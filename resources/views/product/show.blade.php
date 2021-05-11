@extends('layout')

@section('title','Product')

@section('css')
	<style>
		@charset "UTF-8";@import url(https://fonts.googleapis.com/css?family=Nunito);:root{--blue:#3490dc;--indigo:#6574cd;--purple:#9561e2;--pink:#f66d9b;--red:#e3342f;--orange:#f6993f;--yellow:#ffed4a;--green:#38c172;--teal:#4dc0b5;--cyan:#6cb2eb;--white:#fff;--gray:#6c757d;--gray-dark:#343a40;--primary:#3490dc;--secondary:#6c757d;--success:#38c172;--info:#6cb2eb;--warning:#ffed4a;--danger:#e3342f;--light:#f8f9fa;--dark:#343a40;--breakpoint-xs:0;--breakpoint-sm:576px;--breakpoint-md:768px;--breakpoint-lg:992px;--breakpoint-xl:1200px;--font-family-sans-serif:"Nunito",sans-serif;--font-family-monospace:SFMono-Regular,Menlo,Monaco,Consolas,"Liberation Mono","Courier New",monospace}*,:after,:before{box-sizing:border-box}html{font-family:sans-serif;line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0;font-family:Nunito,sans-serif;font-size:.9rem;font-weight:400;line-height:1.6;color:#212529;text-align:left;background-color:#f8fafc}pre{font-family:SFMono-Regular,Menlo,Monaco,Consolas,Liberation Mono,Courier New,monospace;font-size:1em}pre{margin-top:0;margin-bottom:1rem;overflow:auto;-ms-overflow-style:scrollbar}::-webkit-file-upload-button{font:inherit;-webkit-appearance:button}pre{display:block;font-size:87.5%;color:#212529}body{font-family:Montserrat,sans-serif;background:#f4f4f4}
	</style>
@endsection
@section('ogtags')
	<meta property="og:url" content="{{url()->current()}}"/>
	<meta property="og:type" content="product"/>
	<meta property="og:title" content="KlikBox - {{$product->name}}"/>
	<meta property="og:description" content="{{strip_tags($product->description)}}"/>
	<meta property="og:image" content="{{asset($product->photo)}}"/>
    <meta property="og:locale" content="bs_BA" />
@endsection
@section('content')
<div class="container-fluid mt-4 single bg-white">
    <div class="container">

        <div id="bofu" class="bofu">
            <div class="bofu-box">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-md-12 product-image-wrapper pt-lg-5 pb-lg-5">
                            <div class="bofu-left">
                                @if($product->oldprice != null)
                                    <div class="start-procent">
                                        <div class="procent"><span>- {{round($product->price / $product->oldprice * 100)}}%</span></div>
                                    </div>
                                @endif
                                @if($product->photo)
                                    <img class="start-img" src="{{$product->photo}}" alt="{{$product->title}}">
                                @else
                                    <img class="start-img" src="/images/no-image.png" alt="fire">
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12 pt-5 pb-5">
                            <div class="bofu-right">
                                <div class="message"><img src="/images/fire.png" alt="fire" width="21px">Još samo 12 artikala na zalihama</div>
                                <div class="title"><h2>{{$product->name}}</h2></div>
                                <div class="stars-box mb-4">
                                    <i class="fas fa-star mr-1"></i>
                                    <i class="fas fa-star mr-1"></i>
                                    <i class="fas fa-star mr-1"></i>
                                    <i class="fas fa-star mr-1"></i>
                                    <i class="fas fa-star"></i>
                                    4.7 / 5 <span>Proizvod dostupan samo na KlikBox.ba</span></div>
                                <div class="desc">{!!$product->description!!}</div>
                                <div class="form">
                                    <form action="{{route('cart.store')}}" method="post" name="cartform">
                                        <input type="hidden" name="qty" id="qty" value="1">
                                        <input type="hidden" name="prc" id="prc" value="{{$product->price}}">
                                        <div class="price mt-4 mb-4" id="selectedprice">
                                            @if($product->oldprice)
                                                <div id="oldprice">
                                                    <span>{{$product->oldprice}}</span> KM
                                                </div>
                                            @endif
                                            <div id="newprice">
                                                <span>{{$product->price}}</span> KM
                                            </div>
                                        </div>
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{$product->id}}">
                                        <div class="attributes">
                                            @foreach ($attributes as $attribute )
                                                <div class="atribut">
                                                    <select name="{{Str::lower($attribute->name)}}" id="{{Str::lower($attribute->name)}}" class="attr-select" required>
                                                        <option value="">{{$attribute->name}}</option>
                                                        @foreach ($product->options->where('attribute_id',$attribute->id) as $option )
                                                            <option value="{{$option->value}}">{{$option->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            @endforeach
                                        </div>
                                        @if($product->top_choice === 1)
                                            <div class="text-center">
                                                <div class="choicebox">
                                                    <span class="topponuda">TOP ODABIR</span>
                                                    <div class="btn active">
                                                        <span class="choicebtn" data-quantity="1" data-oldprice="{{round($product->oldprice)}}" data-prc="{{round($product->price)}}">1 x {{round($product->price)}} KM</span>
                                                    </div>
                                                    <div class="btn">
                                                        <span class="choicebtn" data-quantity="2" data-oldprice="{{round($product->oldprice)}}" data-prc="{{round($product->price * ((100-22) / 100))}}">2 x {{round($product->price * ((100-22) / 100))}} KM</span>
                                                    </div>
                                                    <div class="btn">
                                                        <span class="choicebtn" data-quantity="3" data-oldprice="{{round($product->oldprice)}}" data-prc="{{round($product->price * ((100-30) / 100))}}">3 x {{round($product->price * ((100-30) / 100))}} KM</span>
                                                    </div>
                                                </div>
                                                <div class="mb-4 mt-3">
                                                    <span>Proizvod dostupan samo na KlikBox.ba</span>
                                                </div>
                                            </div>
                                        @endif
                                        <input type="submit" class="addtocartbtn w-100" value="DODAJ U KORPU">
                                    </form>
                                </div>
                                <div class="garancy">
                                    <div class="row">
                                        <div class="col-4 garancy-box">
                                            <img src="{{asset('/images/delivery-pic.png')}}" alt="delivery">
                                            <p>BRZA DOSTAVA 24H</p>
                                        </div>
                                        <div class="col-4 garancy-box">
                                            <img src="{{asset('/images/pay-pic.png')}}" alt="pay">
                                            <p>PLAĆANJE POUZEĆEM</p>
                                        </div>
                                        <div class="col-4 garancy-box">
                                            <img src="{{asset('/images/garancy-pic.png')}}" alt="garancy">
                                            <p>GARANTOVAN POVRAT NOVCA</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
    </div>
</div>
<div class="">
    @for($i = 0; $i < count($product->blocks); $i++)
        @php
            $block = $product->blocks[$i];
            $background = $i % 2 ? "white" : "light";
        @endphp
        @switch($block->type)
            @case("STANDARD")
            @if($i % 2)
                <div class="bg-{{$background}}">
                    <div class="container block-padding">
                        <div class="col-12 row block-parent justify-content-space-between">
                            @if($block->photo != null && $block->photo_2 != null)
                                @if($block->content != null)
                                    <div class="col-12 block-content text-center align-self-center custom-content mb-4">
                                        {!!$block->content!!}
                                    </div>
                                @endif
                                <img class="col-lg-6 col-sm-12 block-image block-content block-image-padding-bottom" src="{{$block->photo}}" alt="photo">
                                <img class="col-lg-6 col-sm-12 block-image block-content" src="{{$block->photo_2}}" alt="photo">
                            @elseif(($block->photo != null || $block->photo_2 != null) && $block->content != null)
                                <img class="col-lg-6 col-sm-12 order-last order-md-first block-image block-content" src="{{$block->photo != null ? $block->photo : $block->photo_2}}" alt="photo">
                                <div class="col-lg-6 col-sm-12 order-first order-md-last block-content block-center align-self-center custom-content">
                                    {!!$block->content!!}
                                </div>
                            @elseif(($block->photo != null || $block->photo_2 != null) && $block->content == null)
                                <img class="col-lg-6 col-sm-12 offset-sm-0 offset-md-3 block-image block-content" src="{{$block->photo != null ? $block->photo : $block->photo_2}}" alt="photo">
                            @elseif(($block->photo == null && $block->photo_2 == null) && $block->content != null)
                                <div class="col-12 text-center block-content align-self-center custom-content">
                                    {!!$block->content!!}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @else
                <div class="bg-{{$background}}">
                    <div class="container block-padding">
                        <div class="col-12 row block-parent justify-content-space-between">
                            @if($block->photo != null && $block->photo_2 != null)
                                @if($block->content != null)
                                    <div class="col-12 block-content text-center align-self-center custom-content mb-4">
                                        {!!$block->content!!}
                                    </div>
                                @endif
                                <img class="col-lg-6 col-sm-12 block-image block-content block-image-padding-bottom" src="{{$block->photo}}" alt="photo">
                                <img class="col-lg-6 col-sm-12 block-image block-content" src="{{$block->photo_2}}" alt="photo">
                            @elseif(($block->photo != null || $block->photo_2 != null) && $block->content != null)
                                <div class="col-lg-6 col-sm-12 block-content block-center align-self-center custom-content">
                                    {!!$block->content!!}
                                </div>
                                <img class="col-lg-6 col-sm-12 block-image block-content" src="{{$block->photo != null ? $block->photo : $block->photo_2}}" alt="photo">
                            @elseif(($block->photo != null || $block->photo_2 != null) && $block->content == null)
                                <img class="col-lg-6 col-sm-12 offset-sm-0 offset-md-3 block-image block-content" src="{{$block->photo != null ? $block->photo : $block->photo_2}}" alt="photo">
                            @elseif(($block->photo == null && $block->photo_2 == null) && $block->content != null)
                                <div class="col-12 block-content text-center align-self-center custom-content">
                                    {!!$block->content!!}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endif
            @break
            @case("VIDEO")
                <div class="bg-{{$background}}">
                    <div class="container block-padding">
                        <div class="col-12 row justify-content-center video-content">
                            {!! $block->video !!}
                        </div>
                    </div>
                </div>
            @break
            @case("ICONS")
                <div class="bg-{{$background}}">
                    <div class="container block-padding">
                        <div class="col-12 row justify-content-center">
                            <div class="col-lg-3 text-center mb-4"><img class="icons-photo" src="{{$block->icon_1}}" alt="img"></div>
                            <div class="col-lg-3 text-center mb-4"><img class="icons-photo" src="{{$block->icon_2}}" alt="img"></div>
                            <div class="col-lg-3 text-center mb-4"><img class="icons-photo" src="{{$block->icon_3}}" alt="img"></div>
                            <div class="col-lg-3 text-center mb-4"><img class="icons-photo" src="{{$block->icon_4}}" alt="img"></div>
                            <div class="col-lg-3 text-center icon-description">
                                <strong>{{strtoupper($block->icon_1_text)}}</strong>
                            </div>
                            <div class="col-lg-3 text-center icon-description">
                                <strong class="icon-description">{{strtoupper($block->icon_2_text)}}</strong>
                            </div>
                            <div class="col-lg-3 text-center icon-description">
                                <strong>{{strtoupper($block->icon_3_text)}}</strong>
                            </div>
                            <div class="col-lg-3 text-center icon-description">
                                <strong>{{strtoupper($block->icon_4_text)}}</strong>
                            </div>
                        </div>
                    </div>
                </div>
            @break
        @endswitch
    @endfor
</div>

@endsection
@section('scripts')
<script>
    $(function() {
   $(".btn").click(function() {
      // remove classes from all
      $(".btn").removeClass("active");
      // add class to the one we clicked
      $(this).addClass("active");
   });

   $('.choicebtn').each(function () {
    var $this = $(this);

    $this.on("click", function () {
        $('#qty').val($(this).data('quantity'));
        $('#prc').val($(this).data('prc'));
        var oldPrice = $(this).data('quantity') * $(this).data('oldprice');
        var newPrice = $(this).data('quantity') * $(this).data('prc');
        $("#selectedprice #oldprice span").html(oldPrice);
        $("#selectedprice #newprice span").html(newPrice);
        //alert($(this).data('quantity'));
    });
});
});
    const cartform = document.getElementsByName('cartform');
    cartform[0].addEventListener('submit',function (evnt) {
        for (var i = 0; i < selects.length; i++) {
            let select = selects[i];
            select.addEventListener("input", function (event) {
                select.required ='required';
                select.checkValidity();
                if (select.validity.badInput) {
                    select.setCustomValidity("Molimo izaberite");
                } else {
                    select.setCustomValidity("");
                }
            });
        }
    });


</script>
@endsection
