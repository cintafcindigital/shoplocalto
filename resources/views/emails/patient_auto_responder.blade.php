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
                         <img src="{{ asset('public/images/logo.png') }}" style="width:50%;" alt="My Health Squad Logo" style="width: 50%;">
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
                                       <h1 style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;color:#2f3133;font-size:19px;font-weight:bold;margin-top:0;text-align:left">Hi {{isset($name)?$name:''}},</h1>
                                       <p style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;color:#74787e;font-size:16px;line-height:1.5em;margin-top:0;text-align:left">Thank you for contacting these Health Professionals through My Health Squad.</p>
                                       <table align="center" width="100%" cellpadding="0" cellspacing="0" style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;padding:0;text-align:center;width:100%">
                                          <tbody>
                                             <tr>
                                                <td style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box">
                                                   <a href="{{url('vendor/'.$currentProfile->business_name_slug)}}">
                                                   @if(@$currentProfile->image)
                                                   <img src="{{url('public/vendors/'.$currentProfile->vendor_folder.'/'.$currentProfile->image)}}" style="width: auto;height: 250px;">
                                                   @else
                                                   <img src="{{url('public/vendors/no-photo.png')}}"style="width: auto;height: 250px;">
                                                   @endif
                                                   </a>
                                                </td>
                                                <td style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;text-align: left;">
                                                   <p>{{$currentProfile->business_name}}</p>
                                                   <p>{{$currentProfile->email}}</p>
                                                   <p>{{$currentProfile->mobile}}</p>
                                                   <p>{{$currentProfile->business_address}}</p>
                                                </td>
                                             </tr>
                                             <!-- <tr>
                                                <td style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box">
                                                </td>
                                                <td style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box">
                                                </td>
                                             </tr> -->
                                          </tbody>
                                       </table>
                                       <h3>Latest blogs on My Health Squad</h3>
                                       <table align="center" width="100%" cellpadding="0" cellspacing="0" style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;padding:0;text-align:center;width:100%">
                                          <tbody>
                                             <tr>
                                                @foreach($blogs as $blog)
                                                <td style="padding: 0 12px;"><img src="{{url('public/cimg/webroot/img.php?src=images/blogs')}}/{{$blog->picture == null?'no-img.png':$blog->picture}}" style="width: 225px;height: 150px;object-fit: contain;margin: 0 auto;"></td>
                                                @endforeach
                                             </tr>
                                             <tr>
                                                @foreach($blogs as $blog)
                                                <td style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box">
                                                   <a href="{{url('blog-single/'.$blog->slug)}}">{{$blog->name}}</a>
                                                </td>
                                                @endforeach
                                             </tr>
                                          </tbody>
                                       </table>
                                       <p style="font-size: 12px;"><i>Unsubscribe from My Health Squad emails</i><a href="{{url('email-unsubscribe/'.(isset($toEmail)?$toEmail:''))}}" target="_blank" style="text-decoration: none;"> Click here</a></p>
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