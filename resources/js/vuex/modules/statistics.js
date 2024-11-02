import axios from "axios";

const state =  {
    users_count: 0,
    tickets_count: 0
};

const getters = {

    /**
     * Получение кол-ва юзеров
     *
     * @param state
     * @returns {null}
     * @constructor
     */
    GET_USERS_COUNT: (state) => {
        return state.users_count;
    },

    /**
     * Получение кол-ва билетов
     *
     * @param state
     * @returns {number}
     * @constructor
     */
    GET_TICKETS_COUNT: (state) => {
        return state.tickets_count;
    },
};

const mutations = {

    /**
     * Запись кол-ва юзеров
     *
     * @param state
     * @param payload
     * @constructor
     */
    SET_USERS_COUNT: (state, payload) => {
        state.users_count = payload;
    },

    /**
     * Запись кол-ва билетов
     *
     * @param state
     * @param payload
     * @constructor
     */
    SET_TICKETS_COUNT: (state, payload) => {
        state.tickets_count = payload;
    },
};

const actions = {

    /**
     * Суммарное кол-во юзеров
     *
     * @param context
     * @constructor
     */
    USERS_COUNT: (context) => {
        axios.get('/api/statistics/user-count').then( response => {
            context.commit('SET_USERS_COUNT', response.data);
        });
    },

    /**
     * Суммарное кол-во билетов
     *
     * @param context
     * @constructor
     */
    TICKETS_COUNT: (context) => {
        axios.get('/api/statistics/ticket-count').then( response => {
            context.commit('SET_TICKETS_COUNT', response.data);
        });
    }
};

export default {
    namespaced: true,
    state,
    mutations,
    getters,
    actions
}
