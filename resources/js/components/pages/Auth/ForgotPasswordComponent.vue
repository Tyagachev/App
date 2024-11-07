<template>
    <div class="login-page" style="min-height: 332.781px;">
        <div class="login-box">
            <AdminLogo />
            <!-- /.login-logo -->
            <div class="card">
                <div v-if="visibleInputEmail" class="card-body login-card-body">
                    <p class="login-box-msg">Вы забыли свой пароль? Здесь вы можете легко восстановить новый пароль.</p>
                    <p><span class="text-danger">{{emailNotFound}}</span></p>
                    <div v-for="error in errors.email">
                        <p><span class="text-danger">{{error}}</span></p>
                    </div>
                    <form>
                        <div class="input-group mb-3">
                            <input v-model="form.email" type="email" autocomplete="email" autofocus class="form-control" placeholder="Email">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <button @click.prevent="sendEmail" type="submit" class="btn btn-primary btn-block">Сбросить пароль</button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>
                    <p class="mt-3 mb-1">
                        <router-link :to="{name: 'login.page'}">
                            У меня есть аккаунт
                        </router-link>
                    </p>
                    <p class="mb-0">
                        <router-link :to="{name: 'register.page'}">
                            Зарегистрироваться
                        </router-link>
                    </p>
                </div>
                <div v-if="visibleInputCode" class="card-body login-card-body">
                    <p class="login-box-msg">Введите проверочный код из письма.</p>
                        <p><span class="text-danger">{{codeIsWrong}}</span></p>
                    <form>
                        <div class="input-group mb-3">
                            <input v-model="code" type="number" autofocus class="form-control text-center" placeholder="Введите код из письма">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-key-fill" viewBox="0 0 16 16">
                                        <path d="M3.5 11.5a3.5 3.5 0 1 1 3.163-5H14L15.5 8 14 9.5l-1-1-1 1-1-1-1 1-1-1-1 1H6.663a3.5 3.5 0 0 1-3.163 2M2.5 9a1 1 0 1 0 0-2 1 1 0 0 0 0 2"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <button @click.prevent="sendCode" class="btn btn-primary btn-block">Отправить</button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>
                </div>
                <div v-if="visibleChangePassword">
                    <div class="card-body login-card-body">
                        <p class="login-box-msg">Введите новый пароль.</p>
                        <div v-if="success != null" class="p-1 mb-1 bg-success">
                            <p class="text text-center">{{ success }}</p>
                        </div>
                        <div>
                            <p class="text-success">{{ success }}</p>
                        </div>
                        <form>
                            <div v-for="error in errors">
                                <span class="text-danger">{{ error[0] }}</span>
                            </div>

                            <div class="input-group mb-3">
                                <input v-model="form.password" required autocomplete="password" autofocus type="password" class="form-control" placeholder="Пароль">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <input v-model="form.password_confirmation" required autocomplete="password" autofocus type="password" class="form-control" placeholder="Подтверждение пароля">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <!-- /.col -->
                                <div class="col-12">
                                    <button @click.prevent="changePassword" type="submit" :disabled="success != null" class="btn btn-primary btn-block">Сохранить</button>
                                </div>
                                <!-- /.col -->
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.login-card-body -->
            </div>
        </div>
    </div>
</template>

<script>
import AdminLogo from "@/components/pages/Partials/AdminLogo.vue";

export default {
    name: "ForgotPasswordComponent",
    components: {
        AdminLogo
    },
    data() {
        return {
            form: {
                email: null,
                password: null,
                password_confirmation: null
            },
            emailNotFound: '',
            code: null,
            codeIsWrong: '',
            visibleInputEmail: true,
            visibleInputCode: false,
            visibleChangePassword: false,
            errors: {},
            success: null,
            codeErrors: []
        }
    },
    methods: {
        sendEmail() {
            axios.post('/api/recovery-password', {
                email: this.form.email
            }).then(response => {
                if (response.status === 201) {
                    this.$store.dispatch('RECOVERY_MAIL', response.data);
                    this.visibleInputEmail = false;
                    this.visibleInputCode = true;
                    this.form.email = null;
                }
            }).catch(error => {
                if (error.response.status === 404) {
                    this.emailNotFound = error.response.data
                } else if(error.response.data.errors) {
                    this.errors = error.response.data.errors
                }
            });
        },
        sendCode() {
            axios.post('/api/recovery-check', {
                number: this.code,
                email: this.getRecoverEmail
            }).then(response => {
                if (response.status === 200) {
                    this.visibleInputCode = false;
                    this.visibleChangePassword = true;
                }
            }).catch(error => {
                if (error.response) {
                    this.codeIsWrong = 'Код неверный!'
                }
            });
        },
        changePassword() {
            axios.post('/api/reset-password',{
                email: this.getRecoverEmail,
                password: this.form.password,
                password_confirmation: this.form.password_confirmation
            }).then(response => {
                if (response.status === 201) {
                    this.success = 'Пароль успешно изменен';
                    if (this.errors) {
                        this.errors = {};
                    }
                    setTimeout(() => {
                        this.redirectToLogin();
                    },2000)
                }
            }).catch(error => {
                this.errors = error.response.data.errors;
            });
        },
        redirectToLogin() {
            this.$router.push('/log');
        }
    },
    computed: {
        getRecoverEmail() {
            return this.$store.getters['GET_RECOVERY_MAIL'];
        }
    }

    }
</script>

<style scoped>

</style>
