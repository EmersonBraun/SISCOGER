
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
// import Vuetify from 'vuetify'
// import 'vuetify/dist/vuetify.min.css'

// Vue.use(Vuetify)

require ('./components')
require ('./filters')

const app = new Vue({
    el: '#app',
    data: {
        session: ''
    },
    mounted() {
        this.putSessionData()
    },
    methods: {
        putSessionData() {
            let hasSession =  (sessionStorage.getItem("session") !== null) ? true : false
            if(!hasSession){
                let urlIndex = 'http://10.47.1.90/siscoger/session/dados';
                console.log(urlIndex)
                    axios
                    .get(urlIndex)
                    .then((response) => {
                        sessionStorage.setItem("session", JSON.stringify(response.data))
                        this.session = response.data
                        // console.log(response.data)
                    })
                    .catch(error => console.log(error));
           } 
        },
        getSessionData() {
            return JSON.parse(sessionStorage.getItem("session"))
        },
    },
});
