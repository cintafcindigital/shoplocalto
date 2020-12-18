@include('include/header');
<div class="pcoded-main-container">
    <div class="pcoded-content container">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h1 class="d-inline-block font-weight-normal text-body mb-0">Social Media</h1>
                    <div class="table-responsive">
                        @if(session()->has('success'))
                            <div class="alert alert-info">{{ session()->get('success') }}</div>
                        @endif
                        @if(count($data) > 0)
                        <table id="tasktable" class="table table-hover table-center mb-0 ">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Social Link</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $sdata)
                                <tr>
                                    <td width="5%">{!!$sdata->icon!!}</td>
                                    <td width="10%">{{$sdata->name}}</td>
                                    <td width="30%">{{$sdata->social_link}}</td>
                                    <td width="10%">
                                        <a title="Edit" href="{{url('admin/edit-social-settings')}}/{{$sdata->id}}"><i class="fa fa-edit"></i></a> &nbsp; &nbsp; 
                                        @php $status = ($sdata->status==1)?0:1 @endphp
                                        <a title="<?php echo $status==1?'Disable':'Enable'; ?>" style="color:<?php echo $status==1?'#ff0b37':'#00db12'; ?>" href="{{url('admin/status-social-settings')}}/{{$sdata->id}}/{{$status}}">
                                            <?php echo ($status==0)?'<i class="fa fa-thumbs-up"></i>':'<i class="fa fa-thumbs-down"></i>'; ?>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @endif
                    </div>
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