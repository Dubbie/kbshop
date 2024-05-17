<script setup>
import AppButton from "@/Components/AppButton.vue";
import AdminLayout from "@/Layouts/AdminLayout.vue";

const props = defineProps({
    products: Object,
});
</script>

<template>
    <AdminLayout>
        <div>
            <div class="max-w-7xl mx-auto px-4 mt-20 sm:px-6 lg:px-8">
                <AppButton :href="route('admin.product.create')"
                    >Add product</AppButton
                >

                <table class="w-full">
                    <thead>
                        <tr>
                            <th class="text-start">Name</th>
                            <th>Updated</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="product in products">
                            <td>{{ product.name }}</td>
                            <td class="text-center">
                                {{ product.updated_at }}
                            </td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AdminLayout>
</template>
