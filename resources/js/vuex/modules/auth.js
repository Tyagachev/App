import axios from "axios";

const state = {
    user: {},
}

const getters = {

    /**
     * Получение данных авторизированного
     * пользователя
     *
     * @param state
     * @returns {{}}
     * @constructor
     */
    GET_AUTH_USER: (state) => {
        return state.user
    }
}

const mutations = {
    /**
     * Запись информации об
     * аунтифицированном пользователе
     *
     * @param state
     * @param payload
     * @constructor
     */
    SET_AUTH_USER: (state, payload) => {
        state.user = payload;
    },
}

const actions = {

    /**
     * Запрос в базу для плучения авторизированнаго
     * пользователя
     *
     * @param context
     * @constructor
     */
    AUTH_USER: (context) => {
        axios.get('/api/check/auth/user').then(response => {
            context.commit('SET_AUTH_USER', response.data);
        }).catch(error => {
            if (error) {
                localStorage.clear();
                sessionStorage.clear();
                window.location.replace('/log')
            }
        });
    },
    /**
     * Проверка аунтифицирован
     * пользователь или нет
     *
     * @constructor
     */
    AUTH_CHECK: () => {
        axios.get('/api/check/auth/checked').then(response => {
            if (response.data.check !== 'no-check') {
                if (response.data.check && response.data.status === 200) {
                    window.location.replace('/admin')
                }
            }
        })
    },

    /**
     * Выход из системы
     *
     * @returns {Promise<void>}
     * @constructor
     */
    LOGOUT: async () => {
         await axios.post('/logout');
        localStorage.clear();
        sessionStorage.clear();
        window.location.replace('/log')
    }
}

export default {
    namespaced: true,
    state,
    getters,
    mutations,
    actions
}
