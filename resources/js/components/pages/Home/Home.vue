<template>
    <div class="container">
        <div class="mb-3">
            <form @submit.prevent="onSubmit">
                <button class=" btn btn-success">Отправить</button>
            </form>
        </div>
        <div>
            <Editor />
        </div>
    </div>
</template>
<script>
import Editor from "@/components/pages/Home/Editor.vue";
import store from "@/vuex/store.js";
export default {
    name: "Home",
    components: {
        Editor
    },
    methods: {
        onSubmit() {
            console.log(store.state.content)
            store.state.content = ''
        }
    }
}

</script>

<style scoped>

.sidebar-menu {
    width: 100px;
    z-index: 100;
    background: #303641;
    height: 100vh;
    position: relative;
}
.main-menu {
    height: 42px;
    /*background: #262b34;*/
    border-bottom-color: rgba(69, 74, 84, 0.5);
    margin: 0;
    padding: 0;
    list-style: none;

}
.main-link {
    margin: 0;
    padding: 20px 20px;
    border-bottom: 1px solid rgba(69, 74, 84, 0.7);
}
.main-link:hover {
    background: gray;
}

</style>
