<template>
    <div class="register-page" style="min-height: 570.781px;">
        <div class="register-box">
            <AdminLogo />
            <div class="card">
                <div class="card-body register-card-body">
                    <p class="login-box-msg">Регистрация</p>

                    <form>
                        <div v-for="error in errors.name">
                            <span class="text-danger">{{ error }}</span>
                        </div>
                        <div class="input-group mb-3">
                            <input id="name" type="text" class="form-control" v-model="name" placeholder="Имя">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                        </div>
                        <div v-for="error in errors.email">
                            <span class="text-danger">{{ error }}</span>
                        </div>
                        <div class="input-group mb-3">
                            <input id="email" type="email" class="form-control" v-model="email" required autocomplete="email" placeholder="Email">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        <div v-for="error in errors.password">
                            <span class="text-danger">{{ error }}</span>
                        </div>
                        <div class="input-group mb-3">
                            <input id="password" type="password" class="form-control" v-model="password" required autocomplete="current-password" placeholder="Пароль">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <div v-for="error in errors.password">
                            <span class="text-danger">{{ error }}</span>
                        </div>
                        <div class="input-group mb-3">
                            <input id="password_confirmation" type="password" class="form-control" v-model="password_confirmation" required autocomplete="current-password"  placeholder="Подтверждение пароля">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!-- /.col -->
                            <div class="col-12">
                                <button @click.prevent="registration" class="btn btn-primary btn-block">Регистрация</button>
                            </div>
                            <!-- /.col -->
                        </div>

                    </form>
                    <router-link :to="{name: 'login.page'}">
                        У меня есть аккаунт
                    </router-link>
                </div>
                <!-- /.form-box -->
            </div><!-- /.card -->
        </div>
    </div>
</template>

<script>
import AdminLogo from '../Partials/AdminLogo.vue'
export default {
    name: 'RegisterComponent',
    components: {
        AdminLogo
    },
    data() {
        return {
            name: null,
            email: null,
            password: null,
            password_confirmation: null,
            errors: {}
        }
    },
    mounted() {
        this.$store.dispatch('authModule/AUTH_CHECK');
    },
    methods: {
        registration() {
            axios.post('/api/register',{
                name: this.name,
                email: this.email,
                password: this.password,
                password_confirmation: this.password_confirmation
            }).then(response => {
                if (response.status === 200) {
                    localStorage.setItem('x_xsrf_token', response.config.headers['X-CSRF-TOKEN']);
                    localStorage.setItem('uid', response.data.user.id);
                    this.$router.push({ name:'verify.page' });
                    //this.$router.push({ name: 'home.page', params: { id: res.data.user.id } })
                }
            }).catch(error => {
                this.errors = error.response.data.errors;
            });
        }
    }
}
</script>
