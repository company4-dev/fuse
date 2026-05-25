<?php

declare(strict_types=1);

use App\Helpers\Icons;
use App\Extensions\Livewire\Component;
use App\Models\User;
use Livewire\Attributes\Locked;

new class extends Component
{
    #[Locked]
    public User $user;

    #[Locked]
    public $details;

    public function mount($id)
    {
        $this->user = User::find($id);

        $this->details = [
            [
                'icon'  => Icons::user(),
                'label' => 'dictionary.name',
                'value' => $this->user->name,
            ],
            [
                'icon'  => Icons::status(),
                'label' => 'dictionary.status',
                'value' => $this->user->status_id->details('label'),
            ],
            [
                'icon'  => 'identification',
                'label' => 'dictionary.role',
                'value' => $this->user->role_id,
            ]
        ];

        $this->layout(
            [
                'users' => 'dictionary.users',
                $this->user->name,
            ],
            $this->user->avatar,
            [
                [
                    'icon'  => Icons::edit(),
                    'label' => ['phrases.edit', ['dictionary.user']],
                    'route' => ['users.edit', $this->user->id],
                ],
            ]
        );
    }
};
?>

<div>
    <x-page-header
        :activity="$user"
        :charts="null"
        :$details
        :users="null"
    />
</div>
