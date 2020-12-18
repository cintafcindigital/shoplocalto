@extends('layouts.default')
@section('meta_title',$data['titleData']->meta_title)
@section('meta_keyword',$data['titleData']->meta_keyword)
@section('meta_description',$data['titleData']->meta_description)
@section('content')
@include('includes.menu')
<section class="section-padding dashboard-wrap setting_page_wrp storefront_main_sect dash_main_sect">
     @include('vendor.tools_nav')
      <div class="wrapper">
         <div class="pure-g">
            <div class="pure-u-2-7">
               <div class="mr40">
                  <nav class="adminAside setting_list_wrp">
                     <a class="adminAside__item " href="{{url('profile-settings')}}">
                        <i class="svgIcon svgIcon__gen adminAside__icon">
                           <svg viewBox="0 0 17 18">
                              <path d="M1 1v16h15V1H1zm0-1h15a1 1 0 0 1 1 1v16a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V1a1 1 0 0 1 1-1zm3.5 5V4h10v1h-10zm-1 3.5v-1h11v1h-11z" fill-rule="nonzero"></path>
                           </svg>
                        </i> PROFILE SETTINGS
                     </a>
                     <a class="adminAside__item " href="{{url('employees')}}">
                        <i class="svgIcon svgIcon__gen adminAside__icon">
                           <svg viewBox="0 0 17 18">
                              <path d="M1 1v16h15V1H1zm0-1h15a1 1 0 0 1 1 1v16a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V1a1 1 0 0 1 1-1zm3.5 5V4h10v1h-10zm-1 3.5v-1h11v1h-11z" fill-rule="nonzero"></path>
                           </svg>
                        </i> STAFF SETTINGS
                     </a>
                     <!--<a class="adminAside__item active" href="{{url('vendor-settings')}}">
                        <i class="svgIcon svgIcon__gear adminAside__icon">
                           <svg viewBox="0 0 18 20">
                              <path d="M5.98 16.179a.653.653 0 0 0-.822-.472l-1.76.504c-.856.244-1.883-.17-2.325-.94l-.601-1.04C.027 13.46.18 12.365.82 11.745l1.317-1.272a.657.657 0 0 0 0-.95L.824 8.252C.183 7.634.029 6.54.473 5.769l.6-1.04c.443-.771 1.47-1.185 2.325-.94l1.76.504a.656.656 0 0 0 .823-.474l.443-1.776C6.64 1.18 7.511.5 8.4.5h1.2c.889 0 1.76.68 1.975 1.542l.444 1.775c.092.366.46.577.823.474l1.76-.504c.855-.245 1.88.17 2.324.94l.602 1.041c.443.772.29 1.865-.35 2.482L15.86 9.524a.653.653 0 0 0 0 .948l1.318 1.273c.64.619.792 1.712.348 2.484l-.6 1.04c-.442.77-1.469 1.185-2.325.94l-1.761-.504a.654.654 0 0 0-.82.474l-.445 1.778C11.36 18.82 10.489 19.5 9.6 19.5H8.4c-.89 0-1.76-.68-1.975-1.543l-.446-1.778zm1.415 1.536c.104.417.575.785 1.005.785h1.2c.43 0 .901-.368 1.005-.785l.445-1.778a1.653 1.653 0 0 1 2.067-1.193l1.76.504c.415.119.97-.105 1.184-.478l.6-1.04c.215-.375.132-.966-.177-1.266l-1.318-1.273a1.653 1.653 0 0 1 .001-2.387l1.316-1.273c.31-.3.393-.89.178-1.264l-.601-1.04c-.215-.373-.77-.597-1.183-.479l-1.76.504a1.656 1.656 0 0 1-2.068-1.192l-.444-1.776C10.501 1.868 10.03 1.5 9.6 1.5H8.4c-.43 0-.901.368-1.005.785L6.95 4.062a1.657 1.657 0 0 1-2.068 1.193l-1.76-.504c-.415-.12-.97.105-1.184.477l-.6 1.04c-.215.374-.132.966.178 1.265l1.316 1.272a1.658 1.658 0 0 1 0 2.387l-1.317 1.273c-.31.3-.393.892-.178 1.265l.602 1.042c.213.372.768.596 1.183.477l1.759-.503a1.652 1.652 0 0 1 2.067 1.19l.446 1.779zM9 8.1a1.9 1.9 0 1 0 0 3.8 1.9 1.9 0 0 0 0-3.8zm0-1a2.9 2.9 0 1 1 0 5.8 2.9 2.9 0 0 1 0-5.8z" fill-rule="nonzero"></path>
                           </svg>
                        </i> NOTIFICATIONS
                     </a>-->
                  </nav>
               </div>
            </div>
            <div class="pure-u-5-7">
               <h1 class="adminTitle">NOTIFICATIONS</h1>
               <div class="app-hide-alert setting_succ_msg" style="display:none;">
                     <div class="adminAlert adminAlert--success">
                     <p>Notification changes have been successfully saved.</p>
                 </div>
               </div>
               <div class="box">
                  <div class="p20 pb15 notification_wrp">
                     <!-- <h3 class="adminSubtitle">Notifications</h3> -->
                     <p class="m0">
                        Our emails contain useful information and tips to help you improve your Profile Page, increase your visibility in the market place and grow your business. You can edit your email preferences at any time.
                     </p>
                  </div>
                  <hr>
                  <div class="p20 pt10 notification_detail">
                     <form name="frmNotificaciones" action="javascript:;" method="post">
                        <ul class="mb20">
                           <li class="p5">
                              <label>
                                 <!--<div class="icheckbox_minimal" style="position: relative;"><input type="checkbox" name="news" value="1" style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div>-->
                                <div ><input type="checkbox" name="news" value="1" >
                                 Monthly newsletter with my Profile analytics</div>
                              </label>
                           </li>
                           <li class="p5">
                              <label class="">
                                 <!--<div class="icheckbox_minimal" style="position: relative;"><input type="checkbox" name="edu" value="1" style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div>-->
                                <div ><input type="checkbox" name="edu" value="1" > Training emails during your first week.</div>
                              </label>
                           </li>
                           <li class="p5">
                              <label class="">
                                 <!--<div class="icheckbox_minimal" style="position: relative;"><input type="checkbox" name="alertas" value="1" style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div>-->
                                 <div ><input type="checkbox" name="alertas" value="1" > Storefront improvement tips </div>
                              </label>
                           </li>
                        </ul>
                        <input class="btnFlat btnFlat--primary succ_save_btn" type="submit" value="Save">
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
</section>
@include('includes.footer')
<script type="text/javascript">
   $('.succ_save_btn').click(function(){
      $('.setting_succ_msg').slideDown();
   });
   setTimeout(function() {
      $('.setting_succ_msg').slideUp();
   }, 4000);
</script>
@endsection       
