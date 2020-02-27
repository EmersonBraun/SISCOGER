<template>
    <div>
        <div class="text-center">
        <h1>BEM VINDO(A) AO SISCOGER!</h1>
        <h2>Altere a senha padrão para ter acesso ao sistema!</h2>
        </div>
        <div class='col-md-10 col-md-offset-1'>
            <v-label label="password" title="Senha" :error="error.pass">
                <input class="form-control" name="password" type="text" v-model="pass">
            </v-label>
            <v-label label="password_confirmation" title="Senha">
                <input class="form-control" name="password_confirmation" type="text" v-model="pass_confirm">
            </v-label>
            <button @click="updatePassword" class="btn btn-success btn-block"><i class="fa fa-plus"></i> Atualizar</button>
        </div>
    </div>
</template>

<script>
    export default {
       props:['id_user'], 
       methods: {
           updatePassword() {
               
           }
       }
    }
</script>

<style scoped>

</style>