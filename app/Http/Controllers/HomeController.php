<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $data = [];
        $data['products'] = Product::select(['id', 'title', 'slug', 'price', 'sale_price'])
                            ->where('active', 1)
                            ->orderby('id', 'desc')
                            ->paginate(9);

        return view('frontend.home', $data);
    }
}
