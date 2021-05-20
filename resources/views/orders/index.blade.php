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
                        <div class="col-sm-12">
                            <h3>Narudžbe</h3>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Ime</th>
                                        <th>Prezime</th>
                                        <th>Datum i Vrijeme</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($orders as $order)
                                    <tr>
                                        <td scope="row">{{$order->name}}</td>
                                        <td>{{$order->lastname}}</td>
                                        <td>{{$order->created_at->format('d.m.Y H:i:s')}}</td>
                                        <td>
                                            <a href="{{route('orders.show',$order->id)}}" class="btn btn-sm btn-primary">
                                            Pregled
                                            </a>
                                        </td>
                                    </tr>
                                    @empty

                                    @endforelse

                                    <tr>
                                        <td scope="row"></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    {{$orders->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
