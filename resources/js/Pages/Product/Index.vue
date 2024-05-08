<script setup>
import { Link } from "@inertiajs/vue3";
import GuestLayout from "@/Layouts/GuestLayout.vue";

const props = defineProps({
    products: Array,
});
</script>

<template>
    <GuestLayout>
        <div class="max-w-7xl mx-auto px-4 mt-20 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold mb-6">Products</h1>

            <div class="grid grid-cols-4 gap-6">
                <Link
                    v-for="product in products"
                    class="flex flex-col group"
                    :href="route('product.show', product.slug)"
                >
                    <img
                        src="https://picsum.photos/200"
                        alt=""
                        class="rounded-lg group-hover:opacity-75"
                    />

                    <div class="mt-3">
                        <p class="text-sm font-semibold">{{ product.name }}</p>
                    </div>
                </Link>
            </div>
        </div>
    </GuestLayout>
</template>
