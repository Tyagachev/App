<template>
    <h5>Home</h5>
    <div class="modal fade" id="exampleModalCenteredScrollable" tabindex="-1" aria-labelledby="exampleModalCenteredScrollableTitle" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenteredScrollableTitle">Modal title</h5>

                    <button type="button" class="btn-close b-modal" data-bs-dismiss="modal" aria-label="Close">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                            <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z"/>
                        </svg>
                    </button>
                </div>
                <div class="modal-body">
                    <p>This is some placeholder content to show a vertically centered modal. We've added some extra copy here to show how vertically centering the modal works when combined with scrollable modals. We also use some repeated line breaks to quickly extend the height of the content, thereby triggering the scrolling. When content becomes longer than the prefedined max-height of modal, content will be cropped and scrollable within the modal.</p>
                    <br><br><br><br><br><br><br><br><br><br>
                    <p>Just like that.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="bd-example">
        <a href="" data-bs-toggle="modal" data-bs-target="#exampleModalCenteredScrollable">
            Modal
        </a>
    </div>
</template>
<script>
export default {
    name: "Home",
    methods: {
        ///
        }
}

</script>

<style scoped>
.b-modal {
    background: transparent;
    border: transparent;
}
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
