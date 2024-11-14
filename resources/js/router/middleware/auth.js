export default function auth ({ next, store, nextMiddleware }){
    if(!store.getters.LOGGED.loggedIn){
        return next({
            path: '/log'
        })
    }
    return nextMiddleware()
}
