<?php

declare(strict_types=1);

namespace App\Helpers;

use App\Models\User;
use App\Notifications\Toast;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class Notifications
{
    public static function toast(
        string $text,
        mixed $user = null,
        ?string $heading = null,
        ?string $variant = null,
        array|string $translation_replacements = [],
        ?string $link = null
    ): void {
        if (!is_array($translation_replacements)) {
            $translation_replacements = [$translation_replacements];
        }

        $toast = new Toast($text, $heading, $variant, $translation_replacements, $link);

        if (is_array($user) || $user instanceof Collection) {
            foreach ($user as $u) {
                if ($u instanceof User) {
                    $u->notify($toast);
                } elseif (is_numeric($u)) {
                    User::find($u)?->notify($toast);
                } elseif (is_array($u)) {
                    User::find($u['id'])?->notify($toast);
                }
            }
        } elseif (is_null($user)) {
            Auth::user()?->notify($toast);
        } elseif (is_numeric($user)) {
            User::find($user)?->notify($toast);
        } elseif ($user instanceof User) {
            $user->notify($toast);
        }
    }
}
