@extends('layouts.default')
@section('meta_title',$title.($slug != null ? ' | '.ucfirst($slug) : ''))
@if(isset($data['pageData']))
@section('meta_keyword',$data['pageData']->meta_keyword)
@section('meta_description',$data['pageData']->meta_description)
@endif
@section('content')
@include('includes.menu')
<section id="slider-seciton">
    <div class="header-bottom"></div>
    <div id="myCarousel" class="carousel slide inner-slider" data-ride="carousel">
        <div class="carousel-inner" role="listbox" style="background:url({{URL::asset('public/pages')}}/{{Request::is('blog'.(empty($slug)?'':'/'.$slug))?'back-ground-3.jpg':'back-ground-5.jpg'}});background-size:cover;height: 350px;position: relative;">
            <span style="position: absolute;width: 100%;height: 100%;background: #0000007a;">
                <h1 class="banner-title">{{Request::is('blog'.(empty($slug)?'':'/'.$slug))?'BLOG':'COMMUNITY'}}</h1>
            </span>
        </div>
    </div>
</section>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0-11/css/all.css">
<div class="wrapper wrapper--blood">
<div class="row blog-cols">
	<div class="col-sm-9">
    <section class="relatedpost">
        @if(!empty($slug))
        <p>Category : <strong>{{$blogCat->name}}</strong></p>
        @else
        <p>Category : <strong>All Categories</strong></p>
        @endif
        <hr class="my-4">
        <div class="row">
    @if(isset($blogs) && count($blogs) > 0)
	@foreach($blogs as $key => $blog)
	<div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="blog shadow-sm" style="min-height: 0;">
                            <div class="blog-img" style="display:none;">
                                <!-- <img src="{{url('public/cimg/webroot/img.php?src=images/blogs')}}/{{$blog->picture == null?'no-img.png':$blog->picture}}&width=480&height=300&crop-to-fit" class="img-responsive" alt="blog-image"> -->
                                <img src="{{url('public/cimg/webroot/img.php?src=images/blogs')}}/{{$blog->picture == null?'no-img.png':$blog->picture}}&width=254&height=169&crop-to-fit" class="img-responsive" alt="{{$blog->name}}">
                                <span class="blog-category">{{$blog->categories['name']}}</span>
                                <span class="blog-category right">{{$blog->day}} - {{substr($blog->month,0,3)}}</span>
                                <!-- <span class="blog-category share"><i class="fas fa-share-alt"></i>
                                    <div class="share_social-wpapper">
                                        <ul>
                                            <li><a href=""><i class="fab fa-facebook-f"></i></a></li>
                                            <li><a href=""><i class="fab fa-pinterest"></i></a></li>
                                            <li><a href=""><i class="fab fa-twitter"></i></a></li>
                                        </ul>
                                    </div>
                                </span> -->
                            </div>
                            <div class="col-sm-4 col-lg-4 col-md-4 col-xs-12">
                                <!--&width=254&height=169&crop-to-fit-->
                                <a href="{{$single_url}}/{{$blog->slug}}"><img src="{{url('public/cimg/webroot/img.php?src=images/blogs')}}/{{$blog->picture == null?'no-img.png':$blog->picture}}" class="img-responsive blog-picture" alt="{{$blog->name}}"></a>
                            </div>
                            <div class="col-sm-8 col-lg-8 col-md-8 col-xs-12">
                            <div class="blog-info">
                                <h3 class="post-title"><a href="{{$single_url}}/{{$blog->slug}}">{{$blog->name}}</a></h3>
                                <p class="mb-4">{!! substr(strip_tags($blog->excerpt),0,500) !!}...</p>
                                <a href="{{$url}}/{{$blog->category_slug}}" style="float: left;"><span class="author"><i class="fas fa-tag align-baseline"></i>&nbsp; {{$blog->category}}</span></a>
                                <a href="{{$single_url}}/{{$blog->slug}}" class="blogreadmore">{{Request::is('blog'.(empty($slug)?'':'/'.$slug))?'Read More':'Read and Comment'}} <i class="fas fa-arrow-right align-middle"></i></a>
                            </div>
                            </div>
                        </div>
                            <hr>
                    </div>
	<!-- <div class="col-sm-5">
		<div class="blog-lit-item">
		<div class="blog-image">
			<img src="{{$blog->picture == null || $blog->picture == '' ? url('public/cimg/webroot/img.php?src=images/no-img.png') : url('public/cimg/webroot/img.php?src=images/blogs/'.$blog->picture)}}&width=480&height=300&crop-to-fit" class="img-responsive">
		</div>
		<div class="blog-list-content">
			<h4><a href="{{url('main-blog-single')}}/{{$blog->slug}}">{{$blog->name}}</a></h4>
			<ul class="list-inline">
				<li><i class="fa fa-user"></i> User</li>
				<li><i class="fa fa-calendar"></i> 23 June 2020</li>
			</ul>
			<p>{{strip_tags($blog->excerpt)}}</p>
			<a href="" class="blogrml">Read More <i class="fa fa-angle-right"></i></a>
		</div>
		</div>
	</div> -->
	@if(($key+1)%2==0)
	<!-- <div class="col-sm-2"></div> -->
	@endif
	@endforeach
		<div class="col-sm-12 text-center">
			{{$blogs->links()}}
		</div>
    @else
        <div class="col-sm-12 text-center" style="position: relative;height: 250px;">
            <h1 style="position: absolute;left: 34%;top: 50%;">No Articles !!</h1>
        </div>
    @endif
        </div>
    </section>
</div>
    <div class="col-sm-3 col-xs-12">
        <div class="row">
            <div class="col-sm-12 blog-categgory" style="padding-top: 50px;">
                <h3>CATEGORIES</h3>
                <hr class="my-4">
        		<ul>
                    <li><a href="{{$url}}">All Categories</a></li>
        			@foreach($categories as $cat)
        			<li><a href="{{$url}}/{{$cat->slug}}">{{$cat->name}}</a></li>
        			@endforeach
        		</ul>
            </div>
        </div>
	</div>
	<!-- <div class="col-sm-3">
		
	</div> -->
</div>
</div>
<!-- {{print_r($blogs)}} -->
@include('includes.footer')
@endsection