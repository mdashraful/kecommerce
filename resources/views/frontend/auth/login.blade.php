@extends('frontend.layouts.master')

@section('main-content')
    <div class="container">
        <br>
        <p class="text-center fw-bold display-6">Login</p>
        <hr>
        <div>
            @include('frontend.partials._message')
        </div>
        <form action="{{ route('login') }}" method="POST" class="px-5 mt-5">
            @csrf
            
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control mb-3" 
                    placeholder="Email" value="{{ old('email') }}">
            </div>
            
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control mb-3" 
                    placeholder="Password">
            </div>

            <div class="form-group mt-4 text-center">
                <button type="submit" class="btn btn-lg btn-success">Login</button>
            </div>
        </form>
    </div>
@endsection