<?php
$total = 0;
foreach ($order->items as $item) {
   $total += $item->qty * $item->price;
}
?>

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">{{ __('Atributi') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="personal">

                                <p>Lični podaci</p>

                                <h4>{{$order->name}} {{$order->lastname}}</h4>
                                <h4>{{$order->city}}</h4>
                                <h4> {{$order->street}}</h4>
                                <h4>{{$order->phone}}</h4>
                                <h4>{{$order->email}}</h4>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <h4>Proizvodi</h4>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Naziv</th>
                                        <th>Količina</th>
                                        <th>Cijena</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order->items as $item )
                                    <tr>
                                        <td scope="row">{{$item->name}}</td>
                                        <td>{{$item->qty}}</td>
                                        <td>{{$item->price}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="3">TOTAL: {{$total + 7}}</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
