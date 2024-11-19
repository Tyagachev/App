<template>
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
                <save-button></save-button>
            </form>
        </div>
    </div>
    <div v-for="(ticket, index) in ticketInfo.answers" :key="ticket.id">
        <div class="form-group">
            <label for="exampleInputName">Ответ {{ index + 1 }}</label>
            <div class="d-flex justify-content-between">
                <div>
                    <label class="toggle">
                        <input :key="ticket.id" class="toggle-checkbox" type="checkbox"  :checked="ticket.picked"
                               role="switch" id="flexSwitchCheckDefault">
                        <div class="toggle-switch"></div>
                        <span class="toggle-label">Верный ответ</span>
                    </label>
                </div>
                <div>
                    <form v-if="ticketInfo.answers.length > 1" @click.prevent="deleteAnswer(index,ticket.id)">
                        <delete-button></delete-button>
                    </form>

                </div>
            </div>
            <textarea v-model="ticket.answer" :key="index" type="text" class="form-control"></textarea>
        </div>
    </div>
</template>

<script>
import Editor from "@/components/pages/Home/Editor.vue";
import DeleteButton from "@/components/UI/Button/DeleteButton.vue";
import SaveButton from "@/components/UI/Button/SaveButton.vue";
import ticket from "@/vuex/modules/ticket.js";
export default {
    name: "TicketUpdateComponent",
    components: {
        SaveButton,
        DeleteButton,
        Editor
    },
    data() {
        return {
            checked:{}
        }
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
        onSubmit() {
            this.$store.dispatch('ticketModule/SEND_UPDATE_CONTENT_TICKET', this.ticketInfo);
        },
        deleteAnswer(index,id) {
            if (id === undefined) {
                this.ticketInfo.answers.splice(index,1)
            } else {
                axios.delete('/api/answer/destroy/' + id).then(() => {
                    this.getTicketInfo();
                });
            }
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
