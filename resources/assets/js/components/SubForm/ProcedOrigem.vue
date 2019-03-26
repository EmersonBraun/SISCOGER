<template>
    <div class="col-lg-12 col-md-12 col-xs-12 card">
        <div class="card-header">
            <h5><b>Procedimento(s) de Origem (apenas se houver)</b></h5> 
        </div>
        <div class="card-body" :class="add ? 'bordaform' : ''" v-if="!only">
            <div v-if="!add">
                <button @click="add = !add" class="btn btn-success btn-block"><i class="fa fa-plus"></i> Adicionar documento de origem</button>
            </div>
            <div v-else>
                <div id="ligacaoForm1" class="row">
                    <form id="formData" name="formData">
                        <input type="hidden" :name="id_proc" :value="idp">
                        <input type="hidden" name="origem_proc" :value="origin">
                        <input type="hidden" name="destino_proc" :value="dproc">
                        <input type="hidden" name="destino_sjd_ref" :value="dref">
                        <input type="hidden" name="destino_sjd_ref_ano" :value="dano">
                        <div class="col-lg-3 col-md-3 col-xs-3 form-group">
                            <label for="origem_proc">Processo/Procedimento</label><br>
                            <select v-model="proc" name="origem_proc" class="form-control">
                                <option value="">Escolha</option>
                                <option value="ipm">IPM</option>
                                <option value="sindicancia">SINDICÂNCIA</option>
                                <option value="cd">CD</option>
                                <option value="cj">CJ</option>
                                <option value="apfdc">APFDC</option>
                                <option value="apfdm">APFDM</option>
                                <option value="fatd">FATD</option>
                                <option value="iso">ISO</option>
                                <option value="desercao">DESERÇÃO</option>
                                <option value="it">IT</option>
                                <option value="adl">ADL</option>
                                <option value="pad">PAD</option>
                                <option value="sai">SAI</option>
                                <option value="proc_outros">PROC. OUTROS</option>
                            </select>
                        </div>
                        <div class="col-lg-2 col-md-2 col-xs 2">
                            <label for="origem_sjd_ref">Referência</label><br>
                            <input class="numero form-control" v-model="ref" type="text" maxlength="4" name="origem_sjd_ref" placeholder="Nº" value="">
                        </div>
                        <div class="col-lg-2 col-md-2 col-xs 2">
                            <label for="origem_sjd_ref_ano">Ano</label><br>
                            <select v-model="ano" name="origem_sjd_ref_ano" class="form-control">
                                <option v-for="year in years" :value="year" :key="year">{{ year }}</option>
                            </select>
                        </div>
                        <div class="col-lg-1 col-md-1 col-xs 1">
                            <label>Buscar</label><br>
                            <a class="btn btn-info btn-block" @click="searchProc()"><i class="fa fa-search" style="color: white"></i></a>
                        </div>

                        <div class="col-lg-2 col-md-2 col-xs 2">
                            <label>OM</label><br>
                            <input readonly type="text" size="35" name="origem_opm" placeholder="Apenas para conferência" :value="opm" class="form-control">
                        </div>
                        <div class="col-lg-1 col-md-1 col-xs 1">
                            <label>Cancelar</label><br>
                            <a class="btn btn-danger btn-block" @click="cancel"><i class="fa fa-times" style="color: white"></i></a>
                        </div>
                        <div class="col-lg-1 col-md-1 col-xs 1">
                            <label>Adicionar</label><br>
                            <a class="btn btn-success btn-block" :disabled="!finded" @click="createProc"><i class="fa fa-plus" style="color: white"></i></a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="card-footer"> 
            <div class="row bordaform" v-if="procedimentos.length">
                <div class="col-sm-12">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th class="col-sm-2">#</th>
                                <th class="col-sm-8">Proc. REF/ANO</th>
                                <th class="col-sm-2">Ver/Apagar Ligação</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(procedimento, index) in procedimentos" :key="index">
                                <td>
                                    {{ index + 1 }}
                                </td>
                                <td>
                                    {{ procedimento.origem_proc | uppercase}} {{ procedimento.origem_sjd_ref }}/{{ procedimento.origem_sjd_ref_ano }}
                                </td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="First group">
                                        <a type="button" @click="showProc(procedimento.origem_proc, procedimento.origem_sjd_ref, procedimento.origem_sjd_ref_ano)" target="_blanck" class="btn btn-primary" style="color: white">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a type="button"  @click="removeProc(procedimento.id_ligacao)" class="btn btn-danger" style="color: white">
                                            <i class="fa fa-trash"></i> 
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                
                    </table>
                </div>
            </div>  
             <div v-else-if="!procedimentos.length && only">
                <h5>
                    <b>Não há registtros</b>
                </h5>
            </div> 
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            unique: {type: Boolean, default: false},
        },
        data() {
            return {
                proc: '',
                ref: '',
                ano: '',
                opm: '',
                dproc: '',
                dref: '',
                dano: '',
                action: 'editar',
                procedimentos: [],
                add: false,
                action: 'proc',
                params: '',
                finded: false,
                counter: 0,
                id_proc: '',
                idp: '',
                origin: '',
                only: false,
            }
        },
        // depois de montado
        beforeMount(){
            this.listProc()
            this.verifyOnly()
        },
        filters: {
            uppercase: function(v) {
            return v.toUpperCase();
            }
        },
        computed: {
            years () {
                const year = new Date().getFullYear()
                return Array.from({length: year - 2008}, (value, index) => 2009 + index)
            },
            
        },
        methods: {
            searchProc(){
                this.opm = ''
                let searchUrl = this.getBaseUrl() + 'ajax/dados/proc/' + this.proc + '/' + this.ref + '/' + this.ano;
                if(this.proc && this.ref && this.ano){
                    axios
                    .get(searchUrl)
                    .then((response) => {
                        this.opm = response.data.opm
                        this.idp = response.data.id
                        this.finded = response.data.success
                    })
                    .catch(error => console.log(error));
                }
            },
            createProc(){
                let urlCreate = this.getBaseUrl() + 'ajax/ligacao/store';

                let formData = document.getElementById('formData');
                let data = new FormData(formData);

                axios.post( urlCreate,data)
                .then(this.listProc)
                .catch((error) => {
                    console.log(error)
                    this.erro = "Erro ao enviar arquivo"
                });
            },
            // listagem dos arquivos existentes
            listProc(){
                let urlIndex = this.getBaseUrl() + 'ajax/ligacao/list/' + this.dproc + '/' + this.dref + '/' + this.dano;
                axios
                .get(urlIndex)
                .then((response) => {
                    this.procedimentos = response.data
                    
                })
                .then(this.clear)//limpa a busca
                .catch(error => console.log(error));
            },
            showProc(proc, ref, ano){
                let urlIndex = this.getBaseUrl() + proc + '/'+ this.action +'/' + ref + '/' + ano;                
                window.open(urlIndex, "_blank")
            },
            // apagar arquivo
            removeProc(id){
                let urlDelete = this.getBaseUrl() + 'ajax/ligacao/destroy/' + id;
                axios
                .delete(urlDelete)
                .then(this.listProc)//chama list para atualizar
                .catch(error => console.log(error));
            },
            verifyOnly(){     
                if(this.unique == true){
                    this.only = true;
                }else{
                    this.only = false;
                }      
            },
            cancel(){
                this.add = false
                this.proc = ''
                this.ref = ''
                this.ano = ''
                this.opm = ''
            },
            clear(){
                this.proc = ''
                this.ref = ''
                this.ano = ''
                this.opm = ''
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
        },
        watch: {
            proc() {
                let name = (this.proc == 'apfdc' || this.proc == 'apfdm') ? 'apfd' : this.proc
                this.id_proc = 'id_'+name  
                this.origin = name
            },
        },
    }
</script>

<style scoped>

</style>
