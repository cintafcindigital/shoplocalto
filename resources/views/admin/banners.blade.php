@include('include/header')
<div class="pcoded-main-container">
    <div class="pcoded-content container">
        <div class="row">
            <div class="col-sm-12">
                <div class="row border-bottom mb-3">
                    <div class="col-sm-6 d-flex align-items-center mb-4">
                        <h1 class="d-inline-block font-weight-normal mb-0">Add Banners</h1>
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
                        <form method="POST" action="@if(!isset($bannersedit)) {{url('admin/save_banner')}} @else {{url()->current()}} @endif" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                <label>Name</label>
                                <input id="name" type="text" class="form-control" name="name" value="{{old('name',isset($bannersedit)?$bannersedit->name:'')  }}"  autofocus>
                                @if($errors->has('name'))
                                    <span class="help-block"><strong>{{ $errors->first('name') }}</strong></span>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                                <label>Banner Title</label>
                                <input id="name" type="text" class="form-control" name="title" value="{{old('title',isset($bannersedit)?$bannersedit->title:'')  }}"  autofocus>
                                @if($errors->has('title'))
                                    <span class="help-block"><strong>{{ $errors->first('title') }}</strong></span>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
                                <label>Banner Description</label>
                                <textarea name="description" id="description" class="form-control">{{old('description',isset($bannersedit)?$bannersedit->description:'')  }}</textarea>
                               
                                @if($errors->has('description'))
                                    <span class="help-block"><strong>{{ $errors->first('description') }}</strong></span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Image</label>
                                <div class="mb-3">
                                   
                                   @if(isset($bannersedit))
                            <img src="{{asset('banners')}}/{{$bannersedit->image}}" style="width: 100px;height: 100px">
                            @endif
                                    <!-- <input id="file" type="file" name="image" value="{{ old('image') }}" autofocus> -->
                                    @include('includes.image-crop-4',['name' => 'image','width' => 900,'height' => 600])
                                </div>
                                <!-- <p>(Recommonded dimension : 1024 x 614)</p> -->
                                <p>(Recommonded dimension : 900 x 600)</p>
                                @if($errors->has('image'))
                                    <span class="help-block"><strong>{{ $errors->first('image') }}</strong></span>
                                @endif
                            </div>
                            
                            
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                    @if(count($banners) > 0)
                        <div class="col-md-12 col-xl-12">
                            <div class="panel panel-default">
                                <div class="panel-heading my-3">
                                    <h2 class="d-inline-block font-weight-normal mb-0">All Banners</h2>
                                </div>
                                <div class="panel-body">
                                    <table class="table table-striped task-table">
                                        <thead>
                                            <th>Name</th>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Image</th>
                                            <th>Action</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($banners as $banner)
                                            <tr>
                                                <td>{{$banner->name}}</td>
                                                <td>{{$banner->title}}</td>
                                                <td>{{$banner->description}}</td>
                                                <td><img style="width:100px;height:100px" src="{{asset('banners')}}/{{$banner->image}}"></td>
                                                
                                                <th>
                                                    <a class="text-primary" title="Edit" href="{{url('admin/edit-banner')}}/{{$banner->id}}"><i class="fa fa-edit"></i></a>&nbsp;&nbsp; 
                                                    <a class="text-danger" title="Delete" href="{{url('admin/delete-banner')}}/{{$banner->id}}" onclick="javascript:return confirm('Do you want to delete this Banner ?');"><i class="fa fa-trash"></i></a></th>
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