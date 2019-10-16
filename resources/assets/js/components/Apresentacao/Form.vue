<template>
    <div>
        <v-label label="cdopm" title="OPM">
            <v-opm name='cdopm' :cdopm="registro.cdopm" v-model="registro.cdopm"></v-opm>
        </v-label>
        <v-label title="Notificação">
            <select v-model="registro.id_apresentacaonotificacao" class="form-control">
                <option value="1">Pendente</option>
                <option value="2">Notificado</option>
                <option value="3">Não notificado</option>
            </select>
        </v-label>
        <v-label title="Situação" :error="error.id_apresentacaosituacao">
            <select v-model="registro.id_apresentacaosituacao" class="form-control">
                <option value="1">Prevista</option>
                <option value="2">Compareceu/Realizada</option>
                <option value="3">Compareceu/Cancelada</option>
                <option value="4">Compareceu/Redesignada</option>
                <option value="5">Não compareceu</option>
                <option value="6">Não compareceu/Justificado</option>
                <option value="7">Redesignada</option>
                <option value="8">Substituído (Cons. VAJME)</option>
                <option value="9">Ag. Publicação</option>
                <option value="10">Apagada</option>
            </select>
        </v-label>
        <v-label title="Classificação de sigilo" :error="error.id_apresentacaoclassificacaosigilo">
            <select v-model="registro.id_apresentacaoclassificacaosigilo" class="form-control">
                <option value="1">Publico</option>
                <option value="2">Usuário Siscoger</option>
                <option value="3">Reservado - SDJ/Pares/Superiores</option>
                <option value="4">Reservado - Somente o próprio</option>
                <option value="5">Reservado - SJD/Próprio</option>
            </select>
        </v-label>
        <file-upload v-if="registro.id_apresentacao"
            title="Documento de Origem:"
            name="documento_de_origem"
            proc="apresentacao"
            :idp="registro.id_apresentacao"
            :ext="['pdf']">
        </file-upload>
        <v-label title="Processo/Procedimento" :error="error.id_apresentacaotipoprocesso">
            <select v-model="registro.id_apresentacaotipoprocesso" class="form-control">
                <option value="1">Ação Penal</option>
                <option value="2">Ação Civil</option>
                <option value="3">Não informado</option>
                <option value="4">Não se aplica</option>
                <option value="5">PM-IPM</option>
                <option value="6">PM-Sindicância</option>
                <option value="7">PM-FATD</option>
                <option value="8">PM-Inquérito Técnico</option>
                <option value="9">PM-CJ</option>
                <option value="10">PM-CD</option>
                <option value="11">PM-ADL</option>
                <option value="12">PM-ISO</option>
                <option value="13">PM-PAD</option>
                <option value="14">PM-Outro </option>
                <option value="15">Poder Judiciário </option>
                <option value="16">Inquérito Policial</option>
                <option value="17">VAJME</option>
            </select>
        </v-label>
        <v-label title="Autos Nº" :error="error.autos_numero">
            <input v-model="registro.autos_numero" type="text" class="form-control ">
        </v-label>
        <v-label title="Acusados" :error="error.acusados">
            <input v-model="registro.acusados" type="text" class="form-control ">
        </v-label>
        <v-label title="Descrição do local" :error="error.comparecimento_local_txt">
            <v-typeahead
                placeholder="Busca local"
                async-key="items"
                :src="buscaLocal"
                :template="customTemplate"
                v-model="registro.comparecimento_local_txt"
                :on-hit="selectLocal">
            </v-typeahead>
            <!-- <input v-model="registro.comparecimento_local_txt" type="text" class="form-control "> -->
        </v-label>
        <v-label title="Data do comparecimento" icon="fa fa-calendar">
            <v-datepicker v-model="registro.comparecimento_data" placeholder="dd/mm/aaaa" clear-button ></v-datepicker>
        </v-label>
        <v-label lg="12" md="12" title="Observações" :error="error.observacao_txt">
            <textarea v-model="registro.observacao_txt" rows="3" cols="80" style="width: 100%"></textarea>
        </v-label>
        <!-- Pessoa -->
        <v-label title="RG" :error="error.pessoa_rg">
            <input v-model="registro.pessoa_rg" type="text" class="form-control ">
        </v-label>
        <v-label title="Nome" :error="error.pessoa_nome">
            <input v-model="registro.pessoa_nome" type="text" class="form-control ">
        </v-label>
        <v-label title="Posto/Grad" :error="error.pessoa_posto">
            <select v-model="registro.pessoa_posto" class="form-control">
                <option value="CELAGREG">CELAGREG</option>
                <option value="CEL">CEL</option>
                <option value="TENCEL">TENCEL</option>
                <option value="MAJ">MAJ</option>
                <option value="CAP">CAP</option>
                <option value="1TEN">1TEN</option>
                <option value="2TEN">2TEN</option>
                <option value="ASPOF">ASPOF</option>
                <option value="ALUNO">ALUNO</option>
                <option value="ALUNO3A">ALUNO3A</option>
                <option value="ALUNO2A">ALUNO2A</option>
                <option value="ALUNO1A">ALUNO1A</option>
                <option value="SUBTEN">SUBTEN</option>
                <option value="1SGT">1SGT</option>
                <option value="2SGT">2SGT</option>
                <option value="3SGT">3SGT</option>
                <option value="CABO">CABO</option>
                <option value="SD1C">SD1C</option>
                <option value="SD2C">SD2C</option>
                <option value="null">Nâo encontrado</option>
            </select>
        </v-label>
        <v-label title="Quadro" :error="error.pessoa_quadro">
            <select v-model="registro.pessoa_quadro" class="form-control">
                <option value="QPMG1">QPMG1</option> 
                <option value="QPMG2">QPMG2</option> 
                <option value="QOPM">QOPM</option>
                <option value="QOBM">QOBM</option>
                <option value="QEOPM">QEOPM</option>
                <option value="QOS">QOS</option>
                <option value="PM">PM</option>
                <option value="BM">BM</option>
                <option value="null">Nâo encontrado</option>
            </select>
        </v-label>
        <v-label title="OPM" :error="error.pessoa_opm_codigo">
            <v-opm :cdopm="registro.pessoa_opm_codigo" v-model="registro.pessoa_opm_codigo"></v-opm>
        </v-label>
        <v-label title="Condição" :error="error.id_apresentacaocondicao">
            <select v-model="registro.id_apresentacaocondicao" class="form-control">
                <option value="1">Testemunha</option>
                <option value="2">Juiz Militar - Conselho Permanente</option>
                <option value="3">Juiz Militar - Conselho Especial</option>
                <option value="4">Réu</option>
                <option value="5">Testemunha de Defesa</option>
                <option value="6">Testemunha da Denúncia</option>
                <option value="7">Testemunha de Acusação</option>
                <option value="8">Testemunha do Juízo</option>
                <option value="9">Outro</option>
                <option value="10">Não informado</option>
            </select>
        </v-label>
        <div class="col-xs-12">
            <div class="col-xs-6">
                <v-tooltip effect="scale" placement="top" :content="msgRequired">
                    <a v-if="registro.id_apresentacao" class="btn btn-success btn-block" :disabled="requireds" @click.prevent="update(registro.id_apresentacao)">Editar</a>
                    <a v-else class="btn btn-success btn-block" :disabled="requireds" @click="create">Inserir</a>
                </v-tooltip>
            </div>
            <div class="col-xs-6">
                <a class="btn btn-danger btn-block" @click="limparDados">Limpar todos dados</a>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                registro: {},
                error: {},
                customTemplate: '<span>{{item.localdeapresentacao}} {{item.municipio}} - {{item.logradouro | }}</span>',
            }
        },
        computed: {
            buscaLocal() {
                return `${this.$root.baseUrl}api/localapresentacao/`;
            },
            requireds(){
                if(this.registro.comparecimento_data && this.registro.motivo && this.registro.motivo_txt) return false
                return true
            },
            lenght(){
                if(this.registros) return Object.keys(this.registros).length
                return 0 
            },
            msgRequired(){
                return `Para liberar este botão os campos: COMPORTAMENTO, MOTIVO e DESCRIÇÃO deve estar preenchidos`           
            }
        },
        methods: {
            limparDados() {

            },
            selectLocal() {
                
            },
            toCreate(){
                this.showModal = true
                this.registro.rg = this.pm.RG
                this.registro.cargo = this.pm.CARGO
                this.registro.nome = this.pm.NOME
                this.registro.rg_cadastro = this.$root.dadoSession('rg')
                this.registro.cdopm = this.$root.dadoSession('cdopm')
                this.registro.opm_abreviatura = this.$root.dadoSession('opm_abreviatura')
                this.registro.digitador = this.$root.dadoSession('nome')
            },
            create(){
                if(!this.requireds){

                    let urlCreate = `${this.$root.baseUrl}api/${this.module}/store`;
                    axios
                    .post(urlCreate, this.registro)
                    .then((response) => {
                        this.transation(response.data.success, 'create')
                    })
                    .catch(error => console.log(error));
                }
            },
            edit(registro){
                this.registro = registro
                this.toCreate()
            },
            update(id){
                if(!this.requireds){
                    let urlUpdate = `${this.$root.baseUrl}api/${this.module}/update/${id}`;
                    axios
                    .put(urlUpdate, this.registro)
                    .then((response) => {
                        this.transation(response.data.success, 'edit')
                    })
                    .catch(error => console.log(error));
                }
            },
            destroy(id){
                if(confirm('Você tem certeza?')){
                    let urlDelete = `${this.$root.baseUrl}api/${this.module}/destroy/${id}`;
                    axios
                    .delete(urlDelete)
                    .then((response) => {
                        this.transation(response.data.success, 'delete')
                    })
                    .catch(error => console.log(error));
                }
            },
            transation(happen,type) {
                let msg = this.words(type)
                if(happen) { // se deu certo
                        this.list()
                        this.$root.msg(msg.success,'success')
                        this.registro = null
                        this.registro = {}
                } else { // se falhou
                    this.$root.msg(msg.fail,'danger')
                }
            },
            words(type) {
                if(type == 'create') return { success : 'Inserido com sucesso', fail: 'Erro ao inserir'}
                if(type == 'edit') return { success : 'Editado com sucesso', fail: 'Erro ao editar'}
                if(type == 'delete') return { success : 'Apagado com sucesso', fail: 'Erro ao apagar'}
            }
        },
    }
</script>

<style scoped>

</style>
