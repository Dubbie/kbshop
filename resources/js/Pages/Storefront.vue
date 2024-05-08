<script setup>
import AppButton from "@/Components/AppButton.vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
</script>

<template>
    <GuestLayout>
        <div class="max-w-7xl mx-auto px-4 mt-20 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 gap-20 items-center">
                <div>
                    <h1 class="text-5xl font-black mb-6">
                        Storefront big heading that goes here
                    </h1>

                    <p class="text-lg font-medium text-zinc-400">
                        Storefront small text about current new products. Lorem,
                        ipsum dolor sit amet consectetur adipisicing elit.
                    </p>

                    <div class="mt-6">
                        <AppButton color="blue">Shop now</AppButton>
                    </div>
                </div>

                <div class="ml-auto">
                    <img src="https://picsum.photos/900" alt="" />
                </div>
            </div>
        </div>

        <div class="bg-zinc-100">
            <div class="max-w-7xl mx-auto px-4 py-20 sm:px-6 lg:px-8">
                <h2 class="text-xl font-bold mb-6">Shop by category</h2>

                <p>Grid of products</p>
            </div>
        </div>
    </GuestLayout>
</template>
