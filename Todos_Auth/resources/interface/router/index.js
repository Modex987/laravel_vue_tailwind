import { createRouter, createWebHistory } from 'vue-router'

import Home from '../views/Home.vue'
import Login from '../views/Login.vue'
import Register from '../views/Register.vue'

const routes = [
    {
        name: 'Home',
        component: Home,
        path: '/'
    },

    {
        name: 'Login',
        component: Login,
        path: '/login'
    },

    {
        name: 'Register',
        component: Register,
        path: '/register'
    }
]


const router = createRouter({
    history: createWebHistory(),
    routes
  })


export default router