<script setup>
import { IconLogout, IconBell } from "@tabler/icons-vue";
import TextInput from "./TextInput.vue";
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
    background: {
        type: Boolean,
        default: false,
    },
});

const iconSize = 20;
const iconStroke = 1.5;

const handleLogout = () => {
    const form = useForm({});
    form.post(route("logout"));
};
</script>

<template>
    <div :class="{ 'bg-white': props.background }">
        <div
            class="flex items-center justify-between px-8 py-2 max-w-7xl mx-auto"
        >
            <div>
                <TextInput
                    class="w-64"
                    placeholder="Search..."
                    :color="props.background ? 'dark' : 'white'"
                />
            </div>

            <div class="flex items-center space-x-4">
                <IconBell :size="iconSize" :stroke-width="iconStroke" />
                <button
                    type="button"
                    @click="handleLogout"
                    class="flex items-center space-x-2"
                >
                    <IconLogout :size="iconSize" :stroke-width="iconStroke" />
                    <p class="text-sm font-medium">Logout</p>
                </button>
            </div>
        </div>
    </div>
</template>
