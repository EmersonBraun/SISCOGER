<template>
    <div>
        <v-label label="id_objetoprocedimento" title="Objeto do procedimento">
            <select id="id_objetoprocedimento" name="objetoprocedimento" class="form-control" required="true" v-model="op">
                <option value="">Selecione</option>
                <option value="arma">arma</option>
                <option value="munição">munição</option>
                <option value="semovente">semovente</option>
                <option value="viatura">viatura</option>
                <option value="outros">outros</option>
            </select>
        </v-label>
        <template v-if="op === 'viatura'">
            <v-label label="vtr_placa" title="Placa da viatura (sem traço)">
                <input class="form-control " id="vtr_placa" name="vtr_placa" type="text">
            </v-label>
            <v-label label="vtr_prefixo" title="Prefixo da viatura">
                <input class="form-control " id="vtr_prefixo" name="vtr_prefixo" type="text">
            </v-label>
            <v-label label="tipo_acidente" title="Tipo acidente">
                <select name="tipo_acidente" class="form-control">
                    <option value="-">-</option>
                    <option value="nao identificado">Não identificado</option>
                    <option value="abalroamento lateral">Abalroamento lateral</option>
                    <option value="abalroamento transversal">Abalroamento transversal</option>
                    <option value="atropelamento">Atropelamento</option>
                    <option value="atropelamento de animal">Atropelamento de animal</option>
                    <option value="capotamento">Capotamento</option>
                    <option value="colisao frontal">Colisão frontal</option>
                    <option value="colisao traseira">Colisão traseira</option>
                    <option value="choque">Choque</option>
                    <option value="engavetamento">Engavetamento</option>
                    <option value="incendio">Incêndio</option>
                    <option value="queda de passageiro">Queda de passageiro</option>
                    <option value="queda de objeto">Queda de objeto</option>
                    <option value="queda de moto">Queda de moto</option>
                    <option value="queda de veiculo">Queda de veículo</option>
                    <option value="tombamento">Tombamento</option>
                    <option value="acidente complexo">Acidente complexo</option>
                    <option value="nao identificado">Não identificado</option>
                </select>
            </v-label>
            <v-label label="avarias" title="Avarias">
                <select name="avarias" class="form-control">
                    <option value="">Selecione</option>
                    <option value="Pequena Monta">Pequena Monta</option>
                    <option value="Media Monta">Media Monta</option>
                    <option value="Grande Monta">Grande Monta</option>
                </select>
            </v-label>
            <v-label label="situacaoviatura" title="Situação Viatura">
                <select name="situacaoviatura" class="form-control">
                    <option value="nao informado">Não informado</option>
                    <option value="consertada com onus">Consertada com ônus</option>
                    <option value="consertada sem onus">Consertada sem ônus</option>
                    <option value="inservivel">Inservível</option>
                    <option value="aguarda conserto">Aguarda conserto</option>
                </select>
            </v-label>
        </template>
        <template v-if="op === 'arma'">
            <v-label label="identificacao_arma" title="Identificação da arma">
                <input class="form-control " id="identificacao_arma" name="vtr_placa" type="text">
            </v-label>
        </template>
        <template v-if="op === 'munição'">
           <v-label label="identificacao_municao" title="Identificação da munição">
                <input class="form-control " id="identificacao_municao" name="vtr_placa" type="text">
            </v-label>
        </template>
        <template v-if="op === 'semovente'">
           <v-label label="identificacao_semovente" title="Identificação do semovente">
                <input class="form-control " id="identificacao_semovente" name="vtr_placa" type="text">
            </v-label>
        </template>
        <template v-if="op === 'outros'">
           <v-label label="outros" title="Identificação Outros">
                <input class="form-control " id="outros" name="vtr_placa" type="text">
            </v-label>
        </template>
    </div>
</template>
<script>
    export default {
        data() {
            return {
               op: 'viatura' 
            }
        }
    }
</script>

<style scoped>

</style>