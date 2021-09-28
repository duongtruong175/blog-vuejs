import Vue from 'vue'
import VueRouter from 'vue-router'

// user page
import AppLayout from '../layouts/AppLayout.vue'
import Home from '../views/frontend/home/Home.vue'
import About from '../views/frontend/home/About.vue'
import ArticlesIndex from '../views/frontend/article/ArticlesIndex.vue'
import ArticlesShow from '../views/frontend/article/ArticlesShow.vue'

// admin page
import BackendHome from '../views/backend/home/BackendHome.vue'
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
                component: Home,
                meta: {
                    title: 'Home'
                }
            },
            {
                path: 'about',
                name: 'About',
                component: About,
                meta: {
                    title: 'About Us'
                }
            },
            {
                path: 'articles',
                name: 'ArticlesIndex',
                component: ArticlesIndex,
                meta: {
                    title: 'Article list'
                }
            },
            {
                path: 'articles/:id',
                name: 'ArticlesShow',
                component: ArticlesShow,
                meta: {
                    title: 'Article detail'
                }
            },
        ]
    },
    {
        path: '/admin',
        component: BackendAppLayout,
        children: [
            {
                path: '',
                name: 'BackendHome',
                component: BackendHome,
                meta: {
                    title: 'Home'
                }
            },
            {
                path: 'dashboard',
                name: 'BackendDashboard',
                component: BackendDashboard,
                meta: {
                    title: 'Dashboard'
                }
            },
            {
                path: 'articles',
                name: 'BackendArticlesIndex',
                component: BackendArticlesIndex,
                meta: {
                    title: 'Article list'
                }
            },
            {
                path: 'articles/create',
                name: 'BackendArticlesCreate',
                component: BackendArticlesCreate,
                meta: {
                    title: 'Add article'
                }
            },
            {
                path: 'articles/:id/edit',
                name: 'BackendArticlesEdit',
                component: BackendArticlesEdit,
                meta: {
                    title: 'Edit article'
                }
            },
            {
                path: 'categories',
                name: 'BackendCategoriesIndex',
                component: BackendCategoriesIndex,
                meta: {
                    title: 'Category list'
                }
            },
            {
                path: 'categories/create',
                name: 'BackendCategoriesCreate',
                component: BackendCategoriesCreate,
                meta: {
                    title: 'Add category'
                }
            },
            {
                path: 'categories/:id/edit',
                name: 'BackendCategoriesEdit',
                component: BackendCategoriesEdit,
                meta: {
                    title: 'Edit category'
                }
            },
            {
                path: 'comments',
                name: 'BackendCommentsIndex',
                component: BackendCommentsIndex,
                meta: {
                    title: 'Comment list'
                }
            },
            {
                path: 'roles',
                name: 'BackendRolesIndex',
                component: BackendRolesIndex,
                meta: {
                    title: 'Role list'
                }
            },
            {
                path: 'roles/create',
                name: 'BackendRolesCreate',
                component: BackendRolesCreate,
                meta: {
                    title: 'Add role'
                }
            },
            {
                path: 'roles/:id/edit',
                name: 'BackendRolesEdit',
                component: BackendRolesEdit,
                meta: {
                    title: 'Edit role'
                }
            },
            {
                path: 'tags',
                name: 'BackendTagsIndex',
                component: BackendTagsIndex,
                meta: {
                    title: 'Tag list'
                }
            },
            {
                path: 'tags/create',
                name: 'BackendTagsCreate',
                component: BackendTagsCreate,
                meta: {
                    title: 'Add tag'
                }
            },
            {
                path: 'tags/:id/edit',
                name: 'BackendTagsEdit',
                component: BackendTagsEdit,
                meta: {
                    title: 'Edit tag'
                }
            },
            {
                path: 'users',
                name: 'BackendUsersIndex',
                component: BackendUsersIndex,
                meta: {
                    title: 'User list'
                }
            },
            {
                path: 'users/create',
                name: 'BackendUsersCreate',
                component: BackendUsersCreate,
                meta: {
                    title: 'Add user'
                }
            },
            {
                path: 'users/:id/edit',
                name: 'BackendUsersEdit',
                component: BackendUsersEdit,
                meta: {
                    title: 'Edit user'
                }
            },
        ],
    }
];

const router = new VueRouter({
    mode: "history",
    routes
});

export default router;
