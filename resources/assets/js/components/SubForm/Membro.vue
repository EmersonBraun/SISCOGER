<template>
    <div class="col-lg-12 col-md-12 col-xs-12 card">
        <div class="card-header">
             <div class="row">
                <div class="col-sm-10">
                    <h5><b>Membros {{titleSubstitute || ''}}</b></h5> 
                </div>
                <div class="col align-self-end">
                    <div class="btn-group">
                        <a @click="mode = 'atuais'" class="btn" :class="mode == 'atuais' ? 'btn-info' : 'btn-default'">
                            Atuais
                        </a>
                        <a type="button" @click="mode = 'substituidos'" class="btn" :class="mode == 'substituidos' ? 'btn-info' : 'btn-default'">
                            Substituídos
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="card-body " :class="add ? 'bordaform' : ''" v-if="mode == 'atuais' && !only && !show">
            <div v-if="!add">
                <button @click="add = !add" class="btn btn-success btn-block"><i class="fa fa-plus"></i> Adicionar membro</button>
            </div>
            <div v-else>
                <div id="ligacaoForm1" class="row">
                    <form id="formFormMembro" name="formFormMembro">
                        <input type="hidden" :name="'id_'+dproc" :value="idp">
                        <!-- dados para substituição do membro -->
                        <input type="hidden" name="indexsubs" :value="indexsubs">
                        <input type="hidden" name="idsubs" :value="idsubs">
                        <!-- dados para substituição do membro -->
                        <div class="col-lg-3 col-md-4 col-xs 4">
                            <template v-if="!substituido">
                                <label for="rg">RG</label><br>
                            </template>
                            <template v-else>
                                <label for="rg">RG Substituto</label><br>
                            </template>
                            <input class="numero form-control" v-model="rg" @keyup="searchPM()" type="text" maxlength="12" name="rg" placeholder="Nº">
                            <!-- <the-mask mask="############" class="form-control" v-model="rg" type="text" maxlength="12" name="rg" placeholder="Nº"/> -->
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
                            <select v-if="!substituido" class="form-control" name="situacao" :disabled="!finded" required v-model="situacao">
                                <option  v-for="(s, index) in situacoes" :key="index" :value="s">{{s}}</option>
                            </select>
                            <input  v-else class="form-control" :value="situacaosubs" type="text" name="situacao" readonly>
                        </div>
                        <div class="col-lg-1 col-md-1 col-xs 1">
                            <label>Cancelar</label><br>
                            <a class="btn btn-danger btn-block" @click="clear(false)"><i class="fa fa-times" style="color: white"></i></a>
                        </div>
                        <div class="col-lg-1 col-md-1 col-xs 1">
                            <template v-if="!substituido">
                                <label>Adicionar</label><br>
                                <a class="btn btn-success btn-block" :disabled="!situacao" @click="createPM"><i class="fa fa-plus" style="color: white"></i></a>
                            </template>
                            <template v-else>
                                <label>Substituir</label><br>
                                <a class="btn btn-success btn-block" :disabled="!finded" @click="createPM"><i class="fa fa-plus" style="color: white"></i></a>
                            </template>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="card-footer"> 
            <template v-if="mode == 'atuais'">
                <!-- pms -->
                <h5><b>Atuais</b></h5>
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
                                    <th  v-if="!show" class="col-sm-2">Ver/Substituir/Apagar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(pm, index) in pms" :key="index">
                                    <td>{{ index + 1 }}</td>
                                    <td>{{ pm.rg }}</td>
                                    <td>{{ pm.nome }}</td>
                                    <td>{{ pm.cargo }}</td>
                                    <td>{{ pm.situacao }}</td>
                                    <td  v-if="!show">
                                        <div class="btn-group" role="group" aria-label="First group">
                                            <a type="button" @click="showPM(pm.rg)" target="_blanck" class="btn btn-primary" style="color: white">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <a v-if="canReplace" type="button" @click="replacePM(pm, index)" class="btn btn-success" style="color: white">
                                                <i class="fa fa-retweet"></i>
                                            </a>
                                            <a v-if="canDelete" type="button"  @click="removePM(pm.id_envolvido, pm.situacao, index)" class="btn btn-danger" style="color: white">
                                                <i class="fa fa-trash"></i> 
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>  
                <div v-else>
                    <h6>
                        Não há registros
                    </h6>
                </div> 
            </template>
            <template v-else>
                <!-- substituiídos -->
                <h5><b>Substituídos</b></h5>
                <div class="row bordaform" v-if="subs.length">
                    <div class="col-sm-12">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="col-sm-2">#</th>
                                    <th class="col-sm-2">RG</th>
                                    <th class="col-sm-2">Nome</th>
                                    <th class="col-sm-2">Posto/Grad.</th>
                                    <th class="col-sm-2">Situação</th>
                                    <th class="col-sm-2">Ver</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(s, index) in subs" :key="index">
                                    <td>{{ index + 1 }}</td>
                                    <td>{{ s.rg }}</td>
                                    <td>{{ s.nome }}</td>
                                    <td>{{ s.cargo }}</td>
                                    <td>
                                        <i class="fa fa-sign-out" style="color: red"></i>{{ s.situacao }}<br>
                                        <i class="fa fa-sign-in" style="color: green"></i>{{ s.rg_substituto }}
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="First group">
                                            <a type="button" @click="showPM(s.rg)" target="_blanck" class="btn btn-primary" style="color: white">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>  
                <div v-else>
                    <h6>
                        Não há registros substituídos
                    </h6>
                </div> 
            </template>
        </div>
    </div>
</template>

<script>
    import mixin from '../../mixins.js'
    import {TheMask} from 'vue-the-mask'
    export default {
        mixins: [mixin],
        components: {TheMask},
        props: {
            unique: {type: Boolean, default: false},
            idp: {type: String, default: ''},
            dproc: {type: String, default: ''},
            show: {type: Boolean, default: false},
        },
        data() {
            return {  
                add: false,  
                nome: '',
                cargo: '',
                pms: [],
                subs: [],
                finded: false,
                situacao: false,
                counter: 0,
                only: false,
                situacoes: [],
                usados: [],
                // substituto
                substituido: false,
                idsubs: '',
                rgsubs: '',
                nomesubs: '',
                situacaosubs: '',
                substitute: false,
                titleSubstitute: '',
                indexsubs: '',
                mode: 'atuais'
            }
        },
        created(){
            this.verifyOnly
            this.listPM()
        },
        // watch: {
        //     rg() {
        //         if(!this.rg.length){
        //             this.nome = ''
        //             this.cargo = ''
        //         }
        //         this.searchPM()
        //     },
        // },
        computed:{
            verifyOnly(){     
                if(this.unique == true){
                    this.only = true
                }else{
                    this.only = false
                }      
            },
            canReplace(){
                return this.$root.hasPermission('substituir-membros')
            },
            canDelete(){
                return this.$root.hasPermission('apagar-membros')
            },
        },
        methods: {
            searchPM(){
                let searchUrl = `${this.$root.baseUrl}api/dados/pm/${this.rg}`
                console.log('url', searchUrl)
                if(this.rg.length > 5){
                    if(this.substituido && this.rg == this.rgsubs){
                        this.nome = 'Inválido - Mesmo RG informado'
                        this.cargo = 'Mesmo RG'
                        this.finded = false
                    }else{
                        axios
                        .get(searchUrl)
                        .then((response) => {
                            if(response.data.success){
                                this.nome = response.data['pm'].NOME || response.data['pm'].nome
                                this.cargo = response.data['pm'].CARGO || response.data['pm'].cargo
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
                }
            },
            listPM(){
                let urlIndex = `${this.$root.baseUrl}api/dados/membros/${this.dproc}/${this.idp}`;
                if(this.dproc && this.idp){
                    axios
                    .get(urlIndex)
                    .then((response) => {
                        this.pms = response.data.membros
                        this.subs = response.data.subs
                        this.usados = response.data.usados
                    })
                    .then((usados = this.usados) =>{
                        let situacoes = ['Acusador','Encarregado','Escrivão','Membro','Presidente']
                        this.situacoes = situacoes.filter(a => !this.usados.includes(a))
                    })// atualiza disponíveis
                    .then(this.clear(false))
                    .catch(error => console.log(error));
                } 
            },
            createPM(){  
                let urlCreate = `${this.$root.baseUrl}api/membros/store`

                let formFormMembro = document.getElementById('formFormMembro');
                let data = new FormData(formFormMembro);

                axios.post( urlCreate,data)
                .then(this.listPM())//limpa a busca
                .catch((error) => console.log(error));
                
            },
            showPM(rg){
                let urlIndex = `${this.$root.baseUrl}fdi/${rg}/ver`                
                window.open(urlIndex, "_blank")
            },
            removePM(id, situacao, index){
                if(confirm('Você tem certeza?')){
                    this.clear(false)//limpa a busca
                    
                    let urlDelete = `${this.$root.baseUrl}api/membros/destroy/${id}`
                    axios
                    .delete(urlDelete)
                    .then(this.updateSituacao(situacao,'remove'))
                    .then(this.pms.splice(index,1))
                    .catch(error => console.log(error));
                }
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
            replacePM(pm, index){
                this.titleSubstitute=` - Substituição do ${pm.situacao} ${pm.nome}`
                this.substituido = true
                this.rgsubs= pm.rg
                this.nomesubs= pm.nome
                this.situacaosubs= pm.situacao
                this.idsubs= pm.id_envolvido
                this.indexsubs = index
                this.add = true
            },
            clear(add){
                this.add = add
                this.rg = ''
                this.nome = ''
                this.cargo = ''
                this.situacao = ''
                this.substituido = false
                this.rgsubs= ''
                this.nomesubs= '',
                this.situacaosubs= '',
                this.substitute= false
                this.titleSubstitute= ''
                this.finded = false
            },
        },
    }
</script>

<style scoped>

</style>
