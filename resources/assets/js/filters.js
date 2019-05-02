Vue.filter('date_br', function (value) { //data vem yyyy-mm-dd
    if (!value) return ''
    value = value.split('-')
    return value[2] + '/' + value[1] + '/' + value[0] //retornando dd/mm/yyyy
})