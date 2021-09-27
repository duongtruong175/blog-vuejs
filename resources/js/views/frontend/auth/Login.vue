<template>
    <div>
        <auth-card>
            <template v-slot:logo>
                <application-logo class="w-20 h-20 fill-current text-gray-500"></application-logo>
            </template>

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
                    <router-link class="underline text-sm text-gray-600 hover:text-gray-900" :to="{ name: 'ForgotPassword' }">
                        {{ $t('Forgot your password?') }}
                    </router-link>

                    <base-button class="ml-3">
                        {{ $t('Log In') }}
                    </base-button>
                </div>
            </form>
        </auth-card>
    </div>
</template>

<script>
import AuthCard from "../../../components/AuthCard.vue";
import ApplicationLogo from "../../../components/ApplicationLogo.vue";
import AuthSessionStatus from "../../../components/AuthSessionStatus.vue";
import AuthValidationErrors from "../../../components/AuthValidationErrors.vue";
import BaseButton from "../../../components/BaseButton.vue";
import BaseLabel from "../../../components/BaseLabel.vue";
import BaseInput from "../../../components/BaseInput.vue";

export default {
    components: {
        AuthCard,
        ApplicationLogo,
        AuthSessionStatus,
        AuthValidationErrors,
        BaseButton,
        BaseLabel,
        BaseInput,
    },
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
};
</script>
