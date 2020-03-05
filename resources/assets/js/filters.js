import moment, { months } from 'moment'

Vue.filter('date_br', function(value) {
  if (value) {
    return moment(String(value)).format('DD/MM/YYYY')
  }
})

Vue.filter('date_br_hr', function(value) {
    if (value) {
      return moment(String(value)).format('DD/MM/YYYY H:mm:ss')
    }
  })
 

Vue.filter('date_bd', function(value) {
    if (value) {
        // para casos normais
        if(value.charAt(2) == '/') return value.split('/').reverse().join('-')
        let normalDate = moment(String(value)).format('YYYY-MM-DD')
        if(normalDate !== 'Invalid date') return normalDate
        // para tipo isso Jul 17 1985 12:00AM
        let divide = value.split(' ')
        let month = [ "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec" ].indexOf(divide[0]) + 1
        let day = divide[1]
        let year = divide[2]
       return `${year}-${month}-${day}`
    }
})

Vue.filter('tempo_em_anos_e_meses', function (value) { //data vem yyyy-mm-dd
    if (!value) return ''

    let tempo_anos = moment().diff(value, 'year')
    let tempo_meses = moment().diff(value, 'month') % 12

    let ano_plural = (tempo_anos == 1) ? 'Ano' : 'Anos'
    let anos = (tempo_anos > 0 ) ? `${tempo_anos} ${ano_plural}` : '' 

    let mes_plural = (tempo_meses == 1) ? 'Mês' : 'Meses'
    let meses = (tempo_meses > 0 ) ? `${tempo_meses} ${mes_plural}` : ''

    let juncao = (tempo_anos > 0 && tempo_meses > 0) ? 'e' : ''

    return `${anos} ${juncao} ${meses}`
})

Vue.filter('tempo_em_anos', function (value) { //data vem yyyy-mm-dd
    if (!value) return ''
    let tempo_anos = moment().diff(value, 'year')
    let ano_plural = (tempo_anos == 1) ? 'Ano' : 'Anos'
    let anos = (tempo_anos > 0 ) ? `${tempo_anos} ${ano_plural}` : '' 

    return `${anos}`
})

Vue.filter('toUpper', function (value) {
    if (!value) return ''
    return value.toUpperCase()
})

Vue.filter('ucwords', function (value) {
    if (!value) return ''
    let str = value.toLowerCase()
    let re = /(^([a-zA-Z\p{M}]))|([ -][a-zA-Z\p{M}])/g
    return str.replace(re, s => s.toUpperCase())
})