<template>
    {{ ticketInfo }}
    <div class="form-group">
        <label for="exampleInputName">Заголовок<span class="text-danger">*</span></label>
        <input v-model="ticketInfo.title" type="text" class="form-control" id="exampleInputName" placeholder="Заголовок" required>
    </div>
    <div>
        <Editor />
    </div>
    <div class="d-flex mt-2 justify-content-between">
        <div class="mb-3">
            <button @click="addAnswer" class="btn btn-info mb-1">
                Добавить ответ <span v-if="ticketInfo.answers"> ({{ ticketInfo.answers.length }})</span>
            </button>
            <span></span>
        </div>
        <div>
            <form @submit.prevent="onSubmit">
                <button class=" btn btn-success">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-floppy" viewBox="0 0 16 16">
                        <path d="M11 2H9v3h2z"/>
                        <path d="M1.5 0h11.586a1.5 1.5 0 0 1 1.06.44l1.415 1.414A1.5 1.5 0 0 1 16 2.914V14.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 14.5v-13A1.5 1.5 0 0 1 1.5 0M1 1.5v13a.5.5 0 0 0 .5.5H2v-4.5A1.5 1.5 0 0 1 3.5 9h9a1.5 1.5 0 0 1 1.5 1.5V15h.5a.5.5 0 0 0 .5-.5V2.914a.5.5 0 0 0-.146-.353l-1.415-1.415A.5.5 0 0 0 13.086 1H13v4.5A1.5 1.5 0 0 1 11.5 7h-7A1.5 1.5 0 0 1 3 5.5V1H1.5a.5.5 0 0 0-.5.5m3 4a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 .5-.5V1H4zM3 15h10v-4.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5z"/>
                    </svg>
                    Сохранить
                </button>
            </form>
        </div>
    </div>

    <div v-for="(ticket, index) in ticketInfo.answers" :key="ticket.id">
        <div class="form-group">
            <label for="exampleInputName">Ответ {{ index + 1 }}</label>
            <div class="d-flex justify-content-between">
                <div>
                    <label class="toggle">
                        <input :key="ticket.id" class="toggle-checkbox" type="checkbox" v-model="ticket.picked" :checked="ticket.picked" :value="ticket.picked" role="switch" id="flexSwitchCheckDefault">
                        <div class="toggle-switch"></div>
                        <span class="toggle-label">Верный ответ</span>
                    </label>
                </div>
                <div>
                    <button @click.prevent="deleteAnswer(ticket.id)" class="btn btn-danger">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                            <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0"></path>
                        </svg>
                        Удалить
                    </button>
                </div>
            </div>
            <textarea v-model="ticket.answer" :key="index" type="text" class="form-control"></textarea>
        </div>
    </div>
</template>

<script>
import Editor from "@/components/pages/Home/Editor.vue";
export default {
    name: "TicketUpdateComponent",
    components: {
        Editor
    },
    mounted() {
        this.getTicketInfo()

    },
    methods: {
        getTicketInfo() {
            this.$store.dispatch('ticketModule/TICKET_INFO_BY_ID', this.$route.params.id);
        },
        addAnswer() {
            this.ticketInfo.answers.push({ answer: '', picked: false});
        },
        deleteAnswer(id) {
            axios.delete('/api/answer/destroy/' + id).then(response => {
                console.log(response);
                this.getTicketInfo();
            });
        },
        onSubmit() {
            this.$store.dispatch('ticketModule/SEND_UPDATE_CONTENT_TICKET', this.ticketInfo);
        },

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
