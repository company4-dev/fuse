<div class="container">
    <flux:card>
        <x-form :model="$user" name="users.user" wire:submit="save" />
    </flux:card>
</div>
