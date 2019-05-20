<template>
    <p>
        {{ exibe }}
    </p>
</template>

<script>
    export default {
        props: ['dado'],
        computed: {
            exibe(){
                // verifica se existe o dado
                let d = (!this.dado) ? 'Não Há' :  this.dado
                // verifica se é booleano
                if(d.length < 2){
                    let t = (d.toUpperCase() == 'S' || d.toUpperCase() == 'Y' || d == 1) ? 'Sim' : 'Não'
                    return t
                }
                return d
            }
        }
    }
</script>

<style scoped>

</style>