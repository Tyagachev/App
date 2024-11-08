export default function auth ({ next, store, nextMiddleware }){
    console.log(store.getters.LOGGED);
    if(!store.getters.LOGGED.loggedIn){
        return next({
            path: '/log'
        })
    }
    return nextMiddleware()
}
