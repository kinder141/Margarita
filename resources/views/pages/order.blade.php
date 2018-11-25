@extends('layouts.main')

@section('content')
    <section class="order-section">
        <div class="container">
            <h2 class="default-title">Your order:</h2>
            <form class="orders" action="{{ route('order', ['category' => Request::segment(1), 'id' => $product->id]) }}" method="post">
                {{ csrf_field() }}
                <div class="order-item">
                    <div class="product-item">
                        <div class="img-container item-img">
                            @if(strpos($product->name, 'APPLE') !== false)
                                <img src="{{ asset('images/apple.png') }}"/>
                            @elseif(strpos($product->name, 'SAMSUNG') !== false)
                                <img src="{{ asset('images/samsung.png') }}"/>
                            @elseif(strpos($product->name, 'DELL') !== false)
                                <img src="{{ asset('images/dell.png') }}"/>
                            @elseif(strpos($product->name, 'LENOVO') !== false)
                                <img src="{{ asset('images/lenovo.png') }}"/>
                            @elseif(strpos($product->name, 'ACER') !== false)
                                <img src="{{ asset('images/acer.jpeg') }}"/>
                            @elseif(strpos($product->name, 'SONY') !== false)
                                <img src="{{ asset('images/sony.png') }}"/>
                            @elseif(strpos($product->name, 'LG') !== false)
                                <img src="{{ asset('images/lg.png') }}"/>
                            @elseif(strpos($product->name, 'ASUS') !== false)
                                <img src="{{ asset('images/asus.png') }}"/>
                            @elseif(strpos($product->name, 'SHARP') !== false)
                                <img src="{{ asset('images/sharp.png') }}"/>
                            @elseif(strpos($product->name, 'ONEPLUS') !== false)
                                <img src="{{ asset('images/oneplus.png') }}"/>
                            @elseif(strpos($product->name, 'MEIZU') !== false)
                                <img src="{{ asset('images/meizu.png') }}"/>
                            @else
                                <img src="{{ asset('images/unknown.png') }}"/>
                            @endif
                        </div>
                        <div class="product-name">
                            {{ $product->name }}
                        </div>
                    </div>
                    <div class="row-wrapper">
                        <div class="row">
                            <label>Single price:</label>
                            <span class="single-price">{{ $product->price }}</span>
                            <span>$</span>
                        </div>
                        <div class="row">
                            <label for="amount">Amount:</label>
                            <input type="number" id="amount" name="amount" class="amount" min="1" max="{{ $product->amount }}" value="1">
                        </div>
                        <div class="row">
                            <label>Total:</label>
                            <span class="total"></span>
                            <span>$</span>
                        </div>
                    </div>
                </div>
                <div class="submit-container">
                    <button type="submit" class="primary-btn big-btn">CONFIRM ORDER</button>
                </div>
            </form>
        </div>
    </section>
@endsection