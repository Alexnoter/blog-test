const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],
    safelist: [
        "bg-red-600",
        "bg-yellow-600",
        "bg-blue-600",
        "bg-green-600",
        "bg-indigo-600",
        "bg-purple-600",
        "bg-pink-600",
        
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
        },
    },


    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],

    corePlugins: {
        container: false,
    }
};
