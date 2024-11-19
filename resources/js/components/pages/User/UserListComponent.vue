<template>
    <div>
        <div>
            <div class="">
                <span style="color: #687;">Поиск по имени или email</span>
                <br>
                <span style="color: #687;">Чувствителен к регистру</span>
            </div>
        </div>

    </div>
    <Search />
    <div v-if="users.length === 0" >
        <h4>Список пользователей пуст</h4>
    </div>
    <div v-else-if="users.length !== 0">
        <h5>Кол-во пользователей: {{users.length}}</h5>
    </div>
    <div class="pt-2 border-top border-black">
        <router-link :to="{name: 'user.create.page'}">
            <button class="btn btn-info mb-3" >
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 20 20">
                    <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                    <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5"/>
                </svg>
                Добавить юзера
            </button>
        </router-link>
        <div class="row">
            <div v-for="user in users" :key="user.id" class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
            <div class="card bg-light d-flex flex-fill">
                <div class="card-header text-muted border-bottom-0 p-2">
                </div>
                <div class="card-body pt-0">
                    <div class="row">
                        <div class="col-7">
                            <h2 class="lead"><b>{{user.name}}</b></h2>
                            <p class="text-muted text-sm mb-0"><b>ID:</b> {{user.id}}</p>
                            <p class="text-muted text-sm mb-0"><b>Роль:</b> {{(user.role === 1) ? 'Админ' : 'Юзер'}}</p>
                            <p class="text-muted text-sm"><b>Создан:</b> {{user.created_at}}</p>
                            <ul class="ml-4 mb-0 fa-ul text-muted">
                                <li class="small"><span class="fa-li">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-envelope-at-fill" viewBox="0 0 16 16">
                                        <path d="M2 2A2 2 0 0 0 .05 3.555L8 8.414l7.95-4.859A2 2 0 0 0 14 2zm-2 9.8V4.698l5.803 3.546zm6.761-2.97-6.57 4.026A2 2 0 0 0 2 14h6.256A4.5 4.5 0 0 1 8 12.5a4.49 4.49 0 0 1 1.606-3.446l-.367-.225L8 9.586zM16 9.671V4.697l-5.803 3.546.338.208A4.5 4.5 0 0 1 12.5 8c1.414 0 2.675.652 3.5 1.671"/>
                                        <path d="M15.834 12.244c0 1.168-.577 2.025-1.587 2.025-.503 0-1.002-.228-1.12-.648h-.043c-.118.416-.543.643-1.015.643-.77 0-1.259-.542-1.259-1.434v-.529c0-.844.481-1.4 1.26-1.4.585 0 .87.333.953.63h.03v-.568h.905v2.19c0 .272.18.42.411.42.315 0 .639-.415.639-1.39v-.118c0-1.277-.95-2.326-2.484-2.326h-.04c-1.582 0-2.64 1.067-2.64 2.724v.157c0 1.867 1.237 2.654 2.57 2.654h.045c.507 0 .935-.07 1.18-.18v.731c-.219.1-.643.175-1.237.175h-.044C10.438 16 9 14.82 9 12.646v-.214C9 10.36 10.421 9 12.485 9h.035c2.12 0 3.314 1.43 3.314 3.034zm-4.04.21v.227c0 .586.227.8.581.8.31 0 .564-.17.564-.743v-.367c0-.516-.275-.708-.572-.708-.346 0-.573.245-.573.791"/>
                                    </svg>
                                </span> {{ user.email }}</li>
                            </ul>
                        </div>
                        <div class="col-5 text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="gray" class="bi bi-person-circle" viewBox="0 0 16 16">
                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
                            </svg>
                            <!--<img src="#" alt="user-avatar" class="img-circle img-fluid">-->
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="text-right">
                        <!--<a href="#" class="btn btn-sm bg-teal">
                            <i class="fas fa-comments"></i>
                        </a>-->
                        <router-link :to="{name: 'user', params: {id: user.id}}">
                        <a class="btn btn-sm btn-primary">
                            <i class="fas fa-user"></i> Профиль
                        </a>
                        </router-link>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</template>

<script>
import Search from "@/components/UI/Search/Search.vue";

export default {
    name: "UserListComponent",
    components: {Search},
    mounted() {
        this.$store.dispatch('userModule/USERS_LIST');
    },
    computed: {
        users() {
            return this.$store.getters['userModule/GET_USERS_LIST']
                .filter(item => item.name.indexOf(this.$store.state.search) !== -1
                    || item.email.indexOf(this.$store.state.search) !== -1);
        }
    }
}
</script>

<style scoped>

</style>
