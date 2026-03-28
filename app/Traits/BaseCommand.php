<?php

namespace App\Traits;

use App\Helpers\Fuses;
use App\Helpers\Storage;
use Illuminate\Support\Str;

use function Laravel\Prompts\select;
use function Laravel\Prompts\text;

trait BaseCommand
{
    private array $disks      = [];
    private ?string $model    = null;
    private ?string $fuse     = null;

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
                    $this->getDisk()->allFiles('Fuses/'.$this->getFuse().'/app/Models')
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

    public function getFuse(): string
    {
        if (!$this->fuse) {
            $this->fuse = select(
                label:   'For which Fuse?',
                options: Fuses::active()->pluck('name', 'name'),
                scroll:  10
            );
        }

        return $this->fuse;
    }

    protected function makeModel()
    {
        $model    = null;
        $fuse     = $this->getFuse();

        $model = Str::studly(text('What\'s the model called?'));

        $this->call(
            'module:make-model',
            [
                '--fillable' => 'name',
                'model'      => $model,
                'module'     => $fuse,
            ]
        );

        info('Model `'.$model.'` created successfully for `'.$fuse.'`.');

        return $model;
    }
}
