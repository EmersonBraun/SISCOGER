<template>
    <v-tab header="Trâmite COGER" :badge="lenght">
            <table class="table table-striped">
                <template v-if="lenght">
                    <thead>
                        <tr>
                            <th class="col-xs-4">Data</th>
                            <th class="col-xs-4">Descrição</th>
                            <th class="col-xs-4">Digitador</th>
                            <th class="col-xs-4">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="registro in registros" :key="registro.id_tramitacao">
                            <td>{{registro.data}}</td>
                            <td>{{registro.descricao_txt}}</td>
                            <td>{{registro.digitador}}</td>
                            <td>
                                <span>
                                    <template v-if="canEdit">
                                        <a class="btn btn-info" @click="edit(registro)"><i class="fa fa-fw fa-edit "></i></a>
                                    </template>
                                    <template v-if="canDelete">
                                        <a class="btn btn-danger" @click="destroy(registro.id_tramitacao)"><i class="fa fa-fw fa-trash-o "></i></a>
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
            <a class="btn btn-primary btn-block" @click="toCreate">
                <i class="fa fa-plus"></i>Adicionar Trâmite
            </a>
        </template>
        <!-- form -->
        <v-modal v-model="showModal" large effect="fade" width="70%">
            <div slot="modal-header" class="modal-header">
                <h4 class="modal-title">
                    <b v-if="registro.id_tramitacao">Editar Trâmite</b>
                    <b v-else>Inserir novo Trâmite</b>
                </h4>
            </div>
            <div slot="modal-body">
                <input type="hidden" name="id" v-model="registro.id_tramitacao">
                <v-label label="rg" title="RG">
                    <input class="form-control" type="text" size="12" maxlength="25" readonly="" v-model="registro.rg">
                </v-label>
                <v-label label="cargo" title="Posto/Grad.">
                    <input class="form-control" type="text" size="6" maxlength="10" readonly="" v-model="registro.cargo">
                </v-label>
                <v-label label="nome" title="Nome">
                    <input class="form-control" type="text" size="40" readonly="" v-model="registro.nome">
                </v-label>
                <v-label label="data" title="Data" icon="fa fa-calendar">
                    <v-datepicker name="data" :placeholder="registro.data" clear-button v-model="registro.data"></v-datepicker>
                </v-label>
                <v-label label="nome" title="Digitador">
                    <input class="form-control" type="text" size="40" readonly v-model="registro.digitador">
                </v-label>
                <v-label label="descricao_txt" title="Descrição">
                    <textarea  v-model="registro.descricao_txt" class="form-control" rows="3" ></textarea>
                </v-label>
            </div>
            <div slot="modal-footer" class="modal-footer">
                <div class="col-xs-6">
                    <a class="btn btn-default btn-block" @click="showModal = false">Cancelar</a>
                </div>
                <div class="col-xs-6">
                    <v-tooltip effect="scale" placement="top" :content="msgRequired">
                        <a v-if="registro.id_tramitacao" class="btn btn-success btn-block" :disabled="requireds" @click.prevent="update(registro.id_tramitacao)">Editar</a>
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
            module: 'tramitecoger',
            registros: [],
            registro: {},
            canCreate: false,
            canEdit: false,
            canDelete: false,
            showModal: false,
        }
    },
    mounted(){
        this.list()
        this.canCreate = this.$root.hasPermission('criar-tramite-coger')
        this.canEdit = this.$root.hasPermission('editar-tramite-coger')
        this.canDelete = this.$root.hasPermission('apagar-tramite-coger')
    },
    computed:{
        requireds(){
            if(this.registro.data && this.registro.descricao_txt) return false
            return true
        },
        lenght(){
            if(this.registros) return Object.keys(this.registros).length
            return 0    
        },
        msgRequired(){
            return `Para liberar este botão os campos: DATA e DESCRIÇÃO deve estar preenchidos`           
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
                .catch(error => console.log("error"));
            }
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
                .catch(error => console.log("error"));
                this.showModal = false
                
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
                .catch(error => console.log("error"));
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
                .catch(error => console.log("error"));
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