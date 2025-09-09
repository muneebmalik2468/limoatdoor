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
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            keyframes: {
                'shadow-pulse': {
                    '0%, 100%': { boxShadow: '0 0 0px rgba(0, 98, 255, 0.7)' },
                    '50%': { boxShadow: '0 0 20px rgba(0, 98, 255, 0.7)' },
                },
            },
            animation: {
                'shadow-pulse': 'shadow-pulse 2s ease-in-out infinite',
            },
        },
    },

    plugins: [forms],
};
