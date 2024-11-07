import { createStore } from 'vuex'

import user from '../vuex/modules/user.js';
import auth from '../vuex/modules/auth.js'
import verify from "../vuex/modules/verify.js";
import statistics from "../vuex/modules/statistics.js";
import ticket from "../vuex/modules/ticket.js"

const store = createStore({
     state: {
         search: '',
         content: '',
         recoveryMail: '',
         token: ''
     },
     getters: {
         GET_RECOVERY_MAIL:(state) => {
             return state.recoveryMail;
         }
     },
     mutations: {
         SET_RECOVERY_MAIL: (state, payload) => {
             state.recoveryMail = payload;
         }
     },
     actions: {
         RECOVERY_MAIL:(context, email) => {
            context.commit('SET_RECOVERY_MAIL', email);
         }
     },
    modules: {
        userModule: user,
        authModule: auth,
        verifyModule: verify,
        statisticsModule: statistics,
        ticketModule: ticket
    },

})

export default store
