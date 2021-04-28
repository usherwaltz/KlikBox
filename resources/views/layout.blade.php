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
    <link rel="preload" as="style" href="{{asset('css/reset.css')}}" onload="this.rel='stylesheet'">
    <link rel="preload" as="style" href="{{asset('css/animate.css')}}" onload="this.rel='stylesheet'">
    <link rel="preload" as="style" href="{{asset('css/fa.all.min.css')}}" onload="this.rel='stylesheet'">
    <link rel="preload" as="style" href="{{asset('css/bootstrap.min.css')}}" onload="this.rel='stylesheet'">
    <link rel="preload" as="style" href="{{asset('css/miki.css')}}" onload="this.rel='stylesheet'">



<!-- font -->
    <link
            href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
          rel="stylesheet">
@yield('ogtags')

</head>

<body>
<div class="container-fluid pt-3 pb-3 header">
    <div class="row">
        <div class="col-lg-2 col-md-4 col-sm-10 col-8 order-1">
            <div class="logo-box">
                <a class="logo-a" href="{{url()->current()}}">
                    <img class="logo-i" src="/images/logo-nav.png" alt="logo-nav" width="223px">
                </a>
            </div>
        </div>
        <div class="col-lg-9 col-md-7 col-sm-12 col-12 d-none d-md-block order-4 searchboxcol">
            <div class="search-box">
                <form action="" method="post">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control search" placeholder="Pretraga...">
                        <input type="submit" value="" class="search-button">
                    </div>
                </form>
            </div>
        </div>
        <div class="col-2 col-sm-1 d-md-none order-3 px-0">
            <div class="search-btn" style="display: inline-block; vertical-align: middle; width: 50px;
height: 50px;">
                <img src="/images/search-ico.png" alt="search" width="50px">
            </div>
        </div>
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
</div>
<div class="page-e">

    <!-- --------------------------------------------------------------- -->
    <!-- --------------------------------------------------------------- -->

<!--<div class="nav">
    <div class="nav-box">
        <div class="logo-box">
            <a class="logo-a" href="/">
                <img class="logo-i" src="/images/logo-nav.png" alt="logo-nav">
            </a>
        </div>
        <div class="search-box">
            <form action="" method="">
                <input type="submit" value="">
                <input type="text" placeholder="Pretraga..." name="">
            </form>
        </div>      
        <div class="bag-box">
                <div class="dropdown" style="float:left;">
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
        <div class="neto-box">
            
            <p></p>
        </div>
    </div>  
 </div>-->

    <!-- --------------------------------------------------------------- -->
    <!--<div class="clearfix"></div>  -->
    <!-- --------------------------------------------------------------- -->
@yield('content')

<!-- --------------------------------------------------------------- -->
    <!--<div class="clearfix"></div>-->
    <!-- --------------------------------------------------------------- -->

    <!--<div class="clearfix"></div>
    <div class="bottom">
        <div class="bottom-box">
            <div class="bottom-left">
                <div class="logo-bottom">
                   <img src="/images/logo-bottom.png" alt="logo-bottom">
                </div>
                <p>Besplatan broj <br> <a href="tel:080050705">080 05 07 05</a></p>
                <p><a href="mailto:info@klikbox.ba">info@klikbox.ba</a></p>
                <p>
                    <a href="https://www.google.com/maps/place/Teleklik/@44.7831412,17.1983771,16.75z/data=!4m5!3m4!1s0x0:0xa678a8c697b8d01a!8m2!3d44.7843704!4d17.1991509" target="_blank">Kralja Petra II Karađorđevića 39,<br>78000 Banja Luka</a>
                </p>
                <p><a class="copyright" href="#">Uslovi korišćenja</a> <br> <a class="copyright" href="#">Politika Privatnosti</a></p>
                <p>2021 KlikBox | Teleklik.doo</p>
            </div>
            <div class="bottom-right">
                <p class="bottom-title">Vaša kupovina <br> na klik !</p>
                <a href="/" class="bootom-a">SVI PROIZVODI</a>
            </div>
        </div>
    </div>
    -->
    <div class="footer">
        <div class="container pt-5 pb-5">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-xs-12 mb-5">
                    <p class="bottom-title">Vaša kupovina <br> na klik !</p>
                    @if(setting('show_productbtn'))
                        <a href="/" class="bootom-a">SVI PROIZVODI</a>
                    @endif
                </div>

                <div class="col-lg-6 col-md-6 col-xs-12 pt-3">
                    <p><i class="fas fa-headset"></i><span>Besplatni telefon: <a
                                    href="tel:080050705">080 05 07 05</a></span></p>
                    <p><i class="far fa-envelope"></i><a href="mailto:info@klikbox.ba">info@klikbox.ba</a></p>
                    <hr>
                    <div class="logo-bottom mb-4">
                        <a href="/">
                            <img src="{{asset('images/logo-bottom.png')}}" alt="logo-bottom">
                        </a>
                    </div>
                    <!--<p>
                        <a href="https://www.google.com/maps/place/Teleklik/@44.7831412,17.1983771,16.75z/data=!4m5!3m4!1s0x0:0xa678a8c697b8d01a!8m2!3d44.7843704!4d17.1991509" target="_blank">Kralja Petra II Karađorđevića 39,<br>78000 Banja Luka</a>
                    </p>-->
                    <p><a class="privatnost" href="#">Uslovi korišćenja</a> <br> <a class="privatnost" href="#">Politika
                            Privatnosti</a></p>
                    <p class="copyright">2021 KlikBox | Teleklik.doo</p>
                </div>
            </div>

        </div>
    </div>
    <!-- --------------------------------------------------------------- -->
    <!-- --------------------------------------------------------------- -->

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
