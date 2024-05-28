<script setup>
import AppButton from "@/Components/AppButton.vue";
import InputLabel from "@/Components/InputLabel.vue";
import SelectInput from "@/Components/SelectInput.vue";
import TextInput from "@/Components/TextInput.vue";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import CreateVariants from "@/Pages/Admin/Product/Partials/CreateVariants.vue";
import CreateKit from "@/Pages/Admin/Product/Partials/CreateKit.vue";
import CreateSkus from "@/Pages/Admin/Product/Partials/CreateSkus.vue";
import { useForm } from "@inertiajs/vue3";

const form = useForm({
    name: "",
    slug: "",
    type: "product",
    sku: "",
    price: "",
    variants: [],
    kitOptions: [],
    skus: [],
});

const typeOptions = [
    {
        label: "Product",
        value: "product",
    },
    {
        label: "Kit",
        value: "kit",
    },
];

const handleSave = () => {
    axios
        .post(route("api.product.store"), transformFormData())
        .then((response) => {
            console.log(response);
        });
};

const transformFormData = () => {
    const kitOptions = form.kitOptions.map((option) => {
        const values = option.values.filter((value) => {
            return value.value !== "";
        });

        return {
            name: option.name,
            is_visible: option.is_visible,
            values,
        };
    });

    const variants = form.variants.map((variant) => {
        const values = variant.options.filter((value) => {
            return value.value !== "";
        });

        return {
            name: variant.name,
            values,
        };
    });

    return {
        name: form.name,
        slug: form.slug,
        type: form.type,
        sku: form.sku,
        price: form.price,
        kitOptions,
        variants,
        skus: form.skus,
    };
};

const handleGenerateSlugAndSku = () => {
    const name = form.name;
    const slug = generateSlug(name);

    // generate slug and sku using the same function
    form.slug = slug;
    form.sku = slug;
};

const generateSlug = (name) => {
    return name
        .toLowerCase()
        .replace(/[^a-z0-9-]/gi, "-")
        .replace(/-+/g, "-")
        .replace(/^-|-$/g, "");
};

const handleVariants = (variants) => {
    form.variants = variants;

    generateSkus();
};

const generateSkus = () => {
    // Filter out empty strings from options
    const optionsLists = form.variants.map((attribute) =>
        attribute.options.filter((option) => option.trim() !== ""),
    );

    // Generate all combinations using recursion
    function generateCombinationsRec(
        optionsLists,
        index,
        currentCombination,
        combinations,
    ) {
        if (index === optionsLists.length) {
            // Convert the current combination into an object
            const combinationObj = {};
            currentCombination.forEach((option, idx) => {
                combinationObj[form.variants[idx].name.toLowerCase()] = option;
            });
            // Check if we have sku, if so, generate
            let sku = form.sku;
            if (sku) {
                sku += "-" + Object.values(combinationObj).join("-");
            }
            // Add the combination object to the list of combinations
            combinations.push({
                combination: combinationObj,
                sku: sku || "",
                price: form.price || "",
            });
            return;
        }

        // Iterate over options for the current attribute
        for (let i = 0; i < optionsLists[index].length; i++) {
            // Add the current option to the current combination
            currentCombination.push(optionsLists[index][i]);
            // Recursively generate combinations for the next attribute
            generateCombinationsRec(
                optionsLists,
                index + 1,
                currentCombination,
                combinations,
            );
            // Remove the last option to backtrack and try the next one
            currentCombination.pop();
        }
    }

    const combinations = [];
    generateCombinationsRec(optionsLists, 0, [], combinations);

    form.skus = combinations;
};
</script>

<template>
    <AdminLayout>
        <template #header>
            <h1 class="text-xl font-bold">Add product</h1>
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
                                    class="w-full text-sm"
                                    v-model="form.name"
                                    @keyup="handleGenerateSlugAndSku()"
                                />
                            </div>

                            <div>
                                <InputLabel for="slug" value="Slug" />
                                <TextInput
                                    placeholder="Slug"
                                    class="w-full text-sm"
                                    v-model="form.slug"
                                />
                            </div>

                            <div>
                                <InputLabel for="sku" value="SKU" />
                                <TextInput
                                    placeholder="Product sku"
                                    class="w-full text-sm"
                                    v-model="form.sku"
                                />
                            </div>

                            <div>
                                <InputLabel for="price" value="price" />
                                <TextInput
                                    placeholder="1000"
                                    class="w-full text-sm"
                                    v-model="form.price"
                                />
                            </div>

                            <div>
                                <InputLabel for="type" value="Type" />
                                <SelectInput
                                    color="dark"
                                    v-model="form.type"
                                    :options="typeOptions"
                                />
                            </div>

                            <div v-if="form.type === 'product'">
                                <CreateVariants
                                    :model-value="form.variants"
                                    @update:model-value="handleVariants"
                                />

                                <div v-if="form.variants.length > 0">
                                    <p>
                                        Please fill out the SKUs for the
                                        variants!
                                    </p>

                                    <CreateSkus v-model="form.skus" />
                                </div>
                            </div>

                            <div v-if="form.type === 'kit'">
                                <CreateKit v-model="form.kitOptions" />
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
