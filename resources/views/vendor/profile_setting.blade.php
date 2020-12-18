@extends('layouts.default')
@section('meta_title',$data['titleData']->meta_title)
@section('meta_keyword',$data['titleData']->meta_keyword)
@section('meta_description',$data['titleData']->meta_description)
@section('content')
@include('includes.menu')
<style>
   .category-container-ul{
      border: 1px solid #ddd;
      margin: auto;
      padding: 5px;
   }
/* The container */
.container-ul {
  display: block;
  position: relative;
  padding-left: 35px;
  margin-bottom: 12px;
  cursor: pointer;
  font-size: 16px;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

/* Hide the browser's default checkbox */
.container-ul input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
  height: 0;
  width: 0;
}

/* Create a custom checkbox */
.checkmark {
  position: absolute;
  top: 0;
  left: 0;
  height: 25px;
  width: 25px;
  background-color: #eee;
}

/* On mouse-over, add a grey background color */
.container-ul:hover input ~ .checkmark {
  background-color: #ccc;
}

/* When the checkbox is checked, add a blue background */
.container-ul input:checked ~ .checkmark {
  background-color: #83021e;
}

/* Create the checkmark/indicator (hidden when not checked) */
.checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

/* Show the checkmark when checked */
.container-ul input:checked ~ .checkmark:after {
  display: block;
}

/* Style the checkmark/indicator */
.container-ul .checkmark:after {
  left: 9px;
  top: 5px;
  width: 5px;
  height: 10px;
  border: solid white;
  border-width: 0 3px 3px 0;
  -webkit-transform: rotate(45deg);
  -ms-transform: rotate(45deg);
  transform: rotate(45deg);
}
</style>
<section class="section-padding dashboard-wrap setting_page_wrp storefront_main_sect dash_main_sect">
     @include('vendor.tools_nav')
      <div class="wrapper">
         <div class="pure-g">
            <div class="pure-u-2-7">
               <div class="mr40">
                  <nav class="adminAside setting_list_wrp">
                     <a class="adminAside__item active" href="{{url('profile-settings')}}">
                        <i class="svgIcon svgIcon__gen adminAside__icon">
                           <svg viewBox="0 0 17 18">
                              <path d="M1 1v16h15V1H1zm0-1h15a1 1 0 0 1 1 1v16a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V1a1 1 0 0 1 1-1zm3.5 5V4h10v1h-10zm-1 3.5v-1h11v1h-11z" fill-rule="nonzero"></path>
                           </svg>
                        </i> PROFILE SETTINGS
                     </a>
                     <a class="adminAside__item " href="{{url('employees')}}">
                        <i class="svgIcon svgIcon__gen adminAside__icon">
                           <svg viewBox="0 0 17 18">
                              <path d="M1 1v16h15V1H1zm0-1h15a1 1 0 0 1 1 1v16a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V1a1 1 0 0 1 1-1zm3.5 5V4h10v1h-10zm-1 3.5v-1h11v1h-11z" fill-rule="nonzero"></path>
                           </svg>
                        </i> STAFF SETTINGS
                     </a>
                     <!--<a class="adminAside__item " href="{{url('vendor-settings')}}">
                        <i class="svgIcon svgIcon__gear adminAside__icon">
                           <svg viewBox="0 0 18 20">
                              <path d="M5.98 16.179a.653.653 0 0 0-.822-.472l-1.76.504c-.856.244-1.883-.17-2.325-.94l-.601-1.04C.027 13.46.18 12.365.82 11.745l1.317-1.272a.657.657 0 0 0 0-.95L.824 8.252C.183 7.634.029 6.54.473 5.769l.6-1.04c.443-.771 1.47-1.185 2.325-.94l1.76.504a.656.656 0 0 0 .823-.474l.443-1.776C6.64 1.18 7.511.5 8.4.5h1.2c.889 0 1.76.68 1.975 1.542l.444 1.775c.092.366.46.577.823.474l1.76-.504c.855-.245 1.88.17 2.324.94l.602 1.041c.443.772.29 1.865-.35 2.482L15.86 9.524a.653.653 0 0 0 0 .948l1.318 1.273c.64.619.792 1.712.348 2.484l-.6 1.04c-.442.77-1.469 1.185-2.325.94l-1.761-.504a.654.654 0 0 0-.82.474l-.445 1.778C11.36 18.82 10.489 19.5 9.6 19.5H8.4c-.89 0-1.76-.68-1.975-1.543l-.446-1.778zm1.415 1.536c.104.417.575.785 1.005.785h1.2c.43 0 .901-.368 1.005-.785l.445-1.778a1.653 1.653 0 0 1 2.067-1.193l1.76.504c.415.119.97-.105 1.184-.478l.6-1.04c.215-.375.132-.966-.177-1.266l-1.318-1.273a1.653 1.653 0 0 1 .001-2.387l1.316-1.273c.31-.3.393-.89.178-1.264l-.601-1.04c-.215-.373-.77-.597-1.183-.479l-1.76.504a1.656 1.656 0 0 1-2.068-1.192l-.444-1.776C10.501 1.868 10.03 1.5 9.6 1.5H8.4c-.43 0-.901.368-1.005.785L6.95 4.062a1.657 1.657 0 0 1-2.068 1.193l-1.76-.504c-.415-.12-.97.105-1.184.477l-.6 1.04c-.215.374-.132.966.178 1.265l1.316 1.272a1.658 1.658 0 0 1 0 2.387l-1.317 1.273c-.31.3-.393.892-.178 1.265l.602 1.042c.213.372.768.596 1.183.477l1.759-.503a1.652 1.652 0 0 1 2.067 1.19l.446 1.779zM9 8.1a1.9 1.9 0 1 0 0 3.8 1.9 1.9 0 0 0 0-3.8zm0-1a2.9 2.9 0 1 1 0 5.8 2.9 2.9 0 0 1 0-5.8z" fill-rule="nonzero"></path>
                           </svg>
                        </i> NOTIFICATIONS
                     </a>-->
                  </nav>
               </div>
            </div>
            <div class="pure-u-5-7">
               <h1 class="adminTitle">PROFILE SETTINGS</h1>
               @if(session()->has('success'))
                  <div class="alert alert-success">{{ session()->get('success') }}</div>
               @endif
               @if(session()->has('error'))
                  <div class="alert alert-danger">{{ session()->get('error') }}</div>
               @endif
               @if(isset($errors) && count($errors) > 0)                  
                  <div class="alert alert-danger">
                    <ul>
                      @foreach($errors->all() as $error)
                      <li>{{$error}}</li>
                      @endforeach
                    </ul>
                  </div>
               @endif
               <div id="profile-view" class="add_employ_frm">
                  <div class="box mb20">
                     <div class="p20 pb0 border-bottom">
                        <h2 class="adminSubtitle">View Profile Info
                           <button class="btn btn-primary" style="float:right;" onclick="update_info('view');"> Update Info </button>
                        </h2>
                     </div>
                     <div class="p20">
                        <div class="pure-g-r row">
                           <div class="mb10 pure-u-1-3">
                              <div class="unit">
                                 <label class="adminFormLabel">Username</label>
                                 <div class="mt10">
                                    <span>{{$data['vendor']->username}}</span>
                                 </div>
                              </div>
                           </div>
                           <div class="mb10 pure-u-1-3">
                              <div class="unit">
                                 <label class="adminFormLabel">Email</label>
                                 <div class="mt10">
                                    <span>{{$data['vendor']->email}}</span>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="pure-g-r row">
                           @php /*<div class="mb10 pure-u-1-3">
                              <div class="unit">
                                 <label class="adminFormLabel">Category</label>
                                 <div class="mt10">
                                    <span>{{$data['vendor']->category_data->title}}</span>
                                 </div>
                              </div>
                           </div>*/ @endphp
                           <div class="mb10 pure-u-1-3">
                              <div class="unit">
                                 <label class="adminFormLabel">City</label>
                                 <div class="mt10">
                                    <span>{{$data['vendor']->company_data->city}}</span>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <h3 style="border-bottom: 1px dotted #ddd;">Categories</h3>
                        <div class="pure-g-r row">
                           @if(isset($data['categories']) && count($data['categories']) > 0)
                           @foreach($data['categories'] as $cat)
                           <div class="mb10 pure-u-1-3">
                              <div class="unit">
                                 <label class="adminFormLabel">{{($cat->title)}}</label>
                                 <div class="mt10">
                                    @php $childs = \App\VendorCategoryRelation::get_category_by_vendor($data['vendorId'],$cat->id);
                                    @endphp
                                    @foreach($childs as $child)
                                       <span>{{$child->title}}</span><br>
                                    @endforeach
                                 </div>
                              </div>
                           </div>
                           @endforeach
                           @endif
                        </div>
                     </div>
                  </div>
               </div>
               <div id="profile-update" class="add_employ_frm" style="display:none;">
                  <div class="box mb20">
                     <div class="p20 pb0 border-bottom">
                        <h2 class="adminSubtitle">Update Profile Info
                           <button class="btn btn-primary" style="float:right;" onclick="update_info('update');"> View Profile </button>
                        </h2>
                     </div>
                     <div class="p20">
                        <form class="pure-form pure-form-stacked" action="{{url('save-profile-settings')}}" method="post">
                           {{ csrf_field() }}
                           <div class="pure-g-r row">
                              <div class="mb10 pure-u-1-3">
                                 <div class="unit">
                                    <label class="adminFormLabel">Username</label>
                                    <div class="mt10">
                                       <input class="pure-u-1" type="text" name="username" value="{{$data['vendor']->username}}">
                                    </div>
                                 </div>
                              </div>
                              <div class="mb10 pure-u-1-3">
                                 <div class="unit">
                                    <label class="adminFormLabel">Email</label>
                                    <div class="mt10">
                                       <input class="pure-u-1" type="email" name="email" value="{{$data['vendor']->email}}">
                                    </div>
                                 </div>
                              </div>
                              <div class="mb10 pure-u-1-3">
                                 <div class="unit">
                                    <label class="adminFormLabel">Password</label>
                                    <div class="mt10">
                                       <input type="hidden" name="vendor_id" value="{{$data['vendor']->vendor_id}}">
                                       <input class="pure-u-1" type="password" name="password" placeholder="For change password fill it">
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="pure-g-r row">
                              @php /*<div class="mb10 pure-u-1-3 hidden">
                                 <div class="unit">
                                    <label class="adminFormLabel">Category</label>
                                    <div class="mt10">
                                       <input class="pure-u-1" type="text" value="{{$data['vendor']->category_data->title}}" readonly>
                                    </div>
                                 </div>
                              </div> */ @endphp
                              <div class="mb10 pure-u-1-3">
                                 <div class="unit">
                                    <label class="adminFormLabel">City</label>
                                    <div class="mt10">
                                       <input class="pure-u-1" type="text" value="{{$data['vendor']->company_data->city}}" readonly>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <label class="adminFormLabel">Categories</label>
                           <div class="pure-g-r row">
                              @if(isset($data['edit_category']) && count($data['edit_category']) > 0)
                              @foreach($data['edit_category'] as $cat)
                              <div class="mb10 pure-u-1-3">
                                 <div class="unit">
                                    <label>{{$cat['title']}}</label>
                                    <div class="mt10">
                                       @if(isset($cat['child']) && count($cat['child']) > 0)
                                       <ul style="height: 250px;overflow: auto;border:1px solid #868688;padding:5px;">
                                          @foreach($cat['child'] as $child)
                                          <li>
                                             <label class="container-ul">
                                                {{$child['title']}}
                                                 <input type="checkbox" value="{{$child['id']}}" @if($child['checked'] && !is_array(old('categories'))) checked @endif @if(is_array(old('categories')) && in_array($child['id'],old('categories'))) checked @endif name="categories[]" class="parking">
                                                 <span class="checkmark"></span>
                                            </label>
                                          </li>
                                          @endforeach
                                       </ul>
                                       @else
                                       <ul>
                                          <li>Coming Soon</li>
                                       </ul>
                                       @endif
                                    </div>
                                 </div>
                              </div>
                              @endforeach
                              @endif
                           </div>
                           <input class="btnFlat btnFlat--primary" type="submit" value="Update">
                           <input type="button" class="btnFlat btnFlat--grey ml10" onclick="update_info('update');" value="Cancel">
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
</section>
@include('includes.footer')
<script type="text/javascript">
   $('.succ_save_btn').click(function(){
      $('.setting_succ_msg').slideDown();
   });
   setTimeout(function() {
      $('.setting_succ_msg').slideUp();
   }, 4000);
   function update_info(vals) {
      if(vals == 'view') {
         $('#profile-view').css('display','none');
         $('#profile-update').css('display','block');
      } else {
         $('#profile-view').css('display','block');
         $('#profile-update').css('display','none');
      }
   }
   @if(session()->has('error') || (isset($errors) && count($errors) > 0) )
      update_info('view');
   @endif

</script>
@endsection