<script setup></script>

<template>
    <div
        class="min-h-dvh bg-gray-100 pt-24 bg-[url('/images/bg.jpg')] bg-cover"
    >
        <div class="max-w-5xl mx-auto px-4 grid grid-cols-4 sm:px-6 lg:px-8">
            <div class="col-span-2">
                <div class="bg-white p-8 shadow-2xl">
                    <slot />
                </div>
            </div>
        </div>
    </div>
</template>
