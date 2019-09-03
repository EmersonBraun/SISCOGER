<template>
    <div class="row">
        <div class="col-xs-12">
            <div class="box collapsed-box">
                <div class="box-header">
                    <h2 class="box-title">Log Visualização Ficha
                    &emsp;<i class="fa fa-info-circle text-info" data-toggle="tooltip" data-placement="bottom" title="O campo poderá ser suprimido nos casos de certidão da Ficha Disciplinar Individual do militar estadual."></i>
                    <span v-if="logs.length" class="badge bg-red">{{logs.length}}</span></h2> 
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
                                <template v-if="logs.length">
                                    <tr>
                                        <th>Data Hora</th>
                                        <th>RG</th>
                                        <th>Nome</th>
                                        <th>Posto/Grad</th>
                                        <th>IP</th>
                                    </tr>
                                    <tr v-for="log in logs" :key="log.id_log_fdi">
                                        <td>{{log.data_hora | date_br_hr}}</td>
                                        <td>{{log.rg_acesso}}</td>
                                        <td>{{log.nome_acesso}}</td>
                                        <td>{{log.cargo_acesso}}</td>
                                        <td>{{log.ip}}</td>
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
                logs: [],
            }
        },
        mounted(){
            this.listLogs()
        },
        methods: {
            listLogs(){
                let urlIndex = `${this.$root.baseUrl}api/fdi/log/${this.rg}`;
                if(this.rg){
                    axios
                    .get(urlIndex)
                    .then((response) => {
                        this.logs = response.data
                    })
                    .catch(error => console.log(error));
                }
            }
        }
    }
</script>

<style scoped>

</style>