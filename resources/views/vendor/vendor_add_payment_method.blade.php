@extends('layouts.default')
@section('meta_title',$data['titleData']->meta_title)
@section('meta_keyword',$data['titleData']->meta_keyword)
@section('meta_description',$data['titleData']->meta_description)
@section('content')
@include('includes.menu')
<section class="section-padding dashboard-wrap bills_page_wrp dash_main_sect">
	@include('vendor.tools_nav')
	<div class="wrapper">
		<div class="pure-g">
			<div class="pure-u-2-7">
				<div class="mr40">
				<nav class="adminAside add_payment_list">
						<a class="adminAside__item " href="{{url('invoices')}}">
							<i class="svgIcon svgIcon__bill adminAside__icon">
								<svg viewBox="0 0 16 20">
									<path d="M14.196 5.729L9.64 1.8H1.804v16.4h12.392V5.729zm.5 13.471H1.304a.5.5 0 0 1-.5-.5V1.3a.5.5 0 0 1 .5-.5h8.522a.5.5 0 0 1 .327.121l4.87 4.2a.5.5 0 0 1 .173.379v13.2a.5.5 0 0 1-.5.5zM10.326 5h4.37a.5.5 0 0 1 0 1h-4.87a.5.5 0 0 1-.5-.5V1.3a.5.5 0 1 1 1 0V5zM3.24 17.4V6.8h9.522v10.6H3.239zm8.522-1V7.8H4.239v8.6h7.522zm-8.022-6.2a.5.5 0 0 1 0-1h8.522a.5.5 0 0 1 0 1H3.739zm0 2.4a.5.5 0 1 1 0-1h8.522a.5.5 0 0 1 0 1H3.739zm0 2.4a.5.5 0 1 1 0-1h8.522a.5.5 0 0 1 0 1H3.739zm2.544-7.7a.5.5 0 1 1 1 0v9.6a.5.5 0 1 1-1 0V7.3z" fill-rule="nonzero"></path>
								</svg>
							</i> Invoices <span class="adminAside__counter">{{ count($data['vendorInvc']) }}</span>
						</a>
						<a class="adminAside__item " href="{{url('bills')}}">
							<i class="svgIcon svgIcon__receipt adminAside__icon">
								<svg viewBox="0 0 16 22">
									<path d="M3.015 19.722l-1.328 1.327a.5.5 0 0 1-.854-.354V1.362a.5.5 0 0 1 .85-.357l1.314 1.29L4.313.98a.5.5 0 0 1 .707 0l1.313 1.313L7.646.98a.5.5 0 0 1 .708 0l1.313 1.313L10.98.98a.5.5 0 0 1 .707 0l1.316 1.316 1.313-1.29a.5.5 0 0 1 .85.356v19.333a.5.5 0 0 1-.856.35l-1.313-1.335-1.31 1.31a.5.5 0 0 1-.707 0l-1.313-1.313-1.313 1.313a.5.5 0 0 1-.71-.003L6.367 19.72l-1.354 1.307a.5.5 0 0 1-.7-.006l-1.3-1.298zM2.66 18.66a.5.5 0 0 1 .707 0l1.305 1.305 1.356-1.31a.5.5 0 0 1 .704.008l1.27 1.292 1.31-1.31a.5.5 0 0 1 .707 0l1.313 1.314 1.313-1.314a.5.5 0 0 1 .71.003l.81.825V2.554l-.816.803a.5.5 0 0 1-.704-.003L11.333 2.04 10.02 3.354a.5.5 0 0 1-.707 0L8 2.04 6.687 3.354a.5.5 0 0 1-.707 0L4.667 2.04 3.354 3.354a.5.5 0 0 1-.704.003l-.817-.803V19.49l.828-.828zM3.855 7.167a.5.5 0 0 1 0-1h5.043a.5.5 0 1 1 0 1H3.855zm0 2.666a.5.5 0 1 1 0-1h3.362a.5.5 0 1 1 0 1H3.855zm0 2.667a.5.5 0 1 1 0-1h4.203a.5.5 0 1 1 0 1H3.855zm0 2.667a.5.5 0 0 1 0-1h2.522a.5.5 0 1 1 0 1H3.855zm7.565-8a.5.5 0 1 1 0-1h.84a.5.5 0 1 1 0 1h-.84zm0 2.666a.5.5 0 1 1 0-1h.84a.5.5 0 1 1 0 1h-.84zm0 2.667a.5.5 0 1 1 0-1h.84a.5.5 0 1 1 0 1h-.84zm0 2.667a.5.5 0 0 1 0-1h.84a.5.5 0 1 1 0 1h-.84z" fill-rule="nonzero"></path>
								</svg>
							</i> Bills <span class="adminAside__counter">{{ count($data['vendorBill']) }}</span>
						</a>
						<a class="adminAside__item active" href="{{url('payment-method')}}">
							<i class="svgIcon svgIcon__card adminAside__icon">
								<svg viewBox="0 0 22 18">
									<path d="M7.605 7.964c-.159.335-.346.67-.562.985-.654.956-1.437 1.551-2.376 1.551a.5.5 0 1 1 0-1c.532 0 1.064-.405 1.551-1.116a6.268 6.268 0 0 0 .646-1.224.5.5 0 0 1 .47-.327H9c.669 0 1.167-.364 1.167-.833v-.667c0-.461-.513-.833-1.167-.833H6.333c-2.514 0-4.5 1.568-4.5 5.167v2.666c0 2.046 1.788 3.834 3.834 3.834H12a.5.5 0 1 1 0 1H5.667c-2.598 0-4.834-2.236-4.834-4.834V9.667c0-4.21 2.479-6.167 5.5-6.167H9c1.15 0 2.167.738 2.167 1.833V6c0 1.1-1.001 1.833-2.167 1.833H7.666a8.194 8.194 0 0 1-.061.131zm2.062 3.87a.5.5 0 1 1 0-1h5.666c.972 0 1.834.86 1.834 1.833 0 .972-.862 1.833-1.834 1.833H12a.5.5 0 1 1 0-1h3.333c.42 0 .834-.413.834-.833s-.414-.834-.834-.834H9.667zm10.5-6.667h-9.712a.5.5 0 0 1 0-1h9.712v-1.5c0-.42-.414-.834-.834-.834H7.174c-.43 0-.674.235-.674.645V4a.5.5 0 0 1-1 0V2.478c0-.97.699-1.645 1.674-1.645h12.16c.971 0 1.833.862 1.833 1.834V10c0 .972-.862 1.833-1.834 1.833h-12c-.972 0-1.833-.86-1.833-1.833v-.591a.5.5 0 1 1 1 0V10c0 .42.413.833.833.833h12c.42 0 .834-.413.834-.833V5.167zM9.667 14.5a.5.5 0 1 1 0-1h2.217c.965 0 1.616.835 1.616 1.833s-.651 1.834-1.616 1.834h-1.217a.5.5 0 0 1 0-1h1.217c.35 0 .616-.341.616-.834 0-.492-.266-.833-.616-.833H9.667zm9-8.333a.5.5 0 0 1 0 1H16a.5.5 0 1 1 0-1h2.667z" fill-rule="nonzero"></path>
								</svg>
							</i> Payment methods <span class="adminAside__counter">{{ count($data['vendorPaym']) }}</span>
						</a>
					</nav>
				</div>
			</div>
			<div class="pure-u-5-7 add_payment_wrp">
				<h1 class="adminTitle"> Add payment method </h1>
				<div class="adminAlert adminAlert--info">
				<p>At My Health Squad, we use advanced technology to keep a high security level of our online platform. Our secure socket layer (SSL) encrypts all personal information you provide us.</p>
				</div>
				<div class="incomplete_text" style="display: none;">    
					<div class="adminAlert adminAlert--error"><p>Information incomplete.</p></div>
				</div>
				<div class="incorrect_info alert alert-error mb20" style="display:none;">
					<p>Bank information is incorrect. Please check your information.</p>
				</div>
				<p class="mb20 regular">Complete the following form and enter the card you want to use to make the payments for your services. We will automatically charge this card according to the set dates in the contract.</p>
				<div class="box">
					<p class="bg p20 strong m0">
						<i class="icon-vendor icon-vendor-card mr5"></i> Credit Card <small class="ml5 color-grey">(Visa or Mastercard)</small>
					</p>
					<div class="pure-g">
						<div class="pure-u-4-6">
							<div class="unit-primary">
								<form id="pay-form" class="pure-form" method="POST" action="">
									<fieldset>
										<div class="pure-control-group pure-g">
											<div class="pure-u-2-6">
												<label class="adminFormLabel" for="card-number">Card number</label>
												<small class="block color-grey">Numbers only</small>
											</div>
											<div class="pure-u-4-6">
												<input type="text" id="card_number" name="card_number" maxlength="16" autocomplete="off" placeholder="**** **** **** ****" onkeyup="cardNumber_format(this.value);"><br/>
												<span id="card_number_err"></span>
											</div>
										</div>
										<div class="pure-control-group pure-g">
											<div class="pure-u-2-6">
												<label class="adminFormLabel mt10" for="card-holder-name">Cardholder name</label>
											</div>
											<div class="pure-u-4-6">
												<input type="text" id="cardholder_name" name="cardholder_name" autocomplete="off" placeholder="Cardholder Name">
											</div>
										</div>
										<div class="pure-control-group pure-g">
											<div class="pure-u-2-6">
												<label class="adminFormLabel mt10" for="card-cvc">CVC</label>
											</div>
											<div class="pure-u-4-6">
												<input type="text" id="card_cvc" name="card_cvc" size="4" maxlength="4" autocomplete="off" placeholder="CVC">
												<br/><span id="card_cvc_err"></span>
											</div>
										</div>
										<div class="pure-control-group pure-g">
											<div class="pure-u-2-6">
												<label class="adminFormLabel mt10">Expiration</label>
											</div>
											<div class="pure-u-4-6">
												<div class="fleft mr10">
													<select id="exp_month" name="exp_month">
														<option>Month</option>
														@for($mnth = 1; $mnth <= 12; $mnth++)
															@if($mnth < 10)
															<option value="0{{$mnth}}">0{{$mnth}}</option>
															@else
															<option value="{{$mnth}}">{{$mnth}}</option>
															@endif
														@endfor
													</select>
												</div>
												<div class="overflow">
													<span class="mr10">/</span>
													<select id="exp_year" name="exp_year">
														<option value="">Year</option>
														@for($yrs = date('Y'); $yrs <= date('Y')+20; $yrs++)
															<option value="{{$yrs}}">{{$yrs}}</option>
														@endfor
													</select>
												</div>
											</div>
										</div>
										<div class="pure-control-group pure-g">
											<div class="pure-u-2-6"></div>
											<div class="pure-u-4-6">
												<input class="fleft mt5 btn-flat red app-check-before-submit add_payment_btn" type="button" value="Add payment method">
											</div>
											<input id="dispatcher" class="dnone" type="submit">
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
		</div>
	</div>
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
<script type="text/javascript">
$(document).ready(function(){
	$("#card_number").change(function() {
		var cardNum	= $(this).val();
		var numRegEx = /^\d+$/;
		if(numRegEx.test(cardNum) === false) { // Only Numbers......
			$("#card_number").val('');
			$("#card_number_err").html("<i style='color:#ff4545'>Inavlid Card Number !</i>");
			return false;
		} else {
			$("#card_number_err").html("");
			$.ajax({
				type: 'post',
				url: '{{ url("check-card-number") }}',
				data: 'cardNum='+cardNum,
				success: function(response) {
					if(response == 'exist') {
						$("#card_number").val('');
						$("#card_number_err").html("Card Number <i style='color:#ff4545'> "+cardNum+" </i> already exist !");
					} else {
						$("#card_number_err").html("");
					}
				}
			});
		}
	});
	$('.add_payment_btn').click(function(){
		var card_number		= $("#card_number").val();
		var cardholder_name	= $("#cardholder_name").val();
		var card_cvc		= $("#card_cvc").val();
		var exp_month		= $("#exp_month").val();
		var exp_year		= $("#exp_year").val();
		if(card_number == '' || cardholder_name == '' || card_cvc == '' || exp_month == '' || exp_year == '') {
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
				$.ajax({
					type: 'post',
					url: '{{ url("save-payment-method") }}',
					data: $('#pay-form').serialize()+'&cardType='+cardType,
					success: function(response) {
						if(response == 'done') {
							window.location.href = "{{ url('payment-method') }}";
						}
					}
				});
				$('.incorrect_info').hide();
			}
		}
	});
});
function cardNumber_format(value) {
	// var v = value.replace(/\s+/g, '').replace(/[^0-9]/gi, '')
	// var matches = v.match(/\d{4,16}/g);
	// var match = matches && matches[0] || ''
	// var parts = []
	// for (i=0, len=match.length; i<len; i+=4) {
	// 	parts.push(match.substring(i, i+4))
	// }
	// if (parts.length) {
	// 	$("#card_number").val(parts.join(' '));
	// } else {
	// 	$("#card_number").val(value);
	// }
}
</script>
@endsection