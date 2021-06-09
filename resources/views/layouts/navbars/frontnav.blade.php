<!--Header-part-->
<div class="f-top">
<div id="head-top" >
  <div class="container-fluid d-flex row no-gutters">
    <div class="col">
      <a href="{{ route('index') }}"><img src="{{url('/front/images/logo.png')}}" alt="logo" class="logo"></a>
      <a href="{{ route('cart') }}" class="top_cart">
        <button class="btn" style="margin-left: 15px">
          <img src="{{url('/front/images/barket-b.png')}}" style="height: 80%">
          <span class="badge badge-pill badge-danger" id="cart_count" style="top: -7px; left: -20px">{{ session('cart')!=null?count(session('cart')):0 }}</span>
        <span style="margin-left: -20px">{{__('ตะกร้าสินค้า')}}</span>
        </button>
      </a>
      <button class="btn top_cart" @if(Auth::guard('customer')->check()) onclick="location.href='{{ route('history_purchase') }}';" @else data-toggle="modal" data-target="#guestmodal2" @endif>
        <img src="{{url('/front/images/icon-history.png')}}" style="height: 80%">
        <span>{{__('ประวัติการซื้อสินค้า')}}</span>
      </button>
      @if(session()->has('unfinished_order'))
        @php($order_id = session()->get('unfinished_order'))
<!--         <a href="{{route('orderpaybank', $order_id)}}#send_line" class="top_cart">
          <button class="btn"><img src="{{url('/front/images/icon-upload.png')}}" style="height: 80%"><span class="pl-2">{{__('แนบหลักฐานการโอนเงิน')}}</span></button>
        </a> -->
      @endif
      </div>

        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        @if (session('success'))
          <!-- success madal -->
          <div class="modal fade" id="successModal">
            <div class="modal-dialog">
              <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header" style="border-bottom: none;">
                  <div class="text-center mt-5" style="width: 100%">
                    <h3><img src="{{url('/front/images/check.jpg')}}" alt="check"></h3>
                    <a href="#" class="close" data-dismiss="modal" style="position: absolute; top: 10px; right: 10px;"><img src="{{url('/front/images/i-delete.png')}}" alt="close"></a>
                  </div>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                  <div class="row"> 
                    <div class="col-md-10 offset-md-1 mb-4">
                      <div class="row">
                        <div class="col-12" style="text-align: center;">
                          <h4>{{ session('success') }}</h4>
                        </div>                 
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <script type="text/javascript">
            $(document).ready(function() {
              $('#successModal').modal('show');
            })
          </script>
        @endif
        @if ($errors->any())
          <!-- error madal -->
          <div class="modal fade" id="errorModal">
            <div class="modal-dialog">
              <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header" style="border-bottom: none;">
                  <div class="text-center mt-5" style="width: 100%">
                    <h3><img src="{{url('/front/images/ex_mark.png')}}" alt="ex"></h3>
                    <a href="#" class="close" data-dismiss="modal" style="position: absolute; top: 10px; right: 10px;"><img src="{{url('/front/images/i-delete.png')}}" alt="close"></a>
                  </div>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                  <div class="row"> 
                    <div class="col-md-10 offset-md-1 mb-4">
                      <div class="row">
                        @foreach($errors->all() as $error)
                          <div class="col-12" style="text-align: center;">
                            <h4>{{$error}}</h4>
                          </div>
                        @endforeach                    
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <script type="text/javascript">
            $(document).ready(function() {
              $('#errorModal').modal('show');
            })
          </script>
        @endif
        @if (session('customernull'))
          <script type="text/javascript">
              $(window).on('load',function()
              {
                $('#guestmodal2').modal('show');
              });
          </script>
        @endif
    <div class=" col-auto order-xl-2">
      <ul class="nav head-right-contact">
          <a title="สายด่วนโทร 1153" href="tel:1153"><img src="{{url('/front/images/hotline.png')}}" alt="hotline"></a>
          <li class="head-r-l"><a title="B-Quik Facebook" href="https://www.facebook.com/BQUIK" target="_blank"><img src="{{url('/front/images/facebook.png')}}" alt="facebook"></a></li>
          <li class="d-xl-none"><button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".navbarNavc" aria-controls="navbarNavc" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
          </button></li>
      </ul>
    </div>
    <div class="col-12 col-lg-auto order-xl-1 d-none d-lg-none d-xl-block ">
      <hr class="d-lg-none d-xl-none">
      <ul class="nav head-right justify-content-center">
        @if(Auth::guard('customer')->check())
        <li style="font-size: 12px">
          <table><tbody><tr>
          <td style="text-align: right; font-weight: bold; padding-top: 10px;">
          {{ __('ยินดีต้อนรับ') }}
          <p>{{__('คุณ')}} {{ Auth::guard('customer')->user()->fname }} {{ Auth::guard('customer')->user()->lname }}</p>
          </td>
          <td valign="top">
          <img src="{{url('/front/images/img-user.png')}}" alt="user" style="margin: 0 7px;">
          </td></tr>
          </tbody></table>
        </li>
        <li style="padding-top: 12px"><a title="logout" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><img src="{{url('/front/images/logout.png')}}" alt="logout"> <span class="text">{{ __('ออกจากระบบ') }}</span></a></li>

          <form id="logout-form" action="{{ route('customerLogout') }}" method="POST" style="display: none;">
               @csrf
          </form>
          @else
          <li><a title="" href="#" data-toggle="modal" data-target="#myModal2"><img src="{{url('/front/images/login.png')}}" alt="login"> <span class="text">{{ __('เข้าสู่ระบบ') }}</span></a></li>
             <li><a title="" href="{{route('registration')}}"><img src="{{url('/front/images/regis.png')}}" alt="register"> <span class="text">{{ __('ลงทะเบียน') }}</span></a></li>
        @endif
      </ul>
      <hr class="d-lg-none d-xl-none">
    </div>


      <div class="col-12  d-xl-none collapse navbarNavc">
        <hr>
        <ul class="nav head-right justify-content-center">
          <li>
            <a href="{{ url('cart') }}" class="top_cart">
              <button class="btn" style="margin-left: 15px">
                <img src="{{url('/front/images/barket-b.png')}}">
                <span class="badge badge-pill badge-danger" id="cart_count" style="top: -7px; left: -20px">{{ session('cart')!=null?count(session('cart')):0 }}</span>
              <span style="margin-left: -20px">{{__('ตะกร้าสินค้า')}}</span>
              </button>
            </a>
          </li>
          <li>
            <button class="btn" @if(Auth::guard('customer')->check()) onclick="location.href='{{ route('history_purchase') }}';" @else data-toggle="modal" data-target="#guestmodal2" @endif>
              <img src="{{url('/front/images/icon-history.png')}}" style="height: 80%">
              <span>{{__('ประวัติการซื้อสินค้า')}}</span>
            </button>
          </li>
          <li>
            @if(session()->has('unfinished_order'))
              @php($order_id = session()->get('unfinished_order'))
<!--               <a href="{{route('orderpaybank', $order_id)}}#send_line" class="top_cart">
                <button class="btn"><img src="{{url('/front/images/icon-upload.png')}}" style="height: 80%"><span class="pl-2">{{__('แนบหลักฐานการโอนเงิน')}}</span></button>
              </a> -->
            @endif
          </li>
        </ul>
        @if(Auth::guard('customer')->check())
      <table width="100%"><tbody><tr>
               <td valign="top" class="t-img">
      <img src="{{url('/front/images/img-user.png')}}" alt="user" style="margin-right:7px;">
        <td valign="top" class="t-img-name pt-2">
        {{__('ยินดีต้อนรับ')}}
        <p>{{ Auth::guard('customer')->user()->fname }} {{ Auth::guard('customer')->user()->lname }}</p>
      </td>
      <td valign="top" class="text-center t-logout">
        <a title="logout" href="{{ route('customerLogout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="color: black;"><img src="{{url('/front/images/logout.png')}}" alt="logout">
        <p><b>{{__('ออกจากระบบ')}}</b></p></a>
      </td>
      </td></tr>
    </tbody></table>
        @else
        <ul class="nav head-right justify-content-center">
          <li><a title="" href="#" data-toggle="modal" data-target="#myModal2"><img src="{{url('/front/images/login.png')}}" alt="login"> <span class="text">{{ __('เข้าสู่ระบบ') }}</span></a></li>
          <li><a title="" href="{{route('registration')}}"><img src="{{url('/front/images/regis.png')}}" alt="register"> <span class="text">{{ __('ลงทะเบียน') }}</span></a></li>
        </ul>
        @endif
      <hr>
    </div>

  </div>
</div>

<nav class="navbar navbar-expand-xl navbar-dark bg-dark bg-bquik">
  <div class="container-fluid p-0">

  <div class="collapse navbar-collapse navbarNavc" id="navbarNav2">
    <nav class="menu-r order-2">
        @php($i=0)
        @foreach (config('app.available_locales') as $locale)
          @if($i==0)
            <a href="{{ LaravelLocalization::getLocalizedURL('th') }}">
                <span @if (app()->getLocale() == $locale) class='link-active' @endif>{{ strtoupper($locale) }}</span></a>
          @php($i++)
            @else
            <span style="padding:0 5px;">|</span>

            <a href="{{ LaravelLocalization::getLocalizedURL('en') }}">
                <span style="margin-right: 10px" @if (app()->getLocale() == $locale) class='link-active' @endif>{{ strtoupper($locale) }}</span></a>
          
          @php($i++)
          @endif
        @endforeach
   </nav>
    <ul class="navbar-nav nav-fill w-100 order-1">
      <li class="nav-item {{ Request::route()->getName() == 'index' ? 'active' : '' }}">
        <a class="nav-link {{ Request::route()->getName() == 'index' ? 'link-active' : '' }}" href="{{ route('index') }}">{{ __('หน้าแรก') }}</a>
      </li>
      
      <li class="nav-item dropdown {{ Request::route()->getPrefix() == 'th/product' || Request::route()->getPrefix() == 'en/product' ? 'active' : '' }}" style="position: static;">
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
        {{ __('สินค้า') }}
      </a>
        <div class="dropdown-menu">
          <ul class="nav-justified">
              <li><a href="{{ route('product') }}"><i class="tab_menu ic_m1"></i>{{ __('ยาง') }}</a></li>
              <li><a href="{{ route('product_oil') }}"><i class="tab_menu ic_m2"></i>{{ __('น้ำมันเครื่อง') }}</a></li>
              <li><a href="{{ route('product_shock') }}"><i class="tab_menu ic_m3"></i>{{ __('โช้คอัพ') }}</a></li>
              <li><a href="{{ route('product_brake') }}"><i class="tab_menu ic_m4"></i>{{ __('เบรก') }}</a></li>
              <li><a href="{{ route('product_batt') }}"><i class="tab_menu ic_m5"></i>{{ __('แบตเตอรี่/แบตแมน') }}</a></li>
              <li><a href="{{ route('air') }}"><i class="tab_menu ic_m6"></i>{{ __('ระบบปรับอากาศในรถ') }}</a></li>
              <li><a href="{{ route('product_other') }}"><i class="tab_menu ic_m7"></i>{{ __('รายการสินค้าอื่นๆ') }}</a></li>
              <li><a href="{{ route('compare') }}"><i class="tab_menu ic_m8"></i>{{ __('เปรียบเทียบสินค้า') }}</a></li>
              <li><a href="{{ route('review') }}"><div class="review_tab"></div>{{ __('รีวิว') }}</a></li>
          </ul>
        </div>
      </li>

      <li class="nav-item {{ Request::route()->getName() == 'promotion' || Request::route()->getName() == 'promotion_detail' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('promotion') }}">{{ __('โปรโมชั่น') }}</a>
      </li>
      <li class="nav-item {{ Request::route()->getName() == 'branch' || Request::route()->getName() == 'branch_detail' || Request::route()->getName() == 'searchBranch' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('branch') }}">{{ __('สาขาใกล้คุณ') }}</a>
      </li>
      <li class="nav-item {{ Request::route()->getName() == 'cctv' || Request::route()->getName() == 'cctvlogin' ? 'active' : '' }}">
        <a class="nav-link  {{ Request::route()->getName() == 'cctv' || Request::route()->getName() == 'cctvlogin' ? 'link-active' : '' }}"  href="{{ route('cctv') }}">{{ __('เช็กรถผ่านกล้อง CCTV') }}</a>
      </li>
      <li class="nav-item {{ Request::route()->getName() == 'history' || Request::route()->getName() == 'history_detail' ? 'active' : '' }}">
        <a class="nav-link {{ Request::route()->getName() == 'history' || Request::route()->getName() == 'history_detail' ? 'link-active' : '' }}" href="{{ route('history') }}">{{ __('ประวัติการเข้ารับบริการ') }}</a>
      </li>
 
      <!-- Dropdown -->
      <li class="nav-item dropdown {{ Request::route()->getPrefix() == 'th/advice' ||  Request::route()->getPrefix() == 'en/advice' ? 'active' : '' }}" style="position: static;">
        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
          {{ __('สาระเรื่องรถ') }}
        </a>
        <div class="dropdown-menu">
          <ul class="nav nav-justified" style="text-align: left; display: block;">
            <li><a href="{{ route('tyre') }}"><i class="tab_menu2 ic_m2-3"></i>{{ __('ยาง') }}</a></li>
            <li><a href="{{ route('oil') }}"><i class="tab_menu2 ic_m2-6"></i>{{ __('น้ำมันเครื่องและไส้กรอง') }}</a></li>
            <li><a href="{{ route('batt') }}"><i class="tab_menu2 ic_m2-4"></i>{{ __('แบตเตอรี่') }}</a></li>
            <li><a href="{{ route('brake') }}"><i class="tab_menu2 ic_m2-2"></i>{{ __('ระบบเบรก') }}</a></li>
            <li><a href="{{ route('advice') }}"><i class="tab_menu2 ic_m2-1"></i>{{ __('โช้คอัพและระบบกันสะเทือน') }}</a></li>
            <li><a href="{{ route('rain_c') }}"><i class="tab_menu2 ic_m2-7"></i>{{ __('ระบบปัดน้ำฝน') }}</a></li>
            <li><a href="{{ route('engine') }}"><i class="tab_menu2 ic_m2-8"></i>{{ __('ระบบเครื่องยนต์และอื่นๆ') }}</a></li>
            <li><a href="{{ route('video1') }}"><i class="tab_menu2 ic_m2-5"></i>{{ __('60 วิ รู้ครบจบเรื่องรถ') }}</a></li>
            
          </ul>
        </div>
      </li>
      <!-- Dropdown -->
      <li class="nav-item dropdown {{ Request::route()->getName() == 'about' || Request::route()->getName() == 'about_credit' || Request::route()->getName() == 'about_job' || Request::route()->getName() == 'about_job_detail' || Request::route()->getName() == 'news' || Request::route()->getName() == 'news_detail' || Request::route()->getName() == 'contact' || Request::route()->getName() == 'form' || Request::route()->getName() == 'video2' ? 'active' : '' }}" style="position: static;">
        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
          {{ __('เกี่ยวกับเรา') }}
        </a>
        <div class="dropdown-menu">
          <ul class="nav-justified">
            <li><a href="{{ route('about') }}"><i class="tab_menu3 ic_m3-1"></i>{{ __('รู้จัก บี-ควิก') }}</a></li>
            <li><a href="{{ route('about_credit') }}"><i class="tab_menu3 ic_m3-2"></i>{{ __('ลูกค้าระบบเครดิต') }}</a></li>
            <li><a href="{{ route('news') }}"><i class="tab_menu3 ic_m3-3"></i>{{ __('ข่าวและกิจกรรม') }}</a></li>
            <li><a href="{{ route('video2') }}"><i class="tab_menu2 ic_m2-9"></i>{{ __('คลิปดีๆ จาก B-Quik') }}</a></li>
            <li><a href="{{ route('about_job') }}"><i class="tab_menu3 ic_m3-4"></i>{{ __('สมัครงาน') }}</a></li>
            <li><a href="{{ route('contact') }}"><i class="tab_menu3 ic_m3-5"></i>{{ __('ติดต่อเรา') }}</a></li>
          </ul>
        </div>
      </li>
    </ul>
  </div>
  </div>
</nav>

</div>
<!-- The Modal3 -->
<div class="modal fade" id="myModal3">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header" style="border-bottom: none;">
        <div class="text-center mt-5" style="width: 100%">
          <h3><img src="{{url('/front/images/forgot.jpg')}}" alt="register">
          <br><br>{{__('ลืมรหัสผ่าน')}}</h3>
          {{__('กรุณาระบุรหัสผ่านใหม่')}}<a href="#" class="close" data-dismiss="modal" style="position: absolute; top: 10px; right: 10px;"><img src="{{url('/front/images/i-delete.png')}}" alt="delete"></a>
        </div>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
        <form action="{{ route('reset_password') }}" method="post">
        @csrf
          <div class="row"> 
            <div class="col-xl-4 offset-xl-4 col-md-8 offset-md-2 my-2"><input type="password" class="form-control form-control-lg" placeholder="{{__('รหัสผ่านใหม่')}} *" name="password" required></div>    
            <div class="col-xl-4 offset-xl-4 col-md-8 offset-md-2 my-2"><input type="password" class="form-control form-control-lg" placeholder="{{__('ยืนยันรหัสผ่านใหม่')}} *" id="password-confirm" name="password_confirmation" required></div>
            <div class="col-xl-4 offset-xl-4 col-md-8 offset-md-2 my-2"><input type="text" class="form-control form-control-lg" placeholder="{{__('อีเมลที่ใช้ลงทะเบียน')}} *" name="email" required></div>
            <div class="col-xl-4 offset-xl-4 col-md-8 offset-md-2 input-group my-2"><input type="text" class="form-control form-control-lg" placeholder="{{__('ระบุอักขระที่เห็น')}} *" name="captcha" autocomplete="off"></div>
            <div class="col-xl-4 offset-xl-4 col-md-8 offset-md-2 input-group mb-4 captcha">{!! captcha_img() !!}
              <button type="button" class="btn btn-dark btn-half2 my-2 btn-refresh"> {{__('เปลี่ยนภาพ')}} </button>
            </div>
            <div class="col-xl-4 offset-xl-4 col-md-8 offset-md-2 input-group mb-4">
              <button type="button" class="btn btn-light btn-half" data-dismiss="modal"> {{__('ยกเลิก')}} </button>
              <button type="submit" class="btn btn-warning btn-half2"> {{__('ส่งอีเมล')}} </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- The Modalcartroute -->
<div class="modal fade" id="myModalcartroute">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header" style="border-bottom: none;">
        <div class="text-center mt-5" style="width: 100%">
          <a href="#" class="close" data-dismiss="modal" style="position: absolute; top: 10px; right: 10px;"><img src="{{url('/front/images/i-delete.png')}}" alt="close"></a>
          <img src="{{url('/front/images/barket-lightbox.jpg')}}" style="margin-bottom: 25px">
          <h4>{{__('เพิ่มสินค้าในตะกร้าคุณเรียบร้อยแล้ว')}}</h4>
        </div>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
          <div class="row">
            <div class="col-sm-10 offset-sm-1 input-group mb-4">
              <button type="button" class="btn btn-warning col-xl-4 col-sm-12 mb-2 buttons_3" id="choose_more" @if(Request::route()->getPrefix() != 'th/product' && Request::route()->getPrefix() != 'en/product') onclick="window.location.href='{{route('product')}}'" @endif><img src="{{url('front/images/add2.png')}}"> {{__('เลือกสินค้าเพิ่ม')}}</button>
              <button type="button" class="btn btn-warning col-xl-4 col-sm-12 mb-2 buttons_3" style="margin: auto" onclick="window.location.href='{{route('branch')}}'"><img src="{{url('front/images/location.png')}}"> {{__('เลือกสาขาติดตั้ง')}}</button>
              <button type="button" class="btn btn-warning col-xl-4 col-sm-12 mb-2 buttons_3"  onclick="window.location.href='{{route('cart')}}'"><img src="{{url('front/images/barket-b.png')}}"> {{__('ไปยังตะกร้าสินค้า')}}</button>
            </div>
          </div>
      </div>
    </div>
  </div>
</div>
<!--close-Header-part-->
