<template>
    <div class="col-lg-12 col-md-12 col-xs-12 card mt-4">
        <br>
        <div class="card-header">
            <div v-if="reu" class="row">
                <div class="col-sm-10">
                    <h4>{{ verReus ? 'Réus' : 'Acusados' }}</h4>
                </div>
                <div class="col align-self-end">
                    <div class="btn-group">
                        <a type="button" @click="verReus = false" target="_black" class="btn" :class="!verReus ? 'btn-info' : 'btn-default'">
                            Acusados
                        </a>
                        <a type="button" @click="verReus = true" class="btn" :class="verReus ? 'btn-info' : 'btn-default'">
                            Réus
                        </a>
                    </div>
                </div>
            </div>
            <template v-else>
                <h4><b>Acusado</b></h4> 
            </template>
        </div>
        <div class="card-body" :class="add ? 'bordaform' : ''" v-if="!only">
            <div v-if="!add && !verReus">
                <button @click="add = !add" class="btn btn-success btn-block"><i class="fa fa-plus"></i> Adicionar acusado</button>
            </div>
            <div v-if="add">
                <div id="ligacaoForm1" class="row">
                    <form id="formData" name="formData">
                        <input type="hidden" :name="'id_'+dproc" :value="idp">
                        <input type="hidden" name="situacao" :value="situacao">
                        <div class="col-xs-3">
                            <label for="rg">RG</label><br>
                            <the-mask mask="############" class="form-control" v-model="rg" type="text" maxlength="12" name="rg" placeholder="Nº"/>
                        </div>
                        <div class="col-xs-3">
                            <label for="nome">Nome</label><br>
                            <input class="numero form-control" :value="nome" type="text" name="nome" readonly>
                        </div>
                        <div :class="reu ? 'col-xs-3' : 'col-xs-2'">
                            <label for="cargo">Posto/Graduação</label><br>
                            <input class="numero form-control" :value="cargo" type="text" name="cargo" readonly>
                        </div>
                        <div :class="reu ? 'col-xs-3' : 'col-xs-2'">
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
                        <!-- REUS para IPM, desercao e APFD -->
                        <template v-if="reu && edit">
                            <div class="col-lg-6 col-md-6 col-xs-6">
                                <label for="ipm_processocrime">Processo crime</label><br>
                                <select class="form-control" v-model="pm.ipm_processocrime" name="ipm_processocrime" >
                                    <option value="">Selecione</option>
                                    <option value="Denunciado">Denunciado</option>
                                    <option value="Arquivado">Arquivado</option>
                                </select>
                            </div>
                            <div class="col-lg-6 col-md-6 col-xs-6">
                                <label for="ipm_julgamento">Julgamento</label><br>
                                <select class="form-control" v-model="pm.ipm_julgamento" name="ipm_julgamento" >
                                    <option value="">Selecione</option>
                                    <option value="Condenado">Condenado</option>
                                    <option value="Absolvido">Absolvido</option>
                                </select>
                            </div>
                            <!-- dados caso condenado -->
                            <template v-if="pm.ipm_julgamento == 'Condenado'">
                                <div class="col-lg-1 col-md-1 col-xs-1">
                                    <label>Anos</label><br>
                                    <the-mask mask="###" class="form-control" v-model="pm.ipm_pena_anos" type="text" maxlength="3" name="ipm_pena_anos" placeholder="Anos"/>
                                </div>
                                <div class="col-lg-1 col-md-1 col-xs-1">
                                    <label>Meses</label><br>
                                    <the-mask mask="###" class="form-control" v-model="pm.ipm_pena_meses" type="text" maxlength="3" name="ipm_pena_meses" placeholder="Meses"/>
                                </div>
                                <div class="col-lg-1 col-md-1 col-xs-1">
                                    <label>Dias</label><br>
                                    <the-mask mask="###" class="form-control" v-model="pm.ipm_pena_dias" type="text" maxlength="3" name="ipm_pena_dias" placeholder="Dias"/>
                                </div>
                                <div class="col-lg-3 col-md-3 col-xs-3">
                                    <label></label><br>
                                    <v-checkbox v-model="pm.ipm_transitojulgado_bl" name="ipm_transitojulgado_bl" true-value="S" false-value="0"
                                    text="Transitou em julgado?">
                                    </v-checkbox>
                                </div>
                                <div class="col-lg-2 col-md-2 col-xs-2">
                                    <label for="ipm_tipodapena">Tipo Pena</label><br>
                                    <select class="form-control" v-model="pm.ipm_tipodapena" name="ipm_tipodapena" >
                                        <option value="">Selecione</option>
                                        <option value="Detenção">Detenção</option>
                                        <option value="Reclusão">Reclusão</option>
                                    </select>
                                </div>
                                <div class="col-lg-3 col-md-3 col-xs-3">
                                    <label></label><br>
                                    <v-checkbox v-model="pm.ipm_restritiva_bl" name="ipm_restritiva_bl" true-value="S" false-value="0"
                                    text="Restritiva de direito?">
                                    </v-checkbox>
                                </div>
                            </template>
                            <!-- /dados caso condenado -->
                            <div class="col-lg-10 col-md-10 col-xs-10">
                                <label for="obs_txt">Observações</label><br>
                                <input class="numero form-control" :value="pm.obs_txt" type="text" name="obs_txt">
                            </div>
                        </template>
                        <!-- /reus -->
                        <div class="col-lg-1 col-md-1 col-xs 1">
                            <label>Cancelar</label><br>
                            <a class="btn btn-danger btn-block" @click="clear(false)"><i class="fa fa-times" style="color: white"></i></a>
                        </div>
                        <div class="col-lg-1 col-md-1 col-xs 1">
                            <template v-if="edit">
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
        <div class="card-footer"> 
            <template v-if="verReus">
                <div class="row bordaform" v-if="pms.length">
                    <div class="col-sm-12">
                        <table class="table table-hover">
                            <thead>
                                    <tr>
                                        <th class="col-sm-1">#</th>
                                        <th class="col-sm-1">RG</th>
                                        <template v-if="verReus">
                                            <th class="col-sm-1">Processo crime</th>
                                            <th class="col-sm-3">Julgamento</th>
                                            <th class="col-sm-2">Tipo pena</th>
                                            <th class="col-sm-2">Rest. direito</th>
                                        </template>
                                        <template v-else>
                                            <th class="col-sm-2">Nome</th>
                                            <th class="col-sm-2">Posto/Grad.</th>
                                            <th class="col-sm-2">Resultado</th>
                                        </template>
                                        <th class="col-sm-2">Ver/Editar/Apagar</th>
                                    </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(pm, index) in pms" :key="index">
                                    <td>{{ index + 1 }}</td>
                                    <td>{{ pm.rg}}</td>
                                    <template v-if="verReus">
                                        <td>{{ pm.ipm_processocrime | SN}}</td>
                                        <template v-if="pm.ipm_julgamento && pm.ipm_julgamento == 'Absolvido'">
                                            <td>{{ pm.ipm_julgamento }}</td>
                                            <td>-</td>
                                            <td>-</td>
                                        </template>
                                        <template v-else>
                                            <td>{{ pm.ipm_julgamento | SN}}: 
                                                {{pm.ipm_pena_anos}}<b>A</b>
                                                {{pm.ipm_pena_meses}}<b>M</b>
                                                {{pm.ipm_pena_dias}}<b>D</b> 
                                                Transitado? <b>{{pm.ipm_transitojulgado_bl | SN}}</b>
                                            </td>
                                            <td>{{ pm.ipm_tipodapena | SN}}</td>
                                            <td>{{ pm.ipm_restritiva_bl | SN}}</td>
                                        </template>
                                    </template>
                                    <template v-else>
                                        <td>{{ pm.nome }}</td>
                                        <td>{{ pm.cargo }}</td>
                                        <td>{{ pm.resultado | vazio}}</td>
                                    </template>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="First group">
                                            <a type="button" @click="showPM(pm.rg)" target="_blanck" class="btn btn-primary" style="color: white">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <a type="button" @click="replacePM(pm)" target="_blanck" class="btn btn-success" style="color: white">
                                                <i class="fa fa-edit"></i>
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
                <div v-if="!pms.length && only">
                    <h5>
                        <b>Não há registros</b>
                    </h5>
                </div> 
            </template>
            <template v-else>
                <div class="row bordaform" v-if="pms.length">
                    <div class="col-sm-12">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="col-sm-2">#</th>
                                    <th class="col-sm-2">RG</th>
                                    <th class="col-sm-2">Nome</th>
                                    <th class="col-sm-2">Posto/Grad.</th>
                                    <th class="col-sm-2">Resultado</th>
                                    <th class="col-sm-2">Ver/Editar/Apagar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(pm, index) in pms" :key="index">
                                    <td>{{ index + 1 }}</td>
                                    <td>{{ pm.rg }}</td>
                                    <td>{{ pm.nome }} {{pm.ipm_tipodapena}}</td>
                                    <td>{{ pm.cargo }}</td>
                                    <td>{{ pm.resultado | vazio}}</td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="First group">
                                            <a type="button" @click="showPM(pm.rg)" target="_blanck" class="btn btn-primary" style="color: white">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <a v-if="canEdit" type="button" @click="replacePM(pm)" target="_blanck" class="btn btn-success" style="color: white">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a v-if="canDelete" type="button"  @click="removePM(pm.id_envolvido, index)" class="btn btn-danger" style="color: white">
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
                        <b>Não há registros</b>
                    </h5>
                </div> 
            </template>
        </div>
        <v-modal v-if="confirmModal" effect="fade" width="400">
            <div slot="modal-header" class="modal-header">
                <h4 class="modal-title">Você tem certeza?</h4>
            </div>
            <div slot="modal-footer" class="modal-footer">
                <button type="button" class="btn btn-success" @click="respModal = true">Sim</button>
                <button type="button" class="btn btn-danger" @click="confirmModal = false">Não</button>
            </div>
        </v-modal>
    </div>
</template>

<script>
    import mixin from '../../mixins.js'
    import {TheMask} from 'vue-the-mask'
    import {Modal} from '../Vuestrap/Modal'
    export default {
        mixins: [mixin],
        components: {TheMask, Modal},
        props: {
            unique: {type: Boolean, default: false},
            situacao: {type: String, default: ''},
            idp: {type: String, default: ''},
            reu: {type: Boolean, default: false}, 
        },
        data() {
            return {
                cargo: '',
                nome: '',
                resultado: '',
                pm: [],
                proc: '',
                pms: [],
                finded: false,
                resultado: false,
                counter: 0,
                only: false,
                edit: '',
                verReus: false,
                confirmModal: false,
            }
        },
        filters: {
            vazio(value) {
                return (!value) ? 'Não há' : value
            },
            SN(value) {
                const v = (!value) ? '-' : value
                if(v.length < 2){
                    let t = (v.toUpperCase() == 'S' || v.toUpperCase() == 'Y' || v == 1) ? 'Sim' : 'Não'
                    return t
                }
                return v
            },
        },
        mounted(){
            this.verifyOnly
        },
        created() {
            this.dadosSession()
            let name = `${this.dproc}${this.idp}acusados` 
            const json = sessionStorage.getItem(name)
            const array = JSON.parse(json)
            this.pms = Array.isArray(array) ? array : []
            if(!this.pms.length) this.listPM()
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
            verifyOnly(){     
                this.only = (this.unique == true) ? true : false     
            },
            canEdit(){
                return this.permissions.includes('editar-acusado')
            },
            canDelete(){
                return this.permissions.includes('apagar-acusado')
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
                let urlIndex = `${this.getBaseUrl}api/dados/envolvido/${this.dproc}/${this.idp}/${this.situacao}` ;
                if(this.dproc && this.idp && this.situacao){
                    axios
                    .get(urlIndex)
                    .then((response) => {
                        this.pms = response.data
                        let name = this.dproc+this.idp+'acusados'
                        sessionStorage.setItem(name, JSON.stringify(this.pms))
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
                this.rg = pm.rg,
                this.nome = pm.nome,
                this.cargo = pm.cargo,
                this.resultado = pm.resultado,
                this.edit = pm.id_envolvido
                // this.titleSubstitute=" - Substituição do "+pm.situacao+" "+pm.nome
                this.add = true
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
            removePM(id, index){
                this.confimModal = true
                if(r){
                    let urlDelete = `${this.getBaseUrl}api/acusado/destroy/${id}`;
                    axios
                    .delete(urlDelete)
                    .then(this.pms.splice(index,1))
                    .then(this.clear(false))
                    .catch(error => console.log(error));
                }
            },
            clear(add){
                this.add = add
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
