<?php

namespace App\Observers;

use App\Models\User;
use App\Traits\BaseObserver;

class UserObserver
{
    use BaseObserver;

    public function created(User $user): void
    {
        $user->log(
            'logs.users.created',
            [
                $user->name,
            ]
        );

        $this->clearUserCaches($user);
    }

    public function updated(User $user): void
    {
        $changes = $this->changes($user);

        unset(
            $changes['last_login'],
            $changes['password'],
            $changes['remember_token'],
        );

        if ($changes) {
            $user->log(
                'logs.users.updated',
                [
                    $user->name,
                    '- '.implode('<br>- ', array_column($changes, 'text')),
                ]
            );

            $this->clearUserCaches($user);
        }
    }

    public function deleted(User $user): void
    {
        $user->log(
            'logs.users.deleted',
            [
                $user->name,
            ]
        );

        $this->clearUserCaches($user);
    }

    public function restored(User $user): void
    {
        $user->log(
            'logs.users.restored',
            [
                $user->name,
            ]
        );

        $this->clearUserCaches($user);
    }

    public function forceDeleted(User $user): void
    {
        $user->log(
            'logs.users.permanently-deleted',
            [
                $user->name,
            ]
        );

        $this->clearUserCaches($user);
    }

    // Helpers
    protected function clearUserCaches($user): void
    {
        $this->clearCaches($user);
    }
}
