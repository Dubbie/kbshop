<script setup>
import AdminHeader from "@/Components/AdminHeader.vue";
import AdminSidebar from "@/Components/AdminSidebar.vue";
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
        <AdminSidebar />

        <div class="pl-64 min-h-dvh bg-zinc-100 flex flex-col">
            <div
                :class="{
                    'bg-zinc-300 pb-8 bg-pattern': $slots.header,
                }"
            >
                <AdminHeader :background="!$slots.header" />

                <div
                    class="max-w-7xl mx-auto px-4 mt-4 sm:px-6 lg:px-8"
                    v-if="$slots.header"
                >
                    <div class="flex items-center justify-between">
                        <slot name="header" />
                    </div>
                </div>
            </div>

            <div
                class="flex-1"
                :class="{
                    '-mt-6': $slots.header,
                }"
            >
                <slot />
            </div>

            <div class="bg-white py-8 mt-8 text-sm">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="font-semibold">&copy; KBShop</p>
                            <p class="text-xs font-semibold text-zinc-500">
                                {{ new Date().getFullYear() }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.bg-pattern {
    background-image: url("/topography.svg");
    background-color: #b7b0c2;
}
</style>
