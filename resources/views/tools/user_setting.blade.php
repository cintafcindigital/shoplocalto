@extends('layouts.default')
@section('meta_title',$data['titleData']->meta_title)
@section('meta_keyword',$data['titleData']->meta_keyword)
@section('meta_description',$data['titleData']->meta_description)
@section('content')
@include('includes.menu')

  <section class="section-padding dashboard-wrap">
     @include('tools.tools_nav');
  <div class="wrapper">
    <div class="pure-g">
        <div class="pure-u-1-5">
            <div class="pure-s mt5">
                <p class="tools-subtitle">Settings</p>
                <ul class="tools-filters">   
                    <li class="tools-filters-item current">
                        <a class="tools-filters-item-name" href="{{url('user-settings')}}">User profile</a>
                    </li>
                    <li class="tools-filters-item">
                        <a class="tools-filters-item-name" href="{{url('account-settings')}}">Account settings</a>
                    </li>   
                </ul>
            </div>
        </div>
        <div class="pure-u-4-5">
            <div class="profile-header">
                <span class="tools-title">Edit my profile</span>
            </div>

               @if(session()->has('success'))
                   <div class="app-success-box alert alert-success">
                            {{ session()->get('success') }}
                   </div>
               @endif
                @if(session()->has('error'))
                   <div class="app-danger-box alert alert-danger">
                            {{ session()->get('error') }}
                   </div>
               @endif

              <div class="profile-box">
              <p class="profile-box-header">My personal information</p>
              <div class="profile-box-content pure-g">
                  <div class="pure-u-17-24">
                      <form name="frmComunidad" class="app-frmComunidad" action="{{url('save-user-settings')}}" method="post" enctype="multipart/form-data">               
                      {{csrf_field()}}
                      <div class="pure-g">
                          <div class="pure-u-1-2 pr40">
                              <p class="input-group-line-label">Name</p>
                              <div class="input-group-line">
                                  <input class="app-com-modif-save-input" type="text" name="name" value="{{$data['userData']->name ?? ''}}" maxlength="150" data-msgerror="">
                                  @if($errors->has('name'))
                                                <span class="custom-error">{{$errors->first('name')}}</span>
                                  @endif
                              </div>
                          </div>
                          <div class="pure-u-1-2 pt35">
                              <a class="profile-box-smallLink" href="{{url('account-settings')}}">Change Password</a>
                          </div>
                      </div>
                      <div class="pure-g">
                          <div class="pure-u-1-2 pr40">
                              <p class="input-group-line-label">Address</p>
                              <div class="input-group-line">
                                  <input type="text" class="app-com-modif-save-input" name="address" value="{{$data['userData']->address ?? ''}}" maxlength="150" placeholder="You live in..">
                                  @if($errors->has('address'))
                                      <span class="custom-error">{{$errors->first('address')}}</span>
                                 @endif
                              </div>
                          </div>
                      </div>

                      <div class="pure-g">
                          <div class="pure-u-1-2 pr40">
                              <p class="input-group-line-label">Country</p>
                              <div class="input-group-line">
                                  <select name="country" id="country" class="form-control">
                                                <option value="">Country</option>
                                                @if(isset($countries) && !empty($countries))
                                                  @foreach($countries as $k=>$val)
                                                     <option value='{{$val['sortname']}}' @php if($val['sortname'] == $data['userData']->country){ echo"selected";} @endphp >{{$val['name']}}</option>
                                                  @endforeach
                                                @endif
                                            </select>
                                  @if($errors->has('country'))
                                      <span class="custom-error">{{$errors->first('country')}}</span>
                                  @endif
                              </div>
                          </div>
                      </div>

                      <div class="pure-g">
                          <div class="pure-u-1-2 pr40">
                              <p class="input-group-line-label">E-mail</p>
                              <div class="input-group-line disabled">
                                  <input type="text" class="pure-u-1 app-com-modif-save-input" style="cursor:not-allowed;" value="{{$data['userData']->email ?? ''}}" readonly="">
                              </div>
                          </div>
                      </div>

                      <div class="pure-g">
                          <div class="pure-u-1-2 pr40">
                              <p class="input-group-line-label">Phone number</p>
                              <div class="input-group-line">
                                  <input type="text" class="pure-u-1 app-com-modif-save-input" name="phone" value="{{$data['userData']->phone ?? ''}}" maxlength="20">
                              </div>
                          </div>
                      </div>

                      <div class="pure-g">
                          <div class="pure-u-1-2 pr40">
                               <button type="submit" name="com-ModifSubmit" class="btn-flat red">Save changes</button>
                          </div>
                      </div>
                  </form>
                    
                </div>
              <div class="pure-u-7-24 text-center">
                  <div class="avatar">
                     <div class="author-image" data-toggle="tooltip" data-placement="bottom">
                        <figure>
                            <img class="avatar-thumb" style="width:200px;height:200px;" src="{{$data['profile_image']}}" alt="{{$data['userData']->name ?? ''}}">
                        </figure>
                        <a href="{{url('tools/my-wedding')}}" class="">
                              <button class="profileImage btn-outline outline-red mt10" title="My Profile">My Profile</button>
                        </a>

                    </div>
                   
                  </div>
                
              </div>
              </div>
          </div>
          
        </div>
    </div>
  </div>
</section>

  @include('includes.footer')
@endsection       
