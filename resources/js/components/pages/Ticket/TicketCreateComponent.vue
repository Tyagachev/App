<template>
    <div class="form-group">
        <label for="exampleInputName">Заголовок<span class="text-danger">*</span></label>
        <input v-model="form.title" type="text" class="form-control" id="exampleInputName" placeholder="Заголовок"
               required>
    </div>
    <div>
        <Editor/>
    </div>
    <div class="d-flex mt-2 justify-content-between">
        <div class="mb-3">
            <button @click="addAnswer" class="btn btn-info mb-1">
                Добавить ответ <span v-if="form.answers.length"> ({{ form.answers.length }})</span>
            </button>
            <span></span>
        </div>
        <div>
            <form @submit.prevent="createTicket">
                <save-button></save-button>
            </form>
        </div>
    </div>

    <div v-for="(el, index) in form.answers">
        <div class="form-group">
            <label for="exampleInputName">Ответ {{ index + 1 }}</label>
            <div class="d-flex justify-content-between">
                <div>
                    <label class="toggle">
                        <input :key="index" class="toggle-checkbox" type="checkbox" v-model="el.picked" role="switch" id="flexSwitchCheckDefault">
                        <div class="toggle-switch"></div>
                        <span class="toggle-label">Верный ответ</span>
                    </label>
                </div>
                <div>
                    <button @click.prevent="deleteAnswer(index)" class="btn btn-danger">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                            <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0"></path>
                        </svg>
                        Удалить
                    </button>
                </div>
            </div>
            <textarea v-text="" v-model="el.answer" :key="index" type="text" class="form-control"></textarea>
        </div>
    </div>
</template>

<script>
import Editor from "@/components/pages/Home/Editor.vue";
import SaveButton from "@/components/UI/Button/SaveButton.vue";
export default {
    name: "CreateTicketComponent",
    components: {
        SaveButton,
        Editor
    },
    data() {
        return {
            form: {
                title: '',
                answers: []
            },
            errors: {}
        }
    },
    mounted() {
        this.clearStoreContent();
    },
    methods: {
        addAnswer: function () {
            this.form.answers.push({ answer: '', picked: false});
        },
        deleteAnswer(index) {
          this.form.answers.splice(index,1);
        },
        createTicket() {
            this.$store.dispatch('ticketModule/SEND_CONTENT_TICKET', this.form)
        },
        clearStoreContent() {
            this.$store.state.content = ''
        },
    }
}
</script>

<style scoped>


</style>
