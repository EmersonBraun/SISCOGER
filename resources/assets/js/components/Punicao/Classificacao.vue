<template>
    <div>
        <Label label="id_classpunicao" title="Classificação da punição" :error='error'>
            <select v-model="selectedClassificacao" @change="selectClassificacao" class="form-control" name="id_classpunicao" required>
                <option v-for="p in punicao" :value="p.id" :key="p.id" >{{ p.name }}</option>
            </select>
        </Label>
        <Label label="id_gradacao" title="Gradação da punição" v-if="options.length || id_gradacao">
            <select v-model="selectedPunicao" v-if="options.length" @change="selectDias" class="form-control" name="id_gradacao">
                <option v-for="option in options" :value="option.id" :key="option.id" >{{ option.name }}</option>
            </select>
        </Label>
        <template v-if="hasDias || dias">
            <Label label="dias" title="Quantidade de dias">
                <the-mask mask="####" class="form-control" type="text" maxlength="4" name="dias" :value="qtdDias" placeholder="Dias"/>
            </Label>
        </template> 
    </div>
</template>

<script>
    import Label from '../Form/Label'
    import {TheMask} from 'vue-the-mask'
    export default {
        components: { Label, TheMask},
        props: {
            id_gradacao: {type: Number},
            id_classpunicao: {type: Number},
            dias: {type: String},
            error: false
        },
        data(){
            return {
                punicao:[
                    {
                        id: 1, 
                        name: 'Leve',
                        options: [
                            {id: 1, name: 'Advertência'},
                            {id: 2, name: 'Impedimento Disciplinar'},
                        ]
                    },
                    {
                        id: 2, 
                        name: 'Média',
                        options: [
                            {id: 3, name: 'Repreensão'},
                            {id: 4, name: 'Detenção'},
                        ]
                    },
                    {
                        id: 3, 
                        name: 'Grave',
                        options: [
                            {id: 5, name: 'Prisão'},
                        ]
                    }
                ],
                selectedClassificacao: '',
                options: [],
                selectedPunicao: '',
                qtdDias: this.dias,
                hasDias: false
            }
        },
        created(){
            if(this.id_classpunicao) {
                this.selectedClassificacao = this.id_classpunicao
                console.log(this.selectedClassificacao)
                this.options = this.punicao[this.selectedClassificacao - 1].options
            }
            if(this.id_gradacao) this.selectedPunicao = this.id_gradacao
        },
        methods:{
            selectClassificacao() {
                this.selectedPunicao = '';
                this.hasDias = 0;
                this.options = this.punicao[this.selectedClassificacao - 1].options;
            },
            selectDias() {
                if([1,3,4].includes(this.selectedPunicao -1)) this.hasDias = true
                else this.hasDias = false
            }
        }
    }
</script>

<style scoped>

</style>