<template>
    <div>
        <table class="table table-striped">
                <template v-if="lenght">
                    <thead>
                        <tr>
                            <th class="col-xs-1"><b>Data</b></th>
                            <th class="col-xs-2"><b>OPM</b></th>
                            <th class="col-xs-7"><b>Sintese</b></th>
                            <th class="col-xs-2"><b>Ações</b></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(registro, index) in registros" :key="index">
                            <td>{{ registro.elogio_data }}</td>
                            <td>{{ registro.opm_abreviatura }}</td>
                            <td>{{ registro.descricao_txt }}</td>
                            <td>
                                <span>
                                    <template v-if="canEdit">
                                        <a class="btn btn-info" @click="edit(registro)"><i class="fa fa-fw fa-edit "></i></a>
                                    </template>
                                    <template v-if="canDelete">
                                        <a class="btn btn-danger" @click="destroy(registro.id_elogio)"><i class="fa fa-fw fa-trash-o "></i></a>
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
                <i class="fa fa-plus"></i>Adicionar Elogio
            </a>
        </template>
        <!-- form -->
        <v-modal v-model="showModal" large effect="fade" width="70%">
            <input type="hidden" name="id" v-model="registro.id_elogio">
            <div slot="modal-header" class="modal-header">
                <h4 class="modal-title">
                    <b v-if="registro.id_elogio">Editar Elogio</b>
                    <b v-else>Inserir novo Elogio</b>
                </h4>
            </div>
            <div slot="modal-body">
                 <v-label label="rg" title="RG">
                    <input class="form-control" type="text" size="12" maxlength="25" readonly="" v-model="registro.rg">
                </v-label>
                <v-label label="cargo" title="Posto/Grad.">
                    <input class="form-control" type="text" size="6" maxlength="10" readonly="" v-model="registro.cargo">
                </v-label>
                <v-label label="nome" title="Nome">
                    <input class="form-control" type="text" size="40" readonly="" v-model="registro.nome">
                </v-label>
                <v-label label="elogio_data" title="Data da publicação do elogio">
                    <v-datepicker :placeholder="registro.elogio_data" clear-button v-model="registro.elogio_data"></v-datepicker>
                </v-label>
                <v-label label="publicacao" title="Publicação" tooltip="Ex: BI nº 010/2011">
                    <input v-model="registro.publicacao" class="form-control" type="text" size="40" maxlength="120">
                </v-label>
                <v-label label="opm" title="OPM do elogio">
                   <v-opm name='cdopm' :cdopm="registro.cdopm" v-model="registro.cdopm"></v-opm> 
                </v-label>
                <v-label label="descricao_txt" title="Descrição" lg="12" md="12">
                    <textarea  v-model="registro.descricao_txt" id="foco" rows="5" cols="105" width="100%"></textarea>
                </v-label>
            </div>
            <div slot="modal-footer" class="modal-footer">
                <div class="col-xs-6">
                    <a class="btn btn-default btn-block" @click="showModal = false">Cancelar</a>
                </div>
                <div class="col-xs-6">
                    <v-tooltip effect="scale" placement="top" :content="msgRequired">
                        <a v-if="registro.id_elogio" class="btn btn-success btn-block" :disabled="requireds" @click.prevent="update(registro.id_elogio)">Editar</a>
                        <a v-else class="btn btn-success btn-block" :disabled="requireds" @click="create">Inserir</a>
                    </v-tooltip>
                </div>
            </div>
        </v-modal>   
    </div>
</template>

<script>
export default {
    props:['pm'],
    data() {
        return {
            module: 'elogio',
            registros: [],
            registro: {},
            punicoes: [],
            canCreate: false,
            canEdit: false,
            canDelete: false,
            showModal: false,
            rg: '',
            nome: ''
        }
    },
    created(){
        this.list()
        this.canCreate = this.$root.hasPermission('criar-elogio')
        this.canEdit = this.$root.hasPermission('editar-elogio')
        this.canDelete = this.$root.hasPermission('apagar-elogio')
        this.rg = this.$root.dadoSession('rg')
        this.nome = this.$root.dadoSession('nome')
    },
    watch: {
        lenght() {
            this.$root.$emit('length',this.length)
        }
    },
    computed:{
        requireds(){
            if(this.registro.elogio_data && this.registro.descricao_txt) return false
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
                .catch(error => console.log(error));
            }
        },
        toCreate(){
            this.showModal = true
            this.registro.rg = this.pm.RG
            this.registro.cargo = this.pm.CARGO
            this.registro.nome = this.pm.NOME
            this.registro.rg_cadastro = this.rg
            this.registro.digitador = this.nome
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
            this.registro.rg_cadastro = this.rg
            this.registro.digitador = this.nome
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
        listPunicoes(){
            // if(this.registro.origem_proc && this.registro.origem_sjd_ref && this.registro.origem_sjd_ref_ano){
            //     let proc = this.registro
            //     let urlSearch = `${this.$root.baseUrl}api/dados/proc/${proc.origem_proc}/${proc.origem_sjd_ref}/${proc.origem_sjd_ref_ano}`;
            //     axios
            //     .get(urlSearch)
            //     .then((response) => {
            //         this.registro.origem_opm = response.data.opm
            //     })
            //     .catch(error => console.log(error));
            // }
            return true
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