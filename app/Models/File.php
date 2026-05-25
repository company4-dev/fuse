<?php

declare(strict_types=1);

namespace App\Models;

use App\Helpers\Cache;
use App\Helpers\Conversions;
use App\Helpers\Files;
use App\Helpers\Formatters;
use App\Jobs\GenerateImages;
use App\Observers\FileObserver;
use App\Traits\BaseModel;
use Company4\FileVault\Facades\FileVault;
use Exception;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Override;
use SplFileInfo;
use stdClass;

#[Fillable([
    'encrypted',
    'fileable_id',
    'fileable_type',
    'folder',
    'meta',
    'name',
    'path',
])]
#[ObservedBy(FileObserver::class)]
class File extends Model
{
    use BaseModel;
    use HasUlids;

    // Attributes
    public function basePath(): Attribute
    {
        return new Attribute(fn (): string|array => str_replace('original.png', '', $this->path));
    }

    public function downloadLink(): Attribute
    {
        return new Attribute(fn (): string => '/files/download/'.$this->id);
    }

    public function extension(): Attribute
    {
        return new Attribute(function () {
            if (!$this->file_info) {
                return null;
            }

            $extension = property_exists($this->file_info, 'extension') ? $this->file_info->extension : null;

            if ($extension === null) {
                return null;
            }

            if ($extension === 'enc') {
                $exploded_filename = explode('.', $this->file_info->filename);
                $extension         = $exploded_filename[count($exploded_filename) - 2];
            }

            return $extension;
        });
    }

    public function fileInfo(): Attribute
    {
        $disk = Storage::disk($this->disk);

        return $this->getOriginal('id')
            ? Cache::attribute(fn (): ?stdClass => $disk->exists($this->path)
                ? Files::info($disk->path($this->path))
                : null)
            : new Attribute(fn (): ?stdClass => $disk->exists($this->path)
                ? Files::info($disk->path($this->path))
                : null);
    }

    public function info(): Attribute
    {
        return new Attribute(fn (): ?SplFileInfo => $this->is_file ? new SplFileInfo($this->storage_path) : null);
    }

    public function isFile(): Attribute
    {
        return new Attribute(fn () => $this->storage->exists($this->path));
    }

    public function isImage(): Attribute
    {
        return new Attribute(
            fn (): bool => $this->is_file && str_contains(mime_content_type($this->storage_path), 'image')
        );
    }

    public function storage(): Attribute
    {
        return new Attribute(fn () => Storage::disk($this->disk));
    }

    public function storagePath(): Attribute
    {
        return new Attribute(fn () => $this->storage->path($this->path));
    }

    public function path(): Attribute
    {
        return new Attribute(function (string $value): string {
            $path = 'files/'.Storage::id_path($this->id, 2).$value;

            if ($this->encrypted && !str_contains($path, '.enc')) {
                $path .= '.enc';
            }

            return $path;
        });
    }

    protected function route(): Attribute
    {
        return new Attribute(static fn (): null => null);
    }

    // Casts
    #[Override]
    protected function casts(): array
    {
        return [
            'meta' => 'array',
        ];
    }

    // Methods
    public function image_url(string $size = 'thumb'): ?string
    {
        if ($this->is_image) {
            $path  = $this->path;
            $sizes = ['original', 'large', 'medium', 'thumb'];

            if (!in_array($size, $sizes, true)) {
                throw new Exception(___(
                    'errors.exceptions.models.file.invalid-size',
                    Formatters::implode('", "', '" or "', $sizes)
                ));
            }

            if ($size !== 'original') {
                $path = str_replace('original', $size, $path);
            }

            return Storage::disk($this->disk)->url($path);
        }

        return null;
    }

    public function set_model($model, string $id_attribute = 'id'): void
    {
        $this->fileable_id   = $model->$id_attribute ?? 0;
        $this->fileable_type = $model::class;
    }

    public function store($file, bool $encrypt = true): bool
    {
        $this->disk = 'local';
        $this->id ??= Str::ulid();

        $base_path = 'files/'.Storage::id_path($this->id, 2);
        $name      = Conversions::to_base_64(time());
        $mime      = null;
        $storage   = null;
        $valid     = false;

        if ($file instanceof UploadedFile) {
            $mime     = $file->getMimeType();
            $is_image = str_contains($mime, 'image');
            $valid    = true;
        } elseif (is_string($file)) {
            $temp_path = Storage::tmp_path().microtime(true);

            if (str_starts_with($file, 'data:image')) {
                $file = imagecreatefromstring(base64_decode(explode(',', $file)[1], true));

                imagepng($file, $temp_path, 0);
            } else {
                file_put_contents($temp_path, $file);
            }

            $file = new SplFileInfo($temp_path);
            $mime = mime_content_type($temp_path);

            $is_image = str_contains($mime, 'image');
            $valid    = true;
        }

        if ($valid) {
            if ($is_image) {
                $encrypt      = false;
                $storage      = null;
                $storage_path = null;
                $this->disk   = 'public';

                $storage      = Storage::disk($this->disk);
                $storage_path = $storage->path($base_path);

                $storage->makeDirectory($base_path);

                // Save the original image
                ImageManager
                    ::gd()
                    ->read($file->getPathname())
                    ->save($storage_path.'original.png');

                GenerateImages::dispatch($this->disk, $base_path.'original.png');

                $path = $base_path.'original.png';
            } else {
                $storage    = null;
                $this->disk = 'local';

                $path    = $file->storeAs($base_path, $name.'.'.$file->getClientOriginalExtension());
                $storage = Storage::disk($this->disk);
            }

            $this->path = basename($path);

            if ($encrypt) {
                $this->encrypted = true;

                FileVault::encrypt($path);

                $this->path = basename($path).'.enc';
            } else {
                $this->encrypted = false;
            }

            $this->save();
        }

        return true;
    }

    // Models
    public function model()
    {
        return $this->morphTo('fileable');
    }

    // Parent Extensions
    #[Override]
    public function delete()
    {
        if ($this->storage->exists($this->path)) {
            $this->storage->deleteDirectory(dirname($this->path));
        }

        return parent::delete();
    }

    #[Override]
    public function save(array $options = [])
    {
        if (!$this->fileable_id) {
            $this->fileable_id = 0;
        }

        if (!$this->fileable_type) {
            $this->fileable_type = '';
        }

        return parent::save($options);
    }
}
