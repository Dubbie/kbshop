<script setup>
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import AppButton from "@/Components/AppButton.vue";

const props = defineProps({
    modelValue: {
        type: Object,
        required: true,
    },
});

const handleOptionValueChange = (newValue, index) => {
    // add the new value
    const newOptions = [...props.modelValue.options];
    newOptions[index] = newValue;

    if (index === props.modelValue.options.length - 1) {
        newOptions.push("");
    }

    emit("update:model-value", {
        ...props.modelValue,
        options: newOptions,
    });
};

const emit = defineEmits(["update:model-value", "delete", "edit", "done"]);
</script>

<template>
    <div class="p-3 border rounded-lg">
        <div class="space-y-3" v-if="modelValue.editing">
            <div>
                <InputLabel for="name" value="Option name" />
                <TextInput
                    placeholder="Option name"
                    v-model="modelValue.name"
                    class="w-full text-sm"
                    @change="$emit('update:model-value', modelValue)"
                />
            </div>
            <div>
                <p class="text-sm">Option values</p>
                <div class="flex flex-col space-y-2">
                    <div
                        class="flex space-x-2 items-center"
                        v-for="(option, index) in modelValue.options"
                        :key="index"
                    >
                        <TextInput
                            placeholder="Add option value"
                            :model-value="modelValue.options[index]"
                            class="w-full text-sm"
                            @update:model-value="
                                (newValue) =>
                                    handleOptionValueChange(newValue, index)
                            "
                        />

                        <AppButton
                            outline
                            color="zinc"
                            v-if="
                                modelValue.options.length > 2 &&
                                modelValue.options[index] !== ''
                            "
                            @click="modelValue.options.splice(index, 1)"
                            >Remove</AppButton
                        >
                    </div>
                </div>
            </div>

            <div class="flex justify-between">
                <AppButton color="zinc" outline @click="$emit('delete')"
                    >Delete</AppButton
                >
                <AppButton @click="$emit('done')">Done</AppButton>
            </div>
        </div>
        <div v-else class="flex items-start justify-between">
            <div>
                <p class="font-semibold mb-1">{{ modelValue.name }}</p>
                <div class="flex text-sm font-medium text-zinc-600 space-x-2">
                    <p
                        v-for="(option, index) in modelValue.options.filter(
                            (option) => option !== '',
                        )"
                        :key="index"
                        class="px-2 py-0.5 rounded-full bg-zinc-100"
                    >
                        {{ option }}
                    </p>
                </div>
            </div>

            <AppButton color="zinc" outline @click="$emit('edit')"
                >Edit</AppButton
            >
        </div>
    </div>
</template>
