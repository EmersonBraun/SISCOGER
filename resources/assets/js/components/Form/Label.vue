<template>
    <div :class="classform">
        <i v-if="icon && !link" :class="icon"></i>
        <label :for="label">{{ title }}</label>
        <a v-if="link" :href="link" target="_blank"><i :class="icon"></i></a>
        <br>
        <slot></slot>
        <span v-if="error" class="help-block">
            <strong>{{ error }}</strong>
        </span>
    </div>
</template>

<script>
    export default {
        props:{
            title: '',
            label: '',
            icon: '',
            link: '',
            lg: {default: '4'},
            md: {default: '6'},
            xs: {default: '12'},
            error: {type: String,default: ''},
            slim: {type: Boolean, default: false}
        },
        computed:{
            classform(){
                let form = (this.slim) ? 'form-group2 form-group ' : 'form-group '
                let lg = 'col-lg-' + this.lg + ' '
                let md = 'col-md-' + this.md + ' '
                let xs = 'col-xs-' + this.xs + ' '
                let error = this.error.length > 0 ? 'has-error' : ''
                return form+lg+md+xs+error
            }
        }
    }
</script>

<style scoped>
.form-group2 {
    margin-bottom: 2px;
}
</style>


