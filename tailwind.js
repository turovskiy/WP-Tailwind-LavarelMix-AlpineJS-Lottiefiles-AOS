/**
 * Руководство по настройке и настройке вашей установки Tailwind.
 * https://v1.tailwindcss.com/docs/configuration
 *
 * расширение темы по умолчанию
 * https://github.com/tailwindlabs/tailwindcss/blob/v1/stubs/defaultConfig.stub.js
 */

module.exports = {
  mode: 'jit',
  // Удаление неиспользуемого CSS
  // https://v1.tailwindcss.com/docs/controlling-file-size#removing-unused-css
 
  purge: {
    //   https://tailwindcss.com/docs/optimizing-for-production#purging-specific-layers
    content: ['./*.php', './templates/**/*.php', './build/js/**/*.js'],
    // Если вам нужно передать какие-либо параметры непосредственно в PurgeCSS,
    // вы можете сделать это с помощью options:
    // https://purgecss.com/configuration.html#options
    options: {
      safelist: [],
      blocklist: [],
      keyframes: true,
      fontFace: true,
    },
  },
  // Все эти ключи которые доступны
  // https://v1.tailwindcss.com/docs/theme#configuration-reference
  theme: {
    container: {},

    //Если вы хотите сохранить значения по умолчанию для параметра темы,
    //но также добавить новые значения,
    //добавьте свои расширения под ключ theme.extend.
    //https://v1.tailwindcss.com/docs/theme#extending-the-default-theme

    extend: {},
  },
  // Настройка вариантов
  // Настройка того, какие варианты утилит включены в Вашем проекте.
  // https://v1.tailwindcss.com/docs/configuring-variants#app
  variants: {
    // Наведение, фокус и другие состояния
    // https://tailwindcss.ru/docs/hover-focus-and-other-states#obzor
  },
  plugins: [
    //   Добавление утилит
    //   https://tailwindcss.com/docs/plugins#adding-utilities
    // ({ addUtilities }) => {
    //   const utils = {
    //     '.translate-x-half': {
    //       transform: 'translateX(50%)',
    //     },
    //   };
    //   addUtilities(utils, ['responsive']);
    // },
  ],
};
