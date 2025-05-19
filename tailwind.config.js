module.exports = {
  content: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
  ],
  theme: {
    extend: {
      colors: {
        'portfolio-primary': 'var(--portfolio-primary)',
      }
    },
  },
  plugins: [],
}