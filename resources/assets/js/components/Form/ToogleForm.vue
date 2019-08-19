<template>
    <div>
        <Label :title='title' :label='name' :lg='lg' :md='md' :xs='xs' :error='error' :sim='slim'>
         <select :name='name' v-model='option' class='form-control'>
            <option v-for="option in options" value="option.index" :key='option.index'>{{option.name}}</option>
        </select> 
        </Label>
        <template v-if="option.rel == toogle[0]">
            <slot name="toogle1" ></slot>
        </template>
        <template v-else>
            <slot name="toogle2"></slot>
        </template>
    </div>
</template>

<script>
    import Label from './Label'
    export default {
        components: {Label},
        props:{
            title: '',
            lg: {default: '4'},
            md: {default: '6'},
            xs: {default: '12'},
            error: {type: String,default: ''},
            slim: {type: Boolean, default: false},
            name: '',
            options: {type: Array,default: []},
            toogle: {type: Array,default: []},
        },
        data() {
            return {
                option: {}
            }
        }
    }
</script>

<style scoped>

</style>