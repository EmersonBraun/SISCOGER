<template>
    <v-tab header="Dependentes" :badge="registros.length">  
        <table class="table table-striped">
            <template v-if="registros.length">
                <thead>
                    <tr>
                        <th class="col-xs-3"><b>Nome</b></th>
                        <th class="col-xs-2"><b>Sexo</b></th>
                        <th class="col-xs-2"><b>Parentesco</b></th>
                        <th class="col-xs-2"><b>Nascimento</b></th>
                        <th class="col-xs-2"><b>Idade</b></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(registro, index) in registros" :key="index">
                        <td>{{ registro.nome }}</td>
                        <td>{{ registro.sexo }}</td>
                        <td>{{ registro.parentesco }}</td>
                        <td>{{ registro.data_nasc | date_bd | date_br}}</td>
                        <td>{{ registro.data_nasc | date_bd | tempo_em_anos_e_meses}}</td>                        
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
                module: 'dependentes'
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
            }
        }
    }
</script>

<style scoped>

</style>