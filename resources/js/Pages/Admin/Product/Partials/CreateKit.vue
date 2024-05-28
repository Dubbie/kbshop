<script setup>
import AppButton from "@/Components/AppButton.vue";
import CreateKitOption from "./CreateKitOption.vue";
import { computed, onMounted, provide, ref } from "vue";

const props = defineProps({
    modelValue: {
        type: Object,
        required: true,
    },
});

const loading = ref(true);
const baseProducts = ref([]);
const productOptions = computed(() => {
    let options = [
        {
            label: "No product",
            value: null,
        },
    ];

    baseProducts.value.forEach((sku) => {
        options.push({
            label: `${sku.product.name} (${sku.code})`,
            value: sku.id,
        });
    });

    return options;
});
provide("baseProducts", baseProducts);

const handleAddOption = () => {
    const newOptions = [...props.modelValue];

    // Add the new default
    newOptions.push({
        name: "",
        values: [{ sku_id: null, value: "", quantity: 1 }],
        editing: true,
        is_visible: true,
    });

    emit("update:model-value", newOptions);
};

const getBaseProducts = () => {
    axios
        .get(route("api.product.base"))
        .then((response) => {
            baseProducts.value = response.data;
        })
        .catch((error) => {
            console.log(error);
        })
        .finally(() => {
            loading.value = false;
        });
};

const handleNewOption = (newValue, index) => {
    // Replace the old attribute with the new one
    const newOptions = [...props.modelValue];
    newOptions[index] = newValue;
    emit("update:model-value", newOptions);
};

const handleProductChosen = (index, valueIndex) => {
    const current = props.modelValue[index].values[valueIndex];
    const product = baseProducts.value.find((product) => {
        return product.id === current.sku_id;
    });

    if (!product) {
        return;
    }

    // Update the value to be the name of the product
    props.modelValue[index].values[valueIndex].value = product.product.name;
};

const emit = defineEmits(["update:model-value"]);

onMounted(() => {
    getBaseProducts();
});
</script>

<template>
    <div>
        <h2 class="text-2xl font-bold">Kit Creator</h2>

        <div v-if="!loading">
            <p class="text-sm text-zinc-500 mb-3">
                Please choose the selectable options.
            </p>

            <div v-if="modelValue.length">
                <CreateKitOption
                    :options="productOptions"
                    v-for="(option, index) in modelValue"
                    :key="index"
                    :model-value="option"
                    @update:model-value="handleNewOption($event, index)"
                    @done="() => (option.editing = false)"
                    @delete="() => modelValue.splice(index, 1)"
                    @edit="() => (option.editing = true)"
                    @get-product="
                        (valueIndex) => handleProductChosen(index, valueIndex)
                    "
                />

                <AppButton @click="handleAddOption" class="mt-3"
                    >Add another option</AppButton
                >
            </div>
            <div v-else>
                <AppButton @click="handleAddOption"
                    >Add option such as controller, etc</AppButton
                >
            </div>
        </div>

        <div v-else>
            <p>Loading...</p>
        </div>
    </div>
</template>
