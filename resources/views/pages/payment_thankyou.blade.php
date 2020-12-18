@extends('layouts.default')
@section('meta_title',$pageData->meta_title)
@section('meta_keyword',$pageData->meta_keyword)
@section('meta_description',$pageData->meta_description)
@section('content')
@include('includes.menu')
<style>
    .imgCentered {
        position: absolute;
        top: 50%;
        left: 50%;
        padding-top: 35%;
        transform: translate(-50%, -50%);
    }
    .btnCls {
        color:#fff;
        outline: none;
        background-color:#bb8a20;
        font-size: 18px;
        font-family:inherit;
    }
    .btnCls:focus {
        outline: none !important;
        -moz-outline: none !important;
        -ms-outline: none !important;
        -o-outline: none !important;
        -webkit-outline: none !important;
    }
</style>
<section class="section-padding">
    <div class="container">
        <h1 class="text-center border-bottom"><b>Thank You '{{ucwords($vendors->contact_person)}}'</b></h1>
        <div class="col-md-12">
            <p class="m25">We appreciate your trust and want to know you better. As soon as you get your mail of payment has been authorized and approved, after that you can uploads photos & videos. We will highlight them in your Business details & description.</p>
            <div class="col-md-7">
                <h3 class="m10">About Your Details</h3>
                <div class="directory-img-item">
                    <div style="width:100%;text-align:left;padding:10px;font-size:14px;">
                        <table>
                            <tr>
                                <th style="padding:8px;font-size:16px;" width="35%">Email-Id : </th>
                                <th style="padding:8px;font-size:15px;" width="65%">{{$vendors->email}}</th>
                            </tr>
                            <tr>
                                <th style="padding:8px;font-size:16px;" width="35%">UserName : </th>
                                <th style="padding:8px;font-size:15px;" width="65%">{{ucwords($vendors->username)}}</th>
                            </tr>
                            <tr>
                                <th style="padding:8px;font-size:16px;" width="35%">Telephone : </th>
                                <th style="padding:8px;font-size:15px;" width="65%">{{$vendors->telephone.', '.$vendors->mobile}}</th>
                            </tr>
                            <tr>
                                <th style="padding:8px;font-size:16px;" width="35%">Category : </th>
                                <th style="padding:8px;font-size:15px;" width="65%">{{$vendors->category_data->title}}</th>
                            </tr>
                            <tr>
                                <th style="padding:8px;font-size:16px;" width="35%">Website : </th>
                                <th style="padding:8px;font-size:15px;" width="65%">{{$vendors->website}}</th>
                            </tr>
                            <tr>
                                <th style="padding:8px;font-size:16px;" width="35%">Business Name : </th>
                                <th style="padding:8px;font-size:15px;" width="65%">{{ucwords($vendors->company_data->business_name)}}</th>
                            </tr>
                            <tr>
                                <th style="padding:8px;font-size:16px;" width="35%">Business Details : </th>
                                <th style="padding:8px;font-size:15px;" width="65%">{{$vendors->company_data->business_detail}}</th>
                            </tr>
                            <tr>
                                <th style="padding:8px;font-size:16px;" width="35%">Business Address : </th>
                                <th style="padding:8px;font-size:15px;" width="65%">{{$vendors->company_data->business_address}}</th>
                            </tr>
                            <tr>
                                <th style="padding:8px;font-size:16px;" width="35%">Your Address : </th>
                                <th style="padding:8px;font-size:15px;" width="65%">{{$vendors->company_data->address.', '.$vendors->company_data->city.', '.$vendors->company_data->province.' - '.$vendors->company_data->postal_code.', '.$vendors->company_data->country}}</th>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="text-center"><a href="{{url('/')}}" class="btn btnCls">Go To Home</a></div>
            </div>
            <div class="col-md-5">
                <h3 class="m10">Package Details</h3>
                <div class="directory-img-item">
                    <div class="vendor-slider">
                        <div class="vendor-slider-content img-zoom">
                            @if(file_exists(public_path().'/subscription/'.$subscription->image))
                                <img src="{{asset('public/subscription/'.$subscription->image)}}" style="width:100%;height:100%;">
                            @else
                                <img src="{{asset('public/subscription/no-image.jpg')}}" style="width:100%;height:100%;">
                            @endif
                            <div class="imgCentered">
                                <h3 style="color:#dbdbdb;font-weight:bold;">{{$subscription->type.' ( '.$subscription->duration.' )'}}</h3>
                                <h1 style="color:#dbdbdb;font-weight:bold;">{{$subscription->amount}} $</h1>
                            </div>
                        </div>
                    </div>
                    <div style="width:100%;text-align:left;padding:10px;font-size:14px;">
                        @if($subscription->feature_1)
                        <p>@if($subscription->feature1_favour == 0)
                                <i class="fa fa-times" style="color:#ff0b37;width:14px;"></i>
                            @else
                                <i class="fa fa-check" style="color:#00b90c;width:14px;"></i>
                            @endif
                            {{substr(strip_tags($subscription->feature_1),0,75)}}
                        </p>
                        @endif
                        @if($subscription->feature_2)
                        <p>@if($subscription->feature2_favour == 0)
                                <i class="fa fa-times" style="color:#ff0b37;width:14px;"></i>
                            @else
                                <i class="fa fa-check" style="color:#00b90c;width:14px;"></i>
                            @endif
                            {{substr(strip_tags($subscription->feature_2),0,75)}}
                        </p>
                        @endif
                        @if($subscription->feature_3)
                        <p>@if($subscription->feature3_favour == 0)
                                <i class="fa fa-times" style="color:#ff0b37;width:14px;"></i>
                            @else
                                <i class="fa fa-check" style="color:#00b90c;width:14px;"></i>
                            @endif
                            {{substr(strip_tags($subscription->feature_3),0,75)}}
                        </p>
                        @endif
                        @if($subscription->feature_4)
                        <p>@if($subscription->feature4_favour == 0)
                                <i class="fa fa-times" style="color:#ff0b37;width:14px;"></i>
                            @else
                                <i class="fa fa-check" style="color:#00b90c;width:14px;"></i>
                            @endif
                            {{substr(strip_tags($subscription->feature_4),0,75)}}
                        </p>
                        @endif
                        @if($subscription->feature_5)
                        <p>@if($subscription->feature5_favour == 0)
                                <i class="fa fa-times" style="color:#ff0b37;width:14px;"></i>
                            @else
                                <i class="fa fa-check" style="color:#00b90c;width:14px;"></i>
                            @endif
                            {{substr(strip_tags($subscription->feature_5),0,75)}}
                        </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div style="clear:both;"></div>
    </div>
</section>
@include('includes.footer')
@endsection