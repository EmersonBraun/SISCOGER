<template>
    <v-tab header="Proc. Outros" :badge="procoutros.length">
    <h4 class="text-center text-bold">Marcado em procedimentos como Acusado, Indiciado, Sindicado ou Paciente</h4>
        <table class="table table-striped">
        <tbody>
            <template v-if="procoutros.length">
                <tr>
                    <th>N° proc_outros</th>
                    <th>Andamento</th>
                    <th>Andamento COGER</th>
                    <th>Motivo</th>
                    <th>Doc. Origem</th>
                    <th>Sintese do fato</th>
                    <th>Situação</th>
                    <th>Resultado</th>
                    <th>Digitador</th>
                    <th>Ações</th>
                </tr>
                <tr v-for="(procoutro, index) in procoutros" :key="index">
                    <td>{{ procoutro.sjd_ref }}/{{ procoutro.sjd_ref_ano }}</td>
                    <td>{{ procoutro.andamento }}</td>
                    <td>{{ procoutro.andamentocoger }}</td>
                    <td>{{ procoutro.motivo_abertura }}</td>
                    <td>{{ procoutro.doc_origem }}</td>
                    <td>{{ procoutro.sintese_txt }}</td>
                    <td>{{ procoutro.situacao }}</td>
                    <td>{{ procoutro.origem_proc }}-{{ procoutro.origem_sjd_ref }}/{{ procoutro.origem_sjd_ref_ano }}</td>
                    <td>{{ procoutro.digitador }}</td>
                    <td>Ações </td>
                    <td>
                        <span>
                            <a class="btn btn-info" :href="urlEdit( procoutro.sjd_ref, procoutro.sjd_ref_ano)">
                                <i class="fa fa-fw fa-edit "></i>
                            </a>
                        </span>
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
    </v-tab>
</template>

<script>
    export default {
        props:['rg'],
        data() {
            return {
                procoutros: []
            }
        },
        mounted(){
            this.listprocoutros()
        },
        methods: {
            listprocoutros(){
                let urlIndex = `${this.$root.baseUrl}api/fdi/procOutros/${this.rg}`;
                if(this.rg){
                    axios
                    .get(urlIndex)
                    .then((response) => {
                        this.procoutros = response.data
                    })
                    .catch(error => console.log(error));
                }
            },
            urlEdit(ref, ano) {
                let urlBase = this.$root.baseUrl
                return `${urlBase}procoutro/editar/${ref}/${ano}`
            }
        }
    }
</script>

<style scoped>

</style>