<template>
    <div class="col-lg-12 col-md-12 col-xs-12 card">
        <div class="card-header">
            <h5><b>Sobrestamento</b></h5> 
        </div>
        <div class="card-body" :class="add ? 'bordaform' : ''" v-if="!only && !show">
            <div v-if="!add">
                <button @click="add = !add" class="btn btn-success btn-block"><i class="fa fa-plus"></i> Adicionar sobrestamento</button>
            </div>
            <div v-else>
                <div id="ligacaoForm1" class="row">
                    <form id="formSobrestamento" name="formSobrestamento">
                        <input type="hidden" name="procc" :value="dproc">
                        <input type="hidden" :name="'id_'+dproc" :value="idp">
                        <input type="hidden" name="rg" :value="rg">
                        <!-- linha motivo -->
                        <div :class="outros">
                            <label for="data">Motivo</label><br>
                            <select name="motivo" v-model="motivo" class="form-control">
                                <option v-for="(m, index) in motivos" :value="m" :key="index" :selected="m == motivo">{{m}}</option>
                            </select>
                        </div>
                        <div v-if="motivo == 'outros'" class="col-lg-6 col-md-6 col-xs-6">
                            <label for="data">Motivo outros</label><br>
                            <input class="form-control" v-model="motivo_outros" type="text" name="motivo">
                        </div>
                        <!-- linha início -->
                        <div class="col-lg-4 col-md-4 col-xs-4">
                            <label for="inicio_data">Data de início</label><br>
                            <v-datepicker name="inicio_data" v-model="inicio_data" placeholder="dd/mm/aaaa" clear-button required></v-datepicker>
                        </div>
                        <div class="col-lg-4 col-md-4 col-xs-4">
                            <label for="doc_controle_inicio">N° Documento</label><br>
                            <input class="form-control" type="text" v-model="doc_controle_inicio" name="doc_controle_inicio" placeholder="Ex: Despacho n° 2.144/2018">
                        </div>
                        <div class="col-lg-4 col-md-4 col-xs-4">
                            <label for="publicacao_inicio">Publicação início</label><br>
                            <input class="form-control" type="text" v-model="publicacao_inicio" name="publicacao_inicio" placeholder="Ex: Despacho n° 2.144/2018">
                        </div>
                        <!-- linha termino -->
                        <div class="col-lg-4 col-md-4 col-xs-4">
                            <label for="termino_data">Data de Término</label><br>
                            <v-datepicker name="termino_data" v-model="termino_data" placeholder="dd/mm/aaaa" clear-button></v-datepicker>
                        </div>
                        <div class="col-lg-4 col-md-4 col-xs-4">
                            <label for="doc_controle_termino">N° Documento</label><br>
                            <input class="form-control" type="text" v-model="doc_controle_termino" name="doc_controle_termino" placeholder="Ex: Despacho n° 2.144/2018">
                        </div>
                        <div class="col-lg-4 col-md-4 col-xs-4">
                            <label for="publicacao_termino">Publicação Término</label><br>
                            <input class="form-control" type="text" v-model="publicacao_termino" name="publicacao_termino" placeholder="Ex: Despacho n° 2.144/2018">
                        </div>
                        <!-- acoes -->
                        <div class="col-lg-6 col-md-6 col-xs-6">
                            <label>Cancelar</label><br>
                            <a class="btn btn-danger btn-block" @click="clear(false)"><i class="fa fa-times" style="color: white"></i></a>
                        </div>
                        <div class="col-lg-6 col-md-6 col-xs-6">
                             <template v-if="toEdit">
                                <label>Editar</label><br>
                                <a class="btn btn-success btn-block" :disabled="!motivo || (motivo == 'outros' && !motivo_outros.length)" @click="editSobrestamento"><i class="fa fa-plus" style="color: white"></i></a>
                            </template>
                            <template v-else>
                                <label>Adicionar</label><br>
                                <a class="btn btn-success btn-block" :disabled="!motivo || (motivo == 'outros' && !motivo_outros.length)" @click="createSobrestamento"><i class="fa fa-plus" style="color: white"></i></a>
                            </template>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="card-footer"> 
            <div class="row bordaform" v-if="sobrestamentos.length">
                <div class="col-sm-12">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th class="col-sm-2">#</th>
                                <th class="col-sm-1">Início</th>
                                <th class="col-sm-2">Doc.Início</th>
                                <th class="col-sm-1">Término</th>
                                <th class="col-sm-2">Doc.Término</th>
                                <th class="col-sm-2">Motivo</th>
                                <template v-if="!show">
                                    <th v-if="isAdmin" class="col-sm-2">Editar/Apagar</th>
                                    <th v-else class="col-sm-2">Editar</th>
                                </template>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(sobrestamento, index) in sobrestamentos" :key="index">
                                <td>{{ index + 1 }}</td>
                                <td>{{ sobrestamento.inicio_data}}</td>
                                <td>{{ sobrestamento.doc_controle_inicio }}</td>
                                <td>{{ sobrestamento.termino_data}}</td>
                                <td>{{ sobrestamento.doc_controle_termino}}</td>
                                <td v-if="sobrestamento.motivo !== 'outros'">{{ sobrestamento.motivo }}</td>
                                <td v-else>{{ sobrestamento.motivo_outros }}</td>
                                <td v-if="!show">
                                    <div class="btn-group" role="group" aria-label="First group">
                                        <a type="button"  @click="replaceSobrestamento(sobrestamento)" class="btn btn-success" style="color: white">
                                            <i class="fa fa-edit"></i> 
                                        </a>
                                        <a v-if="isAdmin" type="button"  @click="removeSobrestamento(sobrestamento.id_sobrestamento, index)" class="btn btn-danger" style="color: white">
                                            <i class="fa fa-trash"></i> 
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>  
             <div v-if="!sobrestamentos.length && only">
                <h6>Não há registtros</h6>
            </div> 
        </div>
    </div>
</template>

<script>
    import mixin from '../../mixins.js'
    import {Datepicker} from '../Vuestrap/Datepicker'
    export default {
        mixins: [mixin],
        components: {Datepicker},
        props: {
            show: {type: Boolean, default: false},
            unique: {type: Boolean, default: false},
            idp: {type: String, default: ''},
            dproc: {type: String, default: ''},
        },
        data() {
            return {
                motivo: '',
                motivo_outros: '',
                inicio_data: '',
                doc_controle_inicio: '',
                publicacao_inicio: '',
                termino_data: '',
                doc_controle_termino: '',
                publicacao_termino: '',
                sobrestamentos: [],
                motivos: [
                    'Férias Acusado',
                    'Férias Comissão',
                    'Incidente de Insanidade',
                    'Substituição',
                    'Laudos/Perícia',
                    'Deslinde Criminal',
                    'outros',
                ],
                only: false,
                toEdit: '',
                rg: '',
                add: false,
            }
        },
        mounted(){
            this.verifyOnly
            this.listSobrestamento()
            this.rg = this.$root.dadoSession('rg')
        },
        computed:{
            verifyOnly(){     
                if(this.unique == true){
                    this.only = true
                }else{
                    this.only = false
                }      
            },
            outros(){
                let outros = this.motivo !== 'outros' ? 'col-lg-12 col-md-12 col-xs-12' : 'col-lg-6 col-md-6 col-xs-6'
                return outros
            },
            isAdmin(){
                return this.$root.hasRole('admin')
            },
        },
        methods: {
            listSobrestamento(){
                let urlIndex = `${this.$root.baseUrl}api/sobrestamento/list/${this.dproc}/${this.idp}`;
                if(this.dproc && this.idp){
                    axios
                    .get(urlIndex)
                    .then((response) => {
                        this.sobrestamentos = response.data
                        // console.log(response.data)
                    })
                    .then(this.clear(false))//limpa a busca
                    .catch(error => console.log(error));
                }
            },
            createSobrestamento(){
                let urlCreate = `${this.$root.baseUrl}api/sobrestamento/store`

                let formSobrestamento = document.getElementById('formSobrestamento');
                let data = new FormData(formSobrestamento);
                
                axios.post( urlCreate,data)
                .then((response) => this.transation(response.data.success, 'create'))
                .catch((error) => console.log(error));
            },
            replaceSobrestamento(sobrestamento){
                console.table(sobrestamento)
                this.motivo = sobrestamento.motivo,
                this.motivo_outros = sobrestamento.motivo_outros,
                this.inicio_data = sobrestamento.inicio_data,
                this.doc_controle_inicio = sobrestamento.doc_controle_inicio,
                this.publicacao_inicio = sobrestamento.publicacao_inicio,
                this.termino_data = sobrestamento.termino_data,
                this.doc_controle_termino = sobrestamento.doc_controle_termino,
                this.publicacao_termino = sobrestamento.publicacao_termino,
                this.toEdit = sobrestamento.id_sobrestamento

                // this.titleSubstitute=" - Substituição do "+pm.situacao+" "+pm.nome
                this.add = true
            },
            editSobrestamento(){
                let urledit = `${this.$root.baseUrl}api/sobrestamento/edit/${this.toEdit}`

                let formData = document.getElementById('formSobrestamento');
                let data = new FormData(formData);
                
                axios.post( urledit,data)
                .then((response) => this.transation(response.data.success, 'edit'))
                .catch((error) => console.log(error));
            },
            removeSobrestamento(id, index){
                if(confirm('Você tem certeza?')){
                    let urlDelete = `${this.$root.baseUrl}api/sobrestamento/destroy/${id}`
                    axios
                    .delete(urlDelete)
                    .then((response) => this.transation(response.data.success, 'delete'))
                    .catch(error => console.log(error));
                }
            },
            clear(add){
                this.add = add
                this.motivo = '',
                this.motivo_outros = '',
                this.inicio_data = '',
                this.doc_controle_inicio = '',
                this.publicacao_inicio = '',
                this.termino_data = '',
                this.doc_controle_termino = '',
                this.publicacao_termino = '',
                this.toEdit = ''
            },
            transation(happen,type) {
                let msg = this.words(type)
                if(happen) { // se deu certo
                        this.listSobrestamento()
                        this.$root.msg(msg.success,'success')
                        this.registro = null
                        this.clear(false)
                } else { // se falhou
                    this.$root.msg(msg.fail,'danger')
                }
            },
            words(type) {
                if(type == 'create') return { success : 'Inserido com sucesso', fail: 'Erro ao inserir'}
                if(type == 'edit') return { success : 'Editado com sucesso', fail: 'Erro ao editar'}
                if(type == 'delete') return { success : 'Apagado com sucesso', fail: 'Erro ao apagar'}
            }
        },
    }
</script>

<style scoped>

</style>