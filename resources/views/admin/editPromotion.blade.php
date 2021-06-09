@extends('layouts.app')
@push('styles')
    <style type="text/css">
    .select2-container {
        width: 50%;
    }
    </style>
@endpush
@section('content')
<div id="content">
    <div id="content-header">
        <div id="breadcrumb">
            <a href="{{ route('admin.home') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Promotion</a> 
            </div>
            <h1>Promotion Management</h1>    
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
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span10 offset1">
                <div class="widget-box">
                    <div class="widget-content nopadding">
                    <form action="{{ route('promotion.update', $promotion->id) }}" method="post" class="form-horizontal" style="display: inline!important;" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="control-group normal_text"><h3 style="text-align: center;">Edit Promotion</h3></div>
                    <!-- type -->
                    <div class="control-group" style="display: none;">
                        <label for="type" class="control-label">Type : </label>
                        <div class="controls">
                            <select class="type" id="type" name="type">
                                <option value="ยาง">ยาง</option>
                                <option value="ระบบปรับอากาศในรถ">ระบบปรับอากาศในรถ</option>
                                <option value="แบตเตอรี่">แบตเตอรี่</option>
                                <option value="เบรก">เบรก</option>
                                <option value="โช้คอัพ">โช้คอัพ</option>
                                <option value="น้ำมันเครื่องและไส้กรอง">น้ำมันเครื่องและไส้กรอง</option>
                                <option value="การรับประกันสินค้า">การรับประกันสินค้า</option>
                                <option value="อื่นๆ">อื่นๆ</option>
                            </select>
                        </div>
                    </div>                        
                    <!-- new -->
                    <div class="control-group">
                        <label for="new" class="control-label">Highlight : <br>(เลือกโปรโมชั่นไฮไลท์ได้สูงสุด 2 โปรโมชั่น คุณต้องการให้โปรโมชั่นนี้เป็น Highlight หรือไม่) </label>
                        <div class="controls">
                            <label>
                            <input type="radio" name="new" value="Yes" {{$promotion->new=="Yes" ? 'checked' : ''}}>
                            Yes</label>
                            <label>
                            <input type="radio" name="new" value="No" {{$promotion->new=="No" ? 'checked' : ''}}>
                            No</label>
                        </div>
                    </div>
                    <!-- layout -->
                    <div class="control-group">
                        <label for="layout" class="control-label">Layout : </label>
                        <div class="controls">
                            <label style="display: inline-block"><input type="radio" name="layout" id="1" value="0" {{ $promotion->layout == 0 ? 'checked' : '' }}>
                                1<img src="{{ asset('image/layout1.png') }}" class="layout_image" style="max-height: 70px;"></label>
                            <label style="display: inline-block"><input type="radio" name="layout" id="2" value="1" {{ $promotion->layout == 1 ? 'checked' : '' }}>
                                2<img src="{{ asset('image/layout2.png') }}" class="layout_image" style="max-height: 100px;"></label>
                        </div>
                    </div>
                    @if($promotion->start_date != '')
                        @php($start_date = date('d-m-Y', strtotime($promotion->start_date)))
                    @else
                        @php($start_date = '')
                    @endif
                    <!-- start date -->
                    <div class="control-group {{ $errors->has('start_date') ? ' has-error' : '' }}">
                        <label for="start_date" class="control-label">Start Date : </label>
                        <div class="controls">
                            <input type="text" placeholder="Start Date" id="start_date" name="start_date" value="@if( $start_date != '') {{ $start_date }} @endif " class="span6 datepicker" data-date-format="dd-mm-yyyy" autocomplete="off"><button type="button" class="btn btn-danger btn-mini" id="start_date_button" style="margin-left: 3px">X</button>
                        </div>
                    </div>
                    @if($promotion->end_date != '')
                        @php($end_date = date('d-m-Y', strtotime($promotion->end_date)))
                    @else
                        @php($end_date = '')
                    @endif
                    <!-- End date -->
                    <div class="control-group {{ $errors->has('end_date') ? ' has-error' : '' }}">
                        <label for="end_date" class="control-label">End Date : </label>
                        <div class="controls">
                            <input type="text" placeholder="End Date" id="end_date" name="end_date" value="@if( $end_date != '') {{ $end_date }} @endif" class="span6 datepicker" data-date-format="dd-mm-yyyy" autocomplete="off"><button type="button" class="btn btn-danger btn-mini" id="end_date_button" style="margin-left: 3px">X</button>
                        </div>
                    </div>
                    <!-- tab -->
                    <div class="widget-title">
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#tab1">Thai</a></li>
                            <li><a data-toggle="tab" href="#tab2">English</a></li>
                        </ul>
                    </div>
                    <div class="widget-content tab-content">
                        <!-- tab thai -->
                        <div id="tab1" class="tab-pane active">
                            <!-- title th -->
                            <div class="control-group">
                                <label for="title_th" class="control-label">Title (TH) : </label>
                                <div class="controls">
                                    <input type="text" placeholder="Title (TH)" id="title_th" name="title_th" value="{{ $promotion->title_th }}" class="span9" required>
                                </div>
                            </div>                              
                            <!-- slug url th -->
                            <div class="control-group">
                                <label for="slug_url_th" class="control-label">Slug url (TH) : </label>
                                <div class="controls">
                                    <input type="text" placeholder="Slug url (TH)" id="slug_url_th" name="slug_url_th" value="{{ $promotion->slug_url_th }}" class="span9" readonly>
                                </div>
                            </div> 
                            <!-- short detail th -->
                            <div class="control-group">
                            <label for="short_detail_th" class="control-label">Short Detail (TH) : </label>
                                <div class="controls">
                                    <textarea name="short_detail_th" placeholder="รายละเอียดโดยย่อ (TH)" class="span11" rows="5">{{ $promotion->short_detail_th }}</textarea>
                                </div>
                            </div> 
                            <!-- thumbnail th -->
                            <div class="control-group">
                                <label for="thumbnail_th" class="control-label">Thumbnail (TH) : </label>
                                <div class="controls">
                                    <input type="file" id="thumbnail_th" name="thumbnail_th"> 637 * 534 px
                                </div>
                            </div>
                            <!-- preview -->
                            <div class="control-group">
                                <label for="preview" class="control-label"></label>
                                <div class="controls">
                                    @if($promotion->thumbnail_th != '' && $promotion->thumbnail_th != '-')
                                    <img id="image_preview_container1" src="{{ asset('image/promotion/'.$promotion->thumbnail_th) }}" alt="preview image" style="max-height: 75px; float: left; margin: 0px 3px 5px 5px;"><button class="btn btn-mini btn-danger delete-btn3" type="button" style="float: left;" data-id="{{ $promotion->id }}" data-type="thumbnail_th">Delete</button>
                                    @endif
                                </div>
                            </div>
                            <!-- photo th -->
                            <div class="control-group">
                                <label for="photo_th" class="control-label">Photo (TH) : </label>
                                <div class="controls">
                                    <input type="file" id="photo_th" name="photo_th">
                                    <div class="descript_photo">Layout 1 : 637 * 534 px <br> Layout 2 : 1320 * ... px</div> 
                                </div>
                            </div>
                            <!-- preview -->
                            <div class="control-group">
                                <label for="preview" class="control-label"></label>
                                <div class="controls">
                                    @if($promotion->photo_th != '' && $promotion->photo_th != '-')
                                    <img id="image_preview_container2" src="{{ asset('image/promotion/'.$promotion->photo_th) }}" alt="preview image" style="max-height: 100px; float: left; margin: 0px 3px 5px 5px;"><button class="btn btn-mini btn-danger delete-btn3" type="button" style="float: left;" data-id="{{ $promotion->id }}" data-type="photo_th">Delete</button>
                                    @endif
                                </div>
                            </div>
                            <!-- image -->
                            <div class="control-group">
                                <label class="control-label">Addition Photo : </label>
                                <div class="controls">
                                    @php($i=0)
                                    @foreach($promotion->images_th as $image)
                                    <div>
                                        <img src="{{ asset('image/promotion/'.$promotion->slug_url_en.'/'.$image->image) }}" style="max-height: 100px; float: left; margin: 0px 3px 5px 5px; @if($i%3==0) clear: left; @endif"><button class="btn btn-mini btn-danger delete-btn" type="button" style="float: left;" data-id="{{ $image->id }}"  data-token="{{ csrf_token() }}">Delete</button>
                                    </div>
                                    @php($i++)
                                    @endforeach
                                </div>
                            </div>
                            <!-- more photo -->
                            <div class="clone hide">
                                <div class="control-group more_th">
                                <label for="image_th" class="control-label"></label>
                                    <div class="controls">
                                        <input type="file" name="image_th[]" class="image_add" multiple><button class="btn btn-mini btn-danger image-delete" type="button">X</button>
                                    </div>
                                </div>
                            </div>
                            <div id="image_th"></div>
                            <!-- add button -->
                            <div class="control-group">
                                <div class="controls">
                                    <button class="btn btn-success image-add" type="button">Add more photo</button> * จะแสดงผลต่อเมื่อเลือกใช้ Layout รูปแบบที่ 1 เท่านั้น
                                </div>
                            </div>
                            <!-- pdf th -->
                            <div class="control-group" style="display: none;">
                                <label for="pdf_th" class="control-label">PDF (EN): </label>
                                <div class="controls">
                                    <input type="file" id="pdf_th" name="pdf_th">
                                </div>
                            </div> 
                            <!-- condition th -->
                            <div class="control-group">
                            <label for="condition_th" class="control-label">Condition (TH) : </label>
                                <div class="controls">
                                    <input type="hidden" value="{{$promotion->condition_th}}" id="condition_th_value">
                                  <textarea placeholder="Condition (TH)" id="condition_th" name="condition_th" rows="15" class="span11">{{ $promotion->condition_th }}</textarea>
                                </div>
                            </div>
                        </div>

                        <!-- tab english -->
                        <div id="tab2" class="tab-pane">
                            <!-- title en -->
                            <div class="control-group">
                                <label for="title_en" class="control-label">Title (EN) : </label>
                                <div class="controls">
                                    <input type="text" placeholder="Title (EN)" id="title_en" name="title_en" value="{{ $promotion->title_en }}" class="span9" required>
                                </div>
                            </div>                              
                            <!-- slug url en -->
                            <div class="control-group">
                                <label for="slug_url_en" class="control-label">Slug url (EN) : </label>
                                <div class="controls">
                                    <input type="text" placeholder="Slug url (EN)" id="slug_url_en" name="slug_url_en" value="{{ $promotion->slug_url_en }}" class="span9" readonly>
                                </div>
                            </div> 
                            <!-- short detail en -->
                            <div class="control-group">
                            <label for="short_detail_en" class="control-label">Short Detail (EN) : </label>
                                <div class="controls">
                                    <textarea name="short_detail_en" placeholder="รายละเอียดโดยย่อ (EN)" class="span11" rows="5">{{ $promotion->short_detail_en }}</textarea>
                                </div>
                            </div>
                            <!-- thumbnail en -->
                            <div class="control-group">
                                <label for="thumbnail_en" class="control-label">Thumbnail (EN) : </label>
                                <div class="controls">
                                    <input type="file" id="thumbnail_en" name="thumbnail_en"> 637 * 534 px
                                </div>
                            </div>
                            <!-- preview -->
                            <div class="control-group">
                                <label for="preview" class="control-label"></label>
                                <div class="controls">
                                    @if($promotion->thumbnail_en != '' && $promotion->thumbnail_en != '-')
                                    <img id="image_preview_container3" src="{{ asset('image/promotion/'.$promotion->thumbnail_en) }}" alt="preview image" style="max-height: 75px; float: left; margin: 0px 3px 5px 5px;"><button class="btn btn-mini btn-danger delete-btn3" type="button" style="float: left;" data-id="{{ $promotion->id }}" data-type="thumbnail_en">Delete</button>
                                    @endif
                                </div>
                            </div>
                            <!-- photo en -->
                            <div class="control-group">
                                <label for="photo_en" class="control-label">Photo (EN) : </label>
                                <div class="controls">
                                    <input type="file" id="photo_en" name="photo_en">
                                    <div class="descript_photo">Layout 1 : 637 * 534 px <br> Layout 2 : 1320 * ... px</div> 
                                </div>
                            </div>
                            <!-- preview -->
                            <div class="control-group">
                                <label for="preview" class="control-label"></label>
                                <div class="controls">
                                    @if($promotion->photo_en != '' && $promotion->photo_en != '-')
                                    <img id="image_preview_container4" src="{{ asset('image/promotion/'.$promotion->photo_en) }}" alt="preview image" style="max-height: 100px; float: left; margin: 0px 3px 5px 5px;"><button class="btn btn-mini btn-danger delete-btn3" type="button" style="float: left;" data-id="{{ $promotion->id }}" data-type="photo_en">Delete</button>
                                    @endif
                                </div>
                            </div>
                            <!-- image -->
                            <div class="control-group">
                                <label for="photo_th" class="control-label">Addition Photo : </label>
                                <div class="controls">
                                    @php($i=0)
                                    @foreach($promotion->images_en as $image)
                                    <div>
                                        <img src="{{ asset('image/promotion/'.$promotion->slug_url_en.'/'.$image->image) }}" style="max-height: 100px; float: left; margin: 0px 3px 5px 5px; @if($i%3==0) clear: left; @endif"><button class="btn btn-mini btn-danger delete-btn2" type="button" style="float: left;" data-id="{{ $image->id }}"  data-token="{{ csrf_token() }}">Delete</button>
                                    </div>
                                    @php($i++)
                                    @endforeach
                                </div>
                            </div>
                            <!-- more pictures -->
                            <div class="clone2 hide">
                                <div class="control-group more_en">
                                <label for="image_en" class="control-label"></label>
                                    <div class="controls">
                                        <input type="file" name="image_en[]" class="image_add" multiple><button class="btn btn-mini btn-danger image-delete" type="button">X</button>
                                    </div>
                                </div>
                            </div>
                            <div id="image_en"></div>
                            <!-- add button -->
                            <div class="control-group">
                                <div class="controls">
                                    <button class="btn btn-success image-add2" type="button">Add more photo</button> * Only appear if layout 1 is selected
                                </div>
                            </div>
                            <!-- pdf en -->
                            <div class="control-group" style="display: none;">
                                <label for="pdf_en" class="control-label">PDF (EN): </label>
                                <div class="controls">
                                    <input type="file" id="pdf_en" name="pdf_en">
                                </div>
                            </div>
                            <!-- condition en -->
                            <div class="control-group">
                            <label for="condition_en" class="control-label">Condition (EN) : </label>
                                <div class="controls">
                                    <input type="hidden" value="{{$promotion->condition_en}}" id="condition_en_value">
                                  <textarea placeholder="Condition (EN)" id="condition_en" name="condition_en" rows="15" class="span11">{{ $promotion->condition_en }}</textarea>
                                </div>
                            </div>  
                        </div>
                    </div>
        
                    <!-- buttons -->
                    <div class="form-actions form_action">
                        <input type="submit" id="submit" class="btn btn-success action_button" value="Submit">
                        <input type="button" class="btn btn-inverse action_button" value="Back" onclick="history.back()">
                    </div>

                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
    <script>
    $(document).ready(function (e) {
 
        $('#thumbnail_th').change(function(){
          
            let reader = new FileReader();
            reader.onload = (e) => { 
              $('#image_preview_container1').attr('src', e.target.result); 
            }
            reader.readAsDataURL(this.files[0]); 
        });
 
    });    
    $(document).ready(function (e) {
 
        $('#photo_th').change(function(){
          
            let reader = new FileReader();
            reader.onload = (e) => { 
              $('#image_preview_container2').attr('src', e.target.result); 
            }
            reader.readAsDataURL(this.files[0]); 
        });
 
    });    
    $(document).ready(function (e) {
 
        $('#thumbnail_en').change(function(){
          
            let reader = new FileReader();
            reader.onload = (e) => { 
              $('#image_preview_container3').attr('src', e.target.result); 
            }
            reader.readAsDataURL(this.files[0]); 
        });
 
    });    
    $(document).ready(function (e) {
 
        $('#photo_en').change(function(){
          
            let reader = new FileReader();
            reader.onload = (e) => { 
              $('#image_preview_container4').attr('src', e.target.result); 
            }
            reader.readAsDataURL(this.files[0]); 
        });
 
    });

    $(document).ready(function() {

        $(".image-add").click(function(){ 
            var html = $(".clone").html();
            var num = $('.more_th').length;
            if (num == 1) {
                $("#image_th").after(html);
            } else {
                $(".more_th").last().after(html);
            }
        });
        $(".image-add2").click(function(){ 
            var html = $(".clone2").html();
            var num = $('.more_en').length;
            if (num == 1) {
                $("#image_en").after(html);
            } else {
                $(".more_en").last().after(html);
            }
        });
        $("body").on("click",".image-delete",function(){ 
            $(this).parents(".control-group").remove();
        });

        $('.delete-btn').click(function (e) {
             e.preventDefault();
            if (confirm('Are you sure you want to delete this image?')) {
                var id = $(this).data("id");
                var token = $(this).data('token');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{url('/admin/image_delete')}}/"+id,
                    type: "DELETE",
                    dataType: "JSON",
                    data: { 'id': id },
                    success: function(data){
                        setTimeout(function(){
                            location.reload(); // reload the page
                        }, 250); 
                        console.log(data.success);
                    },
                });
            }
        });        

        $('.delete-btn2').click(function (e) {
             e.preventDefault();
            if (confirm('Are you sure you want to delete this image?')) {
                var id = $(this).data("id");
                var token = $(this).data('token');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{url('/admin/image_delete2')}}/"+id,
                    type: "DELETE",
                    dataType: "JSON",
                    data: { 'id': id },
                    success: function(data){
                        setTimeout(function(){
                            location.reload(); // reload the page
                        }, 250); 
                        console.log(data.success);
                    },
                });
            }
        });

    });

    $("#type").val("{{ $promotion->type }}");    
    $('#condition_th').val($('#condition_th_value').val());
    $('#condition_en').val($('#condition_en_value').val());

    $(document).ready(function(){
        $('input#title_th').change(function() {
            var text = $('input#title_th').val().toLowerCase()
                //replace all special characters | symbols with a space
                .replace(/[`~!@#$%^&*()_\-+=\[\]{};:'"\\|\/,.<>?\s]/g, ' ')
                // trim spaces at start and end of string
                .replace(/^\s+|\s+$/gm,'')
                // replace space with dash/hyphen
                .replace(/\s+/g, '-');
            $('#slug_url_th').val(text);    
        })
    });    
    $(document).ready(function(){
        $('input#title_en').change(function() {
            var text = $('input#title_en').val().toLowerCase()
                //replace all special characters | symbols with a space
                .replace(/[`~!@#$%^&*()_\-+=\[\]{};:'"\\|\/,.<>?\s]/g, ' ')
                // trim spaces at start and end of string
                .replace(/^\s+|\s+$/gm,'')
                // replace space with dash/hyphen
                .replace(/\s+/g, '-');
            $('#slug_url_en').val(text);    
        })
    });

    $('.delete-btn3').click(function (e) {
        e.preventDefault();
        if (confirm('Are you sure you want to delete this image?')) {
            var id = $(this).data("id");
            var type = $(this).data("type");
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{url('/admin/promotion/image_delete')}}/"+id,
                type: "DELETE",
                dataType: "JSON",
                data: { 'id': id, 'type' : type },
                success: function(data){
                    setTimeout(function(){
                        location.reload(); // reload the page
                    }, 250); 
                    console.log(data.success);
                },
            });
        }
    });

    $('#start_date_button').click(function() {
        $('#start_date').val('');
    })    
    $('#end_date_button').click(function() {
        $('#end_date').val('');
    })
    </script>
@endpush