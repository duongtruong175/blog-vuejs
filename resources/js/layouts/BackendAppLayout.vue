<template>
    <div>
        <div class="min-h-screen">
            <!-- Responsive Left Navigation-->
            <nav class="lg:hidden py-6 px-6 border-b">
                <div class="flex items-center justify-between">
                    <div class="flex">
                        <router-link class="text-2xl font-semibold" :to="{ name: 'BackendHome' }">
                            <application-logo class="block h-8 w-auto fill-current text-gray-600"></application-logo>
                        </router-link>
                        <span class="ml-2 font-medium text-2xl">{{ $t('Admin Blog') }}</span>
                    </div>
                    <button @click="showingNavigation = ! showingNavigation" class="navbar-burger flex items-center rounded focus:outline-none">
                        <svg class="text-white bg-indigo-500 hover:bg-indigo-600 block h-8 w-8 p-2 rounded" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                            <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"></path>
                        </svg>
                    </button>
                </div>
            </nav>

            <!-- Left Navigation -->
            <div :class="{'hidden': ! showingNavigation}" class="lg:block navbar-menu relative z-50">
                <div @click="showingNavigation = ! showingNavigation" class="navbar-backdrop fixed lg:hidden inset-0 bg-gray-800 opacity-10"></div>
                <nav class="fixed top-0 left-0 bottom-0 flex flex-col w-2/4 lg:w-56 sm:w-56 pt-6 pb-8 bg-white border-r overflow-y-auto">
                    <div class="flex w-full items-center px-6 pb-6 mb-6 lg:border-b">
                        <div class="flex">
                            <router-link class="text-xl font-semibold" :to="{ name: 'BackendHome' }">
                                <application-logo class="block h-8 w-auto fill-current text-gray-600"></application-logo>
                            </router-link>
                            <span class="ml-2 font-medium text-2xl">{{ $t('Admin Blog') }}</span>
                        </div>
                    </div>
                    <div class="px-4 pb-6">
                        <h3 class="mb-2 text-xs uppercase text-gray-500 font-medium">{{ $t('Resource') }}</h3>
                        <ul class="mb-8 text-sm font-medium">
                            <li>
                                <router-link :class="$route.name == 'BackendDashboard'  ? 'text-white bg-indigo-500' : 'text-gray-500 hover:bg-indigo-50'" class="flex items-center pl-3 py-3 pr-4 rounded" :to="{ name: 'BackendDashboard' }">
                                    <span class="inline-block mr-3">
                                        <dashboard-icon class="text-gray-300 w-5 h-5"></dashboard-icon>
                                    </span>
                                    <span>{{ $t('Dashboard') }}</span>
                                </router-link>
                            </li>
                            <li>
                                <router-link :class="/BackendUser*/.test($route.name) ? 'text-white bg-indigo-500' : 'text-gray-500 hover:bg-indigo-50'" class="flex items-center pl-3 py-3 pr-4 rounded" :to="{ name: 'BackendUsersIndex' }">
                                    <span class="inline-block mr-3">
                                        <user-icon class="text-gray-300 w-5 h-5"></user-icon>
                                    </span>
                                    <span>{{ $t('Users') }}</span>
                                </router-link>
                            </li>
                            <li>
                                <router-link :class="/BackendRoles*/.test($route.name) ? 'text-white bg-indigo-500' : 'text-gray-500 hover:bg-indigo-50'" class="flex items-center pl-3 py-3 pr-4 rounded" :to="{ name: 'BackendRolesIndex' }">
                                    <span class="inline-block mr-3">
                                        <role-icon class="text-gray-300 w-5 h-5"></role-icon>
                                    </span>
                                    <span>{{ $t('Roles') }}</span>
                                </router-link>
                            </li>
                            <li>
                                <router-link :class="/BackendArticles*/.test($route.name) ? 'text-white bg-indigo-500' : 'text-gray-500 hover:bg-indigo-50'" class="flex items-center pl-3 py-3 pr-4 rounded" :to="{ name: 'BackendArticlesIndex' }">
                                    <span class="inline-block mr-3">
                                        <article-icon class="text-gray-300 w-5 h-5"></article-icon>
                                    </span>
                                    <span>{{ $t('Articles') }}</span>
                                </router-link>
                            </li>
                            <li>
                                <router-link :class="/BackendCategories*/.test($route.name) ? 'text-white bg-indigo-500' : 'text-gray-500 hover:bg-indigo-50'" class="flex items-center pl-3 py-3 pr-4 rounded" :to="{ name: 'BackendCategoriesIndex' }">
                                    <span class="inline-block mr-3">
                                        <category-icon class="text-gray-300 w-5 h-5"></category-icon>
                                    </span>
                                    <span>{{ $t('Categories') }}</span>
                                </router-link>
                            </li>
                            <li>
                                <router-link :class="/BackendTags*/.test($route.name) ? 'text-white bg-indigo-500' : 'text-gray-500 hover:bg-indigo-50'" class="flex items-center pl-3 py-3 pr-4 rounded" :to="{ name: 'BackendTagsIndex' }">
                                    <span class="inline-block mr-3">
                                        <tag-icon class="text-gray-300 w-5 h-5"></tag-icon>
                                    </span>
                                    <span>{{ $t('Tags') }}</span>
                                </router-link>
                            </li>
                            <li>
                                <router-link :class="/BackendComments*/.test($route.name) ? 'text-white bg-indigo-500' : 'text-gray-500 hover:bg-indigo-50'" class="flex items-center pl-3 py-3 pr-4 rounded" :to="{ name: 'BackendCommentsIndex' }">
                                    <span class="inline-block mr-3">
                                        <comment-icon class="text-gray-300 w-5 h-5"></comment-icon>
                                    </span>
                                    <span>{{ $t('Comments') }}</span>
                                </router-link>
                            </li>
                        </ul>
                        <div class="pt-6">
                            <h3 class="mb-2 text-xs uppercase text-gray-500 font-medium">{{ $t('Functions') }}</h3>
                            <form @submit.prevent="logout">
                                <button class="w-full" type="submit">
                                    <a class="flex items-center pl-3 py-3 pr-2 text-sm font-medium text-gray-500 hover:bg-indigo-50 rounded">
                                        <span class="inline-block mr-4">
                                            <logout-icon class="text-gray-300 w-5 h-5"></logout-icon>
                                        </span>
                                        <span>{{ $t('Log Out') }}</span>
                                    </a>
                                </button>
                            </form>
                        </div>
                    </div>
                </nav>
            </div>

            <!-- Right Container -->
            <div class="mx-auto lg:ml-56">
                <!-- Top Navigation -->
                <div class="py-2 lg:py-5 px-6 bg-white border-b">
                    <nav class="relative">
                        <div class="flex items-center">
                            <div class="flex items-center mr-auto">
                                <router-link class="flex items-center text-sm hover:text-gray-800" :to="{ name: 'BackendHome' }">
                                    <span class="inline-block mr-2">
                                        <home-icon class="text-indigo-500"></home-icon>
                                    </span>
                                    <span>{{ $t('Home') }}</span>
                                </router-link>
                                <div class="flex items-center" v-if="$route.name == 'BackendDashboard'">
                                    <span class="inline-block mx-3">
                                        <arrow-right-icon class="text-indigo-500 w-4 h-4"></arrow-right-icon>
                                    </span>
                                    <router-link class="flex items-center text-sm hover:text-gray-800" :to="{ name: 'BackendDashboard' }">
                                        <span class="inline-block mr-2">
                                            <dashboard-icon class="text-indigo-500" width="20" height="20"></dashboard-icon>
                                        </span>
                                        <span>{{ $t('Dashboard') }}</span>
                                    </router-link>
                                </div>
                                <div class="flex items-center" v-else-if="$route.name == 'BackendUsersIndex'">
                                    <span class="inline-block mx-3">
                                        <arrow-right-icon class="text-indigo-500 w-4 h-4"></arrow-right-icon>
                                    </span>
                                    <router-link class="flex items-center text-sm hover:text-gray-800" :to="{ name: 'BackendUsersIndex' }">
                                        <span class="inline-block mr-2">
                                            <user-icon class="text-indigo-500" width="20" height="20"></user-icon>
                                        </span>
                                        <span>{{ $t('Users') }}</span>
                                    </router-link>
                                </div>
                                <div class="flex items-center" v-else-if="$route.name == 'BackendRolesIndex'">
                                    <span class="inline-block mx-3">
                                        <arrow-right-icon class="text-indigo-500 w-4 h-4"></arrow-right-icon>
                                    </span>
                                    <router-link class="flex items-center text-sm hover:text-gray-800" :to="{ name: 'BackendRolesIndex' }">
                                        <span class="inline-block mr-2">
                                            <role-icon class="text-indigo-500" width="20" height="20"></role-icon>
                                        </span>
                                        <span>{{ $t('Roles') }}</span>
                                    </router-link>
                                </div>
                                <div class="flex items-center" v-else-if="$route.name == 'BackendArticlesIndex'">
                                    <span class="inline-block mx-3">
                                        <arrow-right-icon class="text-indigo-500 w-4 h-4"></arrow-right-icon>
                                    </span>
                                    <router-link class="flex items-center text-sm hover:text-gray-800" :to="{ name: 'BackendArticlesIndex' }">
                                        <span class="inline-block mr-2">
                                            <article-icon class="text-indigo-500" width="20" height="20"></article-icon>
                                        </span>
                                        <span>{{ $t('Articles') }}</span>
                                    </router-link>
                                </div>
                                <div class="flex items-center" v-else-if="$route.name == 'BackendCategoriesIndex'">
                                    <span class="inline-block mx-3">
                                        <arrow-right-icon class="text-indigo-500 w-4 h-4"></arrow-right-icon>
                                    </span>
                                    <router-link class="flex items-center text-sm hover:text-gray-800" :to="{ name: 'BackendCategoriesIndex' }">
                                        <span class="inline-block mr-2">
                                            <category-icon class="text-indigo-500" width="20" height="20"></category-icon>
                                        </span>
                                        <span>{{ $t('Categories') }}</span>
                                    </router-link>
                                </div>
                                <div class="flex items-center" v-else-if="$route.name == 'BackendTagsIndex'">
                                    <span class="inline-block mx-3">
                                        <arrow-right-icon class="text-indigo-500 w-4 h-4"></arrow-right-icon>
                                    </span>
                                    <router-link class="flex items-center text-sm hover:text-gray-800" :to="{ name: 'BackendTagsIndex' }">
                                        <span class="inline-block mr-2">
                                            <tag-icon class="text-indigo-500" width="20" height="20"></tag-icon>
                                        </span>
                                        <span>{{ $t('Tags') }}</span>
                                    </router-link>
                                </div>
                                <div class="flex items-center" v-else-if="$route.name == 'BackendCommentsIndex'">
                                    <span class="inline-block mx-3">
                                        <arrow-right-icon class="text-indigo-500 w-4 h-4"></arrow-right-icon>
                                    </span>
                                    <router-link class="flex items-center text-sm hover:text-gray-800" :to="{ name: 'BackendCommentsIndex' }">
                                        <span class="inline-block mr-2">
                                            <comment-icon class="text-indigo-500" width="20" height="20"></comment-icon>
                                        </span>
                                        <span>{{ $t('Comments') }}</span>
                                    </router-link>
                                </div>
                                <div class="flex items-center" v-if="/Backend*Create/.test($route.name)">
                                    <span class="inline-block mx-3">
                                        <arrow-right-icon class="text-indigo-500 w-4 h-4"></arrow-right-icon>
                                    </span>
                                    <span class="inline-block mr-2">
                                        {{ $t('Create') }}
                                    </span>
                                </div>
                                <div class="flex items-center" v-else-if="/Backend*Edit/.test($route.name)">
                                    <span class="inline-block mx-3">
                                        <arrow-right-icon class="text-indigo-500 w-4 h-4"></arrow-right-icon>
                                    </span>
                                    <span class="inline-block mr-2">
                                        {{ $t('Edit') }}
                                    </span>
                                </div>
                            </div>
                            <ul class="hidden lg:flex items-center space-x-6 mr-6">
                                <li>
                                    <!-- Locale -->
                                    <dropdown :align="'top'" :width="'40'">
                                        <!-- Click to open dropdown -->
                                        <template v-slot:trigger>
                                            <button class="p-2 flex items-center hover:bg-gray-300 rounded transition duration-150 ease-in-out">
                                                <en-flag v-if="$i18n.locale === 'en'" class="w-6 h-4"></en-flag>
                                                <vi-flag v-if="$i18n.locale === 'vi'" class="w-6 h-4"></vi-flag>
                                                <div class="ml-1">
                                                    <svg class="fill-current h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                    </svg>
                                                </div>
                                            </button>
                                        </template>
                                        <!-- Dropdown -->
                                        <template v-slot:content>
                                            <div class="mx-1">
                                                <dropdown-link :as="'a'" @click.native="changeLocale('en')">
                                                    <div class="flex items-center">
                                                        <en-flag class="w-6 h-4"></en-flag>
                                                        <span class="text-sm pl-2">
                                                            English
                                                        </span>
                                                    </div>
                                                </dropdown-link>
                                            </div>
                                            <div class="mx-1">
                                                <dropdown-link :as="'a'" @click.native="changeLocale('vi')">
                                                    <div class="flex items-center">
                                                        <vi-flag class="w-6 h-4"></vi-flag>
                                                        <span class="text-sm pl-2">
                                                            Tiếng Việt
                                                        </span>
                                                    </div>
                                                </dropdown-link>
                                            </div>
                                        </template>
                                    </dropdown>
                                </li>
                                <li>
                                    <router-link class="text-gray-200 hover:text-gray-300" :to="{}">
                                        <search-icon class="h-5 w-5"></search-icon>
                                    </router-link>
                                </li>
                                <li>
                                    <router-link class="text-gray-200 hover:text-gray-300" :to="{}">
                                        <message-icon class="h-5 w-5"></message-icon>
                                    </router-link>
                                </li>
                                <li>
                                    <router-link class="text-gray-200 hover:text-gray-300" :to="{}">
                                        <notification-icon class="h-5 w-5"></notification-icon>
                                    </router-link>
                                </li>
                            </ul>
                            <div class="hidden lg:block">
                                <div class="flex items-center">
                                    <div class="mr-3">
                                        <p v-if="user.id" class="text-base font-medium">{{ user.name }}</p>
                                    </div>
                                    <div class="mr-2">
                                        <img class="w-10 h-10 rounded-full object-cover object-right" src="http://trichdanhay.vn/wp-content/uploads/2020/09/nhung-cau-noi-hay-cua-huan-hoa-hong.png" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </nav>
                </div>

                <div class="m-4">
                    <!-- Page Content -->
                    <main>
                        <router-view></router-view>
                    </main>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="mx-auto lg:ml-56 bg-gray-300 h-24 flex">
            <div class="text-center m-auto">
                <p class="text-sm">Copyright © 2021 - 2022 - Tailwind CSS. All Rights Reserved</p>
            </div>
        </footer>
    </div>
</template>

<script>
import ApplicationLogo from "../components/ApplicationLogo.vue";
import EnFlag from "../components/EnFlag.vue";
import ViFlag from "../components/ViFlag.vue";
import Dropdown from "../components/Dropdown.vue";
import DropdownLink from "../components/DropdownLink.vue";
import HomeIcon from "../components/HomeIcon.vue";
import DashboardIcon from "../components/DashboardIcon.vue";
import ArticleIcon from "../components/ArticleIcon.vue";
import CategoryIcon from "../components/CategoryIcon.vue";
import CommentIcon from "../components/CommentIcon.vue";
import LogoutIcon from "../components/LogoutIcon.vue";
import RoleIcon from "../components/RoleIcon.vue";
import SearchIcon from "../components/SearchIcon.vue";
import TagIcon from "../components/TagIcon.vue";
import UserIcon from "../components/UserIcon.vue";
import MessageIcon from "../components/MessageIcon.vue";
import NotificationIcon from "../components/NotificationIcon.vue";
import ArrowRightIcon from "../components/ArrowRightIcon.vue";

export default {
    components: {
        ApplicationLogo,
        EnFlag,
        ViFlag,
        Dropdown,
        DropdownLink,
        HomeIcon,
        DashboardIcon,
        ArticleIcon,
        CategoryIcon,
        CommentIcon,
        LogoutIcon,
        RoleIcon,
        SearchIcon,
        TagIcon,
        UserIcon,
        MessageIcon,
        NotificationIcon,
        ArrowRightIcon,
    },
    data() {
        return {
            showingNavigation: false,
            user: this.$store.getters.getUserAuth,
        };
    },
    methods: {
        async logout() {
            const url = "admin/logout";
            const res = await this.callApi("post", url);
            if (res.status === 200) {
                this.user = {};
                this.$store.commit("updateUserAuth", this.user);
                localStorage.setItem("userAuth", JSON.stringify(this.user));
                window.location.href = "/admin/login";
            } else {
                alert(this.$i18n.t("Logout error. Please try again !"));
            }
        },
        async changeLocale(locale) {
            if (locale !== this.$i18n.locale) {
                const url = "locale/" + locale;
                const res = await this.callApi("get", url);
                if (res.status === 200) {
                    this.$i18n.locale = locale;
                } else {
                    alert(
                        this.$i18n.t("Change locale error. Please try again !")
                    );
                }
            }
        },
    },
};
</script>
