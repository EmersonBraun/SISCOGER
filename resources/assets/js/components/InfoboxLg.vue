<template>
    <div>
        <div :class="colorClass">
            <div class="inner">
                <h3>{{ value }}</h3>
                <p>{{ title }}</p>
            </div>
            <div class="icon">
                <i :class="iconClass"></i>
            </div>
            <a href="#" class="small-box-footer">{{ text }}<i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['value','title','icon','route','text','bg'],
        computed: {
            // colorClass:function() {
            //     return "small-box bg-"+this.bg
            // },
            // iconClass:function() {
            //     return "fa fa-"+this.icon
            // },
            // routeHref:function() {
            //     return this.route
            // }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>

<style scoped>

</style>