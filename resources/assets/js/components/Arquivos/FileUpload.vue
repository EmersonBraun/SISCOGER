<template>
    <div class="col-sm-12">
        <div class="card bordaform">
            <div v-if="title" class="card-header">
                <h4>{{ title }}</h4>
            </div>
            <div v-if="!only" class="card-body">

                <label v-if="!forUpload" class="btn btn-primary bgicon" for='file'>
                    Selecionar arquivo
                    <input @change="verifyFile" id="file" ref="file" type='file' style="display:none">
                </label>
                
                <a v-if="forUpload" @click="cancelFile()" class="btn btn-danger bgicon" style="color: white">
                    <i class="fa fa-undo"></i> Cancelar
                </a>
                <a v-if="forUpload" @click="createFile()" class="btn btn-primary bgicon" style="color: white">
                    <i class="fa fa-cloud-upload"></i> Upload
                </a>

                <span v-if="file.name">
                    {{ file.name }}
                </span>
                <div v-if="error.length" style="color: red">
                    <p v-for="(e, index) in error" :key="index">{{e}}</p>
                </div>

                <div  v-if="progressBar" class="progress" style="padding-top: 3px">
                    <div class="progress-bar" role="progressbar" :style="{'width' : width + '%'}" :aria-valuenow="width" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                
            </div>

            <div v-if="uploaded.length" class="card-footer"> 
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th v-if="!only" class="col-sm-2">#</th>
                                    <th class="col-sm-2">Aquivo</th>
                                    <th class="col-sm-1">Ref.</th>
                                    <th class="col-sm-1">Ano</th>
                                    <th class="col-sm-2">Tamanho</th>
                                    <th class="col-sm-2">Ext.</th>
                                    <th class="col-sm-2">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(u, index) in uploaded" :key="index">
                                    <td v-if="!only">{{ counter = u.id }}</td>
                                    <td>{{ u.name}}</td>
                                    <td>{{ u.sjd_ref}}</td>
                                    <td>{{ u.sjd_ref_ano}}</td>
                                    <td>{{ u.size | toMB}} MB</td>
                                    <td>{{ u.mime}}</td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="First group">
                                            <a type="button" @click="showFile(u.id)" target="_black" class="btn btn-primary" style="color: white">
                                                <i class="fa fa-eye"></i> Ver
                                            </a>
                                            <a  v-if="u.deleted_at == null" type="button" @click="deleteFile(u.id)" class="btn btn-danger" style="color: white">
                                                <i class="fa fa-trash"></i> Apagar
                                            </a>
                                            <a v-if="u.deleted_at !== null && canDelete" type="button" @click="removeFile(u.id)" class="btn btn-danger" style="color: white">
                                                <i class="fa fa-trash"></i> Destruir
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>    
            </div>
        </div>
    </div>

</template>

<script>
    export default {
    props: {
        title: {type: String},
        name: {type: String},
        proc: {type: String},
        idp: {type: String},
        ext: {type: Array, default: ['pdf']},
        canDelete: {type: Boolean, default: true},
        unique: {type: Boolean, default: false},
    },
    data() {
        return {
        file: '',
        uploaded: [],
        forUpload: false,
        error: [],
        progressBar: false,
        width: 0,
        only: false,
        headers: {
            'Content-Type': 'multipart/form-data'
            },
        counter: 0,
        filetype: '',
        action: 'fileupload',
        }
    },
    beforeMount(){
        this.listFile(); 
    },
    watch: {
        counter() {
            this.verifyOnly;
        },
    },
    filters:{
        toMB(value){
            if (!value) return ''
            let MB = 1048576
            value = value / MB
            return  value.toFixed(2)
        }
    },
    computed:{
        getBaseUrl(){
            // URL completa
            let getUrl = window.location;
            // dividir em array
            let pathname = getUrl.pathname.split('/')              
            let baseUrl = getUrl.protocol + "//" + getUrl.host + "/" + pathname[1]+"/";
            
        return baseUrl;
        },
        // verificar se é upload unico
        verifyOnly(){         
            if(this.unique == true && this.counter > 0){
                this.only = true;
            }else{
                this.only = false;
            }
            
        },
        verifyType(){
            this.filetype = this.file.type.split('/')[1];
            if (!this.ext.includes(this.filetype)) {
                this.error.push('Extenção inválida! deve ser: ' + this.ext.join(', '));
                return false
            }else{
                return true
            }
            
        },
        verifySize(){
            let fileSize = this.file.size;
            let qtdMB = 5
            let maxSize = 1048576 * qtdMB
            if (fileSize > maxSize) {
                this.error.push('Tamanho excedido! deve ser menor que '+qtdMB+'MB ');
                return false
            }else{
                return true
            }    
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
            let urlCreate = this.getBaseUrl + this.action + '/store';
            
            let formData = new FormData();
            formData.append('file', this.file);
            formData.append('name', this.name);
            formData.append('id_proc', this.idp);
            formData.append('proc', this.proc);
            formData.append('ext', this.filetype);

            axios.post( urlCreate,formData,{headers: this.headers})
            .then(this.progress())
            .catch((error) => {
                console.log(error)
                this.erro = "Erro ao enviar arquivo"
            });
        },
        listFile(){
            let urlIndex = this.getBaseUrl + this.action + '/list/' + this.proc + '/' + this.idp + '/' + this.name;
            axios
            .get(urlIndex)
            .then((response) => {
                this.uploaded = response.data
                this.counter = response.data.length
            })
            .catch(error => console.log(error));
        },
        showFile(id){
            let urlShow = this.getBaseUrl + this.action + '/show/' + this.proc + '/' + this.idp + '/' + this.name + '/' + id;
            window.open(urlShow, "_blank")
        },
        deleteFile(id){
            let urlDelete = this.getBaseUrl + this.action + '/delete/' + id;
            axios
            .delete(urlDelete)
            .then((response) => this.listFile())//chama list para atualizar
            .catch(error => console.log(error));
        },
        removeFile(id){
            let urlDelete = this.getBaseUrl + this.action + '/destroy/' + id;
            axios
            .delete(urlDelete)
            .then((response) => this.listFile())//chama list para atualizar
            .catch(error => console.log(error));
        },
        cancelFile(){
            this.file ='';
            this.forUpload = false;
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
</style>