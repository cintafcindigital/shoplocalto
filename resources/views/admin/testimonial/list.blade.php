@include('include/header')
<div class="pcoded-main-container">
    <div class="pcoded-content container">
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-6 d-flex align-items-center mb-4">
                        <h1 class="d-inline-block font-weight-normal mb-0">All Testimonials</h1>
                    </div>
                    <div class="col-sm-6 d-block d-sm-flex align-items-center justify-content-end mb-4 text-right">
                        <a href="{{url('admin/admin-add-testimonials')}}" type="button" class="btn d-block ml-auto btn-primary"><i class="feather icon-plus mr-2"></i>Add Testimonial</a>
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
                                @if (count($testimonials) > 0)
                                    <table id="usertable" class="table table-center mb-0 ">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Name</th>
                                                <th>Image</th>
                                                <th>Description</th>
                                                <th>Added By</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($testimonials as $tests)
                                            <tr>
                                                <td>{{$tests->id}}</td>
                                                <td>{{$tests->name}}</td>
                                                <td><img width="120" src="{{url('public/testimonials')}}/{{ $tests->image }}"></td>
                                                <td>{!!$tests->description!!}</td>
                                                <td>{{$tests->added_by}}</td>
                                                <td>
                                                    <a class="text-primary" title="Edit" href="{{ url('admin/edit-testimonials/'.$tests->id) }}"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
                                                    @php $status = ($tests->status==1)?0:1 @endphp
                                                    <a title="<?php echo $status==1?'Disable':'Enable'; ?>" class="<?php echo $status==1?'text-danger':'text-primary'; ?>" href="{{url('admin/status-testimonial')}}/{{$tests->id}}/{{$status}}">
                                                    <?php echo ($status==0)?'<i class="fa fa-thumbs-up"></i>':'<i class="fa fa-thumbs-down"></i>'; ?>
                                                    </a>&nbsp;
                                                    <form style="float: right;width: 18px;" action="{{ url('admin/delete_testimonial/'.$tests->id) }}" method="POST">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                                                        <button type="submit" class="btn btn-danger p-0 text-danger" title="Delete" style="border: none;background: none;">
                                                            <i class="fa fa-btn fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>                                                
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                            @else
                            <h2 class="text-center">No Testimonial Found</h2>
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