<template>
    <div>
        <div v-if="result.length === 0">
            <h2 class="text-center">Тест пройден успешно!</h2>
            <div class="d-flex justify-content-center mt-4">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="150" height="150" fill="green" class="bi bi-check-circle" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                        <path d="m10.97 4.97-.02.022-3.473 4.425-2.093-2.094a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05"/>
                    </svg>
                    <div>
                        <FeedBackCreate />
                    </div>
                </div>
            </div>

        </div>
        <div v-if="result.length">
            <a @click.prevent="again()" class="mb-4">Пройти тест заново</a>
            <div v-for="res in result" class="mb-1">
                <div class="d-flex justify-content-between border border-secondary">
                        <div class="p-2">
                            <div class=" d-flex align-items-center">
                                <div class="ml-1 mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="red" class="bi bi-exclamation-triangle" viewBox="0 0 16 16">
                                        <path d="M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.15.15 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.2.2 0 0 1-.054.06.1.1 0 0 1-.066.017H1.146a.1.1 0 0 1-.066-.017.2.2 0 0 1-.054-.06.18.18 0 0 1 .002-.183L7.884 2.073a.15.15 0 0 1 .054-.057m1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767z"/>
                                        <path d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0M7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <div>
                                        <h5>{{ res.title }}</h5>
                                    </div>
                                    <div>
                                        <p v-html="res.content"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <div class="d-flex align-items-center p-2">
                        <div class="modal fade" id="exampleModalCenteredScrollable" tabindex="-1" aria-labelledby="exampleModalCenteredScrollableTitle" style="display: none;" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalCenteredScrollableTitle">{{ hints.title }}</h5>
                                        <button type="button" class="btn-close b-modal border border-0 bg-transparent" data-bs-dismiss="modal" aria-label="Close">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                                <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z"/>
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p v-html="hints.hint"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bd-example">
                            <a href="" @click.prevent="getHint(res.id)" data-bs-toggle="modal" data-bs-target="#exampleModalCenteredScrollable">
                                Справка
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div v-if="tasks.length">
            <h5>Вопрос {{ tasksCount + 1 }} / {{ ticketCount }}</h5>
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
import FeedBackCreate from "@/components/pages/Partials/FeedBackCreate.vue";
export default {
    name: "TaskComponent",
    components: {FeedBackCreate},
    data() {
        return {
            user: {},
            tasks: [],
            result: {},
            hints: {},
            tasksCount: null,
            ticketCount: null,
            form: {
                ticket_id: null,
                answer_id: null,
                user_id: null
            }
        }
    },
    mounted() {
        this.getUser()
        this.getTasksCount()
        this.getTicketCount()
    },
    methods: {
        async getUser() {
            await axios.get('/api/check/auth/user').then(response => {
                this.user = response.data;
                this.tasksList();
            });
        },
        async getTicketCount() {
            await axios.get('/api/statistics/ticket-count').then(response => {
                this.ticketCount = response.data;
            })
        },
        async getTasksCount() {
            await axios.get('/api/task/count/' + this.user.id).then(response => {
                    this.tasksCount = response.data
            });
        },
        async tasksList() {
                await axios.post('/api/task/index', {id: this.user.id}).then(response => {
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
                    this.getTasksCount();
                }
            });
        },
        getResult() {
          axios.get('/api/task/show/' + this.user.id).then(response => {
              this.result = response.data
          });
        },
        getHint(resultId) {
          axios.get('/api/hint/show/' + resultId).then(response => {
             this.hints = response.data
          })
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
