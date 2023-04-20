import {createRouter, createWebHistory} from "vue-router";

const routes= [
    {
        path: '/',
        name: 'login',
        component: () => import('@/views/Auth/Login.vue'),
    },
    {
        path: '/register',
        name: 'register',
        component: () => import('@/views/Auth/Register.vue'),
    },
    {
        path: '/dashboard',
        name: 'dashboard',
        component: () => import('@/views/Dashboard/Index.vue'),
    },

]
const router = createRouter({
    history: createWebHistory(),
    routes,
})

export default router;