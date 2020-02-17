<template>
    <div>
        <select :name="name" v-model="year" class="form-control" @click="$emit('input', $event.target.value)">
            <option v-if="selecione" value="">Selecione</option>
            <option v-if="todos" value="">Todos</option>
            <option v-for="y in years" :value="y" :key="y">{{ y }}</option>
        </select>
    </div>
</template>

<script>
    export default {
        created(){
            const start = !this.fim ? new Date().getFullYear() : this.fim
            const end = !this.inicio ? 2007 : this.inicio
            const tam = start - end
            const y = Array.from({length: tam}, (value, index) => start - index)

            this.years = y
            if(!this.year) this.year = start
        },
        props: {
            name: {type: String, default: 'ano'},
            todos: {type: Boolean, default: false},
            ano: {type: String, default: ''},
            inicio: {type: Number, default: 2007},
            fim: {type: Number, default: () => new Date().getFullYear()},
            selecione: {type: Boolean, default: false}
        },
        data(){
            return {
                year: this.ano
            }
        },
    }
</script>

<style scoped>

</style>