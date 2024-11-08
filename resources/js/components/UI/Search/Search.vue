<template>
    <div>
        <form>
            <div class="input-group mb-2">
                <input v-model="this.$store.state.search" type="search" class="form-control form-control-lg" placeholder="Поиск">
                <div class="input-group-append">
                    <button disabled class="btn btn-lg btn-default">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    name: "Search",
    mounted() {
        this.$store.state.search = '';
    }
}
</script>

<style scoped>

</style>
