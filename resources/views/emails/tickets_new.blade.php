<html>
<body>
<table width="100%" cellpadding="0" cellspacing="0" style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;background-color:#ffffff;margin:0;padding:0;width:100%">
   <tbody>
      <tr>
         <td align="center" style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box">
            <table width="100%" cellpadding="0" cellspacing="0" style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;margin:0;padding:0;width:100%">
               <tbody>
                  <tr>
                     <td style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;padding:25px 0;text-align:center">
                        <a href="#">
                           <img src="{{$mailData['siteLogo']}}" style="width: 50%;" alt="My Health Squad Logo">
                        </a>
                     </td>
                  </tr>
                  <tr>
                     <td width="100%" cellpadding="0" cellspacing="0" style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;background-color:#ffffff;border-bottom:1px solid #edeff2;border-top:1px solid #edeff2;margin:0;padding:0;width:100%">
                        <table align="center" width="800" cellpadding="0" cellspacing="0" style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;background-color:#ffffff;margin:0 auto;padding:0;width:800px">
                           <tbody>
                              <tr>
                                 <td style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;padding:35px">
                                    <span class="im">
                                       <h1 style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;color:#2f3133;font-size:19px;font-weight:bold;margin-top:0;text-align:left">Thank you for connecting with our {{ucwords($mailData['subject'])}} Department.</h1>
                                       <p style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;color:#74787e;font-size:16px;line-height:1.5em;margin-top:0;text-align:left">One of our trained support staff will review your issue and get back to you with in 24 hours.</p>
                                       <!-- <h2 style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;color:#2f3133;font-size:17px;font-weight:bold;margin-top:0;text-align:left">Message by {{$mailData['name']}},</h2> -->
                                       <table align="center" width="100%" cellpadding="0" cellspacing="0" style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;padding:0;text-align:center;width:100%">
                                          <tbody>
                                             <tr>
                                                <td style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box"></td>
                                             </tr>
                                          </tbody>
                                       </table>
                                       <p style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;color:#74787e;font-size:16px;line-height:1.5em;margin-top:0;text-align:left"><b>Category :</b> {{ucwords($mailData['subject'])}}</p>
                                       <p style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;color:#74787e;font-size:16px;line-height:1.5em;margin-top:0;text-align:left"><b>Subject :</b> {{$mailData['title']}}</p>
                                       <p style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;color:#74787e;font-size:16px;line-height:1.5em;margin-top:0;text-align:left">{!! $mailData['message'] !!}</p>
                                       @if(@$mailData['fileData'] != '')
                                          <?php $images = explode('--',$mailData['fileData']); ?>
                                          <p style="margin: 10px 0;">
                                             <p style="font-size:18px;">Attachments : </p>
                                             @for($imgNum = 0; $imgNum < count($images); $imgNum++)
                                                <a style="color:#19b5bc;text-decoration:none" href="{{url('images/ticket_images').'/'.$images[$imgNum]}}" target="_blank"> 
                                                   <img style="vertical-align:sub;margin:0px;Margin:0" src="{{url('images/ticket_images').'/'.$images[$imgNum]}}" width="100" height="100" border="1">
                                                </a>
                                             @endfor
                                          </p>
                                       @endif
                                       <p style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;color:#74787e;font-size:14px;line-height:1.5em;padding-top:20px;text-align:left">Regards,<br>
                                          <span class="il">My</span> <span class="il">Health</span> Squad
                                       </p>
                                    </span>
                                 </td>
                              </tr>
                           </tbody>
                        </table>
                     </td>
                  </tr>
                  <tr>
                     <td style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box">
                        <table align="center" width="800" cellpadding="0" cellspacing="0" style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;margin:0 auto;padding:0;text-align:center;width:800px">
                           <tbody>
                              <tr>
                                 <td align="center" style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;padding:40px">
                                    <p style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;line-height:1.5em;margin-top:0;color:#aeaeae;font-size:12px;text-align:center;">&copy; {{date('Y')}} <span class="il">My</span> <span class="il">Health</span> Squad. All rights reserved.</p>
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