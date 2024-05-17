<script setup>
import AdminNavBar from "@/Components/AdminNavBar.vue";
import { Head } from "@inertiajs/vue3";

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
        <AdminNavBar />

        <div>
            <slot />
        </div>

        <div>
            <p>footer</p>
        </div>
    </div>
</template>
