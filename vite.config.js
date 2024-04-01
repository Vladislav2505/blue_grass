import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
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
