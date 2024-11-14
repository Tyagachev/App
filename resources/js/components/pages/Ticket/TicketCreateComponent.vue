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
                    <form @click.prevent="deleteAnswer(index)">
                        <delete-button></delete-button>
                    </form>
                </div>
            </div>
            <textarea v-text="" v-model="el.answer" :key="index" type="text" class="form-control"></textarea>
        </div>
    </div>
</template>

<script>
import Editor from "@/components/pages/Home/Editor.vue";
import SaveButton from "@/components/UI/Button/SaveButton.vue";
import DeleteButton from "@/components/UI/Button/DeleteButton.vue";
export default {
    name: "CreateTicketComponent",
    components: {
        DeleteButton,
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
