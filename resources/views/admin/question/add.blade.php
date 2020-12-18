@include('include/header');
<div class="pcoded-main-container">
    <div class="pcoded-content container">
        <div class="row">
            <div class="col-sm-12">
                <div class="row border-bottom mb-3">
                    <div class="col-sm-6 d-flex align-items-center mb-4">
                        <h1 class="d-inline-block font-weight-normal mb-0">Add FAQ Question</h1>
                    </div>
                    <div class="col-sm-6 d-block d-sm-flex align-items-center justify-content-end mb-4 text-right">
                        <a href="{{url('admin/admin-testimonials')}}" type="button" class="btn d-block ml-auto btn-primary"><i class="fa fa-backward"></i> &nbsp;Back</a>
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

                <form class="form-horizontal" method="POST" action="{{ url('admin/save_questions') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                    <div class="col-md-12 col-xl-12">                        
                        <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                            <label>Question</label>
                                <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}" placeholder="Example : How many guests can you accommodate in your event space?"  required>
                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                        </div>
                        <!-- show-first hide -->
                        <div class="form-group ">
                            <label>Frontend Label</label>
                            <input id="label_title" type="text" class="form-control" name="label_title" value="{{ old('label_title') }}" placeholder="Example : Maximum price per guest" required>
                        </div>
                        <div class="form-group {{ $errors->has('type') ? ' has-error' : '' }}">
                            <label>Type</label>
                                <div class="radio">
                                  <label><input type="radio" class="fq-type-handler" name="type" onclick="hide_additional();" value="text" style="display: inline-block !important;vertical-align: middle;" >Text</label>
                                </div>
                                <div class="radio">
                                  <label><input type="radio" class="fq-type-handler" name="type" onclick="hide_additional();" value="textarea" style="display: inline-block !important;vertical-align: middle;" >Textarea</label>
                                </div>
                                <div class="radio">
                                  <label><input type="radio" class="fq-type-handler" name="type" onclick="show_additional();" value="checkbox" style="display: inline-block !important;vertical-align: middle;" >Checkbox</label>
                                </div>
                                 <div class="radio">
                                  <label><input type="radio" class="fq-type-handler" name="type" onclick="show_additional();" value="radio" style="display: inline-block !important;vertical-align: middle;" >Radio</label>
                                </div>
                                <!--  <div class="radio">
                                  <label><input type="radio" name="type" value="date">Date</label>
                                </div> -->
                                @if ($errors->has('type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                @endif
                        </div>
                        <div class="form-group other-field hide" id="optional_fields">
                            <label>Add Option Fields *</label>    
                             <table class="table">
                                <thead>
                                  </thead>
                                  <tbody class="more-fields">
                                    <tr>
                                       <td><input type="text" name="options[]" id="options"  class="form-control" placeholder="Option Value"></td>
                                       <td><input type="number" name="orders[]" id="orders"  class="form-control" placeholder="Sequence Number"></td>
                                       <td><button type="button" id="add-more" onclick="addMoreRow();"  class="btn btn-primary btn-sm"><i class='fa fa-plus' style='font-size:20px;color:#FFF;cursor:pointer;'></i></button></td>
                                    </tr>
                                    <tr id="insertAfterId"></tr>
                                </tbody>
                            </table>                        
                        </div>
                        <div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
                            <label>Description (If Any)</label>
                                <textarea class="form-control" name="descriptions">{{ old('description') }}</textarea>
                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">Submit</button>
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
<style type="text/css">
    .hide {
        display: none !important;
    }
</style>
<script type="text/javascript">
    function show_additional(){
        $('#optional_fields').removeClass("hide");
    }
    function hide_additional(){
        $('#optional_fields').addClass("hide");
    }

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
            elem.innerHTML += "<td><input type='text' name='options[]' id='options'  class='form-control' placeholder='Option Value'></td><td><input type='number' name='orders[]' id='orders'  class='form-control' placeholder='Sequence Number'></td><td><button type='button' id='add-more' onclick='removeThis("+counter+");'  class='btn btn-danger btn-sm'><i class='fa fa-times-circle' style='font-size:20px;color:#FFF;cursor:pointer;'></i></button></td>";
            $(elem).insertBefore("#insertAfterId");
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