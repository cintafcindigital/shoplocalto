@extends('layouts.default')
@section('meta_title',$data['titleData']->meta_title)
@section('meta_keyword',$data['titleData']->meta_keyword)
@section('meta_description',$data['titleData']->meta_description)
@section('content')
@include('includes.menu')
<section class="section-padding dashboard-wrap review_main_wrp dash_main_sect">
    @include('vendor.tools_nav')
    <div class="wrapper">
       <div class="pure-g">
          <div class="pure-u-2-7">
             <div class="mr40">
                <nav class="adminAside review_list">
                   <a class="adminAside__item active" href="{{url('blogs')}}">
                      <i class="svgIcon svgIcon__gear adminAside__icon">
                         <svg viewBox="0 0 18 20">
                            <path d="M5.98 16.179a.653.653 0 0 0-.822-.472l-1.76.504c-.856.244-1.883-.17-2.325-.94l-.601-1.04C.027 13.46.18 12.365.82 11.745l1.317-1.272a.657.657 0 0 0 0-.95L.824 8.252C.183 7.634.029 6.54.473 5.769l.6-1.04c.443-.771 1.47-1.185 2.325-.94l1.76.504a.656.656 0 0 0 .823-.474l.443-1.776C6.64 1.18 7.511.5 8.4.5h1.2c.889 0 1.76.68 1.975 1.542l.444 1.775c.092.366.46.577.823.474l1.76-.504c.855-.245 1.88.17 2.324.94l.602 1.041c.443.772.29 1.865-.35 2.482L15.86 9.524a.653.653 0 0 0 0 .948l1.318 1.273c.64.619.792 1.712.348 2.484l-.6 1.04c-.442.77-1.469 1.185-2.325.94l-1.761-.504a.654.654 0 0 0-.82.474l-.445 1.778C11.36 18.82 10.489 19.5 9.6 19.5H8.4c-.89 0-1.76-.68-1.975-1.543l-.446-1.778zm1.415 1.536c.104.417.575.785 1.005.785h1.2c.43 0 .901-.368 1.005-.785l.445-1.778a1.653 1.653 0 0 1 2.067-1.193l1.76.504c.415.119.97-.105 1.184-.478l.6-1.04c.215-.375.132-.966-.177-1.266l-1.318-1.273a1.653 1.653 0 0 1 .001-2.387l1.316-1.273c.31-.3.393-.89.178-1.264l-.601-1.04c-.215-.373-.77-.597-1.183-.479l-1.76.504a1.656 1.656 0 0 1-2.068-1.192l-.444-1.776C10.501 1.868 10.03 1.5 9.6 1.5H8.4c-.43 0-.901.368-1.005.785L6.95 4.062a1.657 1.657 0 0 1-2.068 1.193l-1.76-.504c-.415-.12-.97.105-1.184.477l-.6 1.04c-.215.374-.132.966.178 1.265l1.316 1.272a1.658 1.658 0 0 1 0 2.387l-1.317 1.273c-.31.3-.393.892-.178 1.265l.602 1.042c.213.372.768.596 1.183.477l1.759-.503a1.652 1.652 0 0 1 2.067 1.19l.446 1.779zM9 8.1a1.9 1.9 0 1 0 0 3.8 1.9 1.9 0 0 0 0-3.8zm0-1a2.9 2.9 0 1 1 0 5.8 2.9 2.9 0 0 1 0-5.8z" fill-rule="nonzero"></path>
                         </svg>
                      </i> All Posts
                   </a>
                   <a class="adminAside__item " href="{{url('add-blogs')}}">
                      <i class="svgIcon svgIcon__note adminAside__icon">
                         <svg viewBox="0 0 18 19">
                            <path d="M16.636.87a.5.5 0 0 1 .5.5v11.087a.5.5 0 0 1-.143.35l-5.091 5.174a.5.5 0 0 1-.357.15H1.364a.5.5 0 0 1-.5-.5V1.37a.5.5 0 0 1 .5-.5h15.272zm-.5 1H1.864v15.26h9.472l4.8-4.878V1.87zm-4.09 15.76a.5.5 0 1 1-1 0v-5.173a.5.5 0 0 1 .5-.5h5.09a.5.5 0 0 1 0 1h-4.59v4.673zM4 6.5a.5.5 0 0 1 0-1h9a.5.5 0 1 1 0 1H4zm0 3a.5.5 0 0 1 0-1h6a.5.5 0 0 1 0 1H4z" fill-rule="nonzero"></path>
                         </svg>
                      </i> New Post
                   </a>
                   
                </nav>
             </div>
          </div>

          <div class="pure-u-5-7">
             <h1 class="adminTitle">
                            
             </h1>
             
               
       <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-6 d-flex align-items-center mb-4">
                        <h1 class="d-inline-block font-weight-normal mb-0">All Community Posts</h1>
                    </div>
                    <div class="col-sm-6 d-block d-sm-flex align-items-center justify-content-end mb-4 text-right">
                        <a href="{{url('add-blogs')}}" type="button" class="btn d-block ml-auto btn-primary"><i class="feather icon-plus mr-2"></i>Add Post</a>
                        <?php /*
                            <div class="btn-group btn-group-toggle btn-group-link">
                                <label class="btn listView active"><input type="radio"> <i class="fas fa-list"></i></label>
                                <label class="btn gridView "><input type="radio"> <i class="fas fa-th-large"></i></label>
                            </div>
                        */ ?>
                    </div>
                </div>
                @if(session()->has('success'))
                        <div class="alert alert-info">
                            {{ session()->get('success') }}
                        </div>
                @endif
                <div class="row listViewDiv">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                @if (isset($data['blogs']) && count($data['blogs']) > 0)
                                    <table id="usertable" class="table table-center mb-0 ">
                                        <thead>
                                            <tr>
                                                <th>Name or title</th>
                                                <th>Categoy</th>
                                                <th>Status</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           
                                            @foreach($data['blogs'] as $b)
                                            <tr>
                                                <td>{{$b['name']}}</td>
                                                <td>{{$b->categories['name']}}</td>
                                                <td>@if($b['approved']==1)Approved @else Not Approved @endif</td>
                                                <td>                                           
                                                    <!--<a class="text-primary" title="Edit" href="{{url('admin/edit-blog')}}/{{$b['id']}}"><i class="fa fa-edit"></i></a>-->
                                                    <a class="text-primary" title="Delete" href="{{url('delete-blog')}}/{{$b['id']}}" onclick="javascript:return confirm('Do you want to delete this blog ?');"><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                            @else
                            <h2 class="text-center">No Blogs Found</h2>
                            @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
   
              
             
            
            
             
          </div>
       </div>
    </div>
</section>
<!-- View review modal -->

<!-- Reply on review modal -->

<!-- Modal for Import Clients -->

<!-- Modal for Add Profile Picture -->

<style>
    #name_datalist .name_email, #email_datalist .name_email{
        text-overflow: ellipsis;
        display: inline-block;
        overflow: hidden;
        white-space: nowrap;
    }
    #name_datalist .name_email {
        width: 229px;
    }
    #email_datalist .name_email {
        width: 350px;
    }
    #name_datalist, #email_datalist {
        border:1px solid grey;
        padding:10px;
        overflow-y:scroll;
        height:auto;
        display: none;
        max-height: 300px;
    }
    .drop-wrapper ul li b {
        display: inline-block;
        text-overflow: ellipsis;
        /*width: 110px;*/
        overflow: hidden;
        white-space: nowrap;
        vertical-align: top;
    }
</style>
@include('includes.footer')
<script type="text/javascript">
    function show_reviews(vals) {
        if(vals == 'All') {
            $('.pending_review').removeClass('adminFilters__link--current');
            $('.all_reviews').css('display','block');
            $('.pending_reviews').css('display','none');
            $('.all_review').addClass('adminFilters__link--current');
        } else {
            $('.all_review').removeClass('adminFilters__link--current');
            $('.all_reviews').css('display','none');
            $('.pending_reviews').css('display','block');
            $('.pending_review').addClass('adminFilters__link--current');
        }
    }
    $('.review_send_btn').hover(function() {
        $(this).find('.review_send_detail').toggle();
    });
    $('.template_head').click(function() {
        $('.template_list').toggle();
    });
    function fetchTemplate(id)
    {
        if(id) {
            $.ajax({
                url: "{{ url('getTemplate').'/' }}"+id,
                type: "GET",
                data: '',
                success: function (response) {
                    // console.log(response);
                    $("input[name=template_id]").val(response.id);
                    $("input[name=templateName]").val(response.name);
                    $("textarea[name=review_message]").val(response.message);
                    $('.template_list').toggle();
                }
            });
        }
    }
    $(".name-search-input").keyup(function() {
        var search = $(this).val();
        if(search != '') {
            $.ajax({
                url: "{{ url('getSearchNameEmail').'/' }}"+search,
                type: "GET",
                data: '',
                success: function (response) {
                    if(response == '') {
                        $("#name_datalist").hide();
                    } else {
                        $("#name_datalist").show();
                        $("#email_datalist").hide();
                        $("#name_datalist").html(response);
                    }
                }
            });
        }
    });
    $(".email-search-input").keyup(function() {
        var search = $(this).val();
        if(search != '') {
            $.ajax({
                url: "{{ url('getSearchNameEmail').'/' }}"+search,
                type: "GET",
                data: '',
                success: function (response) {
                    if(response == '') {
                        $("#email_datalist").hide();
                    } else {
                        $("#name_datalist").hide();
                        $("#email_datalist").show();
                        $("#email_datalist").html(response);
                    }
                }
            });
        }
    });
    $('body').on('click', '.name_email', function() {
        var nameEmail = $(this).attr('data-value');
        var namel = nameEmail.split('--');
        $('.name-search-input').val(namel[0]);
        $('.email-search-input').val(namel[1]);

    });
    $('body').on('click','.wrapper', function(e){
        if($(e.target).attr('class') != 'reviewCollector__addUsers__input app-review-collector-templates-users-input name-search-input' || $(e.target).attr('class') != 'name_email') {
            $('#name_datalist').hide();
        }
        if($(e.target).attr('class') != 'reviewCollector__addUsers__input app-review-collector-templates-users-input email-search-input' || $(e.target).attr('class') != 'name_email') {
            $('#email_datalist').hide();
        }
    });
    $(".search-box-input").keyup(function() {
        var search = $(this).val();
        if(search != '') {
            $.ajax({
                url: "{{ url('getSearchClients').'/' }}"+search,
                type: "GET",
                data: '',
                success: function (response) {
                    // console.log(response);
                    $(".all-solicitudes").hide();
                    $(".booked-solicitudes").hide();
                    $(".searched-solicitudes").show();
                    $(".selected_all").addClass('selected');
                    $(".selected_booked").removeClass('selected');
                    $(".searched-solicitudes").html(response);
                    if(response == ''){
                        $('.adminModalImport__noResults').show();
                    } else {
                        $('.adminModalImport__noResults').hide();
                    }
                }
            });
        } else {
            $(".searched-solicitudes").hide();
            $(".booked-solicitudes").hide();
            $(".all-solicitudes").show();
            $(".selected_all").addClass('selected');
            $(".selected_booked").removeClass('selected');
            $('.adminModalImport__noResults').hide();
        }
    });
    var importClientDetail = [];
    $("body").on('click', '.importBookingRow', function() {
        var aval = $(this).find('i').hasClass('icon-tools-checkbox-grey');
        var name = $(this).find('.rctChecklistTasks__checkBoxLink').data('name');
        var mail = $(this).find('.rctChecklistTasks__checkBoxLink').data('mail');
        if(aval == true) {
            importClientDetail.push(name+'--'+mail);
            $(this).find('i').addClass('icon-tools-checkbox-green');
            $(this).find('i').removeClass('icon-tools-checkbox-grey');
        } else {
            for(var i = 0; i < importClientDetail.length; i++) {
                if(importClientDetail[i] === name+'--'+mail) {
                    importClientDetail.splice(i, 1); 
                }
            }
            $(this).find('i').addClass('icon-tools-checkbox-grey');
            $(this).find('i').removeClass('icon-tools-checkbox-green');
        }
    });
    function importClients()
    {
        var htmls = '';
        if(importClientDetail.length > 0) {
            for(var i = 0; i < importClientDetail.length; i++) {
                var vals = importClientDetail[i].split('--');
                var names = vals[0];
                var mails = vals[1];
                if(htmls == '') {
                    htmls = "<li class='bubbler__bubble'><span class='review-collector-templates-user'> "+names+" <span class='review-collector-templates-user--user-email'> "+mails+" </span><input type='hidden' name='nombre[]' value='"+names+"'><input type='hidden' name='mail[]' value='"+mails+"'></span><i class='svgIcon svgIcon__close app-bubbler-bubble-close app-bubbler-svg-clone bubbler__svgIcon'><svg viewBox='0 0 32 32' width='16' height='16' class='removeImportClient' data-value='"+importClientDetail[i]+"'><use xlink:href='#svg-_common-close'><svg id='svg-_common-close' viewBox='0 0 26 26'><path d='M12.983 10.862L23.405.439l2.122 2.122-10.423 10.422 10.423 10.422-2.122 2.122-10.422-10.423L2.561 25.527.439 23.405l10.423-10.422L.439 2.561 2.561.439l10.422 10.423z' fill-rule='nonzero'></path></svg></use></svg></i></li>";
                } else {
                    htmls = htmls+"<li class='bubbler__bubble'><span class='review-collector-templates-user'> "+names+" <span class='review-collector-templates-user--user-email'> "+mails+" </span><input type='hidden' name='nombre[]' value='"+names+"'><input type='hidden' name='mail[]' value='"+mails+"'></span><i class='svgIcon svgIcon__close app-bubbler-bubble-close app-bubbler-svg-clone bubbler__svgIcon'><svg viewBox='0 0 32 32' width='16' height='16' class='removeImportClient' data-value='"+importClientDetail[i]+"'><use xlink:href='#svg-_common-close'><svg id='svg-_common-close' viewBox='0 0 26 26'><path d='M12.983 10.862L23.405.439l2.122 2.122-10.423 10.422 10.423 10.422-2.122 2.122-10.422-10.423L2.561 25.527.439 23.405l10.423-10.422L.439 2.561 2.561.439l10.422 10.423z' fill-rule='nonzero'></path></svg></use></svg></i></li>";
                }
            }
        }
        if(htmls != '') {
            $(".app-submit-review-request").removeClass('disabled');
        } else {
            $(".app-submit-review-request").addClass('disabled');
        }
        $("#app-va-modal").modal('hide');
        $(".importClients").html(htmls);
        $('.rctChecklistTasks').find('i').addClass('icon-tools-checkbox-grey');
        $('.rctChecklistTasks').find('i').removeClass('icon-tools-checkbox-green');
    }
    $("body").on('click', '.removeImportClient', function() {
        var remVal = $(this).data('value');
        if(remVal != '') {
            for(var i = 0; i < importClientDetail.length; i++) {
                if(importClientDetail[i] === remVal) {
                    importClientDetail.splice(i, 1); 
                }
            }
            importClients();
        }
    });
    $(".reviewCollector__addButton").click(function() {
        var nombres = $('input[name=nombres]').val();
        var mails = $('input[name=mails]').val();
        if(nombres.length < 3 && mails.length < 3){
            $("#nombres_err").show();
            $("#mails_err").show();
            return false;
        } else
        if(nombres.length < 3){
            $("#nombres_err").show();
            $("#mails_err").hide();
            return false;
        } else
        if(mails.length < 3){
            $("#nombres_err").hide();
            $("#mails_err").show();
            return false;
        } else {
            $("#nombres_err").hide();
            $("#mails_err").hide();
            if(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(mails))
            {
                $("#invalidMails_err").hide();
                importClientDetail.push(nombres+'--'+mails);
                $('input[name=nombres]').val('');
                $('input[name=mails]').val('');
                importClients();
            } else {
                $("#invalidMails_err").show();
                return false;
            }
        }
    });
    $(".selected_all").click(function() {
        $(".searched-solicitudes").hide();
        $(".booked-solicitudes").hide();
        $(".all-solicitudes").show();
        $(".selected_all").addClass('selected');
        $(".selected_booked").removeClass('selected');
        var allCount = "{{ count($data['allData']) }}";
        if(allCount < 1) {
            $('.adminModalImport__noResults').show();
        } else {
            $('.adminModalImport__noResults').hide();
        }
    });
    $(".selected_booked").click(function() {
        $(".searched-solicitudes").hide();
        $(".all-solicitudes").hide();
        $(".booked-solicitudes").show();
        $(".selected_all").removeClass('selected');
        $(".selected_booked").addClass('selected');
        var arrCount = "{{ count($data['bookData']) }}";
        if(arrCount < 1) {
            $('.adminModalImport__noResults').show();
        } else {
            $('.adminModalImport__noResults').hide();
        }
    });
    function va_opinionesImportModal()
    {
        $("#app-va-modal").modal('show');
    }
    function common_disableEnterKey()
    {
        // nothing...
    }
    $(document).ready(function() {
        $('.savetemplatereview').on('click', function() {
          if(!$('#SaveAsTemplate').is(":checked")) {
              $(this).find('.icheckbox_minimal').addClass('checked');
              $('#SaveAsTemplate').prop('checked', true);
              $('.reviewappshow').show();
          } else {
              $(this).find('.icheckbox_minimal').removeClass('checked');
              $('#SaveAsTemplate').prop('checked', false);
              $('.reviewappshow').hide();
          }
        });
        $('.satasdefaultcls').on('click', function() {
          if(!$('#SetAsDefault').is(":checked")) {
              $(this).find('.icheckbox_minimal').addClass('checked');
              $('#SetAsDefault').prop('checked', true);
          } else {
              $(this).find('.icheckbox_minimal').removeClass('checked');
              $('#SetAsDefault').prop('checked', false);
          }
        });
    });
    function sendRequestAgain(id)
    {
        if(id) {
            $.ajax({
                url: "{{ url('sendRequestAgain').'/' }}"+id,
                type: "GET",
                data: '',
                success: function (response) {
                    if(response == 'done'){
                        location.reload();
                    }
                }
            });
        }
    }
    function addProfilePictureModal(id,name)
    {
        $("#add-pro-pic").modal('show');
        $("#userId").val(id);
        $(".adminModalImport__title").html("<h3> "+name+"'s profile picture </h3>");
    }
    function addProfilePicture()
    {
        var id = $("#userId").val();
        var msgs = $("textarea[name=userMessage]").val();
        if(id != '' && msgs != '') {
            $.ajax({
                url: "{{ url('addProfilePicture') }}",
                type: "POST",
                data: "id="+id+"&msgs="+msgs,
                success: function (response) {
                    if(response == 'done'){
                        location.reload();
                    }
                }
            });
        }
    }
    function view_reviews(id,name)
    {
        if(id != '' && name != '') {
            $.ajax({
                url: "{{ url('view_reviews') }}/"+id,
                type: "GET",
                data: "",
                success: function (response) {
                    if(response != '') {
                        $(".adminModalTitle").html(name+"'s Review");
                        $(".admin-reviews-item-modal").html(response);
                        $('#app-common-layer').modal('show');
                    }
                }
            });
        }
    }
    function replyOnReview(reqId,rateId,shortName,fullName)
    {
        $('#reqId').val(reqId);
        $('#rateId').val(rateId);
        $('.shortName').val(shortName);
        $('.fullName').val(fullName);
        $('#app-common-layer').modal('hide');
        $('#reply-common-layer').modal('show');
    }
    function review_next_step()
    {
        var reply_text = $("#reply_text").val();
        if(reply_text.length > 30) {
            $('.nextBTN').hide();
            $('.goBackBTN').show();
            $('.replyBTN').show();
            $(".app-review-form").hide();
            $(".app-review-photo-upload").show();
        } else {
            $('.goBackBTN').hide();
            $('.replyBTN').hide();
            $('.nextBTN').show();
            $(".app-review-photo-upload").hide();
            $(".app-review-form").show();
        }
    }
    function review_previous_step()
    {
        $('.goBackBTN').hide();
        $('.replyBTN').hide();
        $('.nextBTN').show();
        $(".app-review-photo-upload").hide();
        $(".app-review-form").show();
    }
    function readURL(input)
    {
        if(input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#reply_image_preview').show();
                $('#reply_image_preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#reply_image").change(function(){
        readURL(this);
    });
</script>
@endsection