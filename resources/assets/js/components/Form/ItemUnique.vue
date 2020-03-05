<template>
    <!-- :class="classform" -->
    <div class="mb-12 form-group " > 
        <label :for="label">{{ title }}</label><br>
        <div class="input-group " v-if="!view">
            <div v-if="status && !show" class="input-group-prepend">
                <span v-if="status == 'ok'" class="input-group-text fa fa-check" style="color: green"></span>
                <span v-else class="input-group-text fa fa-times" style="color: red"></span>
            </div>
            <v-show v-if="show" :dado="input"></v-show>
            <input  v-else v-model="input" :name="name" type="text" class="form-control">
            <div v-if="!show" class="input-group-append">
                <button class="btn btn-success" :disabled="!input.length" @click="insert()">Inserir/ Alterar</button>
                <button class="btn btn-danger" :disabled="!input.length" @click="remove()">Apagar</button>
            </div>
        </div>
        <p>{{input || 'Não Há '}}</p>
    </div>
</template>

<script>
    export default {
        props:{
            show: {type: Boolean, default: false},
            title: {type: String, default: ''}, //titulo
            label: {type: String, default: ''},
            name: {type: String, default: ''},
            // error: '',
            idp: {type: String, default: ''},
            dproc: {type: String, default: ''}

        },
        data(){
            return{
                input: '',
                status: '',
                view: false,
            }
        },
        beforeMount(){
            this.dadoCampo()
        },
        computed:{
            getBaseUrl(){
                // URL completa
                let getUrl = window.location;
                // dividir em array
                let pathname = getUrl.pathname.split('/')   
                this.view = (pathname[3] == 'ver') ? true : false           
                let baseUrl = getUrl.protocol + "//" + getUrl.host + "/" + pathname[1]+"/";
                
            return baseUrl;
            },
        },
        watch: {
            status() {
                if(this.status !== ''){
                    setTimeout(()=>{ 
                        this.status = ''
                    }, 2000);  
                }
            },
        },
        methods:{
            insert(){
                let urlInsert = this.$root.baseUrl + 'api/proc/update/' + this.dproc + '/' + this.idp + '/' + this.name ;
                axios.post( urlInsert,{
                    input: this.input
                })
                .then(this.status = 'ok')
                .catch((error) => {
                    console.log(error)
                    this.erro = "Erro ao enviar"
                    this.status = 'error'
                });
            },
            remove(){
                this.input = ''
                this.insert()
            },
            dadoCampo(){
                let urlIndex = this.$root.baseUrl + 'api/proc/dadocampo/' + this.dproc + '/' + this.idp + '/' + this.name ;
                axios.get( urlIndex)
                .then(response => {
                    this.input = response.data.input
                    // console.log(this.input)
                })
                .catch((error) => {
                    console.log(error)
                    this.erro = "Erro ao enviar"
                });
            },
        }
    }
</script>

<style>
    .input-group {
        position: relative;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -ms-flex-wrap: wrap;
        flex-wrap: wrap;
        -webkit-box-align: stretch;
        -ms-flex-align: stretch;
        align-items: stretch;
        width: 100%;
    }
    .input-group-append {
        margin-left: -1px;
    }
    .input-group-append, .input-group-prepend {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
    }
    .input-group > .custom-select:not(:last-child), .input-group > .form-control:not(:last-child) {
        border-top-right-radius: 0;
        border-bottom-right-radius: 0;
    }
    .input-group > .custom-file, .input-group > .custom-select, .input-group > .form-control {
        position: relative;
        -webkit-box-flex: 1;
        -ms-flex: 1 1 auto;
        flex: 1 1 auto;
        width: 1%;
        margin-bottom: 0;
    }
    .form-control {
        display: block;
        width: 100%;
        padding: .375rem .75rem;
        font-size: 1rem;
        line-height: 1.5;
        color: #495057;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #ced4da;
        transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    }
    button, input {
        overflow: visible;
    }
    button, input, optgroup, select, textarea {
        margin: 0;
        margin-bottom: 0px;
        font-family: inherit;
        font-size: inherit;
        line-height: inherit;
    }
    .input-group-text {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-align: center;
        align-items: center;
        padding: .375rem .75rem;
        margin-bottom: 0;
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.5;
        color: #495057;
        text-align: center;
        white-space: nowrap;
        background-color: #e9ecef;
        border: 1px solid #ced4da;
        border-radius: .25rem;
            border-top-right-radius: 0.25rem;
            border-bottom-right-radius: 0.25rem;
    }
</style>
