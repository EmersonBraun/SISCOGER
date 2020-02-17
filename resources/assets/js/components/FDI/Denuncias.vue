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
            this.listDenuncias()
        },
        computed: {
            urlBase() {
                return this.$root.baseUrl
            }
        },
        methods: {
            listDenuncias(){
                let urlIndex = `${this.$root.baseUrl}api/fdi/subJudice/${this.rg}`;
                if(this.rg){
                    axios
                    .get(urlIndex)
                    .then((response) => {
                        this.denuncias = response.data
                        console.log(this.denuncias)
                    })
                    .catch(error => console.log(error));
                }
            },
            urlProc(proc, ref, ano) {
                let urlBase = this.$root.baseUrl
                window.open(`${urlBase}${proc}/${ref}/${ano}`)
                console.log('Open')
            }
        }
    }
</script>

<style scoped>

</style>