<template>
        <div v-if="tickets.length === 0" >
            <h4>Список билетов пуст</h4>
        </div>
        <div v-else-if="tickets.length !== 0">
            <h4>Список билетов</h4>
            <Search />
        </div>
    <div class="pt-2 border-top border-black">
        <div class="card card-primary" v-for="ticket in tickets" :key="ticket.id">
            <div class="card-header">
                <h3 class="card-title">{{ ticket.title}}</h3>
            </div>
            <div v-if="user.role === 1" class="d-flex justify-content-end pt-1 pr-2">
                <div>
                    <router-link :to="{name: 'ticket.edit.page', params: {id: ticket.id}}">
                        <button class="btn btn-info">
                            Редактировать
                        </button>
                    </router-link>
                </div>
            </div>
            <div class="card-body" style="display: block;">
                <div v-html="ticket.content"></div>
                <div v-for="answer in ticket.answers" :key="answer.id">
                    <label class="toggle">
                        <input :key="answer.id"  type="checkbox" :checked="answer.picked" role="switch">
                        <span v-html="answer.answer" class="pl-2"></span>
                    </label>
                </div>
            </div>
            <div v-if="user.role === 1" class="d-flex justify-content-end pr-2 pb-1">
                <button @click="destroy(ticket.id)" class="btn btn-danger">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                        <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"/>
                    </svg>
                </button>
            </div>
            <!-- /.card-body -->
            <div class="card-footer" style="display: block;">

            </div>
            <!-- /.card-footer-->
        </div>
    </div>
</template>

<script>

import Search from "@/components/UI/Search/Search.vue";
export default {
    name: "TicketListComponent",
    components: {
        Search
    },
    mounted() {
        this.$store.dispatch('ticketModule/TICKETS_LIST');
    },
    methods: {
        destroy(id) {
            axios.delete('/api/ticket/destroy/' + id).then(response => {
                if (response.data === 'Destroy') {
                    this.$store.dispatch('ticketModule/TICKETS_LIST');
                }
            });
        }
    },
    computed: {
        tickets() {
            return this.$store.getters['ticketModule/GET_TICKETS_LIST'];
        },
        user() {
            return this.$store.getters['userModule/GET_AUTH_USER'];
        }
    }
}
</script>

<style>
 /*img{
    width: 50%;
     height: 50%;
}*/
</style>
