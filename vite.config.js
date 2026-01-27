// import { defineConfig } from 'vite';
// import laravel, { refreshPaths } from 'laravel-vite-plugin';
// import tailwindcss from "@tailwindcss/vite";

// export default defineConfig({
//     plugins: [
//         laravel({
//             input: [
//                 'resources/css/app.css',
//                 'resources/css/auth.css',
//                 'resources/css/guest.css',
//                 'resources/js/app.js',
//                 'resources/js/auth.js',
//                 'resources/js/guest.js',
//             ],
//             refresh: [
//                 // JellyBean
//                 ...refreshPaths,
//                 // Platforms
//                 'Platforms/*/app/Hooks/**',
//                 'Platforms/*/app/Livewire/**',
//                 'Platforms/*/app/Models/**',
//                 'Platforms/*/app/View/**',
//                 'Platforms/*/lang/**',
//                 'Platforms/*/resources/views/**',
//             ],
//         }),
//         tailwindcss(),
//     ],
//     server: {
//         cors: true
//     },
// });
