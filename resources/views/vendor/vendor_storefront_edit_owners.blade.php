@extends('layouts.default')
@section('meta_title',$data['titleData']->meta_title)
@section('meta_keyword',$data['titleData']->meta_keyword)
@section('meta_description',$data['titleData']->meta_description)
@section('content')
@include('includes.menu')
<section class="section-padding dashboard-wrap storefront_main_sect dash_main_sect">
   @include('vendor.tools_nav')
   <div class="wrapper">
	   <div class="pure-g">
	      <!-- Left navigation -->
	     	@include('vendor.nav_links')
	      <!-- end left navigation -->
	      <div class="pure-u-5-7 owners_new">
	      	
	      	<!-- erros message -->
	      	<div class="alert alert-danger print-error-msg" style="display:none">
        					<ul></ul>
    		</div>

            <div class="app-hide-alert" style="display: none;">
	            <div class="adminAlert adminAlert--success"><p class="alert_msg"></p></div>
	        </div>	
	         <h1 class="adminTitle">Meet the Team <i class="icon icon-arrow-right mr10 ml10"></i>Add team member</h1>
	         <div class="adminBox">
	            <form class="pure-form adminOwners__form" name="formOwner"  method="post" enctype="multipart/form-data">
	            	{{ csrf_field() }}
	               <div class="pure-g-r">
	                  <div class="pure-u-3-5">
	                     <div class="pr40">
	                        <div class="pure-g">
	                           <div class="pure-u-1-2 pr20">
	                              <label class="adminFormLabel" for="ownerName">first Name <span class="adminFormLabel__required">*</span></label>
	                              <input class="pure-u-1" type="text" name="firstname" id="firstname" value="{{ isset($data['vendor_tm']->firstname)?$data['vendor_tm']->firstname:''}}">
	                           </div>
	                           <div class="pure-u-1-2">
	                              <label class="adminFormLabel" for="ownerSurname">Last Name</label>
	                              <input class="pure-u-1" type="text" name="lastname" id="lastname" value="{{ isset($data['vendor_tm']->lastname)?$data['vendor_tm']->lastname:''}}">
	                           </div>
	                        </div>
	                        <div class="mt10">
	                           <label class="adminFormLabel" for="ownerMail">Email</label>
	                           <input class="pure-u-1" type="text" name="email" id="email" value="{{ isset($data['vendor_tm']->email)?$data['vendor_tm']->email:''}}">
	                        </div>
	                        <div class="mt10">
	                           <label class="adminFormLabel" for="ownerRole">Position <span class="adminFormLabel__required">*</span></label>
	                           <input class="pure-u-1" type="text" name="position" id="position" value="{{ isset($data['vendor_tm']->position)?$data['vendor_tm']->position:''}}">
	                        </div>
	                        <div class="mt10">
	                           <div class="mb10">
	                              <label class="adminFormLabel" for="ownerBio">Bio </label>
	                           </div>
	                           <textarea class="description form-control" rows="5" id="biography" name="biography">{{ isset($data['vendor_tm']->biography)?strip_tags($data['vendor_tm']->biography):''}}</textarea>
	                           
	                        </div>
	                     </div>
	                  </div>
	                  <div class="pure-u-2-5">
	                     <label class="adminFormLabel" for="dImagen1">Image <span class="adminFormLabel__required">*</span></label>
	                     <div id="dImagen1" class="adminFormUpload mt10">
	                        <input type="hidden" id="ownerImage" name="ownerImage" value="">
	                        <i class="adminFormUpload__icon"></i>

	                        <div class="adminFormUpload__button">
	                           <label for="Imagen1" class="btnOutline btnOutline--primary">Add Image</label>
	                           <input  class="app-promociones-upload" type="file" id="Imagen1" name="Imagen1" data-idtipo="1">
	                           <div id="loading" style="display: none"><img src="{{ asset('images/loading.gif') }}"></div>
	                           <input type="hidden" id="deal_img_data" name="Imagen1" />
	                           <img id="tm_img" src="{{ asset('vendors/VENDOR_'.$data['vendor_tm']->vendor_id.'/'.$data['vendor_tm']->photo)}}" alt="" width="250" height="150" />
	                            <p class="alert_delete_msg"></p>
	                          
	                        </div>
	                        
	                     </div>
	                     <div class="adminAlert adminAlert--info mt40 alert_text_wrp">
	                        <strong>Reminder:</strong>
	                        Each bio must be written in the first person and include a headshot photo.
	                     </div>
	                  </div>
	               </div>
	               <div class="mt20">
	                  <input class="btnFlat btnFlat--primary update_team_mem_btn" type="submit" value="Save Changes">
	                  <input class="btnFlat btnFlat--grey app-owner-delete" type="button" data-owner_remove_id="{{ $data['vendor_tm']->id }}" value="Remove">
	                  <small class="adminOwners__legal">Published content is required to meet My Heaslth Squad Profile. <a href="javascript:;" target="_blank">Terms of Use</a>.</small>
	               </div>
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
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="{{asset('public/js/crop/croppie.js')}}"></script>
<link rel="stylesheet" href="{{asset('public/js/crop/croppie.css')}}" />
<script type="text/javascript">
	$(document).ready(function() {
	    $(".update_team_mem_btn").click(function(e) {
            e.preventDefault();

            var form_data = new FormData();
        	
        	form_data.append('_token', $("input[name='_token']").val());
        	form_data.append('firstname',$("input[name='firstname']").val());
        	form_data.append('lastname',$("input[name='lastname']").val());
        	form_data.append('email',$("input[name='email']").val());
         	form_data.append('position',$("input[name='position']").val());
         	form_data.append('biography',$("textarea[name='biography']").val());
         	form_data.append('image', Imagen1.files[0]);
         	form_data.append('image', $('#deal_img_data').val());
            $.ajax({
                url: "/ownersedit/{{$data['vendor_tm']->id}}",
                type:'POST',
                data: form_data,
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
	        				//$('.app-hide-alert').slideUp();
	        				window.location='/owners';
	    				}	, 3000);

	    					
                        //alert(data.success);
                    }else{
                        printErrorMsg(data.error);
                    }
                }
            });


        }); 
	    $image_crop = $('#image_demo').croppie({
		    enableExif: true,
		    viewport: {
		      width:350,
		      height:250,
		      type:'square' //circle
		    },
		    boundary:{
		      width:600,
		      height:400
		    }
	  	});
        $("#Imagen1").change(function() {
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
			 /*var ext = $('#Imagen1').val().split('.').pop().toLowerCase();
			if($.inArray(ext, ['gif','png','jpg','jpeg']) == -1) {
				$(".update_deal_btn").attr("disabled",true);
			    $(".alert_delete_msg").html('File must be an image (jpg,png,bpm or gif)').css("color","red");
			    return false;
			}else{
				 $(".alert_delete_msg").hide();
				 previewImage(this);
			}*/
        				
        });
        $('.crop_image').click(function(event){
		    $image_crop.croppie('result', {
		      type: 'canvas',
		      size: 'viewport'
		    }).then(function(response){
		      /*$.ajax({
		        url:"{{url('upload-vendor-images')}}",
		        type: "POST",
		        data:{"image": response},
		        success:function(data)
		        {
		          $('#uploadimageModal').modal('hide');
		          // $('#uploaded_image').html(data);
		          window.location.reload();
		        }
		      });*/
		      $('#tm_img').attr('src', response).height(150).width(250);
		      $('#deal_img_data').val(response);
	          $('#uploadimageModal').modal('hide');
		    })
		});


        //DELETE DEAL
	    $(".app-owner-delete").click(function() {
	    	var owner_remove_id=$(this).data("owner_remove_id");
	    	
	    	$.ajax({
                url: "/ownersdelete/{{ $data['vendor_tm']->id }}",
                type:'GET',
                data: { id:owner_remove_id },
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
	        				//$('.app-hide-alert').slideUp();
	        				window.location='/owners';
	    				}	, 3000);
    			
                      
                    }
                }
            });


	    })



	});

		
	 function printErrorMsg (msg) {
        	//alert(msg);
            $(".print-error-msg").find("ul").html('');
            $(".print-error-msg").css('display','block');
            $('html, body').animate({ scrollTop: 10 }, 'slow');
            setTimeout(function(){
            	$(".print-error-msg").slideUp();

            },4000);
            $.each( msg, function( key, value ) {
                $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
            });
        }

    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
            	$('#tm_img').attr('src',"{{ asset('images/loading.gif') }}").height(50).width(50);
            	
            	setTimeout(function(){
            		    //$("#remove_img").hide();
                		$('#tm_img').attr('src', e.target.result).height(150).width(250);
                },1000);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
      }

</script>

<script src="{{ asset('js/tinymce/tinymce.min.js') }}"></script>
<script>
   /*tinymce.init({
   	  branding: false,
   	  menubar:false,
      statusbar: false,
	  selector: 'textarea#biography',  //Change this value according to your HTML
	  auto_focus: 'element1',
	  width: "440",
	  height: "180",

	 setup : function(editor)  {
                editor.on("change keyup", function(e){
                    //console.log('saving');
                    //tinyMCE.triggerSave(); // updates all instances
                    editor.save(); // updates this instance's textarea
                    $(editor.getElement()).trigger('change'); // for garlic to detect change
                });
      }
	});*/
</script>
@endsection