<template>
    <v-tab header="SAI" :badge="sai.lenght">
        <table class="table table-striped">
        <tbody>
            <template v-if="sai.lenght">
                <tr>
                    <th>N° SAI</th>
                    <th>Motivo abertura</th>
                    <th>Síntese do fato</th>
                    <th>Situação</th>
                    <th>Resultado</th>
                    <th>Digitaror</th>
                    <th>Ações</th>
                </tr>
                <tr v-for="s in sai" :key="s.id_sai">
                    <td>
                        <template v-if="s.sjd_ref  !== 0">{{ s.sjd_ref }}/{{ s.sjd_ref_ano }}</template>
                        <template v-else>{{ s.id_sai }}</template>
                    </td>
                    <td>{{ s.motivo_principal }} </td>
                    <td>{{ s.sintese_txt }} </td>
                    <td>{{ s.situacao }} </td>
                    <td>{{ s.origem_proc }}-{{ s.origem_sjd_ref }}/{{ s.origem_sjd_ref_ano }} </td>
                    <td>{{ s.digitador }} </td>
                    <td>
                        <span>
                            <a class="btn btn-info" :href="urlEdit(s.id_sai)">
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
        <a class="btn btn-primary btn-block" :href="urlCreate">
            <i class="fa fa-fw fa-plus "></i>Adicionar SAI
        </a>
    </template>
    </v-tab>
</template>

<script>
    export default {
        props:['rg'] ,
        data() {
            return {
                sai: [],
                canCreate: false,
                canEdit: false,
            }
        },
        mounted(){
            this.listsai()
            this.canCreate = this.$root.hasPermission('criar-sai')
            this.canEdit = this.$root.hasPermission('editar-sai')
        },
        computed: {
            urlCreate() {
                let urlBase = this.$root.baseUrl
                return `${urlBase}sai/criar`
            },
            urlEdit(id) {
                let urlBase = this.$root.baseUrl
                return `${urlBase}sai/editar/${id}`
            }
        },
        methods: {
            listsai(){
                let urlIndex = `${this.$root.baseUrl}api/fdi/sai/${this.rg}`;
                if(this.rg){
                    axios
                    .get(urlIndex)
                    .then((response) => {
                        this.sai = response.data
                    })
                    .catch(error => console.log(error));
                }
            },
        }
    }
</script>

<style scoped>

</style>