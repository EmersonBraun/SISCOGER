Vue.filter('date_br', function (value) { //data vem yyyy-mm-dd
    if (!value) return ''
    if (value.charAt(4) == '-' && value.charAt(7) == '-'){ //está realmente yyyy-mm-dd
        value = value.split('-')
        return value[2] + '/' + value[1] + '/' + value[0] //retornando dd/mm/yyyy
    }else{ // está dd/mm/yyyy
        return value
    }
})
