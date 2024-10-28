<template>
    <div>
        <h4>Список пользователей</h4>
    </div>
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Имя</th>
            <th scope="col">Email</th>
            <th scope="col">Создан</th>
        </tr>
        </thead>
        <tbody>

        <tr v-for="user in users" :key="user.id" >
            <th scope="row">{{user.id}}</th>
            <router-link :to="{name:'user', params: {id: user.id}}"><td>{{user.name}}</td></router-link>
            <td>{{user.email}}</td>
            <td>{{user.created_at}}</td>

        </tr>

        </tbody>

    </table>
</template>

<script>
export default {
    name: "UserListComponent",
    data() {
        return {

        }
    },
    mounted() {
        this.$store.dispatch('userModule/GET_ALL_USERS');
    },
    computed: {
        users() {
            return this.$store.getters['userModule/GET_USERS_LIST'];
        }
    }
}
</script>

<style scoped>

</style>
