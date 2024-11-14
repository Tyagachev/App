<template>
    <div class="d-flex justify-content-center">
        <div class="card card-primary w-75" v-show="visibleForm">
            <div class="card-header">
                <h3 class="card-title">Добавить пользователя</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form>
                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <label for="exampleInputName">Имя<span class="text-danger">*</span></label>
                            <p class="text-danger" v-if="errors.name">{{ errors.name[0] }}</p>
                            <input v-model="form.name" type="text" class="form-control" id="exampleInputName" placeholder="Имя" required>
                        </div>
                        <label for="exampleInputEmail1">Почта<span class="text-danger">*</span></label>
                        <p class="text-danger" v-if="errors.email">{{ errors.email[0] }}</p>
                        <input v-model="form.email" type="email" class="form-control" id="exampleInputEmail1" placeholder="Почта" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword">Пароль <span class="text-sm"> (будет создан автоматически если пусто)</span></label>
                        <p class="text-danger" v-if="errors.password">{{ errors.password[0] }}</p>
                        <div class="d-flex">
                            <input v-model="form.password" type="text" class="form-control" id="exampleInputPassword" placeholder="Пароль (мин. 8 символов)">
                            <button @click.prevent="generatePassword" class="btn btn-info">Генератор</button>
                        </div>

                    </div>
                    <div class="">

                    </div>
                    <div>
                        <p class="mb-1"><b>Отправить данные на почту?</b></p>
                        <label class="toggle">
                            <input class="toggle-checkbox" type="checkbox" v-model="form.sendToMail" role="switch"
                                   id="flexSwitchCheckDefault">
                            <div class="toggle-switch blue"></div>
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="role">Роль<span class="text-danger">*</span></label>
                        <p class="text-danger" v-if="errors.role">{{ errors.role[0] }}</p>
                        <select v-model="form.role" class="form-control" id="role" required>
                            <option value="0">Пользователь</option>
                            <option value="1">Администратор</option>
                        </select>
                    </div>
                    <div>
                        <form @click.prevent="createUser">
                            <save-button></save-button>
                        </form>
                    </div>
                </div>
            </form>
        </div>
        <div class="card card-success card-outline w-75" v-show="visibleCredentials">
            <div class="card-body">
                <div>
                    <h5 class="card-title text-bold mb-2">Пользователь успешно добавлен!</h5>
                </div>
                <div>
                    <p class="card-text text-bold m-0">
                        Имя: {{credentials.name}}
                    </p>
                    <p class="card-text text-bold m-0" ref="mylink">
                        Почта: {{credentials.email}}
                    </p>
                    <p class="card-text text-bold">
                        Пароль: {{credentials.password}}
                    </p>
                    <button @click.prevent="back" class="btn btn-info">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-bar-left" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M12.5 15a.5.5 0 0 1-.5-.5v-13a.5.5 0 0 1 1 0v13a.5.5 0 0 1-.5.5M10 8a.5.5 0 0 1-.5.5H3.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L3.707 7.5H9.5a.5.5 0 0 1 .5.5"/>
                        </svg>
                        Назад
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import SaveButton from "@/components/UI/Button/SaveButton.vue";

export default {
    name: "CreateUserComponent",
    components: {SaveButton},
    data() {
        return {
            form: {
                email: null,
                name: null,
                password: null,
                sendToMail: false,
                role: 0
            },
            credentials: {},
            errors: {},
            visibleForm: true,
            visibleCredentials: false,
        }
    },
    methods: {
        generatePassword() {
            axios.post('/api/generate-password', {response: true}).then(response => {
               this.form.password = response.data;
            });
        },
        createUser() {
            axios.post('/api/user/create', this.form).then(response => {
                this.credentials = response.data;
                if (response.status === 201) {
                    this.visibleForm = false;
                    this.visibleCredentials = true;
                }
            }).catch(error => {
                this.visibleCredentials = false;
                this. errors = error.response.data.errors;
            });
        },
        back() {
            location.reload();
        }
    }
}
</script>

<style scoped>

</style>
