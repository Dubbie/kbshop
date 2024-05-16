<?php

namespace Database\Seeders;

use App\Models\AttributeOption;
use App\Models\Product;
use App\Models\Sku;
use App\Models\Attribute;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $attributesMapping = Attribute::pluck('id', 'name')->toArray();
        $attributes = Attribute::with('attributeOptions')->get()->toArray();

        // Generate all possible combinations
        $attributeCombinations = [[]];
        foreach ($attributes as $attribute) {
            $attributeValues = array_column($attribute['attribute_options'], 'value');
            $newCombinations = [];
            foreach ($attributeCombinations as $combination) {
                foreach ($attributeValues as $value) {
                    $newCombinations[] = array_merge($combination, [$attribute['name'] => $value]);
                }
            }
            $attributeCombinations = $newCombinations;
        }

        $productsConfig = [];
        foreach ($attributeCombinations as $attributeCombination) {
            $productsConfig[] = [
                'name' => 'iPhone',
                'slug' => 'iphone',
                'description' => 'Description of iPhone',
                'price' => fake()->randomNumber(4),
                'attributes' => $attributeCombination
            ];
        }

        // Loop through products, create entries, and assign SKUs
        foreach ($productsConfig as $productData) {
            DB::transaction(function () use ($productData, $attributesMapping) {
                // Create product entry
                $product = Product::where('name', $productData['name'])->first();
                if (!$product) {
                    $product = Product::create([
                        'name' => $productData['name'],
                        'slug' => $productData['slug'],
                    ]);
                }

                // create sku code based on attributes
                $skuCode = implode('-', array_values($productData['attributes']));

                // Create SKU for the product
                $sku = Sku::create([
                    'product_id' => $product->id,
                    'price' => $productData['price'],
                    'code' => $skuCode,
                ]);

                // Associate attributes and attribute options with SKU
                foreach ($productData['attributes'] as $attributeName => $optionValue) {
                    $attributeId = $attributesMapping[$attributeName] ?? null;
                    if ($attributeId) {
                        // Find or create attribute option
                        $attributeOption = AttributeOption::firstOrCreate([
                            'attribute_id' => $attributeId,
                            'value' => $optionValue,
                        ]);

                        // Attach attribute option to SKU
                        $sku->attributeOptions()->attach($attributeOption->id);
                    }
                }
            });
        }
    }
}
