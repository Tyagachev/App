<template>
    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{usersCount}}</h3>

                    <p>Всего пользователей</p>
                </div>
                <div class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="gray" class="bi bi-people-fill" viewBox="0 0 16 16">
                        <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5"/>
                    </svg>
                </div>
                    <a class="small-box-footer">
                        <router-link :to="{name: 'user.list.page'}">
                            <span class="text-dark">Подробнее </span>
                            <i class="fas fa-arrow-circle-right text-dark"></i>
                        </router-link>
                    </a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ ticketsCount }}</h3>
                    <p>Всего билетов</p>
                </div>
                <div class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-ticket-perforated-fill" viewBox="0 0 16 16">
                        <path d="M0 4.5A1.5 1.5 0 0 1 1.5 3h13A1.5 1.5 0 0 1 16 4.5V6a.5.5 0 0 1-.5.5 1.5 1.5 0 0 0 0 3 .5.5 0 0 1 .5.5v1.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 11.5V10a.5.5 0 0 1 .5-.5 1.5 1.5 0 1 0 0-3A.5.5 0 0 1 0 6zm4-1v1h1v-1zm1 3v-1H4v1zm7 0v-1h-1v1zm-1-2h1v-1h-1zm-6 3H4v1h1zm7 1v-1h-1v1zm-7 1H4v1h1zm7 1v-1h-1v1zm-8 1v1h1v-1zm7 1h1v-1h-1z"/>
                    </svg>
                </div>
                <a class="small-box-footer">
                    <router-link :to="{name: 'ticket.list.page'}">
                        <span class="text-dark">Подробнее </span>
                        <i class="fas fa-arrow-circle-right text-dark"></i>
                    </router-link>
                </a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <!--<div class="small-box bg-success">
                <div class="inner">
                    <h3>53<sup style="font-size: 20px">%</sup></h3>

                    <p>Bounce Rate</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>-->
        </div>
        <!-- ./col -->

        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <!--<div class="small-box bg-danger">
                <div class="inner">
                    <h3>65</h3>

                    <p>Unique Visitors</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>-->
        </div>
        <!-- ./col -->
    </div>
</template>

<script>

export default {
    name: "StatisticsComponent",
    mounted() {
        this.getCountUsers();
        this.getCountTickets();
    },
    methods: {
        getCountUsers() {
            this.$store.dispatch('statisticsModule/USERS_COUNT');
        },
        getCountTickets() {
            this.$store.dispatch('statisticsModule/TICKETS_COUNT');
        }
    },
    computed: {
        usersCount() {
            return this.$store.getters['statisticsModule/GET_USERS_COUNT']
        },
        ticketsCount() {
            return this.$store.getters['statisticsModule/GET_TICKETS_COUNT']
        }
    }
}
</script>

<style scoped>

</style>
