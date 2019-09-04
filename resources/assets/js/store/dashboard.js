export default{
    namespaced: true,
    state: {
        alert: {},
    },
    getters:{
        getAlert(state){
            return state.alert
            
        }
    },
    mutations: {
        changeAlert(state, payload){
            state.alert = payload
        },
    },
    actions:{
        changeAlert(context, payload){
            context.commit('changeAlert',payload)
        }  
    },
}