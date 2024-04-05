import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    server: {
        host: '0.0.0.0',
        hmr: {
            host: 'localhost'
        },
    },
    plugins: [
        laravel({
            input: [
                'resources/js/app.js',
                'resources/js/forms/registration.js',
                'resources/js/forms/auth.js',
            ],
            refresh: true,
        }),
    ],
});
