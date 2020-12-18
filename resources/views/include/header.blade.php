<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="" />
    <meta name="keywords" content="">
    <meta name="author" content="Codedthemes" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'ShopLocalTo') }}</title>
    <!-- Favicon icon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{url('public/images/frontend/ShopLocalTO-Logo.png')}}">
    <link rel="shortcut icon" type="image/png" href="{{url('public/images/frontend/ShopLocalTO-Logo.png')}}">
    <link rel="icon" type="image/png" href="{{url('public/images/frontend/ShopLocalTO-Logo.png')}}">
    <!-- CSS Files -->
    <link rel="stylesheet" href="{{url('assets/css/plugins/daterangepicker.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/plugins/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/plugins/select2.min.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/plugins/dragula.min.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/plugins/fullcalendar.min.css')}}">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- vendor css -->
    <link rel="stylesheet" href="{{url('assets/css/style.css')}}">
    <link rel="stylesheet" href="{{url('public/css/select2.min.css')}}" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" />
    <script src="{{url('assets/js/vendor-all.min.js')}}"></script>
    <style>
        a.result-entry:hover {
            background: #EEE;
        }
        .tox-notification { 
            display: none !important;
        }
    </style>
</head>
<body class="">
	<div class="loader-bg">
		<div class="loader-track">
			<div class="loader-fill"></div>
		</div>
	</div><!-- [ Pre-loader ] End -->
	<nav class="pcoded-navbar dashboard-nav menupos-fixed">
		<div class="navbar-wrapper">
			<div class="navbar-content scroll-div">
				@if(Session::get('adminData')[0]['role'] == 1) <!-- Super Admin -->
				<ul class="nav pcoded-inner-navbar">
					<!--<li class="nav-item pcoded-menu-caption"><label>Dashboard</label></li>-->
					<li class="nav-item active"><a href="{{url('/admin/dashboard')}}" class="nav-link "><span class="pcoded-micon"><i class="fas fa-tachometer-alt"></i></span><span class="pcoded-mtext">Dashboard</span></a></li>
					<li class="nav-item">
						<a href="{{url('admin/admin-setting')}}" class="nav-link "><span class="pcoded-micon"><i class="fas fa-user-circle"></i></span><span class="pcoded-mtext">Manage Admin</span></a>
					</li>
					<li class="nav-item pcoded-hasmenu">
						<a href="javascript:;" class="nav-link "><span class="pcoded-micon"><i class="fas fa-user-circle"></i></span><span class="pcoded-mtext">Blog
						@if($catblogs > 0 || $pendblogs > 0)
									&nbsp;<span class="badge badge-circular badge-info">{{$catblogs+$pendblogs}}</span>
								@endif
								</span></a>
						<ul class="pcoded-submenu">
							<li><a href="{{url('/admin/blog-category')}}">Categories
								@if($catblogs > 0)
									&nbsp;<span class="badge badge-circular badge-info">{{$catblogs}}</span>
								@endif
							</a></li>
							<li><a href="{{url('admin/blog')}}">All Articles
							@if($pendblogs > 0)
									&nbsp;<span class="badge badge-circular badge-info">{{$pendblogs}}</span>
								@endif
							</a></li>
						</ul>
					</li>
					
					<li class="nav-item pcoded-hasmenu">
						<a href="javascript:;" class="nav-link "><span class="pcoded-micon"><i class="fas fa-user-tie"></i></span><span class="pcoded-mtext">Vendors</span></a>
						<ul class="pcoded-submenu">
							<li><a href="{{url('admin/vendors')}}">All Vendors</a></li>
							<li><a href="{{url('admin/vendors/active')}}">Active Vendors</a></li>
							<li><a href="{{url('admin/vendors/featured')}}">Featured Vendors</a></li>
							<!--<li><a href="{{url('admin/freelisting-vendors')}}">Free Listing Vendors</a></li>-->
							<li><a href="{{url('admin/vendors/inactive')}}">Inactive Vendors
									@if($inactiveVendors > 0)
										&nbsp;<span class="badge badge-circular badge-info">{{$inactiveVendors}}</span>
									@endif
								</a>
							</li>
							
						</ul>
					</li>
					
					<li class="nav-item pcoded-hasmenu">
						<a href="javascript:;" class="nav-link "><span class="pcoded-micon"><i class="fas fa-user-circle"></i></span><span class="pcoded-mtext">Manage Site Services</span></a>
						<ul class="pcoded-submenu">
							<li><a href="{{url('admin/categories')}}">Manage Categories</a></li>
							<li><a href="{{url('admin/pages')}}">Manage Pages</a></li>
							<li><a href="{{url('admin/add-slider')}}">Manage Sliders</a></li>
							<li><a href="{{url('admin/add-banner')}}">Manage Banners</a></li>
							<li><a href="{{url('admin/add-features')}}">Manage Features</a></li>
							<li><a href="{{url('admin/admin-testimonials')}}">Manage Testimonials</a></li>
							<li><a href="{{url('admin/manage-menus')}}">Manage Menus</a></li>
						</ul>
					</li>
					
					<li class="nav-item pcoded-hasmenu">
						<a href="javascript:;" class="nav-link "><span class="pcoded-micon"><i class="fas fa-user-circle"></i></span><span class="pcoded-mtext">Featured Profiles</span></a>
						<ul class="pcoded-submenu">
							<li><a href="{{url('admin/featured-profiles')}}">Featured Profiles</a></li>
							<li><a href="{{url('admin/featured-profile-vendors')}}">Vendors</a></li>
						</ul>
					</li>
					
					<li class="nav-item pcoded-hasmenu">
						<a href="javascript:;" class="nav-link "><span class="pcoded-micon"><i class="fas fa-user-circle"></i></span><span class="pcoded-mtext">Enquiry</span></a>
						<ul class="pcoded-submenu">
						    <li><a href="{{url('admin/signup-enquiry')}}">Signup Enquiry</a></li>
						    <!-- <li><a href="{{url('admin/list-claim-enquiry')}}">Listing Claim Enquiry</a></li>
							<li><a href="{{url('admin/request-enquiry')}}">Request Enquiry</a></li> -->
							<li><a href="{{url('admin/contact-enquiry')}}">Contact-Us Enquiry</a></li>
						</ul>
					</li>
					<li class="nav-item pcoded-hasmenu">
						<a href="javascript:;" class="nav-link "><span class="pcoded-micon"><i class="fas fa-user-circle"></i></span><span class="pcoded-mtext">Locations</span></a>
						<ul class="pcoded-submenu">
						    <li><a href="{{url('admin/districts')}}">Districts</a></li>
						    <!-- <li><a href="{{url('admin/list-claim-enquiry')}}">Listing Claim Enquiry</a></li>
							<li><a href="{{url('admin/request-enquiry')}}">Request Enquiry</a></li> -->
							<li><a href="{{url('admin/communities')}}">Community</a></li>
						</ul>
					</li>
					<li class="nav-item">
						<a href="{{url('admin/subscribers')}}" class="nav-link "><span class="pcoded-micon"><i class="fas fa-user-circle"></i></span><span class="pcoded-mtext">Subscribers</span></a>
					</li>
					<!-- <li class="nav-item">
						<a href="{{url('admin/site-settings')}}" class="nav-link "><span class="pcoded-micon"><i class="fas fa-key"></i></span><span class="pcoded-mtext">Site Settings</span></a>
					</li> -->
					
				</ul>
				@elseif(Session::get('adminData')[0]['role'] == 2) <!-- Admin -->
				<ul class="nav pcoded-inner-navbar">
					<li class="nav-item pcoded-menu-caption"><label>Dashboard</label></li>
					<li class="nav-item active"><a href="{{url('/admin/dashboard')}}" class="nav-link "><span class="pcoded-micon"><i class="fas fa-tachometer-alt"></i></span><span class="pcoded-mtext">Dashboard</span></a></li>
					<li class="nav-item pcoded-hasmenu">
						<a href="javascript:;" class="nav-link "><span class="pcoded-micon"><i class="fas fa-user-circle"></i></span><span class="pcoded-mtext">Blog
						@if($catblogs > 0 || $pendblogs > 0)
									&nbsp;<span class="badge badge-circular badge-info">{{$catblogs+$pendblogs}}</span>
								@endif
								</span></a>
						<ul class="pcoded-submenu">
							<li><a href="{{url('/admin/blog-category')}}">Categories
															@if($catblogs > 0)
									&nbsp;<span class="badge badge-circular badge-info">{{$catblogs}}</span>
								@endif
								</a></li>
							<li><a href="{{url('admin/blog')}}">All Articles 
							@if($pendblogs > 0)
									&nbsp;<span class="badge badge-circular badge-info">{{$pendblogs}}</span>
								@endif
								</a></li>
						</ul>
					</li>
					<li class="nav-item pcoded-hasmenu">
						<a href="javascript:;" class="nav-link "><span class="pcoded-micon"><i class="fas fa-user-circle"></i></span><span class="pcoded-mtext">Community
							@if($comblogs > 0 || $comentblogs > 0)
									&nbsp;<span class="badge badge-circular badge-info">{{$comblogs+$comentblogs}}</span>
								@endif
						</span></a>
						<ul class="pcoded-submenu">
							<li><a href="{{url('admin/community')}}">All Articles</a></li>
							<li><a href="{{url('admin/community/active')}}">Active Articles</a></li>
							<li><a href="{{url('admin/community/pending')}}">Pending Articles
							@if($comblogs > 0)
									&nbsp;<span class="badge badge-circular badge-info">{{$comblogs}}</span>
								@endif </a></li>
								<li><a href="{{url('admin/community-comments')}}">All Comments</a></li>
							<li><a href="{{url('admin/community-comments/approved')}}">Approved Comments</a></li>
							<li><a href="{{url('admin/community-comments/pending')}}">Pending Comments
							@if($comentblogs > 0)
									&nbsp;<span class="badge badge-circular badge-info">{{$comentblogs}}</span>
								@endif
								</a></li>
						</ul>
					</li>
					
					<li class="nav-item pcoded-hasmenu">
						<a href="javascript:;" class="nav-link "><span class="pcoded-micon"><i class="fas fa-user-tie"></i></span><span class="pcoded-mtext">Vendors</span></a>
						<ul class="pcoded-submenu">
							<li><a href="{{url('admin/vendors')}}">All Vendors</a></li>
							<li><a href="{{url('admin/vendors/active')}}">Active Vendors</a></li>
							<li><a href="{{url('admin/vendors/featured')}}">Featured Vendors</a></li>
							<!--<li><a href="{{url('admin/freelisting-vendors')}}">Free Listing Vendors</a></li>-->
							<li><a href="{{url('admin/vendors/inactive')}}">Inactive Vendors
									@if($inactiveVendors > 0)
										&nbsp;<span class="badge badge-circular badge-info">{{$inactiveVendors}}</span>
									@endif
								</a>
							</li>
							
							<li><a href="{{url('admin/import-vendors')}}">Import Vendors</a></li>
						</ul>
					</li>
					
					<li class="nav-item pcoded-hasmenu d-none">
						<a href="javascript:;" class="nav-link "><span class="pcoded-micon"><i class="fas fa-user-circle"></i></span><span class="pcoded-mtext">Community</span></a>
						<ul class="pcoded-submenu">
							<li><a href="{{url('admin/community')}}">All Posts</a></li>
							<li><a href="{{url('admin/pending-community')}}">Pending Posts</a></li>
							<li><a href="{{url('admin/active-community')}}">Active Posts</a></li>
						</ul>
					</li>
					<li class="nav-item pcoded-hasmenu d-none">
						<a href="javascript:;" class="nav-link "><span class="pcoded-micon"><i class="fas fa-user-circle"></i></span><span class="pcoded-mtext">Blog Categories</span></a>
						<ul class="pcoded-submenu">
							<li><a href="{{url('admin/weddingideas')}}">All Blog Category</a></li>
							<li><a href="{{url('admin/pending-weddingideas')}}">Pending Blog Categories</a></li>
							<li><a href="{{url('admin/active-weddingideas')}}">Active Blog Categories</a></li>
						</ul>
					</li>
					<li class="nav-item pcoded-hasmenu">
						<a href="javascript:;" class="nav-link "><span class="pcoded-micon"><i class="fas fa-user-circle"></i></span><span class="pcoded-mtext">Manage Site Services</span></a>
						<ul class="pcoded-submenu">
							<li><a href="{{url('admin/categories')}}">Manage Categories</a></li>
							<li><a href="{{url('admin/pages')}}">Manage Pages</a></li>
							<li><a href="{{url('admin/add-slider')}}">Manage Sliders</a></li>
							<li><a href="{{url('admin/subscription')}}">Subscription</a></li>
							<li><a href="{{url('admin/promocodes')}}">Promocodes</a></li>
							
							<li><a href="{{url('admin/newsletter')}}">Newsletter</a></li>
							<li><a href="{{url('admin/admin-testimonials')}}">Testimonials</a></li>
						</ul>
					</li>
					
					<li class="nav-item pcoded-hasmenu">
						<a href="javascript:;" class="nav-link "><span class="pcoded-micon"><i class="fas fa-user-circle"></i></span><span class="pcoded-mtext">Marketing</span></a>
						<ul class="pcoded-submenu">
							<li><a href="javascript:;">New Leads</a></li>
							<li><a href="javascript:;">Email Deployment</a></li>
						</ul>
					</li>
					<li class="nav-item pcoded-hasmenu">
						<a href="javascript:;" class="nav-link ">
							<span class="pcoded-micon"><i class="fas fa-user-circle"></i></span>
							<span class="pcoded-mtext">Tickets 
								@if($ticketSectionTotal > 0)
									&nbsp;<span class="badge badge-circular badge-info">{{$ticketSectionTotal}}</span>
								@endif
							</span>
						</a>
						<ul class="pcoded-submenu">
							<li><a href="{{url('admin/new-tickets')}}">New Tickets 
									@if($ticketSectionNew > 0)
										&nbsp;<span class="badge badge-circular badge-info">{{$ticketSectionNew}}</span>
									@endif
								</a>
							</li>
							<li><a href="{{url('admin/pending-tickets')}}">Pending Tickets 
									@if($ticketSectionPending > 0)
										&nbsp;<span class="badge badge-circular badge-info">{{$ticketSectionPending}}</span>
									@endif
								</a>
							</li>
							<li><a href="{{url('admin/closed-tickets')}}">Closed Tickets</a></li>
						</ul>
					</li>
					<li class="nav-item pcoded-hasmenu">
						<a href="javascript:;" class="nav-link "><span class="pcoded-micon"><i class="fas fa-user-circle"></i></span><span class="pcoded-mtext">Staff</span></a>
						<ul class="pcoded-submenu">
							<li><a href="{{url('admin/staff')}}">All Staff</a></li>
						</ul>
					</li>
					<li class="nav-item pcoded-hasmenu">
						<a href="javascript:;" class="nav-link "><span class="pcoded-micon"><i class="fas fa-user-circle"></i></span><span class="pcoded-mtext">Enquiry</span></a>
						<ul class="pcoded-submenu">
							<li><a href="{{url('admin/request-enquiry')}}">Request Enquiry</a></li>
							<li><a href="{{url('admin/contact-enquiry')}}">Contact-Us Enquiry</a></li>
						</ul>
					</li>
					<li class="nav-item pcoded-hasmenu d-none">
						<a href="javascript:;" class="nav-link "><span class="pcoded-micon"><i class="fas fa-user-circle"></i></span><span class="pcoded-mtext">Wedding Dresses</span></a>
						<ul class="pcoded-submenu">
							<li><a href="{{url('admin/weddingdress')}}">Wedding Dress Type</a></li>
							<li><a href="{{url('admin/weddingdress-designer')}}">Wedding Dress Designer</a></li>
							<li><a href="{{url('admin/weddingdress-collections')}}">Wedding Dress Collections</a></li>
							<li><a href="{{url('admin/weddingdress-products')}}">Wedding Dress Product</a></li>
						</ul>
					</li>
				</ul>
				@elseif(Session::get('adminData')[0]['role'] == 3) <!-- Sales Representative -->
				<ul class="nav pcoded-inner-navbar">
					<li class="nav-item pcoded-menu-caption"><label>Dashboard</label></li>
					<li class="nav-item active"><a href="{{url('/admin/dashboard')}}" class="nav-link "><span class="pcoded-micon"><i class="fas fa-tachometer-alt"></i></span><span class="pcoded-mtext">Dashboard</span></a></li>
					<li class="nav-item pcoded-hasmenu">
						<a href="javascript:;" class="nav-link "><span class="pcoded-micon"><i class="fas fa-user-circle"></i></span><span class="pcoded-mtext">Blog
						@if($catblogs > 0 || $pendblogs > 0)
									&nbsp;<span class="badge badge-circular badge-info">{{$catblogs+$pendblogs}}</span>
								@endif
						</span></a>
						<ul class="pcoded-submenu">
							<li><a href="{{url('/admin/blog-category')}}">Categories
															@if($catblogs > 0)
									&nbsp;<span class="badge badge-circular badge-info">{{$catblogs}}</span>
								@endif
								</a></li>
							<li><a href="{{url('admin/blog')}}">All Articles
							@if($pendblogs > 0)
									&nbsp;<span class="badge badge-circular badge-info">{{$pendblogs}}</span>
								@endif
								</a></li>
						</ul>
					</li>
					<li class="nav-item pcoded-hasmenu">
						<a href="javascript:;" class="nav-link "><span class="pcoded-micon"><i class="fas fa-user-circle"></i></span><span class="pcoded-mtext">Community 
							@if($comblogs > 0 || $comentblogs > 0)
									&nbsp;<span class="badge badge-circular badge-info">{{$comblogs+$comentblogs}}</span>
								@endif
						</span></a>
						<ul class="pcoded-submenu">
							<li><a href="{{url('admin/community')}}">All Articles</a></li>
							<li><a href="{{url('admin/community/active')}}">Active Articles</a></li>
							<li><a href="{{url('admin/community/pending')}}">Pending Articles
							@if($comblogs > 0)
									&nbsp;<span class="badge badge-circular badge-info">{{$comblogs}}</span>
								@endif</a></li>
								<li><a href="{{url('admin/community-comments')}}">All Comments</a></li>
							<li><a href="{{url('admin/community-comments/approved')}}">Approved Comments</a></li>
							<li><a href="{{url('admin/community-comments/pending')}}">Pending Comments
							@if($comentblogs > 0)
									&nbsp;<span class="badge badge-circular badge-info">{{$comentblogs}}</span>
								@endif
								</a></li>
						</ul>
					</li>
					
					<li class="nav-item pcoded-hasmenu">
						<a href="javascript:;" class="nav-link "><span class="pcoded-micon"><i class="fas fa-user-tie"></i></span><span class="pcoded-mtext">Vendors</span></a>
						<ul class="pcoded-submenu">
							<li><a href="{{url('admin/vendors')}}">All Vendors</a></li>
							<li><a href="{{url('admin/vendors/active')}}">Active Vendors</a></li>
							<li><a href="{{url('admin/vendors/featured')}}">Featured Vendors</a></li>
							<!--<li><a href="{{url('admin/freelisting-vendors')}}">Free Listing Vendors</a></li>-->
							<li><a href="{{url('admin/vendors/inactive')}}">Inactive Vendors
									@if($inactiveVendors > 0)
										&nbsp;<span class="badge badge-circular badge-info">{{$inactiveVendors}}</span>
									@endif
								</a>
							</li>
							
							<li><a href="{{url('admin/import-vendors')}}">Import Vendors</a></li>
						</ul>
					</li>
					<li class="nav-item pcoded-hasmenu d-none">
						<a href="javascript:;" class="nav-link "><span class="pcoded-micon"><i class="fas fa-user-circle"></i></span><span class="pcoded-mtext">Community</span></a>
						<ul class="pcoded-submenu">
							<li><a href="{{url('admin/community')}}">All Posts</a></li>
							<li><a href="{{url('admin/pending-community')}}">Pending Posts</a></li>
							<li><a href="{{url('admin/active-community')}}">Active Posts</a></li>
						</ul>
					</li>
					<li class="nav-item pcoded-hasmenu d-none">
						<a href="javascript:;" class="nav-link "><span class="pcoded-micon"><i class="fas fa-user-circle"></i></span><span class="pcoded-mtext">Blog Categories</span></a>
						<ul class="pcoded-submenu">
							<li><a href="{{url('admin/weddingideas')}}">All Blog Categories</a></li>
							<li><a href="{{url('admin/pending-weddingideas')}}">Pending Blog Categories</a></li>
							<li><a href="{{url('admin/active-weddingideas')}}">Active Blog Categories</a></li>
						</ul>
					</li>
					
					<li class="nav-item pcoded-hasmenu">
						<a href="javascript:;" class="nav-link ">
							<span class="pcoded-micon"><i class="fas fa-user-circle"></i></span>
							<span class="pcoded-mtext">Tickets 
								@if($ticketSectionTotal > 0)
									&nbsp;<span class="badge badge-circular badge-info">{{$ticketSectionTotal}}</span>
								@endif
							</span>
						</a>
						<ul class="pcoded-submenu">
							<li><a href="{{url('admin/new-tickets')}}">New Tickets 
									@if($ticketSectionNew > 0)
										&nbsp;<span class="badge badge-circular badge-info">{{$ticketSectionNew}}</span>
									@endif
								</a>
							</li>
							<li><a href="{{url('admin/pending-tickets')}}">Pending Tickets 
									@if($ticketSectionPending > 0)
										&nbsp;<span class="badge badge-circular badge-info">{{$ticketSectionPending}}</span>
									@endif
								</a>
							</li>
							<li><a href="{{url('admin/closed-tickets')}}">Closed Tickets</a></li>
						</ul>
					</li>
					<li class="nav-item pcoded-hasmenu">
						<a href="javascript:;" class="nav-link "><span class="pcoded-micon"><i class="fas fa-user-circle"></i></span><span class="pcoded-mtext">Enquiry</span></a>
						<ul class="pcoded-submenu">
							<li><a href="{{url('admin/request-enquiry')}}">Request Enquiry</a></li>
							<li><a href="{{url('admin/contact-enquiry')}}">Contact-Us Enquiry</a></li>
						</ul>
					</li>
				</ul>
				@elseif(Session::get('adminData')[0]['role'] == 4) <!-- Marketing Support -->
				<ul class="nav pcoded-inner-navbar">
					<li class="nav-item pcoded-menu-caption"><label>Dashboard</label></li>
					<li class="nav-item active"><a href="{{url('/admin/dashboard')}}" class="nav-link "><span class="pcoded-micon"><i class="fas fa-tachometer-alt"></i></span><span class="pcoded-mtext">Dashboard</span></a></li>
					<li class="nav-item pcoded-hasmenu">
						<a href="javascript:;" class="nav-link "><span class="pcoded-micon"><i class="fas fa-user-circle"></i></span><span class="pcoded-mtext">Blog
						@if($catblogs > 0 || $pendblogs > 0)
									&nbsp;<span class="badge badge-circular badge-info">{{$catblogs+$pendblogs}}</span>
								@endif
								</span></a>
						<ul class="pcoded-submenu">
							<li><a href="{{url('/admin/blog-category')}}">Categories
															@if($catblogs > 0)
									&nbsp;<span class="badge badge-circular badge-info">{{$catblogs}}</span>
								@endif
							</a></li>
							<li><a href="{{url('admin/blog')}}">All Articles
							@if($pendblogs > 0)
									&nbsp;<span class="badge badge-circular badge-info">{{$pendblogs}}</span>
								@endif
							</a></li>
						</ul>
					</li>
					<li class="nav-item pcoded-hasmenu">
						<a href="javascript:;" class="nav-link "><span class="pcoded-micon"><i class="fas fa-user-circle"></i></span><span class="pcoded-mtext">Community
							@if($comblogs > 0 || $comentblogs > 0)
									&nbsp;<span class="badge badge-circular badge-info">{{$comblogs+$comentblogs}}</span>
								@endif
						</span></a>
						<ul class="pcoded-submenu">
							<li><a href="{{url('admin/community')}}">All Articles</a></li>
							<li><a href="{{url('admin/community/active')}}">Active Articles</a></li>
							<li><a href="{{url('admin/community/pending')}}">Pending Articles
							@if($comblogs > 0)
									&nbsp;<span class="badge badge-circular badge-info">{{$comblogs}}</span>
								@endif</a></li>
						</ul>
					</li>
					
					<li class="nav-item pcoded-hasmenu d-none">
						<a href="javascript:;" class="nav-link "><span class="pcoded-micon"><i class="fas fa-user-circle"></i></span><span class="pcoded-mtext">Community</span></a>
						<ul class="pcoded-submenu">
							<li><a href="{{url('admin/community')}}">All Posts</a></li>
							<li><a href="{{url('admin/pending-community')}}">Pending Posts</a></li>
							<li><a href="{{url('admin/active-community')}}">Active Posts</a></li>
						</ul>
					</li>
					<li class="nav-item pcoded-hasmenu d-none">
						<a href="javascript:;" class="nav-link "><span class="pcoded-micon"><i class="fas fa-user-circle"></i></span><span class="pcoded-mtext">Blog Categories</span></a>
						<ul class="pcoded-submenu">
							<li><a href="{{url('admin/weddingideas')}}">All Blog Categories</a></li>
							<li><a href="{{url('admin/pending-weddingideas')}}">Pending Blog Categories</a></li>
							<li><a href="{{url('admin/active-weddingideas')}}">Active Blog Categories</a></li>
						</ul>
					</li>
					
					<li class="nav-item pcoded-hasmenu">
						<a href="javascript:;" class="nav-link "><span class="pcoded-micon"><i class="fas fa-user-circle"></i></span><span class="pcoded-mtext">Marketing</span></a>
						<ul class="pcoded-submenu">
							<li><a href="javascript:;">New Leads</a></li>
							<li><a href="javascript:;">Email Deployment</a></li>
						</ul>
					</li>
					<li class="nav-item pcoded-hasmenu">
						<a href="javascript:;" class="nav-link ">
							<span class="pcoded-micon"><i class="fas fa-user-circle"></i></span>
							<span class="pcoded-mtext">Tickets 
								@if($ticketSectionTotal > 0)
									&nbsp;<span class="badge badge-circular badge-info">{{$ticketSectionTotal}}</span>
								@endif
							</span>
						</a>
						<ul class="pcoded-submenu">
							<li><a href="{{url('admin/new-tickets')}}">New Tickets 
									@if($ticketSectionNew > 0)
										&nbsp;<span class="badge badge-circular badge-info">{{$ticketSectionNew}}</span>
									@endif
								</a>
							</li>
							<li><a href="{{url('admin/pending-tickets')}}">Pending Tickets 
									@if($ticketSectionPending > 0)
										&nbsp;<span class="badge badge-circular badge-info">{{$ticketSectionPending}}</span>
									@endif
								</a>
							</li>
							<li><a href="{{url('admin/closed-tickets')}}">Closed Tickets</a></li>
						</ul>
					</li>
				</ul>
				@elseif(Session::get('adminData')[0]['role'] == 5) <!-- Customer Service -->
				<ul class="nav pcoded-inner-navbar">
					<li class="nav-item pcoded-menu-caption"><label>Dashboard</label></li>
					<li class="nav-item active"><a href="{{url('/admin/dashboard')}}" class="nav-link "><span class="pcoded-micon"><i class="fas fa-tachometer-alt"></i></span><span class="pcoded-mtext">Dashboard</span></a></li>
					<li class="nav-item pcoded-hasmenu">
						<a href="javascript:;" class="nav-link "><span class="pcoded-micon"><i class="fas fa-user-circle"></i></span><span class="pcoded-mtext">Blog
						@if($catblogs > 0 || $pendblogs > 0)
									&nbsp;<span class="badge badge-circular badge-info">{{$catblogs+$pendblogs}}</span>
								@endif
								</span></a>
						<ul class="pcoded-submenu">
							<li><a href="{{url('/admin/blog-category')}}">Categories
															@if($catblogs > 0)
									&nbsp;<span class="badge badge-circular badge-info">{{$catblogs}}</span>
								@endif
							</a></li>
							<li><a href="{{url('admin/blog')}}">All Articles
							@if($pendblogs > 0)
									&nbsp;<span class="badge badge-circular badge-info">{{$pendblogs}}</span>
								@endif
							</a></li>
						</ul>
					</li>
					<li class="nav-item pcoded-hasmenu">
						<a href="javascript:;" class="nav-link "><span class="pcoded-micon"><i class="fas fa-user-circle"></i></span><span class="pcoded-mtext">Community	
						@if($comblogs > 0 || $comentblogs > 0)
									&nbsp;<span class="badge badge-circular badge-info">{{$comblogs+$comentblogs}}</span>
								@endif
								</span></a>
						<ul class="pcoded-submenu">
							<li><a href="{{url('admin/community')}}">All Articles</a></li>
							<li><a href="{{url('admin/community/active')}}">Active Articles</a></li>
							<li><a href="{{url('admin/community/pending')}}">Pending Articles
							@if($comblogs > 0)
									&nbsp;<span class="badge badge-circular badge-info">{{$comblogs}}</span>
								@endif</a></li>
						</ul>
					</li>
					
					<li class="nav-item pcoded-hasmenu">
						<a href="javascript:;" class="nav-link "><span class="pcoded-micon"><i class="fas fa-user-tie"></i></span><span class="pcoded-mtext">Vendors</span></a>
						<ul class="pcoded-submenu">
							<li><a href="{{url('admin/vendors')}}">All Vendors</a></li>
							<li><a href="{{url('admin/vendors/active')}}">Active Vendors</a></li>
							<li><a href="{{url('admin/vendors/featured')}}">Featured Vendors</a></li>
							
							<li><a href="{{url('admin/vendors/inactive')}}">Inactive Vendors
									@if($inactiveVendors > 0)
										&nbsp;<span class="badge badge-circular badge-info">{{$inactiveVendors}}</span>
									@endif
								</a>
							</li>
							
							<li><a href="{{url('admin/import-vendors')}}">Import Vendors</a></li>
						</ul>
					</li>
					
					<li class="nav-item pcoded-hasmenu">
						<a href="javascript:;" class="nav-link "><span class="pcoded-micon"><i class="fas fa-user-circle"></i></span><span class="pcoded-mtext">Accounting</span></a>
						<ul class="pcoded-submenu">
							<li><a href="{{url('admin/all-invoices')}}">All Invoices</a></li>
						</ul>
					</li>
					<li class="nav-item pcoded-hasmenu">
						<a href="javascript:;" class="nav-link "><span class="pcoded-micon"><i class="fas fa-user-circle"></i></span><span class="pcoded-mtext">Featured Profiles</span></a>
						<ul class="pcoded-submenu">
							<li><a href="{{url('admin/featured-profiles')}}">Featured Profiles</a></li>
							<li><a href="{{url('admin/featured-profile-vendors')}}">Vendors</a></li>
						</ul>
					</li>
					
					<li class="nav-item pcoded-hasmenu">
						<a href="javascript:;" class="nav-link ">
							<span class="pcoded-micon"><i class="fas fa-user-circle"></i></span>
							<span class="pcoded-mtext">Tickets 
								@if($ticketSectionTotal > 0)
									&nbsp;<span class="badge badge-circular badge-info">{{$ticketSectionTotal}}</span>
								@endif
							</span>
						</a>
						<ul class="pcoded-submenu">
							<li><a href="{{url('admin/new-tickets')}}">New Tickets 
									@if($ticketSectionNew > 0)
										&nbsp;<span class="badge badge-circular badge-info">{{$ticketSectionNew}}</span>
									@endif
								</a>
							</li>
							<li><a href="{{url('admin/pending-tickets')}}">Pending Tickets 
									@if($ticketSectionPending > 0)
										&nbsp;<span class="badge badge-circular badge-info">{{$ticketSectionPending}}</span>
									@endif
								</a>
							</li>
							<li><a href="{{url('admin/closed-tickets')}}">Closed Tickets</a></li>
						</ul>
					</li>
					<li class="nav-item pcoded-hasmenu">
						<a href="javascript:;" class="nav-link "><span class="pcoded-micon"><i class="fas fa-user-circle"></i></span><span class="pcoded-mtext">Enquiry</span></a>
						<ul class="pcoded-submenu">
						    <li><a href="{{url('admin/signup-enquiry')}}">Signup Enquiry</a></li>
						    <li><a href="{{url('admin/list-claim-enquiry')}}">Listing Claim Enquiry</a></li>
							<li><a href="{{url('admin/request-enquiry')}}">Request Enquiry</a></li>
							<li><a href="{{url('admin/contact-enquiry')}}">Contact-Us Enquiry</a></li>
						</ul>
					</li>
				</ul>
				@elseif(Session::get('adminData')[0]['role'] == 6) <!-- Technical Support -->
				<ul class="nav pcoded-inner-navbar">
					<li class="nav-item pcoded-menu-caption"><label>Dashboard</label></li>
					<li class="nav-item active"><a href="{{url('/admin/dashboard')}}" class="nav-link "><span class="pcoded-micon"><i class="fas fa-tachometer-alt"></i></span><span class="pcoded-mtext">Dashboard</span></a></li>
					<li class="nav-item pcoded-hasmenu">
						<a href="javascript:;" class="nav-link "><span class="pcoded-micon"><i class="fas fa-user-circle"></i></span><span class="pcoded-mtext">Blog
						@if($catblogs > 0 || $pendblogs > 0)
									&nbsp;<span class="badge badge-circular badge-info">{{$catblogs+$pendblogs}}</span>
								@endif
								</span></a>
						<ul class="pcoded-submenu">
							<li><a href="{{url('/admin/blog-category')}}">Categories
															@if($catblogs > 0)
									&nbsp;<span class="badge badge-circular badge-info">{{$catblogs}}</span>
								@endif
							</a></li>
							<li><a href="{{url('admin/blog')}}">All Articles
							@if($pendblogs > 0)
									&nbsp;<span class="badge badge-circular badge-info">{{$pendblogs}}</span>
								@endif
								</a></li>
						</ul>
					</li>
					<li class="nav-item pcoded-hasmenu">
						<a href="javascript:;" class="nav-link "><span class="pcoded-micon"><i class="fas fa-user-circle"></i></span><span class="pcoded-mtext">Community
							@if($comblogs > 0 || $comentblogs > 0)
									&nbsp;<span class="badge badge-circular badge-info">{{$comblogs+$comentblogs}}</span>
								@endif
						</span></a>
						<ul class="pcoded-submenu">
							<li><a href="{{url('admin/community')}}">All Articles</a></li>
							<li><a href="{{url('admin/community/active')}}">Active Articles</a></li>
							<li><a href="{{url('admin/community/pending')}}">Pending Articles
								@if($comblogs > 0)
									&nbsp;<span class="badge badge-circular badge-info">{{$comblogs}}</span>
								@endif
							</a></li>
							<li><a href="{{url('admin/community-comments')}}">All Comments</a></li>
							<li><a href="{{url('admin/community-comments/approved')}}">Approved Comments</a></li>
							<li><a href="{{url('admin/community-comments/pending')}}">Pending Comments
							@if($comentblogs > 0)
									&nbsp;<span class="badge badge-circular badge-info">{{$comentblogs}}</span>
								@endif
								</a></li>
						</ul>
					</li>
					
					<li class="nav-item pcoded-hasmenu">
						<a href="javascript:;" class="nav-link "><span class="pcoded-micon"><i class="fas fa-user-tie"></i></span><span class="pcoded-mtext">Vendors</span></a>
						<ul class="pcoded-submenu">
							<li><a href="{{url('admin/vendors')}}">All Vendors</a></li>
							<li><a href="{{url('admin/vendors/active')}}">Active Vendors</a></li>
							<li><a href="{{url('admin/vendors/featured')}}">Featured Vendors</a></li>
							
							<li><a href="{{url('admin/vendors/inactive')}}">Inactive Vendors
									@if($inactiveVendors > 0)
										&nbsp;<span class="badge badge-circular badge-info">{{$inactiveVendors}}</span>
									@endif
								</a>
							</li>
							
							<li><a href="{{url('admin/import-vendors')}}">Import Vendors</a></li>
						</ul>
					</li>
					
					<li class="nav-item pcoded-hasmenu">
						<a href="javascript:;" class="nav-link "><span class="pcoded-micon"><i class="fas fa-user-circle"></i></span><span class="pcoded-mtext">Manage Site Services</span></a>
						<ul class="pcoded-submenu">
							<li><a href="{{url('admin/categories')}}">Manage Categories</a></li>
							<li><a href="{{url('admin/pages')}}">Manage Pages</a></li>
							<li><a href="{{url('admin/add-slider')}}">Manage Sliders</a></li>
							<li><a href="{{url('admin/subscription')}}">Subscription</a></li>
							<li><a href="{{url('admin/promocodes')}}">Promocodes</a></li>
							
							<li><a href="{{url('admin/newsletter')}}">Newsletter</a></li>
							<li><a href="{{url('admin/admin-testimonials')}}">Testimonials</a></li>
						</ul>
					</li>
					<li class="nav-item pcoded-hasmenu">
						<a href="javascript:;" class="nav-link ">
							<span class="pcoded-micon"><i class="fas fa-user-circle"></i></span>
							<span class="pcoded-mtext">Tickets 
								@if($ticketSectionTotal > 0)
									&nbsp;<span class="badge badge-circular badge-info">{{$ticketSectionTotal}}</span>
								@endif
							</span>
						</a>
						<ul class="pcoded-submenu">
							<li><a href="{{url('admin/new-tickets')}}">New Tickets 
									@if($ticketSectionNew > 0)
										&nbsp;<span class="badge badge-circular badge-info">{{$ticketSectionNew}}</span>
									@endif
								</a>
							</li>
							<li><a href="{{url('admin/pending-tickets')}}">Pending Tickets 
									@if($ticketSectionPending > 0)
										&nbsp;<span class="badge badge-circular badge-info">{{$ticketSectionPending}}</span>
									@endif
								</a>
							</li>
							<li><a href="{{url('admin/closed-tickets')}}">Closed Tickets</a></li>
						</ul>
					</li>
				</ul>
				@endif
			</div>
		</div>
	</nav><!-- [ navigation menu ] end -->
	<header class="navbar pcoded-header navbar-expand-lg navbar-light headerpos-fixed brand-dark ">
		<div class="m-header">
			<a class="mobile-menu" id="mobile-collapse" href="javascript:;"><span></span></a>
			<a href="{{url('admin')}}" class="b-brand">
				<img src="{{url('public/images/logo_resized.png')}}" style="object-fit: contain;max-width: 82%;height: auto;width:auto;" alt="" class="logo">
			</a>
			<a href="javascript:;" class="mob-toggler">
				<i class="feather icon-more-vertical"></i>
			</a>
		</div>
		<div class="collapse navbar-collapse">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item active">
					<div class="dropdown">
						<a class="dropdown-toggle h-drop" href="javascript:;" data-toggle="dropdown">
							<i class="feather icon-monitor mx-2"></i>
							<span class="d-none d-sm-inline-block">Admin Panel</span>
						</a>
						
					</div>
				</li>
				<li class="nav-item d-none">
					<div class="dropdown mega-menu">
						<a class="dropdown-toggle h-drop" href="javascript:;" data-toggle="dropdown">
							<i class="feather icon-layers mr-2"></i>
							<span class="d-none d-sm-inline-block">Components</span>
						</a>
						
					</div>
				</li>
				
			</ul>
			<ul class="navbar-nav ml-auto">
				
				<li>
					<?php
						$profURL = 'javascript:;';
						if(Session::get('adminData')[0]['role'] == 1) {
							$profURL = url('/').'/admin/admin-setting';
						} elseif(Session::get('adminData')[0]['role'] == 2 || Session::get('adminData')[0]['role'] == 3 || Session::get('adminData')[0]['role'] == 4 || Session::get('adminData')[0]['role'] == 5 || Session::get('adminData')[0]['role'] == 6) {
							$profURL = url('/').'/admin/staff-details/'.Session::get('adminData')[0]['id'];
						}
					?>
					<div class="dropdown drp-user">
						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
							<img src="{{url('public/storage/no-image.png')}}" class="img-radius" alt="User-Profile-Image">
						</a>
						<div class="dropdown-menu dropdown-menu-right profile-notification">
							<ul class="pro-body">
								<li><a href="{{$profURL}}" class="dropdown-item"><i class="feather icon-user"></i> Profile</a></li>
								
								<li><a href="{{url('admin/logout')}}" class="dropdown-item"><i class="feather icon-log-out"></i> LogOut</a></li>
							</ul>
						</div>
					</div>
				</li>
			</ul>
		</div>
	</header><!-- [ Header ] end -->