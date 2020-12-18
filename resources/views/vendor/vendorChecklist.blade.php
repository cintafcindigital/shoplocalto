@extends('layouts.default')
@section('meta_title',$data['titleData']->meta_title)
@section('meta_keyword',$data['titleData']->meta_keyword)
@section('meta_description',$data['titleData']->meta_description)
@section('content')
@include('includes.menu')
<section class="section-padding dashboard-wrap review_main_wrp dash_main_sect">
	@include('vendor.tools_nav')
    <div class="wrapper">
		<div class="pure-g adminChecklistHero">
			<div class="pure-u mr30">
				<div class="adminChecklistHero__circle app-va-percentage dnone" data-percent="25" data-size="90" data-line="6" style="display:block;width:90px;height:90px;line-height:90px;">
					<canvas id="myCanvas" width="90" height="90"></canvas>
				</div>
			</div>
       		<div class="pure-u-5-6">
                <h1 class="adminTitle adminTitle--blood">Complete your Professional Profile</h1>
                <h2 class="adminChecklistHero__subtitle">You are just one step away from completing your My Health Squad Profile</h2>
                <p class="adminChecklistText">Complete your profile so engaged people have more information about your business and are more likely to contact you.</p>
            </div>
		</div>
		<div class="pure-g-- mb20--">
    		<div class="row">
            	<div class="col-sm-3">
            		@if($vendor_progress_basic == 'no')
                    <div class="adminChecklistItem app-link" data-href="{{url('storefront')}}">
                        <header class="adminChecklistItem__header">
                            <i class="icon-vendors-admin-checklist icon-vendors-admin-checklist-info"></i>
                        </header>
                        <footer class="adminChecklistItem__footer">
                            <p><a id="lnkSugerencia" href="{{url('storefront')}}">Complete your basic information</a></p>
                        </footer>
                    </div>
                    @elseif($vendor_progress_basic == 'yes')
                	<div class="adminChecklistItem adminChecklistItem--complete">
                        <header class="adminChecklistItem__header">
                            <i class="fa fa-check" aria-hidden="true"></i>
			                <i class="icon-vendors-admin-checklist icon-vendors-admin-checklist-info"></i>
                        </header>
                        <footer class="adminChecklistItem__footer">
                            <p><span class="adminChecklistItem__label">You have completed all of your basic information.</span></p>
                        </footer>
                	</div>
                	@endif
            	</div>
                <div class="col-sm-3">
            		@if($vendor_progress_images == 'no')
                    <div class="adminChecklistItem app-link" data-href="{{url('gallery')}}">
                        <header class="adminChecklistItem__header">
                            <i class="icon-vendors-admin-checklist icon-vendors-admin-checklist-photos"></i>
                        </header>
                        <footer class="adminChecklistItem__footer">
                            <p><a id="lnkSugerencia" href="{{url('gallery')}}">Upload 4 photos</a></p>
                        </footer>
                    </div>
                    @elseif($vendor_progress_images == 'yes')
                	<div class="adminChecklistItem adminChecklistItem--complete">
                        <header class="adminChecklistItem__header">
                            <i class="fa fa-check" aria-hidden="true"></i>
			                <i class="icon-vendors-admin-checklist icon-vendors-admin-checklist-photos"></i>
                        </header>
                        <footer class="adminChecklistItem__footer">
                            <p><span class="adminChecklistItem__label">You have uploaded 5 photos</span></p>
                        </footer>
                	</div>
                	@endif
            	</div>
                <div class="col-sm-3">
            		@if($vendor_progress_address == 'no')
                    <div class="adminChecklistItem app-link" data-href="{{url('storefront-map')}}">
                        <header class="adminChecklistItem__header">
                            <i class="icon-vendors-admin-checklist icon-vendors-admin-checklist-location"></i>
                        </header>
                        <footer class="adminChecklistItem__footer">
                            <p><a id="lnkSugerencia" href="{{url('storefront-map')}}">Add your business address</a></p>
                        </footer>
                    </div>
                    @elseif($vendor_progress_address == 'yes')
                	<div class="adminChecklistItem adminChecklistItem--complete">
                        <header class="adminChecklistItem__header">
                            <i class="fa fa-check" aria-hidden="true"></i>
			                <i class="icon-vendors-admin-checklist icon-vendors-admin-checklist-location"></i>
                        </header>
                        <footer class="adminChecklistItem__footer">
                            <p><span class="adminChecklistItem__label">You have indicated<br> your address</span></p>
                        </footer>
                	</div>
                	@endif
            	</div>
                <div class="col-sm-3" style="display: none;">
            		@if($vendor_progress_faqs == 'no')
                    <div class="adminChecklistItem app-link" data-href="{{url('storefront-faqs')}}">
                        <header class="adminChecklistItem__header">
                            <i class="icon-vendors-admin-checklist icon-vendors-admin-checklist-faqs"></i>
                        </header>
                        <footer class="adminChecklistItem__footer">
                            <p><a id="lnkSugerencia" href="{{url('storefront-faqs')}}">Fill out all of your FAQs</a></p>
                        </footer>
                    </div>
                    @elseif($vendor_progress_faqs == 'yes')
                	<div class="adminChecklistItem adminChecklistItem--complete">
                        <header class="adminChecklistItem__header">
                            <i class="fa fa-check" aria-hidden="true"></i>
			                <i class="icon-vendors-admin-checklist icon-vendors-admin-checklist-faqs"></i>
                        </header>
                        <footer class="adminChecklistItem__footer">
                            <p><span class="adminChecklistItem__label">You have filled out all of your FAQs</span></p>
                        </footer>
                	</div>
                	@endif
            	</div>
                <div class="col-sm-3" style="display: none;">
            		@if($vendor_progress_deals == 'no')
                    <div class="adminChecklistItem app-link" data-href="{{url('promociones')}}">
                        <header class="adminChecklistItem__header">
                            <i class="icon-vendors-admin-checklist icon-vendors-admin-checklist-promos"></i>
                        </header>
                        <footer class="adminChecklistItem__footer">
                            <p><a id="lnkSugerencia" href="{{url('promociones')}}">Add a deal for potential clients</a></p>
                        </footer>
                    </div>
                    @elseif($vendor_progress_deals == 'yes')
                	<div class="adminChecklistItem adminChecklistItem--complete">
                        <header class="adminChecklistItem__header">
                            <i class="fa fa-check" aria-hidden="true"></i>
			                <i class="icon-vendors-admin-checklist icon-vendors-admin-checklist-promos"></i>
                        </header>
                        <footer class="adminChecklistItem__footer">
                            <p><span class="adminChecklistItem__label">Added a deal for potential clients</span></p>
                        </footer>
                	</div>
                	@endif
                </div>
                <!-- <div class="col-sm-3">
            		@if($vendor_progress_tenHDimages == 'no')
                    <div class="adminChecklistItem app-link" data-href="{{url('gallery')}}">
                        <header class="adminChecklistItem__header">
                            <i class="icon-vendors-admin-checklist icon-vendors-admin-checklist-photoshd"></i>
                        </header>
                        <footer class="adminChecklistItem__footer">
                            <p><a id="lnkSugerencia" href="{{url('gallery')}}">Upload 10 high-quality photos</a></p>
                        </footer>
                    </div>
                    @elseif($vendor_progress_tenHDimages == 'yes')
                	<div class="adminChecklistItem adminChecklistItem--complete">
                        <header class="adminChecklistItem__header">
                            <i class="fa fa-check" aria-hidden="true"></i>
			                <i class="icon-vendors-admin-checklist icon-vendors-admin-checklist-photoshd"></i>
                        </header>
                        <footer class="adminChecklistItem__footer">
                            <p><span class="adminChecklistItem__label">You have uploaded 10 high-quality photos</span></p>
                        </footer>
                	</div>
                	@endif
                </div> -->
                <div class="col-sm-3">
            		@if($vendor_progress_videos == 'no')
                    <div class="adminChecklistItem app-link" data-href="{{url('videos')}}">
                        <header class="adminChecklistItem__header">
                            <i class="icon-vendors-admin-checklist icon-vendors-admin-checklist-video"></i>
                        </header>
                        <footer class="adminChecklistItem__footer">
                            <p><a id="lnkSugerencia" href="{{url('videos')}}">Upload a video</a></p>
                        </footer>
                    </div>
                    @elseif($vendor_progress_videos == 'yes')
                	<div class="adminChecklistItem adminChecklistItem--complete">
                        <header class="adminChecklistItem__header">
                            <i class="fa fa-check" aria-hidden="true"></i>
			                <i class="icon-vendors-admin-checklist icon-vendors-admin-checklist-video"></i>
                        </header>
                        <footer class="adminChecklistItem__footer">
                            <p><span class="adminChecklistItem__label">You have uploaded a video</span></p>
                        </footer>
                	</div>
                	@endif
                </div>
                <div class="col-sm-3">
            		@if($vendor_progress_reviewAsk == 'no')
                    <div class="adminChecklistItem app-link" data-href="{{url('reviews')}}">
                        <header class="adminChecklistItem__header">
                            <i class="icon-vendors-admin-checklist icon-vendors-admin-checklist-reviews"></i>
                        </header>
                        <footer class="adminChecklistItem__footer">
                            <p><a id="lnkSugerencia" href="{{url('reviews')}}">Ask 5 clients for reviews</a></p>
                        </footer>
                    </div>
                    @elseif($vendor_progress_reviewAsk == 'yes')
                	<div class="adminChecklistItem adminChecklistItem--complete">
                        <header class="adminChecklistItem__header">
                            <i class="fa fa-check" aria-hidden="true"></i>
			                <i class="icon-vendors-admin-checklist icon-vendors-admin-checklist-reviews"></i>
                        </header>
                        <footer class="adminChecklistItem__footer">
                            <p><span class="adminChecklistItem__label">You have asked 5 clients for reviews</span></p>
                        </footer>
                	</div>
                	@endif
	            </div>
            </div>
		</div>
	</div>
</section>
@include('includes.footer')
<script>
    $(document).ready(function(){
        $('body').on('click','.app-link',function(){
            var curUrl = $(this).attr('data-href');
            window.location.href = curUrl;
        });
    });
	function degreesToRadians(deg) {
		return (deg/180) * Math.PI;
	}
	function percentToRadians(percentage) {
		// convert the percentage into degrees
		var degrees = percentage * 360 / 100;
		// and so that arc begins at top of circle (not 90 degrees) we add 270 degrees
		return degreesToRadians(degrees + 270);
	}
	function drawPercentageCircle(percentage, radius, canvas) {
		var context = canvas.getContext('2d');
		canvas.style.backgroundColor = '#0000';
		var x = canvas.width / 2;
		var y = canvas.height / 2;
		var startAngle = percentToRadians(0);
		var endAngle = percentToRadians(percentage);
		// set to true so that we draw the missing percentage
		var counterClockwise = true;
		context.beginPath();
		context.arc(x, y, radius, startAngle, endAngle, counterClockwise);
		context.lineWidth = 5;
		// line color
		context.strokeStyle = '#dadada';
		context.stroke();
		// set to false so that we draw the actual percentage
		counterClockwise = false;
		context.beginPath();
		context.arc(x, y, radius, startAngle, endAngle, counterClockwise);
		context.lineWidth = 5;
		// line color
		context.strokeStyle = '#4baa3b';
		context.stroke();
		// now draw the inner text
		context.font = radius/1.8 + "px Helvetica";
		context.fillStyle = "#4baa3b";
		context.textAlign = "center";
		// baseline correction for text
		context.fillText(percentage+"%", x, y*1.2);
	}
	// implantation happens here
	var canvas = document.getElementById('myCanvas');
	var percentage = "{{$vendor_progress_percentage}}";
	var radius;
	if (myCanvas.height < myCanvas.width) {
		radius = myCanvas.height / 2.2;
	} else {
		radius = myCanvas.width / 2.2;
	}
	drawPercentageCircle(percentage, radius, canvas);
</script>
@endsection