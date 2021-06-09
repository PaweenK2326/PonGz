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
        <a href="#">{{__('เกี่ยวกับเรา')}}</a>{{__('สมัครงาน')}}    
      </div>
      @if (session('success'))
        <div class="alert alert-success">
          {{ session('success') }}
        </div>
      @endif
      @if ($errors->any())
        <div class="alert alert-danger">
        <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
        </ul>
        </div>
      @endif
   </div>
<div class="col-xl-7 mb-3">
  <iframe width="560" height="315" src="https://www.youtube.com/embed/iitX-Fatm3k" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
</div>
<div class="col-xl-5"><h3><i class="resize_menu3_1"></i>{{__('สิทธิประโยชน์')}}</h3>
  <div class="span5 scrollbar" id="style-1">
    <div class="box-yellow-list">
    <div class="box-yellow">1</div>
    <div class="box-yellow-detail">{{__('โบนัสรายเดือน')}}</div>
    </div>
    <div class="box-yellow-list">
    <div class="box-yellow">2</div>
    <div class="box-yellow-detail">{{__('ประกันชีวิต และประกันสุขภาพกลุ่ม')}}</div>
    </div>
    <div class="box-yellow-list">
    <div class="box-yellow">3</div>
    <div class="box-yellow-detail">{{__('เมื่ออายุงานครบ 1 ปี มีประกันชีวิตและประกันสุขภาพกลุ่มสำหรับคู่สมรส และบุตร')}}</div>
    </div>
    <div class="box-yellow-list">
    <div class="box-yellow">4</div>
    <div class="box-yellow-detail">{{__('วันหยุดพักผ่อนประจำปี')}}</div>
    </div>
    <div class="box-yellow-list">
    <div class="box-yellow">5</div>
    <div class="box-yellow-detail">{{__('ประกันสังคม, กองทุนเงินทดแทน และกองทุนสำรองเลี้ยงชีพ')}}</div>
    </div>
    <div class="box-yellow-list">
    <div class="box-yellow">6</div>
    <div class="box-yellow-detail">{{__('เงินช่วยเหลือกรณีพนักงาน/คู่สมรสคลอดบุตร')}}</div>
    </div>
    <div class="box-yellow-list">
    <div class="box-yellow">7</div>
    <div class="box-yellow-detail">{{__('เงินช่วยเหลือกรณีบุคคลในครอบครัวเสียชีวิต')}}</div>
    </div>
    <div class="box-yellow-list">
    <div class="box-yellow">8</div>
    <div class="box-yellow-detail">{{__('รางวัลพนักงานดีเด่น')}}</div>
    </div>
    <div class="box-yellow-list">
    <div class="box-yellow">9</div>
    <div class="box-yellow-detail">{{__('งานท่องเที่ยวประจำปี')}}</div>
    </div>
    <div class="box-yellow-list">
    <div class="box-yellow">10</div>
    <div class="box-yellow-detail">{{__('อบรมเพื่อพัฒนาศักยภาพตลอดทั้งปี')}}</div>
    </div>
    <div class="box-yellow-list">
    <div class="box-yellow">11</div>
    <div class="box-yellow-detail">{{__('ปรับเงินเดือนประจำปี')}}</div>
    </div>
    <div class="box-yellow-list">
    <div class="box-yellow">12</div>
    <div class="box-yellow-detail">{{__('เครื่องแบบพนักงาน')}}</div>
    </div>
    <div class="box-yellow-list">
    <div class="box-yellow">13</div>
    <div class="box-yellow-detail">{{__('สามารถเลือกทำงานสาขาใกล้บ้านได้ และมีโอกาสย้ายกลับภูมิลำเนาเมื่อมีสาขาเปิดใหม่')}}</div>
    </div>
    <div class="box-yellow-list">
    <div class="box-yellow">14</div>
    <div class="box-yellow-detail">{{__('โอกาสก้าวหน้าในการทำงานที่มากกว่าศูนย์บริการรถยนต์ทั่วไป')}}</div>
    </div>
    <div class="box-yellow-list">
    <div class="box-yellow-detail"><strong>{{__('หมายเหตุ')}} : {{__('สวัสดิการทั้งหมดเป็นไปตามเงื่อนไขของบริษัทฯ')}}</strong></div>
    </div>

  </div>
</div>



  </div>

   <hr class="line-y" id="line">
</div>

<div class="container-fluid">
  <div class="row">
    <div class="col-xl-6">
      <span style="float: left;"><i class="ic ic_search"></i></span><span style="width: 85%; margin: 8px 0 0 3px; float: left;"><h3>{{__('ค้นหางานได้จากภูมิภาคและตำแหน่งงาน')}}</h3></span>
    </div>
    <div class="col-xl-6">
      <div class="row">
        <div class="col-md-6 col-xs-12">
          <form action="{{route('about_job_filter')}}" method="get">
            <select class="form-control form-control-lg mb-2 custom-select" name="province" onchange="this.form.submit()">
              <option value="allprovince">{{__('จังหวัดทั้งหมด')}}</option>
              @foreach($provinces as $province)
                @if(isset($selectProvince))
                  @if($province == $selectProvince)
                    <option value="{{ $province }}" selected>{{__($province)}}</option>
                  @else
                    <option value="{{ $province }}">{{__($province)}}</option>
                  @endif
                @else
                  <option value="{{ $province }}">{{__($province)}}</option>
                @endif
              @endforeach
            </select>
          </form>
        </div>

        <div class="col-md-6 col-xs-12">
          <select class="form-control form-control-lg custom-select" id="filter_job">            
            <option value="alljob" selected>{{__('ตำแหน่งงานทั้งหมด')}}</option>
            @php($j=0)
            @if( LaravelLocalization::getCurrentLocale() == 'th' )
              @foreach($icons as $icon)
                @if($total[$j] == 0)
                  @php($j++)
                @else
                  <option value="{{ $j }}">{{ $icon->position_th }}</option>
                @php($j++)
                @endif
              @endforeach
            @else
              @foreach($icons as $icon)
                @if($total[$j] == 0)
                  @php($j++)
                @else
                  <option value="{{ $j }}">{{ $icon->position_en }}</option>
                @php($j++)
                @endif
              @endforeach
            @endif
          </select>
        </div>
      </div>
    </div>
  </div>
  <hr class="hr-line" style="margin-top: 10px">
  @php($count=0)
  @foreach ($jobs as $job)
    @php($count += $job->quantity)
  @endforeach
  <span id="count_total" style="display: none;">{{ $count }}</span>
  <p>{{__('ผลการค้นหาตำแหน่งงานใน')}} @if(isset($selectProvince)) {{__($selectProvince)}}@else {{__('จังหวัดทั้งหมด')}}@endif, <span id="job_show">{{__('ตำแหน่งงานทั้งหมด')}}</span> {{__('พบ')}} <span class="f24" id="count_total_show"></span> {{__('อัตรา')}}</p>

  <div class="">
  @php($i=0)
  @php($first=0)
  @foreach($icons as $icon)
    @if($total[$i] == 0)
      @php($i++)
    @else
        <div class="job1 col-12 job_pos_toggle pb-2 pt-2 pl-0 pr-0 {{ $first == 0 ? 'first' : 'collapsed' }}" id="{{ $i }}" data-toggle="collapse" data-target="#collapseG{{$i}}" aria-expanded="false" aria-controls="collapseG{{$i}}">
          <span class="icon" style="float: left;"><img src="{{asset('image/icon/'.$icon->icon)}}" width="32" height="32" alt="job1">
          </span><div style="width: 73%; float: left;">@if( LaravelLocalization::getCurrentLocale() == 'th' ){{ $icon->position_th }}@else{{ $icon->position_en }}@endif <span class="f20" id="total_{{ $i }}">{{ $total[$i] }}</span> {{__('อัตรา')}}</div>
          <span style="width: 14%; float: right; text-align: right;"><i class="up_down"></i></span>
          <div style="clear: both;"></div>
        </div>

        <div class="job2 col-12 accordion-body b-job collapse {{ $first == 0 ? 'show ' : '' }}in" id="collapseG{{$i}}" aria-expanded="true" style="">
          <div class="row">
          @foreach($icon->jobs as $job)
            @if($job->status == 1)
            <div class="col-xl-3 col-md-6 col-xs-12 bor-right-job mb-3 mt-2">
              <form action="{{ route('about_job_detail', $job->id) }}" method="get">
              @csrf
              <img src="{{url('/front/images/logo.png')}}" alt="logo" width="91" height="32" />

                  <div class="clearfix mt-2">
                    @if( LaravelLocalization::getCurrentLocale() == 'th' )
                      {{ $job->branch->name_th }}
                    @else
                      {{ $job->branch->name_en }}
                    @endif
                    <div class="float-right"><span class="f24">{{ $job->quantity }}</span> {{__('อัตรา')}}</div>
                  </div>

              <button class="btn btn-warning btn50 mt-2">{{__('ดูรายละเอียด')}}</button>
              </form>
            </div>
            @endif
          @endforeach 
          </div>
        </div>
      @php($i++)
      @php($first++)
    @endif
  @endforeach

    </div>
  </div>
</div>
 @endsection
 @push('scripts')
<script>
  // Basic FitVids Test
  $(".col-xl-7").fitVids();
  // Custom selector and No-Double-Wrapping Prevention Test
  $(".col-xl-7").fitVids({ customSelector: "iframe[src^='https://www.youtube.com']"});

  $(document).ready(function() {
    var total = $('#count_total').text();
    $('#count_total_show').text(total);
    $('#job_show').text('{{__('ตำแหน่งงานทั้งหมด')}}');
  })

  $('.job1').click(function() {
    if ($(this).hasClass('collapsed')) {
      $('html, body').animate({
        scrollTop: $(this).offset().top
      }, 1000);
    }
  })

  $('#filter_job').change(function() {
    var val = $(this).val();
    var job = $('#filter_job option:selected').text();
    $('#job_show').text(job);
    var total = $('#count_total').text();
    if (val == 'alljob') {
      $('.job1').css('display','inline-block');
      $('#count_total_show').text(total);
      $('.job1').addClass('collapsed');
      $('.job2').removeClass('show');
      setTimeout(function(){
        $('.first').trigger('click');
      }, 500);
    } else {
      $('.job1').css('display','none');
      $('.job1').addClass('collapsed');
      $('.job2').removeClass('show');
      $('#' + val).css('display','inline-block');
      setTimeout(function(){
        $('#' + val).trigger('click');
      }, 500);

      var each_total = $('#total_' + val).text();
      if (each_total) {
        $('#count_total_show').text(each_total);
      } else {
        $('#count_total_show').text('0');
      }
      
      $('html, body').animate({
        scrollTop: $('#line').offset().top
      }, 1000);
    }
  })
</script>
@endpush