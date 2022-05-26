const defaultTheme = require("tailwindcss/defaultTheme");
const colors = require("tailwindcss/colors");
module.exports = {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./public/js/offcanvas.js",
        "./public/material/js/material-dashboard.js",
        "./vendor/usernotnull/tall-toasts/config/**/*.php",
        "./vendor/usernotnull/tall-toasts/resources/views/**/*.blade.php",
        "./node_modules/@themesberg/flowbite/**/*.js",
        "./node_modules/tw-elements/dist/js/**/*.js",
    ],

    theme: {
        fontFamily: {
            sans: ["Graphik", "sans-serif"],
            serif: ["Merriweather", "serif"],
        },
        extend: {
            screens: {
                "3xl": "1366px",
                "4xl": "1920px",
            },
            spacing: {
                128: "32rem",
                144: "36rem",
            },
            borderRadius: {
                "4xl": "2rem",
            },
            colors: {
                cyan: colors.cyan,
                lime: colors.lime,
                fuchsia: colors.fuchsia,
                gray: colors.gray,
                emerald: colors.emerald,
                teal: colors.teal,
                sky: colors.sky,
                violet: colors.violet,
            },
        },
    },

    plugins: [
        //
        require("@themesberg/flowbite/plugin"),
        require("tw-elements/dist/plugin"),
    ],
};
