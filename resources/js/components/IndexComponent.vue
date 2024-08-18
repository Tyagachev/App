<template>
    <div>
        <Links/>
    </div>
    <div>
        <MainComponent />
    </div>
</template>

<script>
import Links from "@/components/pages/Headers/Links.vue";
import MainComponent from "@/components/pages/MainComponent.vue";
export default {
    name: "IndexComponent",
    components: {
        Links,
        MainComponent
    }
}
</script>

<style scoped>

</style>
