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
                    <form id="formData" name="formData">
                        <input type="hidden" :name="'id_'+dproc" :value="idp">
                        <input type="hidden" name="opm" :value="opm">
                        <input type="hidden" name="rg" :value="rg">
                        <div class="col-lg-12 col-md-12 col-xs-12">
                            <label for="data">Data</label><br>
                            <v-datepicker name="data" placeholder="dd/mm/aaaa" v-model="data" clear-button></v-datepicker>
                        </div>
                        <div class="col-lg-12 col-md-12 col-xs-12">
                            <label for="descricao">Descrição</label><br>
                            <textarea rows="5" cols="50" name="descricao" v-model="descricao" class="form-control ">  
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
                            <label>Adicionar</label><br>
                            <a class="btn btn-success btn-block" :disabled="!data.length && !descricao.length" @click="createMovimento"><i class="fa fa-plus" style="color: white"></i></a>
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
                                <template v-if="admin">
                                    <th class="col-sm-2">Descrição</th>
                                </template>
                                <template v-else>
                                    <th class="col-sm-4">Descrição</th>
                                </template>
                                <th class="col-sm-2">OPM</th>
                                <th class="col-sm-2">RG</th>
                                <th v-if="admin" class="col-sm-2">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(movimento, index) in movimentos" :key="index">
                                <td>{{ index + 1 }}</td>
                                <td>{{ movimento.data}}</td>
                                <td>{{ movimento.descricao }}</td>
                                <td>{{ movimento.opm }}</td>
                                <td>{{ movimento.rg }}</td>
                                <td v-if="admin">
                                    <div class="btn-group" role="group" aria-label="First group">
                                        <a type="button"  @click="removeMovimento(movimento.id_movimento, index)" class="btn btn-danger" style="color: white">
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
                <h5>
                    <b>Não há registtros</b>
                </h5>
            </div> 
        </div>
    </div>
</template>

<script>
    import {Datepicker} from '../Vuestrap/Datepicker'
    export default {
        components: {Datepicker},
        props: {
            unique: {type: Boolean, default: false},
            admin: {type: Boolean, default: false},
            opm: {type: String, default: ''},
            rg: {type: String, default: ''},
            idp: {type: String, default: ''},
        },
        data() {
            return {
                data: '',
                descricao: '',
                dproc: '',
                dref: 0,
                dano: 0,
                movimentos: [],
                add: false,
                only: false,
            }
        },
        mounted(){
            this.verifyOnly
            this.listMovimento()
        },
        computed:{
            today() {
                let today = new Date();
                let dd = String(today.getDate()).padStart(2, '0');
                let mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
                let yyyy = today.getFullYear();

                today = dd + '/' + mm + '/' + yyyy;
                return today
            },
            getBaseUrl(){
                // URL completa
                let getUrl = window.location;
                // dividir em array
                let pathname = getUrl.pathname.split('/')
                this.action = pathname[3]
                this.dproc = pathname[2]
                this.dref = pathname[4]
                this.dano = pathname[5]
                
                let baseUrl = getUrl.protocol + "//" + getUrl.host + "/" + pathname[1]+"/";
                
            return baseUrl;
            },
            verifyOnly(){     
                if(this.unique == true){
                    this.only = true
                }else{
                    this.only = false
                }      
            },
        },
        methods: {
            listMovimento(){
                this.clear(true)
                let urlIndex = this.getBaseUrl + 'api/movimento/list/' + this.dproc + '/' +this.idp;
                console.log(urlIndex)
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
                let urlCreate = this.getBaseUrl + 'api/movimento/store';

                let formData = document.getElementById('formData');
                let data = new FormData(formData);
                
                axios.post( urlCreate,data)
                .then(() => {
                    this.movimentos.push({
                        data: data.get('data'),
                        descricao: data.get('descricao'),
                        opm: this.opm,
                        rg: this.rg,
                    })
                    this.clear(false)
                })
                .catch((error) => console.log(error));
            },
            removeMovimento(id, index){
                let urlDelete = this.getBaseUrl + 'api/movimento/destroy/' + id;
                axios
                .delete(urlDelete)
                .then(this.movimentos.splice(index,1))
                .catch(error => console.log(error));
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
