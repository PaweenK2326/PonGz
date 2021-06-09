@extends('layouts.front')  
@section('description','โปรโมชั่นยางรถยนต์ผ่อน 0% บาด บวม แตก เคลมฟรี 1 ปี โปรโมชั่นน้ำมันเครื่อง โปรโมชั่นแบตเตอร์รี่รถยนต์ และอื่นๆลดกระหน่ำทั้งปี ค่าแรงฟรี ที่บี-ควิกทุกสาขาทั่วประเทศ')
@section('keywords','บี-ควิก, บีควิก, B-Quik, bquik, bquick, b-quick, เต็มที่เพื่อรถ เต็มร้อยเพื่อคุณ, 1153, ศูนย์บริการรถยนต์, โปรโมชั่น, โปรโมชั่นราคายางรถยนต์, โปรโมชั่นยาง, โปรยาง, ชำระผ่านบัตรเครดิต, รายการส่งเสริมการขายประจำเดือน, รายการส่งเสริมการขาย, ผ่อนยาง 0%, ยางรถยนต์ราคาถูก')
@if( LaravelLocalization::getCurrentLocale() == 'th' )
@if($promotion->photo_th != null && $promotion->photo_th != '-')
@section('shareFacebookImage')
{{url('/image/promotion/'.$promotion->photo_th)}}
@endsection
@endif
@else
@if($promotion->photo_en != null && $promotion->photo_en != '-')
@section('shareFacebookImage')
{{url('/image/promotion/'.$promotion->photo_en)}}
@endsection
@endif
@endif
@section('title',__('โปรโมชั่น'))
@section('content')
<div id="content">
<div class="container-fluid">
  <div class="row">

  <div class="col-12"> <h1 class="title-top"><span style="float: left;"><img src="{{url('/front/images/promotion.jpg')}}"></span>
  	<span style="width: 73%; float: left; padding-top: 20px;">{{ __('โปรโมชั่น') }}</span></h1>
  	<div style="clear: both;"></div>
    <div id="breadcrumb">
        <a href="{{ route('index') }}" title="Go to Home" class="tip-bottom"> {{ __('หน้าแรก') }}</a><a href="{{ route('promotion') }}">{{ __('โปรโมชั่น') }}</a> @if( LaravelLocalization::getCurrentLocale() == 'th' ){{ $promotion->title_th }}@else{{ $promotion->title_en }}@endif
      </div>
   </div>
@if($promotion->layout == 0)
  <div class="col-xl-6">
    @if( LaravelLocalization::getCurrentLocale() == 'th' )
      @php($count = count($promotion->images_th))
    @else
      @php($count = count($promotion->images_en))
    @endif
    @if($count == 0)
      @if( LaravelLocalization::getCurrentLocale() == 'th' )
        <img src="{{url('/image/promotion/'.$promotion->photo_th)}}" class="responsive detail_image" style="margin-bottom: 10px" onerror="this.onerror=null; this.src='{{url('/image/imagenull.png')}}'">
      @else
        <img src="{{url('/image/promotion/'.$promotion->photo_en)}}" class="responsive detail_image" style="margin-bottom: 10px" onerror="this.onerror=null; this.src='{{url('/image/imagenull.png')}}'">
      @endif
    @else
      <div class="swiper-container">
        <div class="gallery-top responsive detail_image">
      <div class="swiper-wrapper">
      @if( LaravelLocalization::getCurrentLocale() == 'th' )
        <div class="swiper-slide cover" style="background-image: url('{{ url('/image/promotion/'.$promotion->photo_th) }}');"></div>
        @foreach($promotion->images_th as $image)
          <div class="swiper-slide cover" style="background-image: url('{{ url('/image/promotion/'.$promotion->slug_url_en.'/'.$image->image) }}');"></div>
        @endforeach
      @else
        <div class="swiper-slide cover" style="background-image: url('{{ url('/image/promotion/'.$promotion->photo_en) }}');"></div>
        @foreach($promotion->images_en as $image)
          <div class="swiper-slide cover" style="background-image: url('{{ url('/image/promotion/'.$promotion->slug_url_en.'/'.$image->image) }}');"></div>
        @endforeach
      @endif
      </div>
      <div class="swiper-button-next "></div>
      <div class="swiper-button-prev "></div>
    </div>
    </div>
    <div class="swiper-container gallery-thumbs">
      @if( LaravelLocalization::getCurrentLocale() == 'th' )
        <div class="swiper-wrapper">
          <div class="swiper-slide cover" style="background-image:url({{ url('/image/promotion/'.$promotion->photo_th) }})"></div>
          @foreach($promotion->images_th as $image)
              <div class="swiper-slide cover" style="background-image:url({{ url('/image/promotion/'.$promotion->slug_url_en.'/'.$image->image) }})"></div>
          @endforeach
        </div>
      @else
        <div class="swiper-wrapper">
          <div class="swiper-slide cover" style="background-image:url({{ url('/image/promotion/'.$promotion->photo_en) }})"></div>
          @foreach($promotion->images_en as $image)
              <div class="swiper-slide cover" style="background-image:url({{ url('/image/promotion/'.$promotion->slug_url_en.'/'.$image->image) }})"></div>
          @endforeach
        </div>
      @endif
    </div> <!-- .site-wrap -->
    @endif
  </div>
@elseif($promotion->layout == 1)
  <div class="col-xl-12">
    @if( LaravelLocalization::getCurrentLocale() == 'th' )
      <img data-u="image" src="{{ url('/image/promotion/'.$promotion->photo_th) }}" class="responsive" style="margin-bottom: 10px" onerror="this.onerror=null; this.src='{{url('/image/imagenull.png')}}'">
    @else
      <img data-u="image" src="{{ url('/image/promotion/'.$promotion->photo_en) }}" class="responsive" style="margin-bottom: 10px" onerror="this.onerror=null; this.src='{{url('/image/imagenull.png')}}'">
    @endif
  </div>
</div>
@endif
      @if($promotion->layout == 0)
      <div class="col-xl-6">
      @elseif($promotion->layout == 1)
      <div class="col-xl-12">
      @endif
          @if($promotion->new == 'Yes')
            <img src="{{url('/front/images/new.png')}}" class="mb-4" />
          @endif
        @if( LaravelLocalization::getCurrentLocale() == 'th' )
          <h4>{{ $promotion->title_th }}</h4>
          <p>{{ $promotion->short_detail_th }}</p>
          <div class="sun-editor-editable">
            {!! html_entity_decode(e($promotion->condition_th)) !!}
          </div>
        @else
          <h4>{{ $promotion->title_en }}</h4>
          <p>{{ $promotion->short_detail_en }}</p>
          <div class="sun-editor-editable">
            {!! html_entity_decode(e($promotion->condition_en)) !!}
          </div>
        @endif

<div><img src="{{url('/front/images/time.png')}}"> {{ __('ระยะเวลาโปรโมชั่น') }} <span style="font-size: 20px; font-weight: bold; line-height: 18px;">@if($promotion->end_date) @if($promotion->start_date) <span class="@if( LaravelLocalization::getCurrentLocale() == 'th' ) dateThai @else dateEng @endif">{{ $promotion->start_date }}</span> @else {{__('วันนี้')}} @endif - <span class="@if( LaravelLocalization::getCurrentLocale() == 'th' ) dateThai @else dateEng @endif">{{ $promotion->end_date }}</span></span>@else @if($promotion->start_date) {{__('ตั้งแต่')}} <span class="@if( LaravelLocalization::getCurrentLocale() == 'th' ) dateThai @else dateEng @endif">{{ $promotion->start_date }}</span> {{__('เป็นต้นไป')}} @else {{__('ตั้งแต่วันนี้เป็นต้นไป')}} @endif @endif</div>
    <div class="a2a_kit a2a_kit_size_32 a2a_default_style social" style="width: auto;">
      <a href="https://line.me/R/ti/p/@b-quik1153" target="_blank">
      <button class="btn btn-success" style="background: #00ac00"><img src="{{url('/front/images/line.png')}}" alt="line"> {{ __('สอบถามเพิ่มเติม') }}</button></a>
      <a class="a2a_button_facebook">
      <button class="btn btn-primary" style="background:#2b407f; border: none;"><img src="{{url('/front/images/share-facebook.png')}}" alt="facebook"> {{__('แชร์ไปเฟซบุ๊ก')}} </button></a>
    </div>
    </div>
  </div>
</div>

<div style="height: 30px;"></div>
</div>
@endsection