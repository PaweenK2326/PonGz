@extends('layouts.front')
@section('description','ร่วมงานกับบี-ควิก รายได้ดี มีความมั่นคง สวัสดิการครบ อาทิเช่น ประกันกลุ่ม กองทุนสำรองเลี้ยงชีพ เป็นต้น มีโอกาสเติบโตในหน้าที่การงานและปรับฐานเงินเดือนทุกปี') 
@section('keywords','บี-ควิก, บีควิก, B-Quik, bquik, bquick, b-quick, เต็มที่เพื่อรถ เต็มร้อยเพื่อคุณ, 1153, ศูนย์บริการรถยนต์, สมัครงานออนไลน์, สมัครงาน, สมัครงานบีควิก, สมัครงานบีควิกออนไลน์, ช่างยนต์, เจ้าหน้าที่บริการลูกค้า, งานดี, ช่างซ่อมรถยนต์, สมัครงานช่างซ่อมรถยนต์, สมัครงานช่างยนต์, รับสมัครงานช่างซ่อมรถยนต์, รับสมัครงานช่างยนต์, ตำแหน่งงานว่างบีควิก') 
@section('title',__('สมัครงาน')) 
@section('content')
<div id="content">
<div class="container-fluid">
  <div class="row">

  <div class="col-12"> <h1 class="title-top"><i class="tab_menu3_4"></i>{{__('สมัครงาน')}}</h1>
     <div id="breadcrumb">
        <a href="{{ route('index') }}" title="Go to Home" class="tip-bottom"> {{__('หน้าแรก')}}</a>
        <a href="{{ route('about_job') }}">{{__('เกี่ยวกับเรา')}}</a>{{__('สมัครงาน')}}
      </div>
   </div>
 
<div class="col-xl-3">
<div style="margin-bottom: 20px"><img src="{{url('/front/images/logo.png')}}" alt="logo" ></div>
  @if( LaravelLocalization::getCurrentLocale() == 'th' )
    <h3>{{ $job->branch->name_th }}</h3>
  @else
    <h3>{{ $job->branch->name_en }}</h3>
  @endif
<p>{{__('อัพเดตข้อมูล')}} <span class="@if( LaravelLocalization::getCurrentLocale() == 'th' ) dateThai @else dateEng @endif" style="font-size: 24px">{{ $job->updated_at }}</span></p>
<div class="text-center">

  <img src="{{url('/image/icon/'.$job->icon->icon)}}" alt="icon" height="120px" width="120px">
  @if( LaravelLocalization::getCurrentLocale() == 'th' )
    <h3 class="mt-3">{{ $job->icon->position_th }}<br>{{__('จำนวน')}} <span style="font-size: 42px;">{{ $job->quantity }}</span> {{__('อัตรา')}}</h3>
  @else
    <h3 class="mt-3">{{ $job->icon->position_en }}<br>{{__('จำนวน')}} <span style="font-size: 42px;">{{ $job->quantity }}</span> {{__('อัตรา')}}</h3>
  @endif

</div></div>
        <div id="custom_box_1" class="col-xl-9 bor-left"><h3 class="mb-4"><i class="resize_menu3_1"></i>{{__('คุณสมบัติและรายละเอียด')}}</h3>
<!--     @if( LaravelLocalization::getCurrentLocale() == 'th' )
      @php
        $require = explode("<br />
<br />", nl2br(e($job->icon->require_th)));
        $count = count($require)
      @endphp
    @else
      @php
        $require = explode("<br />
<br />", nl2br(e($job->icon->require_en)));
        $count = count($require)
      @endphp
    @endif
      @for($i=0;$i<$count;$i++)
      <div class="box-yellow-list"> 
        <div class="box-yellow">{{ $i+1 }}</div>
        <div class="box-yellow-detail">{!! html_entity_decode(e($require[$i])) !!}</div>
      </div>
      @endfor -->
    @if( LaravelLocalization::getCurrentLocale() == 'th' )
      <div class="sun-editor-editable">
        {!! html_entity_decode(e($job->icon->require_th)) !!}
      </div>
    @else
      <div class="sun-editor-editable">
        {!! html_entity_decode(e($job->icon->require_en)) !!}
      </div>
    @endif

      <form action="{{ route('form', $job->id)}}" method="get">
        @csrf
<div class="col-md-6 p-0 tablet-r-f2 mt-5">
<button type="button" class="btn btn-warning col-md-3 btn-home ml-0" onclick="window.open('https://maps.google.com?daddr={{ $job->branch->latitude }},{{ $job->branch->longitude }}');">{{__('ดูแผนที่สาขา')}}</button> @if($job->icon->pdf_th != '-') <a href="{{url('/pdf/job/'.$job->icon->pdf_th)}}" target="_blank"><button type="button" class="btn btn-warning col-md-4 btn-home2" style="height: 48px;">{{__('เอกสารเพิ่มเติม')}} </button></a> @endif <button type="submit" class="btn btn-warning col-md-3 btn-home">{{__('สมัครเลย')}} </button></div>
</form>

        </div>
  </div>
</div>

<div style="height: 30px;"></div>
</div>
 @endsection