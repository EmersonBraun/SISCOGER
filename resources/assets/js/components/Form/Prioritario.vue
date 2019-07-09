<template>
    <div v-if="admin" class="col-xs-12">
        <v-checkbox name="prioridade" true-value="1" false-value="0" text="O Procedimento é prioritário?(só preencha se tiver certeza)">
        </v-checkbox>
        <hr>
    </div>
</template>

<script>
    import mixin from '../../mixins.js'
    import {Checkbox} from '../Vuestrap/Checkbox'
    export default {
        components: {Checkbox},
        props: ['admin','prioridade'],   
    }
</script>

<style scoped>

</style>