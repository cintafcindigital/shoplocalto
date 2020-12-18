@include('include/header')
<div class="pcoded-main-container">
    <div class="pcoded-content container">
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-6 d-flex align-items-center mb-4">
                        <h1 class="d-inline-block font-weight-normal mb-0">All Communities</h1>
                    </div>
                    <div class="col-sm-6 d-block d-sm-flex align-items-center justify-content-end mb-4 text-right">
                        <a href="{{url('admin/add-community')}}" type="button" class="btn d-block ml-auto btn-primary"><i class="feather icon-plus mr-2"></i>Add Community</a>
                        
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
                                 @if (isset($communities) && count($communities) > 0)
                                    <table id="usertable" class="table table-center mb-0 ">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Image</th>
                                                <th>Name</th>
                                                <th>District</th>
                                                
                                                
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           
                                            @php $i=1;@endphp
                                            @foreach($communities as $community)
                                            <tr>
                                                <td>{{$i}}</td>
                                                <td><img style="width:100px;height:100px" src="{{asset('locations')}}/{{$community->image}}"></td>
                                                <td>{{$community->name}}</td>
                                                <th>{{$community->district}}</th>
                                                <th>
                                                    <a class="text-primary" title="Edit" href="{{url('admin/edit-community')}}/{{$community->id}}"><i class="fa fa-edit"></i></a>&nbsp;&nbsp; 
                                                    <a class="text-danger" title="Delete" href="{{url('admin/delete-community')}}/{{$community->id}}" onclick="javascript:return confirm('Do you want to delete this community ?');"><i class="fa fa-trash"></i></a></th>
                                            </tr>
                                             @php $i++;@endphp
                                            @endforeach
                                        </tbody>
                                    </table>
                            @else
                            <h2 class="text-center">No Communities Found</h2>
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