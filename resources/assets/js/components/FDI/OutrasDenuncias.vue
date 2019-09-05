<template>
    <v-tab header="Outras Denúncias" :badge="lenght">
        <table class="table table-striped">
            <template v-if="lenght">
                <thead>
                    <tr>
                        <th class="col-xs-2">N° Denúncia</th>
                        <th class="col-xs-4">Processo crime</th>
                        <th class="col-xs-2">Julgamento</th>
                        <th class="col-xs-2">Trânsito em julgado</th>
                        <th class="col-xs-2">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="registro in registros" :key="registro.id_denunciacivil">
                        <td>{{ registro.processo }}</td>
                        <td><b>{{ registro.processocrime }}</b></td>
                        <td> 
                            <b v-if="registro.julgamento">{{ registro.julgamento }}</b> 
                            <b v-else> Não cadastrado </b> 
                        </td>
                        <td> 
                            <b v-if="registro.transitojulgado_bl">Sim</b> 
                            <b v-else> Não </b> 
                        </td>
                        <td>
                            <span>
                                <template v-if="canEdit">
                                    <a class="btn btn-info" @click="edit(registro)"><i class="fa fa-fw fa-edit "></i></a>
                                </template>
                                <template v-if="canDelete">
                                    <a class="btn btn-danger" @click="destroy(registro.id_denunciacivil)"><i class="fa fa-fw fa-trash-o "></i></a>
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
                <i class="fa fa-plus"></i>Adicionar Denúncia
            </a>
        </template>
        <!-- form -->
        <Modal v-model="showModal" large effect="fade">
            <div slot="modal-header" class="modal-header">
                <h4 class="modal-title"><b>Inserir nova Denúncia</b></h4>
            </div>
            <div slot="modal-body">
                <input type="hidden" name="id" v-model="registro.id_denunciacivil">
                <Label label="rg" title="RG">
                    <input class="form-control" type="text" size="12" maxlength="25" readonly="" v-model="registro.rg">
                </Label>
                <Label label="cargo" title="Posto/Grad.">
                    <input class="form-control" type="text" size="6" maxlength="10" readonly="" v-model="registro.cargo">
                </Label>
                <Label label="nome" title="Nome">
                    <input class="form-control" type="text" size="40" readonly="" v-model="registro.nome">
                </Label>

                <Label label="processo" title="Processo, Nº do processo - Comarca" tooltip="Ex: Ação Penal Militar nº 2010.0000XXX-X - Curitiba">
                    <input class="form-control" type="text" v-model="registro.processo">
                </Label>
                <Label label="infracao" title="Artigo, Lei e Infração Penal" tooltip="Ex: Art. 121, Código Penal, Homicídio">
                    <input class="form-control" type="text" v-model="registro.infracao">
                </Label>
                <Label label="processocrime" title="Processo Crime">
                    <select class="form-control" v-model="registro.processocrime">
                        <option rel="none" value="">Selecione</option>
                        <option rel="foicondenado" value="Condenado">Condenado</option>
                        <option rel="none" value="Absolvido">Absolvido</option>
                    </select>
                </Label>
                <Label lg="6" label="julgamento" title="Julgamento">
                    <select class="form-control" v-model="registro.julgamento">
                        <option rel="none" value="">Selecione</option>
                        <option rel="foicondenado" value="Condenado">Condenado</option>
                        <option rel="none" value="Absolvido">Absolvido</option>
                    </select>
                </Label>
                <Label lg="6" label="transitojulgado_bl" >
                    <Checkbox v-model="registro.transitojulgado_bl" true-value="S" text="Transitou em julgado?"></Checkbox>
                </Label>
                <template v-if="registro.julgamento == 'Condenado'">
                    <Label label="pena_anos" title="Pena Anos">
                        <the-mask mask="##" class="form-control" type="text" v-model="registro.pena_anos" />
                    </Label>
                    <Label label="pena_meses" title="Pena Meses">
                        <the-mask mask="##" class="form-control" type="text" v-model="registro.pena_meses" />
                    </Label>
                    <Label label="pena_dias" title="Pena Dias">
                        <the-mask mask="##" class="form-control" type="text" v-model="registro.pena_dias" />
                    </Label>
                    <Label label="tipodapena" title="Tipo da pena">
                        <select class="form-control" v-model="registro.tipodapena">
                            <option value="">Selecione</option>
                            <option value="Detencao">Detenção</option>
                            <option value="Reclusao">Reclusão</option>
                        </select>
                    </Label>
                    <Label label="restritiva_bl" >
                        <Checkbox v-model="registro.restritiva_bl" true-value="S" text="Restritiva de direito?"></Checkbox>
                    </Label>
                </template>
                <Label lg="12" label="descricao_txt" title="Obsercações" tooltip="Exemplo: Lei N. 9455/97 - TORTURA. par. 1, inciso I, alinea a. Data da denuncia: xx/xx/xx, transitou em julgado em xx/xx/xx">
                    <textarea  v-model="registro.obs_txt" id="foco" rows="6" cols="105" width="100%"
                    placeholder="Artigo da sentença da condenação, data da denúncia, data do trânsito em julgado e outros complementos"></textarea>
                </Label>
            </div>
            <div slot="modal-footer" class="modal-footer">
                <div class="col-xs-6">
                    <a class="btn btn-default btn-block" @click="showModal = false">Cancelar</a>
                </div>
                <div class="col-xs-6">
                    <template v-if="registro.id_denunciacivil">
                        <a class="btn btn-success btn-block" :disabled="requireds" @click="update(registro.id_denunciacivil)">Editar</a>
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
import Checkbox from '../Vuestrap/Checkbox.vue'

export default {
    components: { Modal, Label, TheMask, Checkbox},
    props:['pm'],
    data() {
        return {
            module: 'denuncia',
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
        this.canCreate = this.$root.hasPermission('criar-outras-denuncia')
        this.canEdit = this.$root.hasPermission('editar-outras-denuncia')
        this.canDelete = this.$root.hasPermission('apagar-outras-denuncia')
        this.registro.rg = this.pm.RG
        this.registro.cargo = this.pm.CARGO
        this.registro.nome = this.pm.NOME
    },
    computed:{
        requireds(){
            if(this.registro.obs_txt) return false
            return true
        },
        lenght(){
            if(this.registros) return Object.keys(this.registros).length
            return 0
            
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