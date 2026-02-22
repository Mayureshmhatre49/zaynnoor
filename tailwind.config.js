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
        "primary": "#D4AF37", // Gold – was green #11d473
        "primary-dark": "#1a1a1a", // Dark neutral – was green-tinted #042f1f
        "primary-light": "#2a2a2a", // Light neutral – was green-tinted #0a402d
        "background-light": "#f5f5f5",
        "background-dark": "#0a0a0a", // True black – was green-tinted #0c1a14
        "background-darker": "#050505", // Deeper black – was #01120b
        "emerald-dark": "#080808", // Near-black – was #05110c
        "gold": "#D4AF37",
        "gold-hover": "#C5A028",
        "gold-light": "#F3E5AB",
        "gold-dim": "#8a7020",
        "accent-gold": "#C6A87C",
        "accent-gold-bright": "#E5C895"
      },
      fontFamily: {
        "display": ["Manrope", "sans-serif"],
        "serif": ["Playfair Display", "serif"],
        "cinzel": ["Cinzel", "serif"]
      },
      backgroundImage: {
        'hero-gradient': 'linear-gradient(to bottom, rgba(10, 10, 10, 0.3), rgba(10, 10, 10, 0.9)), radial-gradient(circle at 50% 40%, rgba(212, 175, 55, 0.1) 0%, rgba(10, 10, 10, 0) 60%)',
        'hero-gradient-home': 'linear-gradient(to bottom, rgba(5, 5, 5, 0.4), rgba(5, 5, 5, 0.8)), radial-gradient(circle at 60% 30%, rgba(198, 168, 124, 0.15) 0%, rgba(5, 5, 5, 0) 50%)',
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
