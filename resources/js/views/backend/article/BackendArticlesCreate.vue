<template>
    <div>
        <!-- Form Create new -->
        <div class="p-4 text-3xl mr-auto">
            {{ $t('Add new article') }}
        </div>
        <div class="w-full sm:max-w-4xl mt-6 px-6 py-4 bg-white sm:rounded-lg">
            <form method="POST" action="#" enctype="multipart/form-data">
                <!-- @csrf -->

                <!-- Title -->
                <div>
                    <label for="title" class="block font-medium text-sm text-gray-700">{{ $t('Title') }}</label>
                    <input class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="text" id="title" name="title" v-model="form.title" required autofocus />
                    <div v-if="errors.title" class="text-xs text-red-900 py-1 px-2">{{ errors.title }}</div>
                </div>

                <!-- Content -->
                <div class="mt-4">
                    <label for="content" class="block font-medium text-sm text-gray-700">{{ $t('Content') }}</label>
                    <textarea rows="10" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" style="min-height: 6.725rem" id="content" name="content" v-model="form.content" required></textarea>
                    <div v-if="errors.content" class="text-xs text-red-900 py-1 px-2">{{ errors.content }}</div>
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
                    <div v-if="errors.categories" class="text-xs text-red-900 py-1 px-2">{{ errors.categories }}</div>
                </fieldset>

                <!-- Tags -->
                <div class="mt-4">
                    <label for="tags" class="block font-medium text-sm text-gray-700">{{ $t('Tags') + ' (' + $t('Comma-separated values') + ')' }}</label>
                    <input class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="text" id="tags" name="tags" v-model="form.tags" />
                    <div v-if="errors.tags" class="text-xs text-red-900 py-1 px-2">{{ errors.tags }}</div>
                </div>

                <!-- Image -->
                <div class="mt-4">
                    <label for="image_url" class="block font-medium text-sm text-gray-700">{{ $t('Image') }}</label>
                    <input class="block mt-1 p-1 text-center text-sm" type="file" v-on:change="onImageChange" id="image_url" name="image_url" />
                    <div v-if="errors.image_url" class="text-xs text-red-900 py-1 px-2">{{ errors.image_url }}</div>
                </div>

                <div class="mt-8 flex-row">
                    <button class="ml-3 inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150" type="submit">
                        {{ $t('Add') }}
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
            categories: {},
            form: {
                title: "",
                content: "",
                categories: [],
                tags: "",
                image: "",
            },
            errors: {},
        };
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
                vm.form.image = e.target.result;
            };
            reader.readAsDataURL(file);
        },
    },
};
</script>
