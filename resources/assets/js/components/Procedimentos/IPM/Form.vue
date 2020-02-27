<template>
    <div>
        <v-prioritario v-model="registro.prioridade"></v-prioritario>
        <v-label label="id_andamento" title="Andamento" :error="error.id_andamento">
            <select v-model="registro.id_andamento" class="form-control">
                <option value="">SELECIONE</option>
                <option value="4">ANDAMENTO</option>
                <option value="5">CONCLUÍDO</option>
                <option value="35">ANÁLISE DO CM</option>
            </select>
        </v-label>
        <v-label label="id_andamentocoger" title="Andamento COGER" :error="error.id_andamentocoger">
             <select v-model="registro.id_andamentocoger" class="form-control">
                <option value="">SELECIONE</option>
                <option value="18">DECIDIDO CG</option>
                <option value="19">VAJME</option>
                <option value="20">ARQUIVADO VAJME</option>
                <option value="45">JUSTICA COMUM</option>
                <option value="46">ARQUIVADO/JUST. COMUM</option>
                <option value="47">COGER</option>
            </select>
        </v-label>
        <v-label label="cdopm" title="OPM" :error="error.cdopm">
            <v-opm v-model="registro.cdopm"></v-opm>
        </v-label>
        <v-label label="fato_data" title="Data da fato" icon="fa fa-calendar">
            <v-datepicker name="fato_data" placeholder="dd/mm/aaaa" clear-button v-model="registro.fato_data"></v-datepicker>
        </v-label>
        <v-label label="abertura_data" title="Data da portaria de delegação de poderes" icon="fa fa-calendar">
            <v-datepicker name="abertura_data" placeholder="dd/mm/aaaa" clear-button v-model="registro.abertura_data"></v-datepicker>
        </v-label>
        <v-label label="autuacao_data" title="Data da portaria de instauração" icon="fa fa-calendar">
            <v-datepicker name="autuacao_data" placeholder="dd/mm/aaaa" clear-button v-model="registro.autuacao_data"></v-datepicker>
        </v-label>
        <v-label label="portaria_numero" title="Nº da portaria de delegação de poderes">
            <input v-model="registro.portaria_numero" type="text" class="form-control ">
        </v-label>
        <v-label label="crime" title="Crime">
            <select v-model="registro.crime" class="form-control">
                <option value="Homicidio">Homicidio"</option>
                <option value="Lesao Corporal">Lesao Corporal"</option>
                <option value="Extravio de arma">Extravio de arma"</option>
                <option value="Furto de arma">Furto de arma"</option>
                <option value="Roubo de arma">Roubo de arma"</option>
                <option value="Extravio de municao">Extravio de Munição"</option>
                <option value="Concussao">Concussão (Art. 305)"</option>
                <option value="Peculato">Peculato (Art. 303)"</option>
                <option value="Corrupcao passiva">Corrupção passiva (Art. 308)"</option>
                <option value="Contrabando ou descaminho">Contrabando ou descaminho"</option>
                <option value="Uso de documento falso">Uso de documento falso (Art. 315)"</option>
                <option value="Falsidade ideologica">Falsidade ideológica"</option>
                <option value="Fuga de Preso">Fuga de preso"</option>
                <option value="Prevaricacao">Prevaricação (Art. 319)"</option>
                <option value="Violacao do sigilo funcional">Violação do sigilo funcional"</option>
                <option value="Deserção">Deserção"</option>
                <option value="Violencia contra superior">Violencia contra superior (Art. 157)"</option>
                <option value="Violencia contra militar de sv">Violencia contra militar de serviço (Art. 158)"</option>
                <option value="Desrespeito a superior">Desrespeito a superior (Art. 160)"</option>
                <option value="Recusa de obediencia">Recusa de obediencia (Art. 163)"</option>
                <option value="Abandono de posto">Abandono de posto (Art. 195)"</option>
                <option value="Embriaguez em servico">Embriaguez em serviço (Art. 202)"</option>
                <option value="Desacato a superior">Desacato a superior (Art. 298)"</option>
                <option value="Desacato a militar">Desacato a militar (Art. 299)"</option>
                <option value="Furto">Furto"</option>
                <option value="Roubo">Roubo"</option>
                <option value="Dano">Dano"</option>
                <option value="Instigamento ao suicidio">Instigamento ao suicidio"</option>
                <option value="Abuso de autoridade">Abuso de autoridade"</option>
                <option value="Auferir vantagem indevida">Auferir vantagem indevida"</option>
                <option value="Outros">Outros (especificar)"</option>
            </select>
        </v-label>
        <v-label v-if="registro.crime == 'Outros'" label="crime_especificar" title="Especificar crime">
            <input v-model="registro.crime_especificar" type="text" class="form-control ">
        </v-label>
        <v-label label="id_municipio" title="Municipio">
            <v-municipio v-model="registro.id_municipio"></v-municipio>
        </v-label>
        <v-label label="bou_ano" title="BOU (Ano)">
            <v-ano v-model="registro.bou_ano"></v-ano>
        </v-label>
        <v-label label="bou_numero" title="N° BOU">
            <input v-model="registro.bou_numero" type="text" class="form-control ">
        </v-label>
        <v-label label="n_eproc" title="N° Eproc">
            <input v-model="registro.n_eproc" type="text" class="form-control ">
        </v-label>
        <v-label label="ano_eproc" title="Eproc (Ano)">
            <v-ano v-model="registro.ano_eproc"></v-ano>
        </v-label>
        <v-label label="relato_enc" title="Conclusão do encarregado">
            <input v-model="registro.relato_enc" type="text" class="form-control ">
        </v-label>
        <v-label label="sintese_txt" title="Sintese" lg="12" md="12" :error="error.sintese_txt">
            <div class="col-lg-12 col-md-12 col-xs-12">
            <label for="descricao">Síntese</label><br>
            <textarea rows="5" cols="50" name="descricao" v-model="registro.sintese_txt" class="form-control ">  
            </textarea>
        </div>
        </v-label>
        <div class="col-xs-12">
            <a v-if="registro.id_ipm" class="btn btn-success btn-block" @click.prevent="update(registro.id_ipm)">Editar</a>
            <a v-else class="btn btn-success btn-block" @click="create">Inserir</a>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['idp'],
        data() {
            return {
                error: {},
                registro: {}
            }
        },
        created() {
            console.log('criado')
        },
        methods: {
            create () {

            },
            update (id) {

            }
        }
    }
</script>

<style scoped>

</style>