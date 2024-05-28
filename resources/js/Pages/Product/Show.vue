<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { onMounted, ref, inject } from "vue";
import { useForm } from "@inertiajs/vue3";
import InputLabel from "@/Components/InputLabel.vue";
import SelectInput from "@/Components/SelectInput.vue";
import AppButton from "@/Components/AppButton.vue";

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

const getAttributesWithOptions = () => {
    let attributes = [];

    Object.keys(props.attributes).forEach((key) => {
        const attr = props.attributes[key];
        let options = [];

        Object.keys(attr.options).forEach((optionKey) => {
            options.push({
                label: attr.options[optionKey],
                value: parseInt(optionKey),
            });
        });

        attributes.push({
            label: attr.label,
            id: attr.id,
            options: options,
            isVisible: attr.is_visible,
        });
    });

    return attributes;
};

const form = useForm(getFormData());
const attributeOptions = getAttributesWithOptions();

const emitter = inject("emitter");
const price = ref(0);
const sku = ref(null);
const kit = ref(null);

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

const getProductDetails = () => {
    if (props.product.type === "kit") {
        getKit();
    } else getVariant();
};

const getKit = () => {
    axios
        .get(route("api.product.kit", props.product.id), {
            params: form.data(),
        })
        .then((response) => {
            kit.value = response.data;
            price.value = formatPrice(response.data.price);
        });
};

const getVariant = () => {
    axios
        .get(route("api.product.variant", props.product.id), {
            params: form.data(),
        })
        .then((response) => {
            price.value = formatPrice(response.data.price);
            sku.value = response.data.code;
        });
};

const formatPrice = (price) => {
    // no decimals, space between thousands
    return price.toLocaleString("en-US");
};

const handleChange = (id, value) => {
    form[id] = value;
    getProductDetails();
};

onMounted(() => {
    getProductDetails();
});
</script>

<template>
    <GuestLayout title="Product">
        <div class="max-w-7xl mx-auto px-4 mt-20 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 gap-20">
                <div>
                    <img
                        src="https://picsum.photos/600/600"
                        :alt="product.name"
                        class="rounded-2xl shadow shadow-zinc-800/20"
                    />
                </div>
                <div>
                    <div class="mb-6">
                        <h1 class="text-3xl font-bold mb-1">
                            {{ product.name }}
                        </h1>
                    </div>

                    <div class="space-y-3">
                        <div
                            v-for="attribute in attributeOptions.filter(
                                (a) => a.isVisible,
                            )"
                        >
                            <InputLabel
                                for="name"
                                :value="attribute.label"
                                class="mb-1"
                            />

                            <SelectInput
                                :model-value="form[attribute.id]"
                                :options="attribute.options"
                                @update:model-value="
                                    handleChange(attribute.id, $event)
                                "
                            />
                        </div>
                    </div>

                    <div class="mt-6">
                        <p
                            class="font-medium text-zinc-500 text-sm leading-none"
                        >
                            Price
                        </p>
                        <p class="font-bold text-3xl whitespace-nowrap">
                            {{ price }} €
                        </p>
                    </div>

                    <AppButton
                        color="blue"
                        @click="handleAddToCart"
                        class="mt-3"
                        >Add to cart</AppButton
                    >
                </div>
            </div>
        </div>
    </GuestLayout>
</template>
