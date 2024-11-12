<template>
    <div class="login-page" style="min-height: 332.781px;">
        <div class="login-box">
            <AdminLogo />
            <div  v-if="getVrf !== null" class="card-body login-card-body">
                <p class="login-box-msg">Введите проверочный код из письма.</p>
                <p><span class="text-danger">{{ getError }}</span></p>
                <form>
                    <div class="input-group mb-3">
                        <input v-model="code" autofocus class="form-control text-center" placeholder="Введите код из письма" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-key-fill" viewBox="0 0 16 16">
                                    <path d="M3.5 11.5a3.5 3.5 0 1 1 3.163-5H14L15.5 8 14 9.5l-1-1-1 1-1-1-1 1-1-1-1 1H6.663a3.5 3.5 0 0 1-3.163 2M2.5 9a1 1 0 1 0 0-2 1 1 0 0 0 0 2"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center flex-column">
                        <div class="col-12">
                            <button @click.prevent="sendCode" class="btn btn-primary btn-block">Применить</button>
                        </div>
                        <TimerForSendCode />
                        <!-- /.col -->
                    </div>
                </form>
            </div>
            <div v-else class="text-center">
                Для ввода кода необходимо авторизироваться
                <router-link :to="{name: 'login.page'}">
                    Авторизация
                </router-link>
            </div>
        </div>
    </div>
</template>

<script>
import AdminLogo from "@/components/pages/Partials/AdminLogo.vue";
import TimerForSendCode from "@/components/pages/Partials/TimerForSendCode.vue";
export default {
    name: "VerifyComponent",
    components: {
        TimerForSendCode,
        AdminLogo
    },
    data() {
        return {
            code: null,

        }
    },
    mounted() {
        this.$store.dispatch('verifyModule/AUTH_USER_VERIFY');
    },
    methods: {
        sendCode() {
            this.$store.dispatch('verifyModule/SEND_VERIFY_CODE', this.code);
        },

    },
    computed: {
        getVrf() {
          return this.$store.getters['verifyModule/GET_VERIFIELD'];
        },
        getError() {
            return this.$store.getters['verifyModule/GET_ERROR'];
        }
    }
}
</script>

<style scoped>

</style>
