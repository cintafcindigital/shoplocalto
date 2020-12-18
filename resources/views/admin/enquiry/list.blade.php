@include('include/header')
<div class="pcoded-main-container">
    <div class="pcoded-content container">
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-6 d-flex align-items-center mb-4">
                        <h1 class="d-inline-block font-weight-normal mb-0">All Enquiry</h1>
                    </div>
                    <div class="col-sm-6 d-block d-sm-flex align-items-center justify-content-end mb-4 text-right">
                       <!--  <a href="{{url('admin/add-page')}}" type="button" class="btn d-block ml-auto btn-primary"><i class="feather icon-plus mr-2"></i>Add Pages</a> -->
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
                <div class="row listViewDiv">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                @if (count($enquiries) > 0)
                                    <table id="usertable" class="table table-center mb-0 ">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Name</th>
                                                <th>Email Id</th>
                                                <th>Phone</th>
                                                <th>Reason</th>
                                                <th>Comment</th>
                                                <th>Reply</th>
                                                <th>###</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($enquiries as $tests)
                                            <tr>                                                
                                                <td>{{$tests->id}}</td>
                                                <td>
                                                    @php
                                                        $today = strtotime(date('Y-m-d'));
                                                    @endphp
                                                    @if($today == strtotime(date('Y-m-d',strtotime($tests->created_at))))
                                                        <small class="label pull-right bg-red">New</small>
                                                    @endif
                                                    {{$tests->name}}
                                                </td>
                                                <td>{{$tests->email}}</td>
                                                <td>{{$tests->phone}}</td>
                                                <td>{{$tests->reason}}</td>
                                                <td>{{$tests->comment}}</td>
                                                <td style="padding-top: 14px;">
                                                @if($tests->reply_status == 0)
                                                    <small class="text-warning" style="font-size: 14px;"><b>Pending</b></small>
                                                @else
                                                    <small class="text-success" style="font-size: 14px;"><b>Sent</b></small>
                                                @endif
                                                </td>
                                                <td>
                                                    <a class="text-primary" title="Edit" href="{{ url('admin/reply-enquiry/'.$tests->id) }}" ><i class="fa fa-reply"></i></a>
                                                    <form style="float: right;" action="{{ url('admin/delete_enquiry/'.$tests->id) }}" method="POST">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                                                        <button type="submit" class="btn text-danger p-0" title="Delete">
                                                            <i class="fa fa-btn fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
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
    $('#usertable').DataTable();
</script>
</body>
</html>