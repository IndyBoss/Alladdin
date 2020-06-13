module.exports = {
    parser: 'vue-eslint-parser',
    parserOptions: {
        ecmaVersion: 6,
        sourceType: 'module',
        parser: '@typescript-eslint/parser',
        project: './tsconfig.json'
    },
    extends: [
        'plugin:vue/recommended',
        'plugin:@typescript-eslint/recommended',
        'prettier',
        'prettier/@typescript-eslint'
    ],
    rules: {
        '@typescript-eslint/member-access': false,
        '@typescript-eslint/explicit-member-accessibility': 'off',
        '@typescript-eslint/no-use-before-define': false,
        '@typescript-eslint/no-explicit-any': false,
        'vue/max-attributes-per-line': false,
        "vue/html-indent": ["error", 4, {
            "baseIndent": 1,
            "closeBracket": 0,
            "alignAttributesVertically": false,
            "ignores": []
        }]
    },
};
