<template>
    <div class="col-lg-12 col-md-12 col-xs-12 card">
        <div class="card-header">
            <h5><b>Movimentos</b></h5> 
        </div>
        <div class="card-body" :class="add ? 'bordaform' : ''" v-if="!only">
            <div v-if="!add">
                <button @click="add = !add" class="btn btn-success btn-block"><i class="fa fa-plus"></i> Adicionar movimento</button>
            </div>
            <div v-else>
                <div id="ligacaoForm1" class="row">
                    <form id="formMovimento" name="formMovimento">
                        <input type="hidden" :name="'id_'+dproc" :value="idp">
                        <input type="hidden" name="opm" :value="opm">
                        <input type="hidden" name="rg" :value="rg">
                        <div class="col-lg-12 col-md-12 col-xs-12">
                            <label for="data">Data</label><br>
                            <v-datepicker name="data" placeholder="dd/mm/aaaa" v-model="data" clear-button></v-datepicker>
                        </div>
                        <div class="col-lg-12 col-md-12 col-xs-12">
                            <label for="descricao">Descrição</label><br>
                            <textarea rows="3" cols="50" name="descricao" v-model="descricao" class="form-control ">  
                            </textarea>
                        </div>
                        <!-- <div class="col-lg-2 col-md-2 col-xs 2">
                            <label for="notificar_assinantes_por_email">Posto/Graduação</label><br>
                            <input class="numero form-control" value="cargo" type="text" name="notificar_assinantes_por_email" >
                        </div> -->
                        <div class="col-lg-6 col-md-6 col-xs-6">
                            <label>Cancelar</label><br>
                            <a class="btn btn-danger btn-block" @click="clear(false)"><i class="fa fa-times" style="color: white"></i></a>
                        </div>
                        <div class="col-lg-6 col-md-6 col-xs-6">
                        <template v-if="toEdit">
                                <label>Editar</label><br>
                                <a class="btn btn-success btn-block" :disabled="requireds" @click="editMovimento"><i class="fa fa-plus" style="color: white"></i></a>
                            </template>
                            <template v-else>
                            <label>Adicionar</label><br>
                            <a class="btn btn-success btn-block" :disabled="requireds" @click="createMovimento"><i class="fa fa-plus" style="color: white"></i></a>
                        </template>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="card-footer"> 
            <div class="row bordaform" v-if="movimentos.length">
                <div class="col-sm-12">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th class="col-sm-2">#</th>
                                <th class="col-sm-2">Data</th>
                                <template v-if="canDelete">
                                    <th class="col-sm-2">Descrição</th>
                                </template>
                                <template v-else>
                                    <th class="col-sm-4">Descrição</th>
                                </template>
                                <th class="col-sm-2">OPM</th>
                                <th class="col-sm-2">RG</th>
                                <th v-if="canDelete" class="col-sm-2">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(movimento, index) in movimentos" :key="movimento.id_movimento">
                                <td>{{ index + 1 }}</td>
                                <td>{{ movimento.data}}</td>
                                <td>{{ movimento.descricao }}</td>
                                <td>{{ movimento.opm }}</td>
                                <td>{{ movimento.rg }}</td>
                                <td v-if="canDelete">
                                    <div class="btn-group" role="group" aria-label="First group">
                                        <a type="button"  @click="replaceMovimento(movimento)" class="btn btn-success" style="color: white">
                                            <i class="fa fa-edit"></i> 
                                        </a>
                                        <a type="button"  @click="removeMovimento(movimento)" class="btn btn-danger" style="color: white">
                                            <i class="fa fa-trash"></i> 
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                
                    </table>
                </div>
            </div>  
             <div v-if="!movimentos.length && only">
                <h6>Não há registros</h6>
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
            unique: {type: Boolean, default: false},
            // opm: {type: String, default: ''},
            idp: {type: String, default: ''},
            dproc: {type: String, default: ''},
        },
        data() {
            return {
                add: false,
                data: '',
                descricao: '',
                movimentos: [],
                only: false,
                toEdit: '',
            }
        },
        mounted(){
            this.verifyOnly
            this.rg = this.$root.dadoSession('rg')
            this.opm = this.$root.dadoSession('cdopm')
            this.listMovimento()
        },
        computed:{
            requireds(){
              if (this.data && this.descricao) return false
              return true      
            },
            today() {
                let today = new Date();
                let dd = String(today.getDate()).padStart(2, '0');
                let mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
                let yyyy = today.getFullYear();

                today = dd + '/' + mm + '/' + yyyy;
                return today
            },
            verifyOnly(){     
                if(this.unique == true){
                    this.only = true
                }else{
                    this.only = false
                }      
            },
            canDelete(){
                return this.$root.hasPermission('apagar-movimento')
            },
        },
        methods: {
            listMovimento(){
                this.clear(true)
                let urlIndex = `${this.$root.baseUrl}api/movimento/list/${this.dproc}/${this.idp}`;
                if(this.dproc && this.idp){
                    axios
                    .get(urlIndex)
                    .then((response) => {
                        this.movimentos = response.data
                        // console.log(response.data)
                    })
                    .then(this.clear)//limpa a busca
                    .catch(error => console.log(error));
                }
            },
            createMovimento(){
                if(!this.requireds) {
                    let urlCreate = `${this.$root.baseUrl}api/movimento/store`
                    let formData = document.getElementById('formMovimento');
                    let data = new FormData(formData);
                    axios.post( urlCreate,data)
                    .then((response) => this.transation(response.data.success, 'create'))
                    .catch((error) => console.log(error));
                }

            },
            replaceMovimento(movimento){
                console.table(movimento)
                this.data = movimento.data,
                this.descricao = movimento.descricao,
                this.toEdit = movimento.id_movimento

                // this.titleSubstitute=" - Substituição do "+pm.situacao+" "+pm.nome
                this.add = true
            },
            editMovimento(){
                if(!this.requireds) {
                let urledit = `${this.$root.baseUrl}api/movimento/update/${this.toEdit}`

                let formData = document.getElementById('formMovimento');
                let data = new FormData(formData);
                
                axios.post( urledit,data)
                .then((response) => this.transation(response.data.success, 'edit'))
                .catch((error) => console.log(error));
                }
                
            },
            removeMovimento(movimento){
                if(confirm('Você tem certeza?')){
                    let id = movimento.id_movimento ? movimento.id_movimento : false
                    if(id){
                        let urlDelete = `${this.$root.baseUrl}api/movimento/destroy/${id}`
                        axios
                        .delete(urlDelete)
                        .then((response) => this.transation(response.data.success, 'delete'))
                        .catch(error => console.log(error));
                    }else{
                        console.log('movimento sem ID')
                    }
                }
            },
            transation(happen,type) {
                let msg = this.words(type)
                if(happen) { // se deu certo
                        this.listMovimento()
                        this.$root.msg(msg.success,'success')
                        this.clear(false)
                } else { // se falhou
                    this.$root.msg(msg.fail,'danger')
                }
            },
            words(type) {
                if(type == 'create') return { success : 'Inserido com sucesso', fail: 'Erro ao inserir'}
                if(type == 'edit') return { success : 'Editado com sucesso', fail: 'Erro ao editar'}
                if(type == 'delete') return { success : 'Apagado com sucesso', fail: 'Erro ao apagar'}
            },
            
            clear(add){
                this.add = add
                this.data = ''
                this.descricao = ''
            },
        },
    }
</script>

<style scoped>

</style>
