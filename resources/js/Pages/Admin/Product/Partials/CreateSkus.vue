<script setup>
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";

const props = defineProps({
    modelValue: {
        type: Object,
        required: true,
    },
});
</script>

<template>
    <div>
        <div class="grid grid-cols-5 gap-3">
            <p class="col-span-3">Combination</p>
            <p>Price</p>
            <p>Sku</p>
        </div>
        <div class="space-y-3">
            <div
                v-for="(sku, index) in modelValue"
                :key="index"
                class="grid grid-cols-5 gap-3"
            >
                <div class="col-span-3">
                    <div class="flex space-x-3">
                        <p
                            v-for="(value, name) in sku.combination"
                            :key="value"
                        >
                            {{ value }}
                        </p>
                    </div>
                </div>
                <div>
                    <TextInput v-model="sku.price" class="w-full text-sm" />
                </div>
                <div>
                    <TextInput v-model="sku.sku" class="w-full text-sm" />
                </div>
            </div>
        </div>
    </div>
</template>
