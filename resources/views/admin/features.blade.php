@include('include/header')
<div class="pcoded-main-container">
    <div class="pcoded-content container">
        <div class="row">
            <div class="col-sm-12">
                <div class="row border-bottom mb-3">
                    <div class="col-sm-6 d-flex align-items-center mb-4">
                        <h1 class="d-inline-block font-weight-normal mb-0">Add Features</h1>
                    </div>
                </div>
                @if(session()->has('success'))
                    <div class="alert alert-info alert-dismissible fade show">{{ session()->get('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if(session()->has('error'))
                    <div class="alert alert-danger alert-dismissible fade show">{{ session()->get('error') }}
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
                <div class="row">
                    <div class="col-md-12 col-xl-12">
                        <form method="POST" action="@if(!isset($featuresedit)) {{url('admin/save_feature')}} @else {{url()->current()}} @endif" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                <label>Name</label>
                                <input id="name" type="text" class="form-control" name="name" value="{{old('name',isset($featuresedit)?$featuresedit->name:'')  }}"  autofocus>
                                @if($errors->has('name'))
                                    <span class="help-block"><strong>{{ $errors->first('name') }}</strong></span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Icon</label>
                                <div class="mb-3">
                                   
                                   @if(isset($featuresedit))
                            <img src="{{asset('features')}}/{{$featuresedit->icon}}" style="width: 100px;height: 100px">
                            @endif
                                    <!-- <input id="file" type="file" name="image" value="{{ old('image') }}" autofocus> -->
                                    @include('includes.image-crop-4',['name' => 'icon','width' => 100,'height' => 100])
                                </div>
                                <!-- <p>(Recommonded dimension : 1024 x 614)</p> -->
                                <p>(Recommonded dimension : 100 x 100)</p>
                                @if($errors->has('icon'))
                                    <span class="help-block"><strong>{{ $errors->first('icon') }}</strong></span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Mobile Icon</label>
                                <div class="mb-3">
                                   
                                   @if(isset($featuresedit))
                            <img src="{{asset('features')}}/{{$featuresedit->mobile_icon}}" style="width: 100px;height: 100px">
                            @endif
                                    <!-- <input id="file" type="file" name="image" value="{{ old('image') }}" autofocus> -->
                                    @include('includes.image-crop-4',['name' => 'mobileicon','width' => 100,'height' => 100])
                                </div>
                                <!-- <p>(Recommonded dimension : 1024 x 614)</p> -->
                                <p>(Recommonded dimension : 100 x 100)</p>
                                @if($errors->has('mobileicon'))
                                    <span class="help-block"><strong>{{ $errors->first('mobileicon') }}</strong></span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Display Order</label>
                                <input id="displayorder" type="number" class="form-control" name="displayorder" value="{{old('displayorder',isset($featuresedit)?$featuresedit->display_order:'')  }}"  autofocus>
                                @if($errors->has('displayorder'))
                                    <span class="help-block"><strong>{{ $errors->first('displayorder') }}</strong></span>
                                @endif
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                    @if(count($features) > 0)
                        <div class="col-md-12 col-xl-12">
                            <div class="panel panel-default">
                                <div class="panel-heading my-3">
                                    <h2 class="d-inline-block font-weight-normal mb-0">All Features</h2>
                                </div>
                                <div class="panel-body">
                                    <table class="table table-striped task-table">
                                        <thead>
                                            <th>Name</th>
                                            <th>Icon</th>
                                            <th>Mobile Icon</th>
                                            <th>Display Order</th>
                                            <th>Action</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($features as $feature)
                                            <tr>
                                                <td>{{$feature->name}}</td>
                                                <td><img style="width:100px;height:100px" src="{{asset('features')}}/{{$feature->icon}}"></td>
                                                <td><img style="width:100px;height:100px" src="{{asset('features')}}/{{$feature->mobile_icon}}"></td>
                                                <th>{{$feature->display_order}}</th>
                                                <th>
                                                    <a class="text-primary" title="Edit" href="{{url('admin/edit-feature')}}/{{$feature->id}}"><i class="fa fa-edit"></i></a>&nbsp;&nbsp; 
                                                    <a class="text-danger" title="Delete" href="{{url('admin/delete-feature')}}/{{$feature->id}}" onclick="javascript:return confirm('Do you want to delete this Feature ?');"><i class="fa fa-trash"></i></a></th>
                                            </tr>

                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
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
</body>
</html>