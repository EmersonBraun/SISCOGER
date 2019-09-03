<template>
    <v-tab header="Restrições" :badge="restricoes.lenght">
        <table class="table table-striped">
        <tbody>
            <template v-if="restricoes.lenght">
                <tr>
                    <td v-if="restricao.arma_bl"><b>Restricao de porte de arma de fogo.</b></td>
                    <td v-if="restricao.fardamento_bl"><b>Restricao de uso de fardamento.</b></td>
                    <td> <b>Inicio</b>: {{data_br(restricao.inicio_data )}} / 
                        <b>Fim</b>:
                        <template v-if="restricao.retirada_data =='0000-00-00' && restricao.fim_data =='0000-00-00'">
                            <b>Vigente</b>
                        </template>
                        <template v-else>
                            {{data_br(restricao.retirada_data )}}
                        </template>
                    </td>
                    <template v-if="canRemove">
                        <td v-if="restricao.retirada_data =='0000-00-00' && restricao.fim_data =='0000-00-00'">
                            <button type="button" class="btn btn-default pull-right">
                                <i class="fa fa-minus"></i>Retirar restricao
                            </button>
                        </td>
                    </template>
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
            <i class="fa fa-plus"></i>Adicionar Restrição
        </button>
    </template>
    </v-tab>
</template>

<script>
    export default {
        props:['rg'],
        data() {
            return {
                restricoes: [],
                canCreate: false,
                canRemove: false
            }
        },
        mounted(){
            this.listrestricoes()
            this.canCreate = this.$root.hasPermission('criar-restricoes')
            this.canRemove = this.$root.hasPermission('editar-restricoes')
        },
        methods: {
            listrestricoes(){
                let urlIndex = `${this.$root.baseUrl}api/fdi/restricaoCivil/${this.rg}`;
                if(this.rg){
                    axios
                    .get(urlIndex)
                    .then((response) => {
                        this.restricoes = response.data
                    })
                    .catch(error => console.log(error));
                }
            },
        }
    }
</script>

<style scoped>

</style>