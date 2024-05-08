<script setup>
import { Head } from "@inertiajs/vue3";
import { inject, onMounted, ref } from "vue";
import NavBar from "@/Components/NavBar.vue";

const props = defineProps({
    title: {
        type: String,
        default: "KBShop",
    },
});

const emitter = inject("emitter");
const cart = ref([]);

const updateCart = () => {
    console.log("updating cart");
    axios.get(route("api.cart.items")).then((response) => {
        cart.value = response.data;
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
    <Head :title="title" />
    <div>
        <NavBar />

        <slot />
    </div>
</template>
