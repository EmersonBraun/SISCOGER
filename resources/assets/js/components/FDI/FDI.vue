<template>
    <v-tab header="FDI" :badge="tam">
        <!-- Mudanças de comportamento -->
        <template v-if="canSeeComportamentos">
           <Comportamento :pm="pm" @length="elogiosLenght"></Comportamento>
        </template>
        <!-- Elogios -->
        <template v-if="canSeeElogios">
            <Elogios :pm="pm"></Elogios>
        </template>
    </v-tab>
</template>

<script>
import Comportamento from './Comportamento.vue'
import Elogios from './Elogios.vue'
    export default {
        components: {Comportamento, Elogios},
        props:['pm'],
        data() {
            return {
                canSeeComportamentos: false,
                canSeeElogios: false,
                tam: 0
            }
        },
        mounted(){
            this.canSeeComportamentos = this.$root.hasPermission('ver-mudanca-comportamento')
            this.canSeeElogios = this.$root.hasPermission('ver-elogios')
        },
        methods: {
            elogiosLenght(value) {
                this.tam = value
            }
        }
    }
</script>

<style scoped>

</style>