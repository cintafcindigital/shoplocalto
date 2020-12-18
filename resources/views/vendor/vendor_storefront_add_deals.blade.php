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
	      <div class="pure-u-5-7 deal_detail">
	      	<div class="alert alert-danger print-error-msg" style="display:none">
        					<ul></ul>
    				  </div>

           <div class="app-hide-alert" style="display: none;">
	            <div class="adminAlert adminAlert--success">
	              <p class="alert_msg"></p>
	            </div>
	         </div>				  
	         <h1 class="adminTitle">
	            Deals                <i class="icon icon-arrow-right mr10 ml10"></i>
	            Create new Deal                            
	         </h1>
	         <iframe name="lFileUpload" id="lFileUpload" class="dnone"></iframe>
	         <div class="adminBox">
	            <form class="pure-form" name="formPromocion" id="formPromocion"  method="post" enctype="multipart/form-data" >
	            		{{ csrf_field() }}
	               <input type="hidden" name="nfile">
	               <input type="hidden" name="tfile">
	               <input type="hidden" name="ficheros">
	               <input type="hidden" name="fotopromocion" value="">
	               <input type="hidden" name="granCuenta" value="0">
	               <div class="pure-g-r">
	                  <div class="pure-u-3-5">
	                     <div class="pr40">
	                        <label class="adminFormLabel" for="nombrePromocion">Deal name <span class="adminFormLabel__required">*</span></label>
	                        <input class="pure-u-1" type="text" name="deal_name" id="deal_name" value="">
	                        <div class="mt15">
	                           <div class="mt10 mb10">
	                              <label class="adminFormLabel" for="tipoPromocion">Type of deal <span class="adminFormLabel__required">*</span></label>
	                              <div class="select-fake pure-u-1">
	                                 <select class="pure-u-1" name="deal_type" id="deal_type" >
	                                    <option value="">-- Select --</option>
	                                    @if(isset($data['deal_types']))
	                                    	@foreach($data['deal_types'] as $type)
	                                    		<option value="{{$type->id}}"> {{$type->name}} </option>
	                                    	@endforeach
	                                    @endif	
	                                   	                                    
	                                 </select>
	                              </div>
	                           </div>
	                           <label class="adminFormLabel">Valid Until</label>
	                           <div id="divSolicFecha2" class="input-append date app-common-datepicker">
	                              <input class="pure-u-1"  value="" type="text" name="expiry_date" id="expiry_date" placeholder="dd/mm/yyyy" data-date-weekstart="1" data-date-format="dd/mm/yyyy" autocomplete="off">
	                              <span class="add-on"></span>
	                           </div>
	                        </div>
	                        <div id="divUrlDesc" class="pure-g mt10">
	                           <div id="divUrl" class="dnone pure-u-1" style="display: none;">
	                              <label class="adminFormLabel" for="urlPromocion">Promotion link</label>
	                              <input class="pure-u-1" type="text" name="urlPromocion" id="urlPromocion" value="">
	                           </div>
	                           <div id="divDescuento" class="dnone pure-u-1" style="display: none;">
	                              <label class="adminFormLabel">Discount <span class="adminFormLabel__required">*</span></label>
	                              <input type="number" id="discount" name="discount" class="pure-u-1" placeholder="50" min="1" max="99" value="" disabled="">
	                           </div>
	                        </div>
	                        <div class="mt10">
	                           <div class="mb15">
	                              <label class="adminFormLabel" for="textoPromocion">Deal description<br>Include percent discounted, promotion, or offer details <span class="adminFormLabel__required">*</span></label>
	                           </div>
	                           <textarea class="description" id="description" name="description"></textarea>
	                          
	                        </div>
	                     </div>
	                  </div>
	                  <div class="pure-u-2-5">
	                     <label class="adminFormLabel" for="dImagen1">Image</label>
	                     <div id="dImagen1" class="adminFormUpload mt10">
	                        <i class="adminFormUpload__icon"></i>
	                        <div class="adminFormUpload__button">
	                           <label for="Imagen1" class="btnOutline btnOutline--primary">Add Image</label>
	                           <input id="Imagen1" class="app-promociones-upload" type="file" name="Imagen1" data-idtipo="1">
	                           <img id="deal_img"  alt="" width="150" height="150" />
	                           <p class="alert_delete_msg"></p>
	                        </div>
	                     </div>
	                     <div class="mt10">
	                        <small class="color-grey">*Collages, photos with watermarks, contact details and illustrations cannot be published</small>
	                     </div>
	                  </div>
	               </div>
	               <div class="mt20">
	                  <input class="btnFlat btnFlat--primary post_deal_Btn" type="submit" value="Post Deal">
	               </div>
	            </form>
	         </div>
	      </div>
	   </div>
	</div>
</section>
@include('includes.footer')

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
	$(document).ready(function() {

		$("#expiry_date").datepicker({

			dateFormat: 'dd/mm/yy',
			minDate: new Date(),
			autoclose: true,
        	orientation: "top"
        	
		});
		$('.add-on').click(function() {
			$("#expiry_date").focus();
		});

        $(".post_deal_Btn").click(function(e) {
            e.preventDefault();

            var form_data = new FormData();
        	form_data.append('image', Imagen1.files[0]);
        	form_data.append('_token', $("input[name='_token']").val());
        	form_data.append('deal_name',$("input[name='deal_name']").val());
         	form_data.append('deal_type',$("select[name='deal_type']").val());
         	form_data.append('description',$("textarea[name='description']").val());
         	form_data.append('expiry_date',$("input[name='expiry_date']").val());
            $.ajax({
                url: "/promocionesnew",
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
	        				window.location='/promociones';
	    				}	, 3000);

	    					
                        //alert(data.success);
                    }else{
                        printErrorMsg(data.error);
                    }
                }
            });


        }); 

        $("#Imagen1").change(function() {

			 var ext = $('#Imagen1').val().split('.').pop().toLowerCase();
			if($.inArray(ext, ['gif','png','jpg','jpeg']) == -1) {
				$(".update_deal_btn").attr("disabled",true);
			    $(".alert_delete_msg").html('File must be an image (jpg,png,bpm or gif)').css("color","red");
			    return false;
			}else{
				 $(".alert_delete_msg").hide();
				 previewImage(this);
			}
        				
        });


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
            	$('#deal_img').attr('src',"{{ asset('images/loading.gif') }}").height(50).width(50);
            	
            	setTimeout(function(){
            		    //$("#remove_img").hide();
                		$('#deal_img').attr('src', e.target.result).height(150).width(250);
                },1000);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
      }

</script>
<script src="{{ asset('js/tinymce/tinymce.min.js') }}"></script>
<script>
   tinymce.init({
   	  branding: false,
   	  menubar:false,
      statusbar: false,
	  selector: 'textarea#description',  //Change this value according to your HTML
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
	});
</script>
<!-- <script src="https://cdn.tiny.cloud/1/08cq8y02kwr759p88hfbo9ym579ceup2a7x2vebx42n6ceee/tinymce/5/tinymce.min.js"></script>
<script>
    tinymce.init({
        selector:'textarea.description',
        menubar:false,
        statusbar: false,
        width: 480,
        height: 300
    });
</script> -->


@endsection