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

        <div class="border-t border-zinc-200 mt-10">
            <div class="max-w-7xl mx-auto px-4 mt-10 sm:px-6 lg:px-8">
                <p>Footer</p>
            </div>
        </div>
    </div>
</template>
