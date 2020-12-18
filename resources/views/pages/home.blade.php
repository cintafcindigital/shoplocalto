@extends('layouts.default')
@section('meta_title',$pageData->meta_title)
@section('meta_keyword',$pageData->meta_keyword)
@section('meta_description',$pageData->meta_description)
@section('content')
@include('includes.menu')
@include('includes.home-slider')
@php $vendorId = $userId = 0; @endphp
@if(Auth::user())
    @php
        $vendorId = \Auth::user()->vendor_id;
        $userId = \Auth::user()->id;
    @endphp
@endif
<?php error_reporting(0); ?>
@if(isset($pageData['vendors']) && !empty($pageData['vendors']))
<section id="weddy-services" class="section-padding text-center" >
    <div class="container">
    <div class="header-bottom"></div>
        <div class="row">
            <div class="col-md-12 col-lg-12" style="z-index: 999;">
                <div class="common-header service-header text-center">
                    <h3 class="homeSection__title">Featured Health Professionals of the Week</h3>
                </div>
            </div>
            <div class="weddy-main wedding_vendor_wrp weddy-store-carousel">
                @foreach($pageData['vendors'] as $vend)
                <div class="wedding_vendor_list" style="padding: 0 10px;">
                    <div class="weddy-cont" onclick="window.location.href='{{url('vendor')}}/{{$vend->business_name_slug}}'">
                        <div class="weddy-comn weddy-img">
                            <a href="{{url('vendor')}}/{{$vend->business_name_slug}}">
                            @if(file_exists(public_path().'/vendors/VENDOR_'.$vend->vendor_id.'/'.$vend->featured_image) && !empty($vend->featured_image))
                            <figure class="premiumBox__figure img-zoom">
                                <!--&width=285&height=183&crop-to-fit-->
                                <img class="premiumBox__img" src="{{asset('public/cimg/webroot/img.php?src=vendors/VENDOR_'.$vend->vendor_id.'/'.$vend->featured_image)}}" alt="{{$vend->business_name}}" />
                            </figure>
                            @elseif(file_exists(public_path().'/vendors/VENDOR_'.$vend->vendor_id.'/'.$vend->profile) && !empty($vend->profile))
                                <figure class="premiumBox__figure img-zoom">
                                    <!--&width=285&height=183&crop-to-fit-->
                                    <img class="premiumBox__img" src="{{asset('public/cimg/webroot/img.php?src=vendors/VENDOR_'.$vend->vendor_id.'/'.$vend->profile)}}" alt="{{$vend->business_name}}" />
                                </figure>
                            @elseif(file_exists(public_path().'/vendors/VENDOR_'.$vend->vendor_id.'/'.$vend->image) && !empty($vend->image))
                                <figure class="premiumBox__figure img-zoom">
                                    <!--&width=285&height=183&crop-to-fit-->
                                    <img class="premiumBox__img" src="{{asset('public/cimg/webroot/img.php?src=vendors/VENDOR_'.$vend->vendor_id.'/'.$vend->image)}}" alt="{{$vend->business_name}}" />
                                </figure>
                            <!--elseif(file_exists(public_path('/images/category_images').'/'.$vend->cat_image))
                                <figure class="premiumBox__figure img-zoom">
                                    <img class="premiumBox__img" src="{{asset('public/cimg/webroot/img.php?src=images/category_images/'.$vend->cat_image)}}" alt="{{$vend->business_name}}" />
                                </figure>-->
                            @else
                                <figure class="premiumBox__figure img-zoom">
                                    <img class="premiumBox__img" src="{{asset('public/cimg/webroot/img.php?src=vendors/no-profile.jpg')}}" alt="{{$vend->business_name}}" alt="{{$vend->business_name}}" />
                                </figure>
                            @endif
                            </a>
                        </div><!-- 285,183 -->
                        <div class="weddy-comn weddy-text">
                            <a href="{{url('vendor')}}/{{$vend->business_name_slug}}"><h3>{{ $vend->business_name }} </h3></a>
                            <h5>{{isset($vend->category)?$vend->category:(isset($vend->cat)?$vend->cat:'None')}}</h5>
                            <hr>
                            <p class="weddy-comn-description">
                                {{substr(strip_tags($vend->business_detail),0,94)}}...
                            </p>
                            <!--<a href="{{url('vendor')}}/{{$vend->business_name_slug}}">Read more</a>-->
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section><!-- / END WEDDY SERVICE SECTION-->
@endif
<!-- Community section and idea tips -->
<div class="homeArticles">
    <div class="wrapper">
        <div class="pure-g">
            <div class="pure-u-1">
                <div class="pure-s health-wellness-conatiner">
                    <h3 class="homeSection__title">Health & Wellness Community</h3>
                    <p class="homeSection__text mb20">Find & share ideas and informations about your health</p>
                    <div class="homeSection__textSeparator"></div>
                    @if(count($blogCategory) > 0)
                        <div class="row">
                            @foreach($blogCategory as $key => $blogCategory)
                                <div class="app-article-item app-link col-sm-4 col-md-4 col-lg-4 col-xs-12">
                                    <div class="unit app-general-item">
                                        <a href="{{ url('/community').'/'.$blogCategory->slug }}">
                                            <figure class="homeArticles__figure img-zoom articlesect">
                                            <img alt="{{$blogCategory->name}}" class="link homeArticles__img app-general-item-linked health-wellness" src="{{ url('public/images/blogs').'/'.$blogCategory->picture }}">
                                            <figcaption class="homeArticles__text articlecapt">
                                                <span class="community-text">{{$blogCategory->name}}</span>
                                            </figcaption>
                                            </figure>
                                        </a>
                                    </div>
                                </div>
                            @php if($key > 3) break; @endphp
                            @endforeach
                            <div class="app-article-item app-link col-sm-4 col-md-4 col-lg-4 col-xs-12">
                                <div class="unit app-general-item">
                                    <a href="{{ url('/testimonial') }}">
                                        <figure class="homeArticles__figure img-zoom articlesect">
                                        <img alt="Testimony" class="link homeArticles__img app-general-item-linked health-wellness" src="{{ url('public/images/blogs/1593615585_6814_category.jpg') }}">
                                        <figcaption class="homeArticles__text articlecapt">
                                            <span class="community-text">Testimony</span>
                                        </figcaption>
                                        </figure>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                    <hr class="mb30 mt20 mr10">
                    @if(count($blogs) > 0)
                        <div class="row">
                            <h3 class="homeSection__title">Blogs & Community</h3>
                            <p class="homeSection__text mb20">Read about the latest news and updates </p>
                        @foreach($blogs as $blog)
                            <div class="app-article-item col-sm-4 col-md-4 col-lg-4 col-xs-12">
                                <div class="unit app-general-item img-zoom">
                                    <figure class="homePosts__figure">
                                        <a href="{{url('blog-single').'/'.$blog->slug}}">
                                        @if($blog->picture != NULL && !empty($blog->picture) )
                                        <!--&width=338&height=250-->
                                            <img class="link--primary app-general-item-linked homePosts__image" src="{{ url('public/cimg/webroot/img.php?src=images/blogs/'.$blog->picture)}}" alt="{{$blog->name}}" style="/*width: 320px; height: 240px;*/object-fit: contain;width: 100%;height: 250px;">
                                        <!-- elseif($blog->picture != NULL)
                                           <img class="link--primary app-general-item-linked homePosts__image" src="{{url('/public/weddingideas/').'/'.$weddingideasPost->feature_image}}" alt="Wedding Ideas" style="/*width: 320px; height: 240px;*/object-fit: contain;width: 100%;height: 475px;"> -->
                                        @else
                                            <!--&width=338&height=250-->
                                           <img class="articles-featured-small-image" src="{{url('public/cimg/webroot/img.php?src=images/blogs')}}/no-photo.jpg" alt="{{$blog->name}}" style="/*width: 320px; height: 240px;*/object-fit: contain;width: 100%;height: 250px;">
                                        @endif
                                        </a>
                                    </figure>
                                    <div class="homePosts__box">
                                        <span class="homePosts__boxCategory">{{ $blog->categories->name }}</span>
                                        <a class="app-general-item-link homePosts__boxTitle" href="{{url('blog-single').'/'.$blog->slug}}">{{$blog->name}}</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        </div>
                    @endif
                    <a class="btn-outline outline-red shape-square" rel="nofollow" href="{{ url('/blog') }}">All articles</a>
                </div>
            </div>
            <div class="pure-u-1-4">
                @if(count($pageData['groupDiscussion']) > 0)
                <h3 class="homeSection__title">Community</h3>
                <p class="homeSection__text mb20">Ask questions and get advice</p>
                <div class="homeSection__textSeparator"></div>
                <ul class="box">
                    @foreach($pageData['groupDiscussion'] as $groupDiscussion)
                    <li class="homeCommunity__item">
                        <div class="homeCommunity__avatar">
                            <span rel="nofollow" class="app-link app-community-profile-layer avatar">
                                <figure class="size-avatar-small">
                                    @if($groupDiscussion->userinfo->profile_image != '')
                                        <img class="avatar-thumb" alt="{{ $groupDiscussion->userinfo->name }}" src="{{ url('public/storage/USER_') }}{{ $groupDiscussion->userinfo->id }}/{{ $groupDiscussion->userinfo->profile_image }}" style="    object-fit: fill;width: 100%;height: 220px;">
                                    @else
                                        <div class="avatar-alias size-avatar-medium app-discussion-comment-avatar avternot-dis-img">
                                            <svg class="avatar-generic" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200" preserveAspectRatio="xMidYMin slice">
                                                <circle fill="#9AAAB0" cx="100" cy="100" r="100"></circle>
                                                <text transform="translate(100,130)" y="0">
                                                    <tspan font-size="90" class="" fill="rgba(0,0,0,0.3)" text-anchor="middle">{{ ucfirst( $groupDiscussion->userinfo->name[0]) }}</tspan>
                                                </text>
                                            </svg>
                                        </div>
                                    @endif
                                </figure>
                            </span>
                        </div>
                        <div class="homeCommunity__content">
                            <a class=" homeCommunity__title" href="{{ url('community/forums') }}/{{ str_slug($groupDiscussion->discussion_title) }}">
                                {{ substr( $groupDiscussion->discussion_title, 0, 40)  }}...
                            </a>
                            <p class=" homeCommunity__date">
                            {{ $groupDiscussion->userinfo->name }}, {{ date('d-F-Y', strtotime( $groupDiscussion->created_at ) ) }}</p>
                            <p class=" homeCommunity__description">{{ strip_tags(mb_strimwidth($groupDiscussion->discussions_text, 0, 180, '...')) }}</p>
                        </div>
                    </li>
                    @endforeach
                    <li>
                        <a href="{{ url('/community') }}" class="homeCommunity__more link--primary">View all discussions</a>
                    </li>
                </ul>
                @endif
            </div>
        </div>
    </div>
</div><!-- End Community section and idea tips -->
<!-- Wedding Dress part -->
<div class="homeSection homeCatalog">
    <div class="wrapper">
        <p class="homeSection__extraTitle">Your roadmap to ultimate health</p>
        <h3 class="homeSection__title mb10">Symptoms, pathology & treatments</h3>
        <p class="homeSection__text homeSection__text--wrapped mb20">
            Why do you want to consult a health professional?    </p>
        <div class="homeSection__textSeparator"></div>
        <div class="homeCatalog__categories">
            <div class="homeCatalog__categoriesItem">
                <span class="app-link" data-href="/search?search=mental-health">
                    <!-- <i class="icon-catalog-categories icon-catalog-categories-bride-dress block mb15"></i> -->
                    <a href="{{ url('/search?search=mental-health') }}"> <img src="{{url('public/images/mental-health.png')}}" style="object-fit: contain;" class="img-responsive">Mental Health</a>
                </span>
            </div>
            <div class="homeCatalog__categoriesItem">
                <span class="app-link" data-href="/search?search=physical-health">
                    <!-- <i class="icon-catalog-categories icon-catalog-categories-dress block mb15"></i> -->
                    <a href="{{ url('/search?search=physical-health') }}"><img src="{{url('public/images/physical-health.png')}}" style="object-fit: contain;" class="img-responsive"> Physical Health</a>
                </span>
            </div>
        </div>
        <!-- <span class="btn-outline outline-red mt40 app-link seegallery">
           <a href="{{ url('/wedding-dress') }}"> &nbsp;See gallery&nbsp;</a>
        </span> -->
    </div>
</div><!-- End Wedding Dress part -->

<!-- SUBSCRIBE SECTION START-->
<section id="companies" class="section-padding">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="common-header text-center">
                    <h3 class="homeSection__title mt35">Search for Your Category</h3>
                </div>
            </div>
            @php
                $key = 0;
                $images = ['mental-health.jpg','physical-health.jpg','enterprise.jpg','vendors-health.jpg'];
            @endphp
            @if(isset($category) && !empty($category))
            @foreach($category as $cats)
            @if($key < 4)
            <div class="col-md-3">
                <div class="qc_comp category-main-page" >
                    <a href="{{url('category/'.$cats['slug'])}}" class="category-main-img" >
                        <span class="cover"></span>
                        <img src="{{url('public/cimg/webroot/img.php?src=images/category_images/'.$cats['image'])}}" class="img-responsive">
                        <!--<img src="{{url('public/cimg/webroot/img.php?src=images/category_images/'.$cats['image'])}}" class="img-responsive visible-xs">-->
                        <span class="title">{{$cats['title']}}</span>
                    </a>
                    <div class="col-md-12">
                        <ul class="Category-list" style="width:100%;">
                            @if(isset($cats['child']) && !empty($cats['child']))
                             @foreach($cats['child'] as $ch0)
                              <li><a href="{{url('category')}}/{{$ch0['slug']}}">{{$ch0['title']}}</a></li>
                             @endforeach
                            @else
                              <li><a href="#">Coming Soon</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
            @else
            @php
                break;
            @endphp
            @endif
            @php
                $key++;
            @endphp
            @endforeach
            @endif
        </div>
    </div>
</section><!-- / END SUBSCRIBE SECTION-->
@include('includes.footer')
<script>
$('body').on('click', '.app-link', function() {
    var curUrl = $(this).attr('data-href');
    window.location.href = curUrl;
});
</script>
@endsection