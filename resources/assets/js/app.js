// core da aplicação
require('./bootstrap');
window.Vue = require('vue');
// componentes
require ('./components')
import VueTheMask from 'vue-the-mask'
Vue.use(VueTheMask)
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
    mounted() {
        this.alertMsg('asdasdasd', 'success')
        // this.$store.state.alert = {
        //     show: true, text: 'teste', type: 'success'
        // }
    },
});
