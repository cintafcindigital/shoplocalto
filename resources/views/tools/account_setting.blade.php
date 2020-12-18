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
            <div class="pure-s mt5">
                <p class="tools-subtitle">Settings</p>
                <ul class="tools-filters">   
                    <li class="tools-filters-item">
                        <a class="tools-filters-item-name" href="{{url('user-settings')}}">User profile</a>
                    </li>
                    <li class="tools-filters-item current">
                        <a class="tools-filters-item-name" href="{{url('account-settings')}}">Account settings</a>
                    </li>   
                </ul>
            </div>
        </div>
        <div class="pure-u-4-5">
            <div class="profile-header">
                <span class="tools-title">Account settings</span>
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
            <div class="pure-g">
              <div class="pure-u-1-2 pr20">
                  <div class="app-scroll-password profile-box profile-box-double">
                      <p class="profile-box-header">Your password</p>
                      <div class="profile-box-content">
                          <div class="app-community-password-change-div">
                             
                              <form method="post" action="{{url('save-account-settings')}}">
                                  {{csrf_field()}}
                                   <span class="input-group-line-label">Current Password</span>
                                  <div class="input-group-line">
                                      <input type="password" name="current_password" size="30" maxlength="40" value="" autocomplete="off" placeholder="Enter the CURRENT password" data-msgerror="The password must have at least six characters.">
                                      @if($errors->has('current_password'))
                                         <span class="custom-error">{{$errors->first('current_password')}}</span>
                                      @endif
                                  </div>
                                  <span class="input-group-line-label">Password</span>
                                  <div class="input-group-line">
                                      <input type="password" name="password" size="30" maxlength="40" value="{{old('password')}}" autocomplete="off" placeholder="Enter the NEW password" data-msgerror="The password must have at least six characters.">
                                      @if($errors->has('password'))
                                         <span class="custom-error">{{$errors->first('password')}}</span>
                                      @endif
                                  </div>
                                  <span class="input-group-line-label">Re-enter password</span>
                                  <div class="input-group-line">
                                      <input type="password" name="password_confirmation" size="30" maxlength="40" value="{{old('password_confirmation')}}" autocomplete="off" placeholder="Retype the NEW password" data-msgerror="The new password does not match.">
                                       @if($errors->has('password_confirmation'))
                                         <span class="custom-error">{{$errors->first('password_confirmation')}}</span>
                                      @endif
                                      <br>
                                  </div>
                                  <button type="submit" class="btn-outline outline-red" onclick="community_user_change_password(this.form)">
                                   Change password </button>
                              </form>
                          </div>
                      </div>
                  </div>
              </div>
              @php  $isVerify =  \Auth::user()->verify; @endphp
              <div class="pure-u-1-2 pl20 @if($isVerify) hide @endif hide">
                  <div class="app-scroll-password profile-box profile-box-double">
                      <p class="profile-box-header">Verify Account</p>
                      <div class="profile-box-content">
                          <div class="app-community-password-change-div">
                             <p id="opcionBaja">
                                <span>To unlock all of the features of perfect wedding day you must verify your email address. Please check your email for a verification link.</span>
                                <a href="{{url('send-verify-link')}}"><span class="app-community-baja-link link pointer">Resend Link</span></a>
                            </p>
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
