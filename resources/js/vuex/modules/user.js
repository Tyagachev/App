import axios from "axios";

const state =  {
    userInfo: {},
    users: [],
};

const getters = {

    /**
     *
     * @param state
     * @returns {{}}
     * @constructor
     */
    GET_USER_INFO: (state) => {
        return state.userInfo
    },

    /**
     *
     * @param state
     * @returns {[]}
     * @constructor
     */
    GET_USERS_LIST: (state) => {
        return state.users
    }
};

const mutations = {



    /**
     * Запись информации о юзере
     *
     * @param state
     * @param payload
     * @constructor
     */
    SET_USER_INFO: (state, payload) => {
        state.userInfo = payload;
    },

    /**
     * Запись списка пользователей
     *
     * @param state
     * @param payload
     * @constructor
     */
    SET_USERS_LIST: (state, payload) => {
        state.users = payload;
    }
}

const actions = {

    /**
     * Получение списка пользователей
     *
     * @param context
     * @constructor
     */
    USERS_LIST: (context) => {
        axios.get('/api/user/list').then(response => {
            context.commit('SET_USERS_LIST', response.data);
        });
    },

    /**
     * Получение информации о пользователе по ID
     *
     * @param context
     * @param id
     * @constructor
     */
    USER_INFO_BY_ID: (context, id) => {
        axios.get('/api/user/show/' + id ).then(response => {
            context.commit('SET_USER_INFO', response.data)
        })
    },
}
export default {
    namespaced: true,
    state,
    mutations,
    getters,
    actions
}

