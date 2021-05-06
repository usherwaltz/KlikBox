@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <form class="form" name="productform" action="{{ route('products.update', $product) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <div class="row mb-2">
                <div class="col-sm-12 col-md-8">
                    <div class="card">
                        <div class="card-header">{{ __('Proizvod') }}</div>

                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <div class="row">
                                <div class="container">

                                    <div class="form-group">
                                        <label for="name">{{ __('Naziv') }}</label>
                                        <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}"
                                            placeholder="Unesite naziv">
                                        @if ($errors->has('name'))
                                            <div class="error">{{ $errors->first('name') }}</div>
                                        @endif

                                    </div>
                                    <div class="form-group">
                                        <label for="slug">{{ __('Slug') }}</label>
                                        <input type="text" class="form-control" id="slug" name="slug" value="{{ $product->slug }}"
                                            placeholder="">
                                        @if ($errors->has('slug'))
                                            <div class="error">{{ $errors->first('slug') }}</div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="description">{{ __('Opis') }}</label>
                                        <textarea class="form-control" name="description" id="description" rows="5">
                                        {{ $product->description }}
                                        </textarea>
                                        @if ($errors->has('description'))
                                            <div class="error">{{ $errors->first('description') }}</div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="oldprice">{{ __('Stara Cijena') }}</label>
                                        <input type="text" value="{{$product->oldprice}}" class="form-control" name="oldprice" id="oldprice"
                                            aria-describedby="oldpriceHelp" placeholder="0.00">
                                        <small id="oldpriceHelp"
                                            class="form-text text-muted">{{ __('Unesite cijenu ili ostavite prazno') }}</small>
                                        @if ($errors->has('oldprice'))
                                            <div class="error">{{ $errors->first('oldprice') }}</div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="price">{{ __('Cijena') }}</label>
                                        <input type="text" value="{{$product->price}}" class="form-control" name="price" id="price"
                                            aria-describedby="priceHelp" placeholder="0.00">
                                        <small id="priceHelp"
                                            class="form-text text-muted">{{ __('Unsite cijenu') }}</small>
                                        @if ($errors->has('price'))
                                            <div class="error">{{ $errors->first('price') }}</div>
                                        @endif
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4">
                    <div class="row mb-2">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    {{ __('Kategorije') }}
                                </div>
                                <div class="card-body">
                                    @forelse ($categories as $category )
                                        <div class="form-check">
                                            <input type="checkbox" value="{{ $category->id }}" @if($product->categories->contains($category->id)) checked @endif class="form-check-input" name="categories[]">
                                            <label class="form-check-label"
                                                for="categories">{{ $category->name }}</label>
                                        </div>
                                    @empty

                                    @endforelse
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    {{ __('Slika proizvoda') }}
                                </div>
                                <div class="card-body">
                                    <img src="{{ $product->photo }}" width="300px" alt="{{ $product->name }}"
                                        class="src">
                                    <div class="form-group">
                                        <label for="photo">Slika</label>
                                        <input type="file" class="form-control-file" name="photo" id="photo" placeholder="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    Atributi
                                </div>
                                <div class="card-body">
                                    @foreach($attributes as $attribute)
                                        <h3>{{$attribute->name}}</h3>
                                        @foreach ($attribute->options as $option)
                                        <div class="form-check">
                                          <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input" name="options[]"  value="{{$option->id}}" @if($product->options->contains($option->id)) checked @endif>
                                          {{$option->name}}
                                          </label>
                                        </div>
                                        @endforeach
                                    @endforeach

                                        <hr>

                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input" name="top_choice" @if($product->top_choice == 1) checked @endif>
                                                Top Odabir
                                            </label>
                                        </div>
                                </div>
                                <div class="card-footer text-muted">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <hr>

        <div class="row mb-2">
            <div class="col-sm-12">
                @for($i = 0; $i < count($product->blocks); $i++)
                    @php $block = $product->blocks[$i]; @endphp
                    <div class="row mb-5">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    Block {{$i + 1}}
                                </div>
                                <div class="card-body">
                                    <form enctype="multipart/form-data" action="{{route('block.update',$block->id)}}" method="post">
                                        @csrf
                                        @method('PATCH')
                                        <div class="form-group row">
                                            <label class="col-6" for="content">Sadrzaj
                                                <textarea class="form-control ckeditor" name="content" id="content" rows="10">{{$block->content}}</textarea>
                                            </label>
                                            <div class="col-3">
                                                <div class="form-group">
                                                    <label for="photo">Slika 1</label>
                                                    <input type="file" class="form-control-file" name="photo" placeholder="">
                                                </div>
                                                <img src="{{ $block->photo }}" width="300px" class="src">
                                            </div>
                                            <div class="col-3">
                                                <div class="form-group">
                                                    <label for="photo">Slika 2</label>
                                                    <input type="file" class="form-control-file" name="photo_2" placeholder="">
                                                </div>
                                                <img src="{{ $block->photo_2 }}" width="300px" class="src">
                                            </div>
                                        </div>
                                        <input type="hidden" name="display" value="1">
                                        <button type="submit" class="btn btn-primary">{{__('Snimi')}}</button>
                                    </form>
                                </div>
                                <div class="card-footer text-muted">
                                    <form action="{{route('block.destroy',$block->id)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="product_slug" value="{{$product->slug}}">
                                        <button type="submit" class="btn btn-danger">Obriši</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endfor
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                Dodaj blok
                            </div>
                            <div class="card-body p-4">
                                <form enctype="multipart/form-data" action="{{route('block.store')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{$product->id}}">
                                    <input type="hidden" name="product_slug" value="{{$product->slug}}">
                                    <div class="form-group row">
                                        <label class="col-6" for="content">Blok tekst
                                            <textarea class="col-12 form-control ckeditor" type="textarea" name="content"></textarea>
                                        </label>
                                        <label class="col-3" for="photo">Slika 1
                                            <input type="file" class="form-control-file" name="photo" placeholder="">
                                        </label>
                                        <label class="col-3" for="photo">Slika 2
                                            <input type="file" class="form-control-file" name="photo_2" placeholder="">
                                        </label>
                                    </div>
                                    <div class="row form-group">
                                        <label class="col-2" for="icons">
                                            Ikonice
                                            <input type="checkbox" name="icons">
                                        </label>
                                        <label class="col-2" for="video">
                                            Video
                                            <input type="checkbox" name="video">
                                        </label>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Dodaj Blok</button>
                                </form>
                            </div>
                            <div class="card-footer text-muted">

                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection
@section('scripts')
<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<script>
    CKEDITOR.replace('description',{
        filebrowserUploadUrl: "{{route('imageupload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    });
    // CKEDITOR.config.extraPlugins = 'embed';
    CKEDITOR.config.contentsCss = "{{asset('css/editor.css')}}";
    CKEDITOR.config.extraAllowedContent = 'h5 div(*)';
    CKEDITOR.config.filebrowserUploadUrl= "{{route('imageupload', ['_token' => csrf_token() ])}}";
    CKEDITOR.config.filebrowserUploadMethod= 'form';
    CKEDITOR.replaceClass ='ckeditor';

</script>
@endsection
