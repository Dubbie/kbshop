<script setup>
import AppButton from "@/Components/AppButton.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import CreateVariants from "@/Pages/Admin/Product/Partials/CreateVariants.vue";
import { useForm } from "@inertiajs/vue3";

const form = useForm({
    name: "",
    slug: "",
    variants: [],
});

const handleSave = () => {
    console.log(form.data());
    axios.post(route("api.product.store"), form.data()).then((response) => {
        console.log(response);
    });
};
</script>

<template>
    <AdminLayout>
        <template #header>
            <h1 class="text-2xl font-semibold">Add product</h1>
        </template>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded p-4">
                <div class="grid grid-cols-4 gap-6">
                    <div class="col-span-3">
                        <div class="space-y-3">
                            <p class="text-lg font-semibold">Basics</p>

                            <div>
                                <InputLabel for="name" value="Name" />
                                <TextInput
                                    placeholder="Product name"
                                    color="dark"
                                    class="w-full"
                                    v-model="form.name"
                                />
                            </div>

                            <div>
                                <InputLabel for="slug" value="Slug" />
                                <TextInput
                                    placeholder="Slug"
                                    class="w-full"
                                    color="dark"
                                    v-model="form.slug"
                                />
                            </div>

                            <CreateVariants v-model="form.variants" />

                            <div v-if="form.variants.length > 0">
                                <p>
                                    Please fill out the SKUs for the variants!
                                </p>
                            </div>

                            <div>
                                <AppButton @click="handleSave">Save</AppButton>
                            </div>
                        </div>
                    </div>

                    <div>
                        <p>Category, publishing</p>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
