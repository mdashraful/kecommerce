<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function showDetails($slug)
    {
        $product = Product::where('slug', $slug)
            ->where('active', 1)
            ->first();

        if(is_null($product))
        {
            return redirect()->route('frontend.home');
        }

        return view('frontend.products.details', compact('product'));
    }
}
