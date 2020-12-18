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
                        <h1 class="d-inline-block font-weight-normal mb-0">Our Vendors</h1>
                        <!-- <h6 class="d-inline-block mb-0 ml-4"><i class="feather icon-download"></i> Download list</h6> -->
                    </div>
                    <div class="col-sm-8 d-block d-sm-flex align-items-center justify-content-end mb-4 text-right">
                        <select name="search_category" class="form-control" style="width:80%;" onchange="getSearchData();">
                            <option value="">Search by Category</option>
                            @foreach($categories as $ct)
                                <option value="{{$ct->id}}" {{isset($_GET['category']) && $_GET['category'] == $ct->id ? 'selected' : '' }}>{{$ct->title}}</option>
                            @endforeach
                        </select>&nbsp;
                        <div class="input-group search-form" style="width:80%;">
                            <div class="input-group-prepend"><span class="input-group-text bg-transparent"><i class="feather icon-search"></i></span></div>
                            <input name="search_name" class="form-control nav-search" onchange="getSearchData();" placeholder="#Name  #Email  #City">
                        </div>&nbsp;
                        <a href="{{url('/admin/vendors')}}" class="btn d-block ml-auto btn-warning"><i class="fa fa-undo"></i></a>&nbsp;
                        <a href="{{url('/admin/addvendors')}}"><button type="button" class="btn d-block ml-auto btn-primary" ><i class="feather icon-plus mr-2"></i>Add</button></a>
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
                <div class="alert alert-warning alert-dismissible" role="alert" id="payment_msg" style="display:none;"></div>
                <div class="row listViewDiv">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body" style="padding: 0px 5px;">
                                <style>
                                    .header{
                                        cursor: pointer;
                                    }
                                    .header:after {
                                        content: "\2195";
                                        top: 2.6em;
                                        position: absolute;
                                        padding-left: 5px;
                                        cursor: pointer;
                                    }
                                    .sort-active:after {
                                        font-weight: 600;
                                        font-size: 13px;
                                        color: #000;
                                    }
                                </style>
                                <div class="table-responsive" style="/*overflow-x:unset;*/">
                                    <table id="usertable" class="usertable table table-center mb-0 ">
                                        <thead>
                                            <tr>
                                                <th><input type="checkbox" id="checkAll" /></th>
                                                <th style="border-top:none;"><span data-value="name_sort" class="header {{isset($_GET['name_sort'])?'sort-active':''}}">Vendor Name</span> <!--<i class="fa fa-sort-alpha-asc"></i><i class="fa fa-sort-alpha-desc"></i>--></th>
                                                <th style="border-top:none;"><span data-value="category_sort" class="header {{isset($_GET['category_sort'])?'sort-active':''}}">Categories</span> <!--<i class="fa fa-sort-alpha-asc"></i><i class="fa fa-sort-alpha-desc"></i>--></th>
                                                <th style="border-top:none;" class="">Featured</th>
                                                <th style="border-top:none;" class=""><span data-value="since_sort" class="header {{isset($_GET['since_sort'])?'sort-active':''}}">Vendor Since</span></th>
                                                <th style="border-top:none;"><!--<span data-value="paid_sort" class="header {{isset($_GET['paid_sort'])?'sort-active':''}}">-->Paid/Listing<!--</span>--> <!--<i class="fa fa-sort-alpha-asc"></i><i class="fa fa-sort-alpha-desc"></i>--></th>
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
                                                <td><input type="checkbox" class="check-vendors" value="{{$cat->vendor_id}}" name="check_vendors[]"/></td>
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
                                                            <p class="mb-0"><a href="mailto:{{$cat->email}}" class="text-secondary">{{$cat->email}}</a></p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <!-- <td>{{isset($cat->category_data->title)?$cat->category_data->title : ''}} {{print_r($cat->category_data)}} ctage</td> -->
                                                @php
                                                    //$categories = array_map(function($title){
                                                  //  return $title['title'];
                                                //},$cat->categories);
                                                @endphp
                                                <td>{{isset($cat->categories) ? str_replace(',',', ',$cat-> categories) : ''}}</td>
                                                <!--<td>{{isset($cat->company_data) && is_array($cat->company_data) ? count($cat->company_data) : '0'}}</td><!-- Cities Count -->
                                                <td>
                                                    <div class="custom-control custom-switch custom-control-inline" style="margin-right:-10px;">
                                                        <input type="checkbox" class="custom-control-input input-success" id="list_input_featured{{$cat->vendor_id}}" {{$cat->display_home_page?'checked':''}} onchange="changeFeatured('{{$cat->vendor_id}}');">
                                                        <label class="custom-control-label" id="list_label_featured{{$cat->vendor_id}}" for="list_input_featured{{$cat->vendor_id}}">Featured</label>
                                                    </div>
                                                </td>
                                                <td><?php echo time_elapsed_string($cat->created_at); ?></td>
                                                <td>
                                                    <?php $listing = $listCheck = '';
                                                        if($cat->freelisting == 'No') {
                                                            echo $listing = 'Paid Listed'; $listCheck = 'checked';
                                                        } else {
                                                            echo $listing = 'Freelisting';
                                                    } ?>
                                                </td>
                                                <!-- <td>{{str_pad(count($cat->noOfCouples), 2, '0', STR_PAD_LEFT)}}</td> -->
                                                <!-- Couples -->
                                                <td class="text-right">
                                                    <div class="btn-group card-option">
                                                        <a href="{{url('admin/vendor-details')}}/{{$cat->vendor_id}}"><i class="fa fa-eye text-success btn shadow-none"></i></a>
                                                        <a href="{{url('admin/vendor-details/del')}}/{{$cat->vendor_id}}" onclick="javascript:return confirm('Do you want to delete this vendor ?');"><i class="fa fa-trash text-success btn shadow-none"></i></a>
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
                                                    @if($listing == 'Paid Listed')
                                                    @else
                                                    <!-- <button class="btn btn-success btn-sm" onclick="openModalFun('{{$cat->vendor_id}}')" >Pay it</button> -->
                                                    @endif
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
                                <div class="row">
                                    <div class="col-sm-12">
                                        <form action="{{url('admin/delete-vendors')}}" method="POST" id="delete-vendor-form">
                                            @csrf
                                            @METHOD('DELETE')
                                            <button type="submit" class="btn btn-danger disabled">Delete Vendors</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row gridViewDiv" style="display:none;">
                    @foreach($vendors as $cat)
                    <div class="col-xl-4 col-md-6">
                        <div class="card">
                            @if($cat->display_home_page)
                            <span class="btn-success" style="position: absolute;right: 0;margin: 5px;padding: 0 15px;border-radius: 25px;">Featured</span>
                            @endif
                            <div class="card-header pb-0">
                                <div class="card-header-right">
                                    <div class="btn-group card-option">
                                        <!--<button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="feather icon-more-horizontal"></i>
                                        </button>-->
                                        <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">
                                            <li class="dropdown-item reload-card"><a href="javascript:;"><i class="feather icon-refresh-cw"></i> reload</a></li>
                                            <li class="dropdown-item close-card"><a href="javascript:;"><i class="feather icon-trash"></i> remove</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body text-center">
                                <div class="d-inline-flex align-items-end justify-content-end">
                                    <!--@if(@$cat->profile)
                                        <img src="{{url('/public/vendors/VENDOR_').$cat->vendor_id.'/'.$cat->profile}}" alt="Vendor Image" class="img-fluid avtar avtar-xl">
                                    @else
                                        <img src="{{url('/').'/public/storage/no-image.png'}}" alt="Vendor Image" class="img-fluid avtar avtar-xl">
                                    @endif-->
                                    @if(@$cat->profile)
                                        <img src="{{url('/public/vendors/VENDOR_').$cat->vendor_id}}/{{$cat->profile}}" alt="Vendor Image" class="img-fluid avtar avtar-xl">
                                    @elseif(isset($cat->image_data) && count($cat->image_data) > 0)
                                    <!-- {{print_r($cat->image_data)}} -->
                                        <img src="{{url('/public/vendors/VENDOR_').$cat->vendor_id}}/{{$cat->image_data[0]->image}}" alt="Vendor Image" class="img-fluid avtar avtar-xl">
                                    @else
                                        <img src="{{url('/').'/public/storage/no-image.png'}}" alt="Vendor Image" class="img-fluid avtar avtar-s">
                                    @endif
                                    <!-- <span class="avtar avtar-icon avtar-xs position-absolute bg-white mt-2 ml-2"><img src="assets/images/uikit/logo-slack.svg" alt="images" class="img-fluid"></span> -->
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
    <div class="modal fade" id="reactivateVendor" tabindex="-1" role="dialog" >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle"><i class="icon-vendor icon-vendor-card mr5"></i> Make Bill <small class="ml5 color-grey"></small></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="payment_form" class="pure-form" method="POST" action="{{url('admin/payment-to-vendor')}}">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="card-holder-name">Choose Subscription Type</label>
                    </div>
                    <div class="col-md-6">
                        <select id="subscription_id" name="subscription_id" class="form-control">
                            @foreach($subscription as $sb)
                            @if((int)$sb->amount != 0)
                            <option value="{{$sb->id}}">{{$sb->type.' - '.$sb->duration.' - $ '.$sb->amount}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="card-number">Pay Type</label>
                    </div>
                    <div class="col-md-6">
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="pay_type_full" name="pay_type" value="full" class="custom-control-input input-success" checked>
                            <label class="custom-control-label" for="pay_type_full"><b> Full Paid</b></label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="pay_type_monthly" name="pay_type" value="monthly" class="custom-control-input input-success">
                            <label class="custom-control-label" for="pay_type_monthly"><b> Monthly Paid</b></label>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="vendor_id"  id="vendor_id" value="">
                <!-- <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="card-number">Card number</label>
                        <small class="block color-grey">Numbers only</small>
                    </div>
                    <div class="col-md-6">
                        <input type="text" class="form-control" id="card_number" name="card_number" maxlength="16" autocomplete="off" placeholder="**** **** **** ****"><br/>
                        <span id="card_number_err"></span>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="card-holder-name">Cardholder name</label>
                    </div>
                    <div class="col-md-6">
                        <input type="text" class="form-control" id="cardholder_name" name="cardholder_name" autocomplete="off" placeholder="Cardholder Name">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="card-cvc">CVC</label>
                    </div>
                    <div class="col-md-6">
                        <input type="text" id="card_cvc" class="form-control" name="card_cvc" size="4" maxlength="4" autocomplete="off" placeholder="CVC">
                        <br/><span id="card_cvc_err"></span>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label >Expiration</label>
                    </div>
                    <div class="col-md-6">                        
                        <div class="row">
                            <div class="col-md-6">
                                <select id="exp_month" class="form-control" name="exp_month">
                                    @for($mn = 1; $mn < 13; $mn++)
                                    <option @if(date('m') == $mn) selected @endif>@if($mn < 10) {{'0'.$mn}} @else {{$mn}} @endif</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-md-6">
                                <select id="exp_year" class="form-control" name="exp_year">
                                    @for($yrs = date('Y'); $yrs <= date('Y')+20; $yrs++)
                                    <option value="{{$yrs}}">{{$yrs}}</option>
                                    @endfor
                                </select>
                            </div>                        
                        </div>
                    </div>
                </div> -->
                <div class="row py-3 border-top">
                    <div class="col-md-12 text-center">
                        <input class="btn btn-success" type="submit" value="Make Payment">
                    </div>
                </div>
            </form>
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
            window.location.href = "{{url()->current()}}?name="+name+"&page=1";
        } else if(category != '') {
            window.location.href = "{{url()->current()}}?category="+category+"&page=1";
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
    function openModalFun(id) {
        if(id) {
            $('#reactivateVendor').modal('show');
            $("#vendor_id").val(id);
        }
    }
    $(document).on('click','.header',function(e){
        e.preventDefault();
        var queries = ['name_sort', 'category_sort', 'paid_sort'];
        // alert($(this).attr("data-value"));
        // alert(window.location.search);
        var url = window.location.search;
        var parse = $(this).attr("data-value");
        var parseUrl = window.location.href;
        var urlValues = getUrlVars();
        var currentValue = url.match(parse);
        // alert(urlValues[parse]);return;
        var actualValue = "";
        // $.each(queries,function(index,value){
            // alert(value);
        if(url.indexOf('name_sort=asc') != -1)
            url = myReplaceMethod(url,'name_sort=asc',"");
        if(url.indexOf('name_sort=desc') != -1)
            url = myReplaceMethod(url,'name_sort=desc',"");
        if(url.indexOf('category_sort=asc') != -1)
            url = myReplaceMethod(url,'category_sort=asc',"");
        if(url.indexOf('category_sort=desc') != -1)
            url = myReplaceMethod(url,'category_sort=desc',"");
        if(url.indexOf('paid_sort=asc') != -1)
            url = myReplaceMethod(url,'paid_sort=asc',"");
        if(url.indexOf('paid_sort=desc') != -1)
            url = myReplaceMethod(url,'paid_sort=desc',"");
        if(url.indexOf('since_sort=asc') != -1)
            url = myReplaceMethod(url,'since_sort=asc',"");
        if(url.indexOf('since_sort=desc') != -1)
            url = myReplaceMethod(url,'since_sort=desc',"");
        // });
        if(url == '' || url == '?')
            parseUrl = '?'+parse+'='+(urlValues[parse] == 'asc' ? 'desc' : 'asc');
        /*else if(url == '?')
            parseUrl = url+parse+'='+(urlValues[parse] == 'desc' ? 'asc' : 'desc');*/
        else
            parseUrl = url+'&'+parse+'='+(urlValues[parse] == 'asc' ? 'desc' : 'asc');
        if(parseUrl.indexOf('?&') != -1)
            parseUrl = myReplaceMethod(parseUrl,'?&',"?");
        if(parseUrl.indexOf('&&') != -1)
            parseUrl = myReplaceMethod(parseUrl,'&&',"&");
        parseUrl = '{{url()->current()}}'+parseUrl;
        // alert(parseUrl);
        // return;
        window.location = parseUrl;
        return;
        if(url.length){
            // alert(currentValue);return;
            if(currentValue != null){
                // parseUrl.replace(currentValue+'='+urlValues[parse],"");
                // parseUrl = myReplaceMethod(parseUrl,currentValue+'='+urlValues[parse],"");
                // alert(parseUrl.split('?')[1] == '');
                if(parseUrl.split('?')[1] == '')
                    parseUrl += ''+parse+'='+(urlValues[parse] == 'desc' ? 'asc' : 'desc');
                else
                    parseUrl += ''+parse+'='+(urlValues[parse] == 'desc' ? 'asc' : 'desc');
                // alert(parseUrl);return;
            }
            else
                parseUrl += '&'+parse+'=asc';
        }
        else
            parseUrl += '?'+parse+'=asc';
        // alert(parseUrl);
        window.location.href = parseUrl;
    });
    $('.add_payment_btn').click(function(){
        var vendor_id      = $("#vendor_id").val();
        var card_number      = $("#card_number").val();
        var cardholder_name  = $("#cardholder_name").val();
        var card_cvc      = $("#card_cvc").val();
        if(card_number == '' || cardholder_name == '' || card_cvc == '') {
            $('.incorrect_info').hide();
            $('.incomplete_text').show();
            return false;
        } else {
            $("#card_cvc_err").html("");
            $('.incomplete_text').hide();
            var cardType = '';
            var visaRegEx = /^(?:4[0-9]{12}(?:[0-9]{3})?)$/;
            var mastercardRegEx = /^(?:5[1-5][0-9]{14})$/;
            var amexpRegEx = /^(?:3[47][0-9]{13})$/;
            if(visaRegEx.test(card_number) === true) { // Visa validation......
                cardType = 'Visa';
            }
            if(mastercardRegEx.test(card_number) === true) { // MasterCard validation......
                cardType = 'MasterCard';
            }
            if(amexpRegEx.test(card_number) === true) { // Amex validation......
                cardType = 'America Express';
            }
            var numRegEx = /^\d+$/;
            if(numRegEx.test(card_cvc) === false || card_cvc.length < 3) { // Only Numbers......
                cardType = '';
                $("#card_cvc").val('');
                $("#card_cvc_err").html("<i style='color:#ff4545'>Inavlid CVC Number !</i>");
                return false;
            }
            if(cardType == '') {
                $('.incorrect_info').show();
                return false;
            } else {
        alert(123);
                $.ajax({
                    url: "{{url('admin/payment-with-listing-status')}}",
                    type: 'post',
                    data: $("#payment_form").serialize()+'&cardType='+cardType,
                    success: function(response) {
                        console.log(response);
                        if(response != '') {
                            $('#reactivateVendor').modal('hide');
                            $('#payment_msg').html(response);
                            $('#payment_msg').css('display','block');
                            $('html, body').animate({
                                scrollTop: $("#payment_msg").offset().top
                            }, 2000);
                        } else {
                            $('#payment_msg').html('');
                            $('#payment_msg').css('display','none');
                        }
                    }
                });
                $('.incorrect_info').hide();
            }
        }
    });
    function getUrlVars()
    {
        var vars = [], hash;
        var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
        for(var i = 0; i < hashes.length; i++)
        {
            hash = hashes[i].split('=');
            vars.push(hash[0]);
            vars[hash[0]] = hash[1];
        }
        return vars;
    }
    function myReplaceMethod(str,find,replace_with){
        while (str.indexOf(find) !== -1 ){
            from = str.indexOf(find);
            to = from + find.length;
            str = str.substr(0,from)+replace_with+str.substr(to, str.length-to);
        }
        return str;
    }
    function changeFeatured(id){
        if(id) {
            $.ajax({
                url: "{{url('admin/change-featured-status')}}",
                type: 'post',
                data:{_token:$('meta[name="csrf-token"]').attr('content'),id:id},
                success: function(data){
                    console.log(data);
                    /*$('#list_status'+id).val(data);
                    $('#list_label'+id).html(data);*/
                    alert('Success');
                    window.location.reload();
                }
            });
        }
    }
    $(document).on('click','#checkAll',function(event){
        // alert(this.checked);
        $('.check-vendors').prop({checked:this.checked});
    });
    $(document).on('click','.check-vendors',function(event){
        // alert($('.check-vendors:checkbox:checked').length);
        // alert($('.check-vendors:checkbox').length);
        if($('.check-vendors:checkbox:checked').length == $('.check-vendors:checkbox').length)
            $('#checkAll').prop({checked:true});
        else if($('.check-vendors:checkbox:checked').length > 0)
            $('#checkAll').prop({indeterminate:true});
        if($('.check-vendors:checkbox:checked').length <= 0) {
            $('#checkAll').prop({checked:false});
            $('#checkAll').prop({indeterminate:false});
        }
    });
    $(document).on('submit','#delete-vendor-form',function(event){
        if($('.check-vendors:checkbox:checked').length <= 0){
            alert('Please select atleast one vendor to delete.');
        }else{
            if(confirm('Do you want to delete this vendor ?'))
            {
                if($('.input[name="vendors[]"]').length > 0)
                    $('.input[name="vendors[]"]').remove();
                $('.check-vendors:checkbox:checked').each(function(index,val){
                   $("#delete-vendor-form").append($("<input />").attr("type", "hidden")
                      .attr("name", "vendors[]")
                      .attr("value", this.value));
                });
            } else 
                event.preventDefault();
        }
    });
</script>
</body>
</html>