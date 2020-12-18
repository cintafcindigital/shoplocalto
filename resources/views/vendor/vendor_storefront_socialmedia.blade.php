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
	      <div class="pure-u-5-7">
	         <h1 class="adminTitle">Social Media</h1>
	         <div class="app-hide-alert social_succ_msg" style="display: none;">
		            <div class="adminAlert adminAlert--success">
		            <p class="alert_msg"></p>
		        </div>
		    </div>
		    @if(session()->has('success'))
		    <div class="app-hide-alert social_succ_msg">
		            <div class="adminAlert adminAlert--success">
		            <p class="alert_msg">{{session()->get('success')}}</p>
		        </div>
		    </div>
		    @endif
		    @if(session()->has('error'))
		    <div class="app-hide-alert social_succ_msg">
		            <div class="adminAlert adminAlert--error">
		            <p class="alert_msg">{{session()->get('error')}}</p>
		        </div>
		    </div>
		    @endif
			<div class="adminSocial">
	            <header class="adminSocial__hero">
	               <p class="adminSocial__title">Get more visibility on social networks with My Health Squad</p>
	            </header>
	            <form id="frm_vendor_social_media" class="app-admin-social-form adminSocial__content"  method="POST">
	            <input type="hidden" name="update_sm_id" id="update_sm_id" value="{{ isset($data['sm']->id)?$data['sm']->id:'' }}">	
	            	{{ csrf_field() }}
	               <p class="mb20">Share your social media profile with us and increase the possibilities to have your pictures published. When we make a post with one of your pictures, we will also mention the name of your company.</p>
	               <div class="app-msg-error"></div>
	               <div class="row">
	               	<form action="" method="POST">
	               		@csrf
	               	@foreach($data['social'] as $social)
	               	<div class="col-sm-6">
	               		<div class="form-group">
	               			<div class="input-group adminFormInput adminFormInput--limited">
	                            <span class="input-group-addon" style="width: 48px;border: 0;border-radius: 0;">
	                                <i class="{{$social->icon}}" style="font-size: 22px;color: #ab0e30;"></i>
	                            </span>
	                            <input style="border:none;" type="text" class="form-control" placeholder="{{$social->name}}" value="{{old($social->slug) != '' ? old($social->slug) : $social->link}}" name="{{$social->slug}}">
                          	</div>
	                        @if($errors->has($social->slug))
                                <span class="text-danger">{{$errors->first($social->slug)}}</span>
                            @endif
	               		</div>
	               	</div>
	               	@endforeach
	               	<div class="col-sm-12 text-center">
	                  	<button type="submit" style="margin-right: 6%;" class="btnFlat btnFlat--primary app-validacion-redes-sociales">Save</button>
	               	</div>
	               	</form>
	               </div>
	               <div class="pure-g row hidden">
	                  <div class="pure-u-1-2">
	                     <div class="adminSocial__item">
	                        <span class="adminSocial__icon adminSocial__icon--facebook">
	                           <i class="svgIcon svgIcon__facebook ">
	                              <svg viewBox="0 0 1792 1792">
	                                 <path d="M1343 12v264h-157q-86 0-116 36t-30 108v189h293l-39 296h-254v759H734V905H479V609h255V391q0-186 104-288.5T1115 0q147 0 228 12z"></path>
	                              </svg>
	                           </i>
	                        </span>
	                        <input class="adminSocial__input" id="input_facebook" name="facebook_url" placeholder="www.facebook.com/business-information" value="{{ isset($data['sm']->facebook_url)?$data['sm']->facebook_url:'' }}" type="text">
	                     </div>
	                  </div>
	                  <div class="pure-u-1-2">
	                     <div class="adminSocial__item">
	                        <span class="adminSocial__icon adminSocial__icon--instagram">
	                           <i class="svgIcon svgIcon__instagram ">
	                              <svg viewBox="0 0 1792 1792">
	                                 <path d="M1152 896q0-106-75-181t-181-75-181 75-75 181 75 181 181 75 181-75 75-181zm138 0q0 164-115 279t-279 115-279-115-115-279 115-279 279-115 279 115 115 279zm108-410q0 38-27 65t-65 27-65-27-27-65 27-65 65-27 65 27 27 65zM896 266q-7 0-76.5-.5t-105.5 0-96.5 3-103 10T443 297q-50 20-88 58t-58 88q-11 29-18.5 71.5t-10 103-3 96.5 0 105.5.5 76.5-.5 76.5 0 105.5 3 96.5 10 103T297 1349q20 50 58 88t88 58q29 11 71.5 18.5t103 10 96.5 3 105.5 0 76.5-.5 76.5.5 105.5 0 96.5-3 103-10 71.5-18.5q50-20 88-58t58-88q11-29 18.5-71.5t10-103 3-96.5 0-105.5-.5-76.5.5-76.5 0-105.5-3-96.5-10-103T1495 443q-20-50-58-88t-88-58q-29-11-71.5-18.5t-103-10-96.5-3-105.5 0-76.5.5zm768 630q0 229-5 317-10 208-124 322t-322 124q-88 5-317 5t-317-5q-208-10-322-124t-124-322q-5-88-5-317t5-317q10-208 124-322t322-124q88-5 317-5t317 5q208 10 322 124t124 322q5 88 5 317z"></path>
	                              </svg>
	                           </i>
	                        </span>
	                        <input class="adminSocial__input" id="input_instagram" name="instagram_url" placeholder="www.instagram.com/business-information" value="{{ isset($data['sm']->instagram_url)?$data['sm']->instagram_url:'' }}" type="text">
	                     </div>
	                  </div>
	               </div>
	               <div class="pure-g row hidden">
	                  <div class="pure-u-1-2">
	                     <div class="adminSocial__item">
	                        <span class="adminSocial__icon adminSocial__icon--twitter">
	                           <i class="svgIcon svgIcon__twitter ">
	                              <svg viewBox="0 0 502 408">
	                                 <path d="M501.625 48.375c-18.477 8.203-38.281 13.71-59.102 16.21 21.25-12.733 37.579-32.89 45.235-56.874a206.477 206.477 0 0 1-65.313 24.922c-18.75-20-45.468-32.461-75.039-32.461-56.797 0-102.851 46.016-102.851 102.812 0 8.047.937 15.899 2.695 23.438C161.781 122.125 86.04 81.188 35.297 18.96 26.43 34.195 21.39 51.85 21.39 70.68c0 35.664 18.125 67.148 45.742 85.625-16.875-.547-32.735-5.196-46.602-12.89v1.288c0 49.844 35.469 91.367 82.461 100.86-8.594 2.343-17.695 3.593-27.07 3.593-6.64 0-13.086-.625-19.375-1.875 13.125 40.82 51.094 70.625 96.055 71.446-35.157 27.578-79.493 43.984-127.696 43.984-8.32 0-16.484-.469-24.492-1.445 45.469 29.218 99.531 46.21 157.617 46.21 189.14 0 292.578-156.68 292.578-292.538 0-4.454-.117-8.946-.273-13.32 20.078-14.493 37.5-32.618 51.289-53.243z" fill-rule="nonzero"></path>
	                              </svg>
	                           </i>
	                        </span>
	                        <input class="adminSocial__input" id="input_twitter" name="twitter_url" placeholder="twitter.com/business-information" value="{{ isset($data['sm']->twitter_url)?$data['sm']->twitter_url:'' }}" type="text">
	                     </div>
	                  </div>
	                  <div class="pure-u-1-2">
	                     <div class="adminSocial__item">
	                        <span class="adminSocial__icon adminSocial__icon--pinterest">
	                           <i class="svgIcon svgIcon__pinterest ">
	                              <svg viewBox="0 0 1792 1792">
	                                 <path d="M1664 896q0 209-103 385.5T1281.5 1561 896 1664q-111 0-218-32 59-93 78-164 9-34 54-211 20 39 73 67.5t114 28.5q121 0 216-68.5t147-188.5 52-270q0-114-59.5-214T1180 449t-255-63q-105 0-196 29t-154.5 77-109 110.5-67 129.5T377 866q0 104 40 183t117 111q30 12 38-20 2-7 8-31t8-30q6-23-11-43-51-61-51-151 0-151 104.5-259.5T904 517q151 0 235.5 82t84.5 213q0 170-68.5 289T980 1220q-61 0-98-43.5T859 1072q8-35 26.5-93.5t30-103T927 800q0-50-27-83t-77-33q-62 0-105 57t-43 142q0 73 25 122l-99 418q-17 70-13 177-206-91-333-281T128 896q0-209 103-385.5T510.5 231 896 128t385.5 103T1561 510.5 1664 896z"></path>
	                              </svg>
	                           </i>
	                        </span>
	                        <input class="adminSocial__input" id="input_pinterest" name="pinterest_url" placeholder="pinterest.com/business-information" value="{{ isset($data['sm']->pinterest_url)?$data['sm']->pinterest_url:'' }}" type="text">
	                     </div>
	                  </div>
	               </div>
	               <footer class="text-center mt10 mb10">
	                  <!-- <button type="button" class="btnFlat btnFlat--primary app-validacion-redes-sociales social_media_save">Save</button> -->
	               </footer>
	            </form>
	         </div>
	      </div>
	   </div>
	</div>
</section>
@include('includes.footer')
<script type="text/javascript">
	$(document).ready(function(){
		/*$('.social_media_save').click(function(){
			$('.social_succ_msg').slideDown();
		});*/

		$(".social_media_save").click(function(e) {
            e.preventDefault();
             $(".alert_msg").html('');

            $.ajax({
                url: "/sociales",
                type:'POST',
                data: $("#frm_vendor_social_media").serialize(),
                success: function(data) {

                	console.log('data',data);
                    if($.isEmptyObject(data.error)) {
                    	
                    	$('.social_succ_msg').show();
                    	$('html, body').animate({ scrollTop: 10 }, 'slow');
                    	$(".alert_msg").html(data.message);
                    	                   	
                    	setTimeout(function() {
                         if(data.sm.id!='undefined')		
        				 	$("#update_sm_id").val(data.sm.id);		        			
	        			 $('.social_succ_msg').slideUp();
	        			// window.location='/gallery';
	        			 	        			 	        				
	    				}, 3000);

	    				
                    }else{
                        alert(data.error);
                    }
                }
            });



        }); 


	});
	/*setTimeout(function() {
        $('.social_succ_msg').slideUp();
    }, 4000);*/
</script>
@endsection