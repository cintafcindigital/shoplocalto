@extends('layouts.default')
@section('meta_title',$pageData->meta_title)
@section('meta_keyword',$pageData->meta_keyword)
@section('meta_description',$pageData->meta_description)
@section('content')
@include('includes.menu')
<section id="about-section">
   <div class="body-mw-font">
      <?php
         $styls = '';
         if(@$data->header_image) {
            $styls = 'background: url(/public/planning_tools_images/'.$data->header_image.') no-repeat scroll 50% 50%;background-size: auto auto;background-size: cover;';
         } else {
            $styls = 'background: url(/public/planning_tools_images/bg_headerMain_8.jpg) no-repeat scroll 50% 50%;background-size: auto auto;background-size: cover;';
         }
      ?>
      <div class="landing-user-header checklist" style="{{$styls}}">
         <!-- <div class="landing-user-breadcrumb">
            <div class="wrapper pt0 pb0">
               <ul class="breadcrumb">
                  <li><a href="https://www.weddingwire.ca/">Weddings</a></li>
                  <li><a href="https://www.weddingwire.ca/my-wedding-planner">Wedding Planning</a></li>
                  <li><span>Checklist</span></li>
               </ul>
            </div>
         </div> -->
         <div class="wrapper text-center">
            <h1 class="landing-user-header__title testing-lp-title-CheckList">{{$data->title}}</h1>
            <p class="landing-user-header__subtitle">{{$data->sub_title}}</p>
            <hr class="landing-user-header__separator">
            <p class="landing-user-header__text">{{$data->description}}</p>
            <div class="mt15">
               @if($data->btn_title)
                  <a class="btn-flat btn-flat--hero red" href="{{ url('/register') }}">{{$data->btn_title}}</a>
               @else
                  <a class="btn-flat btn-flat--hero red" href="{{ url('/register') }}"> Sign up </a>
               @endif
            </div>
         </div>
      </div>
      @if($data->slug != 'planning-tools-page')
      <div class="landing-user-nav border-bottom">
         <ul class="pure-g wrapper">
            <li class="pure-u-1-10">
               <a class="landing-user-nav__item @if($data->slug == 'planning-tools-page') active @endif" href="{{url('website').'/planning-tools-page'}}">
                  <span class="icon-tools icon-tools-nav-dash block mb10"></span> Planning Tools
               </a>
            </li>
            <li class="pure-u-1-10">
               <a class="landing-user-nav__item @if($data->slug == 'checklist-page') active @endif" href="{{url('website').'/checklist-page'}}">
                  <span class="icon-tools icon-tools-nav-checklist block mb10"></span> Checklist
               </a>
            </li>
            <li class="pure-u-1-10">
               <a class="landing-user-nav__item @if($data->slug == 'guest-list-page') active @endif" href="{{url('website').'/guest-list-page'}}">
                  <span class="icon-tools icon-tools-nav-guests block mb10"></span> Guests
               </a>
            </li>
            <li class="pure-u-1-10">
               <a class="landing-user-nav__item @if($data->slug == 'seating-chart-page') active @endif" href="{{url('website').'/seating-chart-page'}}">
                  <span class="icon-tools icon-tools-nav-tables block mb10"></span> Seating Chart
               </a>
            </li>
            <li class="pure-u-1-10">
               <a class="landing-user-nav__item @if($data->slug == 'budget-page') active @endif" href="{{url('website').'/budget-page'}}">
                  <span class="icon-tools icon-tools-nav-budget block mb10"></span> Budget
               </a>
            </li>
            <li class="pure-u-1-10">
               <a class="landing-user-nav__item @if($data->slug == 'vendor-manager-page') active @endif" href="{{url('website').'/vendor-manager-page'}}">
                  <span class="icon-tools icon-tools-nav-vendors block mb10"></span> Vendors
               </a>
            </li>
            <li class="pure-u-1-10">
               <a class="landing-user-nav__item @if($data->slug == 'wedding-website-page') active @endif" href="{{url('website').'/wedding-website-page'}}">
                  <span class="icon-tools icon-tools-nav-wedsite block mb10"></span> Wedding Website
               </a>
            </li>
            <li class="pure-u-1-10">
               <a class="landing-user-nav__item @if($data->slug == 'dresses-page') active @endif" href="{{url('website').'/dresses-page'}}">
                  <span class="icon-tools icon-tools-nav-dresses block mb10"></span> Dresses
               </a>
            </li>
            <li class="pure-u-1-10">
               <a class="landing-user-nav__item @if($data->slug == 'community-page') active @endif" href="{{url('website').'/community-page'}}">
                  <span class="icon-tools icon-tools-nav-community block mb10"></span> Community
               </a>
            </li>
         </ul>
      </div>
      @endif
      <!-- page content goes here -->
      <?php /** <div class="border-bottom">
         {!! nl2br($data->contents) !!}
      </div> **/ ?>
      @include('landing_pages.'.$data->slug)
   </div>
</section>
@include('includes.footer')
@endsection