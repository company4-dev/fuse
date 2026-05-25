<?php

declare(strict_types=1);

namespace App\Observers;

use App\Base\Observer;
use App\Models\User;

class UserObserver extends Observer
{
    public function created(User $user): void
    {
        $this->run_created($user, $user->name);
    }

    public function deleted(User $user): void
    {
        $this->run_deleted($user, $user->name);
    }

    public function forceDeleted(User $user): void
    {
        $this->run_force_deleted($user, $user->name);
    }

    public function restored(User $user): void
    {
        $this->run_restored($user, $user->name);
    }

    public function updated(User $user): void
    {
        $this->run_updated(
            $user,
            $user->name,
            value_map: [
                'last_login'     => null,
                'password'       => null,
                'remember_token' => null,
            ]
        );
    }
}
