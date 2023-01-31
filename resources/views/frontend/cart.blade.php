@extends('frontend.layouts.master')

@section('main-content')
    <div class="container">
        <br>
        <p class="text-center fw-bold display-6">Cart</p>
        <hr>

        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>            
        @endif

        @if (empty($cart))
            <div class="bg-warning p-3">
                <p>Not products found. Add some product.</p>
            </div>            
        @else
            <table class="table table-bordered table-responsive">
                <thead>
                    <tr>
                        <th>Serial</th>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                        <th class="text-center">Item Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cart as $key => $product)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $product['title'] }}</td>
                        <td class="">
                            <input type="number"class="form-control" name="" id="" value="{{ $product['quantity'] }}">
                        </td>
                        <td class="text-center">BDT {{ $product['unit_price'] }}</td>
                        <td class="text-center">BDT {{ $product['item_price'] }}</td>     
                        <td>
                            <div class="btn-group">
                                <form action="{{ route('cart.remove') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $key }}">
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        Remove
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="4">Total Amount</td>
                        <td class="text-center">BDT {{ number_format($total_amount, 2) }}</td>
                        <td>
                            <a href="{{ route('cart.clear') }}" class="btn btn-sm btn-danger">
                                Clear Cart
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="text-end">
                <a href="{{ route('checkout') }}" class="btn btn-lg btn-outline-success">
                    Checkout
                </a>
            </div>
            
        @endif
    </div>
@endsection