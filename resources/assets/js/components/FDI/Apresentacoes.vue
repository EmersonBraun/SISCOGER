<template>
    <v-tab header="Apresentações" :badge="apresentacoes.lenght">
        <table class="table table-striped">
            <tbody> 
                <template v-if="apresentacoes.lenght">
                    <tr>
                        <th>N° Apres.</th>
                        <th>OPM</th>
                        <th>N° OF</th>
                        <th>Pessoa</th>
                        <th>Tipo</th>
                        <th>Autos</th>
                        <th>Condição</th>
                        <th>Local</th>
                        <th>Data/hora</th>
                        <th>Situação</th>
                    </tr>
                    <tr v-for="(apresentacao, index) in apresentacoes" :key="index">
                        <td>{{ apresentacao.sjd_ref }}/{{ apresentacao.sjd_ref_ano }}</td>
                        <td>
                            <template v-if="apresentacao.opmsigla">{{ apresentacao.opmsigla }}</template>
                            <template v-else>{{ apresentacao.pessoa_unidade_lotacao_sigla }}</template>
                        </td>
                        <td>{{ apresentacao.documento_de_origem }}</td>
                        <td>{{ apresentacao.pessoa_posto }} {{apresentacao.pessoa_quadro }} {{apresentacao.pessoa_nome }}</td>
                        <td>{{ tipoProcesso(apresentacao.id_apresentacaotipoprocesso) }}</td>
                        <td>{{ apresentacao.autos_numero }}</td>
                        <td>{{ condicao(apresentacao.id_apresentacaocondicao) }}</td>
                        <td>{{ apresentacao.comparecimento_local_txt }}</td>
                        <td>{{ apresentacao.comparecimento_dh | date_br_hr }}</td>
                        <td>{{ situacao(apresentacao.id_apresentacaosituacao) }}</td>
                    </tr>
                </template>
                <template v-else>
                    <tr>
                        <td> Não há registros.</td>
                    </tr> 
                </template>
            </tbody>
        </table>
        <template v-if="canCreate">
            <button type="button" class="btn btn-primary btn-block">
                <i class="fa fa-plus"></i>Adicionar Apresentação
            </button>
        </template>
    </v-tab>
</template>

<script>
    export default {
        props:['rg'],
        data() {
            return {
                apresentacoes: [],
                canCreate: false,
                apCondicao:
                [
                    { id: 1, name: "Testemunha"},
                    { id: 2, name: "Juiz Militar - Conselho Permanente"},
                    { id: 3, name: "Juiz Militar - Conselho Especial"},
                    { id: 4, name: "Réu"},
                    { id: 5, name: "Testemunha de Defesa"},
                    { id: 6, name: "Testemunha da Denúncia"},
                    { id: 7, name: "Testemunha de Acusação"},
                    { id: 8, name: "Testemunha do Juízo"},
                    { id: 9, name: "Outro"},
                    { id: 10, name: "Não informado"}
                ],
                apSituacao :
                [
                    { id: 1, name: "Prevista"},
                    { id: 2, name: "Compareceu/Realizada"},
                    { id: 3, name: "Compareceu/Cancelada"},
                    { id: 4, name: "Compareceu/Redesignada"},
                    { id: 5, name: "Não compareceu"},
                    { id: 6, name: "Não compareceu/Justificado"},
                    { id: 7, name: "Redesignada"},
                    { id: 8, name: "Substituído (Cons. VAJME)"},
                    { id: 9, name: "Ag. Publicação"},
                    { id: 10, name: "Apagada"}
                ],

                apTipoProcesso :
                [
                    { id: 1, name: "Ação Penal"},
                    { id: 2, name: "Ação Civil"},
                    { id: 3, name: "Não informado"},
                    { id: 4, name: "Não se aplica"},
                    { id: 5, name: "PM-IPM"},
                    { id: 6, name: "PM-Sindicância"},
                    { id: 7, name: "PM-FATD"},
                    { id: 8, name: "PM-Inquérito Técnico"},
                    { id: 9, name: "PM-CJ"},
                    { id: 10, name: "PM-CD"},
                    { id: 11, name: "PM-ADL"},
                    { id: 12, name: "PM-ISO"},
                    { id: 13, name: "PM-PAD"},
                    { id: 14, name: "PM-Outro "},
                    { id: 15, name: "Poder Judiciário "},
                    { id: 16, name: "Inquérito Policial"},
                    { id: 17, name: "VAJME"}
                ],
            }
        },
        mounted(){
            this.listApresentacoes()
            this.canCreate = this.$root.hasPermission('criar-apresentacao')
        },
        methods: {
            listApresentacoes(){
                let urlIndex = `${this.$root.baseUrl}api/fdi/apresentacoes/${this.rg}`;
                if(this.rg){
                    axios
                    .get(urlIndex)
                    .then((response) => {
                        this.apresentacoes = response.data
                    })
                    .catch(error => console.log(error));
                }
            },
            tipoProcesso(id){
                let search = this.apTipoProcesso[id + 1]
                return search.name
            },
            condicao(id){
                let search = this.apCondicao[id + 1]
                return search.name  
            },
            situacao(id){
                let search = this.apSituacao[id + 1]
                return search.name
            }
        }
    }
</script>  
<style scoped>

</style>