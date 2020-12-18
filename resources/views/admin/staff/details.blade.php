@include('include/header')
<div class="pcoded-main-container">
    <div class="pcoded-content container">
        <div class="row">
            <div class="col-sm-12">
                <div class="row align-items-center">
                    @if(isset($staff) && !empty($staff))
                    <div class="col-md-12 col-xl-12 mb-3" style="text-align:center;">
                        <h1 style="display:inline-block;">Staff Profile</h1>
                        <a href="{{url('admin/edit-staff')}}/{{$staff->id}}" class="btn btn-primary float-right">Edit Profile</a>
                    </div>
                    <div class="col-md-6 col-xl-3">
                        @if($staff->profile)
                            <img src="{{url('/images/staff_images/').'/'.$staff->profile}}" alt="Staff Image" class="figure-img img-fluid rounded">
                        @else
                           <img src="{{url('/').'/images/staff_images/no-image.png'}}" alt="Staff Image" class="figure-img img-fluid rounded">
                        @endif
                    </div>
                    <div class="col-md-12 col-xl-5">
                        <h2 class="d-inline-block font-weight-normal">{{$staff->name}}</h2>
                        <p>@if($staff->role == 1) Super Admin 
                            @elseif($staff->role == 2) Admin 
                            @elseif($staff->role == 3) Sales Representative 
                            @elseif($staff->role == 4) Marketing 
                            @elseif($staff->role == 5) Customer Service 
                            @elseif($staff->role == 6) Technical Support 
                        @endif</p>
                        <div class="row my-4">
                            <div class="col-sm-6">
                                <a href="mailto:{{$staff->email}}">
                                    <h5 class="text-h-primary mb-3">{{$staff->email}}</h5>
                                </a>
                                <h5 class="mb-3">{{$staff->contact}}</h5>
                            </div>
                            <div class="col-sm-6">
                                <h5 class="mb-3">{{$staff->address.' - '.$staff->postal_code}}</h5>
                                <h5 class="mb-3">{{$staff->state.', '.$staff->country}}</h5>
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="col-md-12 col-xl-4">
                        @if($staff->get_parentAdmin['name'] != '' && $staff->role > 2)
                            <h6 class="mb-3 text-uppercase text-body f-12">Parent Admin</h6>
                            <div class="media">
                                <a href="{{url('admin/staff-details').'/'.$staff->get_parentAdmin['id']}}" target="_blank">
                                @if($staff->get_parentAdmin['profile'] != '')
                                    <img src="{{url('/').'/images/staff_images/'.$staff->get_parentAdmin['profile']}}" alt="Staff Image" title="{{$staff->get_parentAdmin['name']}}" class="img-fluid avtar mr-3 mb-1">
                                @else
                                    <img src="{{url('/images/staff_images/no-image.png')}}" alt="Staff Images" title="{{$staff->get_parentAdmin['name']}}" class="img-fluid avtar mr-3 mb-1">
                                @endif
                                </a>
                            </div>
                        @endif
                        @if(count($staff->get_staffMember) > 0 && $staff->role == 2)
                            <h6 class="mb-3 text-uppercase text-body f-12">Staff Member</h6>
                            <div class="media">
                                @foreach($staff->get_staffMember as $sm)
                                    <a href="{{url('admin/staff-details').'/'.$sm->id}}" target="_blank">
                                    @if($sm->profile != '')
                                        <img src="{{url('/').'/images/staff_images/'.$sm->profile}}" alt="Staff Image" title="{{$sm->name}}" class="img-fluid avtar mr-3 mb-1">
                                    @else
                                        <img src="{{url('/images/staff_images/no-image.png')}}" alt="Staff Images" title="{{$sm->name}}" class="img-fluid avtar mr-3 mb-1">
                                    @endif
                                    </a>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{url('/assets/js/plugins/bootstrap.min.js')}}"></script>
<script src="{{url('/assets/js/pcoded.min.js')}}"></script>
<script src="{{url('/assets/js/menu-setting.js')}}"></script>
<script src="{{url('/assets/js/plugins/jquery.dataTables.min.js')}}"></script>
<script src="{{url('/assets/js/plugins/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{url('/assets/js/plugins/jquery.dataTables.min.js')}}"></script>
<script src="{{url('/assets/js/plugins/dataTables.bootstrap4.min.js')}}"></script>
<script>
    $('#proftable1').DataTable();
</script>
</body>
</html>