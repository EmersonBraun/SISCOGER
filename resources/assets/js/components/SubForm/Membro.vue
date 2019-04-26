<template>
    <div class="col-lg-12 col-md-12 col-xs-12 card">
        <div class="card-header">
            <h5><b>Membros</b></h5> 
        </div>
        <div class="card-body" :class="add ? 'bordaform' : ''" v-if="!only">
            <div v-if="!add">
                <button @click="add = !add" class="btn btn-success btn-block"><i class="fa fa-plus"></i> Adicionar membro</button>
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
                            <label for="situacao">Situação</label><br>
                            <select class="form-control" name="situacao" :disabled="!finded" required v-model="situacao">
                                <option  v-for="(s, index) in situacoes" :key="index" :value="s">{{s}}</option>
                            </select>
                        </div>
                        <div class="col-lg-1 col-md-1 col-xs 1">
                            <label>Cancelar</label><br>
                            <a class="btn btn-danger btn-block" @click="cancel"><i class="fa fa-times" style="color: white"></i></a>
                        </div>
                        <div class="col-lg-1 col-md-1 col-xs 1">
                            <label>Adicionar</label><br>
                            <a class="btn btn-success btn-block" :disabled="!situacao" @click="createPM"><i class="fa fa-plus" style="color: white"></i></a>
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
                                <th class="col-sm-2">Situação</th>
                                <th class="col-sm-2">Ver/Apagar Ligação</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(pm, index) in pms" :key="index">
                                <td>{{ index + 1 }}</td>
                                <td>{{ pm.rg }}</td>
                                <td>{{ pm.nome }}</td>
                                <td>{{ pm.cargo }}</td>
                                <td>{{ pm.situacao }}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="First group">
                                        <a type="button" @click="showPM(pm.rg)" target="_blanck" class="btn btn-primary" style="color: white">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a type="button"  @click="removePM(pm.id_envolvido, pm.situacao, index)" class="btn btn-danger" style="color: white">
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
                situacao: false,
                counter: 0,
                only: false,
                situacoes: [],
                usados: []
            }
        },
        mounted(){
            this.verifyOnly
            this.listPM()
        },
        watch: {
            rg() {
                if(!this.rg.length){
                    this.nome = ''
                    this.cargo = ''
                }
                this.searchPM()
            },
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
                this.clear()//limpa a busca
                
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
                this.clear()//limpa a busca

                let urlIndex = this.getBaseUrl + 'api/dados/membros/' + this.dproc + '/' +this.idp;
                if(this.dproc && this.idp){
                    axios
                    .get(urlIndex)
                    .then((response) => {
                        this.pms = response.data.membros
                        this.usados = response.data.usados
                    })
                    .then((usados = this.usados) =>{
                        let situacoes = ['Acusador','Encarregado','Escrivão','Membro','Presidente']
                        this.situacoes = situacoes.filter(a => !this.usados.includes(a))
                        // console.log(this.situacoes)
                    })// atualiza disponíveis
                    .catch(error => console.log(error));
                } 
            },
            createPM(){
                this.clear()//limpa a busca
                let urlCreate = this.getBaseUrl + 'api/membros/store';

                let formData = document.getElementById('formData');
                let data = new FormData(formData);

                console.log(data.get('situacao'))
                axios.post( urlCreate,data)
                .then(this.updateSituacao(data.get('situacao'),'add'))
                .then(this.addPM(data))
                .catch((error) => console.log(error));
            },
            addPM(data){
                this.pms.push({
                    id_envolvido: data.get('id_envolvido'),
                    rg: data.get('rg'),
                    nome: data.get('nome'),
                    cargo: data.get('cargo'),
                    situacao: data.get('situacao'),
                    rg: data.get('rg')
                })
            },
            showPM(rg){
                let urlIndex = this.getBaseUrl + 'fdi/' + rg + '/ver';                
                window.open(urlIndex, "_blank")
            },
            removePM(id, situacao, index){
                this.clear()//limpa a busca
                
                let urlDelete = this.getBaseUrl + 'api/membros/destroy/' + id;
                axios
                .delete(urlDelete)
                // .then(this.listPM())
                .then(this.updateSituacao(situacao,'remove'))
                .then(this.pms.splice(index,1))
                .catch(error => console.log(error));
            },
            updateSituacao(situacao, tipo){
                if(tipo == 'add'){
                    this.usados.push(situacao)
                }else{
                    let search = this.usados.indexOf(situacao)
                    this.usados.splice(search,1)
                }
                let situacoes = ['Acusador','Encarregado','Escrivão','Membro','Presidente']
                this.situacoes = situacoes.filter(a => !this.usados.includes(a))
            },
            // removeSituacao(situacao){
            //     let search = this.situacoes.indexOf(situacao)
            //     this.situacoes.slice(search,1)
            //     this.clear()
            // },
            // addSituacao(situacao){
            //     this.situacoes.push(situacao)
            // },
            cancel(){
                this.add = false
                this.rg = ''
                this.nome = ''
                this.cargo = ''
                this.situacao = ''
                this.finded = false
            },
            clear(){
                this.rg = ''
                this.nome = ''
                this.cargo = ''
                this.situacao = ''
                this.finded = false
            },
        },
    }
</script>

<style scoped>

</style>
