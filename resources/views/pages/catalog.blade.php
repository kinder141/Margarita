@extends('layouts.main')

@section('content')
    <section class="main-section">
        <div class="container">
            <div class="main-section__content">
                <div class="sidebar">
                    @yield('filters')
                </div>
                <div class="grid-section">
                    @foreach($products as $product)
                        <a href="{{ route('product', ['category' => Request::segment(1), 'id' => $product->id]) }}" class="item">
                            @if(strpos($product->name, 'APPLE') !== false)
                                <img class="product-img" src="{{ asset('images/apple.png') }}"/>
                            @elseif(strpos($product->name, 'SAMSUNG') !== false)
                                <img class="product-img" src="{{ asset('images/samsung.png') }}"/>
                            @elseif(strpos($product->name, 'DELL') !== false)
                                <img class="product-img" src="{{ asset('images/dell.png') }}"/>
                            @elseif(strpos($product->name, 'LENOVO') !== false)
                                <img class="product-img" src="{{ asset('images/lenovo.png') }}"/>
                            @elseif(strpos($product->name, 'ACER') !== false)
                                <img class="product-img" src="{{ asset('images/acer.jpeg') }}"/>
                            @elseif(strpos($product->name, 'SONY') !== false)
                                <img class="product-img" src="{{ asset('images/sony.png') }}"/>
                            @elseif(strpos($product->name, 'LG') !== false)
                                <img class="product-img" src="{{ asset('images/lg.png') }}"/>
                            @elseif(strpos($product->name, 'ASUS') !== false)
                                <img class="product-img" src="{{ asset('images/asus.png') }}"/>
                            @elseif(strpos($product->name, 'SHARP') !== false)
                                <img class="product-img" src="{{ asset('images/sharp.png') }}"/>
                            @elseif(strpos($product->name, 'ONEPLUS') !== false)
                                <img class="product-img" src="{{ asset('images/oneplus.png') }}"/>
                            @elseif(strpos($product->name, 'MEIZU') !== false)
                                <img class="product-img" src="{{ asset('images/meizu.png') }}"/>
                            @else
                                <img class="product-img" src="{{ asset('images/unknown.png') }}"/>
                            @endif
                            <div class="thumbnail">
                                <div class="name">{{ $product->name }}</div>
                                <div class="b-side">
                                    <button class="primary-btn">BUY</button>
                                    <div class="price">{{ $product->price }}$</div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection