<template>
    <table class="table table-striped">
        <template v-if="lenght">
            <thead>
                <tr>
                    <th class="col-xs-1">Início</th>
                    <th class="col-xs-1">Fim</th>
                    <th class="col-xs-2">Processo</th>
                    <th class="col-xs-2">Complemento</th>
                    <th class="col-xs-2">Comarca</th>
                    <th class="col-xs-2">Vara</th>
                    <th class="col-xs-2">Ações</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="registro in registros" :key="registro.id_preso">
                    <td>{{ registro.inicio_data }}</td>
                    <td>{{ registro.fim_data | fimPrisao}}</td>
                    <td>{{ registro.processo }}</td>
                    <td>{{ registro.complemento }}</td>
                    <td>{{ registro.comarca }}</td>
                    <td>{{ registro.vara }}</td>
                    <td>
                        <span>
                            <template v-if="canEdit">
                                <a class="btn btn-info" @click="edit(registro)"><i class="fa fa-fw fa-edit "></i></a>
                            </template>
                            <template v-if="canDelete">
                                <a class="btn btn-danger" @click="destroy(registro.id_preso)"><i class="fa fa-fw fa-trash-o "></i></a>
                            </template>
                        </span>
                    </td>
                </tr>
            </tbody>
        </template>
        <template v-else>
            <tr><td>Nada encontrado</td></tr>
        </template>
    </table> 
</template>

<script>
import CRUD from '../../../utils/CRUD'

export default {
    props:['registros','lenght'],
    data() {
        return {
            module: 'preso',
            canEdit: false,
            canDelete: false,
            showModal: false,
        }
    },
    filters: {
        fimPrisao(value) {
            if(!value) return 'Está preso'
        }
    },
    created(){
        this.canEdit = this.$root.hasPermission('editar-prisoes')
        this.canDelete = this.$root.hasPermission('apagar-prisoes')
    },
    methods: {
        edit(registro){
            this.$emit('edit', registro)
        },
        async destroy(id){
            let URL = `${this.$root.baseUrl}api/${this.module}/destroy/${id}`;
            const response = await CRUD.destroy(URL, id);
            this.$emit('changed')
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