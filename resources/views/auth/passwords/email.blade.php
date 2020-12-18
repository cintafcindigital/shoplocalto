@extends('layouts.default')
@section('content')
@section('meta_title',$pageData->meta_title)
@section('meta_keyword',$pageData->meta_keyword)
@section('meta_description',$pageData->meta_description)
@include('includes.menu')
@include('includes.inner-slider')
        <!-- ABOUT SECTION START-->
        <section class="section-padding">
            <div class="container">
                <div class="forgot-pass-col text-center"> 
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if ($errors->has('email'))
                        <div id="error_email" class="alert alert-danger" style="">
                            <span>We can't find a user with that e-mail address.</span>
                        </div>
                    @endif
                    <h3>Reset Password</h3>
                    <p>Enter your e-mail and you will receive the instructions to reset your password.</p>
                    <div class="form-content">
                          <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
                             {{ csrf_field() }}
                            <input type="email" name="email" placeholder="E-mail" class="form-control" value="{{ old('email') }}" required>
                            <p><input type="submit" class="btn btn-lg" value="Reset your password"></p>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- / END ABOUT SECTION-->
       @include('includes.footer')
@endsection    
