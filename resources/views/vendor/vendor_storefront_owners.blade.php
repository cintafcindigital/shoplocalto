@extends('layouts.default')
@section('meta_title',$data['titleData']->meta_title)
@section('meta_keyword',$data['titleData']->meta_keyword)
@section('meta_description',$data['titleData']->meta_description)
@section('content')
@include('includes.menu')
<section class="section-padding dashboard-wrap storefront_main_sect dash_main_sect">
   @include('vendor.tools_nav')
   <div class="wrapper">
	   <div class="pure-g">
	       <!-- Left navigation -->
	     	@include('vendor.nav_links')
	      <!-- end left navigation -->
	      <div class="pure-u-5-7">
	         <h1 class="adminTitle">Meet the Team</h1>
	         <div class="adminAlert adminAlert--flex storefront_alert">
	            <i class="icon-vendors-admin-alerts icon-vendors-admin-alerts-owners"></i>
	            <div>
	               <p class="adminAlert__title">Introduce your team to clients and patients</p>
	               <p>
	                  Clients and patients love meeting the people who makes a difference for their health! Help them get to know your business and the personalities behind it by adding a short bio and photo of each team member to your Profile.                   
	               </p>
	            </div>
	         </div>
	         <div class="adminEmpty app-incomplete">
	            <i class="adminEmpty__icon adminEmpty__icon--owners"></i>
	            <p class="adminEmpty__description">Showcase your Health Squad on your Profile</p>
	            <a class="btnFlat btnFlat--primary" href="{{url('ownersnew')}}">Add Team Member</a>
	         </div>

            @if(count($data['team_members'])>0)
	         <ul class="row adminOwners ui-sortable">
	         	@foreach($data['team_members'] as $tm)
   				<li class="adminOwners__flexSize" data-order="1" data-id="{{ $tm->id }}">
      			  <div class="adminOwners__item">
			         <figure class="adminOwners__figure">

			         	@if(file_exists(public_path('vendors/VENDOR_'.$tm->vendor_id.'/'.$tm->photo)) && $tm->photo!='')
			           	  <img class="adminOwners__img" width="150" height="150" src="{{ asset('vendors/VENDOR_'.$tm->vendor_id.'/'.$tm->photo)}}">
			           	@endif 
			            <div class="adminOwners__actions">
			               <!--<span class="tag tag-orange">{{$tm->status}}</span>-->
			            </div>
			         </figure>
			         <div class="adminOwners__content">
			            <div class="adminOwners__name">
			               {{ $tm->firstname }} {{ isset($tm->lastname)?$tm->lastname:'' }}       
			            </div>
			         </div>
			         <footer class="adminOwners__footer">
			            <a class="adminOwners__edit" href="{{ url('ownersedit/'.$tm->id)}}">
			           <i class="fa fa-pencil" aria-hidden="true"></i>Edit</a>
			         </footer>
			      </div>
               </li>
               @endforeach
			</ul>
			@endif
	      </div>
	   </div>
	</div>
</section>
@include('includes.footer')
@endsection