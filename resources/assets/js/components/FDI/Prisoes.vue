<template>
    <v-tab header="Prisões" :badge="prisoes.lenght">
        <table class="table table-striped">
        <tbody>
            <template v-if="prisoes.lenght">
                <tr v-for="prisao in prisoes" :key="prisao.id_prisao">
                    <td>
                        <b>Inicio</b>: {{ prisao.inicio_data | date_br)}} 
                        <b>Fim</b>: 
                            <template v-if="prisao.fim_data">{{ prisao.fim_data | date_br}}</template>
                            <template v-else>Atual</template>
                        ({{ prisao.comarca }}-{{ prisao.vara }}) 
                    </td>
                </tr>
            </template>
            <template v-else>
                <tr>
                    <td>Nada encontrado</td>
                </tr>
            </template>
        </tbody>
    </table>
    <template v-if="canCreate">
        <button type="button" class="btn btn-primary btn-block">
            <i class="fa fa-plus"></i>Adicionar Prisão
        </button>
    </template>
    </v-tab>
</template>

<script>
    export default {
        props:['rg'],
        data() {
            return {
                prisoes: [],
                canCreate: false
            }
        },
        mounted(){
            this.listPrisoes()
            this.canCreate = this.$root.hasPermission('criar-prisoes')
        },
        methods: {
            listPrisoes(){
                let urlIndex = `${this.$root.baseUrl}api/fdi/prisoes/${this.rg}`;
                if(this.rg){
                    axios
                    .get(urlIndex)
                    .then((response) => {
                        this.prisoes = response.data
                    })
                    .catch(error => console.log(error));
                }
            },
        }
    }
</script>

<style scoped>

</style>