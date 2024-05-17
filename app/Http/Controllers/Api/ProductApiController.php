<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductApiController extends Controller
{
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

    public function store(StoreProductRequest $request) {
        dd($request->validated());
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
