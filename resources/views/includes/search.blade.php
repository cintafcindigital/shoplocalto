@include('includes.alert_popup')
<div class="slider-cont">
   @if(!empty($pageData['search_category']))
      <h3><strong>{{ucwords($pageData['search_category'])}}</strong></h3>
   @endif
   {!! $pageData['image_description'] !!}
   <h3 style="line-height: 28px;font-size: 22px;">Let the teamwork of <strong>My Health Squad</strong> guided you to reach your optimal health.</h3>
   <div class="form-wrapper">
      <form class="qc_home-search" style="position:relative;display:block;" method="GET" action="/search" id="searchForm">
           <div class="form-field pull-left" style="width:100%; padding-right: 50px;">
            <input id="search" name="search" autocomplete="off" type="text" size="60" aria-label="Search for" placeholder="Search for">
           </div>
           <div class="form-field field-button" style="position:absolute;right:0px;top:0px;z-index:10;">
            <button type="submit" class="btn btn-search" style="height: 50px;width: 100%;line-height: 50px;text-align: center;padding: 0px 20px;color: #FFF;vertical-align: middle;align-content: normal;margin-left: 13%;margin-bottom: 15%;"><i class="fa fa-search" style="font-size: 22px;"></i>&nbsp;</button>
           </div>
           <div id="search-results" style="display:none;">
               <ul id="result-entries" style="background: #FFF">
                 
               </ul>
           </div>
           
       </form>
      <!-- <form class="qc_home-search" style="display:inline-flex; width: 100%;">
         <div class="form-field pull-left">
            <input id="cat_slug" name="cat_slug" autocomplete="off" type="text" value="@php if(isset($pageData['search_cat_slug'])){ echo ucfirst(str_replace('-',' ',$pageData['search_cat_slug'])); } @endphp" class="form-control bs-select-hidden handler-cat_slug" size="30" aria-label="Search for" placeholder="Search for" style="font-size:21px;font-weight:bold;">
         </div>
         <div class="form-field pull-left">
            <input id="location" name="location" autocomplete="off" type="text" value="@php if(isset($pageData['search_location'])){ echo ucfirst($pageData['search_location']); } @endphp" class="form-control bs-select-hidden handler-location" size="30" aria-label="Where" placeholder="Where" style="font-size:21px;font-weight:bold;">
         </div>
         <div class="form-field field-button pull-left">
            <button type="button" onclick="Frontend.SearchForm()" class="btn btn-search" style="height:62px;"><i class="fa fa-search" style="font-size: 22px;"></i></button>
         </div>
      </form> -->
      <div class="clear"></div>
      @if(isset($pageData['search_cat_slug']) && ($pageData['search_cat_slug'] == 'mental-health' || $pageData['search_cat_slug'] == 'physical-health'))
      <p class="homeSlider__boxLinks">
            <!-- php 
               $key_count = 0;
            endphp
            foreach($sub_category as $key => $cats)
             $key == (count($sub_category)-1)?'':','
            endforeach -->
            <a class="homeSlider__boxLinksItem" data-group="banquetes" href="{{ url('/search?search=') }}massotherapy">Massotherapy</a>,
            <a class="homeSlider__boxLinksItem" data-group="banquetes" href="{{ url('/search?search=') }}psychology-mental-health-services">Psychology & Mental health services</a>,
            <a class="homeSlider__boxLinksItem" data-group="banquetes" href="{{ url('/search?search=') }}chiropractic">Chiropractic</a>,
            <a class="homeSlider__boxLinksItem" data-group="banquetes" href="{{ url('/search?search=') }}yoga">Yoga</a>,
            <a class="homeSlider__boxLinksItem" data-group="banquetes" href="{{ url('/search?search=') }}personal-fitness">Personal fitness</a>,
            <a class="homeSlider__boxLinksItem" data-group="banquetes" href="{{ url('/search?search=') }}acupuncture">Acupuncture</a>,
            <a class="homeSlider__boxLinksItem" data-group="banquetes" href="{{ url('/search?search=') }}family-therapy">Family therapy</a>,
            <a class="homeSlider__boxLinksItem" data-group="banquetes" href="{{ url('/search?search=') }}physiotherapy">Physiotherapy</a>
            <!-- <a class="homeSlider__boxLinksItem" href="{{ url('/') }}/wedding-vendors/wedding-photography">Wedding Photography</a>,             
            <a class="homeSlider__boxLinksItem" href="{{ url('/') }}/wedding-vendors/wedding-music">Wedding Music</a>,             

            <a class="homeSlider__boxLinksItem"  href="{{ url('/') }}/wedding-vendors/wedding-transportation">Wedding Transportation</a>,
            <a class="homeSlider__boxLinksItem" href="{{ url('/') }}/wedding-vendors/wedding-invitations">Wedding Invitations</a>,
            <a class="homeSlider__boxLinksItem"  href="{{ url('/') }}/wedding-dress">Wedding Dresses</a>,             
            <a class="homeSlider__boxLinksItem"  href="{{ url('/') }}/wedding-vendors/wedding-flowers">Wedding Flowers</a>            -->
         </p>
        @else
        @endif
   </div>
</div>
<!-- Dropdown for Wedding Types -->
<div class="SelectorOptions droplayer droplayer-extralarge multi-column" id="layer-suggest-2" style="position:absolute;top:331px;left:177px;display:none;z-index:999;">
   <div class="droplayer-column">
   @if(isset($pageData['categories']) && !empty($pageData['categories']))
      @foreach($pageData['categories'] as $num => $cat)
         @if($cat['id'] != 39)
            @php
               $selctd1 = '';
               if(@$pageData['search_cat_slug'] == $cat['slug']){ $selctd1 = 'selected'; }
            @endphp
         <ul class="mb15 searchDataClassWed suggest-group sgroup-{{$num+1}}" data-id="{{$num+1}}">
            <li class="app-suggest-link setGrupo selectWedTitls {{$selctd1}}" data-id="{{$num+1}}" data-value="{{$cat['slug']}}">
               <a href="javascript:;" class="setGrupo selectWedVals {{$selctd1}}" data-titles="{{$cat['title']}}" data-value="{{$cat['slug']}}" style="font-size:16px;">{{$cat['title']}}</a><!-- <span style="font-size:15px;">2,386</span> -->
            </li>
            @if(isset($cat['child']))
            @foreach($cat['child'] as $cat1)
               @php
                  $selctd2 = '';
                  if(@$pageData['search_cat_slug'] == $cat1['slug']){ $selctd2 = 'selected'; }
               @endphp
               <li class="app-suggest-link setSector selectWedTitls {{$selctd2}}" data-value="{{$cat1['slug']}}">
                  <a href="javascript:;" class="setSector selectWedVals {{$selctd2}}" data-titles="{{$cat1['title']}}" data-value="{{$cat1['slug']}}" style="font-size:14px;">{{$cat1['title']}}</a><!-- <span style="font-size:13px;">25</span> -->
               </li>
            @endforeach
            @endif
         </ul>
         @endif
         @if($cat['title'] == 'Wedding Venues' || $cat['title'] == 'Wedding Vendors')</div><div class="droplayer-column">@endif
      @endforeach
   @endif
   </div>
</div>
<!-- Dropdown for Locations -->
<div class="SelectorOptions droplayer droplayer-extralarge multi-column" id="layer-suggest-1" style="position:absolute;top:331px;left:615px;display:none;z-index:999;width:28%">
   <div class="box-scroll column-container" data-format="ncol">
      @php 
         $colunCount = count($stateSearchRegions) / 2;
      @endphp
      @if(isset($stateSearchRegions) && !empty($stateSearchRegions))
         <div class="droplayer-column">
            <ul>
               <ul class="searchDataClass">
                  @php $i = 0; @endphp
                  @foreach($stateSearchRegions as $key => $locdata)
                     @php
                        $selctd3 = '';
                        if(@$pageData['search_location'] == str_slug($key,'-')){ $selctd3 = 'selected'; }
                     @endphp
                     <li class="app-suggest-link principal setProvincia selectLocTitls {{$selctd3}}" data-value="{{str_slug($key,'-')}}">
                        <a href="javascript:;" class="setProvincia gris selectLocVals {{$selctd3}}" data-titles="{{$key}}" data-value="{{str_slug($key,'-')}}" style="font-size:16px;">{{$key}}</a><!-- <span style="font-size:15px;">2,118</span> -->
                     </li>
                     @foreach($locdata as $loc)
                        @php
                           $selctd4 = '';
                           if(@$pageData['search_location'] == str_slug($loc['region'],'-')){ $selctd4 = 'selected'; }
                        @endphp
                        <li class="app-suggest-link setPoblacion {{$selctd4}}" data-value="{{str_slug($loc['region'],'-')}}">
                           <a href="javascript:;" class="setProvincia gris selectLocVals {{$selctd4}}" data-titles="{{$loc['region']}}" data-value="{{str_slug($loc['region'],'-')}}" style="font-size:16px;">{{$loc['region']}}</a><!-- <span style="font-size:15px;">2,118</span> -->
                        </li>
                     @endforeach
                     @if($i == $colunCount)
                        </ul></ul></div>
                        <div class="droplayer-column"><ul><ul class="searchDataClass">
                     @endif
                     @php $i++; @endphp
                  @endforeach
               </ul>
            </ul>
         </div>
      @endif
   </div>
</div>
<script>
$(document).ready(function()
{
   ////// For Wedding Types......
   $('body').on('click', '#cat_slug', function() {
      $('#layer-suggest-1').css('display','none');
      $('#layer-suggest-2').css('display','block');
   });
   $('body').on('click', '.selectWedVals', function() {
      $('.selectWedVals').removeClass('selected');
      $('.selectWedTitls').removeClass('selected');
      var titls = $(this).data('titles');
      $('#cat_slug').val(titls);
      $(this).addClass('selected');
      $(this).parents().addClass('selected');
   });
   ////// For Locations......
   $('body').on('click', '#location', function() {
      $('#layer-suggest-1').css('display','block');
      $('#layer-suggest-2').css('display','none');
   });
   $('body').on('click', '.selectLocVals', function() {
      $('.selectLocVals').removeClass('selected');
      $('.selectLocTitls').removeClass('selected');
      var titls = $(this).data('titles');
      $('#location').val(titls);
      $(this).addClass('selected');
      $(this).parents().addClass('selected');
   });
   ////// Search filters......
   $("#cat_slug").keyup(function() {
      var filter = $(this).val();
      $("ul.searchDataClassWed li").each(function() {
         if($(this).text().search(new RegExp(filter, "i")) < 0) {
            $(this).fadeOut();
         } else {
            $(this).show();
         }
      });
   });
   $("#location").keyup(function() {
      var filter = $(this).val();
      $("ul.searchDataClass li").each(function() {
         if($(this).text().search(new RegExp(filter, "i")) < 0) {
            $(this).fadeOut();
         } else {
            $(this).show();
         }
      });
   });
   $('body').on('click','#slider-seciton, #weddy-services, #about-section', function(e) {
      if($(e.target).attr('class') == 'form-control bs-select-hidden handler-cat_slug') {
         $('#layer-suggest-1').css('display','none');
         $('#layer-suggest-2').css('display','block');
      } else if($(e.target).attr('class') == 'form-control bs-select-hidden handler-location') {
         $('#layer-suggest-1').css('display','block');
         $('#layer-suggest-2').css('display','none');
      } else {
         $('#layer-suggest-1').css('display','none');
         $('#layer-suggest-2').css('display','none');
      }
   });
});
</script>