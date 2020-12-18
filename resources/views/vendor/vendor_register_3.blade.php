@extends('layouts.default')
@section('meta_title',$pageData->meta_title)
@section('meta_keyword',$pageData->meta_keyword)
@section('meta_description',$pageData->meta_description)
@section('content')
@include('includes.menu')
@include('includes.inner-slider')
        <!-- SLIDER SECTION START -->
        <style> .error-text{ color: #F11D1D;
                     font-size: 14px;
                }
        </style>

        <section class="vendor-step-wrap">
           <div class="container">
               <div class="vendors-signup-steps">
                    <div class="progress-steps">
                        <div class="complete">
                            <span>1</span><hr>
                        </div>
                        <div class="complete">
                            <span>2</span><hr>
                        </div>
                        <!-- <div class="complete">
                            <span>3</span><hr>
                        </div> -->
                        <div class="complete">
                            <span>3</span><hr>
                        </div>
                    </div>
                    <div class="progress-steps-ui">
                        <span>General Information</span>
                        <span>Photo gallery</span>
                        <!-- <span>Frequently Asked Questions</span> -->
                        <span>Promotions</span>
                    </div>
                </div><!-- Vendors Signup Steps -->
                @if(session()->has('fail'))
                        <div class="alert alert-danger">
                            {{ session()->get('fail') }}
                        </div>
                @endif
                 <form action="{{url('register-step-4')}}" class="vendor-form-wrap" method="post">
                   {{ csrf_field() }}
                    <div class="login-info-row">
                        <p class="text-center"><img src="{{ URL::asset('public/images/coupon.png') }}" alt=""> Add special promotions, offers and discounts to your storefront.</p>
                        <div class="wedding-special-discount">
                            <div class="discount-bnr text-center">
                                <img src="{{ URL::asset('public/images/wedding-couple.jpg') }}" alt="">
                                <div class="discount-text">
                                    <h4>Special discount for Perfect Wedding Day couples</h4>
                                    <p>Offer a discount to couples who find you on Perfect Wedding Day and book your services. The discount will apply to the services they purchase.</p>
                                </div>
                            </div>
                            <div class="choose-discount">
                                <ul class="choose-cate clearfix">
                                      <li>
                                        <input type="radio" id="discount" name="promotion_amount" value="3">
                                        <label for="discount">3%</label>
                                        <div class="check"></div>
                                      </li>
                                      <li>
                                        <input type="radio" id="discount2" name="promotion_amount" value="5">
                                        <label for="discount2">5%</label>
                                        <div class="check"></div>
                                      </li>
                                      <li>
                                        <input type="radio" id="discount3" name="promotion_amount" value="10">
                                        <label for="discount3">10%</label>
                                        <div class="check"></div>
                                      </li>
                                      <li>
                                        <input type="radio" id="discount4" name="promotion_amount" value="15">
                                        <label for="discount4">15%</label>
                                        <div class="check"></div>
                                      </li>
                                      <li>
                                        <input type="radio" id="discount5" name="promotion_amount" value="20">
                                        <label for="discount5">20%</label>
                                        <div class="check"></div>
                                      </li>
                                      <li>
                                        <input type="radio" id="discount6" name="promotion_amount" value="30">
                                        <label for="discount6">30%</label>
                                        <div class="check"></div>
                                      </li>
                                    </ul>
                                    <p class="text-center discount-text">
                                        <label for="check" class="checkbox">
                                            <input type="checkbox" name="offer_wedding" class="check" id="check" value="1">
                                            I do not want to offer a discount to Perfect Wedding Day couples.
                                            <span class="checkmark"></span>
                                        </label>
                                    </p>
                            </div><!-- Choose Discount -->
                        </div>

                        <!-- Commented Payment Gateway panel -->
                        <!-- <div class="row">
                          <div class="col-md-3"></div>
                          <div class="col-md-6" style="margin: 20px 0;">
                            <div class="checkout-payment row cart-tax">                                        
                                <h3 class="shoping-checkboxt-title" style="margin-bottom: 10px;">Payment Info</h3>
                                <div class="col-lg-12 col-sm-12" style="margin-bottom: 10px;padding: 0;">
                                    <label>Credit Card</label>
                                    <input type="text" name="cardnumber" class="form-control" placeholder="Enter credit card number" maxlength="16"/>
                                </div>
                                <div class="col-lg-8 col-sm-8" style="margin-bottom: 10px;padding: 0;">
                                    <label>Expiry</label>
                                    <div class="form-row">
                                        <div class="col-lg-6 col-sm-6" style="margin-left:-15px;">
                                            <select name="exp_month" class="form-control">
                                                @for($i=1;$i<=12;$i++)
                                                    <option value="{{sprintf("%02d",$i)}}">{{sprintf("%02d",$i)}}</option>
                                                @endfor
                                            </select>
                                        </div>
                                        <div class="col-lg-6 col-sm-6">
                                            <select name="exp_year" class="form-control">
                                                @for($i=date('Y');$i<=date('Y')+10;$i++)
                                                    <option value="{{$i}}">{{$i}}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-4" style="margin-bottom: 10px;padding: 0;">
                                    <label>CVV</label>
                                    <input type="text" name="cvv" class="form-control" maxlength="4" placeholder="****" />
                                </div>
                              </div>
                          </div>
                          <div class="col-md-3"></div>
                        </div> -->

                         <div class="col-sm-12 next-row text-center">
                             <button type="submit" class="btn btn-lg btn-next">Pay & Save</button>
                        </div>
                    </div><!-- Login Information -->
                </form>
            </div>
        </section><!-- Vendor Step Wrapper -->
        
        <!-- / END SUBSCRIBE SECTION-->
        @include('includes.footer')
@endsection