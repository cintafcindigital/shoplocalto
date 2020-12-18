@section('head')
<head>
    <meta http-equiv="Content-Type" content="text/html" charset="utf-8">
    <!-- Basic page needs
    ============================================ -->
    <meta name="description" content="">
    <meta name="author" content="">
    <title>{{ config('app.name', 'My Health Squad') }}</title>
    <!-- Mobile specific metas
    ============================================ -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Google web fonts
    ============================================ -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,700|Roboto:300,400,500,700|Dancing+Script" rel="stylesheet">
    <!-- Favicon
    ============================================ -->
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
    <!-- CSS  -->
    <!-- Bootstrap CSS
    ============================================ -->
    <link rel="stylesheet" href="{{url('public/css/bootstrap.min.css')}}">
    <!-- font-awesome CSS
    ============================================ -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{url('public/css/bootstrap-select.css')}}">
    <!-- owl.carousel CSS
    ============================================ -->
    <link rel="stylesheet" href="{{url('public/css/owl.carousel.css')}}">
    <link rel="stylesheet" href="{{url('public/css/owl.theme.css')}}">
    <!-- animate CSS
    ============================================ -->
    <link rel="stylesheet" href="{{url('public/css/animate.css')}}">
    <!-- SuperSlider CSS
    ============================================ -->
    <!-- main CSS
    ============================================ -->        
    <link rel="stylesheet" href="{{url('public/css/style.css')}}">
    <!-- responsive CSS
    ============================================ -->        
    <link rel="stylesheet" href="{{url('public/css/responsive.css')}}">
    <!-- prettyPhoto CSS
    ============================================ -->        
    <link rel="stylesheet" href="{{url('public/css/lightbox.min.css')}}">
    <!-- prettyPhoto CSS
    ============================================ -->        
    <link rel="stylesheet" href="{{url('public/css/prettyPhoto.css')}}">
    <!-- modernizr js
    ============================================ -->        
    <script src="{{url('public/js/modernizr.js')}}"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
@stop