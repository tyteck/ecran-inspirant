/** @type {import('tailwindcss').Config} */

const colors = require('tailwindcss/colors')
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
    ],
    safelist: [
        {
            pattern: /(bg|text)-(red|green|blue|pink|emerald)-(100|900)/
        },
    ],
    plugins: [],
}
