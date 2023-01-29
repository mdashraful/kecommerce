<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    public function showCart()
    {
        $data = [];

        $data['cart'] = session()->has('cart') ? session()->get('cart') : [];
        $data['total'] = array_sum(array_column($data['cart'], 'price'));

        return view('frontend.cart', $data);
    }

    public function addToCart(Request $request)
    {   
        $cart = [];
    
        try {
            $this->validate($request, [
                'product_id' => 'required|numeric',
            ]);
        } catch(ValidationException $e) {
            return redirect()->back();
        }

        $product = Product::findOrFail($request->input('product_id')); 

        if (session()->has('cart')) {
            $cart = session()->get('cart');
           
            if(array_key_exists($product->id, $cart)) {
                $cart[$product->id]['quantity'] += 1;

            } else {
                $cart[$product->id] = [ 
                    'title' => $product->title,
                    'quantity' => 1,
                    'price' => ($product->sale_price !== 0 && 
                        $product->sale_price > 0) ? $product->sale_price :   $product->price,            
                ]; 
            }
            
        } else {
            $cart = [ 
                $product->id => [
                    'title' => $product->title,
                    'quantity' => 1,
                    'price' => ($product->sale_price !== 0 && 
                        $product->sale_price > 0) ? $product->sale_price :   $product->price,            
                ],
            ];        
        } 
        session(['cart' => $cart]);
        session()->flash('message', $product->title. ' added to cart.');

        return redirect()->route('cart.show');     
    }
}
