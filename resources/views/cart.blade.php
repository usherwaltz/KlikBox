@extends('layout')

@section('title', 'Cart')
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('css/miki.css')}}">
@endsection
@section('content')
@php
    $counter = 1;
    $total = count(Cart::content());
@endphp

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="con my-4">
	<ul class="nav-cart">
		<li class="activ">Vaša korpa</li>
		<li>Potvrda</li>
		<li>Gotovi ste!</li>
	</ul>
</div>
<form action="{{route('order.store')}}" name="order_frm" method="POST" class="orderfrm">
    <div class="container-fluid">
	<div class="card d-flex justify-content-center align-items-center px-4 @if(Session::has('success')) pb-5 pt-1 @else py-5 @endif">
		<div class="col-12 max-1300">
			@if(Session::has('success'))
				<p class="alert" style="background-color: #d9d9d9 ">{{ Session::get('success') }}</p>
			@endif
		</div>
		<div class="row cart-linup">
			<div class="order-1 order-lg-0 col-lg-6 max-600">
				@csrf
                <div class="row m-0">
                    <h1 class="cart-address mobile-top-margin mb-4">Adresa za dostavu</h1>
                    <input class="form-control my-2 col-12 cart-input" type="text" name="name" id="name" required placeholder="Ime">
                    <input class="form-control my-2 col-12 cart-input" type="text" name="lastname" id="lastname" required placeholder="Prezime">
                    <input class="form-control my-2 col-12 cart-input" type="text" name="phone" id="phone" required placeholder="Broj telefona">
                    <input class="form-control my-2 col-12 cart-input" type="text" name="street" id="street" required placeholder="Ulica i broj">
                    <input class="form-control my-2 col-12 cart-input" type="text" name="postcode" id="postcode" required placeholder="Poštanski broj">
                    <input class="form-control my-2 col-12 cart-input" type="text" name="city" id="city" required placeholder="Grad">
                    <input class="form-control my-2 col-12 cart-input" type="email" name="email" id="email" placeholder="Email adresa">
                </div>
                <div class="d-lg-none mt-4">
                    <div class="frmbox">
                        <input type="submit" value="Naruči Odmah" class="continueshoppingbtn cart-submit btn-orange">
                    </div>
                    <div class="garancy pt-2">
                        <div class="row">
                            <div class="col-4 garancy-box">
                                <img src="/images/pay-pic.png" alt="pay">
                                <p>PLAĆANJE <br>POUZEĆEM</p>
                            </div>
                            <div class="col-4 garancy-box">
                                <img src="/images/delivery-pic.png" alt="delivery">
                                <p>BRZA <br>DOSTAVA 24H</p>
                            </div>
                            <div class="col-4 garancy-box">
                                <img src="/images/garancy-pic.png" alt="garancy">
                                <p>GARANTOVAN<br> POVRAT NOVCA</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="order-0 order-lg-1 col-lg-6 max-600">
                <h2 class="cart-address mb-4">Proizvodi u korpi</h2>
                <hr class="mb-0">
                    <table id="cart" class="table table-condensed">
                    @php $cartTotal = 0; @endphp
                    @foreach(Cart::content() as $row)
                            <?php
                            $showColor = isset($row->options['boja']);
                            $showSize = isset($row->options['velicina']);

                            $product = \App\Models\Product::getProduct($row->id);
                            $price = null;

                            if($product->top_choice) {
                                $n = $product->price;
                                switch($row->qty) {
                                case 1:
                                    $whole = floor($product->price);
                                    $fraction = $product->price - $whole;
                                    $price = $fraction >= 0.5 ? round($product->price) : $product->price;
                                    $cartTotal = $cartTotal + $price * $row->qty;
                                    $item = Cart::get($row->rowId);
                                    Cart::update($row->rowId, ['qty' => $row->qty, 'price' => $price, 'options' => $row->options]);
                                    break;
                                case 2:
                                    $discountPrice = $product->price * 0.85;
                                    $whole = floor($discountPrice);
                                    $fraction = $discountPrice - $whole;
                                    $price = $fraction >= 0.5 ? round($discountPrice) : $whole;
                                    $cartTotal = $cartTotal + $price * $row->qty;
                                    $item = Cart::get($row->rowId);
                                    Cart::update($row->rowId, ['qty' => $row->qty, 'price' => $price, 'options' => $row->options]);
                                    break;
                                default:
                                    $discountPrice = $product->price * 0.75;
                                    $whole = floor($product->price * 0.75);
                                    $fraction = $discountPrice - $whole;
                                    $price = $fraction >= 0.5 ? round($discountPrice) : $whole;
                                    $cartTotal = $cartTotal + $price * $row->qty;
                                    $item = Cart::get($row->rowId);
                                    Cart::update($row->rowId, ['qty' => $row->qty, 'price' => $price, 'options' => $row->options]);
                                    break;
                            }
                            } else {
                                $price = $product->price;
                                $cartTotal = $cartTotal + $price * $row->qty;
                                Cart::update($row->rowId, ['qty' => $row->qty, 'price' => $price, 'options' => $row->options]);
                            }
                            ?>
                        <tr>
                            <td class="p-0 border-0">
                                <div class="row justify-content-between">
                                    <div class="d-none d-md-block col-3 my-2">
                                        <img src="{{$products->where('id', $row->id)->first()->photo}}" alt="">
                                    </div>
                                    <div class="col-8 col-md-5 my-2 row justify-content-between">
                                        <div class="d-block align-self-center cart-product-name">
                                            {{$row->name}} @if($showColor) {{$row->options['boja']}} @endif @if($showSize) {{$row->options['velicina']}} @endif
                                        </div>
                                        <div class="d-block align-self-end">
                                            <div class="mt-2">
                                                <div class="number-input">
                                                    <button class="minus" data-id="{{ $row->rowId }}"></button>
                                                    <input type="number" value="{{ $row->qty }}" class="form-control quantity" title="quantity" />
                                                    <button class="plus" data-id="{{ $row->rowId }}"></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4 my-2 cart-product-price position-relative">
                                        <div class="d-block text-end">
                                            <button class="remove-from-cart align-self-start" data-id="{{ $row->rowId }}">X</button>
                                        </div>
                                        <div class="d-block align-self-end position-absolute bottom-0 float-right">
                                            {{$price * $row->qty}} KM
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>

                            @if($counter != $total)
                                <tr>
                                    <td class="p-0">
                                        <hr class="m-0">
                                    </td>
                                </tr>
                            @endif
                        @php $counter++; @endphp
                    @endforeach
                    </table>
                <hr>
                <div class="row">
                    <div class="d-none d-md-block col-3"></div>
                    <div class="col-6 col-md-6">Dostava</div>
                    <div class="col-6 col-md-3 text-align-right">7 KM</div>
                </div>
                <hr>
                <div class="row mb-4">
                    <div class="d-none d-md-block col-3"></div>
                    <div class="col-6 col-md-6">Konačna cijena</div>
                    <div class="col-6 col-md-3 font-bold cart-total text-align-right">{{ $cartTotal+7 }} KM</div>
                </div>
                <div class="d-none d-lg-block">
                    <div class="frmbox">
                        <input type="submit" value="Naruči Odmah" class="continueshoppingbtn cart-submit btn-orange">
                    </div>
                    <div class="garancy pt-2">
                        <div class="row">
                            <div class="col-4 garancy-box">
                                <img src="/images/pay-pic.png" alt="pay">
                                <p>PLAĆANJE <br>POUZEĆEM</p>
                            </div>
                            <div class="col-4 garancy-box">
                                <img src="/images/delivery-pic.png" alt="delivery">
                                <p>BRZA <br>DOSTAVA 24H</p>
                            </div>
                            <div class="col-4 garancy-box">
                                <img src="/images/garancy-pic.png" alt="garancy">
                                <p>GARANTOVAN<br> POVRAT NOVCA</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
		</div>
    </div>
</div>
</form>


@endsection
@section('scripts')


    <script type="text/javascript">
		$('.minus').each(function(index){
		    $(this).on('click',function () {
                this.parentNode.querySelector('input[type=number]').stepDown();
                let ele = $(this);

                $.ajax({
                    url: '{{ url('update-cart') }}',
                    method: "patch",
                    data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id"), quantity: ele.parents("tr").find(".quantity").val()},
                    success: function (response) {
                        window.location.reload();
                    }
                });
            })
		});

		$('.plus').each(function (index) {
			$(this).on('click',function () {
                this.parentNode.querySelector('input[type=number]').stepUp();
                let ele = $(this);

                $.ajax({
                    url: '{{ url('update-cart') }}',
                    method: "patch",
                    data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id"), quantity: ele.parents("tr").find(".quantity").val()},
                    success: function (response) {
                        window.location.reload();
                    }
                });
            })
        });


        $(".update-cart").click(function (e) {
           e.preventDefault();

           var ele = $(this);

            $.ajax({
               url: '{{ url('update-cart') }}',
               method: "patch",
               data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id"), quantity: ele.parents("tr").find(".quantity").val()},
               success: function (response) {
                   window.location.reload();
               }
            });
        });

        $(".remove-from-cart").click(function (e) {
            e.preventDefault();

            var ele = $(this);

            if(confirm("Da li ste sigurni da želite ukloniti proizvod iz korpe?")) {
                $.ajax({
                    url: '{{ url('remove-from-cart') }}',
                    method: "DELETE",
                    data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id")},
                    success: function (response) {
                        window.location.reload();
                    }
                });
            }
        });

    </script>

@endsection
