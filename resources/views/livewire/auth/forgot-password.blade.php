<x-layouts::auth :title="__('Forgot password')">
    <div class="flex flex-col gap-6">
        <x-laravel-defaults.auth-header
            :title="__('Forgot password')"
            :description="__('Enter your email to receive a password reset link')"
        />

        <!-- Session Status -->
        <x-laravel-defaults.auth-session-status
            class="text-center"
            :status="session('status')"
        />

        <form
            action="{{ route('password.email') }}"
            class="flex flex-col gap-6"
            method="POST"
        >
            @csrf

            <!-- Email Address -->
            <flux:input
                :label="__('Email address')"
                name="email"
                type="email"
                required
                autofocus
                placeholder="email@example.com"
            />

            <flux:button
                class="w-full"
                data-test="email-password-reset-link-button"
                variant="primary"
                type="submit"
            >
                {{ __('Email password reset link') }}
            </flux:button>
        </form>

        <div
            class="space-x-1 rtl:space-x-reverse text-center text-sm text-zinc-400"
        >
            <span>{{ __('Or, return to') }}</span>
            <flux:link :href="route('login')" wire:navigate>
                {{ __('log in') }}
            </flux:link>
        </div>
    </div>
</x-layouts::auth>
