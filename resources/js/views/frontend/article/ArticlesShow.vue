<template>
    <div>
        <!-- Loading component -->
        <div v-if="isLoading" class="relative w-full h-96">
            <loading :active.sync="isLoading" :is-full-page="false" :height="40" :width="40" :color="'#007BFF'" :loader="'dots'"></loading>
        </div>
        <div v-if="!isLoading" class="mx-8 px-2 py-4 lg:flex">
            <!-- Content Left -->
            <div class="w-full lg:w-3/4">
                <div class="py-8">
                    <div class="container px-24 mx-auto">
                        <!-- Article detail -->
                        <div v-if="article.id" class="bg-white">
                            <div class="text-2xl font-bold p-4 bg-gray-100">
                                {{ article.title }}
                            </div>
                            <div class="w-full">
                                <div class="py-4 flex items-center">
                                    <img class="mx-auto" width="400" height="200" :src="article.large_image_url" :alt="article.title">
                                </div>
                            </div>
                            <div class="w-full p-4 text-base">
                                <div class="mt-4 flex items-center text-center">
                                    <div class="font-bold">
                                        <p>{{ $t('Author') }}:</p>
                                    </div>
                                    <div class="ml-2">
                                        <p>{{ article.user.name }}</p>
                                    </div>
                                </div>
                                <div class="mt-4 flex items-center text-center">
                                    <div class="font-bold">
                                        <p>{{ $t('Categories') }}:</p>
                                    </div>
                                    <div class="ml-2">
                                        <p v-html="article.categories_links"></p>
                                    </div>
                                </div>
                                <div class="mt-4 flex items-center text-center">
                                    <div class="font-bold">
                                        <p>{{ $t('Tags') }}:</p>
                                    </div>
                                    <div class="ml-2">
                                        <p v-html="article.tags_links"></p>
                                    </div>
                                </div>
                                <div class="mt-4 flex items-center text-center">
                                    <div class="mx-auto bg-yellow-100 rounded flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 ml-2 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <p class="text-yellow-500 p-2 text-sm">{{ $t('This article was updated at') + ' ' + formatDateTime(article.updated_at) }}</p>
                                    </div>
                                </div>
                                <div class="my-4">
                                    <p>
                                        {{ article.content }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Comment Container -->
                        <div class="bg-white">
                            <!-- Input comment -->
                            <div class="mt-12">
                                <div class="font-bold text-3xl mb-6">
                                    {{ $t('Comments') }}
                                </div>
                                <div class="mb-6 pt-2">
                                    <div v-if="user.id">
                                        <form @submit.prevent="addComment">
                                            <!-- Article ID -->
                                            <input type="hidden" id="article_id" name="article_id" v-model="form.article_id" required />

                                            <!-- User ID -->
                                            <input type="hidden" id="user_id" name="user_id" v-model="form.user_id" required />

                                            <!-- Content -->
                                            <div class="relative w-full clear-both">
                                                <textarea class="py-4 pl-4 pr-20 sm:pr-28 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" style="min-height: 6.725rem" id="content" name="content" v-model="form.content" required :placeholder="$t('Enter a content comment')"></textarea>
                                                <button type="submit" :class="{ 'opacity-25': isFormLoading }" :disabled="isFormLoading" class="w-8 h-8 absolute border-none top-10 right-10 bg-cover" style="background-image: url('/img/comment_textarea.png'); background-color: inherit;"></button>
                                            </div>

                                        </form>
                                        <ul class="text-xs text-red-900">
                                            <li v-for="(error, index) in errors.content" :key="index" class="py-1 px-2">{{ error }}</li>
                                        </ul>
                                    </div>
                                    <div v-else class="w-full">
                                        <div class="border rounded p-2 flex">
                                            <router-link class="mx-auto text-center flex" :to="{ name: 'Login' }">
                                                <login-icon class="w-6 h-6 text-gray-500"></login-icon>
                                                <span class="text-sm ml-2">{{ $t('Login to comment') }}!</span>
                                            </router-link>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- List comments -->
                            <div id="ul-comments" class="mt-6">
                                <div v-for="comment in comments" :key="comment.id" class="mt-4 flex w-full">
                                    <div class="mr-2 pt-2 pl-2">
                                        <img class="w-8 h-8 rounded-full object-cover object-right" src="http://trichdanhay.vn/wp-content/uploads/2020/09/nhung-cau-noi-hay-cua-huan-hoa-hong.png" :alt="comment.user.name">
                                    </div>
                                    <div class="mx-2 bg-gray-100 w-full p-4 rounded">
                                        <div class="text-sm">
                                            <span class="font-bold">{{ comment.user.name }}</span>
                                            <!-- Display xx minutes/hours/days/months/years ago-->
                                            <span class="ml-8 text-gray-400">{{ formatDateTimeAgo(comment.created_at) }}</span>
                                        </div>
                                        <div class="pt-4">
                                            {{ comment.content }}
                                        </div>
                                    </div>
                                </div>
                                <div v-if="typeof comments === 'undefined' || comments.length === 0" id="ul-comments-empty" class="mt-4 w-full">
                                    <div class="border rounded p-2 flex">
                                        <div class="mx-auto text-center flex">
                                            <comment-icon class="w-6 h-6 text-gray-500"></comment-icon>
                                            <span class="text-sm ml-2">{{ $t('No comments yet') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Nav Right -->
            <div class="hidden lg:block lg:w-1/4 z-100">
                <!-- Table of contents -->
                <div class="py-8 mx-3">
                    <div class="text-xl font-bold p-4 border-b">
                        {{ $t("Table of contents") }}
                    </div>
                    <div class="py-4">
                        <ul class="bg-gray-100 p-2">
                            <p>{{ $t('There is no table of contents') }}</p>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import LoginIcon from "../../../components/LoginIcon.vue";
import CommentIcon from "../../../components/CommentIcon.vue";

export default {
    components: {
        LoginIcon,
        CommentIcon,
    },
    data() {
        return {
            article: {},
            comments: [],
            user: {
                id: 2,
            },
            errors: {},
            form: {
                article_id: Number,
                user_id: Number,
                content: "",
            },
            isLoading: true,
            isFormLoading: false,
        };
    },
    async created() {
        this.isLoading = true;
        const url = "articles/" + this.$route.params.id;
        const res = await this.callApi("get", url);
        if (res.status === 200) {
            this.article = res.data.article;
            this.comments = res.data.comments;
            this.isLoading = false;
            // init data form
            this.form.article_id = this.article.id;
            this.form.user_id = this.user.id;
        } else {
            alert("Get data error. Please reload page !");
        }
    },
    methods: {
        async addComment() {
            this.errors = {};
            this.isFormLoading = true;
            const res = await this.callApi("post", "comments", this.form);
            if (res.status === 201) {
                this.form.content = "";
                this.comments.unshift(res.data);
            } else if (res.status === 422) {
                this.errors = res.data.errors;
            } else {
                alert("Post data error. Please try again !");
            }
            this.isFormLoading = false;
        },
    },
};
</script>
