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
