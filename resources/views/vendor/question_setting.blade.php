@extends('layouts.default')
@section('meta_title',$data['titleData']->meta_title)
@section('meta_keyword',$data['titleData']->meta_keyword)
@section('meta_description',$data['titleData']->meta_description)
@section('content')
@include('includes.menu')
 <link rel="stylesheet" href="{{URL::asset('public/css/vendor.css')}}">
<style>
.checkbox{
      display: block;
    position: relative;
    font-weight: 300;
    font-size: 14px;
    height: auto;
    z-index: 9;
    cursor: pointer;
}
.input-group-line input:checked+span {
    background-position: inherit;
}
</style>
  <section class="section-padding dashboard-wrap dash_main_sect">
     @include('vendor.tools_nav');
  <div class="wrapper">
    <div class="pure-g">
        <div class="pure-u-1-5">
            <div class="pure-s mt5">
                <p class="tools-subtitle">Settings</p>
                <ul class="tools-filters">   
                    <li class="tools-filters-item">
                        <a class="tools-filters-item-name" href="{{url('vendor-settings')}}">My profile</a>
                    </li>
                    <li class="tools-filters-item">
                        <a class="tools-filters-item-name" href="{{url('image-settings')}}">Images</a>
                    </li>
                    <li class="tools-filters-item current">
                        <a class="tools-filters-item-name" href="{{url('question-settings')}}">Frequently Questions</a>
                    </li>
                    <li class="tools-filters-item">
                        <a class="tools-filters-item-name" href="{{url('discount-settings')}}">Discounts / Offers</a>
                    </li>
                    <li class="tools-filters-item">
                        <a class="tools-filters-item-name" href="{{url('account-settings')}}">Account settings</a>
                    </li>   
                </ul>
            </div>
        </div>
        <div class="pure-u-4-5">
            <div class="profile-header">
                <span class="tools-title">Question settings</span>
            </div>
             @if(session()->has('success'))
              <div class="app-success-box alert alert-success">
                {{session()->get('success')}}
              </div>
            @endif
            @if(session()->has('error'))
              <div class="app-danger-box alert alert-danger">
               {{session()->get('error')}}
              </div>
            @endif
            <div class="question-error-msg"></div>
            <div class="pure-g">
            <div class="pure-u-1 pr20">  
              <div class="app-scroll-password profile-box profile-box-double">  
               <div class="profile-box-content">
               <div class="app-community-password-change-div">
                <form action="{{url('save-questions')}}" class="app-frmComunidad" method="post">
                {{ csrf_field() }}
                                       
                        <?php /*echo"<pre>";
                             print_r($questions);
                           die;*/
                        ?>
                        @if(isset($questions) && !empty($questions))
                           @foreach($questions as $key=>$ques)
                              @if($ques->type == 'text')
                               @php  $questionId = 'question_'.$ques->question_id; @endphp
                                  <div class="input-group-line">
                                    <label><small>{{$key+1}}.</small> {{$ques->title}}</label>
                                    <div class="pure-u-1 pr20">
                                        @if($ques->description)
                                        <p>{{$ques->description}}</p>
                                        @endif
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label for="">{!!$ques->label_title!!}</label>
                                                <input type="text" name="{{$questionId}}" class="form-control" value="@if(isset($answers[$ques->question_id])){{$answers[$ques->question_id]}}@endif" data-qsid="@if(isset($answers[$ques->question_id])){{$ques->question_id}}@endif"  onblur="Frontend.updateVendorQuestions(this)">
                                               <!--  <span class="price-symb">€</span> -->
                                               <!--  <p class="app_changePrecioComensal"><a href="#">Event Space Rental</a></p> -->
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- Frequent Ques Row -->
                               @elseif($ques->type == 'textarea')
                               @php $questionId = 'question_'.$ques->question_id; @endphp
                                  <div class="input-group-line">
                                    <label><small>{{$key+1}}.</small> {{$ques->title}}</label>
                                    <div class="pure-u-1 pr40">
                                        @if($ques->description)
                                        <p>{{$ques->description}}</p>
                                        @endif
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label for="">{!!$ques->label_title!!}</label>
                                                <textarea name="{{$questionId}}" class="form-control" data-qsid="@if(isset($answers[$ques->question_id])){{$ques->question_id}}@endif" onblur="Frontend.updateVendorQuestions(this)">@if(isset($answers[$ques->question_id])){{$answers[$ques->question_id]}}@endif</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- Frequent Ques Row -->
                              @elseif($ques->type == 'checkbox')
                                @php $questionId = 'question_'.$ques->question_id; @endphp
                                @php $newAnsCheck = array();
                                if(isset($answers[$ques->question_id])){ 
                                       $newAnsCheck = explode(',',$answers[$ques->question_id]);
                                      } 
                                @endphp
                                <div class="input-group-line">
                                    <label><small>{{$key+1}}.</small> {{$ques->title}}</label>
                                    <div class="pure-u-1 pr40">
                                        @if($ques->description)
                                        <p>{{$ques->description}}</p>
                                        @endif
                                        <div class="row">
                                            @if($ques->options)
                                            @php $questOptions = json_decode($ques->options); @endphp
                                            @foreach($questOptions as $k=>$opt)
                                               @php $rand = rand(0,999); @endphp
                                                <div class="col-sm-4">
                                                     <label for="check{{$rand}}" class="checkbox">
                                                        <input type="checkbox" name="{{$questionId}}[]" class="check" id="check{{$rand}}" value="{{$opt}}" @if(in_array($opt,$newAnsCheck)) checked @endif @if(isset($answers[$ques->question_id]) && $answers[$ques->question_id] == $opt) checked @endif data-qsid="@if(isset($answers[$ques->question_id])){{$ques->question_id}}@endif" data-name="{{$questionId}}" onclick="Frontend.updateVendorCheckboxQuestions(this)">
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
                                <div class="input-group-line">
                                    <label><small>{{$key+1}}.</small> {{$ques->title}}</label>
                                    <div class="pure-u-1 pr40">
                                        @if($ques->description)
                                        <p>{{$ques->description}}</p>
                                        @endif
                                        <ul class="choose-cate clearfix">
                                            @if($ques->options)
                                            @php $questOptions = json_decode($ques->options); @endphp
                                            @foreach($questOptions as $k=>$opt)
                                               @php $rand = rand(0,999); @endphp
                                                <li>
                                                    <input type="radio" id="radio{{$rand}}" value="{{$opt}}" name="{{$questionId}}"  @if(isset($answers[$ques->question_id]) && $answers[$ques->question_id] == $opt) checked @endif data-qsid="@if(isset($answers[$ques->question_id])){{$ques->question_id}}@endif" onchange="Frontend.updateVendorQuestions(this)">
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
                          <p>There is no frequently questions found.</p><br>
                        @endif
                      
                </form>
                    </div>
              </div>
            </div>
          </div>

          </div>  
        </div>
    </div>
  </div>
</section>

  @include('includes.footer')
@endsection       
