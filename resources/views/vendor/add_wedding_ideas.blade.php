@extends('layouts.default')
@section('content')
@include('includes.menu')

<section class="section-padding dashboard-wrap billing_page_wrp dash_main_sect">
	@include('vendor.tools_nav')
	<div class="wrapper">
		<div class="pure-g">
			<div class="pure-u-2-7">
				<div class="mr40">
					<nav class="adminAside billing_list">
						<a class="adminAside__item  {{ request()->segment(2) == 'blogs' ? 'active' : 'no'  }}" href="{{url('blogs')}}">
							All Blogs
						</a>
						<a class="adminAside__item {{ request()->segment(2) == 'add-blogs' ? 'active' : 'no'  }}" href="{{url('add-blogs')}}">
							Add New Blog
						</a>
					</nav>
				</div>
			</div>
			<div class="pure-u-5-7">
				<h1 class="adminTitle">Add New Blog</h1>

				<div class="adminAlert adminAlert--flex">
                    <i class="icon-vendors-admin-alerts icon-vendors-admin-alerts-reviews"></i>
                    <div>
                       <p class="adminAlert__title review_count">
                          Share your blog....
                       </p>
                    </div>
                </div>

                <div class="reponce-wr">
                	@if (count($errors) > 0)
				        <div class="alert alert-danger">
				            <strong>Whoops!</strong> There were some problems with your input.<br><br>
				            <ul>
				            @foreach ($errors->all() as $error)
				                <li>{{ $error }}</li>
				            @endforeach
				            </ul>
				        </div>
				    @endif

				    @if(session()->has('message'))
					    <div class="alert alert-success">
					        {{ session()->get('message') }}
					    </div>
					@endif
                </div>

                <form class="pure-form mb20" id="reviewrequestSend" name="reviewrequestSend" method="post" action="{{ url('/').'/save-wedding-ideas' }}">
                	{{ csrf_field() }}
                    <div class="border p30 review_reci_frm">
                       <div class="pb5 reviewCollector__addUsers collector_wrp">

                          	<div class="mb10 app-review-collector-templates-user-form">
                              	<div class="pure-u-1 drop-wrapper">
                              	  	<label class="adminFormLabel">Blog Title</label>
                                  	<input class="wi-input" placeholder="Your Idea" name="widdingIdeastitle" type="text" autocomplete="off">
                                  	<span id="nombres_err" style="color:#ff3535;font-size:18px;display:none;">Minimum 3 characters</span>
                              	</div>
                          	</div>

                          	<div class="mb10 app-review-collector-templates-user-form">
	                      		<div class="pure-u-1 drop-wrapper">
	                      			<label class="adminFormLabel">Blog Subtitle</label>
	                              	<input class="wi-input" placeholder="Your Thinking.." name="widdingIdeasSubtitle" type="text" autocomplete="off">
	                              	<span id="mails_err" style="color:#ff3535;font-size:18px;display:none;">Minimum 3 characters</span>
	                              	<span id="invalidMails_err" style="color:#ff3535;font-size:16px;display:none;">The e-mail is missing and/or invalid.</span>
	                          	</div>
                          	</div>

                       </div>

                       <div class="wd-id-cat">
                       		<div class="mb10 pure-u-1-2">
				                <div class="unit">
				                    <label class="adminFormLabel">Parent Category</label>
				                    <div class="mt10">
				                        <div class="select-fake pure-u-1">
				                            <select class="pure-u-1" name="WIparentCatgories" id="WIparentCatgories">
				                                    <option value="">-- Select Category --</option>
				                                    @if(count($data['parentCategory']) > 0)
				                                    	@foreach($data['parentCategory'] as $parentCat)
				                                    		<option value="{{ $parentCat->id }}">{{ $parentCat->title }}</option>
				                                    	@endforeach
				                                    @endif
				                            </select>
				                        </div>
				                    </div>
				                </div>
				            </div>

				            <div class="mb10 pure-u-1-2">
				                <div class="unit">
				                    <label class="adminFormLabel">Sub Category</label>
				                    <div class="mt10">
				                        <div class="select-fake pure-u-1">
				                            <select class="pure-u-1" name="WIparentSubCatgories" id="WIparentSubCatgories">
				                                    <option value="">-- Select Category --</option>
				                            </select>
				                        </div>
				                    </div>
				                </div>
				            </div>
                       </div>

                       <div class="wi-editor" style="margin-top: 30px">
                       <label class="adminFormLabel" style="margin-bottom: 12px">Explain your 'Blog' for all</label>
                       		<textarea id="summernote" name="weddingideastext"></textarea>
                       </div>

                       <div class="mt30 relative collector_wrp">
                      		<input class="btnFlat btnFlat--primary mt15 app-submit-review-request send_btn" type="submit" name="submit" value="Add Your Idea">
                       </div>
                    </div>
                 </form>
				
			</div>
		</div>
	</div>
</section>
@include('includes.footer')

<!-- include summernote css/js -->
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.css" rel="stylesheet">
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.js"></script>

<script type="text/javascript">
	$(document).ready(function() {

		$(document).ready(function() {
		  $('#summernote').summernote({
		  	 placeholder: 'Share you ideas for our Brides and Grooms',
		  	 height: 350
		  });
		});

		$('#WIparentCatgories').on('change', function() {
			var catid = $(this).val();
			$.ajax({
				type: 'GET',
				url: '{{ url("/getsubcategory") }}/'+catid,
				success: function(responce) {
					var responce = JSON.parse(responce);
					if(responce.html) {
						$('#WIparentSubCatgories').html(responce.html);
					}
				}
			});
		});
	});
</script>

@endsection