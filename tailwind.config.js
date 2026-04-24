import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Outfit', 'Inter', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: {
                    50: '#f0f4ff',
                    100: '#d9e2ff',
                    200: '#bacaff',
                    300: '#8ca6ff',
                    400: '#5975ff',
                    500: '#364fff',
                    600: '#1f2bff',
                    700: '#1219ff',
                    800: '#0f14d4',
                    900: '#1319a9',
                    950: '#0a0d63',
                },
            },
            boxShadow: {
                'premium': '0 10px 30px -5px rgba(0, 0, 0, 0.05), 0 5px 15px -5px rgba(0, 0, 0, 0.05)',
                'glass': '0 8px 32px 0 rgba(31, 38, 135, 0.07)',
            }
        },
    },

    plugins: [forms],
};
