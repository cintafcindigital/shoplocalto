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
                                    <li class="breadcrumb-item"><a href="{{url('admin/vendors')}}">All Vendors</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                @if(session()->has('edit-success'))
                    <div class="alert alert-info alert-dismissible fade show">
                        {{ session()->get('edit-success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="row align-items-center">
                    <div class="col-md-12 col-xl-12 mb-3" style="text-align:center;">
                        <h1 style="display:inline-block;">Vendor Profile</h1>
                        <a href="{{url('/')}}/admin/edit-vendor/{{$vendorData['vendor_data']->vendor_id}}" class="btn btn-primary float-right">Edit Profile</a>
                    </div>
                    <div class="col-md-6 col-xl-3">
                        @if(@$vendorData['vendor_data']->profile)
                            <img src="{{url('/public/vendors/VENDOR_').$vendorData['vendor_data']->vendor_id}}/{{$vendorData['vendor_data']->profile}}" class="figure-img img-fluid rounded" alt="...">
                        @elseif(isset($vendorData['image_data']) && count($vendorData['image_data']) > 0)
                            <img src="{{url('/').'/public/vendors/VENDOR_'.$vendorData['vendor_data']->vendor_id.'/'.$vendorData['image_data'][0]->image}}" alt="Vendor Image" class="figure-img img-fluid rounded">
                        @else
                            <img src="{{url('/').'/public/storage/no-image.png'}}" alt="Vendor Image" class="figure-img img-fluid rounded">
                        @endif
                    </div>
                    <div class="col-md-12 col-xl-5">
                        @if(isset($vendorData['company_data']) && !empty($vendorData['company_data']))
                            @if(isset($vendorData['vendor_data']) && !empty($vendorData['vendor_data']))
                            <h2 class="d-inline-block font-weight-normal">{{$vendorData['company_data']->business_name}}</h2>
                            <p class="text-justify">{!!$vendorData['company_data']->business_detail!!} </p>
                            <div class="row my-4">
                                <div class="col-sm-6">
                                    <h5 class="mb-3">{{$vendorData['vendor_data']->contact_person}}&nbsp;<small>{{$vendorData['vendor_data']->username}}</small></h5>
                                    <h5 class="mb-3">{{$vendorData['company_data']->city}} - {{$vendorData['company_data']->country}}</h5>
                                </div>
                                <div class="col-sm-6">
                                    <a href="mailto:{{$vendorData['vendor_data']->email}}">
                                        <h5 class="text-h-primary mb-3">{{$vendorData['vendor_data']->email}}</h5>
                                    </a>
                                    <h5 class="mb-3">{!!($vendorData['vendor_data']->mobile!=null)?$vendorData['vendor_data']->mobile:'<i>Null</i>'!!}</h5>
                                </div>
                            </div>
                            <!-- <button class="btn btn-primary">Send Message</button> -->
                            <!--<label style="font-size:16px;border:2px solid #0B69FF;border-radius:5px;padding:5px 8px;">-->
                            <!--    <a href="javascript:;" type="button" style="color:#000;">Send Message</a>-->
                            <!--</label>-->
                            <!-- <label style="font-size:16px;border:2px solid;border-radius:5px;padding:5px 8px;">
                                <a href="javascript:;" style="color:#000;">Leads : 100</a>
                            </label> -->
                            <!--<label style="font-size:16px;border:2px solid;border-radius:5px;padding:5px 8px;">-->
                            <!--    <a href="javascript:;" style="color:#000;">Visits : {{str_pad($vendorData['company_data']->visits, 2, '0', STR_PAD_LEFT)}}</a>-->
                            <!--</label>-->
                            @endif
                        @endif
                    </div>
                   
                </div>
                <ul class="nav nav-tabs mb-3" id="TasksmyTab" role="tablist">
                    <!-- <li class="nav-item">
                        <a class="nav-link text-uppercase active" id="Leads-tab" data-toggle="tab" href="#Leads1" role="tab" aria-controls="Leads1" aria-selected="false">Leads</a>
                    </li> -->
                    <!-- <li class="nav-item">
                        <a class="nav-link text-uppercase active" id="Messages-tab" data-toggle="tab" href="#Messages1" role="tab" aria-controls="Messages1" aria-selected="false">Messages</a>
                    </li> -->
                    <li class="nav-item">
                        <a class="nav-link text-uppercase active" id="Reviews-tab" data-toggle="tab" href="#Reviews1" role="tab" aria-controls="Reviews1" aria-selected="false">Reviews</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-uppercase" id="Billings-tab" data-toggle="tab" href="#Billings1" role="tab" aria-controls="Billings1" aria-selected="false">Billings</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-uppercase" id="Billings-tab" data-toggle="tab" href="#categories" role="tab" aria-controls="categories" aria-selected="false">Categories</a>
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
                    <div class="tab-pane fade show" id="Leads1" role="tabpanel" aria-labelledby="Leads-tab">
                        <div class="row">
                            <div class="card" style="width:100%;">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="proftable1" class="table table-center mb-0 ">
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
                                        <table id="proftable2" class="table table-center mb-0 ">
                                            <thead>
                                                <tr>
                                                    <th>Client Name</th>
                                                    <th>Wedding Date</th>
                                                    <th>No. of Guests</th>
                                                    <th>Event Date</th>
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
                                                                @if(@$cm->user->profile_image)
                                                                    <img src="{{url('/public/storage/').'/USER_'.$cm->user->id.'/'.$cm->user->profile_image}}" alt="Couple Image" class="img-fluid avtar avtar-s">
                                                                @else
                                                                    <img src="{{url('/').'/public/storage/no-image.png'}}" alt="Couple Image" class="img-fluid avtar avtar-s">
                                                                @endif
                                                                <div class="media-body ml-3 align-self-center">
                                                                    <h5 class="mb-1">
                                                                        <a href="javascript:;" class="text-dark">{{@$cm->user->name}}</a>
                                                                    </h5>
                                                                    <p class="mb-0"> <a href="mailto:{{@$cm->user->email}}">{{@$cm->user->email}}</a></p>
                                                                </div>
                                                            </div>
                                                            <!-- <div class="media">
                                                                <span class="avtar avtar-square text-white bg-yellow-2 ">NE</span>
                                                                <div class="media-body ml-3 align-self-center">
                                                                    <p class="mb-0">New internal communication and <br>connectivity platform</p>
                                                                </div>
                                                            </div> -->
                                                        </td>
                                                        <td>{{@$cm->user->event_date}}</td>
                                                        <td>{{$cm->number_of_guests}}</td>
                                                        <td>{{@$cm->event_date}}</td>
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
                    <div class="tab-pane fade show active" id="Reviews1" role="tabpanel" aria-labelledby="Reviews-tab">
                        <div class="row">
                            <div class="card" style="width:100%;">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="proftable3" class="table table-center mb-0 ">
                                            <thead>
                                                <tr>
                                                    <th>Client Name</th>
                                                    <th>Rating</th>
                                                    <th>Review</th>
                                                    <th>Date</th>
                                                    <th>Time</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if(count($reviewData) > 0)
                                                    @foreach($reviewData as $review)
                                                    <tr>
                                                        <td>
                                                            <div class="media">
                                                                @if(@$review->user->profile_image)
                                                                    <img src="{{url('/public/storage/').'/USER_'.$review->user->id.'/'.$review->user->profile_image}}" alt="Couple Image" class="img-fluid avtar avtar-s">
                                                                @else
                                                                    <img src="{{url('/').'/public/storage/no-image.png'}}" alt="Couple Image" class="img-fluid avtar avtar-s">
                                                                @endif
                                                                <div class="media-body ml-3 align-self-center">
                                                                    <h5 class="mb-1">
                                                                        <a href="javascript:;" class="text-dark">{{@$review->user->name}}</a>
                                                                    </h5>
                                                                    <p class="mb-0"> <a href="mailto:{{$review->email}}">{{$review->email}}</a></p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="star-holder inline">
                                                                @if($review->average_rating > 0)
                                                                <div class="readOnly" data-score="{{$review->average_rating}}" title="good">

                                                                    <?php 
                                                                        $i = 1;$j = 1;
                                                                        $onStar = $review->average_rating;
                                                                        $offStar = 5 - $review->average_rating;
                                                                        while($i <= $onStar){
                                                                            echo "<img alt='$i' src='http://testnew.perfectweddingday.ca/assets/admin/plugins/raty/images/star-on.png' title='good'>&nbsp;";
                                                                            $i++;
                                                                        }
                                                                        while($j <= $offStar){
                                                                            echo "<img alt='0' src='http://testnew.perfectweddingday.ca/assets/admin/plugins/raty/images/star-off.png' title='good'>&nbsp;";
                                                                            $j++;
                                                                        }?>
                                                                    <input name="score" type="hidden" value="{{$review->average_rating}}" readonly="">
                                                                </div>
                                                                @else
                                                                    <?php 
                                                                        $i = 1;
                                                                        while($i <= 5){
                                                                            echo "<img alt='0' src='http://testnew.perfectweddingday.ca/assets/admin/plugins/raty/images/star-off.png' title='good'>&nbsp;";
                                                                            $i++;
                                                                        }?>                                                                
                                                                @endif
                                                            </div>
                                                        </td>
                                                        <td><?php 
                                                                if(strlen($review->review_description) < 100){
                                                                    echo $review->review_description;
                                                                }
                                                                else
                                                                {
                                                                    $pos=stripos($review->review_description, ' ', 100);
                                                                    echo substr($review->review_description,0,$pos ).'...<a href="#">Read More</a>';
                                                                }?>
                                                        </td>
                                                        <td>{{date('d/m/Y', strtotime($review->created_at))}}</td>
                                                        <td>{{date('H:i A', strtotime($review->created_at))}}</td>
                                                        
                                                    </tr>
                                                    @endforeach
                                                @else
                                                <tr>
                                                    <td colspan="7" style="text-align:center;" class="pt-5"><h4>Oops!.. No Review Found ! </h4></td>
                                                </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="Billings1" role="tabpanel" aria-labelledby="Billings-tab">
                        <div class="row">
                            <div class="card" style="width:100%;">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="proftable4" class="table table-center mb-0 ">
                                            <thead>
                                                <tr>
                                                    <th>Vendor/Business Name</th>
                                                    <th>Bill No.</th>
                                                    <th>Amount</th>
                                                    <th>Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if(count($billData) > 0)
                                                    @foreach($billData as $bill)
                                                    <tr>
                                                        <td>
                                                            <div class="media">
                                                                @if(@$bill->vendor->profile)
                                                                    <img src="{{url('/public/vendors/').'/VENDOR_'.$bill->vendor->vendor_id.'/'.$bill->vendor->profile}}" alt="Vendor Image" class="img-fluid avtar avtar-s">
                                                                @else
                                                                    <img src="{{url('/').'/public/storage/no-image.png'}}" alt="Vendor Image" class="img-fluid avtar avtar-s">
                                                                @endif
                                                                <div class="media-body ml-3 align-self-center">
                                                                    <h5 class="mb-1">
                                                                        <a href="{{url('admin/vendor-details')}}/{{$bill->vendor->vendor_id}}" class="text-dark">{{$bill->vendor->contact_person}}</a>
                                                                    </h5>
                                                                    <p class="mb-0"> <a href="mailto:{{$bill->vendor->email}}">{{$bill->vendor->email}}</a></p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>{{$bill->invoice_number}}</td>
                                                        <td>C$ {{$bill->paid_amount}}</td>
                                                        <td>{{date('d/m/Y ', strtotime($bill->created_at))}}</td>
                                                    </tr>
                                                    @endforeach
                                                @else
                                                <tr>
                                                    <td colspan="7" style="text-align:center;" class="pt-5"><h4>Oops!.. No Billing Found ! </h4></td>
                                                </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="categories" role="tabpanel" aria-labelledby="Categories-tab">
                        <div class="row">
                            <div class="card" style="width:100%;">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="proftable5" class="table table-center mb-0 ">
                                            <thead>
                                                <tr>
                                                    <th>Category</th>
                                                    <th>Parent Category</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if(isset($vendorData['categories']) && count($vendorData['categories']) > 0)
                                                    @foreach($vendorData['categories'] as $cat)
                                                    <tr>
                                                        <td>{{$cat->title}}</td>
                                                        <td>{{$cat->parent_category}}</td>
                                                    </tr>
                                                    @endforeach
                                                @else
                                                <tr>
                                                    <td colspan="7" style="text-align:center;" class="pt-5"><h4>Oops!.. No Categories Found ! </h4></td>
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

    <div class="modal fade" id="vendorTeamMembers" tabindex="-1" role="dialog" aria-labelledby="vendorTeamMembersTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header border-bottom">
            <h5 class="modal-title" id="exampleModalLongTitle">{{$vendorData['company_data']->business_name}} - Team Members</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <?php  $i=1; ?>
            @foreach($teamData as $team)
                <div class="media py-3">
                    <!-- <span class="avtar avtar-square text-white bg-yellow-2 ">NE</span> -->
                    <h5 style="padding: 14px 14px  14px 0;margin-bottom: 0;margin-right: 10px;"><?php $total = $i++; echo str_pad($total, 2, '0', STR_PAD_LEFT); ?></h5>
                    @if($team->photo != '')
                        <a href="{{url('admin/view-team-member/'.$team->id)}}" target="blank">
                            <img src="{{url('/public/vendors/VENDOR_'.$team->vendor_id.'/')}}/{{$team->photo}}" alt="{{$team->firstname}}" title="{{$team->firstname.' '.$team->lastname}}" class="img-fluid avtar mr-3">
                        </a>
                    @else
                        <a href="{{url('admin/view-team-member/'.$team->id)}}" target="blank">
                            <img src="{{url('/public/storage/no-image.png')}}" alt="Team Member" title="{{$team->firstname.' '.$team->lastname}}" class="img-fluid avtar mr-3">
                        </a>
                    @endif
                    <div class="media-body ml-2 align-self-center">
                        <a href="{{url('admin/view-team-member/'.$team->id)}}" target="blank">
                            <h5 class="mb-1">{{$team->firstname.' '.$team->lastname}}</h5>
                        </a>
                        <p class="mb-0"><a href="mailto:{{$team->email}}" class="text-secondary">{{$team->email}}</a></p>
                    </div>
                </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="connectedCouples" tabindex="-1" role="dialog" aria-labelledby="vendorTeamMembersTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header border-bottom">
            <h5 class="modal-title" id="exampleModalLongTitle">Couples Connected to you</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <?php  $i=1; ?>
            @foreach($connCouples as $couple)
                <div class="media py-3">
                    <!-- <span class="avtar avtar-square text-white bg-yellow-2 ">NE</span> -->
                    <h5 style="padding: 14px 14px  14px 0;margin-bottom: 0;margin-right: 10px;"><?php $total = $i++; echo str_pad($total, 2, '0', STR_PAD_LEFT); ?></h5>
                    @if($couple->user['profile_image'] != '')
                    <img src="{{url('/public/storage/USER_'.$couple->user['id'].'/')}}/{{$couple->user['profile_image']}}" alt="{{$couple->user['name']}}" class="img-fluid avtar mr-3">
                    @else
                    <img src="{{url('/public/storage/no-image.png')}}" alt="Couple Image" title="{{$couple->user['name']}}" class="img-fluid avtar mr-3">
                    @endif
                    <div class="media-body ml-2 align-self-center">
                        <h5 class="mb-1"><a href="{{url('/admin/user-details/')}}/{{$couple->user['id']}}" class="text-dark">{{$couple->user['name']}}</a></h5>
                        <p class="mb-0"><a href="mailto:{{$couple->user['email']}}" class="text-secondary">{{$couple->user['email']}}</a></p>
                    </div>
                </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
</div>
<script src="{{url('/')}}/assets/js/plugins/bootstrap.min.js"></script>
<script src="{{url('/')}}/assets/js/pcoded.min.js"></script>
<script src="{{url('/')}}/assets/js/menu-setting.js"></script>
<script src="{{url('/')}}/assets/js/plugins/jquery.dataTables.min.js"></script>
<script src="{{url('/')}}/assets/js/plugins/dataTables.bootstrap4.min.js"></script>
<script src="{{url('/')}}/assets/js/plugins/jquery.dataTables.min.js"></script>
<script src="{{url('/')}}/assets/js/plugins/dataTables.bootstrap4.min.js"></script>
<script>
    $('#proftable1').DataTable();
    $('#proftable5').DataTable();
    $('#proftable2').DataTable();
    $('#proftable3').DataTable();
    $('#proftable4').DataTable();
</script>
</body>
</html>