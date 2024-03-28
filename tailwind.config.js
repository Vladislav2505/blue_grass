/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js"
    ],
    theme: {
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
                lightblue: '#4FB3EF',
                lightpink: '#F3DEDE',
                white: '#FFFFFF',
            },
        },
    },
    plugins: [],
}

