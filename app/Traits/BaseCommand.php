<?php

namespace Fuse\Traits;

use Fuse\Helpers\Platforms;
use Fuse\Helpers\Storage;
use Illuminate\Support\Str;

use function Laravel\Prompts\select;
use function Laravel\Prompts\text;

trait BaseCommand
{
    private array $disks      = [];
    private ?string $model    = null;
    private ?string $platform = null;

    private function getDisk(string $disk = 'root')
    {
        if (!array_key_exists($disk, $this->disks)) {
            $this->disks[$disk] = Storage::disk($disk);
        }

        return $this->disks[$disk];
    }

    public function getModel(): false|string
    {
        if (!$this->model) {
            $models = array_merge(
                [
                    'New',
                ],
                array_map(
                    fn ($model) => basename($model, '.php'),
                    $this->getDisk()->allFiles('Platforms/'.$this->getPlatform().'/app/Models')
                )
            );

            $model = select(
                label: 'For which Model?',
                options: $models,
                scroll: 10
            );

            if ($model === 'New') {
                $model = $this->makeModel();
            }

            $this->model = $model;
        }

        return $this->model;
    }

    public function getPlatform(): string
    {
        if (!$this->platform) {
            $this->platform = select(
                label:   'For which Platform?',
                options: Platforms::active()->pluck('name', 'name'),
                scroll:  10
            );
        }

        return $this->platform;
    }

    protected function makeModel()
    {
        $model    = null;
        $platform = $this->getPlatform();

        $model = Str::studly(text('What\'s the model called?'));

        $this->call(
            'module:make-model',
            [
                '--fillable' => 'name',
                'model'      => $model,
                'module'     => $platform,
            ]
        );

        info('Model `'.$model.'` created successfully for `'.$platform.'`.');

        return $model;
    }
}
