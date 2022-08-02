const defaultTheme = require('tailwindcss/defaultTheme')

/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./templates/**/*.{html,twig,js}",
    "./templates/.{html,twig,js}",
    "./assets/js/**/*.vue",
    "./assets/js/.vue"
  ],
  theme: {
    extend: {
      fontFamily: {
        sans: ['Roboto Condensed', ...defaultTheme.fontFamily.sans],
      },
    },
  },
  plugins: [
    require('@tailwindcss/typography'),
    require('@tailwindcss/aspect-ratio'),
    require('@tailwindcss/forms')
  ],
}
