<template>
    <div class="row">
        <div class="col-md-6 col-xs-12">
            <vue-simple-suggest
                v-model="rg"
                :list="suggestionRG"
                :filter-by-query="true"
                placeholder="RG">
            </vue-simple-suggest>
        </div> 
        <div class="col-md-6 col-xs-12">
            <vue-simple-suggest
                v-model="name"
                :list="suggestionName"
                :filter-by-query="true"
                placeholder="Nome">
            </vue-simple-suggest>
        </div> 
        <div class="col-md-12 col-xs-12">
            <v-checkbox v-model="ativos" :true-value="true" :false-value="false"
                        text="Ativos">
            </v-checkbox>
            <v-checkbox v-model="inativos" :true-value="true" :false-value="false"
                        text="Inativos">
            </v-checkbox>
            <v-checkbox v-model="reserva" :true-value="true" :false-value="false"
                        text="Reserva">
            </v-checkbox>
        </div>
    </div>
</template>

<script>
    import VueSimpleSuggest from 'vue-simple-suggest'
    import 'vue-simple-suggest/dist/styles.css' // Optional CSS
    import {Checkbox} from '../Vuestrap/Checkbox'
    export default {
    components: {
      VueSimpleSuggest
    },
    data() {
      return {
        rg: '',
        name: '',
        ativos: true,
        inativos: false,
        reserva: false,
        suggestionRG: [],
        suggestionName: []
      }
    },
    watch: {
        rg() {
            if(this.rg.length > 3) {
                this.searchRG()
            }
        },
        name(){
            if(this.name.length > 3) {
                this.searchName()
            }
        }
    },
    computed:{
        getBaseUrl(){
            let getUrl = window.location;
            let pathname = getUrl.pathname.split('/')
            let baseUrl = `${getUrl.protocol}//${getUrl.host}/${pathname[1]}/`;
            
            return baseUrl;
        },
    },
    methods: {
        searchRG() {
            let urlSearch = `${this.getBaseUrl}api/dados/sugest/rg`
            let data = {
                rg: this.rg,
                ativos: this.ativos,
                inativos: this.inativos,
                reserva: this.reserva
            }
            
            axios.post( urlSearch,data)
            .then((response) => this.suggestionRG = response.data)
            .catch((error) => console.log(error));
        },
        searchName() {
            let urlSearch = `${this.getBaseUrl}api/dados/sugest/nome`
            let data = {
                name: this.name,
                ativos: this.ativos,
                inativos: this.inativos,
                reserva: this.reserva
            }
            
            axios.post( urlSearch,data)
            .then((response) => this.suggestionName = response.data)
            .catch((error) => console.log(error));
        }
    }
  }
</script>
<style scope>
.suggestions {
  opacity: 1;
}

.vue-simple-suggest-enter-active.suggestions,
.vue-simple-suggest-leave-active.suggestions {
  transition: opacity .2s;
}

.vue-simple-suggest-enter.suggestions,
.vue-simple-suggest-leave-to.suggestions {
  opacity: 0;
}
.default-input:focus {
    border-color: #007bff;
    box-shadow: 2px;
}
</style>