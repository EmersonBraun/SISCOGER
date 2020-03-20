<template>
    <v-tab header="Prisões" :badge="lenght">
        <List :registros="registros" :lenght="lenght" @edit="edit" @changed="list"/>
        <template v-if="canCreate">
            <a class="btn btn-primary btn-block" @click="toCreate">
                <i class="fa fa-plus"></i>Adicionar Prisão
            </a>
        </template>
        <Form :showModal="showModal" :registro.sync="registro" @changed="list"/>
    </v-tab>
</template>

<script>
import CRUD from '../../../utils/CRUD'
import List from './List'
import Form from './Form'

export default {
    components: { List, Form},
    props:['pm'],
    data() {
        return {
            module: 'preso',
            registros: [],
            registro: {},
            canCreate: false,
            showModal: false,
            lenght: 0
        }
    },
    created(){
        this.list()
        this.canCreate = this.$root.hasPermission('criar-prisoes')
    },
    methods: {
        async list(){
            this.restartProj()
            const rg = this.$root.dadoSession('rg')
            const URL = `${this.$root.baseUrl}api/${this.module}/list/${rg}`;
            const response = await CRUD.list(URL)
            this.registros = response.data
            this.lenght = Object.keys(this.registros).length
        },
        restartProj() {
            this.showModal = false
            this.registro = {}
        },
        toCreate(){
            this.showModal = true
            this.registro.rg = this.$root.dadoSession('rg')
            this.registro.origem_opm = this.$root.dadoSession('opm_descricao')
            this.registro.cargo = this.$root.dadoSession('cargo')
            this.registro.nome = this.$root.dadoSession('nome')
        },
        edit(registro){
            console.log('registro', registro)
            this.registro = registro
            this.showModal = true
        }
    }
}
</script>

<style scoped>
td {
  white-space: normal !important; 
  word-wrap: break-word;  
}
table {
  table-layout: fixed;
}
</style>