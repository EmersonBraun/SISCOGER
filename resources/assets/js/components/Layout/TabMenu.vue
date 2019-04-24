<template>
    <ul class="nav nav-tabs">
        <li 
        v-for="item in itens" :key="item.idp"
        :class="'a ' + item.idp + ' ' +(item.cls || '')">
            <a :href="'#' + item.idp" data-toggle="tab" :onclick="oc(item.idp)">
                {{ item.name }} 
            </a>
        </li>
    </ul>
</template>

<script>
    export default {
        props: {
            itens: {
                type: Array, 
                default: []
            }
        },
        methods:{
            oc(idp){
                return "mudaTab('"+idp+"')"
            }
        }
    }
</script>
