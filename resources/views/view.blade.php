<x-layouts.app :layout="$layout">
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
        <flux:card class="space-y-6">
            <div class="flex">
                <div class="flex-1">
                    <flux:heading class="mb-3" size="lg">Details</flux:heading>

                    <x-details class="space-y-3" :details="[
                        [
                            'icon'  => 'user',
                            'label' => __('Name'),
                            'value' => $user->name,
                        ],
                        [
                            'icon'  => 'power',
                            'label' => __('Status'),
                            'value' => $user->status_id->details('label'),
                        ],
                        [
                            'icon'  => 'identification',
                            'label' => __('Role'),
                            'value' => $user->role_id->details('label'),
                        ]
                    ]" />
                </div>

                <div class="-mx-2 -mt-2">
                    <flux:button :href="route('users.edit', $user->id)" icon="pencil-square" inset="top right bottom" size="sm" variant="ghost" />
                </div>
            </div>

        </flux:card>

        <flux:card>
            <flux:heading size="lg">Activity</flux:heading>
        </flux:card>

        <flux:card>
            <flux:heading size="lg">// Something Else</flux:heading>
        </flux:card>
    </div>
</x-layouts.app>
