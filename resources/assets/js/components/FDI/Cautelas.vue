<template>
    <v-tab header="Cautelas" :badge="patrimonios.length">
        <table class="table table-striped">
            <tbody>
                <template v-if="patrimonios.length">
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
                </template>
                <template v-else>
                    <tr>
                        <td>Nada encontrado</td>
                    </tr>
                </template>
            </tbody>
        </table>
    </v-tab>
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
        methods: {
             listPatrimonio(){
                let urlIndex = `${this.$root.baseUrl}api/fdi/cautelas/${this.rg}`;
                if(this.rg){
                    axios
                    .get(urlIndex)
                    .then((response) => {
                        this.patrimonios = response.data
                    })
                    .catch(error => console.log(error));
                }
            },
        }
    }
</script>

<style scoped>

</style>