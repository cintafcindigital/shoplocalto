@include('include/header')
<div class="pcoded-main-container">
    <div class="pcoded-content container">
        <div class="row">
            <div class="col-sm-12">
                <div class="row align-items-center">
                    <div class="col-md-12 col-xl-12 mb-3" style="text-align:center;">
                        <h1 style="display:inline-block;">Team Member Profile</h1>
                    </div>
                    <div class="col-md-6 col-xl-3">
                        @if(@$data->photo)
                            <img src="{{url('/public/vendors/VENDOR_'.$data->vendor_id.'/'.$data->photo)}}" class="figure-img img-fluid rounded" alt="...">
                        @else
                            <img src="{{url('/public/storage/no-image.png')}}" alt="Vendor Image" class="figure-img img-fluid rounded">
                        @endif
                    </div>
                    <div class="col-md-12 col-xl-5">
                        <h2 class="d-inline-block font-weight-normal">{{ucwords($data->firstname).' '.ucwords($data->lastname)}}</h2>
                        <p class="text-justify">{!! $data->biography !!}</p>
                        <div class="row my-4">
                            <div class="col-sm-6">
                                <a href="mailto:{{$data->email}}">
                                    <h5 class="text-h-primary mb-3">{{$data->email}}</h5>
                                </a>
                            </div>
                            <div class="col-sm-6">
                                <h5 class="mb-3">{{ ucwords($data->position) }}</h5>
                            </div>
                        </div>
                        <!-- <label style="font-size:16px;border:2px solid #0B69FF;border-radius:5px;padding:5px 8px;">
                            <a href="javascript:;" type="button" style="color:#000;">Update Password</a>
                        </label>
                        <label><input type="password" name="password" class="form-control" placeholder="Enter new password"></label> -->
                    </div>
                    <div class="col-md-12 col-xl-4">
                        <h6 class="mb-3 text-uppercase text-body f-12">Vendors</h6>
                        <div class="media mb-5">
                            <?php
                            if($vendor_data) {
                            ?>
                            @if($vendor_data->profile != '')
                                <img src="{{url('/public/vendors/VENDOR_'.$vendor_data->vendor_id.'/'.$vendor_data->profile)}}" alt="Vendor Profile" title="{{$vendor_data->contact_person}}" class="img-fluid avtar mr-3 mb-3">
                            @else
                                <img src="{{url('/public/storage/no-image.png')}}" title="{{$vendor_data->contact_person}}" alt="Vendor Profile" class="img-fluid avtar mr-3 mb-3">
                            @endif
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <ul class="nav nav-tabs mb-3" id="TasksmyTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link text-uppercase active" id="Messages-tab" data-toggle="tab" href="#Messages1" role="tab" aria-controls="Messages1" aria-selected="false">Messages</a>
                    </li>
                </ul>
                <div class="tab-content" id="TasksmyTabContent">
                    <div class="tab-pane fade show active" id="Messages1" role="tabpanel" aria-labelledby="Messages-tab">
                        <div class="row">
                            <div class="card" style="width:100%;">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="proftable" class="table table-center mb-0 ">
                                            <thead>
                                                <tr>
                                                    <th>Couples Name</th>
                                                    <th>Wedding Date</th>
                                                    <th>No. of Guests</th>
                                                    <th>Event Date</th>
                                                    <th>Message Title</th>
                                                    <th class="text-right">Read Status</th>
                                                    <th class="text-right">Reply Status</th>
                                                    <!-- <th>Action</th> -->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if(count($chatMessage) > 0)
                                                    @foreach($chatMessage as $cm)
                                                    <tr>
                                                        <td>
                                                            <div class="media">
                                                                @if(@$cm->user->profile_image)
                                                                    <img src="{{url('/public/storage/').'/USER_'.$cm->user->id.'/'.$cm->user->profile_image}}" alt="Couple Image" class="img-fluid avtar avtar-s">
                                                                @else
                                                                    <img src="{{url('/').'/public/storage/no-image.png'}}" alt="Couple Image" class="img-fluid avtar avtar-s">
                                                                @endif
                                                                <div class="media-body ml-3 align-self-center">
                                                                    <h5 class="mb-1">
                                                                        <a href="javascript:;" class="text-dark">{{$cm->user->name}}</a>
                                                                    </h5>
                                                                    <p class="mb-0"> <a href="mailto:{{$cm->user->email}}">{{$cm->user->email}}</a></p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>{{$cm->user->event_date}}</td>
                                                        <td>{{$cm->number_of_guests}}</td>
                                                        <td>{{$cm->event_date}}</td>
                                                        <td>{{$cm->name}}</td>
                                                        <td class="text-right">
                                                            @if($cm->read_status == '1')
                                                                <span class="badge badge-pill badge-success">Done</span>
                                                            @else
                                                                <span class="badge badge-pill badge-danger">Not Read</span>
                                                            @endif
                                                        </td>
                                                        <td class="text-right">
                                                            @if($cm->reply_status == '0')
                                                                <span class="badge badge-pill badge-dark">Pending</span>
                                                            @elseif($cm->reply_status == '1')
                                                                <span class="badge badge-pill badge-light-dark">Replied</span>
                                                            @elseif($cm->reply_status == '2')
                                                                <span class="badge badge-pill badge-danger">Discarded</span>
                                                            @elseif($cm->reply_status == '3')
                                                                <span class="badge badge-pill badge-success">Booked</span>
                                                            @endif
                                                        </td>
                                                        <!-- <td>
                                                        <a class="btn  btn-primary btn-sm" title="Reply" href="{{ url('admin/reply-enquiry/'.$cm->id) }}" style="float:left;margin-right:5px;"><i class="fa fa-reply"></i></a>
                                                        <form style="float: left;width: 30%;" action="{{ url('admin/delete_enquiry/'.$cm->id) }}" method="POST">
                                                            {{ csrf_field() }}
                                                            {{ method_field('DELETE') }}
                                                            <button type="submit" class="btn btn-danger btn-sm" title="Delete">
                                                                <i class="fa fa-btn fa-trash"></i>
                                                            </button>
                                                        </form>
                                                        </td> -->
                                                    </tr>
                                                    @endforeach
                                                @else
                                                <tr>
                                                    <td colspan="7" style="text-align:center;" class="pt-5"><h4>Oops!.. No Message Found ! </h4></td>
                                                </tr>
                                                @endif
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
    $('#proftable').DataTable();
</script>
</body>
</html>