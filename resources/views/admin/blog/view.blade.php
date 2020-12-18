@include('include/header');

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

    label {

        color: #000;

        border-bottom: 1px solid #ddd;

        width: 100%;

    }

    p {

        color: #000;

    }

</style>

<div class="pcoded-main-container">

    <div class="pcoded-content container">

        <div class="row">

            <div class="col-sm-12">

                <div class="row border-bottom mb-3">

                    <div class="col-sm-6 d-flex align-items-center mb-4">

                        <h1 class="d-inline-block font-weight-normal mb-0">Post View</h1>

                    </div>

                    <div class="col-sm-6 d-block d-sm-flex align-items-center justify-content-end mb-4 text-right">

                        <a href="{{url()->previous()}}" type="button" class="btn d-block ml-auto btn-primary"><i class="fa fa-backward"></i> &nbsp;Back</a>

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

                @if(count($errors) > 0 || session()->has('error'))

                <div class="alert alert-danger alert-dismissible fade show">

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

                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>

                </div>

                @endif



                <form class="form-horizontal" method="POST" action="{{ url()->current() }}" enctype="multipart/form-data">

                {{ csrf_field() }}

                <div class="row">

                    <div class="col-md-12 col-xl-12">

                        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">

                            <label>Name Or Titile</label>

                            <h1 style="color: #000">{{$blog->name}}</h1>

                            <!-- <input id="name" type="text" class="form-control" name="name" value="{{ old('name') == '' ? $blog->name : old('name') }}"  autofocus> -->

                            @if ($errors->has('name'))

                                <span class="help-block"><strong>{{ $errors->first('name') }}</strong></span>

                            @endif

                        </div>

                        <div class="form-group {{ $errors->has('excerpt') ? ' has-error' : '' }}">

                            <label>Excerpt</label>

                            <p>{!! $blog->excerpt !!}</p>

                            <!-- <textarea class="form-control" rows="5" id="excerpt" name="excerpt">{{old('excerpt') == '' ? $blog->excerpt : old('excerpt')}}</textarea> -->

                            @if ($errors->has('excerpt'))

                                <span class="help-block"><strong>{{ $errors->first('excerpt') }}</strong></span>

                            @endif

                        </div>

                        <div class="form-group {{ $errors->has('body') ? ' has-error' : '' }}">

                            <label>Post Body</label>

                            {!! $blog->body !!}

                            <!-- <textarea class="form-control" id="body" rows="5" name="body">{{old('body') == '' ? $blog->body : old('body')}}</textarea> -->

                            @if($errors->has('body'))

                                <span class="help-block"><strong>{{ $errors->first('body') }}</strong></span>

                            @endif

                        </div>

                        <div class="form-group {{ $errors->has('meta_title') ? ' has-error' : '' }}">

                            <label>Meta Title</label>

                            <h3>{{$blog->meta_title}}</h3>

                            <!-- <input id="meta_title" type="text" class="form-control" name="meta_title" value="{{ empty(old('meta_title')) ? $blog->meta_title : old('meta_title') }}"  autofocus> -->

                            @if ($errors->has('meta_title'))

                                <span class="help-block"><strong>{{ $errors->first('meta_title') }}</strong></span>

                            @endif

                        </div>

                        <div class="form-group {{ $errors->has('meta_keywords') ? ' has-error' : '' }}">

                            <label>Meta Keywords</label>

                            <h5>{{$blog->meta_keywords}}</h5>

                            <!-- <input id="meta_keywords" type="text" class="form-control" name="meta_keywords" value="{{ empty(old('meta_keywords')) ? $blog->meta_keywords : old('meta_keywords') }}"  autofocus> -->

                            @if ($errors->has('meta_keywords'))

                                <span class="help-block"><strong>{{ $errors->first('meta_keywords') }}</strong></span>

                            @endif

                        </div>

                        <div class="form-group {{ $errors->has('meta_descr') ? ' has-error' : '' }}">

                            <label>Meta Description</label>

                            <p>{{$blog->meta_description}}</p>

                            <!-- <input id="meta_descr" type="text" class="form-control" name="meta_descr" value="{{ empty(old('meta_descr')) ? $blog->meta_description : old('meta_descr') }}"  autofocus> -->

                            @if ($errors->has('meta_descr'))

                                <span class="help-block"><strong>{{ $errors->first('meta_descr') }}</strong></span>

                            @endif

                        </div>

                        <div class="form-group {{ $errors->has('category_id') ? ' has-error' : '' }}">

                            <label>Category</label>

                            <h3>{{$blog->categories->name}}</h3>

                            
                            @if ($errors->has('category_id'))

                                <span class="help-block"><strong>{{ $errors->first('category_id') }}</strong></span>

                            @endif

                        </div>

                        <div class="form-group {{ $errors->has('published') ? ' has-error' : '' }}">

                            <label class="container-ul" style="font-size: 17px;font-weight: normal;"><input type="checkbox" name="published" disabled {{old('published') == '' ? ($blog->published ? 'checked' : '') : 'checked'}} value="1"> Publish <span class="checkmark"></span></label>

                            @if ($errors->has('published'))

                                <span class="help-block"><strong>{{ $errors->first('published') }}</strong></span>

                            @endif

                        </div>

                        <div class="form-group {{ $errors->has('picture') ? ' has-error' : '' }}">

                            <label>Picture</label>

                            @if($blog->picture != null)

                            <img src="{{url('public/images/blogs').'/'.$blog->picture}}" class="img-responsive" width="150px"><br>

                            @endif

                           

                            @if ($errors->has('picture'))

                                <span class="help-block"><strong>{{ $errors->first('picture') }}</strong></span>

                            @endif

                        </div>

                        @if(!empty($blog->pdf))

                        <div class="form-group {{ $errors->has('pdf') ? ' has-error' : '' }}">

                            <label>Pdf</label>

                            @if(!empty($blog->pdf))

                                <a href="{{url('public/images/blogs').'/'.$blog->pdf}}" target="_blank" class="btn btn-info"><i class="fa fa-eye"></i> View PDF</a>

                            @endif

                           
                            @if ($errors->has('pdf'))

                                <span class="help-block"><strong>{{ $errors->first('pdf') }}</strong></span>

                            @endif

                        </div>

                        @endif

                        <div class="form-group">

                            @php $status = ($blog->approved==1)?0:1 @endphp

                            <a title="<?php echo $status==1?'Disapproved':'Approved'; ?>" class="btn <?php echo $status==1?'btn-danger':'btn-success'; ?>" onclick="javascript:return confirm('Do you want to {{$status == 1 ? 'approve' : 'disapprove'}} this blog ?');" href="{{url('admin/blog-approve')}}/{{$blog->id}}/{{$status}}">

                                <?php echo ($status==0)?'<i class="fa fa-thumbs-up"></i>':'<i class="fa fa-thumbs-down"></i>'; ?>

                            </a>

                            

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

<script src="{{ asset('js/tinymce/tinymce.min.js') }}"></script>

<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.css" rel="stylesheet">

<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.js"></script>

<script>

   

    tinymce.init({

      branding: false,

      menubar: false,

      statusbar: false,

      selector: 'textarea#body',  //Change this value according to your HTML

      auto_focus: 'element1',

      width: "100%",

      height: "500",

      setup : function(editor)  {

                editor.on("change keyup", function(e){

                   

                    editor.save(); // updates this instance's textarea

                    $(editor.getElement()).trigger('change'); // for garlic to detect change

                });

      }





    });

    tinymce.init({

      branding: false,

      menubar: false,

      statusbar: false,

      selector: 'textarea#excerpt',  //Change this value according to your HTML

      auto_focus: 'element1',

      width: "100%",

      height: "250",

      setup : function(editor)  {

                editor.on("change keyup", function(e){

                    //console.log('saving');

                    //tinyMCE.triggerSave(); // updates all instances

                    editor.save(); // updates this instance's textarea

                    $(editor.getElement()).trigger('change'); // for garlic to detect change

                });

      }

    });

    // CKEDITOR.replace( 'body' );

    // CKEDITOR.replace( 'excerpt' );

</script>

@@include('./include/footer.php')

</body>

</html>