<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddSkuToCartRequest;
use App\Http\Requests\RemoveSkuFromCartRequest;
use App\Services\CartService;

class CartApiController extends Controller
{
    private CartService $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function add(AddSkuToCartRequest $request)
    {
        $sku = $request->validated('sku');
        if ($this->cartService->add($sku, 1)) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    public function remove(RemoveSkuFromCartRequest $request)
    {
        $sku = $request->validated('sku');
        if ($this->cartService->remove($sku)) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    public function items()
    {
        return response()->json($this->cartService->list());
    }
}
