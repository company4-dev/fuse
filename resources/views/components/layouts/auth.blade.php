@php
    $quote = \App\Hooks\AuthMessages::get();
@endphp
<x-layouts.base class="min-h-screen bg-white antialiased dark:bg-linear-to-b dark:from-neutral-950 dark:to-neutral-900" :title="$title ?? null">
    <div class="relative grid h-dvh flex-col items-center justify-center px-8 sm:px-0 lg:max-w-none lg:grid-cols-2 lg:px-0">
        <div class="bg-muted relative hidden h-full flex-col p-10 text-white lg:flex dark:border-e dark:border-neutral-800 z-10">
            <div class="absolute inset-0 bg-neutral-900"></div>

            <flux:brand
                class="z-10"
                href="/"
                logo="/icon.png"
                logo:dark="/icon.png"
                :name="config('app.name')"
                wire:navigate
            />

            <div class="flex items-center relative z-20 mt-auto">
                <img class="z-10 max-h-96 self-start" height="300" src="/sheldon/sitting.png">

                <div>
                    <blockquote class="space-y-2">
                        <flux:heading size="lg">{!! trim($quote) !!}</flux:heading>
                    </blockquote>
                </div>
            </div>
        </div>

        <div class="w-full lg:p-8">
            <div class="mx-auto flex w-full flex-col justify-center space-y-6 sm:w-[350px]">
                <div class="flex align-middle justify-center">
                    <div class="flex flex-col items-center justify-center">
                        <img class="z-10 max-h-32 max-w-max" src="/sheldon/pawthentication.png">
                        <flux:heading size="xl">
                            {{ ___('phrases.pawthenticate-yourself') }}
                        </flux:heading>
                    </div>
                </div>
                {{ $slot }}
            </div>
        </div>
    </div>
</x-layouts.base>
