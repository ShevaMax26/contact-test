<script setup>
import Header from "./Header.vue";
import Footer from "./Footer.vue";
</script>

<template>
    <div class="main-wrapper">
        <Header/>
        <main>
            <router-view></router-view>
            <slot/>
        </main>
        <Footer/>
    </div>
</template>

<style scoped lang="scss">
.main-wrapper {
    display: grid;
    grid-template-rows: auto 1fr auto;
    min-height: 100vh;
}
</style>
