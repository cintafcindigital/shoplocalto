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
                        <h1 class="font-weight-normal mb-0">Update Subscription
                            <a href="{{url('admin/subscription')}}" class="btn btn-dark float-right"> << Go Back </a>
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
                    <div class="col-md-12 col-xl-12">
                        <form method="POST" action="{{url('admin/update_subscription')}}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="col-xl-12 form-group" style="display:inline-flex;padding:0px;">
                                <div class="col-xl-6 {{$errors->has('type') ? ' has-error' : ''}}">
                                    <label>Subscription Type <span style="color:#ff0b37;"> *</span></label>
                                    <input type="hidden" name="upd_id" value="{{$subs->id}}">
                                    <input type="text" class="form-control" name="type" value="{{$subs->type}}" autofocus>
                                    @if($errors->has('type'))
                                        <span class="help-block"><strong>{{$errors->first('type')}}</strong></span>
                                    @endif
                                </div>
                                <div class="col-xl-3 {{$errors->has('amount') ? ' has-error' : ''}}">
                                    <label>Subscription Amount <span style="color:#ff0b37;"> *</span></label>
                                    <input type="text" class="form-control" name="amount" value="{{$subs->amount}}">
                                    @if($errors->has('amount'))
                                        <span class="help-block"><strong>{{$errors->first('amount')}}</strong></span>
                                    @endif
                                </div>
                                <div class="col-xl-3 {{$errors->has('duration') ? ' has-error' : ''}}">
                                    <label>Subscription Duration</label>
                                    <select class="form-control" name="duration">
                                        <option @if($subs->duration == '1 Month') selected @endif>1 Month</option>
                                        <option @if($subs->duration == '3 Months') selected @endif>3 Months</option>
                                        <option @if($subs->duration == '6 Months') selected @endif>6 Months</option>
                                        <option @if($subs->duration == '1 Year') selected @endif>1 Year</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-12 form-group" style="display:inline-flex;padding:0px;">
                                <div class="col-xl-12">
                                    <label>Promocode</label>
                                    <div class="mb-3">
                                        <label class="form-control" style="cursor: pointer;"><input type="checkbox" name="is_promocode" value="1" {{old('is_promocode') == '1' || $subs->is_promocode == 1 ? 'checked' : ''}}> Is Promocode </label>
                                    </div>
                                    @if($errors->has('is_promocode'))
                                        <span class="help-block"><strong>{{ $errors->first('is_promocode') }}</strong></span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-xl-12 form-group" style="display:inline-flex;padding:0px;">
                                <div class="col-xl-6">
                                    <label>Image</label>
                                    <div class="mb-3">
                                        <!-- <input type="file" name="image" value="{{old('image')}}" class="form-control mb-1"> -->
                                        @include('includes.image-crop-4',['name' => 'image','width' => 350,'height' => 350])
                                        <span><strong>Upload new image here for change that</strong></span>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    @if($subs->image != '')
                                        <img src="{{url('subscription/'.$subs->image)}}" width="120" height="120">
                                        <a href="{{url('subscription/'.$subs->image)}}" target="blank"> &nbsp; View Full Size</a>
                                    @else
                                        <img src="{{url('subscription/no-image.jpg')}}" width="120" height="120">
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
                                        <input type="radio" name="feature1_favour" value="1" @if($subs->feature1_favour == '1') checked @endif><b style="color:#00b90c;"> Pros</b>
                                        &nbsp; <input type="radio" name="feature1_favour" value="0" @if($subs->feature1_favour == '0') checked @endif><b style="color:#ff0b37;"> Cons</b>
                                    </div>
                                </div>
                                <div class="col-xl-9 {{$errors->has('feature_1') ? ' has-error' : ''}}">
                                    <input type="text" class="form-control" name="feature_1" value="{{$subs->feature_1}}">
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
                                        <input type="radio" name="feature2_favour" value="1" @if($subs->feature2_favour == '1') checked @endif><b style="color:#00b90c;"> Pros</b>
                                        &nbsp; <input type="radio" name="feature2_favour" value="0" @if($subs->feature2_favour == '0') checked @endif><b style="color:#ff0b37;"> Cons</b>
                                    </div>
                                </div>
                                <div class="col-xl-9 {{$errors->has('feature_2') ? ' has-error' : ''}}">
                                    <input type="text" class="form-control" name="feature_2" value="{{$subs->feature_2}}">
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
                                        <input type="radio" name="feature3_favour" value="1" @if($subs->feature3_favour == '1') checked @endif><b style="color:#00b90c;"> Pros</b>
                                        &nbsp; <input type="radio" name="feature3_favour" value="0" @if($subs->feature3_favour == '0') checked @endif><b style="color:#ff0b37;"> Cons</b>
                                    </div>
                                </div>
                                <div class="col-xl-9 {{$errors->has('feature_3') ? ' has-error' : ''}}">
                                    <input type="text" class="form-control" name="feature_3" value="{{$subs->feature_3}}">
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
                                        <input type="radio" name="feature4_favour" value="1" @if($subs->feature4_favour == '1') checked @endif><b style="color:#00b90c;"> Pros</b>
                                        &nbsp; <input type="radio" name="feature4_favour" value="0" @if($subs->feature4_favour == '0') checked @endif><b style="color:#ff0b37;"> Cons</b>
                                    </div>
                                </div>
                                <div class="col-xl-9 {{$errors->has('feature_4') ? ' has-error' : ''}}">
                                    <input type="text" class="form-control" name="feature_4" value="{{$subs->feature_4}}">
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
                                        <input type="radio" name="feature5_favour" value="1" @if($subs->feature5_favour == '1') checked @endif><b style="color:#00b90c;"> Pros</b>
                                        &nbsp; <input type="radio" name="feature5_favour" value="0" @if($subs->feature5_favour == '0') checked @endif><b style="color:#ff0b37;"> Cons</b>
                                    </div>
                                </div>
                                <div class="col-xl-9 {{$errors->has('feature_5') ? ' has-error' : ''}}">
                                    <input type="text" class="form-control" name="feature_5" value="{{$subs->feature_5}}">
                                    @if($errors->has('feature_5'))
                                        <span class="help-block"><strong>{{$errors->first('feature_5')}}</strong></span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Update Subscription</button>
                            </div>
                        </form>
                    </div>
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
    }, 1000);
});
</script>
</body>
</html>