module.exports = {
    root: true,
    env: {
        browser: true,
        node: true
    },

    extends: [
        '@nuxtjs/eslint-config-typescript',
        'plugin:nuxt/recommended',
        'plugin:vue/recommended'
    ],
    plugins: [],

    rules: {
        /*
        |--------------------------
        | Disabled rules
        |--------------------------
        */
        'vue/attributes-order': 'off',
        'vue/multi-word-component-names': 'off',
        'space-before-function-paren': 'off',
        'vue/html-quotes': 'off',
        'brace-style': 'off',
        'semi': 'off',
        'quotes': 'off',
        'vue/singleline-html-element-content-newline': 'off',
        'curly': 'off',
        'no-unused-vars': 'off',
        'eqeqeq': 'off',
        'quote-props': 'off',
        'import/order': 'off',
        'import/no-duplicates': 'off',
        'no-mixed-operators': 'off',
        'operator-linebreak': 'off',

        /*
        |--------------------------
        | Clean Code / Code style
        |--------------------------
        */
        '@typescript-eslint/explicit-function-return-type': 'error',
        'vue/html-closing-bracket-spacing': ['error', {
            'selfClosingTag': 'never'
        }],
        'indent': ['error', 4, {
            'ignoredNodes': ['MemberExpression'],
            'SwitchCase': 1
        }],
        'vue/html-indent': ['error', 4],
        'arrow-parens': ['error', 'as-needed'],
        'multiline-ternary': ['error', 'always-multiline'],
        'camelcase': 'error',
        'space-before-blocks': 'error',
        'no-trailing-spaces': ['error', {
            'skipBlankLines': true
        }],
        'vue/max-attributes-per-line': ['warn', {
            'singleline': {
                'max': 4
            },
            'multiline': {
                'max': 1
            }
        }],

        /*
        |--------------------------
        | Error prevention
        |--------------------------
        */
        'vue/block-lang': ['error', {
            script: {
                lang: 'ts'
            }
        }],
        '@typescript-eslint/no-unused-vars': ['error', {
            'varsIgnorePattern': '^_',
            'argsIgnorePattern': '^_'
        }],
        'vue/this-in-template': 'error',
        'no-console': 'warn'
    }
}
