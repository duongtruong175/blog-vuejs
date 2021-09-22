<template>
    <div>
        <auth-card>
            <template v-slot:logo>
                <application-logo class="w-20 h-20 fill-current text-gray-500"></application-logo>
            </template>

            <div class="mb-4 text-sm text-gray-600">
                {{ $t('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
            </div>

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

                <div class="flex items-center justify-end mt-4">
                    <base-button>
                        {{ $t('Email Password Reset Link') }}
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
    data() {
        return {
            status: "",
            errors: {},
            form: {
                email: "",
            },
        };
    },
    components: {
        AuthCard,
        ApplicationLogo,
        AuthSessionStatus,
        AuthValidationErrors,
        BaseButton,
        BaseLabel,
        BaseInput,
    },
};
</script>
