@extends('layout')

@section('title', 'Cart')
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('css/miki.css')}}">
@endsection
@section('content')
<div class="con my-4">
	<ul class="nav-cart">
		<li class="activ">Vaša korpa</li>
		<li>Potvrda</li>
		<li>Gotovi ste!</li>
	</ul>
</div>
<form action="{{route('order.store')}}" name="order_frm" method="POST" class="orderfrm">
    <div class="container">
	<div class="card cart-card-padding">
		<div class="col-12">
			@if(Session::has('success'))
				<p class="alert" style="background-color: #d9d9d9 ">{{ Session::get('success') }}</p>
			@endif
		</div>
		<div class="row">
			<div class="col-lg-6">
				@csrf
                <div class="row m-0">
                    <h1 class="cart-address mb-4">Adresa za dostavu</h1>
                    <input class="form-control my-2 col-12 cart-input" type="text" name="name" id="name" required placeholder="Ime">
                    <input class="form-control my-2 col-12 cart-input" type="text" name="lastname" id="lastname" required placeholder="Prezime">
                    <input class="form-control my-2 col-12 cart-input" type="text" name="phone" id="phone" required placeholder="Broj telefona">
                    <input class="form-control my-2 col-12 cart-input" type="text" name="street" id="street" required placeholder="Ulica i broj">
                    <input class="form-control my-2 col-12 cart-input" type="text" name="postcode" id="postcode" required placeholder="Poštanski broj">
                    <input class="form-control my-2 col-12 cart-input" type="text" name="city" id="city" required placeholder="Grad">
                    <input class="form-control my-2 col-12 cart-input" type="email" name="email" id="email" placeholder="Email adresa">
                </div>
            </div>
            <div class="col-lg-6">
                <h2 class="cart-address mb-4 mt-sm-4">Proizvodi u korpi</h2>
                <hr class="mb-0">
                    <table id="cart" class="table table-condensed">
                    @foreach(Cart::content() as $row)
                        <tr>
                            <td>

                                <div class="row justify-content-between py-3">
                                <div class="col-3 my-2">
                                    <img src="{{$products->where('id', $row->id)->first()->photo}}" alt="">
                                </div>
                                <div class="col-6 my-2 row justify-content-between">
                                    <div class="d-block align-self-center cart-product-name">
                                        {{$row->name}}
                                    </div>
                                    <div class="d-block align-self-end">
                                        <div class="mt-2">
                                            <div class="number-input">
                                                <button class="minus" data-id="{{ $row->rowId }}"></button>
                                                <input type="number" value="{{ $row->qty }}" class="form-control quantity" title="quantity" />
                                                <button class="plus" data-id="{{ $row->rowId }}"></button>
                                            </div>

{{--                                            @foreach ($row->options as $key=>$option)--}}
{{--                                                <span>{{$option}}</span>--}}
{{--                                            @endforeach--}}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3 my-2 cart-product-price position-relative">
                                    <div class="d-block text-end">
                                        <button class="remove-from-cart align-self-start" data-id="{{ $row->rowId }}">X</button>
                                    </div>
                                    <div class="d-block align-self-end position-absolute bottom-0">
                                        {{$row->total}} KM
                                    </div>
                                </div>

                                </div>
                                <hr class="m-0">
                            </td>
                        </tr>
                    @endforeach
                    </table>
                <hr>
                <div class="row">
                    <div class="col-3"></div>
                    <div class="col-6">Dostava</div>
                    <div class="col-3">7 KM</div>
                </div>
                <hr>
                <div class="row mb-4">
                    <div class="col-3"></div>
                    <div class="col-6">Konačna cijena</div>
                    <div class="col-3 font-bold cart-total">{{ Cart::subtotal()+7 }} KM</div>
                </div>
                <div class="frmbox">
                    <input type="submit" value="Naruči Odmah" class="continueshoppingbtn cart-submit btn-orange">
                </div>
{{--                @if(setting('show_upsell'))--}}
{{--                    <div class="card">--}}
{{--                        <p class="title-sale">Upotpunite svoju narudžubu uz popust dostupan samo sada <strong>od čak 50%!</strong></p>--}}
{{--                        <div class="sale">--}}
{{--                            <div class="cart-product-sale">--}}
{{--                                <a href="https://klikbox.ba/product/zastitna-maska-test-3">--}}
{{--                                    <div class="card-box">--}}
{{--                                        <div class="procent-box">--}}
{{--                                            <div class="procent"><span>-50%</span></div>--}}
{{--                                        </div>--}}
{{--                                        <div class="img-box">--}}
{{--                                            <img class="start-img" src="/photos/product-1.png" alt="">--}}
{{--                                        </div>--}}
{{--                                        <div class="title-box">--}}
{{--                                            <p>zastitna maska test 3</p>--}}
{{--                                        </div>--}}
{{--                                        <div class="price-box">--}}
{{--                                            <span>50KM</span>20KM--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </a>--}}
{{--                                <div class="sale-addtocart"><a href="#">Dodaj</a></div>--}}
{{--                            </div>--}}
{{--                            <div class="cart-product-sale">--}}
{{--                                <a href="https://klikbox.ba/product/zastitna-maska-test-3">--}}
{{--                                    <div class="card-box">--}}
{{--                                        <div class="procent-box">--}}
{{--                                            <div class="procent"><span>-50%</span></div>--}}
{{--                                        </div>--}}
{{--                                        <div class="img-box">--}}
{{--                                            <img class="start-img" src="/photos/product-1.png" alt="">--}}
{{--                                        </div>--}}
{{--                                        <div class="title-box">--}}
{{--                                            <p>zastitna maska test 3</p>--}}
{{--                                        </div>--}}
{{--                                        <div class="price-box">--}}
{{--                                            <span>50KM</span>20KM--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </a>--}}
{{--                                <div class="sale-addtocart"><a href="#">Dodaj</a></div>--}}
{{--                            </div>--}}
{{--                            <div class="cart-product-sale">--}}
{{--                                <a href="https://klikbox.ba/product/zastitna-maska-test-3">--}}
{{--                                    <div class="card-box">--}}
{{--                                        <div class="procent-box">--}}
{{--                                            <div class="procent"><span>-50%</span></div>--}}
{{--                                        </div>--}}
{{--                                        <div class="img-box">--}}
{{--                                            <img class="start-img" src="/photos/product-1.png" alt="">--}}
{{--                                        </div>--}}
{{--                                        <div class="title-box">--}}
{{--                                            <p>zastitna maska test 3</p>--}}
{{--                                        </div>--}}
{{--                                        <div class="price-box">--}}
{{--                                            <span>50KM</span>20KM--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </a>--}}
{{--                                <div class="sale-addtocart"><a href="#">Dodaj</a></div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                @endif--}}

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
