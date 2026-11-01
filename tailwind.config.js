import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    // 'class' = dark mode alleen als we dat zelf aanzetten. Zo blijft het thema overal licht en consistent.
    darkMode: 'class',

    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            colors: {
                // Cafe Society palet
                sage: {
                    50: '#f4f7f2',
                    100: '#e6ede1',
                    200: '#cfdcc6',
                    300: '#b0c5a3',
                    400: '#8fab80',
                    500: '#739265',
                    600: '#5a764e',
                    700: '#485e40',
                    800: '#3b4c36',
                    900: '#2f3c2b',
                },
                cream: {
                    50: '#fdfbf7',
                    100: '#faf6ee',
                    200: '#f3ecdd',
                    300: '#e8dcc4',
                },
                latte: {
                    300: '#dcb48e',
                    400: '#c99a6e',
                    500: '#b07d52',
                    600: '#8f6240',
                },
                espresso: {
                    700: '#4a3f35',
                    800: '#352d26',
                    900: '#261f1a',
                },
            },
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
                serif: ['Fraunces', ...defaultTheme.fontFamily.serif],
            },
            boxShadow: {
                cozy: '0 1px 2px rgba(53,45,38,.04), 0 8px 24px -8px rgba(53,45,38,.12)',
            },
        },
    },

    plugins: [forms],
};
