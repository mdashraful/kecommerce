@extends('frontend.layouts.master')

@section('main-content')
    <br>
    <p class="text-center fw-bold display-6">#{{ $order->id }} Order Details</p>
    <hr>

    <div class="container">
        @include('frontend.partials._message')
        {{-- @if (session()->has('message'))
            <div class="alert alert-{{session('type')}}">
                {{ session('message') }}
            </div>            
        @endif --}}
        <h3>Billing Info</h3>

        <ul class="list-group">
            @foreach ($order->toArray() as $column => $value)
                @if(is_string($value))
                    @if ($column == 'user_id' || $column == 'operational_status' || $column == 'processed_by')
                        @continue                    
                    @endif
                    <li class="list-group-item">
                        {{ str_replace('_', ' ', ucwords($column)) }}: {{ $value }}
                    </li>  
                @endif
                
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
                        <td>{{ number_format($product->price, 2) }}</td>
                    </tr>
                    @endforeach
                    <tr class="">
                        <td colspan="4">Total Amount</td>
                        <td >{{number_format($order->total_amount, 2) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>    
    </div>
@endsection