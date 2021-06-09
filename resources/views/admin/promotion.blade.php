@extends('layouts.app')
@push('styles')
<style type="text/css">
	body .modal.addModal {
	    /* new custom width */
	    width: 80%;
	    /* must be half of the width, minus scrollbar on the left (30px) */
	    margin-left: -40%;
	}
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

		<div class="container-fluid">
			<div class="row-fluid">
				<div class="span12">
				    <div class="widget-box">
					    <div class="widget-title">
					    	<button type="submit" name="add" id="add" class="btn btn-success btn-mini" data-toggle="modal" data-target="#addModal" style="margin:8px;" value="Add">Add</button>
					    	<img src="{{asset('front/images/refresh.jpg')}}" class="refresh">
					    </div>
					    <div class="widget-content nopadding">
					        <table class="table table-bordered" id="myTable">
						        <thead>
						            <tr>
						              <th></th>
						              <th>Active</th>
									  <th>Action</th>
						              <th>Highlight</th>
						              <th>Title (TH)</th>
						              <th>Title (EN)</th>
						              <th>Period</th>
						              <th>Short Detail (TH)</th>
						              <th>Short Detail (EN)</th>
						              <th>Thumbnail (TH)</th>
						              <th>Thumbnail (EN)</th>
						              <th>Photo (TH)</th>
						              <th>Photo (EN)</th>
									  <th>Create Date</th>
						              <th>Update Date</th>
						              <th>Priority</th>
						            </tr>
						        </thead>
							</table>
					    </div>
				    </div> 
				</div>
			</div>
		</div>

	</div>

<!-- modal -->
<div id="addModal" class="modal hide fade addModal" aria-hidden="true" style="display: none; overflow:hidden;">

	<div class="modal-header" style="background: orange">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
		</button>
		<h2 class="modal-title" id="addModalLabel" style="color: whitesmoke;">Add Promotion</h2>
	</div>
	<form action="{{ route('promotion.store') }}" method="post" class="form-horizontal" style="display: inline!important;" enctype="multipart/form-data">
        @csrf
	<div class="modal-body">
	        @if ($errors->any())
	            <div class="alert alert-danger">
	            <ul>
	            @foreach ($errors->all() as $error)
	            <li>{{ $error }}</li>
	            @endforeach
	            </ul>
	            </div>
	        @endif
            <!-- type -->
            <div class="control-group" style="display: none;">
                <label for="type" class="control-label">Type : </label>
                <div class="controls">
                	<select class="type" id="type" name="type">
						<option value="ยาง" selected>ยาง</option>
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
						<input type="radio" name="new" value="Yes" checked>
						Yes</label>
						<label>
						<input type="radio" name="new" value="No">
						No</label>
            	</div>
            </div>
            <!-- layout -->
            <div class="control-group">
                <label for="layout" class="control-label">Layout : </label>
                <div class="controls">
						<label style="display: inline-block"><input type="radio" name="layout" value="0" checked>
						1<img src="{{ asset('image/layout1.png') }}" class="layout_image" style="max-height: 70px;"></label>
						<label style="display: inline-block"><input type="radio" name="layout" value="1">
						2<img src="{{ asset('image/layout2.png') }}" class="layout_image" style="max-height: 100px;"></label>
            	</div>
            </div>            
            <!-- start date -->
            <div class="control-group">
                <label for="start_date" class="control-label">Start Date : </label>
                <div class="controls">
					<input type="text" id="start_date" name="start_date" value="{{ old('start_date') }}" class="span3 datepicker" placeholder="dd-mm-yyyy" data-date-format="dd-mm-yyyy" autocomplete="off"><button type="button" class="btn btn-danger btn-mini" id="start_date_button" style="margin-left: 3px">X</button>
            	</div>
            </div>            
            <!-- end date -->
            <div class="control-group">
                <label for="end_date" class="control-label">End Date : </label>
                <div class="controls">
					<input type="text" id="end_date" name="end_date" value="{{ old('end_date') }}" class="span3 datepicker" placeholder="dd-mm-yyyy" data-date-format="dd-mm-yyyy" autocomplete="off"><button type="button" class="btn btn-danger btn-mini" id="end_date_button" style="margin-left: 3px">X</button>
            	</div>
            </div>
		<div class="widget-box">
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
		                  <input type="text" placeholder="Title (TH)" id="title_th" name="title_th" value="{{ old('title_th') }}" class="span7" required>
		            	</div>
	            	</div>		            
	            	<!-- slug url th -->
		            <div class="control-group">
	                <label for="slug_url_th" class="control-label">Slug url (TH) : </label>
		                <div class="controls">
		                  <input type="text" placeholder="Slug url (TH)" id="slug_url_th" name="slug_url_th" value="{{ old('slug_url_th') }}" class="span7" readonly>
		            	</div>
	            	</div>	 
	            	<!-- short detail th -->
		            <div class="control-group">
	                <label for="short_detail_th" class="control-label">Short Detail (TH) : </label>
		                <div class="controls">
		                	<textarea name="short_detail_th" placeholder="รายละเอียดโดยย่อ (TH)" class="span7" rows="5">{{ old('slug_url_th') }}</textarea>
		            	</div>
	            	</div>      	
	            	<!-- thumbnail th -->
		            <div class="control-group">
	                <label for="thumbnail_th" class="control-label">Thmbnail (TH) : </label>
		                <div class="controls">
                        	<input type="file" id="thumbnail_th" name="thumbnail_th"> 637 * 534 px
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
		            <!-- more pictures -->
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
	                <label for="pdf_th" class="control-label">Pdf (TH) : </label>
		                <div class="controls">
                        	<input type="file" id="pdf_th" name="pdf_th">
		            	</div>
	            	</div>
	            	<!-- condition th -->
		            <div class="control-group">
	                <label for="condition_th" class="control-label">Condition (TH) : </label>
		                <div class="controls">
		                  <textarea placeholder="Condition (TH)" id="condition_th" name="condition_th" value="{{ old('condition_th') }}" rows="15" class="span5"></textarea>
		            	</div>
	            	</div>	
	            </div>
	            <!-- tab english -->
	            <div id="tab2" class="tab-pane">
    	            <!-- title en -->
		            <div class="control-group">
		                <label for="title_en" class="control-label">Title (EN) : </label>
		                <div class="controls">
		                  <input type="text" placeholder="Title (EN)" id="title_en" name="title_en" value="{{ old('title_en') }}" class="span7">
		            	</div>
		            </div>
	            	<!-- slug url en -->
		            <div class="control-group">
	                <label for="slug_url_en" class="control-label">Slug url (EN) : </label>
		                <div class="controls">
		                  <input type="text" placeholder="Slug url (EN)" id="slug_url_en" name="slug_url_en" value="{{ old('slug_url_en') }}" class="span7" readonly>
		            	</div>
	            	</div>	            	
	            	<!-- short detail en -->
		            <div class="control-group">
	                <label for="short_detail_en" class="control-label" class="span4">Short Detail (EN) : </label>
		                <div class="controls">
		                	<textarea name="short_detail_en" placeholder="รายละเอียดโดยย่อ (EN)" class="span7" rows="5">{{ old('slug_url_en') }}</textarea>
		            	</div>
	            	</div>
	            	<!-- thumbnail en -->
		            <div class="control-group">
	                <label for="thumbnail_en" class="control-label">Thmbnail (EN) : </label>
		                <div class="controls">
                        	<input type="file" id="thumbnail_en" name="thumbnail_en"> 637 * 534 px
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
		                	<button class="btn btn-success image-add2" type="button">Add more photo</button>
		                	* Only appear if layout 1 is selected
		            	</div>
	            	</div>
	            	<!-- pdf en -->
		            <div class="control-group" style="display: none;">
	                <label for="pdf_en" class="control-label">Pdf (EN) : </label>
		                <div class="controls">
                        	<input type="file" id="pdf_en" name="pdf_en">
		            	</div>
	            	</div>
	            	<!-- condition en -->
		            <div class="control-group">
	                <label for="condition_en" class="control-label">Condition (EN) : </label>
		                <div class="controls">
		                  <textarea placeholder="Condition (EN)" id="condition_en" name="condition_en" value="{{ old('condition_en') }}" rows="15" class="span5"></textarea>
		            	</div>
	            	</div>
	            </div>
	        </div>

        </div>
	</div>
    
    	<!-- footer -->
	    <div class="modal-footer">
	    	<input type="submit" class="btn btn-success" id="submit" value="Submit">
	    	<button type="button" class="btn btn-inverse" data-dismiss="modal">Cancel</button>
	    </div>
    </form>
</div>
<!-- priority modal -->
<div id="priorityModal" class="modal hide fade" aria-hidden="true">
	<div class="modal-dialog md-lg">
	<!-- title -->
	<div class="modal-header" style="background: orange">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
		</button>
		<h2 class="modal-title" style="color: whitesmoke;">Change Priority</h2>
		<h4 style="text-align: center; color: whitesmoke;" id="priority_title"></h4>
	</div>
	<form class="form-horizontal" style="display: inline!important;">
	<!-- body -->
		<div class="modal-body">
		    <input type="hidden" name="priority_id" id="priority_id">
            <!-- priority -->
            <div class="control-group">
                <label for="priority" class="control-label">Priority :</label>
                <div class="controls">
					<label>
						<input type="radio" name="priority" value="first" checked>
						Move Top</label>
						<label>
						<input type="radio" name="priority" value="up">
						Move Up</label>
						<label>
						<input type="radio" name="priority" value="down">
						Move Down</label>
						<label>
						<input type="radio" name="priority" value="last">
						Move Bottom</label>
            	</div>
            </div>
		</div>
    	<!-- footer -->
	    <div class="modal-footer">
	    	<input type="button" class="btn btn-success" id="priority_submit" value="Change">
	    	<button type="button" class="btn btn-inverse" data-dismiss="modal">Cancle</button>
	    </div>
	</form>    
	</div>
</div>
@endsection
@push('scripts')
    <script>
	$(function() {
		$('#myTable').on('click', '.toggle-class', function(e){
			$('.toggle-class').change(function() {
			    var status = $(this).prop('checked') == true ? 1 : 0; 
			    var promotion_id = $(this).data('id'); 
			     
			    $.ajax({
			        type: "GET",
			        dataType: "json",
			        url: "{{route('changeStatusPromotion')}}",
			        data: {'status': status, 'promotion_id': promotion_id},
			        success: function(data){
	                    console.log(data.success)
			        }
			    });
			})
		})
	})

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
    });

    $('#start_date_button').click(function() {
        $('#start_date').val('');
    })
    $('#end_date_button').click(function() {
        $('#end_date').val('');
    })

	$(function() {
	    $('#myTable').DataTable({
	        processing: true,
	        serverSide: true,
	        stateSave: true,
	        stateDuration: -1,
		    sScrollX: "100%",
		    sScrollXInner: "110%",
	        ajax: '{!! route("promotion.data") !!}',
	        columns: [
	            { data: 'DT_RowIndex', orderable: false, searchable: false, width:'30px'},
	            { data: 'status', name: 'status', orderable: false, searchable: false, width:'50px', className: "alignCenter"},
	            { data: 'action', name: 'action', orderable: false, searchable: false, className: "alignCenter"},
	            { data: 'new', name: 'new', width:'50px', searchable: false, className: "alignCenter"},
	            { data: 'title_th', name: 'title_th'},
	            { data: 'title_en', name: 'title_en'},
	            { data: 'period', name: 'period', orderable: false, searchable: false, width:'120px'},
	            { data: 'short_detail_th', name: 'short_detail_th'},
	            { data: 'short_detail_en', name: 'short_detail_en'},
	            { data: 'thumbnail_th', name: 'thumbnail_th', orderable: false, searchable: false},
	            { data: 'thumbnail_en', name: 'thumbnail_en', orderable: false, searchable: false},
	            { data: 'photo_th', name: 'photo_th', orderable: false, searchable: false},
	            { data: 'photo_en', name: 'photo_en', orderable: false, searchable: false},
	            { data: 'created_at', name: 'created_at'},
	            { data: 'updated_at', name: 'updated_at' },
	            { data: 'priority', name: 'priority', searchable: false}
	        ],
	        order: [ [15, 'desc'] ]
	    });
	});
	$('#myTable').on('click', '.priority_button', function(e){
		var id = $(this).data('id');
		var title = $(this).data('title');
    	$('#priority_id').val(id);
    	$('#priority_title').text(title);
	});
    $('#priority_submit').click(function(e) {
        var priority_id = $('#priority_id').val();
        var priority = $('input[name="priority"]:checked').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: '{{route("changePriorityPromotion")}}',
            data: { 'priority_id': priority_id, 'priority': priority },
            success: function (data) {
            	if (data.success) {
            		$('#priorityModal').modal('hide');
            		alert(data.success);
            		$('#myTable').DataTable().ajax.reload(null, false);
            	} else {
            		alert(data.error);
            	}
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
    
	$('#myTable').on('click', '.delete_button', function(e){
		var id = $(this).data('id');
		if(confirm("Permanently delete this promotion?")){
	      	$.ajaxSetup({
	          	headers: {
	              	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	          	}
		    });
	        $.ajax({
	            type: "DELETE",
	            url: '{{url("admin/promotion")}}/'+id,
	            success: function (data) {
	            	alert(data.success);
	                $('#myTable').DataTable().ajax.reload(null, false);
	            },
	            error: function (data) {
	                console.log('Error:', data);
	            }
	        });
		}
	});
	</script>
@endpush
