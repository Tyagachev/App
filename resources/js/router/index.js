import { createRouter, createWebHistory } from 'vue-router'
import store from "../vuex/store.js";

const routes = [
    {
        path: '/',
        redirect: '/log',
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
        component: () => import('../components/pages/Auth/VerifyComponent.vue'),
    },
    {
      path: '/admin',
      name: 'admin.page',
      component: () => import('../components/pages/Home/AdminPanel.vue'),
        children:[{
            path: '/statistics',
            name: 'statistics.page',
            components: {
                page: () => import('../components/pages/Statistics/StatisticsComponent.vue')
            }
        },{
            path: '/home',
            name: 'home.page',
            components: {
                page: () => import('../components/pages/Home/Home.vue')
            }
        },{
            path: '/create/user',
            name: 'create.user.page',
            components: {
                page: () => import('../components/pages/User/CreateUserComponent.vue')
            }
        },{
            path: '/user-list',
            name: 'user-list.page',
            components: {
                page: () => import('../components/pages/User/UserListComponent.vue')
            }
        },{
            path: '/user/:id',
            name: 'user',
            components: {
                page: () => import('../components/pages/User/UserProfileComponent.vue')
            }
        }],
        beforeEnter:(to, from, next) => {
            const token = localStorage.getItem('x_xsrf_token');
            const verifiedStore = store.state.userModule.verified;

            if (token && verifiedStore !== 0 ) {
                next()
            } else if (token && verifiedStore === 0) {
                next({name:'verify.page'})
            } else {
                next({name:'login.page'})
            }
        },
    },
]

const router = createRouter({
  history: createWebHistory(),
  routes
});

/*router.beforeEach((to, from, next) => {
    const token = localStorage.getItem('x_xsrf_token');
    const verified = localStorage.getItem('v');
    if (!token) {
        if (to.name === 'login.page' || to.name === 'register.page') {
            return next()
        }
    }

})*/
/*router.beforeEach((to, from, next) => {
    const token = localStorage.getItem('x_xsrf_token');
    const verified = localStorage.getItem('v');

    if (!token) {
        if (to.name === 'login.page' || to.name === 'register.page') {
            return next()
        } else {
            return next({
                name: 'login.page'
            })
        }
    }

    if (to.name === 'login.page' || to.name === 'register.page' && token) {
        return next({
            name: 'home.page'
        })
    }

    /*if (token && verified !== true ) {
        if (to.name === 'home.page') {
            return next({name: 'verify.page'})
        }
        return next()
    }
    //return next()
    if (token && verified === true) {
        if (to.name === 'home.page') {
            return next()
        }
    }*/
    /*if (to.name === 'login.page' || to.name === 'register.page' && token) {
        return next({
            name: 'home.page'
        })
    }
    return next()*/

    /*if (to.name === 'login.page' || to.name === 'register.page' && token) {
        return next({
            name: 'home.page', params: { id: 1 }
        })
    }
    return next()*/

    /*if (from.name === 'login.page' && verified === 0) {
        return next({
            name: 'verify.page'
        })
    }
    next()*/
//})
export default router
