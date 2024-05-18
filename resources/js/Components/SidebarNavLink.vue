<script setup>
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    href: String,
    active: {
        type: Boolean,
        default: false,
    },
});
</script>

<template>
    <Link
        :href="href"
        class="flex items-center space-x-3 text-sm px-2 py-2 rounded"
        :class="{
            'font-medium text-zinc-300 hover:text-white': !props.active,
            'font-semibold text-white bg-white/10': props.active,
        }"
    >
        <slot />
    </Link>
</template>
