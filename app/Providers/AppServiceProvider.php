<?php

declare(strict_types=1);

namespace App\Providers;

use App\Enums\SSOProvider;
use App\Helpers\Cache as CacheHelper;
use App\Helpers\Icons as IconsHelper;
use App\Helpers\Log;
use App\Helpers\Platforms;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Number;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;
use Livewire\Livewire;
use Override;
use Throwable;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    #[Override]
    public function register(): void
    {
        $providers    = [];
        $raw_settings = null;
        $settings     = [];

        try {
            $raw_settings = DB
                ::table('settings')
                ->where(static fn ($query) => $query
                    ->where('group', 'sso')
                    ->whereIn('name', ['provider', 'status']))
                ->orWhere(static fn ($query) => $query
                    ->where('group', 'tenancy')
                    ->whereIn('name', ['enabled']))
                ->get();

            foreach ($raw_settings as $setting) {
                $settings[$setting->group.'.'.$setting->name] = $setting->value;
            }

            // SSO
            if ((bool) ($settings['sso.status'] ?? config('settings.sso.status'))) {
                $providers[] = SSOProvider
                    ::fromName($settings['sso.provider'])
                    ->class();
            }

            // Tenancy
            if ((bool) ($settings['tenancy.enabled'] ?? config('settings.tenancy.enabled'))) {
                $providers[] = TenancyServiceProvider::class;
            }

            foreach ($providers as $provider) {
                $this->app->register($provider);
            }
        } catch (Throwable $throwable) {
            if (!App::runningUnitTests()) {
                Log::error($throwable->getMessage());
            }
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }

        Blade::if('isdev', static fn (): bool => is_dev());

        // Automatically eager load relationships on models
        Model::AutomaticallyEagerLoadRelationships();
        // Enforce defined loading or relationships
        Model::shouldBeStrict();

        Number::useCurrency('GBP');

        foreach (Platforms::active()->get() as $slug => $platform) {
            Livewire::addNamespace($slug, $platform->getPath().'/resources/views/components');
            Livewire::addNamespace($slug.'.pages', $platform->getPath().'/resources/views/pages');
        }

        $this->app->singleton(CacheHelper::class, static fn (): CacheHelper => new CacheHelper);
        $this->app->singleton(IconsHelper::class, static fn (): IconsHelper => new IconsHelper);

        $this->bootBlueprintMacros();
        $this->bootCollectionMacros();
        $this->bootStorageMacros();
        $this->configureDefaults();
    }

    private function bootBlueprintMacros(): void
    {
        Blueprint::macro(
            'users',
            fn (): Collection => new Collection([
                $this->foreignId('created_by')->constrained('users')->after('created_at'),
                $this->foreignId('updated_by')->constrained('users')->after('updated_at'),
                $this->foreignId('deleted_by')->nullable()->constrained('users')->after('deleted_at'),
            ])
        );
    }

    private function bootCollectionMacros(): void
    {
        Collection::macro(
            'convertTreeToSelect',
            function (
                array $tree,
                mixed $value_column,
                string $key_column,
                bool $select_parent = false,
                int $level = 0
            ): array {
                $branch = [];

                foreach ($tree as $element) {
                    if ($select_parent) {
                        if (is_array($value_column)) {
                            $concatenated_value_column = [];

                            foreach ($value_column as $column) {
                                $concatenated_value_column = $element[$column];
                            }
                            $branch[$element[$key_column]] = implode('', array_pad([], $level, '-&nbsp;&nbsp;&nbsp;'))
                                .implode(' ', $concatenated_value_column);
                        } else {
                            $branch[$element[$key_column]] = implode('', array_pad([], $level, '-&nbsp;&nbsp;&nbsp;'))
                                .$element[$value_column];
                        }

                        if (isset($element['children'])) {
                            $branch += $this->convertTreeToSelect(
                                $element['children'],
                                $value_column,
                                $key_column,
                                $select_parent,
                                $level + 1
                            );
                        }
                    } elseif (isset($element['children'])) {
                        $branch[$element[$value_column]] = $this->convertTreeToSelect(
                            $element['children'],
                            $value_column,
                            $key_column,
                            $select_parent,
                            $level + 1
                        );
                    } elseif (is_array($value_column)) {
                        $concatenated_value_column = [];

                        foreach ($value_column as $column) {
                            $concatenated_value_column[] = $element[$column];
                        }

                        $branch[$element[$key_column]] = implode(' ', $concatenated_value_column);
                    } else {
                        if ($key_column === 'id' && !isset($element[$key_column])) {
                            $element[$key_column] = -1;
                        }

                        $branch[$element[$key_column]] = $element[$value_column];
                    }
                }

                return $branch;
            }
        );

        Collection::macro(
            'createTree',
            function (array $array, ?int $parent_id = null, string $parent_key = 'parent_id'): array {
                $tree = [];

                foreach ($array as $item) {
                    if (array_key_exists($parent_key, $item)) {
                        if ((int) $item[$parent_key] === (int) $parent_id) {
                            $children = $this->createTree($array, $item['id'], $parent_key);

                            if (!isset($tree[$item['id']])) {
                                $tree[$item['id']]              = $item;
                                $tree[$item['id']][$parent_key] = null;
                            }

                            if ($children) {
                                $tree[$item['id']]['children'] = array_merge(
                                    $tree[$item['id']]['children'] ?? [],
                                    $children
                                );
                            }
                        }
                    } else {
                        $tree[$item['id']] = $item;
                    }
                }

                return $tree;
            }
        );

        Collection::macro(
            'flattenKeys',
            static function (array $input, string $separator = ' - '): array {
                $result = [];

                $recurse = static function ($array, $prefix = '') use (&$recurse, &$result, $separator): void {
                    foreach ($array as $key => $value) {
                        $newKey = $prefix === '' ? $key : $prefix.$separator.$key;

                        if (is_array($value) && count($value) === 1 && is_array(reset($value))) {
                            // Continue recursion if there's only one nested array
                            $recurse($value, $newKey);
                        } else {
                            // Stop recursion and assign the final array
                            $result[$newKey] = $value;
                        }
                    }
                };

                $recurse($input);

                return $result;
            }
        );

        Collection::macro(
            'selectTree',
            function (
                ?int $parent_id = null,
                mixed $value_column = 'name',
                string $key_column = 'id',
                bool $select_parent = false,
                string $parent_key = 'parent_id'
            ) {
                $tree = $this->createTree($this->sortBy($parent_key)->toArray(), $parent_id, $parent_key);

                return $this->convertTreeToSelect($tree, $value_column, $key_column, $select_parent);
            }
        );

        Collection::macro(
            'tree',
            fn (?int $parent_id = null, string $parent_key = 'parent_id') => $this->createTree(
                $this->toArray(),
                $parent_id,
                $parent_key
            )
        );

        Collection::macro(
            'whereLike',
            fn (string $key, string $value) => $this->filter(static function ($item) use ($key, $value): bool {
                $item_value   = is_array($item) ? ($item[$key] ?? '') : ($item->$key ?? '');
                $item_value   = strtolower((string) $item_value);
                $search_value = strtolower($value);

                // If no wildcards, do exact match (case-insensitive)
                if (!str_contains($search_value, '%')) {
                    return $item_value === $search_value;
                }

                // Convert SQL LIKE pattern to regex
                // Escape special regex characters except %
                $pattern = preg_quote($search_value, '/');
                // Replace escaped % with .*
                $pattern = str_replace('%', '.*', $pattern);
                // Anchor the pattern
                $pattern = '/^'.$pattern.'$/';

                return preg_match($pattern, $item_value) === 1;
            })
        );
    }

    private function bootStorageMacros(): void
    {
        /**
         * Returns a path based off a passed id. Making it easier to navigate folder structures.
         */
        Storage::macro(
            'id_path',
            static fn (string $id, int $split_length = 1): string => implode('/', str_split($id, $split_length)).'/'
        );

        Storage::macro(
            'tmp_path',
            static fn (): string => sys_get_temp_dir().'/'
        );
    }

    /**
     * Configure default behaviors for production-ready applications.
     */
    private function configureDefaults(): void
    {
        Date::use(CarbonImmutable::class);

        DB::prohibitDestructiveCommands(
            app()->isProduction(),
        );

        Password::defaults(
            fn (): ?Password => app()->isProduction()
            ? Password::min(12)
                ->mixedCase()
                ->letters()
                ->numbers()
                ->symbols()
                ->uncompromised()
            : null,
        );
    }
}
