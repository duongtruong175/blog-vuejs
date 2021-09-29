<template>
    <div>
        <!-- Form Create new -->
        <div class="p-4 text-3xl mr-auto">
            {{ $t('Add new user') }}
        </div>
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white sm:rounded-lg">
            <form @submit.prevent="addUser">
                <!-- Name -->
                <div>
                    <label for="name" class="block font-medium text-sm text-gray-700">{{ $t('Name') }}</label>
                    <input class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="text" id="name" name="name" v-model="form.name" required autofocus />
                    <ul class="text-xs text-red-900">
                        <li v-for="(error, index) in errors.name" :key="index" class="py-1 px-2">{{ error }}</li>
                    </ul>
                </div>

                <!-- Email -->
                <div class="mt-4">
                    <label for="email" class="block font-medium text-sm text-gray-700">{{ $t('Email') }}</label>
                    <input class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="email" id="email" name="email" v-model="form.email" required />
                    <ul class="text-xs text-red-900">
                        <li v-for="(error, index) in errors.email" :key="index" class="py-1 px-2">{{ error }}</li>
                    </ul>
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <label for="password" class="block font-medium text-sm text-gray-700">{{ $t('Password') }}</label>
                    <input class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="password" id="password" name="password" v-model="form.password" required />
                    <ul class="text-xs text-red-900">
                        <li v-for="(error, index) in errors.password" :key="index" class="py-1 px-2">{{ error }}</li>
                    </ul>
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <label for="password_confirmation" class="block font-medium text-sm text-gray-700">{{ $t('Confirm Password') }}</label>
                    <input class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="password" id="password_confirmation" name="password_confirmation" v-model="form.password_confirmation" required />
                </div>

                <div class="mt-8 flex-row">
                    <button :class="{ 'opacity-25': isFormLoading }" :disabled="isFormLoading" class="ml-3 inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150" type="submit">
                        {{ $t('Add') }}
                    </button>
                    <router-link :to="{ name: 'BackendCategoriesIndex' }" class="ml-3 inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
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
            form: {
                name: "",
                email: "",
                password: "",
                password_confirmation: "",
            },
            errors: {},
            isFormLoading: false,
        };
    },
    methods: {
        async addUser() {
            this.errors = {};
            this.isFormLoading = true;
            const url = "admin/users";
            const res = await this.callApi("post", url, this.form);
            if (res.status === 201) {
                this.$router.push({ name: "BackendUsersIndex" });
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
