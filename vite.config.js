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
                'resources/js/main.js',
                'resources/js/auth.js',
                'resources/js/admin.js',
            ],
            refresh: true,
        }),
    ],
});
