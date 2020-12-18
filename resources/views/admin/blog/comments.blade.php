<?php

// var_dump($comments);

// die();

?>

@include('include/header')

<div class="pcoded-main-container">

    <div class="pcoded-content container">

        <div class="row">

            <div class="col-sm-12">

                <div class="row">

                    <div class="col-sm-6 d-flex align-items-center mb-4">

                        <h1 class="d-inline-block font-weight-normal mb-0">Comments</h1>

                    </div>

                    <div class="col-sm-6 d-block d-sm-flex align-items-center justify-content-end mb-4 text-right">

                        

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

                                @if (isset($comments) && count($comments) > 0)

                                    <table id="usertable" class="table table-center mb-0 ">

                                        <thead>

                                            <tr>

                                                <th>Name</th>

                                                <th>Comment</th>

                                                <th>E-mail</th>

                                                <th>Vendor</th>

                                                <th>Article</th>

                                                <th>Time</th>

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

                                            @foreach($comments as $comment)

                                            <tr>

                                                <td>{{$comment->name}}</td>

                                                <td>{{$comment->body}}</td>

                                                <td>{{$comment->email}}</td>

                                                <td>

                                                    @if(isset($comment->vendor->username))

                                                    <a href="{{url('admin/edit-vendor/'.$comment->vendor->vendor_id)}}">{{$comment->vendor->username}}</a>

                                                    @else

                                                    No Vendor

                                                    @endif

                                                    

                                                </td>

                                                <td><a href="{{url('community-post/'.(isset($comment->blog->slug)?$comment->blog->slug:''))}}" target="_blank">{{isset($comment->blog->name)?$comment->blog->name:''}}</a></td>

                                                <td><?= time_elapsed_string($comment->created_at); ?></td>

                                                <td>

                                                   @php $status = ($comment->approved==1)?0:1 @endphp

                                                  

                                                    <a title="<?php echo $status==1?'Disable':'Enable'; ?>" class="<?php echo $status==1?'text-danger':'text-success'; ?>" onclick="javascript:return confirm('Do you want to {{$status == 1 ? 'approve' : 'disapprove'}} this comment ?');" href="{{url('admin/comment-approve')}}/{{$comment->id}}/{{$status}}">

                                                    <?php echo ($status==0)?'<i class="fa fa-thumbs-up"></i>':'<i class="fa fa-thumbs-down"></i>'; ?>

                                                    </a>

                                                    <!-- endif -->

                                                    &nbsp;&nbsp; 

                                                    

                                                    <a class="text-danger" title="Edit" href="{{url('admin/delete-comment')}}/{{$comment->id}}" onclick="javascript:return confirm('Do you want to delete this comment ?');"><i class="fa fa-trash"></i></a>

                                                </td>

                                            </tr>

                                            @endforeach

                                        </tbody>

                                    </table>

                            @else

                            <h2 class="text-center">No Comments Found !!</h2>

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