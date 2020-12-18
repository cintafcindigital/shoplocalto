@include('include/header')
<div class="pcoded-main-container">
    <div class="pcoded-content container">
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-6 d-flex align-items-center mb-4">
                        <h1 class="d-inline-block font-weight-normal mb-0">All Pages</h1>
                    </div>
                    <div class="col-sm-6 d-block d-sm-flex align-items-center justify-content-end mb-4 text-right">
                        <a href="{{url('admin/add-page')}}" type="button" class="btn d-block ml-auto btn-primary"><i class="feather icon-plus mr-2"></i>Add Pages</a>
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
                                @if (count($pages) > 0)
                                    <table id="usertable" class="table table-center mb-0 ">
                                        <thead>
                                            <tr>
                                                <th>Page Id</th>
                                                <th>Page Title</th>
                                                <th>Meta Title</th>
                                                <th>Meta Keyword</th>
                                                <th>Meta Description</th>
                                                <th>Banner</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($pages as $page) 
                                            <tr>
                                                <td>{{$page->id}}</td>
                                                <td>{{$page->title}}</td>
                                                <td>{{$page->meta_title}}</td>
                                                <td>{{$page->meta_keyword}}</td>
                                                <td>{{$page->meta_description}}</td>
                                                <td>
                                                    @if(isset($page->image) && $page->image !='')
                                                        <img width="120" src="{{url('public/sliders')}}/{{ $page->image }}">
                                                    @else
                                                        <i>No Image</i>
                                                    @endif
                                                </td>                                                
                                                <td>
                                                <a class="text-primary" title="Edit" href="{{url('admin/edit-page')}}/{{ $page->id }}"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
                                                <a class="text-danger" title="Delete" href="{{url('admin/delete-page')}}/{{ $page->id }}" onclick="javascript:return confirm('Do you really want to delete this page data ?')"><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                            @else
                            <h2 class="text-center">No Pages Found</h2>
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