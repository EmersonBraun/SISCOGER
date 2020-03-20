// core da aplicação
require('./bootstrap');
window.Vue = require('vue');
// componentes
require ('./components')
import Toasted from 'vue-toasted';
Vue.use(Toasted);

import Vuelidate from 'vuelidate'
Vue.use(Vuelidate)
// import vuetify from './plugins/vuetify' // path to vuetify export
// import Vuetify from 'vuetify/lib'
import Vuetify from 'vuetify'
import 'vuetify/src/stylus/app.styl'
import 'vuetify/dist/vuetify.min.css';
Vue.use(Vuetify,{})

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
    // vuetify,
    el: '#app',
    mixins: [functions],
});
