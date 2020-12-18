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
	         <h1 class="adminTitle">Events</h1>
	         <div class="adminAlert adminAlert--flex">
	            <i class="icon-vendors-admin-alerts icon-vendors-admin-alerts-events"></i>
	            <div>
	               <p><strong>Add details about upcoming events you are hosting!</strong> <br>Events encourage potential clients to attend and learn more about your business.</p>
	            </div>
	         </div>
	         <div class="adminEmpty app-incomplete">
	            <i class="adminEmpty__icon adminEmpty__icon--events"></i>
	            <p class="adminEmpty__title"><strong>Add your first event</strong></p>
	            <p class="adminEmpty__description">Attract clients and patients by showcasing your services</p>
	            <a class="btnFlat btnFlat--primary add_events_btn" href="{{url('eventsnew')}}">Add Event</a>
	         </div>
	         @if(count($data['vendor_events'])>0)
			     <ul class="adminEvent">
			     	@foreach($data['vendor_events'] as $event)

		              <li class="adminEvent__item" id="{{ $event->id }}">
			              <div class="pure-g">
			               <div class="pure-u-1-8 pr25">
					            <span class="adminEvent__calendar">
					            <span class="adminEvent__day">{{ date('d',strtotime($event->event_start_date))}}<span class="adminEvent__month">
					            {{ date('M',strtotime($event->event_start_date))}}</span></span>
					            </span>
					            <span class="adminEvent__tag adminEvent__tag--pending">{{ $event->status }}</span>
				         	</div>
				         <div class="pure-u-6-7">
				            <span class="adminEvent__category">{{ $event->event_type }}</span>
				            <a class="adminEvent__title" title="Edit"  href="{{ url('eventsedit/'.$event->id) }}">
				            {{ $event->event_name }} </a>
				            <time class="adminEvent__date">{{ 'From '.date('d/m/Y',strtotime($event->event_start_date)).' to '.date('d/m/Y',strtotime($event->event_end_date)) }}</time>
				            <a href="{{ url('eventsedit/'.$event->id) }}" class="adminEvent__edit btnOutline btnOutline--primary">
				            Edit                                        </a>
				            <p class="adminEvent__description"></p>
				         </div>
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