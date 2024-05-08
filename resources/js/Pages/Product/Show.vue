<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { onMounted, ref, inject } from "vue";
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
    product: Object,
    attributes: Object,
});

const getFormData = () => {
    let attributes = {};

    Object.keys(props.attributes).forEach((key) => {
        attributes[props.attributes[key].id] = parseInt(
            Object.keys(props.attributes[key].options)[0],
        );
    });

    return attributes;
};
const form = useForm(getFormData());

const emitter = inject("emitter");
const price = ref(0);
const sku = ref(null);

const handleAddToCart = () => {
    axios
        .post(route("api.cart.add"), {
            sku: sku.value,
        })
        .then((response) => {
            console.log(response);

            emitter.emit("updateCart");
        });
};

const getPrice = () => {
    axios
        .get(route("api.product.variant", props.product.id), {
            params: form.data(),
        })
        .then((response) => {
            price.value = response.data.price;
            sku.value = response.data.code;
        });
};

onMounted(() => {
    getPrice();
});
</script>

<template>
    <GuestLayout title="Product">
        <div class="grid grid-cols-2 gap-6">
            <div>
                <img src="https://picsum.photos/400/600" :alt="product.name" />
            </div>
            <div>
                <h1 class="text-3xl font-bold">{{ product.name }}</h1>

                <div>
                    <div v-for="attribute in attributes">
                        <p>{{ attribute.label }}</p>

                        <select
                            :name="attribute.label"
                            :id="attribute.label"
                            v-model="form[attribute.id]"
                            @change="getPrice"
                        >
                            <option
                                v-for="(option, index) in attribute.options"
                                :value="parseInt(index)"
                            >
                                {{ option }}
                            </option>
                        </select>
                    </div>
                </div>

                <div>
                    <p>Price</p>
                    <p>{{ price }} €</p>
                </div>

                <div>
                    <button @click="handleAddToCart">Add to cart</button>
                </div>
            </div>
        </div>
    </GuestLayout>
</template>
