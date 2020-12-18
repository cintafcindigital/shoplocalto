@include('include/header')
<div class="pcoded-main-container">
    <div class="pcoded-content container">
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-4 d-flex align-items-center mb-4">
                        <h1 class="d-inline-block font-weight-normal mb-0">Vendors Report</h1>
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
                        <a href="{{url('/admin/vendors-report')}}" class="btn d-block ml-auto btn-warning"><i class="fa fa-undo"></i></a>
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
                                                <th>Vendor Name</th>
                                                <th>Category</th>
                                               
                                                <th>Paid/Listing</th>
                                                <th>Vendor Since</th>
                                               
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
                                            
                                            @foreach($vendors as $cat)
                                            <tr>
                                                <td>
                                                    <div class="media">
                                                        @if(@$cat->profile)
                                                            <img src="{{url('/public/vendors/VENDOR_').$cat->vendor_id}}/{{$cat->profile}}" alt="Vendor Image" class="img-fluid avtar avtar-s">
                                                        @else
                                                            <img src="{{url('/').'/public/storage/no-image.png'}}" alt="Vendor Image" class="img-fluid avtar avtar-s">
                                                        @endif
                                                        <div class="media-body ml-3 align-self-center">
                                                            <h5 class="mb-1">
                                                                <a href="{{url('admin/vendor-details')}}/{{$cat->vendor_id}}" class="text-dark">{{$cat->company_data->business_name}}</a>
                                                            </h5>
                                                            <p class="mb-0"><a href="mailto:{{$cat->email}}" class="text-secondary">{{$cat->email}}</a></p>
                                                        </div>
                                                    </div>
                                                </td>
                                                @foreach($cate as $c)
                                                @if($c->vendor_id==$cat->vendor_id)
                                                <td>
                                                 {{$c->title}}
                                                </td>
                                                @endif
                                                @endforeach
                                                <td><?php if($cat->freelisting == 'No'){ echo 'Paid'; }else{ echo 'Freelisting'; } ?></td>
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
            window.location.href = "{{url('admin/vendors-report')}}?name="+name;
        } else if(category != '') {
            window.location.href = "{{url('admin/vendors-report')}}?category="+category;
        }
    }
</script>
</body>
</html>