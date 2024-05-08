<script setup>
import NavLink from "@/Components/NavLink.vue";
import CartButton from "@/Components/CartButton.vue";
</script>

<template>
    <div class="border-b">
        <nav
            class="max-w-7xl mx-auto px-4 flex items-center justify-between h-16 sm:px-6 lg:px-8"
        >
            <p class="text-sm font-bold">KBShop</p>

            <div class="flex space-x-2">
                <NavLink :href="route('product.index')">Products</NavLink>
            </div>

            <CartButton />
        </nav>
    </div>
</template>
