<script setup>
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    products: Array,
});
</script>

<template>
    <div>
        <p>Products</p>

        <Link
            v-for="product in products"
            :href="route('product.show', product.slug)"
            >{{ product.name }}</Link
        >
    </div>
</template>
