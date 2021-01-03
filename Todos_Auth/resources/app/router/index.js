import { createRouter, createWebHistory } from 'vue-router'

import Todos from '../views/Todos.vue'
import Profile from '../views/Profile.vue'
import NotFound from '../views/NotFound.vue'

const routes = [
    {
        name: 'Todos',
        component: Todos,
        path: '/'
    },

    {
        name: 'Profile',
        component: Profile,
        path: '/profile'
    },

    {
        name: 'NotFound',
        component: NotFound,
        path: '/404'
    },

    {
        path: '/.*',
        redirect: '/404'
    }
]


const router = createRouter({
    history: createWebHistory(),
    routes
})


export default router