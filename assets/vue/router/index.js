import { createRouter, createWebHistory } from 'vue-router'
import Home from '../views/Home.vue'
import Play from '../views/Play.vue'
import Login from "../views/Login.vue";
import Register from "../views/Register.vue";

const routes = [
    {
        path: '/',
        name: 'home',
        component: Home,
        meta: {
            title: 'Strona główna'
        }
    },
    {
        path: '/play',
        name: 'play',
        component: Play,
        meta: {
            title: 'Graj w przygodę'
        }
    },
    {
        path: '/login',
        name: 'login',
        component: Login,
        meta: {
            title: 'Zaloguj się'
        }
    },
    {
        path: '/register',
        name: 'register',
        component: Register,
        meta: {
            title: 'Załóż konto'
        }
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes,
}).beforeEach((to, from, next) => {
    const isAuthenticated = !!localStorage.getItem('token')

    if (to.name === 'play' && !isAuthenticated) {
        return next({ name: 'login' })
    }

    document.title = to.meta.title || 'D&D App'
    next()
})



export default router
