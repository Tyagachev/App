<template>
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <div  class="p-2">
               <!--<router-link v-if="this.token" :to="{name: 'home.page', params: {id: uid}}">Home</router-link>-->
            </div>
            <div class="p-2">
                <router-link v-if="!this.token" to="/log">Вход</router-link>
            </div>
            <div  class="p-2">
                <router-link v-if="!this.token" to="/reg">Регистрация</router-link>
            </div>
            <div v-if="this.token" class="p-2">
                <a @click.prevent="logout" href="#">Logout</a>
            </div>
        </div>
    </nav>
</template>

<script>
import axios from "axios";
import store from "@/vuex/store.js";

export default {
    name: "Links",
    data() {
        return {
            token: null,
            uid: store.state.uid
        }
    },
    mounted() {
        this.getToken();
    },
    beforeUpdate () {
        this.getToken();
    },
    methods: {
        getToken() {
            this.token = localStorage.getItem('x_xsrf_token');
        },

        logout() {
            axios.post('/logout');
            localStorage.clear();
            sessionStorage.clear();
            store.state.uid = '';
            this.$router.push({name:'login.page'});
        }
    }
}
</script>

<style scoped>

</style>
