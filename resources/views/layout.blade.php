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
                    </ul>
                </div>
            </div>
        </div>
        <nav class="navbar navbar-light shadow-sm bg-white">
            <div class="container">

                <!-- DROPDOWN TOGGLE -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
                    <img src="/images/hamburger.svg" alt="menu">
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
                <button class="text-center col-lg-1 col-md-1 col-sm-1 col-2 order-3 order-md-4 order-lg-4 cart-button" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight" aria-controls="offcanvasRight">
                        <img src="/images/cart-icon.svg" alt="cart-icon">
                        <div class="cart-count">{{ Cart::count() }}</div>
                </button>
            </div>
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
                        <a id="toggle-terms" style="text-decoration: none" href="javascript:void(0)"><h5 class="text-white-50 mb-2">Uslovi Korištenja</h5></a>
                        <a id="toggle-privacy" style="text-decoration: none" href="javascript:void(0)"><h5 class="text-white-50">Politika privatnosti</h5></a>
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
        @forelse (Cart::content() as $row)
            <?php $product = \App\Models\Product::getProduct($row->id); ?>

            <div class="row">
                <div class="col-4">
                    <img src="{{$product->photo}}" alt="img" class="cart-photo">
                </div>
                <div class="col-8 row flex-column justify-content-between">
                    <span class="cart-product-name">{{$product->name}}<span class="cart-ammount"> X {{$row->qty}}</span></span>
                    <span>{{$row->price}}.00 KM</span>
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
                        <span class="cart-total">{{Cart::total() + 7}} KM</span>
                    </div>
                </div>
                <a href="{{ url('cart') }}" class="orangebutton cartbtn cart-button-margin w-100 text-decoration-none">VIDI KORPU</a>
        @endif
        <a href="javascript:void(0)" class="orangebutton orangebutton-inverse cartbtn cart-button-margin w-100 text-decoration-none" data-bs-dismiss="offcanvas" aria-label="Close">NASTAVI KUPOVINU</a>
    </div>
</div>
<div class="modal" id="privacy-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Politika privatnosti</h5>
                <button type="button" class="close bg-transparent shadow-none border-0" data-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    Politika privatnosti

                     
                    Ova Politika privatnosti opisuje kako se lični podaci
                    prikupljaju, koriste i dijele kada posećujete ili naručujete
                    preko www.klikbox.ba
                     
                    1. KAKO PRIKUPLJAMO LIČNE INFORMACIJE
                    Kada posjetite Klikbox online prodavnicu, automatski prikupljamo
                    određene informacije o vašem uređaju, uključujući podatke o
                    vašem web pretraživaču, IP adresi, vremenskoj zoni i nekim
                    kolačićima koji su instalirani na vašem uređaju. Pored toga, dok
                    pregledavate Klikbox online prodavnicu, prikupljamo informacije
                    o pojedinačnim web stranicama ili proizvodima koje pregledate,
                    koje web stranice ili pojmovi za pretragu su vas preusmjerili na
                    Klikbox online prodavnicu, kao i informacije o načinu na koji
                    komunicirate sa web lokacijom. Ovo automatsko prikupljanje
                    informacija vršimo pomoću sljedećih tehnologija:
                    Kolačići su datoteke podataka koje se postavljaju na vaš uređaj
                    ili računar i često sadrže anonimni jedinstveni identifikator.
                    Datoteke logovanja evidentiraju akcije koje se događaju na web
                    lokaciji i prikupljaju podatke uključujući vašu IP adresu, vrstu
                    pretraživača, datum, vrijeme.
                    Takođe, kada izvršite narudžbu ili pokušate da izvršite narudžbu
                    putem Klikbox online prodavnice, od vas prikupljamo određene
                    podatke, uključujući Vaše ime, poslovnu adresu, Email adresu i
                    telefonski broj. To se zove Informacije o porudžbini.
                    2. KAKO KORISTIMO VAŠE LIČNE INFORMACIJE
                    Informacije o porudžbini koje obično prikupljamo da bismo
                    ispunili bilo koje porudžbine postavljene preko KlikBox online

                    prodavnice, koristimo kako bismo Vas kontaktirali i isporučili
                    željeni proizvod. Takođe, ukoliko se upišete na Newsletter listu,
                    slaćemo vam informacije, zanimljivosti i promotivne poruke. Sa
                    mailing liste se u svako doba možete odjaviti.
                    Pored toga, Vaše korisničko iskustvo koristimo za generalno
                    poboljšanje i optimizaciju naše KlikBox online prodavnice.
                    Konekcija sa Klikbox online prodavnicom je osigurana SSL
                    sertifikatom tako da niko nije u mogućnosti preuzeti Vaše lične
                    podatke.
                    3. DIJELJENJE VAŠIH LIČNIH INFORMACIJA
                    Vaše lične podatke dijelimo sa trećim licima samo u svrhu
                    praćenja statistika o posjetiocima i proizvodima koji ih zanimaju.
                    Koristimo Google Analitiku u svrhu analize kako naši klijenti
                    koriste Klikbox online prodavnicu. Konačno, možemo takođe
                    dijeliti Vaše lične podatke za potrebe pridržavanja važećih
                    zakona i propisa, da odgovorimo na sudski poziv, nalog za
                    pretragu ili druge zakonite zahtjeve.
                    4. VAŠA PRAVA
                    Imate pravo da pristupite ličnim podacima koje imamo o Vama i
                    da zatražite da se isti ispravljaju, ažuriraju ili obrišu. Ako želite da
                    iskoristite ovo pravo, kontaktirajte nas.
                    5. POVRATAK PODATAKA
                    Kada izvršite narudžbu putem KlikBox online prodavnice,
                    čuvaćemo podatke o Vašoj porudžbini radi naše evidencije, osim
                    i sve dok ne zatražite da te podatke izbrišemo.
                    6. PROMJENE
                    Možemo povremeno ažurirati ovu politiku privatnosti kako bismo
                    odražavali, na primer, promjene u našoj praksi ili iz drugih
                    operativnih, pravnih ili regulatornih razloga. Ako imate pitanja i /
                    ili vam je potrebno više informacija, slobodno nas kontaktirajte.
                </p>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="terms-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Uslovi poslovanja</h5>
                <button type="button" class="close bg-transparent shadow-none border-0" data-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    Uslovi poslovanja

                     
                    -Uslovi poslovanja koji vrijede za KlikBox.ba online
                    prodavnicu.
                     
                     
                    1.Odaberite željene proizvode i ubacite ih u korpu
                    Proizvode koje ste odabrali možete ubaciti u korpu
                    pritiskom na dugme - &quot; DODAJ U KORPU &quot; i taj proizvod
                    će biti ubačen u vašu korpu. Neki proizvodi zahtijevaju
                    odabir boje, veličine ili vrste prije nego što ih ubacite u
                    korpu. Kako biste to učinili, prvo odaberite jednu od
                    ponuđenih opcija  iznad opcije &quot; DODAJ U KORPU &quot; .
                    Kada ste odabrali jednu od ponuđenih opcija kao sto je
                    boja, veličina i Top odabir, pritiskom na dugme - &quot; DODAJ
                    U KORPU &quot; taj proizvod će biti ubačen u vašu korpu.  
                    2. Upišite Vaše podatke i završite narudžbu
                    Postupak kupovine je izuzetno jednostavan. Upišite svoje
                    podatke i završite svoju narudžbu - i to je sve!  Plaćanje vrši
                    isključivo putem pouzeća, to jest gotovinski pri preuzimanju
                    (dostave) narudžbe. Takođe u korpi možete revidirati svoju
                    narudžbu, izmijeniti količinu, dodati nove proizvode ili ih ukloniti
                    iz korpe.
                    3. Potvrda narudžbe putem E-mail adrese
                    Nakon obrade Vaše narudžbe, dobićete potvrdu putem E-mail.
                    Slanje narudžbe biće obavljeno u najkraćem roku, a naši
                    operateri će Vas kontaktirati kako bi potvrdili prijem narudžbe i
                    obavijestili Vas o datumu isporuke. U slučaju da traženi
                    proizvod trenutno nemamo na lageru, bićete kontaktrani radi
                    dogovora. Sve porudžbe koje su primljene do 14h biće poslate

                    istog dana, a sve porudžbe posle 14h biće poslate sledeći radni
                    dan.
                     
                    4. Naručene proizvode dostavljamo na Vašu adresu
                    Pošiljka sa Vašim proizvodima biće dostavljena na Vašu adresu
                    u roku od 1 - 4 dana ako proizvode imamo na stanju.
                    Ukoliko imate pitanja u vezi Vaše narudžbe, možete nas
                    kontaktirati putem Email adrese info@klikbox.ba ili pozovite
                    besplatan broj 080 05 07 05
                     
                    5. Garancije na povrat novca u roku od 14 dana
                    Povrat robe je moguć u roku od 14 dana od dana kupovine.
                    Roba mora biti neotpakovana, nekorištena i u originalnom
                    pakovanju. Garantovan 100% povrat novca na tekući račun
                    kupca (umanjen za troškove dostave). Kupac snosi troškove
                    povrata robe prodavcu!
                     
                     

                    Politika privatnosti

                     
                    Ova Politika privatnosti opisuje kako se lični podaci
                    prikupljaju, koriste i dijele kada posećujete ili naručujete
                    preko www.klikbox.ba
                     
                    1. KAKO PRIKUPLJAMO LIČNE INFORMACIJE

                    Kada posjetite Klikbox online prodavnicu, automatski prikupljamo
                    određene informacije o vašem uređaju, uključujući podatke o
                    vašem web pretraživaču, IP adresi, vremenskoj zoni i nekim
                    kolačićima koji su instalirani na vašem uređaju. Pored toga, dok
                    pregledavate Klikbox online prodavnicu, prikupljamo informacije
                    o pojedinačnim web stranicama ili proizvodima koje pregledate,
                    koje web stranice ili pojmovi za pretragu su vas preusmjerili na
                    Klikbox online prodavnicu, kao i informacije o načinu na koji
                    komunicirate sa web lokacijom. Ovo automatsko prikupljanje
                    informacija vršimo pomoću sljedećih tehnologija:
                    Kolačići su datoteke podataka koje se postavljaju na vaš uređaj
                    ili računar i često sadrže anonimni jedinstveni identifikator.
                    Datoteke logovanja evidentiraju akcije koje se događaju na web
                    lokaciji i prikupljaju podatke uključujući vašu IP adresu, vrstu
                    pretraživača, datum, vrijeme.
                    Takođe, kada izvršite narudžbu ili pokušate da izvršite narudžbu
                    putem Klikbox online prodavnice, od vas prikupljamo određene
                    podatke, uključujući Vaše ime, poslovnu adresu, Email adresu i
                    telefonski broj. To se zove Informacije o porudžbini.
                    2. KAKO KORISTIMO VAŠE LIČNE INFORMACIJE
                    Informacije o porudžbini koje obično prikupljamo da bismo
                    ispunili bilo koje porudžbine postavljene preko KlikBox online
                    prodavnice, koristimo kako bismo Vas kontaktirali i isporučili
                    željeni proizvod. Takođe, ukoliko se upišete na Newsletter listu,
                    slaćemo vam informacije, zanimljivosti i promotivne poruke. Sa
                    mailing liste se u svako doba možete odjaviti.
                    Pored toga, Vaše korisničko iskustvo koristimo za generalno
                    poboljšanje i optimizaciju naše KlikBox online prodavnice.
                    Konekcija sa Klikbox online prodavnicom je osigurana SSL
                    sertifikatom tako da niko nije u mogućnosti preuzeti Vaše lične
                    podatke.

                    3. DIJELJENJE VAŠIH LIČNIH INFORMACIJA
                    Vaše lične podatke dijelimo sa trećim licima samo u svrhu
                    praćenja statistika o posjetiocima i proizvodima koji ih zanimaju.
                    Koristimo Google Analitiku u svrhu analize kako naši klijenti
                    koriste Klikbox online prodavnicu. Konačno, možemo takođe
                    dijeliti Vaše lične podatke za potrebe pridržavanja važećih
                    zakona i propisa, da odgovorimo na sudski poziv, nalog za
                    pretragu ili druge zakonite zahtjeve.
                    4. VAŠA PRAVA
                    Imate pravo da pristupite ličnim podacima koje imamo o Vama i
                    da zatražite da se isti ispravljaju, ažuriraju ili obrišu. Ako želite da
                    iskoristite ovo pravo, kontaktirajte nas.
                    5. POVRATAK PODATAKA
                    Kada izvršite narudžbu putem KlikBox online prodavnice,
                    čuvaćemo podatke o Vašoj porudžbini radi naše evidencije, osim
                    i sve dok ne zatražite da te podatke izbrišemo.
                    6. PROMJENE
                    Možemo povremeno ažurirati ovu politiku privatnosti kako bismo
                    odražavali, na primer, promjene u našoj praksi ili iz drugih
                    operativnih, pravnih ili regulatornih razloga. Ako imate pitanja i /
                    ili vam je potrebno više informacija, slobodno nas kontaktirajte.
                </p>
            </div>
        </div>
    </div>
</div>
</html>
