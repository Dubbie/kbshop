<script setup>
import AppButton from "@/Components/AppButton.vue";
import StatisticsCard from "@/Components/StatisticsCard.vue";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import {
    IconCashBanknoteFilled,
    IconUserFilled,
    IconShoppingCartFilled,
    IconArchiveFilled,
    IconPlus,
} from "@tabler/icons-vue";

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
</script>

<template>
    <AdminLayout>
        <div class="max-w-7xl mx-auto px-4 pt-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-4 gap-6">
                <div class="bg-white rounded p-4 row-span-2 col-span-2">
                    <p class="font-medium text-sm">Revenue</p>
                    <p class="font-bold text-2xl">
                        $9 246<span
                            class="ml-2 text-sm text-green-500 font-medium"
                            >(+8.26%)</span
                        >
                    </p>
                </div>
                <StatisticsCard
                    color="teal"
                    title="Total Revenue"
                    value="$9 246"
                    :icon="IconCashBanknoteFilled"
                    description="+8.26% More earning than usual"
                />
                <StatisticsCard
                    color="amber"
                    title="Total Customers"
                    value="25 768"
                    :icon="IconUserFilled"
                    description="-5.65% Less users than usual"
                />
                <StatisticsCard
                    color="indigo"
                    title="Total Orders"
                    :icon="IconShoppingCartFilled"
                    value="5 125"
                    description="+8.26% More earning than usual"
                />
                <StatisticsCard
                    color="sky"
                    title="Total Products"
                    value="126"
                    :icon="IconArchiveFilled"
                    description="+8.26% More earning than usual"
                />
            </div>

            <div class="bg-white rounded mt-6 p-4">
                <div class="flex items-center justify-between mb-4">
                    <p class="font-semibold text-xl tracking-tight">Products</p>

                    <div>
                        <AppButton :href="route('admin.product.create')">
                            <IconPlus size="16" stroke-width="3" />
                            <span>Add new</span>
                        </AppButton>
                    </div>
                </div>

                <table class="w-full">
                    <thead class="text-sm">
                        <tr class="border-b">
                            <th class="px-2 py-1 font-semibold text-center">
                                No
                            </th>
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
                                Views
                            </th>
                        </tr>
                    </thead>
                    <tbody class="text-sm">
                        <tr v-for="(product, index) in products">
                            <td class="p-2 text-center">
                                <p>{{ index + 1 }}</p>
                            </td>
                            <td class="p-2">
                                <img
                                    src="https://picsum.photos/200"
                                    class="aspect-square h-8 block mx-auto rounded"
                                />
                            </td>
                            <td class="p-2 w-full">{{ product.name }}</td>
                            <td class="p-2 text-center whitespace-nowrap">
                                {{ formatDate(product.updated_at) }}
                            </td>
                            <td class="p-2 text-end">
                                <p>{{ product.views || 0 }}</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AdminLayout>
</template>
