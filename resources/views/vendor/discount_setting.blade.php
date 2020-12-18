@extends('layouts.default')
@section('meta_title',$data['titleData']->meta_title)
@section('meta_keyword',$data['titleData']->meta_keyword)
@section('meta_description',$data['titleData']->meta_description)
@section('content')
@include('includes.menu')
 <link rel="stylesheet" href="{{URL::asset('public/css/vendor.css')}}">
 <style>.input-group-line input:checked+span {
    background-position: inherit;
}</style>
  <section class="section-padding dashboard-wrap dash_main_sect">
     @include('vendor.tools_nav');
  <div class="wrapper">
    <div class="pure-g">
        <div class="pure-u-1-5">
            <div class="pure-s mt5">
                <p class="tools-subtitle">Discounts</p>
                <ul class="tools-filters">   
                    <li class="tools-filters-item">
                        <a class="tools-filters-item-name" href="{{url('vendor-settings')}}">My profile</a>
                    </li>
                    <li class="tools-filters-item">
                        <a class="tools-filters-item-name" href="{{url('image-settings')}}">Images</a>
                    </li>
                    <li class="tools-filters-item">
                        <a class="tools-filters-item-name" href="{{url('question-settings')}}">Frequently Questions</a>
                    </li>
                    <li class="tools-filters-item current">
                        <a class="tools-filters-item-name" href="{{url('discount-settings')}}">Discounts / Offers</a>
                    </li>
                    <li class="tools-filters-item">
                        <a class="tools-filters-item-name" href="{{url('account-settings')}}">Account settings</a>
                    </li>   
                </ul>
            </div>
        </div>
        <div class="pure-u-4-5">
            <div class="profile-header">
                <span class="tools-title">Discount settings</span>
            </div>
             @if(session()->has('success'))
              <div class="app-success-box alert alert-success">
                {{session()->get('success')}}
              </div>
            @endif
            @if(session()->has('error'))
              <div class="app-danger-box alert alert-danger">
               {{session()->get('error')}}
              </div>
            @endif
            @if (count($errors) > 0)
              <div class="alert alert-danger">
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
              @endif
            <div class="pure-g">
              <div class="pure-u-1-2 pr20">
                  <div class="app-scroll-password profile-box profile-box-double">
                      <p class="profile-box-header">Discount Settings</p>
                      <div class="profile-box-content">
                          <div class="app-community-password-change-div">
                              <form method="post" action="{{url('save-discount-settings')}}">
                                  {{csrf_field()}}
                                   <span class="input-group-line-label">Current Offer (%)</span>
                                  <div class="input-group-line">
                                      <input type="text" name="promotion_amount" value="{{ $data['offer']->promotion_amount ?? ''}}" autocomplete="off" placeholder="Enter the offer (%)">
                                      @if($errors->has('promotion_amount'))
                                         <span class="custom-error">{{$errors->first('promotion_amount')}}</span>
                                      @endif
                                  </div>
                                  <div class="input-group-line">
                                       <label for="check413" class="checkbox" style="font-size:12px;font-weight: 400;">
                                          <input type="checkbox" name="offer_wedding" class="check" id="check413" value="1" @if($data['offer']->offer_wedding) checked="checked" @endif>
                                          I do not want to offer a discount to Perfect Wedding Day couples.
                                          <span class="checkmark"></span>
                                      </label>
                                  </div>
                                  <input type="hidden" name="promotion_id" value="{{$data['offer']->id}}">
                                  <button type="submit" class="btn-outline outline-red" onclick="community_user_change_password(this.form)">
                                   Save Changes </button>
                              </form>
                          </div>
                      </div>
                  </div>
              </div>
             
            </div>
          
        </div>
    </div>
  </div>
</section>

  @include('includes.footer')
@endsection       
