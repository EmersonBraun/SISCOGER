<template>
    <div>
        <div class="card bordaform">
            <!-- titulo -->
            <div v-if="title" class="card-header">
                <div class="row">
                    <div class="col-sm-10">
                        <h4>{{ title }}</h4>
                    </div>
                    <!-- <div class="col-md-5"></div> -->
                    <div v-if="candelete" class="col align-self-end">
                        <div class="btn-group">
                            <a type="button" @click="showUploaded" target="_black" class="btn" :class="!del ? 'btn-info' : 'btn-default'">
                                Ativos
                            </a>
                            <a type="button" @click="showDeleted" class="btn" :class="del ? 'btn-info' : 'btn-default'">
                                Apagados
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- form -->
            <div v-if="!only" class="card-body">
                <!-- botão arquivo -->
                <label v-if="!forUpload && !view" class="btn btn-primary bgicon" :for="name">
                    Selecionar arquivo
                    <input @change="verifyFile" :id="name" :name="name" ref="file" type='file' style="display:none">
                </label>
                <!-- ações -->
                <div v-if="forUpload" class="row">
                    <div class="col-sm-3">
                        <label for="data_arquivo">Data do documento</label><br>
                        <v-datepicker name="data_arquivo" placeholder="dd/mm/aaaa" v-model="data_arquivo" clear-button></v-datepicker>
                    </div>
                    <div class="col-sm-3">
                        <label for="data">Observações</label><br>
                        <input name="obs" type="text" v-model="obs" class="form-control">
                    </div>
                    <div class="col-sm-3">
                        <label for="data">Nome Original:</label>
                        <span v-if="file.name">{{ file.name }}</span>
                    </div>
                    <div class="col-sm-3">
                        <label for="data">Ações</label><br>
                        <a @click="cancelFile()" class="btn btn-danger bgicon" style="color: white">
                            <i class="fa fa-undo"></i> Cancelar
                        </a>
                        <a @click="createFile()" class="btn btn-primary bgicon" style="color: white">
                            <i class="fa fa-cloud-upload"></i> Upload
                        </a>
                    </div>
                </div>
                <div v-if="error.length" style="color: red">
                    <p v-for="(e, index) in error" :key="index">{{e}}</p>
                </div>
                <!-- barra de progresso -->
                <div  v-if="progressBar" class="progress" style="padding-top: 3px">
                    <div class="progress-bar" role="progressbar" :style="{'width' : width + '%'}" :aria-valuenow="width" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                
            </div>
            <!-- uploaded -->
            <template v-if="!del">
                <div class="card-footer"> 
                    <div v-if="uploaded.length" class="row">
                        <div class="col-sm-12">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th v-if="!only" class="col-sm-1">#</th>
                                        <th class="col-sm-2">Nome aquivo</th>
                                        <th class="col-sm-1">Ref/Ano</th>
                                        <th class="col-sm-2">Tamanho - Ext.</th>
                                        <th class="col-sm-1">Data</th>
                                        <th class="col-sm-3">Obs.</th>
                                        <th class="col-sm-2">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(u, index) in uploaded" :key="index">
                                        <td v-if="!only">{{ u.id }}</td>
                                        <td>{{ u.name}}</td>
                                        <td>{{ u.sjd_ref}}/{{ u.sjd_ref_ano}}</td>
                                        <td>{{ u.size | toMB}} MB - {{ u.mime}}</td>
                                        <td>{{ u.data_arquivo}}</td>
                                        <td>{{ u.obs | hasObs}}</td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="First group">
                                                <a type="button" @click="showFile(u.hash)" target="_black" class="btn btn-primary" style="color: white">
                                                    <i class="fa fa-eye"></i> Ver
                                                </a>
                                                <a type="button" @click="downloadFile(u.id)" target="_black" class="btn btn-success" style="color: white">
                                                    <i class="fa fa-download"></i> Download
                                                </a>
                                                <a  v-if="u.deleted_at == null" type="button" @click="deleteFile(u.id)" class="btn btn-danger" style="color: white">
                                                    <i class="fa fa-trash"></i> Apagar
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div> 
                    <!-- Sem arquivos -->
                    <div v-if="!uploaded.length && only" class="row">
                        <div class="col-sm-12">
                            <p>Não há arquivo</p>
                        </div>
                    </div>
                </div>
            </template>
            <!-- Apagados -->
            <template v-if="del">
                <div class="card-footer"> 
                    <div v-if="apagados.length" class="row">
                        <div class="col-sm-12">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th class="col-sm-1">#</th>
                                        <th class="col-sm-2">Nome aquivo</th>
                                        <th class="col-sm-1">Ref/Ano</th>
                                        <th class="col-sm-2">Tamanho - Ext.</th>
                                        <th class="col-sm-1">Data</th>
                                        <th class="col-sm-3">Obs.</th>
                                        <th class="col-sm-2">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(a, i) in apagados" :key="i">
                                        <td>{{ a.id }}</td>
                                        <td>{{ a.name}}</td>
                                        <td>{{ a.sjd_ref}}/{{ a.sjd_ref_ano}}</td>
                                        <td>{{ a.size | toMB}} MB - {{ a.mime}}</td>
                                        <td>{{ a.data_arquivo}}</td>
                                        <td>{{ a.obs | hasObs}}</td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="First group">
                                                <a type="button" @click="showFile(a.hash)" target="_black" class="btn btn-primary" style="color: white">
                                                    <i class="fa fa-eye"></i> Ver
                                                </a>
                                                <a type="button" @click="downloadFile(u.id)" target="_black" class="btn btn-success" style="color: white">
                                                    <i class="fa fa-download"></i> Download
                                                </a>
                                                <!-- <a type="button" @click="removeFile(a.id)" class="btn btn-danger" style="color: white">
                                                    <i class="fa fa-trash"></i> Destruir
                                                </a> -->
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div> 
                    <!-- Sem arquivos -->
                    <div v-else class="row">
                        <div class="col-sm-12">
                            <p>Não há arquivo</p>
                        </div>
                    </div>
                </div>
            </template>
        </div>
        <br>
    </div>

</template>

<script>
    import {Checkbox} from '../Vuestrap/Checkbox'
    import {Datepicker} from '../Vuestrap/Datepicker'
    export default {
    components: {Checkbox,Datepicker},
    props: {
        title: {type: String},
        name: {type: String},
        proc: {type: String},
        idp: {type: String},
        ext: {type: Array, default: ['pdf']},
        candelete: {default: ''},
        unique: {type: Boolean, default: true},
    },
    data() {
        return {
            file: '',
            uploaded: [],
            apagados: [],
            forUpload: false,
            error: [],
            progressBar: false,
            width: 0,
            only: false,
            headers: {
                'Content-Type': 'multipart/form-data'
                },
            countup: 0,
            countap: 0,
            filetype: '',
            action: 'fileupload',
            view: false,
            data_arquivo: '',
            rg: '',
            nome_original: '',
            obs: '',
            del: false
        }
        
    },
    beforeMount(){
        this.listFile(); 
        this.data_arquivo = this.today
    },
    watch: {
        countup() {
            this.verifyOnly;
        },
    },
    filters:{
        toMB(value){
            if (!value) return ''
            let MB = 1048576
            value = value / MB
            return  value.toFixed(2)
        },
        hasObs(value){
            if (!value) return 'Não há'
            return  value
        }
    },
    computed:{
        getBaseUrl(){
            // URL completa
            let getUrl = window.location;
            // dividir em array
            let pathname = getUrl.pathname.split('/') 
            this.view = (pathname[3] == 'ver') ? true : false       
            let baseUrl = `${getUrl.protocol}//${getUrl.host}/${pathname[1]}/api/`;
            
        return baseUrl;
        },
        // verificar se é upload unico
        verifyOnly(){         
            this.only = (this.unique == true && this.countup > 0) ? true : false
        },
        verifyType(){
            this.filetype = this.file.type.split('/')[1];
            if (!this.ext.includes(this.filetype)) {
                this.error.push(`Extenção inválida! deve ser: ${this.ext.join(', ')}`);
                return false
            }else{return true}
        },
        verifySize(){
            let fileSize = this.file.size;
            let qtdMB = 5
            let maxSize = 1048576 * qtdMB
            if (fileSize > maxSize) {
                this.error.push(`Tamanho excedido! deve ser menor que ${qtdMB}MB `);
                return false
            }else{return true}    
        },
        today() {
            let today = new Date();
            let dd = String(today.getDate()).padStart(2, '0');
            let mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
            let yyyy = today.getFullYear();

            today = `${dd}/${mm}/${yyyy}`;
            return today
        },
    },
    methods: {
        verifyFile(){
            this.error = []
            this.file = this.$refs.file.files[0]
            let type = this.verifyType
            let size = this.verifySize
            this.forUpload = (type && size) ? true : false
            if(!this.forUpload) this.file = ''
        },
        createFile(){
            let urlCreate = `${this.getBaseUrl}${this.action}/store`;
            
            let formData = new FormData();
            formData.append('file', this.file);
            formData.append('name', this.name);
            formData.append('rg', this.rg);
            formData.append('id_proc', this.idp);
            formData.append('proc', this.proc);
            formData.append('ext', this.filetype);
            formData.append('nome_original', this.nome_original);
            formData.append('data_arquivo', this.data_arquivo);
            formData.append('obs', this.obs);

            axios.post( urlCreate,formData,{headers: this.headers})
            .then(this.progress())
            .catch((error) => {
                console.log(error)
                this.erro = "Erro ao enviar arquivo"
            });
        },
        listFile(){
            let urlIndex = `${this.getBaseUrl}${this.action}/list/${this.proc}/${this.idp}/${this.name}`;
            axios
            .get(urlIndex)
            .then((response) => {
                this.uploaded = response.data.list
                this.apagados = response.data.apagados
                this.countup = response.data.list.length
                this.countap = response.data.list.length
            })
            .catch(error => console.log(error));
        },
        showFile(hash){
            let urlShow = `${this.getBaseUrl}${this.action}/show/${this.proc}/${this.idp}/${this.name}/${hash}`;
            window.open(urlShow, "_blank")
        },
        downloadFile(id) {
            let urlIndex = `${this.getBaseUrl}${this.action}/download/${id}`;
            window.open(urlIndex, "_blank")
        },
        deleteFile(id){
            let urlDelete = `${this.getBaseUrl}${this.action}/delete/${id}`;
            axios
            .delete(urlDelete)
            .then((response) => this.listFile())//chama list para atualizar
            .catch(error => console.log(error));
        },
        removeFile(id){
            let urlDelete = `${this.getBaseUrl}${this.action}/destroy/${id}`;
            axios
            .delete(urlDelete)
            .then((response) => this.listFile())//chama list para atualizar
            .catch(error => console.log(error));
        },
        cancelFile(){
            this.file ='';
            this.forUpload = false;
        },
        showUploaded(){
            this.del = false
        },
        showDeleted(){
            this.del = true
        },
        progress(){
            this.progressBar = true;
            setTimeout(()=>{ 
                    if(this.width < 100) {
                        this.width += 5; 
                        this.progress();
                    }else{
                        this.width = 0;
                        this.listFile();
                        this.cancelFile(); 
                        this.progressBar = false;
                    }
                }, 25);  
            },
        }
    }
</script>

<style scope>
    .bgicon{
        color: white;
    }
    .align-self-end {
        -ms-flex-item-align: end !important;
        align-self: flex-end !important;
    }
    .col {
        -ms-flex-preferred-size: 0;
        flex-basis: 0;
        -ms-flex-positive: 1;
        flex-grow: 1;
        max-width: 100%;
    }
</style>