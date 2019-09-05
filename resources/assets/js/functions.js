import { mapActions } from 'vuex'
export default{
    data() {
        return {
            baseUrl: 'http://10.47.1.90/siscoger/',
        }
    },
    methods: {
        ...mapActions('dashboard',['changeAlert','toogleSpinner']),
        getSessionData() {
            return JSON.parse(sessionStorage.getItem("session"))
        },
        hasPermission(permission) {
            let session = this.getSessionData()
            if(!session) return false
            let has = Object.values(session.permissions).filter(s => s == permission)
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
        }
    }
}