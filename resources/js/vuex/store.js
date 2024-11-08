import { createStore } from 'vuex'

import user from '../vuex/modules/user.js';
import auth from '../vuex/modules/auth.js'
import verify from "../vuex/modules/verify.js";
import statistics from "../vuex/modules/statistics.js";
import ticket from "../vuex/modules/ticket.js"
import axios from "axios";

const store = createStore({
     state: {
         search: '',
         content: '',
         recoveryMail: '',
         token: '',
         user: {
             loggedIn: localStorage.getItem('l'),
             verify: false,
             isAdmin: false
         }
     },
     getters: {
         LOGGED: (state) => {
             return state.user
         },
         GET_RECOVERY_MAIL:(state) => {
             return state.recoveryMail;
         }
     },
     mutations: {
         SET_RECOVERY_MAIL: (state, payload) => {
             state.recoveryMail = payload;
         },
         SET_USER_LOGGED: (state, payload) => {
             localStorage.setItem('l', payload)
         }
     },
     actions: {
         RECOVERY_MAIL:(context, email) => {
            context.commit('SET_RECOVERY_MAIL', email);
         },
         AUTH: (context, bool) => {
             axios.get('/api/check/logged/user').then(response => {
                 if (response.status === 200) {
                   context.commit('SET_USER_LOGGED', bool);
                     window.location.replace('/admin')
                 }
             }).catch(error => {
                 console.log(error.response);
             });
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
