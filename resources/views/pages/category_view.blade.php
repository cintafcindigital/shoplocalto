@extends('layouts.default')
@section('meta_title','My Health Squad | '.$categoryData->title)
@section('meta_keyword',$categoryData->search_keywords )
@section('meta_description',$categoryData->description)
@section('content')
@include('includes.menu')
<style type="text/css">
	.slider-cont > p {
		font-size: 28px !important;
	    font-weight: 400 !important;
	}
</style>
<section id="slider-seciton">
	<div class="header-bottom"></div>
	<div class="carousel slide inner-slider" data-ride="carousel" style="background:url({{ URL::asset('public/images/category_images') }}/{{ $categoryData->is_parent == 1 ? $categoryData->image : $categoryData->image2 }});background-size: 100%;height: 350px;background-repeat: no-repeat;background-position: center;background-attachment: fixed;">
		<div class="carousel-inner" role="listbox" style="position:relative">                                
			<div class="container">    
				<div class="slider-cont" style="font-size: 52px;color: #fff;font-weight: 600;">
					<!-- {!! $pageData['image_description'] !!} -->
					<span style="border-bottom: 2px solid #fff;border-bottom-width: medium;line-height: 70px;">{{$categoryData->meta_title}}</span>
				</div>
			</div>               
			<div class="item slider-background active custom-height" style="height: 350px;background: rgb(0 0 0 / 62%) !important;"></div>
		</div>
	</div>
</section>
<div class="wrapper wrapper--blood" style="padding-top: 3%;">
	<!-- @if(!empty($categoryData->icon))
	<img src="{{url('public/cimg/webroot/img.php?src=images/category_icons/'.$categoryData->icon)}}&width=124&height=124&crop-to-fit" style="padding-bottom: 3%;">
	@endif -->
	<div class="row" style="">
		<div class="col-sm-12">
			<p>
				@if(!empty($categoryData->icon))
				<!--&width=124&height=124&crop-to-fit-->
				<img src="{{url('public/cimg/webroot/img.php?src=images/category_icons/'.$categoryData->icon)}}" class="img-responsive pull-left category-icon-view">
				@endif
				{!! $categoryData->description !!}</p>
		</div>
	</div>
	<div class="row" style="padding-bottom: 3%;">
		<div class="col-sm-12 text-center">
			<hr>
			<p>Find <span style="font-weight: bold;font-size: 18px;">{{$categoryData->title}}</span> Professionals in your area.</p>
			<a class="adminLandingCta" href="{{url('search?category='.$categoryData->slug)}}">Search Now</a>
		</div>
	</div>
</div>
@include('includes.footer')
@endsection