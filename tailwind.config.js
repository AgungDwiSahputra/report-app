/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/views/**/*.blade.php",
    "./resources/**/*.js",
  ],
  theme: {
    extend: {
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
  plugins: [],
}

