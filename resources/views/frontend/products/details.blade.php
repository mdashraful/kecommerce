@extends('frontend.layouts.master')

@section('main-content')
    <div class="container">
        <br>
        <p class="text-center fw-bold">{{ $product->title }}</p>
        <hr>

        <div class="card">
            <div class="row">
                <aside class="col-sm-5">
                    <div >
                        <article class="gallery-wrap border-end">
                            <div>
                                <img src="{{ $product->getFirstMediaUrl('products') }}" class="card-img-top" alt="">
                            </div>
                        </article>
                    </div>
                </aside>
                
                <aside class="col-sm-7">
                    <article class="card-body p-5">
                        <h3 class="title mb-3">{{ $product->title }}</h3>
                        <p class="price-detail-wrap">
                            <span class="price h3 text-warning">
                                <span class="currency">BDT </span>
                                <span class="num">
                                    {{ $product->price }} /-
                                </span>
                            </span>
                        </p>
                        <dl class="item-property">
                            <dt>Description</dt>
                            <dd><p>{{ $product->description }}</p></dd>
                        </dl>
                        <hr>

                        <div class="btn-group">
                            <form action="{{ route('cart.add') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <button type="submit" class="btn btn-lg btn-outline-secondary">
                                    Add to Cart
                                </button>
                            </form>
                        </div>
                    </article>
                </aside>
            </div>
        </div>
    </div>
@endsection