import { createStore } from 'vuex'

const store = createStore({
    state: {
        token: localStorage.getItem('x_xsrf_token' || ''),
        uid: localStorage.getItem('uid'),
        user: {
            id: localStorage.getItem('uid'),
            name: ''
        }
    },
    getters: {

    },
    modules: {

    },
    mutations: {

    },
    actions: {

    }
})

export default store
