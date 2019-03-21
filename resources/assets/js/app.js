
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.component('v-accordion', require('vue-strap').accordion);
Vue.component('v-affix', require('vue-strap').affix);
Vue.component('v-alert', require('vue-strap').alert);
Vue.component('v-aside', require('vue-strap').aside);
Vue.component('v-button-group', require('vue-strap').buttonGroup);
Vue.component('v-carousel', require('vue-strap').carousel);
Vue.component('v-checkbox', require('vue-strap').checkbox);
Vue.component('v-datepicker', require('vue-strap').datepicker);
Vue.component('v-dropdown', require('vue-strap').dropdown);
Vue.component('v-form-group', require('vue-strap').formGroup);
Vue.component('v-form-validator', require('vue-strap').formValidator);
Vue.component('v-input', require('vue-strap').input);
Vue.component('v-modal', require('vue-strap').modal);
Vue.component('v-navbar', require('vue-strap').navbar);
Vue.component('v-option', require('vue-strap').option);
Vue.component('v-panel', require('vue-strap').panel);
Vue.component('v-popover', require('vue-strap').popover);
Vue.component('v-progressbar', require('vue-strap').progressbar);
Vue.component('v-radio', require('vue-strap').radio);

Vue.component('v-select', require('./components/Vuestrap/Select.vue'));

Vue.component('v-slider', require('vue-strap').slider);
Vue.component('v-spinner', require('vue-strap').spinner);
Vue.component('v-tab', require('vue-strap').tab);
Vue.component('v-tab-group', require('vue-strap').tabGroup);
Vue.component('v-tabs', require('vue-strap').tabs);
Vue.component('v-toggle-button', require('vue-strap').toggleButton);
Vue.component('v-tooltip', require('vue-strap').tooltip);
Vue.component('v-typeahead', require('vue-strap').typeahead);


const app = new Vue({
    el: '#app'
});
