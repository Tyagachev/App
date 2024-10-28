<template>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Подтвердите свой адрес электронной почты</div>

                    <div class="card-body">
                        <div class="alert alert-success" role="alert">
                            На ваш адрес электронной почты была отправлен проверочный код.
                        </div>
                        <div v-if="!getError">
                            Введите проверочный код из письма.
                        </div>
                        <p v-else class="text-danger">{{ getError }}</p>
                        <div class="input-group mb-3">
                            <input class="form-control mr-1" aria-describedby="button-addon1" v-model="code" placeholder="Введите проверочный код" required>
                            <button class="btn btn-outline-secondary" id="button-addon1" @click.prevent="send">Подтвердить</button>
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
            code: null
        }
    },
    mounted() {
        this.$store.dispatch('verifyModule/GET_AUTH_USER_VERIFY');
    },
    methods: {
        send() {
            this.$store.dispatch('verifyModule/SEND_VERIFY_CODE', this.code);
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
