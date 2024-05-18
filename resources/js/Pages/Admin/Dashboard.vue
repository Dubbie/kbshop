<script setup>
import StatisticsCard from "@/Components/StatisticsCard.vue";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import {
    IconCashBanknoteFilled,
    IconUserFilled,
    IconShoppingCartFilled,
    IconArchiveFilled,
} from "@tabler/icons-vue";
</script>

<template>
    <AdminLayout background>
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
                <p class="font-bold text-2xl tracking-tight">Products</p>
            </div>
        </div>
    </AdminLayout>
</template>
