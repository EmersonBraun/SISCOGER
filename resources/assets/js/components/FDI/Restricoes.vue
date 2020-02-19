<template>
    <v-tab header="Restrições" :badge="lenght">
            <table class="table table-striped">
                <template v-if="lenght">
                    <thead>
                        <tr>
                            <th class="col-xs-4">Tipo</th>
                            <th class="col-xs-4">Início</th>
                            <th class="col-xs-4">Fim</th>
                            <th class="col-xs-4">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="registro in registros" :key="registro.id_restricao">
                            <td>
                                <b v-if="registro.arma_bl">Restricao de porte de arma de fogo.</b>
                                <b v-if="registro.fardamento_bl">Restricao de uso de fardamento.</b>
                            </td>
                            <td>{{ registro.inicio_data }}</td>
                            <td>
                                <template v-if="registro.fim_data == '' || !registro.retirada_data">
                                    <b style="color: red">Vigente</b>
                                </template>
                                <template v-else>
                                    {{ registro.retirada_data }}
                                </template>
                            </td>
                            <td>
                                <span>
                                    <template v-if="canEdit">
                                        <a class="btn btn-info" @click="edit(registro)"><i class="fa fa-fw fa-edit "></i></a>
                                    </template>
                                    <template v-if="canDelete">
                                        <a class="btn btn-danger" @click="destroy(registro.id_restricao)"><i class="fa fa-fw fa-trash-o "></i></a>
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
                <i class="fa fa-plus"></i>Adicionar Restrição
            </a>
        </template>
        <!-- form -->
        <v-modal v-model="showModal" large effect="fade" width="70%">
            <div slot="modal-header" class="modal-header">
                <h4 class="modal-title">
                    <b v-if="registro.id_restricao">Editar Restrição</b>
                    <b v-else>Inserir novo Restrição</b>
                </h4>
            </div>
            <div slot="modal-body">
                <input type="hidden" name="id" v-model="registro.id_restricao">
                <v-label label="rg" title="RG">
                    <input class="form-control" type="text" size="12" maxlength="25" readonly="" v-model="registro.rg">
                </v-label>
                <v-label label="cargo" title="Posto/Grad.">
                    <input class="form-control" type="text" size="6" maxlength="10" readonly="" v-model="registro.cargo">
                </v-label>
                <v-label label="nome" title="Nome">
                    <input class="form-control" type="text" size="40" readonly="" v-model="registro.nome">
                </v-label>
                <v-label label="check" title="Restrições: " md="12" lg="12">
                    <v-checkbox name="arma_bl" v-model="registro.arma_bl" true-value="S" false-value="0"
                    text="Restrição de Porte de arma de fogo">
                    </v-checkbox>
                    <v-checkbox name="fardamento_bl" v-model="registro.fardamento_bl" true-value="S" false-value="0"
                    text="Restrição de uso de fardamento">
                    </v-checkbox>
                </v-label>
                <v-label label="origem" title="Situação">
                    <select class="form-control" v-model="registro.origem">
                        <option value='Laudo medico'>Laudo médico</option>
                        <option value='Disciplinar/Criminal'>Sit. Disciplinar/Criminal</option>
                        <option value='Disparo'>Disparo Imprudente/Negligente</option>
                        <option value='Sob efeito alcool'>Porte sob efeito de alcool ou outra subst.</option>
                        <option value='Condenacao Punicao Disciplinar'>Condenação ou Punição Disciplinar</option>
                        <option value='Inapto Psicologico'>Inapto Avaliação Psicológica</option>
                    </select>
                </v-label>
                <v-label label="inicio_data" title="Início da restrição" icon="fa fa-calendar">
                    <v-datepicker name="inicio_data" :placeholder="registro.inicio_data" clear-button v-model="registro.inicio_data"></v-datepicker>
                </v-label>
                <v-label label="fim_data" title="Fim da restrição" icon="fa fa-calendar">
                    <v-datepicker name="fim_data" :placeholder="registro.fim_data" clear-button v-model="registro.fim_data"></v-datepicker>
                </v-label>
                <v-label label="obs_txt" title="Observações" lg="12" md="12" >
                    <textarea  v-model="registro.obs_txt" id="foco" rows="6" cols="105" width="100%"></textarea>
                </v-label>
                <v-label label="cadastro_data" title="Data de cadastro" lg="6" md="6">
                    <v-datepicker name="cadastro_data" :placeholder="registro.cadastro_data" clear-button v-model="registro.cadastro_data"></v-datepicker> 
                </v-label>
                <v-label label="retirada_data" title="Data de retirada das restrições" lg="6" md="6">
                    <v-datepicker name="retirada_data" :placeholder="registro.retirada_data" clear-button v-model="registro.retirada_data"></v-datepicker> 
                </v-label>
            </div>
            <div slot="modal-footer" class="modal-footer">
                <div class="col-xs-6">
                    <a class="btn btn-default btn-block" @click="showModal = false">Cancelar</a>
                </div>
                <div class="col-xs-6">
                    <v-tooltip effect="scale" placement="top" :content="msgRequired">
                        <a v-if="registro.id_restricao" class="btn btn-success btn-block" :disabled="requireds" @click.prevent="update(registro.id_restricao)">Editar</a>
                        <a v-else class="btn btn-success btn-block" :disabled="requireds" @click="create">Inserir</a>
                    </v-tooltip>
                </div>
            </div>
        </v-modal>   
    </v-tab>
</template>

<script>
import Modal from '../Vuestrap/Modal.vue'
import {TheMask} from 'vue-the-mask'

export default {
    components: { Modal, TheMask},
    props:['pm'],
    data() {
        return {
            module: 'restricao',
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
        this.canCreate = this.$root.hasPermission('criar-restricoes')
        this.canEdit = this.$root.hasPermission('editar-restricoes')
        this.canDelete = this.$root.hasPermission('apagar-restricoes')
    },
    computed:{
        requireds(){
            let restricao = this.registro.arma_bl || this.registro.fardamento_bl ? true : false
            if(this.registro.inicio_data && this.registro.origem && restricao) return false
            return true
        },
        lenght(){
            if(this.registros) return Object.keys(this.registros).length
            return 0    
        },
        msgRequired(){
            return `Para liberar este botão os campos: RESTRIÇÃO, SITUAÇÃO e DATA DE INÍCIO deve estar preenchidos`           
        }
    },
    methods: {
        list(){
            let urlIndex = `${this.$root.baseUrl}api/${this.module}/list/${this.pm.RG}`;
            if(this.pm.RG){
                axios
                .get(urlIndex)
                .then((response) => {
                    console.log(response.data)
                    this.registros = response.data
                })
                .catch(error => console.log(error));
            }
        },
        toCreate(){
            this.showModal = true
            this.registro.rg = this.pm.RG
            this.registro.cargo = this.pm.CARGO
            this.registro.nome = this.pm.NOME
            this.registro.fim_data = this.pm.FIM_DATA; 
            //this.registro.cadastro_data = '';
            //this.registro.retirada_data = '';

            
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