@include('include/header')
<div class="pcoded-main-container">
    <div class="pcoded-content container">
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-6 d-flex align-items-center mb-4">
                        <h1 class="d-inline-block font-weight-normal mb-0">All Questions</h1>
                    </div>
                    <div class="col-sm-6 d-block d-sm-flex align-items-center justify-content-end mb-4 text-right">
                        <a href="{{url('admin/add-to-category')}}" type="button" class="btn d-block ml-auto btn-primary"><i class="feather icon-plus mr-2"></i>Add To Category</a>
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
                                @if (count($questions) > 0)
                                    <table id="usertable" class="table table-center mb-0 ">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Question</th>
                                                <th>Type</th>
                                                <th>Options</th>
                                                <th>Action</th>
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
                                            @foreach($questions as $tests)
                                            <tr>
                                                <td>{{$tests->id}}</td>
                                                <td>{{$tests->title}}</td>
                                                <td>{{ucfirst($tests->type)}}</td>
                                                <td>
                                                    @php
                                                     if(isset($tests->field_data->options)):
                                                      $jsonData = json_decode($tests->field_data->options);
                                                      echo implode(', ',$jsonData);
                                                     endif;
                                                    @endphp
                                                </td>
                                                <td>
                                                    @php $status = ($tests->status==1)?0:1 @endphp
                                                    <a title="<?php echo $status==1?'Disable':'Enable'; ?>" class="<?php echo $status==1?'text-danger':'text-primary'; ?>" href="{{url('admin/status-question')}}/{{$tests->id}}/{{$status}}">
                                                    <?php echo ($status==0)?'<i class="fa fa-thumbs-up"></i>':'<i class="fa fa-thumbs-down"></i>'; ?>
                                                    </a>&nbsp;
                                                    <a class="text-primary" title="Edit" href="{{ url('admin/edit-to-category/'.$tests->id) }}"><i class="fa fa-edit"></i></a>&nbsp;
                                                    <form class="hide" style="float: left;width: 30%;" action="{{ url('admin/delete_question/'.$tests->id) }}" method="POST">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                                                    <button type="submit" class="text-danger" title="Delete" style="background: none;border:none;padding: 0;">
                                                    <i class="fa fa-trash"></i>
                                                    </button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                            @else
                            <h2 class="text-center">No Data Found</h2>
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