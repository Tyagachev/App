<template>
    <footer class="main-footer">
        <!-- To the right -->
        <!--<div class="float-right d-none d-sm-inline">
            Anything you want
        </div>-->
        <!-- Default to the left -->
        <!--<strong>Copyright &copy; {{ year }} <a href="https://adminlte.io">AdminAPP.io</a>.</strong> All rights reserved.-->
        <strong>{{ year }}</strong>
    </footer>
</template>

<script>
export default {
    name: "Footer",
    data() {
        return {
            year: new Date().getUTCFullYear()
        }
    }
}
</script>

<style scoped>

</style>
