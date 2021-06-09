<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <!-- Global site tag (gtag.js) - Google Ads: 971826201 -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=AW-971826201"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
   
    gtag('config', 'AW-971826201');
  </script>
   
  <!-- Facebook Pixel Code -->
  <script>
  !function(f,b,e,v,n,t,s)
  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
  n.queue=[];t=b.createElement(e);t.async=!0;
  t.src=v;s=b.getElementsByTagName(e)[0];
  s.parentNode.insertBefore(t,s)}(window, document,'script',
  'https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', '478716345565188');
  fbq('track', 'PageView');
  </script>
  <noscript><img height="1" width="1" style="display:none"
  src="https://www.facebook.com/tr?id=478716345565188&ev=PageView&noscript=1"
  /></noscript>
  <!-- End Facebook Pixel Code -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="@yield('description')">
    <meta name="keywords" content="@yield('keywords')">
    <meta property="og:image" content="@section('shareFacebookImage'){{ asset('image/cover/b-quik-og-image.jpg') }}@show"/>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{!!__('บี&minus;ควิก')!!} @yield('title')</title>
    @yield('extra')
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{asset('favicon.ico')}}">

    <!-- Styles -->
    <link href="{{ asset('front/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('bootstrap-select-1.13.9/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
    <link href="{{ asset('front/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('front/css/style2.css') }}" rel="stylesheet">
    <link href="{{ asset('front/css/svg.css') }}" rel="stylesheet">
    <link href="{{ asset('front/css/gijgo.min.css') }}" rel="stylesheet">
    <link href="{{ asset('front/css/jquery-ui.css') }}" rel="stylesheet">
    <link href="{{ asset('front/css/swiper.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/myfrontcss.css') }}" rel="stylesheet">
    <link href="{{ asset('front/js/jquery.Thailand.js-master/jquery.Thailand.js/dist/jquery.Thailand.min.css') }}" rel="stylesheet">
    <link href="{{ asset('suneditor/src/assets/css/suneditor.css') }}" rel="stylesheet">
    <link href="{{ asset('suneditor/src/assets/css/suneditor-contents.css') }}" rel="stylesheet">
    <style type="text/css">
        .navbar-dark .navbar-nav .active>.nav-link, .navbar-dark .navbar-nav .nav-link.active, .navbar-dark .navbar-nav .nav-link.show, .navbar-dark .navbar-nav .show>.nav-link {
            color: #ffcb05;
        }
    </style>
    @stack('styles')

    <!-- Script -->
    <script type="text/javascript" src="{{ asset('front/js/jquery-3.3.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('front/js/popper.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('front/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('bootstrap-select-1.13.9/dist/js/bootstrap-select.min.js') }}"></script>
    @stack('scripts0')
</head>
<body>
    @section('navbar')
        @include('layouts.navbars.frontnav')
    @show

      @yield('content')

    @include('modals.savecart')
    @section('social')
    <div class="row-fluid">
      <!-- AddToAny BEGIN -->
      <div class="a2a_kit a2a_kit_size_32 a2a_default_style social">
        <a class="a2a_button_twitter"></a>
        <a class="a2a_button_facebook"></a>
        <a class="a2a_button_line"></a>
        <a class="a2a_button_email"></a>
        <a class="a2a_dd" href="https://www.addtoany.com/share"></a>
      </div> 
      <!-- Load Facebook SDK for JavaScript -->
      <div id="fb-root"></div>
      <script>
        window.fbAsyncInit = function() {
          FB.init({
            xfbml            : true,
            version          : 'v4.0'
          });
        };

        (function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = 'https://connect.facebook.net/th_TH/sdk/xfbml.customerchat.js';
          fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
      </script>

      <!-- Your customer chat code -->
      <div class="fb-customerchat"
        attribution=setup_tool
        page_id="104809570904038"
        logged_in_greeting="บี-ควิก สวัสดีครับ สามารถสอบถามข้อมูลที่ลูกค้าต้องการได้เลยครับ"
        logged_out_greeting="บี-ควิก สวัสดีครับ สามารถสอบถามข้อมูลที่ลูกค้าต้องการได้เลยครับ">
      </div>         
    </div>
    
<div class="pos-f-t">
  <div class="container-fluid">
     <div class="collapse customCollapse collapseDiv">
    <div class="bg-dark p-4">
   <div class="site-map"><a href="index.html">{{ __('หน้าแรก') }} </a></div>
<div class="site-map"><a href="{{ route('product') }}">{{ __('สินค้า') }}</a> 
<div class="site-list"><a href="{{ route('product') }}">{{ __('ยาง') }}</a></div>
<div class="site-list"><a href="{{ route('product_oil') }}">{{ __('น้ำมันเครื่อง') }}</a></div>
<div class="site-list"><a href="{{ route('product_shock') }}">{{ __('โช้คอัพ') }}</a></div>
<div class="site-list"><a href="{{ route('product_brake') }}">{{ __('เบรก') }}</a></div>
<div class="site-list"><a href="{{ route('product_batt') }}">{{ __('แบตเตอรี่/แบตแมน') }}</a></div>
<div class="site-list"><a href="{{ route('air') }}">{{ __('ระบบปรับอากาศในรถ') }}</a></div>
<div class="site-list"><a href="{{ route('product_other') }}">{{ __('รายการสินค้าอื่นๆ') }}</a></div>
<div class="site-list"><a href="{{ route('compare') }}">{{ __('เปรียบเทียบสินค้า') }}</a></div>
</div>

<div class="site-map"><a href="{{ route('promotion') }}">{{ __('โปรโมชั่น') }}</a></div>
<div class="site-map site-clear"><a href="{{ route('branch') }}">{{ __('สาขาใกล้คุณ') }}</a></div> 
<div class="site-map"><a href="{{ route('cctv') }}">{{ __('เช็กรถผ่านกล้อง CCTV') }}</a></div> 
<div class="site-map"><a href="{{ route('history') }}">{{ __('ประวัติการเข้ารับบริการ') }}</a></div>

<div class="site-map site-clear"><a href="{{ route('tyre') }}">{{ __('สาระเรื่องรถ') }}</a> 
<div class="site-list"><a href="{{ route('tyre') }}">{{ __('ยาง') }}</a></div>
<div class="site-list"><a href="{{ route('oil') }}">{{ __('น้ำมันเครื่องและไส้กรอง') }}</a></div>
<div class="site-list"><a href="{{ route('batt') }}">{{ __('แบตเตอรี่') }}</a></div>
<div class="site-list"><a href="{{ route('brake') }}">{{ __('ระบบเบรก') }}</a></div>
<div class="site-list"><a href="{{ route('advice') }}">{{ __('โช้คอัพและระบบกันสะเทือน') }}</a></div>
<div class="site-list"><a href="{{ route('rain_c') }}">{{ __('ระบบปัดน้ำฝน') }}</a></div>
<div class="site-list"><a href="{{ route('engine') }}">{{ __('ระบบเครื่องยนต์และอื่นๆ') }}</a></div>
<div class="site-list"><a href="{{ route('video1') }}">{{ __('60 วิ รู้ครบจบเรื่องรถ') }}</a></div>
<div class="site-list"><a href="{{ route('video2') }}">{{ __('คลิปดีๆ จาก B-Quik') }}</a></div>
</div>
<div class="site-map"><a href="{{ route('about') }}">{{ __('เกี่ยวกับเรา') }}</a> 
<div class="site-list"><a href="{{ route('about') }}">{{ __('รู้จัก บี-ควิก') }}</a></div>
<div class="site-list"><a href="{{ route('about_credit') }}">{{ __('ลูกค้าระบบเครดิต') }}</a></div>
<div class="site-list"><a href="{{ route('news') }}">{{ __('ข่าวและกิจกรรม') }}</a></div>
<div class="site-list"><a href="{{ route('about_job') }}">{{ __('สมัครงาน') }}</a></div>
<div class="site-list"><a href="{{ route('contact') }}">{{ __('ติดต่อเรา') }}</a></div>
</div>

   
</div>
    </div>
  </div> 
<div class="line collapse collapseDiv"></div>

 
  <div class="container-fluid bg-dark clearfix">
 <div class="f-right">
  
 <button  data-target=".collapseDiv" class="btn btn-warning collapsed site-map-btn" style="height:44px!important;"><i class="up_down2"></i> Site Map </button>

</div>
 <div class="f-left">Copyright 2019 All right reserved B-Quik.com</div>
</div>


</div>
</div>
    @show
    <style type="text/css">
      .modal {
          overflow-y:auto;
      }
    </style>
    <!-- js -->
    <script async src="https://static.addtoany.com/menu/page.js"></script>

    <!-- <script type="text/javascript" src="{{ asset('front/js/jquery-3.3.1.min.js') }}"></script> -->
    <script type="text/javascript" src="{{ asset('front/js/jquery-ui.js') }}"></script>
    <!-- <script type="text/javascript" src="{{ asset('front/js/bootstrap.min.js') }}"></script> -->
    <script type="text/javascript" src="{{ asset('front/js/gijgo.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('front/js/jquery.fitvids.js') }}"></script>
    <script type="text/javascript" src="{{ asset('front/js/owl.carousel.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('front/js/jquery.countdown.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('front/js/jquery.magnific-popup.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('front/js/aos.js') }}"></script>
    <script type="text/javascript" src="{{ asset('front/js/swiper.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('front/js/main.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/myjs.js') }}"></script>
    <script type="text/javascript" src="{{ asset('front/js/jquery.Thailand.js-master/jquery.Thailand.js/dependencies/JQL.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('front/js/jquery.Thailand.js-master/jquery.Thailand.js/dependencies/typeahead.bundle.js') }}"></script>
    <script type="text/javascript" src="{{ asset('front/js/jquery.Thailand.js-master/jquery.Thailand.js/dist/jquery.Thailand.min.js') }}"></script>
    <script>
      $(".site-map-btn").click(function() {
        $("html, body").animate({ scrollTop: $(document).height() }, "slow");
        $(".collapseDiv" ).slideToggle( "slow" );
        $(".site-map-btn").toggleClass("collapsed ");
      });

    $(".btn-refresh").click(function(){
      $.ajax({
        type:'GET',
        url:"{{route('re_captcha')}}",
        success:function(data){

          $(".captcha img").replaceWith(data.captcha);
        }
      });
    });

  $('#choose_more').click(function() {
    $('#myModalcartroute').modal('hide');
  })
  $('#skip').click(function() {
    $('#guestmodal').modal('hide');
  })
  $('.login2').click(function() {
    $('#guestmodal').modal('hide');
    $('#guestmodal2').modal('hide');
    $('#myModal2').modal('show');
  })
  $('#login_form').submit(function(e) {
    e.preventDefault();
    var email = $('#login_email').val();
    $.ajax({
      url: "{{url('checkLogin')}}",
      type: "get",
      data: {'email': email},
      success: function(data){
        if (data.success) {
          $('#login_form').unbind('submit').submit();
        } else {
          $('#myModal2').modal('hide');
          $('#failModal').modal('show');
        }
      }
    });
  })
  </script>
  @section('datepicker')
  <script type="text/javascript">
    $('.datepicker').each(function() {
      $(this).datepicker({ 
        uiLibrary: 'bootstrap4',
        format: 'dd-mm-yyyy',
      })
    });
  </script>
  @show
  @stack('scripts')
<!-- PK -->
<script type="text/javascript" id="cookieinfo"
  src="//cookieinfoscript.com/js/cookieinfo.min.js"
  data-bg="black" 
  data-fg="white" 
  data-font-family="Kanit" 
  data-font-size="16px" 
  data-divlinkbg="#ffcb05"
  data-message="We use cookies to enhance your experience. By continuing to visit this site you agree to our use of cookies. For more details, please read our "
  data-linkmsg="Cookie Policy"
  data-moreinfo="{{route('cookie')}}"
  data-close-text="Accept">
</script>
</body>
</html>
