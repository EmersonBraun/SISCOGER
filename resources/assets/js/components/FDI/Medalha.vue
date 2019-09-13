<template>
    <v-tab header="Medalhas" :badge="lenght">
            <table class="table table-striped">
                <template v-if="lenght">
                    <thead>
                        <tr>
                            <th class="col-xs-2"><b>Medalha</b></th>
                            <th class="col-xs-2"><b>N° BI</b></th>
                            <th class="col-xs-2"><b>Data BI</b></th>
                            <th class="col-xs-4"><b>Descrição</b></th>
                            <th class="col-xs-2"><b>Ações</b></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(registro, index) in registros" :key="index">
                            <td>{{ registro.nome_medalha }}</td>
                            <td>{{ registro.bi_num }}</td>
                            <td>{{ registro.bi_data }}</td>
                            <td>{{ registro.obs_txt }}</td>
                            <td>
                                <span>
                                    <template v-if="canEdit">
                                        <a class="btn btn-info" @click="edit(registro)"><i class="fa fa-fw fa-edit "></i></a>
                                    </template>
                                    <template v-if="canDelete">
                                        <a class="btn btn-danger" @click="destroy(registro.id_medalha)"><i class="fa fa-fw fa-trash-o "></i></a>
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
                <i class="fa fa-plus"></i>Adicionar Medalha
            </a>
        </template>
        <!-- form -->
        <v-modal v-model="showModal" large effect="fade" width="65%">
            <input type="hidden" name="id" v-model="registro.id_medalha">
            <div slot="modal-header" class="modal-header">
                <h4 class="modal-title">
                    <b v-if="registro.id_medalha">Editar Medalha</b>
                    <b v-else>Inserir nova Medalha</b>
                </h4>
            </div>
            <div slot="modal-body">
                 <v-label lg="4" label="rg" title="RG">
                    <input class="form-control" type="text" size="12" maxlength="25" readonly="" v-model="registro.rg">
                </v-label>
                <v-label lg="4" label="cargo" title="Posto/Grad.">
                    <input class="form-control" type="text" size="6" maxlength="10" readonly="" v-model="registro.cargo">
                </v-label>
                <v-label lg="4" label="nome" title="Nome">
                    <input class="form-control" type="text" size="40" readonly="" v-model="registro.nome">
                </v-label>
                <v-label lg="4" label="nome_medalha" title="Nome da medalha">
                    <input v-model="registro.nome_medalha" class="form-control" type="text" size="40" maxlength="120">
                </v-label>
                <v-label lg="4" label="publicacao" title="N° BI" tooltip="Ex: BI nº 010/2011">
                    <input v-model="registro.bi_num" class="form-control" type="text" size="40" maxlength="120">
                </v-label>
                <v-label lg="4" label="data" title="Data BI">
                    <v-datepicker :placeholder="registro.bi_data" clear-button v-model="registro.bi_data"></v-datepicker>
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
                        <a v-if="registro.id_medalha" class="btn btn-success btn-block" :disabled="requireds" @click.prevent="update(registro.id_medalha)">Editar</a>
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
            module: 'medalha',
            registros: [],
            registro: {},
            punicoes: [],
            canCreate: false,
            canEdit: false,
            canDelete: false,
            showModal: false,
        }
    },
    created(){
        this.list()
        this.canCreate = this.$root.hasPermission('criar-medalhas')
        this.canEdit = this.$root.hasPermission('editar-medalhas')
        this.canDelete = this.$root.hasPermission('apagar-medalhas')
    },
    computed:{
        requireds(){
            if(this.registro.nome_medalha && this.registro.obs_txt) return false
            return true
        },
        lenght(){
            if(this.registros) return Object.keys(this.registros).length
            return 0 
        },
        msgRequired(){
            return `Para liberar este botão os campos: NOME DA MEDALHA e DESCRIÇÃO deve estar preenchidos`           
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
                    this.$emit('length',this.length)
                })
                .catch(error => console.log(error));
            }
        },
        toCreate(){
            this.showModal = true
            this.registro.rg_cadastro = this.$root.dadoSession('rg')
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