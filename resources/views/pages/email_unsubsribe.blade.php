@extends('layouts.default')
@section('content')
@section('meta_title',isset($pageData->meta_title)?$pageData->meta_title:'E-mail Unsubscribe')
@section('meta_keyword',isset($pageData->meta_keyword)?$pageData->meta_keyword:'')
@section('meta_description',isset($pageData->meta_description)?$pageData->meta_description:'')
@include('includes.menu')
        <!-- ABOUT SECTION START-->
        <section class="section-padding">
            <div class="container">
                <div class="forgot-pass-col text-center" style="padding-bottom: 20px;"> 
                    @if($status)
                    <h3 class="text-success">Successfully unsubscribed your email address.</h3>
                    @else
                    <h3 class="text-danger">Something went wrong. Please try again later</h3>
                    @endif
                    <br>
                    <a href="{{url('/')}}" class="btnFlat">Go To Home</a>
                </div>
            </div>
        </section>
        <!-- / END ABOUT SECTION-->
       @include('includes.footer')
@endsection    