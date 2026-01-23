<?php

namespace Fuse\Models;

use Company4\FileVault\Facades\FileVault;
use Fuse\Helpers\Conversions;
use Fuse\Helpers\Storage;
use Fuse\Observers\FileObserver;
use Fuse\Traits\BaseModel;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Override;
use SplFileInfo;

#[ObservedBy(FileObserver::class)]
class File extends Model
{
    use BaseModel;
    use HasUlids;

    protected $appends = [
        // 'storage_path',
    ];
    protected $fillable = [
        'encrypted',
        'fileable_id',
        'fileable_type',
        'folder',
        'meta',
        'name',
        'path',
    ];

    // Attributes
    public function basePath(): Attribute
    {
        return new Attribute(fn () => str_replace('original.png', '', $this->path));
    }

    public function info(): Attribute
    {
        return new Attribute(fn () => $this->is_file ? new SplFileInfo($this->storage_path) : null);
    }

    public function isFile(): Attribute
    {
        return new Attribute(fn () => $this->storage->exists($this->path));
    }

    public function isImage(): Attribute
    {
        return new Attribute(fn () => $this->is_file && str_contains(mime_content_type($this->storage_path), 'image'));
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
        return new Attribute(function ($value) {
            $path = 'files/'.Storage::id_path($this->id, 2).$value;

            if ($this->encrypted && !str_contains($path, '.enc')) {
                $path .= '.enc';
            }

            return $path;
        });
    }

    protected function route(): Attribute
    {
        return new Attribute(fn () => null);
    }

    // Casts
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
            if (!in_array($size, ['original', 'large', 'medium', 'thumb'])) {
                $size = 'thumb';
            }

            $url = asset($this->path);

            if ($size === 'original') {
                return $url;
            }

            return str_replace('original.png', '', $url).$size.'.png';
        }

        return null;
    }

    public function model($model, string $id_attribute = 'id')
    {
        $this->fileable_id   = $model->$id_attribute ?? 0;
        $this->fileable_type = $model::class;
    }

    public function store($file, bool $encrypt = true)
    {
        $this->id ??= Str::ulid();

        $base_path = Storage::id_path($this->id, 2);
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
                $file = imagecreatefromstring(base64_decode(explode(',', $file)[1]));

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
            if ($is_image && !$encrypt) {
                $storage      = null;
                $storage_path = null;
                $this->disk   = 'public';

                $storage      = Storage::disk($this->disk);
                $storage_path = $storage->path('files/'.$base_path);

                $storage->makeDirectory('files/'.$base_path);

                ImageManager
                    ::gd()
                    ->read($file->getPathname())
                    ->save($storage_path.'original.png')
                    ->scaleDown(1920, 1080)
                    ->save($storage_path.'large.png')
                    ->scaleDown(500)
                    ->save($storage_path.'medium.png')
                    ->cover(100, 100)
                    ->save($storage_path.'thumb.png');

                $path = $base_path.'original.png';
            } else {
                $storage    = null;
                $this->disk = 'local';

                $path    = 'public/'.$file->storeAs('files/'.$base_path, $name.'.'.$file->getClientOriginalExtension());
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
