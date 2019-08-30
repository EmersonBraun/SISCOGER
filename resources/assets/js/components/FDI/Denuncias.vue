<template>
    <v-tab header="Denúncias" :badge="denuncias.lenght">
        <table class="table table-striped" >
            <tbody>  
                <template v-if="denuncias.lenght">  
                    <tr v-for="(denuncia, index) in denuncias" :key="index">  
                        <template v-if="denuncia.id_ipm !== 0">
                            <td>
                            <a href="urlProc('ipm', denuncia.sjd_ref, denuncia.sjd_ref_ano)">
                            IPM N°{{denuncia.sjd_ref}}/{{denuncia.sjd_ref_ano}}</a>
                            </td>
                        </template> 
                        <template v-if="denuncia.id_apfd !== 0">
                            <td>
                            <a href="urlProc('apfd', denuncia.sjd_ref, denuncia.sjd_ref_ano)">
                            APFD N°{{denuncia.sjd_ref}}/{{denuncia.sjd_ref_ano}}</a>
                            </td>
                        </template> 
                        <template v-if="denuncia.id_desercao !== 0">
                            <td>
                            <a href="urlProc('desercao', denuncia.sjd_ref, denuncia.sjd_ref_ano)">
                            Desercao N°{{denuncia.sjd_ref}}/{{denuncia.sjd_ref_ano}}</a>
                            </td>
                        </template> 
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
        methods: {
            listDenuncias(){
                let urlIndex = `${this.$root.baseUrl}api/fdi/subJudice/${this.rg}`;
                if(this.rg){
                    axios
                    .get(urlIndex)
                    .then((response) => {
                        this.denuncias = response.data
                    })
                    .catch(error => console.log(error));
                }
            },
            urlProc(proc, ref, ano){
                let baseUrl = this.$root.baseUrl
                return `${baseUrl}${proc}/show/${id}/${ano}`
            }
        }
    }
</script>

<style scoped>

</style>