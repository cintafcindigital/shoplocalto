@include('include/header');
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
                                    <li class="breadcrumb-item"><a href="{{url('admin/users')}}">All Couples</a></li>
                                    <li class="breadcrumb-item"><a href="{{url('admin/user-details/'.$data['id'])}}">View Couple</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 mb-4">
                        <h1 class="d-inline-block font-weight-normal mb-0">Edit Couple Profile</h1>
                    </div>
                </div>
                @if(session()->has('success'))
                    <div class="alert alert-info">{{ session()->get('success') }}</div>
                @endif
                @if(count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>@foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <form class="form-horizontal" method="POST" action="{{url('/admin/edit_user_save')}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-6 col-xl-3">
                        <figure class="figure">
                            @if($data['profile_image'])
                                <!-- <img src="{{url('/public/user_profile/')}}/{{$data['profile_image']}}" alt="Couple Image" class="figure-img img-fluid rounded"> -->
                                <img src="{{url('/public/storage/').'/USER_'.$data['id'].'/'.$data['profile_image']}}" alt="Couple Image" class="figure-img img-fluid rounded mb-3">
                            @else
                               <img src="{{url('/').'/public/storage/no-image.png'}}" alt="Vendor Image" class="figure-img img-fluid rounded mb-3">
                            @endif
                            <figcaption class="figure-caption text-center mt-2" style="display:inline-block;width:20px;"><i class="m-r-10 f-18 feather icon-upload"></i></figcaption>
                            <input type="file" name="profile_image" style="width:218px;">
                        </figure>
                    </div>

                    <div class="col-md-12 col-xl-9">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label for="exampleInputEmail1">Name</label>
                                    <input type="text" class="form-control" name="name" value="{{$data['name']}}" autofocus>
                                    @if ($errors->has('name'))
                                        <span class="help-block"><strong>{{ $errors->first('name') }}</strong></span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label for="exampleInputEmail1">Email Address</label>
                                    <input type="text" class="form-control" name="email" value="{{$data['email']}}" autofocus readonly>
                                    @if ($errors->has('email'))
                                        <span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('address') ? ' has-error' : '' }}">
                                    <label for="exampleInputEmail1">Address</label>
                                    <input type="text" class="form-control" name="address" value="{{$data['address']}}" autofocus>
                                    @if ($errors->has('address'))
                                        <span class="help-block"><strong>{{ $errors->first('address') }}</strong></span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('phone') ? ' has-error' : '' }}">
                                    <label for="exampleInputEmail1">Phone</label>
                                    <input type="text" class="form-control" name="phone" value="{{$data['phone']}}" autofocus>
                                    @if($errors->has('phone'))
                                        <span class="help-block"><strong>{{ $errors->first('phone') }}</strong></span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group {{ $errors->has('event_date') ? ' has-error' : '' }}">
                                    <label for="exampleInputEmail1">Event Date</label>
                                    <input type="text" class="form-control" name="event_date" value="{{$data['event_date']}}" placeholder="YYYY-MM-DD">
                                    @if($errors->has('event_date'))
                                        <span class="help-block"><strong>{{ $errors->first('event_date') }}</strong></span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('phone') ? ' has-error' : '' }}">
                                    <label for="exampleInputEmail1">Event Role</label>
                                    <select class="form-control" name="event_role">
                                        <option value="bride" <?php echo ($data['event_role'] == 'bride')?'selected':''; ?>>Bride</option>
                                        <option value="groom" <?php echo ($data['event_role'] == 'groom')?'selected':''; ?>>Groom</option>
                                        <option value="other" <?php echo ($data['event_role'] == 'other')?'selected':''; ?>>Other</option>
                                    </select>
                                    @if($errors->has('event_role'))
                                        <span class="help-block"><strong>{{ $errors->first('event_role') }}</strong></span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('country') ? ' has-error' : '' }}">
                                    <label for="exampleInputEmail1">Country</label>
                                    <select class="form-control" name="country">
                                        <option value="">Country</option>
                                        @if(isset($countries) && !empty($countries))
                                            @foreach($countries as $cat)
                                                <option value="{{$cat['sortname']}}" <?php echo ($data['country'] == $cat['sortname'])?'selected':''; ?>>{{$cat['name']}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @if ($errors->has('country'))
                                        <span class="help-block"><strong>{{ $errors->first('country') }}</strong></span>
                                    @endif
                                </div>
                                <input type="hidden" name="user_id" value="{{$data['id']}}">
                                <div class="form-group text-right">
                                    <button class="btn btn-primary" type="submit">Update</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-4"></div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="{{url('/assets/js/plugins/bootstrap.min.js')}}"></script>
<script src="{{url('/assets/js/pcoded.min.js')}}"></script>
<script src="{{url('/assets/js/menu-setting.js')}}"></script>
<script src="{{url('/assets/js/plugins/select2.full.min.js')}}"></script>
<script src="{{url('/assets/js/plugins/jquery.dataTables.min.js')}}"></script>
<script src="{{url('/assets/js/plugins/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{url('/assets/js/plugins/jquery.dataTables.min.js')}}"></script>
<script src="{{url('/assets/js/plugins/dataTables.bootstrap4.min.js')}}"></script>
<script>
    $(function() {
        $(".location-mlt-select").select2();
    });
</script>
@@include('./include/footer.php')
</body>
</html>
<!-- <div class="pcoded-main-container">
    <div class="pcoded-content container">
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-12 mb-4">
                        <h1 class="d-inline-block font-weight-normal mb-0">Edit User</h1>
                        <a href="{{url('admin/users')}}" style="font-size:16px;float:right;color:#000;"><i class="fa fa-backward"></i> Back</a>
                    </div>
                    @if(session()->has('success'))
                        <div class="alert alert-info">{{ session()->get('success') }}</div>
                    @endif
                    @if(count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>@foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </div>
                <div class="row">
                    <div class="col-md-12 col-xl-12">
                        <form class="form-horizontal" method="POST" action="{{url('/admin/edit_user_save')}}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                        <label for="exampleInputEmail1">Name</label>
                                        <input type="text" class="form-control" name="name" value="{{$data['name']}}" autofocus>
                                        @if ($errors->has('name'))
                                            <span class="help-block"><strong>{{ $errors->first('name') }}</strong></span>
                                        @endif
                                    </div>
                                    <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                        <label for="exampleInputEmail1">Email Address</label>
                                        <input type="text" class="form-control" name="email" value="{{$data['email']}}" autofocus readonly>
                                        @if ($errors->has('email'))
                                            <span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>
                                        @endif
                                    </div>
                                    <div class="form-group {{ $errors->has('address') ? ' has-error' : '' }}">
                                        <label for="exampleInputEmail1">Address</label>
                                        <input type="text" class="form-control" name="address" value="{{$data['address']}}" autofocus>
                                        @if ($errors->has('address'))
                                            <span class="help-block"><strong>{{ $errors->first('address') }}</strong></span>
                                        @endif
                                    </div>
                                    <div class="form-group {{ $errors->has('phone') ? ' has-error' : '' }}">
                                        <label for="exampleInputEmail1">Phone</label>
                                        <input type="text" class="form-control" name="phone" value="{{$data['phone']}}" autofocus>
                                        @if($errors->has('phone'))
                                            <span class="help-block"><strong>{{ $errors->first('phone') }}</strong></span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group {{ $errors->has('event_date') ? ' has-error' : '' }}">
                                        <label for="exampleInputEmail1">Event Date</label>
                                        <input type="text" class="form-control" name="event_date" value="{{$data['event_date']}}" placeholder="YYYY-MM-DD">
                                        @if($errors->has('event_date'))
                                            <span class="help-block"><strong>{{ $errors->first('event_date') }}</strong></span>
                                        @endif
                                    </div>
                                    <div class="form-group {{ $errors->has('phone') ? ' has-error' : '' }}">
                                        <label for="exampleInputEmail1">Event Role</label>
                                        <select class="form-control" name="event_role">
                                            <option value="bride" <?php echo ($data['event_role'] == 'bride')?'selected':''; ?>>Bride</option>
                                            <option value="groom" <?php echo ($data['event_role'] == 'groom')?'selected':''; ?>>Groom</option>
                                            <option value="other" <?php echo ($data['event_role'] == 'other')?'selected':''; ?>>Other</option>
                                        </select>
                                        @if($errors->has('event_role'))
                                            <span class="help-block"><strong>{{ $errors->first('event_role') }}</strong></span>
                                        @endif
                                    </div>
                                    <div class="form-group {{ $errors->has('country') ? ' has-error' : '' }}">
                                        <label for="exampleInputEmail1">Country</label>
                                        <select class="form-control" name="country">
                                            <option value="">Country</option>
                                            @if(isset($countries) && !empty($countries))
                                                @foreach($countries as $cat)
                                                    <option value="{{$cat['sortname']}}" <?php echo ($data['country'] == $cat['sortname'])?'selected':''; ?>>{{$cat['name']}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @if ($errors->has('country'))
                                            <span class="help-block"><strong>{{ $errors->first('country') }}</strong></span>
                                        @endif
                                    </div>
                                    <input type="hidden" name="user_id" value="{{$data['id']}}">
                                    <div class="form-group text-right">
                                        <button class="btn btn-primary" type="submit">Update</button>
                                    </div>
                                </div>
                            </div>
                        </form>
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
</html> -->