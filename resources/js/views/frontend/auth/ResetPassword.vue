<template>
    <div>
        <auth-card>
            <template v-slot:logo>
                <application-logo class="w-20 h-20 fill-current text-gray-500"></application-logo>
            </template>

            <!-- Validation Errors -->
            <auth-validation-errors class="mb-4" v-bind:errors="errors"></auth-validation-errors>

            <form method="POST" action="#">
                <!-- @csrf -->

                <!-- Password Reset Token -->
                <input type="hidden" name="token" v-model="form.token">

                <!-- Email Address -->
                <div>
                    <base-label for="email" v-bind:value="$t('Email')"></base-label>
                    <base-input id="email" class="block mt-1 w-full" type="email" name="email" v-model="form.email" required autofocus></base-input>
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <base-label for="password" v-bind:value="$t('Password')"></base-label>
                    <base-input id="password" class="block mt-1 w-full" type="password" name="password" v-model="form.password" required autocomplete="new-password"></base-input>
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <base-label for="password_confirmation" :value="$t('Confirm Password')"></base-label>
                    <base-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" v-model="form.password_confirmation" required></base-input>
                </div>

                <div class="flex items-center justify-end mt-4">
                    <base-button>
                        {{ $t('Reset Password') }}
                    </base-button>
                </div>
            </form>
        </auth-card>
    </div>
</template>

<script>
import AuthCard from "../../../components/AuthCard.vue";
import ApplicationLogo from "../../../components/ApplicationLogo.vue";
import AuthValidationErrors from "../../../components/AuthValidationErrors.vue";
import BaseButton from "../../../components/BaseButton.vue";
import BaseLabel from "../../../components/BaseLabel.vue";
import BaseInput from "../../../components/BaseInput.vue";

export default {
    data() {
        return {
            errors: {},
            form: {
                token: "",
                email: "",
                password: "",
                password_confirmation: "",
            },
        };
    },
    components: {
        AuthCard,
        ApplicationLogo,
        AuthValidationErrors,
        BaseButton,
        BaseLabel,
        BaseInput,
    },
    created() {
        this.form.token = this.$route.query.token;
    },
};
</script>
