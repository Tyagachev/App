<template>
        <div>
            <span style="color: #687;">Поиск по заголовку билета</span>
        </div>
    <Search />
    <div v-if="tickets.length === 0" >
        <h4>Список билетов пуст</h4>
    </div>
    <div v-else-if="tickets.length !== 0">
        <h5>Кол-во билетов: {{tickets.length}}</h5>
    </div>
    <div class="pt-2 border-top border-black">
        <router-link :to="{name: 'ticket.create.page'}">
            <button class="btn btn-info mb-3" >
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-plus-circle-dotted" viewBox="0 0 20 20">
                    <path d="M8 0q-.264 0-.523.017l.064.998a7 7 0 0 1 .918 0l.064-.998A8 8 0 0 0 8 0M6.44.152q-.52.104-1.012.27l.321.948q.43-.147.884-.237L6.44.153zm4.132.271a8 8 0 0 0-1.011-.27l-.194.98q.453.09.884.237zm1.873.925a8 8 0 0 0-.906-.524l-.443.896q.413.205.793.459zM4.46.824q-.471.233-.905.524l.556.83a7 7 0 0 1 .793-.458zM2.725 1.985q-.394.346-.74.74l.752.66q.303-.345.648-.648zm11.29.74a8 8 0 0 0-.74-.74l-.66.752q.346.303.648.648zm1.161 1.735a8 8 0 0 0-.524-.905l-.83.556q.254.38.458.793l.896-.443zM1.348 3.555q-.292.433-.524.906l.896.443q.205-.413.459-.793zM.423 5.428a8 8 0 0 0-.27 1.011l.98.194q.09-.453.237-.884zM15.848 6.44a8 8 0 0 0-.27-1.012l-.948.321q.147.43.237.884zM.017 7.477a8 8 0 0 0 0 1.046l.998-.064a7 7 0 0 1 0-.918zM16 8a8 8 0 0 0-.017-.523l-.998.064a7 7 0 0 1 0 .918l.998.064A8 8 0 0 0 16 8M.152 9.56q.104.52.27 1.012l.948-.321a7 7 0 0 1-.237-.884l-.98.194zm15.425 1.012q.168-.493.27-1.011l-.98-.194q-.09.453-.237.884zM.824 11.54a8 8 0 0 0 .524.905l.83-.556a7 7 0 0 1-.458-.793zm13.828.905q.292-.434.524-.906l-.896-.443q-.205.413-.459.793zm-12.667.83q.346.394.74.74l.66-.752a7 7 0 0 1-.648-.648zm11.29.74q.394-.346.74-.74l-.752-.66q-.302.346-.648.648zm-1.735 1.161q.471-.233.905-.524l-.556-.83a7 7 0 0 1-.793.458zm-7.985-.524q.434.292.906.524l.443-.896a7 7 0 0 1-.793-.459zm1.873.925q.493.168 1.011.27l.194-.98a7 7 0 0 1-.884-.237zm4.132.271a8 8 0 0 0 1.012-.27l-.321-.948a7 7 0 0 1-.884.237l.194.98zm-2.083.135a8 8 0 0 0 1.046 0l-.064-.998a7 7 0 0 1-.918 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z"/>
                </svg>
                Добавить билет
            </button>
        </router-link>
        <div v-for="ticket in tickets" :key="ticket.id">
            <div class="card card-primary mb-0 mt-3" >
                <div class="card-header">
                    <h3 class="card-title">{{ ticket.title}}</h3>
                </div>
                <div v-if="user.role === 1" class="d-flex justify-content-end pt-1 pr-2">

                </div>
                <div class="card-body" style="display: block;">
                    <div v-html="ticket.content"></div>
                    <hr>
                    <b>Варианты ответов:</b>
                    <div v-for="answer in ticket.answers" :key="answer.id">
                        <div class="border border-black mt-2 p-2">
                            <input :key="answer.id"  type="radio" :checked="answer.picked" disabled role="switch">
                            <span v-html="answer.answer" class="pl-2"></span>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer" style="display: block;"></div>
                <!-- /.card-footer-->
            </div>
            <div class="d-flex justify-content-between mb-1 mt-1" >
                <router-link :to="{name: 'ticket.edit.page', params: {id: ticket.id}}">
                    <button class="btn btn-info mr-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                            <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001m-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708z"/>
                        </svg>
                        Редактировать
                    </button>
                </router-link>
                <div>
                    <form @click.prevent="destroy(ticket.id)">
                        <delete-button></delete-button>
                    </form>
                </div>
            </div>
            <hr>
        </div>
    </div>
</template>

<script>

import Search from "@/components/UI/Search/Search.vue";
import DeleteButton from "@/components/UI/Button/DeleteButton.vue";
export default {
    name: "TicketListComponent",
    components: {
        DeleteButton,
        Search
    },
    mounted() {
        this.ticketList();

    },
    updated() {
        this.resizeImage()
    },
    methods: {
        ticketList() {
            this.$store.dispatch('ticketModule/TICKETS_LIST');
        },
        destroy(id) {
            axios.delete('/api/ticket/destroy/' + id).then(() => {
                this.ticketList();
            })
        },
        resizeImage() {
            let img = document.getElementsByTagName('img');
            let array = Array.from(img);

            //Устанавливаю размер 100% для тега img
            //в противном случае изображение не масштабируется
            array.forEach(el => {
                    el.style.width = '100%';
                    el.style.height = '100%';
            });
        }
    },
    computed: {
        tickets() {
            return this.$store.getters['ticketModule/GET_TICKETS_LIST']
                .filter(item => item.title.indexOf(this.$store.state.search) !== -1);

        },
        user() {
            return this.$store.getters['authModule/GET_AUTH_USER'];
        }
    }
}
</script>

<style>

</style>
