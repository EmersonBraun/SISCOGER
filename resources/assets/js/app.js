import store from './store/store'
require('./bootstrap');

window.Vue = require('vue');

// import Vuetify from 'vuetify'
// import 'vuetify/dist/vuetify.min.css'

// Vue.use(Vuetify)

require ('./components')
require ('./filters')

import VueTheMask from 'vue-the-mask'
Vue.use(VueTheMask)

let currentDate = new Date().toISOString().split('T')[0]
if(localStorage.getItem(currentDate+"session")==null){
    let urlIndex = 'http://10.47.1.90/siscoger/session/dados';
        axios
        .get(urlIndex)
        .then((response) => {
            sessionStorage.setItem(currentDate+"session", JSON.stringify(response.data))
            // this.$store.dispatch('changeSession',response.data)
        })
        .catch(error => console.log(error));
} 

const app = new Vue({
    el: '#app',
    methods: {
        getSessionData() {
            let currentDate = new Date().toISOString().split('T')[0]
            return JSON.parse(sessionStorage.getItem(currentDate+"session"))
        },
    },
});
