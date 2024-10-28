import axios from "axios";

const state =  {
    verified: null,
    uid: null,
    error: ''
}

const getters = {
    /**
     *
     * @param state
     * @returns {string}
     * @constructor
     */
    GET_ERROR: state => {
        return state.error;
    }
}

const mutations = {
    /**
     *
     * @param state
     * @param payload
     * @constructor
     */
    SET_USER_VERIFY: (state, payload) => {
        state.verified = payload;
    },

    /**
     *
     * @param state
     * @param payload
     * @constructor
     */
    SET_USER_ID: (state, payload) => {
        state.uid = payload;
    },

    /**
     *
     * @param state
     * @param payload
     * @constructor
     */
    SET_ERROR: (state, payload) => {
        state.error = payload;
    }
}

const actions = {

    /**
     * Запрос авторизированного пользователя
     * с определением вводил код или нет
     *
     * @param context
     * @param user
     * @returns {Promise<void>}
     * @constructor
     */
    GET_AUTH_USER_VERIFY: async (context, user) => {
        axios.get('/api/user-auth').then(response => {
            context.commit('SET_USER_VERIFY', response.data.verified);
            context.commit('SET_USER_ID', response.data.id);
        });
    },

    /**
     * Отправка кода подтвержения
     *
     * @param context
     * @param code
     * @returns {Promise<void>}
     * @constructor
     */
    SEND_VERIFY_CODE: async (context, code) => {
        let {data} = await axios.post('/api/confirm-verify', { number: code });
        console.log(data)
        if (Number(state.uid) === data.userId && data.verified) {
            window.location.replace('/admin');
        } else {
            context.commit('SET_ERROR', 'Введен неправильный код');
        }

    }
}

export default {
    namespaced: true,
    state,
    mutations,
    getters,
    actions
}
