// https://nuxt.com/docs/api/configuration/nuxt-config

export default defineNuxtConfig({
  devtools: { enabled: true },

  runtimeConfig: {
    public: {
      apiBaseURL: "http://localhost/",
      imageBaseURL: "http://localhost/storage/"
    }
  },
  modules: [
    // ...
    '@pinia/nuxt',
    '@pinia-plugin-persistedstate/nuxt',
    '@vueuse/nuxt',
    '@nuxtjs/tailwindcss',
    'dayjs-nuxt',
    'nuxt-pdfeasy',
  ],

  tailwindcss: {
    // Options
  },

  dayjs: {
    locales: ['th'],
    plugins: ['relativeTime', 'utc', 'timezone'],
    defaultLocale: 'th',
    defaultTimezone: 'Asia/Bangkok',
  },

  build: {
    transpile: ['@vuepic/vue-datepicker']
  }

})

