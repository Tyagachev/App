import router from "@/router/index.js";
export default function admin ({ next, store, nextMiddleware }){
    if(store.state.role !== 1){
        return next(router.push('/'))
    }
    return nextMiddleware()
}
