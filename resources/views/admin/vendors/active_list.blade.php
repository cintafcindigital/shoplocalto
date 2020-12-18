@include('include/header')
<div class="pcoded-main-container">
    <div class="pcoded-content container">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-header">
                    <div class="page-block">
                        <div class="row align-items-center">
                            <div class="col-md-12">
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{url('admin/')}}">Dashboard</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4 d-flex align-items-center mb-4">
                        <h1 class="d-inline-block font-weight-normal mb-0">All Active Vendors</h1>
                    </div>
                    <div class="col-sm-8 d-block d-sm-flex align-items-center justify-content-end mb-4 text-right">
                        <select name="search_category" class="form-control" style="width:80%;" onchange="getSearchData();">
                            <option value="">Search by Category</option>
                            @foreach($categories as $ct)
                                <option value="{{$ct->id}}">{{$ct->title}}</option>
                            @endforeach
                        </select>&nbsp;
                        <div class="input-group search-form" style="width:80%;">
                            <div class="input-group-prepend"><span class="input-group-text bg-transparent"><i class="feather icon-search"></i></span></div>
                            <input name="search_name" class="form-control nav-search" onchange="getSearchData();" placeholder="#Name  #Email  #City">
                        </div>&nbsp;
                        <a href="{{url('/admin/active-vendors')}}" class="btn d-block ml-auto btn-warning"><i class="fa fa-undo"></i></a>&nbsp;
                        <a href="{{url('/admin/addvendors')}}"><button type="button" class="btn d-block ml-auto btn-primary"><i class="feather icon-plus mr-2"></i>Add</button></a>
                        <div class="btn-group btn-group-toggle btn-group-link">
                            <label class="btn listView active"><input type="radio"> <i class="fas fa-list"></i></label>
                            <label class="btn gridView "><input type="radio"> <i class="fas fa-th-large"></i></label>
                        </div>
                    </div>
                </div>
                @if(session()->has('delete-success'))
                    <div class="alert alert-info alert-dismissible fade show">
                        {{ session()->get('delete-success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="row listViewDiv">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body" style="padding: 0px 5px;">
                                <div class="table-responsive" style="overflow-x:unset;">
                                    <table id="usertable" class="table table-center mb-0">
                                        <thead>
                                            <tr>
                                                <th style="border-top:none;">Vendor Name</th>
                                                <th style="border-top:none;">Category</th>
                                                <th style="border-top:none;">No. of Cities</th>
                                                <th style="border-top:none;">Vendor Since</th>
                                                <th style="border-top:none;">Paid/Listing</th>
                                                <!-- <th style="border-top:none;">Couples</th> -->
                                                <th style="border-top:none;"></th>
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
                                                        @elseif(isset($cat->image_data) && count($cat->image_data) > 0)
                                                        <!-- {{print_r($cat->image_data)}} -->
                                                            <img src="{{url('/public/vendors/VENDOR_').$cat->vendor_id}}/{{$cat->image_data[0]->image}}" alt="Vendor Image" class="img-fluid avtar avtar-s">
                                                        @else
                                                            <img src="{{url('/').'/public/storage/no-image.png'}}" alt="Vendor Image" class="img-fluid avtar avtar-s">
                                                        @endif
                                                        <div class="media-body ml-3 align-self-center">
                                                            <h5 class="mb-1">
                                                                <a href="{{url('admin/vendor-details')}}/{{$cat->vendor_id}}" class="text-dark">{{$cat->company_data->business_name}}</a>
                                                                <!-- {{$cat->username}}
                                                                @php $today = strtotime(date('Y-m-d')); @endphp
                                                                @if($today == strtotime(date('Y-m-d',strtotime($cat->created_at))))
                                                                    <small class="label pull-right bg-red">New</small>
                                                                @endif -->
                                                            </h5>
                                                            <p class="mb-0"> <a href="mailto:{{$cat->email}}" class="text-secondary">{{$cat->email}}</a></p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>{{isset($cat->category_data->title) ? $cat->category_data->title : (isset($cat->categories)?$cat->categories:'')}}</td>
                                                <td>{{isset($cat->company_data) && is_array($cat->company_data) ? count($cat->company_data) : '0'}}</td><!-- Cities Count -->
                                                <td><?php echo time_elapsed_string($cat->created_at); ?></td>
                                                <td><?php $listing = $listCheck = '';
                                                        if($cat->freelisting == 'No') {
                                                            echo $listing = 'Paid Listed'; $listCheck = 'checked';
                                                        } else {
                                                            echo $listing = 'Freelisting';
                                                        } ?>
                                                </td>
                                                <!-- <td>{{str_pad(count($cat->noOfCouples), 2, '0', STR_PAD_LEFT)}}</td> --><!-- Couples --> 
                                                <td class="text-right">
                                                    <div class="btn-group card-option">
                                                        <a href="{{url('admin/vendor-details')}}/{{$cat->vendor_id}}"><i class="fa fa-eye text-success btn shadow-none"></i></a>
                                                        <a href="{{url('admin/vendor-details/del')}}/{{$cat->vendor_id}}"><i class="fa fa-trash text-success btn shadow-none"></i></a>
                                                        <button type="button" class="btn shadow-none px-0 dropdown-toggle no-arrow" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="feather icon-more-horizontal"></i></button>
                                                        <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">
                                                            <li class="dropdown-item reload-card <?php if($cat->status== 1){echo 'active';} ?>" onclick="javascript:window.location.href='{{url('admin/status-vendor')}}/{{$cat->vendor_id}}/1';"><a href="{{url('admin/status-vendor')}}/{{$cat->vendor_id}}/1"><i class="feather icon-refresh-cw"></i> Active</a></li>
                                                            <li class="dropdown-item reload-card <?php if($cat->status== 0){echo 'active';} ?>" onclick="javascript:window.location.href='{{url('admin/status-vendor')}}/{{$cat->vendor_id}}/0';"><a href="{{url('admin/status-vendor')}}/{{$cat->vendor_id}}/0"><i class="feather icon-trash"></i> Inactive</a></li>
                                                        </ul>
                                                    </div><br/>
                                                    <div class="custom-control custom-switch custom-control-inline" style="margin-right:-10px;">
                                                        <input type="hidden" id="list_status{{$cat->vendor_id}}" value="{{$listing}}">
                                                        <input type="checkbox" class="custom-control-input input-success" id="list_input{{$cat->vendor_id}}" {{$listCheck}} onchange="changeListing('{{$cat->vendor_id}}');">
                                                        <label class="custom-control-label" id="list_label{{$cat->vendor_id}}" for="list_input{{$cat->vendor_id}}">{{$listing}}</label>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    @if($vendors->total() > 20) <hr>
                                    <div class="pagination-holder">
                                        <div class="row">
                                            @if(isset($vendors) && !empty($vendors))
                                            <div class="col-xs-12 col-sm-9 text-left">
                                                {{$vendors->appends(Illuminate\Support\Facades\Input::except('page'))->links()}}
                                            </div>
                                            <div class="col-xs-12 col-sm-3">
                                                <div class="result-counter mt-2">
                                                    Showing <span>{{ $vendors->currentPage() }}-{{ $vendors->lastPage() }}</span> of <span>{{ $vendors->total() }}</span> results
                                                </div><!-- /.result-counter -->
                                            </div>
                                            @endif
                                        </div><!-- /.row -->
                                    </div><!-- /.pagination-holder -->
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row gridViewDiv" style="display:none;">
                    @foreach($vendors as $cat)
                    <div class="col-xl-4 col-md-6">
                        <div class="card">
                            <div class="card-header pb-0">
                                <div class="card-header-right">
                                    <div class="btn-group card-option">
                                        <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="feather icon-more-horizontal"></i>
                                        </button>
                                        <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">
                                            <li class="dropdown-item reload-card"><a href="javascript:;"><i class="feather icon-refresh-cw"></i> reload</a></li>
                                            <li class="dropdown-item close-card"><a href="javascript:;"><i class="feather icon-trash"></i> remove</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body text-center">
                                <div class="d-inline-flex align-items-end justify-content-end">
                                    @if(@$cat->profile)
                                        <img src="{{url('/public/vendors/VENDOR_').$cat->vendor_id.'/'.$cat->profile}}" alt="Vendor Image" class="img-fluid avtar avtar-xl">
                                    @else
                                        <img src="{{url('/').'/public/storage/no-image.png'}}" alt="Vendor Image" class="img-fluid avtar avtar-xl">
                                    @endif
                                </div>
                                <h5 class="mt-4"><a href="{{url('admin/vendor-details')}}/{{$cat->vendor_id}}" class="text-dark">{{$cat->company_data->business_name}}</a></h5>
                                <p><a href="mailto:{{$cat->email}}" style="color:#7e8595;">{{$cat->email}}</a></p>
                                <div class="btn-group">
                                    <!--<button type="button" class="btn btn-outline-dark rounded border mr-3">Send Message</button>-->
                                    <a href="{{url('admin/vendor-details')}}/{{$cat->vendor_id}}" class="btn btn-outline-dark rounded border">View Vendor</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @if($vendors->total() > 20)
                    <div class="col-xl-12 col-md-12">
                        <div class="pagination-holder">
                            <div class="row">
                                @if(isset($vendors) && !empty($vendors))
                                <div class="col-xs-12 col-sm-9 text-left">
                                    {{$vendors->appends(Illuminate\Support\Facades\Input::except('page'))->links()}}
                                </div>
                                <div class="col-xs-12 col-sm-3">
                                    <div class="result-counter mt-2">
                                        Showing <span>{{ $vendors->currentPage() }}-{{ $vendors->lastPage() }}</span> of <span>{{ $vendors->total() }}</span> results
                                    </div><!-- /.result-counter -->
                                </div>
                                @endif
                            </div><!-- /.row -->
                        </div><!-- /.pagination-holder -->
                    </div>
                    @endif
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
    // $('#usertable').DataTable();
    $(document).ready(function() {
        $('.listView').on('click', function() {
            $(this).addClass('active');
            $('.gridView').removeClass('active');
            $('.gridViewDiv').css('display','none');
            $('.listViewDiv').css('display','');
        });
        $('.gridView').on('click', function() {
            $(this).addClass('active');
            $('.listView').removeClass('active');
            $('.listViewDiv').css('display','none');
            $('.gridViewDiv').css('display','');
        });
        $('.page-link').on('click', function() {
            if (history.pushState) {
                var name = $('input[name=search_name]').val();
                var category = $('select[name=search_category]').val();
                if(name != '') {
                    var newurl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?name='+name+'&page=1';
                } else if(category != '') {
                    var newurl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?category='+category+'&page=1';
                }
                window.history.pushState({path:newurl},'',newurl);
            }
        });
    });
    function getSearchData() {
        var name = $('input[name=search_name]').val();
        var category = $('select[name=search_category]').val();
        if(name != '') {
            window.location.href = "{{url('admin/active-vendors')}}?name="+name+"&page=1";
        } else if(category != '') {
            window.location.href = "{{url('admin/active-vendors')}}?category="+category+"&page=1";
        }
    }
    function changeListing(id) {
        if(id) {
            var list_status = $('#list_status'+id).val();
            $.ajax({
                url: "{{url('admin/change-listing-status')}}/"+id+'/'+list_status,
                type: 'get',
                success: function(data){
                    console.log(data);
                    $('#list_status'+id).val(data);
                    $('#list_label'+id).html(data);
                }
            });
        }
    }
</script>
</body>
</html>