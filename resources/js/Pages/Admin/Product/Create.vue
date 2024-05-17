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
        <div class="max-w-7xl mx-auto px-4 mt-10 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-semibold mb-6">Add product</h1>

            <div class="grid grid-cols-4 gap-6">
                <div class="col-span-3">
                    <div class="space-y-3">
                        <div class="space-y-3 border rounded-xl p-3">
                            <p class="text-lg font-semibold">Product basics</p>

                            <div>
                                <InputLabel for="name" value="Name" />
                                <TextInput
                                    placeholder="Product name"
                                    class="w-full"
                                    v-model="form.name"
                                />
                            </div>

                            <div>
                                <InputLabel for="slug" value="Slug" />
                                <TextInput
                                    placeholder="Slug"
                                    class="w-full"
                                    v-model="form.slug"
                                />
                            </div>
                        </div>

                        <CreateVariants v-model="form.variants" />

                        <div>
                            <AppButton @click="handleSave">Save</AppButton>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="border p-3 rounded-xl">
                        <p>Category etc</p>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
