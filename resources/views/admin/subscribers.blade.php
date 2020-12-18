@include('include/header')
<div class="pcoded-main-container">
    <div class="pcoded-content container">
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-6 d-flex align-items-center mb-4">
                        <h1 class="d-inline-block font-weight-normal mb-0">All Subscribers</h1>
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
                                @if (isset($subscribers) && count($subscribers) > 0)
                                    <table id="usertable" class="table table-center mb-0 ">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Parent Menu Id</th>
                                                <th>Display Order</th>
                                                <th>Level</th>
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
                                            } 
                                            $id=1;?>
                                            @foreach($menus as $menu)
                                            <tr>
                                                <td>{{$id}}</td>
                                                <td>{{$menu->name}}</td>
                                                <td>{{$menu->link}}</td>
                                                <td>{!!isset($menu->parent_id)?$menu->parent_id:'<i>Null</i>'!!}</td>
                                                
                                                 
                                                <td>{{$menu->display_order}}</td>
                                                <td>{{$menu->level}}</td>      
                                                <td>                                           
                                                   @php $status = ($menu->status==1)?0:1 @endphp
                                                    
                                                    <a class="text-primary" title="Edit" href="{{url('admin/edit-menu')}}/{{$menu->id}}"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
                                                    @if($menu->parent_id != null || ($menu->children->count()==0))
                                                    <a class="text-danger" title="Delete" href="{{url('admin/delete-menu')}}/{{$menu->id}}" onclick="javascript:return confirm('Do you want to delete this menu ?');"><i class="fa fa-trash"></i></a>
                                                    @endif
                                                </td>
                                            </tr>
                                            @php
                                            $id++;
                                            @endphp
                                            @endforeach
                                        </tbody>
                                    </table>
                            @else
                            <h2 class="text-center">No Subscribers Found</h2>
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