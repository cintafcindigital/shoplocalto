@include('include/header')
<div class="pcoded-main-container">
    <div class="pcoded-content container">
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-6 d-flex align-items-center mb-4">
                        <h1 class="d-inline-block mb-0 font-weight-normal">All Staff</h1>
                    </div>
                    <div class="col-sm-6 d-block d-sm-flex align-items-center justify-content-end mb-4 text-right">
                        <button type="button" class="btn d-block ml-auto btn-primary" data-toggle="modal" data-target="#addNewStaff"><i class="feather icon-plus mr-2"></i>Add Staff</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                <div class="alert" id="message2" style="display:none;"></div>
                                @if(session()->has('success'))
                                    <div class="alert alert-info">{{ session()->get('success') }}</div>
                                @endif
                                @if (isset($staff) && count($staff) > 0)
                                    <table id="clienttable" class="table table-center mb-0 ">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Role</th>
                                                <th>Contact</th>
                                                <th>Parent Admin</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($staff as $cat)
                                            <tr>
                                                <td>
                                                    <div class="media">
                                                        @if(@$cat->profile)
                                                            <img src="{{url('/images/staff_images').'/'.$cat->profile}}" alt="Staff Image" class="img-fluid avtar avtar-s">
                                                        @else
                                                            <img src="{{url('/').'/images/staff_images/no-image.png'}}" alt="Staff Image" class="img-fluid avtar avtar-s">
                                                        @endif
                                                        <div class="media-body ml-3 align-self-center">
                                                            <h5 class="mb-1"><a class="text-dark" href="{{url('admin/staff-details').'/'.$cat->id}}">{{$cat->name}}</a></h5>
                                                            <p class="mb-0"><a href="{{ 'mailto:'.$cat->email}}" class="test-secondary">{{$cat->email}}</a></p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>@if($cat->role == 1) Super Admin 
                                                    @elseif($cat->role == 2) Admin 
                                                    @elseif($cat->role == 3) Sales Representative 
                                                    @elseif($cat->role == 4) Marketing 
                                                    @elseif($cat->role == 5) Customer Service 
                                                    @elseif($cat->role == 6) Technical Support 
                                                @endif</td>
                                                <td>{{$cat->contact}}</td>
                                                <td>@if(@$cat->get_parentAdmin['name']) {{$cat->get_parentAdmin['name']}} @else - - - - @endif</td>
                                                <td class="text-right">
                                                    <div class="float-right">
                                                        <div class="btn-group card-option">
                                                            <a href="{{url('admin/staff-details').'/'.$cat->id}}" class="btn text-primary"><i class="fa fa-eye text-success"></i></a>
                                                            <a href="{{url('admin/edit-staff').'/'.$cat->id}}" class="btn text-primary"><i class="fa fa-edit text-primary"></i></a>
                                                            @if($cat->role != 1)
                                                            <button type="button" class="btn shadow-none px-0 dropdown-toggle no-arrow" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="feather icon-more-horizontal"></i></button>
                                                            <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">
                                                                <li class="dropdown-item reload-card <?php if($cat->status== 1){echo 'active';} ?>"><a href="{{url('admin/status-staff').'/'.$cat->id}}/1"><i class="feather icon-refresh-cw"></i> Active</a></li>
                                                                <li class="dropdown-item reload-card <?php if($cat->status== 0){echo 'active';} ?>"><a href="{{url('admin/status-staff').'/'.$cat->id}}/0"><i class="feather icon-trash"></i> Inactive</a></li>
                                                            </ul>
                                                            <form action="{{url('admin/delete-staff/'.$cat->id)}}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" onclick="javascript:return confirm('Do you want to delete this user ?')" class="btn text-danger"><i class="fa fa-trash"></i></button>
                                                            </form>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <h2 class="text-center">No Staff Found</h2>
                                @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade bd-example-modal-lg" id="addNewStaff" tabindex="-1" role="dialog" aria-labelledby="addNewStaff" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Staff Member</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert" id="message" style="display:none;"></div>
                    <form class="needs-validation" id="staff_form" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label>First Name <span style="color:red;font-size:18px;">*</span></label>
                                <input type="text" class="form-control" name="firstname" placeholder="First Name">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label>Last Name <span style="color:red;font-size:18px;">*</span></label>
                                <input type="text" class="form-control" name="lastname" placeholder="Last Name">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label>Staff Role</label>
                                <select class="custom-select d-block w-100" name="role">
                                    <option value="2">Admin</option>
                                    <option value="3">Sales Representative</option>
                                    <option value="4">Marketing</option>
                                    <option value="5">Customer Service</option>
                                    <option value="6">Technical Support</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label>Email Address <span style="color:red;font-size:18px;">*</span></label>
                                <input type="email" class="form-control" name="email" placeholder="you@example.com">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label>Password <span style="color:red;font-size:18px;">*</span></label>
                                <input type="password" class="form-control" name="password" placeholder="********">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label>Profile Picture <span style="color:red;font-size:18px;">*</span></label>
                                <input type="file" class="form-control" name="profile">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label>Staff member of</label>
                                <select class="custom-select d-block w-100" name="parent_id">
                                    <option value="">Select Admin</option>
                                    @foreach($staff as $sf)
                                        @if($sf->role == 2)
                                            <option value="{{$sf->id}}">{{$sf->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label>Contact <span style="color:red;font-size:18px;">*</span></label>
                                <input type="text" class="form-control" name="contact">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label>Address <span style="color:red;font-size:18px;">*</span></label>
                                <input type="text" class="form-control" name="address">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label>ZIP / Postal Code <span style="color:red;font-size:18px;">*</span></label>
                                <input type="text" class="form-control" name="postal_code">
                                @if($errors->has('postal_code'))
                                    <span class="help-block"><strong>{{ $errors->first('postal_code') }}</strong></span>
                                @endif
                            </div>
                            <div class="col-md-4 mb-3">
                                <label>State</label>
                                <select class="custom-select d-block w-100" name="state">
                                    @foreach($states as $st)
                                        <option>{{$st->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label>Country</label>
                                <select class="custom-select d-block w-100" name="country">
                                    @foreach($countries as $cn)
                                        <option @if($cn->sortname == 'CA') selected @endif>{{$cn->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <hr class="mb-4">
                        <button class="btn btn-primary" type="submit">Create Member</button>
                    </form>
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
<script>
$(document).ready(function(){
    $('#staff_form').on('submit', function(event){
        event.preventDefault();
        $.ajax({
            url: "{{url('admin/staff')}}",
            method: "POST",
            data: new FormData(this),
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success:function(data) {
                if(data.class_name == 'alert-danger') {
                    $('#message').css('display', 'block');
                    $('#message').html(data.message);
                    $('#message').addClass(data.class_name);
                } else if(data.class_name == 'alert-success') {
                    $('#message2').css('display', 'block');
                    $('#message2').html(data.message);
                    $('#message2').addClass(data.class_name);
                    $('#addNewStaff').modal('hide');
                    setTimeout(function(){ location.reload(); },1000);
                }
            }
        })
    });
});
</script>
</body>
</html>