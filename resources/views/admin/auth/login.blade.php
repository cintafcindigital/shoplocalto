<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="" />
    <meta name="keywords" content="">
    <meta name="author" content="Codedthemes" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'My Health Squad') }}</title>
    <!-- Favicon icon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{url('public/images/mhs_favicon.png')}}">
    <link rel="shortcut icon" type="image/png" href="{{url('public/images/mhs_favicon.png')}}">
    <link rel="icon" type="image/png" href="{{url('public/images/mhs_favicon.png')}}">
    <!-- vendor css -->
    <link rel="stylesheet" href="{{url('assets/css/style.css')}}">
    <script src="{{url('assets/js/vendor-all.min.js')}}"></script>
</head>
<body>
    <div class="auth-wrapper align-items-stretch aut-bg-img aut-bg-right">
        <div class="flex-grow-1">
            <div class="h-100 d-md-flex align-items-center auth-side-img">
                <div class="col-sm-10 auth-content w-auto"></div>
            </div>
            <div class="auth-side-form">
                <div class="auth-content">
                    <div class="row justify-content-center">
                        <div class="col-md-9">
                            <div class="text-center">
                                <img src="{{url('assets/images/pwd_icon.png')}}" alt="" class="img-fluid mb-5">
                                <h1 class="f-w-400">Hi there, please log in</h1>
                            </div>
                            @if(session()->has('msg'))
                                <div class="alert alert-danger"> {{ session()->get('msg') }} </div>
                            @endif
                            @if(session()->has('msg-success'))
                                <div class="alert alert-success"> {{ session()->get('msg-success') }} </div>
                            @endif
                            <form class="my-5" method="POST" action="{{ route('admin.login.submit') }}">
                                {{ csrf_field() }}
                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label>E-Mail Address</label>
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                                    @if ($errors->has('email'))
                                        <span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label>Password</label>
                                    <input id="password" type="password" class="form-control" name="password" required>
                                    @if ($errors->has('password'))
                                        <span class="help-block"><strong>{{ $errors->first('password') }}</strong></span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary btn-block mb-4">Login</button>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="chklog1" name="remember" {{old('remember')?'checked':''}}>
                                                <label class="custom-control-label" for="chklog1">Remember Me</label>
                                            </div>
                                        </div>
                                        <!-- <div class="col text-right"><a href="javascript:;">Forgot Password?</a></div> -->
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="footer-cont text-center">
                    <h6 class="mb-0 text-muted">&copy;2020 All Rights Reserved. My Health Squad</h6>
                </div>
            </div>
        </div>
    </div>
    <script src="{{url('assets/js/plugins/bootstrap.min.js')}}"></script>
    <script src="{{url('assets/js/pcoded.min.js')}}"></script>
</body>
</html>