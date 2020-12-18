@extends('layouts.default')
@section('meta_title',$pageData->meta_title)
@section('meta_keyword',$pageData->meta_keyword)
@section('meta_description',$pageData->meta_description)
@section('content')
@include('includes.menu')
<style type="text/css">
	.about-us-title {
		/*content: "";*/
	    /*display: block;*/
	    /*margin: auto 0;*/
	    /*width: 20%;*/
	    /*padding-top: 20px;*/
	    border-bottom: 2px solid #fff;
	    border-bottom-width: medium;
	}
	.card {
	  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
	  transition: 0.3s;
	  width: 95%;
	}
	.card img {
		width: 100%;
	    object-fit: cover;
	    height: 350px;
	}
	.card:hover {
	  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
	}

	.card-container {
	  padding: 2px 16px;
	}
	.card-container h4 {
		text-align: center;
	    font-size: 22px;
	    font-weight: 400;
	    color: #000 !important;
	    padding: 10px 0;
	}
	@media(max-width:575px){
	    .card {
	        width: 100%;
	    }
	}
</style>
  <!-- SLIDER SECTION START -->
        <section id="slider-seciton">
                   <div class="header-bottom"></div>
                <div id="myCarousel" class="carousel slide inner-slider about-us" data-ride="carousel" style="background:url({{ URL::asset('public/sliders') }}/{{ $pageData['image'] }}) center center;">
                    <!-- Indicators -->                   
                    <!-- Wrapper for slides -->
                    <div class="carousel-inner" role="listbox" style="position:relative">                                
                             <div class="container">    
                                    <!-- <div class="slider-cont"> -->
                                    @if( $pageData['id'] == 3 || $pageData['id'] == 5)
                                        @include('includes.search')
                                    @else
                                      <div class="slider-cont" style="font-size: 52px;color: #fff;font-weight: 600;">
                                      	<span class="about-us-title">
                                       {{ strip_tags($pageData['image_description']) }}</span>
                                       </div>
                                    @endif
                                    <!-- </div> -->
                                    </div>               
                        <div class="item slider-background active custom-height" style="height: 350px;"></div>
                    </div>
                </div>           
        </section>
       <!-- / END SLIDER SECTION -->
       <div class="wrapper wrapper--blood text-justify" style="padding: 3% 0%;font-size: 18px;">
       	<div class="row">
       		<div class="col-sm-12">
       			{!! $pageData->description !!}
       		</div>
       	</div>
       	<br>
       	<div class="row">
       		@foreach($bios as $bio)
       		<div class="col-sm-4">
       			<div class="card">
       				<a href="{{url('bio/'.$bio->url)}}">
						<img src="{{ URL::asset('public/sliders') }}/{{$bio->image}}" alt="Avatar">
					</a>
					<div class="card-container">
						<a href="{{url('bio/'.$bio->url)}}"><h4>{{$bio->title}}</h4></a>
						<p></p> 
					</div>
				</div>
       		</div>
       		@endforeach
       	</div>
       </div>
<!-- {{print_r($pageData)}} -->

@include('includes.footer')
@endsection