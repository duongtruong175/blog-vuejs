<template>
    <div>
        <auth-card>
            <template v-slot:logo>
                <application-logo class="w-20 h-20 fill-current text-gray-500"></application-logo>
            </template>

            <div class="mb-4 text-sm text-gray-600">
                {{ $t('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
            </div>

            <div class="mb-4 font-medium text-sm text-green-600" v-if="verificationLinkSent">
                {{ $t('A new verification link has been sent to the email address you provided during registration.') }}
            </div>

            <div class="mt-4 flex items-center justify-between">
                <form method="POST" action="#">
                    <!-- @csrf -->

                    <div>
                        <base-button>
                            {{ $t('Resend Verification Email') }}
                        </base-button>
                    </div>
                </form>

                <form method="POST" action="#">
                    <!-- @csrf -->

                    <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900">
                        {{ $t('Log Out') }}
                    </button>
                </form>
            </div>
        </auth-card>
    </div>
</template>

<script>
import AuthCard from "../../../components/AuthCard.vue";
import ApplicationLogo from "../../../components/ApplicationLogo.vue";
import BaseButton from "../../../components/BaseButton.vue";

export default {
    props: ["status"],
    components: {
        AuthCard,
        ApplicationLogo,
        BaseButton,
    },
    computed: {
        verificationLinkSent() {
            return this.status === "verification-link-sent";
        },
    },
};
</script>
