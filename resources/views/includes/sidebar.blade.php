<?php /***<!-- ========================================= SIDEBAR ========================================= -->
<div class="col-xs-12 col-sm-3 no-margin sidebar narrow">
    <!-- ========================================= PRODUCT FILTER ========================================= -->
    <div class="widget">
        <div class="body bordered">
            <div class="category-filter">
                <h3>LOCATION</h3><hr>
                <ul>
                    @php $count = array();
                    $current_loc = "";
                    $uri =  Request::segment(2)??Request::segment(1);
                    $url =  'search/'.$uri;
                    @endphp
                    @if(isset($locationData) && !empty($locationData))
                    @php $count = array_column((array)$locationData,'location_count') @endphp
                    @endif
                        <li class="active"> <label><a href="#"> ALL Provinces</a></label> <span class="pull-right">(@php echo array_sum($count); @endphp)</span></li>
                    @if(isset($locationData) && !empty($locationData))
                    @php $current_loc = Request::segment(3); @endphp
                    @foreach($locationData as $locV)
                    @php $class = "";  @endphp
                    @if($current_loc == str_slug($locV->province,'-'))
                    @php $class = "active_loc";  @endphp
                    @endif
                        <li class="{{$class}}"><label><a href="{{url($url)}}/{{str_slug($locV->province,'-')}}">{{$locV->province}}</a></label> <span class="pull-right">({{$locV->location_count}})</span></li>
                    @endforeach
                    @endif
                </ul>
            </div><!-- /.LOCATION-filter -->
            <div class="clearfix"></div>
        </div><!-- /.body -->
        <div class="body bordered">
            <div class="category-filter">
                <h3>CATEGORY</h3><hr>
                <ul>
                    @php $count = array() @endphp
                    @if(isset($sideBarCat) && !empty($sideBarCat))
                    @php $count = array_column($sideBarCat,'total') @endphp
                    @endif
                        <li class="active"> <label><a href="#"> All sectors</a></label> <span class="pull-right">(@php echo array_sum($count); @endphp)</span></li>
                    @if(isset($sideBarCat) && !empty($sideBarCat))
                    @foreach($sideBarCat as $catV)
                    @php $class = ""; $current_loc = Request::segment(1); @endphp
                    @if($current_loc == $catV['slug'])
                    @php $class = "active_loc"; @endphp
                    @endif
                    @if($catV['slug'] !='my-wedding' && $catV['id'] != 39)
                        <li class="{{$class}}"> <label><a href="{{url($catV['slug'])}}">{{$catV['title']}}</a></label> <span class="pull-right">({{$catV['total']}})</span></li>
                    @endif
                    @endforeach
                    @endif
                </ul>
            </div><!-- /.CATEGORY-filter -->
            <div class="clearfix"></div>
        </div><!-- /.body -->
        <div class="body bordered">
            <div class="category-filter">
                <h3>Type of service</h3><hr>
                <ul>
                    @php $count = array() @endphp
                    Ashiq
                    @if(isset($serviceType) && !empty($serviceType))
                    @php $count = array_column($serviceType,'total') @endphp
                    @endif
                        <li class="active"> <label><a href="#"> All sectors</a></label> <span class="pull-right">(@php echo array_sum($count); @endphp)</span></li>
                    @if(isset($serviceType) && !empty($serviceType))
                    @foreach($serviceType as $catV)
                    @php $class = ""; $current_loc = Request::segment(2); @endphp
                    @if($current_loc == $catV['slug'])
                    @php $class = "active_loc"; @endphp
                    @endif
                        <li class="{{$class}}"> <label><a href="{{url($catV['parent_slug'].'/'.$catV['slug'])}}">{{$catV['title']}}</a></label> <span class="pull-right">({{$catV['total']}})</span></li>
                    @endforeach
                    @endif
                </ul>
            </div><!-- /.CATEGORY-filter -->
            <div class="clearfix"></div>
        </div><!-- /.body -->
    </div><!-- /.widget -->
    <!--  <div class="widget">
        <div class="simple-banner">
            <a href="#"><img alt="" class="img-responsive" src="{{url('public/images/banners/banner-simple.jpg')}}"></a>
        </div>
    </div> -->
    <div class="sidebarad text-center">
        <a href="#"><img src="{{url('public/images/sidebarad-img.jpg')}}" alt="" style="width: 100%"></a>
    </div>
</div>
<!-- ========================================= SIDEBAR : END ========================================= -->
***/ ?>
<style>
.directory-structure-aside {
    width: 100%;
    float: left;
}
.directory-box-filters {
    min-height: 358px;
}
.vendorsFilters {
    box-sizing: border-box;
    color: #222;
}
.vendorsFilters__section {
    border-bottom: 1px solid #d9d9d9;
    padding-bottom: 15px;
    margin-bottom: 25px;
    position: relative;
}
.vendorsFilters__title {
    font-size: 18px;
    line-height: 28px;
}
.vendorsFilters__toggleUp {
    -webkit-transform: rotate(180deg);
    transform: rotate(180deg);
    position: absolute;
    right: 0;
    top: 0;
    width: 24px;
    height: 24px;
    cursor: pointer;
}
.svgIcon {
    width: 16px;
    height: 16px;
    display: inline-block;
}
.vendorsFilters__toggleUp svg {
    fill: #8c8c8c;
}
.svgIcon svg {
    width: 100%;
    height: 100%;
}
svg:not(:root) {
    overflow: hidden;
}
.vendorFilterSearch {
    position: relative;
    margin-top: 20px;
}
.vendorFilterSearch__input--nearSelect {
    border-radius: 3px 3px 0 0;
}
.vendorFilterSearch__input {
    border: 1px solid #d9d9d9;
    padding: 12px 15px;
    border-radius: 3px;
    width: 100%;
    box-sizing: border-box;
}
input {
    line-height: normal;
}
button, input, optgroup, select, textarea {
    color: inherit;
    font: inherit;
    margin: 0;
}
.vendorFilterSearch__close {
    position: absolute;
    right: 10px;
    top: 14px;
    cursor: pointer;
}
.vendorFilterSearch__close svg {
    fill: #d9d9d9;
}
.vendorsFilters__options--nearInput {
    border-top: 0;
    border-radius: 0 0 3px 3px;
}
.vendorsFilters__options--scroll {
    max-height: 230px;
    overflow-y: auto !important;
    -webkit-overflow-scroll: touch;
    padding: 10px 0 15px 15px;
    background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAAUCAMAAAB70KeTAAAADFBMVEX29vb7+/v////y8vIBesvrAAAAEklEQVR4AWNggkJGJIgAzDAIAAIvAB5vqnzBAAAAAElFTkSuQmCC) repeat-x left bottom;
    border: 1px solid #d9d9d9;
    border-radius: 3px;
    margin-bottom: 10px;
}
ul {
    margin-bottom: 0px;
    padding: 0;
    list-style-type: none;
}
.vendorsFilters__item--selected, .vendorsFilters__item.selected, .vendorsFilters__item:hover, .vendorsFilters__itemRegion--selected, .vendorsFilters__itemRegion.selected, .vendorsFilters__itemRegion:hover {
    font-weight: 600;
}
.vendorsFilters__item, .vendorsFilters__itemRegion {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-flex-wrap: wrap;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    -webkit-box-align: center;
    -webkit-align-items: center;
    -ms-flex-align: center;
    align-items: center;
    -webkit-box-pack: space-between;
    -webkit-justify-content: space-between;
    -ms-flex-pack: space-between;
    justify-content: space-between;
    margin: 0 0 10px;
    cursor: pointer;
}
.vendorsFilters__label {
    white-space: nowrap;
    display: inline-block;
    overflow: hidden;
    text-overflow: ellipsis;
    max-width: 85%;
}
.vendorsFilters__count {
    font-size: 13px;
    line-height: 19px;
    color: #8c8c8c;
    margin-top: 3px;
    margin-right: 15px;
}
.active_loc {
    color: #35c0d5;
}
@media (max-width:320px)  { 
    .directory-box-filters {
        min-height: unset;
    }
}
@media (max-width:481px)  { 
    .directory-box-filters {
        min-height: unset;
    }
}
</style>
<div class="col-xs-12 col-sm-3 no-margin sidebar narrow">
    <div class="widget">
        <div id="app-vendors-directory-filters" class="directory-structure-aside aside">
            <div class="directory-box-filters" id="app-vendors-search-filters" data-filters="{&quot;id_grupo&quot;:1}">
                <div class="vendorsFilters app-vendors-search-filters">
                    <form name="frmSearchFilters" method="GET" action="#">
                        <div class="app-vendors-search-filters">
                            <div class="vendorsFilters__section">
                                <div class="app-filter-vendors app-box-filter" data-filter="id_provincia">
                                    <div id="app-filter-province" class="app-toggle-navigators app-toggle-box" data-toggle-type="suggest">
                                        <div class="vendorsFilters__title"> Location </div>
                                        <i class="changed-svgIcon changed-svgIcon__angleDown fa fa-arrow-down vendorsFilters__toggleUp" data-value="location">
                                            <!--<svg viewBox="0 0 32 32" width="16" height="16">
                                                <use xlink:href="#svg-_common-angleDown">
                                                    #shadow-root (closed)
                                                    <svg id="svg-_common-angleDown" viewBox="0 0 1792 1792">
                                                        <path d="M1395 736q0 13-10 23l-466 466q-10 10-23 10t-23-10L407 759q-10-10-10-23t10-23l50-50q10-10 23-10t23 10l393 393 393-393q10-10 23-10t23 10l50 50q10 10 10 23z"></path>
                                                    </svg>
                                                </use>
                                            </svg>-->
                                        </i>
                                    </div>
                                    <div class="loc_ul_li_div">
                                        <div class="vendorFilterSearch">
                                            <input class="vendorFilterSearch__input vendorFilterSearch__input--nearSelect search-region-input" type="text" placeholder="ENTER THE REGION">
                                            <i class="svgIcon svgIcon__close app-vendors-search-clear vendorFilterSearch__close">
                                                <svg viewBox="0 0 26 26">
                                                    <path d="M12.983 10.862L23.405.439l2.122 2.122-10.423 10.422 10.423 10.422-2.122 2.122-10.422-10.423L2.561 25.527.439 23.405l10.423-10.422L.439 2.561 2.561.439l10.422 10.423z" fill-rule="nonzero"></path>
                                                </svg>
                                            </i>
                                        </div>
                                        <ul class="vendorsFilters__options--scroll vendorsFilters__options--nearInput search-region-result" style="display: block;">
                                            <li class="dnone app-vendors-province-filters-zero-result">No matches have been found</li>
                                            @php $count = array();
                                                $current_loc = "";
                                                if(Request::segment(1) != 'search' && Request::segment(1) != 'services') {
                                                    $uri = Request::segment(1)??'wedding-venues';
                                                } else {
                                                    $uri = Request::segment(2)??'wedding-venues';
                                                }
                                                $url = 'search/'.$uri;
                                            @endphp
                                            @if(isset($locationData) && !empty($locationData))
                                                @php $count = array_column((array)$locationData,'location_count') @endphp
                                            @endif
                                            <li class="vendorsFilters__item selected app-link" data-url="{{url('search?search='.$searchData)}}">
                                                <!--All provinces <span class="pull-right">(@php echo array_sum($count); @endphp) &nbsp;</span>-->
                                            </li>
                                            @if(isset($locationData) && !empty($locationData))
                                                @php $current_loc = Request::segment(3); @endphp
                                                @php
                                                    $currentUri = '';
                                                    if(isset($_GET['category']))
                                                        $currentUri .= '?category='.$_GET['category'];
                                                    if(isset($_GET['search']))
                                                        $currentUri .= ($currentUri == '' ? '?search='.$_GET['search'] : '&search='.$_GET['search']);
                                                @endphp
                                                @foreach($locationData as $locV)
                                                    @php $class = "";  @endphp
                                                    @if($current_loc == str_slug($locV->province,'-'))
                                                        @php $class = "active_loc";  @endphp
                                                    @endif
                                                    <li class="{{$class}} vendorsFilters__item app-link" data-url="{{url('search'.($currentUri == ''? '?location='.str_slug($locV->province,'-') :$currentUri.'&location='.str_slug($locV->province,'-')))}}">
                                                        <span class="vendorsFilters__label">{{$locV->province}}</span>
                                                        <!--<span class="vendorsFilters__count">()</span>-->
                                                    </li>
                                                @endforeach
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="vendorsFilters__section">
                                <div class="app-filter-vendors" data-filter="id_grupo">
                                    <div id="app-filter-sector" class="app-toggle-navigators app-selected app-toggle-box">
                                        <div class="vendorsFilters__title">All categories </div>
                                         <i class="changed-svgIcon changed-svgIcon__angleDown fa fa-arrow-down vendorsFilters__toggleUp" data-value="category">
                                            <!--<svg viewBox="0 0 32 32" width="16" height="16">
                                                <use xlink:href="#svg-_common-angleDown"></use>
                                            </svg>-->
                                        </i> 
                                    </div>
                                    <div class="cat_ul_li_div">
                                        <ul class="vendorsFilters__options--scroll app-toggle-box-target">
                                            @php $count = array() @endphp
                                            @if(isset($sideBarCat) && !empty($sideBarCat))
                                                @php $count = array_column($sideBarCat,'total') @endphp
                                            @endif
                                            <!--<li class="vendorsFilters__item selected">
                                                <span class="pull-right">--><!-- (@php echo array_sum($count); @endphp) &nbsp; --></span>
                                            </li>
                                            @if(isset($sideBarCat) && !empty($sideBarCat))
                                                @foreach($sideBarCat as $catV)
                                                    @php $class = ""; $current_loc = Request::segment(1); $current_loc2 = Request::segment(2); @endphp
                                                    @if($current_loc == $catV['slug'] || $current_loc2 == $catV['slug'])
                                                        @php $class = "active_loc"; @endphp
                                                    @endif
                                                    @if($catV['slug'] != 'my-wedding' && $catV['id'] != 39)
                                                    @endif
                                                @endforeach
                                            @endif
                                            @if(isset($category_with_total))
                                            @php
                                                $currentUri = '';
                                                if(isset($_GET['location']))
                                                    $currentUri .= '&location='.$_GET['location'];
                                                if(isset($_GET['search']))
                                                    $currentUri .= '&search='.$_GET['search'];
                                            @endphp
                                            @foreach($category_with_total as $cats)
                                            @if(isset($cats['child']))
                                            @php $count = array_column($cats['child'],'total') @endphp
                                            @else
                                            @php $count = array(); @endphp
                                            @endif
                                                <li class="{{isset($class)?$class:''}} vendorsFilters__item app-link" data-url="{{url('search?category='.$cats['slug'].($currentUri == '' ? '' : $currentUri))}}">
                                                    <span class="vendorsFilters__label">{{$cats['title']}}</span>
                                                    <span class="vendorsFilters__count"><!--({{array_sum($count)}})--></span>
                                                </li>
                                            @endforeach
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="vendorsFilters__section">
                                <div class="app-filter-vendors">
                                    <h4>Type of services</h4>
                                    <!-- <h3>({{$cats['title']}}) <span class="pull-right">({{array_sum($count)}})</span></h3>
                                    <ul>
                                    @if(isset($cats['child']))
                                    @php $count = array_column($cats['child'],'total') @endphp
                                        @foreach($cats['child'] as $child)
                                        <li><a href="{{url('search?search='.$child['slug'])}}">{{$child['title']}}</a><span class="pull-right">({{$child['total']}})</span></li>
                                        @endforeach
                                    @else
                                        <li>Coming Soon</li>
                                    @endif
                                    </ul> -->
                                    <div id="app-filter-service" class="app-toggle-navigators app-toggle-box">
                                        <div class="vendorsFilters__title"><!-- {{$cats['title']}} --></div>
                                        <i class="chnaged-svgIcon changed-svgIcon__angleDown fa fa-arrow-down vendorsFilters__toggleUp" data-value="types">
                                            <!--<svg viewBox="0 0 32 32" width="16" height="16">
                                                <use xlink:href="#svg-_common-angleDown"></use>
                                            </svg>-->
                                        </i>
                                    </div>
                                    <div class="typ_ul_li_div">
                                        <ul class="vendorsFilters__options vendorsFilters__options--scroll app-toggle-box-target" style="max-height: 450px !important;">
                                    @if(isset($category_with_total))
                                    @php
                                        $currentUri = '';
                                        if(isset($_GET['location']))
                                            $currentUri .= '&location='.$_GET['location'];
                                        if(isset($_GET['search']))
                                            $currentUri .= '&search='.$_GET['search'];
                                    @endphp
                                    @foreach($category_with_total as $cats)
                                    @if(isset($cats['child']))
                                    @php $count = array_column($cats['child'],'total') @endphp
                                    @else
                                    @php $count = array(); @endphp
                                    @endif
                                    @if(isset($cats['child']))
                                    @php $count = array_column($cats['child'],'total') @endphp
                                            <li class="vendorsFilters__item selected">
                                                {{$cats['title']}} <span class="pull-right"><!--(@php echo array_sum($count); @endphp)--> &nbsp;</span>
                                            </li>
                                    @foreach($cats['child'] as $child)
                                        @php $class = ""; $current_loc = Request::segment(2); @endphp
                                        @if($current_loc == $child['slug'])
                                            @php $class = "active_loc"; @endphp
                                        @endif
                                        <li class="{{$class}} vendorsFilters__item app-link" data-url="{{url('search?category='.$child['slug'].($currentUri == '' ? '' : $currentUri))}}">
                                            <span class="vendorsFilters__label">{{$child['title']}}</span>
                                            <span class="vendorsFilters__count"><!--({{$child['total']}})--></span>
                                        </li>
                                    @endforeach
                                    @endif
                                    @endforeach
                                    @endif
                                        </ul>
                                    </div>
                                    <!-- <div class="typ_ul_li_div">
                                        <ul class="vendorsFilters__options vendorsFilters__options--scroll app-toggle-box-target"> -->
                                            @php $count = array() @endphp
                                            @if(isset($serviceType) && !empty($serviceType))
                                                @php $count = array_column($serviceType,'total') @endphp
                                            @endif
                                            <!-- <li class="vendorsFilters__item selected">
                                                All types <span class="pull-right">(@php echo array_sum($count); @endphp) &nbsp;</span>
                                            </li> -->
                                            @if(isset($serviceType) && !empty($serviceType))
                                                @foreach($serviceType as $catV)
                                                    @php $class = ""; $current_loc = Request::segment(2); @endphp
                                                    @if($current_loc == $catV['slug'])
                                                        @php $class = "active_loc"; @endphp
                                                    @endif
                                                    <!-- <li class="{{$class}} vendorsFilters__item app-link" data-url="{{url('services/'.$catV['parent_slug'].'/'.$catV['slug'])}}">
                                                        <span class="vendorsFilters__label">{{$catV['title']}}</span>
                                                        <span class="vendorsFilters__count">({{$catV['total']}})</span>
                                                    </li> -->
                                                @endforeach
                                            @endif
                                        <!-- </ul>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- <div class="sidebarad text-center">
                <a href="#"><img src="{{url('public/images/sidebarad-img.jpg')}}" alt="" style="width: 100%"></a>
            </div> -->
        </div>
    </div>
</div>
<script>
$(document).ready(function()
{
    $('body').on('click', '.app-link', function() {
        var curUrl = $(this).attr('data-url');
        window.location.href = curUrl;
    });
    $('body').on('click', '.vendorsFilters__toggleUp', function() {
        var curUrl = $(this).attr('data-value');
        if(curUrl == 'location') {
            if($('.loc_ul_li_div').hasClass('dnone')) {
                $('.loc_ul_li_div').removeClass('dnone');
            } else {
                $('.loc_ul_li_div').addClass('dnone');
            }
        }
        if(curUrl == 'category') {
            if($('.cat_ul_li_div').hasClass('dnone')) {
                $('.cat_ul_li_div').removeClass('dnone');
            } else {
                $('.cat_ul_li_div').addClass('dnone');
            }
        }
        if(curUrl == 'types') {
            if($('.typ_ul_li_div').hasClass('dnone')) {
                $('.typ_ul_li_div').removeClass('dnone');
            } else {
                $('.typ_ul_li_div').addClass('dnone');
            }
        }
    });
    $(".search-region-input").keyup(function() {
        var filter = $(this).val();
        var filterCounter = 0;
        var defFilterCounter = 0;
        $("ul.search-region-result li").each(function() {
            defFilterCounter++;
            if($(this).text().search(new RegExp(filter, "i")) < 0) {
                $(this).fadeOut();
                filterCounter++;
            } else {
                $(this).show();
            }
        });
        if(filterCounter == defFilterCounter && Number(defFilterCounter) > 0) {
            $('.app-vendors-province-filters-zero-result').show();
        } else {
            $('.app-vendors-province-filters-zero-result').hide();
        }
    });
    $('body').on('click', '.vendorFilterSearch__close', function() {
        // $('.vendorFilterSearch__input').val('');
        $('.search-region-input').val('');
        $("ul.search-region-result li").each(function() {
            $(this).show();
        });
        $('.app-vendors-province-filters-zero-result').hide();
    });
    if (window.matchMedia('(max-width: 320px)').matches) {
        $('.vendorsFilters__toggleUp').click();
        // alert(320);
    }
    if (window.matchMedia('(max-width: 481px)').matches) {
        $('.vendorsFilters__toggleUp').click();
        // alert(481);
    }
});
</script>