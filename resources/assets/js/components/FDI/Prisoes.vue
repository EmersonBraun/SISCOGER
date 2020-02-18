<template>
    <v-tab header="Prisões" :badge="lenght">
            <table class="table table-striped">
                <template v-if="lenght">
                    <thead>
                         <tr>
                            <th class="col-xs-1">Início</th>
                            <th class="col-xs-1">Fim</th>
                            <th class="col-xs-2">Processo</th>
                            <th class="col-xs-2">Complemento</th>
                            <th class="col-xs-2">Comarca</th>
                            <th class="col-xs-2">Vara</th>
                            <th class="col-xs-2">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="registro in registros" :key="registro.id_preso">
                            <td>{{ registro.inicio_data }}</td>
                            <td>{{ registro.fim_data | fimPrisao}}</td>
                            <td>{{ registro.processo }}</td>
                            <td>{{ registro.complemento }}</td>
                            <td>{{ registro.comarca }}</td>
                            <td>{{ registro.vara }}</td>
                            <td>
                                <span>
                                    <template v-if="canEdit">
                                        <a class="btn btn-info" @click="edit(registro)"><i class="fa fa-fw fa-edit "></i></a>
                                    </template>
                                    <template v-if="canDelete">
                                        <a class="btn btn-danger" @click="destroy(registro.id_preso)"><i class="fa fa-fw fa-trash-o "></i></a>
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
                <i class="fa fa-plus"></i>Adicionar Prisão
            </a>
        </template>
        <!-- form -->
        <Modal v-model="showModal" large effect="fade" width="70%">
            <input type="hidden" name="id" v-model="registro.id_preso">
            <div slot="modal-header" class="modal-header">
                <h4 class="modal-title">
                    <b v-if="registro.id_preso">Editar prisão</b>
                    <b v-else>Inserir nova prisão</b>
                </h4>
            </div>
            <div slot="modal-body">
                 <Label label="rg" title="RG">
                    <input class="form-control" type="text" size="12" maxlength="25" readonly="" v-model="registro.rg">
                </Label>
                <Label label="cargo" title="Posto/Grad.">
                    <input class="form-control" type="text" size="6" maxlength="10" readonly="" v-model="registro.cargo">
                </Label>
                <Label label="nome" title="Nome">
                    <input class="form-control" type="text" size="40" readonly="" v-model="registro.nome">
                </Label>
                <v-label label="cdopm_quandopreso" title="OPM">
                    <Opm name='cdopm_quandopreso' required :cdopm="registro.cdopm_quandopreso" v-model="registro.cdopm_quandopreso"></Opm>
                </v-label>
                <v-label label="local" title="Local de reclusão/detenção">
                    <select class="form-control" v-model="registro.local" required>
                        <option value="quartel">Quartel</option>
                        <option value="civil">Órgãos civis</option>
                    </select>
                </v-label>
                <template v-if="registro.local == 'quartel'">
                    <v-label label="cdopm_prisao" title="Quartel onde o policial está preso" >
                        <Opm name='cdopm_prisao' :cdopm="registro.cdopm_prisao" v-model="registro.cdopm_prisao"></Opm>
                    </v-label>
                </template>
                <template id='civil' style="display:none">
                    <v-label label="localreclusao" title="Local onde o policial está preso" tooltip="Ex: COCT II" >
                        <input class="form-control" type="text" v-model="registro.localreclusao">
                    </v-label>
                </template>
                <v-label label="origem_proc" title="Procedimento vinculado">
                    <select class="form-control" v-model="registro.origem_proc">
                        <option value="ipm">IPM</option>
                        <option value="sindicancia">Sindicância</option>
                        <option value="cd">CD</option>
                        <option value="cj">CJ</option>
                        <option value="apfdc">APFDC</option>
                        <option value="apfdm">APDM</option>
                        <option value="fatd">FATD</option>
                        <option value="iso">ISO</option>
                        <option value="desercao">Deserção</option>
                        <option value="it">IT</option>
                        <option value="adl">ADL</option>
                        <option value="pad">PAD</option>
                        <option value="sai">SAI</option>
                        <option value="proc_outros">Proc. Outros</option>
                    </select>
                </v-label>
                <v-label label="origem_sjd_ref" title="Referência">
                    <the-mask mask="###" class="form-control" type="text" v-model="registro.origem_sjd_ref" placeholder="Só números" @keyup.native="searchProc"/>
                </v-label>
                <v-label label="origem_sjd_ref_ano" title="Ano">
                    <the-mask mask="####" class="form-control" type="text" v-model="registro.origem_sjd_ref_ano" placeholder="Só números" @keyup.native="searchProc"/>
                </v-label>
                <v-label label="origem_opm" title="OPM de origem">
                    <input class="form-control" type="text" v-model="registro.origem_opm" readonly>
                </v-label>
                <v-label label="processo" title="Processo, Nº do processo - Comarca." tooltip="Ex: Ação Penal Militar nº 2010.0000XXX-X - Curitiba">
                    <input class="form-control" type="text" v-model="registro.processo">
                </v-label>
                <v-label label="complemento" title="Artigos da Infração penal" tooltip="Ex: Art. 121 § 2º CP" >
                    <input class="form-control" type="text" v-model="registro.complemento">
                </v-label>
                <v-label label="numeromandado" title="Nº do mandado de prisão, se houver" tooltip="Ex: 000183216-55">
                    <input class="form-control" type="text" v-model="registro.numeromandado">
                </v-label>
                <v-label label="id_presotipo" title="Tipo da prisão">
                    <select class="form-control" v-model="registro.id_presotipo">
                        <option value="1">Flagrante</option>
                        <option value="2">Preventiva</option>
                        <option value="3">Temporária</option>
                        <option value="4">Condenação</option>
                        <option value="5">Menagem</option>
                        <option value="6">Deserção</option>
                    </select>
                </v-label>
                <v-label label="vara" title="Vara" tooltip="Ex: 3ª Vara Criminal">
                    <input class="form-control" type="text" v-model="registro.vara">
                </v-label>
                <v-label label="comarca" title="Comarca" tooltip="Ex: Curitiba">
                    <input class="form-control" type="text" v-model="registro.comarca">
                </v-label>
                <v-label label="inicio_data" title="Data de entrada na prisão" icon="fa fa-calendar">
                    <Datepicker :placeholder="registro.inicio_data" clear-button v-model="registro.inicio_data"></Datepicker>
                </v-label>
                <v-label label="fim_data" title="Data da saída da prisão" icon="fa fa-calendar">
                    <Datepicker :placeholder="registro.fim_data" clear-button v-model="registro.fim_data"></Datepicker>
                </v-label>
                <v-label label="obs_txt" title="Observações" lg="12" md="12">
                    <textarea  v-model="registro.obs_txt" id="foco" rows="5" cols="105" width="100%"></textarea>
                </v-label>
            </div>
            <div slot="modal-footer" class="modal-footer">
                <div class="col-xs-6">
                    <a class="btn btn-default btn-block" @click="showModal = false">Cancelar</a>
                </div>
                <div class="col-xs-6">
                    <v-tooltip effect="scale" placement="top" :content="msgRequired">
                        <a v-if="registro.id_preso" class="btn btn-success btn-block" :disabled="requireds" @click.prevent="update(registro.id_preso)">Editar</a>
                        <a v-else class="btn btn-success btn-block" :disabled="requireds" @click="create">Inserir</a>
                    </v-tooltip>
                </div>
            </div>
        </Modal>   
    </v-tab>
</template>

<script>
import {TheMask} from 'vue-the-mask'
import Modal from '../Vuestrap/Modal.vue'
import Tooltip from '../Vuestrap/Tooltip.vue'
import Datepicker from '../Vuestrap/Datepicker.vue'
import Label from '../Form/Label.vue'
import Opm from '../Form/OPM.vue'

export default {
    components: { TheMask, Modal, Label, Tooltip, Datepicker, Opm},
    props:['pm'],
    data() {
        return {
            module: 'preso',
            registros: [],
            registro: {},
            canCreate: false,
            canEdit: false,
            canDelete: false,
            showModal: false,
        }
    },
    filters: {
        fimPrisao(value) {
            if(!value) return 'Está preso'
        }
    },
    created(){
        this.list()
        this.canCreate = this.$root.hasPermission('criar-prisoes')
        this.canEdit = this.$root.hasPermission('editar-prisoes')
        this.canDelete = this.$root.hasPermission('apagar-prisoes')
    },
    computed:{
        requireds(){
            if(this.registro.local && this.registro.cdopm_quandopreso && this.registro.inicio_data) return false
            return true
        },
        lenght(){
            if(this.registros) return Object.keys(this.registros).length
            return 0 
        },
        msgRequired(){
            return `Para liberar este botão os campos: LOCAL, QUARTEL ONDE ESTÁ PRESO e DATA DE INÍCIO deve estar preenchidos`           
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
        toCreate(){
            this.showModal = true
            this.registro.rg = this.pm.RG
            this.registro.cargo = this.pm.CARGO
            this.registro.nome = this.pm.NOME
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
                    this.registro = {}
            } else { // se falhou
                this.$root.msg(msg.fail,'danger')
            }
        },
        words(type) {
            if(type == 'create') return { success : 'Inserido com sucesso', fail: 'Erro ao inserir'}
            if(type == 'edit') return { success : 'Editado com sucesso', fail: 'Erro ao editar'}
            if(type == 'delete') return { success : 'Apagado com sucesso', fail: 'Erro ao apagar'}
        },
        searchProc(){
            if(this.registro.origem_proc && this.registro.origem_sjd_ref && this.registro.origem_sjd_ref_ano){
                let proc = this.registro
                let urlSearch = `${this.$root.baseUrl}api/dados/proc/${proc.origem_proc}/${proc.origem_sjd_ref}/${proc.origem_sjd_ref_ano}`;
                axios
                .get(urlSearch)
                .then((response) => {
                    this.registro.origem_opm = response.data.opm
                })
                .catch(error => console.log(error));
            }
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