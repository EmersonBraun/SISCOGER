<template>
    <div>
            <table class="table table-striped">
                <template v-if="lenght">
                    <thead>
                        <tr>
                            <th class="col-xs-1"><b>Data</b></th>
                            <th class="col-xs-2"><b>Novo comportamento</b></th>
                            <th class="col-xs-5"><b>Sintese</b></th>
                            <th class="col-xs-2"><b>Publicacao</b></th>
                            <th class="col-xs-2"><b>Ações</b></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(registro, index) in registros" :key="index">
                            <td>{{ registro.data | date_br}}</td>
                            <td>{{ registro.comportamento }}</td>
                            <td>{{ registro.motivo_txt }}</td>
                            <td>{{ registro.publicacao }}</td>
                            <td>
                                <span>
                                    <template v-if="canEdit">
                                        <a class="btn btn-info" @click="edit(registro)"><i class="fa fa-fw fa-edit "></i></a>
                                    </template>
                                    <template v-if="canDelete">
                                        <a class="btn btn-danger" @click="destroy(registro.id_comportamentopm)"><i class="fa fa-fw fa-trash-o "></i></a>
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
                <i class="fa fa-plus"></i>Adicionar mudança de comportamento
            </a>
        </template>
        <!-- form -->
        <v-modal v-model="showModal" large effect="fade" width="65%">
            <input type="hidden" name="id" v-model="registro.id_comportamentopm">
            <div slot="modal-header" class="modal-header">
                <h4 class="modal-title">
                    <b v-if="registro.id_comportamentopm">Editar Comportamento</b>
                    <b v-else>Inserir novo Comportamento</b>
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
                <v-label lg="4" label="data" title="Data (Art. 63 RDE)">
                    <v-datepicker :placeholder="registro.data" clear-button v-model="registro.data"></v-datepicker>
                </v-label>
                <v-label lg="4" label="publicacao" title="Publicação" tooltip="Ex: BI nº 010/2011">
                    <input v-model="registro.publicacao" class="form-control" type="text" size="40" maxlength="120">
                </v-label>
                <v-label lg="4" label="publicacao" title="Novo Comportamento">
                    <select v-model="registro.id_comportamento" class="form-control">
                        <option value="0">Não se Aplica</option>
                        <option value="1">Excepcional</option>
                        <option value="2">Ótimo</option>
                        <option value="3">Bom</option>
                        <option value="4">Insuficiente</option>
                        <option value="5">Mau</option>
                    </select>
                </v-label>
                <v-label lg="6" label="motivo" title="Motivo" >
                    <select v-model="registro.motivo" v-if="registro.id_comportamento !== 0" class="form-control">
                        <option value="Selecione">Selecione</option>
                        <option value="Inclusao na PMPR">Inclusão na PMPR</option>
                        <option value="Punição Disciplinar">Punição Disciplinar</option>
                        <option value="Condenação">Condenação</option>
                        <option value='Alt. de comportamento - ART. 51 RDE. §7º I- do "Mau" para o "Insuficiente"'>Alt. de comportamento - ART. 51 RDE. §7º I- do "Mau" para o "Insuficiente"</option>
                        <option value='Alt. de comportamento - ART. 51 RDE. §7º II- do "Insuficiente" para o "Bom"'>Alt. de comportamento - ART. 51 RDE. §7º II- do "Insuficiente" para o "Bom"</option>
                        <option value='Alt. de comportamento - ART. 51 RDE. §7º III- do "Bom" para o "Otimo"'>Alt. de comportamento - ART. 51 RDE. §7º III- do "Bom" para o "Ótimo"</option>
                        <option value='Alt. de comportamento - ART. 51 RDE. §7º IV- do "Otimo" para o "Excepcional"'>Alt. de comportamento - ART. 51 RDE. §7º IV- do "Ótimo" para o "Excepcional"</option>
                        <option value='Cancelamento de Punicao - ART. 59 RDE.'>Cancelamento de Punicao - ART. 59 RDE.</option>
                    </select>
                    <select v-model="registro.motivo" v-else class="form-control">
                        <option value='Cancelamento de Punicao - ART. 59 RDE.'>Cancelamento de Punicao - ART. 59 RDE.</option>
                    </select>
                </v-label>
                <v-label lg="6" v-if="registro.motivo == 'Cancelamento de Punicao - ART. 59 RDE.'" label="punicao" title="Qual punição">
                    <select class="form-control" v-model="registro.id_punicao">
                        <option v-for="punicao in punicoes" :value="punicao.id_punicao" :key="punicao.id_punicao">
                            {{punicao.procedimento}}: {{punicao.sjd_ref}}/{{punicao.sjd_ref_ano}} {{punicao.descricao_txt | desc}}
                        </option>
                    </select>
                </v-label>
                <v-label label="obs_txt" title="Observações" lg="12" md="12">
                    <textarea  v-model="registro.motivo_txt" id="foco" rows="5" cols="105" width="100%"></textarea>
                </v-label>
            </div>
            <div slot="modal-footer" class="modal-footer">
                <div class="col-xs-6">
                    <a class="btn btn-default btn-block" @click="showModal = false">Cancelar</a>
                </div>
                <div class="col-xs-6">
                    <v-tooltip effect="scale" placement="top" :content="msgRequired">
                        <a v-if="registro.id_comportamentopm" class="btn btn-success btn-block" :disabled="requireds" @click.prevent="update(registro.id_comportamentopm)">Editar</a>
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
            module: 'comportamento',
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
        this.listPunicoes()
        this.canCreate = this.$root.hasPermission('criar-comportamento')
        this.canEdit = this.$root.hasPermission('editar-comportamento')
        this.canDelete = this.$root.hasPermission('apagar-comportamento')
    },
    filters: {
        desc(value) {
            if(!value) return ''
            let part = value.substring(0,25)
            return `(${part}...)`
        }
    },
    computed:{
        requireds(){
            if(this.registro.id_comportamento && this.registro.motivo && this.registro.motivo_txt) return false
            return true
        },
        lenght(){
            if(this.registros) return Object.keys(this.registros).length
            return 0 
        },
        msgRequired(){
            return `Para liberar este botão os campos: COMPORTAMENTO, MOTIVO e DESCRIÇÃO deve estar preenchidos`           
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
        listPunicoes(){
            if(this.pm.RG){
                let urlSearch = `${this.$root.baseUrl}api/fdi/punicoes/${this.pm.RG}`;
                axios
                .get(urlSearch)
                .then((response) => {
                    this.punicoes = response.data
                })
                .catch(error => console.log(error));
            }
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