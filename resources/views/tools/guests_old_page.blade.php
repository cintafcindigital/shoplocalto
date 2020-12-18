@extends('layouts.default')
@section('meta_title',$data['titleData']->meta_title)
@section('meta_keyword',$data['titleData']->meta_keyword)
@section('meta_description',$data['titleData']->meta_description)
@section('content')
@include('includes.menu')
  <section class="section-padding-ex dashboard-wrap-ex">
      @include('tools.tools_nav');
      <div class="wrapper">
        <h1 class="tools-title mb0"> My Guests </h1>
        <div class="tools-guest-stats pure-g mb20">
    <div class="tools-guest-stats-item pure-u-1-3 border-right">
        <i class="icon-tools icon-tools-vendors-group-10"></i>
        <div class="guest-stats-count">
            <span class="block app-tools-guests-stats-total">{{$data['total_guest'] ?? 0}}</span>
            <p class="app-guests-stats-total-title">guests</p>
        </div>
        <div class="guest-stats-subcount">
            <span class="app-budget-stats-adults-title"><strong class="app-tools-guests-stats-adults">{{$data['ages']['adult'] ?? 0}}</strong> adults</span>
            <span>
                <span class="app-budget-stats-children-title"><strong class="app-tools-guests-stats-children">{{$data['ages']['children'] ?? 0}}</strong> children</span>
                <span class="app-budget-stats-babies-title ml10"><strong class="app-tools-guests-stats-babies">{{$data['ages']['baby'] ?? 0}}</strong> baby</span>
            </span>
        </div>
    </div>
    <div class="tools-guest-stats-item pure-u-1-3  ">
        <i class="icon-tools icon-tools-guest-count"></i>
        <div class="guest-stats-count">
            <span class="block app-tools-guests-stats-confirmed">{{$data['attendace']['confirmed'] ?? 0}}</span>
            <p class="app-budget-stats-confirmed-title">confirmed</p>
        </div>
        <div class="guest-stats-count">
            <span class="block app-tools-guests-stats-pending">{{$data['attendace']['pending'] ?? 0}}</span>
            <p class="app-budget-stats-pending-title">pending</p>
        </div>
        <div class="guest-stats-count">
            <span class="block app-tools-guests-stats-cancelled">{{$data['attendace']['cancelled'] ?? 0}}</span>
            <p class="app-budget-stats-cancelled-title">cancelled</p>
        </div>
    </div>
    </div>


        <ul class="btn-set fright mt30">
            <li>
                <a href="{{url('tools/guest-export')}}">
                    <i class="icon-tools-seating icon-tools-download"></i>
                    <span class="ml5 btn-set-label">Download</span>
                </a>
            </li>
            <!-- <li>
                <a target="_blank" href="/tools/GuestsPrint?tab=1" class="app-tools-guest-print">
                    <i class="icon icon-print"></i>
                    <span class="ml5 btn-set-label">Print</span>
                </a>
            </li> -->
        </ul>
        <div class="guest-header-options">
            <div class="inline-block mr15">
                <p class="guest-header-options-label">Create your registry</p>
                <a data-toggle="modal" data-target="#addGuestPopup" role="button" href="#" class="btn-flat red">
                    <i class="icon-tools icon-tools-plus-white icon-left"></i>
                    Guest                </a>
              
                <a role="button" data-tab="2" class="btn-flat red guests-rows-add ml10 app-guest-add-button dnone" data-toggle="modal" data-target="#tool-modal" data-remote="/tools/MenusAdd?section=group" href="/tools/MenusAdd?section=group">
                    <i class="icon-tools icon-tools-plus-white icon-left"></i>
                    Menu                </a>
                                <a href="{{url('tools/guest-export')}}" data-icon-old="icon-tools-download-red" data-icon-new="icon-tools-download-white" class="btn-outline outline-red ml10 btn-md-icon app-icon-hover">
                    <span class="ml5 btn-set-label">Import</span>
                </a>
            </div>
            <div class="guest-header-options-container inline-block">
            </div>
        </div>
        <div class="app-tools-guest-container">
            @if(Session::has('message'))
                       {!!Session::get('message')!!}
            @endif
        <form method="post" action="/tools/Guests" id="frmPaged" name="frmGuests">
        <div class="relative">
          <header class="guests-rows-header">
            <a href="{{url('tools/guests')}}"><span data-tab="1" class="guests-rows-header-link pointer app-tools-guest-change-tab @if($data['tab']=='groups') active @endif">Groups</span></a>
            <a href="{{url('tools/guests/menus')}}"><span data-tab="2" class="guests-rows-header-link pointer  app-tools-guest-change-tab @if($data['tab']=='menus') active @endif">Menus</span></a>
            <a href="{{url('tools/guests/attendance')}}"><span data-tab="4" class="guests-rows-header-link pointer  app-tools-guest-change-tab @if($data['tab']=='attendance') active @endif">Attendance</span></a>
        </header>
        <!-- <div class="guests-rows-actions ">
            <i class="icon-tools icon-tools-search icon-left"></i>
            <span class="reset-input app-input-search-guests-reset" style="display: none;">×</span>
            <input type="text" name="Query" value="" placeholder="Search guests..." class=" guests-rows-header-search app-input-search-guests">
        </div> -->

        <div class="app-dropdown-filters"></div>
        <div class="guests-rows-content guests-rows-content-full">

          @if(isset($data['guestListData']) && !empty($data['guestListData']))
            @foreach($data['guestListData'] as $keyid=>$guestlist)
            <table class="app-guest-row-group guests-rows-group" style="display: table;">
                 <thead>
                    <tr class="guests-rows-head app-guests-group-title">
                       <td width="24%" class="guests-rows-td guests-rows-nameBig">
                          {{ucwords($keyid)}} <span class="count app-guests-group-items-count">({{count($data['guestListData'][$keyid])}})</span>
                       </td>
                       <td width="15%" class="guests-rows-td guests-rows-tag">Attendance</td>
                       <td width="36%" class="guests-rows-td guests-rows-tag">Menu</td>
                       <td width="10%" class="guests-rows-td guests-rows-more">
                          <span data-selector="app-dropdown-header1" class="app-toogle-layer pointer"></span>
                          <!-- <div style="display:none;" class="guests-rows-dropdown app-dropdown-header1">
                             <a data-toggle="modal" data-target="#tool-modal" data-remote="/tools/GroupsAdd?section=group&amp;idGroup=1" data-selector="app-dropdown-header1" class="icon-tools icon-tools-edit icon-left" role="button">Rename</a>
                          </div> -->
                       </td>
                    </tr>
                 </thead>
                 <tbody>
                   @if(isset($guestlist) && !empty($guestlist))
                    @foreach($guestlist as $liss)
                    @php
                    $icon = 'groom';
                    if($liss['age_type'] == 'adult'){ $icon = ($liss['gender']=='female')?'bride':'groom'; }
                    if($liss['age_type'] == 'children'){ $icon = ($liss['gender']=='female')?'girl':'boy'; }
                    if($liss['age_type'] == 'baby'){ $icon = 'child'; }
                    @endphp
                    <tr data-name="Bride " data-parent-contact-id="186770" data-contact-id="186770" class="app-contact-row guests-rows-item" style="display: table-row;">
                       <td data-idcontact="186770" class="guests-rows-td guests-rows-name pointer app-contact-change-view-contact">
                           <span class="icon-tools icon-tools-{{$icon}}"></span>
                           @if($liss['related_id'])
                           <i class="guests-row-child icon-tools icon-tools-guest-lock"></i>
                           @endif
                          <span class="app-contact-grid-name pointer">
                          {{$liss['name']}}</span>
                       </td>
                       <td class="guests-rows-td">
                           <div class="checklist-boxNew-select-new">
                                  <select class="app-newTask-period" name="attendance" data-msgerror="You must select a attendance">
                                    <option value="">Select</option>
                                    <option value="confirmed" @if($liss['attendance'] =='confirmed') selected @endif>Confirmed</option>
                                    <option value="pending" @if($liss['attendance'] =='pending') selected @endif>Pending</option>
                                    <option value="cancelled" @if($liss['attendance'] =='cancelled') selected @endif>Cancelled</option>
                                  </select>
                                <i class="icon icon-arrow-down-red"></i>
                            </div>
                       </td>
                       <td class="guests-rows-td">
                          <div class="checklist-boxNew-select-new">
                                  <select class="app-newTask-period" name="menu" data-msgerror="You must select a age">
                                    <option value="">Select</option>
                                    <option value="adult" @if($liss['menu'] =='adult') selected @endif>Adults</option>
                                    <option value="children" @if($liss['menu'] =='children') selected @endif>Children</option>
                                    <option value="no menu assigned" @if($liss['menu'] =='no menu assigned') selected @endif>No menu assigned</option>
                                  </select>
                                <i class="icon icon-arrow-down-red"></i>
                            </div>
                       </td>
                       <td class="guests-rows-td guests-rows-more">
                          <a role="button" href="#" class="btn-outline outline-transparent" role="button" data-id="{{$liss['id']}}" onclick="Frontend.getEditGuestListData(this)">
                             <i class="icon icon-edit-grey app-task-edit-title pointer"></i>
                          </a>
                           <a class="btn-outline outline-transparent" role="button" data-id="{{$liss['id']}}" onclick="Frontend.deleteGuestList(this)">
                             <i class="icon-tools icon-tools-trash-grey task-delete-1"></i>
                          </a>
                          
                       </td>
                    </tr>
                    @endforeach
                  @endif
                 </tbody>
              </table>
              @endforeach
            @endif
                    </div>
              </div>
          </form>
        </div>
      </div>			
</section>
  @include('includes.add_guest_popup')
  @include('includes.edit_guest_popup')
  @include('includes.error_popup')
  @include('includes.footer')
@endsection       
