<template>
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
                    </div>

                </div>
                <div class="d-flex">
                    <button @click.prevent="generatePassword" class="btn btn-info">Генерировать</button>
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
                    <button @click.prevent="create" type="submit" class="btn btn-primary">Сохранить</button>
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
                <button @click.prevent="back"class="btn btn-success">Назад</button>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    name: "CreateUserComponent",
    data() {
        return {
            form: {
                email: null,
                name: null,
                password: null,
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
        create() {
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
    },
}
</script>

<style scoped>

</style>
