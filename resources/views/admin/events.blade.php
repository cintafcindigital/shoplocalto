@include('include/header')
<div class="pcoded-main-container">
    <div class="pcoded-content container">
        <div class="row">
            <div class="col-sm-12">
                <div class="row border-bottom mb-3">
                    <div class="col-sm-6 d-flex align-items-center mb-4">
                        <h1 class="d-inline-block font-weight-normal mb-0">Events</h1>
                    </div>
                </div>
                @if(session()->has('success'))
                    <div class="alert alert-info alert-dismissible fade show">{{ session()->get('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                 @if(session()->has('error'))
                    <div class="alert alert-danger alert-dismissible fade show">{{ session()->get('error') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                
                <div class="row">
                   
                    @if(count($events) > 0)
                        <div class="col-md-12 col-xl-12">
                            <div class="panel panel-default">
                                <div class="panel-heading my-3">
                                    <h2 class="d-inline-block font-weight-normal mb-0">All Banners</h2>
                                </div>
                                <div class="panel-body">
                                    <table class="table table-striped task-table">
                                        <thead>
                                            <th>Name</th>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Image</th>
                                            <th>Action</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($banners as $banner)
                                            <tr>
                                                <td>{{$banner->name}}</td>
                                                <td>{{$banner->title}}</td>
                                                <td>{{$banner->description}}</td>
                                                <td><img style="width:100px;height:100px" src="{{asset('banners')}}/{{$banner->image}}"></td>
                                                
                                                <th>
                                                    <a class="text-primary" title="Edit" href="{{url('admin/edit-banner')}}/{{$banner->id}}"><i class="fa fa-edit"></i></a>&nbsp;&nbsp; 
                                                    <a class="text-danger" title="Delete" href="{{url('admin/delete-banner')}}/{{$banner->id}}" onclick="javascript:return confirm('Do you want to delete this Banner ?');"><i class="fa fa-trash"></i></a></th>
                                            </tr>

                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @else
                    <div class="col-md-12 col-xl-12">
                   <h2><center>Sorry No Events Availiable</center></h2>
               </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{url('/assets/js/plugins/bootstrap.min.js')}}"></script>
<script src="{{url('/assets/js/pcoded.min.js')}}"></script>
<script src="{{url('/assets/js/menu-setting.js')}}"></script>
<script src="{{url('/assets/js/plugins/select2.full.min.js')}}"></script>
<script src="{{url('/assets/js/plugins/jquery.dataTables.min.js')}}"></script>
<script src="{{url('/assets/js/plugins/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{url('/assets/js/plugins/jquery.dataTables.min.js')}}"></script>
<script src="{{url('/assets/js/plugins/dataTables.bootstrap4.min.js')}}"></script>
</body>
</html>