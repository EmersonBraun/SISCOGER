export default{
    // namespaced: true,
    state: {
        session: [],
    },
    getters:{
        getSession(state){
            return state.session
        }
    },
    mutations: {
        changeSession(state, payload){
            state.session = payload
        },
    },
    actions:{
        changeSession(context, payload){
            context.commit('changeSession',payload)
        }  
    }
}