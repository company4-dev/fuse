@php
    use App\Helpers\Routes;

    $expected = [
        'avatar',
        'breadcrumbs',
        'title',
    ];

    foreach ($expected as $key) {
        $$key = $$key ?? $layout[$key];
    }
@endphp
<x-layouts.base class="min-h-screen bg-white dark:bg-zinc-800" :title="implode(' > ', array_map('___', $breadcrumbs ?? ['dictionary.dashboard']))">
    <flux:sidebar class="border-e border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900" collapsible="mobile" sticky>
        <flux:sidebar.header>
            <flux:sidebar.brand
                href="{{ route('dashboard') }}"
                logo="{{ '/icon.png' }}"
                logo:dark="{{ '/icon.png' }}"
                name="{{ config('app.name') }}"
                wire:navigate
            />
        </flux:sidebar.header>

        <flux:sidebar.nav>
            @foreach ($links as $link)
                @if ($link['children'] ?? false)
                    <flux:sidebar.group class="grid" expandable :heading="___($link['label'])">
                        @if (array_key_exists('route', $link))
                            <flux:sidebar.item
                                :href="route($link['route'] === 'dashboard' ? $link['route'] : $link['route'])"
                                :icon="$link['icon']"
                                wire:navigate
                            >
                                {{ ___($link['label']) }}
                            </flux:sidebar.item>
                        @endif

                        @foreach ($link['children'] as $child)
                            <flux:sidebar.item
                                :href="route($child['route'] === 'dashboard' ? $child['route'] : $child['route'])"
                                :icon="$child['icon']"
                                wire:navigate
                            >
                                {{ ___($child['label']) }}
                            </flux:sidebar.item>
                        @endforeach
                    </flux:sidebar.group>
                @else
                    <flux:sidebar.item
                        :href="route($link['route'] === 'dashboard' ? $link['route'] : $link['route'])"
                        :icon="$link['icon']"
                        wire:navigate
                    >
                        {{ ___($link['label']) }}
                    </flux:sidebar.item>
                @endif
            @endforeach
        </flux:sidebar.nav>

        <flux:spacer />

        @if (config('app.env') === 'local')
            <flux:sidebar.nav>
                <flux:sidebar.group :heading="___('dictionary.jellybean')" class="grid">
                    <flux:sidebar.item
                        href="https://bitbucket.org/jellyhaus/jellybean/src/main/documentation/"
                        icon="book"
                        target="_blank"
                    >
                        {{ ___('phrases.jellybean-documentation') }}
                    </flux:sidebar.item>

                    <flux:sidebar.item icon="book" href="https://laravel.com/docs/starter-kits#livewire" target="_blank">
                        {{ ___('phrases.laravel-documentation') }}
                    </flux:sidebar.item>
                </flux:sidebar.group>
            </flux:sidebar.nav>
        @endif

        <!-- Desktop User Menu -->
        <flux:dropdown class="hidden lg:block" position="bottom" align="start">
            <flux:profile
                :name="auth()->user()->name"
                :avatar="auth()->user()->avatar"
                icon:trailing="sort"
            />

            <flux:menu class="w-[220px]">
                <flux:menu.radio.group>
                    <div class="p-0 text-sm font-normal">
                        <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                            <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                <span
                                    class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white"
                                >
                                    {{ auth()->user()->initials() }}
                                </span>
                            </span>

                            <div class="grid flex-1 text-start text-sm leading-tight">
                                <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                            </div>
                        </div>
                    </div>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <flux:menu.radio.group>
                    <flux:menu.item :href="route('profile')" icon="user" wire:navigate>
                        {{ ___('dictionary.profile') }}
                    </flux:menu.item>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                        {{ ___('phrases.log-out') }}
                    </flux:menu.item>
                </form>
            </flux:menu>
        </flux:dropdown>
    </flux:sidebar>

    <!-- Mobile User Menu -->
    <flux:header class="lg:hidden">
        <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

        <flux:spacer />

        <flux:dropdown position="top" align="end">
            <flux:profile
                :avatar="auth()->user()->avatar"
                icon-trailing="chevron-down"
            />

            <flux:menu>
                <flux:menu.radio.group>
                    <div class="p-0 text-sm font-normal">
                        <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                            <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                <span
                                    class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white"
                                >
                                    {{ auth()->user()->initials() }}
                                </span>
                            </span>

                            <div class="grid flex-1 text-start text-sm leading-tight">
                                <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                            </div>
                        </div>
                    </div>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <flux:menu.radio.group>
                    <flux:menu.item :href="route('profile')" icon="user" wire:navigate>
                        {{ ___('dictionary.profile') }}
                    </flux:menu.item>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                        {{ ___('phrases.log-out') }}
                    </flux:menu.item>
                </form>
            </flux:menu>
    </flux:dropdown>
    </flux:header>

    <flux:main>
        <div class="flex items-center mb-3">
            @if (str_starts_with($avatar, 'http'))
                <img src="{{ $avatar }}" class="rounded-md size-12 bg-zinc-50 dark:bg-zinc-900 border-r border-zinc-200 dark:border-zinc-700" />
            @else
                <flux:icon :name="$avatar" class="rounded-md size-12 bg-zinc-50 dark:bg-zinc-900 border-r border-zinc-200 dark:border-zinc-700 p-2" />
            @endif

            <div class="ml-3">
                <flux:heading size="xl" level="1">{{ ___($title) }}</flux:heading>

                <flux:breadcrumbs>
                    <flux:breadcrumbs.item href="{{ $breadcrumbs ? route('dashboard') : null }}">
                        {{ ___('dictionary.dashboard') }}
                    </flux:breadcrumbs.item>

                    @if ($breadcrumbs)
                        @foreach ($breadcrumbs as $route => $breadcrumb)
                            <flux:breadcrumbs.item :href="Routes::make($route)">
                                {{ ___($breadcrumb) }}
                            </flux:breadcrumbs.item>
                        @endforeach
                    @endif
                </flux:breadcrumbs>
            </div>

            @if ($layout['menu'] ?? false)
                <livewire:page-menu :menu="$layout['menu']" />
            @endif
        </div>

        <flux:separator class="mb-7" />

        {{ $slot }}
    </flux:main>

    <x-modal-confirm />
</x-layouts.base>
