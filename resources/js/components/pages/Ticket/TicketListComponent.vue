<template>
        <div v-if="tickets.length === 0" >
            <h4>Список билетов пуст</h4>
        </div>
        <div v-else-if="tickets.length !== 0">
            <h4>Список билетов</h4>
        </div>
        <div>
            <span style="color: #687;">Поиск по заголовку билета</span>
        </div>
    <Search />
    <div class="pt-2 border-top border-black">
        <router-link :to="{name: 'ticket.create.page'}">
            <button class="btn btn-success mb-3" >
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-plus-circle-dotted" viewBox="0 0 20 20">
                    <path d="M8 0q-.264 0-.523.017l.064.998a7 7 0 0 1 .918 0l.064-.998A8 8 0 0 0 8 0M6.44.152q-.52.104-1.012.27l.321.948q.43-.147.884-.237L6.44.153zm4.132.271a8 8 0 0 0-1.011-.27l-.194.98q.453.09.884.237zm1.873.925a8 8 0 0 0-.906-.524l-.443.896q.413.205.793.459zM4.46.824q-.471.233-.905.524l.556.83a7 7 0 0 1 .793-.458zM2.725 1.985q-.394.346-.74.74l.752.66q.303-.345.648-.648zm11.29.74a8 8 0 0 0-.74-.74l-.66.752q.346.303.648.648zm1.161 1.735a8 8 0 0 0-.524-.905l-.83.556q.254.38.458.793l.896-.443zM1.348 3.555q-.292.433-.524.906l.896.443q.205-.413.459-.793zM.423 5.428a8 8 0 0 0-.27 1.011l.98.194q.09-.453.237-.884zM15.848 6.44a8 8 0 0 0-.27-1.012l-.948.321q.147.43.237.884zM.017 7.477a8 8 0 0 0 0 1.046l.998-.064a7 7 0 0 1 0-.918zM16 8a8 8 0 0 0-.017-.523l-.998.064a7 7 0 0 1 0 .918l.998.064A8 8 0 0 0 16 8M.152 9.56q.104.52.27 1.012l.948-.321a7 7 0 0 1-.237-.884l-.98.194zm15.425 1.012q.168-.493.27-1.011l-.98-.194q-.09.453-.237.884zM.824 11.54a8 8 0 0 0 .524.905l.83-.556a7 7 0 0 1-.458-.793zm13.828.905q.292-.434.524-.906l-.896-.443q-.205.413-.459.793zm-12.667.83q.346.394.74.74l.66-.752a7 7 0 0 1-.648-.648zm11.29.74q.394-.346.74-.74l-.752-.66q-.302.346-.648.648zm-1.735 1.161q.471-.233.905-.524l-.556-.83a7 7 0 0 1-.793.458zm-7.985-.524q.434.292.906.524l.443-.896a7 7 0 0 1-.793-.459zm1.873.925q.493.168 1.011.27l.194-.98a7 7 0 0 1-.884-.237zm4.132.271a8 8 0 0 0 1.012-.27l-.321-.948a7 7 0 0 1-.884.237l.194.98zm-2.083.135a8 8 0 0 0 1.046 0l-.064-.998a7 7 0 0 1-.918 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z"/>
                </svg>
                Добавить билет
            </button>
        </router-link>
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
                    <input :key="answer.id"  type="checkbox" :checked="answer.picked" role="switch">
                    <span v-html="answer.answer" class="pl-2"></span>
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
            return this.$store.getters['ticketModule/GET_TICKETS_LIST']
                .filter(item => item.title.indexOf(this.$store.state.search) !== -1);
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
