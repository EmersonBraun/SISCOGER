<template>
    <div class="row">
    <div class="col-xs-12">
        <div class="box collapsed-box">
            <div class="box-header">
                <h2 class="box-title">Dependentes
                &emsp;<i class="fa fa-info-circle text-info" data-toggle="tooltip" data-placement="bottom" title="O campo poderá ser suprimido nos casos de certidão da Ficha Disciplinar Individual do militar estadual."></i>
                <span v-if="dependentes.length" class="badge bg-red">{{dependentes.length}}</span></h2>
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
                            <template v-if="dependentes.length">
                                <tr v-for="(dependente, index) in dependentes" :key="index">
                                    <td>
                                    {{ dependente.nome }} 
                                    ({{ dependente.sexo }}), 
                                    {{ dependente.parentesco }} , 
                                    Nascimento: {{ dependente.data_nasc | date_bd | date_br}} 
                                    ({{ dependente.data_nasc | date_bd | tempo_em_anos_e_meses}}) 
                                    Convênio: {{ dependente.irpf }}
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
                dependentes: []
            }
        },
        mounted(){
            this.listDependentes()
        },
        methods: {
            listDependentes(){
                let urlIndex = `${this.$root.baseUrl}api/fdi/dependentes/${this.rg}`;
                if(this.rg){
                    axios
                    .get(urlIndex)
                    .then((response) => {
                        this.dependentes = response.data
                    })
                    .catch(error => console.log(error));
                }
            }
        }
    }
</script>

<style scoped>

</style>