/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./src/**/*.{html,js}",
    "./node_modules/flowbite/**/*.js"
  ],
  theme: {
    extend: {
      colors:{
        customBlue:'#3CA3DD'
      },
      height:{
        'h801':'801px'
      }
    },
  },
  plugins: [
    require('flowbite/plugin')
  ],
}
