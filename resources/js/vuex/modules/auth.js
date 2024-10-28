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
     * @param context
     * @param userData
     * @constructor
     */
    LOGIN: (context, userData) => {
        axios.post('/api/login', userData).then(response => {
            console.log(response);
            if (response.data.status === 200) {
                localStorage.setItem('x_xsrf_token', response.config.headers['X-CSRF-TOKEN']);
                if (response.data.user.verified === 0) {
                    window.location.replace('/verify')
                } else {
                    window.location.replace('/admin')
                }
            }
        }).catch(error => {
            console.log(error.response.data);
        });
    },

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
