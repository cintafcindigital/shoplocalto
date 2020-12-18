@include('include/header');
<div class="pcoded-main-container">
    <div class="pcoded-content container">
        <div class="row">
            <div class="col-sm-12">
                <div class="row border-bottom mb-3">
                    <div class="col-sm-6 d-flex align-items-center mb-4">
                        <h1 class="d-inline-block font-weight-normal mb-0">Add New page</h1>
                    </div>
                    <div class="col-sm-6 d-block d-sm-flex align-items-center justify-content-end mb-4 text-right">
                        <a href="{{url('admin/pages')}}" type="button" class="btn d-block ml-auto btn-primary"><i class="fa fa-backward"></i> &nbsp;Back</a>
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

                <form class="form-horizontal" method="POST" action="{{ url('/admin/save_page') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-12 col-xl-12">                        
                         <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                                <label>Title</label>
                                    <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}"  autofocus>
                                    @if ($errors->has('title'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                    @endif
                         </div>
                          <div class="form-group {{ $errors->has('image_description') ? ' has-error' : '' }}">
                                <label>Image Description</label>
                                 <textarea  name="image_description" id="image_description" data-validation-error-msg="Description is " data-validation="" class="form-control">{{ old('image_description') }}</textarea>
                                    @if ($errors->has('image_description'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('image_description') }}</strong>
                                        </span>
                                    @endif
                         </div>
                         <div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
                                <label>Description</label>
                                 <textarea  name="description" id="description" data-validation-error-msg="Description is " data-validation="" class="form-control">{{ old('description') }}</textarea>
                                    @if ($errors->has('description'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                    @endif
                         </div>
                         <div class="form-group {{ $errors->has('meta_title') ? ' has-error' : '' }}">
                                <label>Meta Title</label>
                                    <input id="meta_title" type="text" class="form-control" name="meta_title" value="{{ old('meta_title') }}"  autofocus>
                                    @if ($errors->has('meta_title'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('meta_title') }}</strong>
                                        </span>
                                    @endif
                         </div>
                          <div class="form-group {{ $errors->has('meta_description') ? ' has-error' : '' }}">
                                <label>Meta Description</label>
                                    <input id="meta_description" type="text" class="form-control" name="meta_description" value="{{ old('meta_description') }}"  autofocus>
                                    @if ($errors->has('meta_description'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('meta_description') }}</strong>
                                        </span>
                                    @endif
                         </div>
                          <div class="form-group {{ $errors->has('meta_keyword') ? ' has-error' : '' }}">
                                <label>Meta Keywords</label>
                                    <input id="meta_keyword" type="text" class="form-control" name="meta_keyword" value="{{ old('meta_keyword') }}" autofocus>
                                    @if ($errors->has('meta_keyword'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('meta_keyword') }}</strong>
                                        </span>
                                    @endif
                         </div>
                         <div class="form-group">
                                <label>Banner Image</label>
                                <div class="mb-3">
                                    <!-- <input id="file" type="file" name="image" value="" autofocus> -->
                                    @include('includes.image-crop-4',['name' => 'image','width' => 600,'height' => 360])
                                </div>
                                    @if ($errors->has('image'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('image') }}</strong>
                                        </span>
                                    @endif
                         </div>
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
<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script>
        CKEDITOR.replace( 'image_description' );
        CKEDITOR.replace( 'description' );
</script>
@@include('./include/footer.php')
</body>
</html>