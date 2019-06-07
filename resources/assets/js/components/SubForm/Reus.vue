<template>
    <div class="col-lg-12 col-md-12 col-xs-12 card">
        <div class="card-header">
            <h5><b>Réus</b>{{titleSubstitute}}</h5> 
        </div>
        <div v-if="edit">
            <div class="card-body" :class="edit ? 'bordaform' : ''" v-if="!only">
                <form id="formReus" name="formReus">
                    <input type="hidden" :name="'id_'+dproc" :value="idp">
                    <div class="col-lg-6 col-md-6 col-xs-6">
                        <label for="ipm_processocrime">Processo crime</label><br>
                        <select class="form-control" v-model="reu.ipm_processocrime" name="ipm_processocrime" >
                            <option value="">Selecione</option>
                            <option value="Denunciado">Denunciado</option>
                            <option value="Arquivado">Arquivado</option>
                        </select>
                    </div>
                    <div class="col-lg-6 col-md-6 col-xs-6">
                        <label for="ipm_julgamento">Julgamento</label><br>
                        <select class="form-control" v-model="reu.ipm_julgamento" name="ipm_julgamento" >
                            <option value="">Selecione</option>
                            <option value="Condenado">Condenado</option>
                            <option value="Absolvido">Absolvido</option>
                        </select>
                    </div>
                    <!-- dados caso condenado -->
                    <template v-if="reu.ipm_julgamento == 'Condenado'">
                        <div class="col-lg-1 col-md-1 col-xs-1">
                            <label>Anos</label><br>
                            <the-mask mask="###" class="form-control" v-model="reu.ipm_pena_anos" type="text" maxlength="3" name="ipm_pena_anos" placeholder="Anos"/>
                        </div>
                        <div class="col-lg-1 col-md-1 col-xs-1">
                            <label>Meses</label><br>
                            <the-mask mask="###" class="form-control" v-model="reu.ipm_pena_meses" type="text" maxlength="3" name="ipm_pena_meses" placeholder="Meses"/>
                        </div>
                        <div class="col-lg-1 col-md-1 col-xs-1">
                            <label>Dias</label><br>
                            <the-mask mask="###" class="form-control" v-model="reu.ipm_pena_dias" type="text" maxlength="3" name="ipm_pena_dias" placeholder="Dias"/>
                        </div>
                        <div class="col-lg-3 col-md-3 col-xs-3">
                            <label></label><br>
                            <v-checkbox v-model="reu.ipm_transitojulgado_bl" name="ipm_transitojulgado_bl" true-value="S" false-value="0"
                            text="Transitou em julgado?">
                            </v-checkbox>
                        </div>
                        <div class="col-lg-2 col-md-2 col-xs-2">
                            <label for="ipm_tipodapena">Tipo Pena</label><br>
                            <select class="form-control" v-model="reu.ipm_tipodapena" name="ipm_tipodapena" >
                                <option value="">Selecione</option>
                                <option value="Detenção">Detenção</option>
                                <option value="Reclusão">Reclusão</option>
                            </select>
                        </div>
                        <div class="col-lg-3 col-md-3 col-xs-3">
                            <label></label><br>
                            <v-checkbox v-model="reu.ipm_restritiva_bl" name="ipm_restritiva_bl" true-value="S" false-value="0"
                            text="Restritiva de direito?">
                            </v-checkbox>
                        </div>
                    </template>
                    <!-- /dados caso condenado -->
                    <div class="col-lg-10 col-md-10 col-xs-10">
                        <label for="obs_txt">Observações</label><br>
                        <input class="numero form-control" :value="reu.obs_txt" type="text" name="obs_txt">
                    </div>
                    <div class="col-lg-1 col-md-1 col-xs-1">
                        <label>Cancelar</label><br>
                        <a class="btn btn-danger btn-block" @click="clear(true)"><i class="fa fa-times" style="color: white"></i></a>
                    </div>
                    <div class="col-lg-1 col-md-1 col-xs-1">
                        <label>Editar</label><br>
                        <a class="btn btn-success btn-block" :disabled="liberaCampo(reu)" @click="editReu"><i class="fa fa-plus" style="color: white"></i></a>
                    </div>
                </form>
            </div>
        </div>
        <div class="card-footer"> 
            <div class="row bordaform" v-if="reus.length">
                <div class="col-sm-12">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th class="col-sm-1">#</th>
                                <th class="col-sm-1">RG</th>
                                <th class="col-sm-1">Processo crime</th>
                                <th class="col-sm-3">Julgamento</th>
                                <th class="col-sm-2">Tipo pena</th>
                                <th class="col-sm-2">Rest. direito</th>
                                <th class="col-sm-2">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(reu, index) in reus" :key="index">
                                <td>{{ index + 1 }}</td>
                                <td>{{ reu.rg}}</td>
                                <td>{{ reu.ipm_processocrime | SN}}</td>
                                <template v-if="reu.ipm_julgamento && reu.ipm_julgamento == 'Absolvido'">
                                    <td>{{ reu.ipm_julgamento }}</td>
                                    <td>-</td>
                                    <td>-</td>
                                </template>
                                <template v-else>
                                    <td>{{ reu.ipm_julgamento | SN}}: 
                                        {{reu.ipm_pena_anos}}<b>A</b>
                                        {{reu.ipm_pena_meses}}<b>M</b>
                                        {{reu.ipm_pena_dias}}<b>D</b> 
                                        Transitado? <b>{{reu.ipm_transitojulgado_bl | SN}}</b>
                                    </td>
                                    <td>{{ reu.ipm_tipodapena | SN}}</td>
                                    <td>{{ reu.ipm_restritiva_bl | SN}}</td>
                                </template>
                                <td>
                                    <div class="btn-group">
                                        <a type="button"  @click="replaceReu(reu)" class="btn btn-success" style="color: white">
                                            <i class="fa fa-edit"></i> 
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>  
            <div v-if="!reus.length && only">
                <h5>
                    <b>Não há registros</b>
                </h5>
            </div> 
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
            situacao: {type: String, default: ''},
            idp: {type: String, default: ''},
        },
        data() {
            return {
                reu: [],
                reus: [],
                edit: false,
                idedit: '',
                resultado: false,
                only: false,
                titleSubstitute: ''
            }
        },
        filters: {
            SN(value) {
                const v = (!value) ? '-' : value
                if(v.length < 2){
                    let t = (v.toUpperCase() == 'S' || v.toUpperCase() == 'Y' || v == 1) ? 'Sim' : 'Não'
                    return t
                }
                return v
            },
        },
        created() {
            this.getBaseUrl
            this.verifyOnly
            this.listReus()
        },
        watch:{
            reus:{
                handler: function(r){
                    let name = `${this.dproc}${this.idp}acusados`
                    localStorage.name = r
                },
                deep: true
            }
        },
        computed:{
        },
        methods: {
            listReus(){
                let name = `${this.dproc}${this.idp}acusados`
                const json = sessionStorage.getItem(name)
                const array = JSON.parse(json)
                this.reus = Array.isArray(array) ? array : []
            },
            showReu(rg){
                let urlIndex = `${this.getBaseUrl}fdi/${rg}/ver`;                
                window.open(urlIndex, "_blank")
            },
            replaceReu(reu){
                this.reu = reu,
                this.titleSubstitute = ` - Edição ${reu.nome}/RG:${reu.rg}`
                this.idedit = reu.id_envolvido
                this.edit = true
            },
            editReu(){
                let urledit = `${this.getBaseUrl}api/acusado/edit/${this.idedit}`;
                let formData = document.getElementById('formReus');
                let data = new FormData(formData);
                
                axios.post( urledit,data)
                .then(() => {
                    this.atualizaReus()
                })
                .catch((error) => console.log(error));
            },
            atualizaReus(){
                let urlIndex = `${this.getBaseUrl}api/dados/envolvido/${this.dproc}/${this.idp}/${this.situacao}` ;
                if(this.dproc && this.idp && this.situacao){
                    axios
                    .get(urlIndex)
                    .then((response) => {
                        this.reus = response.data
                        let name = `${this.dproc}${this.idp}acusados`
                        sessionStorage.setItem(name, JSON.stringify(this.reus))
                    })
                    .then(this.clear(false))//limpa a busca
                    .catch(error => console.log(error));
                }
            },
            liberaCampo(reu){
                if(reu.ipm_processocrime == 'Denunciado' && reu.ipm_julgamento == 'Absolvido') return true
                if(reu.ipm_processocrime != 'Denunciado' && reu.ipm_julgamento == 'Condenado' && reu.ipm_tipodapena) return true
            },
            clear(edit){
                this.edit = edit
                this.reu = []
                this.titleSubstitute = ''
            }
        },
    }
</script>

<style scoped>

</style>

