<template>
    <div class="row">
        <div class="col-md-6 col-xs-12 form-group">
            <div class="vue-simple-suggest designed">
                <div v-if="!onSearch" class="input-wrapper">
                    <input v-model="found.rg" class="form-control" name="rg" placeholder="RG" readonly>
                </div>
                <div v-else class="input-wrapper">
                    <the-mask mask="###############" name="rg" class="form-control" type="text" maxlength="15" v-model="rg" @focus="sugestList('rg')" placeholder="RG" :readonly="name.length > 0"/>
                </div>
                <ul v-if="result.length && type=='rg'" class="suggestions">
                    <li v-for="(r, index) in result" :key="index" class="suggest-item" @click="completaInput(r)">
                        <b>{{ r.rg }}</b> {{r.nome}}
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-md-6 col-xs-12 form-group">
            <div class="vue-simple-suggest designed">
                <div v-if="!onSearch" class="input-wrapper">
                    <input v-model="found.nome" class="form-control" name="nome" placeholder="Nome" readonly>
                </div>
                <div v-else class="input-wrapper">
                    <input v-model="name" @focus="sugestList('nome')" name="nome" placeholder="Nome" class="form-control" :readonly="rg.length > 0">
                </div> 
                <ul v-if="result.length && type=='nome'" class="suggestions" >
                    <li v-for="(r, index) in result" :key="index" class="suggest-item" @click="completaInput(r)">
                        <b>{{ r.nome }}</b> {{r.rg}}
                    </li>
                </ul>
            </div>
        </div>
        <div v-if="!onSearch" class="col-md-12 col-xs-12">
            <a class="btn btn-success btn-block" @click="reset"><i class="fa fa-search"></i> Procurar outro PM</a>
        </div>
    </div>
</template>

<script>
    export default {
    data() {
      return {
        rg: '',
        name: '',
        onSearch: true,
        found: {},
        type: '',
        tables: ['ativos'],
        result: [],
        permissions: {},
        hasPermissions: false
      }
    },
    mounted(){
        let session = this.$root.getSessionData()
        let todasUnidades = Object.values(session.permissions).filter(s => s == 'todas-unidades')
        this.permissions = {
            inativos: true,
            reserva: false,
            unidades: todasUnidades
        }
        this.hasPermissions =  Object.keys(this.permissions).length ? true : false
        
    },
    watch: {
        rg() {
            if(this.rg.length > 2) {
                this.type = 'rg'
                this.search(this.rg)
            } else {
                this.type = ''
                this.result = []
            }
        },
        name(){
            if(this.name.length > 2) {
                this.type = 'nome'
                this.search(this.name)
            } else {
                this.type = ''
                this.result = []
            }
        },
    },
    methods: {
        search(val) {
            let urlSearch = `${this.$root.baseUrl}api/dados/sugest`
            // objeto para ser enviado ao controller
            let data = {
                search: val,
                type: this.type,
                tables: this.tables,
                outrasOpms: this.permissions.unidades,
                opts: this.tables.length
            }

            if(this.onSearch){
                axios.post( urlSearch,data)
                .then((response) => {
                    let res = response.data.data
                    if(res.length) this.result = res
                })
                .catch((error) => console.log(error));
            } 
        },
        sugestList(type){
            this.type = type
        },
        completaInput(item) {
            this.type = ''
            this.onSearch = false
 
            this.found = {
                rg: item.rg,
                nome: item.nome
            }
 
            this.result = []
        },
        reset(){
            this.onSearch = true
            this.type = ''
            this.found = {}
            this.result = []
            this.rg = ''
            this.name = ''
        },
    }
  }
</script>
<style scope>
    input[type="checkbox"], input[type="radio"] {
        box-sizing: border-box;
        padding: 0;
    }
    .custom-control-input {
        position: absolute;
        z-index: -1;
        opacity: 0;
    }
    .funkyradio div {
    clear: both;
    overflow: hidden;
    }
    .funkyradio label {
    border-radius: 3px;
    font-weight: normal;
    }
    .funkyradio input[type="checkbox"]:empty {
    display: none;
    }
    .funkyradio input[type="checkbox"]:empty ~ label {
    position: relative;
    line-height: 2em;
    text-indent: 2.5em;
    margin-top: .3em;
    cursor: pointer;
    -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
            user-select: none;
    }
    .funkyradio input[type="checkbox"]:empty ~ label:before {
    position: absolute;
    display: inline;
    top: 0;
    bottom: 0;
    left: 0;
    content: '';
    background: #D1D3D4;
    border-radius: 3px;
    }
    .funkyradio input[type="checkbox"]:hover:not(:checked) ~ label {
    color: #888;
    }
    .funkyradio input[type="checkbox"]:hover:not(:checked) ~ label:before {
    content: '\2714';
    text-indent: .6em;
    color: #C2C2C2;
    }
    .funkyradio input[type="checkbox"]:checked ~ label {
    color: #777;
    }
    .funkyradio input[type="checkbox"]:checked ~ label:before {
    content: '\2714';
    text-indent: .6em;
    color: #333;
    background-color: #ccc;
    }
    .funkyradio input[type="checkbox"]:focus ~ label:before {
    box-shadow: 0 0 0 3px #999;
    }
    .funkyradio-default input[type="checkbox"]:checked ~ label:before {
    color: #333;
    background-color: #ccc;
    }
    .funkyradio-primary input[type="checkbox"]:checked ~ label:before {
    color: #fff;
    background-color: #337ab7;
    }
    .funkyradio-success input[type="checkbox"]:checked ~ label:before {
    color: #fff;
    background-color: #5cb85c;
    }
    .funkyradio-danger input[type="checkbox"]:checked ~ label:before {
    color: #fff;
    background-color: #d9534f;
    }
    .funkyradio-warning input[type="checkbox"]:checked ~ label:before {
    color: #fff;
    background-color: #f0ad4e;
    }
    .funkyradio-info input[type="checkbox"]:checked ~ label:before {
    color: #fff;
    background-color: #5bc0de;
    }
    .vue-simple-suggest > ul {
    list-style: none;
    margin: 0;
    padding: 0;
    }
    .vue-simple-suggest{
    position: relative;
    }
    .vue-simple-suggest.designed, * {
    box-sizing: border-box;
    }
    .input-wrapper input {
    display: block;
    width: 100%;
    padding: 10px;
    border: 1px solid #cde;
    border-radius: 3px;
    color: black;
    background: white;
    outline:none;
    transition: all .1s;
    transition-delay: .05s
    }
    .vue-simple-suggest.designed:focus .input-wrapper input {
    outline: 2px solid #2874D5;
    }
    .suggestions {
    position: absolute;
    left: 0;
    right: 0;
    top: 100%;
    top: calc(100% + 5px);
    border-radius: 3px;
    border: 1px solid #aaa;
    background-color: #fff;
    opacity: 1;
    z-index: 1000;
    }
    .suggestions .suggest-item {
    cursor: pointer;
    user-select: none;
    }
    .suggestions .suggest-item,
    .suggestions .misc-item {
    padding: 5px 10px;
    }
    .suggestions .suggest-item:hover {
    background-color: #2874D5 !important;
    color: #fff !important;
    }
    .suggestions .suggest-item.selected {
    background-color: #2832D5;
    color: #fff;
    }
</style>