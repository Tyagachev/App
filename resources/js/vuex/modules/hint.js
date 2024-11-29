import axios from "axios";
import store from "@/vuex/store.js";

const state = {
    hints: [],
}

const getters = {
    GET_HINTS: (state) => {
        return state.hints;
    }
}

const mutations = {
    SET_HINTS: (state, payload) => {
       state.hints = payload
    }
}

const actions = {
    HINTS_TICKES_LIST: (context) => {
        axios.get('/api/hint/index').then(response => {
            console.log(response);
            context.commit('SET_HINTS', response.data);
        })
    }
}

export default {
    namespaced: true,
    state,
    getters,
    mutations,
    actions
}
