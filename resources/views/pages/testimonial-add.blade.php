@extends('layouts.default')
@section('meta_title',$pageData->meta_title)
@section('meta_keyword',$pageData->meta_keyword)
@section('meta_description',$pageData->meta_description)
@section('content')
@include('includes.menu')
<!-- SLIDER SECTION START -->
<!--include('includes.inner-slider')-->
        <section id="slider-seciton">
               <div class="header-bottom"></div>
                <div id="myCarousel" class="carousel slide inner-slider" data-ride="carousel" style="background:url({{ URL::asset('public/sliders') }}/{{ $pageData['image'] }});background-size: 100%;position: relative;background-repeat: no-repeat;">
                    <!-- Indicators -->                   
                    <!-- Wrapper for slides -->
                    <span style="position: absolute;height: 100%;width: 100%;background: #00000047;"></span>
                    <div class="carousel-inner" role="listbox" style="position:relative">                                
                             <div class="container">    
                                    <!-- <div class="slider-cont"> -->
                                      <div class="slider-cont">
                                       {!! $pageData['image_description'] !!}
                                       </div>
                                    <!-- </div> -->
                                    </div>                               
                        <div class="item slider-background active"></div>
                    </div>
                </div>           
        </section>

       <section id="about-section" class="section-padding testimonial-section">
            <div class="container">
                    
                    <!-- ========================================= CONTENT ========================================= -->
                    <div class="col-xs-12 col-sm-12 col-md-12 no-margin">
                        <section id="gaming">
                            <div class="grid-list-products">
                                <div class="tab-content">
                                    
                                    <div id="list-view" class="products-grid fade tab-pane  active in">
                                        <div class="products-list">
                                            <h1 class="text-center">Testimonial</h1>
                                        @if(session()->has('success'))
                                        {!! session()->get('success') !!}
                                        @endif
                                        @if(count($errors->all()) > 0)
                                        <div class="col-sm-12">
                                            <ul style="color:#fff;background:lightcoral;padding: 15px;">
                                                @foreach($errors->all() as $error)
                                                <li>{{$error}}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        @endif
                                        <form method="post" action="{{url()->current()}}" enctype="multipart/form-data">
                                            @csrf
                                            @METHOD('POST')
                                            <div class="form-group">
                                                <label>Name</label>
                                                <input type="text" class="form-control" value="{{old('name')}}" name="name" />
                                            </div>
                                            <div class="form-group">
                                                <label>Testimonial Description</label>
                                                <textarea class="form-control" id="description" value="{{old('description')}}" name="description"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>Image</label>
                                                <input type="file" class="form-control" value="{{old('image')}}" name="image" />
                                            </div>
                                            @if(env('GOOGLE_RECAPTCHA_KEY'))
                                                
                                            @endif
                                            <div class="row">
                                                <div class="col-md-12 text-right">
                                                    <div class="g-recaptcha" data-sitekey="{{'6Lfst80ZAAAAALX7HIMxbftvMW-Fqit6kS8ajQh3'}}" data-callback="enableBtn"></div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <input type="submit" id="testimonial-submit-button" style="padding: 10px 15px;" disabled class="btn btn-primary btn-lg pull-right" value="Submit">
                                            </div>
                                        </form>
                            
                                        </div><!-- /.products-list -->

                                </div><!-- /.tab-content -->
                            </div><!-- /.grid-list-products -->

                        </section><!-- /#gaming -->
                    </div><!-- /.col -->
                    <!-- ========================================= CONTENT : END ========================================= -->
                </div>
        </section>

        <!-- / END SUBSCRIBE SECTION-->
        @include('includes.footer')
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
        <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
        <script>
                CKEDITOR.replace( 'description' );
                function enableBtn() {
                    $("#testimonial-submit-button").removeAttr("disabled");
                }
        </script>
@endsection