@extends('layouts.default')
@section('meta_title',$pageData->meta_title)
@section('meta_keyword',$pageData->meta_keyword)
@section('meta_description',$pageData->meta_description)
@section('content')
@include('includes.menu')
<style>
.weddy-contact-form input {
   color: #6A6C72;
}
.textarea textarea {
    color: #6A6C72;
    margin-left: -10px;
}
/*.navbar-default {*/
/*    padding: 0px 0 18px 0!important;*/
/*}*/
.menu-top-wrapper {
    padding: 0px!important;
}
.menu-top-access {
    color: #888181!important; 
    font-size: 11px!important;
}
.app-profile-top-fixed-bar{ box-shadow: none!important; }
.featured_slider .slick-list.draggable {
    padding:0px !important;
}
.featured_slider .fa-angle-left.slick-arrow {
    top: 50%;
    position: absolute;
    z-index: 11;
    font-size: 62px;
    color: #fff;
    left: 10px;
}
.featured_slider .fa-angle-right.slick-arrow {
    position: absolute;
    right: 0px;
    top: 50%;
    font-size: 62px;
    color: #fff;
    right: 10px;
}
.slick-arrow:hover {
    cursor:pointer;
}
.slick-slide img {
    /*width: 400px;*/
    width: auto;
    height:465px;
} 
.slick-slide.slick-active {
    transform: scale(0.9,0.9);
}
.slick-slide.slick-active.slick-center {
    transform: scale(1.2,1.2);
    position: relative;
    z-index: 11;
} 
.btnCls {
    color: #000;
    padding: 10px;
    border-radius: 5px;
    font-size: 17px;
    border: 2px solid #c3153b;
    width: 59%;
    background-color: #fff;
}
.btnCls:focus {
    outline: none !important;
    -moz-outline: none !important;
    -ms-outline: none !important;
    -o-outline: none !important;
    -webkit-outline: none !important;
}
.btnCls:hover {
    color: #000;
    text-decoration: none;
}
.photo-image-carousal {
    width:750px;
    height:500px;
}
.btn-single-outline {
    padding:12px 27px 12px 27px !important;
    margin-left:0 !important;
}
@media (max-width: 575px){
    .slick-slide img {
        object-fit: contain;
        /* width: 400px; */
        width: 100%;
        height: 250px;
    }
    .page-slick-image-container {
        width: 100% !important;
    }
    .photo-image-carousal {
        width: 100% !important;
        height: 250px !important;
        /* min-width: 1349px; */
        object-fit: contain;
    }
    .my-carousel-left{
        left: -12% !important;
    }
    .my-carousel-right{
        width: 23% !important;
        right: 6%;
    }
    .no-margin-single-vendor {
        margin-top: 0 !important;
    }
    .single-vendor-button-holder {
        margin-top: 5%;
    }
    .single-outline {
        width: 100% !important;
    }
    .btn-single-outline {
        margin-left: -5% !important;
        margin-top: 0% !important;
        margin-bottom: 0% !important;
    }   
}
    .body-holder > a.social {
        margin: auto 10px;
        font-size: 18px;
    }
</style>
<!-- <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0-11/css/all.css"> -->
@php
    $name = ''; $email = ''; $phone = '';
    if(Auth::check()):
        $name = Auth::user()->name;
        $email = Auth::user()->email;
        $phone = Auth::user()->phone;
    endif;
@endphp
<div class="breadcrumb-box weddingidea_breadcrumb "><!-- Breadcrumb Section -->
    <div class="wrapper">
        <div class="breadcrumb-container">
            <ul class="breadcrumb pull-left">
                <li><a href="{{url()->previous()}}"><span><i class="fa fa-angle-left"></i>&nbsp; &nbsp;  Your Search</span></a></li>
                @php
                /*@if(isset($vendorDetails) && !empty($vendorDetails))
                    <li><a href="{{url($vendorDetails['category_data']['parent_slug'])}}"><span>{{$vendorDetails['category_data']['parent_title']}}</span></a></li>
                    <li><a href="{{url($vendorDetails['category_data']['parent_slug'].'/'.$vendorDetails['category_data']['slug'])}}"><span>{{$vendorDetails['category_data']['title']}}</span></a></li>
                    <li>{{$vendorDetails['company_data']['business_name']}}</li>
                @endif */
                @endphp
            </ul>       
        </div>
    </div>
</div><!-- /Breadcrumb -->
<section id="about-section" class="section-padding qc_w-vanues">
    @if((isset($vendorDetails) && !empty($vendorDetails)) || isset($slug_ex))
        <div id="single-product">
            <div class="container">
                <div class="row">
                    <div class="no-margin col-xs-12 col-sm-12 body-holder">
                        @if(session()->has('message'))
                            {!!session()->get('message')!!}
                        @endif
                        <div class="body">
                            <h3 class="title">{{ @$vendorDetails['company_data']['business_name'] }} <!--<span class="tag-head">Master</span>--></h3>
                            @if(!empty((array) @$vendorDetails['location']))
                                @php /*<div class="brand">
                                    @if($vendorDetails['location']->address)
                                        {{$vendorDetails['location']->address.' '.(mb_strlen($vendorDetails['location']->postal_code) > 6 ? $vendorDetails['location']->postal_code : chunk_split($vendorDetails['location']->postal_code,3,' ')).' '.$vendorDetails['location']->city.'('.$vendorDetails['location']->state.') ' }}
                                    @else
                                        {{ $vendorDetails['location']->address }}, {{$vendorDetails['company_data']['city']}}
                                    @endif
                                    <a class="storefrontHeaderOnepage__infoItem" id="loc_map" href="javascript:void(0)">Map </a>&nbsp;
                                </div> */ @endphp
                            @else
                            @endif
                            <div class="brand">
                                @if($vendorDetails['freelisting'] == 'No')
                                {!! '<span class="business-address">'.@$vendorDetails['company_data']['address'].'</span>, '.$vendorDetails['company_data']['province'].' - '.(mb_strlen($vendorDetails['company_data']['postal_code']) > 6 ? $vendorDetails['company_data']['postal_code'] : chunk_split($vendorDetails['company_data']['postal_code'],3,' ')) !!} &nbsp;
                                <a class="storefrontHeaderOnepage__infoItem" id="loc_map" href="javascript:void(0)">Map</a>
                                @else
                                {!! $vendorDetails['company_data']['province'].' - '.$vendorDetails['company_data']['city'] !!} 
                                @if($vendorDetails['freelisting'] == 'No')
                                &nbsp;
                                <a class="storefrontHeaderOnepage__infoItem" id="loc_map" href="javascript:void(0)">Map</a>
                                @endif
                                @endif
                            </div>
                        </div><!-- /.body -->
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 storefront-header-summary">
                        @if($vendorDetails['freelisting'] == 'No')
                        <span class="" rel="nofollow">
                            <span class="app-emp-phone-txt btn btn-lg phone-number-option" style="padding: 10px 15px;">Show Phone #</span>
                        </span>
                        <span id="app-emp-phone" class="app-emp-phone phone-number-show">
                            <a href="tel:{{@$vendorDetails['telephone']}}" class="storefrontHeaderOnepage__infoItem">{{@$vendorDetails['mask_phone']}}</a>&nbsp;<a href="tel:{{$vendorDetails['mobile']}}" class="storefrontHeaderOnepage__infoItem">{{!empty($vendorDetails['mobile'])?','.$vendorDetails['mask_mobile']:''}}</a>
                        </span>
                        @endif
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6 storefront-header-summary">
                        <?php /* @if($vendorDetails['freelisting'] == 'No') */ ?>
                            <div class="pure-u mr15">
                                <a class="btn btn-primary btn-full btn-lg" onclick="Frontend.setRequestForm({{$vendorDetails['company_data']['id']}})" href="javascript:void(0)" data-toggle="modal" style="padding: 10px 15px;" data-target="#myModal">Request info</a>
                                <!-- Button trigger modal -->
                                 @include('includes.login_popup')
                                 @include('includes.request_popup')
                            </div>
                            <div class="storefront-header-stars">
                                <div class="star-holder inline">
                                    @if(isset($vendorDetails['rating_data']))
                                        @php
                                            $cont = 0;
                                            $finalAvg = 0;
                                            if($vendorDetails['rating_data_count'] >= 1) {
                                                foreach($vendorDetails['rating_data'] as $avgr) {
                                                    $cont += $avgr['average_rating'];
                                                }
                                                $finalAvg = ($cont/$vendorDetails['rating_data_count']);
                                            }
                                        @endphp
                                     <div class="readOnly" data-score="{{$finalAvg}}"></div>
                                     <span class="block">{{$vendorDetails['rating_data_count']}} Reviews</span>
                                    @endif
                                </div>
                            </div>
                            @if(isset($vendorDetails['parent_cat_id']) && $vendorDetails['parent_cat_id'] == 1)
                                
                            @endif
                        
                    </div>
                    <div class="no-margin col-xs-12 col-sm-6 col-md-6 text-right no-margin-single-vendor" style="margin-top:-36px;z-index: 0;">
                        <?php /* @if($vendorDetails['freelisting'] == 'No') */ ?>
                            <div class="buttons-holder single-vendor-button-holder">
                                <!-- <a class="btn btn-lg outline" href="#"><i class="fa fa-phone"></i> View Telephone</a> -->
                                @if($vendorDetails['rating_data_count'] >= 25 && $vendorDetails['rating_data_count'] < 50)
                                <div class="award award--center award--large award--rounded award--silver award--grey" style="height: 75px;"></div>
                                @endif
                                @if($vendorDetails['rating_data_count'] >= 50 && $vendorDetails['rating_data_count'] < 100)
                                <div class="award award--center award--large award--rounded award--gold award--grey" style="height: 75px;"></div>
                                @endif
                                @if($vendorDetails['rating_data_count'] >= 100)
                                <div class="award award--center award--large award--rounded award--platinum award--grey" style="height: 75px;"></div>
                                @endif
                                <a class="btn btn-lg outline single-outline" href="#reviews"  data-toggle="tab" aria-expanded="true"><!-- <i class="fa fa-star-o" aria-hidden="true"></i> -->Write a review</a>
                                @if($vendorDetails['freelisting'] == 'Yes')<a class="btn btn-primary btn-full btn-lg" style="width: auto !important;text-align: center !important;padding: 10px 15px;" href="#" data-toggle="modal" data-target="#signupModal">Claim your listing</a>
                                @endif
                                 @php
                                    $randId = rand();
                                    $hide1 = $hide2 = 'display:none;';
                                    if(in_array($vendorDetails['company_data']['id'],$wishLists)):
                                       $hide1 = '';
                                    else:
                                       $hide2 = '';
                                    endif;
                                @endphp
                                <a class="btn btn-lg outline single-outline" onclick="Frontend.removeWishList({{$vendorDetails['company_data']['id']}},{{$randId}})" id="remove_{{$randId}}" style="{{$hide1}}" href="#"><i class="fa fa-heart"></i> Saved</a>
                                <!-- <a class="btn btn-lg outline single-outline" onclick="Frontend.checkLogin({{$vendorDetails['company_data']['id']}},{{$randId}})" id="add_{{$randId}}" style="{{$hide2}}" href="#"><i class="fa fa-heart-o"></i> Add to wishlist</a> -->
                            </div>
                        <?php /* @else
                            <div class="pure-u mr15">
                                <a class="btn btn-lg request-price-btn" onclick="Frontend.setRequestForm({{$vendorDetails['company_data']['id']}})" href="javascript:void(0)" data-toggle="modal" data-target="#myModal">Request Pricing</a>
                                <!-- Button trigger modal -->
                                 @include('includes.login_popup')
                                 @include('includes.request_popup')
                            </div>
                        @endif */ ?>
                        @if(Session::get('session_vendorId'))
                        <a href="{{url('payment-packages')}}" class="btn btnCls">Activate Your Listing</a>
                        @endif
                    </div>
                    @if($vendorDetails['freelisting'] == 'No')
                    <div class="no-margin col-xs-12 col-sm-12 body-holder">
                        @foreach($vendorDetails['business_social'] as $social)
                        @if(!empty($social->link))
                        <!-- <li style="border: 1px solid white;width: 10%;text-align: center;padding: 5px;"> -->
                            <a href="{{url($social->link)}}" target="_blank" class="social"><i class="{{$social->icon}}"></i></a>
                        <!-- </li> -->
                        @endif
                        @endforeach
                    </div>
                    @endif
                </div><!-- /.body-holder -->
            </div><!-- /.container -->
        </div>
        <section id="single-product-tab" class="section-padding" style="padding-top: 10px !important;">
            @if($vendorDetails['freelisting'] == 'No')
                <div class="app-profile-top-fixed-bar hidden-xs" data-spy="affix" data-offset-top="450">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-7 col-sm-7 fixed-left">
                                <h3>{{$vendorDetails['company_data']['business_name']}}</h3>
                                <p><span class="business-address">{{$vendorDetails['company_data']['address']}}</span>, {{$vendorDetails['company_data']['city']}}</p>
                            </div>
                            <div class="col-md-5 col-sm-5 fixed-right">
                               
                                <a class="btn btn-lg outline" onclick="Frontend.removeWishList({{$vendorDetails['company_data']['id']}},{{$randId}})" id="remove_{{$randId}}" style="{{$hide1}}" href="#"><i class="fa fa-heart"></i></a>
                               
                                <a class="btn btn-lg request-price-btn" onclick="Frontend.setRequestForm({{$vendorDetails['company_data']['id']}})" href="javascript:void(0)" data-toggle="modal" data-target="#myModal"><i class="fa fa-send"></i> Request info</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <div class="storefront-container">
                <div class="container">
                    <ul class="nav nav-tabs simple storefront-nav">
                        <li class="{{!isset($_GET['page'])?'active':''}}"><a href="#profile" data-toggle="tab" aria-controls="Information"> Profile</a></li>
                       
                            <li class="{{ request()->segment(4)=='photos'?'active':'' }}"><a href="#photos" data-toggle="tab">Photos (@if($vendorDetails['photos_count'] > 0) {{$vendorDetails['photos_count']}} @else {{count(@$vendorDetails['cat_images'])}} @endif)</a></li>
                            <li class="{{ request()->segment(4)=='videos'?'active':'' }}"><a href="#videos" data-toggle="tab">Videos ({{$vendorDetails['videos_count']}})</a></li>
                            
                            <li id="reviewopen"><a href="#reviews" data-toggle="tab"> Reviews ({{$vendorDetails['rating_data_count']}})</a></li>
                            @if($vendorDetails['freelisting'] == 'No')
                            <li class="{{ request()->segment(4)=='map'?'active':'' }}"><a href="#location_map" data-toggle="tab">Map</a></li>
                            @endif
                            @if(isset($blogs) && count($blogs) > 0)
                            <li class="{{isset($_GET['page'])?'active':''}}"><a href="#blogs_community_post" data-toggle="tab">Blogs / Community Post</a></li>
                            @endif
                            @if(count($teamMembers) > 0)
                            <li><a href="#meet_the_team" data-toggle="tab">Meet the Team</a></li>
                            @endif
                        <?php /* @endif */ ?>
                    </ul><!-- /.nav-tabs -->
                </div>
            </div>
            <div class="container">
                <div class="tab-holder">
                    <div class="tab-content clearfix">
                        <div class="row">
                            <div class="col-sm-8 col-xs-12 page-slick-image-container">
                                <div class="tab-pane" role="tabpanel" id="meet_the_team">
                                    <div class="row">
                                        <style>
                                            .team-member {
                                                border: 1px solid #ddd;
                                                border-radius: 0px;
                                                padding: 12px 0;
                                                background: #fff;
                                                margin-bottom: 5px;
                                            }
                                            img.team-member {
                                                max-width: 150px;
                                                /*width: 100%;*/
                                                width: 130px;
                                                max-height: 150px;
                                                display: block;
                                                border-radius: 50%;
                                                margin: 0 auto;
                                                border: 0;
                                            }
                                            h4.heading {
                                                line-height: 27px;
                                            }
                                        </style>
                                        @if(count($teamMembers) > 0)
                                        @foreach($teamMembers as $team)
                                        <div class="row team-member">
                                            <div class="col-sm-3">
                                                @if(empty($team->photo))
                                                    <img src="{{url('/public/storage/no-image.png')}}" class="team-member" alt="{{$team->firstname}}" title="{{$team->firstname.' '.$team->lastname}}" width="150" height="150px">
                                                @else
                                                    <img src="{{url('/public/vendors/VENDOR_'.$team->vendor_id.'/')}}/{{$team->photo}}" class="team-member" alt="{{$team->firstname}}" title="{{$team->firstname.' '.$team->lastname}}" width="150" height="150px">
                                                @endif
                                            </div>
                                            <div class="col-sm-9">
                                                <h4 class="heading" style="font-size: 20px;">{{$team->firstname.' '.$team->lastname}}</h4>
                                                <h4 class="heading">{{$team->position}}</h4>
                                                @if(!empty($team->biography))
                                                    {!! $team->biography !!}
                                                @endif
                                            </div>
                                        </div>
                                        
                                        @endforeach
                                        @else
                                        <div class="col-sm-12 text-center">
                                            <h4>Team members details are not found !!</h4>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="tab-pane {{isset($_GET['page'])?'active':''}}" role="tabpanel" id="blogs_community_post">
                                    <h1>Blogs / Community Post</h1>
                                    <hr class="my-4">
                                    <div class="row">
                                    @if(isset($blogs) && count($blogs) > 0)
                                    @foreach($blogs as $key => $blog)
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <div class="blog shadow-sm" style="min-height: 0;">
                                                <div class="col-sm-3 col-lg-2 col-md-2 col-xs-12">
                                                    <a href="{{$single_url}}/{{$blog->slug}}"><img src="{{url('public/cimg/webroot/img.php?src=images/blogs')}}/{{$blog->picture == null?'no-img.png':$blog->picture}}" class="img-responsive blog-picture" alt="{{$blog->name}}"></a>
                                                </div>
                                                <div class="col-sm-9 col-lg-9 col-md-9 col-xs-12">
                                                <div class="blog-info">
                                                    <h3 class="post-title"><a href="{{$single_url}}/{{$blog->slug}}">{{$blog->name}}</a></h3>
                                                    <p class="mb-4">{{substr(strip_tags($blog->excerpt),0,500)}}...</p>
                                                    <a href="{{$url}}/{{$blog->category_slug}}" style="float: left;"><span class="author"><i class="fas fa-tag align-baseline"></i>&nbsp; {{$blog->category}}</span></a>
                                                    <a href="{{$single_url}}/{{$blog->slug}}" class="blogreadmore">{{Request::is('blog'.(empty($slug)?'':'/'.$slug))?'Read More':'Read and Comment'}} <i class="fas fa-arrow-right align-middle"></i></a>
                                                </div>
                                                </div>
                                            </div>
                                            <hr>
                                        </div>
                                    @endforeach
                                        <div class="col-sm-12 text-center">
                                            {{$blogs->links('paginator.blogs-vendor')}}
                                        </div>
                                    @else
                                        <div class="col-sm-12 text-center" style="position: relative;height: 250px;">
                                            <h1 style="position: absolute;left: 34%;top: 50%;">No Articles !!</h1>
                                        </div>
                                    @endif
                                    </div>
                                </div>
                                <div class="tab-pane {{!isset($_GET['page'])?'active':''}}" role="tabpanel" id="profile">
                                    @if(request()->segment(4)!='faqs' && request()->segment(4)!='photos'  && request()->segment(4)!='videos'  && request()->segment(4)!='deals' && request()->segment(4)!='map' && request()->segment(4)!='promotions')
                                        
                                        <div class="featured_slider">
                                            @if(!empty($vendorDetails['profile']))
                                            <div class="featued_slick_slider">
                                                <img src="{{URL::asset('public/vendors/VENDOR_'.$vendorDetails['vendor_id'].'/'.$vendorDetails['profile'])}}" alt="" height="540" />
                                            </div>
                                            @elseif(isset($vendorDetails['image_data']) && !empty($vendorDetails['image_data']))
                                                @foreach($vendorDetails['image_data'] as $img)
                                                <div class="featued_slick_slider">
                                                    <img src="{{ asset('vendors/'.$img['vendor_folder'].'/'.$img['image'])}}" alt="" height="540"/>
                                                </div>
                                                @break
                                                @endforeach
                                            
                                            @else
                                                <div class="featued_slick_slider">
                                                    <img src="{{URL::asset('public/vendors/no-profile.jpg')}}" alt="" height="540" />
                                                </div>
                                            @endif
                                        </div>
                                    @endif
                                    <!-- Ashiq -->
                                    <div class="row" style="padding:20px;">
                                        <div class="col-sm-12">
                                            <h3 style="margin-bottom:5px;">About {{$vendorDetails['company_data']['business_name']?$vendorDetails['company_data']['business_name']:'' }}</h3>
                                            <p>{!! $vendorDetails['business_description'] !!}</p>
                                            
                                            @if(isset($vendorDetails['categories']))
                                    <h3>Categories</h3>
                                    <hr>
                                    @foreach($vendorDetails['categories'] as $catKey => $cats)
                                        <ul>
                                            <li>
                                                <h4 {{ $catKey != 0 ? 'style=padding-top:1%;' : ""}}>{{$cats->title}}</h4>
                                                
                                                <hr>
                                                <div class="row">
                                                    @php
                                                        $childs = \App\VendorCategoryRelation::get_category_by_vendor($vendorDetails['vendorId'],$cats->id);
                                                        $status = false;
                                                    @endphp
                                                    @if(count($childs) > 0)
                                                    @foreach($childs as $key => $child)
                                                    @if($status == true || $key == 0)
                                                    <div class="row">
                                                    @php $status = false; @endphp
                                                    @endif
                                                    <div class="col-sm-3" style="border: 0px solid #e6e6e6;margin-left: 1%;margin-right:1%;margin-top: 1%;padding: 0;border-radius: 5px;">
                                                        <img src="{{url('public/cimg/webroot/img.php?src=images/category_icons/'.(!empty($child->icon) ? $child->icon : 'no-icon.jpg'))}}" class="img-responsive" style="object-fit: contain;width: 100%;padding-top: 5px;padding-left: 5px;padding-right: 5px;max-height: 250px;min-height: 250px;">
                                                        <p style="width: 100%;height: 100%;text-align:center;margin-top:1px;border-top: 1px solid #80808026;background-color: #c0c0c03b;margin-bottom: 0;line-height: 30px;font-size: 15px;font-weight: bold;padding: 5px;display: none;/*height: 70px;*/">{{$child->title}}</p>
                                                    </div>
                                                    @if(($key+1)%3==0 || ($key+1) == count($childs))
                                                    </div>@php $status = true; @endphp
                                                    @endif
                                                    @endforeach
                                                    @endif
                                                </div>
                                                <hr>
                                            </li>
                                        </ul>
                                    @endforeach
                                    @endif
                                        </div>
                                    </div>
                                    @if(count($vendorDetails['cat_images']) > 0)
                                    @endif
                                    <div class="row">
                                        <div class="col-sm-12">
                                            @if(request()->segment(4)!='faqs' && request()->segment(4)!='photos'  && request()->segment(4)!='videos'  && request()->segment(4)!='deals' && request()->segment(4)!='map' && request()->segment(4)!='promotions')
                                                <div id="profile">
                                                    @if(!empty((array) $vendorDetails['faq_ans_arr']))
                                                        @if(count($vendorDetails['faq_ans_arr']['fs_arr'][0])>0 || count($vendorDetails['faq_ans_arr']['ta_arr'][0])>0 || $vendorDetails['faq_ans_arr']['price_bridal'][0]!='')
                                                            <div class="short-info">
                                                                @if(count($vendorDetails['faq_ans_arr']['fs_arr'][0])>0)
                                                                    <ul>
                                                                        <li><strong>Floral Services</strong>
                                                                            @foreach($vendorDetails['faq_ans_arr']['fs_arr'][0] as $fs )
                                                                                <span>{{ $fs->name }}</span>
                                                                            @endforeach
                                                                        </li>
                                                                        @if(count($vendorDetails['faq_ans_arr']['ta_arr'][0])>0)
                                                                            <li><strong>Arrangements</strong>
                                                                                @foreach($vendorDetails['faq_ans_arr']['ta_arr'][0] as $ta )
                                                                                    <span>{{ $ta->name }}</span>
                                                                                @endforeach
                                                                            </li>
                                                                        @endif
                                                                        @if($vendorDetails['faq_ans_arr']['price_bridal'][0])
                                                                            <li><strong>Bridal Bouquet Price</strong>
                                                                                C$ <span>{{ $vendorDetails['faq_ans_arr']['price_bridal'][0] }}</span>
                                                                            </li>
                                                                        @endif
                                                                    </ul>
                                                                @endif
                                                                <div class="clearfix"></div>
                                                            </div>
                                                        @endif
                                                        @php /*<h2>About {{ $vendorDetails['category_data']['meta_title'] }}</h2>
                                                        {!!$vendorDetails['business_description']!!}
                                                        <h3>More information about {{ $vendorDetails['category_data']['meta_title'] }}</h3>*/ @endphp
                                                        <ul class="storefront-faqs">
                                                            @if(@$vendorDetails['faq_ans_arr']['fd_arr'][0])
                                                            <li >
                                                                <strong>  How would you describe the style of your floral designs? </strong><br>
                                                                <div class="pure-bh">
                                                                    @foreach($vendorDetails['faq_ans_arr']['fd_arr'][0] as $fd )
                                                                    <div class="pure-u-6-10 pure-g">
                                                                        <div class="pure-u-1-2 storefront-faqs__check">
                                                                            <i class="svgIcon">
                                                                                <svg viewBox="0 0 76.3 53.6">
                                                                                    <path d="M31.4 53.6L1.9 23.8c-2.6-2.6-2.6-6.5 0-9.1s6.5-2.6 9.1 0l20.4 20.8L65.2 2.1c2.6-2.6 6.5-2.6 9.1 0s2.6 6.5 0 9.1L31.4 53.6z"></path>
                                                                                </svg>
                                                                            </i>
                                                                            <div>{{ $fd->name }}</div>
                                                                        </div>
                                                                    </div>
                                                                    @endforeach
                                                                </div>
                                                            </li>
                                                            @endif
                                                            @if(@$vendorDetails['faq_ans_arr']['price_bridesmaid'][0])
                                                            <li id="minifaqs_3186" class="storefrontFaqsSummary__item">
                                                                <div class="storefrontFaqsSummary__description">
                                                                    <strong> What is the average price for a bridesmaid bouquet?</strong>
                                                                    C$ {!! $vendorDetails['faq_ans_arr']['price_bridesmaid'][0] !!}
                                                                </div>
                                                            </li>
                                                            @endif
                                                            @if(@$vendorDetails['faq_ans_arr']['price_boutonniere'][0])
                                                            <li id="minifaqs_3186" class="storefrontFaqsSummary__item">
                                                                <div class="storefrontFaqsSummary__description">
                                                                    <strong> What is the average price for a boutonniere?</strong>
                                                                    C$ {!! $vendorDetails['faq_ans_arr']['price_boutonniere'][0] !!}
                                                                </div>
                                                            </li>
                                                            @endif
                                                            @if(@$vendorDetails['faq_ans_arr']['price_low_tbl'][0])
                                                            <li id="minifaqs_3186" class="storefrontFaqsSummary__item">
                                                                <div class="storefrontFaqsSummary__description">
                                                                    <strong> What is the average price for a low table arrangement (per arrangement)?</strong>
                                                                    C$ {!! $vendorDetails['faq_ans_arr']['price_low_tbl'][0] !!}
                                                                </div>
                                                            </li>
                                                            @endif
                                                            @if(@$vendorDetails['faq_ans_arr']['price_elevated_tbl'][0])
                                                            <li id="minifaqs_3186" class="storefrontFaqsSummary__item">
                                                                <div class="storefrontFaqsSummary__description">
                                                                    <strong> What is the average price for an elevated table arrangement (per arrangement)?</strong>
                                                                    C$ {!! $vendorDetails['faq_ans_arr']['price_elevated_tbl'][0] !!}
                                                                </div>
                                                            </li>
                                                            @endif
                                                            @if(@$vendorDetails['faq_ans_arr']['price_customer_expect'][0])
                                                            <li id="minifaqs_3186" class="storefrontFaqsSummary__item">
                                                                <div class="storefrontFaqsSummary__description">
                                                                    <strong> Typically, what can a customer expect to pay for your wedding floral services? </strong>
                                                                    C$ {!! $vendorDetails['faq_ans_arr']['price_customer_expect'][0] !!}
                                                                </div>
                                                            </li>
                                                            @endif
                                                            @if(@$vendorDetails['faq_ans_arr']['cost_fd_arr'][0])
                                                            <li >
                                                                <strong>Which of the following are included in the cost of your floral services?</strong><br>
                                                                <div class="pure-bh">
                                                                    @foreach($vendorDetails['faq_ans_arr']['cost_fd_arr'][0] as $cfs )
                                                                        <div class="pure-bh-inner">
                                                                            <div class="pure-u-1-2 storefront-faqs__check">
                                                                                <i class="svgIcon">
                                                                                    <svg viewBox="0 0 76.3 53.6">
                                                                                        <path d="M31.4 53.6L1.9 23.8c-2.6-2.6-2.6-6.5 0-9.1s6.5-2.6 9.1 0l20.4 20.8L65.2 2.1c2.6-2.6 6.5-2.6 9.1 0s2.6 6.5 0 9.1L31.4 53.6z"></path>
                                                                                    </svg>
                                                                                </i>
                                                                                <div>{{ $cfs->name }}</div>
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            </li>
                                                            @endif
                                                        </ul>
                                                    @endif
                                                    
                                                    @if($vendorDetails['freelisting'] == 'No')
                                                    <div class="storefront-section" data-order="14">
                                                        <p class="storefront-title-section">Location of {{$vendorDetails['company_data']['business_name']?$vendorDetails['company_data']['business_name']:'' }}</p>
                                                        <div id="gmap" style="height:480px;"></div>
                                                        <div id="defMap1" style="height:480px;"></div>
                                                    </div>
                                                    @endif
                                                </div>
                                            @endif
                                            <!-- PROMOTION DETAILS -->
                                            @if(request()->segment(4)=='promotions')
                                            <div>
                                                <div class="storefront-content">
                                                    <p class="storefront-title-section">Discount {{ env('APP_NAME')}}</p>
                                                    <div class="box">
                                                        <div class="unit-primary storefront-promo-content">
                                                            <div class="pure-u-3-4">
                                                                <h1 class="storefront-promo-title">{{ $vendorDetails['promotion_data']['promotion_amount'] }}% discount for {{ env('APP_NAME')}} couples</h1>
                                                            </div>
                                                            <i class="icon-vendor icon-vendor-promo-exclusive fright"></i>
                                                            <p>If you found us on {{ env('APP_NAME')}} we will give you a {{ $vendorDetails['promotion_data']['promotion_amount'] }}% discount on our services. Remember to show us your voucher when you come see us.</p>
                                                        </div>
                                                        <div class="unit-primary vendor-promo-coupon border-top">
                                                            <div class="pure-g">
                                                                <div class="pure-u-1-2">
                                                                    <div class="storefront-promo-info fleft">
                                                                        <span class="count">Permanent Deal</span>
                                                                    </div>
                                                                </div>
                                                                <div class="pure-u-1-2 text-right">
                                                                    <a class="btn btn-primary app-ua-track-event" href="javascript:void(0)" >
                                                                    <i class="fa fa-ticket"></i> Get Deal</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="storefront-promo-figure">
                                                            @php
                                                            /*@if(@$vendorDetails['image_data'][0]['is_logo']==1)
                                                                <img src="{{ asset('vendors/'.$vendorDetails['image_data'][0]['vendor_folder'].'/'.$vendorDetails['image_data'][0]['image'])}}" alt="{{ $vendorDetails['category_data']['meta_title']?$vendorDetails['category_data']['meta_title']:'' }}">
                                                            @endif */
                                                            @endphp
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif <!-- PROMOTION DETAILS -->
                                        </div> <!-- end col -->
                                    </div><!-- /.meta-row -->
                                    <div class="row">
                                        
                                        @if(isset($vendorDetails['business_info']) && $vendorDetails['freelisting'] == 'No')
                                            <p class="storefront-title-section"> More Info ({{$vendorDetails['company_data']['business_name']?$vendorDetails['company_data']['business_name']:'' }})
                                            <ul>
                                                @foreach($vendorDetails['business_info'] as $key=>$info)
                                                @if($info->no_parking == 1 || $info->free_parking == 1 || $info->paid_parking == 1 || $info->indoor_parking == 1)
                                                @if($info->no_parking == 1)
                                                <li><h3>Parking</h3></li>
                                                <li style="padding-bottom: 12%;">
                                                    <img src="{{url('public/cimg/webroot/img.php?src=images/signs/no-parking.png')}}" id="no_parking_img" style="float: right;" class="img-responsive">
                                                    <ol style="list-style-type: circle;">
                                                        <li>No Parking</li>
                                                    </ol>
                                                </li>
                                                @else
                                                <li><h3>Parking</h3></li>
                                                <li style="padding-bottom: 10%;">
                                                    @if($info->paid_parking)
                                                        <img src="{{url('public/cimg/webroot/img.php?src=images/signs/paid-parking.png')}}" style="float: right;" class="img-responsive">
                                                    @elseif($info->free_parking || $info->indoor_parking)
                                                        <img src="{{url('public/cimg/webroot/img.php?src=images/signs/parking.png')}}" style="float: right;" class="img-responsive">
                                                    @endif
                                                    <ol style="list-style-type: circle;">
                                                        @if($info->free_parking) <li>Free Parking</li> @endif
                                                        @if($info->paid_parking) <li>Paid Parking</li> @endif
                                                        @if($info->indoor_parking) <li>Indoor Parking</li> @endif
                                                    </ol>
                                                </li>
                                                @endif
                                                @endif
                                                @if($info->wheel_chair == 1)
                                                <li style="padding-bottom: 10%;">
                                                    <img src="{{url('public/cimg/webroot/img.php?src=images/signs/wheel-chair.png')}}" id="wheelchair_img" style="float: right;" class="img-responsive">
                                                    <ul>
                                                        <li>Access To Wheelchair</li>
                                                    </ul>
                                                </li>
                                                @endif
                                                @if($info->motor_vehicle == 1 || $info->health_benefit == 1 || $info->gov_insurance == 1 || $info->self_pay == 1 || $info->personal_cheque == 1 || $info->finance_available == 1)
                                                <li>
                                                    <h3>Insurance</h3>
                                                </li>
                                                @endif
                                                @if($info->motor_vehicle == 1)
                                                <li>
                                                    Motor Vehicle Accident Insurance
                                                </li>
                                                @endif
                                                @if($info->health_benefit == 1)
                                                <li>
                                                    Health Benefit Plan
                                                </li>
                                                @endif
                                                @if($info->gov_insurance == 1)
                                                <li>
                                                    Government Insurance
                                                </li>
                                                @endif
                                                @if($info->self_pay == 1)
                                                <li>
                                                    Self Pay (Cash/Debit/Credit)
                                                </li>
                                                @endif
                                                @if($info->personal_cheque == 1)
                                                <li>
                                                    Personal Cheque accepted
                                                </li>
                                                @endif
                                                @if($info->finance_available == 1)
                                                <li>
                                                    Financing Available - Differed payment
                                                </li>
                                                @endif
                                                <li style="padding-top: 15px;"><h3>Languages</h3></li>
                                                @if($info->language != '' || $info->sign_language == 1 || $info->sign_language == 1)
                                                <li style="padding-bottom: 3%;">{{str_replace(",",", ",$info->language)}}</li>
                                                @if($info->sign_language == 1)
                                                <li style="padding-bottom: 10%;">
                                                    <img src="{{url('public/images/signs/sign-language.png')}}" id="wheelchair_img" style="float: right;" class="img-responsive">
                                                    Sign Language
                                                </li>
                                                @endif
                                                
                                                @endif
                                                @endforeach
                                            </ul>
                                        @endif
                                        @if(isset($vendorDetails['business_hours']) && $vendorDetails['is_business_hours'] == '1' && $vendorDetails['freelisting'] == 'No')
                                            <h3>Business Hours Of ({{$vendorDetails['company_data']['business_name']?$vendorDetails['company_data']['business_name']:'' }}) </h3>
                                            <table class="table table-bordered table-striped text-center">
                                                <thead>
                                                    <tr>
                                                        <th style="text-align: center;">Day</th>
                                                        <th style="text-align: center;">Opening Hours</th>
                                                        <th style="text-align: center;">Closing Hours</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($vendorDetails['business_hours'] as $hour)
                                                    <tr>
                                                        <td>{{$hour->day}}</td>
                                                        <td>{{$hour->open == null || $hour->open == ''?'Closed':substr($hour->open,0,5)}}</td>
                                                        <td>{{$hour->close == null || $hour->close == ''?'Closed':substr($hour->close,0,5)}}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        @if(isset($vendorDetails['business_info'][0]->holiday_special) && $vendorDetails['is_business_hours'] == '1' && $vendorDetails['freelisting'] == 'No')
                                        <h3>Special Message for Holidays / Special Closing</h3>
                                        <p>{{$vendorDetails['business_info'][0]->holiday_special}}</p>
                                        @endif
                                        @endif
                                        @if(@$info->lgbtq == 1 && $vendorDetails['freelisting'] == 'No')
                                        <ul>
                                            <li style="padding-bottom: 10%;">
                                                <img src="{{url('public/images/signs/LGBTQ.png')}}" id="wheelchair_img" style="float: right;" class="img-responsive">
                                                <h4 style="padding-bottom: 3%;">LGBTQ.</h4>
                                                <p>This business is a place where human rights are respected and where LGBTQ people are welcomed and supported without any discrimation or prejudice.</p>
                                            </li>
                                        </ul>
                                        @endif
                                        
                                    </div>
                                </div><!-- /.tab-pane #description -->
                                <!-- FAQS -->
                                <!-- Ashiq -->
                                <div class="tab-pane" role="tabpanel" id="videos">
                                    @if(isset($vendorDetails['videos']) && count($vendorDetails['videos']) > 0)
                                    <div class="row">
                                        @foreach($vendorDetails['videos'] as $video)
                                        <div class="col-sm-12">
                                            <div style="width: 100%;border: 1px solid #ddd;padding: 5px;margin-bottom: 4px;border-radius: 5px;">
                                                <iframe width="100%" id="video_frame_{{$video->id}}" style="height: 400px;" src="https://www.youtube.com/embed/{{$video->youtube_id}}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                                <h2 style="border-bottom: 1px solid #980c2b">{{$video->title}}</h2>
                                                <p>{{$video->description}}</p>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    @else
                                    <h2 class="text-center">No videos found !!</h2>
                                    @endif
                                </div>
                                <div class="tab-pane" role="tabpanel" id="faqs">
                                    <div class="storefront-section" data-order="3">
                                        <p class="storefront-title-section">About <?php /*{{$vendorDetails['category_data']['meta_title']?$vendorDetails['category_data']['meta_title']:'' }}*/ ?></p>
                                        <div class="pure-g mt30">
                                            <div class="pure-u-1-3">
                                                <div class="storefrontFaqsBox">
                                                    @if(!empty((array)$vendorDetails['faq_ans_arr']))
                                                        <ul class="storefrontFaqsSummary">
                                                            @if(@$vendorDetails['faq_ans_arr']['fs_arr'][0])
                                                                <li id="minifaqs_3193" class="storefrontFaqsSummary__item">
                                                                    <i class="icon-vendor icon-vendor-faq-flowers storefrontFaqsSummary__icon"></i>
                                                                    <div class="storefrontFaqsSummary__description">
                                                                        <span class="storefrontFaqsSummary__title">Floral Services</span>
                                                                        @foreach($vendorDetails['faq_ans_arr']['fs_arr'][0] as $fs )
                                                                            <div>{{ $fs->name }}</div>
                                                                        @endforeach
                                                                    </div>
                                                                </li>
                                                            @endif
                                                            @if(@$vendorDetails['faq_ans_arr']['ta_arr'][0])
                                                                <li id="minifaqs_3175" class="storefrontFaqsSummary__item">
                                                                    <i class="icon-vendor icon-vendor-faq-check storefrontFaqsSummary__icon"></i>
                                                                    <div class="storefrontFaqsSummary__description">
                                                                        <span class="storefrontFaqsSummary__title">Arrangements</span>
                                                                        @foreach($vendorDetails['faq_ans_arr']['ta_arr'][0] as $ta )
                                                                            <div>{{ $ta->name }}</div>
                                                                        @endforeach
                                                                    </div>
                                                                </li>
                                                            @endif
                                                            @if(@$vendorDetails['faq_ans_arr']['price_bridal'][0])
                                                            <li id="minifaqs_3186" class="storefrontFaqsSummary__item">
                                                              <i class="icon-vendor icon-vendor-faq-price storefrontFaqsSummary__icon"></i>
                                                              <div class="storefrontFaqsSummary__description">
                                                                 <span class="storefrontFaqsSummary__title">Bridal Bouquet Price</span>
                                                                 C$  {!! $vendorDetails['faq_ans_arr']['price_bridal'][0] !!}
                                                              </div>
                                                            </li>
                                                            @endif
                                                        </ul>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="storefront-section" data-order="4">
                                        @if(!empty((array)$vendorDetails['faq_ans_arr']))
                                            <ul class="storefront-faqs">
                                                @if(@$vendorDetails['faq_ans_arr']['fd_arr'][0])
                                                <li class="storefront-faqs__listed border-bottom pure-g">
                                                    <span class="strong pure-u-4-10 pr10">How would you describe the style of your floral designs? </span>
                                                    @foreach($vendorDetails['faq_ans_arr']['fd_arr'][0] as $fd )
                                                        <div class="pure-u-6-10 pure-g">
                                                            <div class="pure-u-1-2 storefront-faqs__check">
                                                                <i class="svgIcon">
                                                                    <svg viewBox="0 0 76.3 53.6">
                                                                        <path d="M31.4 53.6L1.9 23.8c-2.6-2.6-2.6-6.5 0-9.1s6.5-2.6 9.1 0l20.4 20.8L65.2 2.1c2.6-2.6 6.5-2.6 9.1 0s2.6 6.5 0 9.1L31.4 53.6z"></path>
                                                                    </svg>
                                                                </i>
                                                                <div>{{ $fd->name }}</div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </li>
                                                @endif
                                                @if(@$vendorDetails['faq_ans_arr']['price_bridesmaid'][0])
                                                <li id="minifaqs_3186" class="storefrontFaqsSummary__item">
                                                    <!-- <i class="icon-vendor icon-vendor-faq-price storefrontFaqsSummary__icon"></i> -->
                                                    <div class="storefrontFaqsSummary__description">
                                                        <span class="storefrontFaqsSummary__title"> What is the average price for a bridesmaid bouquet?</span>
                                                        C$ {!! $vendorDetails['faq_ans_arr']['price_bridesmaid'][0] !!}
                                                    </div>
                                                </li>
                                                @endif
                                                @if(@$vendorDetails['faq_ans_arr']['price_boutonniere'][0])
                                                <li id="minifaqs_3186" class="storefrontFaqsSummary__item">
                                                    <!-- <i class="icon-vendor icon-vendor-faq-price storefrontFaqsSummary__icon"></i> -->
                                                    <div class="storefrontFaqsSummary__description">
                                                        <span class="storefrontFaqsSummary__title"> What is the average price for a boutonniere?</span>
                                                        C$ {!! $vendorDetails['faq_ans_arr']['price_boutonniere'][0] !!}
                                                    </div>
                                                </li>
                                                @endif
                                                @if(@$vendorDetails['faq_ans_arr']['price_low_tbl'][0])
                                                <li id="minifaqs_3186" class="storefrontFaqsSummary__item">
                                                    <!-- <i class="icon-vendor icon-vendor-faq-price storefrontFaqsSummary__icon"></i> -->
                                                    <div class="storefrontFaqsSummary__description">
                                                        <span class="storefrontFaqsSummary__title"> What is the average price for a low table arrangement (per arrangement)?</span>
                                                        C$ {!! $vendorDetails['faq_ans_arr']['price_low_tbl'][0] !!}
                                                    </div>
                                                </li>
                                                @endif
                                                @if(@$vendorDetails['faq_ans_arr']['price_elevated_tbl'][0])
                                                <li id="minifaqs_3186" class="storefrontFaqsSummary__item">
                                                    
                                                    <div class="storefrontFaqsSummary__description">
                                                        <span class="storefrontFaqsSummary__title"> What is the average price for an elevated table arrangement (per arrangement)?</span>
                                                        C$ {!! $vendorDetails['faq_ans_arr']['price_elevated_tbl'][0] !!}
                                                    </div>
                                                </li>
                                                @endif
                                                @if(@$vendorDetails['faq_ans_arr']['price_customer_expect'][0])
                                                <li id="minifaqs_3186" class="storefrontFaqsSummary__item">
                                                   
                                                    <div class="storefrontFaqsSummary__description">
                                                        <span class="storefrontFaqsSummary__title"> Typically, what can a customer expect to pay for your wedding floral services? </span>
                                                        C$ {!! $vendorDetails['faq_ans_arr']['price_customer_expect'][0] !!}
                                                    </div>
                                                </li>
                                                @endif
                                                @if(@$vendorDetails['faq_ans_arr']['cost_fd_arr'][0])
                                                <li class="storefront-faqs__listed border-bottom pure-g">
                                                    <span class="strong pure-u-4-10 pr10">Which of the following are included in the cost of your floral services?</span>
                                                    <div class="pure-bh">
                                                        @foreach($vendorDetails['faq_ans_arr']['cost_fd_arr'][0] as $cfs )
                                                        <div class="pure-u-6-10 pure-g">
                                                            <div class="pure-u-1-2 storefront-faqs__check">
                                                                <i class="svgIcon">
                                                                    <svg viewBox="0 0 76.3 53.6">
                                                                        <path d="M31.4 53.6L1.9 23.8c-2.6-2.6-2.6-6.5 0-9.1s6.5-2.6 9.1 0l20.4 20.8L65.2 2.1c2.6-2.6 6.5-2.6 9.1 0s2.6 6.5 0 9.1L31.4 53.6z"></path>
                                                                    </svg>
                                                                </i>
                                                                <div>{{ $cfs->name }}</div>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                </li>
                                                @endif
                                            </ul>
                                        @endif
                                    </div>
                                </div><!-- END FAQS -->
                                <!-- PHOTOS -->
                                <div class="tab-pane" role="" id="photos">
                                    <div class="storefront-section storefront-section-noBorder">
                                        <h3 class="app-slider-title storefront-title-section">
                                                                                    </h3>
                                    </div><!-- Swiper -->
                                    <div id="myCarouselPhotos" class="carousel slide detail-slide" data-ride="carousel">
                                        <!-- Wrapper for slides -->
                                        <div class="carousel-inner" >
                                            @if(isset($vendorDetails['image_data']) && !empty($vendorDetails['image_data']))
                                                <?php $i=1; ?>
                                                @foreach($vendorDetails['image_data'] as $img)
                                                <div class="item <?php if($i==1){echo'active';} ?>">
                                                    <img src="{{ asset('vendors/'.$img['vendor_folder'].'/'.$img['image'])}}" class="photo-image-carousal" alt="" />
                                                </div>
                                                <?php $i++; ?>
                                                @endforeach
                                            @elseif(count(@$vendorDetails['cat_images']) > 0)
                                                <?php $i=1; ?>
                                                @foreach($vendorDetails['cat_images'] as $cti)
                                                <div class="item <?php if($i==1){echo'active';} ?>">
                                                    <img src="{{ asset('images/category_images/'.$cti->images)}}" class="photo-image-carousal" alt="" />
                                                </div>
                                                <?php $i++; ?>
                                                @endforeach
                                            @else
                                                <div class="item active"><img src="{{URL::asset('public/vendors/no-photo.jpg')}}" class="photo-image-carousal" alt="" /></div>
                                            @endif
                                        </div>
                                        <!-- Left and right controls -->
                                        <a class="left carousel-control my-carousel-left" href="#myCarouselPhotos" role="button" data-slide="prev">
                                            <span class="fa fa-angle-left" aria-hidden="true"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="right carousel-control my-carousel-right" href="#myCarouselPhotos" role="button" data-slide="next">
                                            <span class="fa fa-angle-right" aria-hidden="true"></span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </div>
                                    <div class="wrapper">
                                        <div class="pure-u-3-4">
                                            <div class="storefront-content">
                                                <div class="dnone app-lead-slide adw-slider-lead app-slider-lead-hover">
                                                    <div class="adw-slider-lead-center">
                                                        <p>Did you like this vendor?</p>
                                                        <a class="btn btn-primary app_lnkEsc_ app-ua-track-event" href="javascript:void(0)" onclick="vendors_showFormContactarEmp(this, 17879, null, true, 44);" data-track-c="LeadTracking" data-track-a="a-step1" data-track-l="d-desktop+s-profile_slider" data-track-v="1" data-track-ni="0" data-track-cds="{&quot;dimension15&quot;:&quot;17879&quot;,&quot;dimension17&quot;:&quot;44&quot;}">Request info</a>
                                                    </div>
                                                </div>
                                                <p class="storefront-subtitle">Photo Gallery <?php /*{{ $vendorDetails['category_data']['meta_title']?$vendorDetails['category_data']['meta_title']:'' }}*/ ?></p>
                                                <div class="storefront-gallery-thumbs">
                                                    <ul class="pure-g">
                                                        @if(count($vendorDetails['image_data'])>0)
                                                            @foreach($vendorDetails['image_data'] as $photo)
                                                            <li class="pure-u-1-6 item">
                                                                <div class="storefront-gallery-thumbs-item">
                                                                    
                                                                        <img src="{{ asset('vendors/'.$photo['vendor_folder'].'/'.$photo['image']) }}" alt="" height="88" width="133">
                                                                    </a>
                                                                </div>
                                                            </li>
                                                            @endforeach
                                                        @endif
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- END PHOTOS -->
                                <!-- DEALS -->
                                <div class="tab-pane" role="tabpanel" id="deals">
                                    <div class="storefront-section" data-order="10">
                                        
                                    </div>
                                </div><!-- END DEALS -->
                                
                                <div class="tab-pane" role="tabpanel" id="location_map">
                                    @if($vendorDetails['freelisting'] == 'No')
                                    <div class="storefront-content" style="padding-right: 0 !important;">
                                        <p class="storefront-title-section"> Location of ({{$vendorDetails['company_data']['business_name']?$vendorDetails['company_data']['business_name']:'' }})
                                        </p>
                                        @if(count($vendorDetails['vendor_map'])>0)
                                        <ul class="storefrontAddresses">
                                            @foreach($vendorDetails['vendor_map'] as $key=>$loc)
                                            <li class="app-static-map-box storefrontAddresses__item " id="item_{{ $loc->id }}" >
                                                <div class="storefrontAddresses__address">
                                                    <i class="svgIcon svgIcon__mapMarkerOutline storefrontAddresses__icon">
                                                        <svg viewBox="0 0 28 36">
                                                            <path d="M18.087 14.033c0-2.264-1.83-4.1-4.087-4.1a4.094 4.094 0 0 0-4.087 4.1c0 2.265 1.83 4.1 4.087 4.1a4.094 4.094 0 0 0 4.087-4.1zm2 0c0 3.368-2.725 6.1-6.087 6.1-3.362 0-6.087-2.732-6.087-6.1 0-3.368 2.725-6.1 6.087-6.1 3.362 0 6.087 2.732 6.087 6.1zM15.282 32.09a40.603 40.603 0 0 0 4.171-4.25c3.748-4.441 5.982-9.124 5.982-13.806 0-6.228-5.312-11.466-11.435-11.466S2.565 7.805 2.565 14.033c0 4.682 2.234 9.365 5.982 13.805A40.603 40.603 0 0 0 14 33.168c.39-.311.82-.672 1.282-1.079zm12.153-18.056c0 5.235-2.43 10.327-6.453 15.095a42.584 42.584 0 0 1-5.826 5.677c-.266.211-.459.358-.567.436l-.589.43-.59-.43a18.925 18.925 0 0 1-.566-.436 42.584 42.584 0 0 1-5.825-5.676C2.993 24.36.564 19.268.564 14.032.565 6.695 6.78.567 14 .567s13.435 6.128 13.435 13.466z" fill-rule="nonzero"></path>
                                                        </svg>
                                                    </i>
                                                    <div class="storefrontAddresses__content">
                                                        {{$loc->address.' '.$loc->city.', '.$loc->state.' '.$loc->postal_code }}
                                                        <a href="javascript:void(0)" class="see-map" data-loc-id="{{ $loc->id }}" id="seeonmap_{{$key}}" style="color:#19b5bc">
                                                            <span class="app-static-map-box-open link--primary storefrontAddresses__show">See On Map</span>
                                                        </a>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="latitude" id="latitude_{{$loc->id}}" value="{{$loc->latitude}}">
                                                <input type="hidden" name="longitude" id="longitude_{{$loc->id}}" value="{{$loc->longitude}}">
                                                <input type="hidden" name="address" id="address_{{$loc->id}}" value="{{$loc->address.' '.$loc->city.', '.$loc->state.' '.$loc->postal_code }}">
                                                <div id="gmap_{{ $loc->id }}" class="app-show-map-vendor-custom app-static-map-container " style="width: 100%;{{$key==0?'height: 300px;display:block':'height: 300px;display:none' }}" ></div>
                                            </li>
                                            @endforeach
                                        </ul>
                                        @else
                                        <div class="storefrontAddresses__address">
                                            <i class="svgIcon svgIcon__mapMarkerOutline storefrontAddresses__icon"><svg viewBox="0 0 28 36"><path d="M18.087 14.033c0-2.264-1.83-4.1-4.087-4.1s-4.087 1.836-4.087 4.1c0 2.265 1.83 4.1 4.087 4.1s4.087-1.835 4.087-4.1zm2 0c0 3.368-2.725 6.1-6.087 6.1-3.362 0-6.087-2.732-6.087-6.1 0-3.368 2.725-6.1 6.087-6.1s6.087 2.732 6.087 6.1zM15.282 32.09a40.603 40.603 0 004.171-4.25c3.748-4.441 5.982-9.124 5.982-13.806 0-6.228-5.312-11.466-11.435-11.466S2.565 7.805 2.565 14.033c0 4.682 2.234 9.365 5.982 13.805A40.603 40.603 0 0014 33.168c.39-.311.82-.672 1.282-1.079zm12.153-18.056c0 5.235-2.43 10.327-6.453 15.095a42.584 42.584 0 01-5.826 5.677c-.266.211-.459.358-.567.436l-.589.43-.59-.43a18.925 18.925 0 01-.566-.436 42.584 42.584 0 01-5.825-5.676C2.993 24.36.564 19.268.564 14.032.565 6.695 6.78.567 14 .567s13.435 6.128 13.435 13.466z"></path></svg></i>
                                            <div class="storefrontAddresses__content"> 
                                                @if($vendorDetails['freelisting'] == 'No')
                                                {{$vendorDetails['company_data']['address'].', '.$vendorDetails['company_data']['city'].', '.(mb_strlen($vendorDetails['company_data']['postal_code']) > 6 ? $vendorDetails['company_data']['postal_code'] : chunk_split($vendorDetails['company_data']['postal_code'],3,' '))}}
                                                @else
                                                {{$vendorDetails['company_data']['city'].' - '.$vendorDetails['company_data']['province']}}
                                                @endif
                                            </div>
                                            <a href="javascript:;" class="seeOnMap" style="font-weight:bold;"><span class="link--primary">&nbsp; See On Map</span></a>
                                        </div>
                                        <div id="defMap2" class="defMapClass2" style="height:480px;width: 100%;"></div>
                                        @endif
                                    </div>
                                    @endif
                                </div><!-- END MAP -->
                                <!-- LOCATION -->
                                <div class="tab-pane" role="tabpanel" id="location">
                                    <iframe marginheight="0" marginwidth="0" src="https://maps.google.com/maps?q={{$vendorDetails['company_data']['address'].', '.$vendorDetails['company_data']['city'].', '.$vendorDetails['company_data']['country']}}&iwloc=a&amp;&output=embed" width="100%" height="500" frameborder="0" style="border:0;width: 100%;" allowfullscreen></iframe>
                                </div><!-- END LOCATION -->
                               
                                <!-- REVIEW -->
                                <div class="tab-pane" id="reviews">
                                    <div class="comments" style="max-height: 350px;overflow-y: auto;overflow-x: hidden;">
                                        @if($vendorDetails['rating_data_count'])
                                        <div class="comment-item">
                                            @foreach($vendorDetails['rating_data'] as $rat)
                                                <div class="row no-margin">
                                                    <div class="col-lg-1 col-xs-12 col-sm-2 no-margin">
                                                        <div class="avatar">
                                                            <img class="avatar-review" alt="avatar" src="{{URL::asset('public/images/default-avatar.jpg')}}">
                                                        </div><!-- /.avatar -->
                                                    </div><!-- /.col -->
                                                    <div class="col-xs-12 col-lg-11 col-sm-10 mb10">
                                                        <div class="comment-body">
                                                            <div class="meta-info">
                                                                <div class="author inline"><a href="#" class="bold">{{$rat['name']}}</a></div>
                                                                 <div class="date inline pull-right">
                                                                    {{date('d.m.Y',strtotime($rat['created_at']))}}
                                                                </div>
                                                                <div class="star-holder inline">
                                                                    <div class="readOnly" data-score="{{$rat['average_rating']}}"></div>
                                                                </div>
                                                            </div><!-- /.meta-info -->
                                                            <p class="comment-text">{!! nl2br($rat['review_description']) !!}</p><!-- /.comment-text -->
                                                        </div><!-- /.comment-body -->
                                                    </div><!-- /.col -->
                                                </div><!-- /.row -->
                                            @endforeach
                                        </div><!-- /.comment-item -->
                                        @endif
                                    </div>
                                    <div class="add-review row">
                                        <div class="col-sm-12 col-xs-12">
                                            <div class="weddy-contact-form">
                                                <h2>Add Review</h2>
                                                <div id="form-messages"></div>
                                                <form method="post" action="{{url('save-review')}}">
                                                    {{ csrf_field() }}
                                                    @if($errors->has('rname'))
                                                        <span>{{ $errors->first('rname') }}</span>
                                                    @endif
                                                    <div class="input_top">
                                                        <input type="text" class="form_control" id="rname" name="rname" placeholder="Your Name" value="{{$name}}" required>
                                                    </div>
                                                    @if($errors->has('remail'))
                                                        <span>{{$errors->first('remail')}}</span>
                                                    @endif
                                                    <div class="input_top">
                                                        <input type="email" class="form_control" name="remail" placeholder="Email address" value="{{$email}}" required>
                                                    </div>   
                                                    @if($errors->has('score'))
                                                        <span>{{$errors->first('score')}}</span>
                                                    @endif
                                                    <div class="field-row star-row">
                                                        <br> <label>Your rating</label>
                                                        <div class="star-holder">
                                                            <div class="writeRatig" data-score="0"></div>
                                                        </div>
                                                    </div>                      
                                                    <div class="textarea" style="width:100%;margin-left: 0px;">
                                                        <textarea id="message" class="form_control" name="review_description" placeholder="Write your Message" style="width:100%;"></textarea>
                                                    </div>
                                                    <input type="hidden" name="request_id" value="{{ $idx }}">
                                                    <input type="hidden" name="vendor_id" value="{{ $vendorDetails['vendor_id'] }}">
                                                    <div class="contact-form-btn text-center">
                                                        <input type="submit" class="btn btn-lg outline btn-single-outline"  value="Submit">
                                                    </div>
                                                </form>
                                            </div><!-- /.new-review-form -->
                                        </div><!-- /.col -->
                                    </div><!-- /.add-review -->
                                </div><!-- /.tab-pane #reviews -->
                                
                            </div> <!--/.col-sm-8 col-xs-12 -->
                            <div class="col-sm-4 col-xs-12 rightSidebar">
                                <div class="theiaStickySidebar">
                                    <div>
                                        <div class="storefront-aside storefront-aside-animate">
                                            <div id="app-emp-form-contactar" class="storefront-contact custom-color relative app-sticky-form" data-id-empresa="15043" data-concertar-cita="">
                                                <div id="app-lateral-form">
                                                    <div class="overflow mb10">
                                                        <p class="storefront-contact-title"><i class="svgIcon svgIcon__sendEnvelope storefrontContact__titleIcon svgIcon--align"><svg viewBox="0 0 34 16"><path d="M10.25 6.75v1.5H.75v-1.5h9.5zm.5 4.5v1.5h-5.5v-1.5h5.5zm23 2.293c0 1.157-.898 2.207-1.992 2.207H16.242c-1.094 0-1.992-1.05-1.992-2.207V2.473c0-1.158.898-2.223 1.992-2.223h15.516c1.094 0 1.992 1.065 1.992 2.223v11.07zm-1.5 0V2.473c0-.38-.288-.723-.492-.723H16.242c-.204 0-.492.342-.492.723v11.07c0 .376.283.707.492.707h15.516c.209 0 .492-.331.492-.707zm-7.807-5.308a.75.75 0 01-.886 1.21l-6.882-5.04a.75.75 0 11.886-1.21l6.882 5.04zm0 1.21a.75.75 0 01-.886-1.21l6.882-5.04a.75.75 0 11.886 1.21l-6.882 5.04zm6.984 1.68a.75.75 0 01-1.09 1.03l-2.647-2.8a.75.75 0 011.09-1.03l2.647 2.8zm-13.764 1.03a.75.75 0 01-1.09-1.03l2.647-2.8a.75.75 0 011.09 1.03l-2.647 2.8z" fill-rule="nonzero"></path></svg></i>MESSAGE THIS HEALTH PROFESSIONAL MEMBER NOW </p>
                                                    </div>
                                                    <div id="contact-emp">
                                                        @if(session()->has('success'))
                                                            <div class="alert alert-info">{{session()->get('success')}}</div>
                                                        @endif
                                                        <form class="app-internal-tracking-form vendor-contact-form" name="frmContactoInline" action="{{url('page-request-enquiry')}}" method="post" >
                                                            {{ csrf_field() }}
                                                            @if($errors->has('name'))
                                                                <span class="handler-error">{{ $errors->first('name') }}</span>
                                                            @endif
                                                            <div class="input-group">
                                                                <i class="icon-header icon-header-form-user"></i>
                                                                <input name="name" maxlength="100" type="text" value="{{$name}}" placeholder="First and Last Name">
                                                            </div>
                                                            @if($errors->has('email'))
                                                                <span>{{$errors->first('email')}}</span>
                                                            @endif
                                                            <div class="input-group">
                                                                <i class="icon-header icon-header-form-mail"></i>
                                                                <input type="text" name="email" value="{{$email}}" onchange="vendors_usuarioRegistrado(this);" placeholder="E-mail">
                                                            </div>
                                                            @if($errors->has('phone'))
                                                                <span>{{$errors->first('phone')}}</span>
                                                            @endif
                                                            <div class="input-group">
                                                                <i class="icon-header icon-header-form-phone"></i>
                                                                <input type="text" oninput="return formatPhoneNumber(this.value);" onkeyup="return formatPhoneNumber(this.value);" onchange="return formatPhoneNumber(this.value);" class="phone-number-type" name="phone" value="{{$phone}}" maxlength="12"  placeholder="(XXX) XXX-XXXX">
                                                            </div>
                                                            
                                                            
                                                            <div class="row">
                                                                <div class="">
                                                                    <div class="g-recaptcha" data-sitekey="{{'6Lfst80ZAAAAALX7HIMxbftvMW-Fqit6kS8ajQh3'}}"></div>
                                                                </div>
                                                            </div>
                                                            <script src="https://www.google.com/recaptcha/api.js" async defer></script>
                                                            <input type="hidden" id="r-company_id" name="company_id" value="{{$vendorDetails['company_data']['id']}}">
                                                            <button class="btn btn-primary btn-full btn-lg" type="submit">Send & Get Healthier</button>
                                                            <div class="icheckbox_grey checked qc_checked">
                                                                <input class="app-icheck" type="checkbox" name="newsletter" value="1" checked="checked">
                                                                <p>Yes, I want My Health Squad to send me promotional emails about health & wellness, its members and partners.</p>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div><!-- Sidebar -->
                        </div><!--/.row -->
                    </div><!-- /.tab-content -->
                </div><!-- /.tab-holder -->
            </div><!-- /.container -->
        </section><!-- / END single-product-tab SECTION-->
    @else
        <h3 class="text-center" style="color:#00AEAF;">
            <strong><i class="fa fa-frown-o" aria-hidden="true" style="font-size: 60px;"></i><br>Vendor not found</strong>
        </h3>
        <br><p class="text-center">Sorry, We couldn't found that page.</p>
    @endif
</section><!-- / END ABOUT SECTION-->
@if(count(request()->segments())==3)
    <script async defer src="https://maps.googleapis.com/maps/api/js?key={{ env('GMAP_API_KEY_NEW')}}&callback=initialize"></script>
@endif
@if(request()->segment(4)=='map')
@endif
<script async defer src="https://maps.googleapis.com/maps/api/js?key={{env('GMAP_API_KEY_NEW')}}"></script>
@php if(isset($_GET['review']) && $_GET['review'] == 1) { @endphp
<script type="text/javascript">
    $(window).load(function() {
        $('#reviewopen a').trigger('click');
    });
</script>
@php }  @endphp
<script>
var latitude = 0,longitude = 0;
$(document).ready(function() {
    $('.phone-number-show').hide();
    $('.phone-number-option').on('click',function(e){
        e.preventDefault();
        var tel = $(this).attr('href');
        // alert(123);
        var slug = "{{@$vendorDetails['company_data']['business_name_slug']}}";
        // alert(slug);
        if($('.phone-number-show').is(":hidden"))
            $.ajax({
                url: "/get_phone_number",
                method: 'GET',
                data: 'slug='+slug,
                dataType: "json",   
                success: function(data) {
                    // alert(data);
                    $('.phone-number-show').show();
                    $('.phone-number-option').hide();
                    
                }
            });
        else
            $('.phone-number-show').hide();
    });
    setTimeout(function() {
        $("#seeonmap_0").trigger('click');
    },200);
    $("#loc_map").click(function() {
        //setTimeout(function() {
            $('.nav-tabs a[href="#location_map"]').tab('show');
        //},100);
    });
    $(document).on("click", ".see-map, #seeonmap_0", function(e) {
       
        var win = window.open('http://www.google.com/maps/place/'+$("#latitude_"+mid).val()+','+$("#longitude_"+mid).val(), '_blank');
        win.focus();
    });
    $(document).on("click", ".seeOnMap", function(e) {
        // $('.defMapClass2').toggle();
        // var win = window.open('http://www.google.com/maps/place/'+latitude+','+longitude, '_blank');
        var address = $('.business-address').text();
        var win = window.open('http://www.google.com/maps/place/'+encodeURIComponent(address), '_blank');
        win.focus();
    });
    <?php if(empty((array) @$vendorDetails['location'])) { ?>
        updateLatLong();
    <?php } ?>
});
function map_initialize(id,lat,lng,address) {
    // alert(id+' '+lat+ ' '+lng+' '+address);
    var mapOptions = {
        center: new google.maps.LatLng(parseFloat(lat),parseFloat(lng)),
        zoom: 8
    };
    var map = new google.maps.Map(document.getElementById("gmap_"+id), mapOptions);
    var infowindow = new google.maps.InfoWindow({
        content: address
    });
    var marker = new google.maps.Marker({
        position: new google.maps.LatLng(parseFloat(lat), parseFloat(lng)),
        map: map,
        title: ''
    });
    marker.addListener('click', function() {
        infowindow.open(map, marker);
    });
}
<?php if(!empty((array) @$vendorDetails['location'])) { ?>
function initialize() {
    var lat = "{{  @$vendorDetails['location']->latitude? @$vendorDetails['location']->latitude:'' }}";
    var lng = "{{  @$vendorDetails['location']->longitude? @$vendorDetails['location']->longitude:'' }}";
    var address = "{{  @$vendorDetails['location']->address? @$vendorDetails['location']->address:'' }}";
    var mapOptions = {
        center: new google.maps.LatLng(parseFloat(lat),parseFloat(lng)),
        zoom: 8
    };
    var map = new google.maps.Map(document.getElementById("gmap"), mapOptions);
    var infowindow = new google.maps.InfoWindow({
        content: address
    });
    var marker = new google.maps.Marker({
        position: new google.maps.LatLng(parseFloat(lat), parseFloat(lng)),
        map: map,
        title: ''
    });
    marker.addListener('click', function() {
        infowindow.open(map, marker);
    });
}
<?php } else { ?>
function updateLatLong()
{
    var city = "{{@$vendorDetails['company_data']['city']}}";
    var address = "{{@$vendorDetails['company_data']['address']}}";
    var slug = "{{@$vendorDetails['company_data']['business_name_slug']}}";
    address = $('.business-address').text();
    $.ajax({
        url: "/autocomplete_latlong_2",
        method: 'GET',
        data: 'slug='+slug,
        dataType: "json",
        success: function(data) {
            if(data[0] && data[1] && data[1]) {
                $('#gmap').hide();
                defInitialize1(data[0],data[1],data[2]);
                defInitialize2(data[0],data[1],data[2]);
            }
        }
    });
}
function defInitialize1(lat,lng,address) {
    // alert(lat+ ' '+lng+' '+address);
    latitude = lat;
    longitude = lng;
    try {
        var mapOptions = {
            center: new google.maps.LatLng(parseFloat(lat),parseFloat(lng)),
            zoom: 8
        };
        var map = new google.maps.Map(document.getElementById("defMap1"), mapOptions);
        var infowindow = new google.maps.InfoWindow({
         content: address
        });
        var marker = new google.maps.Marker({
            position: new google.maps.LatLng(parseFloat(lat), parseFloat(lng)),
            map: map,
            title: ''
        });
        marker.addListener('click', function() {
            infowindow.open(map, marker);
        });
    } catch(e) {
        console.log(e);
    }
}
function defInitialize2(lat,lng,address) {
    try {
        var mapOptions = {
            center: new google.maps.LatLng(parseFloat(lat),parseFloat(lng)),
            zoom: 8
        };
        var map = new google.maps.Map(document.getElementById("defMap2"), mapOptions);
        var infowindow = new google.maps.InfoWindow({
         content: address
        });
        var marker = new google.maps.Marker({
            position: new google.maps.LatLng(parseFloat(lat), parseFloat(lng)),
            map: map,
            title: ''
        });
        marker.addListener('click', function() {
            infowindow.open(map, marker);
        });
    } catch(e) {
        console.log(e);
    }
}
<?php } ?>


$('.featured_slider').slick({
  centerMode: true,
  infinite: true,
  // centerPadding: '60px',
  variableWidth: true,
  slidesToShow: 1,
  nextArrow: '<i class="fa fa-angle-right"></i>',
  prevArrow: '<i class="fa fa-angle-left"></i>',
  responsive: [
    {
      breakpoint: 768,
      settings: {
        arrows: false,
        centerMode: true,
        centerPadding: '40px',
        slidesToShow: 3
      }
    },
    {
      breakpoint: 480,
      settings: {
        arrows: false,
        centerMode: true,
        centerPadding: '40px',
        slidesToShow: 1
      }
    }
  ]
});
function formatPhoneNumber(phoneNumberString) {
  var cleaned = ('' + phoneNumberString).replace(/\D/g, '');
  var match = cleaned.match(/^(1|)?(\d{3})(\d{3})(\d{4})$/);
  if (match) {
    var intlCode = (match[1] ? '+1 ' : '');
    console.log([intlCode, '(', match[2], ') ', match[3], '-', match[4]].join(''));
    $('.phone-number-type').val([intlCode, '(', match[2], ') ', match[3], '-', match[4]].join(''));
    return [intlCode, '(', match[2], ') ', match[3], '-', match[4]].join('');
  }
  return null;
}
</script>
@if($vendorDetails['freelisting'] == 'Yes')
@include('includes.register-popup')
@endif
@include('includes.footer')
@endsection