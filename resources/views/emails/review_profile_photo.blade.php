<div style="font-family:Helvetica,Arial,sans-serif;" bgcolor="#f6f3f2">
	<table width="100%" bgcolor="#f6f3f2">
		<tbody>
			<tr>
				<td valign="top" align="center">
					<table width="100%" cellspacing="0" cellpadding="0" border="0">
						<tbody>
							<tr>
								<td style="padding:20px 0;height:38px" valign="top" height="38" align="center">
									<center style="width:100%;min-width:580px">
										<a border="0" href="{{ $baseUrl }}" target="_blank">
											<img src="{{ asset('images/logo.png') }}" alt="" height="71" width="178" border="0" align="middle" style="width: 50%;">
										</a>
									</center>
								</td>
							</tr>
						</tbody>
					</table>
					<table style="width:580px;border-radius:4px" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
						<tbody>
							<tr>
								<td valign="top" align="center">
									<table width="100%" cellspacing="0" cellpadding="0" align="center">
										<tbody>
											<tr>
												<td style="padding:30px 10px 20px" align="center">
													<a style="margin:0;max-width:580px;display:block;padding:0;border-style:none;overflow:hidden" border="0" href="{{ $reviewLink }}" target="_blank">
														<img style="width:102px;max-width:100%;border:1px solid #cbcbcb" src="{{ $vendorLogo }}" width="102" height="80" border="0">
													</a>
												</td>
											</tr>
										</tbody>
									</table>
									<table width="100%" cellspacing="0" cellpadding="0" border="0">
										<tbody>
											<tr>
												<td style="padding:0 30px 10px 20px" align="center">
													<span style="font-family:'Avenir Next',Avenir,Arial,sans-serif;color:#444444;font-size:16px;font-weight:600"> {{ $vendorName }} invites you to upload your profile photo </span>
												</td>
											</tr>
											<tr>
												<td style="padding:0 20px 20px 20px;border-bottom:1px solid #e5e5e5" align="center">
													<span style="font-size:14px;color:#444444;"> Reviews with photos have more credibility as engaged couples consider your feedback to help select their vendor team. </span>
												</td>
											</tr>
										</tbody>
									</table>
									<table style="border-bottom:1px solid #e5e5e5" width="100%" cellspacing="0" cellpadding="0" border="0">
										<tbody>
											<tr>
												<td style="padding:25px 0 25px 25px;width:42px" valign="top" align="left">
													<img src="{{ asset('images/leftQuotes.gif') }}" width="42" height="30">
												</td>
												<td style="font-size:14px;padding:20px 25px;color:#444444;"> Hi {{ $userName }}, <br> {!! $messages !!} </td>
												<td style="padding:25px 25px 25px 0;width:42px" valign="bottom" align="right">
													<img src="{{ asset('images/rightQuotes.gif') }}" width="42" height="30">
												</td>
											</tr>
										</tbody>
									</table>
									<table width="100%" cellspacing="0" cellpadding="0" border="0">
										<tbody>
											<tr>
												<td style="padding:30px 0 30px 0" align="center">
													<a href="{{ $reviewLink }}" target="_blank" style="border:1px solid #19b5bc;padding:10px 15px;border-radius:3px;background: #19b5bc;color:#FFFFFF;text-decoration:none;font-weight:bolder;"> Add profile photo </a>
												</td>
											</tr>
										</tbody>
									</table>
								</td>
							</tr>
						</tbody>
					</table>
					<table style="width:580px" cellspacing="0" cellpadding="0">
						<tbody>
							<tr>
								<td style="padding:15px 0" valign="top" align="left">
									<table width="100%" cellspacing="0" cellpadding="0">
										<tbody>
											<tr>
												<td style="font-size:11px;color:#666666" align="center">
													<a style="color:#8c8c8c" href="javascript:void(0)"> Manage your preferences </a> | <a style="color:#8c8c8c" href="{{url('email-unsubscribe/'.(isset($toEmail)?$toEmail:''))}}" target="_blank">Unsubscribe from all MyHealthSquad<span>.</span>ca marketing emails</a><br>
													You will continue to receive transactional and account-related electronic messages from MyHealthSquad<span>.</span>ca
													<p><a href="{{ $baseUrl }}" target="_blank">{{url('/')}}</a>, {{ $address }} </p>
												</td>
											</tr>
										</tbody>
									</table>
								</td>
							</tr>
						</tbody>
					</table>
				</td>
			</tr>
		</tbody>
	</table>
</div>