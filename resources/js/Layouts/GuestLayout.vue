<script setup>
import { Head } from "@inertiajs/vue3";
import NavBar from "@/Components/NavBar.vue";
import AppFooter from "@/Components/AppFooter.vue";

const props = defineProps({
    title: {
        type: String,
        default: "KBShop",
    },
});
</script>

<template>
    <Head :title="title" />
    <div>
        <NavBar />

        <slot />

        <AppFooter />
    </div>
</template>
