<template>
    <div class="col-lg-12 col-md-12 col-xs-12 card">
        <div class="card-header">
            <template v-if="destino">
                <h5><b>Procedimento(s) de Resultante (apenas se houver)</b></h5> 
            </template>
            <template v-else>
                <h5><b>Procedimento(s) de Origem (apenas se houver)</b></h5> 
            </template>
        </div>
        <div class="card-body" :class="add ? 'bordaform' : ''" v-if="!only && !show">
            <div v-if="!add">
                <template v-if="destino">
                    <button @click="add = !add" class="btn btn-success btn-block"><i class="fa fa-plus"></i> Adicionar procedimento resultante</button>
                </template>
                <template v-else>
                    <button @click="add = !add" class="btn btn-success btn-block"><i class="fa fa-plus"></i> Adicionar documento de origem</button>
                </template>
            </div>
            <div v-else>
                <div id="ligacaoForm1" class="row">
                    <form id="formProcDestino" name="formProcDestino">
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
                        <template v-if="toEdit && !show">
                                <label>Editar</label><br>
                                <a class="btn btn-success btn-block"  @click="editProcedOrigem"><i class="fa fa-plus" style="color: white"></i></a>
                            </template>
                             <template v-else>
                            <label>Adicionar</label><br>
                            <a class="btn btn-success btn-block" :disabled="!finded" @click="createProc"><i class="fa fa-plus" style="color: white"></i></a>
                            </template>
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
                                <th class="col-sm-2">Proc</th>
                                <th class="col-sm-3">Ref.</th>
                                <th class="col-sm-3">Ano</th>
                                <th v-if="!show" class="col-sm-2">Ver/Apagar Ligação</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(procedimento, index) in procedimentos" :key="index">
                                <td>
                                    {{ index + 1 }}
                                </td>
                                <td>
                                    {{ procedimento.origem_proc | uppercase}} 
                                </td>
                                <td>
                                    {{ procedimento.origem_sjd_ref }}
                                </td>
                                <td>
                                    {{ procedimento.origem_sjd_ref_ano }}
                                </td>
                                <td v-if="!show">
                                    <div class="btn-group" role="group" aria-label="First group">
                                        <a type="button" @click="replaceProcedOrigem(procedimento)" target="_blanck" class="btn btn-success" style="color: white">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a v-if="canDelete" type="button"  @click="removeProc(procedimento.id_ligacao)" class="btn btn-danger" style="color: white">
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
    import mixin from '../../mixins.js'
    export default {
        mixins: [mixin],
        props: {
            show: {type: Boolean, default: false},
            unique: {type: Boolean, default: false},
            destino: {type: Boolean, default: false},
            idp: {type: String, default: ''},
            dproc: {type: String, default: ''},
            dref: {type: String, default: ''},
            dano: {type: String, default: ''},
        },
        data() {
            return {
                add: false,
                proc: '',
                ref: '',
                ano: '',
                opm: '',
                action: 'editar',
                procedimentos: [],
                action: 'proc',
                params: '',
                finded: false,
                counter: 0,
                id_proc: '',
                origin: '',
                only: false,
                toEdit: '',
                edit_proc: this.idp,
            }
        },
        // depois de montado
        mounted(){
            this.verifyOnly
            this.listProc()
            this.verifyOnly()
        },
        filters: {
            uppercase: function(v) {
                if(!v) return ''
                return v.toUpperCase();
            }
        },
        computed: {
            years () {
                const year = new Date().getFullYear()
                return Array.from({length: year - 2008}, (value, index) => 2009 + index)
            },

            canDelete(){
                return this.$root.hasPermission('apagar-procedimento-origem')
            },
            
        },
        methods: {
            searchProc(){
                this.opm = ''
                let searchUrl = `${this.$root.baseUrl}api/dados/proc/${this.proc}/${this.ref}/${this.ano}`;
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
                let urlCreate = `${this.$root.baseUrl}api/ligacao/store`

                let formProcDestino = document.getElementById('formProcDestino');
                let data = new FormData(formProcDestino);

                axios.post( urlCreate,data)
                .then(this.listProc)
                .catch((error) => {
                    console.log(error)
                    this.erro = "Erro ao enviar arquivo"
                });
            },
            replaceProcedOrigem(procedimento){
               console.table(procedimento)
               this.proc = procedimento.proc,
               this.ref = procedimento.ref,
               this.ano = procedimento.ano,
               this.opm = procedimento.opm,
               this.toEdit = procedimento.id_ligacao,

               this.add = true   
            },
            editProcedOrigem(){
              let urledit = `${this.$root.baseUrl}api/ligacao/update/${this.toEdit}`
              
              let formData = document.getElementById('formProcDestino');
              let data = new FormData(formData);

              axios.post( urledit,data)
              .then(this.listProc)
              .catch((error) => console.log(error));
            },
            // listagem dos arquivos existentes
            listProc(){
                const urlIndex = (this.idp) 
                ? `${this.$root.baseUrl}api/ligacao/list/${this.dproc}/${this.idp}`
                : `${this.$root.baseUrl}api/ligacao/list/${this.dproc}/${this.dref}/${this.dano}`
                console.log(urlIndex)
                axios
                .get(urlIndex)
                .then((response) => {
                    this.procedimentos = response.data
                    
                })
                .then(this.clear)//limpa a busca
                .catch(error => console.log(error));
            },
            showProc(proc, ref, ano){
                let urlIndex = `${this.$root.baseUrl}${proc}/${this.action}/${ref}/${ano}`;                
                window.open(urlIndex, "_blank")
            },
            // apagar arquivo
            removeProc(id){
                if(confirm('Você tem certeza?')){
                    let urlDelete = `${this.$root.baseUrl}api/ligacao/destroy/${id}`
                    axios
                    .delete(urlDelete)
                    .then(this.listProc)//chama list para atualizar
                    .catch(error => console.log(error));
                }
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
            transation(happen,type) {
                let msg = this.words(type)
                if(happen) { // se deu certo
                        this.listProc()
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
                this.proc = ''
                this.ref = ''
                this.ano = ''
                this.opm = ''
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
