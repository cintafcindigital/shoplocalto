@extends('layouts.default')
@section('meta_title',$pageData->meta_title)
@section('meta_keyword',$pageData->meta_keyword)
@section('meta_description',$pageData->meta_description)
@section('content')
@include('includes.menu')
<?php
    $session_payType = Session::get('session_payType');
    $session_vendorId = Session::get('session_vendorId');
?>
<style>
    .btnCls {
        color:#fff;
        padding:14px;
        outline: none;
        -moz-outline: none;
        -ms-outline: none;
        -o-outline: none;
        -webkit-outline: none;
        border-radius:0px;
        font-family:inherit;
        background-color:#bb8a20;
        font-size: 17px;
    }
    .btnCls:focus {
        outline: none !important;
        -moz-outline: none !important;
        -ms-outline: none !important;
        -o-outline: none !important;
        -webkit-outline: none !important;
    }
    .searchListing {
        width:83%;
        padding:10px;
        border:3px solid #bb8a20;
    }
</style>
<section class="section-padding">
    <div class="container">
        <h1 class="mb10 border-bottom"><b>Search result for "{{$searchKey}}" </b>
            @if($session_payType == 'lead')
                <a href="{{url('activate-now')}}" class="btn btnCls floatright" style="margin-top:-15px;padding:10px;"> << Go Back</a>
            @elseif($session_payType == 'freelisting')
                <a href="{{url('join-now')}}" class="btn btnCls floatright" style="margin-top:-15px;padding:10px;"> << Go Back</a>
            @else
                <a href="{{url('new-vendor')}}" class="btn btnCls floatright" style="margin-top:-15px;padding:10px;"> << Go Back</a>
            @endif
        </h1>
        <form action="#" class="mt10 mb10" style="display:inline-block;width:100%;">
            <input type="text" id="search_listing" class="searchListing" placeholder="Your business name" autocomplete="off">&nbsp;
            <button type="button" onclick="get_search_listing();" class="btn btnCls">Search Your Listing</button>
        </form>
        <div class="col-xs-12 col-sm-9 no-margin wide sidebar">
            <section id="gaming">
                <div class="grid-list-products">
                    <div class="tab-content">
                        <div id="list-view" class="products-grid fade tab-pane active in">
                            <div class="products-list">
                                @if(count($searchData) > 0)
                                    <?php $catImages = 0; $catDesc = -1; ?>
                                    @foreach($searchData as $list)
                                    <div class="product-item product-item-holder">
                                        <div class="row">
                                            <div class="no-margin col-xs-12 col-sm-12 col-md-5 image-holder">
                                                <div class="vandor-gallery">
                                                    @if(isset($list->image_data) && !empty($list->image_data) && (count($list->image_data) > 0))
                                                        @foreach($list->image_data as $img)
                                                        <div class="image-gallery">
                                                            <div class="image">
                                                            @if(file_exists(public_path().'/vendors/'.$img['vendor_folder'].'/'.$img['image']))
                                                                <img style="width:300px;height:189px;" src="{{asset('public/vendors/'.$img['vendor_folder'].'/'.$img['image'])}}">
                                                            @else
                                                                <img style="width:300px;height:189px;" src="{{asset('public/vendors/no-photo.jpg')}}">
                                                            @endif
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                    @else
                                                    <div class="image-gallery">
                                                        <div class="image">
                                                        @if(count($list->category_images))
                                                            @foreach($list->category_images as $num => $cti)
                                                                @if($num == $catImages)
                                                                <img src="{{asset('public/images/category_images/'.$cti->images)}}" style="width:300px;height:189px;">
                                                                <?php $catImages++;
                                                                    if($catImages == 5) { $catImages = 0; }
                                                                    $catDesc++;
                                                                    if($catDesc == 5) { $catDesc = 0; }
                                                                    break;
                                                                ?>
                                                                @endif
                                                            @endforeach
                                                        @else
                                                            <img style="width:300px;height:189px;" src="{{asset('public/vendors/no-photo.jpg')}}">
                                                        @endif
                                                        </div>
                                                    </div><!-- Image Gallery -->
                                                    @endif
                                                </div><!-- Vandor Gallery -->
                                            </div><!-- /.image-holder -->
                                            <div class="no-margin col-xs-12 col-md-7 col-sm-12 body-holder">
                                                <div class="body">
                                                    <div class="pull-left">
                                                        <div class="title">
                                                            <a href="{{url($list->parent_slug.'/'.$list->slug)}}/{{$list->business_name_slug}}">{{$list->business_name}}</a>
                                                        </div>
                                                        <div class="brand">
                                                            <div class="inline">{{$list->title}}, {{$list->address.', '.$list->province.' - '.$list->postal_code}}</div>
                                                        </div>
                                                    </div>
                                                    <div class="clear"></div>
                                                    <div class="excerpt">
                                                        @if(@$list->business_detail)
                                                            <p>{!!strip_tags(substr($list->business_detail,0,200))!!}...(<a href="{{url($list->parent_slug.'/'.$list->slug)}}/{{$list->business_name_slug}}">read more</a>)</p>
                                                        @else
                                                        @foreach($list->category_images as $num => $cti)
                                                            @if($num == $catDesc)
                                                                <p>{!!strip_tags(substr($cti->description,0,200))!!}...(<a href="{{url($list->parent_slug.'/'.$list->slug)}}/{{$list->business_name_slug}}">read more</a>)</p>
                                                            @endif
                                                        @endforeach
                                                        @endif
                                                    </div>
                                                    @if($session_vendorId)
                                                        <a href="{{url('payment-packages')}}" class="btn btnCls floatright">Upgrade Your Account</a>
                                                    @else
                                                        <a href="{{url('register')}}?vendorId={{$list->vendor_id}}" class="btn btnCls floatright">Claim Your Listing</a>
                                                    @endif
                                                </div>
                                            </div><!-- /.body-holder --><!-- /.price-area -->
                                        </div><!-- /.row -->
                                    </div><!-- /.product-item -->
                                    @endforeach
                                    @if($searchData->total() > 10)
                                    <div class="pagination-holder">
                                        <div class="row">
                                            @if(isset($searchData) && !empty($searchData))
                                            <div class="col-xs-12 col-sm-9 text-left">
                                                {{ $searchData->links() }}
                                            </div>
                                            <div class="col-xs-12 col-sm-3 mt25">
                                                <div class="result-counter">
                                                    Showing <span>{{$searchData->currentPage()}} - {{$searchData->lastPage()}}</span> of <span>{{$searchData->total()}}</span> results
                                                </div><!-- /.result-counter -->
                                            </div>
                                            @endif
                                        </div><!-- /.row -->
                                    </div><!-- /.pagination-holder -->
                                    @endif
                                @else
                                    <div class="incorrect_info alert alert-error mb20">
                                        <p class='incorrect_info_p text-center'>No Record Found !!</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</section>
@include('includes.footer')
<script>
    function get_search_listing() {
        var searchKey = $('#search_listing').val();
        if(searchKey) {
            window.location.href = "{{url('get-search-listing')}}/"+searchKey;
        }
    }
</script>
@endsection