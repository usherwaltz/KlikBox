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
    <div class="loader" style="display: none">
    </div>
    <div class="spinner-grow text-light" role="status" style="display: none">
        <span class="sr-only">Loading...</span>
    </div>
    <div class="container-fluid container-lg mt-4 all-products-home">
        <!-- SLIDER -->
        <div id="carouselExampleControls" class="carousel slide banner" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100 carousel-image" src="/images/slider-image-1.png" alt="First slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100 carousel-image" src="/images/slider-image-2.jpg" alt="Second slide">
                </div>
            </div>
            <a class="carousel-control-prev" href="javascript:void(0)" role="button" data-slide="prev" onclick="$(this).closest('.carousel').carousel('prev');">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="javascript:void(0)" role="button" data-slide="next" onclick="$(this).closest('.carousel').carousel('next');">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
            <img src="/images/banner-text.png" alt="text" class="banner-text">
            <img class="banner-logo" src="/images/logo-nav.png" alt="logo">
        </div>

        <!-- ICONS -->
        <div class="row my-sm-2 my-md-5 padding-x-12">

            <div class="col-sm-4 w-50 width-25-tablet px-0 col-md-3 d-flex my-4 my-md-0 align-icons">
                <img class="icon-home" src="/images/brza-dostava.svg" alt="delivery-pic">
                <p class="responsive-icon-text">BRZA <br>DOSTAVA 24H</p>
            </div>

            <div class="col-sm-4 w-50 width-25-tablet px-0 col-md-3 d-flex my-4 my-md-0 align-icons">
                <img class="icon-home" src="/images/sigurna-kupovina.svg" alt="safe-pic">
                <p class="responsive-icon-text">SIGURNA <br>KUPOVINA</p>
            </div>

            <div class="col-sm-4 w-50 width-25-tablet px-0 col-md-3 d-flex my-4 my-md-0 align-icons">
                <img class="icon-home" src="/images/placanje-pouzecu.svg" alt="pay-pic">
                <p class="responsive-icon-text">PLA??ANJE <br>POUZE??EM</p>
            </div>

            <div class="col-sm-4 w-50 width-25-tablet px-0 col-md-3 d-flex my-4 my-md-0 align-icons">
                <img class="icon-home" src="/images/povrat-novca.svg" alt="quality-pic">
                <p class="responsive-icon-text">GARANTOVAN <br>POVRAT NOVCA</p>
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
<script></script>
@endsection
