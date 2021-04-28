@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Atributi') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <h3>Kreiraj atribut</h3>
                            <form action="{{route('attribute.store')}}" class="form" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Naziv</label>
                                    <input type="text"
                                      class="form-control" name="name" id="name" aria-describedby="helpId" placeholder="">
                                    <small id="helpId" class="form-text text-muted">naziv atributa npr. velicina</small>
                                    @if($errors->has('name'))
                                    <div class="error">{{ $errors->first('name') }}</div>
                                    @endif
                                  </div>
                                  <div class="form-group">
                                    <label for="slug">Slug</label>
                                    <input type="text"
                                      class="form-control" name="slug" id="slug" placeholder="">
                                      @if($errors->has('slug'))
                                      <div class="error">{{ $errors->first('slug') }}</div>
                                      @endif
                                    </div>
                                  <button type="submit" class="btn btn-primary">{{__('Submit')}}</button>
                            </form>
                          
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <h3>Atributi u Sistemu</h3>
                            <ul>
                                @forelse ($attributes as $attribute )
                                <li><a href="/admin/attribute/{{$attribute->id}}">{{$attribute->name}}</a></li>
                                @empty
                                    <li>Nema stributa</li>
                                @endforelse
                            </ul>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
