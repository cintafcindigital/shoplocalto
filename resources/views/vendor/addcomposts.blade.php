@extends('layouts.default')
@section('meta_title',$data['titleData']->meta_title)
@section('meta_keyword',$data['titleData']->meta_keyword)
@section('meta_description',$data['titleData']->meta_description)
@section('content')
@include('includes.menu')
<style type="text/css">
    .categories {
        list-style-type: none;
        color: #000;
    }
    .categories li label {
        font-size: 19px;
        font-weight: normal;
    }
    .categories ul {
        list-style-type: none;
        color: #000;
    }
    .categories ul li label {
        font-size: 17px;
        font-weight: normal;
    }
    .container-ul {
      display: block;
      position: relative;
      padding-left: 35px;
      margin-bottom: 12px;
      cursor: pointer;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
      color: #000;
    }
    .container-ul input {
      position: absolute;
      opacity: 0;
      cursor: pointer;
      height: 0;
      width: 0;
    }
    .checkmark {
      position: absolute;
      top: 0;
      left: 0;
      height: 25px;
      width: 25px;
      background-color: #eee;
    }
    .container-ul:hover input ~ .checkmark {
      background-color: #ccc;
    }
    .container-ul input:checked ~ .checkmark {
      background-color: #2c3e98;
    }
    .checkmark:after {
      content: "";
      position: absolute;
      display: none;
    }
    .container-ul input:checked ~ .checkmark:after {
      display: block;
    }
    .container-ul .checkmark:after {
        left: 9px;
        top: 2px;
        width: 8px;
        height: 17px;
        border: solid white;
        border-width: 0 3px 3px 0;
        -webkit-transform: rotate(45deg);
        -ms-transform: rotate(45deg);
        transform: rotate(45deg);
    }
</style>
<section class="section-padding dashboard-wrap review_main_wrp dash_main_sect">
    @include('vendor.tools_nav')
    <div class="wrapper">
       <div class="pure-g">
          <div class="pure-u-2-7">
             <div class="mr40">
                <nav class="adminAside review_list">
                   <a class="adminAside__item" href="{{url('blogs')}}">
                      <i class="svgIcon svgIcon__gear adminAside__icon">
                         <svg viewBox="0 0 18 20">
                            <path d="M5.98 16.179a.653.653 0 0 0-.822-.472l-1.76.504c-.856.244-1.883-.17-2.325-.94l-.601-1.04C.027 13.46.18 12.365.82 11.745l1.317-1.272a.657.657 0 0 0 0-.95L.824 8.252C.183 7.634.029 6.54.473 5.769l.6-1.04c.443-.771 1.47-1.185 2.325-.94l1.76.504a.656.656 0 0 0 .823-.474l.443-1.776C6.64 1.18 7.511.5 8.4.5h1.2c.889 0 1.76.68 1.975 1.542l.444 1.775c.092.366.46.577.823.474l1.76-.504c.855-.245 1.88.17 2.324.94l.602 1.041c.443.772.29 1.865-.35 2.482L15.86 9.524a.653.653 0 0 0 0 .948l1.318 1.273c.64.619.792 1.712.348 2.484l-.6 1.04c-.442.77-1.469 1.185-2.325.94l-1.761-.504a.654.654 0 0 0-.82.474l-.445 1.778C11.36 18.82 10.489 19.5 9.6 19.5H8.4c-.89 0-1.76-.68-1.975-1.543l-.446-1.778zm1.415 1.536c.104.417.575.785 1.005.785h1.2c.43 0 .901-.368 1.005-.785l.445-1.778a1.653 1.653 0 0 1 2.067-1.193l1.76.504c.415.119.97-.105 1.184-.478l.6-1.04c.215-.375.132-.966-.177-1.266l-1.318-1.273a1.653 1.653 0 0 1 .001-2.387l1.316-1.273c.31-.3.393-.89.178-1.264l-.601-1.04c-.215-.373-.77-.597-1.183-.479l-1.76.504a1.656 1.656 0 0 1-2.068-1.192l-.444-1.776C10.501 1.868 10.03 1.5 9.6 1.5H8.4c-.43 0-.901.368-1.005.785L6.95 4.062a1.657 1.657 0 0 1-2.068 1.193l-1.76-.504c-.415-.12-.97.105-1.184.477l-.6 1.04c-.215.374-.132.966.178 1.265l1.316 1.272a1.658 1.658 0 0 1 0 2.387l-1.317 1.273c-.31.3-.393.892-.178 1.265l.602 1.042c.213.372.768.596 1.183.477l1.759-.503a1.652 1.652 0 0 1 2.067 1.19l.446 1.779zM9 8.1a1.9 1.9 0 1 0 0 3.8 1.9 1.9 0 0 0 0-3.8zm0-1a2.9 2.9 0 1 1 0 5.8 2.9 2.9 0 0 1 0-5.8z" fill-rule="nonzero"></path>
                         </svg>
                      </i> All Posts
                   </a>
                   <a class="adminAside__item active " href="{{url('add-blogs')}}">
                      <i class="svgIcon svgIcon__note adminAside__icon">
                         <svg viewBox="0 0 18 19">
                            <path d="M16.636.87a.5.5 0 0 1 .5.5v11.087a.5.5 0 0 1-.143.35l-5.091 5.174a.5.5 0 0 1-.357.15H1.364a.5.5 0 0 1-.5-.5V1.37a.5.5 0 0 1 .5-.5h15.272zm-.5 1H1.864v15.26h9.472l4.8-4.878V1.87zm-4.09 15.76a.5.5 0 1 1-1 0v-5.173a.5.5 0 0 1 .5-.5h5.09a.5.5 0 0 1 0 1h-4.59v4.673zM4 6.5a.5.5 0 0 1 0-1h9a.5.5 0 1 1 0 1H4zm0 3a.5.5 0 0 1 0-1h6a.5.5 0 0 1 0 1H4z" fill-rule="nonzero"></path>
                         </svg>
                      </i> New Post
                   </a>
                   
                </nav>
             </div>
          </div>

          <div class="pure-u-5-7">
             <h1 class="adminTitle">
                            
             </h1>
             
               
        <div class="row">
            <div class="col-sm-12">
                <div class="row border-bottom mb-3">
                    <div class="col-sm-6 d-flex align-items-center mb-4">
                        <h1 class="d-inline-block font-weight-normal mb-0">Add New Community Posts</h1>
                    </div>
                    <!--<div class="col-sm-6 d-block d-sm-flex align-items-center justify-content-end mb-4 text-right">-->
                    <!--    <a href="{{url('admin/blog')}}" type="button" class="btn d-block ml-auto btn-primary"><i class="fa fa-backward"></i> &nbsp;Back</a>-->
                        <!-- <i class="feather icon-plus mr-2"> -->
                    <!--</div>-->
                </div>

                @if(session()->has('success'))
                    <div class="alert alert-info alert-dismissible">{{ session()->get('success') }}
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    </div>
                @endif
                @if(count($errors) > 0 || session()->has('error'))
                <div class="alert alert-danger alert-dismissible">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    @if(count($errors) > 0)
                    <ul>@foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endif
                    @if(session()->has('error'))
                    <ul>
                        <li>{{session()->get('error')}}</li>
                    </ul>
                    @endif
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                </div>
                @endif

                <form class="form-horizontal" method="POST" action="{{ url()->current() }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-12 col-xl-12">
                        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                            <label>Name Or Titile</label>
                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}"  autofocus>
                            @if ($errors->has('name'))
                                <span class="help-block"><strong>{{ $errors->first('name') }}</strong></span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('excerpt') ? ' has-error' : '' }}">
                            <label>Excerpt</label>
                            <textarea class="form-control" rows="5" id="excerpt" name="excerpt">{{old('excerpt')}}</textarea>
                            @if ($errors->has('excerpt'))
                                <span class="help-block"><strong>{{ $errors->first('excerpt') }}</strong></span>
                            @endif
                        </div>
                        <style type="text/css">
                          .btn {
                            color: #000 !important;
                          }
                          .btn i {
                            color: #000 !important;
                          }
                       </style>
                        <div class="form-group {{ $errors->has('body') ? ' has-error' : '' }}">
                            <label>Post Body</label>
                            <textarea class="form-control" id="body" rows="5" id="body" name="body">{{old('body')}}</textarea>
                            @if($errors->has('body'))
                                <span class="help-block"><strong>{{ $errors->first('body') }}</strong></span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('category_id') ? ' has-error' : '' }}">
                            <label>Category</label>
                            <select class="form-control" name="category_id">
                                <option value="">-- Select Parent Category --</option>
                                @if(isset($data['cats']) && !empty($data['cats']))
                                    @foreach($data['cats'] as $cat)
                                        <option value="{{$cat['id']}}" {{old('category_id') == $cat['id'] ? 'selected' : ''}}>{{$cat['name']}}</option>
                                    @endforeach
                                @endif
                            </select>
                            <?php /*<ul class="categories">
                                @if(isset($cats) && !empty($cats))
                                    @foreach($cats as $cat)
                                        @if(isset($cat['child']))
                                        <li><label>{{$cat['name']}}</label></li>
                                        @foreach($cat['child'] as $child)
                                            <ul>
                                                <li><label class="container-ul"> <input type="checkbox" @if(is_array(old('categories')) && in_array($child['id'],old('categories'))) checked @endif value="{{$child['id']}}" name="categories[]"> {{$child['name']}} <span class="checkmark"></span></label></li>
                                            </ul>
                                        @endforeach
                                        @endif
                                    @endforeach
                                @endif
                            </ul>*/ ?>
                            @if ($errors->has('category_id'))
                                <span class="help-block"><strong>{{ $errors->first('category_id') }}</strong></span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('published') ? ' has-error' : '' }}">
                            <label class="container-ul" style="font-size: 17px;font-weight: normal;"><input type="checkbox" name="published" checked value="1"> Publish <span class="checkmark"></span></label>
                            @if ($errors->has('published'))
                                <span class="help-block"><strong>{{ $errors->first('published') }}</strong></span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('picture') ? ' has-error' : '' }}">
                            <label>Picture</label>
                            <input type="file" accept="image/jpeg,image/png,image/jpg,image/gif,image/svg" style="width: 25%;" class="form-control" name="upload_image" id="upload_image">
                            <span>(Recommonded Dimension 750x500)</span>
                            <input type="hidden" name="picture" class="picture">
                            @if ($errors->has('picture'))
                                <span class="help-block"><strong>{{ $errors->first('picture') }}</strong></span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('pdf') ? ' has-error' : '' }}">
                            <label>PDF</label>
                            <input type="file" accept="application/pdf" style="width: 25%;" class="form-control" name="pdf">
                            @if ($errors->has('pdf'))
                                <span class="help-block"><strong>{{ $errors->first('pdf') }}</strong></span>
                            @endif
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary" style="color: #fff !important;" type="submit">Submit</button>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
   
              
             
            
            
             
          </div>
       </div>
    </div>
</section>

<!-- <style>
    #name_datalist .name_email, #email_datalist .name_email{
        text-overflow: ellipsis;
        display: inline-block;
        overflow: hidden;
        white-space: nowrap;
    }
    #name_datalist .name_email {
        width: 229px;
    }
    #email_datalist .name_email {
        width: 350px;
    }
    #name_datalist, #email_datalist {
        border:1px solid grey;
        padding:10px;
        overflow-y:scroll;
        height:auto;
        display: none;
        max-height: 300px;
    }
    .drop-wrapper ul li b {
        display: inline-block;
        text-overflow: ellipsis;
        /*width: 110px;*/
        overflow: hidden;
        white-space: nowrap;
        vertical-align: top;
    }
</style> -->
<!-- <script src="{{url('/assets/js/plugins/bootstrap.min.js')}}"></script>
<script src="{{url('/assets/js/pcoded.min.js')}}"></script>
<script src="{{url('/assets/js/menu-setting.js')}}"></script>
<script src="{{url('/assets/js/plugins/select2.full.min.js')}}"></script>
<script src="{{url('/assets/js/plugins/jquery.dataTables.min.js')}}"></script>
<script src="{{url('/assets/js/plugins/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{url('/assets/js/plugins/jquery.dataTables.min.js')}}"></script>
<script src="{{url('/assets/js/plugins/dataTables.bootstrap4.min.js')}}"></script> -->
<!-- <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script> -->
<!-- <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.css" rel="stylesheet"> -->
<!-- <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.js"></script> -->
<!-- <script src="{{ asset('js/tinymce/tinymce.min.js') }}"></script> -->
<div id="uploadimageModal" class="modal" role="dialog">
 <div class="modal-dialog" style="width:650px;">
  <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Upload & Crop Image</h4>
        </div>
        <div class="modal-body">
          <div class="row">
       <div class="col-md-12 text-center">
        <div id="image_demo" style="width:100%; margin-top:30px"></div>
       </div>
       <div class="col-md-12 text-center" style="padding-top:30px;">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button class="btn btn-success crop_image">Crop & Upload Image</button>
     </div>
    </div>
        </div>
        <div class="modal-footer">
        </div>
     </div>
    </div>
</div>
<link href="//cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.css" rel="stylesheet">
<script src="//cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.js"></script>
<script src="{{asset('public/js/crop/croppie.js')}}"></script>
<link rel="stylesheet" href="{{asset('public/js/crop/croppie.css')}}" />
<script>
    $('#body').summernote({
      placeholder: 'Share you ideas for our health professionals and vendors',
      height: 350
    });
    $(document).ready(function(event) {
        $image_crop = $('#image_demo').croppie({
            enableExif: true,
            viewport: {
              width:550,
              height:366.665,
              type:'square' //circle
            },
            boundary:{
              width:600,
              height:400
            }
          });
        $("#uploadimageModal").on("hidden.bs.modal", function () {
            $('#upload_image').val('');
        });
        $('#upload_image').on('change', function(){
            var reader = new FileReader();
            reader.onload = function (event) {
              $image_crop.croppie('bind', {
                url: event.target.result
              }).then(function(){
                console.log('jQuery bind complete');
              });
            }
            reader.readAsDataURL(this.files[0]);
            $('#uploadimageModal').modal({backdrop: 'static', keyboard: false});
        });
        $('.crop_image').click(function(event){
            $image_crop.croppie('result', {
              type: 'canvas',
              size: 'viewport'
            }).then(function(response){
                $('.picture').val(response);
                $('#uploadimageModal').modal('hide');
                if($('#upload_image').closest('div').find('img').length)
                    $('#upload_image').closest('div').find('img').remove();
                $('#upload_image').closest('div').append('<img src="'+response+'" class="img-responsive" />');
              /*$.ajax({
                url:"{{url('upload-vendor-images')}}",
                type: "POST",
                data:{"image": response},
                success:function(data)
                {
                  window.location.reload();
                }
              });*/
            })
        });
    });
    /*$(document).ready(function() {
          $('#body').summernote({
             placeholder: 'Share you ideas',
             height: 350
          });
        });*/
    /*tinymce.init({
      branding: false,
      menubar: false,
      statusbar: false,
      selector: 'textarea#body',  //Change this value according to your HTML
      auto_focus: 'element1',
      width: "100%",
      height: "500",
      setup : function(editor)  {
                editor.on("change keyup", function(e){
                    //console.log('saving');
                    //tinyMCE.triggerSave(); // updates all instances
                    editor.save(); // updates this instance's textarea
                    $(editor.getElement()).trigger('change'); // for garlic to detect change
                });
      }


    });*/
    
    // CKEDITOR.replace( 'body' );
    // CKEDITOR.replace( 'excerpt' );
</script>
@include('includes.footer')

@endsection