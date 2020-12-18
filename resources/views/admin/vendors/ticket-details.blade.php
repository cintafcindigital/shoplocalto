@include('include/header')
<div class="pcoded-main-container">
    <div class="pcoded-content container">
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-4 d-flex align-items-center mb-4">
                        <h1 class="d-inline-block font-weight-normal mb-0">Ticket Details</h1>
                    </div>
                </div>
                @if(\Session::has('message'))
                <div class="app-hide-alert">
                    <div class="adminAlert adminAlert--success"><p>{!! \Session::get('message') !!}</p></div>
                </div>
                @endif
                @if(\Session::has('error'))
                <div class="app-hide-alert">
                    <div class="adminAlert adminAlert--danger"><p>{!! \Session::get('error') !!}</p></div>
                </div>
                @endif
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
			                    <div class="col-md-12 col-xl-12">
		                            <h2>{{$tickets->ticket_id}}</h2>
		                            <div class="row my-4">
		                                <div class="col-sm-4">
		                                    <h5 class="mb-3">Name : <b style="color:#666;">{{$tickets->name}}</b></h5>
		                                    <a href="mailto:{{$tickets->email}}">
		                                        <h5 class="mb-3">Email : <b style="color:#666;">{{$tickets->email}}</b></h5>
		                                    </a>
		                                </div>
		                                <div class="col-sm-3" style="padding:0px;">
		                                    <h5 class="mb-3">Category : <b style="color:#666;">{{ucwords($tickets->subject)}}</b></h5>
		                                    <h5 class="mb-3">Priority : <b style="color:#666;">{{$tickets->priority}}</b></h5>
		                                </div>
		                                <div class="col-sm-5">
		                                    <h5 class="mb-3">Ticket Status : 
                                                <div class="adminFiltersBox">
                                                    <div class="app-ui-dropdown adminFiltersBox__select move_select app-va-status-dropdown">
                                                        @if($tickets->status == 0)
                                                            <span class="app-va-status-selected"><i class="adminBullet adminBullet--orange"></i>Open</span>
                                                        @elseif($tickets->status == 1)
                                                            <span class="app-va-status-selected"><i class="adminBullet adminBullet--blue"></i>{{$tickets->awaiting_support}}</span>
                                                        @elseif($tickets->status == 2)
                                                            <span class="app-va-status-selected"><i class="adminBullet adminBullet--green"></i>Closed</span>
                                                        @endif
                                                        <i class="icon icon-arrow-down"></i>
                                                        <ul class="app-ui-dropdown-layer adminFiltersBox__dropdown move_to_list" style="display:none;">
                                                            <li id="0_status" class="statusCms @if($tickets->status == 0) dnone app-va-status-hidden @endif" data-status="0">
                                                                <a href="{{url('admin/supports-status-details/'.$tickets->id)}}/0/{{@Session::get('adminData')[0]['id']}}">
                                                                    <i class="adminBullet adminBullet--orange"></i>Open
                                                                </a>
                                                            </li>
                                                            <!-- <li id="1_status" class="statusCms @if($tickets->status == 1) dnone app-va-status-hidden @endif" data-status="1">
                                                                <a href="{{url('admin/supports-status-details/'.$tickets->id)}}/1/{{@Session::get('adminData')[0]['id']}}">
                                                                    <i class="adminBullet adminBullet--blue"></i>{{$tickets->awaiting_support}}
                                                                </a>
                                                            </li> -->
                                                            <li id="2_status" class="statusCms @if($tickets->status == 2) dnone app-va-status-hidden @endif" data-status="2">
                                                                <a href="{{url('admin/supports-status-details/'.$tickets->id)}}/2/{{@Session::get('adminData')[0]['id']}}">
                                                                    <i class="adminBullet adminBullet--green"></i>Closed
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
		                                    </h5>
		                                    <h5 class="mb-3">Read Status : 
		                                    	@if($tickets->is_read == 1)
                                                	<span style="color:#2dca73;font-weight:bold;">Read</span>
                                                @else
                                                	<span style="color:#ff0b37;font-weight:bold;">Not Read</span>
                                                @endif
                                            </h5>
		                                </div>
		                            </div>
		                            <div class="row my-4">
		                                <div class="col-sm-6">
		                                    <h5 class="mb-3">Subject : <b style="color:#666;">{{$tickets->title}}</b></h5>
		                                </div>
		                                <div class="col-sm-6">
		                                    <h5 class="mb-3">Comment : <b style="color:#666;">{!! $tickets->comments !!}</b></h5>
		                                </div>
		                                @if($tickets->attachment)
		                                <div class="col-sm-12">
		                                    <h5 class="mb-3">Attachments : </h5>
											<?php $images = explode('--',$tickets->attachment); ?>
											@for($imgNum = 0; $imgNum < count($images); $imgNum++)
											<div class="box-sol-reply-links mb20">
												<a class="inbox-message-link icon icon-clip icon-left" target="blank" href="{{url('images/ticket_images').'/'.$images[$imgNum] }}">{{$images[$imgNum]}}</a>
											</div>
											@endfor
		                                </div>
		                                @endif
		                            </div>
			                    </div>
                            </div>
                        </div>
                        @if(isset($ratingData->id))
                        <div class="card">
                            <div class="card-body">
			                    <div class="col-md-12 col-xl-12">
			                        <!--<p>{{$ratingData}}</p>-->
		                            <h2>Review Details</h2>
		                            <div class="row my-4">
		                                <div class="col-sm-4">
		                                    <h5 class="mb-3">Name : <b style="color:#666;">{{$ratingData->name}}</b></h5>
		                                    <a href="mailto:{{$ratingData->email}}">
		                                        <h5 class="mb-3">Email : <b style="color:#666;">{{$ratingData->email}}</b></h5>
		                                    </a>
		                                </div>
		                                <div class="col-sm-3" style="padding:0px;">
		                                    <h5 class="mb-3">Average Rating : <b style="color:#666;">{{$ratingData->average_rating}}</b></h5>
		                                </div>
		                                <div class="col-sm-5">
		                                    <h5 class="mb-3">Dispute Status : 
                                                @if($ratingData->dispute_status == 1) Active <a href="{{url('admin/dispute-review-status/'.$ratingData->id.'/0')}}" onclick="javascript:return confirm('Do you want to un-dispute this review ?')" class="btn btn-success"><i class="fa fa-thumbs-up"></i></a> @else In-active <a href="{{url('admin/dispute-review-status/'.$ratingData->id.'/1')}}" onclick="javascript:return confirm('Do you want to dispute this review ?')" class="btn btn-danger"><i class="fa fa-thumbs-down"></i></a> @endif
		                                    </h5>
		                                </div>
		                            </div>
		                            <div class="row my-4">
		                                <div class="col-sm-12">
		                                    <h5 class="mb-3">Comment : <b style="color:#666;">{!! $ratingData->review_description !!}</b></h5>
		                                </div>
		                                <!--<div class="col-sm-6" style="font-size:22px;">
		                                    @if($ratingData->dispute_status == 0)
		                                    <a href="" onclick="javascript:return confirm('Do you want to dispute this review ?')" class="btn btn-danger"><i class="fa fa-thumbs-down"></i></a>
		                                    @else
		                                    <a href="" onclick="javascript:return confirm('Do you want to un-dispute this review ?')" class="btn btn-success"><i class="fa fa-thumbs-down"></i></a>
		                                    @endif
		                                </div>-->
		                            </div>
			                    </div>
                            </div>
                        </div>
                        @endif
			            @if(count($tickets->tickets_replies) > 0)
                            <div class="card">
                                <div class="card-body">
    			                    <div class="col-md-12 col-xl-12">
				                        <h2>Conversation of {{$tickets->ticket_id}}</h2>
			                            @foreach($tickets->tickets_replies as $smsreply)
			                                @if($smsreply['reply_by'] == $tickets->user_id && $smsreply['message_type'] == 'self')
				                            <div class="row my-4 card">
				                                <div class="col-sm-12 card-body">
				                                    <h5 class="mb-3">Subject : <b style="color:#666;">{{ $smsreply['title'] }}</b></h5>
				                                    <h5 class="mb-3">Comment : <b style="color:#666;">{!! $smsreply['comments'] !!}</b></h5>
	                                                @if($smsreply['attachment'] != '' && $smsreply['attachment'] != null)
	                                                	<h5 class="mb-3">Attachments : </h5>
	                                                    <?php $images = explode('--',$smsreply['attachment']); ?>
	                                                    @for($imgNum = 0; $imgNum < count($images); $imgNum++)
	                                                    <div class="box-sol-reply-links mb20">
	                                                        <a class="inbox-message-link icon icon-clip icon-left" target="blank" href="{{url('images/ticket_images').'/'.$images[$imgNum] }}">{{$images[$imgNum]}}</a>
	                                                    </div>
	                                                    @endfor
	                                                @endif
	                                                <time class="text-warning float-right">
	                                                    <span>Message by {{$smsreply['name']}}</span> on {{date('d/M/Y',strtotime($smsreply['created_at']))}} at {{date('H:i', strtotime($smsreply['created_at']))}}
	                                                </time>
				                                </div>
				                            </div>
			                                @elseif($smsreply['reply_by'] != $tickets->user_id && $smsreply['message_type'] == 'reply')
				                            <div class="row my-4 card">
				                                <div class="col-sm-12 card-body">
				                                    <h5 class="mb-3">Subject : <b style="color:#666;">{{ $smsreply['title'] }}</b></h5>
				                                    <h5 class="mb-3">Comment : <b style="color:#666;">{!! $smsreply['comments'] !!}</b></h5>
	                                                @if($smsreply['attachment'] != '' && $smsreply['attachment'] != null)
	                                                	<h5 class="mb-3">Attachments : </h5>
	                                                    <?php $images = explode('--',$smsreply['attachment']); ?>
	                                                    @for($imgNum = 0; $imgNum < count($images); $imgNum++)
	                                                    <div class="box-sol-reply-links mb20">
	                                                        <a class="inbox-message-link icon icon-clip icon-left" target="blank" href="{{url('images/ticket_images').'/'.$images[$imgNum] }}">{{$images[$imgNum]}}</a>
	                                                    </div>
	                                                    @endfor
	                                                @endif
	                                                <time class="text-primary">
	                                                    Reply by You on {{date('d/M/Y',strtotime($smsreply['created_at']))}} at {{date('H:i', strtotime($smsreply['created_at']))}}
                                                        @if($smsreply['is_read'] == 1)
                                                            <span style="float:right;color:#444;">Read by Vendor</span>
                                                        @else
                                                            <span style="float:right;color:#444;">Delivered to Vendor</span>
                                                        @endif
	                                                </time>
				                                </div>
				                            </div>
			                                @endif
			                            @endforeach
    			                    </div>
    			                </div>
    			            </div>
			            @endif
                        <div class="card">
                            <div class="card-body">
				                @if (\Session::has('reply'))
				                    <div class="app-hide-alert">{!! \Session::get('reply') !!}</div>
				                @endif
				                @if($errors->any())
				                    <div class="alert alert-danger">
				                        <ul>@foreach ($errors->all() as $error)
				                                <li>{{ $error }}</li>
				                            @endforeach
				                        </ul>
				                    </div>
				                @endif
				                <div class="col-md-12 col-xl-12">
				                	<h2>Reply to Vendor for {{$tickets->ticket_id}}</h2>
                                    <form action="{{url('/admin/send-reply-admin')}}" name="frmToolLayer" id="frmToolLayer" method="post" enctype="multipart/form-data">
                                        {{csrf_field()}}
                                        <div class="box inbox-message-request__requestBox">
                                            <input type="hidden" name="tickets_id" value="{{$tickets->id}}">
                                            <input type="hidden" name="attachment" id="attachment">
                                            <label style="padding:10px 10px 0px;">Ticket Subject</label>
                                            <input type="text" class="form-control" value="{{$tickets->title}}" style="margin:0px 10px;width:96%;" readonly>
                                            <textarea id="app-trumbowyg-editor-va-chat" name="comments" class="app-trumbowyg-editor-va-chat trumbowyg-textarea" cols="65" rows="6" placeholder="Write a message *" tabindex="-1" style="min-height:158px;max-height:408px;"></textarea>
                                            <div id="ficheroSubido" class=""></div>
                                            <div class="inbox-message-reply-footer">
                                                <button type="button" class="inbox-message-reply-footer__upload icon icon-clip icon-left app-va_solis-upload-file" style="font-size:18px;font-weight:bold;">Attach files</button>
                                                <input class="dnone app-va-input-upload-file" name="fileupload" id="fileupload" type="file" accept=".jpg, .jpeg, .gif, .png, .doc, .docx, .pdf, .ppt, .pptx, .pps, .xls, .xlsx">
                                                <input class="btnFlat btnFlat--primary app-va-solic-chat-submit-btn" type="submit" value="Reply">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
			        </div>
			    </div>
			</div>
        </div>
    </div>
</div>
<script src="{{url('assets/js/plugins/bootstrap.min.js')}}"></script>
<script src="{{url('assets/js/pcoded.min.js')}}"></script>
<script src="{{url('assets/js/menu-setting.js')}}"></script>
<script src="{{url('assets/js/plugins/jquery.dataTables.min.js')}}"></script>
<script src="{{url('assets/js/plugins/dataTables.bootstrap4.min.js')}}"></script>
<style>
    .icon-left::before {
        margin-right: 5px;
    }
    .icon-clip::before {
        background-position: -37px -147px;
        height: 16px;
        width: 16px;
    }
    *, ::before, ::after {
        box-sizing: border-box;
    }
    .btnFlat, .btnOutline {
        display: inline-block;
        vertical-align: middle;
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        font-size: 16px;
        line-height: 24px;
        outline: 0;
        padding: 8px 12px;
        border-radius: 3px;
        border: 1px solid #169fa5;
        cursor: pointer;
        box-sizing: border-box;
        text-decoration: none;
        text-align: center;
        background: 0 0;
        position: relative;
        color: #169fa5;
    }
    .btnFlat {
        font-weight: 600;
    }
    .icon-arrow-down::before {
        background-position: -64px -11px;
        height: 6px;
        width: 13px;
    }
    ul {
        margin: 0;
        padding: 0;
        list-style-type: none;
    }
</style>
<link rel="stylesheet" href="{{url('/')}}/public/css/custom.css">
<link rel="stylesheet" href="{{url('/')}}/public/css/vendor.css">
<script src="https://cdn.tiny.cloud/1/08cq8y02kwr759p88hfbo9ym579ceup2a7x2vebx42n6ceee/tinymce/5/tinymce.min.js"></script>
<script>
    tinymce.init({
        selector:'#app-trumbowyg-editor-va-chat',
        width: 977,
        height: 300
    });
    $(document).ready(function() {
        // Hide status after status change
        setTimeout(function() {
            $('.app-hide-alert').slideUp();
        }, 4000);
        // file upload click
        $('.inbox-message-reply-footer__upload').on('click', function() {
            $('#fileupload').trigger('click');
            return false;
        });
        $('.adminFiltersBox__select').on('click', function() {
            $('.adminFiltersBox__dropdown').toggle();
        });
        // upload file ajax
        $("#fileupload").change(function(e) {
            //Here is where you will make your AJAX call
            var fileobj = e.target.files[0];
            var formData = new FormData();
            formData.append("fileobj", fileobj);
            formData.append("_token", "{{csrf_token()}}");
            $.ajax({
                type:'POST',
                url: "{{ url('admin/reply-fileupload') }}",
                data:formData,
                cache:false,
                contentType: false,
                processData: false,
                success:function(data){
                    var data = JSON.parse(data);
                    if(data.html != '') {
                        var valAttch = $('#attachment').val();
                        if(valAttch) {
                            $('#attachment').val(valAttch+'--'+data.imgName);
                        } else {
                            $('#attachment').val(data.imgName);
                        }
                        $('#ficheroSubido').addClass('app-inbox-upload-attachments');
                        $('#ficheroSubido').append(data.html);
                    }
                },
                error: function(data){
                    console.log(data);
                }
            });
        });
        // Remove image from upload
        $('body').on('click', '.inbox-message-link__remove', function() {
            var imgName = $(this).attr('data-imgName');
            var valAttch = $('#attachment').val();
            var valAttchNew = valAttch.replace(imgName,'');
            $('#attachment').val(valAttchNew);
            $(this).parents('.inbox-message-link').remove();
        });
    });
</script>
</body>
</html>