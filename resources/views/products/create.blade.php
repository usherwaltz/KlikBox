@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">{{ __('Kreiranje proizvoda') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <div class="row">
                        <div class="col-sm-12">
                            <form action="{{route('products.store')}}" class="form" method="POST">
                            @csrf
                            <div class="form-group">
                              <label for="name">Naziv</label>
                              <input type="text" class="form-control" name="name" id="name" aria-describedby="nameHelp" placeholder="">
                              <small id="nameHelp" class="form-text text-muted">Unesite naziv Proizvoda</small>
                            </div>
                            <button type="submit" class="btn btn-primary">Sačuvaj</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
