@extends('layouts.default')
@section('meta_title',$title)
@if(isset($data['pageData']))
@section('meta_keyword',$data['pageData']->meta_keyword)
@section('meta_description',$data['pageData']->meta_description)
@endif
@section('content')
@include('includes.menu')
@php
	//$date = DateTime::createFromFormat('Y-m-d H:i:s', "$blog->created_at");
@endphp
<section id="slider-seciton">
    <div class="header-bottom"></div>
    <div id="myCarousel" class="carousel slide inner-slider" data-ride="carousel">
        <div class="carousel-inner about-us" role="listbox" style="background:url({{URL::asset('public/pages')}}/{{Request::is('blog-single/'.$blog->slug)?'back-ground-3.jpg':'back-ground-5.jpg'}}) center center;">
            <span style="position: absolute;width: 100%;height: 100%;background: #0000007a;">
                <h1 class="banner-title blogsingtitle">{{Request::is('blog-single/'.$blog->slug)?'BLOG':'COMMUNITY'}}</h1>
            </span>
        </div>
    </div>
</section>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0-11/css/all.css">
<div class="wrapper wrapper--blood">
<section class="blog-single container">
        <div class="col-sm-8">
        <article class="posts-details-body-left">
        <div class="events-lists-item-right">
        <h2 class="head2">{{ucfirst($blog->name)}}</h2>
                    <div class="events-item-right-header">
                        <div class="event-item-info">
                            <ul class="list-inline">
                                <li class="list-inline-item"><a href="#"><i class="fas fa-calendar" aria-hidden="true"></i>&nbsp; {{substr($blog->month,0,3)}} {{$blog->display_dates}}</a></li>
                                <li class="list-inline-item"><a href="{{$url}}/{{$blog->categories->slug}}"><i class="fas fa-tag" aria-hidden="true"></i>&nbsp; {{$blog->categories->name}}</a></li>
                                <li class="list-inline-item"><a href="#"><i class="fas fa-user" aria-hidden="true"></i>&nbsp; {{isset($blog->user->name)?$blog->user->name:(isset($blog->vendor->name)?$blog->vendor->name:'')}}</a></li>
                            </ul>
                        </div>
                        <div class="posts-details-left-share">
                            <p>
                                
                            </p>
                    </div>
                        </div>
                    <div class="clearfix"></div>
                </div>
            <section class="posts-details-left-img">
                <img src="{{url('public/images/blogs')}}/{{$blog->picture==null?'no-img.png':$blog->picture}}" alt="blog-single-image" class="img-responsive">
                <div class="event-item-time" style="display:none;">
                   
                </div>
            </section>
            <section class="posts-details-left-title">
                
            </section>
            <section class="posts-details-left-text resort-desc">
                <?php echo nl2br($blog->body); ?>
            </section>
            @if(!empty($blog->pdf))
            <div class="row">
                <div class="col-sm-12 text-center">
                    <a href="{{url('public/images/blogs').'/'.$blog->pdf}}" download target="_blank" class="btnFlat btnFlat--primary"><i class="fa fa-download"></i> Download PDF</a><br>
                </div>
            </div>
            @endif
            
        </article>
        </div>
        <div class="col-sm-4">
            <section class="relatedpost">
                <div class="row">
                    <div class="col-sm-12 blog-categgory" style="border-right:0;">
                        <h2>CATEGORIES</h2>
                        <hr class="my-4">
                        <ul>
                            <li><a href="{{$url}}">All Categories</a></li>
                            @if(isset($categories))
                            @foreach($categories as $cat)
                            <li><a href="{{$url}}/{{$cat->slug}}">{{$cat->name}}</a></li>
                            @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
                @if(Request::is('community-post/'.$blog->slug))
                <h3 style="padding-top: 25px;">Related Posts</h3>
                <hr class="my-4">
                <div class="row" >
                    @foreach($blogs as $blo)
                    <div class="col-sm-12">
                        <div class="blog shadow-sm" style="min-height: 0;">
                            <div class="blog-img" style="display:none;">
                                <img src="{{url('public/images/blogs')}}/{{$blo->picture == null?'no-img.png':$blo->picture}}" class="img-responsive" alt="blog-image">
                                <span class="blog-category">{{$blo->categories->name}}</span>
                                <span class="blog-category right">{{$blo->day}} - {{substr($blo->month,0,3)}}</span>
                            </div>
                            <div class="col-sm-4 col-lg-4 col-md-4 col-xs-4">
                                <a href="{{$single_url}}/{{$blo->slug}}"><img src="{{url('public/cimg/webroot/img.php?src=images/blogs')}}/{{$blo->picture == null?'no-img.png':$blo->picture}}" class="img-responsive blog-picture" alt="{{$blo->name}}"></a>
                            </div>
                            <div class="col-sm-8 col-lg-8 col-md-8 col-xs-8">
                                <div class="blog-info" style="padding:0;">
                                    <h3 class="post-title"><a href="{{$single_url}}/{{$blo->slug}}">{{$blo->name}}</a></h3>
                                    <p class="mb-4">{{substr(strip_tags($blo->excerpt),0,75)}}...</p>
                                    <a href="{{$single_url}}/{{$blo->slug}}" class="blogreadmore">{{Request::is('blogs'.(empty($slug)?'':'/'.$slug))?'Read More':'Read and Comment'}} <i class="fas fa-arrow-right align-middle"></i></a>
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>
                    @endforeach
                </div>
                @endif
            </section>
        </div>
        @if(Request::is('community-post/'.$blog->slug))
        <div class="col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">Comments</div>
                <div class="panel-body" style="padding: 15px 0 !important;">
                    @if(session()->has('success'))
                        <p class="text-success">{{session()->get('success')}}</p>
                    @endif
                    <form action="" class="comment" method="POST" style="background: transparent;border: 0;padding: 0px;margin: 0;border-radius: 0px;">
                        {{csrf_field()}}
                        @if(!Auth::guard('vendor')->check())
                        <div class="form-group col-md-6">
                            <input type="text" placeholder="Name" value="{{old('name')}}" class="form-control" name="name">
                            @if($errors->has('name')) <span class="text-danger">{{$errors->first('name')}}</span> @endif
                        </div>
                        <div class="form-group col-md-6">
                            <input type="email" placeholder="E-mail" class="form-control" value="{{old('email')}}" name="email">
                            @if($errors->has('email')) <span class="text-danger">{{$errors->first('email')}}</span> @endif
                        </div>
                        @endif
                        <div class="form-group col-md-12">
                            <textarea class="form-control" name="body" placeholder="type your comment here..." rows="8">{{old('body')}}</textarea>
                            @if($errors->has('body')) <span class="text-danger">{{$errors->first('body')}}</span> @endif
                        </div>
                        <div class="form-group col-md-12">
                            <button class="btn btn-primary" type="submit">Submit</button>
                            <button class="btnFlat btnFlat--grey ml10" type="reset">Clear</button>
                        </div>
                    </form>
                    @if(count($comments) > 0)
                    <div class="clearfix"></div>
                    <hr>
                    <ul class="media-list" style="padding: 15px;">
                        <?php
                            function time_elapsed_string($datetime, $full = false) {
                                $now = new DateTime;
                                $ago = new DateTime($datetime);
                                $diff = $now->diff($ago);
                                $diff->w = floor($diff->d / 7);
                                $diff->d -= $diff->w * 7;
                                $string = array('y'=>'year', 'm'=>'month', 'w'=>'week', 'd'=>'day', 'h'=>'hour', 'i'=>'minute', 's'=>'second');
                                foreach($string as $k => &$v) {
                                    if($diff->$k) {
                                        $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
                                    } else {
                                        unset($string[$k]);
                                    }
                                }
                                if (!$full) $string = array_slice($string, 0, 1);
                                return $string ? implode(', ', $string) . ' ago' : 'just now';
                            } ?>
                        @foreach($comments as $comment)
                        <li class="media" style="border-bottom: 1px dashed #efefef;margin-bottom: 25px;">
                            <a href="#" class="pull-left" style="position: relative;">
                                <svg class="avatar-generic" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200" preserveAspectRatio="xMidYMin slice" style="height: 64px">
                                    <circle fill="#C7C9C0" cx="100" cy="100" r="100"></circle>
                                    <text transform="translate(100,130)" y="0">
                                        <tspan font-size="90" class="" fill="rgba(0,0,0,0.3)" text-anchor="middle">{{strtoupper(substr($comment->name,0,1))}}</tspan>
                                    </text>
                                </svg>
                             </a>
                            <div class="media-body"> <span class="text-muted pull-right"> <small class="text-muted"><?php echo time_elapsed_string($comment->created_at); ?></small> </span> <strong class="text-success" style="color: #83021e !important;">{{'@'.(isset($comment->vendor->vendor_id) && $user_id == $comment->vendor->vendor_id ? 'You' : $comment->name)}}</strong><p>{{$comment->body}}</p></div>
                        </li>
                        @endforeach
                    </ul>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-sm-4"></div>
        @endif
    </section>
</div>
<!-- session script -->
@if((isset($errors) && count($errors) > 0) || session()->has('error') || session()->has('success'))
<script type="text/javascript">
    $(document).ready(function() {
        $('html, body').animate({
            scrollTop: $(".comment").offset().top-120
        }, 2000);
    });
</script>
@else
<script type="text/javascript">
    // alert(123);
</script>
@endif
@include('includes.footer')
@endsection