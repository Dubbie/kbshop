<script setup>
import { computed, inject, onMounted, ref } from "vue";
import Dropdown from "@/Components/Dropdown.vue";

const emitter = inject("emitter");
const cart = ref({});
const itemLength = computed(() => {
    let length = 0;

    Object.keys(cart.value).forEach((key) => {
        length += cart.value[key];
    });

    return length;
});

const updateCart = () => {
    console.log("updating cart");
    axios.get(route("api.cart.items")).then((response) => {
        console.log("response", response.data);
        cart.value = response.data;

        console.log("cart", cart.value);
    });
};

const removeFromCart = (item) => {
    console.log("removing from cart", item);
    axios
        .delete(
            route("api.cart.remove", {
                sku: item,
            }),
        )
        .then(() => {
            updateCart();
        });
};

onMounted(() => {
    emitter.on("updateCart", updateCart);

    updateCart();
});
</script>

<template>
    <Dropdown>
        <template #trigger>
            <div class="relative cursor-pointer">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20"
                    fill="currentColor"
                    class="w-5 h-5"
                >
                    <path
                        fill-rule="evenodd"
                        d="M6 5v1H4.667a1.75 1.75 0 0 0-1.743 1.598l-.826 9.5A1.75 1.75 0 0 0 3.84 19H16.16a1.75 1.75 0 0 0 1.743-1.902l-.826-9.5A1.75 1.75 0 0 0 15.333 6H14V5a4 4 0 0 0-8 0Zm4-2.5A2.5 2.5 0 0 0 7.5 5v1h5V5A2.5 2.5 0 0 0 10 2.5ZM7.5 10a2.5 2.5 0 0 0 5 0V8.75a.75.75 0 0 1 1.5 0V10a4 4 0 0 1-8 0V8.75a.75.75 0 0 1 1.5 0V10Z"
                        clip-rule="evenodd"
                    />
                </svg>

                <div
                    class="absolute top-0 right-0 text-xs text-white bg-indigo-400 rounded-full size-2 text-center font-bold"
                    v-if="itemLength > 0"
                ></div>
            </div>
        </template>

        <template #content>
            <div v-if="itemLength > 0">
                <div
                    v-for="(quantity, item) in cart"
                    :key="item"
                    class="flex items-center justify-between space-x-6 px-4 py-2 border-b border-zinc-300"
                >
                    <div class="flex items-center">
                        <p>{{ item }}</p>
                    </div>

                    <div class="flex items-center">
                        <p>{{ quantity }}</p>

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20"
                            fill="currentColor"
                            class="w-5 h-5 ms-2"
                            @click="removeFromCart(item)"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM7 9a1 1 0 000 2h6a1 1 0 100-2H7z"
                                clip-rule="evenodd"
                            />
                        </svg>
                    </div>
                </div>
            </div>
            <div v-else>
                <p class="px-3 py-1.5 text-sm text-zinc-500">
                    Your cart is empty.
                </p>
            </div>
        </template>
    </Dropdown>
</template>
