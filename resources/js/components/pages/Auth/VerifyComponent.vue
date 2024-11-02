<template>
    <div class="login-page" style="min-height: 496.781px;">
    <div class="container">
            <div class="row justify-content-center mt-5">
                <div class="col-md-8">
                    <div class="card card-primary">
                        <div class="card-header text-center">Подтвердите свой адрес электронной почты</div>
                        <div class="card-body">
                            <div class="d-flex justify-content-center flex-column align-items-center">
                                <div v-if="!getError">
                                    <p>Введите проверочный код из письма.</p>
                                </div>
                                <div v-else>
                                    <p class="text-danger">{{ getError }}</p>
                                </div>
                                <div class="input-group mb-3 w-50">
                                    <input  class="form-control mr-1 text-center text-bold" aria-describedby="button-addon1" v-model="code" placeholder="Введите проверочный код" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    name: "VerifyComponent",
    data() {
        return {
            code: null,
        }
    },
    mounted() {
        this.$store.dispatch('verifyModule/AUTH_USER_VERIFY');
    },
    methods: {
        send(code) {
            if (code.length >= 6) {
                this.$store.dispatch('verifyModule/SEND_VERIFY_CODE', this.code);
            }
        }
    },
    watch:{
        code(code) {
            this.code = code
            this.send(code);
        }
    },
    computed: {
        getError() {
            return this.$store.getters['verifyModule/GET_ERROR'];
        }
    }
}
</script>

<style scoped>

</style>
