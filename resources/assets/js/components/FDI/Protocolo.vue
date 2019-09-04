<template>
    <v-tab header="E-Protocolo" :badge="lenght">
        <table class="table table-striped">
        <tbody>
            <template v-if="lenght">
                <tr>
                    <th>N° Documento</th>
                    <th>Descrição</th>
                    <th>RG Autor</th>
                    <th>RG Analista</th>
                    <th>Observações</th>
                    <th>Ações</th>
                </tr>
                <tr v-for="protocolo in protocolos" :key="protocolo.id_protocolo">
                    <td>{{ protocolo.numero }}</td>
                    <td>{{ protocolo.descricao_txt }}</td>
                    <td>{{ protocolo.rg_autor }}</td>
                    <td>{{ protocolo.rg_analista }}</td>
                    <td>{{ protocolo.obs }}</td>
                    <td>Ações</td>
                </tr>
            </template>
            <template v-else>
                <tr>
                    <td>Nada encontrado</td>
                </tr>
            </template>
        </tbody>
    </table>
    <!-- <template v-if="canCreate"> -->
        <a class="btn btn-primary btn-block" @click="showModal = true">
            <i class="fa fa-plus"></i>Adicionar Protocolo
        </a>
    <!-- </template> -->
    <!-- form -->
    <Modal v-model="showModal" large effect="fade">
        <div slot="modal-header" class="modal-header">
            <h4 class="modal-title"><b>Inserir novo Protocolo</b></h4>
        </div>
        <div slot="modal-body">
            <input type="hidden" v-model="protocolo.id_protocolo">
            <Label lg="6" label="numero" title="Numero do protocolo">
                <the-mask mask="##.###.###-#" class="form-control" type="text" required v-model="protocolo.numero" placeholder="00.000.000-0" />
            </Label>
            <Label lg="6" label="rg" title="RG cadastro">
                <input type="text" readonly v-model="protocolo.rg_autor" class="form-control">
            </Label>
            <Label lg="6" label="rg_analista" title="RG analista">
                <the-mask mask="###############" class="form-control" type="text" v-model="protocolo.rg_analista" placeholder="Só números" />
            </Label>
            <Label lg="6" label="obs" title="Observações">
                <input type="text" class="form-control" v-model="protocolo.obs">
            </Label>
            <Label lg="12" label="descricao_txt" title="Descrição">
                <textarea  v-model="protocolo.descricao_txt" id="foco" rows="5" cols="105" width="100%"></textarea>
            </Label>
        </div>
        <div slot="modal-footer" class="modal-footer">
            <div class="col-xs-6">
                <a class="btn btn-default btn-block" @click="showModal = false">Cancelar</a>
            </div>
            <div class="col-xs-6">
                <template v-if="protocolo.id_protocolo">
                    <a class="btn btn-success btn-block" :disabled="requireds" @click="showModal = false">Editar</a>
                </template>
                <template v-else>
                    <a class="btn btn-success btn-block" :disabled="requireds" @click="createProtocolo">Inserir</a>
                </template>
            </div>
        </div>
    </Modal>
    <!-- confirm -->
    <Modal v-model="confirmModal" effect="fade">
        <div slot="modal-header" class="modal-header">
            <h4 class="modal-title"><b>Tem certeza?</b></h4>
        </div>
        <div slot="modal-footer" class="modal-footer">
            <div class="col-xs-6">
                <a class="btn btn-default btn-block" @click="confirmModal = false">Cancelar</a>
            </div>
            <div class="col-xs-6">
                <a class="btn btn-success btn-block" :disabled="requireds" @click="confirmModal = false">Apagar</a>
            </div>
        </div>
    </Modal>
    
    </v-tab>
</template>

<script>
    import Modal from '../Vuestrap/Modal.vue'
    import Alert from '../Vuestrap/Alert.vue'
    import Label from '../Form/Label.vue'
    import {TheMask} from 'vue-the-mask'
    export default {
        components: { Modal, Label, TheMask, Alert},
        props:['rg'],
        data() {
            return {
                protocolos: [],
                protocolo: {},
                canCreate: false,
                canEdit: false,
                canDelete: false,
                showModal: false,
                confirmModal: false
            }
        },
        computed:{
            requireds(){
                if(this.protocolo.numero && this.protocolo.descricao_txt) return false
                return true
            },
            lenght(){
                return Object.keys(this.protocolos).length
            }
        },
        mounted(){
            this.listProtocolo()
            this.canCreate = this.$root.hasPermission('criar-protocolo')
            this.canEdit = this.$root.hasPermission('editar-protocolo')
            this.canDelete = this.$root.hasPermission('apagar-protocolo')
            this.protocolo.rg_autor = this.$root.dadoSession('rg')
            this.protocolo.rg = this.rg
            this.$root.alertMsg('Teste','success')
        },
        methods: {
            listProtocolo(){
                let urlIndex = `${this.$root.baseUrl}api/fdi/protocolo/list/${this.rg}`;
                if(this.rg){
                    axios
                    .get(urlIndex)
                    .then((response) => {
                        this.protocolos = response.data
                    })
                    .catch(error => console.log(error));
                }
            },
            createProtocolo(){
                let urlSave = `${this.$root.baseUrl}api/fdi/protocolo/store`;
                axios
                .post(urlSave, this.protocolo)
                .then((response) => {
                    if(response.data.success) this.listProtocolo()
                })
                .then(() => {
                    this.showModal = false
                    this.$root.alertMsg('Inserido com Sucesso','success')
                })
                .catch(error => console.log(error));
                this.showModal = false
                
            },
            editProtocolo(protocolo){
                this.protocolo = protocolo
                this.showModal = true
            },
            updateProtocolo(id){
                let urlSave = `${this.$root.baseUrl}api/fdi/protocolo/update/${id}`;
                axios
                .get(urlSave)
                .then((response) => {
                    if(response.data.success) this.listProtocolo()
                })
                .catch(error => console.log(error));
            },
        }
    }
</script>

<style scoped>

</style>