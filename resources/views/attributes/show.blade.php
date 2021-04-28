@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Opcije atributa') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row">
                        
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <h3>Atribut</h3>
                            <ul>
                                <li>Naziv :{{$attribute->name}}</li>
                                <li>Slug :{{$attribute->slug}}</li>
                            </ul>
                           <form action="{{route('attribute.destroy',$attribute->id)}}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-primary">{{__('Obriši')}}</button>
                        </form>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <h3>Postojece opcije</h3>
                            <ul>
                                @forelse ($attribute->options as $option)
                                    <li>{{$option->name}}</li>
                                @empty
                                    
                                @endforelse
                            </ul>
                            <h3>Kreiraj opciju</h3>
                            <form action="{{route('option.store')}}" class="form" method="post">
                                @csrf
                                <input type="hidden" name="attribute_id" value="{{$attribute->id}}">
                                <div class="form-group">
                                    <label for="name">Naziv</label>
                                    <input type="text"
                                      class="form-control" name="name" id="name" aria-describedby="helpId" placeholder="">
                                    <small id="helpId" class="form-text text-muted">naziv opcije npr. velika L</small>
                                    @if($errors->has('name'))
                                    <div class="error">{{ $errors->first('name') }}</div>
                                    @endif
                                  </div>
                                  <div class="form-group">
                                    <label for="value">Vrijednost</label>
                                    <input type="text"
                                      class="form-control" name="value" id="value" aria-describedby="valueHelp" placeholder="">
                                      <small id="valueHelp" class="form-text text-muted">vrijednost opcije npr. L</small>
                                      @if($errors->has('value'))
                                      <div class="error">{{ $errors->first('value') }}</div>
                                      @endif
                                    </div>
                                  <button type="submit" class="btn btn-primary">{{__('Submit')}}</button>
                            </form>
                          
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
