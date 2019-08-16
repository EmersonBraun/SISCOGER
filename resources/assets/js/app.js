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

if(localStorage.getItem("session")==null){
    let urlIndex = 'http://10.47.1.90/siscoger/session/dados';
        axios
        .get(urlIndex)
        .then((response) => {
            sessionStorage.setItem("session", JSON.stringify(response.data))
        })
        .catch(error => console.log(error));
}

new Vue({
    store,
    el: '#app',
    methods: {
        getSessionData() {
            return JSON.parse(sessionStorage.getItem("session"))
        },
    },
});
