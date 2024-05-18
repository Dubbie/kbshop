<script setup>
import { computed } from "vue";

const props = defineProps({
    color: {
        type: String,
        default: "cyan",
    },
    title: {
        type: String,
        required: true,
    },
    value: {
        type: String,
        required: true,
    },
    icon: {
        type: Function,
        required: false,
    },
    description: {
        type: String,
        required: false,
    },
});

const bgColor = computed(() => {
    return {
        red: "bg-red-200",
        orange: "bg-orange-200",
        amber: "bg-amber-200",
        yellow: "bg-yellow-200",
        lime: "bg-lime-200",
        green: "bg-green-200",
        emerald: "bg-emerald-200",
        teal: "bg-teal-200",
        cyan: "bg-cyan-200",
        sky: "bg-sky-200",
        blue: "bg-blue-200",
        indigo: "bg-indigo-200",
        violet: "bg-violet-200",
        purple: "bg-purple-200",
        fuchsia: "bg-fuchsia-200",
        pink: "bg-pink-200",
        rose: "bg-rose-200",
        dark: "bg-zinc-800",
        zinc: "bg-zinc-600",
        white: "bg-white",
    }[props.color];
});
</script>

<template>
    <div class="rounded p-4 relative" :class="bgColor">
        <p class="font-medium mb-3 text-sm">{{ props.title }}</p>
        <p class="text-2xl font-bold">{{ props.value }}</p>

        <p class="text-xs mt-3" v-if="props.description">
            {{ props.description }}
        </p>

        <div
            v-if="props.icon"
            class="absolute right-4 top-4 p-2 bg-white rounded-lg"
        >
            <component :is="props.icon" size="24" stroke-width="2" />
        </div>
    </div>
</template>
