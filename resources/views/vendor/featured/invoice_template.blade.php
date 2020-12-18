<html>
    <head>
    	<meta charset="utf-8"/>
    	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    </head>
<body onload="window.print()">
	<table cellpadding="0" cellspacing="0" style="font-family:'Open Sans',Helvetica,Arial,sans-serif;box-sizing:border-box;padding:45px 0;color: #000;font-size:18px;margin:0 auto;width:70%;line-height:28px;">
		<tbody>
			<tr>
					<td><img src="{{ $pdfdata['pdfImage'] }}" alt="logoimage" style="max-width:100%;width:350px;" />   </td>
					<td>
						<table align="right" style="text-align: right;">
							<tbody>
							<tr> <td style="padding-top:5px;padding-bottom:5px;">My Health Squad</td></tr>
							<tr> <td style="padding-top:5px;padding-bottom:5px;">6975 Meadowvale Town Center Circle,Unit 9</td></tr>
							<tr> <td style="padding-top:5px;padding-bottom:5px;">Missisuauga, Ontario - L5N2VY</td></tr>
							</tbody>
						</table>
					</td>
			</tr>
		</tbody>
	</table>	
	<table cellpadding="0" cellspacing="0" style="font-family:'Open Sans',Helvetica,Arial,sans-serif;box-sizing:border-box;border-top:5px solid #000;padding:20px 50px 50px 20px;color: #000;font-size:16px;margin:0 auto;width:70%;line-height: 28px;">
		<thead>
			<tr>
				<th>
					<h3 style="font-size:20px;font-weight:700;color:black;text-align: left;">
					Billed to:
					</h3>
				</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td></td>
				<td style="padding:10px 15px ;">
					<p style="text-align:right;"><span style="float:left;font-weight:bold;">Date:</span>{{ date('d/m/Y', strtotime(@$pdfdata['invoiceData']->subscription_date)) }}
					</p>
				</td>
			</tr>
			<tr>
				<td style="padding:10px 15px 10px 0;">
					<p>{{@$pdfdata['vendorData'][0]['contact_person']}}</p>
				</td>
				<td style="padding-left:15px;padding-right:15px;">
					<p style="text-align:right;"><span style="font-weight:bold;float:left;">Method:</span>{{@$pdfdata['invoiceData']->payment_method}}</p>
				</td>
			</tr>
			<tr>
			<td style="padding:10px 15px 10px 0;">
					<p>{{ @$pdfdata['vendorData'][0]['company_data']['address'] }}</p>
				</td>
				<td style="padding-left:15px;padding-right:15px ">
					<p style="text-align:right;"><span style="font-weight:bold;float:left;">Receipt # :</span>{{@$pdfdata['invoiceData']->reciept_id}}</p>
				</td>
			</tr>
			<tr>
				<td style="padding:10px 15px 10px 0;">
					<p>{{ @$pdfdata['vendorData'][0]['company_data']['province'] }}</p>
				</td>
				<td style="padding-left:15px;padding-right:15px ">
					<p style="text-align:right;"><span style="font-weight:bold;float:left;">Invoice # :</span>{{ @$pdfdata['invoiceData']->invoice_id }}</p>
				</td>
			</tr>
			<tr>
				<td style="padding:10px 15px 10px 0;">
					<p>{{@$pdfdata['vendorData'][0]['email']}}</p>
				</td>
			
			</tr>
		</tbody>
	</table>
	<table cellpadding="0" cellspacing="0" style="font-family:'Open Sans',Helvetica,Arial,sans-serif;box-sizing:border-box;border-top:5px solid #000;padding:20px 0px 50px 0px;color: #000;font-size:16px;margin:0 auto;width:70%;border-bottom:5px solid #000;line-height:28px;">
		<thead>
			<tr style="text-align:left;border-bottom:5px solid #000;">
				<th style="border-bottom:5px solid #000;padding-bottom:20px;padding-left:20px;">
					Item
				</th>
				<th style="border-bottom:5px solid #000;padding-bottom:20px">
					Description
				</th>
				<th style="border-bottom:5px solid #000;padding-bottom:20px;text-align:center;">
					Rate
				</th>
				<th style="border-bottom:5px solid #000;padding-bottom:20px;text-align:center;">
					Quantity
				</th>
				<th style="border-bottom:5px solid #000;padding-bottom:20px;text-align:center;">
					Price
				</th>
			</tr>
		</thead>
		<tbody>
			@foreach($pdfdata['billData'] as $key => $bd)
			<tr>
				<td style="padding:15px 20px;">{{$key+1}}</td>
				<td style="padding:20px 20px 20px 0;">{{empty($bd->comments) ? '' : $bd->comments}}</td>
				<td style="padding:20px 0;text-align:center;">CA${{number_format($bd->paid_amount,2)}}</td>
				<td style="padding:20px 0;text-align:center;">{{$bd->quantuty}}</td>
				<td style="padding:20px 0;text-align:center;">CA${{number_format($bd->paid_amount*$bd->quantuty,2)}}</td>
			</tr>
			@endforeach
			<tr>
				<td colspan="2" style="padding-top:35px;padding-bottom:5px"></td>	
				<td colspan="3" style="padding-top:35px;padding-bottom:5px">
					<table style="width:100%;text-align:left;">
						<tr>
							<th style="padding-bottom:10px;padding-top:10px;">Subtotal</th>
							<td style="text-align:right;padding-bottom:10px;padding-top:10px;">CA${{number_format(isset($pdfdata['invoiceData']->subscription->amount)?$pdfdata['invoiceData']->subscription->amount:@$pdfdata['invoiceData']->featured_profile->amount, 2) }} </td>
						</tr>	
						<tr >
							<th style="padding-bottom:10px;padding-top:10px;">GST/HST*</th>
							<td style="text-align:right;padding-bottom:10px;padding-top:10px;">CA$0.00 </td>
						</tr>
						<tr>
							<th style="padding-bottom:10px;padding-top:10px;">Invoice</th>
							<td style="text-align:right;padding-bottom:10px;padding-top:10px;">CA${{number_format(isset($pdfdata['invoiceData']->subscription->amount)?$pdfdata['invoiceData']->subscription->amount:@$pdfdata['invoiceData']->featured_profile->amount, 2) }} </td>
						</tr>
						<tr>
							<th style="padding-bottom:10px;padding-top:10px;">Payment</th>
							<td style="text-align:right;padding-bottom:10px;padding-top:10px;">CA${{number_format(isset($pdfdata['invoiceData']->subscription->amount)?$pdfdata['invoiceData']->subscription->amount:@$pdfdata['invoiceData']->featured_profile->amount, 2) }} </td>
						</tr>
						<tr>
							<th style="padding-bottom:10px;padding-top:10px;">Balance</th>
							<td style="text-align:right;padding-bottom:10px;padding-top:10px;">CA$0.00 </td>
						</tr>
					</table>
			</tr>
		</tbody>
	</table>
	<table cellpadding="0" cellspacing="0" style="font-family:'Open Sans',Helvetica,Arial,sans-serif;box-sizing:border-box;padding:20px 70px 70px 20px;color: #000;font-size:16px;margin:0 auto;width:70%;line-height:28px;">
		<thead>
			<tr>
					<th style="text-align:left;padding-bottom:15px;">Notes:</th>
			</tr>
		</thead>
		<tbody style="background-color:#eee;">
			<tr>
				<td style="padding:25px 20px 10px;">1</td>
				<td style="padding:25px 20px 10px;">You'll pay CA$49 (plus applicable taxes) each month for a total of 12 months.<br>You paid 1 month of your subscription; you have 11 months remains.</td>
			</tr>
			<tr>
				<td style="padding:10px 20px;">2</td>
				<td style="padding:10px 20px;">Your annual subscription include the equivalent of 2 months free—amortized over 12 months.</td>
			</tr>
			<tr>
				<td style="padding:10px 20px 35px;">3</td>
				<td style="padding:10px 20px 35px;">HST (Harmonized Sales Tax) breakdown: 8% Ontario tax & 5% GST.</td>
			</tr>	
		</tbody>

	</table>	
</body>
</html>