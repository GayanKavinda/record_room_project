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
            colors: {
                purple: {
                    600: '#7e3af2',
                    700: '#6c2bd9',
                    800: '#5521b5',
                },
                indigo: {
                    600: '#5D4FD8', // This is an approximation of the color in the image
                },
            },
        },
    },

    plugins: [forms],
};
