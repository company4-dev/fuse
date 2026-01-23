<?php

namespace Fuse\Hooks;

use Fuse\Enums\PlatformHook;
use Fuse\Enums\TenantDisplay;
use Fuse\Helpers\Icons;
use Fuse\Helpers\Tenants;
use Fuse\Traits\BaseHook;
use Exception;

class Management
{
    use BaseHook;

    public static function get(mixed ...$args)
    {
        $groups = [
            ___('dictionary.system') => [
                [
                    'display' => TenantDisplay::Both,
                    'icon'    => Icons::log(),
                    'label'   => 'dictionary.logs',
                    'route'   => 'management.logs',
                ],
            ],
            ___('dictionary.users') => [
                [
                    'display' => TenantDisplay::Both,
                    'icon'    => Icons::roles(),
                    'label'   => 'dictionary.roles',
                    'route'   => 'management.roles',
                ],
            ],
            ___('dictionary.platforms') => [
                [
                    'display' => TenantDisplay::Central,
                    'icon'    => Icons::platforms(),
                    'label'   => 'dictionary.platforms',
                    'route'   => 'management.platforms',
                ],
            ],
        ];

        $is_tenant = Tenants::is_tenant();

        foreach (self::getPlatformData(PlatformHook::Management) as $platform_groups) {
            foreach ($platform_groups['data'] as $group => $links) {
                $group = ___($group);

                if (!array_key_exists($group, $groups)) {
                    $groups[$group] = [];
                }

                foreach ($links as $link) {
                    if (!array_key_exists('display', $link) || !$link['display'] instanceof TenantDisplay) {
                        throw new Exception(___(
                            'errors.exceptions.layouts.management.missing-display',
                            [
                                $platform_groups['platform']->getName(),
                                TenantDisplay::class,
                            ]
                        ));
                    }

                    $groups[$group][] = $link;
                }
            }
        }

        foreach ($groups as $group => $links) {
            foreach ($links as $key => $link) {
                if (($is_tenant && in_array($link['display'], [TenantDisplay::Both, TenantDisplay::Tenant]))
                    || (!$is_tenant && in_array($link['display'], [TenantDisplay::Both, TenantDisplay::Central]))
                ) {
                    $groups[$group][$key]['label'] = ___($groups[$group][$key]['label']);
                    unset($groups[$group][$key]['display']);
                } else {
                    unset($groups[$group][$key]);
                }
            }

            if (!$groups[$group]) {
                unset($groups[$group]);
            }
        }

        ksort($groups);

        return $groups;
    }
}
