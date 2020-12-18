@include('include/header');
<div class="pcoded-main-container">
    <div class="pcoded-content container">
        <form class="navbar-form navbar-left" role="search" method="get" action="{{url('admin/vendors')}}">
            <div class="col-sm-6 input-group mb-3">
                <input type="text" name="search" class="form-control" placeholder="Search" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-outline-secondary"><i class="fa fa-search"></i></button>
                    <a class="btn btn-outline-secondary" href="{{url('admin/community')}}"><i class="fas fa-redo-alt"></i></a>
                </div>
            </div>
        </form>
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="clearfix border-bottom mb-3">
                        <div class="float-left"><h1 class="d-inline-block font-weight-normal text-body mb-3">All Pending Community Group</h1></div>
                        <div class="float-right"><a href="{{url('admin/add-group-community')}}"><i class="fa fa-plus"></i>&nbsp; Add Community Group</a></div>
                    </div>
                    
                    <div class="table-responsive">
                        @if(session()->has('success'))
                            <div class="alert alert-info">{{ session()->get('success') }}</div>
                        @endif
                        @if (count($community) > 0)
                        <table id="tasktable" class="table table-hover table-center mb-0 ">
                            <thead>
                                <tr>
                                  <th class="border-top-0">Group Id</th>
                                  <th class="border-top-0">Group Title</th>
                                  <th class="border-top-0">Meta Title</th>
                                  <th class="border-top-0">Meta Keyword</th>
                                  <th class="border-top-0">Meta Description</th>
                                  <th class="border-top-0">Banner</th>
                                  <th class="border-top-0">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($community as $group)  
                                <tr>
                                    <td width="7%">{{$group->id}}</td>
                                    <td>{{$group->group_title}}</td>
                                    <td width="20%">{{$group->meta_title}}</td>
                                    <td width="20%">{{$group->meta_keyword}}</td>
                                    <td width="20%">{{$group->meta_description}}</td>
                                    <td>
                                    @if(isset($group->thumb_image) && $group->thumb_image !='')
                                    <img width="120" src="{{url('public/community_images')}}/{{ $group->thumb_image }}">
                                    @else
                                    <i>No Image</i>
                                    @endif
                                    </td>
                                    <td width="10%" class="text-center">
                                    <a class="text-primary" title="Edit" href="{{url('admin/edit-group-community')}}/{{ $group->id }}"><i class="fa fa-edit"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                        <h2 class="text-center">No Pending Community Group Found</h2>
                        @endif
                    </div>
                <div class="box-footer clearfix">  </div>  
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{url('assets/js/plugins/bootstrap.min.js')}}"></script>
<script src="{{url('assets/js/pcoded.min.js')}}"></script>
<script src="{{url('assets/js/plugins/apexcharts.min.js')}}"></script>
<script src="{{url('assets/js/plugins/moment.min.js')}}"></script>
<script src="{{url('assets/js/plugins/daterangepicker.js')}}"></script>
</body>
</html>
<?php /***
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <form class="navbar-form navbar-left" role="search" method="get" action="{{url('admin/vendors')}}">
                        <div class="form-group">
                            <input type="text" class="form-control" name="search" placeholder="Search">
                        </div>
                        <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                        <a class="btn btn-default" href="{{url('admin/vendors')}}"><i class="fa fa-refresh"></i></a>
                    </form>
                </div><!-- /.box-header -->
                <div class="box-body">
                    @if(session()->has('success'))
                        <div class="alert alert-info">
                            {{ session()->get('success') }}
                        </div>
                    @endif
                    @if (isset($vendors) && count($vendors) > 0)
                        <table id="example" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Username</th>
                                    <th>Business Name</th>
                                    <th>T.Phone /<br>Mobile</th>
                                    <!-- <th>Mobile</th> -->
                                    <th>Email Id</th>
                                    <th>Rating</th>
                                    <th>Wedding-Idea</th>
                                    <th>Enquiry</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($vendors as $cat)
                                    <tr>
                                        <td width="4%">{{$cat->vendor_id}}</td>
                                        <td width="11%">{{$cat->username}}
                                            @php
                                                $today = strtotime(date('Y-m-d'));
                                            @endphp
                                            @if($today == strtotime(date('Y-m-d',strtotime($cat->created_at))))
                                                <small class="label pull-right bg-red">New</small>
                                            @endif
                                        </td>
                                        <td width="12%">
                                            <a href="{{url('admin/vendor-details')}}/{{$cat->vendor_id}}">{{$cat->company_data->business_name}}</a>
                                        </td>
                                        <td width="10%">{{$cat->telephone}} /<br>{!!($cat->mobile!=null)?$cat->mobile:'<i>Null</i>'!!}</td>
                                        <!-- <td width="10%">{!!($cat->mobile!=null)?$cat->mobile:'<i>Null</i>'!!}</td> -->
                                        <td width="11%" style="word-wrap:break-word;word-break:break-all;">{{$cat->email}}</td>
                                        <td width="11%"><div class="readOnly" data-score="{{$cat->avg_rating}}"></div></td>
                                        <td width="8%">
                                            @php $weddingidea_per = ($cat->weddingidea_permission==1)?0:1 @endphp
                                            <a style="float: left;margin-right:5px;" title="<?php echo $weddingidea_per==1?'Disable':'Enable'; ?>" class="btn <?php echo $weddingidea_per==1?'btn-danger':'btn-primary'; ?>" href="{{url('admin/weddingidea-permission')}}/{{$cat->vendor_id}}/{{$weddingidea_per}}">
                                                <?php echo ($weddingidea_per==0)?'<i class="fa fa-eye"></i>':'<i class="fa fa-eye-slash"></i>'; ?>
                                            </a>
                                        </td>
                                        <td width="5%">
                                            @php
                                                $searchKey = array_search($cat->company_data->id, array_column($enCount, 'company_id'));
                                                if($searchKey) {
                                                    echo '<button type="button" class="btn bg-green btn-flat margin" style="margin-top: 0px;">'.$enCount[$searchKey]['enCount'].'</button>';
                                                } else {
                                                    echo'<button type="button" class="btn bg-orange btn-flat margin" style="margin-top: 0px;">0</button>';
                                                }
                                            @endphp
                                        </td>
                                        <td width="10%">
                                            <!-- <a class="btn btn-primary" title="Edit" href="{{url('admin/edit-vendor')}}/{{$cat->vendor_id}}"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp; -->
                                            <a class="btn btn-success" title="Details" href="{{url('admin/vendor-details')}}/{{$cat->vendor_id}}"><i class="fa fa-eye"></i></a>
                                            @php $status = ($cat->status==1)?0:1 @endphp
                                            <a style="float: left;margin-right:5px;" title="<?php echo $status==1?'Disable':'Enable'; ?>" class="btn <?php echo $status==1?'btn-danger':'btn-primary'; ?>" href="{{url('admin/status-vendor')}}/{{$cat->vendor_id}}/{{$status}}">
                                                <?php echo ($status==0)?'<i class="fa fa-thumbs-up"></i>':'<i class="fa fa-thumbs-down"></i>'; ?>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <h2 class="text-center">No Vendor Found</h2>
                    @endif
                </div><!-- /.box-body -->
                <div class="box-footer clearfix"></div>
            </div>
        </div>
    </div>
</section>
@endsection */ ?>