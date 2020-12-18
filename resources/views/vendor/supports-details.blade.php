@extends('layouts.default')
@section('meta_title',$data['titleData']->meta_title)
@section('meta_keyword',$data['titleData']->meta_keyword)
@section('meta_description',$data['titleData']->meta_description)
@section('content')
@include('includes.menu')
<section class="section-padding dashboard-wrap dash_main_sect">
    @include('vendor.tools_nav')
    <div class="wrapper">
        <div class="pure-g">
            <div class="pure-u-1-5"> @include('includes.supportsidebar') </div>
            <div class="pure-u-4-5">
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
                <div id="app-alert-no-leida" class="app-alert adminAlert adminAlert--success" style="display:none;">
                    <p>Ticket marked as Unread.</p>
                </div>
                <div id="app-alert-leida" class="app-alert adminAlert adminAlert--success" style="display:none;">
                    <p>Ticket marked as Read.</p>
                </div>
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
                <div class="pure-g">
                    <div class="pure-u-5-7">
                        <div class="mb30 clearfix">
                            <div class="fleft">
                                <div class="adminFiltersBox">
                                    <div class="app-ui-dropdown adminFiltersBox__select move_select app-va-status-dropdown">
                                        @if($data['support_details']->status == 0)
                                            <span class="app-va-status-selected"><i class="adminBullet adminBullet--orange"></i>Open</span>
                                        @elseif($data['support_details']->status == 1)
                                            <span class="app-va-status-selected"><i class="adminBullet adminBullet--blue"></i>{{$data['support_details']->awaiting_vendor}}</span>
                                        @elseif($data['support_details']->status == 2)
                                            <span class="app-va-status-selected"><i class="adminBullet adminBullet--green"></i>Closed</span>
                                        @endif
                                        <i class="icon icon-arrow-down"></i>
                                        <ul class="app-ui-dropdown-layer adminFiltersBox__dropdown move_to_list" style="display:none;">
                                            <li id="0_status" class="statusCms @if($data['support_details']->status == 0) dnone app-va-status-hidden @endif" data-status="0">
                                                <a href="{{url('supports-status-details/'.$data['support_details']->id)}}/0/vendor">
                                                    <i class="adminBullet adminBullet--orange"></i>Open
                                                </a>
                                            </li>
                                            <!-- <li id="1_status" class="statusCms @if($data['support_details']->status == 1) dnone app-va-status-hidden @endif" data-status="1">
                                                <a href="{{url('supports-status-details/'.$data['support_details']->id)}}/1/vendor">
                                                    <i class="adminBullet adminBullet--blue"></i>{{$data['support_details']->awaiting_vendor}}
                                                </a>
                                            </li> -->
                                            <li id="2_status" class="statusCms @if($data['support_details']->status == 2) dnone app-va-status-hidden @endif" data-status="2">
                                                <a href="{{url('supports-status-details/'.$data['support_details']->id)}}/2/vendor">
                                                    <i class="adminBullet adminBullet--green"></i>Closed
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="app-ui-dropdown adminFiltersBox__select mark_select">
                                    <span class="app_combo_leida @if($data['support_details']->is_read == 0) dnone @endif">Read</span>
                                    <span class="app_combo_no_leida @if($data['support_details']->is_read == 1) dnone @endif">Unread</span>
                                    <i class="icon icon-arrow-down"></i>
                                    <ul class="app-ui-dropdown-layer adminFiltersBox__dropdown adminFiltersBox__dropdown--noBorder mark_us_list" style="display:none;">
                                        <li class="app_combo_no_leida @if($data['support_details']->is_read == 0) dnone @endif">
                                            <a href="javascript:;" onclick="statusChangeajax({{$data['support_details']->id}},0)">Unread</a>
                                        </li>
                                        <li class="app_combo_leida @if($data['support_details']->is_read == 1) dnone @endif">
                                            <a href="javascript:;" onclick="statusChangeajax({{$data['support_details']->id}},1)">Read </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <a id="redactar"></a>
                        <div id="app-new-inbox-message-request" class="inbox-message-request inbox-message-request-user" style="padding-right: 0">
                            <div class="pure-g">
                                <div class="pure-u-1-9">
                                    @if(@$data['vendorData'][0]['image_data'][0]['image'])
                                    <div class="avatar-vendor">
                                        <img class="avatar-thumb" src="{{url('public/vendors/VENDOR_'.$data['vendorData'][0]['vendor_id'].'/'.$data['vendorData'][0]['image_data'][0]['image'])}}" alt="User Image" width="64px" height="64px" style="height: 60px; width: 60px">
                                    </div>
                                    @else
                                    <div class="avatar-alias size-avatar-medium">
                                        <svg class="avatar-generic" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200" preserveAspectRatio="xMidYMin slice">
                                            <circle fill="#C7C9C0" cx="100" cy="100" r="100"></circle>
                                            <text transform="translate(100,130)" y="0">
                                                <tspan font-size="90" class="" fill="rgba(0,0,0,0.3)" text-anchor="middle">{{ucfirst(substr($data['support_details']->name, 0, 1))}}</tspan>
                                            </text>
                                        </svg>
                                    </div>
                                    @endif
                                </div>
                                <div class="pure-u-8-9">
                                    <div class="tools-inbox-message-reply">
                                        <form class="app-vendors-solicitudes-response-form" action="{{url('/send-reply-supports')}}" name="frmToolLayer" id="frmToolLayer" method="post" enctype="multipart/form-data">
                                            {{csrf_field()}}
                                            <div class="box inbox-message-request__requestBox">
                                                <input type="hidden" name="tickets_id" value="{{$data['support_details']->id}}">
                                                <input type="hidden" name="attachment" id="attachment">
                                                <label style="padding:10px 10px 0px;">Ticket Subject</label>
                                                <input type="text" class="form-control" value="{{$data['support_details']->title}}" style="margin:0px 10px;width:96%;" readonly>
                                                <textarea id="app-trumbowyg-editor-va-chat" name="comments" class="app-trumbowyg-editor-va-chat trumbowyg-textarea" cols="65" rows="6" placeholder="Write a message *" tabindex="-1" style="min-height:158px;max-height:408px;"></textarea>
                                                <div id="ficheroSubido" class=""></div>
                                                <div class="inbox-message-reply-footer">
                                                    <button class="inbox-message-reply-footer__upload icon icon-clip icon-left app-va_solis-upload-file" style="font-size:18px;font-weight:bold;">Attach files</button>
                                                    <input class="dnone app-va-input-upload-file" name="fileupload" id="fileupload" type="file" accept=".jpg, .jpeg, .gif, .png, .doc, .docx, .pdf, .ppt, .pptx, .pps, .xls, .xlsx">
                                                    <input class="btnFlat btnFlat--primary app-va-solic-chat-submit-btn" type="submit" value="Reply">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if(count($data['reply']) > 0)
                            @foreach($data['reply'] as $smsreply)
                                @if($smsreply['reply_by'] == $data['support_details']->user_id && $smsreply['message_type'] == 'self')
                                <div class="app-sol-reply inbox-message-request inbox-message-request-user send-by-vendor" style="padding: 0">
                                    <div class="pure-g">
                                        <div class="pure-u-1-9">
                                            @if(@$data['vendorData'][0]['image_data'][0]['image'])
                                            <div class="avatar-vendor">
                                                <img class="avatar-thumb" src="{{url('public/vendors/VENDOR_'.$data['vendorData'][0]['vendor_id'].'/'.$data['vendorData'][0]['image_data'][0]['image'])}}" alt="User Image" width="64px" height="64px" style="height: 64px; width: 64px">
                                            </div>
                                            @else
                                            <div class="avatar-alias size-avatar-medium fright">
                                                <svg class="avatar-generic" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200" preserveAspectRatio="xMidYMin slice">
                                                    <circle fill="#C7C9C0" cx="100" cy="100" r="100"></circle>
                                                    <text transform="translate(100,130)" y="0">
                                                        <tspan font-size="90" class="" fill="rgba(0,0,0,0.3)" text-anchor="middle">{{ucfirst(substr($data['support_details']->name, 0, 1))}}</tspan>
                                                    </text>
                                                </svg>
                                            </div>
                                            @endif
                                        </div>
                                        <div class="pure-u-8-9">
                                            <div class="tools-inbox-message  inbox-message-content-user">
                                                <div class="tools-inbox-message__header">
                                                    <p class="strong">{{ ucfirst($smsreply['title']) }}</p>
                                                </div>
                                                {!! $smsreply['comments'] !!}
                                                @if($smsreply['attachment'] != '' && $smsreply['attachment'] != null)
                                                    <?php
                                                        $images = explode('--',$smsreply['attachment']);
                                                    ?>
                                                    @for($imgNum = 0; $imgNum < count($images); $imgNum++)
                                                    <div class="box-sol-reply-links mb20">
                                                        <a style="background-color: #fff" class="inbox-message-link icon icon-clip icon-left" target="blank" href="{{url('images/ticket_images').'/'.$images[$imgNum] }}">{{$images[$imgNum]}}</a>
                                                    </div>
                                                    @endfor
                                                @endif
                                                <time>
                                                    <span class="adminConversation__status">
                                                        @if($smsreply['is_read'])
                                                            Read by Staff Member
                                                        @else
                                                            Delivered to Staff Member
                                                        @endif
                                                    </span>on {{date('d/M/Y',strtotime($smsreply['created_at']))}} at {{date('H:i', strtotime($smsreply['created_at']))}}
                                                </time>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @elseif($smsreply['reply_by'] != $data['support_details']->user_id && $smsreply['message_type'] == 'reply')
                                <div class="app-sol-reply inbox-message-request inbox-message-request-vendor received-by-user">
                                    <div class="pure-g">
                                        <div class="pure-u-8-9">
                                            <div class="tools-inbox-message inbox-message-content-vendor box">
                                                <div class="tools-inbox-message__header">
                                                    <p class="strong">{{ ucfirst($smsreply['name']) }}</p>
                                                </div>
                                                <b>{{ $smsreply['title'] }}</b>
                                                {!! $smsreply['comments'] !!}
                                                @if($smsreply['attachment'] != '' && $smsreply['attachment'] != null)
                                                    <?php
                                                        $images = explode('--',$smsreply['attachment']);
                                                    ?>
                                                    @for($imgNum = 0; $imgNum < count($images); $imgNum++)
                                                    <div class="box-sol-reply-links mb20">
                                                        <a style="background-color: #fff" class="inbox-message-link icon icon-clip icon-left" target="blank" href="{{url('images/ticket_images').'/'.$images[$imgNum] }}">{{$images[$imgNum]}}</a>
                                                    </div>
                                                    @endfor
                                                @endif
                                                <time>
                                                    on {{date('d/M/Y', strtotime($smsreply['created_at']))}} at {{date('H:i', strtotime($smsreply['created_at']))}}
                                                </time>
                                            </div>
                                        </div>
                                        <div class="pure-u-1-9">
                                            @if($smsreply['name'])
                                            <div class="avatar-alias size-avatar-medium">
                                                <svg class="avatar-generic" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200" preserveAspectRatio="xMidYMin slice">
                                                    <circle fill="#C7C9C0" cx="100" cy="100" r="100"></circle>
                                                    <text transform="translate(100,130)" y="0">
                                                        <tspan font-size="90" class="" fill="rgba(0,0,0,0.3)" text-anchor="middle">{{ucfirst(substr($smsreply['name'], 0, 1))}}</tspan>
                                                    </text>
                                                </svg>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @endif
                            @endforeach
                        @endif
                        @if(isset($data['support_details']) && ($data['support_details']))
                        <div class="app-sol-reply inbox-message-request inbox-message-request-user send-by-vendor" style="padding:0">
                            <div class="pure-g">
                                <div class="pure-u-1-9">
                                    @if(@$data['vendorData'][0]['image_data'][0]['image'])
                                    <div class="avatar-vendor">
                                        <img class="avatar-thumb" src="{{url('public/vendors/VENDOR_'.$data['vendorData'][0]['vendor_id'].'/'.$data['vendorData'][0]['image_data'][0]['image'])}}" alt="User Image" width="64px" height="64px" style="height: 64px; width: 64px">
                                    </div>
                                    @else
                                    <div class="avatar-alias size-avatar-medium fright">
                                        <svg class="avatar-generic" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200" preserveAspectRatio="xMidYMin slice">
                                            <circle fill="#C7C9C0" cx="100" cy="100" r="100"></circle>
                                            <text transform="translate(100,130)" y="0">
                                                <tspan font-size="90" class="" fill="rgba(0,0,0,0.3)" text-anchor="middle">{{ucfirst(substr($data['support_details']->name, 0, 1))}}</tspan>
                                            </text>
                                        </svg>
                                    </div>
                                    @endif
                                </div>
                                <div class="pure-u-8-9">
                                    <div class="tools-inbox-message  inbox-message-content-user">
                                        <b>{{ $data['support_details']->title }}</b>
                                        {!! $data['support_details']->comments !!}
                                        @if($data['support_details']->attachment != '' && $data['support_details']->attachment != null)
                                            <?php
                                                $images = explode('--',$data['support_details']->attachment);
                                            ?>
                                            @for($imgNum = 0; $imgNum < count($images); $imgNum++)
                                            <div class="box-sol-reply-links mb20">
                                                <a style="background-color: #fff" class="inbox-message-link icon icon-clip icon-left" target="blank" href="{{url('images/ticket_images').'/'.$images[$imgNum] }}">{{$images[$imgNum]}}</a>
                                            </div>
                                            @endfor
                                        @endif
                                        <time>
                                            <span class="adminConversation__status">
                                                @if($data['support_details']->is_read > 0)
                                                    Read by Staff Memeber
                                                @else
                                                    Delivered to Staff Memeber
                                                @endif
                                            </span>on {{date('d/M/Y',strtotime($data['support_details']->created_at))}} at {{date('H:i', strtotime($data['support_details']->created_at))}}
                                        </time>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="pure-u-2-7">
                        <div class="ml30">
                            <div class="box">
                                <div class="inbox-vendor-profile">
                                    @if($data['support_details'])
                                    <div class="inbox-vendor-profile__content">
                                        <div class="text-center">
                                            @if($data['support_details']->name)
                                            <div class="avatar-alias size-avatar-xmedium avatar-center">
                                                <svg class="avatar-generic" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200" preserveAspectRatio="xMidYMin slice" style="height: 98px">
                                                    <circle fill="#C7C9C0" cx="100" cy="100" r="100"></circle>
                                                    <text transform="translate(100,130)" y="0">
                                                        <tspan font-size="90" class="" fill="rgba(0,0,0,0.3)" text-anchor="middle">{{ucfirst(substr($data['support_details']->name, 0, 1))}}</tspan>
                                                    </text>
                                                </svg>
                                            </div>
                                            @endif
                                            <span class="inbox-vendor-profile-title mt10">{{$data['support_details']->name}}</span><!-- Searching : {{@$data['vendorData'][0]['category_data']['title']}} in {{@$data['vendorData'][0]['company_data']['province']}} --> <hr>
                                        </div>
                                        <div class="inbox-vendor-profileList">
                                            <div class="inbox-vendor-profileList__item">
                                                <span class="inbox-vendor-profileList__icon icon icon-form-cal"></span>
                                                <span class="inbox-vendor-profile__mail" style="margin-left: 10px">
                                                    Event: {{date('d/m/Y', strtotime($data['support_details']->created_at))}}
                                                </span>                                     
                                            </div>
                                            <div class="inbox-vendor-profileList__item">
                                                <span class="inbox-vendor-profileList__icon icon icon-form-mobile"></span>
                                                <span class="inbox-vendor-profile__mail" style="margin-left: 10px">
                                                    {{$data['support_details']->email}}
                                                </span>
                                            </div>
                                            <div role="button">
                                                <div class="inbox-vendor-profileList__item">
                                                    <span class="inbox-vendor-profileList__icon icon icon-form-mail"></span>
                                                    <span class="inbox-vendor-profile__mail" style="margin-left: 10px">
                                                        {{$data['support_details']->email}}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                                <div class="vendors-item-content app-tools-vendors-modif" data-id-empresa="17879" data-id-escaparate="">
                                    <div class="app-va-change-status vendorsItemStatus__item" enq-id="{{ $data['support_details']->id }}" data-status-old="{{ $data['support_details']->reply_status }}" onclick="changeStatusforBooking(this)">
                                        <i class="svgIcon svgIcon__checkCircle app-va-change-status-icon vendorsItemStatus__icon vendorsItemStatus__icon--check @if($data['support_details']->reply_status == 3) active @endif">
                                            <svg viewBox="0 0 92 92"><path d="M46 0C20.6 0 0 20.6 0 46s20.6 46 46 46 46-20.6 46-46S71.4 0 46 0zm20.1 36.3L45 59.7c-.5.6-1.3 1-2.1 1h-.1c-.8 0-1.5-.3-2.1-.9L26 45.3c-1.2-1.2-1.2-3.1 0-4.2 1.2-1.2 3.1-1.2 4.2 0l12.4 12.3 19.1-21c1.1-1.2 3-1.3 4.2-.2 1.3 1 1.4 2.9.2 4.1z"></path></svg>
                                        </i>
                                        <span class="vendorsItemStatus__label">Booked</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box p20 text-center ml30">
                            <i class="icon-vendor icon-vendor-info-circle block mb15"></i>
                            <strong>Get more clients:</strong><br> Reply to new leads and messages within 24 hours
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="app-vendor-availability-dialog" data-target="#app-vendor-availability-dialog" class="modal"></div>
</section>
@include('vendor.ExportLeads.exportleads_popup')
@include('includes.footer')
<script src="https://cdn.tiny.cloud/1/08cq8y02kwr759p88hfbo9ym579ceup2a7x2vebx42n6ceee/tinymce/5/tinymce.min.js"></script>
<script>
    tinymce.init({
        selector:'#app-trumbowyg-editor-va-chat',
        width: 570,
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
        // upload file ajax
        $("#fileupload").change(function(e) {
            //Here is where you will make your AJAX call
            var fileobj = e.target.files[0];
            var formData = new FormData();
            formData.append("fileobj", fileobj);
            $.ajax({
                type:'POST',
                url: "{{ url('supports-fileupload') }}",
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
    // Ticket status chage Ajax
    function statusChangeajax(eqid, status) {
        $.ajax({
            type:'get',
            url: '{{ url("supports-details-status") }}/'+eqid+'/'+status,
            success: function(responce) {
                if(responce == 1) {
                    $('#app-alert-no-leida').hide();
                    $('#app-alert-leida').show();
                    $('.app_combo_leida').removeClass('dnone');
                    $('.app_combo_no_leida').addClass('dnone');
                    $('.mark_us_list .app_combo_leida').addClass('dnone');
                    $('.mark_us_list .app_combo_no_leida').removeClass('dnone');
                }
                if(responce == 0) {
                    $('#app-alert-no-leida').show();
                    $('#app-alert-leida').hide();
                    $('.app_combo_leida').addClass('dnone');
                    $('.app_combo_no_leida').removeClass('dnone');
                    $('.mark_us_list .app_combo_leida').removeClass('dnone');
                    $('.mark_us_list .app_combo_no_leida').addClass('dnone');
                }
            }
        });
    }
    // Booking status change on Ticket single page
    function changeStatusforBooking(cvthis) {
        console.log(cvthis);
        // var leadid = cvthis.getAttribute('enq-id');
        // var cleadstatus = cvthis.getAttribute('data-status-old');
        // if(cleadstatus == 3) {
        //     cleadstatus = 0;
        // }
        // $.ajax({
        //     'type': 'post',
        //     'url': '{{ url("booking-status") }}',
        //     'data': {'leadid':leadid, 'cleadstatus':cleadstatus},
        //     success: function(responce) {
        //         var responce = JSON.parse(responce);
        //         if(responce.active == 'yes') {
        //             $('.vendorsItemStatus__icon').addClass('active');
        //         }else {
        //             $('.vendorsItemStatus__icon').removeClass('active');
        //         }
        //         var statusHtml = '';
        //         if(responce.leadstatus == 0) {
        //             statusHtml = '<i class="adminBullet adminBullet--orange"></i>Pending';
        //         }
        //         if(responce.leadstatus == 1) {
        //             statusHtml = '<i class="adminBullet adminBullet--blue"></i>Replied';
        //         }
        //         if(responce.leadstatus == 2) {
        //             statusHtml = '<i class="adminBullet adminBullet--red"></i>Discarded';
        //         }
        //         if(responce.leadstatus == 3) {
        //             statusHtml = '<i class="adminBullet adminBullet--green"></i>Booked';
        //         }
        //         // For page status
        //         $('.statusCms').removeClass('dnone');
        //         $('#'+responce.leadstatus+'_status').addClass('dnone');
        //         $('.app-va-status-selected').html(statusHtml);
        //         // For sidebar status
        //         $('.app-va-folders-side-status').removeClass('active');
        //         $('#'+responce.leadstatus+'_sidebarstatus').addClass('active');
        //         // For sidebarCounter
        //         // For update
        //         var cu = $('#'+responce.leadstatus+'_sidebarstatus').find('.app-va-folders--counter').text();
        //         cu = parseInt(cu) + parseInt(1);
        //         $('#'+responce.leadstatus+'_sidebarstatus').find('.app-va-folders--counter').text(cu);
        //         // For Lowdown
        //         if(cleadstatus != responce.leadstatus) {
        //             var cd = $('#'+cleadstatus+'_sidebarstatus').find('.app-va-folders--counter').text();
        //             cd = parseInt(cd) - parseInt(1);
        //             $('#'+cleadstatus+'_sidebarstatus').find('.app-va-folders--counter').text(cd);
        //         } else {
        //             var cd = $('#3_sidebarstatus').find('.app-va-folders--counter').text();
        //             cd = parseInt(cd) - parseInt(1);
        //             $('#3_sidebarstatus').find('.app-va-folders--counter').text(cd);
        //         }
        //     }
        // });
    }
</script>
@endsection