@include('include/header')
<div class="pcoded-main-container">
    <div class="pcoded-content container">
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-4 d-flex align-items-center mb-4">
                        <h1 class="d-inline-block font-weight-normal mb-0">Couples Report</h1>
                    </div>
                    <div class="col-sm-8 d-block d-sm-flex align-items-center justify-content-end mb-4 text-right">
                        <select name="search_category" class="form-control" onchange="getSearchData();">
                            <option value="">Select Report Type</option>
                            <option value="monthly">Monthly Report</option>
                            <option value="weekly">Weekly Report</option>
                            <option value="today">Today's Report</option>
                        </select>&nbsp;
                        <div class="input-group search-form" style="width:80%;">
                            <div class="input-group-prepend"><span class="input-group-text bg-transparent"><i class="feather icon-search"></i></span></div>
                            <input name="search_name" class="form-control nav-search" onchange="getSearchData();" placeholder="#Name  #Email">
                        </div>&nbsp;
                        <a href="{{url('/admin/couples-report')}}" class="btn d-block ml-auto btn-warning"><i class="fa fa-undo"></i></a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="usertable" class="table table-center mb-0 ">
                                        <thead>
                                            <tr>
                                                <th>Couples Name</th>
                                                <th>Phone</th>
                                                <th>Wedding Date</th>
                                                <th>Address</th>
                                                <th>Connected Vendors</th>
                                                <th>Couple Since</th>
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
                                            @foreach($users as $cat)
                                            <tr>
                                                <td>
                                                    <div class="media">
                                                        @if(@$cat->profile_image)
                                                            <img src="{{url('/public/storage/').'/USER_'.$cat->id.'/'.$cat->profile_image}}" alt="Couple Image" class="img-fluid avtar avtar-s">
                                                        @else
                                                            <img src="{{url('/').'/public/storage/no-image.png'}}" alt="Couple Image" class="img-fluid avtar avtar-s">
                                                        @endif
                                                        <div class="media-body ml-3 align-self-center">
                                                            <h5 class="mb-1"><a class="text-dark" href="{{url('admin/user-details')}}/{{$cat->id}}">{{$cat->name}}</a><small> ( {{ucfirst($cat->event_role)}} )</small></h5>
                                                            <p class="mb-0">{{$cat->email}}</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>{{$cat->phone}}</td>
                                                <td>{!!date('j<\s\up>S</\s\up> M, Y',strtotime($cat->event_date))!!}</td>
                                                <td>{{$cat->address.', '.$cat->country}}</td>
                                                <td>{{str_pad((count($cat->noOfBookedVendors)+ count($cat->noOfAddedVendors)), 2, '0', STR_PAD_LEFT)}}</td>
                                                <td><?php echo time_elapsed_string($cat->created_at); ?></td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
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
<script>
    $('#usertable').DataTable();
    function getSearchData() {
        var name = $('input[name=search_name]').val();
        var category = $('select[name=search_category]').val();
        if(name != '') {
            window.location.href = "{{url('admin/couples-report')}}?name="+name;
        } else if(category != '') {
            window.location.href = "{{url('admin/couples-report')}}?category="+category;
        }
    }
</script>
</body>
</html>