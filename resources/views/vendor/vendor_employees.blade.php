@extends('layouts.default')
@section('meta_title',$data['titleData']->meta_title)
@section('meta_keyword',$data['titleData']->meta_keyword)
@section('meta_description',$data['titleData']->meta_description)
@section('content')
@include('includes.menu')

@php
$parent_vendor = $data['vendorData']; 
$all_members = $data['vendorEmployees'];
@endphp
<section class="section-padding dashboard-wrap billing_page_wrp dash_main_sect">
	@include('vendor.tools_nav')
	<div class="wrapper">
	   <div class="pure-g">
	      <div class="pure-u-2-7">
	         <div class="mr40">
	            <nav class="adminAside setting_list_wrp">
	            	<a class="adminAside__item " href="{{url('profile-settings')}}">
	            		<i class="svgIcon svgIcon__gen adminAside__icon">
	            			<svg viewBox="0 0 17 18">
	            				<path d="M1 1v16h15V1H1zm0-1h15a1 1 0 0 1 1 1v16a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V1a1 1 0 0 1 1-1zm3.5 5V4h10v1h-10zm-1 3.5v-1h11v1h-11z" fill-rule="nonzero"></path>
	            			</svg>
	            		</i> PROFILE SETTINGS
	            	</a>
	            	<a class="adminAside__item active" href="{{url('employees')}}">
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
	         <h1 class="adminTitle">Employees</h1>
	         <div class="adminAlert adminAlert--flex employee_detail_wrp">
	            <div>
	               <p class="adminAlert__title">Add additional users to your account</p>
	               <p>It is very important that all the information on your Profile Page and your contact info is updated and accurate. </p>
	            </div>
	            <div class="adminAlert__cta">
	               <button class="btnFlat btnFlat--primary app-empleados-new add_employ_btn">Add new employee</button>
	            </div>
	         </div>

         	@if(session()->has('message'))
			    <div id="app-alert-leida" class="app-alert adminAlert adminAlert--success">
			        {{ session()->get('message') }}
			    </div>
			@endif

			@if(session()->has('error'))
			    <div class="alert alert-danger">
			        {{ session()->get('error') }}
			    </div>
			@endif

			@if ($errors->any())
			    @foreach ($errors->all() as $error)
			          <div class="alert alert-danger">{{$error}}</div>
			    @endforeach
			@endif

	         <div id="app-empleados-new" class="add_employ_frm" style="display: none;">
	         	<div class="box mb20">
				   <div class="p20 pb0 border-bottom">
				      <h2 class="adminSubtitle">Add new employee</h2>
				   </div>
				   <div class="p20">
				    <form class="pure-form pure-form-stacked" name="addemployee" id="addemployee" action="{{ url('add-employee') }}" method="post">
				      {{ csrf_field() }}
				         <div class="pure-g-r row">
				            <div class="mb10 pure-u-1-3">
				               <div class="unit">
				                  <label class="adminFormLabel">Username</label>
				                  <div class="mt10">
				                     <input class="pure-u-1" type="text" name="Eusername" id="Login" value="">
				                  </div>
				               </div>
				            </div>
				            <div class="mb10 pure-u-1-3">
				               <div class="unit">
				                  <label class="adminFormLabel">Password</label>
				                  <div class="mt10">
				                     <input class="pure-u-1" name="Epassword" autocomplete="off" maxlength="20" type="password">
				                  </div>
				               </div>
				            </div>
				            <div class="mb10 pure-u-1-3">
				               <div class="unit">
				                  <label class="adminFormLabel">Confirm password</label>
				                  <div class="mt10">
				                     <input class="pure-u-1" name="Econfirmpassword" autocomplete="off" maxlength="20" type="password">
				                  </div>
				               </div>
				            </div>
				         </div>
				         <div class="pure-g-r row">
				            <div class="mb10 pure-u-1-3">
				               <div class="unit">
				                  <label class="adminFormLabel">Role</label>
				                  <div class="mt10">
				                    <div class="pure-u-1">
			                            <input class="pure-u-1" type="text" value="" name="role">
			                        </div>
				                  </div>
				               </div>
				            </div>
				            <div class="mb10 pure-u-1-3">
				               <div class="unit">
				                  <label class="adminFormLabel">Name</label>
				                  <div class="mt10">
				                     <input class="pure-u-1" type="text" name="Ename" id="Ename" value="">
				                  </div>
				               </div>
				            </div>
				            <div class="mb10 pure-u-1-3">
				               <div class="unit">
				                  <label class="adminFormLabel">Email</label>
				                  <div class="mt10">
				                     <input class="pure-u-1" type="text" name="Email" id="Email" value="">
				                  </div>
				               </div>
				            </div>
				        </div>
				        <input class="btnFlat btnFlat--primary" type="submit" value="Add" onclick="addemployee()">
				        <input type="button" class="app-empleados-cancelar btnFlat btnFlat--grey ml10" value="Cancel">
				    </form>
				   </div>
				</div>
	         </div>

	         <ul class="adminStaff employee_wrp">

	         	@if($parent_vendor)
	            <li class="adminStaff__item pure-g app-empleados app-vendor">
	               <div class="pure-u-5-10">
	                  <i class="adminStaff__icon icon icon-user"></i>
	                  <p class="adminStaff__info">
	                     <a class="adminStaff__name app-empleados-edit" data-idempleado="81249" title="Editar" role="button">
	                     {{$parent_vendor[0]['contact_person']}}</a>
	                     <small class="adminStaff__rank">Owner</small>
	                     <small class="adminStaff__mail">{{$parent_vendor[0]['email']}}</small>
	                  </p>
	               </div>
	               <div class="pure-u-5-10 text-right">
	                  <time class="adminStaff__date">Registration Date: {{$parent_vendor[0]['created_at']}}</time>
	                  <a class="app-empleados-edit icon icon-arrow-down  pointer" role="button" data-idempleado="{{$parent_vendor[0]['vendor_id']}}"></a>
	               </div>
	               <div class="pure-u-1 app-empleados-content" style="display:none;">

	               		<div class="pure-u-1 app-empleados-content" style="">    
	               			<hr class="mt20 mb20">

						    <form class="pure-form pure-form-stacked" name="formEmpedit" id="formEmpedit" action="{{ url('/update-employee') }}" method="post">
						    	{{ csrf_field() }}
						        <input type="hidden" name="vendor_id" value="{{$parent_vendor[0]['vendor_id']}}">

						        <div class="pure-g-r row showingPasswoard">
						            <div class="mb10 pure-u-1-3">
						                <div class="unit">
						                    <label class="adminFormLabel">Username</label> 
						                    <div class="mt10">
						                        <input class="pure-u-1" type="text" name="vendor_username" id="vendor_username" value="{{$parent_vendor[0]['username']}}">
						                    </div>
						                    <input name="vendor_username_old" value="{{$parent_vendor[0]['username']}}" type="hidden">
						                    <a class="small pointer block mt5 changpass" role="button">I want to change my password</a>
						                </div>
						            </div>
						            <div class="mb10 pure-u-1-3"></div>
						            <div class="mb10 pure-u-1-3"></div>
						        </div>

						        <div class="app-va-empresa-cambiar-password dnone">

						            <div class="pure-g-r row">
						                <div class="mb10 pure-u-1-3">
						                    <div class="unit">
						                        <label class="adminFormLabel">Your password</label>
						                        <div class="mt10">
						                            <input class="pure-u-1 vendor_password_old" placeholder="Enter the current password" name="vendor_password_old" autocomplete="off" maxlength="20" type="password">
						                        </div>
						                        <a class="small pointer block mt5" href="javascript:;">Forgot your password?</a>
						                    </div>
						                </div>

						                <div class="mb10 pure-u-1-3">
						                    <div class="unit">
						                        <label class="adminFormLabel">New password</label>
						                        <div class="mt10">
						                            <input class="pure-u-1 vendor_password_new" placeholder="Enter your new password" name="vendor_password_new" autocomplete="off" maxlength="20" type="password">
						                        </div>
						                    </div>
						                </div>

						                <div class="mb10 pure-u-1-3">
						                    <div class="unit">
						                        <label class="adminFormLabel">Confirm password</label>
						                        <div class="mt10">
						                            <input class="pure-u-1 vendor_password_confirm" placeholder="Confirm new password" name="vendor_password_confirm" autocomplete="off" maxlength="20" type="password">
						                        </div>
						                    </div>
						                </div>
						            </div>
						        </div>

						        <div class="pure-g-r row">	
						            <div class="mb10 pure-u-1-3">
						                <div class="unit">
						                    <label class="adminFormLabel">Name</label>
						                    <div class="mt10">
						                        <input class="pure-u-1" type="text" name="vendor_name" id="vendor_name" value="{{$parent_vendor[0]['contact_person']}}">
						                    </div>
						                </div>
						            </div>
						            <div class="mb10 pure-u-1-3">
						                <div class="unit">
						                    <label class="adminFormLabel">Email</label>
						                    <div class="mt10">
						                        <input class="pure-u-1" type="text" name="vendor_email" id="vendor_email" value="{{$parent_vendor[0]['email']}}">
						                    </div>
						                </div>
						            </div>
						        </div>
						        <input class="btnFlat btnFlat--primary save_employee" type="submit" value="Save changes" >
						    </form>

						</div>
	               </div>
	            </li>
	            @endif
	            @foreach ($all_members as $all_member)

	            	<li class="adminStaff__item pure-g app-empleados app-vendor">
		                <div class="pure-u-5-10">
		                  <i class="adminStaff__icon icon icon-user"></i>
		                  <p class="adminStaff__info">
		                     <a class="adminStaff__name app-empleados-edit" data-idempleado="81249" title="Editar" role="button">
		                     {{$all_member->contact_person}}</a>
		                     <small class="adminStaff__rank">{{$all_member->role}}</small>
		                     <small class="adminStaff__mail">{{$all_member->email}}</small>
		                  </p>
		                </div>
		                <div class="pure-u-5-10 text-right">
		                  <time class="adminStaff__date">Registration Date: {{$all_member->created_at}}</time> 
		                  <a class="app-empleados-edit icon icon-arrow-down  pointer" role="button" data-idempleado="{{$all_member->vendor_id}}"></a>
		                </div>
		                <div class="pure-u-1 app-empleados-content vendor-{{$all_member->vendor_id}}" style="display:none;">
		                	<div class="pure-u-1 app-empleados-content" style="">    
		               			<hr class="mt20 mb20">

		               			@if (count($errors) > 0)
								    <div class="alert alert-danger">
								        <ul>
								            @foreach ($errors->all() as $error)
								                <li>{{ $error }}</li>
								            @endforeach
								        </ul>
								    </div>
								@endif

		               			<form class="pure-form pure-form-stacked form-vendor-{{$all_member->vendor_id}}" name="formEmpedit" id="form-vendor-{{$all_member->vendor_id}}" action="{{ url('/update-employee') }}" method="post">
						    		{{ csrf_field() }}							   
							        <input type="hidden" name="vendor_id" value="{{$all_member->vendor_id}}">

							        <div class="pure-g-r row showingPasswoard">
							            <div class="mb10 pure-u-1-3">
							                <div class="unit">

							                    <label class="adminFormLabel">Username</label>
							                    <div class="mt10">
							                        <input class="pure-u-1" type="text" value="{{ $all_member->username }}" readonly="readonly">
							                    </div>
							                    <a class="small pointer block mt5 changpass" role="button">I want to change my password</a>
							                </div>
							            </div>
							            <div class="mb10 pure-u-1-3"></div>
							            <div class="mb10 pure-u-1-3"></div>
							        </div>

							        <div class="app-va-empresa-cambiar-password dnone">

							            <div class="pure-g-r row">
							                <div class="mb10 pure-u-1-3">
							                    <div class="unit">
							                        <label class="adminFormLabel">Your password</label>
							                        <div class="mt10">
							                            <input class="pure-u-1 vendor_password_old" placeholder="Enter the current password" name="vendor_password_old" autocomplete="off" maxlength="20" type="password">
							                        </div>
							                        <a class="small pointer block mt5" href="javascript:;">Forgot your password?</a>
							                    </div>
							                </div>

							                <div class="mb10 pure-u-1-3">
							                    <div class="unit">
							                        <label class="adminFormLabel">New password</label>
							                        <div class="mt10">
							                            <input class="pure-u-1 vendor_password_new" placeholder="Enter your new password" name="vendor_password_new" autocomplete="off" maxlength="20" type="password">
							                        </div>
							                    </div>
							                </div>

							                <div class="mb10 pure-u-1-3">
							                    <div class="unit">
							                        <label class="adminFormLabel">Confirm password</label>
							                        <div class="mt10">
							                            <input class="pure-u-1 vendor_password_confirm" placeholder="Confirm new password" name="vendor_password_confirm" autocomplete="off" maxlength="20" type="password">
							                        </div>
							                    </div>
							                </div>
							            </div>
							        </div>

							        <div class="pure-g-r row">

							        	@if(isset($all_member->parent_vendor_id) && $all_member->parent_vendor_id != 0)
								            <div class="mb10 pure-u-1-3">
								                <div class="unit">
								                    <label class="adminFormLabel">Role</label>
								                    <div class="mt10">
								                        <div class="pure-u-1">
								                            <input class="pure-u-1" type="text" name="vendor_role" id="vendor_role" value="{{$all_member->role}}">
								                        </div>
								                    </div>
								                </div>
								            </div> 
								        @endif

							            <div class="mb10 pure-u-1-3">
							                <div class="unit">
							                    <label class="adminFormLabel">Name</label>
							                    <div class="mt10">
							                        <input class="pure-u-1" type="text" name="vendor_name" id="vendor_name" value="{{$all_member->contact_person}}">
							                    </div>
							                </div>
							            </div>

							            <div class="mb10 pure-u-1-3">
							                <div class="unit">
							                    <label class="adminFormLabel">Email</label>
							                    <div class="mt10">
							                        <input class="pure-u-1" type="text" name="vendor_email" id="vendor_email" value="{{$all_member->email}}">
							                    </div>
							                </div>
							            </div>
							            
							            <!--<div class="mb10 pure-u-1-3">
							                <div class="unit">
							                    <label class="adminFormLabel">Role</label>
							                    <div class="mt10">
							                        <input class="pure-u-1" type="text" name="vendor_role" id="vendor_role" value="{{$all_member->role}}">
							                    </div>
							                </div>
							            </div>-->

							        </div>
							        <input class="btnFlat btnFlat--primary save_employee" type="submit"  value="Save changes"> 
							    </form>
							</div>
		                </div>
	            	</li>
	        	@endforeach	
	        </ul>
	      </div>
	   </div>
	</div>
</section>
@include('includes.footer')
<script type="text/javascript">

	// function addemployee() {
	// 	$('')	
	// }

	$(document).ready(function(){

		$('.add_employ_btn').click(function(){
			$(this).attr("disabled", true);
			$('.add_employ_frm').show();
		});
		$('.app-empleados-cancelar').click(function(){
			$('.add_employ_btn').attr("disabled", false);
			$('.add_employ_frm').hide();
		});
		$('.app-empleados-edit').click(function(){
			console.log($(this).parent().siblings());
			$(this).parent().siblings('.app-empleados-content').toggle();
		});

		$('.save_employee').click(function() {
			var empl_form = $(this).parent('form');

			var passwordOld = empl_form.find('.vendor_password_old').val();
			var passwordnew = empl_form.find('.vendor_password_new').val();
			var passwordConfirm = empl_form.find('.vendor_password_confirm').val();

			if(empl_form.find('.app-va-empresa-cambiar-password').hasClass('activeChecker')) {

				if(passwordOld.length < 6){
					alert('Enter Old Password atleast 6 characters');
					return false;
				}

				if(passwordnew.length < 6){
					alert('Enter New Password atleast 6 characters');
					return false;
				}

				if(passwordConfirm.length < 6){
					alert('Enter Confirm Password atleast 6 characters');
					return false;
				}

			}

		});

		$('.changpass').on('click', function() {
			var psObj = $(this).parents('.showingPasswoard');
			psObj.next().addClass('activeChecker');
			psObj.next().show();
			$(this).remove();
		});
	});
</script>
@endsection