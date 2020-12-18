@include('include/header')
<div class="pcoded-main-container">
    <div class="pcoded-content container">
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-6 d-flex align-items-center mb-4">
                        @if(Request::path() == 'admin/list-claim-enquiry')
                            <h1 class="d-inline-block font-weight-normal mb-0">Listing Claim Enquiry</h1>
                        @else
                            <h1 class="d-inline-block font-weight-normal mb-0">Signup Enquiries</h1>
                        @endif
                    </div>
                    <div class="col-sm-6 d-block d-sm-flex align-items-center justify-content-end mb-4 text-right">
                      
                    </div>
                </div>
                @if(session()->has('success'))
                        <div class="alert alert-info alert-dismissible fade show">
                            {{ session()->get('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                @endif
                @if(session()->has('error'))
                        <div class="alert alert-danger alert-dismissible fade show">
                            {{ session()->get('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                @endif
                <div class="row listViewDiv">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                @if (count($requests) > 0)
                                    <table id="usertable" class="table table-center mb-0 ">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Service Specialty</th>
                                                <th>Employees</th>
                                                <th>Time</th>
                                                <th data-sortable="false">&nbsp;</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($requests as $request)
                                            @if(@$request->vendor->freelisting == 'Yes' || Request::path() == 'admin/signup-enquiry')
                                            <tr>                                                
                                                <td>{!! $request->firstname.' '.$request->lastname !!}</td>
                                                <td>{!! $request->email !!}</td>
                                                <td>{{$request->phone}}</td>
                                                <td>{{$request->service_specialty}}</td>
                                                <td>{{$request->employees}}</td>
                                                <td>{{date('d M Y',strtotime($request->created_at))}}</td>
                                                <td style="white-space:no-wrap;">
                                                    <a class="btn text-success p-0" title="Delete" href="{{ url('admin/change-listing-status-2/'.$request->vendor_id.'/'.'No') }}" onclick="javascript:return confirm('Do you want to change this professional to paid listing ?');"><i class="fa fa-btn fa-thumbs-up"></i></a>
                                                    <a class="text-info" title="Edit" href="{{ url('admin/signup-details/'.$request->id) }}" ><i class="fa fa-eye"></i></a>
                                                    <a class="text-primary" title="Edit" href="{{ url('admin/reply-signup/'.$request->id) }}" ><i class="fa fa-reply"></i></a>
                                                    <a class="btn text-danger p-0" title="Delete" href="{{ url('admin/delete-signup/'.$request->id) }}" onclick="javascript:return confirm('Do you want to delete this enquiry ?');"><i class="fa fa-btn fa-trash"></i></a>
                                                </td>
                                            </tr>
                                            @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <h2 class="text-center">No Enquiry Found</h2>
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
<script src="{{url('assets/js/plugins/bootstrap.min.js')}}"></script>
<script src="{{url('assets/js/pcoded.min.js')}}"></script>
<script src="{{url('assets/js/menu-setting.js')}}"></script>
<script src="{{url('assets/js/plugins/jquery.dataTables.min.js')}}"></script>
<script src="{{url('assets/js/plugins/dataTables.bootstrap4.min.js')}}"></script>
<script type="text/javascript">
    $('#usertable').DataTable({
        "aaSorting":[[5,'desc']]
    });
</script>
</body>
</html>