<?php

declare(strict_types=1);

namespace App\Hooks;

use App\Base\Hook;
use App\Enums\PlatformHook;
use App\Helpers\Cache;
use App\Models\User;
use Illuminate\Support\Arr;

class Search extends Hook
{
    /**
     * @return array<mixed, array<int, non-empty-array<mixed>>>
     */
    public static function get(mixed ...$args): array
    {
        $term = Arr::get($args, 0);

        return Cache::forHours(
            'search',
            'term',
            $term,
            static function () use ($term): array {
                $results = [];
                $return  = [];

                if ($term !== '') {
                    // Search Results
                    $results[] = User
                        ::search($term)
                        ->get()
                        ->map(static fn ($user): array => [
                            'route' => $user->route,
                            'icon'  => 'user-circle',
                            'label' => $user->name,
                        ])
                        ->toArray();

                    // Hooks
                    foreach (self::getPlatformData(PlatformHook::Search, $term) as $hook_data) {
                        foreach ($hook_data['data'] as $data) {
                            $results[] = $data;
                        }
                    }
                }

                // Menu Results
                $results[] = collect(Menu::get())
                    ->when(
                        $term !== '',
                        static fn ($results) => $results->whereLike('label', '%'.$term.'%')
                    )
                    ->toArray();

                if ($term !== '') {
                    // Management Page Results
                    $management = collect();

                    foreach (Management::get() as $group => $links) {
                        foreach ($links as $link) {
                            $management->push([
                                'route' => $link['route'],
                                'icon'  => $link['icon'],
                                'label' => $group.' > '.$link['label'],
                            ]);
                        }
                    }

                    $results[] = $management
                        ->when(
                            $term !== '',
                            static fn ($results) => $results->whereLike('label', '%'.$term.'%')
                        )
                        ->toArray();
                }

                // Prepare for output
                foreach (array_merge(...$results) as $result) {
                    if (!array_key_exists('route', $result)) {
                        continue;
                    }

                    $route = is_array($result['route']) ? $result['route'] : [$result['route']];

                    $return[route(...$route)] = [
                        'icon'  => $result['icon'],
                        'label' => $result['label'],
                    ];
                }

                return $return;
            }
        );
    }
}
