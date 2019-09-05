<template>
    <v-tab header="FDI" :badge="elogiosLenght">
        <!-- Mudanças de comportamento -->
        <template v-if="canSeeComportamentos">
            <table class="table table-striped">
                <h4 class="text-center text-bold">Mudanças de Comportamento</h4>
                <tbody>
                    <template v-if="comportamentosLenght">
                        <tr>
                            <th><b>Data:</b></th>
                            <th><b>Novo comportamento:</b></th>
                            <th><b>Sintese:</b></th>
                            <th><b>Publicacao:</b></th>
                        </tr>
                        <tr v-for="(comportamento, index) in comportamentos" :key="index">
                            <td>{{ comportamento.data | date_br}}</td>
                            <td>{{ comportamento.comportamento }}</td>
                            <td>{{ comportamento.motivo_txt }}</td>
                            <td>{{ comportamento.publicacao }}</td>
                        </tr>
                    </template>
                    <template v-else>
                        <tr>
                            <td>Não há mudanças de comportamento.</td>
                        </tr>
                    </template>
                </tbody>
            </table>
            <template v-if="canCreateComportamento">
                <button type="button" class="btn btn-primary btn-block">
                    <i class="fa fa-plus"></i>Adicionar mudança de comportamento
                </button>
            </template>
        </template>
        <!-- Elogios -->
        <template v-if="canSeeElogios">
            <table class="table table-striped">
                <h4 class="text-center text-bold">Elogios</h4>
                <tbody>
                    <template v-if="elogiosLenght">
                        <tr>
                            <th><b>Data:</b></th>
                            <th><b>OPM:</b></th>
                            <th><b>Sintese:</b></th>
                        </tr>
                        <tr v-for="(elogio, index) in elogios" :key="index">
                            <td>{{ elogio.elogio_data | date_br}}</td>
                            <td>{{ elogio.opm_abreviatura }}</td>
                            <td>{{ elogio.descricao_txt }}</td>
                        </tr>
                    </template>
                    <template v-else>
                        <tr>
                            <td>Não há Elogios.</td>
                        </tr>
                    </template>
                </tbody>
            </table>
            <template v-if="canCreateElogio">
                <button type="button" class="btn btn-primary btn-block">
                    <i class="fa fa-plus"></i>Adicionar Elogio
                </button>
            </template>
        </template>
    </v-tab>
</template>

<script>
    export default {
        props:['rg'],
        data() {
            return {
                comportamentos: [],
                elogios: [],
                canSeeComportamentos: false,
                canCreateComportamento: false,
                canSeeElogios: false,
                canCreateElogio: false
            }
        },
        mounted(){
            this.listComportamentos()
            this.listElogios()
            this.canSeeComportamentos = this.$root.hasPermission('ver-mudanca-comportamento')
            this.canCreateComportamento = this.$root.hasPermission('criar-mudanca-comportamento')
            this.canSeeElogios = this.$root.hasPermission('ver-elogios')
            this.canCreateElogio = this.$root.hasPermission('criar-elogio')
        },
         computed:{
            elogiosLenght(){
                return Object.keys(this.elogios).length
            },
            comportamentosLenght(){
                return Object.keys(this.comportamentos).length
            }
        },
        methods: {
            listComportamentos(){
                let urlIndex = `${this.$root.baseUrl}api/comportamento/list/${this.rg}`;
                if(this.rg){
                    axios
                    .get(urlIndex)
                    .then((response) => {
                        this.comportamentos = response.data
                    })
                    .catch(error => console.log(error));
                }
            },
            listElogios(){
                let urlIndex = `${this.$root.baseUrl}api/fdi/elogios/${this.rg}`;
                if(this.rg){
                    axios
                    .get(urlIndex)
                    .then((response) => {
                        this.elogios = response.data
                        
                    })
                    .catch(error => console.log(error));
                }
            },
        }
    }
</script>

<style scoped>

</style>