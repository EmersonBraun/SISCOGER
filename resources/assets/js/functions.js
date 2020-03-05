import { mapActions } from 'vuex'
export default{
    data() {
        return {
            baseUrl: 'http://10.47.1.90/siscoger/',
        }
    },
    computed: {
        today() {
            let today = new Date();
            let dd = String(today.getDate()).padStart(2, '0');
            let mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
            let yyyy = today.getFullYear();

            today = `${dd}/${mm}/${yyyy}`;
            return today
        },
    },
    methods: {
        ...mapActions('dashboard',['changeAlert','toogleSpinner']),
        getSessionData() {
            return JSON.parse(sessionStorage.getItem("session"))
        },
        getDate(opt) {
            const d = new Date()
            const dayOfWeekBR = ['domingo','segunda-feira','terça-feira','quarta-feira','quinta-feira','sexta-feira','sábado']
            const monthBR = ['janeiro','fevereiro','março','abril','maio','junho','julho','agosto','setembro','outubro','novembro','dezembro']
            
            let day = d.getDate()
            let month = d.getMonth()
            let fullYear = d.getFullYear()
            let numOfWeek = d.getDay()

            let date = {
                day : day,
                numOfWeek : numOfWeek, 
                dayOfWeek : dayOfWeekBR[numOfWeek],
                month : month,
                monthName : monthBR[month],
                year : d.getFullYear().toString().substr(-2),
                fullYear : fullYear,
                hour : d.getHours(),
                minute : d.getMinutes(),
                date : `${fullYear}-${month}-${day}`,
                dateBR : `${day}/${month}/${fullYear}`,
            }
            console.log(date[opt])
            return date[opt]
        },
        hasPermission(permission) {
            let session = this.getSessionData()
            if(!session) return false
            let has = Object.values(session.permissions).filter(s => s == permission)
            return has
        },
        hasRole(role) {
            let session = this.getSessionData()
            if(!session) return false
            let has = Object.values(session.roles).filter(s => s == role)
            return has
        },
        dadoSession(dado){
            let session = this.getSessionData()
            return session[dado]
        },
        msg(text, type) {

            let dados = {
                show: true,
                text: text,
                type: type
            }
            this.changeAlert(dados)

            let vazio = {}
            setTimeout(() => this.changeAlert(vazio), 3000)
        },
        load(){
            this.toogleSpinner()
        },
        formatUcwords(value){
            let str = value.toLowerCase()
            let re = /(^([a-zA-Z\p{M}]))|([ -][a-zA-Z\p{M}])/g
            return str.replace(re, s => s.toUpperCase())
        }
    }
}