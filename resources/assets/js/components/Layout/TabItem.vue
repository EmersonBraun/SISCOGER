<template>
    <div class="box tab-pane" :id="idp" :class="cls">
        <div class="box-header">
            <h4 class="box-title">{{ title }}</h4>            
        </div>
        <div class="box-body">
            <slot></slot>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            idp: {
                type: String,
                default: ''
            },
            title: {
                type: String,
                default: ''
            },
            cls: {
                type: String,
                default: ''
            },
        },
    }
</script>

<style scoped>

</style>