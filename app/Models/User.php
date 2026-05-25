<?php

declare(strict_types=1);

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\UserStatus;
use App\Observers\UserObserver;
use App\Traits\BaseModel;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
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
use Override;
use Spatie\Permission\Traits\HasRoles;

#[Fillable([
    'created_by',
    'first_name',
    'last_name',
    'email',
    'password',
    'role_id',
    'updated_by',
])]
#[Hidden([
    'password',
    'remember_token',
])]
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

    protected $metaKeyName   = 'user_id';
    protected $metaTable     = 'user_meta';
    protected $search_fields = [
        [
            'first_name',
            'last_name',
        ],
        'email',
    ];

    // Attributes
    // User's full name
    public function avatar(): Attribute
    {
        return new Attribute(
            fn (): string => 'https://ui-avatars.com/api/?name='.urlencode($this->name).'&background=ff7c00'
        );
    }

    // User's full name
    public function name(): Attribute
    {
        return new Attribute(fn (): string => $this->first_name.' '.$this->last_name);
    }

    protected function role(): Attribute
    {
        return new Attribute(fn () => $this->roles()->first());
    }

    public function route(): Attribute
    {
        return new Attribute(fn (): array => ['users.view', $this->id]);
    }

    // Casts
    #[Override]
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
            ->map(static fn ($word) => Str::substr($word, 0, 1))
            ->implode('');
    }

    // Relations

    // Scopes
    public function scopeByRole(Builder $query, int $role): void
    {
        $query->where('role_id', $role);
    }
}
