<div style="width:100%!important;min-width:100%;color:#616161;font-family:'Open Sans',Helvetica,Arial,sans-serif;font-weight:normal;text-align:left;font-size:14px;line-height:21px" bgcolor="#f6f3f2">
	<table width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#f6f3f2">
		<tbody>
			<tr>
				<td valign="top" align="center">
					<table width="100%" cellspacing="0" cellpadding="0" border="0">
						<tbody>
							<tr>
								<td style="padding:0px;padding-bottom:10px" valign="top" align="center">
									<span style="font-size:11px;color:#9c9c9c">{{$name}} wants to know more about @if($roleType == 'admin') vendor @else your @endif services</span>
								</td>
							</tr>
						</tbody>
					</table>
					<table width="100%" cellspacing="0" cellpadding="0" border="0">
						<tbody>
							<tr>
								<td style="padding:20px 0;height:30px" valign="top" height="38" align="center">
									<center style="width:100%;min-width:580px">
										<a border="0" href="{{url('/')}}" target="_blank">
											<img src="{{ asset('public/images/logo.png') }}" style="max-width:50%;margin:0px auto 0px;height:38px!important;max-height:38px!important" class="CToWUd" height="38" border="0" align="middle">
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
									<table width="100%" cellspacing="0" cellpadding="0">
										<tbody>
											<tr>
												<td style="padding:30px 20px 10px 20px" align="center">
													<span style="font-weight:600;font-size:20px"> New lead </span>
												</td>
											</tr>
										</tbody>
									</table>
									<table width="100%" cellspacing="0" cellpadding="0">
										<tbody>
											<tr>
												<td style="padding:10px 30px 30px" align="center">
													<span><b>{{$name}}</b> has contacted @if($roleType == 'admin') vendor @else your @endif business (<b>{{$business_name}}</b>) through MyHealthSquad to request more information about @if($roleType == 'admin') vendor @else your @endif services.</span>
												</td>
											</tr>
										</tbody>
									</table>
									<table width="100%" cellspacing="0" cellpadding="0">
										<tbody>
											<tr>
												<td style="background-color:#f6f3f2;height:18px"> &nbsp; </td>
											</tr>
											<tr>
												<td align="center"><img src="{{asset('images/downArrow.gif')}}" style="vertical-align:top" width="30" height="12"></td>
											</tr>
										</tbody>
									</table>
									@if($roleType != 'admin')
										<table style="border-bottom:1px solid #e8e8e8" width="100%" cellspacing="0" cellpadding="0">
											<tbody>
												<tr>
													<td style="padding:5px 30px 10px 30px"><span>Hi!</span></td>
												</tr>
												<tr>
													<td style="padding:0px 30px 10px 30px" align="left">
														<span>A potential client has requested information from your company through your free listing on My Health Squad. If you would like to claim the lead and get more like it, please click here to see packages ( <a href="{{url('payment-lead-details').'/'.$vendor_id}}" target="_blank">Claim / Upgrade</a> ).</span>
													</td>
												</tr>
											</tbody>
										</table>
										<table style="border-bottom:1px solid #e8e8e8" width="100%" cellspacing="0" cellpadding="0">
											<tbody>
												<tr>
													<td style="padding:10px 30px" align="left">
														<table width="100%" cellspacing="0" cellpadding="0">
															<tbody>
																<tr>
																	<td style="padding:10px 30px" valign="top" align="left">
																		<b style="font-size:17px;">Lead details will include :</b>
																	</td>
																</tr>
																<tr>
																	<td style="padding:5px 30px" valign="top" align="left">
																		<b>Name :</b><span> {{$name}}</span>
																	</td>
																</tr>
																<tr>
																	<td style="padding:5px 30px" valign="top" align="left">
																		<b>Email :</b><span> {{$email}}</span>
																	</td>
																</tr>
																<tr>
																	<td style="padding:5px 30px" valign="top" align="left">
																		<b>Phone :</b><span> {{$phone}}</span>
																	</td>
																</tr>
																<!-- <tr>
																	<td style="padding:5px 30px" valign="top" align="left">
																		<b>Consulting Date :</b><span> {{date_format(date_create($event_date),'d/m/Y')}}</span>
																	</td>
																</tr> -->
																<tr>
																	<td style="padding:5px 30px">{{$comment}}</td>
																</tr>
															</tbody>
														</table>
													</td>
												</tr>
												<tr>
													<td style="padding:10px 30px" align="left">
														<span>My Health Squad is an inclusive, health obsessed team and we’d be happy to help you grow your business and make meaningful connections.</span>
													</td>
												</tr>
												<tr>
													<td style="padding:5px 30px" align="left">
														<b>Live healthy & prosper !</b>
													</td>
												</tr>
												<tr>
													<td style="padding:0px 30px 20px 30px" align="left">
														<b>My Health Squad </b>
													</td>
												</tr>
											</tbody>
										</table>
										<table width="100%" cellspacing="0" cellpadding="0">
											<tbody>
												<tr>
													<td style="padding:20px" align="center">Unsubscribe from My Health Squad emails (<a href="{{url('email-unsubscribe/'.(isset($toEmail)?$toEmail:''))}}">link</a>)</td>
												</tr>
											</tbody>
										</table>
									@else
										<table style="border-bottom:1px solid #e8e8e8" width="100%" cellspacing="0" cellpadding="0">
											<tbody>
												<tr>
													<td style="padding:5px 30px 20px 30px"><span>Message from {{$name}}</span></td>
												</tr>
											</tbody>
										</table>
										<table style="border-bottom:1px solid #e8e8e8" width="100%" cellspacing="0" cellpadding="0">
											<tbody>
												<tr>
													<td style="padding:20px 30px" align="left">
														<table width="100%" cellspacing="0" cellpadding="0">
															<tbody>
																<tr>
																	<td width="55%" valign="top" align="left">
																		<table width="100%" cellspacing="0" cellpadding="0">
																			<tbody>
																				<tr>
																					<td style="padding-bottom:5px">
																						<b>Category :</b> {{$category_title}} / {{$province}}
																					</td>
																				</tr>
																				<!-- <tr>
																					<td style="padding:5px 0">
																						<b>Event date :</b><span> {{date_format(date_create($event_date),'d/m/Y')}}</span>
																					</td>
																				</tr> -->
																			</tbody>
																		</table>
																	</td>
																	<td width="45%" valign="top" align="left">
																		<table width="100%" cellspacing="0" cellpadding="0">
																			<tbody>
																				<tr>
																					<td style="padding-bottom:5px">
																						<b>Email :</b><span> {{$email}}</span>
																					</td>
																				</tr>
																				<tr>
																					<td style="padding:5px 0 5px 0">
																						<b>Phone number :</b><span> {{$phone}}</span>
																					</td>
																				</tr>
																			</tbody>
																		</table>
																	</td>
																</tr>
																<tr>
																	<td colspan="2" style="padding:10px 0 5px">{{$comment}}</td>
																</tr>
															</tbody>
														</table>
													</td>
												</tr>
											</tbody>
										</table>
									@endif
								</td>
							</tr>
						</tbody>
					</table>
					<br>
					<!-- <table style="width:580px;" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#FFFFFF">
						<tbody>
							<tr>
								<td style="line-height:0" width="200" valign="bottom" align="center"> <img src="{{asset('images/unnamed_mod.jpg')}}" class="CToWUd" width="148" border="0"> </td>
								<td style="padding:20px" valign="middle" align="center">
									<table style="border-collapse:collapse" width="49%" cellspacing="0" cellpadding="0" align="left">
										<tbody>
											<tr>
												<td style="padding:10px 10px 0 0" align="right">
													<a style="display:inline-block;color:#ffffff;text-decoration:none;padding:0;border-radius:3px;max-width:100%;overflow:hidden;" href="javascript:;" target="_blank">
														<table style="border-spacing:0;border-collapse:collapse;vertical-align:top;display:inline-block;padding:0">
															<tbody>
																<tr>
																	<td style="border-collapse:collapse!important;vertical-align:top;color:#ffffff;display:block;width:auto!important;border:2px solid #19b5bc;margin:0;padding:10px 15px;border-radius:3px" valign="top">
																		<span style="text-decoration:none;color:#ffffff;font-weight:bold">
																			<a style="color:#19b5bc;text-decoration:none;padding:0;border-radius:2px;max-width:100%" href="javascript:;" target="_blank"> iPhone </a>
																		</span>
																	</td>
																</tr>
															</tbody>
														</table>
													</a>
												</td>
											</tr>
										</tbody>
									</table>
									<table style="border-collapse:collapse" width="49%" cellspacing="0" cellpadding="0">
										<tbody>
											<tr>
												<td style="padding:10px 0 0 0">
													<a style="display:inline-block;color:#ffffff;text-decoration:none;padding:0;border-radius:3px;max-width:100%;overflow:hidden" href="javascript:;" target="_blank">
														<table style="border-spacing:0;border-collapse:collapse;vertical-align:top;display:inline-block;padding:0">
															<tbody>
																<tr>
																	<td style="border-collapse:collapse!important;vertical-align:top;color:#ffffff;display:block;width:auto!important;border:2px solid #19b5bc;margin:0;padding:10px 15px;border-radius:3px" valign="top">
																		<span style="text-decoration:none;color:#ffffff;font-weight:bold">
																			<a style="color:#19b5bc;text-decoration:none;padding:0;border-radius:2px;max-width:100%" href="javascript:;" target="_blank"> Android </a>
																		</span>
																	</td>
																</tr>
															</tbody>
														</table>
													</a>
												</td>
											</tr>
										</tbody>
									</table>
								</td>
							</tr>
						</tbody>
					</table> -->
					<table style="width:580px" cellspacing="0" cellpadding="0" border="0">
						<tbody>
							<tr>
								<td style="padding:15px" valign="top" align="center">
									<span style="font-size:11px;color:#6c6c6c;line-height:18px">
										<a style="color:#8c8c8c;" href="javascript:;">Manage your preferences</a> | <a style="color:#8c8c8c;" href="{{url('email-unsubscribe/'.(isset($toEmail)?$toEmail:''))}}" target="_blank">Unsubscribe from all myhealthsquad<span>.</span>ca marketing emails</a> <br>You will continue to receive transactional and account-related electronic messages from myhealthsquad<span>.</span>ca
										<p><a href="{{url('/')}}" target="_blank">{{url('/')}}</a>., {{!empty($category_title)?$category_title.',':''}} {{$business_address}} ({{$province}}, {{$country}})</p>
									</span>
								</td>
							</tr>
						</tbody>
					</table>
				</td>
			</tr>
		</tbody>
	</table>
</div>