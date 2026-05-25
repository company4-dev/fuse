<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Base\Command;
use App\Helpers\Log;
use App\Helpers\Platforms;
use Illuminate\Filesystem\LocalFilesystemAdapter;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use function Laravel\Prompts\confirm;
use function Laravel\Prompts\info;
use function Laravel\Prompts\intro;
use function Laravel\Prompts\select;
use function Laravel\Prompts\text;

class JellyBeanCommand extends Command
{
    private array $disks      = [];
    private ?string $feature  = null;
    private ?string $model    = null;
    private ?string $platform = null;
    private ?string $view     = null;
    protected $description    = 'JellyBean Growing';
    protected $signature      = 'jb';

    public function handle(): void
    {
        intro('What shall we grow?');

        $commands = [
            'connect_hook'   => 'Connect Hook',
            'make_command'   => 'Make Command',
            'make_component' => 'Make Component',
            'make_email'     => 'Make Email',
            'make_form'      => 'Make Form',
            'make_job'       => 'Make Job',
            'make_migration' => 'Make Migration',
            'make_model'     => 'Make Model',
            'make_page'      => 'Make Page',
            'make_platform'  => 'Make Platform',
            'make_table'     => 'Make Table',
        ];

        foreach (array_keys(Artisan::all()) as $command) {
            if (str_starts_with($command, 'jb:')) {
                $commands[$command] = Str::of($command)->substr(3)->headline()->toString();
            }
        }

        asort($commands);

        $command = select(
            label: 'What do you want to do?',
            options: $commands,
            scroll: 10
        );

        info('Let\'s grow!');

        if (str_starts_with($command, 'jb:')) {
            $this->call($command);
        } else {
            $this->{$command}();
        }
    }

    public function getModel(): false|string
    {
        if (!$this->model) {
            $models = array_merge(
                [
                    'New...',
                ],
                array_map(
                    static fn ($model): string => basename($model, '.php'),
                    $this->getDisk()->allFiles('Platforms/'.$this->getPlatform().'/app/Models')
                )
            );

            $model = select(
                label: 'For which Model?',
                options: $models,
                scroll: 10
            );

            if ($model === 'New...') {
                $model = $this->make_model();
            }

            $this->model = $model;
        }

        return $this->model;
    }

    public function getPlatform(): string
    {
        if (!$this->platform) {
            $this->platform = select(
                label: 'For which Platform?',
                options: Platforms::active()->pluck('name', 'name'),
                scroll: 10
            );
        }

        return $this->platform;
    }

    // Commands
    public function connect_hook(): void
    {
        $hooks = array_map(
            static fn ($model): string => basename($model, '.php'),
            $this->getDisk()->allFiles('app/Hooks')
        );

        $hook = select(
            label: 'Which Hook?',
            options: $hooks,
            scroll: 10
        );

        $stub = $this->getDisk()->exists('stubs/jellybean/hooks/'.$hook.'.stub') ? $hook : 'default';

        $this->generateFile(
            'hooks/'.$stub.'.stub',
            'app/Hooks/'.$hook.'.php',
            [
                'hook' => $hook,
            ],
        );
    }

    private function make_command(): void
    {
        $command = text('What should the console command be named?');

        $this->call(
            'make:command',
            [
                'name' => Str::finish($command, 'Command'),
            ]
        );
    }

    private function make_component(): void
    {
        Log::emergency('Needs updating to Livewire 4, adding support for generating into Platform folders');

        $component = text('What\'s the component called?');

        $this->call(
            'make:livewire',
            [
                'name'   => $component,
                '--pest' => true,
            ]
        );
    }

    private function make_email(): void
    {
        Log::emergency('Add support for generating into Platform folders');

        $mailer = text('What\'s the email called?');

        if (!count(glob(base_path('app/Mail/'.$mailer.'.php')))) {
            $this->call(
                'make:mail',
                [
                    'name' => $mailer,
                ]
            );

            $blade = [
                '@extends(\'layouts.mail\')',
                '',
                '@section(\'content\')',
                '',
                'Hello {{ $recipient[\'first_name\'] }},',
                '',
                '@endsection',
            ];

            file_put_contents(base_path('/resources/views/mail/'.$mailer.'.blade.php'), implode("\r\n", $blade));
        }
    }

    private function make_form(): string
    {
        $form = Str::studly(text('What\'s the form called?'));

        $this->generateFile(
            'form.edit.stub',
            'app/View/Forms/'.$form.'.php',
            [
                'form'  => $form,
                'model' => $this->getModel(),
            ]
        );

        info('Form `'.$form.'` created successfully for `'.$this->getPlatform().'`.');

        return $form;
    }

    private function make_job(): void
    {
        $this->call(
            'make:job',
            [
                'name' => Str
                    ::of(text('What should the console job be named?'))
                    ->studly()
                    ->finish('Job')
                    ->toString(),
            ]
        );
    }

    private function make_migration(): void
    {
        $disk      = $this->getDisk();
        $is_tenant = null;
        $migration = null;
        $platform  = $this->getPlatform();

        $is_tenant = select(
            label: 'Is this for a tenant migration?',
            options: [1 => 'Yes', 0 => 'No']
        );

        $migration = Str::snake(text('What\'s the migration called?', required: true));

        $this->call(
            'module:make-migration',
            [
                'name'   => $migration,
                'module' => $platform,
            ]
        );

        if ($is_tenant) {
            $path = $disk->path('Platforms/'.$platform.'/database/migrations/');

            $migration = glob($path.now()->format('Y_m_d_Hi').'*_'.$migration.'.php')[0];

            $disk->move(
                str_replace($disk->path(''), '', $migration),
                str_replace($disk->path(''), '', $path.'tenant/'.basename($migration)),
            );
        }

        info('Migration `'.$migration.'` created successfully for `'.$platform.'`.');
    }

    protected function make_model(): string
    {
        $disk     = $this->getDisk();
        $headline = null;
        $json     = null;
        $model    = null;
        $path     = null;
        $platform = $this->getPlatform();
        $snake    = null;

        $model = Str::studly(text('What\'s the model called?'));
        $snake = Str::of($model)->snake('-')->plural()->toString();

        $headline = Str::headline($model);

        // Generate Model
        $this->generateFile(
            'model.stub',
            'app/Models/'.$model.'.php',
            [
                'fillable' => [
                    '\'name\'',
                ],
                'model' => $model,
            ]
        );

        // Generate Observer
        $this->generateFile(
            'observer.stub',
            'app/Observers/'.$model.'Observer.php',
            [
                'model' => $model,
            ]
        );

        // Add to logs
        $path = 'Platforms/'.$platform.'/lang/en/logs.json';

        if ($disk->exists($path)) {
            $json = $disk->json($path);
        } else {
            // Generate Log file to map from JSON
            $this->generateFile('log.stub', 'lang/en/logs.php');
            $json = $disk->json($path);
        }

        $json[$snake] = [
            'created'             => 'Created '.$headline.' ":0"',
            'deleted'             => 'Deleted '.$headline.' ":0"',
            'permanently-deleted' => 'Permanently deleted '.$headline.' ":0"',
            'restored'            => 'Restored '.$headline.' ":0"',
            'updated'             => 'Updated '.$headline.' ":item" with changes: :changes',
        ];

        ksort($json);

        $disk->put($path, json_encode($json, JSON_PRETTY_PRINT)."\r\n");

        info('Model `'.$model.'` created successfully for `'.$platform.'`.');

        return $model;
    }

    private function make_page(): void
    {
        $this->getPlatform();

        match (select(
            label: 'What page type?',
            options: [
                'add-form'  => 'Add Form',
                'edit-form' => 'Edit Form',
                'index'     => 'Index',
                'list'      => 'List',
                'view'      => 'View',
            ],
            scroll: 10
        )) {
            'add-form'  => $this->create_form_page('add'),
            'edit-form' => $this->create_form_page('edit'),
            'index'     => $this->create_list_page('index'),
            'list'      => $this->create_list_page(),
            'view'      => $this->create_view_page(),
            default     => 'NEVER ANSWERED',
        };

        info('Page `'.$this->getFeature().'/'.$this->getView().'` created successfully for `'.$this->getPlatform()
            .'`.');
    }

    private function make_platform(): void
    {
        $platform = Str::lower(text('What\'s the platform called?', required: true));

        info('Creating new platform `'.$platform.'.');

        $this->call(
            'module:make',
            [
                'name' => [$platform],
            ]
        );

        info('Platform `'.$platform.'` created successfully.');
    }

    private function make_table(): string
    {
        $platform = $this->getPlatform();
        $table    = text('What\'s the table called?');

        $model = $this->getModel();
        $table = Str::of($table)->studly()->plural()->toString();

        $this->generateFile(
            'table.stub',
            'app/View/Tables/'.$table.'.php',
            [
                'model' => $model,
                'table' => $table,
            ],
        );

        info('Table `'.$table.'` created successfully for `'.$platform.'`.');

        return $table;
    }

    // Creators
    private function create_form_page(string $type): void
    {
        $feature = $this->getFeature();
        $form    = $this->getForm();
        $model   = $this->getModel();

        $this->generateFile(
            'page-form-'.$type.'.stub',
            'resources/views/pages/'.$feature.'/⚡'.$this->getView($type).'.blade.php',
            [
                'feature'   => $feature,
                'form'      => Str::contains($form, '/') ? explode('/', $form)[1] : $form,
                'model'     => $model,
                'namespace' => Str::replace('/', '\\', $form),
            ]
        );
    }

    private function create_list_page(string $view = 'list'): void
    {
        $feature = $this->getFeature();
        $table   = $this->getTable();

        $this->generateFile(
            'page-list.stub',
            'resources/views/pages/'.$feature.'/⚡'.$this->getView('list').'.blade.php',
            [
                'feature' => $feature,
                'table'   => Str::of($table)->lower()->replace('/', '.')->toString(),
            ]
        );
    }

    private function create_view_page(): void
    {
        $feature = $this->getFeature();
        $model   = $this->getModel();

        $this->generateFile(
            'page-view.stub',
            'resources/views/pages/'.$feature.'/⚡'.$this->getView('view').'.blade.php',
            [
                'feature' => $feature,
                'model'   => $model,
            ]
        );
    }

    // Helpers
    private function generateFile(string $stub, string $target, array $replacements = []): void
    {
        $platform          = $this->getPlatform();
        $base_replacements = array_merge(
            [
                'platform' => $platform,
            ],
            $replacements
        );

        $replacements = [];

        foreach ($base_replacements as $key => $value) {
            $array_value = implode(",\r\n", is_array($value) ? $value : [$value]).',';

            $replacements['{{ '.Str::studly($key).' }}'] = is_array($value) ? $array_value : Str::studly($value);
            $replacements['{{ '.Str::slug($key).' }}']   = is_array($value) ? $array_value : Str::slug($value);
            $replacements['{{ $'.Str::slug($key).' }}']  = is_array($value) ? $array_value : Str::snake($value);
        }

        if ($this->getDisk()->exists('Platforms/'.$platform.'/'.$target)) {
            $confirmed = confirm('File already exists: '.$target.'. Do you want to overwrite it?');

            if (!$confirmed) {
                info('Skipped file generation for '.$target);

                return;
            }
        }

        $this->getDisk()->put(
            'Platforms/'.$platform.'/'.$target,
            str_replace(
                array_keys($replacements),
                array_values($replacements),
                $this->getDisk()->get('stubs/jellybean/'.$stub)
            )
        );
    }

    private function getDisk(string $disk = 'root'): LocalFilesystemAdapter
    {
        if (!array_key_exists($disk, $this->disks)) {
            $this->disks[$disk] = Storage::disk($disk);
        }

        return $this->disks[$disk];
    }

    private function getFeature(): string
    {
        if (!$this->feature) {
            $feature_path = 'Platforms/'.$this->getPlatform().'/resources/views/pages/';
            $features     = array_merge(
                [
                    'New...',
                ],
                array_map(
                    static fn ($form) => Str::replace([$feature_path, '.php'], '', $form),
                    $this->getDisk('root')->directories($feature_path)
                )
            );

            $feature = select(
                label: 'For which feature?',
                options: $features,
                scroll: 10
            );

            if ($feature === 'New...') {
                $feature = Str::slug(text('What\'s the feature called?'));
            }

            $this->feature = $feature;
        }

        return $this->feature;
    }

    private function getForm(): string
    {
        $form_path = 'Platforms/'.$this->getPlatform().'/app/View/Forms/';

        $forms = array_merge(
            [
                'New...',
            ],
            array_map(
                static fn ($form) => Str::replace([$form_path, '.php'], '', $form),
                $this->getDisk('root')->allFiles($form_path)
            )
        );

        $form = select(
            label: 'For which form?',
            options: $forms,
            scroll: 10
        );

        if ($form === 'New...') {
            return $this->make_form();
        }

        return $form;
    }

    private function getTable(): string
    {
        $table_path = 'Platforms/'.$this->getPlatform().'/app/View/Tables/';

        $tables = array_merge(
            [
                'New...',
            ],
            array_map(
                static fn ($table) => Str::replace([$table_path, '.php'], '', $table),
                $this->getDisk('root')->allFiles($table_path)
            )
        );

        $table = select(
            label: 'For which table?',
            options: $tables,
            scroll: 10
        );

        if ($table === 'New...') {
            return $this->make_table();
        }

        return $table;
    }

    private function getView(?string $default = null): string
    {
        if (!$this->view) {
            $this->view = Str::slug(text('What\'s the view called?', default: $default ?? ''));
        }

        return $this->view;
    }
}
