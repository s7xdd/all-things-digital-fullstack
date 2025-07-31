const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './resources/views/**/*.blade.php',
    './resources/js/**/*.js',
  ],
  theme: {
    extend: {
      colors: {
        primary: {
          DEFAULT: '#224FA2',
          dark: '#307FC2',
          light: '#3DA4DC',
        },
        'primary-224fa2': '#224FA2',
        'primary-307fc2': '#307FC2',
        'primary-3da4dc': '#3DA4DC',
      },
      fontFamily: {
        sans: ['Inter var', 'ui-sans-serif', 'system-ui', 'sans-serif'],
      },
    },
  },
  plugins: [],
}
