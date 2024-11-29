<template>
     <h5>Hint</h5>
    <div v-for="h in getHints">
            <div class="card card-primary mb-0 mt-3" >
                <div v-for="t in h">
                    <div class="card-header">
                        <h3 class="card-title">{{ t.title }}</h3>
                    </div>
                </div>
            </div>
        <textarea>{{ h.hint.replace(/<br\s*\/?>/mg,"\n")}}</textarea>
    </div>

</template>

<script>
import store from "@/vuex/store.js";
export default {
    name: "HintCreateComponent",
    mounted() {
        this.hints()
    },
    methods: {
        hints() {
            store.dispatch('hintModule/HINTS_TICKES_LIST');
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
