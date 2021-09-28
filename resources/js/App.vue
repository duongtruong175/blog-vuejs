<template>
    <div>
        <router-view></router-view>
    </div>
</template>

<script>
export default {
    async created() {
        await this.$store.dispatch("loadUser");
    },
    watch: {
        $route: {
            immediate: true,
            handler(to, from) {
                if (to.path.includes("admin")) {
                    document.title =
                        this.$i18n.t("Admin") +
                        " | " +
                        this.$i18n.t(to.meta.title);
                } else {
                    document.title = this.$i18n.t(to.meta.title);
                }
            },
        },
    },
};
</script>
