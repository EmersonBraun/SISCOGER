<template>
    <div>
        <div class="card-head"> 
            <h5><b>Cautelas</b></h5>
        </div>
        <div class="card-body"> 
            <div class="row bordaform" v-if="patrimonios.length">
                <div class="col-sm-12">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th class="col-sm-2">#</th>
                                <th class="col-sm-2">N° Patrimônio</th>
                                <th class="col-sm-2">Tipo</th>
                                <th class="col-sm-2">Série</th>
                                <th class="col-sm-2">Marca</th>
                                <th class="col-sm-2">Modelo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template v-for="patrimonio in patrimonios">
                                <tr v-for="(p, index) in patrimonio" :key="index">
                                    <td>{{ index + 1 }}</td>
                                    <td>{{ p['patrimonio'] }}</td>
                                    <td>{{ p['tipo'] }}</td>
                                    <td>{{ p['serie'] }}</td>
                                    <td>{{ p['marca'] }}</td>
                                    <td>{{ p['modelo'] }}</td>
                                </tr>
                            </template>
                        </tbody>
                
                    </table>
                </div>
            </div>  
             <div v-else>
                <h5>
                    <b>Não há registtros</b>
                </h5>
            </div> 
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            rg: {type: String , default: ''},
        },
        data(){
            return{
                patrimonios: []
            }
        },
        mounted(){
            this.listPatrimonio()
        },
        computed:{
            getBaseUrl(){
                // URL completa
                let getUrl = window.location;
                // dividir em array
                let pathname = getUrl.pathname.split('/')
                let baseUrl = getUrl.protocol + "//" + getUrl.host + "/" + pathname[1]+"/";
                
            return baseUrl;
            },
        },
        methods: {
             listPatrimonio(){
                let urlIndex = this.getBaseUrl + 'api/dados/cautelas/' + this.rg
                axios
                    .get(urlIndex)
                    .then((response) => {
                        this.patrimonios = response.data
                    })
                    .catch(error => console.log(error));
            },
        }
    }
</script>

<style scoped>

</style>