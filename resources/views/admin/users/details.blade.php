@include('include/header')
<div class="pcoded-main-container">
    <div class="pcoded-content container">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-header">
                    <div class="page-block">
                        <div class="row align-items-center">
                            <div class="col-md-12">
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{url('admin/')}}">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="{{url('admin/users')}}">All Couples</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center">
                    @if(isset($users) && !empty($users))
                    <div class="col-md-12 col-xl-12 mb-3" style="text-align:center;">
                        <h1 style="display:inline-block;">Couple Profile</h1>
                        <a href="{{url('admin/edit-user')}}/{{$users->id}}" class="btn btn-primary float-right">Edit Profile</a>
                    </div>
                    <div class="col-md-6 col-xl-3">
                        @if($users->profile_image)
                            <!-- <img src="{{url('/public/user_profile/')}}/{{$users->profile_image}}" alt="Couple Image" class="figure-img img-fluid rounded"> -->
                            <img src="{{url('/public/storage/').'/USER_'.$users->id.'/'.$users->profile_image}}" alt="Couple Image" class="figure-img img-fluid rounded">
                        @else
                           <img src="{{url('/').'/public/storage/no-image.png'}}" alt="Vendor Image" class="figure-img img-fluid rounded">
                        @endif
                    </div>
                    <div class="col-md-12 col-xl-5">
                        <h2 class="d-inline-block font-weight-normal">{{$users->name}}</h2>
                        <p>Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit donec sed odio dui. </p>
                        <div class="row my-4">
                            <div class="col-sm-6">
                                <h5 class="mb-3">{{$users->name}}</h5>
                                <h5 class="mb-3">{!!date('j<\s\up>S</\s\up> M, Y',strtotime($users->event_date))!!}</h5>
                            </div>
                            <div class="col-sm-6">
                                <a href="mailto:{{$users->email}}">
                                    <h5 class="text-h-primary mb-3">{{$users->email}}</h5>
                                </a>
                                <h5 class="mb-3">Product Design</h5>
                            </div>
                        </div>
                        <button class="btn btn-primary mb-2">Send An Email to Couples</button>
                    </div>
                    @endif
                    <div class="col-md-12 col-xl-4">
                        <h6 class="mb-3 text-uppercase text-body f-12">Vendors Favorited</h6>
                        <div class="media mb-5">
                            <?php 
                                if(@$bookedVendorData){
                                    $i=0;
                                    foreach($bookedVendorData as $vendor){
                             ?>
                                @if(@$vendor->vendor[0]->profile != '')
                                <img src="{{url('/public/vendors/VENDOR_'.@$vendor->vendor[0]->vendor_id.'/')}}/{{@$vendor->vendor[0]->profile}}" alt="{{@$vendor->vendor[0]->firstname}}" title="{{@$vendor->vendor[0]->firstname.' '.@$vendor->vendor[0]->lastname}}" class="img-fluid avtar mr-3 mb-3">
                                @else
                                <img src="{{url('/public/storage/no-image.png')}}" alt="Team Member" title="{{@$vendor->vendor[0]->firstname.' '.@$vendor->vendor[0]->lastname}}" class="img-fluid avtar mr-3 mb-3">
                                @endif
                            <?php 
                                        $i++;
                                        if($i==3){                                            
                                            break;
                                        }
                                    }
                                    if(count(@$bookedVendorData) > 0)
                                    {
                                        if (((count(@$bookedVendorData)-3)) != 0) {

                                            if(count(@$bookedVendorData) > 3){
                                                echo "<button type='button' class='btn btn-icon' style='font-size:18px;padding: 22px !important;' data-toggle='modal' data-target='#userBookedVendors'>+".(count(@$bookedVendorData)-3)."</button>";
                                            }
                                        }
                                    }
                                    else{
                                        echo "<button type='button' class='btn btn-icon' style='font-size:18px;padding: 22px !important;''><i class='feather icon-plus'></i></button>";
                                    }
                                }
                             ?>
                        </div>
                        <h6 class="mb-3 text-uppercase text-body f-12">Added Vendors</h6>
                        <div class="media mb-4">
                            <?php 
                                if(@$addedVendorData){
                                    $i=0;
                                    foreach($addedVendorData as $vendor){
                            ?>
                                @if(@$vendor->vendor[0]->profile != '')
                                <img src="{{url('/public/vendors/VENDOR_'.@$vendor->vendor[0]->vendor_id.'/')}}/{{@$vendor->vendor[0]->profile}}" alt="{{@$vendor->vendor[0]->firstname}}" title="{{@$vendor->vendor[0]->firstname.' '.@$vendor->vendor[0]->lastname}}" class="img-fluid avtar mr-3 mb-3">
                                @else
                                <img src="{{url('/public/storage/no-image.png')}}" alt="Team Member" title="{{@$vendor->vendor[0]->firstname.' '.@$vendor->vendor[0]->lastname}}" class="img-fluid avtar mr-3 mb-3">
                                @endif
                            <?php 
                                        $i++;
                                        if($i==3){                                            
                                            break;
                                        }
                                    }
                                    if(count(@$addedVendorData) > 0)
                                    {
                                        if (((count(@$addedVendorData)-3)) != 0) {
                                            if(count(@$addedVendorData) > 3){
                                                echo "<button type='button' class='btn btn-icon' style='font-size:18px;padding: 22px !important;' data-toggle='modal' data-target='#userAddedVendors'>+".(count(@$addedVendorData)-3)."</button>";
                                            }
                                        }
                                    }
                                    else{
                                        echo "<button type='button' class='btn btn-icon' style='font-size:18px;padding: 22px !important;''><i class='feather icon-plus'></i></button>";
                                    }
                                }
                             ?>
                        </div>
                    </div>
                </div>

                <ul class="nav nav-tabs mb-3" id="TasksmyTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link text-uppercase active" id="Vendors-tab" data-toggle="tab" href="#Vendors1" role="tab" aria-controls="Vendors1" aria-selected="false">Vendors</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-uppercase" id="Budget-tab" data-toggle="tab" href="#Budget1" role="tab" aria-controls="Budget1" aria-selected="false">Budget</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-uppercase" id="Messages-tab" data-toggle="tab" href="#Messages1" role="tab" aria-controls="Messages1" aria-selected="false">Messages</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-uppercase" id="Posts-tab" data-toggle="tab" href="#Posts1" role="tab" aria-controls="Posts1" aria-selected="false">Posts</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-uppercase" id="Website_Link-tab" data-toggle="tab" href="#weddingWebsite" role="tab" aria-controls="weddingWebsite" aria-selected="false">Website Link</a>
                    </li>
                </ul>
                @if(session()->has('success'))
                    <div class="alert alert-info alert-dismissible fade show">
                        {{ session()->get('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="tab-content" id="TasksmyTabContent">
                    <div class="tab-pane fade show active" id="Vendors1" role="tabpanel" aria-labelledby="Vendors-tab">
                        <div class="row">
                            <div class="card" style="width:100%;">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="proftable1" class="table table-center mb-0 ">
                                            <thead>
                                                <tr>
                                                    <th>Connected Vendors</th>
                                                    <th>Business Details</th>
                                                    <th class="text-right">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if(count($bookedVendorData) > 0)
                                                @foreach($bookedVendorData as $vendor)                                                    
                                                <tr>
                                                    <td>
                                                        <div class="media">
                                                            @if(@$vendor->vendor[0]->profile)
                                                                <img src="{{url('/public/vendors/VENDOR_'.@$vendor->vendor[0]->vendor_id.'/')}}/{{@$vendor->vendor[0]->profile}}" alt="Vendor Image" class="img-fluid avtar avtar-s mr-3">
                                                            @else
                                                            <img src="{{url('/public/storage/no-image.png')}}" alt="Vendor Profile" class="img-fluid avtar mr-3">
                                                            @endif                                                            
                                                            <div class="media-body ml-3 align-self-center">
                                                                <h5 class="mb-1">
                                                                    <a href="{{url('/admin/vendor-details/')}}/{{@$vendor->vendor[0]->vendor_id}}" class="text-dark">{{@$vendor->vendorCompanyData[0]->business_name}}</a>
                                                                </h5>
                                                                <p class="mb-0"><a href="mailto:{{@$vendor->vendor[0]->email}}" class="text-secondary">{{@$vendor->vendor[0]->email}}</a></p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>{{@$vendor->vendorCompanyData[0]->business_detail}}</td>
                                                    <td>
                                                        @if(@$vendor->vendor[0]->status == 1)
                                                        Active
                                                        @else
                                                        Inactive
                                                        @endif
                                                    </td>
                                                    <!-- <td class="text-right"><span class="badge badge-pill badge-success">Completed</span></td> -->
                                                </tr>
                                                @endforeach
                                                @foreach($addedVendorData as $vendor)                                                    
                                                <tr>
                                                    <td>
                                                        <div class="media">
                                                            @if(@$vendor->vendorData[0]->profile)
                                                                <img src="{{url('/public/vendors/VENDOR_'.@$vendor->vendorData[0]->vendor_id.'/')}}/{{@$vendor->vendorData[0]->profile}}" alt="Vendor Image" class="img-fluid avtar avtar-s mr-3">
                                                            @else
                                                            <img src="{{url('/public/storage/no-image.png')}}" alt="Vendor Profile" class="img-fluid avtar mr-3">
                                                            @endif                                                            
                                                            <div class="media-body ml-3 align-self-center">
                                                                <h5 class="mb-1">
                                                                    <a href="{{url('/admin/vendor-details/')}}/{{@$vendor->vendorData[0]->vendor_id}}" class="text-dark">{{@$vendor->vendorCompanyData[0]->business_name}}</a>
                                                                </h5>
                                                                <p class="mb-0"><a href="mailto:{{@$vendor->vendorData[0]->email}}" class="text-secondary">{{@$vendor->vendorData[0]->email}}</a></p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>{{@$vendor->vendorCompanyData[0]->business_detail}}</td>
                                                    <td>
                                                        @if(@$vendor->vendorData[0]->status == 1)
                                                        Active
                                                        @else
                                                        Inactive
                                                        @endif
                                                    </td>
                                                    <!-- <td class="text-right"><span class="badge badge-pill badge-success">Completed</span></td> -->
                                                </tr>
                                                @endforeach
                                                @else
                                                <tr>
                                                    <td colspan="7" style="text-align:center;" class="pt-5"><h4>Oops!.. Vendor Data Not Found ! </h4></td>
                                                </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="Budget1" role="tabpanel" aria-labelledby="Budget-tab">
                        <div class="row">
                            <div class="card" style="width:100%;">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="proftable2" class="table table-center mb-0 ">
                                            <thead>
                                                <tr>
                                                    <th>Connected Couples</th>
                                                    <th>Lead Progress</th>
                                                    <th>Lead Date</th>
                                                    <th>Wedding Date</th>
                                                    <th>City</th>
                                                    <th class="text-right">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <div class="media">
                                                            <span class="avtar avtar-square text-white bg-yellow-2 ">NE</span>
                                                            <div class="media-body ml-3 align-self-center">
                                                                <p class="mb-0">New internal communication and <br>connectivity platform</p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>Engineering</td>
                                                    <td>9/01/2019</td>
                                                    <td>37 <i class="feather icon-arrow-down text-danger"></i></td>
                                                    <td>Low</td>
                                                    <td class="text-right"><span class="badge badge-pill badge-success">Completed</span></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="media">
                                                            <span class="avtar avtar-square text-white bg-yellow-2 ">NE</span>
                                                            <div class="media-body ml-3 align-self-center">
                                                                <p class="mb-0">New internal communication and <br>connectivity platform</p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>Product Design</td>
                                                    <td>8/04/2019</td>
                                                    <td>37 <i class="feather icon-arrow-down text-danger"></i></td>
                                                    <td>Low</td>
                                                    <td class="text-right"><span class="badge badge-pill badge-danger">OFF Track</span></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="media">
                                                            <span class="avtar avtar-square text-white bg-yellow-2 ">NE</span>
                                                            <div class="media-body ml-3 align-self-center">
                                                                <p class="mb-0">New internal communication and <br>connectivity platform</p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>Product Design</td>
                                                    <td>8/04/2019</td>
                                                    <td>37 <i class="feather icon-arrow-down text-danger"></i></td>
                                                    <td>Low</td>
                                                    <td class="text-right"><span class="badge badge-pill badge-dark">ON track</span></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="media">
                                                            <span class="avtar avtar-square text-white bg-yellow-2 ">NE</span>
                                                            <div class="media-body ml-3 align-self-center">
                                                                <p class="mb-0">New internal communication and <br>connectivity platform</p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>Marketing</td>
                                                    <td>8/04/2019</td>
                                                    <td>37 <i class="feather icon-arrow-down text-danger"></i></td>
                                                    <td>Low</td>
                                                    <td class="text-right"><span class="badge badge-pill badge-light-dark">not started</span></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="Messages1" role="tabpanel" aria-labelledby="Messages-tab">
                        <div class="row">
                            <div class="card" style="width:100%;">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="proftable3" class="table table-center mb-0 ">
                                            <thead>
                                                <tr>
                                                    <th>Vendor Name</th>
                                                    <th>Vendor Category</th>
                                                    <th>Message Title</th>
                                                    <th class="text-right">Read Status</th>
                                                    <th class="text-right">Reply Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if(count($chatMessage) > 0)
                                                    @foreach($chatMessage as $cm)
                                                    <tr>
                                                        <td>
                                                            <div class="media">
                                                                @if(@$cm->vendor_company['vendor_data']['profile'])
                                                                    <img src="{{url('/public/vendors/').'/VENDOR_'.$cm->vendor_company['vendor_data']['vendor_id'].'/'.$cm->vendor_company['vendor_data']['profile']}}" alt="Couple Image" class="img-fluid avtar avtar-s">
                                                                @else
                                                                    <img src="{{url('/').'/public/storage/no-image.png'}}" alt="Couple Image" class="img-fluid avtar avtar-s">
                                                                @endif
                                                                <div class="media-body ml-3 align-self-center">
                                                                    <h5 class="mb-1">
                                                                        <a href="javascript:;" class="text-dark">{{$cm->vendor_company['business_name']}}</a>
                                                                    </h5>
                                                                    <p class="mb-0"> <a href="mailto:{{$cm->vendor_company['vendor_data']['email']}}" class="text-secondary">{{$cm->vendor_company['vendor_data']['email']}}</a></p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>{{$cm->vendor_company['vendor_data']['category_data']['title']}}</td>
                                                        <td>{{$cm->name}}</td>
                                                        <td class="text-right">
                                                            @if($cm->read_status == '1')
                                                                <span class="badge badge-pill badge-success">Done</span>
                                                            @else
                                                                <span class="badge badge-pill badge-danger">Not Read</span>
                                                            @endif
                                                        </td>
                                                        <td class="text-right">
                                                            @if($cm->reply_status == '0')
                                                                <span class="badge badge-pill badge-dark">Pending</span>
                                                            @elseif($cm->reply_status == '1')
                                                                <span class="badge badge-pill badge-light-dark">Replied</span>
                                                            @elseif($cm->reply_status == '2')
                                                                <span class="badge badge-pill badge-danger">Discarded</span>
                                                            @elseif($cm->reply_status == '3')
                                                                <span class="badge badge-pill badge-success">Booked</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                        <a class="btn  btn-primary btn-sm" title="Reply" href="{{ url('admin/reply-enquiry/'.$cm->id) }}" style="float:left;margin-right:5px;"><i class="fa fa-reply"></i></a>
                                                        <form style="float: left;width: 30%;" action="{{ url('admin/delete_enquiry/'.$cm->id) }}" method="POST">
                                                            {{ csrf_field() }}
                                                            {{ method_field('DELETE') }}
                                                            <button type="submit" class="btn btn-danger btn-sm" title="Delete">
                                                                <i class="fa fa-btn fa-trash"></i>
                                                            </button>
                                                        </form>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                @else
                                                <tr>
                                                    <td colspan="7" style="text-align:center;" class="pt-5"><h4>Oops!.. No Message Found ! </h4></td>
                                                </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="Posts1" role="tabpanel" aria-labelledby="Posts-tab">
                        <div class="row">
                            <div class="card" style="width:100%;">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="proftable4" class="table table-center mb-0 ">
                                            <thead>
                                                <tr>
                                                    <th>Connected Couples</th>
                                                    <th>Lead Progress</th>
                                                    <th>Lead Date</th>
                                                    <th>Wedding Date</th>
                                                    <th>City</th>
                                                    <th class="text-right">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <div class="media">
                                                            <span class="avtar avtar-square text-white bg-yellow-2 ">NE</span>
                                                            <div class="media-body ml-3 align-self-center">
                                                                <p class="mb-0">New internal communication and <br>connectivity platform</p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>Engineering</td>
                                                    <td>9/01/2019</td>
                                                    <td>37 <i class="feather icon-arrow-down text-danger"></i></td>
                                                    <td>Low</td>
                                                    <td class="text-right"><span class="badge badge-pill badge-success">Completed</span></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="media">
                                                            <span class="avtar avtar-square text-white bg-yellow-2 ">NE</span>
                                                            <div class="media-body ml-3 align-self-center">
                                                                <p class="mb-0">New internal communication and <br>connectivity platform</p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>Product Design</td>
                                                    <td>8/04/2019</td>
                                                    <td>37 <i class="feather icon-arrow-down text-danger"></i></td>
                                                    <td>Low</td>
                                                    <td class="text-right"><span class="badge badge-pill badge-danger">OFF Track</span></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="media">
                                                            <span class="avtar avtar-square text-white bg-yellow-2 ">NE</span>
                                                            <div class="media-body ml-3 align-self-center">
                                                                <p class="mb-0">New internal communication and <br>connectivity platform</p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>Product Design</td>
                                                    <td>8/04/2019</td>
                                                    <td>37 <i class="feather icon-arrow-down text-danger"></i></td>
                                                    <td>Low</td>
                                                    <td class="text-right"><span class="badge badge-pill badge-dark">ON track</span></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="media">
                                                            <span class="avtar avtar-square text-white bg-yellow-2 ">NE</span>
                                                            <div class="media-body ml-3 align-self-center">
                                                                <p class="mb-0">New internal communication and <br>connectivity platform</p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>Marketing</td>
                                                    <td>8/04/2019</td>
                                                    <td>37 <i class="feather icon-arrow-down text-danger"></i></td>
                                                    <td>Low</td>
                                                    <td class="text-right"><span class="badge badge-pill badge-light-dark">not started</span></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="weddingWebsite" role="tabpanel" aria-labelledby="Website_Link-tab">
                        <div class="row">
                            <div class="card" style="width:100%;">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="proftable5" class="table table-center mb-0 ">
                                            <thead>
                                                <tr>
                                                    <th>Title</th>
                                                    <th>Description</th>
                                                    <th>Banner</th>
                                                    <th>Website Link</th>
                                                    <th>Created on</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if(count($weddingWebsite) > 0)
                                                <tr>
                                                    <td>
                                                        <h5 class="mb-1">
                                                            {{@$weddingWebsite[0]->title}}
                                                        </h5>
                                                    </td>
                                                    <td><p>{{@$weddingWebsite[0]->description}}</p></td>
                                                    <td>
                                                        @if(@$weddingWebsite[0]->banner_image)
                                                            <img src="{{@$weddingWebsite[0]->banner_image}}" alt="Website Banner" class="img-fluid" style="width: 150px;">
                                                        @else
                                                            <img src="{{url('/public/storage/no-image.png')}}" alt="Default Website Banner" class="img-fluid" style="width: 150px;">
                                                        @endif
                                                    </td>
                                                    <td><a href="{{@$weddingWebsite[0]->website_link}}" class="text-primary">{{@$weddingWebsite[0]->website_link}}</a></td>
                                                    <td>{{date('d-M-Y', strtotime(@$weddingWebsite[0]->created_at))}}</td>
                                                </tr>
                                                @else
                                                <tr>
                                                    <td colspan="7" style="text-align:center;" class="pt-5"><h4>Oops!.. No Website Found ! </h4></td>
                                                </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="userBookedVendors" tabindex="-1" role="dialog" aria-labelledby="userBookedVendorsTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header border-bottom">
            <h5 class="modal-title" id="exampleModalLongTitle">Vendor Booked by User</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <?php  $i=1; ?>
            @foreach($bookedVendorData as $vendor)
                <div class="media py-3">
                    <!-- <span class="avtar avtar-square text-white bg-yellow-2 ">NE</span> -->
                    <h5 style="padding: 14px 14px  14px 0;margin-bottom: 0;margin-right: 10px;"><?php $total = $i++; echo str_pad($total, 2, '0', STR_PAD_LEFT); ?></h5>
                    @if(@$vendor->vendor[0]->profile != '')
                    <img src="{{url('/public/vendors/VENDOR_'.@$vendor->vendor[0]->vendor_id.'/')}}/{{@$vendor->vendor[0]->profile}}" alt="Vendor Profile" class="img-fluid avtar mr-3">
                    @else
                    <img src="{{url('/public/storage/no-image.png')}}" alt="Vendor Profile" class="img-fluid avtar mr-3">
                    @endif
                    <div class="media-body ml-2 align-self-center">
                        <h5 class="mb-1"><a href="{{url('/admin/vendor-details/')}}/{{@$vendor->vendor[0]->vendor_id}}" class="text-dark">{{@$vendor->vendorCompanyData[0]->business_name}}</a></h5>
                        <p class="mb-0"><a href="mailto:{{@$vendor->vendor[0]->email}}" class="text-secondary">{{@$vendor->vendor[0]->email}}</a></p>
                    </div>
                </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="userAddedVendors" tabindex="-1" role="dialog" aria-labelledby="userBookedVendorsTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header border-bottom">
            <h5 class="modal-title" id="exampleModalLongTitle">Vendor Added by User</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <?php  $i=1; ?>
            @foreach($addedVendorData as $vendor)
                <div class="media py-3">
                    <!-- <span class="avtar avtar-square text-white bg-yellow-2 ">NE</span> -->
                    <h5 style="padding: 14px 14px  14px 0;margin-bottom: 0;margin-right: 10px;"><?php $total = $i++; echo str_pad($total, 2, '0', STR_PAD_LEFT); ?></h5>
                    @if(@$vendor->vendorData[0]->profile != '')
                    <img src="{{url('/public/vendors/VENDOR_'.@$vendor->vendorData[0]->vendor_id.'/')}}/{{@$vendor->vendorData[0]->profile}}" alt="Vendor Profile" class="img-fluid avtar mr-3">
                    @else
                    <img src="{{url('/public/storage/no-image.png')}}" alt="Vendor Profile" class="img-fluid avtar mr-3">
                    @endif
                    <div class="media-body ml-2 align-self-center">
                        <h5 class="mb-1"><a href="{{url('/admin/vendor-details/')}}/{{@$vendor->vendorData[0]->vendor_id}}" class="text-dark">{{@$vendor->vendorCompanyData[0]->business_name}}</a></h5>
                        <p class="mb-0"><a href="mailto:{{@$vendor->vendorData[0]->email}}" class="text-secondary">{{@$vendor->vendorData[0]->email}}</a></p>
                    </div>
                </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
</div>
<script src="{{url('/assets/js/plugins/bootstrap.min.js')}}"></script>
<script src="{{url('/assets/js/pcoded.min.js')}}"></script>
<script src="{{url('/assets/js/menu-setting.js')}}"></script>
<script src="{{url('/assets/js/plugins/jquery.dataTables.min.js')}}"></script>
<script src="{{url('/assets/js/plugins/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{url('/assets/js/plugins/jquery.dataTables.min.js')}}"></script>
<script src="{{url('/assets/js/plugins/dataTables.bootstrap4.min.js')}}"></script>
<script>
    $('#proftable1').DataTable();
    $('#proftable2').DataTable();
    $('#proftable3').DataTable();
    $('#proftable4').DataTable();
    $('#proftable5').DataTable();
</script>
@@include('./include/footer.php')
</body>
</html>