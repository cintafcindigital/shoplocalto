@include('include/header');
<div class="pcoded-main-container">
    <div class="pcoded-content container">
        <div class="row">
            <div class="col-sm-12">
                <div class="row border-bottom mb-3">
                    <div class="col-sm-6 d-flex align-items-center mb-4">
                        <h1 class="d-inline-block font-weight-normal mb-0">Add New Category</h1>
                    </div>
                    <div class="col-sm-6 d-block d-sm-flex align-items-center justify-content-end mb-4 text-right">
                        <a href="{{url('admin/categories')}}" type="button" class="btn d-block ml-auto btn-primary"><i class="fa fa-backward"></i> &nbsp;Back</a>
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

                <form class="form-horizontal" method="POST" action="{{ url('/admin/save_category') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-12 col-xl-12">
                        <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                            <label>Title</label>
                            <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}"  autofocus>
                            @if ($errors->has('title'))
                                <span class="help-block"><strong>{{ $errors->first('title') }}</strong></span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('parent_id') ? ' has-error' : '' }}">
                            <label>Parent Category</label>
                            <select class="form-control" name="parent_id">
                                <option value="">-- Select Parent Category --</option>
                                @if(isset($cats) && !empty($cats))
                                    @foreach($cats as $cat)
                                        <option value="{{$cat['id']}}">{{$cat['title']}}</option>
                                    @endforeach
                                @endif
                            </select>
                            @if ($errors->has('parent_id'))
                                <span class="help-block"><strong>{{ $errors->first('parent_id') }}</strong></span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('is_parent') ? ' has-error' : '' }}">
                            <input type="checkbox" name="is_parent" value="1"> <label>Make Parent</label>
                            @if ($errors->has('is_parent'))
                                <span class="help-block"><strong>{{ $errors->first('is_parent') }}</strong></span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('is_professionals') ? ' has-error' : '' }}">
                            <input type="checkbox" name="is_professionals" value="1" @if(old('is_professionals') == '1') checked @endif @if($is_errors == false) checked @endif> <label>Show in home</label>
                            @if ($errors->has('is_professionals'))
                                <span class="help-block"><strong>{{ $errors->first('is_professionals') }}</strong></span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('meta_title') ? ' has-error' : '' }}">
                            <label>Meta Title</label>
                            <input id="meta_title" type="text" class="form-control" name="meta_title" value="{{ old('meta_title') }}"  autofocus>
                            @if ($errors->has('meta_title'))
                                <span class="help-block"><strong>{{ $errors->first('meta_title') }}</strong></span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('meta_keyword') ? ' has-error' : '' }}">
                            <label>Meta Keywords</label>
                            <input id="meta_keyword" type="text" class="form-control" name="meta_keyword" value="{{ old('meta_keyword') }}" autofocus>
                            @if ($errors->has('meta_keyword'))
                                <span class="help-block"><strong>{{ $errors->first('meta_keyword') }}</strong></span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('meta_description') ? ' has-error' : '' }}">
                            <label>Meta Description</label>
                            <input id="meta_description" type="text" class="form-control" name="meta_description" value="{{ old('meta_description') }}"  autofocus>
                            @if ($errors->has('meta_description'))
                                <span class="help-block"><strong>{{ $errors->first('meta_description') }}</strong></span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('icon') ? ' has-error' : '' }}">
                            <label>Icon Image</label>
                            <!-- <input id="icon" type="file" required class="form-control" name="icon" value="{{ old('icon') }}"> -->
                            @include('includes.image-crop-4',['name' => 'icon','width' => 275,'height' => 275])

                            @if ($errors->has('icon'))
                                <span class="help-block"><strong>{{ $errors->first('icon') }}</strong></span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
                            <label>Description</label>
                            <textarea  name="description" id="description" data-validation-error-msg="Description is " data-validation="" class="form-control">{{ old('description') }}</textarea>
                            @if ($errors->has('description'))
                                <span class="help-block"><strong>{{ $errors->first('description') }}</strong></span>
                            @endif
                            
                        </div>
                        <div class="form-group {{ $errors->has('search_keywords') ? ' has-error' : '' }}">
                            <label>Search Keywords</label>
                            <textarea class="form-control" name="search_keywords" rows="8">{{old('search_keywords')}}</textarea>
                            @if ($errors->has('search_keywords'))
                                <span class="help-block"><strong>{{ $errors->first('search_keywords') }}</strong></span>
                            @endif
                        </div>
                        <div class="form-group ">
                            <table width="100%">
                                <thead class="mb-3">
                                    <tr>
                                        <th width="5%"> # </th>
                                        <th width="25%">Category Image Upload</th>
                                        <th width="70%" style="padding-left:5px;">Category Description</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr id="tdRow1">
                                        <td class="srNoCls"><b>1.</b></td>
                                        <td>
                                            <!-- <input type="file" name="categoryImage[]" style="width:218px;"> -->
                                            <span>(275px x 160px)</span>
                                            @include('includes.image-crop-4',['name' => 'categoryImage','width' => 618.75,'height' => 360])
                                        </td>
                                        <td style="padding:5px;"><textarea name="categoryDescription" class="form-control" style="border-radius:5px;"></textarea></td>
                                    </tr>
                                    <tr id="insertBeforeId">
                                        <td colspan="3" align="center">
                                            <!-- <a href="javascript:;" onclick="addMoreRow();" style="font-size:16px;border:2px solid grey;padding:5px;border-radius:20px;color:#008a06;">
                                                <i class="fa fa-plus-circle" style="color:#008a06;padding:10px 0px"></i> Add More
                                            </a> -->
                                            <!-- <a href="javascript:;" onclick="addMoreRow();" class="btn btn-success mt-3">
                                                <i class="fa fa-plus-circle"></i> &nbsp;Add More
                                            </a> -->
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
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