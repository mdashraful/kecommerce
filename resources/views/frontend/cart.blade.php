@extends('frontend.layouts.master')

@section('main-content')
    <div class="container">
        <br>
        <p class="text-center">Cart</p>
        <hr>

        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>            
        @endif

        <table class="table table-bordered table-responsive">
            <thead>
                <tr>
                    <th>Serial</th>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th class="text-center">Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cart as $product)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $product['title'] }}</td>
                    <td class="">
                        <input type="number"class="form-control" name="" id="" value="{{ $product['quantity'] }}">
                    </td>
                    <td class="text-center">BDT {{ $product['price'] }}</td>
                    <td>
                        <a href="">Remove</a>
                        <a href="">Add</a>
                    </td>
                </tr>
                @endforeach
                <tr class="text-center">
                    <td colspan="3">Total</td>
                    <td>BDT {{ number_format($total, 2) }}</td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection