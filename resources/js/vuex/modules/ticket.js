import axios from "axios";
import store from "../store.js";
const state = {
    tickets: []
}

const getters = {
    GET_TICKETS_LIST: (state) => {
        return state.tickets
    }
}

const mutations = {
    SET_TICKETS_LIST: (state, payload) => {
        state.tickets = payload;
    }
}

const actions = {
    TICKETS_LIST: (context) => {
        axios.get('/api/ticket/list').then(response => {
            context.commit('SET_TICKETS_LIST', response.data)
        });
    },
    SEND_CONTENT_TICKET: (context, form) => {
        axios.post('/api/ticket/store', {
            title:form.title,
            content: store.state.content,
            answers:form.answers
        }).then( response => {
            console.log(response.data);
                if (response.data === 'Created') {
                    window.location.replace('/ticket/list');
                }
            }).catch((error) => {
            //
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
