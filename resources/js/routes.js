import {createRouter, createWebHistory} from "vue-router";
import Home from "./Pages/Index.vue";
import NotFound404 from "./Pages/Errors/404.vue";

const routes = [
    {
        path: '/',
        name: 'home',
        component: Home
    },
    {
        path: '/:pathMatch(.*)*',
        name: '404',
        component: NotFound404
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
