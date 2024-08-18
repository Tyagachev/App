<template>
    <h1>Home page: {{ user.name }}</h1>
</template>

<script>
import axios from "axios";
export default {
    name: "Home",
    data() {
        return {
            user: {}
        }
    },
    mounted() {
        this.test();
    },
    methods: {
        test() {
            axios.get('/api/test/' + this.$route.params.id ).then(res => {
                this.user = res.data;
            })
        }
    }
}
</script>

<style scoped>

</style>
