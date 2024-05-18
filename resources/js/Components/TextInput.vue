<script setup>
import { computed, onMounted, ref } from "vue";

const props = defineProps({
    modelValue: String,
    color: {
        type: String,
        default: "white",
    },
});

defineEmits(["update:modelValue"]);

const input = ref(null);

const classes = computed(() => {
    return {
        white: "bg-white ring-zinc-300 focus:ring-2 focus:ring-indigo-500",
        dark: "bg-zinc-100 ring-transparent focus:ring-2 focus:ring-indigo-500",
    }[props.color];
});

onMounted(() => {
    if (input.value.hasAttribute("autofocus")) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
    <input
        ref="input"
        class="px-3 py-1.5 ring-1 border-none rounded focus:outline-none"
        :class="classes"
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
    />
</template>
