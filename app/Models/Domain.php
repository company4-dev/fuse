<?php

declare(strict_types=1);

namespace App\Models;

use App\Observers\DomainObserver;
use App\Traits\BaseModel;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\SoftDeletes;
use Stancl\Tenancy\Database\Models\Domain as BaseDomain;

#[ObservedBy(DomainObserver::class)]
class Domain extends BaseDomain
{
    use BaseModel;
    use SoftDeletes;

    protected static function defaultSort(): array
    {
        return [
            'domain' => 'asc',
        ];
    }

    protected function route(): Attribute
    {
        return new Attribute(static fn (): null => null);
    }

    public function url(): Attribute
    {
        return Attribute
            ::make(fn (): string => request()->getScheme().'://'.$this->domain.'.'.request()->getHost())
            ->shouldCache();
    }
}
