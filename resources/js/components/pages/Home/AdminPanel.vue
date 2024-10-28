<template>
    <div class="hold-transition sidebar-mini">
        <div class="wrapper">
            <!-- Header -->
            <Header />
            <!-- /.Header -->
            <!-- Main Sidebar Container -->
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <!-- Brand Logo -->
                <router-link :to="{name:'admin.page'}">
                <a href="" class="brand-link">

                    <div class="d-flex justify-content-center">
                            <span class="brand-text font-weight-light">AdminLTE 3</span>
                    </div>

                    <!--<img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">-->
                </a>
                </router-link>

                <!-- Sidebar -->
                <div class="sidebar">
                    <!-- Sidebar user panel (optional) -->
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="image">
                            <!--<img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">-->
                        </div>
                        <div class="info">
                            <router-link :to="{name:'user', params: {id: user.id}}"><a class="d-block">{{ user.name }} (ID: {{user.id}})</a></router-link>
                        </div>
                    </div>

                    <!-- SidebarSearch Form -->
                    <div class="form-inline">
                        <div class="input-group" data-widget="sidebar-search">
                            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                            <div class="input-group-append">
                                <button class="btn btn-sidebar">
                                    <i class="fas fa-search fa-fw"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar Menu -->
                   <SidebarMenu />
                    <!-- /.sidebar-menu -->
                </div>
                <!-- /.sidebar -->
            </aside>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <!--<h1 class="m-0">Starter Page</h1>-->
                            </div>

                            <!-- /.col -->
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <router-link :to="{name: 'home.page'}">
                                        <li class="breadcrumb-item">Home</li>
                                    </router-link>
                                    <div class="ml-1 mr-1">/</div>
                                    <router-link :to="{name: 'admin.page'}">
                                        <li class="breadcrumb-item">Starter Page</li>
                                    </router-link>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Main content -->
                <div class="content">
                    <div class="container-fluid">
                        <PageLayout>
                            <RouterView name="page"/>
                        </PageLayout>
                        <!-- /.row -->
                    </div><!-- /.container-fluid -->
                </div>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->

            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
                <div class="p-3">
                    <h5>Title</h5>
                    <p>Sidebar content</p>
                </div>
            </aside>
            <!-- /.control-sidebar -->

            <!-- Main Footer -->
            <Footer />
        </div>
    </div>
</template>

<script>
import Footer from "@/components/Footer/Footer.vue";
import Navbar from "@/components/Navbar/Navbar.vue";
import SidebarMenu from "@/components/SidebarMenu/SidebarMenu.vue";
import Header from "@/components/Header/Header.vue";
import PageLayout from "@/components/Layouts/PageLayout.vue";
export default {
    name: "AdminPanel",
    components: {
        PageLayout,
        Header,
        SidebarMenu,
        Navbar,
        Footer
    },
    mounted() {
        this.$store.dispatch('userModule/GET_AUTH_USER');
    },
    computed: {
        user() {
            return this.$store.getters['userModule/GET_AUTH_USER'];
        }
    }
}
</script>

<style scoped>

</style>
