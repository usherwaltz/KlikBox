@extends('layouts.app')

@section('content')
    <div class="container">
        <form enctype="multipart/form-data"  class="form" name="productform" action="{{ route('products.update', $product) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <div class="row mb-4">
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
                    <div class="row">
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
            <hr>

            <div class="row mb-2 mt-4">
            <div class="col-12">
                <div class="row mb-5">
                    <div class="col-sm-12">
                        <div class="card">
                            @for($i = 0; $i < count($product->blocks); $i++)
                                @php $block = $product->blocks[$i]; @endphp
                                <div class="block-wrapper" data-blok="{{$i}}" data-id="{{$block->id}}">
                                    <div class="card-header border-top border-bottom-0 font-weight-bold font-size-xl">
                                        Blok {{$i + 1}}
                                        <div class="remove-button float-lg-right">
                                            <i class="fas fa-minus"></i>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <input type="text" value="{{$block->id}}" name="blocks[{{$i}}][id]" hidden>
                                        <div class="form-group row">
                                            <label class="col-lg-6 col-sm-12" for="content">Sadrzaj
                                                <textarea class="form-control ckeditor" name="blocks[{{$i}}][content]" id="content-{{$i}}" rows="10">{{$block->content}}</textarea>
                                            </label>
                                            <div class="col-lg-3 col-sm-12">
                                                <div class="form-group">
                                                    <label for="photo">Slika 1</label>
                                                    <input type="file" class="form-control-file" name="blocks[{{$i}}][photo]" placeholder="">
                                                </div>
                                                <img src="{{ $block->photo }}" class="src block-photo">
                                            </div>
                                            <div class="col-lg-3 col-sm-12">
                                                <div class="form-group">
                                                    <label for="photo">Slika 2</label>
                                                    <input type="file" class="form-control-file" name="blocks[{{$i}}][photo_2]" placeholder="">
                                                </div>
                                                <img src="{{ $block->photo_2 }}" class="src block-photo">
                                            </div>
                                        </div>
                                        <input type="hidden" name="display" value="1">
                                    </div>
                                </div>
                             @endfor
                            <div class="card-footer insert-before">
                                <button type="submit" class="btn btn-primary edit-product" hidden>{{__('Snimi Promjene')}}</button>
                                <div class="add-block btn btn-success float-lg-right">Dodaj Blok</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
        </form>
        <div class="toast">
            <div class="toast-header">
                KlikBox
            </div>
            <div class="toast-body">
                Uspješno ste obrisali blok.
            </div>
        </div>
    </div>
@endsection
@section('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<script>
    $(document).ready(function () {
        replaceEditor();

        $('.add-block').on('click', function(e) {
            e.preventDefault();
            let wrapper = $('.block-wrapper');
            let lastWrapper = wrapper[wrapper.length - 1]
            let data = $(lastWrapper).attr('data-blok');
            let dataInt = parseInt(data);
            let newData = isNaN(dataInt) ? 0 : dataInt + 1;
            let ordNum = newData + 1;

            let html =
                '<div class="block-wrapper" data-blok="' + newData + '">' +
                    '<div class="card-header border-top border-bottom-0 font-weight-bold font-size-xl">' +
                        'Blok ' + ordNum +
                        '<div class="remove-button no-ajax float-lg-right pointer">' +
                            '<i class="fas fa-minus"></i>' +
                        '</div>' +
                    '</div>' +
                    '<div class="card-body">' +
                        '<div class="form-group row">' +
                            '<label class="col-lg-6 col-sm-12" for="content">Sadrzaj' +
                                '<textarea class="form-control ckeditor" name="blocks[' + newData + '][content]" id="content-' + newData + '" rows="10"></textarea>' +
                            '</label>' +
                            '<div class="col-lg-3 col-sm-12">' +
                                '<div class="form-group">' +
                                    '<label for="photo">Slika 1</label>' +
                                    '<input type="file" class="form-control-file" name="blocks[' + newData + '][photo]" placeholder="">' +
                                '</div>' +
                            '</div>' +
                            '<div class="col-lg-3 col-sm-12">' +
                                '<div class="form-group">' +
                                    '<label for="photo_2">Slika 2</label>' +
                                    '<input type="file" class="form-control-file" name="blocks[' + newData + '][photo_2]" placeholder="">' +
                                '</div>' +
                            '</div>' +
                        '</div>' +
                    '</div>' +
                '</div>';

            appendHtml(html, ".insert-before");
            replaceEditor('content-' + newData);

        });

        function appendHtml(str, element) {
            $(str).insertBefore(element).hide().show('slow');
        }

        function replaceEditor(newElement) {
            let element = 'description';
            if(newElement != null) {
                element = newElement
            }
            CKEDITOR.replace(element,{
                filebrowserUploadUrl: "{{route('imageupload', ['_token' => csrf_token() ])}}",
                filebrowserUploadMethod: 'form'
            });
            // CKEDITOR.config.extraPlugins = 'embed';
            CKEDITOR.config.contentsCss = "{{asset('css/editor.css')}}";
            CKEDITOR.config.extraAllowedContent = 'h5 div(*)';
            CKEDITOR.config.filebrowserUploadUrl= "{{route('imageupload', ['_token' => csrf_token() ])}}";
            CKEDITOR.config.filebrowserUploadMethod= 'form';
            CKEDITOR.replaceClass ='ckeditor';
        }

        $('.blok-submit').on('click', function(e) {
            e.preventDefault();

            $('.edit-product').click();
        });

        $(document).on('click', '.remove-button', function() {
            if($(this).hasClass('no-ajax')) {
                let target = $(this).closest('.block-wrapper');
                target.hide('slow', function() {
                    target.remove();
                });
            } else {
                let block_id = $(this).closest(".block-wrapper").attr('data-id');
                let target = $(this).closest('.block-wrapper');
                $.ajax({
                    url: '/admin/remove',
                    type: 'DELETE',
                    data: {
                        "_token": "{{csrf_token()}}",
                        block_id
                    },
                    success: (response) => {
                        console.log('success');
                        target.hide('slow', function() {
                            target.remove();
                        });
                        $('.toast').toast({delay: 5000}).toast('show');
                    },
                    error: function (response) {
                        console.log('error');
                    }
                });
            }
        });
    });

</script>
@endsection
