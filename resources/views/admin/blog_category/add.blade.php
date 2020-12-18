@include('include/header');

<div class="pcoded-main-container">

    <div class="pcoded-content container">

        <div class="row">

            <div class="col-sm-12">

                <div class="row border-bottom mb-3">

                    <div class="col-sm-6 d-flex align-items-center mb-4">

                        <h1 class="d-inline-block font-weight-normal mb-0">Add New Blog Category</h1>

                    </div>

                    <div class="col-sm-6 d-block d-sm-flex align-items-center justify-content-end mb-4 text-right">

                        <a href="{{url('admin/blog-category')}}" type="button" class="btn d-block ml-auto btn-primary"><i class="fa fa-backward"></i> &nbsp;Back</a>

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

                            <label>Category Name</label>

                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}"  autofocus>

                            @if ($errors->has('name'))

                                <span class="help-block"><strong>{{ $errors->first('name') }}</strong></span>

                            @endif

                        </div>

                        <div class="form-group {{ $errors->has('meta_title') ? ' has-error' : '' }}">

                            <label>Meta Title</label>

                            <input id="meta_title" type="text" class="form-control" name="meta_title" value="{{ old('meta_title') }}"  autofocus>

                            @if ($errors->has('meta_title'))

                                <span class="help-block"><strong>{{ $errors->first('meta_title') }}</strong></span>

                            @endif

                        </div>

                        <div class="form-group {{ $errors->has('meta_keywords') ? ' has-error' : '' }}">

                            <label>Meta Keywords</label>

                            <input id="meta_keywords" type="text" class="form-control" name="meta_keywords" value="{{ old('meta_keywords') }}"  autofocus>

                            @if ($errors->has('meta_keywords'))

                                <span class="help-block"><strong>{{ $errors->first('meta_keywords') }}</strong></span>

                            @endif

                        </div>

                        <div class="form-group {{ $errors->has('meta_descr') ? ' has-error' : '' }}">

                            <label>Meta Description</label>

                            <input id="meta_descr" type="text" class="form-control" name="meta_descr" value="{{ old('meta_descr') }}"  autofocus>

                            @if ($errors->has('meta_descr'))

                                <span class="help-block"><strong>{{ $errors->first('meta_descr') }}</strong></span>

                            @endif

                        </div>

                        <div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">

                            <label>Description</label>

                            <textarea id="description" type="text" class="form-control" name="description" autofocus>{{ old('description') }}</textarea>

                            @if ($errors->has('description'))

                                <span class="help-block"><strong>{{ $errors->first('description') }}</strong></span>

                            @endif

                        </div>

                        <div class="form-group {{ $errors->has('picture') ? ' has-error' : '' }}">

                            <label>Picture</label>

                            <span>(362px x 200px)</span>

                            <!-- <input id="picture" type="file" class="form-control" name="picture" value="{{ old('picture') }}"  autofocus> -->

                            @include('includes.image-crop-4',['name' => 'picture','width' => 633.5,'height' => 350])

                            @if ($errors->has('picture'))

                                <span class="help-block"><strong>{{ $errors->first('picture') }}</strong></span>

                            @endif

                        </div>

                       

                        <div class="form-group {{ $errors->has('is_active') ? ' has-error' : '' }}">

                            <label><input type="checkbox" checked name="is_active" value="1"> Active</label>

                            @if ($errors->has('is_active'))

                                <span class="help-block"><strong>{{ $errors->first('is_active') }}</strong></span>

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

<script>

var counter = 1;

function addMoreRow() {

    counter++;

    if(counter > 10) {

        counter--;

        alert('You cannot add more than '+counter+' Images & Description');

        return false;

    } else {

        var elem = document.createElement('tr');

        elem.setAttribute("id","tdRow"+counter);

        elem.innerHTML += "<td class='srNoCls'><b>"+counter+".</b></td><td><input type='file' name='categoryImage[]''></td><td style='padding:5px;'><textarea name='categoryDescription[]' class='form-control' style='border-radius:5px;'></textarea></td><td onclick='removeThis("+counter+");'><i class='fa fa-times-circle' style='font-size:20px;color:red;cursor:pointer;padding:0px 5px'></i></td>";

        $(elem).insertBefore("#insertBeforeId");

    }

}

function removeThis(id) {

    if(id) {

        $('#tdRow'+id).remove();

        counter--;

        var imgNum = 0;

        $('.srNoCls').each(function(){

            imgNum++;

            $(this).html('<b>'+imgNum+'.</b>');

        });

    }

}

</script>

@@include('./include/footer.php')

</body>

</html>