<template>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h2 v-if="registro.opm_nome_por_extenso" class="box-title">{{registro.opm_nome_por_extenso}}</h2>
                    <h2 v-else class="box-title">Dados cadastrais da Unidade </h2>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                            <i class="fa fa-plus"></i>
                        </button> 
                    </div>             
                </div>
                <div class="box-body">
                    <div class="col-md-12 col-xs-12"> 
                        <v-label lg="6" md="6" label="opm_intermediaria_cdopm" title="OM Interm.">
                            <select class="form-control" v-model="registro.opm_intermediaria_cdopm">
                                <option value="0">CG</option>
                                <option value="010">SUBCG</option>
                                <option value="1">EM</option>
                                <option value="2">1CRPM</option>
                                <option value="3">2CRPM</option>
                                <option value="4">3CRPM</option>
                                <option value="5">4CRPM</option>
                                <option value="6">5CRPM</option>
                                <option value="7">6CRPM</option>
                                <option value="9">CCB</option>
                            </select>
                        </v-label>
                        <v-label lg="6" md="6" label="opm_intermediaria_nome_por_extenso" title="Nome da Unidade Intermediaria por extenso">
                            <input size="45" class="form-control" v-model="registro.opm_intermediaria_nome_por_extenso" type="text">	
                        </v-label>
                        <v-label lg="6" md="6" label="opm_nome_por_extenso" title="Nome da Unidade por extenso">
                            <input size="45" class="form-control" v-model="registro.opm_nome_por_extenso" type="text">	
                        </v-label>
                        <v-label lg="6" md="6" label="id_municipio" title="Municipio">
                            <v-municipio :id_municipio="registro.id_municipio" v-model="registro.id_municipio"></v-municipio>
                        </v-label>
                        <v-label label="opm_autoridade_rg" title="RG">
                            <input size="45" class="form-control" v-model="registro.opm_autoridade_rg" @keyup="dadosPM" type="text">	
                        </v-label>
                        <v-label label="opm_autoridade_nome" title="Comandante/Chefe/Diretor">
                            <input size="45" class="form-control" v-model="registro.opm_autoridade_nome" readonly type="text">	
                        </v-label>
                        <v-label label="opm_autoridade_funcao" title="Função">
                            <input size="45" class="form-control" v-model="registro.opm_autoridade_funcao" type="text">	
                        </v-label>
                        <div class="col-xs-12">
                            <template v-if="canCreate">
                                <v-tooltip effect="scale" placement="top" :content="msgRequired">
                                    <a v-if="registro.id_cadastroopmcoger" class="btn btn-success btn-block" :disabled="requireds" @click.prevent="update(registro.id_cadastroopmcoger)">Editar</a>
                                    <a v-else class="btn btn-success btn-block" :disabled="requireds" @click="create">Inserir</a>
                                </v-tooltip>
                            </template>
                        </div>
                    </div> 
                </div>   
            </div>
        </div> 
        <template v-if="registro.id_cadastroopmcoger">
            <v-outras-autoridades :id_cadastroopmcoger="registro.id_cadastroopmcoger"></v-outras-autoridades>
        </template>
    </div>
</template>

<script>

export default {
    data() {
        return {
            module: 'cadastroopm',
            om: '',
            registro: {},
            canCreate: false,
            canEdit: false,
        }
    },
    created(){
        this.om = this.$root.dadoSession('cdopmbase')
        this.rg = this.$root.dadoSession('rg')
        this.canCreate = this.$root.hasPermission('criar-dados-unidade')
        this.canEdit = this.$root.hasPermission('editar-dados-unidade')
        this.get()
    },
    computed:{
        requireds(){
            if(this.registro.opm_nome_por_extenso && this.registro.opm_autoridade_rg) return false
            return true
        },
        msgRequired(){
            return `Para liberar este botão os campos: NOME DA UNIDADE e RG deve estar preenchidos`           
        }
    },
    methods: {
        get(){
            let urlIndex = `${this.$root.baseUrl}api/${this.module}/get/${this.om}`;
            if(this.om){
                axios
                .get(urlIndex)
                .then((response) => {
                    this.registro = response.data[0]
                })
                .catch(error => console.log(error));
            }
        },
        toCreate(){
            this.showModal = true
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
            if(this.registro.opm_autoridade_rg.length > 3){
                let urlSearch = `${this.$root.baseUrl}api/dados/pm/${this.registro.opm_autoridade_rg}`;
                axios
                .get(urlSearch)
                .then((response) => {
                    console.log(response.data.pm)
                    let res = response.data.pm
                    this.registro.opm_autoridade_cargo = res.CARGO
                    this.registro.opm_autoridade_quadro = res.QUADRO
                    this.registro.opm_autoridade_subquadro = res.SUBQUADRO

                    let cargolimpo = this.$root.formatUcwords(res.CARGO)
                    console.log(cargolimpo)
                    let quadro = this.registro.opm_autoridade_quadro
                    let nomelimpo = this.$root.formatUcwords(res.NOME)
                    this.registro.opm_autoridade_nome = `${cargolimpo}. ${quadro} ${nomelimpo}`
                    
                    // this.registro.origem_opm = response.data.opm
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