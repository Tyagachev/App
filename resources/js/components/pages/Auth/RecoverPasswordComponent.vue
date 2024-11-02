<template>
    <div class="login-page" style="min-height: 398px;">
        <div class="login-box">
            <div class="card card-outline card-primary">
                <div class="card-header text-center">
                    <AdminLogo />
                </div>
                <div class="card-body">
                    <p class="login-box-msg">Вы находитесь всего в одном шаге от получения нового пароля, восстановите его прямо сейчас.</p>
                    <form>
                        <div class="input-group mb-3">
                            <input v-model="password" type="password" class="form-control" required placeholder="Пароль">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input v-model="password_confirmation" type="password" class="form-control" required placeholder="Подтверждение пароля">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <button @click.prevent="sendNewPassword" type="submit" class="btn btn-primary btn-block">Сменить пароль</button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>

                    <p class="mt-3 mb-1">
                        <router-link :to="{name: 'login.page'}">
                            Вход
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
    name: "RecoverPasswordComponent",
    components: {
        AdminLogo
    },
    data() {
        return {
            password: null,
            password_confirmation: null
        }
    },
    mounted() {
    },
    methods: {
        sendNewPassword() {
            //
        }
    }
}
</script>

<style scoped>

</style>
