<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Models\Order;

class CartController extends Controller
{
    public function showCart()
    {
        $data = [];

        $data['cart'] = session()->has('cart') ? session()->get('cart') : [];
        $data['total_amount'] = array_sum(array_column($data['cart'], 'item_price'));

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
        $unit_price = ($product->sale_price !== 0 && 
            $product->sale_price > 0) ? $product->sale_price :   $product->price;
        if (session()->has('cart')) {
            $cart = session()->get('cart');
           
            if(array_key_exists($product->id, $cart)) {
                $cart[$product->id]['quantity'] += 1;
                $cart[$product->id]['item_price'] = $unit_price * $cart[$product->id]['quantity'];
            } else {
                $cart[$product->id] = [ 
                    'title' => $product->title,
                    'quantity' => 1,
                    'unit_price' => $unit_price,
                    'item_price' => $unit_price,
                ]; 
            }
            
        } else {
            $cart = [ 
                $product->id => [
                    'title' => $product->title,
                    'quantity' => 1,
                    'unit_price' => $unit_price,
                    'item_price' => $unit_price,            
                ],
            ];        
        } 
        session(['cart' => $cart]);
        session()->flash('message', $product->title. ' added to cart.');

        return redirect()->route('cart.show');     
    }

    public function removeFromCart(Request $request)
    {
        try {
            $this->validate($request, [
                'product_id' => 'required|numeric',
            ]);
        } catch(ValidationException $e) {
            return redirect()->back();
        }

        $cart = session()->has('cart') ? session()->get('cart') : [];

        unset($cart[$request->input('product_id')]);
        session(['cart' => $cart]);
        
        session()->flash('message',  ' Product removed from cart.');
        return redirect()->back();
    }

    public function clearCart() {
        session()->forget('cart');

        return back();
    }

    public function checkout () 
    {
        $data = [];

        $data['cart'] = session()->has('cart') ? session()->get('cart') : [];
        $data['total_amount'] = array_sum(array_column($data['cart'], 'item_price'));
        session(['total_amount' => $data['total_amount']]);
        // dd(session()->all());
        return view('frontend.checkout', $data);
    }

    public function order ()
    {
        $validator = Validator::make(request()->all(), [
            'customer_name' => 'required',
            'customer_phone_number' => 'required',
            'address' => 'required',
            'city' => 'required',
            'postal_code' => 'required',
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $cart = session()->has('cart') ? session()->get('cart') : [];
        $total_amount = session()->has('total_amount') ? session()->get('total_amount') : [];
        
        $order = Order::create([
            'user_id' => auth()->user()->id,
            'customer_name' => request()->input('customer_name'),
            'customer_phone_number' => request()->input('customer_phone_number'),
            'address' => request()->input('address'),
            'city' => request()->input('city'),
            'postal_code' => request()->input('postal_code'),
            'total_amount' => $total_amount,
            'paid_amount' => $total_amount,
            'payment-details' => 'Cash on Delivery',
        ]);

        foreach($cart as $product_id => $product)
        {
            $order->products()->create([
                'product_id' => $product_id,
                'quantity' => $product['quantity'],
                'price' => $product['item_price'],    
            ]);
        }

        $this->setSuccess('Order created.');

        session()->forget(['cart', 'total_amount']);
        return redirect('/');
    }
}
