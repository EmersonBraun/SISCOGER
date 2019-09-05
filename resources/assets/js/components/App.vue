<template>
    <div>
        <v-spinner :value="spinner" size="xl" text="Carregando"></v-spinner>
        <v-alert v-model="show" placement="top-right" duration="3000" :type="type" width="400px">
            <span class="icon-info-circled alert-icon-float-left"></span>
            {{ text}}
        </v-alert>
    </div>
</template>

<script>
    export default {
        computed: {
            spinner(){
                return this.$store.state.dashboard.spinner
            },
            show(){
                return this.$store.state.dashboard.alert.show
            },
            type(){
                return this.$store.state.dashboard.alert.type
            },
            text(){
                return this.$store.state.dashboard.alert.text
            }
        },
    }
</script>

<style scoped>

</style>