<template>
    <p>{{ticketInfo}}</p>
</template>

<script>
export default {
    name: "TicketUpdateComponent",
    mounted() {
        this.getTicketInfo()
    },
    methods: {
        getTicketInfo() {
            this.$store.dispatch('ticketModule/TICKET_INFO_BY_ID', this.$route.params.id);
        }
    },
    computed: {
        ticketInfo() {
            return this.$store.getters['ticketModule/GET_TICKET_INFO'];
        }
    }
}
</script>

<style scoped>

</style>
