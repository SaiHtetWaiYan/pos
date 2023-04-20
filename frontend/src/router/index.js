import {createRouter, createWebHistory} from "vue-router";
import Layout from "@/components/Dashboard/Layout.vue"
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
        path: '/app',
        name: 'app',
        component: Layout,
        //meta: { requiresAuth: true },
        children: [
            {
                path: 'dashboard',
                name: 'app.dashboard',
                component: () => import('@/views/Dashboard/Index.vue'),
            },

        ]

    },


]
const router = createRouter({
    history: createWebHistory(),
    routes,
})

export default router;