<template>
    <div>
        <div class="mx-8 px-2 py-4 lg:flex">
            <!-- Content Left -->
            <div class="w-full lg:w-3/4">
                <div class="py-8">
                    <div class="container px-24 mx-auto">
                        <!-- Article detail -->
                        <div class="bg-white">
                            <div class="text-2xl font-bold p-4 bg-gray-100">
                                {{ article.title }}
                            </div>
                            <div class="w-full">
                                <div class="py-4 flex items-center">
                                    <img class="mx-auto" width="400" height="200" src="" :alt="article.title">
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
                                        <p>#</p>
                                    </div>
                                </div>
                                <div class="mt-4 flex items-center text-center">
                                    <div class="font-bold">
                                        <p>{{ $t('Tags') }}:</p>
                                    </div>
                                    <div class="ml-2">
                                        <p>#</p>
                                    </div>
                                </div>
                                <div class="mt-4 flex items-center text-center">
                                    <div class="mx-auto bg-yellow-100 rounded flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 ml-2 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <p class="text-yellow-500 p-2 text-sm">{{ $t('This article was updated at') + ' ' + article.updated_at }}</p>
                                    </div>
                                </div>
                                <div class="my-4">
                                    <p>
                                        {{ article.content }}
                                    </p>
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
export default {
    data() {
        return {
            articles: {},
        };
    },
    async created() {
        const url = "api/v1/articles/" + "1";
        const res = await this.callApi("get", url);
        if (res.status === 200) {
            console.log(res.data);
            this.articles = res.data.articles;
        } else {
            console.log(res);
        }
    },
};
</script>
