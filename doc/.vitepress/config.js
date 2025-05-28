import { defineConfig } from 'vitepress'

// https://vitepress.dev/reference/site-config
export default defineConfig({
  title: "The Clean Structure",
  description: "2222",
  lang: 'ru-RU',
  cleanUrls: true,
  ignoreDeadLinks: true,
  themeConfig: {
    // https://vitepress.dev/reference/default-theme-config
    outline: { label: 'Содержание страницы' },

    sidebar: [
      { text: 'Чистая Структура', link: '/clean-structure/' }
    ],

    socialLinks: [
      { icon: 'github', link: 'https://github.com/vendelev/Clean-Architecture-Laravel-Demo-Structure' }
    ],

    docFooter: {
      prev: 'Предыдущая страница',
      next: 'Следующая страница'
    },

    notFound: {
      title: 'СТРАНИЦА НЕ НАЙДЕНА',
      quote:
          'Но если ты не изменишь направление и продолжишь искать, ты можешь оказаться там, куда направляешься.',
      linkLabel: 'перейти на главную',
      linkText: 'Отведи меня домой'
    },

    darkModeSwitchLabel: 'Оформление',
    lightModeSwitchTitle: 'Переключить на светлую тему',
    darkModeSwitchTitle: 'Переключить на тёмную тему',
    sidebarMenuLabel: 'Меню',
    returnToTopLabel: 'Вернуться к началу',
    langMenuLabel: 'Изменить язык',
    skipToContentLabel: 'Перейти к содержимому'
  }
})
