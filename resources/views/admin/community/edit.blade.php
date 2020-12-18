@include('include/header');


<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>

<div class="pcoded-main-container">
    <div class="pcoded-content container">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="clearfix border-bottom mb-3">
                        <div class="float-left"><h1 class="d-inline-block font-weight-normal text-body mb-3">Edit Community Group</h1></div>
                        <div class="float-right"><a href="{{url('admin/community')}}"><i class="fa fa-backward"></i>&nbsp; Back</a></div>
                    </div>
                    
                    <div class="table-responsive">
                        @if(session()->has('success'))
                            <div class="alert alert-info">{{ session()->get('success') }}</div>
                        @endif

                        @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        
                        <form class="form-horizontal" method="POST" action="{{ url('/admin/update-group-community') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}                                                                                             
                            <div class="box-body">               
                             <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                                    <label> Group Title</label>
                                        <input id="title" type="text" class="form-control" name="title" value="{{ $data['group_title'] }}"  autofocus>
                                        @if ($errors->has('title'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('title') }}</strong>
                                            </span>
                                        @endif
                             </div>
                             <div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
                                    <label>Description</label>
                                     <textarea  name="description" id="description" data-validation-error-msg="Description is " data-validation="" class="form-control">{{$data['description']}}</textarea>
                                        @if ($errors->has('description'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('description') }}</strong>
                                            </span>
                                        @endif
                                    <script>
                                        CKEDITOR.replace( 'description' );
                                    </script>
                             </div>
                             <div class="form-group {{ $errors->has('meta_title') ? ' has-error' : '' }}">
                                    <label>Meta Title</label>
                                        <input id="meta_title" type="text" class="form-control" name="meta_title" value="{{$data['meta_title']}}"  autofocus>
                                        @if ($errors->has('meta_title'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('meta_title') }}</strong>
                                            </span>
                                        @endif
                             </div>
                              <div class="form-group {{ $errors->has('meta_description') ? ' has-error' : '' }}">
                                    <label>Meta Description</label>
                                        <input id="meta_description" type="text" class="form-control" name="meta_description" value="{{$data['meta_description']}}"  autofocus>
                                        @if ($errors->has('meta_description'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('meta_description') }}</strong>
                                            </span>
                                        @endif
                             </div>
                              <div class="form-group {{ $errors->has('meta_keyword') ? ' has-error' : '' }}">
                                    <label>Meta Keywords</label>
                                        <input id="meta_keyword" type="text" class="form-control" name="meta_keyword" value="{{$data['meta_keyword']}}" autofocus>
                                        @if ($errors->has('meta_keyword'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('meta_keyword') }}</strong>
                                            </span>
                                        @endif
                             </div>
                             <div class="form-group">
                                    <label>Group Thumb Image</label>
                                        <input id="file" type="file" class="form-control" name="thumb_image" value=""  autofocus style="margin-bottom: 20px;">
                                        @if(isset($data['thumb_image']) && $data['thumb_image']!='')
                                        <img src="{{URL::asset('public/community_images')}}/{{$data['thumb_image']}}" style="width:150px;">
                                        @endif
                                        @if ($errors->has('thumb_image'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('thumb_image') }}</strong>
                                            </span>
                                        @endif
                             </div>
                             <div class="form-group">
                                    <label>Group Banner Image</label>
                                        <input id="file" type="file" class="form-control" name="image" value=""  autofocus style="margin-bottom: 20px;">
                                        @if(isset($data['image']) && $data['image']!='')
                                        <img src="{{URL::asset('public/community_images')}}/{{$data['image']}}" style="width:150px;">
                                        @endif
                                        @if ($errors->has('image'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('image') }}</strong>
                                            </span>
                                        @endif
                             </div>
                             <div class="form-group">
                                <input type="hidden" name="page_id" value="{{$data['id']}}">
                                <button class="btn btn-primary" type="submit">Submit</button>
                             </div>
                        </form>
                    </div>
                    <div class="box-footer clearfix">  </div>  
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