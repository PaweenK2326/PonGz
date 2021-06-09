@extends('layouts.front')  
@section('description','โปรโมชั่นยางรถยนต์ผ่อน 0% บาด บวม แตก เคลมฟรี 1 ปี โปรโมชั่นน้ำมันเครื่อง โปรโมชั่นแบตเตอร์รี่รถยนต์ และอื่นๆลดกระหน่ำทั้งปี ค่าแรงฟรี ที่บี-ควิกทุกสาขาทั่วประเทศ')
@section('keywords','บี-ควิก, บีควิก, B-Quik, bquik, bquick, b-quick, เต็มที่เพื่อรถ เต็มร้อยเพื่อคุณ, 1153, ศูนย์บริการรถยนต์, โปรโมชั่น, โปรโมชั่นราคายางรถยนต์, โปรโมชั่นยาง, โปรยาง, ชำระผ่านบัตรเครดิต, รายการส่งเสริมการขายประจำเดือน, รายการส่งเสริมการขาย, ผ่อนยาง 0%, ยางรถยนต์ราคาถูก')
@section('title',__('โปรโมชั่น'))
@push('styles')
  <style type="text/css">
    form{
      display: inline-block!important;
    }
  </style>
@endpush
@section('content')
<div id="content"> 
  <div class="container-fluid">
    <div class="row">
    <div class="col-12"> <h1 class="title-top"><span style="float: left;"><img src="{{url('/front/images/promotion.jpg')}}"></span>
      <span style="width: 73%; float: left; padding-top: 20px;">{{ __('โปรโมชั่น') }}</span></h1>
      <div style="clear: both;"></div>
      <div id="breadcrumb">
          <a href="{{ route('index') }}" title="Go to Home" class="tip-bottom"> {{ __('หน้าแรก') }}</a>{{ __('โปรโมชั่น') }}
        </div>
    </div>   

  <div class="container-fluid">
    <div class="row">
  @foreach($newpromotions as $newpromotion)
    <div class="col-lg-6 pt-3">
        @if( LaravelLocalization::getCurrentLocale() == 'th' )
          <a href="{{route('promotion_detail',['slug' => $newpromotion->slug_url_en])}}"><img data-u="image" src="{{ url('/image/promotion/'.$newpromotion->thumbnail_th) }}" class="responsive thumbnail_new_promotion" onerror="this.onerror=null; this.src='{{url('/image/imagenull.png')}}'"></a>
              @if ( $newpromotion->new == 'Yes' )
                <div class="icon-new2">
                  <img src="{{url('/front/images/new.png')}}" class="responsive">
                </div>
              @endif
          <div style="float: left; width: 90%;"><div class="txt-title">{{ $newpromotion->title_th }}</div>
          @if($newpromotion->short_detail_th == null)
            <p class="cut-text" style="height: 72px">{{ str_replace(['&nbsp;','&quot;'], '', strip_tags($newpromotion->condition_th)) }}</p>
          @else
            <p class="cut-text" style="height: 72px">{{ $newpromotion->short_detail_th }}</p>
          @endif
          </div>
        @else
          <a href="{{route('promotion_detail',['slug' => $newpromotion->slug_url_en])}}"><img data-u="image" src="{{ url('/image/promotion/'.$newpromotion->thumbnail_en) }}" class="responsive thumbnail_new_promotion" onerror="this.onerror=null; this.src='{{url('/image/imagenull.png')}}'"></a>
            @if ( $newpromotion->new == 'Yes' )
              <div class="icon-new2">
                <img src="{{url('/front/images/new.png')}}" class="responsive">
              </div>
            @endif          
          <div style="float: left; width: 90%;"><div class="txt-title">{{ $newpromotion->title_en }}</div>
          @if($newpromotion->short_detail_en == null)
            <p class="cut-text" style="height: 72px">{{ str_replace(['&nbsp;','&quot;'], '', strip_tags($newpromotion->condition_en)) }}</p>
          @else
            <p class="cut-text" style="height: 72px">{{ $newpromotion->short_detail_en }}</p>
          @endif
          </div>
        @endif
      <div style="clear: both;"></div>
        <div class="container-fluid" style="width: 100%!important;">
        <div class="row "><div class="col-xl-8 p-0"><img src="{{url('/front/images/time.png')}}"> {{ __('ระยะเวลาโปรโมชั่น') }} <span style="font-size: 20px; font-weight: bold; line-height: 18px;">@if($newpromotion->end_date) @if($newpromotion->start_date) <span class="@if( LaravelLocalization::getCurrentLocale() == 'th' ) dateThai @else dateEng @endif">{{ $newpromotion->start_date }}</span> @else {{__('วันนี้')}} @endif - <span class="@if( LaravelLocalization::getCurrentLocale() == 'th' ) dateThai @else dateEng @endif">{{ $newpromotion->end_date }}</span></span>@else @if($newpromotion->start_date) {{__('ตั้งแต่')}} <span class="@if( LaravelLocalization::getCurrentLocale() == 'th' ) dateThai @else dateEng @endif">{{ $newpromotion->start_date }}</span> {{__('เป็นต้นไป')}} @else {{__('ตั้งแต่วันนี้เป็นต้นไป')}} @endif @endif</div> 
        <div class="col-xl-4 p-0"><a href="{{route('promotion_detail',['slug' => $newpromotion->slug_url_en])}}"><button type="button" class="btn btn-warning mb-3 col-xl-9 col-md-3 col-6 btn-r-l">{{ __('ดูรายละเอียด') }}</button></a></div></div>

        </div>
  </div>
  @endforeach
    </div>
    <hr class="line-y2">
  </div>
  <div class="container-fluid">
    <div class="row">    
      <div class="col-12 mb-3"><h3>{{ __('โปรโมชั่นที่น่าสนใจอื่นๆ') }}</h3></div>

  @foreach($promotions as $promotion)
    <div class="col-lg-3 col-md-4 col-6"> 
      @if( LaravelLocalization::getCurrentLocale() == 'th' )
        <a href="{{route('promotion_detail',['slug' => $promotion->slug_url_en])}}"><img data-u="image" src="{{ url('/image/promotion/'.$promotion->thumbnail_th) }}" class="responsive thumbnail_promotion" onerror="this.onerror=null; this.src='{{url('/image/imagenull.png')}}'"></a>
        <div class="txt-title" style="height: 54px">{{ $promotion->title_th }}</div>
        @if($promotion->short_detail_th == null)
          <p class="cut-text" style="height: 72px">{{ str_replace(['&nbsp;','&quot;'], '', strip_tags($promotion->condition_th)) }}</p>      
        @else
          <p class="cut-text" style="height: 72px">{{ $promotion->short_detail_th }}</p>
        @endif
      @else
        <a href="{{route('promotion_detail',['slug' => $promotion->slug_url_en])}}"><img data-u="image" src="{{ url('/image/promotion/'.$promotion->thumbnail_en) }}" class="responsive thumbnail_promotion" onerror="this.onerror=null; this.src='{{url('/image/imagenull.png')}}'"></a>
        <div class="txt-title" style="height: 54px">{{ $promotion->title_en }}</div>
      <p class="cut-text" style="height: 72px">{{ $promotion->short_detail_en }}</p>
      @endif
        <div class="hide-m"><img src="{{url('/front/images/time.png')}}"><div class="txt-time-p"> {{ __('ระยะเวลาโปรโมชั่น') }}<br> <span class="txt-time-p-d" style="height: 36px">@if($promotion->end_date) @if($promotion->start_date) <span class="@if( LaravelLocalization::getCurrentLocale() == 'th' ) dateThai @else dateEng @endif">{{ $promotion->start_date }}</span> @else {{__('วันนี้')}} @endif - <span class="@if( LaravelLocalization::getCurrentLocale() == 'th' ) dateThai @else dateEng @endif">{{ $promotion->end_date }}</span></span>@else @if($promotion->start_date) {{__('ตั้งแต่')}} <span class="@if( LaravelLocalization::getCurrentLocale() == 'th' ) dateThai @else dateEng @endif">{{ $promotion->start_date }}</span> {{__('เป็นต้นไป')}} @else {{__('ตั้งแต่วันนี้เป็นต้นไป')}} @endif @endif</div></div>
        <div><a href="{{route('promotion_detail',['slug' => $promotion->slug_url_en])}}"><button type="button" class="btn btn-warning mb-3 mt-3 col-md-6">{{ __('ดูรายละเอียด') }}</button></a></div>
        <div style="clear: both;"></div>
    </div>
  @endforeach
  </div>
  {{ $promotions->links() }}
    <hr style="margin-top: 10px">
    <div style="height: 30px;"></div>
</div>
</div>
</div>
@endsection