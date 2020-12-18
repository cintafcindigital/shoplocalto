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
						<a class="adminAside__item  {{ request()->segment(2) == 'blogs' ? 'active' : 'no'  }}" href="{{url('blogs')}}"> All Blogs </a>
						<a class="adminAside__item {{ request()->segment(2) == 'add-blogs' ? 'active' : 'no'  }}" href="{{url('add-blogs')}}"> Add New Blogs </a>
					</nav>
				</div>
			</div>
			<div class="pure-u-5-7">
				<h1 class="adminTitle">All Blogs By You</h1>
			    @if(session()->has('message'))
				    <div class="alert alert-success">
				        {{ session()->get('message') }}
				    </div>
				@endif
				<div class="allwedding-ideas">
					@if(count($data['weddingPost']) > 0)
						@foreach($data['weddingPost'] as $weddingpost)
							<div class="wedding-idea-post wi-{{ $weddingpost->id }}" style="margin:10px 0;padding:10px 0 20px;border-bottom:1px solid #ccc;box-shadow:0 4px 3px -2px #ccc;">
								<div class="row">
									<div class="no-margin col-xs-12 col-sm-12 col-md-4 image-holder">
										<div class="" style="opacity: 1; display: block;">
											<div class="">
												<div class="image-gallery">
													<div class="image">
														@if($weddingpost->feature_image != NULL && strpos($weddingpost->feature_image, '/') != false )
															<img style="width: 100%" src="{{ $weddingpost->feature_image }}" alt="">
														@elseif($weddingpost->feature_image != NULL)
															<img style="width: 100%" src="{{ url('/public/weddingideas').'/'.$weddingpost->feature_image }}" alt="">
														@else
															<img style="width: 100%" src="{{ url('/public/weddingideas') }}/vintage-wedding-ideas-meme.jpg" alt="wedding Ideas">
														@endif
													</div>
												</div>
											</div>
										</div><!-- Vandor Gallery -->
									</div><!-- /.image-holder -->
									<div class="no-margin col-xs-12 col-md-8 col-sm-12 body-holder">
										<div class="body">
											<div class="wi-title-post-wr" style="margin-bottom: 5px; padding-bottom: 7px; border-bottom: 1px solid #ccc">
												<div class="title" style="margin-bottom: 5px">
													<a href="javascript:;"><h3> {{ str_limit($weddingpost->post_title, 55, '...') }} </h3></a>
												</div>
												<div class="brand">
													{{ $weddingpost->parentCategory->title }} / {{ $weddingpost->subCategory->title }}
												</div>
											</div>
											<div class="clear"></div>
											<div class="excerpt">
												<p> {{ str_limit($weddingpost->post_sub_title, 140, '...') }}</p>
											</div>
											<div class="addto-compare text-right" style="margin-top: 12px">
												<a class="readmore-btn" href="{{ url('edit-wedding-ideas').'/'.$weddingpost->id }}">Edit</a>
											</div>
										</div>
									</div><!-- /.body-holder -->
								</div><!-- /.row -->
							</div>
						@endforeach
					@else
					@endif
				</div>
			</div>
		</div>
	</div>
</section>
@include('includes.footer')
@endsection