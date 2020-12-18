@extends('layouts.default')
@section('meta_title',$data['meta_data']->meta_title)
@section('meta_keyword',$data['meta_data']->meta_keyword)
@section('meta_description',$data['meta_data']->meta_description)
@section('content')
@include('includes.menu')

<link rel="stylesheet" href="{{ asset('css/swiper.min.css') }}">

  <!-- Demo styles -->
  <style>
    html, body {
      position: relative;
      height: 100%;
    }
    body {
      
                 
      margin: 0;
      padding: 0;
    }
    .swiper-container {
      width: 100%;
      height: 100%;
    }
    .swiper-slide {
      text-align: center;
      font-size: 18px;
      background: #000;

    }
    .swiper-slide img {
      width: auto;
      height: auto;
      max-width: 100%;
      max-height: 100%;
      -ms-transform: translate(-50%, -50%);
      -webkit-transform: translate(-50%, -50%);
      -moz-transform: translate(-50%, -50%);
      transform: translate(-50%, -50%);
      position: absolute;
      left: 50%;
      top: 50%;
    }
  </style>

 <div class="menu-top">
	<div class="menu-top-wrapper">
	    <strong class="app-common-cab-title menu-top-title ellipsis">{{ $data['meta_data']->meta_title }}</strong>
	</div>
</div>
@include('vendor.tools_nav')
<div class="storefront-search">
    <div class="directory-search-content ">
        <form id="app-frm-search" class="pure-u app-vendors-search-form" name="frmSearch" method="get" >
            <input type="hidden" name="id_grupo" data-value="wedding-vendors" data-id="2" data-id-ww="605" value="2">
            <input type="hidden" name="id_sector" data-value="wedding-flowers" value="15" data-id="15" data-id-ww="15">
            <input type="hidden" name="id_region" data-value="" value="">
            <input type="hidden" name="id_provincia" data-value="" data-id-ww="" value="">
            <input type="hidden" name="id_geozona" data-value="" value="">
            <input type="hidden" name="id_poblacion" data-value="" value="">
            <input type="hidden" name="id_empresa" value="17879">
            <input type="hidden" name="distance" value="">
            <input type="hidden" name="lat" value="">
            <input type="hidden" name="long" value="">
            <input type="hidden" name="showmode" value="">
            <input type="hidden" name="NumPage" value="1">
            <input type="hidden" name="userSearch" value="1">
            <input type="hidden" name="isSearch" value="0">
            <input type="hidden" name="isHome" value="0">

            <div class="directory-search-input">
                <i class="svgIcon svgIcon__search directory-search-input-icon">
                    <svg viewBox="0 0 32 32" width="16" height="16">
                        <use xlink:href="#svg-_common-search"><svg id="svg-_common-search" viewBox="0 0 74 77"><path d="M49.35 48.835l23.262 23.328a2.316 2.316 0 1 1-3.28 3.27L45.865 51.901a28.534 28.534 0 0 1-17.13 5.683C12.867 57.584.014 44.7.014 28.8.014 12.896 12.865.015 28.735.015 44.593.015 57.446 12.9 57.446 28.8a28.728 28.728 0 0 1-8.097 20.035zM52.813 28.8c0-13.345-10.782-24.153-24.079-24.153-13.31 0-24.089 10.805-24.089 24.153 0 13.344 10.782 24.152 24.09 24.152 13.294 0 24.078-10.811 24.078-24.152z" fill-rule="nonzero"></path></svg></use>
                    </svg>
                </i>
                <input id="txtStrSearch" class="directory-search-input-first search-filled" name="txtStrSearch" autocomplete="off" type="search" value="Wedding Flowers" data-placeholder="(E.g. Wedding Flowers)" data-explain="Search for" data-value="Wedding Flowers" placeholder="(E.g. Wedding Flowers)">
                <span id="app-search-text-reset" class="directory-hero-search-clear ">
                    <i class="svgIcon svgIcon__close ">
	                    <svg viewBox="0 0 32 32" width="16" height="16">
	                        <use xlink:href="#svg-_common-close"><svg id="svg-_common-close" viewBox="0 0 26 26"><path d="M12.983 10.862L23.405.439l2.122 2.122-10.423 10.422 10.423 10.422-2.122 2.122-10.422-10.423L2.561 25.527.439 23.405l10.423-10.422L.439 2.561 2.561.439l10.422 10.423z" fill-rule="nonzero"></path></svg></use>
	                    </svg>
                	</i>     
            	</span>
            </div>
            <div class="directory-search-input">
                <span class="directory-search-input-where">in</span>
                <input id="txtLocSearch" class="" name="txtLocSearch" autocomplete="off" type="search" value="" data-placeholder="(E.g. Toronto)" data-explain="Where" data-value="" placeholder="(E.g. Toronto)">
                <span id="app-search-loc-reset" class="directory-hero-search-clear dnone">
                    <i class="svgIcon svgIcon__close ">
                    <svg viewBox="0 0 32 32" width="16" height="16">
                        <use xlink:href="#svg-_common-close"></use>
                    </svg>
                </i>                </span>
            </div>
            <input class="btn-outline outline-red" id="mainSearchBtn" title="Search" value="Search" type="submit">
        </form>
    </div>
</div>

<div class="storefrontBar ">
    <div class="wrapper">
		<div class="storefront-bar-breadcrumb breadcrumb-container">
		    <ul class="breadcrumb" vocab="http://schema.org/" typeof="BreadcrumbList"><li property="itemListElement" typeof="ListItem"><a href="https://www.weddingwire.ca/" property="item" typeof="WebPage"><span property="name">Weddings</span></a><meta property="position" content="1"></li><li property="itemListElement" typeof="ListItem"><a href="https://www.weddingwire.ca/wedding-vendors" property="item" typeof="WebPage"><span property="name">Wedding Vendors</span></a><meta property="position" content="2"></li><li property="itemListElement" typeof="ListItem"><a href="https://www.weddingwire.ca/wedding-flowers" property="item" typeof="WebPage"><span property="name">Wedding Flowers</span></a><meta property="position" content="3"></li><li property="itemListElement" typeof="ListItem"><a href="https://www.weddingwire.ca/wedding-flowers/ontario" property="item" typeof="WebPage"><span property="name">Wedding Flowers Ontario</span></a><meta property="position" content="4"></li><li property="itemListElement" typeof="ListItem"><a href="https://www.weddingwire.ca/wedding-flowers/ontario/toronto" property="item" typeof="WebPage"><span property="name">Wedding Flowers Toronto</span></a><meta property="position" content="5"></li><li><span>Wedding Blossoms</span></li></ul>                 
		</div>
	</div>
</div>

<div class="storefrontHeader">
	<div id="app-basic-info" class="wrapper">
		<div class="storefrontHeader__infoContainer">
			<input type="hidden" name="facebook_conversion_enabled" value="1">
			<input type="hidden" name="google_conversion_enabled" value="1">
			<div class="storefrontHeader__info">
				<h1 class="storefrontHeader__title">{{ $data['meta_data']->meta_title }}</h1>
				<i class="svgIcon svgIcon__premium storefrontHeader__premium"><svg viewBox="0 0 64 18"><path d="M64 0H0v18h64l-3.5-8.9L64 0zm-1.5 17H1V1h61.5l-3.1 8.1 3.1 7.9z"></path><path d="M9.8 6.1c-.5-.4-1.2-.6-2-.6H4.9v7h1.3v-2.1h1.5c.9 0 1.6-.2 2-.7.5-.4.7-1.1.7-1.9.1-.7-.1-1.3-.6-1.7zm-1 2.8c-.2.2-.6.4-1.1.4H6.2V6.7h1.5c.5 0 .9.1 1.2.3s.4.5.4 1c-.1.4-.2.7-.5.9zM16.2 10.2c.5-.2.8-.5 1-.9.2-.4.4-.9.4-1.4 0-.8-.2-1.4-.7-1.8-.5-.4-1.2-.6-2.1-.6h-2.9v7h1.3v-2.1H15l1.2 2.1h1.5l-1.5-2.3zm-1.5-.9h-1.6V6.7h1.6c.5 0 .9.1 1.2.3s.4.5.4 1c0 .4-.1.8-.4 1-.3.1-.7.3-1.2.3zM19.2 5.5h5.2v1.2h-3.8v1.7H24v1.2h-3.4v1.7h3.9v1.2h-5.3zM26 5.5h1.6l2.3 4.5 2.3-4.5h1.5v7h-1.2v-5l-2.2 4.3h-.8l-2.2-4.3v5H26zM35.7 5.5H37v7h-1.3zM40.6 10.9c.3.3.7.5 1.3.5.5 0 .9-.2 1.2-.5.3-.3.5-.7.5-1.3V5.5h1.3v4.1c0 .6-.1 1.1-.4 1.6-.2.5-.6.8-1.1 1-.5.2-1 .4-1.6.4-.6 0-1.2-.1-1.6-.4-.5-.2-.8-.6-1.1-1-.2-.5-.4-1-.4-1.6V5.5H40v4.1c.1.6.3 1 .6 1.3zM46.7 5.5h1.5l2.3 4.5 2.3-4.5h1.5v7h-1.2v-5l-2.2 4.3h-.8l-2.2-4.3v5h-1.2z"></path></svg></i>                
				<div class="storefrontHeaderOnepage__address">
					<!-- APP_SHOW_LOCATION_GEO -->
						{{$data['vendor_map'][0]->address.' '.$data['vendor_map'][0]->postal_code.' '.$data['vendor_map'][0]->city.'(  '.$data['vendor_map'][0]->state.') ' }}
					                                               <!-- /APP_SHOW_LOCATION_GEO -->
					<a class="storefrontHeaderOnepage__infoItem" href="{{ url('view_storefront/'.request()->segment(2).'/map') }}">
					Map </a> · <a class="storefrontHeaderOnepage__infoItem storefrontDrop" rel="nofollow" role="button">
					<span class="app-emp-phone-txt">Phone Number</span>
					<div id="app-emp-phone" class="app-emp-phone dnone"></div></a>
				</div>
			</div>

			<div class="storefrontHeader__actions">
				<span class="btnOutline btnOutline--grey storefrontHeader__review">
					<a rel="nofollow" href="https://www.weddingwire.ca/shared/rate/17879">
						<i class="svgIcon svgIcon__starOutline ">
							<svg viewBox="0 0 32 32" width="16" height="16">
								<use xlink:href="#svg-_common-starOutline"><svg id="svg-_common-starOutline" viewBox="0 0 1792 1792"><path d="M1201 1004l306-297-422-62-189-382-189 382-422 62 306 297-73 421 378-199 377 199zm527-357q0 22-26 48l-363 354 86 500q1 7 1 20 0 50-41 50-19 0-40-12l-449-236-449 236q-22 12-40 12-21 0-31.5-14.5T365 1569q0-6 2-20l86-500L89 695q-25-27-25-48 0-37 56-46l502-73L847 73q19-41 49-41t49 41l225 455 502 73q56 9 56 46z"></path></svg></use>
							</svg>
						</i>Write a review
					</a>
				</span>
				
				<span class="btnOutline btnOutline--grey storefrontHeader__hired app-save-vendor" role="button" data-type="hired" data-params="{&quot;idCategory&quot;: 119,&quot;idEmpresa&quot;: 17879,&quot;zonaInsert&quot;: 31,&quot;status&quot;: 6}">
					<i class="svgIcon svgIcon__hired ">
						<svg viewBox="0 0 32 32" width="16" height="16">
							<use xlink:href="#svg-vendors-hired"><svg id="svg-vendors-hired" viewBox="0 0 101 72"><path d="M22.214 50.432l18.374-10.304a1 1 0 0 1 .978 1.744L20.79 53.523c-1.622.909-2.27 3.123-1.407 4.917.779 1.62 2.56 2.251 4.012 1.477.22-.124.478-.266.807-.444l.059-.032.73-.394.442-.24c.346-.395.75-.74 1.21-1.014l19.46-11.651a1 1 0 0 1 1.027 1.716l-19.46 11.65c-1.51.906-2.123 3.143-1.307 4.956.723 1.603 2.33 2.21 3.654 1.455l20.449-11.676a1 1 0 1 1 .991 1.737l-13.8 7.88c-.018.055-.041.109-.07.162-.66 1.227-.776 2.746-.26 3.898l.043.119c.7 1.557 2.987 2.231 4.487 1.373l.605-.317 28.55-16.405a36.618 36.618 0 0 0 7.608-5.838l7.534-7.52-13.23-27.366-.042-.089a3.892 3.892 0 0 1 1.94-5.15l6.812-3.085a3.892 3.892 0 0 1 5.122 1.879l13.3 28.066a3.892 3.892 0 0 1-1.531 5.014l-6.245 3.703a3.892 3.892 0 0 1-5.166-1.104l-7.081 7.067a38.618 38.618 0 0 1-8.025 6.157L43.426 70.847l-.607.318c-2.472 1.416-6.077.353-7.295-2.36l-.043-.118c-.455-1.013-.58-2.194-.405-3.353l-4.067 2.322c-2.39 1.363-5.279.27-6.47-2.37a6.225 6.225 0 0 1-.469-3.475c-2.435 1.108-5.275.023-6.49-2.504-1.286-2.677-.365-5.965 2.086-7.443-.896-.517-1.65-1.35-2.125-2.418-1.225-2.758-.307-6.15 2.115-7.621l9.364-5.68a1 1 0 1 1 1.037 1.71l-9.364 5.68c-1.531.93-2.153 3.232-1.324 5.099.576 1.293 1.721 1.974 2.845 1.798zM24.88 4.096l2.04.649a9.477 9.477 0 0 0 6.723-.367 12.865 12.865 0 0 1 10.161-.108l24.943 10.31-.015.684c-.097 4.25-1.676 6.763-4.27 7.71-1.225.447-2.496.484-3.672.287a5.144 5.144 0 0 1-.615-.137l-11.564-4.01c-2.007 6.266-5.497 9.963-10.05 11.454-3.228 1.058-6.64.915-9.88.05-.967-.26-1.692-.52-2.11-.703a1 1 0 0 1 .802-1.832c.074.032.232.095.465.18.398.143.854.287 1.36.422 2.898.775 5.935.901 8.74-.017 4.137-1.355 7.282-4.848 9.053-11.111l.289-1.02 1.001.347 12.495 4.334c.05.014.17.041.344.07.865.146 1.804.118 2.657-.193 1.652-.603 2.724-2.173 2.925-5.197L43.04 6.118a10.865 10.865 0 0 0-8.595.092 11.477 11.477 0 0 1-8.131.441l-.84-.267a3.908 3.908 0 0 1-.13.802c-.019.069-.019.069-.04.137l-10.18 32.828A3.892 3.892 0 0 1 10 42.628l-7.144-2.764a3.892 3.892 0 0 1-2.301-4.82l10.277-31.97a3.892 3.892 0 0 1 4.72-2.566l7.049 1.905a3.878 3.878 0 0 1 2.277 1.683zm-1.466 2.568a1.892 1.892 0 0 0-1.333-2.32l-7.048-1.906a1.892 1.892 0 0 0-2.295 1.248L2.46 35.656a1.892 1.892 0 0 0 1.118 2.342l7.145 2.765a1.892 1.892 0 0 0 2.49-1.204l10.18-32.828.02-.067zM88.592 39.78a1.892 1.892 0 0 0 2.668.804l6.244-3.703a1.892 1.892 0 0 0 .745-2.438l-13.3-28.066a1.892 1.892 0 0 0-2.49-.913l-6.812 3.084a1.892 1.892 0 0 0-.943 2.504l.02.043L88.592 39.78z" fill-rule="nonzero"></path></svg></use>
						</svg>
					</i> Hired?
				</span>
				<span class="btnOutline btnOutline--grey storefrontHeader__hired active app-displayer-hide app-link" style="display:none;" data-href="https://www.weddingwire.ca/tools/VendorsCateg?id_categ=119&amp;status=6" onclick="common_teDIR(&quot;EMP_CB_SHOWVENDORS&quot;);">
					<i class="svgIcon svgIcon__hired ">
						<svg viewBox="0 0 32 32" width="16" height="16">
							<use xlink:href="#svg-vendors-hired"><svg id="svg-vendors-hired" viewBox="0 0 101 72"><path d="M22.214 50.432l18.374-10.304a1 1 0 0 1 .978 1.744L20.79 53.523c-1.622.909-2.27 3.123-1.407 4.917.779 1.62 2.56 2.251 4.012 1.477.22-.124.478-.266.807-.444l.059-.032.73-.394.442-.24c.346-.395.75-.74 1.21-1.014l19.46-11.651a1 1 0 0 1 1.027 1.716l-19.46 11.65c-1.51.906-2.123 3.143-1.307 4.956.723 1.603 2.33 2.21 3.654 1.455l20.449-11.676a1 1 0 1 1 .991 1.737l-13.8 7.88c-.018.055-.041.109-.07.162-.66 1.227-.776 2.746-.26 3.898l.043.119c.7 1.557 2.987 2.231 4.487 1.373l.605-.317 28.55-16.405a36.618 36.618 0 0 0 7.608-5.838l7.534-7.52-13.23-27.366-.042-.089a3.892 3.892 0 0 1 1.94-5.15l6.812-3.085a3.892 3.892 0 0 1 5.122 1.879l13.3 28.066a3.892 3.892 0 0 1-1.531 5.014l-6.245 3.703a3.892 3.892 0 0 1-5.166-1.104l-7.081 7.067a38.618 38.618 0 0 1-8.025 6.157L43.426 70.847l-.607.318c-2.472 1.416-6.077.353-7.295-2.36l-.043-.118c-.455-1.013-.58-2.194-.405-3.353l-4.067 2.322c-2.39 1.363-5.279.27-6.47-2.37a6.225 6.225 0 0 1-.469-3.475c-2.435 1.108-5.275.023-6.49-2.504-1.286-2.677-.365-5.965 2.086-7.443-.896-.517-1.65-1.35-2.125-2.418-1.225-2.758-.307-6.15 2.115-7.621l9.364-5.68a1 1 0 1 1 1.037 1.71l-9.364 5.68c-1.531.93-2.153 3.232-1.324 5.099.576 1.293 1.721 1.974 2.845 1.798zM24.88 4.096l2.04.649a9.477 9.477 0 0 0 6.723-.367 12.865 12.865 0 0 1 10.161-.108l24.943 10.31-.015.684c-.097 4.25-1.676 6.763-4.27 7.71-1.225.447-2.496.484-3.672.287a5.144 5.144 0 0 1-.615-.137l-11.564-4.01c-2.007 6.266-5.497 9.963-10.05 11.454-3.228 1.058-6.64.915-9.88.05-.967-.26-1.692-.52-2.11-.703a1 1 0 0 1 .802-1.832c.074.032.232.095.465.18.398.143.854.287 1.36.422 2.898.775 5.935.901 8.74-.017 4.137-1.355 7.282-4.848 9.053-11.111l.289-1.02 1.001.347 12.495 4.334c.05.014.17.041.344.07.865.146 1.804.118 2.657-.193 1.652-.603 2.724-2.173 2.925-5.197L43.04 6.118a10.865 10.865 0 0 0-8.595.092 11.477 11.477 0 0 1-8.131.441l-.84-.267a3.908 3.908 0 0 1-.13.802c-.019.069-.019.069-.04.137l-10.18 32.828A3.892 3.892 0 0 1 10 42.628l-7.144-2.764a3.892 3.892 0 0 1-2.301-4.82l10.277-31.97a3.892 3.892 0 0 1 4.72-2.566l7.049 1.905a3.878 3.878 0 0 1 2.277 1.683zm-1.466 2.568a1.892 1.892 0 0 0-1.333-2.32l-7.048-1.906a1.892 1.892 0 0 0-2.295 1.248L2.46 35.656a1.892 1.892 0 0 0 1.118 2.342l7.145 2.765a1.892 1.892 0 0 0 2.49-1.204l10.18-32.828.02-.067zM88.592 39.78a1.892 1.892 0 0 0 2.668.804l6.244-3.703a1.892 1.892 0 0 0 .745-2.438l-13.3-28.066a1.892 1.892 0 0 0-2.49-.913l-6.812 3.084a1.892 1.892 0 0 0-.943 2.504l.02.043L88.592 39.78z" fill-rule="nonzero"></path></svg></use>
						</svg>
					</i> Hired
				</span>
				<input type="hidden" name="facebook_conversion_id" value="1981600325399047">
				<span class="btnOutline btnOutline--grey storefrontHeader__save ml5 app-save-vendor" role="button" data-type="save" data-params="{&quot;id_empresa&quot;: 17879,&quot;zona_vendor&quot;: 2}">
					<i class="svgIcon svgIcon__heartOutline ">
						<svg viewBox="0 0 32 32" width="16" height="16">
							<use xlink:href="#svg-_common-heartOutline"><svg id="svg-_common-heartOutline" viewBox="0 0 34 30"><path d="M26.232.086C30.653.716 34 4.68 34 9.858c0 1.41-.371 2.884-1.073 4.412-1.35 2.937-3.878 6.013-7.247 9.134a68.921 68.921 0 0 1-5.582 4.625c-.665.496-1.284.941-1.84 1.328-.335.233-.577.396-.71.483a1 1 0 0 1-1.097 0c-.132-.087-.374-.25-.71-.483a67.429 67.429 0 0 1-1.84-1.328 68.921 68.921 0 0 1-5.58-4.625c-3.37-3.121-5.898-6.197-7.248-9.134C.371 12.742 0 11.268 0 9.858 0 4.681 3.347.716 7.768.086 11.6-.46 15.091 1.616 17 5.778 18.91 1.617 22.4-.46 26.232.086zm-9.115 27.628a65.438 65.438 0 0 0 1.785-1.288 66.954 66.954 0 0 0 5.418-4.489c3.194-2.958 5.57-5.85 6.79-8.502.588-1.283.89-2.479.89-3.577 0-4.193-2.626-7.304-6.05-7.792-3.552-.507-6.76 1.95-7.978 7.03-.245 1.023-1.7 1.023-1.944 0-1.219-5.08-4.426-7.537-7.978-7.03C4.626 2.554 2 5.666 2 9.858c0 1.098.302 2.294.89 3.577 1.22 2.652 3.596 5.544 6.79 8.502a66.954 66.954 0 0 0 5.418 4.489A65.438 65.438 0 0 0 17 27.796l.117-.082z"></path></svg></use>
						</svg>
					</i> Save                    
				</span>
				<span class="btnOutline btnOutline--grey storefrontHeader__save active ml5 app-link" style="display:none;" data-href="https://www.weddingwire.ca/tools/VendorsCateg?id_categ=119" onclick="common_teDIR(&quot;EMP_CB_SHOWVENDORS&quot;);">
				<i class="svgIcon svgIcon__heart ">
					<svg viewBox="0 0 32 32" width="16" height="16">
						<use xlink:href="#svg-_common-heart"><svg id="svg-_common-heartOutline" viewBox="0 0 34 30"><path d="M26.232.086C30.653.716 34 4.68 34 9.858c0 1.41-.371 2.884-1.073 4.412-1.35 2.937-3.878 6.013-7.247 9.134a68.921 68.921 0 0 1-5.582 4.625c-.665.496-1.284.941-1.84 1.328-.335.233-.577.396-.71.483a1 1 0 0 1-1.097 0c-.132-.087-.374-.25-.71-.483a67.429 67.429 0 0 1-1.84-1.328 68.921 68.921 0 0 1-5.58-4.625c-3.37-3.121-5.898-6.197-7.248-9.134C.371 12.742 0 11.268 0 9.858 0 4.681 3.347.716 7.768.086 11.6-.46 15.091 1.616 17 5.778 18.91 1.617 22.4-.46 26.232.086zm-9.115 27.628a65.438 65.438 0 0 0 1.785-1.288 66.954 66.954 0 0 0 5.418-4.489c3.194-2.958 5.57-5.85 6.79-8.502.588-1.283.89-2.479.89-3.577 0-4.193-2.626-7.304-6.05-7.792-3.552-.507-6.76 1.95-7.978 7.03-.245 1.023-1.7 1.023-1.944 0-1.219-5.08-4.426-7.537-7.978-7.03C4.626 2.554 2 5.666 2 9.858c0 1.098.302 2.294.89 3.577 1.22 2.652 3.596 5.544 6.79 8.502a66.954 66.954 0 0 0 5.418 4.489A65.438 65.438 0 0 0 17 27.796l.117-.082z"></path></svg></use>
					</svg>
					</i> Saved                    
				</span>
			</div>
		</div>
		<div class="storefrontSummary">
			<div id="lContactEmp">
				<a id="btnCompany" class="storefront-header-btn btn btn-primary app-ua-track-event" rel="nofollow" href="#app-layer-multisolicitud" onclick="vendors_showFormContactarEmp(this, '17879', false, null, 1); common_teDIR('EMP_CB_FORM');" data-track-c="LeadTracking" data-track-a="a-step1" data-track-l="d-desktop+s-profile_header" data-track-v="1" data-track-ni="0" data-track-cds="{&quot;dimension15&quot;:&quot;17879&quot;,&quot;dimension17&quot;:&quot;1&quot;}">
				Request pricing</a>
			</div>
			<div class="storefrontDiscount storefrontSummary__item app-mirror-link">
				<span class="storefrontDiscount__label">{{ $data['meta_data']->meta_title }}</span>
				 @if($data['vendor']->promotion_data->promotion_amount!='' && $data['vendor']->promotion_data->wedding_offer!=1)
				 	<a href="{{ url('view_storefront/'.request()->segment(2).'/promotions/'.$data['vendor']->promotion_data->promotion_amount.'-discount-for-perfectwedding-couples')}}">
				-{{$data['vendor']->promotion_data->promotion_amount}}% Discount </a>
				@endif
				
			</div>

			<a class="storefrontSummary__item" href="https://www.weddingwire.ca/wedding-flowers/wedding-blossoms--e17879/reviews">
				<span class="storefrontSummary__label">
				<div class="rating-stars-vendor mr5">
				<span class="rating-stars-vendor rating-stars-vendor-bar" style=" width:100%;"></span>
				</div> 1 review</span>
				<div class="storefrontSummary__text strong">5.0 out of 5.0 </div>
			</a>
			<div class="storefrontSummary__item">
				<span class="storefrontSummary__label">Availability</span>
				<i class="svgIcon svgIcon__calendarOk listItem__featuresIcon">
					<svg viewBox="0 0 32 32" width="16" height="16">
						<use xlink:href="#svg-_common-calendarOk"><svg id="svg-_common-calendarOk" viewBox="0 0 34 34"><path d="M15.887 25.353l7.202-8.672.77.638-7.474 9-.528-.438-.438.425-5.393-5.56.718-.697 5.143 5.304zM1.067 10.267h31.867v-5.8h-4.667v1.766a.5.5 0 0 1-.5.5h-4.534a.5.5 0 0 1-.5-.5V4.467H11.267v1.766a.5.5 0 0 1-.5.5H6.233a.5.5 0 0 1-.5-.5V4.467H1.067v5.8zm0 1v21.666h31.867V11.267H1.067zm10.2-7.8h11.466v-2.9a.5.5 0 0 1 .5-.5h4.534a.5.5 0 0 1 .5.5v2.9h5.167a.5.5 0 0 1 .5.5v29.466a.5.5 0 0 1-.5.5H.567a.5.5 0 0 1-.5-.5V3.967a.5.5 0 0 1 .5-.5h5.166v-2.9a.5.5 0 0 1 .5-.5h4.534a.5.5 0 0 1 .5.5v2.9zm-1 2.266V1.067H6.733v4.666h3.534zm17 0V1.067h-3.534v4.666h3.534z" fill-rule="nonzero"></path></svg></use>
					</svg>
				</i>
				<a id="btnCompany" class="storefrontFaqs__description app-ua-track-event" role="button" rel="nofollow" href="#app-layer-multisolicitud" onclick="vendors_showFormContactarEmp(this, '17879', false, null, 62); common_teDIR('EMP_CB_FORM');" data-track-c="LeadTracking" data-track-a="a-step1" data-track-l="d-desktop+s-availability-faq" data-track-v="1" data-track-ni="0">Contact for Availability</a>
			</div>
			<div class="storefrontSummary__item storefrontSummary__item--right">
				<div class="storefrontShare app-storefront-share storefrontDrop">
					<i class="svgIcon svgIcon__share storefrontShare__icon"><svg viewBox="0 0 34 36"><path d="M24.3 7c.4.3.4 1 0 1.3-.2.2-.5.3-.7.3-.2 0-.5-.1-.7-.3L18 3.4v20.2c0 .5-.4 1-1 1s-1-.4-1-1V3.4l-4.9 4.9c-.4.4-1 .4-1.4 0-.4-.4-.4-1 0-1.4L16.3.3c.1-.1.2-.2.3-.2.1-.1.2-.1.3-.1h.1c.1 0 .2 0 .3.1.1 0 .2.1.3.2L24.3 7zm5.4 29H4.3c-2.2 0-4-1.8-4-4V16.2c0-2.2 1.8-4 4-4h5.2c.6 0 1 .4 1 1s-.4 1-1 1H4.3c-1.1 0-2 .9-2 2V32c0 1.1.9 2 2 2h25.5c1.1 0 2-.9 2-2V16.2c0-1.1-.9-2-2-2h-5.2c-.6 0-1-.4-1-1s.4-1 1-1h5.2c2.2 0 4 1.8 4 4V32c-.1 2.2-1.9 4-4.1 4z" fill-rule="nonzero"></path></svg></i>Share 
					<div class="storefrontDrop__layer storefrontDrop__layer--social dnone">
						<div class="buttons-social">
							<a rel="nofollow" data-icon-old="icon-facebook" data-icon-new="icon-facebook-grey" class="app-icon-hover" role="button" onclick="common_social_fbShare('https://www.weddingwire.ca/wedding-flowers/wedding-blossoms--e17879', 'Wedding Blossoms');">
								<i class="icon icon-facebook"></i>
							</a>
							<a rel="nofollow" data-icon-old="icon-twitter" data-icon-new="icon-twitter-grey" class="app-icon-hover" role="button" onclick="common_social_twitterShare('https://www.weddingwire.ca/wedding-flowers/wedding-blossoms--e17879', 'Wedding Blossoms', 'WeddingWireCA');">
								<i class="icon icon-twitter"></i>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="app-dual-calendar dnone" data-year="2019" data-month="9"></div>
	</div>
</div>
<div class="storefront-container">
	@include('vendor.storefront_tab_link')
</div>


@if(request()->segment(3)!='faqs' && request()->segment(3)!='photos'  && request()->segment(3)!='videos'  && request()->segment(3)!='deals' && request()->segment(3)!='map' && request()->segment(3)!='promotions')	
 <div class="wrapper">
   <div class="pure-g">
      <div class="pure-u-3-4">
         <div class="storefront-content">
            <div class="storefront-section" data-order="3">
               <p class="storefront-title-section">About {{ $data['meta_data']->meta_title }}</p>
               <div class="pure-g mt30">
                  <div class="pure-u-2-3">
                     <div class="storefront__description post">
                       <div>{!! $data['vendor']->business_description !!}</div>
                     </div>
                  </div>
                  <div class="pure-u-1-3">
                     <div class="storefrontFaqsBox">
                        <ul class="storefrontFaqsSummary">
                         @if($faq_ans_arr['fs_arr'][0])
                           <li id="minifaqs_3193" class="storefrontFaqsSummary__item">
                              <i class="icon-vendor icon-vendor-faq-flowers storefrontFaqsSummary__icon"></i>
                              
                            
                              <div class="storefrontFaqsSummary__description">

                                 <span class="storefrontFaqsSummary__title">Floral Services</span>
                                		@foreach($faq_ans_arr['fs_arr'][0] as $fs )
                                		
                                		 <div>{{ $fs->name }}</div>
                                		@endforeach
                                	                    
                              </div>
                             
                           </li>
                            @endif
                            @if($faq_ans_arr['ta_arr'][0]) 
                           <li id="minifaqs_3175" class="storefrontFaqsSummary__item">
                              <i class="icon-vendor icon-vendor-faq-check storefrontFaqsSummary__icon"></i>
                              <div class="storefrontFaqsSummary__description">
                                 <span class="storefrontFaqsSummary__title">Arrangements</span>
                                @foreach($faq_ans_arr['ta_arr'][0] as $ta )
                                		
                                		 <div>{{ $ta->name }}</div>
                                @endforeach                   
                              </div>
                           </li>
                           @endif
                           @if($faq_ans_arr['price_bridal'][0])
                           <li id="minifaqs_3186" class="storefrontFaqsSummary__item">
                              <i class="icon-vendor icon-vendor-faq-price storefrontFaqsSummary__icon"></i>
                              <div class="storefrontFaqsSummary__description">
                                 <span class="storefrontFaqsSummary__title">Bridal Bouquet Price</span>
                                 C$  {!! $faq_ans_arr['price_bridal'][0] !!}                   
                              </div>
                           </li>
                           @endif
                        </ul>
                        <a class="btnOutline btnOutline--grey btnOutline--full mt15" href="https://www.weddingwire.ca/wedding-flowers/wedding-blossoms--e17879/details">
                        More information                                        </a>
                     </div>
                  </div>
               </div>
            </div>
            <div class="storefront-section" data-order="4">
               <p class="storefront-title-section">
                  More information about {{ $data['meta_data']->meta_title }}                        
               </p>
               <ul class="storefront-faqs">
               	@if($faq_ans_arr['fd_arr'][0])
               	
                  <li class="storefront-faqs__listed border-bottom pure-g">
                     <span class="strong pure-u-4-10 pr10">
                     How would you describe the style of your floral designs? </span>
                     @foreach($faq_ans_arr['fd_arr'][0] as $fd )
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
                  
               
                 @if($faq_ans_arr['price_bridesmaid'][0])
                           <li id="minifaqs_3186" class="storefrontFaqsSummary__item">
                              <i class="icon-vendor icon-vendor-faq-price storefrontFaqsSummary__icon"></i>
                              <div class="storefrontFaqsSummary__description">
                                 <span class="storefrontFaqsSummary__title"> What is the average price for a bridesmaid bouquet?</span>
                                 C$  {!! $faq_ans_arr['price_bridesmaid'][0] !!}                   
                              </div>
                           </li>
                  @endif

                  @if($faq_ans_arr['price_boutonniere'][0])
                           <li id="minifaqs_3186" class="storefrontFaqsSummary__item">
                              <i class="icon-vendor icon-vendor-faq-price storefrontFaqsSummary__icon"></i>
                              <div class="storefrontFaqsSummary__description">
                                 <span class="storefrontFaqsSummary__title"> What is the average price for a boutonniere?</span>
                                 C$  {!! $faq_ans_arr['price_boutonniere'][0] !!}                   
                              </div>
                           </li>
                  @endif

                  @if($faq_ans_arr['price_low_tbl'][0])
                           <li id="minifaqs_3186" class="storefrontFaqsSummary__item">
                              <i class="icon-vendor icon-vendor-faq-price storefrontFaqsSummary__icon"></i>
                              <div class="storefrontFaqsSummary__description">
                                 <span class="storefrontFaqsSummary__title"> What is the average price for a low table arrangement (per arrangement)?</span>
                                 C$  {!! $faq_ans_arr['price_low_tbl'][0] !!}                   
                              </div>
                           </li>
                  @endif

                 

                  @if($faq_ans_arr['price_elevated_tbl'][0])
                           <li id="minifaqs_3186" class="storefrontFaqsSummary__item">
                              <i class="icon-vendor icon-vendor-faq-price storefrontFaqsSummary__icon"></i>
                              <div class="storefrontFaqsSummary__description">
                                 <span class="storefrontFaqsSummary__title"> What is the average price for an elevated table arrangement (per arrangement)?</span>
                                 C$  {!! $faq_ans_arr['price_elevated_tbl'][0] !!}                   
                              </div>
                           </li>
                  @endif

                  @if($faq_ans_arr['price_customer_expect'][0])
                           <li id="minifaqs_3186" class="storefrontFaqsSummary__item">
                              <i class="icon-vendor icon-vendor-faq-price storefrontFaqsSummary__icon"></i>
                              <div class="storefrontFaqsSummary__description">
                                 <span class="storefrontFaqsSummary__title"> Typically, what can a customer expect to pay for your wedding floral services? </span>
                                 C$  {!! $faq_ans_arr['price_customer_expect'][0] !!}                   
                              </div>
                           </li>
                  @endif
                 
                 
                  @if($faq_ans_arr['cost_fd_arr'][0])
                  <li class="storefront-faqs__listed border-bottom pure-g">
                     <span class="strong pure-u-4-10 pr10">
                     Which of the following are included in the cost of your floral services?</span>
                       @foreach($faq_ans_arr['cost_fd_arr'][0] as $cfs )
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
                  </li>
                  @endif
               </ul>
            </div>
                              
           
         </div>
      </div>
    </div>
   @if($data['vendor']->promotion_data->promotion_amount && $data['vendor']->promotion_data->wedding_offer!=1)

      <div class="pure-u-3-4">
	   <div class="storefront-section" data-order="10">
	   <p class="storefront-title-section">
	      Promotions from {{ $data['meta_data']->meta_title }}                       
	   </p>
	   <ul class="pure-g-r row">
	      <li class="pure-u-1-3">
	         <div class="vendorPromoCard app-promo-item app-link" data-href="https://www.weddingwire.ca/wedding-flowers/wedding-blossoms--e17879/promotions/10-discount-for-weddingwire-couples--pr49167">
	            <figure class="vendorPromoCard__cover">
	               <div class="img-zoom">
	               
	               	@if($data['vendor']->image_data[0]->is_logo==1)
	                  <img src="{{ asset('vendors/'.$data['vendor']->image_data[0]->vendor_folder.'/'.$data['vendor']->image_data[0]->image)}}" alt="Wedding Blossoms">
	                @endif  
	               </div>
	               <div class="vendor-promo-badge  promo-badge-exclusive">
	                  <span>{{ '-'.$data['vendor']->promotion_data->promotion_amount.'%' }}</span>
	               </div>
	            </figure>
	            <div class="vendorPromoCard__content">
	               <span class="title-promo promo-exclusive">Exclusive</span>
	               <a class="vendorPromoCard__title app-promo-item-link" href="#">
	               {{$data['vendor']->promotion_data->promotion_amount}}% discount for {{ env('APP_NAME') }} couples</a>
	               <p class="vendorPromoCard__description">If you found us on {{ env('APP_NAME') }} we will give you a {{$data['vendor']->promotion_data->promotion_amount}}% discount on our services. Remember to show us your voucher when you come see us.</p>
	            </div>
	            <div class="vendorPromoCard__footer">
	               <small class="vendorPromoCard__date">
	               <i class="icon-vendor icon-vendor-clock-small"></i>
	               Permanent deal</small>
	            </div>
	         </div>
	      </li>
	    </ul>
	 </div>
   @endif

   <div class="storefront-section" data-order="14">
   <p class="storefront-title-section">Location of {{ $data['meta_data']->meta_title }}</p>
   <meta itemprop="latitude" content="43.7223">
   <meta itemprop="longitude" content="-79.4674">
   <div id="gmap"  data-id-empresa="17879" style="height: 480px;">
      
      
   </div>
  <!--  <div class="storefront-meta-tags">
      <div class="storefront-meta-tags">
         <a class="tag" href="https://www.weddingwire.ca/wedding-vendors/ontario/toronto">Wedding Vendors Toronto</a>
         <a class="tag" href="https://www.weddingwire.ca/wedding-flowers/ontario/toronto">Wedding Flowers Toronto</a>
      </div>
   </div> -->
</div>
</div>
 <!-- contect form geos here -->
      		@include('vendor.storefront_contact_form')
      		<!-- end contact form -->
 </div>     		
@endif

<!-- FAQS DETAILS -->
@if(request()->segment(3)=='faqs')
<div class="wrapper">
	<div class="pure-u-3-4">
  		 <div class="storefront-section" data-order="3">
               <p class="storefront-title-section">About {{ $data['meta_data']->meta_title }}</p>
               <div class="pure-g mt30">
                  <div class="pure-u-2-3">
                     <div class="storefront__description post">
                       <div>{!! $data['vendor']->business_description !!}</div>
                     </div>
                  </div>
                  <div class="pure-u-1-3">
                     <div class="storefrontFaqsBox">
                        <ul class="storefrontFaqsSummary">
                         @if($faq_ans_arr['fs_arr'][0])
                           <li id="minifaqs_3193" class="storefrontFaqsSummary__item">
                              <i class="icon-vendor icon-vendor-faq-flowers storefrontFaqsSummary__icon"></i>
                              
                            
                              <div class="storefrontFaqsSummary__description">

                                 <span class="storefrontFaqsSummary__title">Floral Services</span>
                                		@foreach($faq_ans_arr['fs_arr'][0] as $fs )
                                		
                                		 <div>{{ $fs->name }}</div>
                                		@endforeach
                                	                    
                              </div>
                             
                           </li>
                            @endif
                            @if($faq_ans_arr['ta_arr'][0]) 
                           <li id="minifaqs_3175" class="storefrontFaqsSummary__item">
                              <i class="icon-vendor icon-vendor-faq-check storefrontFaqsSummary__icon"></i>
                              <div class="storefrontFaqsSummary__description">
                                 <span class="storefrontFaqsSummary__title">Arrangements</span>
                                @foreach($faq_ans_arr['ta_arr'][0] as $ta )
                                		
                                		 <div>{{ $ta->name }}</div>
                                @endforeach                   
                              </div>
                           </li>
                           @endif
                           @if($faq_ans_arr['price_bridal'][0])
                           <li id="minifaqs_3186" class="storefrontFaqsSummary__item">
                              <i class="icon-vendor icon-vendor-faq-price storefrontFaqsSummary__icon"></i>
                              <div class="storefrontFaqsSummary__description">
                                 <span class="storefrontFaqsSummary__title">Bridal Bouquet Price</span>
                                 C$  {!! $faq_ans_arr['price_bridal'][0] !!}                   
                              </div>
                           </li>
                           @endif
                        </ul>
                       
                     </div>
                  </div>
               </div>
            </div>
            <div class="storefront-section" data-order="4">
               
               <ul class="storefront-faqs">
               	@if($faq_ans_arr['fd_arr'][0])
               	
                  <li class="storefront-faqs__listed border-bottom pure-g">
                     <span class="strong pure-u-4-10 pr10">
                     How would you describe the style of your floral designs? </span>
                     @foreach($faq_ans_arr['fd_arr'][0] as $fd )
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
                  
               
                 @if($faq_ans_arr['price_bridesmaid'][0])
                           <li id="minifaqs_3186" class="storefrontFaqsSummary__item">
                              <i class="icon-vendor icon-vendor-faq-price storefrontFaqsSummary__icon"></i>
                              <div class="storefrontFaqsSummary__description">
                                 <span class="storefrontFaqsSummary__title"> What is the average price for a bridesmaid bouquet?</span>
                                 C$  {!! $faq_ans_arr['price_bridesmaid'][0] !!}                   
                              </div>
                           </li>
                  @endif

                  @if($faq_ans_arr['price_boutonniere'][0])
                           <li id="minifaqs_3186" class="storefrontFaqsSummary__item">
                              <i class="icon-vendor icon-vendor-faq-price storefrontFaqsSummary__icon"></i>
                              <div class="storefrontFaqsSummary__description">
                                 <span class="storefrontFaqsSummary__title"> What is the average price for a boutonniere?</span>
                                 C$  {!! $faq_ans_arr['price_boutonniere'][0] !!}                   
                              </div>
                           </li>
                  @endif

                  @if($faq_ans_arr['price_low_tbl'][0])
                           <li id="minifaqs_3186" class="storefrontFaqsSummary__item">
                              <i class="icon-vendor icon-vendor-faq-price storefrontFaqsSummary__icon"></i>
                              <div class="storefrontFaqsSummary__description">
                                 <span class="storefrontFaqsSummary__title"> What is the average price for a low table arrangement (per arrangement)?</span>
                                 C$  {!! $faq_ans_arr['price_low_tbl'][0] !!}                   
                              </div>
                           </li>
                  @endif

                 

                  @if($faq_ans_arr['price_elevated_tbl'][0])
                           <li id="minifaqs_3186" class="storefrontFaqsSummary__item">
                              <i class="icon-vendor icon-vendor-faq-price storefrontFaqsSummary__icon"></i>
                              <div class="storefrontFaqsSummary__description">
                                 <span class="storefrontFaqsSummary__title"> What is the average price for an elevated table arrangement (per arrangement)?</span>
                                 C$  {!! $faq_ans_arr['price_elevated_tbl'][0] !!}                   
                              </div>
                           </li>
                  @endif

                  @if($faq_ans_arr['price_customer_expect'][0])
                           <li id="minifaqs_3186" class="storefrontFaqsSummary__item">
                              <i class="icon-vendor icon-vendor-faq-price storefrontFaqsSummary__icon"></i>
                              <div class="storefrontFaqsSummary__description">
                                 <span class="storefrontFaqsSummary__title"> Typically, what can a customer expect to pay for your wedding floral services? </span>
                                 C$  {!! $faq_ans_arr['price_customer_expect'][0] !!}                   
                              </div>
                           </li>
                  @endif
                 
                 
                  @if($faq_ans_arr['cost_fd_arr'][0])
                  <li class="storefront-faqs__listed border-bottom pure-g">
                     <span class="strong pure-u-4-10 pr10">
                     Which of the following are included in the cost of your floral services?</span>
                       @foreach($faq_ans_arr['cost_fd_arr'][0] as $cfs )
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
                  </li>
                  @endif
               </ul>
            </div>
           </div> 
            <!-- contect form geos here -->
      		@include('vendor.storefront_contact_form')
      		<!-- end contact form -->
      </div>		
@endif
<!-- FAQS DETAILS -->

<!-- PHOTOS -->
@if(request()->segment(3)=='photos')
 <div class="storefront-section storefront-section-noBorder">
         <h1 class="app-slider-title storefront-title-section">{{ $data['meta_data']->meta_title }}</h1>

      </div>
  <!-- Swiper -->

  <div class="swiper-container">
   			<div class="swiper-wrapper">
      
    	@foreach($data['vendor']->image_data as $key=>$photo)

    	<div class="swiper-slide">
	        <!-- Required swiper-lazy class and image source specified in data-src attribute -->
	        <img data-src="{{ asset('vendors/'.$photo->vendor_folder.'/'.$photo->image) }}" class="swiper-lazy">
	        <!-- Preloader image -->
	        <div class="swiper-lazy-preloader swiper-lazy-preloader-white"></div>
      </div>
    	@endforeach
      
      </div>
    <!-- Add Pagination -->
    <div class="swiper-pagination swiper-pagination-white"></div>
    <!-- Navigation -->
    <div class="swiper-button-next swiper-button-white"></div>
    <div class="swiper-button-prev swiper-button-white"></div>
  </div>
<div class="wrapper">
	<div class="pure-u-3-4">
      <div class="storefront-content">
      
            <div class="dnone app-lead-slide adw-slider-lead app-slider-lead-hover">
               <div class="adw-slider-lead-center">
                  <p>Did you like this vendor?</p>
                  <a class="btn btn-primary app_lnkEsc_ app-ua-track-event" href="javascript:void(0)" onclick="vendors_showFormContactarEmp(this, 17879, null, true, 44);" data-track-c="LeadTracking" data-track-a="a-step1" data-track-l="d-desktop+s-profile_slider" data-track-v="1" data-track-ni="0" data-track-cds="{&quot;dimension15&quot;:&quot;17879&quot;,&quot;dimension17&quot;:&quot;44&quot;}">
                  Request pricing                                            </a>
               </div>
           
      </div>
      <p class="storefront-subtitle">Photo Gallery of {{ $data['meta_data']->meta_title }}</p>
      <div class="storefront-gallery-thumbs">
         <ul class="pure-g">
         	@if(count($data['vendor']->image_data)>0)
         	  @foreach($data['vendor']->image_data as $photo)
	            <li class="pure-u-1-6 item">
	               <div class="storefront-gallery-thumbs-item">
	                  <a href="{{ asset('vendors/'.$photo->vendor_folder.'/'.$photo->image) }}" title="Colour of Wedding Blossoms">
	                 
	                   <img src="{{ asset('vendors/'.$photo->vendor_folder.'/'.$photo->image) }}" alt="" height="88" width="133">
	                  </a>
	               </div>
	            </li>
	           @endforeach 
            @endif
           
         </ul>
      </div>
   </div>
   <!-- contect form geos here -->
      	@include('vendor.storefront_contact_form')
      <!-- end contact form -->
   </div>
</div>
@endif
<!-- END PHOTOS-->

<!-- VIDEOS -->
@if(request()->segment(3)=='videos')
<div class="wrapper">

 <div class="pure-u-3-4">
   <div class="storefront-content">
      <div class="storefront-section storefront-section-noBorder">
         <h1 class="app-slider-title storefront-title-section">{{ $data['vendor']->videos[0]->title?$data['vendor']->videos[0]->title:'' }}</h1>
         <div class="mb10 storefront-video-subtitle app-slider-description">
            <p> {{ $data['vendor']->videos[0]->description?$data['vendor']->videos[0]->description:'' }}</p>
         </div>


         <div class="storefront-slider" id="app-vendor-slider-box" style="width: 400px">
          
          
         </div>
      </div>
   </div>
</div>
<!-- contect form geos here -->
      	@include('vendor.storefront_contact_form')
      <!-- end contact form -->
</div>
@endif
<!-- END VIDEOS -->

<!-- DEALS  -->
@if(request()->segment(3)=='deals')
   <div class="wrapper">
	 @if($data['vendor']->promotion_data->promotion_amount && $data['vendor']->promotion_data->wedding_offer!=1)
	   <div class="storefront-section" data-order="10">
	   <p class="storefront-title-section">
	      Promotions from {{ $data['meta_data']->meta_title }}                        
	   </p>
	   <ul class="pure-g-r row">
	      <li class="pure-u-1-3">
	         <div class="vendorPromoCard app-promo-item app-link" data-href="https://www.weddingwire.ca/wedding-flowers/wedding-blossoms--e17879/promotions/10-discount-for-weddingwire-couples--pr49167">
	            <figure class="vendorPromoCard__cover">
	               <div class="img-zoom">
	               
	               	@if($data['vendor']->image_data[0]->is_logo==1)
	                  <img src="{{ asset('vendors/'.$data['vendor']->image_data[0]->vendor_folder.'/'.$data['vendor']->image_data[0]->image)}}" alt="Wedding Blossoms">
	                @endif  
	               </div>
	               <div class="vendor-promo-badge  promo-badge-exclusive">
	                  <span>{{ '-'.$data['vendor']->promotion_data->promotion_amount.'%' }}</span>
	               </div>
	            </figure>
	            <div class="vendorPromoCard__content">
	               <span class="title-promo promo-exclusive">Exclusive</span>
	               <a class="vendorPromoCard__title app-promo-item-link" href="#">
	               {{$data['vendor']->promotion_data->promotion_amount}}% discount for {{ env('APP_NAME')}} couples</a>
	               <p class="vendorPromoCard__description">If you found us on {{ env('APP_NAME')}} we will give you a {{$data['vendor']->promotion_data->promotion_amount}}% discount on our services. Remember to show us your voucher when you come see us.</p>
	            </div>
	            <div class="vendorPromoCard__footer">
	               <small class="vendorPromoCard__date">
	               <i class="icon-vendor icon-vendor-clock-small"></i>
	               Permanent deal</small>
	            </div>
	         </div>
	      </li>
	    </ul>
	 </div>

   @endif
   <!-- contect form geos here -->
      	@include('vendor.storefront_contact_form')
      <!-- end contact form -->
  </div>
@endif
<!-- END DEALS -->

<!-- MAP -->

@if(request()->segment(3)=='map')
<div class="wrapper">
  <div class="pure-u-3-4">
   <div class="storefront-content">
      <p class="storefront-title-section">
         Location of ({{ $data['meta_data']->meta_title }})
      </p>
      @if(count($data['vendor_map'])>0)
        <ul class="storefrontAddresses">
          @foreach($data['vendor_map'] as $key=>$loc)	

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
               	<span class="app-static-map-box-open link--primary storefrontAddresses__show"  >See On Map</span></a>
               </div>
            </div>
            <input type="hidden" name="latitude" id="latitude_{{$loc->id}}" value="{{$loc->latitude}}">
			<input type="hidden" name="longitude" id="longitude_{{$loc->id}}" value="{{$loc->longitude}}">
			<input type="hidden" name="address" id="address_{{$loc->id}}" value="{{$loc->address.' '.$loc->city.', '.$loc->state.' '.$loc->postal_code }}">
            <div id="gmap_{{ $loc->id }}" class="app-show-map-vendor-custom app-static-map-container " style="{{$key==0?'height: 180px;display:block':'height: 180px;display:none' }}" >
                          
            </div>
         </li>
         @endforeach
        
         
      </ul>
       @endif
   </div>
   <!-- contect form geos here -->
      	@include('vendor.storefront_contact_form')
      <!-- end contact form -->
  </div>
</div>
@endif
<!-- END MAP -->

<!-- PROMOTION DETAILS -->
@if(request()->segment(3)=='promotions')
<div class="wrapper">
   <div id="contact-emp-layer"></div>
   <div class="pure-g">
      <div class="pure-u-3-4">
         <div class="storefront-content">
            <p class="storefront-title-section">Discount {{ env('APP_NAME')}}</p>
            <div class="box">
               <div class="unit-primary storefront-promo-content">
                  <div class="pure-u-3-4">
                     <h1 class="storefront-promo-title">{{ $data['vendor']->promotion_data->promotion_amount }}% discount for {{ env('APP_NAME')}} couples</h1>
                  </div>
                  <i class="icon-vendor icon-vendor-promo-exclusive fright"></i>
                  <p>If you found us on {{ env('APP_NAME')}} we will give you a {{ $data['vendor']->promotion_data->promotion_amount }}% discount on our services. Remember to show us your voucher when you come see us.</p>
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
               		@if($data['vendor']->image_data[0]->is_logo==1)
	                  <img src="{{ asset('vendors/'.$data['vendor']->image_data[0]->vendor_folder.'/'.$data['vendor']->image_data[0]->image)}}" alt="Wedding Blossoms">
	                @endif  
                 
               </div>
            </div>
         </div>
      </div>
      <!-- contect form geos here -->
      	@include('vendor.storefront_contact_form')
      <!-- end contact form -->
   </div>
</div>
@endif
<!-- PROMOTION DETAILS -->

</div>
@include('includes.footer')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
@if(count(request()->segments())==2)
	<script async defer src="https://maps.googleapis.com/maps/api/js?key={{ env('GMAP_API_KEY')}}&callback=initialize"></script>
@endif	
@if(request()->segment(3)=='map')
<script async defer src="https://maps.googleapis.com/maps/api/js?key={{ env('GMAP_API_KEY')}}"></script>
@endif
<script>

	$(document).ready(function(){
		setTimeout(function() {
			$("#seeonmap_0").trigger('click');
		},200);
		$(document).on("click", ".see-map, #seeonmap_0", function(e) {
		       // e.preventDefault();
		     
		        //$('.app-list-item-content').hide();
		        $('.app-show-map-vendor-custom').hide();
		        $("#gmap_"+mid).addClass("open");
				
				var mid = $(this).data('loc-id');
											
		   		$("#gmap_"+mid).css("display","block");

		    
		    	 setTimeout(function() {
			    		map_initialize(mid,$("#latitude_"+mid).val(),$("#longitude_"+mid).val(),$("#address_"+mid).val());
			   	}, 500);
        
         });

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

	function initialize() {
    
      var lat="{{ $data['vendor']->location[0]->latitude?$data['vendor']->location[0]->latitude:'' }}";
      var lng="{{ $data['vendor']->location[0]->longitude?$data['vendor']->location[0]->longitude:'' }}";
      var address="{{ $data['vendor']->location[0]->address?$data['vendor']->location[0]->address:'' }}";
      
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
</script>
<!-- Swiper JS -->
<script type="text/javascript" src="{{ asset('js/swiper.min.js') }}"></script>
  <!-- Initialize Swiper -->
  <script type="text/javascript">
    var swiper = new Swiper('.swiper-container', {
      // Enable lazy loading
      slidesPerView: 3,
      spaceBetween: 0,
      centeredSlides: true,
      lazy: true,
     /* pagination: {
        el: '.swiper-pagination',
        clickable: false,
      },*/
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },

    });
  </script>
@endsection