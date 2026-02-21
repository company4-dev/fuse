<x-layouts.base class="min-h-screen bg-white dark:bg-zinc-800" :title="$title ?? null">
    <flux:header container class="bg-zinc-50 dark:bg-zinc-900 border-b border-zinc-200 dark:border-zinc-700">
        <flux:sidebar.toggle class="lg:hidden my-2" icon="bars-2" inset="left" />

        <flux:brand class="max-lg:ml-3 dark:hidden" href="/" logo="/icon.png" :name="config('app.name')" wire:navigate/>
        <flux:brand class="max-lg:ml-3 hidden dark:flex" href="/" logo="/icon.png" :name="config('app.name')" wire:navigate/>

        <flux:navbar class="-mb-px max-lg:hidden">
            <flux:navbar.item icon="home" href="/" :current="request()->routeIs('/')" wire:navigate>
                {{ ___('dictionary.home') }}
            </flux:navbar.item>
        </flux:navbar>

        <flux:spacer />

        <flux:navbar class="-mb-px max-lg:hidden">
            @auth
                <flux:navbar.item icon="home" :href="route('dashboard')" wire:navigate>
                    {{ ___('dictionary.dashboard') }}
                </flux:navbar.item>
            @else
                <flux:navbar.item icon="arrow-right-to-bracket" :href="route('login')" wire:navigate>
                    {{ ___('dictionary.login') }}
                </flux:navbar.item>

                @if (Route::has('register'))
                    <flux:navbar.item icon="file-signature" :href="route('register')" wire:navigate>
                        {{ ___('dictionary.register') }}
                    </flux:navbar.item>
                @endif
            @endauth
        </flux:navbar>

        <!-- Desktop User Menu -->
    </flux:header>

    <!-- Mobile Menu -->
    <flux:sidebar sticky collapsible="mobile" class="lg:hidden bg-zinc-50 dark:bg-zinc-900 border-r border-zinc-200 dark:border-zinc-700">
        <flux:sidebar.header>
            <flux:sidebar.brand
                href="/"
                logo="/icon.png"
                logo:dark="/icon.png"
                :name="config('settings.app.name')"
            />

            <flux:sidebar.collapse class="in-data-flux-sidebar-on-desktop:not-in-data-flux-sidebar-collapsed-desktop:-mr-2" />
        </flux:sidebar.header>

        <flux:sidebar.nav>
            <flux:sidebar.item icon="home" href="/" :current="request()->routeIs('/')" wire:navigate>
                {{ ___('dictionary.home') }}
            </flux:sidebar.item>
        </flux:sidebar.nav>

        <flux:sidebar.spacer />

        <flux:sidebar.nav>
            @auth
                <flux:sidebar.item icon="home" :href="route('dashboard')" wire:navigate>
                    {{  ___('dictionary.dashboard') }}
                </flux:sidebar.item>
            @else
                <flux:sidebar.item icon="arrow-right-to-bracket" :href="route('login')" wire:navigate>
                    {{  ___('dictionary.login') }}
                </flux:sidebar.item>

                @if (Route::has('register'))
                    <flux:sidebar.item icon="file-signature" :href="route('register')" wire:navigate>
                        {{  ___('dictionary.register') }}
                    </flux:sidebar.item>
                @endif
            @endauth
        </flux:sidebar.nav>
    </flux:sidebar>

    <flux:main
        :class="$class ?? null"
        container
    >
        {{ $slot }}
    </flux:main>
</x-layouts.base>
