export default function admin ({ next, store, nextMiddleware }){
    if(store.state.role !== 1){
        return next({
            path: '/task'
        })
    }
    return nextMiddleware()
}
