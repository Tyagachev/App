import { createRouter, createWebHistory } from 'vue-router'
import store from "@/vuex/store.js";

const routes = [
    {
        path: '/',
        redirect: '/log'
        //component: () => import('../components/IndexComponent.vue')
    },
    {
        path: '/log',
        name: 'login.page',
        component: () => import('../components/pages/Auth/LoginComponent.vue')
    },
    {
        path: '/reg',
        name: 'register.page',
        component: () => import('../components/pages/Auth/RegisterComponent.vue')
    },
    {
        path: '/verify',
        name: 'verify.page',
        component: () => import('../components/pages/Auth/VerifyComponent.vue')
    },
    {
        path: '/home/:id',
        name: 'home.page',
        component: () => import('../components/pages/Home/Home.vue')
    }
]

const router = createRouter({
  history: createWebHistory(),
  routes
});

router.beforeEach((to, from, next) => {
    const token = localStorage.getItem('x_xsrf_token');
    if (!token) {
        if (to.name === 'login.page' || to.name === 'register.page') {
            return next()
        } else {
            next({
                name: 'login.page'
            })
        }
    }

    if (to.name === 'login.page' || to.name === 'register.page' && token) {
        return next({
            name: 'home.page'
        })
    }
    next()
})
export default router
