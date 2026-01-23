<?php

namespace Fuse\Helpers;

use Livewire\Component;

class Livewire extends Component
{
    public static function layout(?array $breadcrumbs = null, null|object|string $avatar = null, ?array $menu = null)
    {
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
}
