@extends('layouts.default')
@section('meta_title',$data['titleData']->meta_title)
@section('meta_keyword',$data['titleData']->meta_keyword)
@section('meta_description',$data['titleData']->meta_description)
@section('content')
@include('includes.menu')
<link rel="stylesheet" href="{{URL::asset('public/css/custom-box.css')}}">
  <section class="section-padding dashboard-wrap">
      @include('tools.tools_nav');   
    <div class="wrapper">
    <div class="app-currency-entity dnone" data-before="C$" data-after=""></div>
    <div class="tools-toggle-content app-lista-header-nav pure-g">
        <div class="pure-u-1-3"></div>
        <div class="pure-u-1-3">
           <div class="tools-toggle">
                <a href="{{url('tools/wedshoots')}}" class="tools-toggle-item">Your album</a>
                <a href="{{url('tools/wedshoots-settings')}}" class=" tools-toggle-item active">Create Album</a>
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
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="pure-u-7-10 wedshoots-config">
                                <h3 class="tools-subtitle"></h3>
                                <form action="{{url('tools/save-wedshoots-settings')}}" class="wedshoots-configForm app-form-wedshoots-album-modif mb40" method="post" enctype="multipart/form-data">
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
                                    <span class="upper small strong @if($errors->has('album_link')) style="color:red;" @endif">Album link</span>
                                    <div>
                                        <span id="app-url-first-part">{{url('album')}}/</span>
                                        <div class="pure-u-2-6 wedshoots-config-url input-group-line">
                                            <input type="text" value="{{$data['parterData'][0]['album_link'] ?? ''}}" size="15" name="album_link" placeholder="thomas-and-olivia">
                                        </div>
                                    </div>
                                    
                                    <input type="hidden" name="id" value="{{$data['parterData'][0]['id'] ?? ''}}">
                                    <button type="submit" class="btn-flat red mt20">Save Changes</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <div class="pure-u-1-4">

            </div>
    </div>
    <div class="pure-g">
        <div class="pure-u-3-4">
            <div class="pure-s">
                <div class="pure-g">
                    <div class="pure-u-3-10">
                    </div>
                    <div class="pure-u-7-10">

                        <span class="upper small strong @if($errors->has('image')) style="color:red;" @endif">Upload Photos</span>
                                    <div class="upload-photo-con clearfix">
                                        <div class="image-error-msg" style="color:#E09122;font-size: 15px;margin-top:15px;">
                                        </div>
                                        <div class="upload-col" style="float: left;">
                                            <div class="gallery-upload-graphic" id="drop-area-album">
                                                <span class="galeria-photos"><img src="{{ url('public/images/no-img.png')}}" alt=""></span>
                                                <span class="gallery-upload-step">JPG or PNG format</span>
                                                <!-- <span class="gallery-upload-step">Maximum weight 5 MB</span> -->
                                            </div>
                                            <p class="upload-btn-wrapper">
                                                 <span>Drag and drop your images here</span>
                                                 <button class="add-image pointer frame-inputFile btn-outline outline-red">Add images</button>
                                                 <input type="file" name="userImageAlbum" id="wedshoots-image-upload" class="wedshoots-image-upload" />
                                            </p>                                      
                                        </div>
                                    </div>
                        <div class="row add-images-via">

                            <div class="row margin-bottom">                   
                                  <div class="row">
                                    <?php $counter = 1; ?> 
                                         @if(isset($data['photos'][0]) && !empty($data['photos'][0]))
                                          @foreach($data['photos'] as $pho)
                                            <div class="col-sm-4 mb30 image-webshoots" id="webshoot_image_{{$pho['id']}}">     
                                               <img class="img-responsive mb5" src="{{$pho['image']}}">
                                               <div class="budget-spending-item-cells b-text-white col-sm-8">
                                                    <span class="icon-tools icon-left icon-tools-plus-circle-outline link pointer app-add-spending" data-title="{{$pho['title']}}" data-note="{{$pho['note']}}" data-id="{{$pho['id']}}" onclick="Frontend.AddAlbumImageNote(this)">Add Note</span>
                                               </div>
                                               <div class="budget-spending-item-cells col-sm-2" >
                                               </div>
                                               <div class="budget-spending-item-cells col-sm-2">
                                                    <i class="fa fa-trash text-red trash-icon" data-id="{{$pho['id']}}" onclick="Frontend.DeleteAlbumImage(this)"></i>
                                               </div>
                                            </div>
                                            <?php $counter++; ?>
                                          @endforeach
                                         @endif
                                    <!-- /.col -->
                                  </div>
                                  <!-- /.row -->
                                <!-- /.col -->
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
  @include('includes.add_image_note_popup')
  @include('includes.error_popup')
  @include('includes.footer')
@endsection       
