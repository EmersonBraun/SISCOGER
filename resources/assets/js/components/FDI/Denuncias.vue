<template>
    <v-tab header="Denúncias" :badge="denuncias.length">
        <table class="table table-striped">
            <tbody>  
                <template v-if="denuncias.length">  
                    <tr v-for="(denuncia, index) in denuncias" :key="index">  
                    <td>
                        <a :href="`${urlBase}${denuncia.proc_clean}/editar/${denuncia.sjd_ref}/${denuncia.sjd_ref_ano}`" target="_blanck">
                        {{denuncia.proc}} N°{{denuncia.sjd_ref}}/{{denuncia.sjd_ref_ano}}</a>
                    </td>
                    <td>Processo crime: <b>{{denuncia.ipm_processocrime}}</b></td>
                    <td>Julgamento:  
                        <b v-if="denuncia.ipm_julgamento"> {{denuncia.ipm_processocrime}}</b>
                        <b v-else> Não cadastrado </b> 
                    </td>
                    <td>Trânsito em julgado:  
                        <b v-if="denuncia.ipm_julgamento == 'Condenado'"> Sim</b>
                        <b v-else> Não </b>  
                    </td>
                    </tr> 
                </template> 
                <template v-else> 
                    <tr><td>Nada encontrado</td></tr>
                </template>     
            </tbody>
        </table>
    </v-tab>
</template>

<script>
    export default {
        props:['rg'],
        data() {
            return {
                denuncias: []
            }
        },
        mounted(){
            this.list()
        },
        computed: {
            urlBase() {
                return this.$root.baseUrl
            }
        },
        methods: {
            async list(){
                const urlIndex = `${this.$root.baseUrl}api/fdi/subJudice/${this.rg}`;
                if(this.rg){
                     try {
                        const response = await axios.get(urlIndex)
                        this.denuncias = response.data
                    } catch (error) {
                        console.log(error)
                    }
                }
            }
        }
    }
</script>

<style scoped>

</style>