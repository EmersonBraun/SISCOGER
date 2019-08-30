<template>
    <div class="box">
        <div class="box-header">
            <h2 class="box-title">Dados Principais</h2>       
            <div class="box-tools pull-right">
                <i v-if="pm.STATUS == 'Ativo'" class="fa fa-circle text-success"></i>
                <i v-if="pm.STATUS == 'Inativo'" class="fa fa-circle text-warning"></i>
                <i v-if="pm.STATUS == 'Reserva'" class="fa fa-circle text-info"></i>
                <strong>{{ pm.STATUS }}</strong>
                <strong v-if="preso" class="text-danger">| Preso</strong>
                <strong v-if="suspenso" class="text-danger">| Suspenso</strong>
                <strong v-if="excluido" class="text-danger">| Excluido</strong>
                <strong v-if="subJudice" class="text-danger">| Sub Judice</strong>
                <button type="button" class="btn btn-box-tool" data-widget="collapse">
                    <i class="fa fa-minus"></i>
                </button> 
            </div>             
        </div>
        <div class="box-body">
                <!-- principal -->
                <div class="row">
                    <div class="col-md-2 ">
                        <a :href="foto"><img class="img-responsive" :src="foto" style="max-height: 350px;  max-width: 250px"></a>
                    </div>
                    <div class="col-md-5 border" >
                        <p><strong>Nome:</strong><br></p>
                        <p>{{ pm.CARGO }} {{ pm.QUADRO }} <template v-if="pm.SUBQUADRO !== 'NA'">-{{ pm.SUBQUADRO }}</template>{{ pm.NOME }} </p>
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
                        <p>{{ pm.ADMISSAO_REAL | date_br }} ({{ pm.ADMISSAO_REAL | date_bd | tempo_em_anos }})</p>
                    </div>
                    <div class="col-md-5 border">
                        <p><strong>Cidade:</strong></p>
                        <p>{{ pm.CIDADE }} <template v-if="pm.STATUS == 'Inativo'">- {{ pm.END_BAIRRO }}</template></p>
                    </div>
                    <div class="col-md-5 border">
                        <p><strong>Data de nascimento:</strong></p>
                        <p>{{ pm.NASCIMENTO | date_br }} ({{ pm.IDADE }} Anos)</p>
                    </div>
                    <div class="col-md-5 border">
                        <p><strong>Classificacao Meta4:</strong></p>
                        <p>{{ pm.OPM_DESCRICAO }}</p>
                    </div>
                    <div class="col-md-5 border">
                        <p><strong>Email funcional:</strong></p>
                        <p>{{ pm.EMAIL_META4 }}</p>
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
        props:['rg'],
        data() {
            return {
                pm: '',
                adc: '',
                comportamento: '',
                preso: '',
                suspenso: '',
                excluido: '',
                subJudice: '',
            }
        },
        mounted(){
            this.listDadosGerais()
            this.listDadosAdicionais()
            this.listComportamento()
            this.estaPreso()
            this.estaSuspenso()
            this.estaExcluido()
            this.estaSubJudice()
        },
        computed: {
            foto(){
                return `http://10.47.1.8/sispics/fotos/${this.pm.RG}.JPG`
            }
        },
        methods: {
            listDadosGerais(){
                let urlIndex = `${this.$root.baseUrl}api/fdi/dadosGerais/${this.rg}`;
                if(this.rg){
                    axios
                    .get(urlIndex)
                    .then((response) => {
                        this.pm = response.data
                    })
                    .catch(error => console.log(error));
                }
            },
            listDadosAdicionais(){
                let urlIndex = `${this.$root.baseUrl}api/fdi/dadosAdicionais/${this.rg}`;
                if(this.rg){
                    axios
                    .get(urlIndex)
                    .then((response) => {
                        this.adc = response.data
                    })
                    .catch(error => console.log(error));
                }
            },
            listComportamento(){
                let urlIndex = `${this.$root.baseUrl}api/fdi/comportamento/${this.rg}`;
                if(this.rg){
                    axios
                    .get(urlIndex)
                    .then((response) => {
                        this.comportamento = response.data
                    })
                    .catch(error => console.log(error));
                }
            },
            estaPreso(){
                let urlIndex = `${this.$root.baseUrl}api/fdi/preso/${this.rg}`;
                if(this.rg){
                    axios
                    .get(urlIndex)
                    .then((response) => {
                        this.preso = response.data
                    })
                    .catch(error => console.log(error));
                }
            },
            estaSuspenso(){
                let urlIndex = `${this.$root.baseUrl}api/fdi/suspenso/${this.rg}`;
                if(this.rg){
                    axios
                    .get(urlIndex)
                    .then((response) => {
                        this.suspenso = response.data
                    })
                    .catch(error => console.log(error));
                }
            },
            estaExcluido(){
                let urlIndex = `${this.$root.baseUrl}api/fdi/excluido/${this.rg}`;
                if(this.rg){
                    axios
                    .get(urlIndex)
                    .then((response) => {
                        this.excluido = response.data
                    })
                    .catch(error => console.log(error));
                }
            },
            estaSubJudice(){
                let urlIndex = `${this.$root.baseUrl}api/fdi/subJudice/${this.rg}`;
                if(this.rg){
                    axios
                    .get(urlIndex)
                    .then((response) => {
                        this.subJudice = response.data
                    })
                    .catch(error => console.log(error));
                }
            }
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