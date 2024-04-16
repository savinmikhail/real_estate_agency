<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Product;

final class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate();

        return view('products.index', compact('products'));
    }
}
