<template>
    <div class="container">
        <div class="d-flex justify-content-center">
            <div class="mt-3 mb-3" style="width: 200px; height: 170px;">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 261.76 226.69">
                    <path d="M161.096.001l-30.225 52.351L100.647.001H-.005l130.877 226.688L261.749.001z"
                          fill="#41b883"/>
                    <path d="M161.096.001l-30.225 52.351L100.647.001H52.346l78.526 136.01L209.398.001z"
                          fill="#34495e"/>
                </svg>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Логин</div>
                    <div class="card-body">
                        <p style="color: red">{{ message }}</p>
                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">Почта:</label>
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" v-model="email" required autocomplete="email" autofocus>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password" class="col-md-4 col-form-label text-md-end">Пароль:</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" v-model="password" required autocomplete="current-password">
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button @click.prevent="login" class="btn btn-primary">Вход</button>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

import store from "@/vuex/store.js";

export default {
    name: "LoginComponent",
    data() {
        return {
            uid: null,
            email: null,
            password: null,
            message: ''
        }
    },
    methods: {
        login() {
            axios.get('/sanctum/csrf-cookie').then(response => {
                axios.post('api/login',{
                    email: this.email,
                    password: this.password,
                }).then(res => {
                    if (res.data.message === 'Invalid Credentials') {
                        this.message = 'Invalid Credentials';
                        this.$router.push({ name:'login.page' })
                    } else {
                        localStorage.setItem('x_xsrf_token', res.config.headers['X-XSRF-TOKEN']);
                        this.$router.push({ name: 'home.page', params: { id: res.data.user.id } })
                    }
                }).catch(err => {
                    this.errors = err
                });
            });
        }
    }
}
</script>

<style scoped>

</style>
