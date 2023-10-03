const defaultTheme = require('tailwindcss/defaultTheme');
const plugin = require('tailwindcss/plugin');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/js/app.js',
        './resources/views/**/*.blade.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Livvic', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'main-color': '#C82090',
                'secondary-color': '#FAE8FF',
                'custom-purple-color': '#9A2CB0',
                'custom2-purple-color': '#6A14D1'
            },
        }
    },

    plugins: [
        require('@tailwindcss/forms'),
    ],
};
