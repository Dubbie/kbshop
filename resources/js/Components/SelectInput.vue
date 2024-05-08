<script setup>
import { computed, ref } from "vue";
import {
    Listbox,
    ListboxButton,
    ListboxOptions,
    ListboxOption,
} from "@headlessui/vue";

const props = defineProps({
    options: {
        type: Array,
        required: true,
    },
    modelValue: {
        type: [Number, String],
        required: true,
    },
});

const selectedItem = ref(props.modelValue);

const selectedLabel = computed(() => {
    return props.options.find((item) => item.value === selectedItem.value)
        .label;
});
</script>

<template>
    <Listbox v-model="selectedItem" as="div" class="relative">
        <ListboxButton
            class="border border-zinc-300 rounded-md px-3 py-1.5 text-sm flex items-center justify-between"
        >
            <p>{{ selectedLabel }}</p>
            <svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 16 16"
                fill="currentColor"
                class="w-4 h-4 ms-1"
            >
                <path
                    fill-rule="evenodd"
                    d="M5.22 10.22a.75.75 0 0 1 1.06 0L8 11.94l1.72-1.72a.75.75 0 1 1 1.06 1.06l-2.25 2.25a.75.75 0 0 1-1.06 0l-2.25-2.25a.75.75 0 0 1 0-1.06ZM10.78 5.78a.75.75 0 0 1-1.06 0L8 4.06 6.28 5.78a.75.75 0 0 1-1.06-1.06l2.25-2.25a.75.75 0 0 1 1.06 0l2.25 2.25a.75.75 0 0 1 0 1.06Z"
                    clip-rule="evenodd"
                />
            </svg>
        </ListboxButton>
        <ListboxOptions
            class="absolute z-10 bg-white border border-zinc-300 rounded-md mt-1 py-1 px-1"
        >
            <ListboxOption
                v-for="option in props.options"
                :key="option.id"
                :value="option.value"
                v-slot="{ active, selected }"
            >
                <div
                    class="px-2 py-1 text-sm rounded cursor-pointer"
                    :class="{
                        'bg-indigo-600 text-white': active && !selected,
                        'text-zinc-700': !active && !selected,
                        'bg-zinc-200 hover:bg-indigo-600 hover:text-white':
                            selected,
                    }"
                >
                    <p>{{ option.label }}</p>
                </div>
            </ListboxOption>
        </ListboxOptions>
    </Listbox>
</template>
