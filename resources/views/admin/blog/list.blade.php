@include('include/header')
<div class="pcoded-main-container">
    <div class="pcoded-content container">
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-6 d-flex align-items-center mb-4">
                        <h1 class="d-inline-block font-weight-normal mb-0">{{Request::is('admin/community')?'Community Posts':'All Blogs'}}</h1>
                    </div>
                    <div class="col-sm-6 d-block d-sm-flex align-items-center justify-content-end mb-4 text-right">
                        @if(Request::is('admin/blog'))
                        <a href="{{url('admin/add-blog')}}" type="button" class="btn d-block ml-auto btn-primary"><i class="feather icon-plus mr-2"></i>Add Blog</a>
                        @endif
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
                <div class="row listViewDiv">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                @if (isset($blogs) && count($blogs) > 0)
                                    <table id="usertable" class="table table-center mb-0 ">
                                        <thead>
                                            <tr>
                                                <th>Name or title</th>
                                                <th>Categoy</th>
                                                @if(Request::is('admin/community') || Request::is('admin/community/active') || Request::is('admin/community/pending'))
                                                <th>Vendor</th>
                                                @endif
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
                                                $string = array('y' => 'year', 'm'=>'month', 'w' => 'week', 'd' => 'day', 'h'=>'hour', 'i' => 'minute', 's' => 'second');
                                                foreach($string as $k => &$v) {
                                                    if($diff->$k) {
                                                        $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
                                                    } else {
                                                        unset($string[$k]);
                                                    }
                                                }
                                                if (!$full) $string = array_slice($string, 0, 1);
                                                return $string ? implode(', ', $string) . ' ago' : 'just now';
                                            } 
                                            ?>
                                            @foreach($blogs as $blog)
                                            <tr>
                                                <td>@if(Request::is('admin/community') || Request::is('admin/community/active') || Request::is('admin/community/pending')) <a href="{{url('admin/view-blog/'.$blog->id)}}">{{$blog->name}}</a> @else {{$blog->name}} @endif</td>
                                                <td>{{$blog->categories->name}}</td>
                                                @if(Request::is('admin/community') || Request::is('admin/community/active') || Request::is('admin/community/pending'))
                                                <td>{{@$blog->vendor->username}}</td>
                                                @endif
                                                <td>
                                                   <!-- if($blog->vendor_id != null) -->
                                                   @if(Request::is('admin/community') || Request::is('admin/community/active') || Request::is('admin/community/pending'))
                                                    @php $status = ($blog->approved==1)?0:1; @endphp
                                                    <a title="<?php echo $status==1?'Disapprove':'Approve'; ?>" class="<?php echo $status==1?'text-danger':'text-success'; ?>" onclick="javascript:return confirm('Do you want to {{$status == 1 ? 'Approve' : 'Disapprove'}} this blog ?');" href="{{url('admin/blog-approve')}}/{{$blog->id}}/{{$status}}">
                                                    <?php echo ($status==0)?'<i class="fa fa-thumbs-up"></i>':'<i class="fa fa-thumbs-down"></i>'; ?>
                                                    </a>
                                                    <!-- endif -->
                                                    @else
                                                    @php $status = ($blog->published==1)?0:1; @endphp
                                                    <a title="<?php echo $status==1?'publish':'unpublish'; ?>" class="<?php echo $status==1?'text-danger':'text-success'; ?>" onclick="javascript:return confirm('Do you want to {{$status == 1 ? 'publish' : 'unpublish'}} this blog ?');" href="{{url('admin/blog-publish')}}/{{$blog->id}}/{{$status}}">
                                                    <?php echo ($status==0)?'<i class="fa fa-thumbs-up"></i>':'<i class="fa fa-thumbs-down"></i>'; ?>
                                                    </a>
                                                        <!--<span class="text-success"><i class="fa fa-thumbs-up"></i></span>-->
                                                    @endif
                                                    &nbsp;&nbsp; 
                                                    <a class="text-primary" title="Edit" href="{{url('admin/edit-blog')}}/{{$blog->id}}"><i class="fa fa-edit"></i></a>&nbsp;&nbsp; 
                                                    <a class="text-danger" title="Edit" href="{{url('admin/delete-blog')}}/{{$blog->id}}" onclick="javascript:return confirm('Do you want to delete this blog ?');"><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                            @else
                            <h2 class="text-center">No Articles Found !!</h2>
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