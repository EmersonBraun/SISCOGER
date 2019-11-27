<template>
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h2 class="box-title">Outras Autoridades</h2>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse">
                        <i class="fa fa-plus"></i>
                    </button> 
                </div>             
            </div>
            <div class="box-body">
                <div class="col-md-12 col-xs-12"> 
                    <table class="table table-striped">
                        <template v-if="lenght">
                            <thead>
                                <tr>
                                    <th class="col-xs-4">RG</th>
                                    <th class="col-xs-4">Função</th>
                                    <th class="col-xs-4">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="registro in registros" :key="registro.id_cadastroopmcogerautoridade">
                                    <td>{{ registro.rg }}</td>
                                    <td>{{ registro.funcao }}</td>
                                    <td>
                                        <span>
                                            <template v-if="canEdit">
                                                <a class="btn btn-info" @click="edit(registro)"><i class="fa fa-fw fa-edit "></i></a>
                                            </template>
                                            <template v-if="canDelete">
                                                <a class="btn btn-danger" @click="destroy(registro.id_cadastroopmcogerautoridade)"><i class="fa fa-fw fa-trash-o "></i></a>
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
                            <i class="fa fa-plus"></i>Adicionar Autoridade
                        </a>
                    </template>
                    <v-modal v-model="showModal" large effect="fade" width="80%">
                        <div slot="modal-header" class="modal-header">
                            <h4 class="modal-title">
                                <b v-if="registro.id_cadastroopmcogerautoridade">Editar Autoridade</b>
                                <b v-else>Inserir nova Autoridade</b>
                            </h4>
                        </div>
                        <div slot="modal-body">
                            <v-label label="rg" title="RG">
                                <input size="45" class="form-control" v-model="registro.rg" @keyup="dadosPM" type="text">	
                            </v-label>
                            <v-label label="nome" title="Nome">
                                <input class="form-control" v-model="nome" type="text" readonly>
                            </v-label>
                            <v-label label="funcao" title="Função">
                                <input size="45" class="form-control" v-model="registro.funcao" type="text">	
                            </v-label>
                        </div>
                        <div slot="modal-footer" class="modal-footer">
                            <div class="col-xs-6">
                                <a class="btn btn-default btn-block" @click="showModal = false">Cancelar</a>
                            </div>
                            <div class="col-xs-6">
                                <template v-if="canCreate">
                                    <v-tooltip effect="scale" placement="top" :content="msgRequired">
                                        <a v-if="registro.id_cadastroopmcogerautoridade" class="btn btn-success btn-block" :disabled="requireds" @click.prevent="update(registro.id_cadastroopmcogerautoridade)">Editar</a>
                                        <a v-else class="btn btn-success btn-block" :disabled="requireds" @click="create">Inserir</a>
                                    </v-tooltip>
                                </template>
                            </div>
                        </div>
                    </v-modal> 
                </div>   
            </div>   
        </div>
    </div> 
</template>

<script>

export default {
    props: ['id_cadastroopmcoger'],
    data() {
        return {
            module: 'cadastroopmautoridade',
            registros: [],
            registro: {},
            canCreate: false,
            canEdit: false,
            canDelete: false,
            showModal: false,
            nome: ''
        }
    },
    created(){
        this.canCreate = this.$root.hasPermission('criar-dados-unidade')
        this.canEdit = this.$root.hasPermission('editar-dados-unidade')
        this.canDelete = this.$root.hasPermission('apagar-dados-unidade')
        this.list()
    },
    computed:{
        requireds(){
            if(this.registro.rg && this.registro.funcao) return false
            return true
        },
        lenght(){
            if(this.registros) return Object.keys(this.registros).length
            return 0    
        },
        msgRequired(){
            return `Para liberar este botão os campos: RG e Função deve estar preenchidos`           
        }
    },
    methods: {
        list(){
            let urlIndex = `${this.$root.baseUrl}api/${this.module}/list/${this.id_cadastroopmcoger}`;
            if(this.id_cadastroopmcoger){
                axios
                .get(urlIndex)
                .then((response) => {
                    console.log(response.data)
                    this.registros = response.data[0]
                })
                .catch(error => console.log(error));
            }
        },
        toCreate(){
            this.showModal = true
            this.registro.id_cadastroopmcoger = this.id_cadastroopmcoger
            this.registro.usuario_rg = this.rg
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
            this.showModal = true
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
                this.$root.msg(msg.success,'success')
                this.registro = null
                this.registro = {}
                this.list()
            } else { // se falhou
                this.$root.msg(msg.fail,'danger')
            }
        },
        words(type) {
            if(type == 'create') return { success : 'Inserido com sucesso', fail: 'Erro ao inserir'}
            if(type == 'edit') return { success : 'Editado com sucesso', fail: 'Erro ao editar'}
            if(type == 'delete') return { success : 'Apagado com sucesso', fail: 'Erro ao apagar'}
        },
        dadosPM(){
            if(this.registro.rg.length > 3){
                let urlSearch = `${this.$root.baseUrl}api/dados/pm/${this.registro.rg}`;
                axios
                .get(urlSearch)
                .then((response) => {
                    console.log('res', response)
                    let res = response.data.pm
                    this.nome = `${res.cargo_ico} ${res.quadro_ico} ${res.nome_ico}`
                })
                .catch(error => console.log(error));
            }
        },
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