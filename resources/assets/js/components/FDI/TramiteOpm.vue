<template>
    <div class="row">
        <div class="col-xs-12">
            <div class="box collapsed-box">
                <div class="box-header">
                    <h2 class="box-title">Trâmite OPM/OBM
                    &emsp;<i class="fa fa-info-circle text-info" data-toggle="tooltip" data-placement="bottom" title="O campo poderá ser suprimido nos casos de certidão da Ficha Disciplinar Individual do militar estadual."></i>
                    <span v-if="tramites.length" class="badge bg-red">{{tramites.length}}</span></h2> 
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                            <i class="fa fa-plus"></i>
                        </button> 
                    </div>             
                </div>
                <div class="box-body">
                    <div class="col-md-12 col-xs-12">   
                        <table class="table table-striped">
                            <tbody> 
                                <template v-if="tramites.length">
                                    <tr>
                                        <th>Data</th>
                                        <th>Descrição</th>
                                        <th>Digitador</th>
                                        <th>OM</th>
                                    </tr>
                                    <tr v-for="(tramite, index) in tramites" :key="index">
                                        <td>{{tramite.data | date_br}}</td>
                                        <td>{{tramite.descricao_txt}}</td>
                                        <td>{{tramite.digitador}}</td>
                                        <td>{{tramite.opm_abreviatura}}</td>
                                    </tr>
                                </template>
                                <template v-else>
                                    <tr>
                                        <td>Não há registros.</td>
                                    </tr>
                                </template> 
                            </tbody>
                        </table>  
                        <template v-if="canCreate">
                            <button type="button" class="btn btn-primary btn-block">
                                <i class="fa fa-plus"></i>Adicionar Trâmite OPM
                            </button>
                        </template>
                    </div> 
                </div>   
            </div>
        </div> 
    </div>
</template>

<script>
    export default {
        props:['rg'],
        data() {
            return {
                tramites: [],
                canCreate: false
            }
        },
        mounted(){
            this.listTramites()
            this.canCreate = this.$root.hasPermission('criar-tramite-opm')
        },
        methods: {
            listTramites(){
                let urlIndex = `${this.$root.baseUrl}api/fdi/tramitacaoopm/${this.rg}`;
                if(this.rg){
                    axios
                    .get(urlIndex)
                    .then((response) => {
                        this.tramites = response.data
                    })
                    .catch(error => console.log(error));
                }
            }
        }
    }
</script>

<style scoped>

</style>