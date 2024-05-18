<script setup>
import { computed } from "vue";
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    type: {
        type: String,
        default: "button",
    },
    color: {
        type: String,
        default: "dark/zinc",
    },
    outline: {
        type: Boolean,
        default: false,
    },
    href: {
        type: String,
        default: null,
    },
});

const colorClasses = computed(() => {
    // handle outline
    if (props.outline) {
        return {
            "dark/zinc": "ring-1 ring-zinc-800 text-zinc-800",
            dark: "ring-1 ring-zinc-800 text-zinc-800",
            zinc: "ring-1 ring-zinc-300 text-zinc-600 hover:bg-zinc-50 hover:ring-zinc-400",
            white: "ring-1 ring-zinc-800 text-zinc-800",
            red: "ring-1 ring-red-600 text-red-600",
            orange: "ring-1 ring-orange-500 text-orange-500",
            amber: "ring-1 ring-amber-500 text-amber-500",
            yellow: "ring-1 ring-yellow-400 text-yellow-400",
            lime: "ring-1 ring-lime-500 text-lime-500",
            green: "ring-1 ring-green-500 text-green-500",
            emerald: "ring-1 ring-emerald-500 text-emerald-500",
            teal: "ring-1 ring-teal-500 text-teal-500",
            cyan: "ring-1 ring-cyan-400 text-cyan-400",
            sky: "ring-1 ring-sky-500 text-sky-500",
            blue: "ring-1 ring-blue-500 text-blue-500",
            indigo: "ring-1 ring-indigo-500 text-indigo-500",
            violet: "ring-1 ring-violet-500 text-violet-500",
            purple: "ring-1 ring-purple-500 text-purple-500",
            fuchsia: "ring-1 ring-fuchsia-500 text-fuchsia-500",
            pink: "ring-1 ring-pink-500 text-pink-500",
            rose: "ring-1 ring-rose-500 text-rose-500",
        }[props.color];
    }

    return {
        "dark/zinc": "bg-zinc-900 text-white hover:bg-zinc-700",
        dark: "bg-zinc-900 text-white hover:bg-zinc-700",
        zinc: "bg-zinc-600 text-white hover:bg-zinc-500",
        white: "bg-white text-zinc-800 ring-1 ring-zinc-300 hover:bg-zinc-50 hover:ring-zinc-400",
        red: "bg-red-600 text-white hover:bg-red-500",
        orange: "bg-orange-500 text-white hover:bg-orange-400",
        amber: "bg-amber-500 text-black hover:bg-amber-400",
        yellow: "bg-yellow-400 text-black hover:bg-yellow-300",
        lime: "bg-lime-500 text-black hover:bg-lime-400",
        green: "bg-green-500 text-white hover:bg-green-400",
        emerald: "bg-emerald-500 text-white hover:bg-emerald-400",
        teal: "bg-teal-500 text-white hover:bg-teal-400",
        cyan: "bg-cyan-400 text-black hover:bg-cyan-300",
        sky: "bg-sky-500 text-white hover:bg-sky-400",
        blue: "bg-blue-500 text-white hover:bg-blue-400",
        indigo: "bg-indigo-500 text-white hover:bg-indigo-400",
        violet: "bg-violet-500 text-white hover:bg-violet-400",
        purple: "bg-purple-500 text-white hover:bg-purple-400",
        fuchsia: "bg-fuchsia-500 text-white hover:bg-fuchsia-400",
        pink: "bg-pink-500 text-white hover:bg-pink-400",
        rose: "bg-rose-500 text-white hover:bg-rose-400",
    }[props.color];
});
</script>

<template>
    <component
        :is="href ? Link : 'button'"
        :type="type"
        class="inline-flex items-center space-x-1 text-sm font-semibold px-3 py-1.5 rounded"
        :class="colorClasses"
        :href="href"
    >
        <slot />
    </component>
</template>
