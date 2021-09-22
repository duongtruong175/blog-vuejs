<template>
    <div>
        <auth-card>
            <template v-slot:logo>
                <application-logo class="w-20 h-20 fill-current text-gray-500"></application-logo>
            </template>

            <div class="mb-4 text-sm text-gray-600">
                {{ $t('This is a secure area of the application. Please confirm your password before continuing.') }}
            </div>

            <!-- Validation Errors -->
            <auth-validation-errors class="mb-4" v-bind:errors="errors"></auth-validation-errors>

            <form method="POST" action="#">
                <!-- @csrf -->

                <!-- Password -->
                <div>
                    <base-label for="password" v-bind:value="$t('Password')"></base-label>
                    <base-input id="password" class="block mt-1 w-full" type="password" name="password" v-model="form.password" required autocomplete="current-password"></base-input>
                </div>

                <div class="flex justify-end mt-4">
                    <base-button>
                        {{ $t('Confirm') }}
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
                password: "",
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
};
</script>
