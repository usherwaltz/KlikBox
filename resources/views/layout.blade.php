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
    <header id="header" class="sticky-top" id="header">
        <div class="collapse" id="navbarToggleExternalContent">
            <div class="p-4">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <a class="bg-white shadow-sm w3-bar-item" href="/novo"><i class="fas fa-tags"></i> NOVO</a>
                            <a class="bg-white shadow-sm w3-bar-item" href="/trend"> <i class="fas fa-arrow-up"></i> TREND</a>
                            <a class="bg-white shadow-sm w3-bar-item" href="/akcija"><i class="fas fa-percentage"></i> AKCIJA</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <nav class="navbar navbar-light shadow-sm bg-white">
            <div class="container">

                <!-- DROPDOWN TOGGLE -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>


                <!-- BRAND ICON -->
                <a class="navbar-brand mr-4" href="/home">
                    <img height="50px" src="/images/logo-nav.png" alt="logo" class="logo-default">
                </a>

                <!-- SEARCH BOX -->
                <div class="search-box mx-auto">
                    <form action="#" method="">
                        <div class="input-group">
                            <input type="text" class="form-control search" placeholder="Pretraga...">
                            <input type="#" value="" class="search-button">
                        </div>
                    </form>
                </div>

                <!-- CONTACT PHONE -->
                <a class="custom-anchor-tag" href="tel:080050705">
                    <div class="header-contact">
                        <div class="contact-icon">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                        <div class="contact-text">
                            <h5 class="mb-1">Besplatni telefon:</h5>
                            <h3>080 05 07 05</h3>
                        </div>
                    </div>
                </a>

                <!-- CART ICON -->
                <div class="col-lg-1 col-md-1 col-sm-1 col-2 order-3 order-md-4 order-lg-4">
                    <div class="bag-box">
                        <div class="dropdown">
                            <button class="dropbtn">
                                {{ Cart::count() }}
                            </button>
                            <div class="dropdown-content" style="right:0;">
                                <ul>
                                    @forelse (Cart::content() as $row)
                                        <li>
                                            <div></div>
                                            <div>
                                                {{$row->name}}
                                                @if(isset($row->options))
                                                    <?php $opts = get_object_vars($row->options); ?>
                                                    @foreach ($opts as $key => $option)
                                                        | {{$row->options->$key}}
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div>X</div>
                                            <div>{{$row->qty}}</div>
                                        </li>
                                    @empty
                                        <li>Korpa je prazna</li>
                                    @endforelse
                                </ul>
                                <a href="{{ url('cart') }}" class="orangebutton cartbtn">Vidi korpu</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    @forelse (Cart::content() as $row)
        {{$row->name}}
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
            <div class="container">
                <!-- BRAND ICON -->
                <a class="navbar-brand mr-4" href="/home">
                    <img height="50px" src="/images/logo-bottom.png" alt="logo" class="logo-default">
                </a>

                <!-- CONTACT PHONE -->
                <a class="custom-anchor-tag" href="tel:080050705">
                    <div class="header-contact">
                        <div class="contact-icon">
                            <i class="fas fa-phone-alt text-white-50"></i>
                        </div>
                        <div class="contact-text">
                            <h5 class="mb-1 text-white-50">Besplatni telefon:</h5>
                            <h3 class="text-white-50">080 05 07 05</h3>
                        </div>
                    </div>
                </a>

                <!-- EMAIL CONTACT -->
                <a class="custom-anchor-tag" href="mailto:info@klikbox.ba">
                    <div class="header-contact">
                        <div class="contact-icon">
                            <i class="fas fa-envelope text-white-50"></i>
                        </div>
                        <div class="contact-text">
                            <h3 class="text-white-50">info@klikbox.ba</h3>
                        </div>
                    </div>
                </a>

                <!-- PRIVACY POLICY & TERMS AND CONDITIONS -->
                <div class="header-contact">
                    <div class="contact-text">
                        <a style="text-decoration: none" href="#"><h5 class="text-white-50 mb-2">Uslovi Korištenja</h5></a>
                        <a style="text-decoration: none" href="#"><h5 class="text-white-50">Politika privatnosti</h5></a>
                    </div>
                </div>
            </div>
            <div class="container justify-content-center text-white-50">
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
    </script>
    @yield('scripts')

</div>
</body>

</html>
