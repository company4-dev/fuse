<?php

namespace Fuse\Console\Commands;

use Fuse\Helpers\Log;
use Fuse\Traits\BaseCommand;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;

use function Laravel\Prompts\error;
use function Laravel\Prompts\info;
use function Laravel\Prompts\intro;
use function Laravel\Prompts\select;
use function Laravel\Prompts\text;

class FuseCommand extends Command
{
    use BaseCommand;

    private ?string $feature = null;
    private ?string $table   = null;
    private ?string $view    = null;
    protected $description   = 'Fusing';
    protected $signature     = 'jb';

    public function handle()
    {
        intro('What shall we fuse?');

        $commands = [
            'make_command'   => 'Make Command',
            'make_component' => 'Make Component',
            'make_email'     => 'Make Email',
            'make_form'      => 'Make Form',
            'make_migration' => 'Make Migration',
            'make_page'      => 'Make Page',
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

    // Commands
    private function make_command()
    {
        $command = text('What should the console command be named?');

        $this->call(
            'make:command',
            [
                'name' => Str::finish($command, 'Command'),
            ]
        );
    }

    private function make_component()
    {
        Log::emergency('Add support for generating into Platform folders');

        $component = text('What\'s the component called?');

        $this->call(
            'make-volt',
            [
                'name'         => $component,
                '--module'     => true,
                '--pest'       => true,
                '--functional' => true,
            ]
        );
    }

    private function make_email()
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

    private function make_form()
    {
        $form = Str::studly(text('What\'s the form called?'));

        $this->generateFile(
            'form.edit.stub',
            'app/View/Forms/'.$form.'.php',
        );

        info('Form `'.$form.'` created successfully for `'.$this->getPlatform().'`.');

        return $form;
    }

    private function make_migration()
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

    private function make_page()
    {
        $this->getPlatform();

        match (select(
            label: 'What page type?',
            options: [
                'add-form'  => 'Add Form',
                'edit-form' => 'Edit Form',
                'list'      => 'List',
                'view'      => 'View',
            ],
            scroll: 10
        )) {
            'add-form'  => $this->create_form_page('add'),
            'edit-form' => $this->create_form_page('edit'),
            'list'      => $this->create_list_page(),
            'view'      => $this->create_view_page(),
            default     => 'NEVER ANSWERED',
        };

        info('Page `'.$this->getFeature().'/'.$this->getView().'` created successfully for `'.$this->getPlatform().'`.');
    }

    private function make_table()
    {
        $platform = $this->getPlatform();
        $table    = text('What\'s the table called?');

        $model = $this->getModel();
        $table = Str::pluralStudly($table);

        $this->generateFile(
            'table.stub',
            'app/View/Tables/'.$table.'.php',
            [
                'model' => $model,
                'table' => $table,
            ],
        );

        info('Table `'.$table.'` created successfully for `'.$platform.'`.');
    }

    // Creators
    private function create_form_page($type)
    {
        $feature = $this->getFeature();
        $form    = $this->getForm();
        $model   = $this->getModel();

        $this->generateFile(
            'page-form-'.$type.'.stub',
            'resources/views/livewire/'.$feature.'/'.$this->getView().'.blade.php',
            [
                'feature'   => $feature,
                'form'      => Str::contains($form, '/') ? explode('/', $form)[1] : $form,
                'model'     => $model,
                'namespace' => Str::replace('/', '\\', $form),
            ]
        );
    }

    private function create_list_page()
    {
        $feature = $this->getFeature();
        $table   = $this->getTable();

        $this->generateFile(
            'page-list.stub',
            'resources/views/livewire/'.$feature.'/'.$this->getView().'.blade.php',
            [
                'feature' => $feature,
                'table'   => Str::of($table)->lower()->replace('/', '.')->toString(),
            ]
        );
    }

    private function create_view_page()
    {
        $feature = $this->getFeature();
        $model   = $this->getModel();

        if (!$model) {
            error('Run `php artisan jb` again to make the model first before making this page.');

            return Command::FAILURE;
        }

        $this->generateFile(
            'page-view.stub',
            'resources/views/livewire/'.$feature.'/'.$this->getView().'.blade.php',
            [
                'feature' => $feature,
                'model'   => $model,
            ]
        );
    }

    // Helpers
    private function generateFile(string $stub, string $target, array $replacements = [])
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
            $replacements['{{ '.Str::studly($key).' }}'] = Str::studly($value);
            $replacements['{{ '.Str::slug($key).' }}']   = Str::slug($value);
            $replacements['{{ $'.Str::slug($key).' }}']  = Str::snake($value);
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

    private function getFeature()
    {
        if (!$this->feature) {
            $this->feature = Str::slug(text('What\'s the feature called?'));
        }

        return $this->feature;
    }

    private function getForm()
    {
        $form_path = 'Platforms/'.$this->getPlatform().'/app/View/Forms/';

        $forms = array_merge(
            [
                'New',
            ],
            array_map(
                fn ($form) => Str::replace([$form_path, '.php'], '', $form),
                $this->getDisk('root')->allFiles($form_path)
            )
        );

        $form = select(
            label: 'For which form?',
            options: $forms,
            scroll: 10
        );

        if ($form === 'New') {
            $form = $this->make_form();
        }

        return $form;
    }

    private function getTable()
    {
        $table_path = 'Platforms/'.$this->getPlatform().'/app/View/Tables/';

        $tables = array_merge(
            [
                'New',
            ],
            array_map(
                fn ($table) => Str::replace([$table_path, '.php'], '', $table),
                $this->getDisk('root')->allFiles($table_path)
            )
        );

        $table = select(
            label: 'For which table?',
            options: $tables,
            scroll: 10
        );

        if ($table === 'New') {
            $table = $this->make_table();
        }

        return $table;
    }

    private function getView()
    {
        if (!$this->view) {
            $this->view = Str::slug(text('What\'s the view called?'));
        }

        return $this->view;
    }
}
