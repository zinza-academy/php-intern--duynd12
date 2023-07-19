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
      colors: {
        customBlue: '#3CA3DD',
        customBgFrom: '#D51E36',
        customBgTo: '#273494'
      },
      height: {
        'h801': '801px'
      },
      width: {
        '635': '635px',
        '681': '681px',
        '112': '112px'
      }
    },
  },
  plugins: [
    require('flowbite/plugin')
  ],
}
