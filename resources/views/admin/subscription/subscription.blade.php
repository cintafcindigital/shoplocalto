@include('include/header')
<style>
.help-block {
    color: #ff0b37;
}
</style>
<div class="pcoded-main-container">
    <div class="pcoded-content container">
        <div class="row">
            <div class="col-sm-12">
                <div class="row border-bottom mb-3">
                    <div class="col-sm-12 align-items-center mb-4">
                        <h1 class="font-weight-normal mb-0">Subscription Details
                            <button class="hideShow float-right"></button>
                        </h1>
                    </div>
                </div>
                @if(session()->has('success'))
                    <div class="alert alert-info alert-dismissible fade show">{{ session()->get('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="row">
                    <div class="col-md-12 col-xl-12 eForm">
                        <h2 class="font-weight-normal mb-3">Add Subscription</h2>
                        <form method="POST" action="{{url('admin/save_subscription')}}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="col-xl-12 form-group" style="display:inline-flex;padding:0px;">
                                <div class="col-xl-6 {{$errors->has('type') ? ' has-error' : ''}}">
                                    <label>Subscription Type <span style="color:#ff0b37;"> *</span></label>
                                    <input type="text" class="form-control" name="type" value="{{old('type')}}" autofocus>
                                    @if($errors->has('type'))
                                        <span class="help-block"><strong>{{$errors->first('type')}}</strong></span>
                                    @endif
                                </div>
                                <div class="col-xl-3 {{$errors->has('amount') ? ' has-error' : ''}}">
                                    <label>Subscription Amount <span style="color:#ff0b37;"> *</span></label>
                                    <input type="text" class="form-control" name="amount" value="{{old('amount')}}">
                                    @if($errors->has('amount'))
                                        <span class="help-block"><strong>{{$errors->first('amount')}}</strong></span>
                                    @endif
                                </div>
                                <div class="col-xl-3 {{$errors->has('duration') ? ' has-error' : ''}}">
                                    <label>Subscription Duration</label>
                                    <select class="form-control" name="duration">
                                        <option>1 Month</option>
                                        <option>3 Months</option>
                                        <option>6 Months</option>
                                        <option>1 Year</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-12 form-group" style="display:inline-flex;padding:0px;">
                                <div class="col-xl-6">
                                    <label>Image <span style="color:#ff0b37;"> *</span></label>
                                    <div class="mb-3">
                                        <!-- <input type="file" name="image" value="{{old('image')}}" class="form-control"> -->
                                        @include('includes.image-crop-4',['name' => 'image','width' => 350,'height' => 350])

                                    </div>
                                    @if($errors->has('image'))
                                        <span class="help-block"><strong>{{ $errors->first('image') }}</strong></span>
                                    @endif
                                </div>
                                <div class="col-xl-6">
                                    <label>Promocode</label>
                                    <div class="mb-3">
                                        <label class="form-control" style="cursor: pointer;"><input type="checkbox" name="is_promocode" value="1" {{old('is_promocode') == '1' ? 'checked' : ''}}> Is Promocode </label>
                                    </div>
                                    @if($errors->has('is_promocode'))
                                        <span class="help-block"><strong>{{ $errors->first('is_promocode') }}</strong></span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-xl-12 form-group border-bottom" style="display:inline-flex;padding:0px;">
                                <div class="col-xl-1"><label>S.No.</label></div>
                                <div class="col-xl-2"><label>Features Favour</label></div>
                                <div class="col-xl-9">
                                    <label>Add Subscription Features <span style="color:#ff0b37;"> ( All Required * )</span></label>
                                </div>
                            </div>
                            <div class="col-xl-12 form-group" style="display:inline-flex;padding:0px;">
                                <div class="col-xl-1"><div class="mb-3">1. </div></div>
                                <div class="col-xl-2">
                                    <div class="mb-3">
                                        <input type="radio" name="feature1_favour" value="1" checked><b style="color:#00b90c;"> Pros</b>
                                        &nbsp; <input type="radio" name="feature1_favour" value="0"><b style="color:#ff0b37;"> Cons</b>
                                    </div>
                                </div>
                                <div class="col-xl-9 {{$errors->has('feature_1') ? ' has-error' : ''}}">
                                    <input type="text" class="form-control" name="feature_1" value="{{old('feature_1')}}">
                                    @if($errors->has('feature_1'))
                                        <span class="help-block"><strong>{{$errors->first('feature_1')}}</strong></span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-xl-12 form-group" style="display:inline-flex;padding:0px;">
                                <div class="col-xl-1">
                                    <div class="mb-3">2. </div>
                                </div>
                                <div class="col-xl-2">
                                    <div class="mb-3">
                                        <input type="radio" name="feature2_favour" value="1" checked><b style="color:#00b90c;"> Pros</b>
                                        &nbsp; <input type="radio" name="feature2_favour" value="0"><b style="color:#ff0b37;"> Cons</b>
                                    </div>
                                </div>
                                <div class="col-xl-9 {{$errors->has('feature_2') ? ' has-error' : ''}}">
                                    <input type="text" class="form-control" name="feature_2" value="{{old('feature_2')}}">
                                    @if($errors->has('feature_2'))
                                        <span class="help-block"><strong>{{$errors->first('feature_2')}}</strong></span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-xl-12 form-group" style="display:inline-flex;padding:0px;">
                                <div class="col-xl-1">
                                    <div class="mb-3">3. </div>
                                </div>
                                <div class="col-xl-2">
                                    <div class="mb-3">
                                        <input type="radio" name="feature3_favour" value="1" checked><b style="color:#00b90c;"> Pros</b>
                                        &nbsp; <input type="radio" name="feature3_favour" value="0"><b style="color:#ff0b37;"> Cons</b>
                                    </div>
                                </div>
                                <div class="col-xl-9 {{$errors->has('feature_3') ? ' has-error' : ''}}">
                                    <input type="text" class="form-control" name="feature_3" value="{{old('feature_3')}}">
                                    @if($errors->has('feature_3'))
                                        <span class="help-block"><strong>{{$errors->first('feature_3')}}</strong></span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-xl-12 form-group" style="display:inline-flex;padding:0px;">
                                <div class="col-xl-1">
                                    <div class="mb-3">4. </div>
                                </div>
                                <div class="col-xl-2">
                                    <div class="mb-3">
                                        <input type="radio" name="feature4_favour" value="1" checked><b style="color:#00b90c;"> Pros</b>
                                        &nbsp; <input type="radio" name="feature4_favour" value="0"><b style="color:#ff0b37;"> Cons</b>
                                    </div>
                                </div>
                                <div class="col-xl-9 {{$errors->has('feature_4') ? ' has-error' : ''}}">
                                    <input type="text" class="form-control" name="feature_4" value="{{old('feature_4')}}">
                                    @if($errors->has('feature_4'))
                                        <span class="help-block"><strong>{{$errors->first('feature_4')}}</strong></span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-xl-12 form-group" style="display:inline-flex;padding:0px;">
                                <div class="col-xl-1">
                                    <div class="mb-3">5. </div>
                                </div>
                                <div class="col-xl-2">
                                    <div class="mb-3">
                                        <input type="radio" name="feature5_favour" value="1" checked><b style="color:#00b90c;"> Pros</b>
                                        &nbsp; <input type="radio" name="feature5_favour" value="0"><b style="color:#ff0b37;"> Cons</b>
                                    </div>
                                </div>
                                <div class="col-xl-9 {{$errors->has('feature_5') ? ' has-error' : ''}}">
                                    <input type="text" class="form-control" name="feature_5" value="{{old('feature_5')}}">
                                    @if($errors->has('feature_5'))
                                        <span class="help-block"><strong>{{$errors->first('feature_5')}}</strong></span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Add Subscription</button>
                            </div>
                        </form>
                    </div>
                    @if(count($subscription) > 0)
                    <div class="col-md-12 col-xl-12">
                        <div class="panel panel-default">
                            <div class="panel-heading my-3">
                                <h2 class="d-inline-block font-weight-normal mb-0">Active Subscription List</h2>
                            </div>
                            <div class="panel-body">
                                <table class="table table-striped task-table">
                                    <thead>
                                        <th>Type</th>
                                        <th>Amount</th>
                                        <th>Duration</th>
                                        <th>Image</th>
                                        <th>Features</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        @foreach($subscription as $subs)
                                        <tr>
                                            <td class="table-text" width="15%"><div>{{$subs->type}}</div></td>
                                            <td class="table-text" width="10%"><div>{{$subs->amount}}</div></td>
                                            <td class="table-text" width="15%"><div>{{$subs->duration}}</div></td>
                                            <td class="table-text" width="15%">
                                                <a href="{{url('public/subscription/'.$subs->image)}}" target="blank">
                                                    <img src="{{url('public/subscription/'.$subs->image)}}" width="150">
                                                </a>
                                            </td>
                                            <td class="table-text" width="35%">
                                                <div>@if($subs->feature1_favour == 0)
                                                        <i class="fa fa-times" style="color:#ff0b37;width:15px;"></i>
                                                    @else
                                                        <i class="fa fa-check" style="color:#00b90c;width:15px;"></i>
                                                    @endif
                                                    {{substr($subs->feature_1,0,45)}}
                                                </div>
                                                <div>@if($subs->feature2_favour == 0)
                                                        <i class="fa fa-times" style="color:#ff0b37;width:15px;"></i>
                                                    @else
                                                        <i class="fa fa-check" style="color:#00b90c;width:15px;"></i>
                                                    @endif
                                                    {{substr($subs->feature_2,0,45)}}
                                                </div>
                                                <div>@if($subs->feature3_favour == 0)
                                                        <i class="fa fa-times" style="color:#ff0b37;width:15px;"></i>
                                                    @else
                                                        <i class="fa fa-check" style="color:#00b90c;width:15px;"></i>
                                                    @endif
                                                    {{substr($subs->feature_3,0,45)}}
                                                </div>
                                                <div>@if($subs->feature4_favour == 0)
                                                        <i class="fa fa-times" style="color:#ff0b37;width:15px;"></i>
                                                    @else
                                                        <i class="fa fa-check" style="color:#00b90c;width:15px;"></i>
                                                    @endif
                                                    {{substr($subs->feature_4,0,45)}}
                                                </div>
                                                <div>@if($subs->feature5_favour == 0)
                                                        <i class="fa fa-times" style="color:#ff0b37;width:15px;"></i>
                                                    @else
                                                        <i class="fa fa-check" style="color:#00b90c;width:15px;"></i>
                                                    @endif
                                                    {{substr($subs->feature_5,0,45)}}
                                                </div>
                                            </td>
                                            <td width="10%">
                                                <a href="{{url('admin/edit-subscription/'.$subs->id)}}"><i class="fa fa-btn fa-edit"></i></a> &nbsp; &nbsp;
                                                <!-- <a href="{{url('admin/edit-subscription/'.$subs->id)}}"><i class="fa fa-btn fa-edit"></i></a> &nbsp; &nbsp; -->
                                                <form action="{{url('admin/delete_subscription/'.$subs->id)}}" method="POST" style="display:inline-block;">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                                                    <button type="submit" onclick="javascript:return confirm('Do you want to delete this subscription ?');" class="btn btn-danger btn-sm" title="Delete">
                                                        <i class="fa fa-btn fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="col-md-12 col-xl-12">
                        <div class="panel panel-default">
                            <div class="panel-heading my-3">
                                <h2 class="text-center" style="color:#ff0b37;">No Subscription Found !!</h2>
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
<script>
$(document).ready(function() {
    setTimeout(function(){
        $('.help-block').fadeOut(3000);
        $('.alert-dismissible').fadeOut(3000);
        //// Show & Hide button......
        $('.hideShow').addClass('btn btn-dark');
        $('.hideShow').html('<i class="fa fa-eye-slash"></i> &nbsp; Hide Subscription Form');
    }, 1000);
    $('.hideShow').click(function(){
        if($('.eForm').hasClass('d-none')) {
            $('.eForm').removeClass('d-none');
            $('.hideShow').html('<i class="fa fa-eye-slash"></i> &nbsp; Hide Subscription Form');
        } else {
            $('.eForm').addClass('d-none');
            $('.hideShow').html('<i class="fa fa-eye"></i> &nbsp; Show Subscription Form');
        }
    });
});
</script>
</body>
</html>