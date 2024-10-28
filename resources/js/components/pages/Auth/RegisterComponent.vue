<template>
    <div class="container">
        <div class="d-flex justify-content-center">
            <div class="mt-3 mb-3" style="width: 200px; height: 170px;">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 261.76 226.69">
                    <path d="M161.096.001l-30.225 52.351L100.647.001H-.005l130.877 226.688L261.749.001z"
                          fill="#41b883"/>
                    <path d="M161.096.001l-30.225 52.351L100.647.001H52.346l78.526 136.01L209.398.001z"
                          fill="#34495e"/>
                </svg>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Логин</div>

                    <div class="card-body">
                        <form>
                            <div class="row mb-3">
                                <label for="login" class="col-md-4 col-form-label text-md-end">Имя:</label>

                                <div class="col-md-6">
                                    <span class="text-danger" v-if="errors.name">{{ errors.name[0] }}</span>
                                    <input id="login" type="text" class="form-control" v-model="name" required autocomplete="login" autofocus>
                                </div>
                            </div>
                            <div class="row mb-3">

                                <label for="email" class="col-md-4 col-form-label text-md-end">Почта:</label>
                                <div class="col-md-6">
                                    <span class="text-danger" v-if="errors.email">{{ errors.email[0] }}</span>
                                    <input id="email" type="email" class="form-control" v-model="email" required autocomplete="email">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password" class="col-md-4 col-form-label text-md-end">Пароль:</label>

                                <div class="col-md-6">
                                    <span class="text-danger" v-if="errors.email">{{ errors.password[0] }}</span>
                                    <input id="password" type="password" class="form-control" v-model="password" required autocomplete="current-password">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="password_confirmation" class="col-md-4 col-form-label text-md-end">Подтверждение пароля:</label>

                                <div class="col-md-6">
                                    <span class="text-danger" v-if="errors.email">{{ errors.password[0] }}</span>
                                    <input id="password_confirmation" type="password" class="form-control" v-model="password_confirmation" required autocomplete="current-password">
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button @click.prevent="registration" class="btn btn-primary">Регистрация</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    name: 'RegisterComponent',
    data() {
        return {
            name: null,
            email: null,
            password: null,
            password_confirmation: null,
            errors: {}
        }
    },
    methods: {
        registration() {
                axios.post('/api/register',{
                    name: this.name,
                    email: this.email,
                    password: this.password,
                    password_confirmation: this.password_confirmation
                }).then(res => {
                    if (res.status === 200) {
                        localStorage.setItem('uid', res.data.user.id);
                        localStorage.setItem('x_xsrf_token', res.config.headers['X-XSRF-TOKEN']);
                        this.$router.push({ name:'verify.page' });
                        //this.$router.push({ name: 'home.page', params: { id: res.data.user.id } })
                    }
                }).catch(error => {
                    this.errors = error.response.data.errors;
                    console.log(this.errors)
                });
        }
    }
}
</script>
