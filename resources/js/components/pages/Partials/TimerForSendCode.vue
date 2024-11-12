<template>
    <div>
        <a v-if="this.localSecond === null" href="" @click.prevent="sendCodeAgain" class="link">Отправить код повторно</a>
        <span v-if="this.localSecond !== null">Повторная отправка через {{ localSecond }} c.</span>
    </div>
</template>

<script>
export default {
    name: "TimerForSendCode",
    data() {
        return {
            second: 60,
            localSecond: null
        }
    },
    mounted() {
        this.checkTimer();
    },
    methods: {
        sendCodeAgain() {
            this.$store.dispatch('verifyModule/SEND_CODE_AGAIN');
            this.timer()
        },
        timer() {

            if (localStorage.getItem('time') === null) {
                localStorage.setItem('time', this.second);
            }

            const timer = setInterval(()=> {
                this.localSecond = localStorage.getItem('time');
                this.localSecond--
                localStorage.setItem('time', this.localSecond);

                if (this.localSecond === 0) {
                    clearInterval(timer)
                    localStorage.removeItem('time')
                    this.localSecond = null
                }
            }, 1000)
        },
        checkTimer() {
            this.localSecond = localStorage.getItem('time')
            if (this.localSecond !== null) {
                this.timer();
            }
        }
    }
}
</script>

<style scoped>

</style>
