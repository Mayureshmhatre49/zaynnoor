/** @type {import('tailwindcss').Config} */
module.exports = {
  darkMode: "class",
  content: [
    "./*.php",
    "./inc/**/*.php",
    "./template-parts/**/*.php",
    "./woocommerce/**/*.php",
    "../UI/**/*.html" // Include original UI files to ensure all classes are generated during dev
  ],
  theme: {
    extend: {
      colors: {
        "primary": "#11d473", // from Cart/Single
        "primary-dark": "#042f1f", // from Home (was primary)
        "primary-light": "#0a402d",
        "background-light": "#f6f8f7",
        "background-dark": "#0c1a14", // unified dark bg
        "background-darker": "#01120b",
        "emerald-dark": "#05110c",
        "gold": "#D4AF37",
        "gold-hover": "#C5A028",
        "gold-light": "#F3E5AB",
        "gold-dim": "#8a7020",
        "accent-gold": "#C6A87C", // Home used this
        "accent-gold-bright": "#E5C895"
      },
      fontFamily: {
        "display": ["Manrope", "sans-serif"],
        "serif": ["Playfair Display", "serif"],
        "cinzel": ["Cinzel", "serif"]
      },
      backgroundImage: {
        'hero-gradient': 'linear-gradient(to bottom, rgba(16, 34, 25, 0.3), rgba(16, 34, 25, 0.9)), radial-gradient(circle at 50% 40%, rgba(17, 212, 115, 0.15) 0%, rgba(16, 34, 25, 0) 60%)',
        'hero-gradient-home': 'linear-gradient(to bottom, rgba(2, 26, 17, 0.4), rgba(2, 26, 17, 0.8)), radial-gradient(circle at 60% 30%, rgba(198, 168, 124, 0.15) 0%, rgba(2, 26, 17, 0) 50%)',
        'texture': 'url("https://www.transparenttextures.com/patterns/stardust.png")', 
        'metallic-gold': 'linear-gradient(135deg, #bf953f 0%, #fcf6ba 40%, #b38728 60%, #fbf5b7 100%)',
      }
    },
  },
  plugins: [
    require('@tailwindcss/forms'),
    require('@tailwindcss/container-queries')
  ],
}
