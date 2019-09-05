<template>
    <v-tab header="E-Protocolo" :badge="lenght">
            <table class="table table-striped">
                <template v-if="lenght">
                    <thead>
                        <tr>
                            <th class="col-xs-1">N° Documento</th>
                            <th class="col-xs-4">Descrição</th>
                            <th class="col-xs-1">RG Autor</th>
                            <th class="col-xs-1">RG Analista</th>
                            <th class="col-xs-3">Observações</th>
                            <th class="col-xs-2">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="registro in registros" :key="registro.id_protocolo">
                            <td>{{ registro.numero }}</td>
                            <td>{{ registro.descricao_txt }}</td>
                            <td>{{ registro.rg_autor }}</td>
                            <td>{{ registro.rg_analista }}</td>
                            <td>{{ registro.obs }}</td>
                            <td>
                                <span>
                                    <template v-if="canEdit">
                                        <a class="btn btn-info" @click="edit(registro)"><i class="fa fa-fw fa-edit "></i></a>
                                    </template>
                                    <template v-if="canDelete">
                                        <a class="btn btn-danger" @click="destroy(registro.id_protocolo)"><i class="fa fa-fw fa-trash-o "></i></a>
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
            <a class="btn btn-primary btn-block" @click="showModal = true">
                <i class="fa fa-plus"></i>Adicionar Protocolo
            </a>
        </template>
        <!-- form -->
        <Modal v-model="showModal" large effect="fade">
            <div slot="modal-header" class="modal-header">
                <h4 class="modal-title"><b>Inserir novo Protocolo</b></h4>
            </div>
            <div slot="modal-body">
                <input type="hidden" name="id" v-model="registro.id_protocolo">
                <Label lg="6" label="numero" title="Numero do protocolo">
                    <the-mask mask="##.###.###-#" class="form-control" type="text" required v-model="registro.numero" placeholder="00.000.000-0" />
                </Label>
                <Label lg="6" label="rg" title="RG cadastro">
                    <input type="text" readonly v-model="registro.rg_autor" class="form-control">
                </Label>
                <Label lg="6" label="rg_analista" title="RG analista">
                    <the-mask mask="###############" class="form-control" type="text" v-model="registro.rg_analista" placeholder="Só números" />
                </Label>
                <Label lg="6" label="obs" title="Observações">
                    <input type="text" class="form-control" maxlength="50" v-model="registro.obs">
                </Label>
                <Label lg="12" label="descricao_txt" title="Descrição">
                    <textarea  v-model="registro.descricao_txt" id="foco" rows="5" cols="105" width="100%"></textarea>
                </Label>
            </div>
            <div slot="modal-footer" class="modal-footer">
                <div class="col-xs-6">
                    <a class="btn btn-default btn-block" @click="showModal = false">Cancelar</a>
                </div>
                <div class="col-xs-6">
                    <template v-if="registro.id_protocolo">
                        <a class="btn btn-success btn-block" :disabled="requireds" @click="update(registro.id_protocolo)">Editar</a>
                    </template>
                    <template v-else>
                        <a class="btn btn-success btn-block" :disabled="requireds" @click="create">Inserir</a>
                    </template>
                </div>
            </div>
        </Modal>   
    </v-tab>
</template>

<script>
import Modal from '../Vuestrap/Modal.vue'
import Label from '../Form/Label.vue'
import {TheMask} from 'vue-the-mask'

export default {
    components: { Modal, Label, TheMask},
    props:['rg'],
    data() {
        return {
            module: 'protocolo',
            permission: 'protocolo',
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
        this.canCreate = this.$root.hasPermission(`criar-${this.permission}`)
        this.canEdit = this.$root.hasPermission(`editar-${this.permission}`)
        this.canDelete = this.$root.hasPermission(`apagar-${this.permission}`)
        this.registro.rg_autor = this.$root.dadoSession(`rg`)
        this.registro.rg = this.rg
    },
    computed:{
        requireds(){
            if(this.registro.numero && this.registro.descricao_txt) return false
            return true
        },
        lenght(){
            if(this.registros) return Object.keys(this.registros).length
            return 0
            
        }
    },
    methods: {
        list(){
            let urlIndex = `${this.$root.baseUrl}api/${this.module}/list/${this.rg}`;
            if(this.rg){
                axios
                .get(urlIndex)
                .then((response) => {
                    this.registros = response.data
                })
                .catch(error => console.log(error));
            }
        },
        create(){
            let urlCreate = `${this.$root.baseUrl}api/${this.module}/store`;
            axios
            .post(urlCreate, this.registro)
            .then((response) => {
                this.transation(response.data.success, 'create')
            })
            .catch(error => console.log(error));
            this.showModal = false
            
        },
        edit(registro){
            this.registro = registro
            this.showModal = true
        },
        update(id){
            let urlUpdate = `${this.$root.baseUrl}api/${this.module}/update/${id}`;
            axios
            .put(urlUpdate, this.registro)
            .then((response) => {
                this.transation(response.data.success, 'edit')
            })
            .catch(error => console.log(error));
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
                    this.registro = []
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