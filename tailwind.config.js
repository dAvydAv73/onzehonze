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
          rouge:         '#D66049', // corail (inchangé)
          'rouge-fonce': '#A94332', // corail foncé — footer, survols
          jaune:         '#F7B449', // orange (inchangé)
          beige:         '#FAEAD6', // beige (inchangé)
          paper:         '#FFFDF9', // blanc cassé chaud — fonds de section
          nuit:          '#18242E', // bleu nuit (était #2E3F4C → aligné charte Camille)
          vert:          '#58624B', // vert (était #5C7B78 → aligné)
          text:          '#3F4A52', // gris-bleu pour le texte courant
        },
      },
      fontFamily: {
        sans: ['"DM Sans"', 'system-ui', 'sans-serif'],      // corps
        display: ['Nunito', 'system-ui', 'sans-serif'],       // titres
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
    { pattern: /^bg-brand-(rouge|rouge-fonce|jaune|beige|paper|nuit|vert|text)$/ },
    { pattern: /^text-brand-(rouge|rouge-fonce|jaune|beige|paper|nuit|vert|text)$/ },
    { pattern: /^grid-cols-(1|2|3|4|5)$/, variants: ['sm', 'md', 'lg'] },
  ],
};