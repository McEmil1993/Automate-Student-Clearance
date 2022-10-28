<template>
    <div class="preloader" v-if="show">
        <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
</template>

<script>
export default {
    name: "PreloaderComponent",
    data: () => ({
        show: false
    }),
    mounted() {
        window.addEventListener('isAxiosRequesting',  (event) => {
            this.show = event.detail
        })
    }
}
</script>

<style lang="scss">
.preloader {
    position: absolute;
    width: 100%;
    height: 100%;
    left: 0;
    top: 0;
    z-index: 1050;
    background: rgba(0, 0, 0, .3);
    display: flex;
    align-items: center;
    justify-content: center;
}
</style>