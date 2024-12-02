<template>
     <h5>Hint</h5>
    <div v-for="h in getHints" :key="h.id">
            <div class="card card-primary mb-0 mt-1" >
                <div class="card-header">
                    <div v-for="t in h">
                        <h3 class="card-title">{{ t.title }}</h3>
                    </div>
                </div>
            </div>
        <div>
            <textarea :id="h.id" class="form-label w-100" @input="updateTheVariable($event.target.value)"  rows="6">{{ h.hint.replace(/<br\s*\/?>/mg,"\n") }}</textarea>
                <form @click.prevent="update(h)">
                    <save-button></save-button>
                </form>
        </div>
    </div>

</template>

<script>
import store from "@/vuex/store.js";
import SaveButton from "@/components/UI/Button/SaveButton.vue";
export default {
    name: "HintCreateComponent",
    components: {SaveButton},
    data() {
        return {
            form: {
                hintId: null,
                hintValue: null
            }
        }
    },
    mounted() {
        this.hints()
    },
    methods: {
        hints() {
            store.dispatch('hintModule/HINTS_TICKES_LIST');
        },
        update(h) {
            this.form.hintId = h.id;
            store.dispatch('hintModule/UPDATE_HINT_VALUE', this.form)
        },
        updateTheVariable(newValue) {
            this.form.hintValue = newValue
        }
    },
    computed: {
        getHints() {
            return store.getters['hintModule/GET_HINTS'];
        }
    }
}
</script>

<style scoped>

</style>
