<template>
    <div>
        <!-- Header + Contain dashboard -->
        <div class="text-3xl p-4 mb-8">
            {{ $t('Dashboard') }}
        </div>
        <div class="flex flex-wrap">
            <div class="w-1/2 sm:w-1/3 lg:w-1/4 px-2">
                <div class="bg-blue-400 relative rounded mb-4">
                    <div class="items-center text-center sm:text-left sm:block text-white p-6">
                        <div class="font-extrabold text-3xl">
                            {{ total_users }}
                        </div>
                        <div class="text-sm mt-2 font-medium">
                            {{ $t('Users Registrations') }}
                        </div>
                    </div>
                    <div class="hidden sm:block absolute top-1/3 right-4">
                        <user-icon class="w-8 h-8 transition duration-300 transform hover:scale-125" style="color: rgba(0, 0, 0, 0.15)"></user-icon>
                    </div>
                    <a class="flex justify-center cursor-pointer text-center p-1 w-full" style="background-color: rgba(0,0,0,.1)">
                        <span class="text-white text-sm mr-1">{{ $t('More info') }}</span>
                        <arrow-circle-right-icon class="h-5 w-5 text-white inline-block"></arrow-circle-right-icon>
                    </a>
                </div>
            </div>
            <div class="w-1/2 sm:w-1/3 lg:w-1/4 px-2">
                <div class="bg-green-400 relative rounded mb-4">
                    <div class="items-center text-center sm:text-left sm:block text-white p-6">
                        <div class="font-extrabold text-3xl">
                            {{ total_articles }}
                        </div>
                        <div class="text-sm mt-2 font-medium">
                            {{ $t('Articles Written') }}
                        </div>
                    </div>
                    <div class="hidden sm:block absolute top-1/3 right-4">
                        <article-icon class="w-8 h-8 transition duration-300 transform hover:scale-125" style="color: rgba(0, 0, 0, 0.15)"></article-icon>
                    </div>
                    <a class="flex justify-center cursor-pointer text-center p-1 w-full" style="background-color: rgba(0,0,0,.1)">
                        <span class="text-white text-sm mr-1">{{ $t('More info') }}</span>
                        <arrow-circle-right-icon class="h-5 w-5 text-white inline-block"></arrow-circle-right-icon>
                    </a>
                </div>
            </div>
            <div class="w-1/2 sm:w-1/3 lg:w-1/4 px-2">
                <div class="bg-yellow-400 relative rounded mb-4">
                    <div class="items-center text-center sm:text-left sm:block text-white p-6">
                        <div class="font-extrabold text-3xl">
                            {{ total_categories }}
                        </div>
                        <div class="text-sm mt-2 font-medium">
                            {{ $t('Categories Created') }}
                        </div>
                    </div>
                    <div class="hidden sm:block absolute top-1/3 right-4">
                        <category-icon class="w-8 h-8 transition duration-300 transform hover:scale-125" style="color: rgba(0, 0, 0, 0.15)"></category-icon>
                    </div>
                    <a class="flex justify-center cursor-pointer text-center p-1 w-full" style="background-color: rgba(0,0,0,.1)">
                        <span class="text-white text-sm mr-1">{{ $t('More info') }}</span>
                        <arrow-circle-right-icon class="h-5 w-5 text-white inline-block"></arrow-circle-right-icon>
                    </a>
                </div>
            </div>
            <div class="w-1/2 sm:w-1/3 lg:w-1/4 px-2">
                <div class="bg-red-500 relative rounded mb-4">
                    <div class="items-center text-center sm:text-left sm:block text-white p-6">
                        <div class="font-extrabold text-3xl">
                            {{ total_tags }}
                        </div>
                        <div class="text-sm mt-2 font-medium">
                            {{ $t('Tags Created') }}
                        </div>
                    </div>
                    <div class="hidden sm:block absolute top-1/3 right-4">
                        <tag-icon class="w-8 h-8 transition duration-300 transform hover:scale-125" style="color: rgba(0, 0, 0, 0.15)"></tag-icon>
                    </div>
                    <a class="flex justify-center cursor-pointer text-center p-1 w-full" style="background-color: rgba(0,0,0,.1)">
                        <span class="text-white text-sm mr-1">{{ $t('More info') }}</span>
                        <arrow-circle-right-icon class="h-5 w-5 text-white inline-block"></arrow-circle-right-icon>
                    </a>
                </div>
            </div>
            <div class="w-1/2 sm:w-1/3 lg:w-1/4 px-2">
                <div class="bg-indigo-500 relative rounded mb-4">
                    <div class="items-center text-center sm:text-left sm:block text-white p-6">
                        <div class="font-extrabold text-3xl">
                            {{ total_comments }}
                        </div>
                        <div class="text-sm mt-2 font-medium">
                            {{ $t('Comments Written') }}
                        </div>
                    </div>
                    <div class="hidden sm:block absolute top-1/3 right-4">
                        <comment-icon class="w-8 h-8 transition duration-300 transform hover:scale-125" style="color: rgba(0, 0, 0, 0.15)"></comment-icon>
                    </div>
                    <a class="flex justify-center cursor-pointer text-center p-1 w-full" style="background-color: rgba(0,0,0,.1)">
                        <span class="text-white text-sm mr-1">{{ $t('More info') }}</span>
                        <arrow-circle-right-icon class="h-5 w-5 text-white inline-block"></arrow-circle-right-icon>
                    </a>
                </div>
            </div>
            <div class="w-1/2 sm:w-1/3 lg:w-1/4 px-2">
                <div class="bg-pink-500 relative rounded mb-4">
                    <div class="items-center text-center sm:text-left sm:block text-white p-6">
                        <div class="font-extrabold text-3xl">
                            {{ total_roles }}
                        </div>
                        <div class="text-sm mt-2 font-medium">
                            {{ $t('Roles Created') }}
                        </div>
                    </div>
                    <div class="hidden sm:block absolute top-1/3 right-4">
                        <role-icon class="w-8 h-8 transition duration-300 transform hover:scale-125" style="color: rgba(0, 0, 0, 0.15)"></role-icon>
                    </div>
                    <a class="flex justify-center cursor-pointer text-center p-1 w-full" style="background-color: rgba(0,0,0,.1)">
                        <span class="text-white text-sm mr-1">{{ $t('More info') }}</span>
                        <arrow-circle-right-icon class="h-5 w-5 text-white inline-block"></arrow-circle-right-icon>
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import ArrowCircleRightIcon from "../../../components/ArrowCircleRightIcon.vue";
import UserIcon from "../../../components/UserIcon.vue";
import ArticleIcon from "../../../components/ArticleIcon.vue";
import CategoryIcon from "../../../components/CategoryIcon.vue";
import CommentIcon from "../../../components/CommentIcon.vue";
import RoleIcon from "../../../components/RoleIcon.vue";
import TagIcon from "../../../components/TagIcon.vue";

export default {
    data() {
        return {
            total_users: 0,
            total_articles: 0,
            total_categories: 0,
            total_comments: 0,
            total_roles: 0,
            total_tags: 0,
        };
    },
    components: {
        ArrowCircleRightIcon,
        UserIcon,
        ArticleIcon,
        CategoryIcon,
        CommentIcon,
        RoleIcon,
        TagIcon,
    },
    created() {
        this.total_users = 10;
        this.total_articles = 5;
        this.total_categories = 6;
        this.total_comments = 8;
        this.total_roles = 9;
        this.total_tags = 15;
    },
};
</script>
