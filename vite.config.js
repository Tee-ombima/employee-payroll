import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',  // Your main CSS file with Tailwind directives
                'resources/js/app.js',    // Your main JavaScript file
            ],
            refresh: [
                'resources/views/**/*.blade.php',  // Auto-refresh when Blade files change
                'routes/**/*.php'                  // Auto-refresh when routes change
            ],
        }),
    ],
    // Optional optimization for production builds
    build: {
        rollupOptions: {
            output: {
                manualChunks: undefined, // Disable automatic chunk splitting
            },
        },
    },
});