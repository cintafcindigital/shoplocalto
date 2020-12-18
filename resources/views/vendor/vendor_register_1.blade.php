@extends('layouts.default')
@section('meta_title',$pageData->meta_title)
@section('meta_keyword',$pageData->meta_keyword)
@section('meta_description',$pageData->meta_description)
@section('content')
@include('includes.menu')
@include('includes.inner-slider')
<?php $vendor_id = @Input::get('vendorId', false); ?>
<style> 
.error-text{
    color: #F11D1D;
    font-size: 14px;
}
.upload-btn-wrapper input[type=file] {
    font-size: 21px;
    position: absolute;
    left: 0;
    top: 37px;
    opacity: 0;
    height: 44px;
    width: 56%;
    cursor: pointer;
}
</style>
<section class="vendor-step-wrap"><!-- SLIDER SECTION START -->
    <div class="container">
        <div class="vendors-signup-steps">
            <div class="progress-steps">
                <div class="complete"><span>1</span><hr></div>
                <!-- <div class="complete"><span>2</span><hr></div> -->
                <div class="complete"><span>2</span><hr></div>
                <!-- <div><span>3</span><hr></div> -->
            </div>
            <div class="progress-steps-ui">
                <span>General Information</span>
                <span>Photo gallery</span>
                <!-- <span>Frequently Asked Questions</span> -->
                <!-- <span>Promotions</span> -->
            </div>
        </div><!-- Vendors Signup Steps -->
        @if(session()->has('fail'))
            <div class="alert alert-danger">{{ session()->get('fail') }}</div>
        @endif
        <form action="" method="post" class="vendor-form-wrap step02" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="login-info-row">
                <h3>Photo Gallery</h3>
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="vendor-notice">
                            <p>4 pictures are recommended <span>Showcase work by adding high-quality photos of your business and the service or products you offer. Clients & patients want to see what you are about – remember a picture is sometimes worth a thousand words.</span></p>
                        </div>
                        <div class="instruction">
                            <ul>
                                <li>You must add a minimum of <strong>one logo and 1 picture of your business</strong>  (up to 4 pictures).</li>
                                <li><strong>Grab and drag the images to change the order</strong></li>
                            </ul>
                            <!-- <p><a href="#">See sample company file</a></p> -->
                        </div>
                        <div class="upload-photo-con clearfix">
                            <div class="image-error-msg text-center" style="color:#E09122;"></div>
                            <div class="upload-col">
                                <div class="gallery-upload-graphic" id="drop-area">
                                    <span class="galeria-photos"><img src="{{ url('public/images/no-img.png')}}" alt=""></span>
                                    <span class="gallery-upload-step">GIF or JPG format</span>
                                    <span class="gallery-upload-step">Maximum weight 5 MB</span>
                                </div>
                                <p class="upload-btn-wrapper">
                                    <span>Drag and drop your images here</span>
                                    <button class="btn btn-lg add-image">Add images</button>
                                    <input type="file" name="userImage" id="profile-image-upload" accept="image/webp,image/png,image/jpeg" />
                                </p>
                            </div>
                        </div>
                    </div><br>
                    <div class="col-md-12 col-sm-12">
                        <div class="row append-image">
                            @if(isset($imageData) && !empty($imageData))
                                @foreach($imageData as $image)
                                <div class="col-md-3">
                                    <div class="thumbnail">
                                        <img style="height:253px;width:100%" src="{{URL::asset('public/vendors')}}/{{$image['vendor_folder']}}/{{$image['image']}}" alt="Lights">
                                    </div>
                                </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 next-row text-center">
                    <a href="{{url('register-step-4').'?vendorId='.$vendor_id}}" class="btn btn-lg btn-next">Pay & Save</a>
                </div>
            </div><!-- Photo Gallery -->
        </form>
    </div><!-- End container -->
</section><!-- Vendor Step Wrapper -->
@include('includes.footer')
@endsection