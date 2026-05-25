<footer class="mt-auto py-3 flex">
    @if (Route::has('login'))
        <nav class="flex flex-1">
            @auth
                <a href="{{ url('/dashboard') }}">
                    {{ ___('dictionary.dashboard') }}
                </a>
            @else
                <flux:button href="{{ route('login') }}" variant="ghost">{{ ___('dictionary.login') }}</flux:button>

                @if (Route::has('register'))
                    <flux:button href="{{ route('register') }}" variant="ghost">{{ ___('dictionary.register') }}</flux:button>
                @endif
            @endauth
        </nav>
    @endif

    <span>&copy; {{ now()->format('Y') }} <a href="https://jellyhaus.com">Jellyhaus</a>. All rights reserved.</span>
</footer>
