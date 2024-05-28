<script setup>
import SidebarNavLink from "./SidebarNavLink.vue";
import { computed } from "vue";
import { IconDashboard, IconTag } from "@tabler/icons-vue";

const currentRoute = computed(() => route().current());

const iconSize = 24;
const iconStroke = 1.5;

const isActive = (href) => {
    return currentRoute.value === href;
};
</script>

<template>
    <div class="flex flex-col w-64 fixed z-50 inset-y-0 bg-zinc-950 text-white">
        <div class="flex-1 flex flex-col gap-y-4 px-4 pt-10 overflow-y-auto">
            <div class="flex flex-col items-center">
                <img
                    :src="$page.props.auth.user.profile_photo_url"
                    alt=""
                    class="size-14 rounded-2xl mb-1"
                />
                <p class="font-bold text-lg">
                    {{ $page.props.auth.user.name }}
                </p>
                <p class="text-xs text-zinc-300">
                    {{ $page.props.auth.user.email }}
                </p>
            </div>

            <div>
                <SidebarNavLink
                    :href="route('dashboard')"
                    :active="isActive('dashboard')"
                >
                    <IconDashboard
                        :size="iconSize"
                        :stroke-width="iconStroke"
                    />
                    <p>Dashboard</p>
                </SidebarNavLink>
                <SidebarNavLink
                    :href="route('admin.product.index')"
                    :active="route().current('admin.product.*')"
                >
                    <IconTag :size="iconSize" :stroke-width="iconStroke" />
                    <p>Products</p>
                </SidebarNavLink>
                <SidebarNavLink :href="route('storefront')">
                    <p>Check store</p>
                </SidebarNavLink>
            </div>
        </div>
    </div>
</template>
