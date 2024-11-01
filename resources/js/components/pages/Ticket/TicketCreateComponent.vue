<template>
        <div class="container">
            <div class="form-group">
                <label for="exampleInputName">Заголовок<span class="text-danger">*</span></label>
                <input v-model="form.title" type="text" class="form-control" id="exampleInputName" placeholder="Заголовок" required>
            </div>
            <div>
                <Editor />
            </div>
            <div class="d-flex mt-2 justify-content-between">
                <div class="mb-3">
                    <button @click="addAnswer" class="btn btn-info mb-1">
                        Добавить ответ  <span v-if="form.answers.length > 0"> {{form.answers.length}}</span>
                    </button>
                    <span>

                    </span>
                </div>
                <div>
                    <form @submit.prevent="onSubmit">
                        <button class=" btn btn-success">Сохранить</button>
                    </form>
                </div>
            </div>

            <div v-for="(el, index) in form.answers">
                <div class="form-group">
                    <label for="exampleInputName">Ответ {{ index + 1 }}</label>
                    <div>
                        <label class="toggle">
                            <input :key="index" class="toggle-checkbox" type="checkbox" v-model="el.picked" role="switch" id="flexSwitchCheckDefault">
                            <div class="toggle-switch"></div>
                            <span class="toggle-label">Верный ответ</span>
                        </label>
                    </div>
                    <textarea v-text="" v-model="el.answer" :key="index" type="text" class="form-control"></textarea>
                </div>
            </div>
        </div>
</template>

<script>
import Editor from "@/components/pages/Home/Editor.vue";
export default {
    name: "CreateTicketComponent",
    components: {
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
    methods: {
        addAnswer: function () {
            this.form.answers.push({ answer: '', picked: false});
        },
        onSubmit() {
            this.$store.dispatch('ticketModule/SEND_CONTENT_TICKET', this.form)
        }
    }
}
</script>

<style scoped>


</style>
