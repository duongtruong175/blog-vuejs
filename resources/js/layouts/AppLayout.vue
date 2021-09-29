<template>
    <div>
        <div class="min-h-screen">
            <!-- Navigation -->
            <nav class="bg-white border-b border-gray-100">
                <!-- Primary Navigation Menu -->
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <!-- Left Navigation -->
                        <div class="flex">
                            <!-- Logo -->
                            <div class="flex-shrink-0 flex items-center">
                                <router-link :to="{ name: 'Home' }">
                                    <application-logo class="block h-10 w-auto fill-current text-gray-600"></application-logo>
                                </router-link>
                                <span class="ml-4 font-medium text-2xl">
                                    {{ $t('Blog') }}
                                </span>
                            </div>

                            <!-- Links on Left Naigation-->
                            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                                <nav-link :href="{ name: 'Home' }" :active="$route.name == 'Home'">
                                    {{ $t('Home') }}
                                </nav-link>
                                <nav-link :href="{ name: 'ArticlesIndex' }" :active="$route.name == 'ArticlesIndex' || $route.name == 'ArticlesShow'">
                                    {{ $t('Articles') }}
                                </nav-link>
                                <nav-link :href="{ name: 'About' }" :active="$route.name == 'About'">
                                    {{ $t('About Us') }}
                                </nav-link>

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
                            </div>
                        </div>

                        <!-- Links on Right Navigation + Settings Dropdown (screen > sm (640px)) -->
                        <div class="hidden sm:flex sm:items-center sm:ml-6">
                            <dropdown v-if="user.id" :align="'right'" :width="'40'">
                                <template v-slot:trigger>
                                    <button class="flex items-center text-base font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                        <div>{{ user.name }}</div>

                                        <div class="ml-1">
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </button>
                                </template>

                                <template v-slot:content>
                                    <!-- Authentication -->
                                    <form @submit.prevent="logout">
                                        <button class="w-full text-left block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out">
                                            {{ $t('Log Out') }}
                                        </button>
                                    </form>
                                </template>
                            </dropdown>
                            <div v-else class="px-6 py-4 flex">
                                <a href="/login" class="flex items-center text-sm text-white bg-green-500 hover:bg-green-800 font-medium px-4 py-2 rounded-2xl">{{ $t('Log In') }}</a>
                                <a href="/register" class="flex items-center ml-4 text-sm text-white bg-green-500 hover:bg-green-800 font-medium px-4 py-2 rounded-2xl">{{ $t('Register') }}</a>
                            </div>
                        </div>

                        <!-- Hamburger -->
                        <div class="-mr-2 flex items-center sm:hidden">
                            <button @click="showingNavigationDropdown = ! showingNavigationDropdown" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition">
                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path :class="{'hidden': showingNavigationDropdown, 'inline-flex': ! showingNavigationDropdown }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                    <path :class="{'hidden': ! showingNavigationDropdown, 'inline-flex': showingNavigationDropdown }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Responsive Navigation Menu -->
                <div :class="{'block': showingNavigationDropdown, 'hidden': ! showingNavigationDropdown}" class="sm:hidden">
                    <div class="pt-2 pb-3 space-y-1">
                        <responsive-nav-link :href="{ name: 'Home' }" :active="$route.name == 'Home'">
                            {{ $t('Home') }}
                        </responsive-nav-link>
                        <responsive-nav-link :href="{ name: 'ArticlesIndex' }" :active="$route.name == 'ArticlesIndex' || $route.name == 'ArticlesShow'">
                            {{ $t('Articles') }}
                        </responsive-nav-link>
                        <responsive-nav-link :href="{ name: 'About' }" :active="$route.name == 'About'">
                            {{ $t('About Us') }}
                        </responsive-nav-link>
                        <!-- Locale -->
                        <dropdown class="ml-2" :align="'top'" :width="'40'">
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
                    </div>

                    <!-- Responsive Settings Options -->
                    <div v-if="user.id" class="pt-4 pb-1 border-t border-gray-200">
                        <div class="px-4">
                            <div class="font-medium text-base text-gray-800">{{ user.name }}</div>
                            <div class="font-medium text-sm text-gray-500">{{ user.email }}</div>
                        </div>

                        <div class="mt-3 space-y-1">
                            <!-- Authentication -->
                            <form @submit.prevent="logout">
                                <button type="submit" class="w-full text-left block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out">
                                    {{ $t('Log Out') }}
                                </button>
                            </form>
                        </div>
                    </div>
                    <div v-else class="pt-2 pb-3 border-t border-gray-200">
                        <div class="space-y-1">
                            <a href="/login" class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out">
                                {{ $t('Log In') }}
                            </a>
                        </div>
                        <div class="mt-3 space-y-1">
                            <a href="/register" class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out">
                                {{ $t('Register') }}
                            </a>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Content -->
            <main>
                <router-view></router-view>
            </main>
        </div>
        <!-- Footer -->
        <footer class="bg-gray-300 h-24 flex">
            <div class="text-center m-auto">
                <p class="text-sm">Copyright © 2021 - 2022 - Tailwind CSS. All Rights Reserved</p>
            </div>
        </footer>
    </div>
</template>

<script>
import ApplicationLogo from "../components/ApplicationLogo.vue";
import NavLink from "../components/NavLink.vue";
import ResponsiveNavLink from "../components/ResponsiveNavLink.vue";
import EnFlag from "../components/EnFlag.vue";
import ViFlag from "../components/ViFlag.vue";
import Dropdown from "../components/Dropdown.vue";
import DropdownLink from "../components/DropdownLink.vue";

export default {
    components: {
        ApplicationLogo,
        NavLink,
        Dropdown,
        EnFlag,
        ViFlag,
        DropdownLink,
        ResponsiveNavLink,
    },
    data() {
        return {
            showingNavigationDropdown: false,
            user: this.$store.getters.getUserAuth,
        };
    },
    async created() {
        await this.$store.dispatch("loadUser");
        this.user = this.$store.getters.getUserAuth;
    },
    methods: {
        async logout() {
            const url = "logout";
            const res = await this.callApi("post", url);
            if (res.status === 200) {
                this.user = {};
                this.$store.commit("updateUserAuth", this.user);
                localStorage.setItem("userAuth", JSON.stringify(this.user));
                window.location.href = "/";
            } else {
                alert("Logout error. Please try again !");
            }
        },
        async changeLocale(locale) {
            if (locale !== this.$i18n.locale) {
                const url = "locale/" + locale;
                const res = await this.callApi("get", url);
                if (res.status === 200) {
                    this.$i18n.locale = locale;
                } else {
                    alert("Change locale error. Please try again !");
                }
            }
        },
    },
};
</script>
