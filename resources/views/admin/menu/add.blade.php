@include('include/header');
<div class="pcoded-main-container">
    <div class="pcoded-content container">
        <div class="row">
            <div class="col-sm-12">
                <div class="row border-bottom mb-3">
                    <div class="col-sm-6 d-flex align-items-center mb-4">
                        <h1 class="d-inline-block font-weight-normal mb-0">@if(!isset($menu)) Add New Menu @else Update Menu @endif</h1>
                    </div>
                    <div class="col-sm-6 d-block d-sm-flex align-items-center justify-content-end mb-4 text-right">
                        <a href="{{url('admin/manage-menus')}}" type="button" class="btn d-block ml-auto btn-primary"><i class="fa fa-backward"></i> &nbsp;Back</a>
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
                @if(session()->has('error'))
                    <div class="alert alert-danger alert-dismissible fade show">{{ session()->get('error') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @php 
                    $is_errors = false;
                @endphp
                @if(count($errors) > 0)
                <div class="alert alert-danger alert-dismissible fade show">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>@foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @php 
                                $is_errors = true;
                            @endphp
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
                            <label>Name</label>
                            <input id="title" type="text" class="form-control" name="name" value="{{ old('name',isset($menu)?$menu->name:'') }}"  autofocus>
                            @if ($errors->has('name'))
                                <span class="help-block"><strong>{{ $errors->first('name') }}</strong></span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('parent_id') ? ' has-error' : '' }}">
                            <label>Parent Menu</label>
                            <select class="form-control" name="parent_id">
                                <option value="">-- Select Parent Menu --</option>
                                @if(isset($menus) && !empty($menus))
                                    @foreach($menus as $menuss)
                                        <option value="{{$menuss->id}}" @if(isset($menu) && ($menu->parent_id==$menuss->id)) selected @endif>{{$menuss->name}}</option>
                                    @endforeach
                                @endif
                            </select>
                            @if ($errors->has('parent_id'))
                                <span class="help-block"><strong>{{ $errors->first('parent_id') }}</strong></span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('link') ? ' has-error' : '' }}">
                            <label>Link</label>
                            <input id="link" type="text" class="form-control" name="link" value="{{ old('link',isset($menu)?$menu->link:'') }}"  autofocus>
                            @if ($errors->has('link'))
                                <span class="help-block"><strong>{{ $errors->first('link') }}</strong></span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('level') ? ' has-error' : '' }}">
                            <label>Level</label>
                            <input id="level" type="number" class="form-control" name="level" value="{{ old('level',isset($menu)?$menu->level:'') }}"  autofocus>
                            @if ($errors->has('level'))
                                <span class="help-block"><strong>{{ $errors->first('level') }}</strong></span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('displayorder') ? ' has-error' : '' }}">
                            <label>Display Order</label>
                            <input id="display_order" type="number" class="form-control" name="displayorder" value="{{ old('displayorder',isset($menu)?$menu->display_order:'') }}" autofocus>
                            @if ($errors->has('displayorder'))
                                <span class="help-block"><strong>{{ $errors->first('displayorder') }}</strong></span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('status') ? ' has-error' : '' }}">

                            <label><input type="checkbox" checked name="status" value="1"> Active</label>

                            @if ($errors->has('status'))

                                <span class="help-block"><strong>{{ $errors->first('status') }}</strong></span>

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
        CKEDITOR.replace( 'description' );
</script>
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