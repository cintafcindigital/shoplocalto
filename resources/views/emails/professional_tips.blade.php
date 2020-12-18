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
                                       <h1 style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;color:#2f3133;font-size:19px;font-weight:bold;margin-top:0;text-align:left">Hello {{isset($name)?$name:''}},</h1>
                                       <p style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;color:#000;font-size:16px;line-height:1.5em;margin-top:0;text-align:left">We are all about helping you be the best and there are a few tips and tricks we’d like to share to get you started. Today’s Tips: <strong><u>Creating a compelling profile:</u></strong></p>
                                       <p><span style="font-weight: 600;">Tip 1:</span> Pictures! We all know: a picture is worth a thousand words. Photos are what draws potential clients - it’s even more true in the health industry. Show off your best side with high quality photos that show off who you are, your installation and what you do. Photos should be a minimum of 5 MB size and you should upload the max. allowed 10 no.s if you can. Finally, make sure you include as much information as possible about your location including parking, access to wheelchair; this could make a difference for many of your potential clients. </p>
                                       <p><span style="font-weight: 600;">Tip 2:</span> Your business description should be kept short and to the point. Reference your service areas and top products in the description. Your description should focus on ‘what’s in it for me’ not just features.</p>
                                       <p><span style="font-weight: 600;">Tip 3:</span> Contact info. Make sure that the contact information for leads will be going to an email that is monitored 7 days a week. That email can be different from the billing email.</p>
                                       <p><span style="font-weight: 600;">Tip 4:</span> Meet the team. Adding photos and profiles of team members your potential clients will interact with helps bring a face to the name. Make sure your staff are using professional pictures and that they are smiling. It’s also your chance to brag about the quality and experience of your team.</p>
                                       <p><span style="font-weight: 600;">Tip 5:</span> Contribute to the My Health Squad community by providing blog and other content. This will build your brand, build your credibility and increase visibility of your business and your profession. People could recognize you one day from this little difference you made by providing useful and relevant information.</p>
                                       @if(isset($vendors) && count((array) $vendors) > 0)
                                       <p style="width: 100%;"><span style="background: #ff0;">Some examples of great profiles:</span></p>
                                       <table width="100%" style="background: #ff0;">
                                          <tr>
                                             <th><a href="{{url('example/vendor/example-1')}}" style="text-decoration: none;color: #000;" target="_blank">Example 1</a></th>
                                             <th><a href="{{url('example/vendor/example-2')}}" style="text-decoration: none;color: #000;" target="_blank">Example 2</a></th>
                                             <th><a href="{{url('example/vendor/example-3')}}" style="text-decoration: none;color: #000;" target="_blank">Example 3</a></th>
                                          </tr>
                                       </table>
                                       @endif
                                       <table align="center" width="100%" cellpadding="0" cellspacing="0" style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;padding:0;text-align:center;width:100%">
                                          <tbody>
                                             <tr>
                                                <td align="center" style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box">
                                                </td>
                                             </tr>
                                          </tbody>
                                       </table>
                                       <p style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;color:#000;font-size:16px;line-height:1.5em;margin-top:0;text-align:left"></p>
                                       <p style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;color:#000;font-size:14px;line-height:1.5em;margin-top:0;text-align:left">Live healthy & prosper! <br><span class="il">My</span> <span class="il">Health</span> Squad</p>
                                    </span>
                                    <p style="font-size: 12px;"><i>Unsubscribe from My Health Squad emails</i><a href="{{url('email-unsubscribe/'.(isset($toEmail)?$toEmail:''))}}" style="text-decoration: none;"> Click here</a></p>
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