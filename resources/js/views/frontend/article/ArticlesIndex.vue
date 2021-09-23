<template>
    <div>
        <div class="mx-4 px-2 py-4 lg:flex">
            <!-- Content Left -->
            <div class="w-full lg:w-3/4">
                <div class="py-8">
                    <div class="container px-4 mx-auto">
                        <div class="flex flex-wrap m-4">
                            <!-- List Articles -->
                            <div v-for="article in articles" :key="article.id" class="w-full lg:w-2/4 p-4">
                                <div class="bg-white shadow rounded overflow-hidden sm:flex">
                                    <div class="w-full sm:w-4/12 flex">
                                        <div class="p-2 m-auto">
                                            <img width="200" height="200" src="" :alt="article.title">
                                        </div>
                                    </div>
                                    <div class="w-full px-4 sm:w-8/12 sm:px-2 py-4">
                                        <div class="mt-4 border-b">
                                            <router-link class="text-2xl text-blue-500 hover:text-blue-800" :to="{ name: 'ArticlesShow', params: { id: article.id } }">
                                                {{ article.title }}
                                            </router-link>
                                        </div>
                                        <div class="text-sm mt-4 flex items-center text-center">
                                            <div class="font-bold">
                                                <p>{{ $t('Author') }}:</p>
                                            </div>
                                            <div class="ml-2">
                                                <div class="overflow-hidden whitespace-nowrap">{{ article.user.name }}</div>
                                            </div>
                                        </div>
                                        <div class="text-sm mt-4 flex items-center text-center">
                                            <div class="font-bold">
                                                <p>{{ $t('Categories') }}:</p>
                                            </div>
                                            <div class="ml-2">
                                                <div class="overflow-hidden whitespace-nowrap">#</div>
                                            </div>
                                        </div>
                                        <div class="text-sm mt-4 flex items-center text-center">
                                            <div class="font-bold">
                                                <p>{{ $t('Tags') }}:</p>
                                            </div>
                                            <div class="ml-2">
                                                <div class="overflow-hidden whitespace-nowrap">#</div>
                                            </div>
                                        </div>
                                        <div class="text-sm mt-4 flex items-center text-center text-gray-500">
                                            <comment-icon width="20" height="20"></comment-icon>
                                            <span class="ml-1">
                                                {{ Object. keys(article.comments).length }}
                                            </span>
                                        </div>
                                        <div class="text-sm my-4">
                                            <div>
                                                <p class="overflow-hidden" style="max-height: 9rem; min-height: 9rem">{{ article.content.substr(0, 399) + ' ...' }}</p>
                                                <router-link class="text-blue-500 hover:text-blue-800" :to="{ name: 'ArticlesShow', params: { id: article.id } }">
                                                    {{ $t('Read full article') }}
                                                </router-link>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div v-if="Object.keys(articles).length === 0" class="text-xl pl-56 pt-8">
                                {{ $t('No articles yet') }}
                            </div>
                        </div>

                        <!-- Paging Bar -->
                        <!-- <div class="pt-4">
                            {{ $articles->onEachSide(1)->appends(request()->except('page'))->links() }}
                        </div> -->
                    </div>
                </div>
            </div>

            <!-- Nav Right -->
            <div class="w-full lg:w-1/4">
                <div class="py-8 mx-3">
                    <div class="shadow">
                        <div class="text-xl font-bold p-4 bg-gray-100">
                            {{ $t('Search by keyword') }}
                        </div>
                        <div class="pl-4 py-4">
                            <form action="#" method="GET">
                                <input class="text-xs w-7/12 p-2 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="text" id="keyword" name="keyword" :placeholder="$t('Enter a keyword')" v-model="form.keyword" required />
                                <button class="text-xs ml-2 text-white p-2 bg-blue-500 hover:bg-blue-800 rounded">{{ $t('Search') }}</button>
                            </form>
                        </div>
                    </div>
                    <div class="shadow mt-6">
                        <div class="text-xl font-bold p-4 bg-gray-100">
                            {{ $t('Categories') }}
                        </div>
                        <div class="text-sm h-64 overscroll-y-auto overflow-y-auto overflow-x-hidden">
                            <ul class="pl-10 pt-3 pb-6">
                                <li v-for="category in categories" :key="category.id" class="pt-3">
                                    <div class="transition duration-300 transform text-blue-500 hover:text-blue-900 hover:scale-105">
                                        <router-link :to="{ name: 'ArticlesIndex' }">
                                            {{ category.name }}
                                        </router-link>
                                    </div>
                                </li>
                                <li v-if="Object.keys(categories).length === 0" class="pt-3">
                                    {{ $t('No categories yet') }}
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="shadow mt-6">
                        <div class="text-xl font-bold p-4 bg-gray-100">
                            {{ $t('Top 5 tags') }}
                        </div>
                        <div class="text-sm">
                            <ul class="pl-10 pt-3 pb-6">
                                <li v-for="tag in top_tags" :key="tag.id" class="pt-3">
                                    <div class="transition duration-300 transform text-blue-500 hover:text-blue-800 hover:scale-105">
                                        <a :to="{ name: 'ArticlesIndex' }">
                                            {{ tag.name }}
                                        </a>
                                    </div>
                                </li>
                                <li v-if="Object.keys(top_tags).length === 0" class="pt-3">
                                    {{ $t('No tags yet') }}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import CommentIcon from "../../../components/CommentIcon.vue";

export default {
    data() {
        return {
            articles: {},
            categories: {},
            top_tags: {},
            form: {
                keyword: "",
            },
        };
    },
    async created() {
        const res = await this.callApi("get", "api/v1/articles");
        if (res.status === 200) {
            console.log(res.data);
            this.articles = res.data.articles.data;
            this.categories = res.data.categories;
            this.top_tags = res.data.top_tags;
        } else {
            console.log(res);
        }
    },
    components: {
        CommentIcon,
    },
};
</script>
