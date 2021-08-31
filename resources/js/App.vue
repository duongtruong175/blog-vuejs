<template>
    <h1 class="font-medium text-2xl">This is first components</h1>
</template>

<script>
export default {
    data() {
        return {
            locale: "en",
        };
    },
    watch: {
        // watch locale variable change
        locale(val) {
            this.$i18n.locale = val;
        },
    },
};
</script>

<style>
</style>
