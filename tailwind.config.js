import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    plugins: [forms],
    darkMode: 'selector',
    theme: {
        extend: {
            colors: {
                ink: '#0F1B14',
                moss: '#1A2B21',
                sprout: '#7ED957',
                'sprout-soft': '#C9E9B8',
                paper: '#F7FAF5',
                'warning-gold': '#E8B94B',
            },
            fontFamily: {
                display: ['Manrope', 'sans-serif'],
                sans: ['DM Sans', 'sans-serif'],
            },
            screens: { xs: '375px' },
        },
    },
};
