@extends('layouts.default')
@section('meta_title',$pageData->meta_title)
@section('meta_keyword',$pageData->meta_keyword)
@section('meta_description',$pageData->meta_description)
@section('content')
@include('includes.menu')
@include('includes.inner-slider')

        <!-- ABOUT SECTION START-->
        <section class="section-padding">
            <div class="container">
                <div class="login-col"> 
                    <div class="row">
                        <div class="col-md-5 col-sm-5 login-left hidden-xs">
                            <img src="{{URL::asset('public/images/login-health.jpg')}}" alt="Wedding Image">
                        </div>
                        <div class="col-md-7 col-sm-7 login-right">
                            <div class="login-content">
                                <h3>Login to your account
                                 <p>Don't have an account? <a href="{{url('register')}}">Sign up</a></p>
                                </h3>
                               
                                <div class="facebook-login">
                                    <a style="display: block;" href="{{url('login/facebook')}}"><img src="{{URL::asset('public/images/facebook_image.jpg')}}" alt="Facebook Login"></a>

                                    <a style="display: block; margin-top: 15px" href="{{url('login/google')}}"><img src="{{URL::asset('public/images/google_image.jpg')}}" alt="Facebook Login"></a>

                                    <p>We will not publish anything without your permission</p>

                                    @if (\Session::has('error'))
                                        <div class="alert alert-error">
                                            <ul>
                                                <li>{!! \Session::get('error') !!}</li>
                                            </ul>
                                        </div>
                                    @endif

                                </div><!-- Facebook Login -->
                                <!-- <h5 class="text-left">Or login with your email</h5> -->
                                <h5 class="text-center">Or login with your email</h5>
                                <div class="form-content"><br>
                                @if ($errors->has('email'))
                                    <div id="error_email" class="alert alert-danger" style="">
                                            <span>The e-mail address or password is incorrect.</span>
                                    </div>
                                @endif
                                 <form class="form-horizontal" autocomplete="off" method="POST" action="{{ route('login') }}" role="presentation">
                                  {{ csrf_field() }}
                                     <input type="hidden" name="redirect_url" value="{{ redirect()->back()->getTargetUrl() }}">
                                   
                                    <input  type="email" name="email" placeholder="Your email" class="form-control" value="{{old('email')}}"  autocomplete="new-email">
                                    <input id="password" type="password" name="password" placeholder="Your password" class="form-control" autocomplete="new-password">
                                    <input class="hide" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <p class="text-right forgot-pass"><a href="{{ route('password.request') }}">Forgot your password?</a></p>
                                    <p><input type="submit" class="btn btn-lg" value="Log In"></p>
                                    <p>Are you a vendor? <a href="{{url('login')}}"><strong>Login for businesses</strong></a></p>
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- / END ABOUT SECTION-->
    @include('includes.footer')
@endsection       
