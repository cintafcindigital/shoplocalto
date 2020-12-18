@extends('layouts.default')
@section('meta_title',$data['titleData']->meta_title)
@section('meta_keyword',$data['titleData']->meta_keyword)
@section('meta_description',$data['titleData']->meta_description)
@section('content')
@include('includes.menu')
 <link href="http://demo.expertphp.in/css/dropzone.css" rel="stylesheet">
 <script src="{{ asset('js/dropzone.js') }}"></script>
<section class="section-padding dashboard-wrap storefront_main_sect dash_main_sect">
   @include('vendor.tools_nav')
   <div class="wrapper">
	   <div class="pure-g">
	       <!-- Left navigation -->
	     	@include('vendor.nav_links')
	      <!-- end left navigation -->
	      <div class="pure-u-5-7">
	      	<div class="alert alert-danger print-error-msg" style="display:none">
        					<ul></ul>
    				  </div>
	         <h1 class="adminTitle">
	            Photo Gallery <span class="adminTitle__counter">
	            	{{ isset($data['vendor_photo']) && count($data['vendor_photo'])>0?'('.count($data['vendor_photo']).')':''}}
	            </span>
	         </h1>
	         <div class="adminAlert adminAlert--flex">
	            <i class="icon-vendors-admin-alerts icon-vendors-admin-alerts-photos"></i>
	            <div>
	               <p>
	                  Add at least 1 picture highlighting your products or services to give clients and patients a clear picture of your work. (maximum 8 pictures) <strong><br>Professional profile with more photos typically receive more leads.</strong>
	                  <a target="_blank" href="{{url('vendor/read-between-the-wines-podcast-4')}}">View an example of a Profile</a>
	               </p>
	            </div>
	         </div>
	        
	         <div class="app-hide-alert success_gall_msg" style="display: none;">
		        <div class="adminAlert adminAlert--success">
		            
		             <p class="alert_msg"></p>
		        </div>
		    </div>
	         <p class="adminSubtitle">Add photos</p>
	         <div class="app-global-progress-uploaded" style="display: none;">
	            <div class="adminAlert adminAlert--success">
	               <p>Uploaded files</p>
	            </div>
	         </div>
	         <div id="app-common-upload-drop-element" class="mb20 upload_gallery" style="position: relative;">	         	
	           <?php /* 
	            <div class="adminGalleryUpload box" id="app-common-upload-container" style="position: relative;">

	           <form method="POST" action="{{url('/gallery')}}" accept-charset="UTF-8" class="dropzone dz-clickable" id="dropzone" enctype="multipart/form-data">

	           
	             	{{ csrf_field() }}

	               <div class="adminGalleryUpload__graphic">
	                  <div class="adminGalleryUpload__content">
	                     <span class="adminGalleryUpload__icon adminGalleryUpload__icon--photos"></span>
	                     <span class="adminGalleryUpload__step">GIF, JPG or PNG format</span>
	                     <span class="adminGalleryUpload__step">Max 5MB</span>
	                     <span class="adminGalleryUpload__step">Recommended ratio is 300 x 188 pixels</span>
	                  </div>
	               </div>
	               <p class="adminGalleryUpload__title">Drag and drop your photos here. Once uploaded, you can select and drag images to reorder below.</p>

	               <!-- <div class="adminFormUpload__button" style="cursor: pointer">
	                           <label for="pickphotos" class="btnFlat btnFlat--primary" >Add Photos</label>
	                           <input  type="file" name="pickphotos[]" id="image-upload" class="app-promociones-upload dropzone" multiple>
	                           	                          
	                </div> -->
	             
	              <!--  <a class="btnFlat btnFlat--primary" role="button" id="pickfiles" style="z-index: 1;">Add Photos</a> -->
	               <p class="adminGalleryUpload__legal">Published content is required to meet My Health Squad’s <a href="{{url('privacy-policy')}}" target="_blank">Terms of Use</a>.</p>
	               <div class="adminGalleryLoader--global app-global-progress-bar"></div>
	               <div id="html5_1dh0kpffo151ilbshgi1f368kj_container" class="moxie-shim moxie-shim-html5" style="position: absolute; top: 303px; left: 373px; width: 109px; height: 42px; overflow: hidden; z-index: 0;"><input id="html5_1dh0kpffo151ilbshgi1f368kj" type="file" style="font-size: 999px; opacity: 0; position: absolute; top: 0px; left: 0px; width: 100%; height: 100%;" multiple="" accept=".jpg,.jpeg,.gif,.png" tabindex="-1"></div>
	                </form> 
	            </div>
	                */ ?>
	            <form name="frm_gallery" id="frm_gallery"  method="post" >
	               <input type="hidden" name="action" value="save_gallery">	
	               <input type="hidden" id="controlPeticionPorPost" name="controlPeticionPorPost" value="1">
	                <!-- include('includes.image-crop-4',['name' => 'picture','width' => 633.5,'height' => 350]) -->
	                <input type="file" name="upload_image" class="form-control" id="upload_image" accept="image/*" />

	               <div id="SWFUploadFileListingFiles">
	              
	                  <ul id="imageList" class="pure-g-r row">

	                  	@foreach($data['vendor_photo'] as $photo)
	                     <li id="photo_{{$photo->id}}" class="app-gallery-li adminGalleryItem__container pure-u-1-4" data-total="0">
	                        <div class="relative app-item-container">
	                        	  <input type="hidden" name="photo_ids_arr[]" value="{{ $photo->id }}">
	                           <div class="adminGalleryItem">
	                              <figure class="adminGalleryItem__figure" id="0_imgFig">
	                                 <div class="adminGalleryLoader app-progress-bar" style="display:none;">
	                                    <div class="adminGalleryLoader__progress" id="0progress"></div>
	                                 </div>
	                                 <img class="app-gallery-choose adminGalleryItem__image" id="{{$photo->id}}_img" src="{{ asset('vendors/'.$photo->vendor_folder.'/'.$photo->image)}}" alt="">                         
	                              </figure>
	                              <span class="adminGalleryItem__label">Title:</span><input class="adminGalleryItem__description" type="text" maxlength="30" placeholder="Add a description..." name="img_title[{{$photo->id}}]" value="{{ isset($photo->img_title)?$photo->img_title:'' }}">                         
	                              <footer class="adminGalleryItem__footer">
	                                 <div class="adminGalleryItem__select icon icon-arrow-down">
	                                    <select class="app-item-select app-item-selector-checker" name="set_main_img[{{ $photo->id }}]" data-img_id="{{ $photo->id }}" id="set_main_img_{{ $photo->id }}">
	                                       <option value="0" {{ isset($photo->is_logo) && $photo->is_logo==0?'selected':''}}>Show as</option>
	                                       <option value="1" {{ isset($photo->is_logo) && $photo->is_logo==1?'selected':''}}>Main Image</option>
	                                    </select>
	                                 </div>
	                                 <button type="button" class="app-gallery-delete-item adminGalleryItem__delete icon icon-trash" data-photo_trash_id="{{ $photo->id }}" data-url="{{ url('/gallerydelete/'.$photo->id) }}"></button>                         
	                              </footer>
	                           </div>
	                        </div>

	                     </li>
	                     @endforeach
	                  </ul>
	               </div>
	               <input class="btnFlat btnFlat--primary app-va-fotos-boton-guardar mt20 save_gallery" type="submit" value="Save">
	            </form>
	         </div>
	      </div>
	   </div>
	</div>
</section>
@include('includes.footer')
<!-- Image Crop -->
<div id="uploadimageModal" class="modal" role="dialog">
 <div class="modal-dialog" style="width:700px;">
  <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Upload & Crop Image</h4>
        </div>
        <div class="modal-body">
          <div class="row">
       <div class="col-md-12 text-center">
        <div id="image_demo" style="width:100%; margin-top:30px"></div>
       </div>
       <div class="col-md-12 text-center" style="padding-top:30px;">
      	<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button class="btn btn-success crop_image">Crop & Upload Image</button>
     </div>
    </div>
        </div>
        <div class="modal-footer">
        </div>
     </div>
    </div>
</div>
</div>
<script src="{{asset('public/js/crop/croppie.js')}}"></script>
<link rel="stylesheet" href="{{asset('public/js/crop/croppie.css')}}" />
<script type="text/javascript">
		// Dropzone.options.dropzone

        Dropzone.options.dropzone =
         {
         	autoProcessQueue:false,
         	dictDefaultMessage:'<div class="adminFormUpload__button" style="cursor: pointer;margin:auto"><label for="pickphotos" class="btnFlat btnFlat--primary">Add Photos</label></div>',
            maxFilesize: 5,
            renameFile: function(file) {
                var dt = new Date();
                var time = dt.getTime();
               return time+file.name;
            },
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
            createImageThumbnails: false,
            addRemoveLinks: false,
            timeout: 5000,
            accept: function(file, done) {
            	alert(123);
            },
            success: function(file, response) 
            {
             alert(123);
             // return;
                console.log(response);
                setTimeout(function() {
	        				//$('.app-hide-alert').slideUp();
	        		// window.location='/gallery';
	    		}	, 3000);
                this.removeFile(file);
            },
            error: function(file, response)
            {
              console.log(response);
              alert(response);	
               return false;
            }
};

	setTimeout(function() {
	    $('.app-hide-alert').slideUp();
	}, 6000);
	$(document).ready(function(){
	  	 $image_crop = $('#image_demo').croppie({
		    enableExif: true,
		    viewport: {
		      width:570,
		      height:366,
		      type:'square' //circle
		    },
		    boundary:{
		      width:600,
		      height:400
		    }
		  });
	  	$('#upload_image').on('change', function(){
		    var reader = new FileReader();
		    reader.onload = function (event) {
		      $image_crop.croppie('bind', {
		        url: event.target.result
		      }).then(function(){
		        console.log('jQuery bind complete');
		      });
		    }
		    reader.readAsDataURL(this.files[0]);
		    $('#uploadimageModal').modal({backdrop: 'static', keyboard: false});
		});
		$("#uploadimageModal").on("hidden.bs.modal", function () {
            $('#upload_image').val('');
        });
		$('.crop_image').click(function(event){
		    $image_crop.croppie('result', {
		      type: 'canvas',
		      size: 'viewport'
		    }).then(function(response){
		      $.ajax({
		        url:"{{url('upload-vendor-images')}}",
		        type: "POST",
		        data:{"image": response},
		        success:function(data)
		        {
		          $('#uploadimageModal').modal('hide');
		          // $('#uploaded_image').html(data);
		          window.location.reload();
		        }
		      });
		    })
		});
       $(".save_gallery").click(function(e) {
            e.preventDefault();
             $(".alert_msg").html('');
            $.ajax({
                url: "/gallery",
                type:'POST',
                data: $("#frm_gallery").serialize(),
                success: function(data) {

                	console.log('data',data);
                    if($.isEmptyObject(data.error)) {
                    	
                    	$('.app-hide-alert').show();
                    	$('html, body').animate({ scrollTop: 10 }, 'slow');
                    	$(".alert_msg").html(data.message);
                    	                   	
                    	setTimeout(function() {
        					        			
	        			 $('.app-hide-alert').slideUp();
	        			 window.location='/gallery';
	        			 	        			 	        				
	    				}, 3000);

	    				
                    }else{
                        alert(data.error);
                    }
                }
            });



        }); 

   
    $(document).on('change', '.app-item-selector-checker', function(e) {
    		
    	
    	  var id=$(this).data('img_id');
    		
			$("select.app-item-selector-checker option:selected").removeAttr("selected");
			
			$("select#set_main_img_"+id+" option").each(function() { 
					this.selected = (this.text == 'Show as' || this.text == 'Main Image'); 
					//alert(this.val);
					this.val=this.val;
			});
					    		
    		
	  });

      //DELETE DEAL
	    $(".app-gallery-delete-item").click(function() {
	    	var photo_trash_id=$(this).data("photo_trash_id");
	    	
	    	$.ajax({
                url: $(this).data('url'),
                type:'GET',
                data: { id:photo_trash_id },
                dataType:'JSON',
   				contentType: false,
   				cache: false,
   				processData: false,
                success: function(data) {
                    if($.isEmptyObject(data.error)) {

                    	$('.app-hide-alert').show();
                    	$('html, body').animate({ scrollTop: 10 }, 'slow');
                    	$(".alert_msg").html(data.message);
                    	setTimeout(function() {
                    		$("#photo_"+photo_trash_id).remove();
	        				$('.app-hide-alert').slideUp();
	        				//window.location='/promociones';
	    				}	, 3000);
    			
                      
                    }
                }
            });


	    })

	});





</script>
@endsection