import axios from "axios";

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
    UPDATE_HINT_VALUE: (context, payload) => {
        axios.post('/api/hint/update', payload).then(response => {
            console.log(response);
        });
    },
    HINTS_TICKES_LIST: (context) => {
        axios.get('/api/hint/index').then(response => {
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
