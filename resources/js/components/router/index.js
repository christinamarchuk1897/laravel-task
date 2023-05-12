import { createWebHistory, createRouter } from 'vue-router'
import store from '../store/index';

const Login = () => import('../../components/pages/auth/Login.vue');
const Register = () => import('../../components/pages/auth/Register.vue');
const DahboardLayout = () => import('../../components/layouts/Default.vue');
const ForgotPassword = () => import('../../components/pages/auth/ForgotPassword.vue');
const ResetPassword = () => import('../../components/pages/auth/ResetPassword.vue');
const VerifyEmail = () => import('../../components/pages/auth/VerifyEmail.vue');
const Dashboard = () => import('../../components/Dashboard.vue');
const routes = [
    {
        name: "login",
        path: "/login",
        component: Login,
        meta: {
            middleware: "guest",
            title: `Login`
        }
    },
    {
        name: "forgot-password",
        path: "/forgot-password",
        component: ForgotPassword,
        meta: {
            middleware: "guest",
            title: `ForgotPassword`
        }
    },
    {
        name: "reset-password",
        path: "/reset-password",
        component: ResetPassword,
        meta: {
            middleware: "guest",
            title: `ResetPassword`
        }
    },
    {
        name: "register",
        path: "/register",
        component: Register,
        meta: {
            middleware: "guest",
            title: `Register`
        }
    },
    {
        name: "email-verify",
        path: "/email/verify/:id",
        component: VerifyEmail,
        meta: {
            middleware: "guest",
            title: `Email-Verify`
        }
    },
    {
        path: "/",
        component: DahboardLayout,
        meta: {
            middleware: "auth"
        },
        children: [
            {
                name: "dashboard",
                path: '/dashboard',
                component: Dashboard,
                meta: {
                    title: `Dashboard`
                }
            }
        ]
    }
]
const router = createRouter({
    history: createWebHistory(),
    routes,
})
router.beforeEach((to, from, next) => {
    document.title = to.meta.title
    if (to.path == '/') {
        next({ name: "login" })
    }

    if (to.meta.middleware == "guest") {
        if (store.state.auth.authenticated) {
            next({ name: "dashboard" })
        }
        next()
    } else {
        if (store.state.auth.authenticated) {
            next()
        } else {
            next({ name: "login" })
        }
    }
})
export default router