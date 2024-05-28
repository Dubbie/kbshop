<script setup>
import InputLabel from "@/Components/InputLabel.vue";
import SelectInput from "@/Components/SelectInput.vue";
import TextInput from "@/Components/TextInput.vue";
import AppButton from "@/Components/AppButton.vue";
import Checkbox from "@/Components/Checkbox.vue";
import KitProductDetails from "./KitProductDetails.vue";

const props = defineProps({
    options: {
        type: Array,
        required: true,
    },
    modelValue: {
        type: Object,
        required: true,
    },
});

const handleValueChange = () => {
    // Check if we have to add another row to the array
    if (!isLastValueEmpty()) {
        addNewValue();
    }
};

const handleProductSelected = (newValue, index) => {
    // update the product id
    const newValues = [...props.modelValue.values];
    newValues[index].sku_id = newValue;
    emit("update:model-value", {
        ...props.modelValue,
        values: newValues,
    });

    emit("get-product", index);
};

const isLastValueEmpty = () => {
    return (
        props.modelValue.values[props.modelValue.values.length - 1].value === ""
    );
};

const addNewValue = () => {
    const newValues = [...props.modelValue.values];

    newValues.push({
        sku_id: null,
        value: "",
        quantity: 1,
    });

    emit("update:model-value", {
        ...props.modelValue,
        values: newValues,
    });
};

const emit = defineEmits([
    "update:model-value",
    "done",
    "delete",
    "get-product",
    "edit",
]);
</script>

<template>
    <div>
        <div v-if="modelValue.editing">
            <div class="flex space-x-10 items-end">
                <div class="flex-1">
                    <InputLabel for="name" value="Option name" />
                    <TextInput
                        placeholder="Option name"
                        v-model="modelValue.name"
                        class="w-full text-sm"
                    />
                </div>
                <div class="mb-2">
                    <label
                        class="flex items-center space-x-3 text-sm text-zinc-600 font-medium"
                    >
                        <Checkbox
                            :checked="modelValue.is_visible"
                            @update:checked="modelValue.is_visible = $event"
                        />
                        <p>Visible on storefront</p>
                    </label>
                </div>
            </div>
            <div class="mt-2">
                <div class="flex space-x-3">
                    <div
                        class="flex-1 grid grid-cols-5 gap-3 text-sm text-zinc-700 font-medium mb-1"
                    >
                        <p class="col-span-2">Associated product</p>
                        <p class="col-span-2">Option values</p>
                        <p>Quantity</p>
                    </div>
                    <AppButton
                        outline
                        color="zinc"
                        class="opacity-0 pointer-events-none"
                        >Remove</AppButton
                    >
                </div>
                <div class="space-y-3">
                    <div
                        v-for="(value, index) in modelValue.values"
                        :key="index"
                    >
                        <div class="flex space-x-3">
                            <div class="grid grid-cols-5 gap-3 flex-1">
                                <div class="col-span-2">
                                    <SelectInput
                                        :model-value="value.sku_id"
                                        :options="options"
                                        class="w-full"
                                        @update:model-value="
                                            (newValue) =>
                                                handleProductSelected(
                                                    newValue,
                                                    index,
                                                )
                                        "
                                    />
                                </div>
                                <div class="col-span-2">
                                    <TextInput
                                        placeholder="Option value"
                                        class="w-full text-sm"
                                        v-model="value.value"
                                        @keyup="handleValueChange()"
                                    />
                                </div>
                                <div>
                                    <TextInput
                                        placeholder="Quantity"
                                        class="w-full text-sm"
                                        v-model="value.quantity"
                                        @keyup="handleValueChange()"
                                    />
                                </div>
                            </div>
                            <div>
                                <AppButton
                                    outline
                                    color="zinc"
                                    :class="{
                                        'opacity-0 pointer-events-none':
                                            index === 0,
                                    }"
                                    @click="modelValue.values.splice(index, 1)"
                                    >Remove</AppButton
                                >
                            </div>
                        </div>

                        <KitProductDetails
                            v-if="value.sku_id !== null"
                            :productId="value.sku_id"
                        />
                    </div>
                </div>

                <div class="flex justify-between mt-3">
                    <AppButton color="zinc" outline @click="$emit('delete')"
                        >Delete</AppButton
                    >
                    <AppButton @click="$emit('done')">Done</AppButton>
                </div>
            </div>
        </div>

        <div v-else class="flex space-x-3">
            <div class="flex-1">
                <p class="font-semibold">{{ modelValue.name }}</p>
                <div class="flex space-x-1">
                    <p
                        v-for="(value, index) in modelValue.values"
                        :key="index"
                        class="text-sm"
                    >
                        {{ value.value }}
                    </p>
                </div>
            </div>
            <div>
                <AppButton outline color="zinc" @click="$emit('edit')"
                    >Edit</AppButton
                >
            </div>
        </div>
    </div>
</template>
