<template>
    <div class="login-page" style="min-height: 332.781px;">
        <div class="login-box">
            <AdminLogo />
            <!-- /.login-logo -->
            <div class="card">
                <div class="card-body login-card-body">
                    <p class="login-box-msg">Вы забыли свой пароль? Здесь вы можете легко восстановить новый пароль.</p>

                    <form action="recover-password.html" method="post">
                        <div class="input-group mb-3">
                            <input type="email" class="form-control" placeholder="Email">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary btn-block">Сбросить пароль</button>
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
                <!-- /.login-card-body -->
            </div>
        </div>
    </div>
</template>

<script>
import AdminLogo from "@/components/pages/Partials/AdminLogo.vue";

export default {
    name: "ForgotPasswordComponent",
    components: {AdminLogo}
}
</script>

<style scoped>

</style>
