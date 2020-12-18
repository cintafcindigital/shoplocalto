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
                                       <h1 style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;color:#2f3133;font-size:19px;font-weight:bold;margin-top:0;text-align:left">Hello {{isset($name)?$name:''}}!,</h1>
                                       <p style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;color:#000;font-size:16px;line-height:1.5em;margin-top:0;text-align:left">Today’s Tips: Best practices for following up on leads.</p>
                                       <p>Congratulations! People are noticing your profile page and want to get to know you.</p>
                                       <p>Now what?</p>
                                       <p><span style="font-weight: 600;">Tip 1:</span> Follow up as quickly as possible! If a prospect is online and in search of health service or any sort of treatment, that’s the time to connect to them. Not only are you reaching out to them when they are most receptive but you are demonstrating reactive and responsive customer service, something that is appreciated by prospects and helps them get a feel for how you will treat them when they are a client. </p>
                                       <p><span style="font-weight: 600;">Tip 2:</span> The first response to a request should be both an email and a text (or a call if you are so bold!). Why? The simple answer is clutter. Chances are the prospect is not just requesting info from you. They may have also requested info from your competitor and other health practitioners. Stand out from the crowd by following up on your reply with a friendly, customer service text or call that opens the door for a follow up call or an in-person consultation. <span style="">See script idea <a href="{{url('/')}}" target="_blank">here</a>.</span></p>
                                       <p><span style="font-weight: 600;">Tip 3:</span> <span style="">Plan your follow up in your Clients Admin Tool (CAT). As soon as you send your reply and follow up, create a follow up task for yourself. The first follow up can be several days later and then others can be spaced out to a pace you think will not be intrusive. While using Clients Admin Tool (CAT), you can pre-plan your follow ups for the life of the lead and take them out of the stream, or change the dates as you get feedback from the prospect.</span></p>
                                       <p><span style="font-weight: 600;">Tip 4:</span> Create an automated nurture stream. Take your follow up plan to the next level and have a series of emails pre-planned. A great nurture stream does more than ask for the sale. Some great topics are health inspiration, tricks and tips and free information you know the prospect would be interested in. Position yourself as an expert and consultant in your nurture stream to build trust.</p>
                                       <p><span style="font-weight: 600;">Tip 5:</span> Make calls. Sales 101! If you aren’t getting a response don’t be afraid to make a phone call. You will get a lot of voicemail but don’t be afraid of that. Either leave a short and sweet voicemail inviting them to call or email you back if they have questions or want to book a consultation. Stand out from the crowd by going old school.</p>
                                       <table align="center" width="100%" cellpadding="0" cellspacing="0" style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;padding:0;text-align:center;width:100%">
                                          <tbody>
                                             <tr>
                                                <td align="center" style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box">
                                                </td>
                                             </tr>
                                          </tbody>
                                       </table>
                                       <p style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;color:#000;font-size:16px;line-height:1.5em;margin-top:0;text-align:left"></p>
                                       <p style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;color:#000;font-size:14px;line-height:1.5em;margin-top:0;text-align:left">Live healthy &amp; prosper! <br><br><span class="il">My</span> <span class="il">Health</span> Squad</p>
                                       <p style="font-size: 12px;"><i>Unsubscribe from My Health Squad emails</i><a href="{{url('email-unsubscribe/'.(isset($toEmail)?$toEmail:''))}}" style="text-decoration: none;"> Click here</a></p>
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