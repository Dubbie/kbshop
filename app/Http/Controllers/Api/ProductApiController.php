<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Models\AttributeOption;
use App\Models\Product;
use App\Models\Sku;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductApiController extends Controller
{
    private ProductService $productService;

    public function __construct(ProductService $productService) {
        $this->productService = $productService;
    }

    public function getBaseProducts() {
        return Sku::whereHas('product', function ($query) {
            return $query->where('type', 'product');
        })->with('product')->get();
    }

    public function getVariant(Product $product, Request $request)
    {
        $product = $product->load('skus.attributeOptions.attribute');
        $variant = null;

        foreach($product->skus as $sku) {
            $attributes = [];

            foreach ($sku->attributeOptions as $option) {
                $attributes[$option->attribute_id] = $option->id;
            }

            if ($this->checkAttributesMatch($request->all(), $attributes)) {
                $variant = $sku;
                break;
            }
        }

        return $variant;
    }

    public function getKitDetails(Product $product, Request $request) {
        $data = $request->all();
        $response = [
            'price' => 0,
            'details' => []
        ];

        foreach ($data as $attributeId => $optionId) {
            $attributeOption = AttributeOption::find($optionId);
            $sku = $attributeOption->sku;

            if ($sku) {
                $response['details'][] = [
                    'attribute' => $attributeId,
                    'product' => $sku
                ];

                $response['price'] += $sku->price * $attributeOption->quantity;
            }
        }

        return response()->json($response);
    }

    public function store(StoreProductRequest $request) {
        return $this->productService->create($request->validated());
    }

    public function destroy(Product $product) {
        return $product->delete();
    }

    private function checkAttributesMatch(array $input, array $found) {
        foreach ($input as $key => $value) {
            if (!isset($found[$key]) || $found[$key] != $value) {
                return false;
            }
        }

        return true;
    }
}
