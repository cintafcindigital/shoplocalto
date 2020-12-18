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
                        <a href="#">
                           <img src="{{ asset('public/images/logo.png') }}" style="width: 50%;" alt="My Health Squad Logo">
                        </a>
                     </td>
                  </tr>
                  <tr>
                     <td width="100%" cellpadding="0" cellspacing="0" style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;background-color:#ffffff;border-bottom:1px solid #edeff2;border-top:1px solid #edeff2;margin:0;padding:0;width:100%">
                        <table align="center" width="570" cellpadding="0" cellspacing="0" style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;background-color:#ffffff;margin:0 auto;padding:0;width:570px">
                           <tbody>
                              <tr>
                                 <td style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;padding:35px">
                                    <span class="im">
                                       <h1 style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;color:#2f3133;font-size:17px;font-weight:bold;margin-top:0;text-align:left">Hi {{$name}},</h1>
                                       <p style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;color:#74787e;font-size:14px;line-height:1.5em;margin-top:0;text-align:left">Your enquiry through My Health Squad has been sent correctly and they'll contact you very soon.</p>
                                       <table width="100%" cellpadding="0" cellspacing="0" style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;padding:0;text-align:left;width:100%">
                                          <tbody>
                                             <tr>
                                                <td colspan="2">
                                                <h1 style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;color:#2f3133;font-size:15px;font-weight:bold;margin-top:0;text-align:left">Your Enquiry :</h1>
                                                </td>
                                             </tr>
                                             <tr>
                                                <td colspan="2" style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;color:#74787e;font-size:15px;"><b>{{$business_name}}</b></td>
                                             </tr>
                                              <tr>
                                                <td colspan="2" style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;color:#74787e;font-size:14px;"><b>Name :</b> {{$name}}</td>
                                             </tr>
                                             <tr>
                                                <td style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;color:#74787e;font-size:14px;"><b>Telephone :</b> {{$phone}}</td>
                                                <!-- <td style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;color:#74787e;font-size:14px;"><b>Event Date :</b> {{$event_date}}</td> -->
                                                <td style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;color:#74787e;font-size:14px;"><b>Email :</b> {{$email}}</td>
                                             </tr>
                                             <tr>
                                                <!-- <td style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;color:#74787e;font-size:14px;"><b>Number Of Guests :</b> {{$number_of_guests}}</td> -->
                                                <td colspan="2" style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;color:#74787e;font-size:14px;"><b>Comment :</b> {{$comment}}</td>
                                             </tr>
                                             <tr>
                                             </tr>
                                          </tbody>
                                       </table>
                                       <p style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;color:#74787e;font-size:14px;line-height:1.5em;margin-top:20px;text-align:left">Regards,<br><span class="il">My</span><span class="il">Health</span> Squad</p>
                                    </span>
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
                                    <p style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;line-height:1.5em;margin-top:0;color:#aeaeae;font-size:12px;text-align:center">&copy; {{date('Y')}} <span class="il">My</span> <span class="il">Health</span> Squad. All rights reserved.</p>
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