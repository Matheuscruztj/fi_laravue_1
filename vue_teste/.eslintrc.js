module.exports = {
  extends: [
    // add more generic rulesets here, such as:
    'eslint:recommended',
    'plugin:vue/vue3-recommended',
    'plugin:vue/recommended' // Use this if you are using Vue.js 2.x.
  ],
  rules: {
    // override/add rules settings here, such as:
    // 'vue/no-unused-vars': 'error'
    'vue/singleline-html-element-content-newline': 'off',
    'vue/multiline-html-element-content-newline': 'off',
    'vue/component-definition-name-casing': 'off',
    "vue/no-unused-vars": "off",
    "vue/html-indent": "off",
    "vue/max-attributes-per-line": "off",
    "vue/html-self-closing": "off",
    "vue/attributes-order": "off",
    "vue/v-slot-style": "off",
    "vue/require-explicit-emits": "off"
  }
}