<script setup>
import NavLink from "@/Components/NavLink.vue";
import CartButton from "@/Components/CartButton.vue";
import { computed } from "vue";
import { Link } from "@inertiajs/vue3";

const currentRoute = computed(() => route().current());

const isActive = (href) => {
    return currentRoute.value === href;
};
</script>

<template>
    <div class="border-b">
        <nav
            class="max-w-7xl mx-auto px-4 flex items-center justify-between h-16 sm:px-6 lg:px-8"
        >
            <Link :href="route('storefront')">
                <p class="text-sm font-bold">KBShop</p>
            </Link>

            <div class="flex space-x-2">
                <NavLink
                    :href="route('storefront')"
                    :active="isActive('storefront')"
                    >Home</NavLink
                >
                <NavLink
                    :href="route('product.index')"
                    :active="isActive('product.index')"
                    >Products</NavLink
                >
            </div>

            <CartButton />
        </nav>
    </div>
</template>
