export default function logged ({ next, store, nextMiddleware }){
    const token = localStorage.getItem('x-xsrf-token')
    if(store.getters.LOGGED.loggedIn && token){
        return next({
            path: '/admin'
        })
    }
    return nextMiddleware()
}
