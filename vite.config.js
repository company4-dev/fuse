import { defineConfig } from 'vite';
import laravel, { refreshPaths } from 'laravel-vite-plugin';
import tailwindcss from "@tailwindcss/vite";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/auth.css',
                'resources/css/guest.css',
                'resources/js/app.js',
                'resources/js/auth.js',
                'resources/js/guest.js',
            ],
            refresh: [
                // FuseBox
                ...refreshPaths,
                // Fuses
                'Fuses/*/app/Hooks/**',
                'Fuses/*/app/Livewire/**',
                'Fuses/*/app/Models/**',
                'Fuses/*/app/View/**',
                'Fuses/*/lang/**',
                'Fuses/*/resources/views/**',
            ],
        }),
        tailwindcss(),
    ],
    server: {
        cors: true,
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
});
