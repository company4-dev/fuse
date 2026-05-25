<?php

declare(strict_types=1);

namespace App\Extensions\Livewire;

use App\Models\File;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Livewire\WithFileUploads as BaseWithFileUploads;

trait WithFileUploads
{
    use BaseWithFileUploads;

    public function removeFile(string $name, ?int $index = null): void
    {
        $name = Str::chopStart($name, 'form.');

        if ($index !== null) {
            // Multiple
            $file = $this->form->$name[$index];

            $file->delete();

            unset($this->form->$name[$index]);

            $this->form->$name = array_values($this->form->$name);
        } else {
            // Single
            $this->form->$name->delete();
        }
    }

    public function saveFiles(array $uploaded_files, ?Model $model = null, ?string $group = null, bool $encrypt = true)
    {
        if (!is_array($uploaded_files)) {
            $uploaded_files = [$uploaded_files];
        }

        foreach ($uploaded_files as $uploaded_file) {
            $file        = new File;
            $file->group = $group;

            if ($model instanceof Model) {
                $file->set_model($model);
            }

            $file->name = basename(
                $uploaded_file->getClientOriginalName(),
                '.'.$uploaded_file->getClientOriginalExtension()
            );

            $file->store($uploaded_file, $encrypt);
        }

        return $uploaded_files;
    }
}
