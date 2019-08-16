<template>
    <div class="small-box " :class="background">
    <div class="inner">
        <h3>{{value}}</h3>
        <p>{{title}}</p>
    </div>
    <div class="icon">
        <i class="fa " :class="faicon"></i>
    </div>
    <a :href="route" class="small-box-footer">{{text}}<i class="fa fa-arrow-circle-right"></i></a>
</div>
</template>

<script>
    export default {
        props: {
            title: {type: String,default: ''},
            bg: {type:String,default: 'aqua'},
            icon: {type:String,default: 'balance-scale'},
            value: {type:Number,default: 0},
            route: {type:String,default: '#'},
            text: {type:String,default: 'Mais Informações'},
        },
        computed: {
            background(){
                return `bg-${this.bg}`
            },
            faicon(){
                return `fa-${this.icon}`
            }
        }

    }
</script>

<style scoped>

</style>
