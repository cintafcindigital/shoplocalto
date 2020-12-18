@include('include/header');
<div class="pcoded-main-container">
    <div class="pcoded-content container">
        <div class="row">
            <div class="col-sm-12">
                <div class="row border-bottom mb-3">
                    <div class="col-sm-6 d-flex align-items-center mb-4">
                        <h1 class="d-inline-block font-weight-normal mb-0">
                        
                        @if(isset($communities))
                        Update Community
                        @else
                        Add New Community
                        @endif


                    </h1>
                    </div>
                    <div class="col-sm-6 d-block d-sm-flex align-items-center justify-content-end mb-4 text-right">
                        <a href="{{url('admin/communities')}}" type="button" class="btn d-block ml-auto btn-primary"><i class="fa fa-backward"></i> &nbsp;Back</a>
                        <!-- <i class="feather icon-plus mr-2"> -->
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

                <form class="form-horizontal" method="POST" action="{{ url()->current() }}" enctype="multipart/form-data">

                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-12 col-xl-12">
                        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                            <label>Community Name</label>
                            <input id="name" type="text" class="form-control" name="name" value="{{old('name',isset($communities)?$communities->name:'')  }}"  autofocus>
                            @if ($errors->has('name'))
                                <span class="help-block"><strong>{{ $errors->first('name') }}</strong></span>
                            @endif
                        </div>
                       
                        
                        <div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
                            <label>Description</label>
                            <textarea id="description" type="text" class="form-control" name="description" autofocus>{{ old('description',isset($communities)?$communities->description:'') }}</textarea>
                            @if ($errors->has('description'))
                                <span class="help-block"><strong>{{ $errors->first('description') }}</strong></span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('district_id') ? ' has-error' : '' }}">
                            <label>District</label>
                            <select class="form-control" id="district" name="district">
                                <option value="">Select District</option>
                                @foreach($districts as $district)
                                <option value="{{$district->id}}" @if(isset($communities)) @if($communities->district_id==$district->id) selected @endif @endif>{{$district->name}}</option>
                                @endforeach
                            </select>
                            <!-- <textarea id="district_id" type="text" class="form-control" name="district_id" autofocus>{{ old('district_id') }}</textarea> -->
                            @if ($errors->has('district'))
                                <span class="help-block"><strong>{{ $errors->first('district') }}</strong></span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('image') ? ' has-error' : '' }}">
                            <label>Picture</label>
                            <span>(362px x 200px)</span>
                            @if(isset($communities))
                            <img src="{{asset('locations')}}/{{$communities->image}}" style="width: 100px;height: 100px">
                            @endif
                            <!-- <input id="picture" type="file" class="form-control" name="picture" value="{{ old('picture') }}"  autofocus> -->
                            @include('includes.image-crop-4',['name' => 'image','width' => 633.5,'height' => 350])
                            @if ($errors->has('image'))
                                <span class="help-block"><strong>{{ $errors->first('image') }}</strong></span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12 col-xl-12">
                        <div class="form-group {{$errors->has('latitude') ? ' has-error' : '' }}">
                            <label>Latitude</label>
                            <input id="latitude" type="text" class="form-control" name="latitude" value="{{ old('latitude',isset($communities)?$communities->latitude:'') }}"  autofocus>
                            @if ($errors->has('latitude'))
                                <span class="help-block"><strong>{{ $errors->first('latitude') }}</strong></span>
                            @endif
                        </div>
                        <div class="form-group {{$errors->has('longitude') ? ' has-error' : '' }}">
                            <label>Longitude</label>
                            <input id="longitude" type="text" class="form-control" name="longitude" value="{{ old('longitude',isset($communities)?$communities->longitude:'')}}"  autofocus>
                            @if ($errors->has('longitude'))
                                <span class="help-block"><strong>{{ $errors->first('longitude') }}</strong></span>
                            @endif
                        </div>
                    </div>
                     <div class="form-group {{ $errors->has('is_home') ? ' has-error' : '' }}">

                            <label><input type="checkbox" @if(isset($communities) && ($communities->display_home==1))checked @endif name="is_home" value="1"> Display In Home</label>

                            @if ($errors->has('is_home'))

                                <span class="help-block"><strong>{{ $errors->first('is_home') }}</strong></span>

                            @endif

                        </div>
                    <div class="col-md-12 col-xl-12">
                        
                        
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </div>
                    </div>
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

@@include('./include/footer.php')
</body>
</html>