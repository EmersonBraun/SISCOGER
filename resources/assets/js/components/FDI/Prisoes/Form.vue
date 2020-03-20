<template>
    <Modal v-model="showModal" large effect="fade" width="70%">
        <input type="hidden" name="id" v-model="registro.id_preso">
        <div slot="modal-header" class="modal-header">
            <h4 class="modal-title">
                <b v-if="registro.id_preso">Editar prisão</b>
                <b v-else>Inserir nova prisão</b>
            </h4>
        </div>
        <div slot="modal-body">
                <v-label label="rg" title="RG">
                <input class="form-control" type="text" size="12" maxlength="25" readonly="" v-model="registro.rg">
            </v-label>
            <v-label label="cargo" title="Posto/Grad.">
                <input class="form-control" type="text" size="6" maxlength="10" readonly="" v-model="registro.cargo">
            </v-label>
            <v-label label="nome" title="Nome">
                <input class="form-control" type="text" size="40" readonly="" v-model="registro.nome">
            </v-label>
            <v-label label="cdopm_quandopreso" title="OPM" :error="$v.cdopm_quandopreso.$error ? 'Campo obrigatório' : ''">
                <Opm name='cdopm_quandopreso' required :cdopm.sync="registro.cdopm_quandopreso"></Opm>
            </v-label>
            <v-label label="local" title="Local de reclusão/detenção" :error="$v.local.$error ? 'Campo obrigatório' : ''">
                <select class="form-control" v-model="registro.local" required>
                    <option value="quartel">Quartel</option>
                    <option value="civil">Órgãos civis</option>
                </select>
            </v-label>
            <template v-if="registro.local == 'quartel'">
                <v-label label="cdopm_prisao" title="Quartel onde o policial está preso" >
                    <Opm name='cdopm_prisao' :cdopm="registro.cdopm_prisao" v-model="registro.cdopm_prisao"></Opm>
                </v-label>
            </template>
            <template id='civil' style="display:none">
                <v-label label="localreclusao" title="Local onde o policial está preso" tooltip="Ex: COCT II" >
                    <input class="form-control" type="text" v-model="registro.localreclusao">
                </v-label>
            </template>
            <v-label label="origem_proc" title="Procedimento vinculado">
                <select class="form-control" v-model="registro.origem_proc">
                    <option value="ipm">IPM</option>
                    <option value="sindicancia">Sindicância</option>
                    <option value="cd">CD</option>
                    <option value="cj">CJ</option>
                    <option value="apfdc">APFDC</option>
                    <option value="apfdm">APDM</option>
                    <option value="fatd">FATD</option>
                    <option value="iso">ISO</option>
                    <option value="desercao">Deserção</option>
                    <option value="it">IT</option>
                    <option value="adl">ADL</option>
                    <option value="pad">PAD</option>
                    <option value="sai">SAI</option>
                    <option value="proc_outros">Proc. Outros</option>
                </select>
            </v-label>
            <v-label label="origem_sjd_ref" title="Referência">
                <the-mask mask="###" class="form-control" type="text" v-model="registro.origem_sjd_ref" placeholder="Só números" @keyup.native="searchProc"/>
            </v-label>
            <v-label label="origem_sjd_ref_ano" title="Ano">
                <the-mask mask="####" class="form-control" type="text" v-model="registro.origem_sjd_ref_ano" placeholder="Só números" @keyup.native="searchProc"/>
            </v-label>
            <v-label label="origem_opm" title="OPM de origem">
                <input class="form-control" type="text" v-model="registro.origem_opm" readonly>
            </v-label>
            <v-label label="processo" title="Processo, Nº do processo - Comarca." tooltip="Ex: Ação Penal Militar nº 2010.0000XXX-X - Curitiba">
                <input class="form-control" type="text" v-model="registro.processo">
            </v-label>
            <v-label label="complemento" title="Artigos da Infração penal" tooltip="Ex: Art. 121 § 2º CP" >
                <input class="form-control" type="text" v-model="registro.complemento">
            </v-label>
            <v-label label="numeromandado" title="Nº do mandado de prisão, se houver" tooltip="Ex: 000183216-55">
                <input class="form-control" type="text" v-model="registro.numeromandado">
            </v-label>
            <v-label label="id_presotipo" title="Tipo da prisão">
                <select class="form-control" v-model="registro.id_presotipo">
                    <option value="1">Flagrante</option>
                    <option value="2">Preventiva</option>
                    <option value="3">Temporária</option>
                    <option value="4">Condenação</option>
                    <option value="5">Menagem</option>
                    <option value="6">Deserção</option>
                </select>
            </v-label>
            <v-label label="vara" title="Vara" tooltip="Ex: 3ª Vara Criminal">
                <input class="form-control" type="text" v-model="registro.vara">
            </v-label>
            <v-label label="comarca" title="Comarca" tooltip="Ex: Curitiba">
                <input class="form-control" type="text" v-model="registro.comarca">
            </v-label>
            <v-label label="inicio_data" title="Data de entrada na prisão" icon="fa fa-calendar" :error="$v.inicio_data.$error ? 'Campo obrigatório' : ''">
                <Datepicker :placeholder="registro.inicio_data" clear-button v-model="registro.inicio_data"></Datepicker>
            </v-label>
            <v-label label="fim_data" title="Data da saída da prisão" icon="fa fa-calendar">
                <Datepicker :placeholder="registro.fim_data" clear-button v-model="registro.fim_data"></Datepicker>
            </v-label>
            <v-label label="obs_txt" title="Observações" lg="12" md="12">
                <textarea  v-model="registro.obs_txt" id="foco" rows="5" cols="105" width="100%"></textarea>
            </v-label>
        </div>
        <div slot="modal-footer" class="modal-footer">
            <div class="col-xs-6">
                <a class="btn btn-default btn-block" @click="showModal = false">Cancelar</a>
            </div>
            <div class="col-xs-6">
                <a v-if="registro.id_preso" class="btn btn-success btn-block" :disabled="$v.$anyError" @click.prevent="update(registro.id_preso)">Editar</a>
                <a v-else class="btn btn-success btn-block" :disabled="$v.$anyError" @click="create">Inserir</a>
            </div>
        </div>
    </Modal>   
</template>

<script>
import CRUD from '../../../utils/CRUD'
import { required } from 'vuelidate/lib/validators'
import Modal from '../../Vuestrap/Modal.vue'
import Datepicker from '../../Vuestrap/Datepicker.vue'
import Opm from '../../Form/OPM.vue'

export default {
    components: { Modal, Datepicker, Opm},
    props:['registro','showModal'],
    data() {
        return {
            module: 'preso',
        }
    },
    validations: {
        local : {required},
        cdopm_quandopreso : {required},
        inicio_data: {required},
    },
    filters: {
        fimPrisao(value) {
            if(!value) return 'Está preso'
        }
    },
    computed:{
        local() { return this.registro.local },
        cdopm_quandopreso() { return this.registro.cdopm_quandopreso },
        inicio_data() { return this.registro.inicio_data },
    },
    methods: {
        async create(){
            if(!this.validations()){
                const URL = `${this.$root.baseUrl}api/${this.module}/store`;
                const response = await CRUD.create(URL, this.registro)
                if(response) this.$emit('changed')
            }
        },
        async update(id){
            if(!this.validations()){
                let URL = `${this.$root.baseUrl}api/${this.module}/update/${id}`;
                const response = await CRUD.update(URL, this.registro);
                if(response) this.$emit('changed')
            }
        },
        validations() {
            this.$v.$touch()
            return this.$v.$invalid
        },
        transation() {
            this.showModal = false
            this.list()
            this.registro = {}
        },
        async searchProc(){
            if(this.registro.origem_proc && this.registro.origem_sjd_ref && this.registro.origem_sjd_ref_ano){
                let proc = this.registro
                const URL = `${this.$root.baseUrl}api/dados/proc/${proc.origem_proc}/${proc.origem_sjd_ref}/${proc.origem_sjd_ref_ano}`;
                const response = await CRUD.list(URL)
                this.registro.origem_opm = response.data.opm
            }
        }
    }
}
</script>
