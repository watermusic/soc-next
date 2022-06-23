/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./templates/**/*.{html,twig,js}","./templates/.{html,twig,js}"],
  theme: {
    extend: {},
  },
  plugins: [
    require('@tailwindcss/typography'),
    require('@tailwindcss/aspect-ratio'),
    require('@tailwindcss/forms')
  ],
}
