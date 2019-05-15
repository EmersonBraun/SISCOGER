<template>
    <div class="col-lg-12 col-md-12 col-xs-12 card">
        <div class="card-body">
            <div id="ligacaoForm1" class="row">
                <form id="formData" name="formData">
                    <div class="col-lg-3 col-md-3 col-xs-3">
                        <label for="rg">RG</label><br>
                        <the-mask mask="############" class="form-control" @change="searchPM" v-model="prg" type="text" maxlength="12" name="rg" placeholder="Nº"/>
                    </div>
                    <div class="col-lg-3 col-md-3 col-xs-3">
                        <label for="nome">Nome</label><br>
                        <input class="numero form-control" v-model="pnome" type="text" name="nome" readonly>
                    </div>
                    <div class="col-lg-3 col-md-3 col-xs-3">
                        <label for="cargo">Posto/Graduação</label><br>
                        <input class="numero form-control" v-model="pcargo" type="text" name="cargo" readonly>
                    </div>
                    <div class="col-lg-3 col-md-3 col-xs-3">
                        <label for="resultado">Resultado</label><br>
                        <template v-if="situacao">
                            <input class="numero form-control" v-model="situacao" type="text" name="situacao" readonly>
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
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    import {TheMask} from 'vue-the-mask'
    export default {
        components: {TheMask},
        props: {
            situacao: {type: String, default: ''},
            idp: {type: String, default: ''},
            rg: {type: String},
            cargo: {type: String},
            nome: {type: String}
        },
        data() {
            return {
                prg: this.rg,
                pnome: this.nome,
                pcargo: this.cargo,
                proc: '',
                dproc: '',
                dref: 0,
                dano: 0,
                action: '',
                finded: false
            }
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
        },
        methods: {
            searchPM(){               
                let searchUrl = `${this.getBaseUrl}api/dados/pm/${this.rg}` ;
                if(this.prg.length > 5){
                    axios
                    .get(searchUrl)
                    .then((response) => {
                        if(response.data.success){
                            this.pnome = response.data['pm'].NOME
                            this.pcargo = response.data['pm'].CARGO
                            this.finded = true
                        }
                        else{
                            this.pnome = ''
                            this.pcargo = ''
                            this.finded = false
                        }
                    })
                    .catch(error => console.log(error));
                }
            },
            clear(){
                this.pnome = ''
                this.pcargo = ''
                this.finded = false
            }
        },
    }
</script>

<style scoped>

</style>
