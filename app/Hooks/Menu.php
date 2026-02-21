<?php

namespace App\Hooks;

use App\Enums\PlatformHook;
use App\Enums\TenantDisplay;
use App\Helpers\Icons;
use App\Helpers\Tenants;
use App\Traits\BaseHook;
use Exception;

class Menu
{
    use BaseHook;

    public static function get(mixed ...$args)
    {
        $is_tenant = Tenants::is_tenant();

        $links = [
            [
                'display' => TenantDisplay::Both,
                'icon'    => Icons::dashboard(),
                'label'   => 'dictionary.dashboard',
                'route'   => 'dashboard',
            ],
        ];

        foreach (self::getPlatformData(PlatformHook::Menu) as $platform_links) {
            foreach ($platform_links['data'] as $link) {
                if (!array_key_exists('display', $link) || !$link['display'] instanceof TenantDisplay) {
                    throw new Exception(___(
                        'errors.exceptions.layouts.menu.missing-display',
                        [
                            $platform_links['platform']->getName(),
                            TenantDisplay::class,
                        ]
                    ));
                }

                $links[] = $link;
            }
        }

        $links = array_merge(
            $links,
            [
                [
                    'display' => TenantDisplay::Central,
                    'icon'    => Icons::tenants(),
                    'label'   => 'dictionary.tenants',
                    'route'   => 'tenants.list',
                ],
                [
                    'display' => TenantDisplay::Both,
                    'icon'    => Icons::users(),
                    'label'   => 'dictionary.users',
                    'route'   => 'users.list',
                ],
                [
                    'display' => TenantDisplay::Both,
                    'icon'    => Icons::management(),
                    'label'   => 'dictionary.management',
                    'route'   => 'management.list',
                ],
            ]
        );

        foreach ($links as $key => $link) {
            if (($is_tenant && in_array($link['display'], [TenantDisplay::Both, TenantDisplay::Tenant]))
                || (!$is_tenant && in_array($link['display'], [TenantDisplay::Both, TenantDisplay::Central]))
            ) {
                $links[$key]['label'] = ___($links[$key]['label']);
            } else {
                unset($links[$key]);
            }
        }

        return $links;
    }
}
