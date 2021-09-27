<template>
    <div>
        <!-- Header + Create new -->
        <div class="mb-8 flex items-center">
            <div class="p-4 text-3xl mr-auto">
                {{ $t('Category list') }}
            </div>
            <router-link class="flex items-center mr-4 p-2 bg-green-500 hover:bg-green-900 rounded" :to="{ name: 'BackendCategoriesCreate' }">
                <span class="inline-block">
                    <add-icon class="h-4 w-4 text-white"></add-icon>
                </span>
                <span class="text-sm pl-1 text-white">{{ $t('Create New') }}</span>
            </router-link>
        </div>
        <!-- Loading component -->
        <div v-if="isLoading" class="relative w-full h-96">
            <loading :active.sync="isLoading" :is-full-page="false" :height="40" :width="40" :color="'#007BFF'" :loader="'dots'"></loading>
        </div>
        <div v-if="!isLoading" class="shadow mx-0">
            <div class="py-8">
                <div class="container px-4 mx-auto">
                    <!-- Paginate -->
                    <div class="flex justify-end pb-4">
                        <div class="w-auto mr-4 flex items-center">
                            <p class="mr-3 text-sm">{{ $t('Rows')}}</p>
                            <div class="flex bg-white border border-gray-100 rounded">
                                <select class="text-sm border-0 w-full" name="paginate" id="paginate">
                                    <option v-for="(length, index) in paginateOptions" :key="index" :value="length">{{ length }}</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Data table -->
                    <div class="px-4 py-4 overflow-x-auto">
                        <table class="table-auto w-full text-center text-sm">
                            <thead>
                                <tr>
                                    <th class="border px-2 py-2">{{ $t('ID') }}</th>
                                    <th class="border px-2 py-2">{{ $t('Name') }}</th>
                                    <th class="border px-2 py-2">{{ $t('Created at') }}</th>
                                    <th class="border px-2 py-2">{{ $t('Updated at') }}</th>
                                    <th class="border px-2 py-2">{{ $t('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(category, index) in categories" :key="index">
                                    <td class="border px-2 py-2">{{ category.id }}</td>
                                    <td class="border px-2 py-2">{{ category.name }}</td>
                                    <td class="border px-2 py-2">{{ formatDateTime(category.created_at) }}</td>
                                    <td class="border px-2 py-2">{{ formatDateTime(category.updated_at) }}</td>
                                    <td class="border px-2 py-2">
                                        <div class="flex justify-center items-center">
                                            <div class="inline-block mx-1 p-1 rounded bg-green-500 hover:bg-green-800">
                                                <router-link class="flex items-center" :to="{ name: 'BackendCategoriesEdit', params: { id: category.id } }">
                                                    <span class="inline-block">
                                                        <edit-icon class="h-4 w-4 text-white"></edit-icon>
                                                    </span>
                                                </router-link>
                                            </div>
                                            <div class="inline-block mx-1 p-1 rounded bg-red-500 hover:bg-red-800">
                                                <form @submit.prevent="deleteCategory(category.id, index)">
                                                    <button class="flex items-center" type="submit">
                                                        <span class="inline-block">
                                                            <delete-icon class="h-4 w-4 text-white"></delete-icon>
                                                        </span>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr v-if="typeof categories === 'undefined' || categories.length === 0" class="text-lg text-red-500 mb-4">
                                    {{ $t('No data yet') }}
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Paging Bar -->
                    <!-- <div class="pt-4">
                        {{ $articles->onEachSide(1)->appends(request()->except('page'))->links() }}
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import AddIcon from "../../../components/AddIcon.vue";
import DeleteIcon from "../../../components/DeleteIcon.vue";
import EditIcon from "../../../components/EditIcon.vue";

export default {
    components: {
        AddIcon,
        DeleteIcon,
        EditIcon,
    },
    data() {
        return {
            paginateOptions: [5, 10, 20, 50],
            categories: [],
            isLoading: true,
        };
    },
    async created() {
        this.isLoading = true;
        const url = "admin/categories";
        const res = await this.callApi("get", url);
        if (res.status === 200) {
            this.categories = res.data.categories.data;
            this.isLoading = false;
        } else {
            alert("Get data error. Please reload page !");
        }
    },
    methods: {
        async deleteCategory(category_id, index) {
            if (confirm("Are you sure delete it and its relationships?")) {
                const url = "admin/categories/" + category_id;
                const res = await this.callApi("delete", url);
                if (res.status === 200) {
                    this.categories.splice(index, 1);
                } else {
                    alert("Delete data error. Please try again !");
                }
            }
        },
    },
};
</script>
