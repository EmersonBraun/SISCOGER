// core da aplicação
require('./bootstrap');
window.Vue = require('vue');
// componentes
require ('./components')
// the mask
import VueTheMask from 'vue-the-mask'
Vue.use(VueTheMask)
// money
import money from 'v-money'
Vue.use(money, {
    decimal: ',',
    thousands: '.',
    prefix: 'R$ ',
    precision: 2,
    masked: false
});

// html to pdf
import VueHtmlToPaper from 'vue-html-to-paper';
const options = {
  name: '_blank',
  specs: [
    'fullscreen=yes',
    'titlebar=no',
    'scrollbars=no'
  ],
}

Vue.use(VueHtmlToPaper, options);

// stores do vuex
import store from './store/store'
// filtros para exibição de dados
require ('./filters')
// funções
import functions from './functions'

new Vue({
    store, 
    el: '#app',
    mixins: [functions],
});
