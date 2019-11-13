<template>
    <div class="body">
        <!-- form -->
        <!-- /form -->
        <section class="a4 col-xs-6" v-for="(via, index) in vias" :key="index"> 
            <div class="header">
                <div class="text-bold-g">ESTADO DO PARANÁ</div>
                <div class="text-bold-g">POLÍCIA MILITAR</div>
                <div v-if="opmIntermediaria" class="text-bold-m">{{ opmIntermediaria }}</div>
                <div class="text-bold-m">{{ registro.pessoa_unidade_lotacao_descricao }}</div>
            </div>
            <div class="content-mem">
                <div class="col-xs-6 text-bold-m nopadding">Memorando nº {{ numMemorando }}/SJD</div>
                <div class="col-xs-6 text-bold-m text-right nopadding">Em {{day}} de {{month}} de {{year}}.</div>
                <div class="col-xs-12 text-bold-m nopadding" style="padding-top: 10px !important;">Ao {{ pm.posto }} {{ pm.quadro }} {{ pm.nome }}</div>
                <div class="col-xs-12 nopadding" style="padding-bottom: 10px !important;"><span class="text-bold-m">Assunto:</span>  Determinação para comparecimento.</div>
                <div class="col-xs-12 nopadding" style="padding-bottom: 25px !important;"><span class="text-bold-m">Referência:</span>  {{ registro.documento_de_origem }}.</div>
                <p>
                    Com fundamento no artigo 288,§ 3º do CPPM, 
                    determino o comparecimento de Vossa Senhoria em data de 
                    {{registro.comparecimento_data.split('/')[0]}} 
                    {{mesIco(registro.comparecimento_data.split('/')[1])}}. 
                    {{registro.comparecimento_data.split('/')[2].slice(-2)}}, 
                    às {{horaIco(registro.comparecimento_hora)}}, 
                    no(a) {{registro.comparecimento_local_txt}}, a fim de prestar depoimento em autos n°
                    {{registro.autos_numero}} na condição de {{registro.condicao}}.
                </p>
                <div v-if="registro.acusados">Acusado(s): {{registro.acusados}}</div>
            </div>
            <div class="ass">
                <div>2º Ten. QOPM Francimar de Moraes Zamierowski,</div>
                <div class="text-bold-m">Chefe da SJD</div>
            </div>
            <div class="row cert" >
                <div class="col-xs-6">
                    <table class="table-mem border">
                        <tr>
                            <td colspan="2" class="border text-bold-s center">USO DO SJD ({{codNotificacao.cod}}/{{year}})</td>
                        </tr>
                        <tr>
                            <td class="border text-bold-s">Notificado:</td>
                            <td class="border-l">{{codNotificacao}}</td>
                        </tr>
                        <tr>
                            <td class="border text-bold-s">Não notificado:</td>
                            <td class="border-l">{{codNotificacao}}</td>
                        </tr>
                        <tr>
                            <td class="border text-bold-s">Compareceu/Realizada:</td>
                            <td class="border-l">{{codNotificacao}}</td>
                        </tr>
                        <tr>
                            <td class="border text-bold-s">Compareceu/Cancelada:</td>
                            <td class="border-l">{{codNotificacao}}</td>
                        </tr>
                        <tr>
                            <td class="border text-bold-s">Compareceu/Redesignada:</td>
                            <td class="border-l">{{codNotificacao}}</td>
                        </tr>
                        <tr>
                            <td class="border text-bold-s">Não compareceu:</td>
                            <td class="border-l">{{codNotificacao}}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-xs-6">
                    <!-- para segunda via -->
                    <template v-if="via == 2">
                        <table class="table-mem border">
                            <tr>
                                <td colspan="2" class="border text-bold-m" style="text-align: justify;">
                                    ** Esta via deve ser carimbada no local da audiência e ser entregue no SJD após a apresentação do Militar Estadual
                                </td>
                            </tr>
                        </table>
                    </template>
                    <!-- primeira via -->
                    <template v-else>
                        <table class="table-mem border">
                            <tr>
                                <td colspan="2" class="border text-bold-s center" style="height: 12px;">CIENTE</td>
                            </tr>
                            <tr>
                                <td><span class="text-bold-s">Data:</span>  ______/______/__________</td>
                            </tr>
                            <tr>
                                <td><span class="text-bold-s">Horário:</span>  ______:______</td>
                            </tr>
                            <tr>
                                <td><span class="text-bold-s">Ass.:</span></td>
                            </tr>
                        </table>
                    </template>
                </div>
            </div>
        </section>
         <!-- <pre>{{day}}</pre> -->
    </div>
</template>

<script>
    export default {
        props: {
            idp: {
                type: Number,
                default: null 
            },
        },
        data() {
            return {
                module: 'apresentacao',
                registro: {},
                date: {},
                pm: {},
                autoridades: {},
                codNotificacao: {},
                opmIntermediaria: null,
                numMemorando: 0,
                vias: 2,
            }
        },
        computed: {
            day() {
                return this.$root.getDate('day')
            },
            month() {
                return this.$root.getDate('month')
            },
            year() {
                return this.$root.getDate('fullYear')
            }
        },
        created() {
            this.list()
            this.getPm()
        },
        methods: {
            list() {
                let urlIndex = `${this.$root.baseUrl}api/${this.module}/memorando/${this.idp}`;
                if(this.idp){
                    axios
                    .get(urlIndex)
                    .then((response) => {
                        this.registro = response.data
                    })
                    .catch(error => console.log(error));
                }
            },
            mesIco(mes) {
                const mesBR = ['','jan','fev','mar','abr','maio','jun','jul','ago','set','out','nov','dez']
                return mesBR[mes]
            },
            horaIco(hora){
                let hr = hora.split(':')
                let h = hr[0]
                let m = hr[1]
                if(Number(m) > 0) return `${h}h${m}`
                return `${h}h`
            },
            getPm(){
                // TODO trazer dados do pm para apresentacao
            },
            getAutoridade(){
                // TODO trazer autoridades para assinar
            },
            getCodNotificacao(){
                /*
                notificado 00
                n notificado 17
                comp real 23
                comp cancelada 30
                comp redes 46
                n comp 52
                */
            }

        }
    }
</script>

<style scoped>
    .body {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 12px;
        line-height: 1 !important;
        background-color: #f1f1f1;
    }
    p {
        text-indent: 50px;
        text-align: justify;
    }
    .a4 {
        display: flex;
        flex-direction: column;
        width: 595px;
        height: 841px;
        padding: 20px;
        border: 1px solid black;
        page-break-before: always;
    }
    .header {
        margin: 82.8px 57px 10px 85px;
        text-align: center;
        padding-bottom: 10px;
        border-bottom: 1px solid black;
    }
    .text-bold-g{
        font-size:14px;
        font-weight:bold;
        font-style:normal;
        text-decoration: none;
    }
    .text-bold-m{
        font-size:12px;
        font-weight:bold;
        font-style:normal;
        text-decoration: none;
    }
    .text-bold-s{
        font-size:8px;
        font-weight:bold;
        font-style:normal;
        text-decoration: none;
    }
    .content-mem {
        margin: 10px 57px 10px 85px !important;
        padding: 0 !important;
    }
    .ass {
        margin-top: 50px;
        text-align: center;  
    }
    .cert {
        display: flex;
        align-items: flex-end !important;
        margin: auto 57px 25px 85px; 
        font-size:8px;
    }
    .border-l {
        border-left: 1px solid black;
    }
    .border {
        border: 1px solid black;
    }
    .center {
        text-align: center;
    }
    .table-mem  {
        width: 100%;
        height: 90px;
        text-align: left;
        text-indent: 5px;
        padding: 0 10px 0 10px;
    }
</style>