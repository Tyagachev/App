<template>
    <div v-for="feed in feeds" class="col-md-9">
        <div class="card">
            <div class="card-body">
                <div class="tab-content">
                    <div>
                        <!-- Post -->
                        <div class="post">
                            <div class="user-block">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <span>
                                            <router-link :to="{name: 'user', params: {id: feed.user_id}}">
                                                {{feed.name}}
                                            </router-link>
                                        </span>
                                    </div>
                                    <div class="d-flex">
                                        <div v-for="stars in feed.score">
                                            <p class="d-none">{{stars}}</p>
                                            <i class="fas fa-star"></i>
                                        </div>
                                    </div>

                                </div>

                                <span class="description ml-0">Добавлен - {{feed.created_at}}</span>
                            </div>
                            <!-- /.user-block -->
                            <p v-html="feed.comment"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    name: "FeedbackComponent",
    data() {
        return {
            feeds: {}
        }
    },
    mounted() {
        this.getFeeds()
    },
    methods: {
        getFeeds() {
            axios.get('/api/feedbacks/index').then(response => {
                this.feeds = response.data
            }).catch(err => {
                console.log(err.response);
            })
        }
    }
}
</script>

<style scoped>
.fas {
    color: #ec9801;
}
</style>
