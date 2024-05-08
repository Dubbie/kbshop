<script setup>
import { Head, Link } from "@inertiajs/vue3";
import { inject, onMounted, ref } from "vue";

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
        <nav>
            <p>KBShop</p>

            <div class="flex space-x-2">
                <Link href="/">Home</Link>
                <Link :href="route('product.index')">Products</Link>
            </div>
        </nav>

        <div>
            <p>Cart</p>
            <div>
                <div v-for="(qty, item) in cart">
                    <p>{{ item }} - {{ qty }} qty</p>
                    <button type="button" @click="removeFromCart(item)">
                        Remove
                    </button>
                </div>
            </div>
        </div>

        <slot />
    </div>
</template>
