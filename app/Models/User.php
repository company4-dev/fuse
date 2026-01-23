<?php

namespace Fuse\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Database\Factories\UserFactory;
use Fuse\Enums\UserStatus;
use Fuse\Observers\UserObserver;
use Fuse\Traits\BaseModel;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Kodeine\Metable\Metable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

#[ObservedBy(UserObserver::class)]
class User extends Authenticatable
{
    use BaseModel;
    use HasApiTokens;
    use HasFactory;
    use HasRoles;
    use Metable;
    use Notifiable;
    use SoftDeletes;

    protected $fillable = [
        'created_by',
        'first_name',
        'last_name',
        'email',
        'password',
        'role_id',
        'updated_by',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $metaKeyName = 'user_id';
    protected $metaTable   = 'user_meta';

    // Attributes
    // User's full name
    public function avatar(): Attribute
    {
        return new Attribute(fn () => 'https://ui-avatars.com/api/?name='.urlencode($this->name).'&background=ff7c00');
    }

    // User's full name
    public function name(): Attribute
    {
        return new Attribute(fn () => $this->first_name.' '.$this->last_name);
    }

    protected function role(): Attribute
    {
        return new Attribute(fn () => $this->roles()->first());
    }

    protected function route(): Attribute
    {
        return new Attribute(fn () => ['users.view', $this->id]);
    }

    // Casts
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
            'status_id'         => UserStatus::class,
        ];
    }

    // Global
    protected static function newFactory(): Factory
    {
        return UserFactory::new();
    }

    // Methods
    protected static function defaultSort(): array
    {
        return [
            'first_name' => 'asc',
            'last_name'  => 'asc',
        ];
    }

    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->take(2)
            ->map(fn ($word) => Str::substr($word, 0, 1))
            ->implode('');
    }

    // Relations

    // Scopes
    public function scopeByRole(Builder $query, int $role)
    {
        $query->where('role_id', $role);
    }
}
