@extends('layouts.default')
@section('meta_title',$data['titleData']->meta_title)
@section('meta_keyword',$data['titleData']->meta_keyword)
@section('meta_description',$data['titleData']->meta_description)
@section('content')
@include('includes.menu')
<section class="section-padding dashboard-wrap message_main_wrp dash_main_sect">
    @include('vendor.tools_nav')
    <div class="wrapper">
	   <div class="pure-g">
	      <div class="pure-u-1-5">
	      		@include('includes.messagesidebar')
	      </div>
	      <div class="pure-u-4-5 msg_templates_wrp">
	         <h1 class="adminTitle">Templates</h1>
	         <div class="adminAlert">
	            <p><span>Create and edit message templates to quickly and easily reply to couples. </span></p>
	         </div>
     		@if (\Session::has('success'))
                <div class="app-hide-alert">
                    <div class="adminAlert adminAlert--success">
                        <p>{!! \Session::get('success') !!}</p>
                    </div>
                </div>
            @endif
            @if (\Session::has('error'))
                <div class="app-hide-alert">
                    <div class="adminAlert adminAlert--error">
                        <p>{!! \Session::get('error') !!}</p>
                    </div>
                </div>
            @endif
	         <ul class="admin-sol-template">
	         	@foreach( $data['alltemplates'] as $templates )
		            <li class="admin-sol-template-item">
		               <div class="admin-sol-template-item-content app-plantillas-parent" id="26193">

		               		@if(count($templates['reply_images']) > 0) 
		                  		<i class="icon-vendor icon-vendor-clip mr10"></i>
		                  	@else
		                  		<i class="icon-vendor icon-vendor-document mr10"></i>
		                  	@endif

		                  <div class="admin-sol-template-item-info">
		                     <a class="admin-sol-template-item-link app-plantillas-edit" title="Edit" data-idplantilla="26193" href="javascript:;">{{ $templates['template_name'] }}</a>
		                     <time class="admin-sol-template-item-date">{{ date('d/m/Y', strtotime($templates['updated_at'])) }}</time>
		                  </div>

		                  <a class="admin-sol-template-item-edit btnOutline btnOutline--primary app-plantillas-edit mt0 templ_edit_btn" onclick="getTemplate({{ $templates['id'] }})" href="javascript:;">Edit</a>
		               </div>

		               	<div id="templateid{{$templates['id']}}" class="app-plantillas-content admin-sol-template-item-form dnone template_edit_content" style="display: none;">
						</div>
		            </li>
		        @endforeach
	         </ul>

	         <button class="btnFlat btnFlat--primary app-plantillas-new add_msg_temp">Add template</button>

	         <div class="mt20 msg_template_frm" id="app-plantillas-new" style="display: none;">
			   	<div class="adminBox">
				    <form class="pure-form" name="templateForm" id="templateForm" action="{{ url('messages-templates') }}" method="post" enctype="multipart/form-data">
					      	{{ csrf_field() }}

					      	<div class="hidenfilesarray" style="display: none;"></div>

					        <input type="hidden" name="vender_id" value="{{ $data['vendorData'][0]['vendor_id'] }}" />

					        <div class="mb15 pure-control-group">
					            <label class="adminFormLabel">Template Name</label>
					            <input size="45" type="text" name="template_name" id="template_name" value="">
					        </div>

					        <div class="mb15 pure-control-group">
					            <label class="adminFormLabel">Subject</label>
					            <input size="45" type="text" name="template_subject" id="template_subject" value="">
					        </div>

					        <div class="mb15 pure-control-group">
						        <label class="adminFormLabel">Text</label>
						        <div style="border: 1px solid #ccc">
						        	<textarea class="mt5" rows="10" name="templatemesage" id="templatemesage" aria-hidden="true"></textarea>
						        </div>
						    </div>

					        <div id="ficheroSubido" class="mt10 mb10">
					        
					        </div>

				         	<div class="pure-control-group">
					            <div id="ficheroAdjunto" class="adminFormFile icon icon-clip">
					               <label for="ficheroAdjunto">Attach files</label>
					               <input name="templatefiles" id="templatefiles" type="file" onchange="templateFileupload(this)">
					            </div>
				         	</div>

							<input class="btnFlat btnFlat--primary mr10 add_templ" type="submit" value="Add template" onclick="return addmessageTemplate();">
							<input class="btnFlat btnFlat--grey app-plantillas-cancelar cancel_templ" type="button" value="Cancel">

				    </form>
			   	</div> 
			</div> <!-- end of msg_template_frm-->
	      </div>
	   </div>
	</div>
</section>
@include('vendor.ExportLeads.exportleads_popup')
@include('includes.footer')
<script src="https://cdn.tiny.cloud/1/08cq8y02kwr759p88hfbo9ym579ceup2a7x2vebx42n6ceee/tinymce/5/tinymce.min.js"></script>
<script type="text/javascript">

	// Add New Message Template 

		function addmessageTemplate() {
			var x = document.forms["templateForm"]["template_name"].value;
			var y = document.forms["templateForm"]["template_subject"].value;
			if (x == "") {
			    alert("Add a Name for the template");
			    $(this).parents('form').find('#template_name').focus();
			    return false;
			} else if (y == "") {
			    alert("Add a Subject for the template");
			    $(this).parents('form').find('#template_subject').focus();
			    return false;
			} else {
				return true
			}
		}

	// Upload Template file

		function templateFileupload(e) {
			var fileobj = e.files[0];
	        var formData = new FormData();
	        formData.append("fileobj", fileobj);
	        formData.append("checker", 1);

	        console.log(e.files[0].name);
	        $.ajax({
	            type:'POST',
	            url: "{{ url('reply-fileupload') }}",
	            data:formData,
	            cache:false,
	            contentType: false,
	            processData: false,
	            success:function(data){
	                var data = JSON.parse(data);
	                if(data.html != 'yes') {
	                    $('.hidenfilesarray').append('<input id="'+data.id+'" type="hidden" name="inputFiles[]" value="'+data.fileid+'" />');
	                    $('#ficheroSubido').append(data.html);
	                }
	            },
	            error: function(data){
	                console.log("error");
	                console.log(data);
	            }
	        });
		}

	// Get Message template for edit

		function getTemplate(templateid) {
			//alert(templateid);
			$('#app-plantillas-new').hide();
			$('.add_msg_temp').attr('disabled','false');

			$.ajax({
	            type:'GET',
	            url: "{{ url('getmessage-templates') }}/"+templateid,
	            success:function(data){
	                var data = JSON.parse(data);

	                $('.app-plantillas-content').hide();
	                $('.app-plantillas-content').html('');
	                $('#templateid'+data.templatedata[0].id).html(data.html);
	                //alert($('#templateid'+data.templatedata[0].id).find('#templatemesageupdate'));
	                tinymce.remove(); 
	                tinymce.init({
				        selector:'#templatemesageupdate',
				        width: 870,
				        height: 300
				    });

	                tinymce.get("templatemesageupdate").setContent(data.templatedata[0].template_message);
	                $('#templateid'+data.templatedata[0].id).slideDown();
	            },
	            error: function(data){
	                console.log("error");
	                console.log(data);
	            }
	        });

		}

	// Update Message Template

		function updatemessageTemplate() {

			var x = document.forms["templateFormupdate"]["template_nameupdate"].value;
			var y = document.forms["templateFormupdate"]["template_subjectupdate"].value;
			if (x == "") {
			    alert("Add a Name for the template");
			    $(this).parents('form').find('#template_nameupdate').focus();
			    return false;
			} else if (y == "") {
			    alert("Add a Subject for the template");
			    $(this).parents('form').find('#template_subjectupdate').focus();
			    return false;
			} else {
				return true
			}

		}

	// Delete message Template 

		function deletemessageTemplate(templateid) {
			//alert(templateid);
			if(confirm("Are you sure!")) {
				window.location.href = "{{ url('delete-messages-templates') }}/"+templateid;
			}	
		}


	$(document).ready(function(){

		tinymce.init({
	        selector:'#templatemesage',
	        width: 870,
	        height: 300
	    });

		$('.add_msg_temp').click(function(){
			$('.msg_template_frm').show();
			$(this).attr('disabled','true');
		});

		$(".cancel_templ").click(function(){
			$('.msg_template_frm').hide();
			$('.add_msg_temp').attr('disabled','false');
		});

		$('.save_change_btn').click(function(){
			$('.template_edit_content').hide();
			$('.success_msg').slideDown(1000);
		});

		// Remove image from upload
            $('body').on('click', '.inbox-message-link__remove', function() {
                var removeid = $(this).attr('data-remove');
                //alert(removeid);
                $('body .hidenfilesarray').find('#'+removeid).remove();
                $(this).parents('.admin-sol-template-tag').remove();
            });

        // Cencle update template window
        	$('body').on('click', '.update_cancel_templ', function() {
        		$(this).parents('.template_edit_content').hide(500, function() {
        			$('.template_edit_content').html('');
        		});

        	});


	});
	setTimeout(function() {
        $('.success_msg').slideUp();
    }, 4000);
</script>
@endsection       