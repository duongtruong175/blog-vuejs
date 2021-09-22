<template>
    <div>
        <div class="min-h-screen">
            <!-- Form admin login -->
            <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
                <div class="flex items-center text-center">
                    <application-logo class="w-20 h-20 fill-current text-gray-500"></application-logo>
                    <span class="ml-4 text-2xl">{{ $t('Admin Blog') }}</span>
                </div>

                <div class="w-full sm:mx-2 sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                    <!-- Session Status -->
                    <auth-session-status class="mb-4" v-bind:status="status"></auth-session-status>

                    <!-- Validation Errors -->
                    <auth-validation-errors class="mb-4" v-bind:errors="errors"></auth-validation-errors>

                    <form method="POST" action="#">
                        <!-- @csrf -->

                        <!-- Email Address -->
                        <div>
                            <base-label for="email" v-bind:value="$t('Email')"></base-label>
                            <base-input id="email" class="block mt-1 w-full" type="email" name="email" v-model="form.email" required autofocus></base-input>
                        </div>

                        <!-- Password -->
                        <div class="mt-4">
                            <base-label for="password" v-bind:value="$t('Password')"></base-label>
                            <base-input id="password" class="block mt-1 w-full" type="password" name="password" v-model="form.password" required autocomplete="current-password"></base-input>
                        </div>

                        <!-- Remember Me -->
                        <div class="block mt-4">
                            <label for="remember_me" class="inline-flex items-center">
                                <input id="remember_me" type="checkbox" v-model="form.remember" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                                <span class="ml-2 text-sm text-gray-600">{{ $t('Remember me') }}</span>
                            </label>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <base-button class="ml-3">
                                {{ $t('Log In') }}
                            </base-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="mx-auto bg-gray-300 h-24 flex">
            <div class="text-center m-auto">
                <p class="text-sm">Copyright © 2021 - 2022 - Tailwind CSS. All Rights Reserved</p>
            </div>
        </footer>
    </div>
</template>

<script>
import ApplicationLogo from "../../../components/ApplicationLogo.vue";
import AuthSessionStatus from "../../../components/AuthSessionStatus.vue";
import AuthValidationErrors from "../../../components/AuthValidationErrors.vue";
import BaseButton from "../../../components/BaseButton.vue";
import BaseLabel from "../../../components/BaseLabel.vue";
import BaseInput from "../../../components/BaseInput.vue";

export default {
    data() {
        return {
            status: "",
            errors: {},
            form: {
                email: "",
                password: "",
                remember: false,
            },
        };
    },
    components: {
        ApplicationLogo,
        AuthSessionStatus,
        AuthValidationErrors,
        BaseButton,
        BaseLabel,
        BaseInput,
    },
};
</script>
