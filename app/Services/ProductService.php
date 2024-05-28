<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Attribute;
use App\Models\AttributeOption;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductService {
    public function create(array $data) {
        DB::beginTransaction();

        try {
            $product = Product::create([
                'name' => $data['name'],
                'slug' => $data['slug'],
                'type' => $data['type'],
            ]);


            if (!empty($data['kitOptions'])) {
            // Create the base variant
            $sku = $product->skus()->create([
                'code' => $data['sku'],
                'price' => $data['price'],
            ]);

                foreach ($data['kitOptions'] as $option) {
                    // Create the product attribute
                    $attribute = Attribute::create([
                        'name' => $option['name'],
                        'is_visible' => $option['is_visible'],
                    ]);

                    foreach ($option['values'] as $value) {
                        $attributeOption = AttributeOption::create([
                            'attribute_id' => $attribute->id,
                            'value' => $value['value'],
                            'sku_id' => $value['sku_id'],
                            'quantity' => $value['quantity'],
                        ]);

                        $sku->attributeOptions()->attach($attributeOption->id);
                    }
                }
            }

            if (!empty($data['variants'])) {
                foreach ($data['variants'] as $variant) {
                    // Create the attribute
                    $attribute = Attribute::create([
                        'name' => $variant['name'],
                    ]);

                    foreach ($variant['values'] as $value) {
                        if ($value === null) {
                            continue;
                        }

                        $attributeOption = AttributeOption::create([
                            'attribute_id' => $attribute->id,
                            'value' => $value,
                        ]);
                    }
                }

                // Create the skus and attach to options
                foreach ($data['skus'] as $variant) {
                    $sku = $product->skus()->create([
                        'code' => $variant['sku'],
                        'price' => $variant['price'],
                    ]);

                    foreach ($variant['combination'] as $attributeName => $attributeValue) {
                        $attributeOption = AttributeOption::where('value', $attributeValue)->first();
                        $sku->attributeOptions()->attach($attributeOption->id);
                    }
                }
            }

            DB::commit();

            return response()->json($product, 201);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return response()->json([
                'message' => 'Something went wrong while creating the product.',
            ], 500);
        }
    }
}
