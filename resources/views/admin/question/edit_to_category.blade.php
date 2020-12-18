@include('include/header');
<div class="pcoded-main-container">
    <div class="pcoded-content container">

        @php 
               $includeCatId = array();
               if(isset($assign_questions) && !empty($assign_questions)){
                  $includeCatId = array_column(@$assign_questions,'cat_id');
               }
        @endphp
        <div class="row">
            <div class="col-sm-12">
                <div class="row border-bottom mb-3">
                    <div class="col-sm-6 d-flex align-items-center mb-4">
                        <h1 class="d-inline-block font-weight-normal mb-0">Edit to Category</h1>
                    </div>
                    <div class="col-sm-6 d-block d-sm-flex align-items-center justify-content-end mb-4 text-right">
                        <a href="{{url('admin/questions')}}" type="button" class="btn d-block ml-auto btn-primary"><i class="fa fa-backward"></i> &nbsp;Back</a>
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

                <form class="form-horizontal" method="POST" action="{{ url('admin/edit-to-category') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="col-md-12 col-xl-12">                    
                     <div class="form-group {{ $errors->has('question_id') ? ' has-error' : '' }}">
                            <label>Question</label>
                              <select name="question_id" class="form-control">
                                 <option value="">-- Select Option --</option>
                                 @if(isset($questions) && !empty($questions)):
                                    @foreach($questions as $ques)
                                     <option value="{{$ques->id}}" <?php echo ($ques_id == $ques->id)?'selected':''; ?>>{{$ques->title}}</option>
                                    @endforeach
                                 @endif
                              </select>
                                @if ($errors->has('question_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('question_id') }}</strong>
                                    </span>
                                @endif
                     </div>
                     <div class="form-group {{ $errors->has('cat_id') ? ' has-error' : '' }}">
                            <label>Category</label>
                            <div>
                                <select name="cat_id[]" class="form-control select2-hidden-accessible" id="mlt-checked-select" multiple data-select2-id="mlt-checked-select" tabindex="-1" aria-hidden="true">
                                     <!-- <option value="">-- Select Option --</option> -->
                                     @if(isset($categories) && !empty($categories)):
                                        @foreach($categories as $ques)
                                            <option value="{{$ques->id}}" @php if(in_array($ques->id, $includeCatId)){ echo"selected='selected' data-select2-id='".$ques->id."'";} @endphp ><b>{{$ques->title}}</b> ({{$ques->parent_title}})</option>
                                        @endforeach
                                     @endif
                                </select>
                            </div>
                                @if ($errors->has('cat_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('cat_id') }}</strong>
                                    </span>
                                @endif
                     </div>                    
                     <div class="form-group">
                            <label>Sequence number</label>
                            <input id="sequence_number" type="number" class="form-control" name="sequence_number" value="{{ (@$assign_questions[0]['sequence_number'] !== 'null')?@$assign_questions[0]['sequence_number']:'' }}">
                     </div>
                     <div class="form-group {{ $errors->has('is_mandatory') ? ' has-error' : '' }}">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" style="display: inline-block !important;vertical-align: middle;" class="fq-type-handler" name="is_mandatory" value="text{{@$assign_questions[0]['is_mandatory']}}" <?php echo (@$assign_questions[0]['is_mandatory'] == 1)?'checked':''; ?> >
                                Mandatory
                            </label>
                        </div>                             
                        @if ($errors->has('is_mandatory'))
                            <span class="help-block">
                                <strong>{{ $errors->first('is_mandatory') }}</strong>
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
<script>
    $("#mlt-select").select2();
    $("#mlt-checked-select").select2();
    $(document).ready(function(){
        $("ul.select2-selection__rendered").css('width', '1033px');
        $("ul.select2-results__options").css('width', '1033px');
        $(".select2-container").css('width', '1033px');
    });
</script>
@@include('./include/footer.php')
</body>
</html>