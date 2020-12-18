@include('include/header')
<div class="pcoded-main-container">
    <div class="pcoded-content container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>@foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
	                <div class="col-md-12 col-xl-12">
	                	<h2>Create Mail template for Freelisting Vendors</h2>
                        @if (\Session::has('message'))
                            <div class="app-hide-alert">{!! \Session::get('message') !!}</div>
                        @endif
                        <form action="{{url('admin/bulk-freelisting-vendor')}}" method="post" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="box inbox-message-request__requestBox">
                                <input type="hidden" name="attachment" id="attachment">
                                <label style="padding:10px 10px 0px;">Template Subject</label>
                                <input type="text" name="subject" class="form-control" style="margin:0px 10px;width:96%;">
                                <textarea id="app-trumbowyg-editor-va-chat" name="comments" class="app-trumbowyg-editor-va-chat trumbowyg-textarea" cols="65" rows="6" placeholder="Write a message for vendors *" tabindex="-1" style="min-height:158px;max-height:408px;"></textarea>
                                <div id="ficheroSubido" class=""></div>
                                <div class="inbox-message-reply-footer">
                                    <button type="button" class="inbox-message-reply-footer__upload icon icon-clip icon-left app-va_solis-upload-file" style="font-size:18px;font-weight:bold;">Attach files</button>
                                    <input class="dnone app-va-input-upload-file" name="fileupload" id="fileupload" type="file" accept=".jpg, .jpeg, .gif, .png, .doc, .docx, .pdf, .ppt, .pptx, .pps, .xls, .xlsx">
                                    <input class="btnFlat btnFlat--primary app-va-solic-chat-submit-btn" type="submit" value="Send Mail to All">
                                </div>
                            </div>
                        </form>
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
                url: "{{ url('admin/mailing-fileupload') }}",
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
            $.ajax({
                type:'GET',
                url: "{{ url('admin/mailing-fileremove')}}/"+imgName,
                data:'',
                cache:false,
                contentType: false,
                processData: false,
                success:function(data){
                    console.log(data);
                }
            });
        });
    });
</script>
</body>
</html>