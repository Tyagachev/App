import axios from "axios";
import store from "../store.js";
const state = {
    ticket: {},
    tickets: [],
    errors: {}
}

const getters = {

    /**
     * Получение списка билетов
     *
     * @param state
     * @returns {[]}
     * @constructor
     */
    GET_TICKETS_LIST: (state) => {
        return state.tickets;
    },
    /**
     * Получение билета
     *
     * @param state
     * @returns {{}}
     * @constructor
     */
    GET_TICKET_INFO: (state) => {
        return state.ticket;
    }
}

const mutations = {

    /**
     * Запись всех билетов
     *
     * @param state
     * @param payload
     * @constructor
     */
    SET_TICKETS_LIST: (state, payload) => {
        state.tickets = payload;
    },

    /**
     * Запись информации о билете
     *
     * @param state
     * @param payload
     * @constructor
     */
    SET_TICKET_INFO: (state, payload) => {
        state.ticket = payload;
        store.state.content = payload.content
    }
}

const actions = {

    /**
     * Получение списка билетов
     *
     * @param context
     * @constructor
     */
    TICKETS_LIST: (context) => {
        axios.get('/api/ticket/list').then(response => {
            context.commit('SET_TICKETS_LIST', response.data);
        });
    },

    /**
     * Получение информации о билете
     *
     * @param context
     * @param id
     * @constructor
     */
    TICKET_INFO_BY_ID: (context, id) => {
        axios.get('/api/ticket/edit/' + id).then(response => {
            context.commit('SET_TICKET_INFO', response.data)
        });
    },

    /**
     * Отправка данных билета на сервер
     *
     * @param context
     * @param form
     * @constructor
     */
    SEND_CONTENT_TICKET: (context, form) => {
        let ans = [];
        Object.entries(form.answers).forEach(([key, el]) => {
            if (el.answer === '') {
                form.answers.splice(Number(key), 1)
            } else if (el.answer !== '') {
                ans.push(el);
            }
        });
        axios.post('/api/ticket/store', {
            title: form.title,
            content: store.state.content,
            answers: ans
        }).then( response => {
            if (response.status === 201) {
                    window.location.replace('/ticket/list');
                }
        }).catch(err => {
            console.log(err.response);
        })
    },
    /**
     * Обновление контента билета
     *
     * @param context
     * @param form
     * @constructor
     */
    SEND_UPDATE_CONTENT_TICKET: (context, form) => {
        axios.post('/api/ticket/update', {
            id: form.id,
            title: form.title,
            content: store.state.content,
            answers: form.answers
        }).then( response => {
            if (response.status === 200) {
                window.location.replace('/ticket/list');
            }
        })
    },
}

export default {
    namespaced: true,
    state,
    getters,
    mutations,
    actions
}
