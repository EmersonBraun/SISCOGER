<template>
    <v-tab header="Proc. Outros" :badge="procoutros.length">
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
    <template v-if="canCreate">
        <a :href="urlCreate" class="btn btn-primary btn-block">
            <i class="fa fa-plus"></i>Adicionar Proc. Outros
        </a>
    </template>
    </v-tab>
</template>

<script>
    export default {
        props:['rg'],
        data() {
            return {
                procoutros: [],
                canCreate: false
            }
        },
        mounted(){
            this.listprocoutros()
            this.canCreate = this.$root.hasPermission('criar-proc-outros')
        },
        computed: {
            urlCreate() {
                return `${this.$root.baseUrl}procoutro/criar`;
            }
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