/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./templates/**/*.html.twig", // IMPORTANT pour analyser les fichiers Twig
    "./assets/**/*.js",
  ],
  theme: {
    extend: {},
  },
  plugins: [],
};
