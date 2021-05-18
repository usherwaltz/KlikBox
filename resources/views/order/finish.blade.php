@extends('layout')

@section('title', 'Cart')
@section('css')

<link rel="stylesheet" type="text/css" href="{{asset('css/miki.css')}}">
@endsection
@section('content')
<div class="con mt-4">
	<ul class="nav-cart">
		<li>Vaša korpa</li>
		<li>Potvrda</li>
		<li class="activ">Gotovi ste!</li>
	</ul>
</div>
<div class="finish-section">
    <div class="finish-box">
        <h2>Narudžba je uspješna!</h2>
        <h3>Hvala na povjerenju,<br>Vaš</h3>
		<div class="img-box"><img src="/images/logo-finish.png" alt=""></div>
    </div>
</div>
@endsection
