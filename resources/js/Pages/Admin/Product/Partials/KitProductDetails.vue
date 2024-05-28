<script setup>
import { computed, inject } from "vue";

const props = defineProps({
    productId: {
        type: Number,
        required: true,
    },
});

const products = inject("baseProducts");

const product = computed(() => {
    return products.value.find((product) => product.id === props.productId);
});
</script>

<template>
    <div class="flex items-center space-x-2 mt-2">
        <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke-width="1.5"
            stroke="currentColor"
            class="size-6 text-zinc-500"
        >
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z"
            />
        </svg>

        <p class="text-xs text-zinc-500">
            {{ product.product.name }} - Current price:
            <span class="text-black">${{ product.price }}</span>
        </p>
    </div>
</template>
