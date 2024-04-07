/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js"
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
                darkblue: '#1A2852',
                lightblue: '#4FB3EF',
                lightpink: '#F3DEDE',
                white: '#FFFFFF',
                success: '#20bb33',
                error: '#EF4444',
            },
        },
    },
    plugins: [],
}
