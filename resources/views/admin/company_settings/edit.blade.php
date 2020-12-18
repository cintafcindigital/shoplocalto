@include('include/header');
<div class="pcoded-main-container">
    <div class="pcoded-content container">
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-12 mb-4">
                        <h1 class="d-inline-block font-weight-normal mb-0">Edit Company Details</h1>
                        @if(session()->has('success'))
                            <div class="alert alert-info">{{ session()->get('success') }}</div>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-xl-12">
                        <form class="form-horizontal" method="POST" action="{{url('/admin/edit_company_settings_data')}}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group {{ $errors->has('company_name') ? ' has-error' : '' }}">
                                        <label for="exampleInputEmail1">Company Name</label>
                                        <input type="text" class="form-control" name="company_name" value="{{$company['company_name']}}" autofocus>
                                        @if($errors->has('company_name'))
                                            <span class="help-block"><strong>{{ $errors->first('company_name') }}</strong></span>
                                        @endif
                                    </div>
                                    <div class="form-group {{ $errors->has('email_id') ? ' has-error' : '' }}">
                                        <label for="exampleInputEmail1">Email Id</label>
                                        <input type="text" class="form-control" name="email_id" value="{{$company['email_id']}}" autofocus>
                                        @if($errors->has('email_id'))
                                            <span class="help-block"><strong>{{ $errors->first('email_id') }}</strong></span>
                                        @endif
                                    </div>
                                    <div class="form-group {{ $errors->has('email_goes_to') ? ' has-error' : '' }}">
                                        <label for="exampleInputEmail1">Email Goes To</label>
                                        <input type="text" class="form-control" name="email_goes_to" value="{{$company['email_goes_to']}}" autofocus>
                                        @if($errors->has('email_goes_to'))
                                            <span class="help-block"><strong>{{ $errors->first('email_goes_to') }}</strong></span>
                                        @endif
                                    </div>
                                    <div class="form-group {{ $errors->has('phone_number') ? ' has-error' : '' }}">
                                        <label for="exampleInputEmail1">Phone Number</label>
                                        <input type="text" class="form-control" name="phone_number" value="{{$company['phone_number']}}" autofocus>
                                        @if ($errors->has('phone_number'))
                                            <span class="help-block"><strong>{{ $errors->first('phone_number') }}</strong></span>
                                        @endif
                                    </div>
                                    <div class="form-group {{ $errors->has('toll_free_number') ? ' has-error' : '' }}">
                                        <label for="exampleInputEmail1">Toll Free Number</label>
                                        <input type="text" class="form-control" name="toll_free_number" value="{{$company['toll_free_number']}}" autofocus>
                                        @if ($errors->has('toll_free_number'))
                                            <span class="help-block"><strong>{{ $errors->first('toll_free_number') }}</strong></span>
                                        @endif
                                    </div>
                                    <div class="form-group {{ $errors->has('fax_number') ? ' has-error' : '' }}">
                                        <label for="exampleInputEmail1">Fax Number</label>
                                        <input type="text" class="form-control" name="fax_number" value="{{$company['fax_number']}}" autofocus>
                                        @if ($errors->has('fax_number'))
                                            <span class="help-block"><strong>{{ $errors->first('fax_number') }}</strong></span>
                                        @endif
                                    </div>
                                    <div class="form-group {{ $errors->has('address') ? ' has-error' : '' }}">
                                        <label for="exampleInputEmail1">Address</label>
                                        <input type="text" class="form-control" name="address" value="{{$company['address']}}" autofocus>
                                        @if ($errors->has('address'))
                                            <span class="help-block"><strong>{{ $errors->first('address') }}</strong></span>
                                        @endif
                                    </div>
                                    <div class="form-group {{ $errors->has('logo') ? ' has-error' : '' }}">
                                        <label for="exampleInputEmail1">Logo</label>
                                        <input type="file" class="form-control" name="logo" autofocus><br>
                                        <img style="width:150px;" src="{{URL::asset('/public/images')}}/{{$company['logo']}}">
                                        @if ($errors->has('logo'))
                                            <span class="help-block"><strong>{{ $errors->first('logo') }}</strong></span>
                                        @endif
                                    </div>
                                    <input type="hidden" name="company_id" value="{{$company['id']}}">
                                    <div class="form-group">
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
</html>