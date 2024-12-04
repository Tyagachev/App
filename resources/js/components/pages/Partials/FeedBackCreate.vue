<template>
    <div>
        <div class="review_stars_wrap mt-4" >
            <div id="review_stars" v-for="v in values">
                <div class="ml-2 mr-2">
                    <input :id="'star-' + v" type="radio" :checked=checked v-model="score" :value="v" name="stars"/>
                    <label :for="'star-' + v">
                        <div>
                            <span class="star_num ml-2 mr-2">{{v}}</span>
                            <i class="fas fa-star"></i>
                        </div>
                    </label>
                </div>
            </div>
        </div>
        <div>
            <textarea class="w-100" rows="6" v-model="comment"></textarea>
            <form @click.prevent="sendFeedBack">
                <button class="btn btn-success w-100">Отправить</button>
            </form>
        </div>
    </div>
</template>

<script>
import SaveButton from "@/components/UI/Button/SaveButton.vue";
import axios from "axios";

export default {
    name: "FeedBackCreate",
    components: {SaveButton},
    data() {
      return {
          values: [1, 2, 3, 4, 5],
          checked: false,
          comment: null,
          score: null,
      }
    },
    methods: {
      sendFeedBack() {
          axios.post('/api/feedbacks/store', {
              form: {
                  score: this.score,
                  comment: this.comment,
                  user_id: this.getUser.id
              },

          }).then(response => {
              console.log(response);
          });
      },
        e(ev) {
            this.form.value = ev;
        }
    },
    computed: {
        getUser() {
            return this.$store.getters['authModule/GET_AUTH_USER']
        }
    }
}
</script>

<style scoped>
.review_stars_wrap{
    overflow: hidden;
}
#review_stars {
    overflow: hidden;
    position: relative;
    float: left;
}
#review_stars input {
    opacity: 0;
    position: absolute;
    top: 0;
    z-index: 0;
}
#review_stars input ~ label i{
    color:#ccc;
    font-size: larger;
}
#review_stars input:checked ~ label i{
    color: #ec9801;
}
#review_stars label {
    float: right;
    cursor: pointer;
    position: relative;
    z-index: 1;
}
#review_stars label:hover i, #review_stars label:hover ~ label i{
    color: #ec9801;
}

</style>
