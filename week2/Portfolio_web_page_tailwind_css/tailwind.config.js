/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./dist/index.html"],
  theme: {
    extend: {
      colors: {
        'custom-blue': 'rgb(152, 158, 206)',  // First custom blue
        'custom-purple': 'rgb(110, 87, 224)', // Purple color
        'deep-blue': 'rgb(40, 91, 212)',      // Renamed the second custom-blue to deep-blue
      },
    },
  },
  plugins: [],
}
