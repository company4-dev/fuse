<x-layouts::auth :title="__('Confirm password')">
    <div class="flex flex-col gap-6">
        <x-auth-header
            :title="__('Confirm password')"
            :description="__('This is a secure area of the application. Please confirm your password before continuing.')"
        />

        <x-auth-session-status class="text-center" :status="session('status')" />

        <form
            action="{{ route('password.confirm.store') }}"
            class="flex flex-col gap-6"
            method="POST"
        >
            @csrf

            <flux:input
                autocomplete="current-password"
                :label="__('Password')"
                name="password"
                :placeholder="__('Password')"
                required
                type="password"
                viewable
            />

            <flux:button
                class="w-full"
                data-test="confirm-password-button"
                type="submit"
                variant="primary"
            >
                {{ __('Confirm') }}
            </flux:button>
        </form>
    </div>
</x-layouts::auth>
