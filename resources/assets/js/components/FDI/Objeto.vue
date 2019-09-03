<template>
    <v-tab header="Objeto" :badge="objetos.length">
    <h4 class="text-center text-bold">Marcado em procedimentos como Acusado, Indiciado, Sindicado ou Paciente</h4>
        <table class="table table-striped">
        <tbody>
            <template v-if="objetos.length">
                <tr>
                    <th>Proc.</th>
                    <th>CDOPM</th>
                    <th>Situação</th>
                    <th>Andamento</th>
                    <th>Ações</th>
                </tr>
                <tr v-for="(objeto, index) in objetos" :key="index">
                    <td>{{ objeto.procedimento | toUpper }} {{ objeto.sjd_ref }} / {{ objeto.sjd_ref_ano }}</td>
                    <td>{{ objeto.cdopm }}</td>
                    <td>{{ objeto.situacao }} <template v-if="objeto.rg_sustituto">Substituído</template></td>
                    <td>{{ objeto.id_andamento }}</td>
                    <td>
                        <span>
                            <a class="btn btn-info" :href="urlEdit(objeto.procedimento, objeto.sjd_ref, objeto.sjd_ref_ano)">
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
                objetos: []
            }
        },
        mounted(){
            this.listObjetos()
        },
        methods: {
            listObjetos(){
                let urlIndex = `${this.$root.baseUrl}api/fdi/objetos/${this.rg}`;
                if(this.rg){
                    axios
                    .get(urlIndex)
                    .then((response) => {
                        this.objetos = response.data
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