@extends('layouts.default')
@section('meta_title',$data['titleData']->meta_title)
@section('meta_keyword',$data['titleData']->meta_keyword)
@section('meta_description',$data['titleData']->meta_description)
@section('content')
@include('includes.menu')
  <section class="section-padding dashboard-wrap">
      @include('tools.tools_nav');   
      <div class="wrapper">
    <div class="app-currency-entity dnone" data-before="C$" data-after=""></div>
    
    <div class="tools-toggle-content app-lista-header-nav pure-g">
        <div class="pure-u-1-3"></div>
        <div class="pure-u-1-3">
            <div class="tools-toggle">
                <a class="tools-toggle-item active" href="{{url('tools/wedding-website')}}">Wedding Website</a>
                @if(isset($data['parterData'][0]['id']))
                <a class="tools-toggle-item " href="{{url('web')}}/{{$data['parterData'][0]['website_link'] ?? ''}}">Review</a>
                @else
                  <a class="tools-toggle-item" onclick="Frontend.websiteNotFound('Please complete your website first.')" href="#">Review</a>
                @endif
            </div>
        </div>
    </div>
    <div id="app-error"></div>
    <div class="pure-g">
                <div class="pure-u-3-4">
                    <div class="pure-s">
                        <div class="pure-g">
                            <div class="pure-u-3-10">
                                <div class="pure-s text-center">
                                    <form id="app-wedshoots-portada-upload" name="frmDesktopUpload">
                                        <input type="hidden" name="idFoto1">
                                        <div class="app-wsPhoto">
                                            <figure class="mb10">
                                                @php
                                                      $userId =  \Auth::user()->id;
                                                      $profileImage =  \Auth::user()->profile_image;
                                                      if(isset($profileImage) && !empty($profileImage)){
                                                          $proImagePath = url('storage/USER_'.$userId.'/'.$profileImage);
                                                      }
                                                  @endphp
                                                <div class="wedshoots-info-img mauto app-uploader-wedshoots-container">
                                                   <img src="{{$proImagePath ?? ''}}">
                                                </div>
                                            </figure>
                                            <input type="hidden" name="nfile">
                                            <input type="hidden" value="1" name="settings_update">
                                            <p><span class="upper strong small">Profile photo</span></p>
                                           
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="pure-u-7-10 wedshoots-config">
                                <h3 class="tools-subtitle">Website options</h3>
                                <form action="{{url('tools/save-wedding-website')}}" class="wedshoots-configForm app-form-wedshoots-album-modif mb40" method="post" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    @if(session()->has('message'))
                                       {!!session()->get('message')!!}
                                    @endif

                               
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    <span class="upper small strong" @if($errors->has('name')) style="color:red;" @endif>Couple Name</span>
                                    <div class="input-group-line">
                                        <input type="text" value="{{$data['parterData'][0]['couple_name'] ?? ''}}" name="couple_name" size="45" placeholder="Thomas & Olivia">
                                    </div>
                                    <span class="upper small strong">Wedding Date</span>
                                    <div class="input-group-line">
                                       <input type="text" name="wedding_date" placeholder="Wedding date" size="45" class="datetimepicker" value="{{$data['parterData'][0]['wedding_date'] ?? ''}}">
                                    </div>
                                    <span class="upper small strong"  @if($errors->has('title')) style="color:red;" @endif >Title</span>
                                    <div class="input-group-line">
                                        <input type="text" value="{{$data['parterData'][0]['title'] ?? ''}}" name="title" size="45" placeholder="Welcome to our wedding website!">
                                    </div>
                                    <span class="upper small strong" @if($errors->has('description')) style="color:red;" @endif>Description</span>
                                    <div class="input-group-line">
                                        <textarea name="description">{{$data['parterData'][0]['description'] ?? ''}}</textarea>
                                    </div>
                                    <span class="upper small strong @if($errors->has('image')) style="color:red;" @endif">Banner Image</span>
                                    <div class="input-group-line">
                                        <div class="upl-foto app-photo-1 hide">
                                            <input id="photo_1" type="file" name="image" accept="image/*" hidden="">
                                        </div>
                                        <br><label for="photo_1" class="pointer frame-inputFile btn-outline outline-red">
                                          Upload                               
                                        </label>
                                        @if(isset($data['parterData'][0]['banner_image']))
                                          <br><br><img src="{{$data['parterData'][0]['banner_image']}}" style="width:200px;">
                                        @endif
                                    </div>
                                     <span class="upper small strong @if($errors->has('background_color')) style="color:red;" @endif">Background Color</span>
                                    <div class="input-group-line">
                                        <input type="text" value="{{$data['parterData'][0]['background_color'] ?? 'F1F1F1'}}" class="jscolor" name="background_color" size="45" placeholder="Welcome to our wedding website!">
                                    </div>
                                    <span class="upper small strong @if($errors->has('website_link')) style="color:red;" @endif">My wedding website link</span>
                                    <div>
                                        <span id="app-url-first-part">{{url('web')}}/</span>
                                        <div class="pure-u-2-6 wedshoots-config-url input-group-line">
                                            <input type="text" value="{{$data['parterData'][0]['website_link'] ?? ''}}" size="15" name="website_link" placeholder="thomas-and-olivia">
                                        </div>
                                    </div>
                                    <input type="hidden" name="website_id" value="{{$data['parterData'][0]['id'] ?? ''}}">
                                    <button type="submit" class="btn-flat red mt20">Save Changes</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <div class="pure-u-1-4">
        </div>
    </div>
</div>
</section>
  @include('includes.error_popup')
  @include('includes.footer')
@endsection       
