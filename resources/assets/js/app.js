import store from './store/store'
require('./bootstrap');

window.Vue = require('vue');

// import Vuetify from 'vuetify'
// import 'vuetify/dist/vuetify.min.css'

// Vue.use(Vuetify)

require ('./components')
require ('./filters')

const app = new Vue({
    store,
    el: '#app',
    mounted() {
        this.putSessionData()
    },
    methods: {
        putSessionData() {
            //let hasSession =  (sessionStorage.getItem("session") !== null) ? true : false
            let hasSession = this.$store.state.session.length
            if(!hasSession){
                let urlIndex = 'http://10.47.1.90/siscoger/session/dados';
                //console.log(urlIndex)
                    axios
                    .get(urlIndex)
                    .then((response) => {
                        this.$store.dispatch('changeSession',response.data)
                        //sessionStorage.setItem("session", JSON.stringify(response.data))
                        //this.session = response.data
                        // console.log(response.data)
                    })
                    .catch(error => console.log(error));
           } 
        },
    },
});
