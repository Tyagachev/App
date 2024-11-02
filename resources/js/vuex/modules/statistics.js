import axios from "axios";

const state =  {
    users: 0
};

const getters = {

    /**
     * Получение кол-ва юзеров
     *
     * @param state
     * @returns {null}
     * @constructor
     */
    GET_USERS_COUNT: state => {
        return state.users;
    }
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
        state.users = payload;
    }
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
    }
};

export default {
    namespaced: true,
    state,
    mutations,
    getters,
    actions
}
