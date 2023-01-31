@extends('frontend.layouts.master')

@section('main-content')
    <div class="container">
        <br>
        <p class="text-center fw-bold display-6">My Profile</p>
        <hr>
        @if (count($orders) > 0)
            <div class="container">
                <h3>My Orders</h3>
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Customer Name</th>
                            <th>Customer Phone Number</th>
                            <th>Total Amount</th>
                            <th>Paid Amount</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->customer_name }}</td>
                                <td>{{ $order->customer_phone_number }}</td>
                                <td>{{ number_format($order->total_amount, 2) }}</td>
                                <td>{{ number_format($order->paid_amount, 2) }}</td>
                                <td>
                                    <a href="{{ route('order.details', $order->id) }}" class="btn btn-info">
                                        Detailsl
                                    </a>
                                </td>
                            </tr>
                        @endforeach 
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection