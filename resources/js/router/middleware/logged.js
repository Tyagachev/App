export default function logged ({ next, store, nextMiddleware }){
    console.log(store.getters.LOGGED);
    if(store.getters.LOGGED.loggedIn){
        return next({
            path: '/admin'
        })
    }
    return nextMiddleware()
}
