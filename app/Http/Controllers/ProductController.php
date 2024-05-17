<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function index()
    {
        return Inertia::render('Product/Index', [
            'products' => Product::all(),
        ]);
    }

    public function show(string $product)
    {
        $product = Product::where('slug', $product)->with('skus.attributeOptions.attribute')->firstOrFail();


        $attributes = $this->extractAttributes($product->skus);

        return Inertia::render('Product/Show', [
            'product' => $product,
            'attributes' => $attributes
        ]);
    }

    private function extractAttributes($skus)
    {
        $attributes = [];

        foreach ($skus as $sku) {
            foreach ($sku->attributeOptions as $option) {
                $attributeName = $option->attribute->name;

                if (!isset($attributes[$attributeName]['id'])) {
                    $attributes[$attributeName]['id'] = $option->attribute->id;
                    $attributes[$attributeName]['label'] = $attributeName;
                    $attributes[$attributeName]['options'] = [];
                }

                if (!isset($attributes[$attributeName]['options'][$option->id])) {
                    $attributes[$attributeName]['options'][$option->id] = $option->value;
                }
            }
        }

        return $attributes;
    }
}
