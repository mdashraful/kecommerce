@extends('frontend.layouts.master')

@section('main-content')
    <div class="container">
        <br>
        <p class="text-center fw-bold display-6">Checkout</p>
        <hr>
        @guest
            <div class="alert alert-info">
                <p>You need to <a href="{{route('login')}}">Login</a> first for complete your order.</p>
            </div>
        @endguest     
    </div>
    @auth 
    <div class="container">
        <main>  
            <div class="alert alert-info">
                <p>You are ordering as, {{ auth()->user()->name }}</p>
            </div>
            
            <div class="py-3 text-center">
              <h2>Checkout form</h2>
            </div>

            @include('frontend.partials._message')
            
            <div class="row g-5">
              <div class="col-md-5 col-lg-4 order-md-last">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                  <span class="text-primary">Your cart</span>
                  <span class="badge bg-primary rounded-pill">
                    {{ count($cart) }}
                  </span>
                </h4>
                <ul class="list-group mb-3">
                    @foreach($cart as $key => $product)
                        <li class="list-group-item d-flex justify-content-between lh-sm">
                            <div>
                            <h6 class="my-0">{{ $product['title'] }}</h6>
                            <small class="text-muted">* {{ $product['quantity'] }}</small>
                            </div>
                            <span class="text-muted">{{ number_format($product['item_price'], 2) }} /=</span>
                        </li>
                    @endforeach
                  <li class="list-group-item d-flex justify-content-between">
                    <span>Total (BDT)</span>
                    <strong>{{ number_format($total_amount, 2) }} /=</strong>
                  </li>
                </ul>
        
                {{-- <form class="card p-2">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Promo code">
                    <button type="submit" class="btn btn-secondary">Redeem</button>
                  </div>
                </form> --}}
              </div>
              <div class="col-md-7 col-lg-8">
                <h4 class="mb-3">Billing address</h4>
                <form class="needs-validation" action="{{ route('order') }}" method="POST" novalidate>
                  @csrf
                  <div class="row g-3">
                    <div class="col-sm-12">
                      <label for="customer_name" class="form-label">Full name</label>
                      <input type="text" class="form-control" id="customer_name" name="customer_name"
                        placeholder="Full name here" value="{{ auth()->user()->name }}" required>
                      <div class="invalid-feedback">
                        Valid name is required.
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="customer_phone_number" class="form-label">Phone number <span class="text-muted"></span></label>
                      <input type="text" class="form-control" id="customer_phone_number" name="customer_phone_number" placeholder="01xxxxxxxxx"
                        value="{{ auth()->user()->phone_number }}">
                      <div class="invalid-feedback">
                        Please enter a valid Phone Number.
                      </div>
                    </div>
        
                    <div class="col-12">
                      <label for="address" class="form-label">Address</label>
                      <textarea class="form-control" id="address" placeholder="1234 Main St"
                       name="address" required>

                      </textarea>
                    </div>
        
                    <div class="col-md-6">
                      <label for="city" class="form-label">City</label>
                      <input type="text" class="form-control" id="city" name="city"
                        placeholder="City" required>
                    </div>
                    <div class="col-md-6">
                      <label for="postal_code" class="form-label">Postal code</label>
                      <input type="text" class="form-control" id="postal_code" name="postal_code"
                        placeholder="Postal code" required>
                    </div>
                  </div>
        
                  <hr class="my-4">
                  <h4 class="mb-3">Payment</h4>
                    <p>Cash on delivery</p>
                  <hr class="my-4">
                  <button class="w-100 btn btn-primary btn-lg" type="submit">Continue to checkout</button>
                </form>
              </div>
            </div>
            @endauth
        </main>
    </div>
@endsection