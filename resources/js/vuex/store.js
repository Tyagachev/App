import { createStore } from 'vuex'

import userModule from '../vuex/modules/user.js';
import authModule from '../vuex/modules/auth.js'
import verifyModule from "../vuex/modules/verify.js";
import statisticsModule  from "../vuex/modules/statistics.js";

const store = createStore({
     state: {
         //
     },
     getters: {
         //
     },
     mutations: {
         //
     },
     actions: {
         //
     },
    modules: {
        userModule: userModule,
        authModule: authModule,
        verifyModule: verifyModule,
        statisticsModule: statisticsModule
    },

})

export default store
