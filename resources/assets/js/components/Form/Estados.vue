<template>
    <div>
       <select :name="name" v-model='uf' class="form-control">
		    <option value="AC">AC</option>
		    <option value="AL">AL</option>
		    <option value="AM">AM</option>
		    <option value="AP">AP</option>
		    <option value="BA">BA</option>
		    <option value="CE">CE</option>
		    <option value="DF">DF</option>
		    <option value="ES">ES</option>
		    <option value="GO">GO</option>
		    <option value="MA">MA</option>
		    <option value="MT">MT</option>
		    <option value="MS">MS</option>
		    <option value="MG">MG</option>
            <option value="PA">PA</option>		    
            <option value="PB">PB</option>
		    <option value="PR" selected='selected'>PR</option>
		    <option value="PE">PE</option>
		    <option value="PI">PI</option>
		    <option value="RJ">RJ</option>
		    <option value="RN">RN</option>
		    <option value="RO">RO</option>
		    <option value="RS">RS</option>
		    <option value="RR">RR</option>
		    <option value="SC">SC</option>
		    <option value="SE">SE</option>
		    <option value="SP">SP</option>
		    <option value="TO">TO</option>
        </select> 
    </div>
</template>

<script>
    export default {
        props: {
            uf: {type: String, default: 'PR'},
            name: {type: String, default: 'uf'}
        },
    }
</script>

<style scoped>

</style>