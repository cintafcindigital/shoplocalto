@include('include/header');
div class="pcoded-content container">
<style type="text/css">
	.upload-file-import {
		padding: 15px 35px;
		background: #ddd;
		border-radius: 10px;
	}
	.validate-data {
		padding: 15px 35px;
		background: #0b69ff;
	    border-radius: 10px;
	    color: #fff;
	    cursor: pointer;
	}
	.validate-data:hover {
		background: #0b69ffd1;
	}
	.category-image-add {
		cursor: pointer;
		color: #0b69ff;
		background: #fff;
		padding: 15px;
		border-radius: 10px;
		-webkit-box-shadow: 0px 0px 11px -5px rgba(0,0,0,0.75);
		-moz-box-shadow: 0px 0px 11px -5px rgba(0,0,0,0.75);
		box-shadow: 0px 0px 11px -5px rgba(0,0,0,0.75);
	}
	.select-category {
		background: #ddd;
	}
	.image-library {
		background: #ddd;
	}
	.image-library img {
		height: 250px;
		object-fit: contain;
	}
	.images-div {
		position:relative;
		padding: 15px;
	}
	.delete-images {
	    position: absolute;
	    right: 0px;
	    bottom: 10px;
	    color: #eb1c24;
	    background: transparent;
	    padding: 2px 7px;
	    border-radius: 12px;
	    cursor: pointer;
	    font-size: 25px;
	}
	.delete-images:hover{
		color: #ff4b52;
	}
</style>
<div class="pcoded-main-container">
    <div class="pcoded-content container">
        <div class="row">
            <div class="col-sm-12">
            	<div class="row border-bottom mb-3">
                    <div class="col-sm-6 d-flex align-items-center mb-4">
                        <h1 class="d-inline-block font-weight-normal mb-0">Import Vendors</h1>
                    </div>
                </div>
                @if(session()->has('success'))
                    <div class="alert alert-info alert-dismissible fade show">{{ session()->get('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if((count($errors) > 0 || session()->has('error')) && !session()->has('last'))
                <div class="alert alert-danger alert-dismissible fade show">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    @if(count($errors) > 0)
                    <ul>@foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endif
                    @if(session()->has('error'))
                    <ul>
                        <li>{{session()->get('error')}}</li>
                    </ul>
                    @endif
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                </div>
                @endif
                <form method="POST" enctype="multipart/form-data" action="{{url()->current()}}" id="data-import" class="">
                	@csrf
                	<div class="form-group text-center">
                		<label for="vendor_file" class="upload-file-import">Upload File</label>
                		<input type="file" id="vendor_file" name="vendor_file" class="form-control d-none" onchange="javascript:$('.upload-file-import').text(this.value.split('\\')[2])" accept=".csv">
                		<button class="btn btn-primary" name="validate" value="1" type="submit">Validate Data</button>
                	</div>
                	<!-- <div class="form-group d-none">
                		<button type="submit" class="btn float-left btn-success d-none">Submit</button>
                	</div> -->
                	<input type="hidden" name="store_id" value="@if(session()->has('store_id')){{session()->get('store_id')}}@else{{old('store_id','0')}}@endif">
                	@if(session()->has('success') || old('import') == 1)
                	<div class="form-group text-center">
                		<button type="submit" name="import" value="1" class="btn btn-success">Import Data</button>
                	</div>
                	<div class="form-group">
                		<div class="row">
	                		<div class="col-sm-3">
	                			<h3>Random Images</h3>
	                		</div>
	                		<div class="col-sm-5">
	                			<select class="form-control select-category" required name="category">
	                				<option value>--Select Category--</option>
	                				@foreach($categories as $cat)
		                				<option value="{{$cat->id}}" @if(old('category',0) == $cat->id) selected @endif>{{$cat->title}}</option>
	                				@endforeach
	                			</select>
	                		</div>
	                		<div class="col-sm-4">
	                			<label for="add_images" class="category-image-add"><i class="fa fa-plus"></i> New Image</label>
	                			<input type="file" name="add_images[]" id="add_images" class="d-none" multiple="true" accept="image/jpeg,image/png,image/jpg,image/gif,image/svg">
	                		</div>
                		</div>
        				<div class="image-library row">
        					
        				</div>
                	</div>
                	@endif
                </form>
            </div>
        </div>
    </div>
</div>
<script src="{{url('/assets/js/plugins/bootstrap.min.js')}}"></script>
<script src="{{url('/assets/js/pcoded.min.js')}}"></script>
<script src="{{url('/assets/js/menu-setting.js')}}"></script>
<script src="{{url('/assets/js/plugins/select2.full.min.js')}}"></script>
<script src="{{url('/assets/js/plugins/jquery.dataTables.min.js')}}"></script>
<script src="{{url('/assets/js/plugins/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{url('/assets/js/plugins/jquery.dataTables.min.js')}}"></script>
<script src="{{url('/assets/js/plugins/dataTables.bootstrap4.min.js')}}"></script>
@@include('./include/footer.php')
<script type="text/javascript">
	$(document).on('click','.delete-images',function(event) {
		var deleteId = $(this).attr('value');
		if(confirm('Do you want to delete this image ?'))
		$.ajax({
				url:'{{url("admin/delete-random-images")}}',
				type:'POST',
				datatype:'JSON',
				data:{
					_token:$('meta[name="csrf-token"]').attr('content'),
					id:deleteId
				},
				beforeSend:function(){
					$('button[type="submit"]').addClass('disabled')
				},
				success:function(data){
					$('button[type="submit"]').removeClass('disabled')
					$('.select-category').change();
				}
			});
	});
	jQuery(document).ready(function($) {
		$('.select-category').change(function(event) {
			$.ajax({
				url:'{{url("admin/get-category-images")}}',
				type:'POST',
				datatype:'JSON',
				data:{
					_token:$('meta[name="csrf-token"]').attr('content'),
					category:$('.select-category').val()
				},
				beforeSend:function(){
					$('button[type="submit"]').addClass('disabled')
				},
				success:function(data){
					$('.image-library').html('');
					$.each(data,function(index, el) {
						$('.image-library').append('<div class="col-sm-3 images-div"><span class="delete-images" value="'+el.id+'"><i class="fa fa-trash"></i></span><img class="img-fluid" src="{{url("public/import")}}/'+el.image+'"></div>');
					});
					$('button[type="submit"]').removeClass('disabled');
				}
			});
		});
	    if($('.select-category').val() != '' && $('.select-category').val() != 0) $('.select-category').change();
	});
	function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();            
            reader.onload = function (e) {
		        $('.image-library').append('<div class="col-sm-3"><img class="img-fluid" src="'+e.target.result+'"></div>')
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
	$('#add_images').change(function(event) {
		var files = this.files;
		var formData = new FormData();
		formData.append('_token',$('meta[name="csrf-token"]').attr('content'));
		formData.append('category',$('.select-category').val());
		for (var i = 0; i < files.length; i++) {
			console.log("Filename: " + files[i].name);
	        console.log("Type: " + files[i].type);
	        console.log("Size: " + files[i].size + " bytes");
	        formData.append('images[]',files[i]);
		}
		$.ajax({
			url : "{{url('admin/upload-random-images')}}",
			type: 'POST',
			datatype : "JSON",
			data: formData,
			async: false,
			cache: false,
			contentType: false,
			processData: false,
			beforeSend:function(){
				// alert(123);
				$('button[type="submit"]').addClass('disabled')
			},
			success: function (returndata) {
				$('button[type="submit"]').removeClass('disabled')
				$('.select-category').change();
			},
		});
	});
</script>
</body>
</html>