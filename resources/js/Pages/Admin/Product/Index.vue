<script setup>
import AppButton from "@/Components/AppButton.vue";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { IconPlus, IconPencil, IconTrash } from "@tabler/icons-vue";

const props = defineProps({
    products: Object,
});

const formatDate = (date) => {
    return new Date(date).toLocaleDateString("en-US", {
        day: "numeric",
        month: "short",
        year: "numeric",
        hour: "numeric",
        minute: "numeric",
        hour12: false,
    });
};

const iconSize = 20;
const iconStroke = 1.5;

const deleteProduct = (product) => {
    if (confirm("Are you sure you want to delete this product?")) {
        axios
            .delete(route("api.product.destroy", product.id))
            .then(() => {
                console.log("Product deleted");
                window.location.reload();
            })
            .catch((error) => {
                console.log(error);
            });
    }
};
</script>

<template>
    <AdminLayout>
        <template #header>
            <h1 class="text-xl font-bold">Products</h1>

            <div class="flex space-x-2">
                <AppButton :href="route('admin.product.create')">
                    <IconPlus size="16" stroke-width="3" />
                    <span>Add new</span>
                </AppButton>
            </div>
        </template>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded p-4">
                <table class="w-full">
                    <thead class="text-sm">
                        <tr class="border-b">
                            <th class="px-2 py-1 font-semibold text-center">
                                Image
                            </th>
                            <th class="px-2 py-1 font-semibold text-start">
                                Name
                            </th>
                            <th class="px-2 py-1 font-semibold text-center">
                                Updated
                            </th>
                            <th class="px-2 py-1 font-semibold text-end">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="text-sm">
                        <tr v-for="product in products">
                            <td class="px-2 py-1">
                                <img
                                    src="https://picsum.photos/200"
                                    class="aspect-square h-8 block mx-auto rounded"
                                />
                            </td>
                            <td class="px-2 py-1">{{ product.name }}</td>
                            <td class="px-2 py-1 text-center">
                                {{ formatDate(product.updated_at) }}
                            </td>
                            <td class="px-2 py-1 text-end">
                                <div class="flex justify-end space-x-1">
                                    <div>
                                        <IconPencil
                                            :size="iconSize"
                                            :stroke-width="iconStroke"
                                        />
                                    </div>
                                    <div>
                                        <IconTrash
                                            :size="iconSize"
                                            :stroke-width="iconStroke"
                                            @click="deleteProduct(product)"
                                        />
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AdminLayout>
</template>
