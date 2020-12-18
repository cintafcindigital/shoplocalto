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
                                    <li class="breadcrumb-item"><a href="{{url('admin/vendors')}}">All Vendors</a></li>
                                    <li class="breadcrumb-item"><a href="{{url('admin/vendor-details/'.$data['vendor_id'])}}">View Details</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 mb-4">
                        <h1 class="d-inline-block font-weight-normal mb-0">Edit Vendor Profile</h1>
                    </div>
                </div>
                @if(session()->has('success'))
                    <div class="alert alert-info alert-dismissible fade show">{{ session()->get('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if(count($errors) > 0)
                <div class="alert alert-danger alert-dismissible fade show">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>@foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                </div>
                @endif
                <form class="form-horizontal" method="POST" action="{{url('/admin/update-vendor/')}}/{{$data['vendor_id']}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-6 col-xl-3">
                            @if(@$data['profile'])
                                <img src="{{url('/public/vendors/VENDOR_').$data['vendor_id']}}/{{$data['profile']}}" class="figure-img img-fluid rounded mb-3" alt="...">
                            @else
                                <img src="{{url('/').'/public/storage/no-image.png'}}" alt="Vendor Image" class="figure-img img-fluid rounded mb-3">
                            @endif
                            <figcaption class="figure-caption text-center mt-2" style="display:inline-block;width:20px;"><i class="m-r-10 f-18 feather icon-upload"></i></figcaption>
                            <input type="file" name="profile_image" style="width:218px;">
                            <p></p>
                            <select class="form-control" name="assign_sales">
                                <option value="">- - Assign Sales Staff - -</option>
                                @foreach($admins as $ads)
                                    @if($ads->role == 3)
                                    <option @if($ads->id == $data['assign_sales']) selected @endif value="{{$ads->id}}">{{$ads->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                            <p></p>
                            <select class="form-control" name="assign_marketing">
                                <option value="">- - Assign Marketing Staff - -</option>
                                @foreach($admins as $ads)
                                    @if($ads->role == 4)
                                    <option @if($ads->id == $data['assign_marketing']) selected @endif value="{{$ads->id}}">{{$ads->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                            <p></p>
                            <select class="form-control" name="assign_customer">
                                <option value="">- - Assign Customer Service - -</option>
                                @foreach($admins as $ads)
                                    @if($ads->role == 5)
                                    <option @if($ads->id == $data['assign_customer']) selected @endif value="{{$ads->id}}">{{$ads->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                            <p></p>
                            <select class="form-control" name="assign_technical">
                                <option value="">- - Assign Technical Staff - -</option>
                                @foreach($admins as $ads)
                                    @if($ads->role == 6)
                                    <option @if($ads->id == $data['assign_technical']) selected @endif value="{{$ads->id}}">{{$ads->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12 col-xl-9">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group {{ $errors->has('username') ? ' has-error' : '' }}">
                                        <label for="exampleInputEmail1">Username</label>
                                        <input type="text" class="form-control" name="username" value="{{$data['username']}}" readonly="readonly">
                                        <input type="hidden" name="vendor_id" value="{{$data['vendor_id']}}">
                                        @if ($errors->has('username'))
                                            <span class="help-block"><strong>{{ $errors->first('username') }}</strong></span>
                                        @endif
                                    </div>
                                    <div class="form-group {{ $errors->has('contact_person') ? ' has-error' : '' }}">
                                        <label for="exampleInputEmail1">Contact Person</label>
                                        <input type="text" class="form-control" name="contact_person" value="{{$data['contact_person']}}" autofocus>
                                        @if($errors->has('contact_person'))
                                            <span class="help-block"><strong>{{ $errors->first('contact_person') }}</strong></span>
                                        @endif
                                    </div>
                                    <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                                        <label for="exampleInputEmail1">Change Password</label>
                                        <input type="password" class="form-control" name="password" placeholder="Fill it for change password">
                                        @if($errors->has('password'))
                                            <span class="help-block"><strong>{{ $errors->first('password') }}</strong></span>
                                        @endif
                                    </div>
                                    <div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
                                        <label for="exampleInputEmail1">Business Description</label>
                                        <textarea style="resize: none;" class="form-control" name="description">{{$data['business_description']}}</textarea>
                                        @if ($errors->has('description'))
                                            <span class="help-block"><strong>{{ $errors->first('description') }}</strong></span>
                                        @endif
                                    </div>
                                    <div class="form-group {{ $errors->has('website') ? ' has-error' : '' }}">
                                        <label for="exampleInputEmail1">Website</label>
                                        <input type="text" class="form-control" name="website" value="{{$data['website']}}">
                                        @if ($errors->has('website'))
                                            <span class="help-block"><strong>{{ $errors->first('website') }}</strong></span>
                                        @endif
                                    </div>
                                    <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                        <label for="exampleInputEmail1">Email Address</label>
                                        <input type="text" class="form-control" name="email" value="{{$data['email']}}">
                                        @if ($errors->has('email'))
                                            <span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>
                                        @endif
                                        <input type="hidden" class="form-control" name="email1" value="{{$data['email']}}">
                                    </div>
                                    <div class="form-group {{ $errors->has('telephone') ? ' has-error' : '' }}">
                                        <label for="exampleInputEmail1">Telephone</label>
                                        <input type="number" class="form-control" name="telephone" value="{{$data['telephone']}}" autofocus>
                                        @if($errors->has('telephone'))
                                            <span class="help-block"><strong>{{ $errors->first('telephone') }}</strong></span>
                                        @endif
                                    </div>
                                    <div class="form-group {{ $errors->has('mobile') ? ' has-error' : '' }}">
                                        <label for="exampleInputEmail1">Mobile</label>
                                        <input type="number" class="form-control" name="mobile" value="{{$data['mobile']}}" autofocus>
                                        @if($errors->has('mobile'))
                                            <span class="help-block"><strong>{{ $errors->first('mobile') }}</strong></span>
                                        @endif
                                    </div>
                                    <hr class="my-2"/>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group {{ $errors->has('business_name') ? ' has-error' : '' }}">
                                        <label for="exampleInputEmail1">Business Name</label>
                                        <input type="text" class="form-control" name="business_name" value="{{$company_data['business_name']}}">
                                        @if ($errors->has('business_name'))
                                            <span class="help-block"><strong>{{ $errors->first('business_name') }}</strong></span>
                                        @endif
                                    </div>
                                    <div class="form-group {{ $errors->has('business_address') ? ' has-error' : '' }}">
                                        <label for="exampleInputEmail1">Business Address</label>
                                        <input type="text" class="form-control" name="business_address" value="{{$company_data['business_address']}}">
                                        @if ($errors->has('business_address'))
                                            <span class="help-block"><strong>{{ $errors->first('business_address') }}</strong></span>
                                        @endif
                                    </div>
                                    <div class="form-group {{ $errors->has('confirm_password') ? ' has-error' : '' }}">
                                        <label for="exampleInputEmail1">Confirm Password</label>
                                        <input type="text" class="form-control" name="confirm_password">
                                        @if($errors->has('confirm_password'))
                                            <span class="help-block"><strong>{{ $errors->first('confirm_password') }}</strong></span>
                                        @endif
                                    </div>
                                    <div class="form-group {{ $errors->has('business_detail') ? ' has-error' : '' }}">
                                        <label for="exampleInputEmail1">Business Details</label>
                                        <textarea style="resize: none;" class="form-control" name="business_detail">{{$company_data['business_detail']}}</textarea>
                                        @if ($errors->has('business_detail'))
                                            <span class="help-block"><strong>{{ $errors->first('business_detail') }}</strong></span>
                                        @endif
                                    </div>
                                    <div class="form-group {{ $errors->has('postal_code') ? ' has-error' : '' }}">
                                        <label for="exampleInputEmail1">Postal Code</label>
                                        <input type="text" class="form-control" name="postal_code" value="{{$company_data['postal_code']}}">
                                        @if ($errors->has('postal_code'))
                                            <span class="help-block"><strong>{{ $errors->first('postal_code') }}</strong></span>
                                        @endif
                                    </div>
                                    <div class="form-group {{ $errors->has('city') ? ' has-error' : '' }}">
                                        <label for="exampleInputEmail1">City</label>
                                        <input type="text" class="form-control" name="city" value="{{$company_data['city']}}">
                                        @if ($errors->has('city'))
                                            <span class="help-block"><strong>{{ $errors->first('city') }}</strong></span>
                                        @endif
                                    </div>
                                    <div class="form-group {{ $errors->has('province') ? ' has-error' : '' }}">
                                        <label for="exampleInputEmail1">Province</label>
                                        <select class="form-control" name="province">
                                            <option value="">Province</option>
                                            @if(isset($province) && !empty($province))
                                                @foreach($province as $cat)
                                                    <option value="{{$cat['name']}}" <?php echo (strtolower($company_data['province']) == strtolower($cat['name']))?'selected':''; ?>>{{$cat['name']}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @if ($errors->has('province'))
                                            <span class="help-block"><strong>{{ $errors->first('province') }}</strong></span>
                                        @endif
                                    </div>
                                    <div class="form-group {{ $errors->has('country') ? ' has-error' : '' }}">
                                        <label for="exampleInputEmail1">Country</label>
                                        <select class="form-control" name="country">
                                            <option value="">Country</option>
                                            @if(isset($countries) && !empty($countries))
                                                @foreach($countries as $cat)
                                                    <option value="{{$cat['name']}}" <?php echo (strtolower($company_data['country']) == strtolower($cat['name']))?'selected':''; ?>>{{$cat['name']}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @if($errors->has('country'))
                                            <span class="help-block"><strong>{{ $errors->first('country') }}</strong></span>
                                        @endif
                                    </div>
                                    <hr class="my-2"/>
                                    <input type="hidden" name="user_id" value="{{$data['vendor_id']}}">
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
</body>
</html>