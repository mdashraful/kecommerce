@extends('frontend.layouts.master')

@section('main-content')
    <div class="container">
        <br>
        <p class="text-center fw-bold display-6">Register</p>
        <hr>
        <div>
            @include('frontend.partials._message')
        </div>
        <form action="{{ route('register') }}" method="POST" class="px-5 mt-5">
            @csrf
            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" name="name" id="name" class="form-control mb-3" 
                    placeholder="Full Name" value="{{ old('name') }}">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control mb-3" 
                    placeholder="Email" value="{{ old('email') }}">
            </div>
            
            <div class="form-group">
                <label for="phone_number">Phone</label>
                <input type="text" name="phone_number" id="phone_number" class="form-control mb-3" 
                    placeholder="Phone" value="{{ old('phone_number') }}">
            </div>
            
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control mb-3" 
                    placeholder="Password">
            </div>

            <div class="form-group mt-4 text-center">
                <button type="submit" class="btn btn-lg btn-success">Register</button>
            </div>
        </form>
    </div>
@endsection