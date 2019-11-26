<template>
    <div class="row">
        <div class="col-md-12 col-xs-12 funkyradio" v-if="hasPermissions">
            <div class="funkyradio-primary" >
                <input type="checkbox" id="checkbox1" value="ativos" v-model="tables"/>
                <label for="checkbox1">Ativos</label>
            </div>
            <div class="funkyradio-primary" v-if="permissions.inativos">
                <input type="checkbox" id="checkbox2" value="inativos" v-model="tables"/>
                <label for="checkbox2">Inativos</label>
            </div>
            <div class="funkyradio-primary" v-if="permissions.reserva">
                <input type="checkbox" id="checkbox3" value="reserva" v-model="tables"/>
                <label for="checkbox3">Reserva</label>
            </div>
        </div>
        <template v-if="tables.length">
            <div class="col-md-6 col-xs-12 form-group">
                <div class="vue-simple-suggest designed">
                    <div v-if="!onSearch" class="input-wrapper">
                        <input v-model="found.rg" class="form-control" placeholder="RG" readonly>
                    </div>
                    <div v-else class="input-wrapper">
                        <the-mask mask="###############" class="form-control" type="text" maxlength="15" v-model="rg" @focus="sugestList('rg')" placeholder="RG" :readonly="name.length > 0"/>
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
                        <input v-model="found.nome" class="form-control" placeholder="Nome" readonly>
                    </div>
                    <div v-else class="input-wrapper">
                        <input v-model="name" @focus="sugestList('nome')" placeholder="Nome" class="form-control" :readonly="rg.length > 0">
                    </div> 
                    <ul v-if="result.length && type=='nome'" class="suggestions" >
                        <li v-for="(r, index) in result" :key="index" class="suggest-item" @click="completaInput(r)">
                            <b>{{ r.nome }}</b> {{r.rg}}
                        </li>
                    </ul>
                </div>
            </div>
            <div v-if="!onSearch" class="col-md-6 col-xs-12">
                <a class="btn btn-success btn-block" @click="goToFdi(found.rg)">Ir para ficha</a>
            </div>
            <div v-if="!onSearch" class="col-md-6 col-xs-12">
                <a class="btn btn-primary btn-block" @click="reset"><i class="fa fa-search"></i> Procurar outra ficha</a>
            </div>
        </template>
        <template v-else>
            <div class="col-xs-12">
                <h4>Selecione pelo menos um local para ser feita a busca</h4>
            </div>
        </template>
    </div>
</template>

<script>
    import {TheMask} from 'vue-the-mask'
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
        let verAtivo = Object.values(session.permissions).filter(s => s == 'ver-inativo')
        let verReserva = Object.values(session.permissions).filter(s => s == 'ver-reserva')
        let todasUnidades = Object.values(session.permissions).filter(s => s == 'todas-unidades')
        this.permissions = {
            inativos: verAtivo,
            reserva: verReserva,
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
            let search = val //valor procurado

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
        goToFdi(rg) {
            window.location.href = `${this.$root.baseUrl}fdi/${rg}/ver`;
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
    /* width: 2em; */
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