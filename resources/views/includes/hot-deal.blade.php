@if(isset($pageData['hot_deals']) && !empty($pageData['hot_deals']))
<section id="blog-section" class="section-padding">
    <div class="container text-center">
        <div class="row">
            <div class="col-md-12">
                <div class="common-header text-center">
                    <h2>@lang('frontend.hot_deals_area')</h2>
                    <img src="{{url('public/images/agency-divider1.png')}}" alt="header image" />
                </div>
            </div>
        </div>
        <div class="row all-blog-cont">
            @foreach($pageData['hot_deals'] as $hots)
            <div class="col-md-3 col-lg-3 col-xs-12 col-sm-6">
                <div class="blog-all-cont">
                  <a href="{{url($hots->full_slug)}}/{{$hots->business_name_slug}}">
                    @if(file_exists( public_path().'/vendors/VENDOR_'.$hots->vendor_id.'/'.$hots->image))
                        <img class="img-responsive" src="{{asset('public/vendors/VENDOR_'.$hots->vendor_id.'/'.$hots->image)}}" alt="" style="min-height:200px;max-height:200px;">
                    @elseif(file_exists( public_path('/images/category_images').'/'.$hots->cat_image))
                        <img class="img-responsive" src="{{asset('public/images/category_images/'.$hots->cat_image)}}" alt="" style="min-height:200px;max-height:200px;">
                    @else
                        <img class="img-responsive" src="{{asset('public/vendors/no-photo.jpg')}}" alt="{{$hots->business_name}}" style="min-height:200px;max-height:200px;">
                    @endif
                  </a>
                    <a class="blog-wedding" href="{{url($hots->full_slug)}}/{{$hots->business_name_slug}}">-{{$hots->promotion_amount}}%</a>
                    <div class="hot-deals-text">
                        <span class="offer-text">Exclusive Discount</span>
                        <h3><a href="{{url($hots->full_slug)}}/{{$hots->business_name_slug}}">{{$hots->promotion_amount}}% discount for Perfect Wedding Day couples</a></h3>
                        <p class="hot-text-col"><span>{{$hots->business_name}}</span>{{$hots->city}},    {{$hots->province}}</p>
                    </div>
                </div>
            </div>
            @endforeach
            <div class="col-lg-12 col-md-12 col-sm-12 blog-btn hide">
                <a href="{{url('hot-deals')}}">View all</a>
            </div>
        </div>
    </div>
</section><!-- Hot Deals Section -->
@endif