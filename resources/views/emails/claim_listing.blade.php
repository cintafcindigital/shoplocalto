<html>
<body>
<table width="100%" cellpadding="0" cellspacing="0" style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;background-color:#f5f8fa;margin:0;padding:0;width:100%">
   <tbody>
      <tr>
         <td align="center" style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box">
            <table width="100%" cellpadding="0" cellspacing="0" style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;margin:0;padding:0;width:100%">
               <tbody>
                  <tr>
                     <td style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;padding:25px 0;text-align:center">
                        <a target="_blank" href="{{url('/')}}">
                         <img src="{{ asset('public/images/logo.png') }}" width="50%;" alt="My Health Squad Logo" style="width: 50%;">
                        </a>
                     </td>
                  </tr>
                  <tr>
                     <td width="100%" cellpadding="0" cellspacing="0" style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;background-color:#ffffff;border-bottom:1px solid #edeff2;border-top:1px solid #edeff2;margin:0;padding:0;width:100%">
                        <table align="center" width="60%;" cellpadding="0" cellspacing="0" style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;background-color:#ffffff;margin:0 auto;padding:0;width:60%;">
                           <tbody>
                              <tr>
                                 <td style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;padding:35px">
                                    <span class="im">
                                       <p style='margin:0in;margin-bottom:.0001pt;line-height:115%;font-size:19px;font-family:"Arial","sans-serif";'><span style='font-family:"Calibri","sans-serif";'>The My Health Squad online directory is launching in Toronto and is set to be THE resource for individuals looking for alternative and complementary health services and information like yours.<br>&nbsp;</span></p>
                                       <p style='margin:0in;margin-bottom:.0001pt;line-height:115%;font-size:19px;font-family:"Arial","sans-serif";'><span style='font-family:"Calibri","sans-serif";'>We have already added your listing to the directory at no charge but potential clients and patients don&rsquo;t see your contact information, therefore we invite you to claim your listing and upgrade to a premium membership to increase your visibility in the marketplace.</span></p>
                                       <p><span style='font-size:19px;line-height:115%;font-family:"Calibri","sans-serif";'><br>&nbsp;Click <a href="{{url('/dashboard')}}" target="_blank" style="color: #1155CC">here</a> to claim your listing.</span></p>
                                    </span><br>
                                    <p style="font-size: 12px;"><i>Unsubscribe from My Health Squad emails</i><a target="_blank" href="{{url('email-unsubscribe/'.(isset($toEmail)?$toEmail:''))}}" style="text-decoration: none;"> Click here</a></p>
                                 </td>
                              </tr>
                           </tbody>
                        </table>
                     </td>
                  </tr>
                  <tr>
                     <td style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box">
                        <table align="center" width="570" cellpadding="0" cellspacing="0" style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;margin:0 auto;padding:0;text-align:center;width:570px">
                           <tbody>
                              <tr>
                                 <td align="center" style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;padding:35px">
                                    <p style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;line-height:1.5em;margin-top:0;color:#aeaeae;font-size:12px;text-align:center">&copy; {{date('Y')}} <span class="il">My </span> <span class="il">Health</span> Squad. All rights reserved.</p>
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
</body>
</html>