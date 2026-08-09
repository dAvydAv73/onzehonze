/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './views/**/*.twig',
    './*.php',
    './inc/**/*.php',
    './assets/js/**/*.js',
  ],

  theme: {
    container: {
      center: true,
      padding: '1rem',
      screens: { lg: '1024px', xl: '1200px', '2xl': '1320px' },
    },
    extend: {
      colors: {
        brand: {
          rouge: '#D66049',
          jaune: '#F7B449',
          beige: '#FAEAD6',
          nuit:  '#2E3F4C',
          vert:  '#5C7B78',
        },
      },
      fontFamily: {
        sans: ['"Plus Jakarta Sans"', 'system-ui', 'sans-serif'],
      },
    },
  },

  plugins: [
    require('@tailwindcss/typography'), // pour les .prose des WYSIWYG ACF
  ],

  /**
   * Safelist : classes injectées dynamiquement via ACF (block_classes, choix de fond…)
   * que le scanner ne voit pas dans les Twig.
   */
  safelist: [
    'alignwide', 'alignfull',
    { pattern: /^bg-brand-(rouge|jaune|beige|nuit|vert)$/ },
    { pattern: /^text-brand-(rouge|jaune|beige|nuit|vert)$/ },
    { pattern: /^grid-cols-(1|2|3|4|5)$/, variants: ['sm', 'md', 'lg'] },
  ],
};