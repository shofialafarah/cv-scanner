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
                sans: ['Bricolage Grotesque', 'sans-serif'],
            },
            colors: {
                // Warna gelap custom agar tidak hitam pekat (biar lebih nyaman di mata)
                'dark-bg': '#0B0F1A',
                'dark-card': '#161B2D',
            }
        },
    },

    plugins: [forms],
};
