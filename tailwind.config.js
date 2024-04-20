/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    ],
    theme: {
        screens: {
            'xs': '375px',
            'sm': '640px',
            'md': '768px',
            'lg': '1024px',
            'xl': '1280px',
            '2xl': '1536px',
        },
        extend: {
            fontFamily: {
                roboto: ['Roboto', 'sans-serif'],
            },
            container: {
                center: true,
            },
            colors: {
                main: '#111827',
                secondary: '#696262',
                lightgray: '#d1d5db',
                darkblue: '#1A2852',
                blue: '#1e40af',
                lightblue: '#02ccfe',
                lightpink: '#efebeb',
                white: '#FFFFFF',
                success: '#20bb33',
                error: '#EF4444',
            },
        },
    },
    plugins: [],
}
