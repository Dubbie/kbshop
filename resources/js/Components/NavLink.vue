<script setup>
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    href: String,
    active: Boolean,
});
</script>

<template>
    <Link
        :href="href"
        class="text-sm font-medium p-2"
        :class="{
            'text-zinc-500 hover:text-zinc-700': !props.active,
            'text-zinc-900': props.active,
        }"
    >
        <slot />
    </Link>
</template>
