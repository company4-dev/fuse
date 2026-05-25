<?php

declare(strict_types=1);

namespace App\Hooks;

use App\Base\Hook;
use App\Enums\PlatformHook;
use App\Enums\TenantDisplay;
use App\Helpers\Icons;
use App\Helpers\Tenants;
use Exception;
use Illuminate\Support\Facades\Auth;

class Menu extends Hook
{
    /**
     * @return mixed[]
     */
    public static function get(mixed ...$args): array
    {
        $is_tenant = Tenants::is_tenant();

        $links = [
            [
                'display' => TenantDisplay::Both,
                'icon'    => Icons::dashboard(),
                'label'   => 'dictionary.dashboard',
                'route'   => 'dashboard',
            ],
            [
                'count'   => Auth::user()->notifications()->count(),
                'display' => TenantDisplay::Both,
                'icon'    => Icons::notifications(),
                'label'   => 'dictionary.notifications',
                'modal'   => 'notifications',
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

        if (config('settings.tenancy.enabled')) {
            $links[] = [
                'display' => TenantDisplay::Central,
                'icon'    => Icons::tenants(),
                'label'   => 'dictionary.tenants',
                'route'   => 'tenants',
            ];
        }

        $links = array_merge(
            $links,
            [
                [
                    'display' => TenantDisplay::Both,
                    'icon'    => Icons::users(),
                    'label'   => 'dictionary.users',
                    'route'   => 'users',
                ],
                [
                    'display' => TenantDisplay::Both,
                    'icon'    => Icons::management(),
                    'label'   => 'dictionary.management',
                    'route'   => 'management',
                ],
            ]
        );

        foreach ($links as $key => $link) {
            if (($is_tenant && in_array($link['display'], [TenantDisplay::Both, TenantDisplay::Tenant], true))
                || (!$is_tenant && in_array($link['display'], [TenantDisplay::Both, TenantDisplay::Central], true))
            ) {
                $links[$key]['label'] = ___($links[$key]['label']);

                unset($links[$key]['display']);
            } else {
                unset($links[$key]);
            }
        }

        return $links;
    }
}
