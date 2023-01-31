@extends('frontend.layouts.master')

@section('main-content')
    <br>
    <p class="text-center fw-bold display-6">Order Details</p>
    <hr>

    <div class="container">

        <h3>Order #{{ $order->id }} details</h3>

        <ul class="list-group">
            @foreach ($order->toArray() as $column => $value)
                @if ($column == 'products' || $column == 'user_id' || 
                    $column == 'operational_status' || $column == 'processed_by')
                    @continue                    
                @endif
                <li class="list-group-item">
                    {{ $column }}: {{ $value }}
                </li>  
            @endforeach
            
        </ul>
        <div class="mt-5">
            <h3>Products</h3>
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Product ID</th>
                        <th>Product Title</th>
                        <th>Unite price</th>
                        <th>Product Quantity</th>
                        <th>Items Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->products as $product)
                    <tr>
                        <td>{{ $product->product->id}}</td>
                        <td>{{ $product->product->title}}</td>
                        <td>{{ $product->product->sale_price}}</td>
                        <td>{{ $product->quantity }}</td>
                        <td>{{ $product->price }}</td>
                    </tr>
                    @endforeach
                    <tr class="">
                        <td colspan="4">Total Amount</td>
                        <td >{{$order->total_amount}}</td>
                    </tr>
                </tbody>
            </table>
        </div>    
    </div>
@endsection