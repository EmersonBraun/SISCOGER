<template>
    <div class="body">
        <!-- form -->
        <div class="col-xs-12">
            <v-label lg='6' md='6' title="Número memorando">
                <input type="text" v-model="registro.sjd_ref" class="form-control">
            </v-label>
            <v-label lg='6' md='6' title="Sigla Seção">
                <input type="text" v-model="registro.sigla" class="form-control">
            </v-label>
            <v-label label="check" title="Fecho: " md="12" lg="12">
                <div v-for="(autoridade, index) in autoridades" :key="index">
                    <input type="radio" :value="index" @click="changeAutoridade(autoridade)" v-model="check"> {{ autoridade.nome}} <b> {{ autoridade.funcao }} </b>
                </div>
            </v-label>
            <div class="col-xs-12">
                <v-tooltip effect="scale" placement="top" content="Deve selecionar o Fecho">
                    <a v-if="registro.id_apresentacao" class="btn btn-success btn-block" :disabled="autoridade.nome == null" @click.prevent="print()">Imprimir</a>
                </v-tooltip>
            </div>
        </div>
        <!-- /form -->
        <section id="printpage">
            <div class="a4 col-xs-6" v-for="(via, index) in vias" :key="index"> 
                <div class="header">
                    <div class="text-bold-g">ESTADO DO PARANÁ</div>
                    <div class="text-bold-g">POLÍCIA MILITAR</div>
                    <div v-if="opm_intermediaria" class="text-bold-m">{{ opm_intermediaria }}</div>
                    <div class="text-bold-m">{{ registro.pessoa_unidade_lotacao_descricao }}</div>
                </div>
                <div class="content-mem">
                    <div class="col-xs-6 text-bold-m nopadding">Memorando nº {{ registro.sjd_ref }}/{{registro.sigla}}</div>
                    <div class="col-xs-6 text-bold-m text-right nopadding">Em {{registro.data_ico.dia}} de {{registro.data_ico.mes_abr}} de {{registro.data_ico.ano}}.</div>
                    <div v-if="pm" class="col-xs-12 text-bold-m nopadding" style="padding-top: 10px !important;">Ao {{ pm.cargo_ico }} {{ pm.quadro_ico }} {{ pm.nome_ico }}</div>
                    <div class="col-xs-12 nopadding" style="padding-bottom: 10px !important;"><span class="text-bold-m">Assunto:</span>  Determinação para comparecimento.</div>
                    <div class="col-xs-12 nopadding" style="padding-bottom: 25px !important;"><span class="text-bold-m">Referência:</span>  {{ registro.documento_de_origem }}.</div>
                    <p>
                        Com fundamento no artigo 288,§ 3º do CPPM, 
                        determino o comparecimento de <span v-if="pm">{{ pm.tratamento_ico }}</span> em data de 
                        {{registro.comparecimento_data_ico.dia}} 
                        {{registro.comparecimento_data_ico.mes}}. 
                        {{registro.comparecimento_data_ico.ano_abr}}, 
                        às {{registro.comparecimento_hora_ico}}, 
                        no(a) {{registro.comparecimento_local_txt}}, a fim de prestar depoimento em autos n°
                        {{registro.autos_numero}} na condição de {{registro.condicao}}.
                    </p>
                    <div v-if="registro.acusados">Acusado(s): {{registro.acusados}}</div>
                </div>
                <div class="ass">
                    <div v-if="autoridade">{{autoridade.nome}},</div>
                    <div class="text-bold-m">{{autoridade.funcao}}</div>
                </div>
                <div class="row cert" >
                    <div class="col-xs-6">
                        <table class="table-mem border">
                            <tr>
                                <td colspan="2" class="border text-bold-s center">USO DO SJD ({{registro.cod_notificacao.base}}/{{registro.data_ico.ano}})</td>
                            </tr>
                            <tr>
                                <td class="border text-bold-s">Notificado:</td>
                                <td class="border-l">{{registro.cod_notificacao.notificado}}</td>
                            </tr>
                            <tr>
                                <td class="border text-bold-s">Não notificado:</td>
                                <td class="border-l">{{registro.cod_notificacao.naonotificado}}</td>
                            </tr>
                            <tr>
                                <td class="border text-bold-s">Compareceu/Realizada:</td>
                                <td class="border-l">{{registro.cod_notificacao.realizada}}</td>
                            </tr>
                            <tr>
                                <td class="border text-bold-s">Compareceu/Cancelada:</td>
                                <td class="border-l">{{registro.cod_notificacao.cancelada}}</td>
                            </tr>
                            <tr>
                                <td class="border text-bold-s">Compareceu/Redesignada:</td>
                                <td class="border-l">{{registro.cod_notificacao.redesignada}}</td>
                            </tr>
                            <tr>
                                <td class="border text-bold-s">Não compareceu:</td>
                                <td class="border-l">{{registro.cod_notificacao.naocompareceu}}</td>
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
            </div>
        </section>
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
                opm_intermediaria: null,
                date: {},
                pm: null,
                autoridades: [],
                autoridade: {},
                id_cadastroopmcoger: 0,
                vias: 2,
                check: null,
            }
        },
        mounted() {
            this.list()
        },
        methods: {
            async list() {
                if(this.idp){
                    let urlIndex = `${this.$root.baseUrl}api/${this.module}/memorando/${this.idp}`;
                    try {
                        const response = await axios.get(urlIndex)
                        if (response) {
                            this.registro = response.data
                            this.getPm(response.data.pessoa_rg)
                            this.getAutoridade()
                        }
                    } catch (e) {
                        console.error(e)
                    }
                }
            },
            async getPm(rg) {
                let searchUrl = `${this.$root.baseUrl}api/dados/pm/${rg}` ;
                try {
                    const response = await axios.get(searchUrl)
                    if (response) {
                        this.pm = response.data.pm
                        this.registro.pm = response.data.pm
                    }
                } catch (e) {
                    console.error(e)
                }
            },
            async getAutoridade() {
                let opm = this.$root.dadoSession('cdopmbase')
                if (!opm) this.login()
                let urlIndex = `${this.$root.baseUrl}api/cadastroopm/get/${opm}`;

                try {
                    const response = await axios.get(urlIndex)
                    if (response) {
                        let res = response.data[0]

                        this.id_cadastroopmcoger = res.id_cadastroopmcoger
                        this.getOtherAutoridade(res.id_cadastroopmcoger)

                        this.autoridades.push({
                            nome: res.opm_autoridade_nome,
                            funcao: res.opm_autoridade_funcao
                        })
                    }
                } catch (e) {
                    console.error(e)
                }
            },
            async getOtherAutoridade(id) {
                let urlIndex = `${this.$root.baseUrl}api/cadastroopmautoridade/list/${id}`;

                try {
                    const response = await axios.get(urlIndex)
                    if (response) {
                        let res = response.data[0]
                        res.forEach(e => {
                            this.autoridades.push({
                                nome: e.nome,
                                funcao: e.funcao
                            })
                        });
                    }
                } catch (e) {
                    console.error(e)
                }
            },
            changeAutoridade(autoridade) {
                this.autoridade = autoridade
                this.registro.autoridade = autoridade
            },
            login() {
                window.location.href = `${this.$root.baseUrl}login`
            },
            print() {
                let nome = this.autoridade.nome.replace(/\s/g , "-");
                let funcao = this.autoridade.funcao.replace(/\s/g , "-");
                let urlPrint = `${this.$root.baseUrl}api/apresentacao/memorandogerar/${this.idp}/${nome}/${funcao}`;
                console.log('url',urlPrint)
                window.open(urlPrint);
                console.log('print')
            }

        }
    }
</script>

<style scoped>
    /* #printpage {
        top: 10px;
        margin: 10px;
        padding: 20px;
    } */

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