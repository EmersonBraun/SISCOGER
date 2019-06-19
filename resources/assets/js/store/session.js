export default{
    // namespaced: true,
    state: {
        session: [],
    },
    getters:{
        async getSession(state){
            if(state.session.length) return state.session
            else{
                await this.$store.putSessionData
                console.log(state.session)
                return state.session
            }
            
        }
    },
    mutations: {
        changeSession(state, payload){
            state.session = payload
        },
    },
    actions:{
        putSessionData() {
            let hasSession = this.$store.state.session.length
            if(!hasSession){
                let urlIndex = 'http://10.47.1.90/siscoger/session/dados';
                    axios
                    .get(urlIndex)
                    .then((response) => {
                        this.$store.dispatch('changeSession',response.data)
                        console.log(response.data)
                        return response.data
                    })
                    .catch(error => console.log(error));
           } 
        },
        changeSession(context, payload){
            context.commit('changeSession',payload)
        }  
    },
}