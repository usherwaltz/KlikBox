@extends('layout')

@section('title', 'Products')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('css/miki.css')}}">
@endsection
@section('content')
<div class="products-home">
    <div class="container mt-4 all-products-home">
        <div class="banner">
            <img src="/images/home-banner.png" alt="banner">
            <h1 class="banner-text text-white font-size-xl font-weight-bold">
                Vaša <br> kupovina <br> na klik!
            </h1>
            <img class="banner-logo" src="/images/logo-nav.png" alt="logo">
        </div>
        <div class="row">
            @forelse ($products as $product)
                <div class="col-lg-4 col-md-6 col-xl-2 p-0">
                    <div class="card m-2">
                        <div class="card-body">
                            <a href="{{route('product',$product->slug)}}">
                                <div class="card-box">
                                    <div class="procent-box">
                                        <div class="procent"><span>-50%</span></div>
                                    </div>
                                    <div class="img-box">
                                        @if($product->photo)
                                            <img class="start-img" src="{{$product->photo}}" alt="{{$product->title}}">
                                        @else
                                            <img class="start-img" src="/images/no-image.png" alt="fire">
                                        @endif
                                    </div>
                                    <div class="title-box">
                                        <p>{{$product->name}}</p>
                                    </div>
                                    <div class="price-box">
                                        @if($product->oldprice)
                                            <span>{{round($product->oldprice)}} KM</span>
                                        @endif
                                        {{round($product->price)}} KM
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
            @endforelse
        </div>
    </div>
    <div class="tofu">
        <div class="tofu-box-home">
            <div class="tofu-card">
                <img src="/images/safe-pic.png" alt="safe-pic">
                <p>SIGURNA <br>DOSTAVA</p>
            </div>
            <div class="tofu-card">
                <img src="/images/delivery-pic.png" alt="delivery-pic">
                <p>BRZA <br>DOSTAVA 24H</p>
            </div>

            <div class="tofu-card">
                <img src="/images/quality-pic.png" alt="quality-pic">
                <p>KONTROLA <br>KVALITETA</p>
            </div>
            <div class="tofu-card">
                <img src="/images/pay-pic.png" alt="pay-pic">
                <p>PLAĆANJE <br>POUZEĆEM</p>
            </div>
            <div class="tofu-card">
                <img src="/images/garancy-pic.png" alt="garancy-pic">
                <p>GARANTOVAN <br>POVRAT NOVCA</p>
            </div>
        </div>
    </div>
</div>
@endsection
