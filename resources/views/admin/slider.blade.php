@include('include/header')
<div class="pcoded-main-container">
    <div class="pcoded-content container">
        <div class="row">
            <div class="col-sm-12">
                <div class="row border-bottom mb-3">
                    <div class="col-sm-6 d-flex align-items-center mb-4">
                        <h1 class="d-inline-block font-weight-normal mb-0">Add Slider</h1>
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
                <div class="row">
                    <div class="col-md-12 col-xl-12">
                        <form method="POST" action="{{ url('admin/save_slider') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                <label>Name</label>
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}"  autofocus>
                                @if($errors->has('name'))
                                    <span class="help-block"><strong>{{ $errors->first('name') }}</strong></span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Image</label>
                                <div class="mb-3">
                                    <!-- <input id="file" type="file" name="image" value="{{ old('image') }}" autofocus> -->
                                    @include('includes.image-crop-4',['name' => 'image','width' => 750,'height' => 400])
                                </div>
                                <!-- <p>(Recommonded dimension : 1024 x 614)</p> -->
                                <p>(Recommonded dimension : 750 x 320)</p>
                                @if($errors->has('image'))
                                    <span class="help-block"><strong>{{ $errors->first('image') }}</strong></span>
                                @endif
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Add Slider</button>
                            </div>
                        </form>
                    </div>
                    @if(count($sliders) > 0)
                        <div class="col-md-12 col-xl-12">
                            <div class="panel panel-default">
                                <div class="panel-heading my-3">
                                    <h2 class="d-inline-block font-weight-normal mb-0">Active Sliders</h2>
                                </div>
                                <div class="panel-body">
                                    <table class="table table-striped task-table">
                                        <thead>
                                            <th>Title</th>
                                            <th>Image</th>
                                            <th>Action</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($sliders as $slider)
                                            <tr>
                                                <td class="table-text" width="35%"><div>{{ $slider->name }}</div></td>
                                                <td class="table-text"><div><img width="200" src="{{url('public/sliders')}}/{{ $slider->image }}"></div></td>
                                                <td>
                                                    <form action="{{ url('admin/delete_slider/'.$slider->id) }}" method="POST">
                                                        {{ csrf_field() }}
                                                        {{ method_field('DELETE') }}
                                                        <button type="submit" class="btn btn-danger btn-sm" onclick="javascript:return confirm('Do you want to delete ?');" title="Delete">
                                                            <i class="fa fa-btn fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
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