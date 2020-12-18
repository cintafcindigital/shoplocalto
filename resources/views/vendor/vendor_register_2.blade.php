@extends('layouts.default')
@section('meta_title',$pageData->meta_title)
@section('meta_keyword',$pageData->meta_keyword)
@section('meta_description',$pageData->meta_description)
@section('content')
@include('includes.menu')
@include('includes.inner-slider')
<?php $vendor_id = @Input::get('vendorId', false); ?>
<style>
.error-text {
    color: #F11D1D;
    font-size: 14px;
}
</style>
<section class="vendor-step-wrap step03"><!-- SLIDER SECTION START -->
   <div class="container">
       <div class="vendors-signup-steps">
            <div class="progress-steps">
                <div class="complete"><span>1</span><hr></div>
                <div class="complete"><span>2</span><hr></div>
                <!-- <div class="complete"><span>3</span><hr></div> -->
                <div><span>3</span><hr></div>
            </div>
            <div class="progress-steps-ui">
                <span>General Information</span>
                <span>Photo gallery</span>
                <!-- <span>Frequently Asked Questions</span> -->
                <span>Promotions</span>
            </div>
        </div><!-- Vendors Signup Steps -->
        @if(session()->has('fail'))
            <div class="alert alert-danger">{{ session()->get('fail') }}</div>
        @endif
        <form action="{{url('register-step-3')}}" class="vendor-form-wrap" method="post">
            {{ csrf_field() }}
            <div class="login-info-row">
                <h3>Frequent questions</h3>
                <div class="vendor-notice frequent-notice">
                    <span class="alert-icon"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span>
                    <h6>Then you can answer the Frequently Asked Questions of the Masías sector.</h6>
                    <p>This information will appear on your profile. Your answers will give the couple more knowledge of the services you offer.</p>
                </div>
                <?php /*echo"<pre>"; print_r($questions); die;*/ ?>
                @if(isset($questions) && !empty($questions))
                    @foreach($questions as $key=>$ques)
                        @if($ques->type == 'text')
                            @php $questionId = 'question_'.$ques->question_id; @endphp
                            <div class="frequent-ques-row">
                                <h4><small>{{$key+1}}</small>{{$ques->title}}</h4>
                                <div class="ans-wrap">
                                    @if($ques->description) <p>{{$ques->description}}</p> @endif
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <input type="hidden" name="vendor_id" value="{{$vendor_id}}">
                                            <label for="">{!!$ques->label_title!!}</label>
                                            <input type="text" name="{{$questionId}}" class="form-control" value="{{old($questionId)}}">
                                            <!--  <span class="price-symb">€</span> -->
                                            <!--  <p class="app_changePrecioComensal"><a href="#">Event Space Rental</a></p> -->
                                        </div>
                                    </div>
                                </div>
                            </div><!-- Frequent Ques Row -->
                        @elseif($ques->type == 'textarea')
                            @php $questionId = 'question_'.$ques->question_id; @endphp
                            <div class="frequent-ques-row">
                                <h4><small>{{$key+1}}</small>{{$ques->title}}</h4>
                                <div class="ans-wrap">
                                    @if($ques->description) <p>{{$ques->description}}</p> @endif
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label for="">{!!$ques->label_title!!}</label>
                                            <textarea name="{{$questionId}}" class="form-control">{{old($questionId)}}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- Frequent Ques Row -->
                        @elseif($ques->type == 'checkbox')
                            @php $questionId = 'question_'.$ques->question_id; @endphp
                            <div class="frequent-ques-row">
                                <h4><small>{{$key+1}}</small>{{$ques->title}}</h4>
                                <div class="ans-wrap">
                                    @if($ques->description) <p>{{$ques->description}}</p> @endif
                                    <div class="row">
                                        @if($ques->options)
                                            @php $questOptions = json_decode($ques->options); @endphp
                                            @foreach($questOptions as $k=>$opt)
                                                @php $rand = rand(0,999); @endphp
                                                <div class="col-sm-4">
                                                    <label for="check{{$rand}}" class="checkbox">
                                                        <input type="checkbox" name="{{$questionId}}[]" class="check" id="check{{$rand}}" value="{{$opt}}">
                                                        {{$opt}}
                                                        <span class="checkmark"></span>
                                                    </label>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div><!-- Frequent Ques Row -->
                        @elseif($ques->type == 'radio')
                            @php $questionId = 'question_'.$ques->question_id; @endphp
                            <div class="frequent-ques-row">
                                <h4><small>{{$key+1}}</small>{{$ques->title}}</h4>
                                <div class="ans-wrap">
                                    @if($ques->description) <p>{{$ques->description}}</p> @endif
                                    <ul class="choose-cate clearfix">
                                        @if($ques->options)
                                            @php $questOptions = json_decode($ques->options); @endphp
                                            @foreach($questOptions as $k=>$opt)
                                                @php $rand = rand(0,999); @endphp
                                                <li>
                                                    <input type="radio" id="radio{{$rand}}" value="{{$opt}}" name="{{$questionId}}">
                                                    <label for="radio{{$rand}}">{{$opt}}</label>
                                                    <div class="check"></div>
                                                </li>
                                            @endforeach
                                        @endif
                                    </ul>
                                </div>
                            </div><!-- Frequent Ques Row -->
                        @endif
                    @endforeach
                @else
                    <div class="frequent-ques-row">
                        <h4>There is no question asked please move to next step.</h4>
                    </div><!-- Frequent Ques Row -->
                @endif
                <div class="col-sm-12 next-row text-center">
                    <button type="submit" class="btn btn-lg btn-next">Next</button>
                </div>
            </div><!-- Login Information -->
        </form>
    </div>
</section><!-- Vendor Step Wrapper -->
@include('includes.footer')
@endsection