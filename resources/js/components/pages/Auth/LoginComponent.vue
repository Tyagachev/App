<template>
    <div class="login-page" style="min-height: 496.781px;">
        <div class="login-box">
            <AdminLogo />
            <!-- /.login-logo -->
            <div class="card">
                <div class="card-body login-card-body">
                    <p class="login-box-msg">Вход в систему</p>
                    <p style="color: red">{{ message }}</p>
                    <form>
                        <span class="text-danger" v-if="errors.email">{{ errors.email[0] }}</span>
                        <div class="input-group mb-3">
                            <input v-model="email" required autocomplete="email" autofocus type="email" class="form-control" placeholder="Email">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        <span class="text-danger" v-if="errors.password">{{ errors.password[0] }}</span>
                        <div class="input-group mb-3">
                            <input v-model="password" required autocomplete="password" autofocus type="password" class="form-control" placeholder="Пароль">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!-- /.col -->
                            <div class="col-4">
                                <button @click.prevent="login" type="submit" class="btn btn-primary btn-block">Вход</button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>
                    <!-- /.social-auth-links -->

                    <p class="mb-1">
                        <router-link :to="{name: 'forgot.page'}">
                            Я забыл свой пароль
                        </router-link>
                    </p>
                    <p class="mb-0">
                        <router-link :to="{name: 'register.page'}">
                            Зарегистрироваться
                        </router-link>
                    </p>
                </div>
                <!-- /.login-card-body -->
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import AdminLogo from "@/components/pages/Partials/AdminLogo.vue";
export default {
    name: "LoginComponent",
    components: {AdminLogo},
    data() {
        return {
            uid: null,
            email: null,
            password: null,
            message: '',
            errors: {},
        }
    },
    mounted() {
        this.$store.dispatch('authModule/AUTH_CHECK');
    },
    methods: {
        login() {
            axios.post('/api/login', {email: this.email, password: this.password}).then(response => {
                this.message = response.data.message
                if (response.data.status === 200) {
                    localStorage.setItem('x_xsrf_token', response.config.headers['X-CSRF-TOKEN']);
                    if (response.data.user.verified === 0) {
                        window.location.replace('/verify')
                    } else {
                        window.location.replace('/admin')
                    }
                }
            }).catch(error => {
                this.errors = error.response.data.errors;
            });
        }
    }
}
</script>

<style scoped>

</style>
