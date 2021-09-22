<template>
    <div v-if="hasErrors">
        <div class="font-medium text-red-600">
            {{ $t('Whoops! Something went wrong.') }}
        </div>

        <ul class="mt-3 list-disc list-inside text-sm text-red-600">
            <li v-for="(error, index) in errors" :key="index">
                {{ $error }}
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    props: ["errors"],
    computed: {
        hasErrors() {
            return Object.keys(this.errors).length > 0;
        },
    },
};
</script>
