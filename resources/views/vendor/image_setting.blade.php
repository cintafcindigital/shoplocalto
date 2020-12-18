@extends('layouts.default')
@section('meta_title',$data['titleData']->meta_title)
@section('meta_keyword',$data['titleData']->meta_keyword)
@section('meta_description',$data['titleData']->meta_description)
@section('content')
@include('includes.menu')
 <link rel="stylesheet" href="{{URL::asset('public/css/vendor.css')}}">
  <section class="section-padding dashboard-wrap dash_main_sect">
     @include('vendor.tools_nav');
  <div class="wrapper">
    <div id="app-error"></div>
    <div class="pure-g">
        <div class="pure-u-1-5">
            <div class="pure-s mt5">
                <p class="tools-subtitle">Settings</p>
                <ul class="tools-filters">   
                    <li class="tools-filters-item">
                        <a class="tools-filters-item-name" href="{{url('vendor-settings')}}">My profile</a>
                    </li>
                    <li class="tools-filters-item current">
                        <a class="tools-filters-item-name" href="{{url('image-settings')}}">Images</a>
                    </li>
                    <li class="tools-filters-item">
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
                <span class="tools-title">Image settings</span>
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
            <div class="pure-s">
                <div class="pure-g">                   
                    <div class="pure-u-1">
                        <div class="upload-photo-con clearfix">
                            <div class="upload-col" style="float: left;">
                                <p class="upload-btn-wrapper">
                                     <button class="add-image pointer frame-inputFile btn-outline outline-red">Add images</button>
                                     <input type="file" name="imageVendor" id="vendor-image-upload" class="vendor-image-upload" style="margin-top: 25px;" />
                                </p>                                      
                            </div>
                        </div>
                        <div class="add-images-via">
                            <div class="margin-bottom">  
                                    <?php $counter = 1; ?> 
                                         @if(isset($data['vendorData'][0]['image_data']) && !empty($data['vendorData'][0]['image_data']))
                                          @foreach($data['vendorData'][0]['image_data'] as $pho)
                                           @if($counter%3 == 1) <div class="row"> @endif   
                                            <div class="col-sm-4 mb30 image-vendor" id="vendor_image_{{$pho['id']}}">     
                                               <img class="img-responsive mb5" src="{{url('public/vendors')}}/{{$pho['vendor_folder']}}/{{$pho['image']}}">
                                               <div class="budget-spending-item-cells b-text-white col-sm-8">
                                                    @if($pho['is_logo'] == '1')
                                                    <span class="icon-tools icon-left icon-tools-plus-circle-outline-done link pointer app-add-spending" data-id="{{$pho['id']}}">Profile Image</span>
                                                    @else
                                                    <span class="icon-tools icon-left icon-tools-plus-circle-outline link pointer app-add-spending" data-id="{{$pho['id']}}" onclick="Frontend.SetAsProfileImageVendor(this)">Set As Profile Image</span>
                                                    @endif
                                               </div>
                                               <div class="budget-spending-item-cells col-sm-2" >
                                               </div>
                                               <div class="budget-spending-item-cells col-sm-2">
                                                    <i class="fa fa-trash text-red trash-icon" data-id="{{$pho['id']}}" onclick="Frontend.DeleteVendorImage(this)"></i>
                                               </div>
                                            </div>
                                            @if($counter%3 == 0) </div> @endif
                                            <?php $counter++; ?>
                                          @endforeach
                                           @if($counter%3 != 1) </div> @endif
                                         @endif
                                    <!-- /.col -->
                                
                                <!-- /.col -->
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
