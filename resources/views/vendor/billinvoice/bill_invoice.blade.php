<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
		<link rel="stylesheet" href="{{ asset('css/base.css') }}"/>
		<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}"/>
		<link rel="stylesheet" href="{{ asset('css/style.css') }}"/>
		<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/> -->
		<!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,700|Roboto:300,400,500,700|Dancing+Script"/> -->
		<title></title>
	</head>
	<body onload="window.print()">
		<section id="about-section" style="padding: 25px 0">
			<div class="container">
				<div align="center"><img style="width:200px;height:71px;" src="{{ $pdfdata['pdfImage'] }}" alt=""></div>
				<table width="100%">
					<tbody>
						<tr>
							<td width="20%" align="left"><b>HealthProfessionalPlanner SL </b></td>
							<td width="60%"></td>
							<td width="20%" align="right"><b>Invoice</b></td>
						</tr>
					</tbody>
				</table>
				<hr style="border:1px solid #616263; margin: 10px 0 20px"/>
				<table width="100%">
					<tbody>
						<tr>
							<td width="50%">
								<p> Registration Number: PWD{{ @$pdfdata['vendorData'][0]['vendor_id'] }}CN{{ @$pdfdata['vendorData'][0]['company_data']['id'] }} </p>
								<p> {{ @$pdfdata['vendorData'][0]['company_data']['business_name'] }} </p>
								<p> {{ @$pdfdata['vendorData'][0]['company_data']['address'] }} </p>
								<p> {{ @$pdfdata['vendorData'][0]['company_data']['province'] }}, {{ @$pdfdata['vendorData'][0]['company_data']['city'] }}, {{ @$pdfdata['vendorData'][0]['company_data']['postal_code'] }}  </p>
								<p> {{ ucfirst(@$pdfdata['vendorData'][0]['company_data']['country']) }} </p>
							</td>
							<td width="50%" style="border:2px solid #616263;padding:10px;">
								<p><b> Bill To:- </b></p>
								<p><b> {{ @$pdfdata['vendorData'][0]['company_data']['business_name'] }} </b></p>
								<p><b> {{ @$pdfdata['vendorData'][0]['company_data']['address'] }} </b></p>
								<p><b> {{ @$pdfdata['vendorData'][0]['company_data']['province'] }}, {{ @$pdfdata['vendorData'][0]['company_data']['city'] }}, {{ @$pdfdata['vendorData'][0]['company_data']['postal_code'] }} </b></p>
								<p><b> {{ ucfirst(@$pdfdata['vendorData'][0]['company_data']['country']) }} </b></p>
							</td>
						</tr>
						<tr><td colspan="2"><br/><br/></td></tr>
						<tr>
							<td colspan="2">
								<p> <b>Invoice No.</b> {{ $pdfdata['invoiceData']->invoice_id }} </p>
								<p> <b>Date:</b> {{ date('d/m/Y', strtotime($pdfdata['invoiceData']->subscription_date)) }} </p>
								<p> <b>Contract No.</b> CA0{{ $pdfdata['invoiceData']->id }} </p>
								<p> <b>Contract start date:</b> {{ date('d/m/Y', strtotime($pdfdata['invoiceData']->subscription_date)) }} </p>
								<p> <b>Contract end date:</b> {{ date('d/m/Y', strtotime($pdfdata['invoiceData']->due_date)) }} </p>
							</td>
						</tr>
					</tbody>
				</table><br>
				<table width="100%">
					<thead>
						<tr>
							<th width="40%">Product</th>
							<th width="10%">Qty</th>
							<th width="10%">Rate</th>
							<th width="10%">Amount</th>
							<th width="10%">VAT</th>
							<th width="10%">Discount</th>
							<th width="10%">Total</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td colspan="7"><hr style="border:1px solid #616263;"/></td>
						</tr>
						<tr>
							<td><b>{{ $pdfdata['invoiceData']->subscription->type }} ( {{ $pdfdata['invoiceData']->subscription->duration }} ) </b></td>
							<td> 1 </td>
							<td> {{ number_format($pdfdata['invoiceData']->subscription->amount, 2) }} </td>
							<td> {{ number_format($pdfdata['invoiceData']->subscription->amount, 2) }} </td>
							<td> 0% </td>
							<td> 00</td>
							<td> {{ number_format($pdfdata['invoiceData']->subscription->amount, 2) }} </td>
						</tr>
					</tbody>
				</table><br/><br/><br/>
				<table width="100%">
					<thead>
						<tr>
							<th width="25%">% IVA</th>
							<th width="15%">Sub-Total</th>
							<th width="15%">Discount</th>
							<th width="15%">Sub-Total</th>
							<th width="15%">VAT Total</th>
							<th width="15%">Invoice Total</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td colspan="6"><hr style="border:1px solid #616263;"/></td>
						</tr>
						<tr>
							<td>0%</td>
							<td>{{ number_format($pdfdata['invoiceData']->subscription->amount, 2) }}</td>
							<td>-00</td>
							<td>{{ number_format($pdfdata['invoiceData']->subscription->amount, 2) }}</td>
							<td>0.00</td>
							<td>{{ number_format($pdfdata['invoiceData']->subscription->amount, 2) }}</td>
						</tr>
						<tr>
							<td></td>
							<td>0.00</td>
							<td>0.00</td>
							<td>0.00</td>
							<td>0.00</td>
							<td>0.00</td>
						</tr>
						<tr>
							<td colspan="6"><hr style="border:1px solid #616263;"/></td>
						</tr>
						<tr>
							<th></th>
							<th>{{ number_format($pdfdata['invoiceData']->subscription->amount, 2) }}</th>
							<th>$-00,00</th>
							<th>{{ number_format($pdfdata['invoiceData']->subscription->amount, 2) }}</th>
							<th>$0.00</th>
							<th>{{ number_format($pdfdata['invoiceData']->subscription->amount, 2) }}</th>
						</tr>
					</tbody>
				</table><br/><br/>
				<table width="100%">
					<thead>
						<tr>
							<td>
								<p><b>Memo:</b></p>
								<p><b>Form of Payment:</b> {{ $pdfdata['billData'][0]->carddata->card_type }}</p>
								<p><b>Due Dates</b></p>
							</td>
						</tr>
					</thead>
				</table><br/>
				<table width="100%">
					<tbody>
						<tr>
							<?php
							$nm = 0;
							foreach($pdfdata['billData'] as $bd) {
								$nm++;
								if($nm == 1){ echo "<td width='10%'></td>"; }
							?>
								<td width="15%"><b>{{ date_format(date_create($bd->due_date),'d/m/Y') }}</b></td>
								<td width="15%">${{ number_format($bd->paid_amount, 2) }}</td>
							<?php
								if($nm % 3 == 0){ echo "</tr><tr><td width='10%'></td>"; }
							}
							?>
						</tr>
						<tr><td colspan="7"><br/></td></tr>
						<tr>
							<td colspan="6"></td>
							<td><b>Currency:</b> CAD </td>
						</tr>
					</tbody>
				</table><br/><br/><br/>
			</div>
		</section>
	</body>
</html>