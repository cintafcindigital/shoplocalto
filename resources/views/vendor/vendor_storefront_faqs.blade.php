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
	      <div class="pure-u-5-7 faqs_frm_wrp" id="faqs_frm_wrp">
	         <div class="pure-g mb10">
	            <div class="pure-u-2-3">
	               <h1 class="adminTitle">Frequently Asked Questions</h1>
	            </div>
	         </div>
	         <div class="adminAlert adminAlert--flex storefront_alert">
	            <i class="icon-vendors-admin-alerts icon-vendors-admin-alerts-pencilNote"></i>
	            <div>
	               <p class="adminAlert__title">Please provide details about your Wedding Flowers services.</p>
	               <p>Add answers to frequently asked questions about your business to give couples a better understanding of your offering before deciding whether to contact you.</p>
	            </div>
	         </div>
	         <div class="app-hide-alert faq_succ_msg" style="display: none;">
		         <div class="adminAlert adminAlert--success">
		            <p class="alert_msg"></p>
		        	</div>
		    	</div>
	         <form class="pure-form mb20" method="post"  name="formFaq" id="formFaq">
	         	 {{csrf_field()}}
	            <input type="hidden" name="idSector" id="idSector" value="15">
	            <input type="hidden" name="precioMinOld" value="">
	            <input type="hidden" name="invitadosMaxOld" value="0">
	            <div class="adminFaqs">
	               <header class="adminFaqs__header ">
	                  <p class="adminFaqs__title">
	                     <span class="adminFaqs__counter">1.</span>
	                     How would you describe the style of your floral designs? <i class="adminFaqs__tag icon-vendor icon-vendor-form-check"></i>
	                  </p>
	               </header>
	               <div class="adminFaqs__content">
	                  <ul class="pure-g-r">
	                  	<input type="hidden" name="faqs[]" value="1">
	                  	@foreach($data['floral_designs'] as $fd)
	                  		 <li class="pure-u-1-3 mb10">
	                          <label class="block">
	                           <div class="icheckbox_minimal @if(count(@$faq_ans_arr) > 0) @php echo in_array($fd->id,@$faq_ans_arr['fd_arr'][0])?'checked':'' @endphp @endif" style="position: relative;"><input type="checkbox" name="faqs[1][]" value="{{$fd->id}}" @if(count(@$faq_ans_arr) > 0) @php echo isset($faq_ans_arr['fd_arr'][0]) && in_array($fd->id,@$faq_ans_arr['fd_arr'][0])?'checked':'' @endphp @endif><ins class="iCheck-helper" ></ins></div>
	                           <span class="pure-u-5-6">{{$fd->name}}</span>
	                        </label>
	                     </li>
	                  	@endforeach
	                  </ul>
	               </div>
	            </div>
	            <div class="adminFaqs">
	               <header class="adminFaqs__header ">
	                  <p class="adminFaqs__title">
	                     <span class="adminFaqs__counter">2.</span>
	                     Which of the following services do you provide?  <i class="adminFaqs__tag icon-vendor icon-vendor-form-check"></i>
	                  </p>
	               </header>
	               <div class="adminFaqs__content">
	                  <ul class="pure-g-r">
	                  	<input type="hidden" name="faqs[]" value="2">
	                  	@foreach($data['floral_services'] as $fs)
	                  		<li class="pure-u-1-3 mb10">
	                        <label class="block">
	                           <div class="icheckbox_minimal" style="position: relative;"><input type="checkbox" name="faqs[2][]" value="{{$fs->id}}" @if(count(@$faq_ans_arr) > 0) @php echo isset($faq_ans_arr['fs_arr'][0]) && in_array($fs->id,@$faq_ans_arr['fs_arr'][0])?'checked':'' @endphp @endif><ins class="iCheck-helper" ></ins></div>
	                           <span class="pure-u-5-6">{{$fs->name}}</span>
	                        </label>
	                     </li>
	                  	@endforeach
	                  </ul>
	               </div>
	            </div>
	            <div class="adminFaqs">
	               <header class="adminFaqs__header ">
	                  <p class="adminFaqs__title">
	                     <span class="adminFaqs__counter">3.</span>
	                     What types of arrangements do you provide? <i class="adminFaqs__tag icon-vendor icon-vendor-form-check"></i>
	                  </p>
	               </header>
	               <div class="adminFaqs__content">
	                  <ul class="pure-g-r">
	                     <input type="hidden" name="faqs[]" value="3">
	                     @foreach($data['type_arrangements'] as $ta)
	                     <li class="pure-u-1-3 mb10">
	                        <label class="block">
	                           <div class="icheckbox_minimal " style="position: relative;"><input type="checkbox" name="faqs[3][]" value="{{$ta->id}}" @if(count(@$faq_ans_arr) > 0) @php echo in_array($ta->id,@$faq_ans_arr['ta_arr'][0])?'checked':'' @endphp @endif><ins class="iCheck-helper" ></ins></div>
	                           <span class="pure-u-5-6">{{$ta->name}}</span>
	                        </label>
	                     </li>
	                     @endforeach
	                  </ul>
	               </div>
	            </div>
	            <div class="adminFaqs">
	               <header class="adminFaqs__header ">
	                  <p class="adminFaqs__title">
	                     <span class="adminFaqs__counter">4.</span>
	                     What is the average price for a bridal bouquet? <span id="question_4">
	                     	@php 
	                     	if(@$faq_ans_arr['price_bridal'][0])
	                     		echo '<i class="adminFaqs__tag icon-vendor icon-vendor-form-check"></i>';
	                     	else
	                     		echo '<span class="adminFaqs__tag adminFaqs__tag--pending" style="color:#e0960e">Pending</span>';
	                     	@endphp
	                     </span>
	                  </p>
	               </header>
	               <div class="adminFaqs__content">
	               	<input type="hidden" name="faqs[]" value="4">
	                  <div class="pure-g-r app-va-question-prices-ww">
	                     <div class="pure-u-3-4">
	                        <div class="pure-s mt15">
	                            <div id="slider-range-min-bridal_bouquet"></div>
	                              <div class="ui-slider-legend mt10">
	                              <span class="ui-slider-legend-min">C$  50</span>
	                              <span class="ui-slider-legend-max fright">C$  500+</span>
	                           </div>
	                        </div>
	                     </div>
	                     <div class="pure-u-1-4 text-center app-va-question-prices-ww-right-section ">
	                        <span class="currency" id="bridal_bouquet_currency">C$ </span>
	                        <input class="app-numerical-input pure-u-6-10" type="text" name="faqs[4][]" id="avg_price_bridal_bouquet" readonly data-decimals="2" data-decimal-sep="." data-miles-sep="," data-price_bridal="{{@$faq_ans_arr['price_bridal'][0]}}" >
	                       <!--  <input class="app-numerical-input pure-u-6-10" data-decimals="2" data-decimal-sep="." data-miles-sep="," type="text" value="150" name="3186"> -->
	                        <div class="inline-block mt5">
	                           <a href="javascript:void(0)" data-trash_id="avg_price_bridal_bouquet" data-slider_id="slider-range-min-bridal_bouquet" data-min="50" data-max="500" data-currency_id="bridal_bouquet_currency" class="app-va-question-prices-ww-not-apply btn btn-transparent trash-faq">
	                           <i class="icon icon-trash"></i>
	                           </a>
	                        </div>
	                     </div>
	                  </div>
	               </div>
	            </div>
	            <div class="adminFaqs">
	               <header class="adminFaqs__header ">
	                  <p class="adminFaqs__title">
	                     <span class="adminFaqs__counter">5.</span>
	                     What is the average price for a bridesmaid bouquet? <span id="question_5">
	                     	@php 
	                     	if(@$faq_ans_arr['price_bridesmaid'][0])
	                     		echo '<i class="adminFaqs__tag icon-vendor icon-vendor-form-check"></i>';
	                     	else
	                     		echo '<span class="adminFaqs__tag adminFaqs__tag--pending" style="color:#e0960e">Pending</span>';
	                     	@endphp
	                     </span>
	                  </p>
	               </header>
	               <div class="adminFaqs__content">
	               	<input type="hidden" name="faqs[]" value="5">
	                  <div class="pure-g-r app-va-question-prices-ww">
	                     <div class="pure-u-3-4">
	                        <div class="pure-s mt15">
	                        	<div id="slider-range-min-bridesmaid_bouquet"></div>
	                           <div class="ui-slider-legend mt10">
	                              <span class="ui-slider-legend-min"> C$ 25 </span>
	                              <span class="ui-slider-legend-max fright"> C$ 500+ </span>
	                           </div>
	                        </div>
	                     </div>
	                     <div class="pure-u-1-4 text-center app-va-question-prices-ww-right-section ">
	                        <span class="currency" id="bridesmaid_bouquet_currency">C$ </span>
	                    <input class="app-numerical-input pure-u-6-10" type="text" name="faqs[5][]" id="avg_price_bridesmaid_bouquet" readonly data-decimals="2" data-decimal-sep="." data-miles-sep="," data-price_bridesmaid="{{@$faq_ans_arr['price_bridesmaid'][0]}}">
	                        <div class="inline-block mt5">
	                        	<a href="javascript:void(0)" data-trash_id="avg_price_bridesmaid_bouquet" data-slider_id="slider-range-min-bridesmaid_bouquet" data-min="25" data-max="500" data-currency_id="bridesmaid_bouquet_currency" class="app-va-question-prices-ww-not-apply btn btn-transparent trash-faq">
	                            <i class="icon icon-trash"></i>
	                           </a>
	                        </div>
	                     </div>
	                  </div>
	               </div>
	            </div>
	            <div class="adminFaqs">
	               <header class="adminFaqs__header ">
	                  <p class="adminFaqs__title">
	                     <span class="adminFaqs__counter">6.</span>
	                     What is the average price for a boutonniere? <span id="question_6">
	                     	@php 
	                     	if(@$faq_ans_arr['price_boutonniere'][0])
	                     		echo '<i class="adminFaqs__tag icon-vendor icon-vendor-form-check"></i>';
	                     	else
	                     		echo '<span class="adminFaqs__tag adminFaqs__tag--pending" style="color:#e0960e">Pending</span>';
	                     	@endphp
	                     </span>
	                  </p>
	               </header>
	               <div class="adminFaqs__content">
	               	<input type="hidden" name="faqs[]" value="6">
	                  <div class="pure-g-r app-va-question-prices-ww">
	                     <div class="pure-u-3-4">
	                        <div class="pure-s mt15">
	                           <div id="slider-range-min-boutonniere"></div>
	                           <div class="ui-slider-legend mt10">
	                              <span class="ui-slider-legend-min"> C$ 5 </span>
	                              <span class="ui-slider-legend-max fright"> C$ 50+ </span>
	                           </div>
	                        </div>
	                     </div>
	                     <div class="pure-u-1-4 text-center app-va-question-prices-ww-right-section ">
	                        <span class="currency" id="boutonniere_bouquet_currency">C$ </span>
	                       <input class="app-numerical-input pure-u-6-10" type="text" name="faqs[6][]" id="avg_price_boutonniere" readonly data-decimals="2" data-decimal-sep="." data-miles-sep="," data-price_boutonniere="{{@$faq_ans_arr['price_boutonniere'][0]}}">
	                        <div class="inline-block mt5">
	                           <a href="javascript:void(0)" data-trash_id="avg_price_boutonniere" data-slider_id="slider-range-min-boutonniere" data-min="5" data-max="50" data-currency_id="boutonniere_bouquet_currency" class="app-va-question-prices-ww-not-apply btn btn-transparent trash-faq">
	                           <i class="icon icon-trash"></i>
	                           </a>
	                        </div>
	                     </div>
	                  </div>
	               </div>
	            </div>
	            <div class="adminFaqs">
	               <header class="adminFaqs__header ">
	                  <p class="adminFaqs__title">
	                     <span class="adminFaqs__counter">7.</span>
	                     What is the average price for a low table arrangement (per arrangement)? <span id="question_7">
	                     	@php 
	                     	if(@$faq_ans_arr['price_low_tbl'][0])
	                     		echo '<i class="adminFaqs__tag icon-vendor icon-vendor-form-check"></i>';
	                     	else
	                     		echo '<span class="adminFaqs__tag adminFaqs__tag--pending" style="color:#e0960e">Pending</span>';
	                     	@endphp
	                     </span>

	                  </p>
	               </header>
	               <div class="adminFaqs__content">
	               		<input type="hidden" name="faqs[]" value="7">
	                  <div class="pure-g-r app-va-question-prices-ww">
	                     <div class="pure-u-3-4">
	                        <div class="pure-s mt15">
	                           <div id="slider-range-min-low-tbl-arrangement"></div>
	                           <div class="ui-slider-legend mt10">
	                              <span class="ui-slider-legend-min"> C$ 50 </span>
	                              <span class="ui-slider-legend-max fright"> C$ 500+ </span>
	                           </div>
	                        </div>
	                     </div>
	                     <div class="pure-u-1-4 text-center app-va-question-prices-ww-right-section ">
	                        <span class="currency" id="low_tbl_arrangement_currency">C$ </span>
	                      
	                         <input class="app-numerical-input pure-u-6-10" type="text" name="faqs[7][]" id="avg_price_low_tbl_arrangement" readonly data-decimals="2" data-decimal-sep="." data-miles-sep="," data-price_low_tbl="{{@$faq_ans_arr['price_low_tbl'][0]}}">
	                        <div class="inline-block mt5">
	                           <a href="javascript:void(0)" data-trash_id="avg_price_low_tbl_arrangement" data-slider_id="slider-range-min-low-tbl-arrangement" data-min="50" data-max="500" data-currency_id="low_tbl_arrangement_currency" class="app-va-question-prices-ww-not-apply btn btn-transparent trash-faq">
	                           <i class="icon icon-trash"></i>
	                           </a>
	                        </div>
	                     </div>
	                  </div>
	               </div>
	            </div>
	            <div class="adminFaqs">
	               <header class="adminFaqs__header ">
	                  <p class="adminFaqs__title">
	                     <span class="adminFaqs__counter">8.</span>
	                     What is the average price for an elevated table arrangement (per arrangement)?     <span id="question_8">
	                     	@php 
	                     	if(@$faq_ans_arr['price_elevated_tbl'][0])
	                     		echo '<i class="adminFaqs__tag icon-vendor icon-vendor-form-check"></i>';
	                     	else
	                     		echo '<span class="adminFaqs__tag adminFaqs__tag--pending" style="color:#e0960e">Pending</span>';
	                     	@endphp
	                     </span>

	                  </p>
	               </header>
	               <div class="adminFaqs__content">
	               	<input type="hidden" name="faqs[]" value="8">
	                  <div class="pure-g-r app-va-question-prices-ww">
	                     <div class="pure-u-3-4">
	                        <div class="pure-s mt15">
	                            <div id="slider-range-min-elevated-tbl-arrangement"></div>
	                           <div class="ui-slider-legend mt10">
	                              <span class="ui-slider-legend-min"> C$ 50 </span>
	                              <span class="ui-slider-legend-max fright"> C$ 500+ </span>
	                           </div>
	                        </div>
	                     </div>
	                     <div class="pure-u-1-4 text-center app-va-question-prices-ww-right-section ">
	                        <span class="currency" id="elevated_tbl_arranegment_currency">C$ </span>
	                       
	                         <input class="app-numerical-input pure-u-6-10" type="text" name="faqs[8][]" id="avg_price_elevated_tbl_arranegment" readonly data-decimals="2" data-decimal-sep="." data-miles-sep="," data-price_elevated_tbl="{{@$faq_ans_arr['price_elevated_tbl'][0]}}">
	                        <div class="inline-block mt5">
	                            <a href="javascript:void(0)" data-trash_id="avg_price_elevated_tbl_arranegment" data-slider_id="slider-range-min-elevated-tbl-arrangement" data-min="50" data-max="500" data-currency_id="elevated_tbl_arranegment_currency" class="app-va-question-prices-ww-not-apply btn btn-transparent trash-faq">
	                           <i class="icon icon-trash"></i>
	                           </a>
	                        </div>
	                     </div>
	                  </div>
	               </div>
	            </div>
	            <div class="adminFaqs">
	               <header class="adminFaqs__header ">
	                  <p class="adminFaqs__title">
	                     <span class="adminFaqs__counter">9.</span>
	                     Typically, what can a customer expect to pay for your wedding floral services? <span id="question_9">
	                     	@php 
	                     	if(@$faq_ans_arr['price_customer_expect'][0])
	                     		echo '<i class="adminFaqs__tag icon-vendor icon-vendor-form-check"></i>';
	                     	else
	                     		echo '<span class="adminFaqs__tag adminFaqs__tag--pending" style="color:#e0960e">Pending</span>';
	                     	@endphp
	                     </span>
	                  </p>
	               </header>
	               <div class="adminFaqs__content">
	               	<input type="hidden" name="faqs[]" value="9">
	                  <div class="pure-g-r app-va-question-prices-ww">
	                     <div class="pure-u-3-4">
	                        <div class="pure-s mt15">
	                            <div id="slider-range-min-customer-expect"></div>
	                           <div class="ui-slider-legend mt10">
	                              <span class="ui-slider-legend-min"> C$ 50 </span>
	                              <span class="ui-slider-legend-max fright"> C$ 25,000+ </span>
	                           </div>
	                        </div>
	                     </div>
	                     <div class="pure-u-1-4 text-center app-va-question-prices-ww-right-section ">
	                        <span class="currency" id="customer_expect_currency">C$ </span>
	                         <input class="app-numerical-input pure-u-6-10" type="text" name="faqs[9][]" id="avg_price_customer_expect" readonly data-decimals="2" data-decimal-sep="." data-miles-sep="," data-price_customer_expect="{{@$faq_ans_arr['price_customer_expect'][0]}}">
	                        <div class="inline-block mt5">
	                            <a href="javascript:void(0)" data-trash_id="avg_price_customer_expect" data-slider_id="slider-range-min-customer-expect" data-min="50" data-max="500" data-currency_id="customer_expect_currency" class="app-va-question-prices-ww-not-apply btn btn-transparent trash-faq">
	                           <i class="icon icon-trash"></i>
	                           </a>
	                        </div>
	                     </div>
	                  </div>
	               </div>
	            </div>
	            <div class="adminFaqs">
	               <header class="adminFaqs__header ">
	                  <p class="adminFaqs__title">
	                     <span class="adminFaqs__counter">10.</span>
	                     Which of the following are included in the cost of your floral services? <i class="adminFaqs__tag icon-vendor icon-vendor-form-check"></i>
	                  </p>
	               </header>
	               <div class="adminFaqs__content">
	                  <ul class="pure-g-r">
	                     <input type="hidden" name="faqs[]" value="10">                            
	                    @foreach($data['floral_services'] as $fss)
	                  		<li class="pure-u-1-3 mb10">
	                        <label class="block">
	                           <div class="icheckbox_minimal" style="position: relative;"><input type="checkbox" name="faqs[10][]" value="{{$fss->id}}" @if(count(@$faq_ans_arr) > 0) @php echo in_array($fss->id,@$faq_ans_arr['cost_fd_arr'][0])?'checked':'' @endphp @endif><ins class="iCheck-helper" ></ins></div>
	                           <span class="pure-u-5-6">{{$fss->name}}</span>
	                        </label>
	                     </li>
	                  	@endforeach
	                  </ul>
	               </div>
	            </div>
	            <input class="btnFlat btnFlat--primary faq_save_btn" type="submit" value="Save">
	         </form>
	      </div>
	   </div>
	</div>
</section>
@include('includes.footer')
<!-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script> -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$('.default_quest_handl').hover(function(){
		$(this).toggleClass('ui-state-hover');
	});
	$(".faq_save_btn").click(function(e) {
		e.preventDefault();
		$(".alert_msg").html('');
		$.ajax({
			url: "/storefront-faqs",
			type:'POST',
			data: $("#formFaq").serialize(),
			success: function(data) {
				console.log('data',data);
				if($.isEmptyObject(data.error)) {
					$(".faq_succ_msg").show();
					$(".alert_msg").html(data.message);
					$('html, body').animate({ scrollTop: 10 }, 'slow');
					$.each(data.faqs_ans, function(key,val) {
						console.log('key:'+key+' question_id:'+val.question_id+' answer:'+val.answer);
						if(val.answer!='' && val.question_id!=0)
							$("#question_"+val.question_id).html('<i class="adminFaqs__tag icon-vendor icon-vendor-form-check"></i>');
						else
							$("#question_"+val.question_id).html('<span class="adminFaqs__tag adminFaqs__tag--pending" style="color:#e0960e">Pending</span>');
					});
					setTimeout(function() {
						$('.faq_succ_msg').slideUp();
					}, 4000);
				} else {
					printErrorMsg(data.error);
				}
			}
		});
	});
	function printErrorMsg (msg) {
		//alert(msg);
		$(".print-error-msg").find("ul").html('');
		$(".print-error-msg").css('display','block');
		$.each( msg, function( key, value ) {
			$(".print-error-msg").find("ul").append('<li>'+value+'</li>');
		});
	}
	/*setTimeout(function() { $('.faq_succ_msg').slideUp(); }, 4000);*/
	//range slider
	$(".trash-faq").click(function() {
		var trash_id=$(this).data('trash_id');
		var slider_id=$(this).data('slider_id');
		var currency_id=$(this).data('currency_id');
		var min=$(this).data('min');
		var max=$(this).data('max');
		$("#"+currency_id).hide();
		$(this).hide();
		$('#'+trash_id).val('').hide();
		$("#"+slider_id).find(".ui-slider-range").css('width','0');
		$("#"+slider_id).slider("option", "values",[min,max]);
	})	;
	function ResetPrimarySlider() {
		$( "#slider-range" ).slider("destroy");
		PrimarySlider();
	}
	var price_bridal=$("#avg_price_bridal_bouquet").data('price_bridal');
	$( "#slider-range-min-bridal_bouquet" ).slider({
		range: "min",
		value: price_bridal?price_bridal:50,
		min: 50,
		max: 500,
		slide: function( event, ui ) {
			//var id=$(".app-numerical-input").attr('id');
			//console.log('id',id);
			$( "#avg_price_bridal_bouquet").val( ui.value );
		}
	});
	$( "#avg_price_bridal_bouquet" ).val($( "#slider-range-min-bridal_bouquet" ).slider( "value" ) );
	var price_bridesmaid=$("#avg_price_bridesmaid_bouquet").data('price_bridesmaid');
	$( "#slider-range-min-bridesmaid_bouquet" ).slider({
      range: "min",
      value: price_bridesmaid?price_bridesmaid:25,
      min: 25,
      max: 500,
      slide: function( event, ui ) {
      	//var id=$(".app-numerical-input").attr('id');
      	//console.log('id',id);
        $( "#avg_price_bridesmaid_bouquet").val( ui.value );
      }
   });
   $( "#avg_price_bridesmaid_bouquet" ).val(  $( "#slider-range-min-bridesmaid_bouquet" ).slider( "value" ) );
    var price_boutonniere=$("#avg_price_boutonniere").data('price_boutonniere');
	$( "#slider-range-min-boutonniere" ).slider({
      range: "min",
      value: price_boutonniere?price_boutonniere:5,
      min: 5,
      max: 50,
      slide: function( event, ui ) {
      	$( "#avg_price_boutonniere").val( ui.value );
      }
   });
	$( "#avg_price_boutonniere" ).val($( "#slider-range-min-boutonniere" ).slider( "value" ) );
	var price_low_tbl=$("#avg_price_low_tbl_arrangement").data('price_low_tbl');
	$( "#slider-range-min-low-tbl-arrangement" ).slider({
      range: "min",
      value: price_low_tbl?price_low_tbl:50,
      min: 50,
      max: 500,
      slide: function( event, ui ) {
      	$( "#avg_price_low_tbl_arrangement").val(  ui.value );
      }
   });
	$( "#avg_price_low_tbl_arrangement" ).val(  $( "#slider-range-min-low-tbl-arrangement" ).slider( "value" ) );
	var price_elevated_tbl=$("#avg_price_elevated_tbl_arranegment").data('price_elevated_tbl');
   $( "#slider-range-min-elevated-tbl-arrangement" ).slider({
      range: "min",
      value: price_elevated_tbl?price_elevated_tbl:50,
      min: 50,
      max: 500,
      slide: function( event, ui ) {
			//var id=$(".app-numerical-input").attr('id');
			//console.log('id',id);
			$( "#avg_price_elevated_tbl_arranegment").val(  ui.value );
      }
   });
	$( "#avg_price_elevated_tbl_arranegment" ).val( $( "#slider-range-min-elevated-tbl-arrangement" ).slider( "value" ) );
	var price_customer_expect=$("#avg_price_customer_expect").data('price_customer_expect');
	$( "#slider-range-min-customer-expect" ).slider({
      range: "min",
      value: price_customer_expect?price_customer_expect:50,
      min: 50,
      max: 25000,
      slide: function( event, ui ) {
			//var id=$(".app-numerical-input").attr('id');
			//console.log('id',id);
			$( "#avg_price_customer_expect").val(  ui.value );
      }
   });
	$( "#avg_price_customer_expect" ).val($( "#slider-range-min-customer-expect" ).slider( "value" ) );
});
</script>
@endsection