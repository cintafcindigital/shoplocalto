@extends('layouts.default')
@section('content')

    <div class="headerlanding" style="padding: 20px 0;text-align: center;border-bottom: 1px solid #00AEAF;box-shadow: 0 0px 9px 0px #00AEAE;">
        <div class="headerlanding-inner">
            <a href="{{ url('/') }}"><img src="{{ URL::asset('public/images/logo.jpg') }}" alt="Landing Logo"></a>
        </div>
    </div>

    <!-- / END SLIDER SECTION -->
     <!-- ABOUT SECTION START-->
        <section class="section-padding">
            <div class="container">
                <div class="login-col"> 
                    <div class="row">
                        <div class="col-md-5 col-sm-5 login-left">
                            <img src="{{URL::asset('public/images/login-img.jpg')}}" alt="">
                        </div>
                        <div class="col-md-7 col-sm-7 login-right">
                            <div class="login-content">
                                <h4 class="text-left">Last Step to Access Your Account</h4>
                                <form autocomplete="off" method="POST" action="{{ url('post-guest-account-verify') }}">
                                 {{ csrf_field() }}
                                <div class="form-content">
                                    <div class="row">
                                        <div class="form-group col-sm-12">
                                            <input type="text" name="name" placeholder="First and Last Name" value="{{ $userObj->name }}" class="form-control" autocomplete="new-name">
                                            @if($errors->has('name'))
                                             <span class="custom-error">{{$errors->first('name')}}</span>
                                            @endif
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <input type="text" name="email" placeholder="E-mail" value="{{ $userObj->email }}" class="form-control" autocomplete="new-email" readonly>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <input type="password" name="password" placeholder="Your password" class="form-control" autocomplete="new-password">
                                            <input id="password-confirm" type="hidden" class="form-control" name="password_confirmation" >
                                        </div>
                                        @if($errors->has('email') || $errors->has('password'))
                                        <div class="col-sm-12">
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
                                        </div>
                                        @endif
                                        <div class="form-group col-sm-6">
                                            <input type="text" name="address" placeholder="You live in..." class="form-control" value="{{old('address')}}">
                                        </div>
                                       
                                        <div class="form-group col-sm-6">
                                            <select name="country" id="country" class="form-control">
                                                <option value="">Country</option>
                                                @if(isset($countries) && !empty($countries))
                                                  @foreach($countries as $k=>$val)
                                                     <option value='{{$val['sortname']}}' @php if($val['sortname'] == 'CA'){ echo"selected";} @endphp >{{$val['name']}}</option>
                                                  @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        @if($errors->has('address'))
                                        <div class="col-sm-12">
                                           <div class="col-sm-12 reg-error">
                                            @if($errors->has('address'))
                                            <span class="custom-error">{{$errors->first('address')}}</span>
                                            @endif
                                           </div>
                                        </div>
                                        @endif
                                        <div class="form-group col-sm-6">
                                            <input type="text" name="event_date" placeholder="Wedding date" class="form-control datetimepicker" @if(isset($userObj->event_date) && $userObj->event_date != '') value="{{ date("d/m/Y", strtotime($userObj->event_date)) }}" readonly @endif >
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <input type="text" name="phone" placeholder="Phone" class="form-control" value="{{ $userObj->phone }}">
                                        </div>
                                        <div class="form-group col-sm-12 radio-btns text-left">
                                            <span><strong>I am</strong></span>
                                            <label>
                                                <input type="radio" name="event_role" value="bride" id="bride"  @if(old('event_role') == 'bride') checked @endif> Bride
                                                <div class="check"></div>
                                            </label>
                                            <label>
                                                <input type="radio" name="event_role" value="groom" id="groom"  @if(old('event_role') == 'groom') checked @endif> Groom 
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
                                        <p class="accept-text">By clicking on 'Sign up' I am accepting the <a href="{{url('privacy-policy')}}">legal terms</a> of Perfect wedding day.</p>
                                        </div>
                                    </div>
                                    <p>
                                    <input type="hidden" value="{{ base64_encode($userObj->id) }}" name="user_id" />
                                    <input type="submit" class="btn btn-lg" value="Access Your Account"></p>
                                    <div class="send-email">
                                        <label for="check" class="checkbox">
                                            <input type="checkbox" name="mail_allow" class="check" id="check" value="1">
                                            Yes, I want Perfect wedding day to send me promotional emails about Perfect wedding day and its vendor and advertising partners.
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                              </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- / END ABOUT SECTION-->
    
    <footer id="footer-section">
        <div class="container text-center">
            <div class="row">
                
                <div class="col-md-12">
                    <div class="footer-cont">
                        <p>© Copyright {{ date('Y') }}. All Rights Reserved | Website Developed by <a href="http://www.infoicontechnologies.com/"><u>Infoicon Technologies</u></a></p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

@endsection       
