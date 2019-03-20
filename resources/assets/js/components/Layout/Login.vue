<template>
    <div>
         <v-input 
            name="rg" 
            id="rg" 
            :value="value"
            label="RG"
            error="Insira o RG"
            placeholder="RG"
            pattern="^[0-9]+$"
            minlength="5"
            required
            icon
            ></v-input>
    </div>
</template>

<script>
    export default {
        props: ['value'],
    }
</script>

<style scoped>

</style>