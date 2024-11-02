import axios from "axios";

const state = {
    //
}

const getters = {
    //
}

const mutations = {
    //
}

const actions = {

    /**
     * Проверка аунтифицирован
     * пользователь или нет
     *
     * @constructor
     */
    AUTH_CHECK: () => {
        axios.get('/api/check/auth/checked').then(response => {
            if (response.data.check && response.data.status === 200) {
                window.location.replace('/admin')
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
