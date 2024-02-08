/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
        container: {
            center: true,
            padding: '1rem',
        },
        colors: {
            primary: '#197593',
        }
    },
  },
  plugins: [],
}

