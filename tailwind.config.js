/** @type {import('tailwindcss').Config} */

const colors = require('tailwindcss/colors')
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
    ],
    safelist: [
        {
            pattern: /(bg|text)-(gray|orange|red|green|blue|purple|pink|emerald|rose)-(100|900)/
        },
    ],
    plugins: [],
}
