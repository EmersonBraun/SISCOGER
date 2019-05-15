<template>
    <div class="col-lg-12 col-md-12 col-xs-12 card">
            <div class="card-header">
                <h5><b>Réus</b></h5> 
            </div>
            <div class="card-body" :class="add ? 'bordaform' : ''" v-if="!only">
                <div>
                    <div id="ligacaoForm1" class="row">
                        <form id="formData" name="formData">
                            <input type="hidden" name="envolvido[0][id_envolvido]" value="188220">
                            <div class="col-lg-4 col-md-4 col-xs-4">
                                <label for="nome">Indiciado</label><br>
                                <input type="text" name="nome" :value="nome">
                            </div>
                            <div class="col-lg-4 col-md-4 col-xs-4">
                                <label for="nome">Processo Crime</label><br>
                                <select name="envolvido[0][ipm_processocrime]">
                                    <option value="">Selecione</option>
                                    <option value="Denunciado">Denunciado</option>
                                    <option value="Arquivado">Arquivado</option>
                                </select>
                            </div>
                            <div class="col-lg-4 col-md-4 col-xs-4">
                                <label for="nome">Julgamento</label><br>
                                <select name="envolvido[0][ipm_julgamento]">
                                    <option rel="none" value="">Selecione</option>
                                    <option rel="foicondenado0" value="Condenado">Condenado</option>
                                    <option rel="none" value="Absolvido">Absolvido</option>
                                </select>
                            </div>
                            <template>
                                <div class="col-lg-1 col-md-1 col-xs-1">
                                    <label for="nome">Pena (anos)</label><br>
                                    <input size="2" type="text" name="envolvido[0][ipm_pena_anos]">
                                </div>
                                <div class="col-lg-1 col-md-1 col-xs-1">
                                    <label for="nome">Pena (meses)</label><br>
                                    <input size="2" type="text" name="envolvido[0][ipm_pena_meses]">
                                </div>
                                <div class="col-lg-1 col-md-1 col-xs-1">
                                    <label for="nome">Pena (dias)</label><br>
                                    <input size="2" type="text" name="envolvido[0][ipm_pena_dias]">
                                </div>
                                <div class="col-lg-2 col-md-2 col-xs-2">
                                    <label for="nome">Trânsito em julgado</label><br>
                                    <v-checkbox name="ipm_transitojulgado_bl" true-value="S" false-value="0"
                                    text="Transitou em julgado">
                                    </v-checkbox>
                                </div>
                                <div class="col-lg-1 col-md-1 col-xs-1">
                                    <label for="nome">Tipo da pena</label><br>
                                    <select name="envolvido[0][ipm_tipodapena]">
                                        <option value="">Selecione</option>
                                        <option value="Detenção">Detenção</option>
                                        <option value="Reclusão">Reclusão</option>
                                    </select>
                                </div>
                                <div class="col-lg-3 col-md-3 col-xs-3">
                                    <label for="obs_txt">Restritiva de direito?</label><br>
                                    <v-checkbox name="ipm_restritiva_bl" true-value="S" false-value="0"
                                    text="Convertida restritiva de direito ">
                                    </v-checkbox>
                                </div>
                            </template>
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <label for="obs_txt">Observações</label><br>
                                <textarea rows="3" cols="50" name="obs_txt" v-model="obs_txt" class="form-control ">  
                                </textarea>
                            </div>
                             <div class="col-lg-6 col-md-6 col-xs-6">
                                <label>Cancelar</label><br>
                                <a class="btn btn-danger btn-block" @click="clear(false)"><i class="fa fa-times" style="color: white"></i></a>
                            </div>
                            <div class="col-lg-6 col-md-6 col-xs-6">
                                <label>Adicionar</label><br>
                                <a class="btn btn-success btn-block" :disabled="!data.length && !descricao.length" @click="createMovimento"><i class="fa fa-plus" style="color: white"></i></a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-footer"> 
                <div class="row bordaform" v-if="movimentos.length">
                    <div class="col-sm-12">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="col-sm-2">#</th>
                                    <th class="col-sm-2">Data</th>
                                    <template v-if="admin">
                                        <th class="col-sm-2">Descrição</th>
                                    </template>
                                    <template v-else>
                                        <th class="col-sm-4">Descrição</th>
                                    </template>
                                    <th class="col-sm-2">OPM</th>
                                    <th class="col-sm-2">RG</th>
                                    <th v-if="admin" class="col-sm-2">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(movimento, index) in movimentos" :key="index">
                                    <td>{{ index + 1 }}</td>
                                    <td>{{ movimento.data}}</td>
                                    <td>{{ movimento.descricao }}</td>
                                    <td>{{ movimento.opm }}</td>
                                    <td>{{ movimento.rg }}</td>
                                    <td v-if="admin">
                                        <div class="btn-group" role="group" aria-label="First group">
                                            <a type="button"  @click="removeMovimento(movimento, index)" class="btn btn-danger" style="color: white">
                                                <i class="fa fa-trash"></i> 
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                    
                        </table>
                    </div>
                </div>  
                <div v-if="!movimentos.length && only">
                    <h5>
                        <b>Não há registtros</b>
                    </h5>
                </div> 
            </div>
        </div>
    <div>
</template>

<script>
    export default {
        /*[id_envolvido] 
    [rg_substituto]
    [nome] 
    [rg] 
    [situacao] 
    [cargo] 
    [resultado] 
    [inclusao_ano] 
    [id_ipm] 
    [id_cj] 
    [id_cd] 
    [id_adl] 
    [id_sindicancia] 
    [id_fatd] 
    [id_desercao] 
    [id_apfd] 
    [id_iso] 
    [id_it]
    [id_pad] 
    [id_sai] 
    [ipm_julgamento] 
    [ipm_processocrime]
    [ipm_pena_anos] 
    [ipm_pena_meses] 
    [ipm_pena_dias]
    [ipm_tipodapena] 
    [ipm_transitojulgado_bl] 
    [ipm_restritiva_bl]  
    [obs_txt] 
    [exclusaoportaria_data] 
    [exclusaoportaria_numero] 
    [exclusaoboletim] 
    [exclusaobg_numero]
    [exclusaobg_ano] 
    [exclusaobg_data]
    [exclusaoopm]
    [id_punicao]
    [id_proc_outros] */
    }
</script>

<style scoped>

</style>

