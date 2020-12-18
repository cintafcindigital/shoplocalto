@extends('layouts.default')
@section('meta_title',$data['titleData']->meta_title)
@section('meta_keyword',$data['titleData']->meta_keyword)
@section('meta_description',$data['titleData']->meta_description)
@section('content')
@include('includes.menu')
  <section class="section-padding dashboard-wrap">
      @include('tools.tools_nav');   
            <div class="wrapper">
    <div class="pure-g">
        <div class="pure-u-1-5">
            <p class="tools-subtitle pt10">Catalogue</p>
            <div class="mr45 tools-filters-dresses">
                <ul class="tools-filters app-tools-filters pt10">
		    <li class="tools-filters-item app-link current" data-href="/tools/DressList?tipo=0" data-idcateg="0">
		       <!--  <i class="tools-filters-item-icon icon-tools icon-tools-dress-filter-0"></i> -->
		        <span class="tools-filters-item-name">All</span>
		        @if(isset($data['dresses']))
		        <span class="tools-filters-item-count app-num-dress">{{count($data['dresses'])}}</span>
		        @endif
		    </li>
            <li class="tools-filters-item app-link " data-href="/tools/DressList?tipo=1" data-idcateg="1">
           <!--  <i class="tools-filters-item-icon icon-tools icon-tools-dress-filter-1"></i> -->
            <span class="tools-filters-item-name">Dresses</span>
            @if(isset($data['dresses']))
            <span class="tools-filters-item-count app-num-dress">{{count($data['dresses'])}}</span>
            @endif
        </li>
    </ul>
            </div>
        </div>
        <div class="pure-u-4-5">
            <div class="pure-g">
                <div class="pure-u-1-2">
                    <h1 class="tools-title tools-title-inline">My Dresses</h1>
                </div>
                <div class="pure-u-1-2 text-right">
                    <a class="btn-flat red mb10 pull-right" href="{{url('wedding-dress')}}">Go to catalogue</a>
                    <!-- <a class="btn-flat red mb10" href="/wedding-dress">Go to catalogue</a> -->
                </div>
            </div>
            <hr class="mb30">
            <div class="app-dresses-container">
					        <div class="pure-g-r dresses-list app-dresses-list">
					         @if(isset($data['dresses']) && !empty($data['dresses']))
					           @foreach($data['dresses'] as $dars)
					            <div class="pure-u-1-4 dresses-list-item app-tools-dress-item">
				                   <!--  <div class="dresses-list-item-fav app-tools-dresses-save btn-fav on" data-id="43311" data-tipo="1">
				                    </div> -->
				                     <div class="dresses-list-item-fav app-tools-dresses-save">
                                @php
                                  $randId = rand();
                                  $hide1 = $hide2 = 'display:none;';                                                             
                                if(in_array($dars['company_data']['id'],$wishLists)):
                                   $hide1 = '';
                                else:
                                   $hide2 = '';
                                endif;
                                @endphp
                                <div onclick="Frontend.removeWishList({{$dars['company_data']['id']}},{{$randId}})" id="remove_{{$randId}}" style="{{$hide1}}" class="btn-fav on animation" data-id="42218" data-z="2"></div>
                                <div onclick="Frontend.checkLogin({{$dars['company_data']['id']}},{{$randId}})" id="add_{{$randId}}" style="{{$hide2}}" class="btn-fav" data-id="42218" data-z="2"></div>
                              </div>

				                    <div class="dresses-list-content app-show-fav-dress" id="app-dress-43311" data-id="43311" data-tipo="1" data-idx="1">
				                        <figure class="mb20">
				                            <img class="dresses-list-content-img" alt="08-3747-LN, Lilly" src="{{URL::asset('public/vendors')}}/{{$dars['image_data'][0]['vendor_folder']}}/{{$dars['image_data'][0]['image']}}">
				                        </figure>
				                                                <p class="dresses-list-content-title">{{$dars['company_data']['business_name']}}</p>
				                        <p class="dresses-list-content-subtitle">{{$dars['company_data']['city']}}</p>
				                    </div>
					            </div> 
					            @endforeach
                            @endif


					        </div>
					    
						<p class="text-center mt20 mb20">
						<!-- <a data-track-c="RelatedContentTracking" data-track-a="a-click" data-track-l="d-desktop+s-related_content+o-tools_dresslist+dt-vendors_list" data-track-v="0" data-track-ni="0" class="btn-outline outline-red tools-more-link app-ua-track-event" onclick="setZOrigen(59);return true" rel="nofollow" href="https://www.weddingwire.ca/brides">
						View more        </a> -->
						</p>            
		          </div>
		        </div>
		    </div>
    </div>
			
</section>
  @include('includes.request_popup')
  @include('includes.search_vendor_popup')
  @include('includes.error_popup')
  @include('includes.footer')
@endsection       
