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
            <div class="pure-u-1">
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
                <?php
                    $curls = url()->current();
                    $purls = url()->previous();
                    if($purls == $curls) {
                        $purls = url('supports/opened');
                    }
                ?>
                <h1 style="text-align:center;font-weight:bold;">
                    Add New Support Ticket<a href="{{$purls}}" style="float:right;font-size:18px;"> << Go Back</a>
                </h1><p></p>
                <div class="pure-g">
                    <div class="pure-u-1">
                        <div id="app-new-inbox-message-request" class="inbox-message-request inbox-message-request-user" style="padding-right: 0">
                            <div class="pure-g">
                                <div class="pure-u-1-15">
                                    @if(@$data['vendorData'][0]['image_data'][0]['image'])
                                    <div class="avatar-vendor">
                                        <img class="avatar-thumb" src="{{url('public/vendors/VENDOR_'.$data['vendorData'][0]['vendor_id'].'/'.$data['vendorData'][0]['image_data'][0]['image'])}}" alt="User Image" width="64px" height="64px" style="height: 60px; width: 60px">
                                    </div>
                                    @else
                                    <div class="avatar-alias size-avatar-medium">
                                        <svg class="avatar-generic" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200" preserveAspectRatio="xMidYMin slice">
                                            <circle fill="#C7C9C0" cx="100" cy="100" r="100"></circle>
                                            <text transform="translate(100,130)" y="0">
                                                <tspan font-size="90" class="" fill="rgba(0,0,0,0.3)" text-anchor="middle">{{ucfirst(substr(@$data['vendorData'][0]['contact_person'], 0, 1))}}</tspan>
                                            </text>
                                        </svg>
                                    </div>
                                    @endif
                                </div>
                                <div class="pure-u-14-15">
                                    <div class="tools-inbox-message-reply">
                                        <form class="app-vendors-solicitudes-response-form" action="{{url('/send-new-supports')}}" name="frmToolLayer" id="frmToolLayer" method="post" enctype="multipart/form-data">
                                            {{csrf_field()}}
                                            <div class="box inbox-message-request__requestBox">
                                                <input type="hidden" name="attachment" id="attachment">
                                                <div class="pure-u-11-24" style="width:49%;padding: 10px 10px 0px;">
                                                    <label style="padding-left:10px;">
                                                        Select Category <span style="color:red;font-size:18px;">*</span>
                                                    </label>
                                                    <select class="form-control" name="subject">
                                                        <option value="">- - Select Category - -</option>
                                                        <option value="customer-service">Customer Service</option>
                                                        <option value="sales-support">Sales / Billing Support</option>
                                                        <option value="technical-support">Technical Support</option>
                                                    </select>
                                                </div>
                                                <div class="pure-u-11-24" style="width:49%;padding: 10px 10px 0px;">
                                                    <label>
                                                        Select Priority <span style="color:red;font-size:18px;">*</span>
                                                    </label>
                                                    <select class="form-control" name="priority">
                                                        <option value="">- - Select Priority - -</option>
                                                        <option value="Low">Low</option>
                                                        <option value="Medium">Medium</option>
                                                        <option value="High">High</option>
                                                        <option value="Urgent">Urgent</option>
                                                    </select>
                                                </div>
                                                <label style="padding:10px 10px 0px;">
                                                    Ticket Subject <span style="color:red;font-size:18px;">*</span>
                                                </label>
                                                <input type="text" name="title" class="form-control" placeholder="Your ticket subject *" style="margin:0px 10px;width:96%;">
                                                <textarea id="app-trumbowyg-editor-va-chat" name="comments" class="app-trumbowyg-editor-va-chat trumbowyg-textarea" cols="65" rows="6" placeholder="Write a message *" tabindex="-1" style="min-height:158px;max-height:408px;"></textarea>
                                                <div id="ficheroSubido" class=""></div>
                                                <div class="inbox-message-reply-footer">
                                                    <button class="inbox-message-reply-footer__upload icon icon-clip icon-left app-va_solis-upload-file" style="font-size:18px;font-weight:bold;">Attach files</button>
                                                    <input class="dnone app-va-input-upload-file" name="fileupload" id="fileupload" type="file" accept=".jpg, .jpeg, .gif, .png, .doc, .docx, .pdf, .ppt, .pptx, .pps, .xls, .xlsx">
                                                    <input class="btnFlat btnFlat--primary app-va-solic-chat-submit-btn" type="submit" value="Add New Ticket">
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
    <div id="app-vendor-availability-dialog" data-target="#app-vendor-availability-dialog" class="modal"></div>
</section>
@include('vendor.ExportLeads.exportleads_popup')
@include('includes.footer')
<script src="https://cdn.tiny.cloud/1/08cq8y02kwr759p88hfbo9ym579ceup2a7x2vebx42n6ceee/tinymce/5/tinymce.min.js"></script>
<script>
    tinymce.init({
        selector:'#app-trumbowyg-editor-va-chat',
        width: 1080,
        height: 300/*,
        init_instance_callback : function(editor) {
            var freeTiny = document.querySelector('.tox .tox-notification--in');
            freeTiny.style.display = 'none';
        }*/
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
</script>
@endsection