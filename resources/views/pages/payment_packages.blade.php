@extends('layouts.default')
@section('meta_title',$pageData->meta_title)
@section('meta_keyword',$pageData->meta_keyword)
@section('meta_description',$pageData->meta_description)
@section('content')
@include('includes.menu')
<?php $session_payType = Session::get('session_payType'); ?>
<style>
    .imgCentered {
        position: absolute;
        top: 50%;
        left: 50%;
        padding-top: 35%;
        transform: translate(-50%, -50%);
    }
    .btnCls {
        color:#fff;
        outline: none;
        background-color:#dd0000;
    }
    .btnCls:focus {
        outline: none !important;
        -moz-outline: none !important;
        -ms-outline: none !important;
        -o-outline: none !important;
        -webkit-outline: none !important;
    }
</style>
<section class="section-padding">
    <div class="container">
        <h1>Our Prices & Packages
            @if($session_payType == 'lead')
                <a href="{{url('activate-now')}}" class="btn mt10 floatright" style="background:#DD0000;color:#FFF;"> << Go Back</a>
            @elseif($session_payType == 'freelisting')
                <a href="{{url('join-now')}}" class="btn btnCls mt10 floatright" style="background:#DD0000;color:#FFF;"> << Go Back</a>
            @else
                <a href="{{url('new-vendor')}}" class="btn btnCls mt10 floatright" style="background:#DD0000;color:#FFF;"> << Go Back</a>
            @endif
        </h1>
        @if(@$vendors->company_data->business_name)
        <h3 class="mb25 border-bottom">{{@$vendors->company_data->business_name}}<br/>
            {{@$vendors->company_data->address.', '.@$vendors->company_data->postal_code.', '.@$vendors->company_data->city.', '.@$vendors->company_data->province}}
        </h3>
        @endif
        <div class="col-md-12">
            @foreach($subscription as $subs)
            <div class="col-md-4">
                <div class="directory-img-item">
                    <div class="vendor-slider">
                        <div class="vendor-slider-content img-zoom">
                            @if(file_exists(public_path().'/subscription/'.$subs->image))
                                <img src="{{asset('public/subscription/'.$subs->image)}}" style="width:100%;height:100%;object-fit: contain;">
                            @else
                                <img src="{{asset('public/subscription/no-image.jpg')}}" style="width:100%;height:100%;object-fit: contain;">
                            @endif
                            <div class="imgCentered">
                            </div>
                        </div>
                    </div>
                    <div style="width:100%;text-align:left;padding:10px;font-size:13px;">
                        <hr>
                        <h3 style="color:#000;font-weight:bold;" class="text-center">{{$subs->type.' ( '.$subs->duration.' )'}}</h3>
                        <h1 style="color:#000;font-weight:bold;" class="text-center">{{$subs->amount}} $</h1>
                        <hr>
                        @if($subs->feature_1)
                        <p>@if($subs->feature1_favour == 0)
                                <i class="fa fa-times" style="color:#ff0b37;width:14px;"></i>
                            @else
                                <i class="fa fa-check" style="color:#00b90c;width:14px;"></i>
                            @endif
                            {{substr(strip_tags($subs->feature_1),0,55)}}
                        </p>
                        @endif
                        @if($subs->feature_2)
                        <p>@if($subs->feature2_favour == 0)
                                <i class="fa fa-times" style="color:#ff0b37;width:14px;"></i>
                            @else
                                <i class="fa fa-check" style="color:#00b90c;width:14px;"></i>
                            @endif
                            {{substr(strip_tags($subs->feature_2),0,55)}}
                        </p>
                        @endif
                        @if($subs->feature_3)
                        <p>@if($subs->feature3_favour == 0)
                                <i class="fa fa-times" style="color:#ff0b37;width:14px;"></i>
                            @else
                                <i class="fa fa-check" style="color:#00b90c;width:14px;"></i>
                            @endif
                            {{substr(strip_tags($subs->feature_3),0,55)}}
                        </p>
                        @endif
                        @if($subs->feature_4)
                        <p>@if($subs->feature4_favour == 0)
                                <i class="fa fa-times" style="color:#ff0b37;width:14px;"></i>
                            @else
                                <i class="fa fa-check" style="color:#00b90c;width:14px;"></i>
                            @endif
                            {{substr(strip_tags($subs->feature_4),0,55)}}
                        </p>
                        @endif
                        @if($subs->feature_5)
                        <p>@if($subs->feature5_favour == 0)
                                <i class="fa fa-times" style="color:#ff0b37;width:14px;"></i>
                            @else
                                <i class="fa fa-check" style="color:#00b90c;width:14px;"></i>
                            @endif
                            {{substr(strip_tags($subs->feature_5),0,55)}}
                        </p>
                        @endif
                        @if($subs->is_promocode)
                            <button type="button" class="btn" style="color:#fff;padding:10px;background-color:#dd0000;width:100%;border-radius:5px;outline:none !important;" data-toggle="modal" data-target="#promoModal">APPLY CODE</button>
                        @else
                        <form action="{{url('make-payment')}}" method="POST">
                            {{csrf_field()}}
                            <input type="hidden" name="amount_to_pay" value="{{$subs->amount}}">
                            <input type="hidden" name="subscription_id" value="{{$subs->id}}">
                            <button type="submit" class="btn" style="color:#fff;padding:10px;background-color:#dd0000;width:100%;border-radius:5px;outline:none !important;">REQUEST NOW</button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div style="clear:both;"></div>
    </div>
    <div id="promoModal" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Promocode</h4>
          </div>
          <div class="modal-body">
            <div class="form-group">
                <input type="text" class="form-control codeEnter" placeholder="Enter promocode here.." name="promocode">
                <span class="text-danger promoError">Please enter promocode</span>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btnFlat promocodeApply" style="color: #4baa3b;">Apply</button>
            <button type="button" class="btn btnCls" data-dismiss="modal">Close</button>
          </div>
        </div>

      </div>
    </div>
</section>
@include('includes.footer')
<script type="text/javascript">
    $('.promoError').hide('slow');
    $('.promocodeApply').click(function(event) {
        event.preventDefault();
        if($('.codeEnter').val().length === 0){
            $('.promoError').show('slow');
        }else{
            $('.promoError').hide('slow');
            $.ajax({
                url: '{{url('promocode-request')}}',
                type: 'POST',
                // dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
                data: {_toke:'{{csrf_token()}}',code: $('.codeEnter').val()},
            })
            .done(function(data) {
                // alert(data);
                if(data.status){
                    alert(data.message);
                    window.location.href = data.data.url;
                }else{
                    alert(data.message);
                }
                // console.log("success");
            })
            .fail(function() {
                console.log("error");
            })
            .always(function() {
                // console.log("complete");
            });
            
        }
    });
</script>
@endsection