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
   <div class="wrapper wrapper-blood">
	   <div class="pure-g">
	       <!-- Left navigation -->
	     	@include('vendor.nav_links')
	      <!-- end left navigation -->
	      <div class="pure-u-5-7">
	         <h1 class="adminTitle">
	            Videos {{ isset($data['vendor_videos']) && count($data['vendor_videos'])>0?'('.count($data['vendor_videos']).')':''}}                         
	         </h1>
	         <div class="adminAlert adminAlert--flex storefront_alert">
	            <i class="icon-vendors-admin-alerts icon-vendors-admin-alerts-videos"></i>
	            <div>
	               <p class="adminAlert__title">Showcase your work by adding videos to your Profile.</p>
	               <p>Add unlimited videos related to your business and health services.</p>
	            </div>
	         </div>
	         <div class="app-global-progress-uploaded" style="display: @if(session()->has('success')) block; @else none; @endif">
	            <div class="adminAlert adminAlert--success">
	              <p class="alert_msg">{{session()->get('success')}}</p>
	            </div>
	         </div>

	         <p class="adminSubtitle">Add Video </p>
	         <div class="row">
	         	<form method="POST" action="{{url('videos')}}">
	         		{{csrf_field()}}
			         <div class="col-sm-12">
			         	<div class="form-group">
			         		<input type="text" class="form-control" name="file" placeholder="Paste or type your youtube link here..." autocomplete="off">
			         		@if($errors->has('file')) <span class="has-error text-danger">{{$errors->first('file')}}</span> @endif
			         	</div>
			         	<button class="btnFlat btnFlat--primary">Submit</button>
			         </div>
	         	</form>
	         </div>
	         <div id="app-common-upload-drop-element" class="upload_video" style="position: relative;display: none;">
	            <div class="adminGalleryUpload box" id="app-common-upload-container" style="position: relative;">
	               <div class="adminGalleryUpload__graphic">
	                  <div class="adminGalleryUpload__content">
	                     <span class="adminGalleryUpload__icon adminGalleryUpload__icon--videos"></span>
	                     <span class="adminGalleryUpload__step"> AVI, FLV and MP4 format <br>Landscape orientation</span>
	                     <span class="adminGalleryUpload__step">Max 500MB</span>
	                  </div>
	               </div>
	               <p class="adminGalleryUpload__title">Drag and drop your videos here. Once uploaded, you can select and drag videos to reorder below.<br>Be sure that the video showcases your services and does not include any contact information.</p>
	               
	               <div class="adminGalleryLoader--global app-global-progress-bar"></div>
	               <div id="html5_1dh0n6p6m1rlm1gcc1i7qshn1ih8j_container" class="moxie-shim moxie-shim-html5" style="position: absolute; top: 327px; left: 378px; width: 99px; height: 42px; overflow: hidden; z-index: 0;"><input id="html5_1dh0n6p6m1rlm1gcc1i7qshn1ih8j" type="file" style="font-size: 999px; opacity: 0; position: absolute; top: 0px; left: 0px; width: 100%; height: 100%;" multiple="" accept=".flv,.avi,.mp4,.mpeg,.mpeg4,.mov,.3gp,.wmv,.vob" tabindex="-1"></div>
	            </div>
	            <form method="POST" action="{{url('/videos')}}" accept-charset="UTF-8" class="dropzone dz-clickable" id="dropzone" enctype="multipart/form-data">
	            	{{ csrf_field() }}
	               <input type="hidden" id="id_project" value="50">
	               <div id="SWFUploadFileListingFiles" class="emp-gallery-list">
	                  <ul id="videoList" class="row"></ul>
	               </div>
	               <div class="app-va-fotos-uploading alert alert-advice" style="display: none;">
	                  <p>Uploading files ...</p>
	               </div>
	            </form>
	         </div>
	        

	         <div  class="emp-gallery-list-x">
	         	@if(isset($data['vendor_videos']) && count($data['vendor_videos'])>0)
	                        <ul id="videoList" class="row">

	                           @foreach($data['vendor_videos'] as $video)	
	                        	<li id="video_{{$video->id}}" data-embedded="false" data-editable="true" data-id-video="{{$video->id}}" class="app-gallery-li adminGalleryItem__container-x --pure-u-1-4 col-sm-6 selected " draggable="false" data-total="1">
	                        		<div class="relative app-item-container">
	                        		<input type="hidden" name="Ficheros[]" value="0">
	                        		<div class="adminGalleryItem adminGalleryItem--video">
	                        			     <figure class="adminGalleryItem__figure_x" id="0_imgFig">
	                        				   <div class="adminGalleryLoader app-progress-bar" style="display:none;">
	                        					<div class="adminGalleryLoader__progress" id="0progress"></div> 
	                        					</div>
	                        					<iframe width="100%" id="video_frame_{{$video->id}}" style="height: 175px;" src="https://www.youtube.com/embed/{{$video->youtube_id}}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
	                        					<!-- <video width="320" height="240" controls="controls" preload="metadata" poster="">
  													<source src="{{ asset('vendors/'.$video->vendor_folder.'/'.$video->video.'#t=0.5') }}" >Your browser does not support the video tag.
  												</video> -->
  														     <!--                        <img class="app-gallery-choose adminGalleryItem__image" id="0_img" src="{{ asset('vendors/'.$video->vendor_folder.'/'.$video->video) }}" draggable="false"> -->
	                        				  </figure>
	                        				    <div class="adminGalleryItem__content" id="0_content">
	                        						<p class="adminGalleryItem__name" id="video_title_{{$video->id}}">{{ isset($video->title)?$video->title:''}}</p> 
	                        						@if($video->status=='Pending' || $video->status=='Rejected')
			                        					<small>{{ $video->status=='Pending'?'Pending Review':$video->status}}</small>
			                        				@endif
	                        						 </div>
	                        						<footer class="adminGalleryItem__footer" style="" id="{{ $video->id }}_footer">
	                        							<span class="edit-video">
	                        							<a class="app-va-videos-edit-anchor adminGalleryItem__edit open_modal" data-toggle="modal" data-target="#modal_{{$video->id}}" href="javascript:void(0)" title="Edit" draggable="false" data-video-edit-id="{{ $video->id }}" data-url="{{ url('/edit_video/'.$video->id) }}"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</a></span><button type="button" class="app-va-videos-delete-anchor app-gallery-delete-video adminGalleryItem__delete icon icon-trash" data-video-trash-id="{{ $video->id }}" data-delete_url="{{ url('/delete_video/'.$video->id) }}"></button></footer>
	                        					</div>
	                                        </div>
	                                        <!-- START MODAL -->
	                                      
											 <form method="post" name="edit_video_form" id="edit_video_form">
											 <input type="hidden" name="update_video_id" id="update_video_id">	
												{{ csrf_field() }}
								
											<div class="modal" tabindex="-1" role="dialog" id="modal_{{$video->id}}">
											<div class="modal-dialog" role="document">
											<div class="modal-content">
											<div class="alert alert-danger" style="display:none"></div>
											<div class="modal-header">

											<h5 class="modal-title">Edit Video</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											   <p class="modal-loader"></p>	
											</div>
											
											<div class="modal-body" style="display: none">
												<div class="row">
													<div class="form-group col-md-11">
													<label for="Name">Video Title:</label>
														<input type="text" class="form-control" name="title" id="vtitle_{{ $video->id }}">
													</div>
												</div>
												<div class="row">
													<div class="form-group col-md-11">
													<label for="Name">Video URL:</label>
														<input type="text" class="form-control" name="url" id="vurl_{{ $video->id }}">
													</div>
												</div>
																							
												<div class="row">
													<div class="form-group col-md-11">
														<label for="Goal Score">Video Description:</label>
														 <textarea  class="form-control description-x"  id="vdescription_{{ $video->id }}" name="vdescription" style="margin-top: 0px; margin-bottom: 0px; height: 104px;"></textarea>
														
													</div>
												</div>
											</div>
											<div class="modal-footer">
											
												<button  class="btnFlat btnFlat--primary btn-save-video" data-update_video_id="{{ $video->id }}" data-update_url="{{ url('/edit_video/'.$video->id) }}" >Save Changes</button>
												<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
										  </div>
										 </div>
									 	</div>
									  </div>
									</form>	
								
								<!-- END Form MODAL -->

								<!--  <script src="{{ asset('js/tinymce/tinymce.min.js') }}"></script>	

								<script>
								   tinymce.init({
								   	  menubar:false,
								      statusbar: false,
									  selector: 'textarea#vdescription',  //Change this value according to your HTML
									  auto_focus: 'element1',
									  width: "450",
									  height: "180",

									 setup : function(editor)  {
								                editor.on("change keyup", function(e){
								                    //console.log('saving');
								                    //tinyMCE.triggerSave(); // updates all instances
								                    editor.save(); // updates this instance's textarea
								                    $(editor.getElement()).trigger('change'); // for garlic to detect change
								                });
								      }
									});
								</script> -->

	                    	  </li>
	                    	 @endforeach 
	                       </ul>

	           
</div>
                     @endif  
                    </div>
	      </div>
	   </div>
	</div>
</section>
@include('includes.footer')
<script type="text/javascript">
        Dropzone.options.dropzone =
         {
         	dictDefaultMessage:'<a class="btnFlat btnFlat--primary" role="button" id="pickfiles" style="z-index: 1;border:none">Add Video</a>\
	               <small class="adminGalleryUpload__legal">Published content is required to meet My Health Squad&#39;s <a href="javascript:;" target="_blank">Terms of Use</a>.</small>',
            maxFilesize: 500,
            renameFile: function(file) {
                var dt = new Date();
                var time = dt.getTime();
               return time+file.name;
            },
            acceptedFiles: ".mp4,.flv,.mpeg,'.avi'",
            createImageThumbnails: false,
            addRemoveLinks: false,
            timeout: 8000,
            success: function(file, response) 
            {
                console.log(response);
                $(".app-global-progress-uploaded").show();
                $('.app-hide-alert').show();
                $('html, body').animate({ scrollTop: 10 }, 'slow');
                $(".alert_msg").html(response.message);
                setTimeout(function() {
	        		$('.app-hide-alert').slideUp();
	        		window.location='/videos';
	    		}	, 3000);
                this.removeFile(file);
            },
            error: function(file, response)
            {
              console.log(response);
              alert(response.message);	
               return false;
            }
};

$(document).ready(function() {	

 $(".app-va-videos-edit-anchor").click(function(e) {
            e.preventDefault();
            var id=$(this).data("video-edit-id");
             

            $(".modal-loader").html('Loading...');
            $.ajax({
                url: $(this).data('url'),
                type:'GET',
                data: {id:id,action:'EDIT_VIDEO'},
                dataType:'JSON',
   				contentType: false,
   				cache: false,
   				processData: false,
                success: function(data) {

                	console.log(data);

                    if($.isEmptyObject(data.error)) {
                    	
                    	setTimeout(function(){

                     	  $(".modal-body").show();
                     	  $(".modal-loader").html('');	
                    	  $("#update_video_id").val();
                    	  $("#vtitle_"+id).val(data.video.title);
                    	  $("#vurl_"+id).val(data.video.video);
                    	  $("textarea#vdescription_"+id).text(data.video.description);
                    	  
                    	 
                    	},200);
                    	

                    	   					
                        //alert(data.success);
                    }else{
                        printErrorMsg(data.error);
                    }
                }
            });


        });

 	//UPDPATE Video

        $(".btn-save-video").click(function(e) {
            e.preventDefault();
            var id =$(this).data("update_video_id");
            var form_data = new FormData();
        	
        	form_data.append('_token', '{{csrf_token()}}');
        	form_data.append('title',$("#vtitle_"+id).val());
         
         	form_data.append('description',$("#vdescription_"+id).val());
         	
         	form_data.append('id',id);
         	form_data.append('video',$('#vurl_'+id).val());
         	
            $.ajax({
                url: $(this).data("update_url"),
                type:'POST',
                data: form_data,
                dataType:'JSON',
   				contentType: false,
   				cache: false,
   				processData: false,
                success: function(data) {
                    if($.isEmptyObject(data.error)) {
                    	console.log(data);
                    	$(".app-global-progress-uploaded").show();
                    	$('.app-hide-alert').show();
                    	$('#video_frame_'+id).attr('src', 'https://www.youtube.com/embed/'+data.video.youtube_id);
                    	$('html, body').animate({ scrollTop: 10 }, 'slow');
                    	$(".alert_msg").html(data.message);
                    	
                    	$(".close").trigger("click");
                    	setTimeout(function() {
	        					$('.app-hide-alert').slideUp();
	        					$("#video_title_"+id).html(data.video.title);
	        					//window.location='/videos';
	    				}	, 3000);
	    						
                        //alert(data.success);
                    }else{
                        printErrorMsg(data.error);
                    }
                }
            });


        }); 


         //DELETE Video
	    $(".app-gallery-delete-video").click(function() {
	    	var video_trash_id=$(this).data("video-trash-id");
	    	if(confirm('Do you want to delete this video ?'))
	    	$.ajax({
                url: $(this).data('delete_url'),
                type:'GET',
                data: { id:video_trash_id },
                dataType:'JSON',
   				contentType: false,
   				cache: false,
   				processData: false,
                success: function(data) {
                    if($.isEmptyObject(data.error)) {
                    	$(".app-global-progress-uploaded").show();
                    	$('.app-hide-alert').show();
                    	$('html, body').animate({ scrollTop: 10 }, 'slow');
                    	$(".alert_msg").html(data.message);
                    	setTimeout(function() {
                    		$("#video_"+video_trash_id).remove();
	        				$('.app-hide-alert').slideUp();
	        				//window.location='/promociones';
	    				}	, 2000);
    			
                      
                    }
                }
            });


	    })


  }); 
</script>
@endsection