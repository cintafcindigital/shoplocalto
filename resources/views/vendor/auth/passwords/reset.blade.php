@extends('layouts.default')
@section('meta_title',$pageData->meta_title)
@section('meta_keyword',$pageData->meta_keyword)
@section('meta_description',$pageData->meta_description)
@section('content')
@include('includes.menu')
@include('includes.inner-slider')

        <section class="section-padding">
            <div class="container">
                <div class="forgot-pass-col text-center"> 
                    @if ($errors->has('email'))
                        <div id="error_email" class="alert alert-danger" style="">
                            <span>{{ $errors->first('email') }}</span>
                        </div>
                    @endif
                    @if ($errors->has('password'))
                        <div id="error_email" class="alert alert-danger" style="">
                            <span>{{ $errors->first('password') }}</span>
                        </div>
                    @endif
                    @if ($errors->has('password_confirmation'))
                        <div id="error_email" class="alert alert-danger" style="">
                            <span>{{ $errors->first('password_confirmation') }}</span>
                        </div>
                    @endif
                    <h3>Reset Password</h3>
                    <div class="form-content">
                          <form class="form-horizontal" method="POST" action="{{ url('/password/reset') }}">
                             {{ csrf_field() }}
                             <input type="hidden" name="token" value="{{ $token }}">
                             <input type="email" name="email" placeholder="E-mail" class="form-control" value="{{ $email or old('email') }}" required>
                             <input id="password" type="password" placeholder="Password" class="form-control" name="password" >
                             <input id="password-confirm" type="password" placeholder="Confirm Password" class="form-control" name="password_confirmation" >

                             <p><input type="submit" class="btn btn-lg" value="Reset your password"></p>
                        </form>
                    </div>
                </div>
            </div>
        </section>
       @include('includes.footer')
@endsection     