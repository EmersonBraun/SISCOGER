<template>
    <v-tab header="Membro" :badge="membros.length">
    <h4 class="text-center text-bold">Marcado em procedimentos como Encarregado, Presidente ou Acusador</h4>
        <table class="table table-striped">
        <tbody>
            <template v-if="membros.length">
                <tr>
                    <th>Proc.</th>
                    <th>CDOPM</th>
                    <th>Situação</th>
                    <th>Andamento</th>
                    <th>Ações</th>
                </tr>
                <tr v-for="(membro, index) in membros" :key="index">
                    <td>{{ membro.procedimento | toUpper }} {{ membro.sjd_ref }} / {{ membro.sjd_ref_ano }}</td>
                    <td>{{ membro.cdopm }}</td>
                    <td>{{ membro.situacao }} <template v-if="membro.rg_sustituto">Substituído</template></td>
                    <td>{{ membro.id_andamento }}</td>
                    <td>
                        <span>
                            <a class="btn btn-info" :href="urlEdit(membro.procedimento, membro.sjd_ref, membro.sjd_ref_ano)">
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
                membros: []
            }
        },
        mounted(){
            this.listmembros()
        },
        methods: {
            listmembros(){
                let urlIndex = `${this.$root.baseUrl}api/fdi/membros/${this.rg}`;
                if(this.rg){
                    axios
                    .get(urlIndex)
                    .then((response) => {
                        this.membros = response.data
                    })
                    .catch(error => console.log(error));
                }
            },
            urlEdit(proc, ref, ano) {
                let urlBase = this.$root.baseUrl
                return `${urlBase}${proc}/editar/${ref}/${ano}`
            }
        }
    }
</script>

<style scoped>

</style>