<template>
    <div class="row">
        <div class="col-xs-12">
            <div class="box collapsed-box">
                <div class="box-header">
                    <h2 class="box-title">Afastamentos
                    &emsp;
                    <i class="fa fa-info-circle text-info" data-toggle="tooltip" data-placement="bottom" title="O campo poderá ser suprimido nos casos de certidão da Ficha Disciplinar Individual do militar estadual."></i>
                    <span v-if="afastamentos.length" class="badge bg-red">{{afastamentos.length}}</span></h2>
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
                                <template v-if="afastamentos.length">
                                    <tr v-for="(afastamento, index) in afastamentos" :key="index">
                                        <td>
                                            {{afastamento.DESC_INCIDENTE}}, 
                                            <b>
                                                De {{afastamento.DT_INIC | date_br}} a 
                                                {{afastamento.DT_FIM | date_br}}
                                            ({{afastamento.UNITS}} Dias)</b>     
                                        </td>
                                    </tr>
                                </template>
                                <template v-else>
                                    <tr>
                                        <td>Não há registros.</td>
                                    </tr>
                                </template> 
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
        props:['rg'],
        data() {
            return {
                afastamentos: []
            }
        },
        mounted(){
            this.listAfastamentos()
        },
        methods: {
            listAfastamentos(){
                let urlIndex = `${this.$root.baseUrl}api/fdi/afastamentos/${this.rg}`;
                if(this.rg){
                    axios
                    .get(urlIndex)
                    .then((response) => {
                        this.afastamentos = response.data
                    })
                    .catch(error => console.log(error));
                }
            }
        }
    }
</script>

<style scoped>

</style>