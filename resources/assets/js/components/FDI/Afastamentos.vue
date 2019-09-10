<template>
    <v-tab header="Afastamentos" :badge="registros.length">
        <table class="table table-striped">
                <template v-if="registros.length">
                    <thead>
                        <tr>
                            <th class="col-xs-6">Descrição</th>
                            <th class="col-xs-2">Início</th>
                            <th class="col-xs-2">Fim</th>
                            <th class="col-xs-2">Tempo (dias)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(registro, index) in registros" :key="index">
                            <td>{{registro.DESC_INCIDENTE}}</td>
                            <td>{{registro.DT_INIC | date_br}}</td>
                            <td>{{registro.DT_FIM | date_br}}</td>
                            <td>{{registro.UNITS}}</td>    
                        </tr>
                    </tbody>
                </template>
                <template v-else>
                    <tr><td>Nada encontrado</td></tr>
                </template>
            </table>    
    </v-tab>
</template>

<script>
    export default {
        props:['rg'],
        data() {
            return {
                registros: [],
                module: 'afastamentos'
            }
        },
        mounted(){
            this.list()
        },
        methods: {
            list(){
                let urlIndex = `${this.$root.baseUrl}api/fdi/${this.module}/${this.rg}`;
                if(this.rg){
                    axios
                    .get(urlIndex)
                    .then((response) => {
                        this.registros = response.data
                    })
                    .catch(error => console.log(error));
                }
            },
        }
    }
</script>

<style scoped>

</style>