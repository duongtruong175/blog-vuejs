<template>
    <div>
        <!-- Form edit -->
        <div class="p-4 text-3xl mr-auto">
            {{ $t('Edit user') }}
        </div>
        <!-- Loading component -->
        <div v-if="isLoading" class="relative w-full h-96">
            <loading :active.sync="isLoading" :is-full-page="false" :height="40" :width="40" :color="'#007BFF'" :loader="'dots'"></loading>
        </div>
        <div v-if="!isLoading" class="w-full sm:max-w-4xl mt-6 px-6 py-4 bg-white sm:rounded-lg">
            <form @submit.prevent="updateUser">
                <!-- ID -->
                <div>
                    <label for="id" class="block font-medium text-sm text-gray-700">{{ $t('ID') }}</label>
                    <input class="block mt-1 w-full rounded-md shadow-sm bg-gray-300 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="text" id="id" name="id" v-model="form.id" required readonly />
                </div>

                <!-- Name -->
                <div class="mt-4">
                    <label for="name" class="block font-medium text-sm text-gray-700">{{ $t('Name') }}</label>
                    <input class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="text" id="name" name="name" v-model="form.name" required autofocus />
                    <ul class="text-xs text-red-900">
                        <li v-for="(error, index) in errors.name" :key="index" class="py-1 px-2">{{ error }}</li>
                    </ul>
                </div>

                <div class="mt-8 flex-row">
                    <button :class="{ 'opacity-25': isFormLoading }" :disabled="isFormLoading" class="ml-3 inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150" type="submit">
                        {{ $t('Update') }}
                    </button>
                    <router-link :to="{ name: 'BackendUsersIndex' }" class="ml-3 inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
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
            user: {},
            form: {
                id: Number,
                name: "",
            },
            errors: {},
            isLoading: true,
            isFormLoading: false,
        };
    },
    async created() {
        this.isLoading = true;
        const url = "admin/users/" + this.$route.params.id + "/edit";
        const res = await this.callApi("get", url);
        if (res.status === 200) {
            this.user = res.data.user;
            this.isLoading = false;
            // init data form
            this.form.id = this.user.id;
            this.form.name = this.user.name;
        } else {
            alert("Get data error. Please reload page !");
        }
    },
    methods: {
        async updateUser() {
            this.errors = {};
            this.isFormLoading = true;
            const url = "admin/users/" + this.$route.params.id;
            const res = await this.callApi("put", url, this.form);
            if (res.status === 200) {
                this.$router.push({ name: "BackendUsersIndex" });
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
