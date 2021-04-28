@extends('layout')

@section('title', 'Cart')
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('css/miki.css')}}">
@endsection
@section('content')
<div class="con"> 
	<ul class="nav-cart">
		<li>Vaša korpa</li>
		<li class="activ">Potvrda</li>
		<li>Gotovi ste!</li>
	</ul>
</div>
<div class="potvrda mb-5">
	<div class="potvrda-first">
		<h2 class="mb-4">Molimo Vas potvrdite Vaše podatke!</h2>
        @if(session('order'))
            @foreach($order['cart'] as $row)
            <div class="product-box-cart">
                <img src="{{ $products->where('id',$row->id)->first()->photo }}" alt="">
                <h2>{{ $row->name}} x {{ $row->qty }}</h2>
                <p class="text-right"> {{ $row->total }} KM </p>
            </div>
            @endforeach
        @endif
        <div class="delivery">
            <p>Dostava <span>7 KM </span></p>
        </div>
        <div class="total">
            <h3>Total <span> {{Cart::subtotal() + 7}} KM </span></h3>
        </div>
	</div>
	<div class="personal">
        <h3>Lični podaci</h3>
        <p>{{$order['data']['name']}} {{$order['data']['lastname']}}</p>
        <p>{{$order['data']['city']}}</p>
        <p> {{$order['data']['street']}}</p>
        <p>{{$order['data']['phone']}}</p>
        @if($order['data']['email'])
        <p>{{$order['data']['email']}}</p> 
        @endif
    </div> 
	<p class="text-center no-bottom-m"><a href="{{route('order.confirm',$id)}}" class="continueshoppingbtn btn-orange">POTVRDI</a></p>
	<p class="text-center safe"><i class="fas fa-lock"></i> Sigurna kupovina</p>
	<div class="tofu-box">
        <div class="tofu-card">
            <img src="/images/delivery-pic.png" alt="delivery-pic">
            <p>BRZA DOSTAVA 24H</p>
        </div>
        <div class="tofu-card">
            <img src="/images/pay-pic.png" alt="pay-pic">
            <p>PLAĆANJE POUZEĆEM</p>
        </div>
        <div class="tofu-card">
            <img src="/images/garancy-pic.png" alt="garancy-pic">
            <p>GARANTOVAN POVRAT NOVCA</p>
        </div>
	</div>
</div>
@endsection