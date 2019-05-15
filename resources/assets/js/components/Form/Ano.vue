<template>
    <div>
        <select :name="name" v-model="year" class="form-control">
            <option v-for="year in years" :value="year" :key="year">{{ year }}</option>
        </select>
    </div>
</template>

<script>
    export default {
        props: {
            name: {type: String, default: 'ano'},
            ano: {type: String, default: ''},
            inicio: {type: String, default: ''},
            fim: {type: String, default: this.currentYear}
        },
        data(){
            return {
                year: this.ano
            }
        },
        computed: {
            years () {
            const end = !this.fim ? new Date().getFullYear() : this.fim
            const start = !this.inicio ? 2007 : this.inicio
            const tam = end - start
            const y = Array.from({length: tam}, (value, index) => (start + 1) + index)
                return y
            },
        }
    }
</script>

<style scoped>

</style>