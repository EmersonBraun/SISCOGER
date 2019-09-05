export default{
    namespaced: true,
    state: {
        spinner: false,
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
        toogleSpinner(state){
            state.spinner = true ? false : true
        },
    },
    actions:{
        changeAlert(context, payload){
            context.commit('changeAlert',payload)
        }, 
        toogleSpinner(context){
            context.commit('toogleSpinner')
        }
    },
}