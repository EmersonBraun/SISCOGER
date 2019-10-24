<template>
        <the-mask v-model="val" mask="DU:TM" class="form-control" :tokens="hexTokens" type="text" placeholder="00:00" @click="$emit('input', $event.target.value)"/>
</template>

<script>
    export default {
        data(){
            return {
                val: '',
                hexTokens: {
                    D: {pattern: /[0-2]/},
                    U: {pattern: /[0-9]/},
                    T: {pattern: /[0-5]/},
                    M: {pattern: /[0-9]/}
                }
            }
        },
    }
</script>

<style scoped>

</style>