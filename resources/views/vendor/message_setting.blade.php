@extends('layouts.default')
@section('meta_title',$data['titleData']->meta_title)
@section('meta_keyword',$data['titleData']->meta_keyword)
@section('meta_description',$data['titleData']->meta_description)
@section('content')
@include('includes.menu')
<section class="section-padding dashboard-wrap message_main_wrp dash_main_sect">
     @include('vendor.tools_nav')
     <div class="wrapper">
	   <div class="pure-g">
	      <div class="pure-u-1-5">
	          @include('includes.messagesidebar')
	      </div>
	      <div class="pure-u-4-5 msg_setting_wrp">

	         <h1 class="adminTitle">Settings</h1>
	         <hr>
	         <div class="admin-section mt20">
	            <h2 class="adminSubtitle">Email addresses that will be notified of new My Health Squad messages</h2>

	            @if(session()->has('success'))
		            <div class="adminAlert adminAlert--success email_update_alert" id="alert-emails-updated">
	                    <p>{{ session()->get('success') }}</p>
	                </div>
	            @endif
	            <div class="adminBox">
	               <div class="inline-block bg">
	                  <span class="block p10 color-black"><i class="icon icon-mail-letter mr5"></i>{{ $data['vendorData'][0]['email'] }}</span>
	               </div>

	               <em class="color-grey default_text">(by default)</em>

	               <form class="pure-form pure-form-stacked" name="frmMailLayer" action="{{ url('messages-setting') }}" method="post">
	               	{{ csrf_field() }}
	                  <p class="small color-grey mt20" for="Mails">Add any email that you'd like to receive notifications about new messages.</p>
	                  <input size="60" type="text" id="Mails" name="notify_mail" value="{{ $data['vendorData'][0]['message_notify_email'] }}">
	                  <input class="btnFlat btnFlat--primary mt30 add_email_btn" type="submit" value="Add&nbsp;emails">
	               </form>
	            </div>
	            
	         </div> <!-- End admin-section -->
	      </div>
	   </div>
	</div> <!-- End wrapper -->
</section>
@include('vendor.ExportLeads.exportleads_popup')
@include('includes.footer')
<script type="text/javascript">
	setTimeout(function() {
        $('.email_update_alert').slideUp();
    }, 4000);
</script>
@endsection 