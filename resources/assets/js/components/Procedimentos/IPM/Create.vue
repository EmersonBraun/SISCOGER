<template>
    <v-stepper v-model="e1">
        <v-stepper-header>
            <v-stepper-step :complete="e1 > 1" step="1">Principal</v-stepper-step>
            <v-divider></v-divider>
            <v-stepper-step :complete="e1 > 2" step="2">Membros</v-stepper-step>
            <v-divider></v-divider>
            <v-stepper-step :complete="e1 > 3" step="3">Indiciados</v-stepper-step>
            <v-divider></v-divider>
            <v-stepper-step :complete="e1 > 4" step="4">Ofendidos</v-stepper-step>
            <v-divider></v-divider>
            <v-stepper-step :complete="e1 > 5" step="5">Documentação</v-stepper-step>
            <v-divider></v-divider>
            <v-stepper-step step="6">Acompanhamento justiça</v-stepper-step>
        </v-stepper-header>
        <v-stepper-items>
            <v-stepper-content step="1">
                <v-prioritario v-model="registro.prioridade"></v-prioritario>
                <v-label label="id_andamento" title="Andamento" :key="registro.id_andamento" :error="error.id_andamento">
                    <select v-model="registro.id_andamento" class="form-control">
                        <option value="">SELECIONE</option>
                        <option value="4">ANDAMENTO</option>
                        <option value="5">CONCLUÍDO</option>
                        <option value="35">ANÁLISE DO CM</option>
                    </select>
                </v-label>
                <v-label label="id_andamentocoger" title="Andamento COGER" :key="registro.id_andamentocoger" :error="error.id_andamentocoger">
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
                <v-label label="cdopm" title="OPM" :error="error.cdopm" :key="registro.cdopm">
                    <v-opm v-model="registro.cdopm"></v-opm>
                </v-label>
                <v-label label="fato_data" title="Data da fato" icon="fa fa-calendar" :error="error.fato_data">
                    <v-datepicker name="fato_data" placeholder="dd/mm/aaaa" clear-button v-model="registro.fato_data"></v-datepicker>
                </v-label>
                <v-label label="abertura_data" title="Data da portaria de delegação de poderes" icon="fa fa-calendar" :error="error.abertura_data">
                    <v-datepicker name="abertura_data" placeholder="dd/mm/aaaa" clear-button v-model="registro.abertura_data"></v-datepicker>
                </v-label>
                <v-label label="autuacao_data" title="Data da portaria de instauração" icon="fa fa-calendar" :error="error.autuacao_data">
                    <v-datepicker name="autuacao_data" placeholder="dd/mm/aaaa" clear-button v-model="registro.autuacao_data"></v-datepicker>
                </v-label>
                <v-label label="portaria_numero" title="Nº da portaria de delegação de poderes" :error="error.portaria_numero">
                    <input v-model="registro.portaria_numero" type="text" class="form-control ">
                </v-label>
                <v-label label="crime" title="Crime" :error="error.crime">
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
                <v-label v-if="registro.crime == 'Outros'" label="crime_especificar" title="Especificar crime" :error="error.crime_especificar">
                    <input v-model="registro.crime_especificar" type="text" class="form-control ">
                </v-label>
                <template v-if="registro.crime == 'Homicidio' || registro.crime == 'Lesao Corporal'" :error="error.vitima">
                    <v-label label="vítima" title="Vítima do crime">
                        <select v-model="registro.vitima" class="form-control">
                            <option value="Civil">Civil"</option>
                            <option value="Policial Militar">Policial Militar"</option>
                            <option value="Civil e Militar">Civil e Militar"</option>
                        </select>
                    </v-label>
                    <v-label label="crime_especificar" title="Confronto armado?" tooltip="Tanto o individuo como o militar estadual efetuaram disparo(s) de arma de fogo." :error="error.confronto_armado_bl">
                        <v-checkbox  v-model="registro.confronto_armado_bl" true-value="1" false-value="0" text="Confronto armado?" class="form-control "/>
                    </v-label>
                </template>
                <v-label label="tentado" title="Tentado/Consumado" :error="error.tentado">
                    <select v-model="registro.tentado" class="form-control">
                        <option value="Tentado">Tentado"</option>
                        <option value="Consumado">Consumado"</option>
                    </select>
                </v-label>
                <v-label label="id_municipio" title="Municipio" :error="error.id_municipio">
                    <v-municipio v-model="registro.id_municipio"></v-municipio>
                </v-label>
                <v-label label="bou_ano" title="BOU (Ano)" :error="error.bou_ano">
                    <v-ano v-model="registro.bou_ano"></v-ano>
                </v-label>
                <v-label label="bou_numero" title="N° BOU" :error="error.bou_numero">
                    <input v-model="registro.bou_numero" type="text" class="form-control ">
                </v-label>
                <v-label label="n_eproc" title="N° Eproc" :error="error.n_eproc">
                    <input v-model="registro.n_eproc" type="text" class="form-control ">
                </v-label>
                <v-label label="ano_eproc" title="Eproc (Ano)" :error="error.ano_eproc">
                    <v-ano v-model="registro.ano_eproc"></v-ano>
                </v-label>
                <v-label label="relato_enc" title="Conclusão do encarregado" :error="error.relato_enc">
                    <input v-model="registro.relato_enc" type="text" class="form-control ">
                </v-label>
                <v-label label="sintese_txt" title="Sintese" lg="12" md="12" :error="error.sintese_txt">
                    <textarea rows="5" cols="50" name="descricao" v-model="registro.sintese_txt" class="form-control ">  
                    </textarea>
                </v-label>
                 <div class="col-xs-12">
                    <a class="btn btn-primary btn-block" @click="validateAndCreate">Continue</a>
                </div>
            </v-stepper-content>
            <v-stepper-content step="2">
                encarregado
                escrivão
                <div class="col-xs-6">
                    <a class="btn btn-primary btn-block" @click="e1++">Continue</a>
                </div>
                <div class="col-xs-6">
                    <a class="btn btn-danger btn-block" @click="e1--">Voltar</a>
                </div>
            </v-stepper-content>
            <v-stepper-content step="3">
                indiciados
                <div class="col-xs-6">
                    <a class="btn btn-primary btn-block" @click="e1++">Continue</a>
                </div>
                <div class="col-xs-6">
                    <a class="btn btn-danger btn-block" @click="e1--">Voltar</a>
                </div>
            </v-stepper-content>
            <v-stepper-content step="4">
                Ofendidos
                <div class="col-xs-6">
                    <a class="btn btn-primary btn-block" @click="e1++">Continue</a>
                </div>
                <div class="col-xs-6">
                    <a class="btn btn-danger btn-block" @click="e1--">Voltar</a>
                </div>
            </v-stepper-content>
            <v-stepper-content step="5">
                <file-upload 
                title="PDF - Conclusão do encarregado:"
                name="relato_enc_file"
                dproc="ipm" v-if="registro.id_ipm" :idp="registro.id_ipm"
                :ext="['pdf']" 
                ></file-upload>
                <v-item-unique title="Data" proc="ipm" dproc="ipm" v-if="registro.id_ipm" :idp="registro.id_ipm" name="relato_enc_data"></v-item-unique>
                <v-item-unique title="Conclusão do encarregado" proc="ipm" dproc="ipm" v-if="registro.id_ipm" :idp="registro.id_ipm" name="relato_enc"></v-item-unique>
                <file-upload 
                title="PDF - Solução do Cmt OPM:"
                name="relato_cmtopm_file"
                dproc="ipm" v-if="registro.id_ipm" :idp="registro.id_ipm"
                :ext="['pdf']" 
                ></file-upload>
                <v-item-unique title="Data" proc="ipm" dproc="ipm" v-if="registro.id_ipm" :idp="registro.id_ipm" name="relato_cmtopm_data"></v-item-unique>
                <v-item-unique title="Conclusão do Cmt. OPM" proc="ipm" dproc="ipm" v-if="registro.id_ipm" :idp="registro.id_ipm" name="relato_cmtopm"></v-item-unique>
                <file-upload 
                title="PDF - Decisão do Cmt Geral:"
                name="relato_cmtgeral_file"
                dproc="ipm" v-if="registro.id_ipm" :idp="registro.id_ipm"
                :ext="['pdf']" 
                ></file-upload>
                <v-item-unique title="Data" proc="ipm" dproc="ipm" v-if="registro.id_ipm" :idp="registro.id_ipm" name="relato_cmtgeral_data"></v-item-unique>
                <v-item-unique title="Conclusão do Cmt. Geral" proc="ipm" dproc="ipm" v-if="registro.id_ipm" :idp="registro.id_ipm" name="relato_cmtgeral"></v-item-unique>
                
                <file-upload 
                    title="Relatório complementar"
                    name="relcomplemtentar_file"
                    dproc="ipm" v-if="registro.id_ipm" :idp="registro.id_ipm"
                    :ext="['pdf']">
                </file-upload>
                <v-item-unique title="Data" proc="ipm" dproc="ipm" v-if="registro.id_ipm" :idp="registro.id_ipm" name="relato_cmtgeral_data"></v-item-unique>
                <div class="col-xs-6">
                    <a class="btn btn-primary btn-block" @click="e1++">Continue</a>
                </div>
                <div class="col-xs-6">
                    <a class="btn btn-danger btn-block" @click="e1--">Voltar</a>
                </div>
            </v-stepper-content>
            <v-stepper-content step="6">
                <v-label label="bou_numero" title="Referência da Vajme" tooltip="Nº do processo, vara">
                    <input v-model="registro.bou_numero" type="text" class="form-control ">
                </v-label>
                <v-label label="bou_numero" title="Referência da Justiça Comum" tooltip="Nº do processo, vara">
                    <input v-model="registro.bou_numero" type="text" class="form-control ">
                </v-label>
                <div class="col-xs-6">
                    <a class="btn btn-success btn-block" @click="e1++">Inserir</a>
                </div>
                <div class="col-xs-6">
                    <a class="btn btn-danger btn-block" @click="e1--">Voltar</a>
                </div>
            </v-stepper-content>
        </v-stepper-items>
    </v-stepper>
</template>

<script>
    export default {
        data () {
            return {
                module: 'ipm',
                e1: 1,
                valid: false,
                error: {},
                registro: {}
            }
        },
        methods: {
            validateAndCreate() {
                // SITUAÇÃO
                // CIDADE DO FATO
                // SÍNTESE DO FATO (QUEM, QUANDO, ONDE, COMO E POR QUÊ)
                const msg = ' é obrigatóri'
                if (!this.registro.cdopm) this.error.cdopm = `OPM${msg}a`
                if (!this.registro.abertura_data) this.error.abertura_data = `Data da portaria${msg}a`
                if (!this.registro.portaria_numero) this.error.portaria_numero = `Número da portaria${msg}o`
                if (!this.registro.crime) this.error.crime = `Motivo${msg}o`
                if (this.registro.crime == 'Outros' && !this.registro.crime_especificar) this.error.crime_especificar = `Motivo Outros${msg}o`
                if (this.registro.crime == 'Homicidio' || this.registro.crime == 'Lesao Corporal') {
                    if(!this.registro.vitima) this.error.vitima = `Motivo Outros${msg}o`
                    if(!this.registro.confronto_armado_bl) this.error.confronto_armado_bl = `Motivo Outros${msg}o`
                }
                console.log(this.error)
                if (!this.error) this.create
            },
            async create() {
                const url = `${this.$root.baseUrl}api/${this.module}/create`;
                try { 
                    const response = await axios.post(url, this.registro)
                    this.el++
                } catch (error) {
                    console.log(error)
                }
            },
        },
    }
</script>

<style scoped>

</style>