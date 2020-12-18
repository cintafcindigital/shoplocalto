@include('include/header')
<div class="pcoded-main-container">
    <div class="pcoded-content container">
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-6 d-flex align-items-center mb-4">
                        <h1 class="d-inline-block font-weight-normal mb-0">All Category</h1>
                    </div>
                    <div class="col-sm-6 d-block d-sm-flex align-items-center justify-content-end mb-4 text-right">
                        <a href="{{url('admin/add-category')}}" type="button" class="btn d-block ml-auto btn-primary"><i class="feather icon-plus mr-2"></i>Add Category</a>
                        <?php /*
                            <div class="btn-group btn-group-toggle btn-group-link">
                                <label class="btn listView active"><input type="radio"> <i class="fas fa-list"></i></label>
                                <label class="btn gridView "><input type="radio"> <i class="fas fa-th-large"></i></label>
                            </div>
                        */ ?>
                    </div>
                </div>
                @if(session()->has('success'))
                        <div class="alert alert-info">
                            {{ session()->get('success') }}
                        </div>
                @endif
                @if(session()->has('error'))
                        <div class="alert alert-danger">
                            {{ session()->get('error') }}
                        </div>
                @endif
                <div class="row listViewDiv">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                @if (isset($cats) && count($cats) > 0)
                                    <table id="usertable" class="table table-center mb-0 ">
                                        <thead>
                                            <tr>
                                                <th>Cat Id</th>
                                                <th>Title</th>
                                                <th>Slug</th>
                                                <th>Parent Category Id</th>
                                                <th>Parent</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            function time_elapsed_string($datetime, $full = false) {
                                                $now = new DateTime;
                                                $ago = new DateTime($datetime);
                                                $diff = $now->diff($ago);
                                                $diff->w = floor($diff->d / 7);
                                                $diff->d -= $diff->w * 7;
                                                $string = array('y'=>'year', 'm'=>'month', 'w'=>'week', 'd'=>'day', 'h'=>'hour', 'i'=>'minute', 's'=>'second');
                                                foreach($string as $k => &$v) {
                                                    if($diff->$k) {
                                                        $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
                                                    } else {
                                                        unset($string[$k]);
                                                    }
                                                }
                                                if (!$full) $string = array_slice($string, 0, 1);
                                                return $string ? implode(', ', $string) . ' ago' : 'just now';
                                            } ?>
                                            @foreach($cats as $cat)
                                            <tr>
                                                <td>{{$cat->id}}</td>
                                                <td>{{$cat->title}}</td>
                                                <td>{{$cat->slug}}</td>
                                                <td>{!!isset($cat->parent_id)?$cat->parent_id:'<i>Null</i>'!!}</td>
                                                <td>{!!($cat->is_parent==1)?'<label class="btn btn-success btn-sm mb-0">YES</label>':'<label class="btn btn-danger btn-sm mb-0">No</label>'!!}</td>
                                                <td>                                                  
                                                   @php $status = ($cat->status==1)?0:1 @endphp
                                                    <a title="<?php echo $status==1?'Disable':'Enable'; ?>" class="<?php echo $status==1?'text-danger':'text-success'; ?>" href="{{url('admin/status-category')}}/{{$cat->id}}/{{$status}}">
                                                    <?php echo ($status==0)?'<i class="fa fa-thumbs-up"></i>':'<i class="fa fa-thumbs-down"></i>'; ?>
                                                    </a>&nbsp;&nbsp;
                                                    <a class="text-primary" title="Edit" href="{{url('admin/edit-category')}}/{{$cat->id}}"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
                                                    <a class="text-danger" title="Delete" href="{{url('admin/delete-category')}}/{{$cat->id}}" onclick="javascript:return confirm('Do you want to delete this category ?');"><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                            @else
                            <h2 class="text-center">No Category Found</h2>
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