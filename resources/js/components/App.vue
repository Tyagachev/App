<template>
    <div>
        <router-view></router-view>
    </div>
</template>
<script>

import PageLayout from "@/components/Layouts/PageLayout.vue";

export default {
    name: "App",
    data() {
        return {
            token: null,
        }
    },
    mounted() {
        this.getToken();
    },
    methods: {
        getToken() {
            this.token = localStorage.getItem('x_xsrf_token');
        },
    }
}
</script>

<style scoped>

</style>
