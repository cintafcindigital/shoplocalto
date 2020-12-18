@extends('layouts.default')
@section('meta_title',$pageData->meta_title)
@section('meta_keyword',$pageData->meta_keyword)
@section('meta_description',$pageData->meta_description)
@section('content')
<?php
    $session_payType = Session::get('session_payType');
    $session_vendorId = Session::get('session_vendorId');
?>
<div class="text-center mb15">
	<a href="{{url('/')}}"><img src="{{asset('public/images/Logo_1584618693.png')}}" alt="" style="width:25%;"></a>
</div>
<style>
	.adminAccessHero__title p {
		font-size: 30px;
	}
    .btnCls {
        width:25%;
        color:#fff;
        padding:10px;
        outline: none;
        -moz-outline: none;
        -ms-outline: none;
        -o-outline: none;
        -webkit-outline: none;
        border-radius:0px;
        font-family:inherit;
        background-color:#bb8a20;
    }
    .btnCls:focus {
        outline: none !important;
        -moz-outline: none !important;
        -ms-outline: none !important;
        -o-outline: none !important;
        -webkit-outline: none !important;
    }
    .searchListing {
        width:44%;
        padding:5px;
        border:3px solid #bb8a20;
    }
    .droplayer {
        border: 1px solid #D9D9D9;
        border-radius: 3px;
        box-shadow: 0 3px 4px 0 rgba(0,0,0,.15);
        width: 35%;
        top: 87% !important;
        left: 31%;
        z-index: 900;
        background: #FFF;
        padding: 0px;
        position: absolute;
        text-align: left;
    }
    .ml170 {
        margin-left: 170px;
    }
    .mt100 {
        margin-top: 100px;
    }
    .ml-25 {
        margin-left: -25px;
    }
    .mt-20 {
        margin-top: -20px;
    }
</style>
<section id="slider-seciton"><!-- Sec-1 -->
    <div class="header-bottom"></div>
    <div id="myCarousel" class="carousel slide inner-slider" data-ride="carousel">
        <div class="carousel-inner" role="listbox" style="background:url({{URL::asset('public/sliders/'.$pageData['image'])}});background-size:cover;">
            <div class="item active slider-background">
                <div class="wrapper wrapper--blood">
                    <div class="pure-g">
                        <div class="pure-u-5-8 text-center ml170">
                            <h2 class="adminAccessHero__title floatleft mt100 mb5">{!! $pageData['image_description'] !!}</h2>
                            @if($session_payType == 'lead')
                                <p class="floatleft" style="color:#fff;">@if(@$vendors->contact_person) Welcome {{@$vendors->contact_person}}, @else Welcomes you, @endif thank you for your interest in the request from one of pout MHS's clients.</p>
                                <p class="floatleft" style="color:#fff;">In order to view this new lead please activate your Free Listing to a Paid Listing</p>
                            @else
                                <p class="floatleft" style="color:#fff;"><i class="fa fa-check" style="color:green;"></i> Showcase your services on our industry leading site.</p>
                                <p class="floatleft" style="color:#fff;"><i class="fa fa-check" style="color:green;"></i> Reach local engaged clients and book more weddings.</p>
                                <p class="floatleft" style="color:#fff;"><i class="fa fa-check" style="color:green;"></i> Trusted by over 1000 Canadian health professionals.</p>
                            @endif
                            <form action="#" class="mt30 ml-25" style="display:inline-block;width:100%;">
                                @if($session_payType == 'lead')
                                    <a href="{{url('payment-packages')}}" class="btn btnCls mt-20">Upgrade Your Account</a>&nbsp;
                                    <p style="color:#fff;display:inline-block;text-align:left;width:70%;">
                                        @if(@$vendors->company_data->business_name)
                                            {{@$vendors->company_data->business_name}}<br/>
                                            {{@$vendors->company_data->address.', '.@$vendors->company_data->postal_code.', '.@$vendors->company_data->city.', '.@$vendors->company_data->province}}
                                        @endif
                                    </p>
                                @else
                                    @if($session_vendorId)
                                        <a href="{{url('payment-packages')}}" class="btn btnCls">Upgrade Your Account</a>&nbsp;
                                    @else
                                        <a href="{{url('register')}}" class="btn btnCls" target="blank">Create New Account</a>&nbsp;
                                    @endif
                                	<input type="text" id="search_listing" class="searchListing" placeholder="Search your business name" value="{{@$vendors->company_data->business_name}}" autocomplete="off">&nbsp;
                                    <div class="droplayer droplayer-scroll app-suggest-vendor-div-default vendor-suggest-list hide">
                                        <ul class="nav-main-list search-vendor-list"></ul>
                                    </div>
                                	<button type="button" onclick="get_search_listing();" class="btn btnCls">Search Your Listing</button>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section><!-- End Sec-1 -->
<style>
	.adminAccessSteps {
	    padding: 50px 0;
	    text-align: center;
	}
	.wrapper--blood {
	    padding: 0 15px;
	}
	.adminAccessSteps__item {
	    padding: 0 30px;
	}
	.adminAccessSteps__icon {
	    margin: 0 auto 15px;
	    height: 61px;
	    background: url(/public/build/sprite_access.svg) no-repeat scroll 50% 0 transparent;
	    display: block;
	}
	.adminAccessSteps__icon--search {
	    background-position: 50% 0;
	}
	.adminAccessSteps__icon--sol {
	    background-position: 50% -78px;
	}
	.adminAccessSteps__icon--users {
	    background-position: 50% -161px;
	}
	.adminAccessSteps__title {
	    font-size: 18px;
	    line-height: 28px;
	    font-weight: 600;
	}
	.adminAccessSteps__description--small {
	    font-size: 16px;
	    line-height: 25.88854384px;
	}
	.adminAccessSteps__description {
	    font-size: 18px;
	    line-height: 29.12461182px;
	    margin: 0;
	}
</style>
<section class="adminAccessSteps"><!-- Sec-2 -->
    <div class="pure-g">
        <div class="pure-u-1-3">
            <div class="adminAccessSteps__item">
                <i class="adminAccessSteps__icon adminAccessSteps__icon--search"></i>
                <p class="adminAccessSteps__title">Free Marketing Tools</p>
                <p class="adminAccessSteps__description adminAccessSteps__description--small">Communicate with your customers right on the app. Send Email, SMS and Chat with your customers where they are.</p>
            </div>
        </div>
        <div class="pure-u-1-3">
            <div class="adminAccessSteps__item">
                <i class="adminAccessSteps__icon adminAccessSteps__icon--sol"></i>
                <p class="adminAccessSteps__title">Get More Leads</p>
                <p class="adminAccessSteps__description adminAccessSteps__description--small">Stand out of competition and flaut your work in front of the right target audience.</p>
            </div>
        </div>
        <div class="pure-u-1-3">
            <div class="adminAccessSteps__item">
                <i class="adminAccessSteps__icon adminAccessSteps__icon--users"></i>
                <p class="adminAccessSteps__title">Manage Your Business</p>
                <p class="adminAccessSteps__description adminAccessSteps__description--small">Manage your business from a single platform. Book appointments and follow-up with your customers. Your business at your fingertips</p>
            </div>
        </div>
    </div>
</section><!-- End Sec-2 -->
<style>
    .adminTourBlock {
        padding: 70px 0;
    }
    .adminTourBlock__container {
        display: -webkit-box;
        display: -webkit-flex;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        -webkit-flex-direction: row;
        -ms-flex-direction: row;
        flex-direction: row;
        -webkit-box-pack: space-between;
        -webkit-justify-content: space-between;
        -ms-flex-pack: space-between;
        justify-content: space-between;
        -webkit-box-align: center;
        -webkit-align-items: center;
        -ms-flex-align: center;
        align-items: center;
    }
    .adminTourBlock__column {
        width: 45%;
    }
    .adminTourBlock__img {
        margin: 0 auto;
        max-width: 100%;
        display: block;
    }
    .adminTourBlock__title {
        font-size: 32px;
        line-height: 40px;
        font-weight: 300;
        margin-bottom: 15px;
    }
    .adminTourBlock__description {
        font-size: 18px;
        line-height: 28px;
        margin: 0;
    }
</style>
<section class="adminTourBlock"><!-- Sec-3 -->
    <div class="adminTourBlock__container wrapper wrapper--blood">
        <div class="adminTourBlock__column">
            <img src="{{asset('public/build/gen_storefront-1_en-CA.png')}}" class="adminTourBlock__img box">
        </div>
        <div class="adminTourBlock__column">
            <h2 class="adminTourBlock__title">Get more exposure for your business</h2>
            <p class="adminTourBlock__description">Be visible to couples on top search engines with your custom, mobile friendly Storefront. Our Content Team will review and optimise your business description, photos, and videos to boost your SEO ranking.</p>
        </div>
    </div>
</section>
<section class="adminTourBlock bg">
    <div class="adminTourBlock__container wrapper wrapper--blood">
        <div class="adminTourBlock__column">
            <h2 class="adminTourBlock__title">Add unlimited photos to your gallery</h2>
            <p class="adminTourBlock__description">Show off your work to potential clients by uploading high-quality images that highlight your products or services to your Storefront.</p>
        </div>
        <div class="adminTourBlock__column">
            <img src="{{asset('public/build/gen_storefront-2_en-CA.png')}}" class="adminTourBlock__img">
        </div>
    </div>
</section><!-- End Sec-3 -->
<section class="adminTourBlock"><!-- Sec-4 -->
    <div class="adminTourBlock__container wrapper wrapper--blood">
        <div class="adminTourBlock__column">
            <img src="{{asset('public/build/gen_storefront-3_en-CA.png')}}" class="adminTourBlock__img">
        </div>
        <div class="adminTourBlock__column">
            <h2 class="adminTourBlock__title">Upload your videos</h2>
            <p class="adminTourBlock__description">Showcase your work by adding unlimited videos related to your business and wedding services to your Storefront.</p>
        </div>
    </div>
</section>
<section class="adminTourBlock bg">
    <div class="adminTourBlock__container wrapper wrapper--blood">
        <div class="adminTourBlock__column">
            <h2 class="adminTourBlock__title">Impress potential clients</h2>
            <p class="adminTourBlock__description">Share key details about your business to help clients find what they need, including pricing and FAQs. Plus, appear in couples' searches by adding your available dates.</p>
        </div>
        <div class="adminTourBlock__column">
            <img src="{{asset('public/build/gen_storefront-4.png')}}" class="adminTourBlock__img">
        </div>
    </div>
</section><!-- End Sec-4 -->
<section class="adminTourBlock"><!-- Sec-5 -->
    <div class="adminTourBlock__container wrapper wrapper--blood">
        <div class="adminTourBlock__column">
            <img src="{{asset('public/build/gen_promos-1_en-CA.png')}}" class="adminTourBlock__img">
        </div>
        <div class="adminTourBlock__column">
            <h2 class="adminTourBlock__title">Stand out from the competition</h2>
            <p class="adminTourBlock__description">Add a Deal for your business to automatically receive a promotional flag on your Storefront and directory listing.</p>
        </div>
    </div>
</section>
<section class="adminTourBlock bg">
    <div class="adminTourBlock__container wrapper wrapper--blood">
        <div class="adminTourBlock__column">
            <h2 class="adminTourBlock__title">Attract more clients</h2>
            <p class="adminTourBlock__description">Drive new business and fill your calendar by offering seasonal deals to help meet your booking goals.</p>
        </div>
        <div class="adminTourBlock__column">
            <img src="{{asset('public/build/gen_promos-2.png')}}" class="adminTourBlock__img">
        </div>
    </div>
</section><!-- End Sec-5 -->
<section class="adminTourBlock"><!-- Sec-6 -->
    <div class="adminTourBlock__container wrapper wrapper--blood">
        <div class="adminTourBlock__column">
            <img src="{{asset('public/build/gen_events-1_en-CA.png')}}" class="adminTourBlock__img">
        </div>
        <div class="adminTourBlock__column">
            <h2 class="adminTourBlock__title">Attend Free Education Seminars</h2>
            <p class="adminTourBlock__description">Perfect Wedding Day likes to keep their vendors up-to-date with the latest trends related to customer Acquistion, Social Media, Lead Management and Mentorship Programs</p>
        </div>
    </div>
</section><!-- End Sec-6 -->
<section class="adminTourBlock"><!-- Sec-7 -->
    <div class="adminTourBlock__container wrapper wrapper--blood">
        <div class="adminTourBlock__column">
            <img src="{{asset('public/build/gen_solic-1_en-CA.png')}}" class="adminTourBlock__img">
        </div>
        <div class="adminTourBlock__column">
            <h2 class="adminTourBlock__title">Manage your leads</h2>
            <p class="adminTourBlock__description">Receive instant email and mobile notifications when you get a new lead or message.</p>
        </div>
    </div>
</section>
<section class="adminTourBlock bg">
    <div class="adminTourBlock__container wrapper wrapper--blood">
        <div class="adminTourBlock__column">
            <h2 class="adminTourBlock__title">Talk to Your Clients and Book Appointments</h2>
            <p class="adminTourBlock__description">Access the leads and reach out to them by booking an appointment or contacting them via Email, SMS or a Phone Calls right from a single dashboard.</p>
        </div>
        <div class="adminTourBlock__column">
            <img src="{{asset('public/build/gen_solic-2.png')}}" class="adminTourBlock__img">
        </div>
    </div>
</section>
<section class="adminTourBlock">
    <div class="adminTourBlock__container wrapper wrapper--blood">
        <div class="adminTourBlock__column">
            <img src="{{asset('public/build/gen_solic-3_en-CA.png')}}" class="adminTourBlock__img">
        </div>
        <div class="adminTourBlock__column">
            <h2 class="adminTourBlock__title">Track your performance</h2>
            <p class="adminTourBlock__description">Receive Storefront analytics in real time to easily track your business growth.</p>
        </div>
    </div>
</section><!-- End Sec-7 -->
<style>
	.adminLandingFooter {
	    padding: 110px 50px 195px;
	    background: url(/public/build/bg_landing-footer.jpg) no-repeat scroll 50% 50% #333;
	    background-size: cover;
	    text-align: center;
	    position: relative;
	}
	.adminLandingFooter__title {
	    font-size: 32px;
	    line-height: 40px;
	    font-weight: 300;
	    color: #222;
	    margin-bottom: 50px;
	}
	.adminLandingCta {
	    font-size: 20px;
	    line-height: 26px;
	    font-weight: 600;
	    background: #19b5bc;
	    padding: 13px 21px;
	    border-radius: 2px;
	    color: #fff;
	    cursor: pointer;
	    display: inline-block;
	}
</style>
<section class="adminLandingFooter"><!-- Sec-8 -->
    <p class="adminLandingFooter__title">Grow your business with Perfect Wedding Day!</p>
    <a class="adminLandingCta" href="{{url('payment-packages')}}">Upgrade Your Account</a>
    <a class="adminLandingCta" href="{{url('/register')}}">Create a New Listing</a>
</section><!-- End Sec-8 -->
@include('includes.footer')
<script>
    function get_search_listing() {
        var searchKey = $('#search_listing').val();
        if(searchKey) {
            window.location.href = "{{url('search?search=')}}/"+searchKey;
        }
    }
    $('#search_listing').keyup(function() {
        var searchKey = $('#search_listing').val();
        if(searchKey.length > 2) {
            $.ajax({
                url: "{{url('search-listing')}}/"+searchKey,
                type: 'GET',
                data: '',
                global: false, 
                success :function(response) {
                    if(response.length) {
                        var htmlVal = '';
                        var baseUrl = "{{url('/')}}";
                        var session_vendorId = "{{$session_vendorId}}";
                        $.each(response, function(key,values) {
                            if(session_vendorId) {
                                htmlVal += '<li class="nav-main-list-item pure-u-1-1"><a style="padding:15px 0px;" class="nav-main-list-link droplayer-tools-icon tasklist" href="'+baseUrl+'/'+values.parent_slug+'/'+values.slug+'/'+values.business_name_slug+'">'+values.business_name+', '+ values.province +'</a></li>';
                            } else {
                                htmlVal += '<li class="nav-main-list-item pure-u-1-1"><a style="padding:15px 0px;" class="nav-main-list-link droplayer-tools-icon tasklist" href="'+baseUrl+'/register?vendorId='+values.vendor_id+'">'+values.business_name+', '+ values.province +'</a></li>';
                            }
                        });
                        $('.search-vendor-list').html(htmlVal);
                        $('.vendor-suggest-list').removeClass('hide');
                    } else {
                        $('.vendor-suggest-list').removeClass('hide');
                        $('.search-vendor-list').html('<li class="nav-main-list-item pure-u-1-1"><a style="padding:15px 0px;" class="nav-main-list-link droplayer-tools-icon tasklist" href="javascript:;">No matches have been found</a></li>');
                    }
                },error: function(data) {
                    var errors = data.responseJSON;
                    console.log(errors);
                }
            });
        } else {
            $('.vendor-suggest-list').addClass('hide');
        }
    });
</script>
@endsection