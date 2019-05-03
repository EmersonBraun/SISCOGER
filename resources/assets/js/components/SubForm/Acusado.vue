<template>
    <div class="col-lg-12 col-md-12 col-xs-12 card">
        <div class="card-header">
            <h5><b>Acusado</b></h5> 
        </div>
        <div class="card-body" :class="add ? 'bordaform' : ''" v-if="!only">
            <div v-if="!add">
                <button @click="add = !add" class="btn btn-success btn-block"><i class="fa fa-plus"></i> Adicionar acusado</button>
            </div>
            <div v-else>
                <div id="ligacaoForm1" class="row">
                    <form id="formData" name="formData">
                        <input type="hidden" :name="'id_'+dproc" :value="idp">
                        <input type="hidden" name="situacao" :value="situacao">
                        <div class="col-lg-3 col-md-4 col-xs 4">
                            <label for="rg">RG</label><br>
                            <the-mask mask="############" class="form-control" v-model="rg" type="text" maxlength="12" name="rg" placeholder="Nº"/>
                        </div>
                        <div class="col-lg-3 col-md-2 col-xs 2">
                            <label for="nome">Nome</label><br>
                            <input class="numero form-control" :value="nome" type="text" name="nome" readonly>
                        </div>
                        <div class="col-lg-2 col-md-2 col-xs 2">
                            <label for="cargo">Posto/Graduação</label><br>
                            <input class="numero form-control" :value="cargo" type="text" name="cargo" readonly>
                        </div>
                        <div class="col-lg-2 col-md-2 col-xs 2">
                            <label for="resultado">Resultado</label><br>
                            <select class="form-control" name="resultado" :disabled="!finded" required v-model="resultado">
                                <option value="">Selecione</option>
                                <option value="Excluído">Excluído</option>
                                <option value="Punido">Punido</option>
                                <option value="Absolvido">Absolvido</option>
                                <option value="Perda objeto">Perda objeto</option>
                                <option value="Prescricao">Prescricao</option>
                                <option value="Reintegrado/Reinserido">Reintegrado/Reinserido</option>
                            </select>
                        </div>
                        <div class="col-lg-1 col-md-1 col-xs 1">
                            <label>Cancelar</label><br>
                            <a class="btn btn-danger btn-block" @click="clear(true)"><i class="fa fa-times" style="color: white"></i></a>
                        </div>
                        <div class="col-lg-1 col-md-1 col-xs 1">
                            <label>Adicionar</label><br>
                            <a class="btn btn-success btn-block" :disabled="!resultado" @click="createPM"><i class="fa fa-plus" style="color: white"></i></a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="card-footer"> 
            <div class="row bordaform" v-if="pms.length">
                <div class="col-sm-12">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th class="col-sm-2">#</th>
                                <th class="col-sm-2">RG</th>
                                <th class="col-sm-2">Nome</th>
                                <th class="col-sm-2">Posto/Grad.</th>
                                <th class="col-sm-2">Resutlado</th>
                                <th class="col-sm-2">Ver/Apagar Ligação</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(pm, index) in pms" :key="index">
                                <td>{{ index + 1 }}</td>
                                <td>{{ pm.rg }}</td>
                                <td>{{ pm.nome }}</td>
                                <td>{{ pm.cargo }}</td>
                                <td>{{ pm.resultado }}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="First group">
                                        <a type="button" @click="showPM(pm.rg)" target="_blanck" class="btn btn-primary" style="color: white">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a type="button"  @click="removePM(pm.id_envolvido, index)" class="btn btn-danger" style="color: white">
                                            <i class="fa fa-trash"></i> 
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                
                    </table>
                </div>
            </div>  
             <div v-else-if="!pms.length && only">
                <h5>
                    <b>Não há registtros</b>
                </h5>
            </div> 
        </div>
    </div>
</template>

<script>
    import {TheMask} from 'vue-the-mask'
    export default {
        components: {TheMask},
        props: {
            unique: {type: Boolean, default: false},
            situacao: {type: String, default: ''},
            idp: {type: String, default: ''},
        },
        data() {
            return {
                rg: '',
                nome: '',
                cargo: '',
                proc: '',
                dproc: '',
                dref: 0,
                dano: 0,
                action: '',
                pms: [],
                add: false,
                finded: false,
                resultado: false,
                counter: 0,
                only: false,
            }
        },
        mounted(){
            this.verifyOnly
        },
        created() {
            let name = this.dproc+this.idp+'acusados'
            const json = sessionStorage.getItem(name)
            const array = JSON.parse(json)
            this.pms = Array.isArray(array) ? array : []
            if(this.pms == []) this.listPM()
        },
        watch: {
            rg() {
                if(this.rg.length > 5){
                    this.searchPM()
                }else{
                    this.clear(true)
                }
            },
            pms:{
                deep: true,
                handler(){
                    let name = this.dproc+this.idp+'acusados'
                    sessionStorage.setItem(name, JSON.stringify(this.pms))
                }
            }
        },
        computed:{
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
            searchPM(){               
                let searchUrl = this.getBaseUrl + 'api/dados/pm/' + this.rg ;
                if(this.rg.length > 5){
                    axios
                    .get(searchUrl)
                    .then((response) => {
                        if(response.data.success){
                            this.nome = response.data['pm'].NOME
                            this.cargo = response.data['pm'].CARGO
                            this.finded = true
                        }
                        else{
                            this.nome = ''
                            this.cargo = ''
                            this.finded = false
                        }
                    })
                    .catch(error => console.log(error));
                }
            },
             listPM(){
                this.clear(false)
                let urlIndex = this.getBaseUrl + 'api/dados/envolvido/' + this.dproc + '/' +this.idp + '/' + this.situacao ;
                if(this.dproc && this.idp && this.situacao){
                    axios
                    .get(urlIndex)
                    .then((response) => {
                        this.pms = response.data
                        // console.log(response.data)
                    })
                    .then(this.clear(false))//limpa a busca
                    .catch(error => console.log(error));
                }
            },
            createPM(){
                let urlCreate = this.getBaseUrl + 'api/acusado/store';

                let formData = document.getElementById('formData');
                let data = new FormData(formData);

                axios.post( urlCreate,data)
                .then(this.listPM())
                .catch((error) => console.log(error));
            },
            showPM(rg){
                let urlIndex = this.getBaseUrl + 'fdi/' + rg + '/ver';                
                window.open(urlIndex, "_blank")
            },
            // apagar arquivo
            removePM(id, index){
                let urlDelete = this.getBaseUrl + 'api/acusado/destroy/' + id;
                axios
                .delete(urlDelete)
                .then(this.pms.splice(index,1))
                .then(this.clear(false))
                .catch(error => console.log(error));
            },
            clear(add){
                this.add = add
                this.rg = ''
                this.nome = ''
                this.cargo = ''
                this.resultado = ''
                this.finded = false
            },
        },
    }
</script>

<style scoped>

</style>
