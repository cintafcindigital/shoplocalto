<div class="replyresend-wr" style="width:100%!important;min-width:100%;color:#616161;font-family:'Open Sans',Helvetica,Arial,sans-serif;font-weight:normal;text-align:left;font-size:14px;line-height:21px" bgcolor="#f6f3f2">
    <table width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#f6f3f2">
        <tbody>
            <tr>
                <td valign="top" align="center">
                    <table width="100%" cellspacing="0" cellpadding="0" border="0">
                        <tbody>
                            <tr>
                                <td style="padding:20px 0;height:30px" valign="top" height="38" align="center">
                                    <center style="width:100%;min-width:580px">
                                        <a border="0" href="{{ url('/') }}" target="_blank">
                                         <img src="{{ url('public/images') }}/logo.png" style="max-width:100%;margin:0px auto 0px;height:38px!important;max-height:38px!important" class="CToWUd" height="38" border="0" align="middle"> </a>
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
                                                <td style="padding:30px 20px 10px 20px" align="center"> <span style="font-weight:600;font-size:20px"> New lead </span> </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table width="100%" cellspacing="0" cellpadding="0">
                                        <tbody>
                                            <tr>
                                                <td style="padding:10px 30px 30px" align="center">  <b>{{ $enq_name }}</b> has contacted your business (<b>{{ $business_name }}</b>) through My Health Squad to request more information about your services. </span> </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table width="100%" cellspacing="0" cellpadding="0">
                                        <tbody>
                                            <tr>
                                                <td style="background-color:#f6f3f2;height:18px"> &nbsp; </td>
                                            </tr>
                                            <tr>
                                                <td align="center"> <img src="{{ url('public/images') }}/caret_down.gif" alt="" style="vertical-align:top" class="CToWUd" width="30" height="12"> </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table style="border-bottom:1px solid #e8e8e8" width="100%" cellspacing="0" cellpadding="0">
                                        <tbody>
                                            <tr>
                                                <td style="padding:5px 30px 20px 30px"> <span>Message from <b>{{ $enq_name }}</b></span> </td>
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
                                                                                <td style="padding-bottom:5px"> <b>Category:</b> {{ $business_category }} / {{ $business_province }} </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="padding:5px 0"> <b>Event date:</b> <span>
                                                                                    {{ date('d/m/Y', strtotime($enq_eventdate)) }}
                                                                                </span> </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                                <td width="45%" valign="top" align="left">
                                                                    <table width="100%" cellspacing="0" cellpadding="0">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td style="padding-bottom:5px"> <b>Email:</b> <span><a href="mailto:{{ $enq_email }}" target="_blank">{{ $enq_email }}</a></span> </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="padding:5px 0 5px 0"> <b>Phone number:</b> <span>{{ $enq_phone }}</span> </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2" style="padding:10px 0 5px"> {!! $enq_message !!} </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table width="100%" cellspacing="0" cellpadding="0">
                                        <tbody>
                                            <tr>
                                                <td style="padding:20px" align="center"> Reply to leads from your Dashboard.
                                                    <br> </td>
                                            </tr>
                                            <tr>
                                                <td style="padding-bottom:15px" align="center">
                                                    <a style="display:inline-block;color:#ffffff;text-decoration:none;padding:0;border-radius:3px;max-width:100%;overflow:hidden" href="" target="_blank">
                                                        <table style="border-spacing:0;border-collapse:collapse;vertical-align:top;display:inline-block;padding:0">
                                                            <tbody>
                                                                <tr>
                                                                    <td style="border-collapse:collapse!important;vertical-align:top;color:#ffffff;display:block;width:auto!important;background:#19b5bc;border:1px solid #19b5bc;margin:0;padding:10px 15px;border-radius:3px" valign="top" bgcolor="#19b5bc"> <span style="text-decoration:none;color:#ffffff;font-weight:bold"> <a style="color:#ffffff;text-decoration:none;padding:0;border-radius:2px;max-width:100%" href="{{ $enq_url }}" target="_blank" > Respond </a> </span> 
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="padding:0 0 10px 0" align="center"> Or reply directly to this email </td>
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