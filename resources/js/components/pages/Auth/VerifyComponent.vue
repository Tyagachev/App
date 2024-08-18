<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Подтвердите свой адрес электронной почты</div>

                    <div class="card-body">
                        <div class="alert alert-success" role="alert">
                            На ваш адрес электронной почты была отправлен проверочный код.
                        </div>
                        Введите проверочный код из письма.
                        <input v-model="number" placeholder="Введите проверочный код">
                        <button @click.prevent="check">Подтвердить</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
export default {
    name: "VerifyComponent",
    data() {
        return {
            number: null,
            uid: localStorage.getItem('uid'),
        }
    },
    methods: {
        check() {
            axios.post('/api/confirm-verify', {
                number: this.number
            }).then(res => {
                if (Number(this.uid) === res.data.userId && res.data.verified) {
                    this.$router.push({ name: 'home.page', params: { id: this.uid } })
                } else {
                    this.$router.go(-1);
                }
            })
        }
    }
}
</script>

<style scoped>

</style>
