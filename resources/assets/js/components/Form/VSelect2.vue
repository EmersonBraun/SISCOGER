<template>
    <div>
        <template slot="no-options">
        Escreva para buscar...
        </template>
        <template slot="option" slot-scope="option">
        <div class="d-center">
            <img :src='option.owner.avatar_url'/> 
            {{ option.full_name }}
            </div>
        </template>
        <template slot="selected-option" scope="option">
        <div class="selected d-center">
            <img :src='option.owner.avatar_url'/> 
            {{ option.full_name }}
        </div>
    </template>
    </div>
</template>

<script>
    export default {
        data: {
            options: []
        },
        methods: {
            onSearch(search, loading) {
            loading(true);
            this.search(loading, search, this);
            },
            search: _.debounce((loading, search, vm) => {
            fetch(
                `http://10.47.1.90/siscoger/api/acess/rhpr/${escape(search)}`
            ).then(res => {

                res.json().then(json => (vm.options = json.items));
                loading(false);
            });
            }, 350)
        }
    }
</script>

<style scoped>

</style>
