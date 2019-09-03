<template>
    <v-tab header="Outras Denúncias" :badge="denuncias.lenght">
        <table class="table table-striped">
        <tbody>
            <template v-if="denuncias.lenght">
                <tr v-for="denuncia in denuncias" :key="denuncia.id_denunciacivil">
                    <td><a href="#">Deserção N°{{ denuncia.id_denunciacivil }}</a></td>
                    <td>Processo crime: <b>{{ denuncia.processocrime }}</b></td>
                    <td>Julgamento: 
                        <b v-if="denuncia.julgamento">{{ denuncia.julgamento }}</b> 
                        <b> Não cadastrado </b> 
                    </td>
                    <td>Trânsito em julgado: 
                        <b v-if="denuncia.transitojulgado_bl">Sim</b> 
                        <b> Não </b> 
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
            <i class="fa fa-plus"></i>Adicionar Denúncia
        </button>
    </template>
    </v-tab>
</template>

<script>
    export default {
        props:['rg'],
        data() {
            return {
                denuncias: [],
                canCreate: false
            }
        },
        mounted(){
            this.listDenuncias()
            this.canCreate = this.$root.hasPermission('criar-outras-denuncias')
        },
        methods: {
            listDenuncias(){
                let urlIndex = `${this.$root.baseUrl}api/fdi/denunciaCivil/${this.rg}`;
                if(this.rg){
                    axios
                    .get(urlIndex)
                    .then((response) => {
                        this.denuncias = response.data
                    })
                    .catch(error => console.log(error));
                }
            },
        }
    }
</script>

<style scoped>

</style>