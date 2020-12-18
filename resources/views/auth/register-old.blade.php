@extends('layouts.default')
@section('meta_title',$pageData->meta_title)
@section('meta_keyword',$pageData->meta_keyword)
@section('meta_description',$pageData->meta_description)
@section('content')
@include('includes.menu')
@include('includes.inner-slider')
    <!-- / END SLIDER SECTION -->
     <!-- ABOUT SECTION START-->
        <section class="section-padding">
            <div class="container">
                <div class="login-col"> 
                    <div class="row">
                        <div class="col-sm-12" style="height: 100vh;">
                            <h1 class="text-center" style="position: absolute;top: 25%;left: 37%;">Coming Soon..!</h1>
                        </div>
                    </div>
                    <div class="row hidden">
                        <div class="col-md-5 col-sm-5 login-left hidden-xs">
                            <img src="{{URL::asset('public/images/login-health.jpg')}}" alt="">
                        </div>
                        <div class="col-md-7 col-sm-7 login-right">
                            <div class="login-content">
                                <div class="facebook-login">
                                    <a href="{{url('login/facebook')}}"><img src="{{URL::asset('public/images/fb-login.jpg')}}" alt=""></a>
                                    <p>We will not publish anything without your permission</p>
                                </div><!-- Facebook Login -->
                                <h5 class="text-left">Or sign you up using your email</h5>
                                <form autocomplete="off" method="POST" action="{{ route('register') }}">
                                 {{ csrf_field() }}
                                <div class="form-content">
                                        <div class="row">
                                            <div class="form-group col-sm-12">
                                                <input type="text" name="name" placeholder="First and Last Name" value="{{ old('name') }}" class="form-control" autocomplete="new-name">
                                                @if($errors->has('name'))
                                                 <span class="custom-error">{{$errors->first('name')}}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-sm-6">
                                                <input type="text" name="email" placeholder="E-mail" value="{{ old('email') }}" class="form-control" autocomplete="new-email">
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <input type="password" name="password" placeholder="Your password" class="form-control" autocomplete="new-password">
                                                <input id="password-confirm" type="hidden" class="form-control" name="password_confirmation" >
                                            </div>
                                        </div>
                                        <div class="row">
                                            @if($errors->has('email') || $errors->has('password'))
                                           <div class="col-sm-6 reg-error">
                                                @if($errors->has('email'))
                                                <span class="custom-error">{{$errors->first('email')}}</span>
                                                @endif
                                            </div>
                                            <div class="col-sm-6 reg-error-1">
                                                @if($errors->has('password'))
                                                <span class="custom-error">{{$errors->first('password')}}</span>
                                                @endif
                                            </div>
                                            @endif
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-sm-6">
                                                <input type="text" name="address" placeholder="You live in..." class="form-control" value="{{old('address')}}">
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <input type="text" name="city" placeholder="In which city..." class="form-control" value="{{old('city')}}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            @if($errors->has('address'))
                                            <div class="col-sm-6">
                                               <div class="col-sm-6 reg-error">
                                                    @if($errors->has('address'))
                                                        <span class="custom-error">{{$errors->first('address')}}</span>
                                                    @endif
                                               </div>
                                            </div>
                                            @endif
                                            @if($errors->has('city'))
                                            <div class="col-sm-6">
                                               <div class="col-sm-6 reg-error">
                                                    @if($errors->has('city'))
                                                        <span class="custom-error">{{$errors->first('city')}}</span>
                                                    @endif
                                               </div>
                                            </div>
                                            @endif
                                        </div>
                                        <div class="form-group col-sm-6 hidden">
                                            <select name="country" id="country" class="form-control">
                                                <option value="">Country</option>
                                                @if(isset($countries) && !empty($countries))
                                                    @foreach($countries as $k=>$val)
                                                        <option value='{{$val['sortname']}}' @php if($val['sortname'] == 'CA'){ echo"selected";} @endphp >{{$val['name']}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="form-group col-sm-6 hidden">
                                            <input type="text" name="event_date" placeholder="Date Of Birth" class="form-control datetimepicker" value="{{old('event_date')}}">
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-sm-6">
                                                <select name="province" id="province" class="form-control">
                                                    <option value="">Province</option>
                                                    @if(isset($states) && !empty($states))
                                                        @foreach($states as $k=>$val)
                                                            <option @if(old('province') == $val['name']) selected @endif>{{$val['name']}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <input type="text" name="phone" placeholder="Phone" class="form-control" value="{{old('phone')}}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            @if($errors->has('province'))
                                            <div class="col-sm-6">
                                               <div class="col-sm-6 reg-error">
                                                    @if($errors->has('province'))
                                                        <span class="custom-error">{{$errors->first('province')}}</span>
                                                    @endif
                                               </div>
                                            </div>
                                            @endif
                                            @if($errors->has('phone'))
                                            <div class="col-sm-6">
                                               <div class="col-sm-6 reg-error">
                                                    @if($errors->has('phone'))
                                                        <span class="custom-error">{{$errors->first('phone')}}</span>
                                                    @endif
                                               </div>
                                            </div>
                                            @endif
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-sm-12">
                                                <select class="form-control text-center" name="category">
                                                    <option selected disabled>--Select Your Profession--</option>
                                                    @foreach($category as $cat)
                                                    <option disabled style="font-weight: bold;color: #000;">{{$cat['title']}}</option>
                                                    @if(isset($cat['child']))
                                                    @foreach($cat['child'] as $child)
                                                    <option value="{{$child['id']}}" @if(old('category') == $child['id']) selected @endif>{{$child['title']}}</option>
                                                    @endforeach
                                                    @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            @if($errors->has('category'))
                                            <div class="col-sm-12">
                                               <div class="col-sm-12 reg-error">
                                                    @if($errors->has('category'))
                                                        <span class="custom-error">{{$errors->first('category')}}</span>
                                                    @endif
                                               </div>
                                            </div>
                                            @endif
                                        </div>
                                        <div class="form-group col-sm-12 radio-btns text-left hidden">
                                            <span style="padding-right: 0;"><strong>I am</strong></span>
                                            <label>
                                                <input type="radio" name="event_role" value="bride" id="bride"  @if(old('event_role') == 'bride') checked @endif> Female
                                                <div class="check"></div>
                                            </label>
                                            <label>
                                                <input type="radio" name="event_role" value="groom" id="groom"  @if(old('event_role') == 'groom') checked @endif> Male 
                                                <div class="check"></div>
                                            </label>
                                            <label>
                                                <input type="radio" name="event_role" value="other" id="other"  @if(old('event_role') == 'other') checked @endif> Other
                                                <div class="check"></div>
                                            </label>
                                            @if($errors->has('event_role'))
                                            <span class="custom-error">{{$errors->first('event_role')}}</span>
                                            @endif                                           
                                        </div><!-- Radio Buttons -->
                                        <div class="form-group col-sm-12">
                                        <p class="accept-text">By clicking on 'Sign up' I am accepting the <a href="{{url('terms')}}">legal terms</a> of My Health Squad.</p>
                                        </div>
                                    <!-- </div> -->
                                    <p><input type="submit" class="btn btn-lg" value="Sign up"></p>
                                    <div class="send-email">
                                        <label for="check" class="checkbox">
                                            <input type="checkbox" name="mail_allow" class="check" id="check" value="1">
                                            Yes, I want My Health Squad to send me promotional emails about My Health Squad and its vendor and advertising partners.
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <p>Already have an account? <a href="{{url('login')}}"><strong>Log In</strong></a></p>
                                </div>
                              </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- / END ABOUT SECTION-->
    
    @include('includes.footer')

@endsection       
