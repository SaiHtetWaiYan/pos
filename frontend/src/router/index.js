import {createRouter, createWebHistory} from "vue-router";
import {useAuthStore} from "@/store/AuthStore.js";
import Layout from "@/components/Dashboard/Layout.vue"
const routes= [
    {
        path: '/',
        name: 'login',
        meta: { requiresGuest: true },
        component: () => import('@/views/Auth/Login.vue'),
    },
    {
        path: '/register',
        name: 'register',
        meta: { requiresGuest: true },
        component: () => import('@/views/Auth/Register.vue'),
    },
    {
        path: '/app',
        name: 'app',
        component: Layout,
        meta: { requiresAuth: true },
        children: [
            {
                path: 'dashboard',
                name: 'app.dashboard',
                component: () => import('@/views/Dashboard/Index.vue'),
            },
            {
                path: 'profile',
                name: 'app.profile',
                component: () => import('@/views/Dashboard/Profile.vue'),
            },
            {
                path: 'brand',
                name: 'app.brand',
                component: () => import('@/views/Dashboard/Brand/Index.vue'),
            },
            {
                path: 'category',
                name: 'app.category',
                component: () => import('@/views/Dashboard/Category/Index.vue'),
            },
            {
                path: 'supplier',
                name: 'app.supplier',
                component: () => import('@/views/Dashboard/Supplier/Index.vue'),
            },
            {
                path: 'product',
                name: 'app.product',
                component: () => import('@/views/Dashboard/Product/Index.vue'),
            },
            {
                path: 'order',
                name: 'app.order',
                component: () => import('@/views/Dashboard/Order/Index.vue'),
            },
            {
                path: 'summary',
                name: 'app.summary',
                component: () => import('@/views/Dashboard/Order/Summary.vue'),
            },


        ]

    },


]
const router = createRouter({
    history: createWebHistory(),
    routes,
})

router.beforeEach((to, from, next) => {
    const authStore = useAuthStore();
    const requiresAuth = to.matched.some((record) => record.meta.requiresAuth);
    const requiresGuest = to.matched.some((record) => record.meta.requiresGuest);

    if (requiresAuth && !authStore.token) {
        // If the user is not authenticated and the route requires authentication, redirect to the login page
        next('/');
    } else if (requiresGuest && authStore.token) {
        // If the user is authenticated and the route requires guest access, redirect to the home page
        next('/app/dashboard');
    } else {
        // Otherwise, allow the user to proceed to the requested page
        next();
    }
});

export default router;