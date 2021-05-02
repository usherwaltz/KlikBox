<?php
use Illuminate\Support\Facades\Route;
?>
@extends('layout')

@section('title', 'Products')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('css/miki.css')}}">
@endsection
@section('content')
<div class="products-home">
    <div class="container-fluid container-lg mt-4 all-products-home">

        <!-- BANNER -->
        <div class="banner">
            <img class="banner-background" src="/images/home-banner.png" alt="banner">
            <img src="/images/banner-text.png" alt="text" class="banner-text">
            <img class="banner-logo" src="/images/logo-nav.png" alt="logo">
        </div>

        <!-- ICONS -->
        <div class="tofu-box-home mt-4 mb-4">
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

        <!-- PRODUCT LISTING -->
        <div id="data-wrapper" class="row row-cols-xl-5">


        </div>
        <!-- Data Loader -->
        <div class="row">
            <div class="auto-load text-center col-12">
                <svg version="1.1" id="L9" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                     x="0px" y="0px" height="60" viewBox="0 0 100 100" enable-background="new 0 0 0 0" xml:space="preserve">
                <path fill="#000"
                      d="M73,50c0-12.7-10.3-23-23-23S27,37.3,27,50 M30.9,50c0-10.5,8.5-19.1,19.1-19.1S69.1,39.5,69.1,50">
                    <animateTransform attributeName="transform" attributeType="XML" type="rotate" dur="1s"
                                      from="0 50 50" to="360 50 50" repeatCount="indefinite" />
                </path>
                </svg>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.5/waypoints.min.js"></script>

<script>
    let ENDPOINT = "{{ url('/') }}" + <?php $route = Route::getCurrentRoute()->getActionMethod(); if($route == 'index' || $route == 'home') { ?>
        "/homeproducts?page=";
        <?php } elseif ($route == 'novo') {?>
        "/novoproducts?page=";
        <?php } elseif ($route == 'trend') {?>
            "/trendproducts?page=";
        <?php } elseif ($route == 'akcija') {?>
            "/akcijaproducts?page=";
    <?php } ?>
    let page = 1;
    infinteLoadMore(page);

    $(window).scroll(function () {
        if ($(window).scrollTop() + $(window).height() >= $(document).height()) {
            page++;
            <?php if ($route == 'index' || $route == 'home') { ?>
            infinteLoadMore(page);
            <?php } ?>
        }
    });

    function infinteLoadMore(page) {
        $.ajax({
            url: ENDPOINT + page,
            datatype: "html",
            type: "get",
            beforeSend: function () {
                $('.auto-load').show();
            }
        }).done(function (response) {
            if (response.length === 0 && page === 1) {
                $('.auto-load').html("Trenutno nemamo proizvoda za navesti. Molimo da nas posjetite malo kasnije.");
                return;
            } else if(response.length === 0) {
                $('.auto-load').html("Svi proizvodi su navedeni.");
                return;
            }
            $('.auto-load').hide();
            $("#data-wrapper").append(response);
        })
        .fail(function (jqXHR, ajaxOptions, thrownError) {
            console.log('Server error occured');
        });
    }

</script>
@endsection
