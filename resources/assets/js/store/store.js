import Vue from 'vue'
import Vuex from 'vuex'

import session from './session'
import dashboard from './dashboard'

Vue.use(Vuex)

export default new Vuex.Store({
    namespaced: true,
    modules:{ session, dashboard}
})