@extends('layouts.default')
@section('meta_title',$data['titleData']->meta_title)
@section('meta_keyword',$data['titleData']->meta_keyword)
@section('meta_description',$data['titleData']->meta_description)
@section('content')
@include('includes.menu')
<section class="section-padding dashboard-wrap review_main_wrp dash_main_sect">
    @include('vendor.tools_nav')
    <div class="wrapper">
	   	<div class="pure-g">
	      	<div class="pure-u-2-7">
	         	<div class="mr40">
		            <nav class="adminAside review_list_menu">
		               	<a class="adminAside__item " href="{{url('reviews')}}">
		                  	<i class="svgIcon svgIcon__gear adminAside__icon">
		                    	<svg viewBox="0 0 18 20">
		                        	<path d="M5.98 16.179a.653.653 0 0 0-.822-.472l-1.76.504c-.856.244-1.883-.17-2.325-.94l-.601-1.04C.027 13.46.18 12.365.82 11.745l1.317-1.272a.657.657 0 0 0 0-.95L.824 8.252C.183 7.634.029 6.54.473 5.769l.6-1.04c.443-.771 1.47-1.185 2.325-.94l1.76.504a.656.656 0 0 0 .823-.474l.443-1.776C6.64 1.18 7.511.5 8.4.5h1.2c.889 0 1.76.68 1.975 1.542l.444 1.775c.092.366.46.577.823.474l1.76-.504c.855-.245 1.88.17 2.324.94l.602 1.041c.443.772.29 1.865-.35 2.482L15.86 9.524a.653.653 0 0 0 0 .948l1.318 1.273c.64.619.792 1.712.348 2.484l-.6 1.04c-.442.77-1.469 1.185-2.325.94l-1.761-.504a.654.654 0 0 0-.82.474l-.445 1.778C11.36 18.82 10.489 19.5 9.6 19.5H8.4c-.89 0-1.76-.68-1.975-1.543l-.446-1.778zm1.415 1.536c.104.417.575.785 1.005.785h1.2c.43 0 .901-.368 1.005-.785l.445-1.778a1.653 1.653 0 0 1 2.067-1.193l1.76.504c.415.119.97-.105 1.184-.478l.6-1.04c.215-.375.132-.966-.177-1.266l-1.318-1.273a1.653 1.653 0 0 1 .001-2.387l1.316-1.273c.31-.3.393-.89.178-1.264l-.601-1.04c-.215-.373-.77-.597-1.183-.479l-1.76.504a1.656 1.656 0 0 1-2.068-1.192l-.444-1.776C10.501 1.868 10.03 1.5 9.6 1.5H8.4c-.43 0-.901.368-1.005.785L6.95 4.062a1.657 1.657 0 0 1-2.068 1.193l-1.76-.504c-.415-.12-.97.105-1.184.477l-.6 1.04c-.215.374-.132.966.178 1.265l1.316 1.272a1.658 1.658 0 0 1 0 2.387l-1.317 1.273c-.31.3-.393.892-.178 1.265l.602 1.042c.213.372.768.596 1.183.477l1.759-.503a1.652 1.652 0 0 1 2.067 1.19l.446 1.779zM9 8.1a1.9 1.9 0 1 0 0 3.8 1.9 1.9 0 0 0 0-3.8zm0-1a2.9 2.9 0 1 1 0 5.8 2.9 2.9 0 0 1 0-5.8z" fill-rule="nonzero"></path>
		                     	</svg>
		                  	</i> REVIEW REQUEST
		               	</a>
		               	<a class="adminAside__item active" href="{{url('reviews-list')}}">
		                 	<i class="svgIcon svgIcon__note adminAside__icon">
		                    	<svg viewBox="0 0 18 19">
		                        	<path d="M16.636.87a.5.5 0 0 1 .5.5v11.087a.5.5 0 0 1-.143.35l-5.091 5.174a.5.5 0 0 1-.357.15H1.364a.5.5 0 0 1-.5-.5V1.37a.5.5 0 0 1 .5-.5h15.272zm-.5 1H1.864v15.26h9.472l4.8-4.878V1.87zm-4.09 15.76a.5.5 0 1 1-1 0v-5.173a.5.5 0 0 1 .5-.5h5.09a.5.5 0 0 1 0 1h-4.59v4.673zM4 6.5a.5.5 0 0 1 0-1h9a.5.5 0 1 1 0 1H4zm0 3a.5.5 0 0 1 0-1h6a.5.5 0 0 1 0 1H4z" fill-rule="nonzero"></path>
		                     	</svg>
		                  	</i> REVIEWS
		               	</a>
		               	<a class="adminAside__item " href="{{url('reviews-sellos')}}">
		                	<i class="svgIcon svgIcon__seals adminAside__icon">
		                    	<svg viewBox="0 0 19 18">
		                        	<path d="M17.488 16.895h-.067c-.006.021.02.014.078.006l-.01-.006zm-.218 0V1h-16v15.895h16zm.33 1H.653c-.192 0-.383-.19-.383-.476V.476C.27.286.461 0 .749 0H17.79c.192 0 .479.19.479.476v16.943c-.191.285-.383.476-.67.476zm-2.007-7.03a.5.5 0 0 1-.393.809h-12a.5.5 0 0 1-.393-.81l1.33-1.69-1.33-1.691a.5.5 0 0 1 .393-.81h12a.5.5 0 0 1 .393.81l-1.33 1.69 1.33 1.692zm-2.358-1.382a.5.5 0 0 1 0-.618l.936-1.191H4.229l.936 1.19a.5.5 0 0 1 0 .619l-.936 1.19h9.942l-.936-1.19z" fill-rule="nonzero"></path>
		                     	</svg>
		                  	</i> MHS ALL STAR TEAM™
		               	</a>
		               	<a class="adminAside__item " href="{{url('/reviews-widget')}}">
		                  	<i class="svgIcon svgIcon__gear adminAside__icon">
		                    	<svg viewBox="0 0 18 20">
		                        	<path d="M5.98 16.179a.653.653 0 0 0-.822-.472l-1.76.504c-.856.244-1.883-.17-2.325-.94l-.601-1.04C.027 13.46.18 12.365.82 11.745l1.317-1.272a.657.657 0 0 0 0-.95L.824 8.252C.183 7.634.029 6.54.473 5.769l.6-1.04c.443-.771 1.47-1.185 2.325-.94l1.76.504a.656.656 0 0 0 .823-.474l.443-1.776C6.64 1.18 7.511.5 8.4.5h1.2c.889 0 1.76.68 1.975 1.542l.444 1.775c.092.366.46.577.823.474l1.76-.504c.855-.245 1.88.17 2.324.94l.602 1.041c.443.772.29 1.865-.35 2.482L15.86 9.524a.653.653 0 0 0 0 .948l1.318 1.273c.64.619.792 1.712.348 2.484l-.6 1.04c-.442.77-1.469 1.185-2.325.94l-1.761-.504a.654.654 0 0 0-.82.474l-.445 1.778C11.36 18.82 10.489 19.5 9.6 19.5H8.4c-.89 0-1.76-.68-1.975-1.543l-.446-1.778zm1.415 1.536c.104.417.575.785 1.005.785h1.2c.43 0 .901-.368 1.005-.785l.445-1.778a1.653 1.653 0 0 1 2.067-1.193l1.76.504c.415.119.97-.105 1.184-.478l.6-1.04c.215-.375.132-.966-.177-1.266l-1.318-1.273a1.653 1.653 0 0 1 .001-2.387l1.316-1.273c.31-.3.393-.89.178-1.264l-.601-1.04c-.215-.373-.77-.597-1.183-.479l-1.76.504a1.656 1.656 0 0 1-2.068-1.192l-.444-1.776C10.501 1.868 10.03 1.5 9.6 1.5H8.4c-.43 0-.901.368-1.005.785L6.95 4.062a1.657 1.657 0 0 1-2.068 1.193l-1.76-.504c-.415-.12-.97.105-1.184.477l-.6 1.04c-.215.374-.132.966.178 1.265l1.316 1.272a1.658 1.658 0 0 1 0 2.387l-1.317 1.273c-.31.3-.393.892-.178 1.265l.602 1.042c.213.372.768.596 1.183.477l1.759-.503a1.652 1.652 0 0 1 2.067 1.19l.446 1.779zM9 8.1a1.9 1.9 0 1 0 0 3.8 1.9 1.9 0 0 0 0-3.8zm0-1a2.9 2.9 0 1 1 0 5.8 2.9 2.9 0 0 1 0-5.8z" fill-rule="nonzero"></path>
		                     	</svg>
		                  	</i> REVIEWS WIDGET
		               	</a>
		            </nav>
	         	</div>
	      	</div>
	      	<?php
	      		$rateMembr = 0;
	      		$rateNumbr = 0;
	      		foreach($data['ratingData'] as $rts) {
	      		    if($rts->dispute_status == '0'){
	      		        $rateMembr++;
    		      	    $rateNumbr += $rts->average_rating;
	      		    }
		      	}
		      	if($rateNumbr > 0) {
		      		$finRate = round($rateNumbr / $rateMembr);
		      	} else {
		      		$finRate = 0;
		      	}
		        $rating = '0%';
		        if($finRate == 1) {
		            $rating = '20%';
		        } else if($finRate == 2) {
		            $rating = '40%';
		        } else if($finRate == 3) {
		            $rating = '60%';
		        } else if($finRate == 4) {
		            $rating = '80%';
		        } else if($finRate == 5) {
		            $rating = '100%';
		        }
		    ?>
			<div class="pure-u-5-7">
				<h1 class="adminTitle"> Reviews <span class="adminTitle__counter">({{ count($data['ratingData']) }})</span></h1>
				@if (Session::has('message'))
				<div class="alert alert-success">
					<p class="fa fa-check" style="font-size:16px;">{{ Session::get('message') }}</p>
				</div>
				@endif
				<div class="adminAlert adminAlert--flex review_list_alert">
					<i class="icon-vendors-admin-alerts icon-vendors-admin-alerts-reviews"></i>
					<div>
						<p class="adminAlert__title">Get reviews from your clients and patients.</p>
						<p>Reviews are critical when it comes time to choose a health professional.</p>
						<p>Encourage your past clients to leave a review about their experience with your business.</p>
					</div>
					<div class="adminAlert__cta">
						<a class="btnFlat btnFlat--primary" href="{{url('reviews')}}"> Request reviews </a>
					</div>
				</div>
				<div class="mt25"></div>
				<div class="storefrontRating">
					<div class="storefrontRatingBox">
						<span class="storefrontRatingBox__total">{{ $finRate.'.0' }}</span>
						<span class="storefrontRatingBox__percent">out of 5.0</span>
						<div class="rating-stars-vendor">
							<span class="rating-stars-vendor rating-stars-vendor-bar" style=" width:{{ $rating }};"></span>
						</div>
					</div>
					<ul class="ratingBar">
						<li class="ratingBar__item" data-columns="3">
							<i class="svgIcon svgIcon__quality ratingBar__icon">
								<svg viewBox="0 0 31 44">
									<path d="M15.5 31C6.94 31 0 24.06 0 15.5 0 6.94 6.94 0 15.5 0 24.06 0 31 6.94 31 15.5 31 24.06 24.06 31 15.5 31zm0-2C22.956 29 29 22.956 29 15.5S22.956 2 15.5 2 2 8.044 2 15.5 8.044 29 15.5 29zm7.5 2a1 1 0 0 1 2 0v12a1 1 0 0 1-1.485.875L15.5 39.429l-8.015 4.446A1 1 0 0 1 6 43V31a1 1 0 0 1 2 0v10.302l7.015-3.89a1 1 0 0 1 .97 0L23 41.301V31zM10.875 16.823a3474.948 3474.948 0 0 1-2.407-2.121 1.364 1.364 0 0 1-.397-1.464c.175-.517.632-.87 1.16-.932l1.336-.143 1.908-.205.305-.033.12-.256.788-1.688.553-1.184A1.389 1.389 0 0 1 15.499 8a1.4 1.4 0 0 1 1.261.798l.552 1.183.789 1.688.12.256a182079.96 182079.96 0 0 1 3.545.382c.53.06.99.414 1.164.934.176.527.013 1.091-.397 1.462l-.991.874a9127.99 9127.99 0 0 1-1.62 1.426l.054.25a9468.34 9468.34 0 0 1 .66 3.095 1.369 1.369 0 0 1-.553 1.396 1.408 1.408 0 0 1-1.484.083l-1.164-.643c-.908-.5-.908-.5-1.663-.918l-.273-.15a269811.572 269811.572 0 0 1-3.106 1.712 1.395 1.395 0 0 1-1.473-.08 1.378 1.378 0 0 1-.556-1.408 1852.645 1852.645 0 0 1 .66-3.09l.054-.248-.203-.179zm1.322-1.5l.642.565.44.387-.123.573-.175.82-.377 1.76 1.657-.913.755-.417.483-.266.483.266.756.417 1.657.914-.375-1.758-.176-.824-.122-.572.44-.387.642-.566 1.339-1.178-1.831-.197-.865-.093-.561-.06-.239-.511-.358-.767-.789-1.688-.788 1.687-.359.768-.238.51-.561.06c-.173.02-.173.02-.865.094l-1.83.196 1.338 1.18z" fill-rule="nonzero"></path>
								</svg>
							</i>
							<span>
								<span class="ratingBar__name">Quality of service</span>
								<span class="ratingBar__rating">
									<span class="ratingBar__ratingForeground" style="width:{{ $rating }}"></span>
								</span>
								<strong>{{ $finRate.'.0' }}</strong>
							</span>
						</li>
						<li class="ratingBar__item" data-columns="3">
							<i class="svgIcon svgIcon__briefcase ratingBar__icon">
								<svg viewBox="0 0 48 41">
									<path d="M44.3 27.917h.933V13.925c0-1.46-1.199-2.86-3.057-3.625H5.825c-1.859.766-3.058 2.164-3.058 3.625v13.992h14.866V24.39a1 1 0 0 1 1-1h10.734a1 1 0 0 1 1 1v3.527H44.3zm-2.133 2h-11.8v.51a1 1 0 0 1-1 1H18.633a1 1 0 0 1-1-1v-.51h-11.8v8.564h36.334v-8.564zM14.567 8.3v-.51c0-3.797 2.855-7.035 6.533-7.035h5.8c3.68 0 6.533 3.236 6.533 7.036V8.3h8.935a1 1 0 0 1 .358.066c2.655 1.02 4.507 3.115 4.507 5.559v14.992a1 1 0 0 1-1 1h-2.066v9.564a1 1 0 0 1-1 1H4.833a1 1 0 0 1-1-1v-9.564H1.767a1 1 0 0 1-1-1V13.925c0-2.445 1.852-4.54 4.509-5.559a1 1 0 0 1 .358-.066h8.933zm13.8 21.126V25.39h-8.734v4.036h8.734zm3.066-21.635c0-2.747-2.018-5.036-4.533-5.036h-5.8c-2.513 0-4.533 2.29-4.533 5.036V8.3h14.866v-.51z" fill-rule="nonzero"></path>
								</svg>
							</i>
							<span>
								<span class="ratingBar__name">Professionalism</span>
								<span class="ratingBar__rating">
									<span class="ratingBar__ratingForeground" style="width:{{ $rating }}"></span>
								</span>
								<strong>{{ $finRate.'.0' }}</strong>
							</span>
						</li>
						<li class="ratingBar__item" data-columns="3">
							<i class="svgIcon svgIcon__flexibility ratingBar__icon">
								<svg viewBox="0 0 48 39">
									<path d="M2 7.6h44V2H2v5.6zm13 15h31V17H15v5.6zm-2 0V17H2v5.6h11zM34 31H2v5.6h32V31zm2 0v5.6h10V31H36zM0 9.6V0h48v9.6H0zm0 15V15h48v9.6H0zm0 14V29h48v9.6H0zM34 0h2v9.5h-2V0z" fill-rule="nonzero"></path>
								</svg>
							</i>
							<span>
								<span class="ratingBar__name">Flexibility</span>
								<span class="ratingBar__rating">
									<span class="ratingBar__ratingForeground" style="width:{{ $rating }}"></span>
								</span>
								<strong>{{ $finRate.'.0' }}</strong>
							</span>
						</li>
						<li class="ratingBar__item" data-columns="3">
							<i class="svgIcon svgIcon__pricing ratingBar__icon">
								<svg viewBox="0 0 47 42">
									<path d="M31.336 4.949c0 3.075-6.897 4.917-15.591 4.917C7.05 9.866.15 8.024.15 4.949.151 1.875 7.054.032 15.745.032c8.691 0 15.591 1.843 15.591 4.917zm-2 0c0-.41-1.24-1.195-3.545-1.81-2.626-.702-6.215-1.107-10.046-1.107-3.83 0-7.42.405-10.047 1.106-2.306.616-3.547 1.402-3.547 1.81 0 .411 1.24 1.196 3.547 1.812 2.627.701 6.216 1.106 10.047 1.106 3.831 0 7.42-.405 10.046-1.106 2.306-.615 3.545-1.4 3.545-1.811zm0 0a1 1 0 0 1 2 0v5.483c0 3.164-6.874 4.917-15.591 4.917C7.025 15.35.15 13.596.15 10.432V4.95a1 1 0 1 1 2 0v5.483c0 .47 1.273 1.262 3.664 1.871 2.614.667 6.186 1.046 9.93 1.046 3.742 0 7.314-.38 9.928-1.046 2.39-.61 3.663-1.4 3.663-1.87V4.948zM15.512 31.754C6.908 31.723.152 29.972.152 26.837V15.941v-5.554a1 1 0 1 1 2 0v5.508c.044.472 1.314 1.246 3.663 1.846 2.615.667 6.187 1.046 9.93 1.046 3.741 0 7.313-.38 9.928-1.046 2.371-.605 3.643-1.39 3.663-1.86v-.011-5.482a1 1 0 0 1 2 0v10.75c8.583.032 15.36 1.87 15.36 4.916V37.02c0 3.164-6.873 4.917-15.593 4.917-8.717 0-15.59-1.753-15.59-4.917v-5.267zm0-2V26.27c-5.787-.02-10.738-.82-13.36-2.294v2.861c0 .47 1.274 1.26 3.664 1.87 2.56.653 6.04 1.031 9.696 1.047zm2 1.04v.743c0 .47 1.274 1.26 3.663 1.87 2.615.667 6.187 1.047 9.928 1.047 3.743 0 7.316-.38 9.93-1.047 2.39-.61 3.664-1.4 3.664-1.87v-2.903c-2.66 1.495-7.717 2.337-13.594 2.337-5.874 0-10.93-.842-13.59-2.338v2.064a1.018 1.018 0 0 1 0 .096zm11.824-9.63v-2.671c-2.657 1.494-7.705 2.294-13.591 2.294-5.887 0-10.936-.8-13.593-2.294v2.861c0 .469 1.274 1.26 3.664 1.87 2.614.667 6.186 1.047 9.928 1.047.207 0 .42-.003.657-.007 1.945-1.812 6.888-2.92 12.935-3.1zm.811 1.982a1.004 1.004 0 0 1-.157.003c-3.407.07-6.562.461-8.932 1.094-1.807.483-2.96 1.07-3.374 1.498-.04.072-.088.138-.143.197a.28.28 0 0 0-.029.116c0 .41 1.24 1.195 3.546 1.81 2.627.702 6.216 1.107 10.045 1.107 3.832 0 7.422-.405 10.048-1.107 2.306-.615 3.546-1.4 3.546-1.81 0-.41-1.24-1.195-3.546-1.81-2.626-.702-6.216-1.107-10.048-1.107-.32 0-.64.003-.956.009zm14.55 11.013c-2.657 1.495-7.706 2.295-13.594 2.295-5.886 0-10.935-.8-13.59-2.295v2.862c0 .47 1.272 1.26 3.662 1.87 2.614.667 6.186 1.047 9.928 1.047 3.744 0 7.316-.38 9.93-1.047 2.39-.61 3.664-1.4 3.664-1.87v-2.862z" fill-rule="nonzero"></path>
								</svg>
							</i>
							<span>
								<span class="ratingBar__name">Value</span>
								<span class="ratingBar__rating">
									<span class="ratingBar__ratingForeground" style="width:{{ $rating }}"></span>
								</span>
								<strong>{{ $finRate.'.0' }}</strong>
							</span>
						</li>
						<li class="ratingBar__item" data-columns="3">
							<i class="svgIcon svgIcon__widget ratingBar__icon">
								<svg viewBox="0 0 19 19">
									<path d="M17.217 6.655V1.793H1.783v4.862h2.9a.5.5 0 0 1 .5.5v1.617L7.777 6.76a.5.5 0 0 1 .306-.105h9.134zm-13.034 1h-2.9a.5.5 0 0 1-.5-.5V1.293a.5.5 0 0 1 .5-.5h16.434a.5.5 0 0 1 .5.5v5.862a.5.5 0 0 1-.5.5H8.255L4.99 10.188a.5.5 0 0 1-.807-.395V7.655zm-2.9 7.62a.5.5 0 0 1-.5-.5V9.5a.5.5 0 0 1 .5-.5H3.07a.5.5 0 0 1 0 1H1.784v4.276H11.2a.5.5 0 0 1 .343.136l2.274 2.138v-1.774a.5.5 0 0 1 .5-.5h2.9V10H8.429a.5.5 0 0 1 0-1h9.288a.5.5 0 0 1 .5.5v5.276a.5.5 0 0 1-.5.5h-2.9v2.43a.5.5 0 0 1-.843.365l-2.972-2.795H1.284z" fill-rule="nonzero"></path>
								</svg>
							</i>
							<span>
								<span class="ratingBar__name">Response time</span>
								<span class="ratingBar__rating">
									<span class="ratingBar__ratingForeground" style="width:{{ $rating }}"></span>
								</span>
								<strong>{{ $finRate.'.0' }}</strong>
							</span>
						</li>
					</ul>
				</div>
				<div class="overflow mb15 pt30 border-top">
                    <p class="adminReviewsItem__counter mt10">{{ count($data['ratingDatas']) }} reviews</p>
                    <div class="adminFiltersSuggest">
                        <input class="adminFiltersSuggest__Search" size="25" type="search" onchange="getSearchReviews(this.value)" placeholder="Search reviews" autocomplete="off" value="{{ $data['searchData'] }}">
                    </div>
                </div>
                @if(!count($data['ratingDatas']) > 0)
				<div class="adminEmpty">
					<i class="adminEmpty__icon adminEmpty__icon--reviews"></i>
					<p class="adminEmpty__description"> You haven't received any reviews yet! </p>
					<a class="btnFlat btnFlat--primary" href="{{url('reviews')}}"> Request reviews </a>
				</div>
				@else
					@foreach($data['ratingDatas'] as $rts)
					<?php
						$shortName = str_replace(substr($rts->name, 1),'',$rts->name);
				        $ratingIndi = '0%';
				        if($rts->average_rating == 1) {
				            $ratingIndi = '20%';
				        } else if($rts->average_rating == 2) {
				            $ratingIndi = '40%';
				        } else if($rts->average_rating == 3) {
				            $ratingIndi = '60%';
				        } else if($rts->average_rating == 4) {
				            $ratingIndi = '80%';
				        } else if($rts->average_rating == 5) {
				            $ratingIndi = '100%';
				        }
					?>
					<ul>
						@if($rts->highlights == 1)
						<li class="adminReviewsItem box" style="border-color:#eac44d;{{$rts->dispute_status == '1' ? 'background: lightcoral;' : ''}}">
						@else
						<li class="adminReviewsItem box" style="{{$rts->dispute_status == '1' ? 'background: lightcoral;' : ''}}">
						@endif
							<div class="adminReviewsItemFooter__highlight">
								
							</div>
							<div class="adminReviewsContent pure-g-r">
								<div class="pure-u-1-9">
									<div class="adminReviewsItem__avatar">
										<div class="avatar">
											<div class="avatar-alias size-avatar-xlarge ">
												<svg class="avatar-generic" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200" preserveAspectRatio="xMidYMin slice">
													<circle fill="#BCB0B5" cx="100" cy="100" r="100"></circle>
													<text transform="translate(100,130)" y="0">
														<tspan font-size="90" class="" fill="rgba(0,0,0,0.3)" text-anchor="middle">{{ strtoupper($shortName) }}</tspan>
													</text>
												</svg>
											</div>
										</div>
									</div>
								</div>
								<div class="pure-u-8-9">
									<div class="mb5">
										<span class="adminReviewsItem__name">{{ $rts->name }}</span>
										<h4 class="pull-right {{$rts->dispute_status == '1' ? '' : 'hidden'}}" style="color:#fff;">Disputed</h4>
									</div>
									<div class="app-review-rating-container mt5">
										<div class="rating-stars-vendor">
											<span class="rating-stars-vendor rating-stars-vendor-bar" style="width: {{ $ratingIndi }}"></span>
										</div>
										<span class="review__ratio ml5">{{ round($rts->average_rating).'.0' }}</span>
									</div>
									<p class="adminReviewsItem__title"><br>
										<strong>{{ $rts->review_title }}</strong>
									</p>
									<p class="adminReviewsItem__description "> {!! nl2br($rts->review_description) !!} </p>
									<time class="adminReviewsItem__send">Sent on {{ date_format(date_create($rts->created_at),'d/m/Y') }}</time>
									@if($rts->reply_text != '')
									<div class="adminReviewsItemAnswer">
										<blockquote class="adminReviewsItemAnswer__block">
											<p class="adminReviewsItemAnswer__title">Reply:</p>
											<p class="adminReviewsItemAnswer__description">{!! $rts->reply_text !!}</p>
											<div class="mt10 mb10">
												<span class="adminReviewsItemAnswer__date">Sent on {{ date_format(date_create($rts->createDate),'d/m/Y') }}</span>
												@if($rts->rStatus == 1)
													<span class="tag tag-green">Validated</span>
												@else
													<span class="tag tag-red">Validated</span>
												@endif
											</div>
											<div class="adminReviewsItem__img">
												<a class="adminReviewsItem__anchor" role="button" onclick="">
													<img src="{{ asset('review_reply_images').'/'.$rts->reply_image }}" width="100">
												</a>
											</div>
										</blockquote>
									</div>
									@endif
									<!-- <span class="tags tag-pending app-capa-pedir-foto-884319"> Asked for a profile picture on 19/09/2019 </span> -->
								</div>
							</div>
							<footer class="adminReviewsItemFooter">
								<div class="pure-g">
									<div class="pure-u-1-3">
										<a class="adminReviewsItemFooter__report" href="{{ url('review-dispute').'/'.encrypt($rts->id) }}" role="button"> Dispute </a>
										@if($rts->dispute_status == '0')
										<a class="@if($rts->highlights == '1') enabled @endif" style="cursor: pointer;" onclick="highlight_reviews('{{ $rts->id }}');">
        									<div class="icheckbox_minimal @if($rts->highlights == '1') checked @endif" style="position: relative;">
        										<input class="app-admin-reviewHighlight" type="checkbox" @if($rts->highlights == '1') checked @endif style="opacity:0;">
        										<ins class="iCheck-helper" style="opacity: 0;"></ins>
        									</div> Highlight
        								</a>
        								@endif
									</div>
									<div class="pure-u-2-3 text-right">
										<!--<ul class="adminReviewsItemFooter__links">
											<li>Share it on:</li>
											<li>
												<a rel="nofollow" class="icon icon-facebook" role="button" onclick=""></a>
											</li>
											<li>
												<a rel="nofollow" class="icon icon-twitter" role="button" onclick=""></a>
											</li>
										</ul>-->
									</div>
								</div>
							</footer>
						</li>
					</ul>
					@endforeach
				@endif
			</div>
	   	</div>
	</div>
</section>

<script>
$( document ).ready(function() {
	$(document).on('mouseover', '.adminReviewsItemFooter__highlight', function() {
		$(this).find('.icheckbox_minimal').addClass('hover');
	});
	$(document).on('mouseout', '.adminReviewsItemFooter__highlight', function() {
		$(this).find('.icheckbox_minimal').removeClass('hover');
	});
});
function highlight_reviews(id) {
	if(id != '') {
        $.ajax({
            url: "{{ url('highlight_reviews') }}/"+id,
            type: "GET",
            data: "",
            success: function (response) {
                if(response == 'done') {
                	location.reload();
                }
            }
        });
    }
};
function getSearchReviews(vals)
{
	window.location.href = "{{ url('reviews-list').'?q=' }}"+encodeURI(vals);
}
</script>
@include('includes.footer')
@endsection