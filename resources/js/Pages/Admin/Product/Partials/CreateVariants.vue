<script setup>
import AppButton from "@/Components/AppButton.vue";
import { computed } from "vue";
import CreateAttribute from "./CreateAttribute.vue";

const props = defineProps({
    modelValue: {
        type: Object,
        required: true,
    },
});

const buttonLabel = computed(() => {
    return props.modelValue.length
        ? "Add another option"
        : "Add options like size or color";
});

const addAttribute = () => {
    // Add an empty default attribute
    const newAttributes = [...props.modelValue];

    // Add the new attribute
    newAttributes.push({
        name: "",
        options: [""],
        editing: true,
    });

    // Update the model
    emit("update:model-value", newAttributes);
};

const handleAttributeUpdate = (newValue, index) => {
    // Replace the old attribute with the new one
    const newAttributes = [...props.modelValue];
    newAttributes[index] = newValue;
    emit("update:model-value", newAttributes);
};

const emit = defineEmits(["update:model-value"]);
</script>

<template>
    <div class="border p-3 rounded-xl">
        <p class="font-semibold text-lg mb-3">Variants</p>

        <div class="mb-3">
            <div v-if="modelValue.length">
                <CreateAttribute
                    v-for="(attribute, index) in modelValue"
                    :key="index"
                    :model-value="attribute"
                    @update:model-value="
                        (newValue) => handleAttributeUpdate(newValue, index)
                    "
                    @delete="() => modelValue.splice(index, 1)"
                    @done="() => (attribute.editing = false)"
                    @edit="() => (attribute.editing = true)"
                />
            </div>
        </div>

        <AppButton color="blue" @click="addAttribute">{{
            buttonLabel
        }}</AppButton>
    </div>
</template>
