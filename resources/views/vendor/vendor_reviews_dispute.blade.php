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
				$shortName = str_replace(substr($data['ratingData']->name, 1),'',$data['ratingData']->name);
		        $ratingIndi = '0%';
		        if($data['ratingData']->average_rating == 1) {
		            $ratingIndi = '20%';
		        } else if($data['ratingData']->average_rating == 2) {
		            $ratingIndi = '40%';
		        } else if($data['ratingData']->average_rating == 3) {
		            $ratingIndi = '60%';
		        } else if($data['ratingData']->average_rating == 4) {
		            $ratingIndi = '80%';
		        } else if($data['ratingData']->average_rating == 5) {
		            $ratingIndi = '100%';
		        }
	      	?>
			<div class="pure-u-5-7">
				<h1 class="adminTitle">Dispute a review</h1>
				@if(session()->has('reply'))
				{!! session()->get('reply') !!}
				@endif
	            <div class="adminAlert adminAlert--warning">
	                <p>Disputing a review means you are questioning its validity.</p>
	            </div>
	            <h2 class="adminSubtitle">Review to dispute</h2>
	            <ul>
	                <li class="adminReviewsItem box">
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
                                	<span class="adminReviewsItem__name">{{ $data['ratingData']->name }}</span>
                             	</div>
                                <div class="app-review-rating-container mt5">
        							<div class="rating-stars-vendor">
							            <span class="rating-stars-vendor rating-stars-vendor-bar" style="width: {{ $ratingIndi }}"></span>
							        </div>
        							<span class="review__ratio ml5">{{ round($data['ratingData']->average_rating).'.0' }}</span>
        						</div>
	                            <p class="adminReviewsItem__description ">
	                            	{!! nl2br($data['ratingData']->review_description) !!}                                                                 
	                                <time class="adminReviewsItem__send">Sent on {{ date_format(date_create($data['ratingData']->created_at),'d/m/Y') }}</time>
	                            </p>
                        	</div>
                    	</div>
                        <!--<footer class="adminReviewsItemFooter text-right">
                        	@if($data['ratingData']->profile_pic == 0)
                            	<a class="btnOutline btnOutline--primary" onclick="addProfilePictureModal('{{ $data['ratingData']->id }}','{{ $data['ratingData']->name }}');"> Ask for a profile photo </a>
                            @else
                            	<a class="btnOutline btnOutline--primary newbttngreen" href="javascript:void(0)"> Ask for a profile photo </a>
                            @endif
                        </footer>-->
                    </li>
            	</ul>
	            <!--<form class="pure-form mb20" id="frmDenuncia" action="{{ url('save-review-dispute') }}" method="POST">-->
                <form class="pure-form mb20" id="frmDenuncia" action="{{ url('send-new-supports') }}" method="POST">
	            	{{ csrf_field() }}
	                <input name="rateId" type="hidden" value="{{ $data['ratingData']->id }}">
                    <h2 class="adminSubtitle">Reason for dispute</h2>
                    <div class="adminAlert adminAlert--info">
                        <p class="adminAlert__title">Reasons for disputing a review:</p>
                        <p class="adminAlert__description">I never conducted business with this person.</p>
                        <p class="adminAlert__description">Contains profane, vulgar, racist, or adult material.</p>
                        <p class="adminAlert__description">A court ruling has been issued to remove this review.</p>
                        <p class="adminAlert__description">Contains personally identifiable information such as full names, date of birth, personal address, email addresses, etc.</p>
                        <p class="adminAlert__description">Is incorrectly tagged with the wrong type of event.</p>
                        <p class="adminAlert__description">Duplicate of another review.</p>
                    </div>
                    <p class="mt5 mb15 small color-grey">Disputes will only be investigated for these reasons. You cannot dispute a review just because it is not positive enough.</p>
                    <div class="col-sm-6">
                        <select class="form-control" name="subject">
                            <option value="review-dispute">Review Dispute</option>
                        </select>
                    </div>
                    <div class="col-sm-6">
                        <select class="form-control" name="priority">
                            <option value="">- - Select Priority - -</option>
                            <option value="Low">Low</option>
                            <option value="Medium">Medium</option>
                            <option value="High">High</option>
                            <option value="Urgent">Urgent</option>
                        </select>
                    </div>
                    <div class="col-sm-12">
                        <input type="text" name="title" class="form-control" placeholder="Your dispute ticket subject *">
                    </div>
                    <div class="col-sm-12">
                        <div style="border: 1px solid #ddd;">
                            <textarea class="pure-u-1 dispute_text" name="comments" id="dispute_text" rows="10" cols="65" rows="6" placeholder="Write your disputes detailed by here" style="min-height:158px;max-height:408px;"></textarea>
                        </div>
                        <input class="btnFlat btnFlat--primary mt15" type="submit" value="Submit dispute">
                    </div>
	            </form>
			</div>
	   	</div>
	</div>
</section>

<!-- Modal for Add Profile Picture -->
<div id="add-pro-pic" class="modal fade dnone" tabindex="-1" role="dialog" aria-hidden="false" style="display:none;">
    <div class="modal-dialog modal-large">
        <div class="modal-content app-review-request-importer" data-check-selector="icon-tools-checkbox-grey" data-check-selector-green="icon-tools-checkbox-green">
            <button type="button" class="close close-white" data-dismiss="modal" aria-hidden="true">×</button>
            <div class="adminModalImport__title"><h3></h3></div>
            <div class="border-top lazyLoad-effect" data-booked="false">
                <div style="padding:5px;">
                  <input type="hidden" name="userId" id="userId">
                  <textarea class="adminTextarea reviews-textarea app-reviews-textarea" name="userMessage" rows="15" data-allow-enter="true" style="border:2px solid grey;">Thank you so much for leaving us a review on Perfect Wedding Day. Your opinion helps us improve and grow our business each day.

We would like to ask you a favour about the review you left us recently. We noticed that you did not add a profile photo to your account, and the truth is that having a profile picture makes your review much more credible to other couples.

If you could just log in to your account and add a profile picture, we would really appreciate it - all you have to do is click this link.

Thank you in advance! </textarea>
                </div>
            </div>
            <div class="adminModalImport__actions p20 mt5">
                <div class="btnFlat btnFlat--primary import-submit-button app-review-request-import-submit" onclick="addProfilePicture();">Add profile picture</div>
            </div>
        </div>
    </div>
</div>
@include('includes.footer')
<script src="//cdn.tiny.cloud/1/08cq8y02kwr759p88hfbo9ym579ceup2a7x2vebx42n6ceee/tinymce/5/tinymce.min.js"></script>
<script>
    tinymce.init({
        selector:'#dispute_text',
        width: '100%',
        height: 300/*,
        init_instance_callback : function(editor) {
            var freeTiny = document.querySelector('.tox .tox-notification--in');
            freeTiny.style.display = 'none';
        }*/
    });
</script>
<script>
    function addProfilePictureModal(id,name)
    {
        $("#add-pro-pic").modal('show');
        $("#userId").val(id);
        $(".adminModalImport__title").html("<h3> "+name+"'s profile picture </h3>");
    }
    function addProfilePicture()
    {
        var id = $("#userId").val();
        var msgs = $("textarea[name=userMessage]").val();
        if(id != '' && msgs != '') {
            $.ajax({
                url: "{{ url('addProfilePicture') }}",
                type: "POST",
                data: "id="+id+"&msgs="+msgs,
                success: function (response) {
                    if(response == 'done'){
                        location.reload();
                    }
                }
            });
        }
    }
</script>
@endsection