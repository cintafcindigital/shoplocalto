@extends('layouts.default')
@section('meta_title',$data['titleData']->meta_title)
@section('meta_keyword',$data['titleData']->meta_keyword)
@section('meta_description',$data['titleData']->meta_description)
@section('content')
@include('includes.menu')
  <section class="section-padding dashboard-wrap">
      @include('tools.tools_nav');   
      <div class="wrapper">
        <div class="tools-toggle-content">
            <div class="tools-toggle">
                <a href="{{url('tools/wedshoots')}}" class="active tools-toggle-item">Your album</a>
                <a href="{{url('tools/wedshoots-settings')}}" class=" tools-toggle-item">Create Album</a>
            </div>
      </div>
    <div class="pure-g mt50">
    <div class="pure-u-5-8">
        <div class="pure-g">
            <div class="pure-u-1-4">
                <div class="wedshoots-info-img">
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
                </div>
            </div>
            <div class="pure-u-3-4">
                <p class="wedshoots-info-name">
                    {{$data['parterData'][0]['couple_name'] ?? ''}}
                </p>
                <p class="wedshoots-info-description">Access your wedding album to see and share the best pictures.</p>
                <div class="mt5 mb10">
                    @if(isset($data['parterData'][0]['id']))
                    <a class="link" href="{{url('album')}}/{{$data['parterData'][0]['album_link'] ?? ''}}">{{url('album')}}/{{$data['parterData'][0]['album_link'] ?? ''}}</a>
                    @else
                    <a class="link" onclick="Frontend.websiteNotFound('Please create your photo album.')" href="#">{{url('album')}}/{{$data['parterData'][0]['album_link'] ?? ''}}</a>
                    @endif
                </div>
                <div class="mt20">
                    <span>Status:</span>
                    <span class="wedshoots-info-status green app-album-status-label">Visible</span>
                    </div>
            </div>
        </div>
    </div>
    <div class="pure-u-3-8">
        <div class="pure-g mt20">
            <div class="pure-u-1-2">
                <div class="wedshoots-count">
                    <i class="icon-tools icon-tools-wedshoots-album"></i>
                        <span class="wedshoots-count-number">
                        {{$data['parterData'][0]['total_pohots'] ?? 0}} <small class="wedshoots-count-text">photos</small>
                        </span>
                </div>
            </div>
            <div class="pure-u-1-2 wedshoots-actions">
             @if(isset($data['parterData'][0]['id']))
                <button id="btn-copy" onclick="Frontend.copyText(this)" class="btn-copy wedshoots-actions-button btn-flat red" data-clipboard-text="{{url('album')}}/{{$data['parterData'][0]['album_link'] ?? ''}}">
                   Copy Album Link</button>
             @else
                <a class="wedshoots-actions-button btn-flat red" onclick="Frontend.websiteNotFound('Please create your photo album.')" href="#">Copy Album Link</a>
             @endif
            </div>
        </div>
    </div>
</div>          
            
            
         
</div>
    
</section>
  <script type="text/javascript" src="{{URL::asset('public/js/clipboard.min.js')}}"></script>
  <script>
    var btn = document.getElementById('btn-copy');
    var clipboard = new ClipboardJS(btn);
  </script>
  @include('includes.error_popup')
  @include('includes.footer')
       
@endsection       
