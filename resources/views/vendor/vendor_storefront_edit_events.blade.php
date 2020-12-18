@extends('layouts.default')
@section('meta_title',$data['titleData']->meta_title)
@section('meta_keyword',$data['titleData']->meta_keyword)
@section('meta_description',$data['titleData']->meta_description)
@section('content')
@include('includes.menu')
@php
function get_time($selected_time='') {
	$time_array[] = "00:00"; // Adds the last line to the end of the array
	$hour = 0; 
	$min = 00; // Lets start at "00:30" 
	$length = 24 * 2; // The number of times we need to run the loop 
	$option=$time=$selected='';
	for ($i=0;$i<$length;++$i) {
		$time = str_pad($hour, 2, "0", STR_PAD_LEFT) .':'. str_pad($min, 2, "0", STR_PAD_LEFT);
		$selected=!empty($selected_time) && $selected_time==$time?'selected':'';
		$option.='<option value='.$time.' '.$selected.'>'. $time.'</option>';
		if ($min < 30) { $min = $min + 30; } else { $min = 0; ++$hour; } 
	}
	return $option;
}
@endphp
<section class="section-padding dashboard-wrap storefront_main_sect dash_main_sect">
   @include('vendor.tools_nav')
   <div class="wrapper">
	   <div class="pure-g">
	     	@include('vendor.nav_links')<!-- left navigation -->
	      <div class="pure-u-5-7 add_event_page">
	      	<div class="alert alert-danger print-error-msg" style="display:none">
	      		<ul></ul>
	      	</div>

            <div class="app-hide-alert" style="display: none;">
	            <div class="adminAlert adminAlert--success">
	              <p class="alert_msg"></p>
	            </div>
	        </div>	
	         <h1 class="adminTitle">Events <i class="icon icon-arrow-right ml10 mr10"></i>Edit</h1>
	         <iframe name="lFileUpload" id="lFileUpload" class="dnone"></iframe>
	         <form class="pure-form mb20 add_new_event_frm" id="formEvent" name="formEvent"  method="post" enctype="multipart/form-data">
	         	{{ csrf_field() }}
	            <input type="hidden" name="Pais" value="32">
	            <input type="hidden" name="nfile">
	            <input type="hidden" name="tfile">
	            <input type="hidden" name="ficheros">
	            <input type="hidden" name="fotoevento" value="">
	            <div class="adminBox">
	               <div class="pure-g">
	                  <div class="pure-u-3-5">
	                     <div class="pr20">
	                        <label class="adminFormLabel" for="nombreEvento">Event Name <span class="adminFormLabel__required">*</span></label>
	                        <input class="pure-u-1" type="text" value=" {{ isset($data['vendor_event']->event_name)?$data['vendor_event']->event_name:''}}" name="event_name" id="event_name" maxlength="100">
	                     </div>
	                  </div>
	                  <div class="pure-u-2-5">
	                     <label class="adminFormLabel" for="tipoEvento">Type of Event <span class="adminFormLabel__required">*</span></label>
	                     <div class="select-fake mt5">
	                        <select class="pure-u-1" name="event_type" id="event_type">
	                           <option value="">-- Select --</option>
	                           @if(count($event_types)>0)
	                            @foreach($event_types as $type)
	                            	<option value="{{ $type->id }}" {{ isset($data['vendor_event']->event_type_id) && $data['vendor_event']->event_type_id==$type->id?'selected':'' }}>{{ $type->name }}</option>
	                            @endforeach
	                           @endif
	                        </select>
	                     </div>
	                  </div>
	               </div>
	               <hr class="mt20 mb20">
	               <div class="pure-g">
	                  <div class="pure-u event_input">
	                     <div class="pr20">
	                        <label class="adminFormLabel" for="SolicFecha">Start Date <span class="adminFormLabel__required">*</span></label>
	                        <div class="mt10 input-append date app-common-datepicker">
	                           <input id="event_start_date" name="event_start_date" type="text" placeholder="dd/mm/yyyy" data-date-weekstart="1" data-date-format="dd/mm/yyyy" readonly="" value="{{ isset($data['vendor_event']->event_start_date) && $data['vendor_event']->event_start_date!='0000-00-00'?date('d/m/Y',strtotime($data['vendor_event']->event_start_date)):'' }}">
	                           <span class="add-on" id="add-on-start"></span>
	                        </div>
	                     </div>
	                  </div>
	                  <div class="pure-u event_all_input">
	                     <!-- <div class="pr20"> -->
	                        <label class="adminFormLabel" for="horaInicio">at... <span class="adminFormLabel__required">*</span></label>
	                        <div class="select-fake mt5 mr5">
	                           <select name="event_start_time" id="event_start_time">
	                              <option value="">- Start Time -</option>
	                                {!!  get_time($data['vendor_event']->event_start_time) !!}
	                             
	                           </select>
	                        </div>
	                     <!-- </div> -->
	                  </div>
	                  <div class="pure-u event_input">
	                     <div class="pr20">
	                        <label class="adminFormLabel" for="SolicFecha2">End Date <span class="adminFormLabel__required">*</span></label>
	                        <div class="mt10 input-append date app-common-datepicker">
	                           <input id="event_end_date" name="event_end_date" type="text" placeholder="dd/mm/yyyy" data-date-weekstart="1" data-date-format="dd/mm/yyyy" readonly="" value="{{ isset($data['vendor_event']->event_end_date) && $data['vendor_event']->event_end_date!='0000-00-00'?date('d/m/Y',strtotime($data['vendor_event']->event_end_date)):'' }}">
	                           <span class="add-on" id="add-on-end"></span>
	                        </div>
	                     </div>
	                  </div>
	                  <div class="pure-u event_all_input">
	                     <label class="adminFormLabel" for="horaFin">at... <span class="adminFormLabel__required">*</span></label>
	                     <div class="select-fake mt5">
	                        <select name="event_end_time" id="event_end_time">
	                           <option value="">- End Time -</option>
	                            {!!  get_time($data['vendor_event']->event_end_time) !!}
	                        </select>
	                     </div>
	                  </div>
	               </div>
	            </div>
	            <div class="adminBox">
	               <div class="pure-g-r">
	                  <div class="pure-u-3-5">
	                     <div class="pr40">
	                       <!--  <div class="pure-control-group">
	                           <label class="adminFormLabel" for="txtStrPoblacion">City</label>
	                           <div class="drop-wrapper">
	                              <input type="hidden" class="app-suggest-provincia-id-default" name="Provincia" value="2052">
	                              <input type="hidden" class="app-suggest-poblacion-id-default" name="Poblacion" value="1315499">
	                              <input id="event_city" name="event_city" class="pure-u-1" type="text" autocomplete="off" data-suffix="default" value="Toronto, Ontario">
	                              <div class="app-suggest-poblacion-div-default droplayer droplayer-scroll dnone"></div>
	                           </div>
	                        </div> -->

	                        <div class="pure-control-group">
				                     <label for="txtStrPoblacion" class="adminFormLabel">City </label>
				                     <div class="drop-wrapper">
				                        <input type="hidden" class="app-suggest-poblacion-id-default" name="city_id" id="city_id">
				                        <input id="city" name="city" class="pure-u-1 autocomplete_txt" type="text" value="{{ isset($data['vendor_event']->city)?$data['vendor_event']->city.', '.$data['vendor_event']->state:'' }}">
				                        <div class="app-suggest-poblacion-div-default droplayer droplayer-scroll dnone"></div>
				                     </div>
				                  </div>
	                        <label class="adminFormLabel" for="Direccion">Address</label>
	                        <input class="pure-u-1" type="text" name="event_address" id="event_address" value="{{ isset($data['vendor_event']->address)?$data['vendor_event']->address:'' }}" onchange="updateLatLong();">
	                        <div class="mt20">
	                           <a role="button" class="btnOutline btnOutline--primary m0 app-icon-hover update_map_btn" data-icon-old="icon-refresh-active" data-icon-new="icon-refresh-white">
	                           <i class="icon icon-refresh-active icon-left"></i>Update Map</a>
	                        </div>
	                     </div>
	                  </div>
	                  <div class="pure-u-2-5">
	                     <input type="hidden" name="latitude" id="latitude" value="43.7223">
	                     <input type="hidden" name="longitude" id="longitude" value="-79.4674">
	                     	<div id="gmap" class="mt10 pure-u-1" style="height: 180px;">
	                        
	                       </div>
	                  </div>
	               </div>
	            </div>
	            <div class="adminBox">
	               <div class="pure-g">
	                  <div class="pure-u-3-5">
	                     <div class="pr40">
	                        <div class="mb15">
	                           <label class="adminFormLabel" for="textoEvento">Event Description <span class="adminFormLabel__required">*</span></label>
	                        </div>
	                       
	                        <textarea id="event_description" name="event_description" class="description" >{{ isset($data['vendor_event']->description)?$data['vendor_event']->description:'' }}</textarea>
	                     </div>
	                  </div>
	                  <div class="pure-u-2-5">
	                     <label class="adminFormLabel" for="dImagen1">Image</label>
	                    
	                      <div id="dImagen1" class="adminFormUpload mt20">
	                        <i class="adminFormUpload__icon"></i>
	                        <div class="adminFormUpload__button">
	                           <label for="Imagen1" class="btnOutline btnOutline--primary">Add Image</label>
	                           <input id="Imagen1" class="app-promociones-upload" type="file" name="Imagen1" data-idtipo="1">
	                                               
	                           @if(public_path('/vendors/VENDOR_'.$data['vendor_event']->vendor_id.'/'.$data['vendor_event']->image) && $data['vendor_event']->image!='')
	                             <img id="event_img" src="{{ asset('/vendors/VENDOR_'.$data['vendor_event']->vendor_id.'/'.$data['vendor_event']->image)}}" alt="{{$data['vendor_event']->event_name}}" width="250" height="150" />
	                             <a href="javascript:void(0)" data-event_img_remove_id="{{ $data['vendor_event']->id }}" class="remove_event_img">Remove</a>
	                           @else
	                           	   <img id="event_img"  alt="" width="150" height="150" style="display: none"  />
	                           	   <a id="remove_img" style="display: none;cursor: pointer;">Remove</a>
	                           @endif 

	                            <p class="alert_delete_msg"></p>
	                        </div>
	                     </div>
	                  </div>
	                  <div class="pure-u-1 mt20">
	                     <input type="submit" class="btnFlat btnFlat--primary update_event_btn" value="Save Event">
	                     <input class="btnOutline btnOutline--primary app-eventos-delete" type="button" data-event_remove_id="{{ $data['vendor_event']->id }}" value="Remove Event">
	                  </div>
	               </div>
	               <div class="mt10 form-image-legend">
	                  *Collages, photos with watermarks, contact details and illustrations cannot be published                    
	               </div>
	            </div>
	         </form>
	      </div>
	   </div>
	</div>
</section>
@include('includes.footer')
<script type="text/javascript">
	$(document).ready(function(){
		$('.update_map_btn').hover(function(){
			$(this).find('i').toggleClass('icon-refresh-active');
			$(this).find('i').toggleClass('icon-refresh-white')
		});

		$(".post_event_btn-x").click(function(){
			var x = document.forms["formEventos"]["nombreEvento"].value;
				if (x == "") {
				    alert('You must name the Event');
				    $(this).parents('form').find('#nombreEvento').focus();
				}
		});
	});
</script>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key={{env('GMAP_API_KEY')}}"></script>
<script type="text/javascript">
	$(document).ready(function() {

		$("#event_start_date").datepicker({

			dateFormat: 'dd/mm/yy',
			minDate: new Date(),
			autoclose: true,
        	orientation: "top",
        	onSelect: function (selected) {
	           $("#event_end_date").datepicker("option","minDate", selected)

        	}
        	
		});

		$("#event_end_date").datepicker({

			dateFormat: 'dd/mm/yy',
			minDate: new Date(),
			autoclose: true,
        	orientation: "top"
        	
		});
		$('#add-on-start').click(function() {
			$("#event_start_date").focus();
		});
		$('#add-on-end').click(function() {
			$("#event_end_date").focus();
		});

        $(".update_event_btn").click(function(e) {
            e.preventDefault();
            var form_data = new FormData();
        	form_data.append('_token', $("input[name='_token']").val());
        	form_data.append('event_name',$("input[name='event_name']").val());
         	form_data.append('event_type',$("select[name='event_type']").val());
         	form_data.append('event_description',$("textarea[name='event_description']").val());
         	form_data.append('event_start_date',$("input[name='event_start_date']").val());
         	form_data.append('event_start_time',$("select[name='event_start_time']").val());
         	form_data.append('event_end_date',$("input[name='event_end_date']").val());
         	form_data.append('event_end_time',$("select[name='event_end_time']").val());
         	form_data.append('event_address',$("input[name='event_address']").val());
         	form_data.append('event_city',$("input[name='city_id']").val());
         	form_data.append('image', Imagen1.files[0]);
            $.ajax({
                url: "/eventsedit/{{$data['vendor_event']->id}}",
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
	        				window.location='/events';
	    				}, 2000);
                        //alert(data.success);
                    } else {
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


        $( ".autocomplete_txt" ).autocomplete({
 		
        source: function(request, response) {
            $.ajax({
            url: "/autocomplete_ajax",
            data: {
                    term : request.term
             },
            dataType: "json",
            success: function(data){
               var resp = $.map(data,function(obj){
                    console.log('obj:',obj);
                    return {
                           label: obj.city+', '+obj.state,
                           value: obj.city+', '+obj.state,
                           data : obj
                       }
               }); 
 
               response(resp);
            }
        });
    },
    minLength: 2,
    select: function( event, ui ) {
    	    var action=$(this).data('action');
    	    var cityid=$(this).attr('id');

    	    console.log(action+':'+cityid);
    	    // setTimeout(function() {
    	       console.log('data',ui.item.data);
    	    if(action=='update'){
    	       	$('#'+cityid).val(ui.item.data.label);
                $('#update_city_id_'+ui.item.data.id).val(ui.item.data.id);
    	    }else{
              $('#city').val(ui.item.data.label);
              $('#city_id').val(ui.item.data.id);
              setTimeout(function(){ updateLatLong(); },1000);
          	}

    	   //  },500);
          	            
          }
 });

    setTimeout(function(){ 
	  		$(".update_map_btn").trigger("click");

	    },200);    

    $(".update_map_btn").click(function(){
    
		setTimeout(function() {
		    		initialize($("#latitude").val(),$("#longitude").val(),$("#event_address").val()+', '+$("#city").val());
		   	}, 500);

	   	});

    
    $("#remove_img").click(function(){

    	 $('#event_img').hide().attr('src', '');
    	 $('#remove_img').hide();
    	 $('input#Imagen1').val('');

    });


    //REMOVE IMAGE
	    $(".remove_event_img").click(function() {
	    	var remove_img_id=$(this).data("event_img_remove_id");
	    	$.ajax({
                url: "/event_remove_img/{{ $data['vendor_event']->id }}",
                type:'GET',
                data: { id:remove_img_id },
                dataType:'JSON',
   				contentType: false,
   				cache: false,
   				processData: false,
                success: function(data) {
                    if($.isEmptyObject(data.error)) {

                    	$('.alert_delete_msg').show();
                    	//$('html, body').animate({ scrollTop: 10 }, 'slow');
                    	$(".alert_delete_msg").html(data.message);
                    	$("#event_img").attr('src','').hide();
                    	$(".remove_event_img").hide();
                    	setTimeout(function() {
	        				$('.alert_delete_msg').slideUp();
	        				//window.location='/promociones';
	    				}	, 2000);

	    					
                        //alert(data.success);
                    }
                }
            });


	    });

	    //DELETE EVENT
	    $(".app-eventos-delete").click(function() {
	    	$.ajax({
                url: "/event_delete/{{ $data['vendor_event']->id }}",
                type:'GET',
                data: '',
                success: function(data) {
                    if($.isEmptyObject(data.error)) {
                    	$('.app-hide-alert').show();
                    	$('html, body').animate({ scrollTop: 10 }, 'slow');
                    	$(".alert_msg").html(data.message);
                    	setTimeout(function() {
	        				//$('.app-hide-alert').slideUp();
	        				window.location='/events';
	    				}	, 2000);
                    }
                }
            });


	    })

	});//end reday function	

	function updateLatLong()
	{
		var city = $('#city').val();
		var address = $('#event_address').val();
		$.ajax({
			url: "/autocomplete_latlong",
			method: 'GET',
			data: 'city='+city+'&address='+address,
			dataType: "json",
			success: function(data) {
				if(data[0] && data[1] && data[1]) {
					$("#latitude").val(data[0]);
					$("#longitude").val(data[1]);
					initialize(data[0],data[1],data[2]);
				}
			}
		});
	}
  function removePreview() {
  	    

  }

    function initialize(lat,lng,address) {
      // alert(id+' '+lat+ ' '+lng+' '+address);
        var mapOptions = {
            center: new google.maps.LatLng(parseFloat(lat),parseFloat(lng)),
            zoom: 8
        };

        var map = new google.maps.Map(document.getElementById("gmap"), mapOptions);
        
        var infowindow = new google.maps.InfoWindow({
	     content: address
	    });

		var marker = new google.maps.Marker({
			position: new google.maps.LatLng(parseFloat(lat), parseFloat(lng)),
			map: map,
			title: ''
		});

		marker.addListener('click', function() {
			infowindow.open(map, marker);
		});
    }

		
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

            	$('#event_img').show().attr('src',"{{ asset('images/loading.gif') }}").height(50).width(50);
            	
            	setTimeout(function(){
            		    $("#remove_img").show();

                		$('#event_img').show().attr('src', e.target.result).height(150).width(250);
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
	  selector: 'textarea#event_description',  //Change this value according to your HTML
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
@endsection