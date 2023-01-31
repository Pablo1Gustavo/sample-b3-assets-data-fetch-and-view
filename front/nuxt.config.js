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
        baseURL: 'http://127.0.0.1:8000/api/'
    },

    vuetify: {
        theme: {
            dark: true,
            themes: {
                dark: {
                    "sblue-darken": "#1F2937",
                    "sblue-darken-2": "#1D2632",
                    "sgrey": "#202230"
                }
            }
        }
    },

    build: {
    }
}
