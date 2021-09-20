import Vue from 'vue'
import VueRouter from 'vue-router'

// user page
import Home from '../views/frontend/home/Home.vue'
import About from '../views/frontend/home/About.vue'
import ArticlesIndex from '../views/frontend/article/ArticlesIndex.vue'
import ArticlesShow from '../views/frontend/article/ArticlesShow.vue'

// admin page
import BackendLogin from '../views/backend/auth/BackendLogin.vue'

Vue.use(VueRouter)

const routes = [
    {
        path: '/',
        name: 'Home',
        component: Home
    },
    {
        path: '/about',
        name: 'About',
        component: About
    },
    {
        path: '/articles',
        name: 'ArticlesIndex',
        component: ArticlesIndex
    },
    {
        path: '/articles/:articleId',
        name: 'ArticlesShow',
        component: ArticlesShow
    },
    {
        path: '/admin/login',
        name: 'BackendLogin',
        component: BackendLogin
    }
];

const router = new VueRouter({
    mode: "history",
    routes
});

export default router;
