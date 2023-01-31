import colors from 'vuetify/es5/util/colors'

export default {
    ssr: false,
    head: {
        titleTemplate: '%s',
        title: 'B3 SAMPLE DATA',
        htmlAttrs: {
            lang: 'en'
        },
        meta: [
            { charset: 'utf-8' },
            { name: 'viewport', content: 'width=device-width, initial-scale=1' },
            { hid: 'description', name: 'description', content: '' },
            { name: 'format-detection', content: 'telephone=no' }
        ],
        link: [
            { rel: 'icon', type: 'image/x-icon', href: '/favicon.ico' }
        ]
    },

    css: [
        '~/assets/style.css'
    ],

    plugins: [
        '~/plugins/chart'
    ],

    components: [{
        path: '~/components',
        pathPrefix: false
    }],

    buildModules: [
        '@nuxt/typescript-build',
        '@nuxtjs/vuetify'
    ],

    modules: [
        '@nuxtjs/axios'
    ],

    axios: {
        baseURL: '/'
    },

    vuetify: {
        theme: {
            dark: true,
            themes: {
                dark: {
                    primary: colors.blue.darken2,
                    accent: colors.grey.darken3,
                    secondary: colors.amber.darken3,
                    info: colors.teal.lighten1,
                    warning: colors.amber.base,
                    error: colors.deepOrange.accent4,
                    success: colors.green.accent3,
                    "system-blue-darken": "#1F2937"
                }
            }
        }
    },

    build: {
    }
}
