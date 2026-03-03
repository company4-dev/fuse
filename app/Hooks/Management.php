<?php

namespace App\Hooks;

use App\Enums\FuseHook;
use App\Enums\TenantDisplay;
use App\Helpers\Icons;
use App\Helpers\Tenants;
use App\Traits\BaseHook;
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
            ___('dictionary.fuses') => [
                [
                    'display' => TenantDisplay::Central,
                    'icon'    => Icons::fuses(),
                    'label'   => 'dictionary.fuses',
                    'route'   => 'management.fuses',
                ],
            ],
        ];

        $is_tenant = Tenants::is_tenant();

        foreach (self::getFuseData(FuseHook::Management) as $fuse_groups) {
            foreach ($fuse_groups['data'] as $group => $links) {
                $group = ___($group);

                if (!array_key_exists($group, $groups)) {
                    $groups[$group] = [];
                }

                foreach ($links as $link) {
                    if (!array_key_exists('display', $link) || !$link['display'] instanceof TenantDisplay) {
                        throw new Exception(___(
                            'errors.exceptions.layouts.management.missing-display',
                            [
                                $fuse_groups['fuse']->getName(),
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
