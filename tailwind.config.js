/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/views/**/*.blade.php",
    "./resources/**/*.js",
  ],
  theme: {
    extend: {
      flex: {
       '100': '0 0 100px',
      },
      boxShadow: {
        custom: '1px 4px 10px 10px rgba(0, 0, 0, 0.05)',
      },
      colors: {
        'custom-green-500': '#4B903A',
        'custom-green-600': '#32841e',
        'custom-green-700': '#3D6B31',
      },
      fontFamily: {
        sans: ['Ubuntu', 'sans-serif'],
      },
    },
  },
  plugins: [
    function ({ addComponents }) {
      addComponents({
        '.btn-custom': {
          '@apply px-4 py-2 bg-custom-green-700 text-white font-bold rounded-md shadow-sm hover:bg-[#1d4b13] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#3F6137]': {},
        },
      });
    },
  ],
}

