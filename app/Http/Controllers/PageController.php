<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Inertia\Inertia;

class PageController extends Controller
{
    public function dashboard()
    {
        return Inertia::render('Admin/Dashboard', [
            'products' => Product::all(),
        ]);
    }
}
