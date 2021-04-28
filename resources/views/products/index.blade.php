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
                            <a href="{{route('products.create')}}" class="btn btn-success">{{__('Dodaj proizvod')}}</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <h3>Proizvodi</h3>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Naziv</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($products as $product)
                                    <tr>
                                        <td scope="row">{{$product->id}}</td>
                                        <td>{{$product->name}}</td>
                                        <td>
                                            <div class="row">
                                                <div class="col-m-6">
                                                    <a href="{{route('products.edit',$product->slug)}}" class="btn btn-sm btn-primary">
                                                        Izmjena
                                                    </a>
                                                </div>
                                                <div class="col-m-6">
                                                    <form action="{{route('products.destroy',$product)}}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <input class="btn btn-sm btn-danger" type="submit" name="submit" value="Obriši">
                                                    </form>
                                                </div>
                                            </div>


                                        </td>
                                    </tr>
                                    @empty
                                        
                                    @endforelse
                                    
                                    <tr>
                                        <td scope="row"></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                            {{$products->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
