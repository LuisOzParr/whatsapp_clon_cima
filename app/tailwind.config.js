/** @type {import('tailwindcss').Config} */
module.exports = {
  prefix: 'tw-',
  content: [
    "./index.html",
    "./src/**/*.{vue,js,ts,jsx,tsx}",
  ],
  theme: {
    extend: {
      colors: {
        messages: {
          user: '#015c4c',
          contact: '#202d33',
          text: '#e9edef',

        },
        gray: {
          message: '#8696a1',
          title: '#e9edef',
        }
      }
    },
  },
  plugins: [],
}
