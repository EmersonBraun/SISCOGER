<template>
    <div >
        <v-label lg="2" md="2" title="Of. Nº" :error="error.documento_de_origem">
            <input v-model="registro.documento_de_origem" type="text" class="form-control ">
        </v-label>
        <v-label lg="2" md="2" title="Autos Nº" :error="error.autos_numero">
            <input v-model="registro.autos_numero" type="text" class="form-control ">
        </v-label>
        <v-label lg="2" md="2" title="Autos Ano" :error="error.autos_ano">
            <the-mask v-model="val" mask="####" class="form-control" type="text" />
        </v-label>
        <v-label lg="2" md="2" title="Acusados" :error="error.acusados">
            <input v-model="registro.acusados" type="text" class="form-control ">
        </v-label>
        <v-label lg="2" md="2" title="Data do comparecimento" icon="fa fa-calendar">
            <v-datepicker v-model="registro.comparecimento_data" clear-button ></v-datepicker>
        </v-label>
        <v-label lg="2" md="2" title="Hora" :error="error.comparecimento_hora">
            <input type="time" v-model="registro.comparecimento_hora" class="form-control" placeholder="00:00" required>
        </v-label>
        <v-label lg="12" md="12" title="Observações" :error="error.observacao_txt">
            <input v-model="registro.observacao_txt" class="form-control">
        </v-label>
        <v-label lg="12" md="12" title="Descrição do local" :error="error.comparecimento_local_txt">
            <v-typeahead
                placeholder="Busca local"
                :async="buscaLocal"
                :on-hit="selectLocal"
                :template="templateLocal"
                v-model="registro.comparecimento_local_txt">
            </v-typeahead>
            <input type="hidden" v-model="registro.id_localdeapresentacao">
        </v-label>
        <v-label lg="2" md="2" title="RG" :error="error.pessoa_rg">
            <template v-if="onSearch && type == 'rg'">
                <v-typeahead
                    placeholder="Busca PM/BM ativos"
                    :async="buscaPM"
                    :on-hit="selectPM"
                    :template="templatePM"
                    match-start
                    v-model="registro.pessoa_rg">
                </v-typeahead>
            </template>
            <template v-else>  
                <input v-model="registro.pessoa_rg" type="text" class="form-control " placeholder="Busca PM/BM ativos" @click.prevent="changeMode('rg')">       
            </template>
        </v-label>
        <v-label lg="2" md="2" title="Nome" :error="error.pessoa_nome" >
            <template v-if="onSearch && type == 'nome'">  
                <v-typeahead
                    placeholder="Busca PM/BM ativos"
                    :async="buscaPM"
                    :on-hit="selectPM"
                    :template="templatePM"
                    match-start
                    v-model="registro.pessoa_nome">
                </v-typeahead>
            </template>
            <template v-else>  
                <input v-model="registro.pessoa_nome" type="text" class="form-control " placeholder="Busca PM/BM ativos" @click.prevent="changeMode('nome')">       
            </template>
        </v-label>

        <v-label lg="2" md="2" title="Posto/Grad" :error="error.pessoa_posto">
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
        <v-label lg="2" md="2" title="Quadro" :error="error.pessoa_quadro">
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

        <v-label lg="2" md="2" title="OPM" :error="error.pessoa_opm_codigo">
            <v-opm :cdopm="registro.pessoa_opm_codigo" v-model="registro.pessoa_opm_codigo"></v-opm>
        </v-label>

        <v-label lg="2" md="2" title="Condição" :error="error.id_apresentacaocondicao">
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
            <div class="col-md-8 col-xs-12">
                <v-tooltip effect="scale" placement="top" :content="msgRequired">
                    <a v-if="registro.id_apresentacao" class="btn btn-success btn-block" :disabled="requireds" @click.prevent="update(registro.id_apresentacao)">Editar</a>
                    <a v-else class="btn btn-success btn-block" :disabled="requireds" @click="create">Inserir</a>
                </v-tooltip>
            </div>
            <div class="col-md-4 col-xs-12">
                <a class="btn btn-danger btn-block" @click="limparDados">Limpar todos dados</a>
            </div>
        </div>
        <div class="col-xs-12">
            <table class="table table-striped">
                <template v-if="lenght">
                    <thead>
                        <tr>
                            <th class="col-xs-1"><b>N° Autos</b></th>
                            <th class="col-xs-1"><b>Of. N°</b></th>
                            <th class="col-xs-1"><b>Acusados</b></th>
                            <th class="col-xs-1"><b>Data comparecimento</b></th>
                            <!--<th class="col-xs-1"><b>Hora</b></th>-->
                            <th class="col-xs-1"><b>Local</b></th>
                            <th class="col-xs-1"><b>RG</b></th>
                            <th class="col-xs-1"><b>Nome</b></th>
                            <th class="col-xs-1"><b>Posto/grad.</b></th>
                            <th class="col-xs-1"><b>OPM</b></th>
                            <th class="col-xs-1"><b>Condição</b></th>
                            <th class="col-xs-2"><b>Ações</b></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(registro, index) in registros" :key="index">
                            <td>{{ registro.autos_numero }}</td>
                            <td>{{ registro.documento_de_origem }}</td>
                            <td>{{ registro.acusados }}</td>
                            <td>{{ registro.comparecimento_dh}}</td>
                            <!--<td>{{ registro.comparecimento_hora }}</td>-->
                            <td>{{ registro.comparecimento_local_txt }}</td>
                            <td>{{ registro.pessoa_rg }}</td>
                            <td>{{ registro.pessoa_nome }}</td>
                            <td>{{ registro.pessoa_quadro }}</td>
                            <td>{{ registro.pessoa_unidade_lotacao_sigla }}</td>
                            <td>{{ condicao(registro.id_apresentacaocondicao) }}</td>
                            <td>
                                <span>
                                    <template v-if="canEdit">
                                        <a class="btn btn-info" @click="edit(registro)"><i class="fa fa-fw fa-edit "></i></a>
                                    </template>
                                    <template v-if="canDelete">
                                        <a class="btn btn-danger" @click="destroy(registro.id_apresentacao)"><i class="fa fa-fw fa-trash-o "></i></a>
                                    </template>
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </template>
                <template v-else>
                    <tr><td>Não há registros</td></tr>
                </template>
            </table>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            reference: {type: Number, default: null},
            ano: {type: Number, default: null},
            id_notacomparecimento: {type: Number, default: null},
        },
        data() {
            return {
                module: 'apresentacao',
                registros: null,
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
                registro: {
                    pessoa_rg: '',
                    pessoa_nome: '',
                    id_apresentacaonotificacao: '1',
                    id_apresentacaosituacao: '1',
                    id_apresentacaoclassificacaosigilo: '1',
                    id_apresentacaotipoprocesso: '3',
                    id_apresentacaocondicao: '1',
                },
                error: {},
                type: null,
                onSearch: false,
                templateLocal: '<span>{{item.localdeapresentacao}}.{{item.logradouro}}, {{item.numero}} - {{item.bairro}} - {{item.municipio}}/{{item.uf}}. Tel.: {{item.telefone}}. CEP: {{item.cep}}.</span>',
                templatePM: '<span>{{item.CARGO}} {{item.NOME}} - {{item.RG}} (OM: {{item.OPM_DESCRICAO}}).</span>',
            }
        },
        computed: {
            buscaLocal() {
                return `${this.$root.baseUrl}api/localapresentacao/`
            },
            buscaPM(){
                return `${this.$root.baseUrl}api/dados/showsugest/${this.type}/`
            },
            requireds(){
                if(this.registro.autos_numero && this.registro.comparecimento_data && this.registro.comparecimento_hora && this.registro.comparecimento_local_txt &&
                 this.registro.pessoa_rg && this.registro.pessoa_nome && this.registro.pessoa_posto && this.registro.pessoa_quadro && this.registro.id_apresentacaocondicao) return false
                return true
            },
            msgRequired(){
                return `Para liberar este botão os campos: AUTOS, DATA DO COMPARECIMENTO, HORA, DESCRIÇÃO DO LOCAL, E OS DADOS DO PM/BM deve estar preenchidos`           
            },
            canEdit(){
                return this.$root.hasPermission('editar-apresentacao')
            },
            canDelete(){
                return this.$root.hasPermission('apagar-apresentacao')
            },
            lenght(){
                if(this.registros) return Object.keys(this.registros).length
                return 0 
            },
        },
        created(){
            this.list()
            if(this.reference) this.dadosApresentacao() 
            else this.cleanRegister()
        },
        methods: {
            list(){
                let urlIndex = `${this.$root.baseUrl}api/${this.module}/listnota/${this.id_notacomparecimento}`;
                if(this.id_notacomparecimento){
                    axios
                    .get(urlIndex)
                    .then((response) => {
                        this.registros = response.data
                    })
                    .catch(error => console.log(error));
                }
            },
            changeMode(type){
                this.type = type
                this.onSearch = true
                return true
            },
            limparDados() {
                let sn = confirm('Você tem certeza?')
                if(sn) {
                    this.registro = null
                    this.registro = {}
                }
            },
            selectLocal(item) {
                let localapresentacao = `${item.localdeapresentacao}.${item.logradouro}, ${item.numero} - ${item.bairro} - ${item.municipio}/${item.uf}. Tel.: ${item.telefone}. CEP: ${item.cep}.`
                this.registro.comparecimento_local_txt = localapresentacao
                this.registro.id_localdeapresentacao = item.id_localdeapresentacao
                return localapresentacao
            },
            selectPM(item) {
                this.onSearch = false
                this.type = null
                // dado PM
                this.registro.pessoa_rg = item.RG
                this.registro.pessoa_nome = item.NOME
                this.registro.pessoa_posto = item.CARGO
                this.registro.pessoa_quadro = item.QUADRO
                this.registro.pessoa_email = item.EMAIL_META4
                this.registro.pessoa_opm_meta4 = item.META4
                this.registro.pessoa_opm_sigla = item.ABREVIATURA
                this.registro.pessoa_opm_descricao = item.OPM_DESCRICAO
                // dados unidade
                this.registro.pessoa_unidade_lotacao_meta4 = item.META4
                this.registro.pessoa_unidade_lotacao_codigo = item.CDOPM
                this.registro.pessoa_unidade_lotacao_sigla = item.ABREVIATURA
                this.registro.pessoa_unidade_lotacao_descricao = item.OPM_DESCRICAO

                let cleanCdopm = item.CDOPM.substring(0,3)
                this.registro.pessoa_opm_codigo = cleanCdopm

                return this.type ? item.RG : item.NOME
            },
            dadosApresentacao(){
                let refAno = this.ano ? `${this.reference}/${this.ano}` : this.reference
                let urlData = `${this.$root.baseUrl}api/${this.module}/${refAno}`;
                    axios
                    .get(urlData)
                    .then((response) => {
                        this.registro = response.data
                    })
                    .catch(error => console.log(error));
            },
            cleanRegister(){
                this.registro.id_apresentacao = null
                this.registro.pessoa_rg = null
                this.registro.pessoa_nome = null
                this.registro.pessoa_posto = null
                this.registro.pessoa_quadro = null
                this.registro.pessoa_opm_codigo = null
                this.registro.id_apresentacaocondicao = null
                // this.registro = {
                //     pessoa_rg: '',
                //     pessoa_nome: '',
                //     id_apresentacaonotificacao: '1',
                //     id_apresentacaosituacao: '1',
                //     id_apresentacaoclassificacaosigilo: '1',
                //     id_apresentacaotipoprocesso: '3',
                //     id_apresentacaocondicao: '1',
                //     id_notacomparecimento: this.id_notacomparecimento,
                //     cdopm: this.$root.dadoSession('cdopmbase'),
                //     usuario_rg: this.$root.dadoSession('rg'),
                //     autos_ano: new Date().getFullYear()
                // }
            },
            additionalData(){
                let reg = this.registro
                let cleanData = reg.comparecimento_data.split('/').reverse().join('-')
                this.registro.comparecimento_hora = this.registro.comparecimento_hora
                this.registro.comparecimento_dh = `${cleanData} ${reg.comparecimento_hora}`
            },
            create(){
                if(!this.requireds){
                    this.additionalData()
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
                    let urlDelete = `${this.$root.baseUrl}api/${this.module}/destroyApi/${id}`;
                    axios
                    .delete(urlDelete)
                    .then((response) => {
                        this.transation(response.data.success, 'delete')
                    })
                    .catch(error => console.log(error));
                }
            },
             condicao(id){
                let search = this.apCondicao[id-1]
                return search.name  
            },
            transation(happen,type) {
                let msg = this.words(type)
                if(happen) { // se deu certo
                        this.list()
                        this.$root.msg(msg.success,'success')
                        this.cleanRegister()
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
