@extends('layouts.default')
@section('meta_title',$data['titleData']->meta_title)
@section('meta_keyword',$data['titleData']->meta_keyword)
@section('meta_description',$data['titleData']->meta_description)
@section('content')
@include('includes.menu')
<section class="section-padding dashboard-wrap payment_page_wrp dash_main_sect">
	@include('vendor.tools_nav')
	<div class="wrapper">
		<div class="pure-g mb30">
			<div class="pure-u-2-7">
				<div class="mr40">
					<nav class="adminAside payment_list">
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
			<div class="pure-u-5-7 payment_wrp">
				<h1 class="adminTitle"> Payment methods <span class="adminTitle__counter">({{ count($data['vendorPaym']) }})</span></h1>
				<div id="bills-cab">
					<div class="adminAlert adminAlert--info">
						<p class="adminAlert__title">Manage your payment methods</p>
						<p>Add or remove payment methods associated with your account.</p>
					</div>
				</div>
				@foreach($data['vendorPaym'] as $nm => $ptm)
				<div class="box credit_card_wrp">
					<div class="border-bottom p15 pr20 pl20">
						<p class="m0 clearfix">
							<strong>Credit Card</strong>
							@if($nm == 0)
							<span class="color-green regular">(main account)</span>
							@endif
							<a class="btn btn-primary update_card_btn" style="float:right;" onclick="getUpdater('{{ $ptm->id }}');" role="button"> Update Card </a>
						</p>
					</div>
					<div class="p20 relative">
						<p class="pure-g mb10">
							<span class="regular pure-u-2-10">Cardholder name</span>
							<strong class="pure-u-8-10">{{ strtoupper($ptm->cardholder_name) }}</strong>
						</p>
						<p class="pure-g mb10">
							<span class="regular pure-u-2-10">Card type</span>
							<!-- <span class="pure-u-8-10"><img src="../images/icon-card-visa.png"></span> -->
							@if($ptm->card_type == 'Visa')
							<span class="pure-u-8-10"><i class="icon-vendor icon-vendor-card-visa"></i></span>
							@elseif($ptm->card_type == 'MasterCard')
							<span class="pure-u-8-10"><i class="icon-vendor icon-vendor-card-mastercard"></i></span>
							@elseif($ptm->card_type == 'America Express')
							<span class="pure-u-8-10"><i class="icon-vendor icon-vendor-card-americanexpress"></i></span>
							@endif
						</p>
						<p class="pure-g mb10">
							<span class="regular pure-u-2-10">Card number</span>
							<strong class="pure-u-8-10">{{ str_repeat('*', strlen($ptm->card_number) - 4) . substr($ptm->card_number, -4) }}</strong>
						</p>
						<p class="pure-g mb10">
							<span class="regular pure-u-2-10">Expiration</span>
							<strong class="pure-u-8-10">{{ $ptm->exp_month }}/{{ $ptm->exp_year }}</strong>
						</p>
					</div>
				</div>
				@endforeach
				<a class="btn btn-primary mb20" href="{{url('add-payment-method')}}"> Add payment method </a>
				<!-- <a class="btn btn-primary mb20 ml10 app-emp-renew-credit-card update_card_btn" role="button"> Update Card </a> -->
			</div>
		</div>
	</div>
</section>
<style>
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
<div id="app-va-modal" class="update_card_detail modal fade dnone in" tabindex="-1" role="dialog" aria-hidden="false" style="display: none;">
	<div class="modal-dialog modal-large">
		<div class="modal-content">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<div class="adminModalHeader adminModalHeader--bg">
				<span class="adminModalIcon adminModalIcon--card"></span>
				<h2 class="adminModalTitle">Your credit card details</h2>
			</div>
			<div class="adminModalContent">
				<div id="divShowChanges" class="alert alert-error dnone">
					<p>Incorrect date. Check the date entered...</p>
				</div>
				<div id="divShowChangesEmpty" class="alert alert-error dnone">
					<p>You must select your card expiration date.</p>
				</div>
				<p class="fs13 mb30">To keep paying with this card, please update the card information within your account. Otherwise, add a new payment method to maintain your Premium PerfectWedding membership. </p>
				<p class="creadit_card_no"></p>
				<div class="pure-g">
					<div class="pure-u-1-6">
						<small class="color-grey" style="font-size:12px;">New expiration date</small>
					</div>
					<form class="pure-u-5-6 pl20" id="addCCExpired" name="card_form">
						<div class="pure-u-1-4 vertical-middle select-fake mr15">
							<input type="hidden" name="payId" id="payId">
							<select id="expiryMonth" name="expiryMonth">
								<option value="">Month</option>
								@for($mnth = 1; $mnth <= 12; $mnth++)
									@if($mnth < 10)
									<option value="0{{$mnth}}">0{{$mnth}}</option>
									@else
									<option value="{{$mnth}}">{{$mnth}}</option>
									@endif
								@endfor
							</select>
						</div>
						<div class="pure-u-1-4 vertical-middle select-fake mr10">
							<select id="expiryYear" name="expiryYear">
								<option value="">Year</option>
								@for($yrs = date('Y'); $yrs <= date('Y')+20; $yrs++)
									<option value="{{$yrs}}">{{$yrs}}</option>
								@endfor
							</select>
						</div>
						<input class="btn-flat red app-add-payment-expired" type="button" value="Update">
					</form>
				</div>
				<!-- <a class="pointer block mt20 app-remind-payment-expired remind_me_text" role="button"> Remind me later </a> -->
			</div>
			<footer class="adminModalFooter">
				<p class="mt10 mb0 pure-u mr20">Do you want to pay with a different card?</p>
				<a class="btn-outline outline-red shape-square" href="{{url('add-payment-method')}}">Change card</a>
			</footer>
		</div>
	</div>
	<div class="popup_overlay" style="display: none;"></div>
</div>
@include('includes.footer')
<script type="text/javascript">
$(document).ready(function(){
	// $('.update_card_btn').click(function(){
	// 	$('.update_card_detail').show();
	// 	$('body').addClass('modal-open');
	// 	$('.popup_overlay').show();
	// });
	$('.update_card_detail .close').click(function(){
		$('.update_card_detail').hide();
		$('body').removeClass('modal-open');
		$('.popup_overlay').hide();
	});
	$('.app-add-payment-expired').click(function(){
		if(document.card_form.expiryMonth.selectedIndex==0 || document.card_form.expiryYear.selectedIndex==0) {
			$('#divShowChangesEmpty').show();
		} else {
			$('#divShowChangesEmpty').hide();
			var yers = $("#expiryYear").val();
			var mnth = $("#expiryMonth").val();
			var cyrs = "{{ date('Y') }}";
			var cmth = "{{ date('m') }}";
			if(Number(yers) > Number(cyrs)) {
				$('#divShowChanges').hide();
				updateCard();
			} else
			if(Number(yers) == Number(cyrs) && Number(mnth) >= Number(cmth)) {
				$('#divShowChanges').hide();
				updateCard();
			} else {
				$('#divShowChanges').show();
			}
		}
	});
});
var payId = '';
function getUpdater(id)
{
	var cardData = '';
	<?php
	foreach($data['vendorPaym'] as $ptm) {
		$cardImg = '';
		if($ptm->card_type == 'Visa') {
			$cardImg = "Credit card: <i class='icon-vendor icon-vendor-card-visa'></i> <span> ".str_repeat('*', strlen($ptm->card_number) - 4) . substr($ptm->card_number, -4)."</span>";
		}else
		if($ptm->card_type == 'MasterCard') {
			$cardImg = "Credit card: <i class='icon-vendor icon-vendor-card-mastercard'></i> <span> ".str_repeat('*', strlen($ptm->card_number) - 4) . substr($ptm->card_number, -4)."</span>";
		}else
		if($ptm->card_type == 'America Express') {
			$cardImg = "Credit card: <i class='icon-vendor icon-vendor-card-americanexpress'></i> <span> ".str_repeat('*', strlen($ptm->card_number) - 4) . substr($ptm->card_number, -4)."</span>";
		}
		?>
		var forId = "{{ $ptm->id }}";
		if(Number(forId) == Number(id)) {
			cardData = "{!! $cardImg !!}";
		}
		<?php
	}
	?>
	$("#payId").val(id);
	$('.update_card_detail').show();
	$(".creadit_card_no").html(cardData);
	$('body').addClass('modal-open');
	$('.popup_overlay').show();
}
function updateCard()
{
	var payId = $("#payId").val();
	if(payId) {
		$.ajax({
			type: 'post',
			url: '{{ url("update-payment-method") }}',
			data: $('#addCCExpired').serialize(),
			success: function(response) {
				if(response == 'done') {
					$('.update_card_detail').hide();
					window.location.href = "{{ url('payment-method') }}";
				}
			}
		});
	}
}
</script>
@endsection