import Vue from 'vue'
import VueRouter from 'vue-router'

// user page
import AppLayout from '../layouts/AppLayout.vue'
import Home from '../views/frontend/home/Home.vue'
import Login from '../views/frontend/auth/Login.vue'
import Register from '../views/frontend/auth/Register.vue'
import About from '../views/frontend/home/About.vue'
import ArticlesIndex from '../views/frontend/article/ArticlesIndex.vue'
import ArticlesShow from '../views/frontend/article/ArticlesShow.vue'
import ForgotPassword from '../views/frontend/auth/ForgotPassword.vue'
import ConfirmPassword from '../views/frontend/auth/ConfirmPassword.vue'
import VerifyEmail from '../views/frontend/auth/VerifyEmail.vue'
import ResetPassword from '../views/frontend/auth/ResetPassword.vue'

// admin page
import BackendHome from '../views/backend/home/BackendHome.vue'
import BackendLogin from '../views/backend/auth/BackendLogin.vue'
import BackendAppLayout from '../layouts/BackendAppLayout.vue'
import BackendDashboard from '../views/backend/dashboard/BackendDashboard.vue'
import BackendArticlesIndex from '../views/backend/article/BackendArticlesIndex.vue'
import BackendArticlesCreate from '../views/backend/article/BackendArticlesCreate.vue'
import BackendArticlesEdit from '../views/backend/article/BackendArticlesEdit.vue'
import BackendCategoriesIndex from '../views/backend/category/BackendCategoriesIndex.vue'
import BackendCategoriesCreate from '../views/backend/category/BackendCategoriesCreate.vue'
import BackendCategoriesEdit from '../views/backend/category/BackendCategoriesEdit.vue'
import BackendCommentsIndex from '../views/backend/comment/BackendCommentsIndex.vue'
import BackendRolesIndex from '../views/backend/role/BackendRolesIndex.vue'
import BackendRolesCreate from '../views/backend/role/BackendRolesCreate.vue'
import BackendRolesEdit from '../views/backend/role/BackendRolesEdit.vue'
import BackendTagsIndex from '../views/backend/tag/BackendTagsIndex.vue'
import BackendTagsCreate from '../views/backend/tag/BackendTagsCreate.vue'
import BackendTagsEdit from '../views/backend/tag/BackendTagsEdit.vue'
import BackendUsersIndex from '../views/backend/user/BackendUsersIndex.vue'
import BackendUsersCreate from '../views/backend/user/BackendUsersCreate.vue'
import BackendUsersEdit from '../views/backend/user/BackendUsersEdit.vue'

Vue.use(VueRouter)

const routes = [
    {
        path: '/',
        component: AppLayout,
        children: [
            {
                path: '',
                name: 'Home',
                component: Home
            },
            {
                path: 'login',
                name: 'Login',
                component: Login
            },
            {
                path: 'register',
                name: 'Register',
                component: Register
            },
            {
                path: 'about',
                name: 'About',
                component: About
            },
            {
                path: 'articles',
                name: 'ArticlesIndex',
                component: ArticlesIndex
            },
            {
                path: 'articles/:id',
                name: 'ArticlesShow',
                component: ArticlesShow
            },
            {
                path: 'forgot-password',
                name: 'ForgotPassword',
                component: ForgotPassword
            },
            {
                path: 'confirm-password',
                name: 'ConfirmPassword',
                component: ConfirmPassword
            },
            {
                path: 'verify-email',
                name: 'VerifyEmail',
                component: VerifyEmail
            },
            {
                path: 'reset-password',
                name: 'ResetPassword',
                component: ResetPassword,
                props: route => ({ query: route.query.token })
            },
        ]
    },
    {
        path: '/admin/login',
        name: 'BackendLogin',
        component: BackendLogin
    },
    {
        path: '/admin',
        component: BackendAppLayout,
        children: [
            {
                path: '',
                name: 'BackendHome',
                component: BackendHome
            },
            {
                path: 'dashboard',
                name: 'BackendDashboard',
                component: BackendDashboard
            },
            {
                path: 'articles',
                name: 'BackendArticlesIndex',
                component: BackendArticlesIndex
            },
            {
                path: 'articles/create',
                name: 'BackendArticlesCreate',
                component: BackendArticlesCreate
            },
            {
                path: 'articles/:id/edit',
                name: 'BackendArticlesEdit',
                component: BackendArticlesEdit
            },
            {
                path: 'categories',
                name: 'BackendCategoriesIndex',
                component: BackendCategoriesIndex
            },
            {
                path: 'categories/create',
                name: 'BackendCategoriesCreate',
                component: BackendCategoriesCreate
            },
            {
                path: 'categories/:id/edit',
                name: 'BackendCategoriesEdit',
                component: BackendCategoriesEdit
            },
            {
                path: 'comments',
                name: 'BackendCommentsIndex',
                component: BackendCommentsIndex
            },
            {
                path: 'roles',
                name: 'BackendRolesIndex',
                component: BackendRolesIndex
            },
            {
                path: 'roles/create',
                name: 'BackendRolesCreate',
                component: BackendRolesCreate
            },
            {
                path: 'roles/:id/edit',
                name: 'BackendRolesEdit',
                component: BackendRolesEdit
            },
            {
                path: 'tags',
                name: 'BackendTagsIndex',
                component: BackendTagsIndex
            },
            {
                path: 'tags/create',
                name: 'BackendTagsCreate',
                component: BackendTagsCreate
            },
            {
                path: 'tags/:id/edit',
                name: 'BackendTagsEdit',
                component: BackendTagsEdit
            },
            {
                path: 'users',
                name: 'BackendUsersIndex',
                component: BackendUsersIndex
            },
            {
                path: 'users/create',
                name: 'BackendUsersCreate',
                component: BackendUsersCreate
            },
            {
                path: 'users/:id/edit',
                name: 'BackendUsersEdit',
                component: BackendUsersEdit
            },
        ],
        meta: {
            requiresAdminAuth: true
        }
    }
];

const router = new VueRouter({
    mode: "history",
    routes
});

router.beforeEach((to, from, next) => {
    const user = this.$store.state.user;
    if (to.matched.some(record => record.meta.requiresAdminAuth) && lodash.isEmpty(user)) {
        next({ name: 'BackendLogin' });
    } else if (!lodash.isEmpty(user)) {
        user.roles.forEach(role => {
            if (role.name == 'admin') {
                next({ name: 'BackendHome' });
            }
        });
    } else {
        next();
    }
})

export default router;
