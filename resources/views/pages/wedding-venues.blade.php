@extends('layouts.default')
@section('meta_title',$pageData->meta_title)
@section('meta_keyword',$pageData->meta_keyword)
@section('meta_description',$pageData->meta_description)
@section('content')
@include('includes.menu')

<style>
.qc_heart.right_corner {
   float: right;
   margin: 8px 8px 0px 0px;
}
.directory-img-item__wrapper {
   padding: 15px 10px;
}
.owl-theme .owl-controls{
    display:none !important;
}
</style>
@include('includes.inner-slider')
<!-- ABOUT SECTION START-->
<section id="about-section" class="section-padding">
   <div class="container">
      <div id="app-vendors-directory-navigation" class="directory-results-bar">
         <div class="wrapper">
            <div class="pure-g">
               <div class="pure-u-4-6">
                  <div class="directory-filtered">
                     <span class="directory-results-bar-results">{{!empty($vendorLists)?$vendorLists->total():0}} results:</span>
                     <ul class="directory-search-tags">
                         @if(!empty($pageData['search_category']))
                        <li class="app-directory-filters-change tag-box">
                           <span>{{$pageData['search_category']}}</span>
                           <i class="fa fa-close search-main-category-close" style="color: #ddd;"></i>
                           
                        </li>
                        @endif
                       
                        @if(isset($_GET['location']))
                           <li class="app-directory-filters-change tag-box">
                              <span>{{$_GET['location']}}</span>
                              <i class="fa fa-close province_close" style="color: #ddd;"></i>
                              
                           </li>
                        @endif
                        
                        <li class="app-directory-filters-change" data-filters-maintain="none">
                           <span class="tag-box-clear">Clear all</span>
                        </li>
                     </ul>
                  </div>
               </div>
               <div class="pure-u-2-6 text-right">
                  <div id="vendors-list-view">
                     <ul class="directory-view-mode">
                        <li class="app-directory-filters-change-mode list_tab">
                           <span class="directory-list-mode active" title="Show list on map">
                              <i class="svgIcon svgIcon__list vendors-list-view-icon">
                                 <svg viewBox="0 0 32 18">
                                    <path d="M.985 2V0h30.032v2H.985zm0 8V8h30.032v2H.985zm0 8v-2H25.02v2H.985z" fill-rule="nonzero"></path>
                                 </svg>
                              </i> List
                           </span>
                        </li>
                        <li class="app-directory-filters-change-mode image_tab hidden-xs hidden-md">
                           <span class="directory-imagetag-filters-mode " title="Show grid with photo">
                              <i class="svgIcon svgIcon__squares vendors-list-view-icon">
                                 <svg viewBox="0 0 32 32">
                                    <path d="M2 20v10h10V20H2zm12-2v14H0V18h14zm6-16v10h10V2H20zm12-2v14H18V0h14zM2 2v10h10V2H2zm12-2v14H0V0h14zm6 20v10h10V20H20zm12-2v14H18V18h14z" fill-rule="nonzero"></path>
                                 </svg>
                              </i> Images
                           </span>
                        </li>
                        
                     </ul>
                  </div>
               </div>
            </div>
         </div>
      </div>
      @include('includes.sidebar')
      <!-- ========================================= CONTENT ========================================= -->
      <div class="col-xs-12 col-sm-9 no-margin wide sidebar">
         <section id="gaming">
            <div class="grid-list-products">
              
               <div class="tab-content">
                  <div id="list-view" class="products-grid fade tab-pane  active in">
                     <div class="products-list">
                        @if(isset($vendorLists) && !empty($vendorLists))
                           <?php $catImages = 0; $catDesc = -1; ?>
                           @foreach($vendorLists as $list)
                              <div class="product-item product-item-holder">
                                 <div class="row">
                                    <div class="no-margin col-xs-12 col-sm-12 col-md-5 image-holder">
                                       <div class="vandor-gallery">
                                           @if(!empty($list->profile))
                                              <img class="filter-search-image img-responsive" src="{{asset('public/vendors/VENDOR_'.$list->vendor_id.'/'.$list->profile)}}">
                                          @elseif(isset($list->image_data) && !empty($list->image_data) && (count($list->image_data) > 0))
                                             @foreach($list->image_data as $img)
                                                <div class="image-gallery">
                                                  
                                                   <div class="image" style="text-align: center;">
                                                      
                                                      @if(file_exists(public_path().'/vendors/'.$img['vendor_folder'].'/'.$img['image']))
                                                         <img class="filter-search-image img-responsive" src="{{asset('public/cimg/webroot/img.php?src=vendors/'.$img['vendor_folder'].'/'.$img['image'])}}">
                                                        
                                                        @php //break; @endphp
                                                      @else
                                                         <img class="filter-search-image img-responsive" src="{{asset('public/cimg/webroot/img.php?src=vendors/no-photo.jpg')}}">
                                                      @endif
                                                   </div>
                                                </div>
                                             @endforeach
                                          @else
                                             <div class="image-gallery">
                                                
                                                <div class="image" style="text-align: center;">
                                                   
                                                   <img class="filter-search-image img-responsive" src="{{asset('public/cimg/webroot/img.php?src=vendors/no-profile.jpg')}}"> 
                                                </div>
                                             </div><!-- Image Gallery -->
                                          @endif
                                       </div><!-- Vandor Gallery -->
                                    </div><!-- /.image-holder -->
                                    <div class="no-margin col-xs-12 col-md-7 col-sm-12 body-holder">
                                       <div class="body">
                                          <div class="product-head">
                                             <div class="title">
                                                <a href="{{url('vendor')}}/{{$list['company_data']['business_name_slug']}}">{{$list['business_name']}}</a>
                                             </div>
                                             <div class="brand">
                                                @if($list->freelisting == 'No')
                                                   
                                                   <div class="inline product-head-content"> {{$list['company_data']['address'].', '.$list['company_data']['province'].' - '.$list['company_data']['postal_code']}}</div>
                                                @else
                                                   <div class="inline product-head-content"> {{$list['company_data']['city']}} ({{$list['company_data']['province']}})</div>
                                                @endif
                                             </div>
                                          </div>
                                          <div class="pull-right">
                                             
                                             @if($list->freelisting == 'No')
                                                <div class="qc_heart">
                                                   @php
                                                      $randId = rand();
                                                      $hide1 = $hide2 = 'display:none;';
                                                      if(in_array($list['company_data']['id'],$wishLists)):
                                                         $hide1 = '';
                                                      else:
                                                         $hide2 = '';
                                                      endif;
                                                   @endphp
                                                   
                                                </div>
                                             @endif
                                          </div>
                                          <div class="clear"></div>
                                          <div class="excerpt">
                                            
                                               
                                                      <p>{!!strlen(@$list->business_description) <= 200 ? strip_tags(@$list->business_description) : strip_tags(substr(@$list->business_description,0,200)).'...'!!}&nbsp;&nbsp;&nbsp;(<a href="{{url('vendor')}}/{{$list['company_data']['business_name_slug']}}">read more</a>)</p>
                                                  
                                             
                                          </div>
                                          <div class="addto-compare">
                                              @if($list['rating_data_count'] >= 25 && $list['rating_data_count'] < 50)
                                            <div class="award award--center award--large award--rounded award--silver award--grey" style="height: 75px;">
                    	                    </div>
                    	                    @endif
                    	                    @if($list['rating_data_count'] >= 50 && $list['rating_data_count'] < 100)
                                            <div class="award award--center award--large award--rounded award--gold award--grey" style="height: 75px;">
                    	                    </div>
                    	                    @endif
                    	                    @if($list['rating_data_count'] >= 100)
                                            <div class="award award--center award--large award--rounded award--platinum award--grey" style="height: 75px;">
                    	                    </div>
                    	                    @endif
                                             <a class="readmore-btn pull-right" onclick="Frontend.setRequestForm({{$list['company_data']['id']}})" href="#" data-toggle="modal" data-target="#myModal">Request info</a>
                                          </div>
                                       </div>
                                    </div><!-- /.body-holder --><!-- /.price-area -->
                                 </div><!-- /.row -->
                              </div><!-- /.product-item -->
                           @endforeach
                        @else
                           <p class="text-center">No Records Found !!</p>
                        @endif
                        @if(!isset($list->profile))
                            <!--<p class="text-center">No Records Found !! not 1</p>-->
                        @endif
                     </div><!-- /.products-list -->
                     <div class="directory-list-images pure-g-r row image_view" style="display:none;">
                        @if(isset($vendorLists) && !empty($vendorLists))
                           <?php $catImages2 = 0; $catDesc2 = -1; ?>
                           @foreach($vendorLists as $list)
                              <div class="pure-u-1-3 app-ec-item app-vendors-item app-vpromo appVendorGalleryMedium_46 gtm-snowplow-tracking-impression">
                                 <div class="directory-img-item directory-img-item--box">
                                    <div class="vendor-slider">
                                       <div class="app-vendors-sliderMedium"></div>
                                       <div class="vendor-slider-content img-zoom">
                                          @if(!empty($list->profile))
                                              <img class="filter-search-image img-responsive" src="{{asset('public/vendors/VENDOR_'.$list->vendor_id.'/'.$list->profile)}}">
                                          @elseif(isset($list->image_data) && !empty($list->image_data) && (count($list->image_data) > 0))
                                             @foreach($list->image_data as $img)
                                                @if(file_exists( public_path().'/vendors/'.$img['vendor_folder'].'/'.$img['image']))
                                                   <img class="filter-search-image img-responsive" src="{{asset('public/vendors/'.$img['vendor_folder'].'/'.$img['image'])}}">
                                                    @php //break; @endphp
                                                @else
                                                   <img class="filter-search-image img-responsive" src="{{asset('public/vendors/no-profile.jpg')}}">
                                                @endif
                                             @endforeach
                                          @else
                                             
                                             <img src="{{asset('public/vendors/no-profile.jpg')}}" class="filter-search-image img-responsive">
                                          @endif
                                       </div>
                                      
                                    </div>
                                    <div class="directory-img-item__wrapper">
                                       <div class="directory-img-item__content">
                                          <div class="directory-img-item-top">
                                             <a class="directory-img-item-name app_lnkEsc_2407" href="{{url('vendor')}}/{{$list['business_name_slug']}}">{{$list['business_name']}}</a>
                                             <div class="directory-img-item-location">
                                                @if($list->freelisting == 'No')
                                                   
                                                @else
                                                   <span>{{isset($list['category_data']['title'])?$list['category_data']['title'].',':''}}<br/> {{$list['company_data']['address'].', '.$list['company_data']['province'].' - '.$list['company_data']['postal_code']}}</span>
                                                @endif
                                             </div>
                                          </div>
                                          <div class="excerpt">
                                                {!!strip_tags(substr($list['business_description'],0,100),'<br>')!!}...(<a href="{{url('vendor')}}/{{$list['company_data']['business_name_slug']}}">read more</a>)
                                          </div>
                                       </div>
                                       <div class="app-vendors-item-solicitar listItem__button">
                                          <a class="btnFlat btnFlat--primary btnFlat--full app-ua-track-event" onclick="Frontend.setRequestForm({{$list['company_data']['id']}})" href="#" data-toggle="modal" data-target="#myModal">Request info</a>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           @endforeach
                        @else
                            <p class="text-center" style="width: 100%;letter-spacing: 0;">No Records Found !!</p>
                        @endif
                        @if(!isset($list->profile))
                            <!--<p class="text-center" style="width: 100%;letter-spacing: 0;">No Records Found !! not 2</p>-->
                        @endif
                     </div><!-- product-image  -->
                     <!-- Modal -->
                     @include('includes.login_popup')
                     @include('includes.request_popup')
                     @if(!empty($vendorLists) && $vendorLists->total() > 10)
                     <div class="pagination-holder">
                        <div class="row">
                           @if(isset($vendorLists) && !empty($vendorLists))
                              <div class="col-xs-12 col-sm-9 text-left">
                                 {{ $vendorLists->links() }}
                                 
                              </div>
                              <div class="col-xs-12 col-sm-3">
                                 <div class="result-counter">
                                    Showing <span>{{ $vendorLists->currentPage() }}-{{ $vendorLists->lastPage() }}</span> of <span>{{ $vendorLists->total() }}</span> results
                                 </div><!-- /.result-counter -->
                              </div>
                           @endif
                        </div><!-- /.row -->
                     </div><!-- /.pagination-holder -->
                     @endif
                  </div><!-- /.products-grid #list-view -->
               </div><!-- /.tab-content -->
            </div><!-- /.grid-list-products -->
         </section><!-- /#gaming -->
      </div><!-- /.col -->
      <!-- ========================================= CONTENT : END ========================================= -->
   </div>
</section>
<?php /* @include('includes.hot-deal') */ ?>
<!-- / END SUBSCRIBE SECTION-->
@include('includes.footer')
<script>
$(document).ready(function() {
   $('body').on('click', '.tag-box-clear', function() {
    //   window.location.href = "{!!url('search?'.(isset($_GET['search']) ? 'search='.$_GET['search']:''))!!}";
      window.location.href = "{!! url('search') !!}";
   });
   $('body').on('click', '.province_close', function() {
      window.location.href = "{!!url('search?'.(isset($_GET['search']) ? 'search='.$_GET['search']:'').(isset($_GET['category'])?'&category='.$_GET['category']:''))!!}";
   });
   $('body').on('click', '.search-main-category-close', function() {
      window.location.href = "{!!url('search?'.(isset($_GET['search']) ? 'search='.$_GET['search']:'').(isset($_GET['location'])?'&location='.$_GET['location']:('')))!!}";
   });
   $('body').on('click', '.region_close', function() {
      window.location.href = "{!!url('search?'.(isset($_GET['search']) ? 'search='.$_GET['search']:'').(isset($_GET['category'])?'&category='.$_GET['category']:''))!!}";
   });
   $('body').on('click', '.list_tab', function() {
      $('.image_view').hide();
      $('.products-list').show();
      $('.directory-list-mode').addClass('active');
      $('.directory-imagetag-filters-mode').removeClass('active');
   });
   $('body').on('click', '.image_tab', function() {
      $('.image_view').show();
      $('.products-list').hide();
      $('.directory-list-mode').removeClass('active');
      $('.directory-imagetag-filters-mode').addClass('active');
   });
});
</script>
@endsection