<!DOCTYPE html>
<html lang="sr">

<head>

    <title>KlikBox</title>
    <link rel="icon" type="image/png" href="{{asset('/images/fav.png')}}"/>

    <meta charset="UTF-8">
    <meta name="description" content="Vaša kupovina na klik">
    <meta name="author" content="KlikBox">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- my css -->
    @yield('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
    <link rel="preload" as="style" href="{{asset('css/reset.css')}}" onload="this.rel='stylesheet'">
    <link rel="preload" as="style" href="{{asset('css/animate.css')}}" onload="this.rel='stylesheet'">
    <link rel="preload" as="style" href="{{asset('css/fa.all.min.css')}}" onload="this.rel='stylesheet'">
{{--    <link rel="preload" as="style" href="{{asset('css/bootstrap.min.css')}}" onload="this.rel='stylesheet'">--}}
    <link rel="preload" as="style" href="{{asset('css/miki.css')}}" onload="this.rel='stylesheet'">





    <!-- font -->
    <link
            href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
          rel="stylesheet">
@yield('ogtags')

</head>

<body>
<div class="wrap">
    <header id="header" class="sticky-top bg-white shadow-sm">
        <div class="collapse" id="navbarToggleExternalContent">
            <div class="bg-light">
                <div class="navbar-collapse collapse show" id="collapsibleNavbar" style="">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link custom-anchor-tag text-center" href="/novo">NOVO</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link custom-anchor-tag text-center" href="/trend">TREND</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link custom-anchor-tag text-center" href="/akcija">AKCIJA</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link custom-anchor-tag text-center" href="/o-nama">O NAMA</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <nav class="navbar navbar-light bg-white container">

                <!-- DROPDOWN TOGGLE -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
                    <img src="/images/hamburger.svg" alt="menu">
                </button>


                <!-- BRAND ICON -->
                <a class="navbar-brand m-sm-0 mr-4 float-left" href="/home">
                    <img height="50" width="180" src="/images/logo-header.svg" alt="logo" class="d-none d-md-block">
                    <img height="20" src="/images/logo-sm.png" alt="small-logo" class="d-md-none">
                </a>

                <!-- SEARCH BOX -->
                <div class="search-box d-none d-md-block">
                    <div class="row align-items-center search-row">
                        <img class="search-icon col-md-2 col-lg-1 p-0" src="/images/search-icon.svg" alt="img">
                        <input type="text" name="searchString" class="search p-0 col-md-2 col-lg-11" placeholder="Pretraga...">
                    </div>
                </div>

                <!-- MOBILE SEARCH -->
                <img class="d-sm-block d-md-none search-icon col-1 p-0 margin-left-auto" src="/images/mobile-search-icon.svg" alt="img">

                <!-- CONTACT PHONE -->
                <a class="custom-anchor-tag d-none d-lg-block d-xl-block" href="tel:080050705">
                    <div class="header-contact">
                        <div class="contact-icon">
                            <img src="/images/phone-header.svg" alt="phone">
                        </div>
                        <div class="contact-text">
                            <h5 class="mb-1">Besplatni telefon:</h5>
                            <h3>080 05 07 05</h3>
                        </div>
                    </div>
                </a>

                <!-- CART ICON -->
                <button class="text-center col-lg-1 col-md-1 col-sm-1 col-2 order-3 order-md-4 order-lg-4 cart-button" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight" aria-controls="offcanvasRight">
                        <img src="/images/cart-icon.svg" alt="cart-icon">
                        <div class="cart-count">{{ Cart::count() }}</div>
                </button>
        </nav>
    </header>
    @forelse (Cart::content() as $row)
{{--        {{$row->name}}--}}
        @if(isset($row->options))
            <?php $opts = get_object_vars($row->options); ?>
            @foreach ($opts as $key => $option)
                | {{$row->options->$key}}
            @endforeach
        @endif
    @empty
    @endforelse
    @yield('content')

<!-- Footer -->
    <footer id="footer" class="text-center text-lg-start">
        <nav class="navbar navbar-bottom navbar-light shadow-sm bg-white footer-bg">
            <div class="container row-cols-sm-1 row-cols-md-3 row-cols-lg-4">
                <!-- BRAND ICON -->
                <a class="col-12 col-sm-12 col-md-12 margin-footer-320 text-align-initial" href="/home">
                    <img height="50px" width="200" src="/images/logo-footer.svg" alt="logo" class="logo-default">
                </a>

                <!-- CONTACT PHONE -->
                <a class="col-12 col-sm-12 custom-anchor-tag margin-footer-320 text-align-initial" href="tel:080050705">
                    <div class="header-contact justify-content-md-center">
                        <div class="contact-icon">
                            <img src="/images/phone-footer.svg" alt="phone">
                        </div>
                        <div class="contact-text">
                            <h5 class="mb-1 text-white-50">Besplatni telefon:</h5>
                            <h3 class="text-white-50">080 05 07 05</h3>
                        </div>
                    </div>
                </a>

                <!-- EMAIL CONTACT -->
                <a class="col-12 col-sm-12 custom-anchor-tag m-0 margin-footer-320 text-align-initial" href="mailto:info@klikbox.ba">
                    <div class="header-contact justify-content-md-center">
                        <div class="contact-icon d-flex justify-content-center">
                            <img src="/images/email-contact.svg" alt="phone">
                        </div>
                        <div class="contact-text">
                            <h3 class="text-white-50">info@klikbox.ba</h3>
                        </div>
                    </div>
                </a>

                <!-- PRIVACY POLICY & TERMS AND CONDITIONS -->
                <div class="col-12 col-sm-12 justify-content-md-center header-contact margin-footer-320 text-align-initial">
                    <div class="contact-text">
                        <a id="toggle-terms" style="text-decoration: none" href="javascript:void(0)"><h5 class="text-white-50 mb-2">Uslovi Korištenja</h5></a>
                        <a id="toggle-privacy" style="text-decoration: none" href="javascript:void(0)"><h5 class="text-white-50">Politika privatnosti</h5></a>
                    </div>
                </div>
            </div>
            <div class="container justify-content-center text-white-50 mt-md-4">
                @ <?= date("Y") ?> KlikBox | Teleklik d.o.o.
            </div>
        </nav>
    </footer>

    <!-- jquery script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- my script -->
    <script src="{{asset('js/script.js')}}"></script>
    <script src="{{asset('js/jquery.waypoints.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"
            integrity="sha512-RXf+QSDCUQs5uwRKaDoXt55jygZZm2V++WUZduaU/Ui/9EGp3f/2KZVahFZBKGH0s774sd3HmrhUy+SgOFQLVQ=="
            crossorigin="anonymous"></script>
    <script>
        let event = ('ontouchstart' in window) ? 'click' : 'mouseenter mouseleave';

        $('.dropbtn').on(event, function () {
            $(this).closest('div.dropdown').toggleClass('dropdown-open');
        });
        $('.search-btn').on('click', function () {
            $('.searchboxcol').toggleClass('d-none');
        })

        $(document).ready(function (e) {
            $('#toggle-privacy').on('click', function () {
                $('#privacy-modal').modal('toggle')
            })

            $('#toggle-terms').on('click', function() {
                $("#terms-modal").modal('toggle')
            });

            $('.close').on('click', function (eventObject) {
                $('.modal').modal('hide');
            });

        });
    </script>
    @yield('scripts')

</div>
</body>
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">

    <div class="offcanvas-header">
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <hr class="m-0">
    <div class="offcanvas-body p-4">
        @php $cartTotal = 0; @endphp
        @forelse (Cart::content() as $row)
            <?php
                $product = \App\Models\Product::getProduct($row->id);
                $price = null;

                $n = $product->price;
                switch($row->qty) {
                    case 1:
                        $whole = floor($product->price);
                        $fraction = $product->price - $whole;
                        $price = $fraction >= 0.5 ? round($product->price) : $product->price;
                        $cartTotal = $cartTotal + $price * $row->qty;
                        break;
                    case 2:
                        $discountPrice = $product->price * 0.85;
                        $whole = floor($discountPrice);
                        $fraction = $discountPrice - $whole;
                        $price = $fraction >= 0.5 ? round($discountPrice) : $whole;
                        $cartTotal = $cartTotal + $price * $row->qty;
                        break;
                    default:
                        $discountPrice = $product->price * 0.75;
                        $whole = floor($product->price * 0.75);
                        $fraction = $discountPrice - $whole;
                        $price = $fraction >= 0.5 ? round($discountPrice) : $whole;
                        $cartTotal = $cartTotal + $price * $row->qty;
                        break;
                }

            ?>

            <div class="row">
                <div class="col-4">
                    <img src="@if($product->photo != null){{$product->photo}}@endif" alt="img" class="cart-photo">
                </div>
                <div class="col-8 row flex-column justify-content-between">
                    <span class="cart-product-name">{{$product->name}}<span class="cart-ammount"> X {{$row->qty}}</span></span>
                    <span>{{$row->qty}} x {{$price}}.00 KM</span>
                </div>
            </div>

            <hr>

        @empty
            <h3>Korpa je prazna</h3>
        @endforelse

        @if(count(Cart::content()) > 0)
                <div class="row">
                    <div class="col-4">
                        <span>Dostava</span>
                    </div>
                    <div class="col-8">
                        <span>7 KM</span>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-4 align-self-center">
                        <span class="cart-product-name">Total</span>
                    </div>
                    <div class="col-8">
                        <span class="cart-total">{{$cartTotal + 7}} KM</span>
                    </div>
                </div>
                <a href="{{ url('cart') }}" class="orangebutton cartbtn cart-button-margin w-100 text-decoration-none">VIDI KORPU</a>
        @endif
        <a href="javascript:void(0)" class="orangebutton orangebutton-inverse cartbtn cart-button-margin w-100 text-decoration-none" data-bs-dismiss="offcanvas" aria-label="Close">NASTAVI KUPOVINU</a>
    </div>
</div>
@include('privacy')
@include('terms')
</html>
