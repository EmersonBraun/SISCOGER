export default{
    data() {
        return {
            action: '',
            dproc: '',
            dref: '',
            dano: '',
            add: false,
            admin: false,
            rg: ''
        }
    },
    computed:{
        getBaseUrl(){
            // URL completa
            let getUrl = window.location;
            // dividir em array
            let pathname = getUrl.pathname.split('/')
            this.action = pathname[3]
            this.dproc = pathname[2]
            this.dref = pathname[4]
            this.dano = pathname[5]
            
            let baseUrl = getUrl.protocol + "//" + getUrl.host + "/" + pathname[1]+"/";
            
        return baseUrl;
        },
    },
    methods: {
        dadosSession(){
            let session = this.$root.getSessionData()
            this.admin = session.is_admin
            this.rg = session.rg
        },
    }
}