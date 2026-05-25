<?php

declare(strict_types=1);

namespace App\Extensions\Livewire;

use Livewire\Component as BaseComponent;
use Override;

class Component extends BaseComponent
{
    public static function layout(
        ?array $breadcrumbs = null,
        null|object|string $avatar = null,
        ?array $menu = null
    ): void {
        view()->share(
            'layout',
            [
                'avatar' => match (true) {
                    is_null($avatar)   => null,
                    is_string($avatar) => $avatar,
                    default            => $avatar->value,
                },
                'breadcrumbs' => $breadcrumbs,
                'menu'        => $menu,
                'title'       => $breadcrumbs ? $breadcrumbs[array_key_last($breadcrumbs)] : 'dictionary.dashboard',
            ]
        );
    }

    /**
     * phpcs:disable Generic.CodeAnalysis.UselessOverridingMethod.Found
     *
     * We default to true, overriding Livewire's default of false.
     */
    #[Override]
    public function redirect($url, $navigate = true)
    {
        return parent::redirect($url, $navigate);
    }
    // phpcs:enable Generic.CodeAnalysis.UselessOverridingMethod.Found
}
