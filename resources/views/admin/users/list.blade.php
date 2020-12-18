@include('include/header');
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
                <div class="row">
                    <div class="col-sm-6 d-flex align-items-center mb-4">
                        <h1 class="d-inline-block mb-0 font-weight-normal">Couples</h1>
                        <h6 class="d-inline-block mb-0 ml-4"><i class="feather icon-download"></i> Download CSV</h6>
                    </div>
                    <div class="col-sm-6 d-block d-sm-flex align-items-center justify-content-end mb-4 text-right">
                        <button type="button" class="btn d-block ml-auto btn-primary"><i class="feather icon-plus mr-2"></i>Add</button>
                        <div class="btn-group btn-group-toggle btn-group-link">
                            <label class="btn active">
                                <input type="radio" name="options" id="filteropt11" checked=""> <i class="fas fa-sort-amount-down m-r-5"></i>SORT</label>
                            <label class="btn ">
                                <div class="dropdown mb-0 mr-2">
                                    <a class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-sort-amount-up-alt m-r-5"></i>FILTER</a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#!"><i class="feather icon-alert-circle mr-2"></i> City</a>
                                        <a class="dropdown-item" href="#!"><i class="feather icon-target mr-2"></i> Province</a>
                                        <a class="dropdown-item" href="#!"><i class="feather icon-calendar mr-2"></i> Date</a>
                                    </div>
                                </div>
                            </label>
                        </div>
                        <!-- <span class="my-2">|</span>
                        <div class="btn-group btn-group-toggle btn-group-link">
                            <label class="btn active"><input type="radio" name="options" id="listopt11" checked=""> <i class="fas fa-th-large"></i></label>
                            <label class="btn "><input type="radio" name="options" id="listopt12"> <i class="fas fa-list"></i></label>
                        </div> -->
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                @if(session()->has('success'))
                                    <div class="alert alert-info">{{ session()->get('success') }}</div>
                                @endif
                                @if (isset($users) && count($users) > 0)
                                    <table id="clienttable" class="table table-center mb-0 ">
                                        <thead>
                                            <tr>
                                                <th>Couple</th>
                                                <th>No. of Vendors</th>
                                                <th class="text-right">Vendors</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($users as $cat)
                                            <tr>
                                                <td>
                                                    <div class="media">
                                                        @if(@$cat->profile_image)
                                                        <!-- <img src="{{url('/public/user_profile/')}}/{{$cat->profile_image}}" alt="Couple Image" class="img-fluid avtar avtar-s"> -->
                                                        <img src="{{url('/public/storage/').'/USER_'.$cat->id.'/'.$cat->profile_image}}" alt="Couple Image" class="img-fluid avtar avtar-s">
                                                        
                                                        @else
                                                        <img src="{{url('/').'/public/storage/no-image.png'}}" alt="Vendor Image" class="img-fluid avtar avtar-s">
                                                        @endif
                                                        <div class="media-body ml-3 align-self-center">
                                                            <h5 class="mb-1"><a class="text-dark" href="{{url('admin/user-details')}}/{{$cat->id}}">{{$cat->name}}</a></h5>
                                                            <p class="mb-0">Wedding Date : {!!date('j<\s\up>S</\s\up> M, Y',strtotime($cat->event_date))!!}</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>{{str_pad(count($cat->noOfBookedVendors), 2, '0', STR_PAD_LEFT)}}</td>
                                                <td class="text-right">
                                                
                                                <?php 
                                                        $i = 0;
                                                        foreach ($cat->noOfAddedVendors as $myVendor)
                                                        {
                                                ?>

                                                @if($myVendor->vendorData[0]->profile != '')
                                                <img src="{{url('/public/vendors/VENDOR_'.$myVendor->vendorData[0]->vendor_id.'/')}}/{{$myVendor->vendorData[0]->profile}}" alt="Couple Image" class="img-fluid avtar avtar-xs mr-2">
                                                @else
                                                <img src="{{url('/public/storage/no-image.png')}}" alt="Couple Image" class="img-fluid avtar avtar-xs mr-2">
                                                @endif

                                                <?php
                                                            $i++;
                                                            if($i==4){
                                                                break;
                                                            }
                                                        }
                                                        if(count($cat->noOfAddedVendors) > 0){
                                                            echo "<button type='button' class='btn btn-icon' style='padding:17px;' data-toggle='modal' data-target='#vendorTeamMembers'>+".(count($cat->noOfAddedVendors)-4)."</button>";
                                                        }
                                                        else{
                                                            echo "<button type='button' class='btn btn-icon'><i class='feather icon-plus'></i></button>";
                                                        }
                                                 ?>

                                                </td>
                                                <td class="text-right">
                                                    <div class="float-right">
                                                        <div class="btn-group card-option">
                                                            <a href="{{url('admin/user-details')}}/{{$cat->id}}" class="btn text-primary"><i class="fa fa-eye text-success"></i></a>
                                                            <a href="{{url('admin/edit-user')}}/{{$cat->id}}" class="btn text-primary"><i class="fa fa-edit text-primary"></i></a>
                                                            <button type="button" class="btn shadow-none px-0 dropdown-toggle no-arrow" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="feather icon-more-horizontal"></i></button>
                                                            <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">
                                                                <li class="dropdown-item reload-card <?php if($cat->status== 1){echo 'active';} ?>"><a href="{{url('admin/status-user')}}/{{$cat->id}}/1"><i class="feather icon-refresh-cw"></i> Active</a></li>
                                                                <li class="dropdown-item close-card <?php if($cat->status== 0){echo 'active';} ?>"><a href="{{url('admin/status-user')}}/{{$cat->id}}/0"><i class="feather icon-trash"></i> Inactive</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <h2 class="text-center">No Couples Found</h2>
                                @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="vendorTeamMembers" tabindex="-1" role="dialog" aria-labelledby="vendorTeamMembersTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header border-bottom">
            <h5 class="modal-title" id="exampleModalLongTitle">Vendors added by User</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <?php  $i=1; ?>

            @foreach($users as $cat)
                @foreach($cat->noOfAddedVendors as $myVendor)
                    <div class="media py-3">
                        <!-- <span class="avtar avtar-square text-white bg-yellow-2 ">NE</span> -->
                        <h5 style="padding: 14px 14px  14px 0;margin-bottom: 0;margin-right: 10px;"><?php $total = $i++; echo str_pad($total, 2, '0', STR_PAD_LEFT); ?></h5>                        

                        @if($myVendor->vendorData[0]->profile != '')
                        <img src="{{url('/public/vendors/VENDOR_'.$myVendor->vendorData[0]->vendor_id.'/')}}/{{$myVendor->vendorData[0]->profile}}" alt="{{$myVendor->vendorData[0]->contact_person}}" class="img-fluid avtar mr-3">
                        @else
                        <img src="{{url('/public/storage/no-image.png')}}" alt="Couple Image" class="img-fluid avtar mr-3">
                        @endif

                        <div class="media-body ml-2 align-self-center">
                            @foreach ($myVendor->vendorCompanyData as $value)                                
                                <h5 class="mb-1"><a href="{{url('admin/vendor-details')}}/{{$myVendor->vendorData[0]->vendor_id}}" target="_blank" class="text-dark">{{$value['business_name']}}</a></h5>
                                <p class="mb-0">{{$myVendor->vendorData[0]->contact_person}}</p>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            @endforeach

            <?php  ?>
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

<script>
    $('#clienttable').DataTable();
    $('input[type=search]').attr("placeholder", 'name, email, #phone');
</script>
</body>
</html>
<!-- 
<div class="pcoded-main-container">
    <div class="pcoded-content container">
        <form class="navbar-form navbar-left" role="search" method="get" action="{{url('admin/users')}}">
            <div class="col-sm-6 input-group mb-3">
                <input type="text" name="search" class="form-control" placeholder="Search" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-outline-secondary"><i class="fa fa-search"></i></button>
                    <a class="btn btn-outline-secondary" href="{{url('admin/users')}}"><i class="fas fa-redo-alt"></i></a>
                </div>
            </div>
        </form>
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h1 class="d-inline-block font-weight-normal text-body mb-0">All Users</h1>
                    <div class="card-body">
                        <div class="table-responsive">
                            @if(session()->has('success'))
                                <div class="alert alert-info">{{ session()->get('success') }}</div>
                            @endif
                            @if (isset($users) && count($users) > 0)
                            <table id="tasktable" class="table table-hover table-center mb-0 ">
                                <thead>
                                    <tr>
                                        <th class="border-top-0">Id</th>
                                        <th class="border-top-0">User Name</th>
                                        <th class="border-top-0">Email Id</th>
                                        <th class="border-top-0">Address</th>
                                        <th class="border-top-0">Event Date</th>
                                        <th class="border-top-0">Role</th>
                                        <th class="border-top-0">Login Via</th>
                                        <th class="border-top-0">Created At</th>
                                        <th class="border-top-0">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $cat)
                                    <tr>
                                        <td width="4%">{{$cat->id}}</td>
                                        <td width="10%">{{$cat->name}}
                                            @php $today = strtotime(date('Y-m-d')); @endphp
                                            @if($today == strtotime(date('Y-m-d',strtotime($cat->created_at))))
                                                <small class="label pull-right bg-red">New</small>
                                            @endif
                                        </td>
                                        <td width="10%">{{$cat->email}}</td>
                                        <td width="10%">{{$cat->address}}</td>
                                        @if($cat->event_date)
                                            <td width="10%">{!!date('j<\s\up>S</\s\up> M, Y',strtotime($cat->event_date))!!}</td>
                                        @else
                                            <td width="10%"><i>Null</i></td>
                                        @endif
                                        <td width="10%">{{$cat->event_role}}</td>
                                        <td width="10%"><span class="label bg-blue">Web Form</span></td>
                                        <td width="10%">{!!date('j<\s\up>S</\s\up> M, Y',strtotime($cat->created_at))!!}</td>
                                        <td width="15%">
                                            @php $status = ($cat->status==1)?0:1 @endphp
                                            <a title="<?php echo $status==1?'Disable':'Enable'; ?>" style="float: left;margin-right:5px;color:<?php echo $status==1?'#ff0b37':'#00db12'; ?>" href="{{url('admin/status-user')}}/{{$cat->id}}/{{$status}}">
                                                <?php echo ($status==0)?'<i class="fa fa-thumbs-up"></i>':'<i class="fa fa-thumbs-down"></i>'; ?>
                                            </a>&nbsp; &nbsp;
                                            <a title="Edit" href="{{url('admin/edit-user')}}/{{$cat->id}}"><i class="fa fa-edit"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @else
                                <h2 class="text-center">No User Found</h2>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{url('assets/js/plugins/bootstrap.min.js')}}"></script>
<script src="{{url('assets/js/pcoded.min.js')}}"></script>
<script src="{{url('assets/js/plugins/apexcharts.min.js')}}"></script>
<script src="{{url('assets/js/plugins/moment.min.js')}}"></script>
<script src="{{url('assets/js/plugins/daterangepicker.js')}}"></script>
</body>
</html> -->