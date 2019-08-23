<template>
    <div>
        <Label label="id_classpunicao" title="Classificação da punição" :error='error'>
            <select v-model="selectedGradacao" @change="selectGradacao" class="form-control" name="id_gradacao" required>
                <option v-for="p in punicao" :value="p.id" :key="p.id">{{ p.name }}</option>
            </select>
        </Label>
        <Label label="id_gradacao" title="Gradação da punição" v-if="options.length || id_classpunicao">
            <select v-model="selectedPunicao" v-if="options.length" @change="selectDias" class="form-control" name="id_classpunicao">
                <option v-for="option in options" :value="option.id" :key="option.id">{{ option.name }}</option>
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
            id_gradacao: {type: String, default: ''},
            id_classpunicao: {type: String, default: ''},
            dias: {type: String, default: ''},
            error: false
        },
        data(){
            return {
                punicao:[
                    {
                        id: 0, 
                        name: 'Leve',
                        options: [
                            {id: 0, name: 'Advertência'},
                            {id: 1, name: 'Impedimento Disciplinar'},
                        ]
                    },
                    {
                        id: 1, 
                        name: 'Média',
                        options: [
                            {id: 2, name: 'Repreensão'},
                            {id: 3, name: 'Detenção'},
                        ]
                    },
                    {
                        id: 2, 
                        name: 'Grave',
                        options: [
                            {id: 4, name: 'Prisão'},
                        ]
                    }
                ],
                selectedGradacao: this.id_gradacao,
                selectedPunicao: this.id_classpunicao,
                qtdDias: this.dias,
                options:[],
                selectedGradacaoLabel:'',
                hasDias: false
            }
        },
        methods:{
            selectGradacao() {
                this.selectedPunicao = '';
                this.hasDias = 0;
                this.options = this.punicao[this.selectedGradacao].options;
            },
            selectDias() {
                if([1,3,4].includes(this.selectedPunicao)) this.hasDias = true
                else this.hasDias = false
            }
        }
    }
</script>

<style scoped>

</style>