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
	      <div class="pure-u-5-7 deals_wrp">
	         <h1 class="adminTitle">
	            Deals                            
	         </h1>
	         <div class="adminAlert adminAlert--flex">
	            <i class="icon-vendors-admin-alerts icon-vendors-admin-alerts-promos"></i>
	            <div>
	               <p>Add <strong>special offers</strong> to your Storefront to generate more interest and <strong>receive more leads</strong>.</p>
	            </div>
	         </div>
	         <div class="app-hide-alert" style="display: none;">
	            <div class="adminAlert adminAlert--success">
	              <p class="alert_msg"></p>
	            </div>
	         </div>
	         <form name="frmPromocionWp" id="frmPromocionWp" method="post">
	                  	{{csrf_field()}}
	         	 <input type="hidden" name="promotion_id" id="promotion_id" value="{{isset($data['offer']->id)?$data['offer']->id:''}}">
	            <div class="adminPromosSet">
	               <header class="adminPromosSet__header">
	                  <h3 class="adminPromosSet__title">Add a special discount for PerfectWedding couples</h3>
	                  <p class="adminPromosSet__description">Offer a discount to couples who find you on PerfectWedding and book your services. The discount will apply to the services they purchase.</p>
	               </header>

	               <div class="adminPromosSet__content" id="select-discount">
	                  <label class="app-promos-check adminPromosSet__button deal_offer {{ isset($data['offer']->promotion_amount) && $data['offer']->promotion_amount==3?'active':''}} " for="DescuentoWp3">
	                  <input class="app-not-icheck" type="radio" id="DescuentoWp3" name="discount" value="3">3%
	                  </label>
	                  <label class="app-promos-check adminPromosSet__button deal_offer {{ isset($data['offer']->promotion_amount) && $data['offer']->promotion_amount==5?'active':''}}" for="DescuentoWp5">
	                  <input class="app-not-icheck" type="radio" id="DescuentoWp5" name="discount" value="5">5%
	                  </label>
	                  <label class="app-promos-check adminPromosSet__button deal_offer {{ isset($data['offer']->promotion_amount) && $data['offer']->promotion_amount==10?'active':''}}" for="DescuentoWp10">
	                  <input class="app-not-icheck" type="radio" id="DescuentoWp10" name="discount" value="10">10%
	                  </label>
	                  <label class="app-promos-check adminPromosSet__button deal_offer {{ isset($data['offer']->promotion_amount) && $data['offer']->promotion_amount==15?'active':''}}" for="DescuentoWp15">
	                  <input class="app-not-icheck" type="radio" id="DescuentoWp15" name="discount" value="15">15%
	                  </label>
	                  <label class="app-promos-check adminPromosSet__button deal_offer {{ isset($data['offer']->promotion_amount) && $data['offer']->promotion_amount==20?'active':''}}" for="DescuentoWp20">
	                  <input class="app-not-icheck" type="radio" id="DescuentoWp20" name="discount" value="20">20%
	                  </label>
	                  <label class="app-promos-check adminPromosSet__button deal_offer {{ isset($data['offer']->promotion_amount) && $data['offer']->promotion_amount==30?'active':''}}" for="DescuentoWp30">
	                  <input class="app-not-icheck" type="radio" id="DescuentoWp30" name="discount" value="30">30%
	                  </label>
	                  <label for="DescuentoWp" class="adminPromosSet__denied">
	                  
	                     <div class="iradio_minimal no_offer_btn {{ isset($data['offer']->offer_wedding) && $data['offer']->offer_wedding==1?'checked':''}}" ><input style="opacity: 0;" class="app-promos-check-icheck" type="radio" name="offer_wedding" value="1" {{ isset($data['offer']->offer_wedding) && $data['offer']->offer_wedding==1?'checked':''}}><ins class="iCheck-helper" style="position: unset" ></ins></div>
	                     <span>Not offering any discounts currently.</span>
	                  </label>
	                  <input class="btnFlat btnFlat--primary save_disc_btn" type="submit" value="Save Discount">

	               </div>
	            </div>
	         </form>
	         <h2 class="adminSubtitle">Other Deals</h2>
	         

	         @if(isset($data['vendor_deals']))
	           
	         <ul class="deals_wrapper">
	         	<li><i class="adminEmpty__icon adminEmpty__icon--promos"></i>
	                <a class="btnFlat btnFlat--primary" href="{{url('promocionesnew')}}">
	            Add Deal                        </a></li>
	           
	            
	          @foreach($data['vendor_deals'] as $deal)
	          	<li>
	          			<div class="adminPromos__actions">
	          				<span class="tag tag-orange">{{$deal->status}}</span>
	          			</div>
	          			<a href="{{url('promocionesedit/'.$deal->id)}}">
		          			@if(file_exists(public_path('/images/deal_photo/'.$deal->photo)) && $deal->photo!='')
			          			<img src="{{ asset('/images/deal_photo/'.$deal->photo)}}" alt="{{$deal->deal_name}}" width="250" height="150" />
			          		@else
			          			<img src="{{ asset('vendors/'.$data['vendor']->image_data[0]->vendor_folder.'/'.$data['vendor']->image_data[0]->image)}}" alt="{{$deal->deal_name}}" width="250" height="150" />
			          		@endif
		          		</a>
		          		<div class="adminPromos__content">	
		          			 <p class="adminPromos__typeName ">{{strtoupper($deal->type)}}</p>
		          			 <p class="adminPromos__dealName "><a href="{{url('promocionesedit/'.$deal->id)}}"><strong>{{ $deal->deal_name}}</strong></a></p>
		          			 <time class="adminPromos__date">
				          		@if($deal->end_date!='0000-00-00')
				          			{{ 'End '.date('d/m/Y',strtotime($deal->end_date))}}
				          		@endif
				          	 </time>
		          			<span class="adminPromos__type adminPromos__type--{{strtolower($deal->type)}}"></span>
		          		</div>
	          	</li>

	          @endforeach
	         </ul>
	         @else
	          <div class="adminEmpty">
	            <i class="adminEmpty__icon adminEmpty__icon--promos"></i>
	            <p class="adminEmpty__title">Create your first deal</p>
	            <p class="adminEmpty__description">Offer a discount or special package to attract new business and get greater visibility in the PerfectWedding directory.</p>
	            <a class="btnFlat btnFlat--primary" href="{{url('promocionesnew')}}">
	            Add Deal                        </a>
	         </div>
	         @endif
	      </div>


	   </div>
	</div>
</section>
@include('includes.footer')
<script>
	setTimeout(function() {
	    $('.app-hide-alert').slideUp();
	}, 6000);

	$(document).ready(function(){

		$(".no_offer_btn").click(function(){

			$('.deal_offer').removeClass('active');
			$('input[name=discount]').removeAttr('checked');
		});
		
		$('.save_disc_btn').click(function(e){
			e.preventDefault();


			post_data={
                _token : $("input[name='_token']").val(),
				discount:$('input[name=discount]:checked').val(),
				promotion_id:$("input[name='promotion_id']").val(),
				offer_wedding:$('input[name=discount]:checked').val()?'':$('input[name=offer_wedding]:checked').val(),
				
			}

			$.ajax({
                url: "/promociones",
                type:'POST',
                data: post_data,
                success: function(data) {

                	console.log('data',data);
                	 $('.app-hide-alert').show();
                    if($.isEmptyObject(data.error)) {
                    	
                    	//$(".faq_succ_msg").show();
                    	$(".alert_msg").html(data.message);
                  	                    	                    	
                    	setTimeout(function() {
        				
	        			 $('.app-hide-alert').slideUp();
        			 	        			 	        				
	    				}, 4000);
	    				
                    }else{
                        console.log(data.error);
                    }
                }
            });


			
		});
		$('.no_offer_btn').hover(function(){
			$(this).toggleClass('hover');
			
			$(this).parent('.adminPromosSet__denied').toggleClass('hover');

			
		});

		$('.no_offer_btn').click(function(){
			
			$(this).addClass('checked');
					
		});
		$('.deal_offer').click(function(){
			$('.deal_offer').removeClass('active');
			$('input[name=offer_wedding]').removeAttr('checked');
			$(".no_offer_btn").removeClass('checked');
			$(this).addClass('active');
		});
	});
</script>
<style type="text/css">
	.iradio_minimal.checked, .iradio_minimal.no_offer_btn.checked.hover {
    background-position: -140px 0;
}

</style>
@endsection