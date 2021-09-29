<template>
    <div>
        <!-- Form edit -->
        <div class="p-4 text-3xl mr-auto">
            {{ $t('Edit article') }}
        </div>
        <!-- Loading component -->
        <div v-if="isLoading" class="relative w-full h-96">
            <loading :active.sync="isLoading" :is-full-page="false" :height="40" :width="40" :color="'#007BFF'" :loader="'dots'"></loading>
        </div>
        <div v-if="!isLoading" class="w-full sm:max-w-4xl mt-6 px-6 py-4 bg-white sm:rounded-lg">
            <form @submit.prevent="updateArticle" enctype="multipart/form-data">
                <!-- ID -->
                <div>
                    <label for="id" class="block font-medium text-sm text-gray-700">{{ $t('ID') }}</label>
                    <input class="block mt-1 w-full rounded-md shadow-sm bg-gray-300 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="text" id="id" name="id" v-model="form.id" required readonly />
                </div>

                <!-- Title -->
                <div class="mt-4">
                    <label for="title" class="block font-medium text-sm text-gray-700">{{ $t('Title') }}</label>
                    <input class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="text" id="title" name="title" v-model="form.title" required autofocus />
                    <ul class="text-xs text-red-900">
                        <li v-for="(error, index) in errors.title" :key="index" class="py-1 px-2">{{ error }}</li>
                    </ul>
                </div>

                <!-- Content -->
                <div class="mt-4">
                    <label for="content" class="block font-medium text-sm text-gray-700">{{ $t('Content') }}</label>
                    <textarea rows="10" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" style="min-height: 6.725rem" id="content" name="content" v-model="form.content" required></textarea>
                    <ul class="text-xs text-red-900">
                        <li v-for="(error, index) in errors.content" :key="index" class="py-1 px-2">{{ error }}</li>
                    </ul>
                </div>

                <!-- Categories -->
                <fieldset class="mt-4">
                    <legend for="categories" class="block font-medium text-sm text-gray-700">{{ $t('Categories') + ' (' + $t('Max 3 categories') + ')' }}</legend>
                    <div class="mt-1 w-full overscroll-y-auto overflow-auto h-40">
                        <div v-for="category in categories" :key="category.id" class="flex items-center my-2 ml-2 text-sm">
                            <input class="rounded" type="checkbox" :id="'category_' + category.id" name="categories" v-model="form.categories" :value="category.id" />
                            <label class="pl-2" :for="'category_' + category.id">{{ category.name }}</label>
                        </div>
                    </div>
                    <ul class="text-xs text-red-900">
                        <li v-for="(error, index) in errors.categories" :key="index" class="py-1 px-2">{{ error }}</li>
                    </ul>
                </fieldset>

                <!-- Tags -->
                <div class="mt-4">
                    <label for="tags" class="block font-medium text-sm text-gray-700">{{ $t('Tags') + ' (' + $t('Comma-separated values') + ')' }}</label>
                    <input class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="text" id="tags" name="tags" v-model="form.tags" />
                    <ul class="text-xs text-red-900">
                        <li v-for="(error, index) in errors.tags" :key="index" class="py-1 px-2">{{ error }}</li>
                    </ul>
                </div>

                <!-- Image -->
                <div class="mt-4">
                    <label for="image_url" class="block font-medium text-sm text-gray-700">{{ $t('Image') }}</label>
                    <input class="block mt-1 p-1 text-center text-sm" type="file" v-on:change="onImageChange" id="image_url" name="image_url" />
                    <ul class="text-xs text-red-900">
                        <li v-for="(error, index) in errors.image_url" :key="index" class="py-1 px-2">{{ error }}</li>
                    </ul>
                </div>

                <div class="mt-8 flex-row">
                    <button :class="{ 'opacity-25': isFormLoading }" :disabled="isFormLoading" class="ml-3 inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150" type="submit">
                        {{ $t('Update') }}
                    </button>
                    <router-link :to="{ name: 'BackendArticlesIndex' }" class="ml-3 inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                        {{ $t('Cancel') }}
                    </router-link>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            categories: [],
            article: {},
            form: {
                id: Number,
                title: "",
                content: "",
                categories: [],
                tags: "",
                image_url: "",
            },
            errors: {},
            isLoading: true,
            isFormLoading: false,
        };
    },
    async created() {
        this.isLoading = true;
        const url = "admin/articles/" + this.$route.params.id + "/edit";
        const res = await this.callApi("get", url);
        if (res.status === 200) {
            this.categories = res.data.categories;
            this.article = res.data.article;
            this.isLoading = false;
            // init data form
            this.form.id = this.article.id;
            this.form.title = this.article.title;
            this.form.content = this.article.content;
            this.article.categories.forEach((category) => {
                this.form.categories.push(category.id);
            });
            this.form.tags = this.article.tags
                .map(function (tag) {
                    return tag.name;
                })
                .join(",");
        } else {
            alert(this.$i18n.t("Get data error. Please reload page !"));
        }
    },
    methods: {
        onImageChange(e) {
            let files = e.target.files || e.dataTransfer.files;
            if (!files.length) return;
            this.createImage(files[0]);
        },
        createImage(file) {
            let reader = new FileReader();
            let vm = this;
            reader.onload = (e) => {
                vm.form.image_url = e.target.result;
            };
            reader.readAsDataURL(file);
        },
        async updateArticle() {
            this.errors = {};
            this.isFormLoading = true;
            const url = "admin/articles/" + this.$route.params.id;
            const res = await this.callApi("put", url, this.form);
            if (res.status === 200) {
                this.$router.push({ name: "BackendArticlesIndex" });
            } else if (res.status === 422) {
                this.errors = res.data.errors;
            } else {
                alert(this.$i18n.t("Post data error. Please try again !"));
            }
            this.isFormLoading = false;
        },
    },
};
</script>
