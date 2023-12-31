<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function archive(Request $request)
    {
        $products = Product::select('id', 'name', 'price', 'slug')->with('productImage');

        if (isset($request->search)) {
            $products->where('name', 'like', '%' . $request->search . '%');
        }

        return Inertia::render('Index', ['products' => $products->paginate(6), 'search' => $request->search]);
    }

    public function index($product)
    {

        $product = Product::where('slug', $product)->with('productImage')->first();

        return Inertia::render('Product/Index', ['product' => $product]);
    }
}
