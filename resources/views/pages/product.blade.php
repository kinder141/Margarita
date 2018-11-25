@extends('layouts.main')

@section('content')
    <section class="product-section">
        <div class="container">
            <div class="product">
                <h2 class="default-title">{{ $product->name }}</h2>
                <div class="product-item">
                    <div class="img-container product-img">
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
                    <div class="product-info">
                        <div class="row">
                            <dl class="price">
                                <dt>Price:</dt>
                                <dd>{{ $product->price }}$</dd>
                            </dl>
                            <a href="{{ route('order', ['category' => Request::segment(1), 'id' => $product->id]) }}" class="primary-btn big-btn">BUY</a>
                        </div>
                        <h3>
                            Characteristics:
                        </h3>
                        <div class="char-grid">
                            @foreach($characteristics as $name => $value)
                                <dl>
                                    <dt>{{ $name }}:</dt>
                                    <dd>{{ $value }}</dd>
                                </dl>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="product-desc">
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatum, repudiandae sunt iure sapiente eius excepturi praesentium illum dignissimos! Ipsa fuga tempora similique aspernatur perspiciatis, quas mollitia, vero assumenda ad repudiandae?
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatum, repudiandae sunt iure sapiente eius excepturi praesentium illum dignissimos! Ipsa fuga tempora similique aspernatur perspiciatis, quas mollitia, vero assumenda ad repudiandae?
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sequi consectetur doloremque ex, repellat reiciendis quisquam quibusdam nobis quis esse. Laboriosam reprehenderit voluptatum maiores repellendus cum doloremque. Impedit voluptas, labore alias?
                    </p>
                </div>
            </div>
        </div>
    </section>
    <section class="comments-section">
        <div class="container">
            <h2 class="default-title">Comments:</h2>
                @if(isset($mongoProduct['comments']) && !empty($mongoProduct['comments']))
                <ul class="comment-list">
                    @foreach($mongoProduct['comments'] as $comment)
                        <li class="comment-item">
                            <div class="comment-head">
                                <div class="img-container user-avatar">
                                    @if(!empty($comment['user_id']))
                                        <img src="{{ asset('images/user.png') }}" alt="">
                                    @else
                                        <img src="{{ asset('images/anonim.png') }}" alt="">
                                    @endif
                                </div>
                                <div class="user-nickname">
                                    {!! $comment['nickname'] !!}
                                </div>
                                @if($comment['mark'] != 0)
                                    <div class="user-mark">
                                        <ul class="rate">
                                            @for($i = 1; $i <= 5; $i++)
                                                @if($i <= $comment['mark'])
                                                    <li class="rate-item {!! 'active' !!}"></li>
                                                @else
                                                    <li class="rate-item"></li>
                                                @endif
                                            @endfor
                                        </ul>
                                    </div>
                                @endif
                            </div>
                            <div class="comment-message">
                                <p>
                                    {!! $comment['text'] !!}
                                </p>
                            </div>
                        </li>
                    @endforeach
                </ul>
                @else
                    <p class="no-comment">No comments yet</p>
                @endif
            <form action="{{ route('comment', ['category' => Request::segment(1), 'id' => $product->id]) }}" class="comment-form" method="post">
                {{ csrf_field() }}
                @if(Auth::guest())
                    <div class="row">
                        <div class="row">
                            <div class="img-container user-avatar">
                                <img src="{{ asset('images/anonim.png') }}" alt="cartman" class="user-img"/>
                            </div>
                            <span for="name" class="label">Your name:</span>
                            <input type="text" name="nickname" id="name" class="guest-name" required>
                        </div>
                    </div>
                @else
                    <div class="row">
                      <div class="img-container user-avatar">
                        <img src="{{ asset('images/user.png') }}" alt="cartman" class="user-img"/>
                      </div>
                      <div class="nick-name">{!! Auth::user()->name !!}</div>
                        <input type="text" name="nickname" value="{{ Auth::user()->name }}" hidden>
                    </div>
                @endif
                @if($rated)
                    <div class="row">
                        <span class="label">Customer product rate:</span>
                        <ul class="rate user">
                            <li class="rate-item editable"></li>
                            <li class="rate-item editable"></li>
                            <li class="rate-item editable"></li>
                            <li class="rate-item editable"></li>
                            <li class="rate-item editable"></li>
                            <li class="save-rate"></li>
                            <li class="clear-rate"></li>
                        </ul>
                    </div>
                @endif
                <div class="col">
                    <label for="comment-textarea">Comment:</label>
                    <textarea id="comment-textarea" name="text" class="user-message" required></textarea>
                </div>
                <input type="number" name="mark" class="rate-value" value="0" hidden>
                <div class="row">
                    <button type="submit" class="primary-btn big-btn send-btn">
                        SEND
                    </button>
                </div>
            </form>
        </div>
    </section>
@endsection