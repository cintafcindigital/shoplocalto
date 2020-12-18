@include('include/header')
<?php
$q = @Request::get('q') ? : '';
?>
<div class="pcoded-main-container">
    <div class="pcoded-content container">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-header">
                    <div class="page-block">
                        <div class="row align-items-center">
                            <div class="col-md-12">
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{url('admin/')}}">Dashboard</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center">
                    <div class="col-md-12 col-xl-12 mb-3" style="text-align:center;">
                        <h1 style="display:inline-block;">Admin Profile</h1>
                        <a href="{{url('admin/edit-admin')}}/{{$admins[0]->id}}" class="btn btn-primary float-right">Edit Profile</a>
                    </div>
                    <div class="col-md-6 col-xl-3" style="margin-bottom:50px;">
                        @if(@$company[0]->logo)
                            <img src="{{url('/public/images')}}/{{$company[0]->logo}}" class="figure-img img-fluid rounded w-100" alt="...">
                        @else
                            <img src="{{url('/').'/public/storage/no-image.png'}}" alt="Vendor Image" class="figure-img img-fluid rounded">
                        @endif
                    </div>
                    <div class="col-md-12 col-xl-5">
                        @if(isset($company) && !empty($company))
                            <h2 class="d-inline-block font-weight-normal">{{$admins[0]->name}}</h2>
                            <p class="text-justify">{{$admins[0]->email}}</p>
                            <div class="row my-4">
                                <div class="col-sm-6">
                                    <h5 class="mb-3">{{$company[0]->company_name}}&nbsp;</h5>
                                    <a href="mailto:{{$company[0]->email_id}}">
                                        <h5 class="text-h-primary mb-3">{{$company[0]->email_id}}</h5>
                                    </a>
                                </div>
                                <div class="col-sm-6">
                                    <h5 class="mb-3">{{$company[0]->address}}&nbsp;</h5>
                                    <h5 class="mb-3">{{$company[0]->fax_number}}</h5>
                                </div>
                                <div class="col-sm-6">                                    
                                    <h5 class="mb-3">{{$company[0]->phone_number}}</h5>
                                </div>
                                <div class="col-sm-6">                                   
                                    <h5 class="mb-3">{{$company[0]->toll_free_number}}</h5>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="col-md-12 col-xl-4">
                       
                    </div>
                </div>
                <ul class="nav nav-tabs mb-3" id="TasksmyTab" role="tablist">
                    
                    <li class="nav-item">
                        <a class="nav-link text-uppercase @if($q == '') active @endif" id="SocialMedia-tab" data-toggle="tab" href="#SocialMedia1" role="tab" aria-controls="SocialMedia1" aria-selected="false">Social Media</a>
                    </li>
                    
                </ul>
                @if(session()->has('success'))
                    <div class="alert alert-info mb-4 alert-dismissible fade show"> {{ session()->get('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="tab-content" id="TasksmyTabContent">
                    <div class="tab-pane fade @if($q != '') show active @endif" id="Messages1" role="tabpanel" aria-labelledby="Messages-tab">
                        <div class="row">
                            <div class="card" style="width:100%;">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="proftable2" class="table table-center mb-0 ">
                                            <thead>
                                                <tr>
                                                   <th>Heading 01</th>
                                                   <th>Heading 02</th>
                                                   <th>Heading 03</th>
                                                   <th>Heading 04</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade @if($q == '') show active @endif" id="SocialMedia1" role="tabpanel" aria-labelledby="SocialMedia-tab">
                        <div class="row">
                            <div class="card" style="width:100%;">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="socialmedia" class="table table-center mb-0 ">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Social Link</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($socialmedia as $social)
                                                    <tr>
                                                    <form class="form-horizontal"  method="POST" action="{{url('/admin/edit_social_settings_data')}}" enctype="multipart/form-data">
                                                        {{ csrf_field() }}
                                                            <td>{!!$social->icon!!}</td>
                                                            <td>
                                                                <span id="span1{{$social->id}}">{{$social->name}}</span>
                                                                <input type="text" id="input1{{$social->id}}" class="form-control" name="name" value="{{$social->name}}" style="display: none;">
                                                                @if($errors->has('name'))
                                                                    <span class="help-block"><strong>{{ $errors->first('name') }}</strong></span>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <span id="span2{{$social->id}}" >{{$social->social_link}}</span>
                                                                <input type="text" id="input2{{$social->id}}" class="form-control" name="social_link" value="{{$social->social_link}}" style="display: none;">
                                                                @if($errors->has('social_link'))
                                                                    <span class="help-block"><strong>{{ $errors->first('social_link') }}</strong></span>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <input type="hidden" name="social_id" value="{{$social->id}}">
                                                                
                                                                <div id="span3{{$social->id}}">
                                                                    <a title="Edit" href="javascript:;" onclick="socialpanel('{{$social->id}}')"><i class="fa fa-edit"></i></a> &nbsp; &nbsp; 
                                                                    @php $status = ($social->status==1)?0:1 @endphp
                                                                    <a title="<?php echo $status==1?'Disable':'Enable'; ?>" style="color:<?php echo $status==1?'#ff0b37':'#00db12'; ?>" href="{{url('admin/status-social-settings')}}/{{$social->id}}/{{$status}}">
                                                                        <?php echo ($status==0)?'<i class="fa fa-thumbs-up"></i>':'<i class="fa fa-thumbs-down"></i>'; ?>
                                                                    </a>
                                                                </div>
                                                                <div class="form-group mb-0" style="display: none;" id="input3{{$social->id}}">
                                                                    <button class="btn text-success btn-sm" type="submit" style="background: none;border: none;"><i class="fa fa-check"></i></button>&nbsp;&nbsp;
                                                                    <button class="btn text-danger btn-sm" type="button" onclick="socialpanel('{{$social->id}}')" style="background: none;border: none;"><i class="fa fa-times"></i></button>
                                                                </div>
                                                            </td>
                                                    </form>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
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
<script src="{{url('/')}}/assets/js/plugins/bootstrap.min.js"></script>
<script src="{{url('/')}}/assets/js/pcoded.min.js"></script>
<script src="{{url('/')}}/assets/js/menu-setting.js"></script>
<script src="{{url('/')}}/assets/js/plugins/jquery.dataTables.min.js"></script>
<script src="{{url('/')}}/assets/js/plugins/dataTables.bootstrap4.min.js"></script>
<script src="{{url('/')}}/assets/js/plugins/jquery.dataTables.min.js"></script>
<script src="{{url('/')}}/assets/js/plugins/dataTables.bootstrap4.min.js"></script>
<script>
    $('#socialmedia').DataTable();
    $('#proftable1').DataTable();
    $('#proftable2').DataTable();
    $('#proftable3').DataTable();
    $('#proftable4').DataTable();
</script>
<script type="text/javascript">
    function socialpanel(id) {
        if($('#input1'+id).css('display') == 'none'){
            $('#input1'+id).css('display','block');
            $('#span1'+id).css('display','none');
        }else{        
            $('#input1'+id).css('display','none');
            $('#span1'+id).css('display','block');
        }
        if($('#input2'+id).css('display') == 'none'){
            $('#input2'+id).css('display','block');
            $('#span2'+id).css('display','none');
        }else{        
            $('#input2'+id).css('display','none');
            $('#span2'+id).css('display','block');
        }
        if($('#input3'+id).css('display') == 'none'){
            $('#input3'+id).css('display','block');
            $('#span3'+id).css('display','none');
        }else{        
            $('#input3'+id).css('display','none');
            $('#span3'+id).css('display','block');
        }
    }
</script>
@@include('./include/footer.php')
</body>
</html>