<template>
    <div class="box">
        <div class="box-header">
            <h2 class="box-title">Dados Principais</h2>       
            <div class="box-tools pull-right">
                <i v-if="pm.STATUS == 'Ativo'" class="fa fa-circle text-success"></i>
                <i v-if="pm.STATUS == 'Inativo'" class="fa fa-circle text-warning"></i>
                <i v-if="pm.STATUS == 'Reserva'" class="fa fa-circle text-info"></i>
                <strong>{{ pm.STATUS }}</strong>
                <template v-if="status">
                    <strong v-if="status.preso" class="text-danger">| Preso</strong>
                    <strong v-if="status.suspenso" class="text-danger">| Suspenso</strong>
                    <strong v-if="status.excluido" class="text-danger">| Excluido</strong>
                    <strong v-if="status.denunciado" class="text-danger">| Sub Judice</strong>
                    <strong v-if="status.restricao_fardamento" class="text-danger">| Rest. Fardamento</strong>
                    <strong v-if="status.restricao_arma" class="text-danger">| Rest. Armamento</strong>
                </template>
                <button type="button" class="btn btn-box-tool" data-widget="collapse">
                    <i class="fa fa-minus"></i>
                </button> 
            </div>             
        </div>
        <div class="box-body">
                <!-- principal -->
                <div class="row">
                    <div class="col-md-2 ">
                        <a :href="foto"><img class="img-responsive" :src="foto" ></a>
                    </div>
                    <div class="col-md-5 border" >
                        <p><strong>Nome:</strong><br></p>
                        <p>{{ pm.CARGO || pm.cargo }} {{ pm.QUADRO || pm.quadro}}<template v-if="pm.SUBQUADRO !== 'NA'">-{{ pm.SUBQUADRO || pm.subquadro}}</template> {{ pm.NOME || pm.nome }} </p>
                    </div>
                    <div class="col-md-5 border">
                        <p><strong>RG:</strong></p>
                        <p>{{ pm.RG }}</p>
                    </div>
                    <div class="col-md-5 border">
                        <p><strong>Comportamento atual:</strong></p>
                        <p>{{ comportamento }}</p>
                    </div>
                    <div class="col-md-5 border">
                        <p>
                            <template v-if="pm.STATUS == 'Ativo'"><b>Data de inclusão:</b></template>
                            <template v-if="pm.STATUS == 'Inativo'"><b>Data Inatividade:</b></template>
                            <template v-if="pm.STATUS == 'Reserva'"><b>Data Reserva:</b></template>
                        </p>
                        <p>{{ pm.ADMISSAO_REAL || pm.admissao_real| date_br }} ({{ pm.ADMISSAO_REAL || pm.admissao_real | date_bd | tempo_em_anos_e_meses }})</p>
                    </div>
                    <div class="col-md-5 border">
                        <p><strong>Cidade:</strong></p>
                        <p>{{ pm.CIDADE || pm.cidade }} <template v-if="pm.STATUS == 'Inativo'">- {{ pm.END_BAIRRO || pm.bairro}}</template></p>
                    </div>
                    <div class="col-md-5 border">
                        <p><strong>Data de nascimento:</strong></p>
                        <p>{{ pm.NASCIMENTO || pm.nascimento | date_br }} ({{ pm.IDADE }} Anos)</p>
                    </div>
                    <div class="col-md-5 border">
                        <p><strong>Classificacao Meta4:</strong></p>
                        <p>{{ pm.OPM_DESCRICAO || pm.opm_descricao }}</p>
                    </div>
                    <div class="col-md-5 border">
                        <p><strong>Email funcional:</strong></p>
                        <p>{{ pm.EMAIL_META4 || pm.email_meta4}}</p>
                    </div>
                    <!-- \principal -->
                    <!-- Adicionais -->
                    <div class="col-md-5 border">
                        <p><strong>CPF:</strong></p>
                        <p>{{ adc.CPF || 'Não encontrado'}}</p>
                    </div>
                    <div class="col-md-5 border">
                        <p><strong>Título de eleitor:</strong></p>
                        <p v-if="adc.SBR_NUM_TIT">{{ adc.SBR_NUM_TIT }}  Zona: {{ adc.SBR_ZONA }} Seção: {{ adc.SBR_SECAO }}</p>
                        <p v-else>Não encontrado</p>
                    </div>
                    <div class="col-md-5 border">
                        <p><strong>Nome do pai:</strong></p>
                        <p>{{ adc.CBR_NAME_FATHER || 'Não encontrado'}}</p>
                    </div>
                    <div class="col-md-5 border">
                        <p><strong>Nome da mãe:</strong></p>
                        <p>{{ adc.CBR_NAME_MATHER || 'Não encontrado'}}</p>
                    </div>
                    <!-- \Adicionais -->
                    <template v-if="pm.STATUS == 'Inativo'">
                        <div class="col-md-6 border">
                            <p><strong>Endereço:</strong></p>
                            <p>{{ pm.END_RUA }}, n° {{ pm.END_NUM }} ({{ pm.END_COMPL }}) CEP: {{ pm.END_CEP }}</p>
                        </div>
                        <div class="col-md-6 border">
                            <p><strong>Telefone:</strong></p>
                            <p>{{ pm.FONE }}</p>
                        </div>
                    </template>
                </div>
        </div>
    </div>
</template>

<script>
    export default {
        props:{
            pm: {type: Object}
        },
        data() {
            return {
                adc: '',
                comportamento: '',
                status: [],
            }
        },
        mounted(){
            // this.listDadosGerais()
            this.listDadosAdicionais()
            this.listComportamento()
            this.estatuspm()
        },
        computed: {
            foto(){
                return `http://10.47.1.8/sispics/fotos/${this.pm.RG}.JPG`
            }
        },
        methods: {
            listDadosAdicionais(){
                let urlIndex = `${this.$root.baseUrl}api/fdi/dadosAdicionais/${this.pm.RG}`;
                if(this.pm.RG){
                    axios
                    .get(urlIndex)
                    .then((response) => {
                        this.adc = response.data
                    })
                    .catch(error => console.log(error));
                }
            },
            listComportamento(){
                let urlIndex = `${this.$root.baseUrl}api/comportamento/atual/${this.pm.RG}`;
                if(this.pm.RG){
                    axios
                    .get(urlIndex)
                    .then((response) => {
                        this.comportamento = response.data
                    })
                    .catch(error => console.log(error));
                }
            },
            estatuspm(){
                let urlIndex = `${this.$root.baseUrl}api/estatuspm/${this.pm.RG}`;
                if(this.pm.RG){
                    axios
                    .get(urlIndex)
                    .then((response) => {
                        this.status = response.data
                    })
                    .catch(error => console.log(error));
                }
            },
        }
    }
</script>

<style scoped>
.border {
    border: 1px solid #dee2e6 !important;
    border-top-color: rgb(222, 226, 250);
    border-right-color: rgb(222, 226, 250);
    border-bottom-color: rgb(222, 226, 250);
    border-left-color: rgb(222, 226, 250);
    min-height: 60px;
}
</style>