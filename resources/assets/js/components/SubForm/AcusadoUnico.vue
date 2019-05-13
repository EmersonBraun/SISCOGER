<template>
    <div class="col-lg-12 col-md-12 col-xs-12 card">
        <div class="card-header">
            <h5><b>Acusado</b></h5> 
        </div>
        <div class="card-body">
            <template v-if="hasPM">
                <template v-if="pms.length">
                    <div v-for="(pm,index) in pms" :key="index">
                        <div class="col-lg-3 col-md-3 col-xs-3">
                            <label for="nome">RG</label><br>
                            <p>{{ pm.rg }}</p>
                        </div>
                        <div class="col-lg-3 col-md-3 col-xs-3">
                            <label for="nome">Nome</label><br>
                            <p>{{ pm.nome }}</p>
                        </div>
                        <div :class="cls">
                            <label for="cargo">Posto/Graduação</label><br>
                            <p>{{ pm.cargo }}</p>
                        </div>
                        <div :class="cls">
                            <label for="resultado">Resultado</label><br>
                            <p>{{ pm.situacao }}</p>
                        </div>
                        <div v-if="!only" class="col-lg-2 col-md-2 col-xs-2">
                            <label>Editar</label><br>
                            <a class="btn btn-success btn-block" @click="replacePM(pm)"><i class="fa fa-edit" style="color: white"></i></a>
                        </div>
                    </div>
                </template>
                <template v-else>
                </template>
            </template>
            <div v-else>
                <div id="ligacaoForm1" class="row">
                    <form id="formData" name="formData">
                        <input type="hidden" :name="'id_'+dproc" :value="idp">
                        <div class="col-lg-3 col-md-3 col-xs-3">
                            <label for="rg">RG</label><br>
                            <the-mask mask="############" class="form-control" v-model="rg" type="text" maxlength="12" name="rg" placeholder="Nº"/>
                        </div>
                        <div class="col-lg-3 col-md-3 col-xs-3">
                            <label for="nome">Nome</label><br>
                            <input class="numero form-control" :value="nome" type="text" name="nome" readonly>
                        </div>
                        <div class="col-lg-2 col-md-2 col-xs-2">
                            <label for="cargo">Posto/Graduação</label><br>
                            <input class="numero form-control" :value="cargo" type="text" name="cargo" readonly>
                        </div>
                        <div class="col-lg-2 col-md-2 col-xs-2">
                            <label for="resultado">Resultado</label><br>
                            <template v-if="situacao">
                                <input class="numero form-control" :value="situacao" type="text" name="situacao" readonly>
                            </template>
                            <template v-else>
                                <select class="form-control" name="resultado" :disabled="!finded" required v-model="resultado">
                                    <option value="">Selecione</option>
                                    <option value="Excluído">Excluído</option>
                                    <option value="Punido">Punido</option>
                                    <option value="Absolvido">Absolvido</option>
                                    <option value="Perda objeto">Perda objeto</option>
                                    <option value="Prescricao">Prescricao</option>
                                    <option value="Reintegrado/Reinserido">Reintegrado/Reinserido</option>
                                </select>
                            </template>
                        </div>
                        <div class="col-lg-1 col-md-1 col-xs-1">
                            <template v-if="!edit">
                                <label>Cancelar</label><br>
                                <a class="btn btn-danger btn-block" @click="clear(true)"><i class="fa fa-times" style="color: white"></i></a>
                            </template>
                            <template v-else>
                                <label>Cancelar</label><br>
                                <a class="btn btn-danger btn-block" @click="hasPM = !hasPM"><i class="fa fa-times" style="color: white"></i></a>
                            </template>
                        </div>
                        <div class="col-lg-1 col-md-1 col-xs-1">
                             <template v-if="!edit">
                                <label>Editar</label><br>
                                <a class="btn btn-success btn-block" :disabled="!resultado" @click="editPM"><i class="fa fa-plus" style="color: white"></i></a>
                            </template>
                            <template v-else>
                                <label>Adicionar</label><br>
                                <a class="btn btn-success btn-block" :disabled="!resultado" @click="createPM"><i class="fa fa-plus" style="color: white"></i></a>
                            </template>
                        </div>
                    </form>
                </div>
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
                cls: false,
                resultado: false,
                counter: 0,
                only: false,
                edit: '',
                hasPM: false
            }
        },
        filters: {
            vazio(value) {
                return (!value) ? 'Não há' : value
            }
        },
        mounted(){
            this.verifyOnly
            this.listPM()
        },
        watch: {
            rg() {
                if(this.rg.length > 5){
                    this.searchPM()
                }else{
                    this.clear(true)
                }
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
                
                let baseUrl = `${getUrl.protocol}//${getUrl.host}/${pathname[1]}/`;
                
            return baseUrl;
            },
            verifyOnly(){     
                if(this.unique == true){
                    this.only = true
                    this.cls = 'col-lg-3 col-md-3 col-xs-3'
                }else{
                    this.only = false
                    this.cls = 'col-lg-2 col-md-2 col-xs-2'
                }      
            },
        },
        methods: {
            searchPM(){               
                let searchUrl = `${this.getBaseUrl}api/dados/pm/${this.rg}` ;
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
                let urlIndex = `${this.getBaseUrl}api/dados/envolvido/${this.dproc}/${this.idp}/${this.situacao}`;
                if(this.dproc && this.idp && this.situacao){
                    axios
                    .get(urlIndex)
                    .then((response) => {
                        this.pms = response.data
                        if(this.pms.length) this.hasPM = true
                        // console.log(response.data)
                    })
                    .then(this.clear(false))//limpa a busca
                    .catch(error => console.log(error));
                }
            },
            createPM(){
                let urlCreate = `${this.getBaseUrl}api/acusado/store`;

                let formData = document.getElementById('formData');
                let data = new FormData(formData);

                axios.post( urlCreate,data)
                .then(this.listPM())
                .catch((error) => console.log(error));
            },
            showPM(rg){
                let urlIndex = `${this.getBaseUrl}fdi/${rg}/ver`;                
                window.open(urlIndex, "_blank")
            },
            replacePM(pm){
                this.hasPM = false
                this.edit = pm.id_envolvido
                this.rg = pm.rg,
                this.nome = pm.nome,
                this.cargo = pm.cargo,
                this.resultado = pm.resultado
                // this.titleSubstitute=" - Substituição do "+pm.situacao+" "+pm.nome

            },
            editPM(){
                let urledit = `${this.getBaseUrl}api/acusado/edit/${this.edit}`;

                let formData = document.getElementById('formData');
                let data = new FormData(formData);
                
                axios.post( urledit,data)
                .then(() => {
                    this.listPM()
                    this.clear(false)
                })
                .catch((error) => console.log(error));
            },
            clear(){
                this.rg = ''
                this.nome = ''
                this.cargo = ''
                this.resultado = ''
                this.edit = ''
                this.finded = false
            },
        },
    }
</script>

<style scoped>

</style>
