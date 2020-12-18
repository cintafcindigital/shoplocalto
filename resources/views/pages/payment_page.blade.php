@extends('layouts.default')
@section('meta_title',$pageData->meta_title)
@section('meta_keyword',$pageData->meta_keyword)
@section('meta_description',$pageData->meta_description)
@section('content')
@include('includes.menu')
<?php
   $session_subsId = Session::get('session_subsId');
   $session_payType = Session::get('session_payType');
   $session_vendorId = Session::get('session_vendorId');
?>
<style>
   .btnCls {
      color:#fff;
      outline: none;
      margin-top:-15px;
      background-color:#bb8a20;
   }
   .btnCls:focus {
      outline: none !important;
      -moz-outline: none !important;
      -ms-outline: none !important;
      -o-outline: none !important;
      -webkit-outline: none !important;
   }
</style>
<section class="section-padding">
   @if(isset($vendors) && empty($vendors))
   <div class="text-center mb15">
      <a href="{{url('/')}}"><img src="{{asset('public/images/Logo_1584618693.png')}}" alt="" style="width:25%;"></a>
   </div>
   <div class="container">
      <div class="alert alert-error mb20">
         <p class='text-center'>You are not listed in Free-Listing. Please contact to Admin.</p>
      </div>
   </div>
   @else
   <div class="container">
      <h4 class="mb10">Please enter your Credit card details for payment processing.
         <a href="{{url('payment-packages')}}" class="btn floatright" style="background: #DD0000;color:White;"> << Go Back</a>
      </h4>
      <div class="incomplete_text" style="display:none;">
         <div class="adminAlert adminAlert--error"><p>Information incomplete.</p></div>
      </div>
      <div class="incorrect_info alert alert-error mb20" style="display:none;">
         <p class='incorrect_info_p'>Bank information is incorrect. Please check your information.</p>
      </div>
      <div class="box">
         <p class="bg p20 strong m0">
            <i class="icon-vendor icon-vendor-card mr5"></i> Credit Card <small class="ml5 color-grey">(Visa or Mastercard)</small>
         </p>
         <div class="pure-g">
            <div class="pure-u-4-6">
               <div class="unit-primary">
                  <form id="payment-form" class="pure-form" method="POST" action="">
                     <fieldset>
                        <div class="pure-control-group pure-g">
                           <div class="pure-u-2-6">
                              <label class="adminFormLabel mt10">Package Details</label>
                           </div>
                           <div class="pure-u-4-6">
                              <input type="hidden" name="subscription_id" value="{{$session_subsId}}">
                              <input type="hidden" name="vendor_id" id="vendor_id" value="{{$session_vendorId}}">
                              @if($subscription->id == $session_subsId)
                                 <h4>{{$subscription->type.' - $'.$subscription->amount.' ( for '.$subscription->duration.' )'}}</h4>
                              @endif
                           </div>
                        </div>
                        <div class="pure-control-group pure-g">
                           <div class="pure-u-2-6">
                              <label class="adminFormLabel">Pay Type</label>
                           </div>
                           <div class="pure-u-4-6">
                              <ul class="choose-cate" style="padding:0px;">
                                 <li style="width:25%;margin:0px;">
                                    <input type="radio" name="pay_type" value="full" id="pay_type_full" checked>
                                    <label for="pay_type_full"><b> Full Paid</b></label>
                                    <div class="check"></div>
                                 </li>
                                 <li style="width:25%;margin:0px;">
                                    <input type="radio" name="pay_type" value="monthly" id="pay_type_monthly">
                                    <label for="pay_type_monthly"><b> Monthly Paid</b></label>
                                    <div class="check"></div>
                                 </li>
                              </ul>
                           </div>
                        </div>
                        <div class="pure-control-group pure-g">
                           <div class="pure-u-2-6">
                              <label class="adminFormLabel">Card number</label>
                              <small class="block color-grey">Numbers only</small>
                           </div>
                           <div class="pure-u-4-6">
                              <input type="text" id="card_number" name="card_number" maxlength="16" autocomplete="off" placeholder="**** **** **** ****" style="width:50%;"><br/>
                              <span id="card_number_err"></span>
                           </div>
                        </div>
                        <div class="pure-control-group pure-g">
                           <div class="pure-u-2-6">
                              <label class="adminFormLabel mt10">Cardholder name</label>
                           </div>
                           <div class="pure-u-4-6">
                              <input type="text" id="cardholder_name" name="cardholder_name" autocomplete="off" placeholder="Cardholder Name" style="width:50%;">
                           </div>
                        </div>
                        <div class="pure-control-group pure-g">
                           <div class="pure-u-2-6">
                              <label class="adminFormLabel mt10">CVC</label>
                           </div>
                           <div class="pure-u-4-6">
                              <input type="text" id="card_cvc" name="card_cvc" size="4" maxlength="4" autocomplete="off" placeholder="CVC" style="width:50%;">
                              <br/><span id="card_cvc_err"></span>
                           </div>
                        </div>
                        <div class="pure-control-group pure-g">
                           <div class="pure-u-2-6">
                              <label class="adminFormLabel mt10">Expiration</label>
                           </div>
                           <div class="pure-u-4-6">
                              <div class="fleft mr10" style="width:20%;">
                                 <select id="exp_month" name="exp_month" style="width:95%;">
                                    @for($mn = 1; $mn < 13; $mn++)
                                       <option @if(date('m') == $mn) selected @endif>@if($mn < 10) {{'0'.$mn}} @else {{$mn}} @endif</option>
                                    @endfor
                                 </select>
                              </div>
                              <div class="overflow" style="width:30%;">
                                 <span class="mr10">/</span>
                                 <select id="exp_year" name="exp_year" style="width:80%;">
                                    @for($yrs = date('Y'); $yrs <= date('Y')+20; $yrs++)
                                       <option value="{{$yrs}}">{{$yrs}}</option>
                                    @endfor
                                 </select>
                              </div>
                           </div>
                        </div>
                        @if(@$vendors->username == '' || @$vendors->password == '')
                           <h3 class="mt10 mb20">Fill Your Login Information</h3>
                           <div class="pure-control-group pure-g">
                              <div class="pure-u-2-6"><label class="adminFormLabel">UserName</label></div>
                              <div class="pure-u-4-6">
                                 <input type="text" id="username" name="username" placeholder="Username *" style="width:50%;"><br/>
                                 <span id="username_err"></span>
                              </div>
                           </div>
                           <div class="pure-control-group pure-g">
                              <div class="pure-u-2-6"><label class="adminFormLabel">Password</label></div>
                              <div class="pure-u-4-6">
                                 <input type="text" id="password" name="password" minlength="6" placeholder="Password *" style="width:50%;"><br/>
                                 <span id="password_err"></span>
                              </div>
                           </div>
                        @endif
                        <div class="pure-control-group pure-g">
                           <div class="pure-u-4-6">
                              <input class="fleft mt5 btn-flat red app-check-before-submit" type="button" value="Make Payment">
                           </div>
                        </div>
                     </fieldset>
                  </form>
               </div>
            </div>
            <div class="pure-u-2-6">
               <div class="unit-primary">
                  <div class="adminAlert adminAlert--info">
                     <p class="adminAlert__title">What is CVC?</p>
                     <p>Three-digit security code printed on the back side of the card. It is used to help validate your card during the transaction.</p>
                  </div>
                  <p class="regular mb5 small color-grey">Payment 100% safe</p>
                  <i class="icon-vendor icon-vendor-card-visa"></i>
                  <i class="icon-vendor icon-vendor-card-mastercard"></i>
                  <i class="icon-vendor icon-vendor-card-americanexpress"></i>
               </div>
            </div>
         </div>
      </div>
   </div>
   @endif
</section>
<style>
   .icon-vendor-card::before {
      background-position: -24px 0;
      height: 13px;
      width: 18px;
   }
   .icon-vendor-card-mastercard::before {
      background-position: -67px -84px;
      height: 16px;
      width: 24px;
   }
   .icon-vendor-card-visa::before {
      background-position: 0px -222px;
      height: 16px;
      width: 24px;
   }
   .icon-vendor-card-americanexpress::before {
      background-position: 0 -288px;
      height: 16px;
      width: 24px;
   }
</style>
@include('includes.footer')
<script>
$(document).ready(function(){
   $("#card_number").change(function() {
      var cardNum = $(this).val();
      var numRegEx = /^\d+$/;
      if(numRegEx.test(cardNum) === false) { // Only Numbers......
         $("#card_number").val('');
         $("#card_number_err").html("<i style='color:#ff4545'>Inavlid Card Number !</i>");
         return false;
      } else {
         $("#card_number_err").html("");
      }
   });
   $('.app-check-before-submit').click(function(){
      var vendor_id       = $("#vendor_id").val();
      var card_number     = $("#card_number").val();
      var cardholder_name = $("#cardholder_name").val();
      var card_cvc        = $("#card_cvc").val();
      var userCheck       = "{{@$vendors->username}}";
      if(userCheck == '') {
         var username = $("#username").val();
         if(username == '') {
            $("#username_err").html("<i style='color:#ff4545'>Please enter UserName</i>");
         } else {
            $("#username_err").html('');
         }
         var password = $("#password").val();
         if(password == '') {
            $("#password_err").html("<i style='color:#ff4545'>Please enter Password</i>");
         } else {
            $("#password_err").html('');
         }
      }
      if(card_number == '' || cardholder_name == '' || card_cvc == '') {
         $('.incorrect_info').hide();
         $('.incomplete_text').show();
         return false;
      } else {
         $("#card_cvc_err").html("");
         $('.incomplete_text').hide();
         var cardType = '';
         var visaRegEx = /^(?:4[0-9]{12}(?:[0-9]{3})?)$/;
         var mastercardRegEx = /^(?:5[1-5][0-9]{14})$/;
         var amexpRegEx = /^(?:3[47][0-9]{13})$/;
         if(visaRegEx.test(card_number) === true) { // Visa validation......
            cardType = 'Visa';
         }
         if(mastercardRegEx.test(card_number) === true) { // MasterCard validation......
            cardType = 'MasterCard';
         }
         if(amexpRegEx.test(card_number) === true) { // Amex validation......
            cardType = 'America Express';
         }
         var numRegEx = /^\d+$/;
         if(numRegEx.test(card_cvc) === false || card_cvc.length < 3) { // Only Numbers......
            cardType = '';
            $("#card_cvc").val('');
            $("#card_cvc_err").html("<i style='color:#ff4545'>Inavlid CVC Number !</i>");
            return false;
         }
         if(cardType == '') {
            $('.incorrect_info').show();
            return false;
         } else {
            var session_payType = "{{$session_payType}}";
            if(session_payType == 'marketing') {
               $.ajax({
                  type: 'post',
                  url: '{{ url("store-payment-method") }}',
                  data: $('#payment-form').serialize()+'&cardType='+cardType,
                  success: function(response) {
                     if(response == 'done') {
                        window.location.href = "{{url('/payment-thankyou')}}";
                     } else {
                        $('.incorrect_info').show();
                        $('.incorrect_info_p').html(response);
                     }
                  }
               });
            } else {
               $.ajax({
                  type: 'post',
                  url: '{{ url("save-payment-method") }}',
                  data: $('#payment-form').serialize()+'&cardType='+cardType,
                  success: function(response) {
                     if(response == 'done') {
                        window.location.href = "{{url('/register')}}?vendorId="+vendor_id;
                     } else {
                        $('.incorrect_info').show();
                        $('.incorrect_info_p').html(response);
                     }
                  }
               });
            }
            $('.incorrect_info').hide();
         }
      }
   });
});
</script>
@endsection