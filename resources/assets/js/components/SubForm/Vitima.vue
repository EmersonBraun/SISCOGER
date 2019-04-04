<template>
    <div class="col-lg-12 col-md-12 col-xs-12 card">
        <div class="card-header">
            <h5><b>Vítima (apenas se houver)</b></h5> 
        </div>
        <div class="card-body" :class="add ? 'bordaform' : ''" v-if="!only">
            <div v-if="!add">
                <button @click="add = !add" class="btn btn-success btn-block"><i class="fa fa-plus"></i> Adicionar vítima</button>
            </div>
            <div v-else>
                <div class="row">
                    <form id="formData" name="formData">

                        <input type="hidden" :name="'id_'+dproc" :value="idp">

                        <div class="col-lg-4 col-md-4 col-xs 4">
                            <label for="rg">RG</label><br>
                            <the-mask mask="############" name="rg" v-model="rg" class="form-control"/>
                        </div>
                        <div class="col-lg-4 col-md-4 col-xs 4">
                            <label for="nome">Nome</label><br>
                            <input type="text" size="30" name="nome" v-model="nome" class="form-control">
                        </div>

                        <div  v-if="dproc == 'ipm'" class="col-lg-4 col-md-4 col-xs 4">
                            <label for="resultado">Resultado</label><br>
                            <select name="resultado" class="form-control" v-model="resultado">
                                <option value="">Selecione</option>
                                <option value="Sem lesao">Sem lesao</option>
                                <option value="Obito">Obito</option>
                                <option value="Lesao corporal">Lesao corporal</option>
                            </select>
                        </div>

                        <div class="col-lg-2 col-md-2 col-xs 2">
                            <label for="sexo">Sexo</label><br>
                            <select name="resultado" class="form-control" v-model="sexo">
                                <option value="">Selecione</option>
                                <option value="M">Masculino</option>
                                <option value="F">Feminino</option>
                            </select>
                        </div>

                        <template v-if="dproc !== 'ipm'">
                            <div class="col-lg-2 col-md-2 col-xs 2">
                                <label for="fone">Fone</label><br>
                                <input size='10' maxlength='20' name='fone' type='text' class="form-control" v-model="fone">
                            </div>
                            <div class="col-lg-4 col-md-4 col-xs 4">
                                <label for="email">Email</label><br>
                                <input size='20' maxlength='40' name='email' type='text' class="form-control" v-model="email">
                            </div>
                        </template>

                        <div class="col-lg-2 col-md-2 col-xs 2">    
                            <label for="idade">Idade</label><br>
                            <the-mask mask="###" name='idade' type='text' class="form-control" v-model="idade"/>
                        </div>
                        
                        <div v-if="dproc !== 'sai'&& dproc !== 'proc_outros'" class="col-lg-4 col-md-4 col-xs 4">
                            <label for="escolaridade">Escolaridade</label><br>
                            <select name="escolaridade" class="form-control" v-model="escolaridade">
                                <option value="Analfabeto">Analfabeto</option>
                                <option value="Fundamental Incompleto" selected>Fundamental Incompleto</option>
                                <option value="Fundamental Completo">Fundamental Completo</option>
                                <option value="Médio Incompleto">Médio Incompleto</option>
                                <option value="Médio completo">Médio completo</option>
                                <option value="Superior incompleto">Superior incompleto</option>
                                <option value="Superior completo">Superior completo</option>
                                <option value="Pos - graduado">Pós - graduado</option>
                                <option value="Mestrado">Mestrado</option>
                                <option value="Doutorado">Doutorado</option>
                            </select>
                        </div>
                        <div class="col-lg-4 col-md-4 col-xs-4" v-if="dproc == 'sai'|| dproc == 'proc_outros'">    
                            <label for="situacao">Envolvimento</label><br>
                            <select name="situacao" class="form-control" v-model="vsituacao">
                                <option value="Vitima">Vítima</option>
                                <option value="Testemunha">Testemunha</option>
                                <option value="Denunciante">Denunciante</option>
                            </select>
                        </div>
                        <template v-else>
                            <input type="hidden" name="situacao" value="Vitima">
                        </template>
                        <div v-if="dproc == 'ipm'" class="col-lg-2 col-md-2 col-xs 2"></div>

                        <div class="col-lg-1 col-md-1 col-xs 1">
                            <label>Cancelar</label><br>
                            <a class="btn btn-danger btn-block" @click="cancel"><i class="fa fa-times" style="color: white"></i></a>
                        </div>
                        <div class="col-lg-1 col-md-1 col-xs 1">
                            <label>Adicionar</label><br>
                            <a class="btn btn-success btn-block" :disabled="!rg.length || !nome.length" @click="createVitima()"><i class="fa fa-plus" style="color: white"></i></a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <div class="card-footer"> 
            <div class="row bordaform" v-if="vitimas.length">
                <div class="col-sm-12">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th class="col-sm-2">RG</th>
                                <th class="col-sm-2">Nome</th>
                                <th class="col-sm-3" v-if="dproc == 'ipm'">Resultado</th>
                                <th class="col-sm-1">Sexo</th>
                                <th class="col-sm-1" v-if="dproc !== 'ipm'">Fone</th>
                                <th class="col-sm-2" v-if="dproc !== 'ipm'">Email</th>
                                <th class="col-sm-1">Idade</th>
                                <th class="col-sm-2">Escolaridade</th>
                                <th class="col-sm-2" v-if="dproc == 'sai' || dproc == 'proc_outros'">Envolv.</th>
                                <th class="col-sm-1">Apagar Vítima</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(vitima, index) in vitimas" :key="index">
                                <td>{{ vitima.rg }}</td>
                                <td>{{ vitima.nome }}</td>
                                <td v-if="dproc == 'ipm'">{{ vitima.resultado }}</td>
                                <td>{{ vitima.sexo }}</td>
                                <td v-if="dproc !== 'ipm'">{{ vitima.fone }}</td>
                                <td v-if="dproc !== 'ipm'">{{ vitima.email }}</td>
                                <td>{{ vitima.idade }}</td>
                                <td>{{ vitima.escolaridade }}</td>
                                <td v-if="dproc == 'sai' || dproc == 'proc_outros'">{{ vitima.envolvimento }}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="First group">
                                        <a type="button"  @click="removeVitima(vitima.id_vitima)" class="btn btn-danger" style="color: white">
                                            <i class="fa fa-trash"></i> 
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                
                    </table>
                </div>
            </div>  
             <div v-else-if="!vitimas.length && only">
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
            situacao: {type: String},
            idp: {type: String},
        },
        data() {
            return {
                rg: '',
                nome: '',
                resultado: '',
                sexo: '',
                fone: '',
                email: '',
                idade: '',
                escolaridade: '',
                vsituacao: '',
                dproc: '',
                dref: 0,
                dano: 0,
                action: '',
                vitimas: [],
                add: false,
                finded: false,
                resultado: false,
                counter: 0,
                only: false,
            }
        },
        mounted(){
            this.verifyOnly
            this.listVitima()
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
             listVitima(){
                this.clear()
                let urlIndex = this.getBaseUrl + 'api/dados/vitima/' + this.dproc + '/' +this.idp + '/' + this.situacao ;
                if(this.dproc && this.idp && this.situacao){
                    axios
                    .get(urlIndex)
                    .then((response) => {
                        this.vitimas = response.data
                        // console.log(response.data)
                    })
                    .then(this.clear)//limpa a busca
                    .catch(error => console.log(error));
                }
            },
            createVitima(){
                let urlCreate = this.getBaseUrl + 'api/vitima/store';

                let formData = document.getElementById('formData');
                let data = new FormData(formData);

                axios.post( urlCreate,data)
                .then(this.listVitima())
                .catch((error) => console.log(error));
            },
            // apagar arquivo
            removeVitima(id){
                let urlDelete = this.getBaseUrl + 'api/vitima/destroy/' + id;
                axios
                .delete(urlDelete)
                .catch(error => console.log(error));
                this.listVitima()
            },
            cancel(){
                this.add = false
                this.rg = '',
                this.nome = '',
                this.resultado = '',
                this.sexo = '',
                this.fone = '',
                this.email = '',
                this.idade = '',
                this.escolaridade = '',
                this.vsituacao = '',
                this.finded = false
            },
            clear(){
                this.rg = '',
                this.nome = '',
                this.resultado = '',
                this.sexo = '',
                this.fone = '',
                this.email = '',
                this.idade = '',
                this.escolaridade = '',
                this.vsituacao = '',
                this.finded = false
            },
        },
    }
</script>

<style scoped>

</style>
