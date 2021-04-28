@extends('layout')

@section('title', 'Cart')
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('css/miki.css')}}">
@endsection
@section('content')
<div class="con"> 
	<ul class="nav-cart">
		<li class="activ">Vaša korpa</li>
		<li>Potvrda</li>
		<li>Gotovi ste!</li>
	</ul>
</div>
<div class="container-fluid">
	<div class="card col-12">
		<div class="col-12">
			@if(Session::has('success'))
				<p class="alert" style="background-color: #d9d9d9 ">{{ Session::get('success') }}</p>
			@endif
		</div>
		<div class="row mb-5">
			<div class="left-side col-lg-6 mt-3 order-lg-1">
				<form action="{{route('order.store')}}" name="order_frm" method="POST" class="orderfrm">
				@csrf
					<div class="contactdetails">
						<h2>Adresa za dostavu</h2>
						<div class="frmbox">
							<input type="text" name="name" id="name" required placeholder="Ime">
						</div>
						<div class="frmbox">
							<input type="text" name="lastname" id="lastname" required placeholder="Prezime">
						</div>       
						<div class="frmbox">
							<input type="email" name="email" id="email" placeholder="Email adresa">
						</div>  
						<div class="frmbox">
							<input type="text" name="city" id="city" required placeholder="Grad">
						</div>
						<div class="frmbox">
							<input type="text" name="postcode" id="postcode" required placeholder="Poštanski broj">
						</div> 
						<div class="frmbox">
							<input type="text" name="street" id="street" required placeholder="Ulica i broj">
						</div>
						<div class="frmbox">
							<input type="text" name="phone" id="phone" required placeholder="Broj telefona">
						</div> 
						<h2 class="mt-3">Plaćanje pouzećem</h2>	
						<p>Plaćanje se vrši gotovinom prilikom preuzimanja prozivoda.</p>
						<div class="frmbox">
							<input type="submit" value="Naruči" class="continueshoppingbtn btn-orange">
					</div>
				</form> 
				<div class="garancy pt-2">
					<div class="row">
						<div class="col-4 garancy-box">
							<img src="/images/delivery-pic.png" alt="delivery">
							<p>BRZA <br>DOSTAVA 24H</p>
						</div>
						<div class="col-4 garancy-box">
							<img src="/images/pay-pic.png" alt="pay">
							<p>PLAĆANJE <br>POUZEĆEM</p>
						</div>
						<div class="col-4 garancy-box">
							<img src="/images/garancy-pic.png" alt="garancy">
							<p>GARANTOVAN<br> POVRAT NOVCA</p>
						</div>
					</div>
				</div> 
			</div>
		</div>
			<div class="right-side order-md-1 order-sm-1 order-first order-lg-2 col-lg-6">
				<h2>Proizvodi u korpi</h2>
				<table id="cart" class="table table-condensed" style="text-align: left">
				@foreach(Cart::content() as $row)
					<tr>
						<td>
							<img src="{{$products->where('id',$row->id)->first()->photo}}" width="100" height="100" class="img-responsive"/>
						</td>
						<td data-th="Product">
							<div class="row">
								<div>
									<h4 class="nomargin">{{ $row->name }}</h4>
									@foreach ($row->options as $key=>$option)                               
										<span>{{$option}}</span>                                       
									@endforeach
								</div>
								<div class="number-box">
								<div class="number-input">
									<button class="minus" data-id="{{ $row->rowId }}"></button>
									<input type="number" value="{{ $row->qty }}" class="form-control quantity" title="quantity" />
									<button class="plus" data-id="{{ $row->rowId }}"></button>
								</div>
								<span>{{ $row->total}} KM</span>
								</div>
							</div>
						</td>
						<td class="actions" data-th="">
							<button class="remove-from-cart" data-id="{{ $row->rowId }}">X</button>
							{{--<button class="btn btn-info btn-sm update-cart" data-id="{{ $row->rowId }}"><i class="fas fa-sync"></i></button>--}}
						</td>
					</tr>
				@endforeach
					<tr class="dostava">
						<td></td>
						<td>Dostava <span>7 KM</span></td>
						<td></td>
					</tr>
					<tr class="konacna-cijena">
						<td></td>
						<td>Konačna cijena <span>{{ Cart::subtotal()+7 }} KM</span></td>
						<td></td>
					</tr>
				</table>
				@if(setting('show_upsell'))
				<div class="card">
					<p class="title-sale">Upotpunite svoju narudžubu uz popust dostupan samo sada <strong>od čak 50%!</strong></p>
					<div class="sale">
						<div class="cart-product-sale">
							<a href="https://klikbox.ba/product/zastitna-maska-test-3">
								<div class="card-box">
									<div class="procent-box">
										<div class="procent"><span>-50%</span></div>
									</div>  
									<div class="img-box">
										<img class="start-img" src="/photos/product-1.png" alt="">
									</div>
									<div class="title-box">
										<p>zastitna maska test 3</p>
									</div>
									<div class="price-box">
										<span>50KM</span>20KM
									</div>
								</div>  
							</a>
						<div class="sale-addtocart"><a href="#">Dodaj</a></div>
					</div>
						<div class="cart-product-sale">
							<a href="https://klikbox.ba/product/zastitna-maska-test-3">
								<div class="card-box">
									<div class="procent-box">
										<div class="procent"><span>-50%</span></div>
									</div>  
									<div class="img-box">
										<img class="start-img" src="/photos/product-1.png" alt="">
									</div>
									<div class="title-box">
										<p>zastitna maska test 3</p>
									</div>
									<div class="price-box">
										<span>50KM</span>20KM
									</div>
								</div>  
							</a>
							<div class="sale-addtocart"><a href="#">Dodaj</a></div>
						</div>
						<div class="cart-product-sale">
							<a href="https://klikbox.ba/product/zastitna-maska-test-3">
								<div class="card-box">
									<div class="procent-box">
										<div class="procent"><span>-50%</span></div>
									</div>  
									<div class="img-box">
										<img class="start-img" src="/photos/product-1.png" alt="">
									</div>
									<div class="title-box">
										<p>zastitna maska test 3</p>
									</div>
									<div class="price-box">
										<span>50KM</span>20KM
									</div>
								</div>  
							</a>
						<div class="sale-addtocart"><a href="#">Dodaj</a></div>
					</div>
				</div>
			</div>
				@endif
		</div>   
		</div>
	</div>
   

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