<template>
    <div>
        <div v-if="result.length === 0">
            <h3 class="text-center">Вы ответили на все вопросы!</h3>
        </div>
        <div v-if="result.length">
            <button @click.prevent="again()" class=" btn btn-danger">Пройти тест заново</button>
            <div v-for="res in result">
                <p>{{ res.title }}</p>
                <p v-html="res.content"></p>
            </div>
        </div>
        <div v-for="task in tasks" :key="task.id">
            <div class="card card-primary mb-0 mt-3" >
                <div class="card-header">
                    <h3 class="card-title">{{ task.title}}</h3>
                </div>
                <div class="card-body" style="display: block;">
                    <div v-html="task.content"></div>
                    <hr>
                    <b>Варианты ответов:</b>
                    <div v-for="answer in task.answers" :key="answer.id">
                        <label class="w-100 font-weight-normal">
                            <div class="border border-black p-2">
                                <input :checked="false" @change="onChange(answer)" name="answer" type="radio">
                                <span v-html="answer.answer" class="pl-2"></span>
                            </div>
                        </label>
                    </div>
                        <div class="d-flex justify-content-end mt-1">
                            <button @click.prevent="sendAnswer"  class="btn btn-info">Ответить</button>
                        </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
export default {
    name: "TaskComponent",
    data() {
        return {
            user: {},
            tasks: [],
            result: {},
            form: {
                ticket_id: null,
                answer_id: null,
                user_id: null
            }
        }
    },
    mounted() {
        this.getUser()
    },
    methods: {
        getUser() {
            axios.get('/api/check/auth/user').then(response => {
                this.user = response.data;
                if (this.user) {
                    this.tasksList();
                }
            });
        },
        tasksList() {
                axios.post('/api/task/index', {id: this.user.id}).then(response => {
                    if (response.data[0].id) {
                        this.tasks = response.data;
                    } else if (response.data === 'No found') {
                        this.tasks = [];
                        this.getResult();
                    }
                })
        },
        sendAnswer() {
            axios.post('/api/task/store', this.form).then(response => {
                if (response.status === 200) {
                    this.getUser();
                }
            });
        },
        getResult() {
          axios.get('/api/task/show/' + this.user.id).then(response => {
              this.result = response.data
          });
        },
        again() {
            axios.post('/api/task/destroy', {id: this.user.id}).then(response => {
                if (response.status === 200) {
                    window.location.reload()
                }
            });
        },
        onChange(answer) {
            this.form.user_id = this.user.id
            this.form.ticket_id = answer.ticket_id
            this.form.answer_id = answer.id
        }
    },

}
</script>

<style scoped>

</style>
