import { createRouter, createWebHistory } from 'vue-router';
import auth from "./middleware/auth.js";
import admin from "./middleware/admin.js";
import logged from "./middleware/logged.js";
import middlewarePipeline from './middlewarePipeline.js';
import store from "../vuex/store.js";

const routes = [
    {
        path: '/',
        redirect: '/admin',
    },
    {
        path: '/log',
        name: 'login.page',
        component: () => import('../components/pages/Auth/LoginComponent.vue'),
        meta: {
            middleware: [
                logged
            ]
        }
    },
    {
        path: '/reg',
        name: 'register.page',
        component: () => import('../components/pages/Auth/RegisterComponent.vue'),
        meta: {
            middleware: [
                logged
            ]
        }
    },
    {
        path: '/forgot-password',
        name: 'forgot.page',
        component: () => import('../components/pages/Auth/ForgotPasswordComponent.vue'),
    },
    {
        path: '/verify',
        name: 'verify.page',
        component: () => import('../components/pages/Auth/VerifyComponent.vue')
    },
    {
      path: '/admin',
      name: 'admin.page',
      component: () => import('../components/pages/Home/AdminPanel.vue'),
        meta: {
            middleware: [
                auth,
            ]
        },
        children:[{
            path: '/ticket/list',
            name: 'ticket.list.page',
            components: {
                page: () => import('../components/pages/Ticket/TicketListComponent.vue'),
            },
            meta: {
                middleware: [
                    admin
                ]
            }
        },{
            path: '/ticket/create',
            name: 'ticket.create.page',
            components: {
                page: () => import('../components/pages/Ticket/TicketCreateComponent.vue')
            },
            meta: {
                middleware: [
                    admin
                ]
            }
        },{
            path: '/hint',
            name: 'hint.create.page',
            components: {
                page: () => import('../components/pages/Ticket/Hint/HintCreateComponent.vue')
            },
            meta: {
                middleware: [
                    admin
                ]
            }
        },{
            path: '/ticket/edit/:id?',
            name: 'ticket.edit.page',
            components: {
                page: () => import('../components/pages/Ticket/TicketUpdateComponent.vue')
            },
            meta: {
                middleware: [
                    admin
                ]
            }
        },{
            path: '/home',
            name: 'home.page',
            components: {
                page: () => import('../components/pages/Home/Home.vue')
            },
            meta: {
                middleware: [
                    admin
                ]
            }
        },{
            path: '/user/create',
            name: 'user.create.page',
            components: {
                page: () => import('../components/pages/User/UserCreateComponent.vue')
            },
            meta: {
                middleware: [
                    admin
                ]
            }
        },{
            path: '/user/list',
            name: 'user.list.page',
            components: {
                page: () => import('../components/pages/User/UserListComponent.vue')
            },
            meta: {
                middleware: [
                    admin
                ]
            }
        },{
            path: '/user/show/:id?',
            name: 'user',
            components: {
                page: () => import('../components/pages/User/UserProfileComponent.vue')
            },
            meta: {
                middleware: [
                    admin
                ]
            }
        },{
            path: '/task/:id?',
            name: 'task.page',
            components: {
                page: () => import('../components/pages/Task/TaskComponent.vue')
            }
        },{
            path: '/statistics',
            name: 'statistics.page',
            components: {
                page: () => import('../components/pages/Statistics/StatisticsComponent.vue')
            },
            meta: {
                middleware: [
                    admin
                ]
            }
        },{
            path: '/feedback',
            name: 'feed.page',
            components: {
                page: () => import('../components/pages/Feedback/FeedbackComponent.vue')
            },
            meta: {
                middleware: [
                    admin
                ]
            }
        }],
    },
]

const router = createRouter({

  history: createWebHistory(),
  routes
});
router.beforeEach((to, from, next) => {

    if (!to.meta.middleware) {
        return next()
    }

    const middleware = to.meta.middleware

    const context = {
        to,
        from,
        next,
        store
    }

    return middleware[0]({
        ...context,
        nextMiddleware: middlewarePipeline(context, middleware, 1)
    })

})
export default router

