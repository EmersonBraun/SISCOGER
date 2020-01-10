<template>
    <v-tab header="Histórico Funcional" :badge="lenght">
            <table class="table table-striped">
                <template v-if="lenght">
                    <thead>
                        <tr>
                            <th class="col-xs-1">Data</th>
                            <th class="col-xs-1">Classificação</th>
                            <th class="col-xs-1">Gradação</th>
                            <th class="col-xs-5">Descrição</th>
                            <th class="col-xs-2">OPM</th>
                            <th class="col-xs-2">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="registro in registros" :key="registro.id_punicao">
                            <td>{{ registro.punicao_data }}</td>
                            <td>{{ registro.classpunicao || 'Não cadastrado' }}</td>
                            <td>{{ registro.gradacao || 'Não cadastrado' }}</td>
                            <td>{{ registro.descricao_txt }}</td>
                            <td>{{ registro.opm_abreviatura }}</td>
                            <td>
                                <span>
                                    <template v-if="canEdit">
                                        <a class="btn btn-info" @click="edit(registro)"><i class="fa fa-fw fa-edit "></i></a>
                                    </template>
                                    <template v-if="canDelete">
                                        <a class="btn btn-danger" @click="destroy(registro.id_punicao)"><i class="fa fa-fw fa-trash-o "></i></a>
                                    </template>
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </template>
                <template v-else>
                    <tr><td>Nada encontrado</td></tr>
                </template>
            </table>
        <template v-if="canCreate">
            <a class="btn btn-primary btn-block" @click="toCreate('create')">
                <i class="fa fa-plus"></i>Adicionar Punição
            </a>
        </template>
        <!-- form -->
        <v-modal v-model="showModal" large effect="fade" width="80%">
            <div slot="modal-header" class="modal-header">
                <h4 class="modal-title">
                    <b v-if="registro.id_punicao">Editar Punição</b>
                    <b v-else>Inserir nova Punição</b>
                </h4>
            </div>
            <div slot="modal-body">
                <input type='hidden' v-model='registro.rg_cadastro'>
                <input type='hidden' v-model='registro.opm_abreviatura'>
                <input type='hidden' v-model='registro.digitador'> 

                <v-label label="rg" title="RG">
                    <input class="form-control" type="text" size="12" maxlength="25" readonly="" v-model="registro.rg">
                </v-label>
                <v-label label="cargo" title="Posto/Grad.">
                    <input class="form-control" type="text" size="6" maxlength="10" readonly="" v-model="registro.cargo">
                </v-label>
                <v-label label="nome" title="Nome">
                    <input class="form-control" type="text" size="40" readonly="" v-model="registro.nome">
                </v-label>
                <v-label label="cdopm" title="OPM da Punicao">
                    <v-opm name='cdopm' cdopm="registro.cdopm" v-model="registro.cdopm"></v-opm>
                </v-label>
                <v-label label="procedimento" title="Procedimento">
                    <input v-if="registro.id_punicao && registro.procedimento" class="form-control" type="text" size="6" maxlength="10" readonly v-model="registro.procedimento">
                    <select v-else v-model="registro.procedimento" class="form-control">
                        <option value="NA">FATD S/N COGER</option>
                        <option value='fatd'>FATD</option>
                        <template v-if="isCoger">
                            <option value='cd'>CD</option>
                            <option value='cj'>CJ</option>
                            <option value='adl'>ADL</option>
                        </template>
                    </select>
                </v-label>
                <v-label label="sjd_ref" title="Nº Referência">
                    <input class="form-control" type="text" size="6" maxlength="10" :readonly="registro.id_punicao && registro.sjd_ref" v-model="registro.sjd_ref">
                </v-label>
                <v-label label="sjd_ref_ano" title="Ano">
                    <input class="form-control" type="text" size="6" maxlength="10" :readonly="registro.id_punicao && registro.sjd_ref_ano" v-model="registro.sjd_ref_ano">
                </v-label>
                <v-label label="punicao_data" title="Data da punição" icon="fa fa-calendar" >
                    <v-datepicker name="punicao_data" :placeholder="registro.punicao_data" clear-button v-model="registro.punicao_data"></v-datepicker>
                </v-label>
                <v-label label="ultimodia_data" title="Ultimo dia de cumprimento da punição" tooltip="Art. 63 RDE" icon="fa fa-calendar">
                    <v-datepicker name="ultimodia_data" :placeholder="registro.ultimodia_data" clear-button v-model="registro.ultimodia_data"></v-datepicker>
                </v-label>
                <v-label label="id_classpunicao" title="Classificação da punição">
                    <select v-model="registro.id_classpunicao" class="form-control">
                        <option value="1">Leve</option>
                        <option value='2'>Média</option>
                        <option value='3'>Grave</option>
                    </select>
                </v-label>
                <v-label label="id_gradacao" title="Gradação da punição" v-if="registro.id_classpunicao || registro.id_gradacao">
                    <select v-model="registro.id_gradacao" class="form-control" name="id_gradacao">
                        <template v-if="registro.id_classpunicao == 1">
                            <option value='1'>Advertência</option>
                            <option value='2'>Impedimento Disciplinar</option>
                        </template>
                        <template v-if="registro.id_classpunicao == 2">
                            <option value='3'>Repreensão</option>
                            <option value='4'>Detenção</option>
                        </template>
                        <template v-if="registro.id_classpunicao == 3">
                            <option value='5'>Prisão</option>
                        </template>
                    </select>
                </v-label>
                <template v-if="hasDias">
                    <v-label label="dias" title="Quantidade de dias">
                        <the-mask mask="####" class="form-control" type="text" maxlength="4" name="dias" v-model="registro.dias" placeholder="Dias"/>
                    </v-label>
                </template>
                <v-label label="descricao_txt" title="Descrição" lg="12" md="12">
                    <textarea  v-model="registro.descricao_txt" id="foco" rows="6" cols="105" width="100%"></textarea>
                </v-label>
            </div>
            <div slot="modal-footer" class="modal-footer">
                <div class="col-xs-6">
                    <a class="btn btn-default btn-block" @click="showModal = false">Cancelar</a>
                </div>
                <div class="col-xs-6">
                    <v-tooltip effect="scale" placement="top" :content="msgRequired">
                        <a v-if="registro.id_punicao" class="btn btn-success btn-block" :disabled="requireds" @click.prevent="update(registro.id_punicao)">Editar</a>
                        <a v-else class="btn btn-success btn-block" :disabled="requireds" @click="create">Inserir</a>
                    </v-tooltip>
                </div>
            </div>
        </v-modal>   
    </v-tab>
</template>

<script>

export default {
    props:['pm'],
    data() {
        return {
            module: 'punicao',
            registros: [],
            registro: {},
            canCreate: false,
            canEdit: false,
            canDelete: false,
            showModal: false,
            isCoger: false
        }
    },
    mounted(){
        this.list()
        this.canCreate = this.$root.hasPermission('criar-tramite-coger')
        this.canEdit = this.$root.hasPermission('editar-tramite-coger')
        this.canDelete = this.$root.hasPermission('apagar-tramite-coger')
        this.isCoger = this.$root.hasPermission('COGER')
    },
    computed:{
        requireds(){
            if(this.registro.punicao_data && this.registro.descricao_txt) return false
            return true
        },
        lenght(){
            if(this.registros) return Object.keys(this.registros).length
            return 0    
        },
        msgRequired(){
            return `Para liberar este botão os campos: DATA DA PUNIÇÃO e DESCRIÇÃO deve estar preenchidos`           
        },
        hasDias(){
            if(
                this.registro.id_gradacao == 2 || 
                this.registro.id_gradacao == 4 || 
                this.registro.id_gradacao == 5 || 
                this.registro.dias
            ) return true
            return false
        }
    },
    methods: {
        list(){
            let urlIndex = `${this.$root.baseUrl}api/${this.module}/list/${this.pm.RG}`;
            if(this.pm.RG){
                axios
                .get(urlIndex)
                .then((response) => {
                    this.registros = response.data
                })
                .catch(error => console.log(error));
            }
        },
        toCreate(type){
            this.showModal = true
            if(type == 'create') this.registro.id_punicao = null
            this.registro.rg = this.pm.RG
            this.registro.cargo = this.pm.CARGO
            this.registro.nome = this.pm.NOME
            this.registro.rg_cadastro = this.$root.dadoSession('rg')
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
                this.showModal = false
            }
        },
        edit(registro){
            this.registro = registro
            this.toCreate('edit')
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
            this.showModal = false
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
    }
}
</script>

<style scoped>
td {
  white-space: normal !important; 
  word-wrap: break-word;  
}
table {
  table-layout: fixed;
}
</style>