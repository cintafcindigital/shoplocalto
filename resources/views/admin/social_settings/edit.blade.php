@include('include/header');
<div class="pcoded-main-container">
    <div class="pcoded-content container">
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-12 mb-4">
                        <h1 class="d-inline-block font-weight-normal mb-0">Edit Social Media</h1>
                        @if(session()->has('success'))
                            <div class="alert alert-info">{{ session()->get('success') }}</div>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-xl-12">
                        <form class="form-horizontal" method="POST" action="{{url('/admin/edit_social_settings_data')}}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                        <label for="exampleInputEmail1">Name</label>
                                        <input type="text" class="form-control" name="name" value="{{$data['name']}}" autofocus>
                                        @if($errors->has('name'))
                                            <span class="help-block"><strong>{{ $errors->first('name') }}</strong></span>
                                        @endif
                                    </div>
                                    <div class="form-group {{ $errors->has('social_link') ? ' has-error' : '' }}">
                                        <label for="exampleInputEmail1">Social Link</label>
                                        <input type="text" class="form-control" name="social_link" value="{{$data['social_link']}}" autofocus>
                                        @if($errors->has('social_link'))
                                            <span class="help-block"><strong>{{ $errors->first('social_link') }}</strong></span>
                                        @endif
                                    </div>
                                    <input type="hidden" name="social_id" value="{{$data['id']}}">
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