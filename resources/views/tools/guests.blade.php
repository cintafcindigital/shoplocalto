@extends('layouts.default')
@section('meta_title',$data['titleData']->meta_title)
@section('meta_keyword',$data['titleData']->meta_keyword)
@section('meta_description',$data['titleData']->meta_description)
@section('content')
@include('includes.menu')
<?php
    $tab = @Request::get('tab') ? : '1';
    $idEvent = @Request::get('idEvent') ? : '';
    $idGuest = @Request::get('idGuest') ? : '';
    $viewGrid = @Request::get('viewGrid') ? : '1';
    $guestsTitle = 'Overview';
    if($idEvent) {
        $guestsTitle = $data['current_event']->event_name;
    }
?>
<section class="section-padding-ex dashboard-wrap-ex">
    @include('tools.tools_nav')
    @include('includes.guests.pageCSS')
    <div class="wrapper guest-desgin">
        <div class="mb20 text-center">
            <div class="text-center" data-where="">
                <div class="inline-block tools-toggle">
                    <span class="tools-toggle-item @if(!$idEvent) active @endif app-event-change" data-href="{{url('/tools/guests')}}">Overview</span>
                    @foreach($data['guests_event'] as $ge)
                        <span class="tools-toggle-item @if($idEvent == $ge->id) active @endif app-event-change" data-href="{{url('/tools/guests')}}?idEvent={{$ge->id}}">{{$ge->event_name}}</span>
                    @endforeach
                    <a class="tools-toggle-item small " href="/tools/guests/eventForm"><i class="icon-tools icon-tools-plus"></i></a>
                </div>
            </div>
        </div>
        <div class="app-guests-header">
            @if($idEvent != '')
                <a href="{{url('/tools/guests/eventForm').'?idEvent='.$idEvent}}" class="tools-title-count guestsTitle__action mt10 mr10" role="button">
                    <i class="icon-tools icon-tools-settings icon-left"></i> Settings
                </a>
            @endif
            <h1 class="tools-title guestsTitle">{{$guestsTitle}}</h1>
            @if($idEvent == '')
                <div class="pure-g guestStats app-guests-summary">
                    @foreach($data['guests_event_limit'] as $genm => $ge)
                        @php $cnfrmVal = $cncldVal = 0; @endphp
                        <div class="guestStats__item pure-u-1-3 app-guests-summary-event">
                            <a href="{{url('/tools/guests')}}?idEvent={{$ge->id}}">
                                @php foreach($ge->guestsInvitationCount as $evt) {
                                        if($ge->id == $evt->invited_for) {
                                            if($evt->attendances == 'confirmed') {
                                                $cnfrmVal++;
                                            } elseif($evt->attendances == 'cancelled') {
                                                $cncldVal++;
                                            }
                                        }
                                        if($idGuest == '') { $idGuest = $evt->guest_id; }
                                    }
                                @endphp
                                @if($genm == 0)
                                    <i class="guestStats__icon icon-tools icon-tools-guest-wedding ml20"></i>
                                @elseif($genm == 1)
                                    <i class="guestStats__icon icon-tools icon-tools-guest-rehearsal ml20"></i>
                                @elseif($genm == 2)
                                    <i class="guestStats__icon icon-tools icon-tools-guest-bridal ml20"></i>
                                @endif
                                <div class="guestStats__content">
                                    <p class="guestStats__title">{{$ge->event_name}}</p>
                                    <div class="guestStats__count">
                                        <span class="guestStats__subtitle app-tools-guests-stats-pending">{{count($ge->guestsInvitationCount)}}</span>
                                        <span class="app-budget-stats-pending-title">Guests</span>
                                    </div>
                                    <div class="guestStats__count">
                                        <span class="guestStats__text app-budget-stats-adults-title">
                                            <strong class="app-tools-guests-stats-confirmed">{{$cnfrmVal}}</strong> Attending
                                        </span>
                                        <span class="guestStats__text app-budget-stats-adults-title">
                                            <strong class="app-tools-guests-stats-declined">{{$cncldVal}}</strong> Cancelled
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            @elseif($idEvent !== '')
                @php $totalVal = $cnfrmVal = $cncldVal = $pendngVal = $seatedVal = 0; $haveTables = 'No';
                    foreach($data['guests_event'] as $ge) {
                        if($ge->id == $idEvent) {
                            if($ge->tables == 'Yes') {
                                $haveTables = 'Yes';
                            }
                            foreach($ge->guestsInvitationCount as $evt) {
                                if($evt->attendances == 'confirmed') {
                                    $cnfrmVal++;
                                } elseif($evt->attendances == 'cancelled') {
                                    $cncldVal++;
                                } elseif($evt->attendances == 'pending') {
                                    $pendngVal++;
                                }
                                if($evt->tables != '') {
                                    $seatedVal++;
                                }
                                $totalVal++;
                                if($idGuest == '') { $idGuest = $evt->guest_id; }
                            }
                        }
                    }
                @endphp
                <div class="pure-g mb20 app-guests-summary guestStats">
                    <div class="guestStats__item @if($haveTables == 'Yes') pure-u-1-3 @else pure-u-1-2 @endif">
                        <i class="guestStats__icon icon-tools icon-tools-guest-count"></i>
                        <div class="guestStats__content">
                            <div class="guestStats__count">
                                <span class="guestStats__subtitle app-tools-guests-stats-total">{{$totalVal}}</span>
                                <span class="app-guests-stats-total-title">Guests</span>
                            </div>
                        </div>
                    </div>
                    <div class="guestStats__item @if($haveTables == 'Yes') pure-u-1-3 @else pure-u-1-2 @endif">
                        <i class="guestStats__icon icon-tools icon-tools-guest-stats"></i>
                        <div class="guestStats__content">
                            <div class="guestStats__count">
                                <span class="guestStats__subtitle app-tools-guests-stats-confirmed">{{$cnfrmVal}}</span>
                                <span class="app-budget-stats-confirmed-title">Attending</span>
                            </div>
                            <div class="guestStats__count">
                                <span class="guestStats__text">
                                    <strong class="app-tools-guests-stats-pending">{{$pendngVal}}</strong>
                                    <span class="app-budget-stats-pending-title">Pending</span>
                                </span>
                                <span class="guestStats__text">
                                    <strong class="app-tools-guests-stats-cancelled">{{$cncldVal}}</strong>
                                    <span class="app-budget-stats-cancelled-title">Cancelled</span>
                                </span>
                            </div>
                        </div>
                    </div>
                    @if($haveTables == 'Yes')
                        <div class="guestStats__item pure-u-1-3">
                            <i class="guestStats__icon icon-tools icon-tools-guest-tables"></i>
                            <div class="guestStats__content">
                                <span class="guestStats__text">
                                    <strong class="app-tools-guests-stats-seated guestStats__subtitle guestStats__subtitle--inline">{{$seatedVal}}</strong>
                                    <span>Seated guests</span>
                                    <a class="link--primary block" href="{{url('tools/seating_chart').'?idEvent='.$idEvent}}">Create Seating Chart</a>
                                </span>
                            </div>
                        </div>
                    @endif
                </div>
            @endif
            <div class="pure-g">
                <div class="pure-u-1-2">
                    <div class="pure-u app-toogle-layer pointer relative inline-block" data-selector="app-dropdown-request-contact">
                        <a class="btnOutline btnOutline--grey message_guests" role="button">
                            <i class="icon icon-mail-letter mr10"></i>Message guests <i class="icon icon-arrow-down"></i>
                        </a>
                        <div class="guestsDropdown app-dropdown-request-contact dnone">
                            <a href="{{url('tools/guests/onlineInvitation').'?idEvent='.$idEvent}}" class="icon icon-mail-letter icon-left">Online Invitation</a>
                            <a href="{{url('tools/guests/requestRSVP').'?idEvent='.$idEvent}}" class="icon icon-mail-letter icon-left">Request RSVP</a>
                            <a href="{{url('tools/guests/requestAddress')}}" class="icon icon-mail-letter icon-left">Request Address</a>
                        </div>
                    </div>
                </div>
                <div class="pure-u-1-2 text-right">
                    @if($idEvent != '')
                        <div class="pure-u ml10">
                            <div class="app-toogle-layer relative inline-block" data-selector="app-dropdown-export">
                                <a class="btnOutline btnOutline--grey exportButton" role="button"><i class="icon-tools icon-tools-export mr10"></i>Export</a>
                                <div class="guestsDropdown guestsDropdown--right app-dropdown-export dnone" style="display:none;">
                                    <a href="{{url('tools/guests/download_guestList').'?idEvent='.$idEvent}}" class="icon-tools icon-tools-download-pdf"> Download</a>
                                    <a href="/tools/GuestsPrint?tab=1&amp;idEvent={{$idEvent}}" class="app-tools-guest-print icon-tools icon-tools-print" target="_blank"> Print</a>
                                </div>
                            </div>
                        </div>
                        <div class="pure-u ml10">
                            <a class="btnOutline btnOutline--grey" href="{{url('tools/guests/stats')}}?idEvent={{$idEvent}}">
                                <i class="icon icon-stats icon-left"></i> View summary
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="guestsRows app-tools-guest-container">
            <nav class="guestsRows__nav">
                <div class="guestsRows__right">
                    <span class="guestsRows__rightTitle">View:</span>
                    <div class="guestsRows__changeView">
                        <button class="app-tools-guest-change-view viewGrid1 @if($viewGrid == 1) active @endif" role="button" onclick="take_viewGrid('1');">
                            <i class="icon-tools icon-tools-list"></i>
                        </button>
                        <button class="app-tools-guest-change-view viewGrid2 @if($viewGrid == 2) active @endif" role="button" onclick="take_viewGrid('2');">
                            <i class="icon-tools icon-tools-profile"></i>
                        </button>
                    </div>
                </div>
                @if($idEvent)
                    <span class="guestsRows__navLink app-tools-guest-change-tab tab1 @if($tab == 1) active @endif" onclick="take_tab('1');">Groups</span>
                    @if($data['current_event']->menus == 'Yes')
                        <span class="guestsRows__navLink app-tools-guest-change-tab tab2 @if($tab == 2) active @endif" onclick="take_tab('2');">Menu</span>
                    @endif
                    @if($data['current_event']->tables == 'Yes')
                        <span class="guestsRows__navLink app-tools-guest-change-tab tab3 @if($tab == 3) active @endif" onclick="take_tab('3');">Seating Chart</span>
                    @endif
                    <span class="guestsRows__navLink app-tools-guest-change-tab tab4 @if($tab == 4) active @endif" onclick="take_tab('4');">Attendance</span>
                    @if($data['current_event']->lists == 'Yes')
                        <span class="guestsRows__navLink app-tools-guest-change-tab tab5 @if($tab == 5) active @endif" onclick="take_tab('5');">Lists</span>
                    @endif
                @endif
            </nav>
            <div class="guestsRows__actions">
                <a data-target="#newGuests-modal" data-toggle="modal" role="button" class="app-tools-guest-add btn-flat red mr10">
                    <i class="icon-tools icon-tools-plus-white icon-left"></i> Guest
                </a>
                <a class="btnOutline btnOutline--red app-tools-section-add app-icon-hover add_groups" onclick="add_groups();" role="button" @if($tab != 1) style="display:none;" @endif>
                    <i class="icon-tools icon-tools-plus-red icon-left"></i> Group
                </a>
                @if($idEvent)
                <a class="btnOutline btnOutline--red app-tools-section-add app-icon-hover add_menus" onclick="add_menus();" role="button" @if($tab != 2) style="display:none;" @endif>
                    <i class="icon-tools icon-tools-plus-red icon-left"></i> Menu
                </a>
                <a class="btnOutline btnOutline--red app-tools-section-add app-icon-hover add_tables" onclick="window.location.href='{{url('tools/seating_chart').'?idEvent='.$idEvent}}'" role="button" @if($tab != 3) style="display:none;" @endif>
                    <i class="icon-tools icon-tools-plus-red icon-left"></i> Table
                </a>
                <a class="btnOutline btnOutline--red app-tools-section-add app-icon-hover add_lists" onclick="add_lists();" role="button" @if($tab != 5) style="display:none;" @endif>
                    <i class="icon-tools icon-tools-plus-red icon-left"></i> List
                </a>
                @endif
                <div class="guestsRows__search">
                    <i class="icon-tools icon-tools-search icon-left"></i>
                    <span class="reset-input app-input-search-guests-reset" style="display:none;">×</span>
                    <input type="text" class="guests-rows-header-search app-input-search-guests" placeholder="Search guests..." name="searchGuests">
                </div>
            </div>
            <input type="hidden" name="tab" id="tab" value="{{$tab}}">
            <input type="hidden" name="viewGrid" id="viewGrid" value="{{$viewGrid}}">
            <input type="hidden" name="idEvent" id="idEvent" value="{{$idEvent}}">
            <input type="hidden" name="idGuest" id="idGuest" value="{{$idGuest}}">
            <div class="listView" @if($viewGrid == 2) style="display:none;" @endif> @include('includes.guests.listView') </div>
            <div class="pure-g imageView" @if($viewGrid == 1) style="display:none;" @endif> @include('includes.guests.imageView') </div>
        </div>
    </div>
    @include('includes.guests.add_guest_modal')
    @include('includes.guests.remove_guest_modal')
    @include('includes.guests.add_group_modal')
    @include('includes.guests.new_menu_modal')
    @include('includes.guests.new_list_modal')
    @include('includes.guests.moveGroups_modal')
    @include('includes.guests.moveAttendance_modal')
    @include('includes.guests.moveMenus_modal')
    @include('includes.guests.moveLists_modal')
    @include('includes.guests.add_newCompanion')
    @include('includes.guests.edit_table_modal')
</section>
<?php /*@include('includes.add_guest_popup')
@include('includes.edit_guest_popup')
@include('includes.error_popup')
*/ ?>
@include('includes.footer')
<script>
$(document).ready(function(){
    $('body').on('click','.message_guests', function(){
        $('.app-dropdown-request-contact').toggle();
    });
    $('body').on('click','.section-padding-ex', function(e) {
        if($(e.target).attr('class') == 'btnOutline btnOutline--grey message_guests') {
            $('.app-dropdown-request-contact').show();
        } else {
            $('.app-dropdown-request-contact').hide();
        }
        if($(e.target).attr('class') != 'app-input-label input-select-label input-filled') {
            $('.hideStatusChange').hide();
            $('.hideMenusChange').hide();
            $('.hideTablesChange').hide();
            $('.hideListsChange').hide();
            $('.hideGroupChange').hide();
            $('.hideeStatusChange').hide();
            $('.hideeMenusChange').hide();
            $('.hideeTablesChange').hide();
            $('.hideeListsChange').hide();
        }
        if($(e.target).attr('class') != 'app-input-label input-select-label menuTypesSpan') {
            $('.menuTypesDiv').hide();
        }
        if($(e.target).attr('class') != 'icon-tools icon-tools-form-mail sendMail') {
            $('.guestsDropdown--center').hide();
        }
        if($(e.target).attr('class') != 'app-toogle-layer pointer clsSpan') {
            $('.dropdown-opened').hide();
        }
        if($(e.target).attr('class') != 'app-toogle-layer pointer relative inline-block') {
            $('.threeDotsDiv').hide();
        }
    });
    $('body').on('click','.app-event-change', function(){
        var curUrl = $(this).attr('data-href');
        window.location.href = curUrl;
    });
    $('body').on('click','.app-addguest-tab', function(){
        $('.app-addguest-tab').removeClass('active');
        var tabName = $(this).attr('data-section');
        $(this).addClass('active');
        if(tabName == 'import') {
            $('.sectionNew').hide();
            $('.sectionImport').show();
        } else {
            $('.sectionImport').hide();
            $('.sectionNew').show();
        }
    });
    $('body').on('click','.app-addguest-toggle', function(){
        var gtClas = $(this).find('i').hasClass('active');
        if(gtClas) {
            $(this).find('i').removeClass('active');
        } else {
            $(this).find('i').addClass('active');
        }
        var pName = $(this).attr('data-value');
        if(pName == 'contact_div') {
            $('.contact_div').toggle();
        } else
        if(pName == 'guest_div') {
            $('.guest_div').toggle();
        }
    });
    $('body').on('click','.exportButton', function(){
        $('.app-dropdown-export').toggle();
    });
    $('body').on('mouseover','.guest_select_all_span, .select_all_childs_span', function(){
        var allChkbox = $('.guest_select_all').is(':checked');
        var childChkbox = $(this).prev().is(':checked');
        if(allChkbox) {
            $(this).css('background-position','-40px 0px');
        } else if(childChkbox) {
            $(this).css('background-position','-40px 0px');
        } else {
            $(this).css('background-position','-20px 0px');
        }
    });
    $('body').on('mouseleave','.guest_select_all_span, .select_all_childs_span', function(){
        var allChkbox = $('.guest_select_all').is(':checked');
        var childChkbox = $(this).prev().is(':checked');
        if(allChkbox) {
            $(this).css('background-position','-40px 0px');
        } else if(childChkbox) {
            $(this).css('background-position','-40px 0px');
        } else {
            $(this).css('background-position','0px 0px');
        }
    });
    $('body').on('click','.guest_select_all', function(){
        var tabs = "0";
        var idEvents = "{{$idEvent}}";
        if(idEvents) {
            var tabs = "{{$tab}}";
        }
        var chkbox = $(this).is(':checked');
        if(chkbox) {
            $('#app-guest-mark-nav').removeClass('disabled');
            $(".guest_select_all").attr("checked",true);
            $(".guest_select_all_span").css('background-position','-40px 0px');
            $(".chbxChilds"+tabs).attr("checked",true);
            $(".select_all_childs_span").css('background-position','-40px 0px');
            $('.app-guest-mark-hide-label').hide();
        } else {
            $('#app-guest-mark-nav').addClass('disabled');
            $(".guest_select_all").attr("checked",false);
            $(".guest_select_all_span").css('background-position','0px 0px');
            $(".select_all_childs").attr("checked",false);
            $(".select_all_childs_span").css('background-position','0px 0px');
            $('.app-guest-mark-hide-label').show();
        }
    });
    $('body').on('click','.select_all_childs', function(){
        var chkboxNum = 0;
        var chkbox = $(this).is(':checked');
        if(chkbox) {
            $(this).attr('checked',true);
            $(this).next().css('background-position','-40px 0px');
        } else {
            $(this).attr('checked',false);
            $(this).next().css('background-position','0px 0px');
            $('.guest_select_all_span').css('background-position','0px 0px');
        }
        $(".guest_select_all").attr("checked",false);
        $('.select_all_childs').each(function(){
            if($(this).is(':checked')) {
                chkboxNum++;
            }
        });
        if(chkboxNum > 0) {
            $('.app-guest-mark-hide-label').hide();
            $('#app-guest-mark-nav').removeClass('disabled');
        } else {
            $('.app-guest-mark-hide-label').show();
            $('#app-guest-mark-nav').addClass('disabled');
            $(".guest_select_all_span").css('background-position','0px 0px');
        }
    });
    $('body').on('mouseover','.selectAll_li', function(){
        $(this).find('.iradio_minimal').addClass('hover');
    });
    $('body').on('mouseleave','.selectAll_li', function(){
        $(this).find('.iradio_minimal').removeClass('hover');
    });
    $('#moveGroups-modal').on('hidden.bs.modal', function(){
        $('.app-guest-multi-detail').hide();
        $('#moveGroups-modal form')[0].reset();
        $('.iradio_minimal').removeClass('checked');
    });
    $('#moveAttendance-modal').on('hidden.bs.modal', function(){
        $('.app-guest-multi-detail').hide();
        $('#moveAttendance-modal form')[0].reset();
        $('.iradio_minimal').removeClass('checked');
    });
    $('#moveMenus-modal').on('hidden.bs.modal', function(){
        $('.app-guest-multi-detail').hide();
        $('#moveMenus-modal form')[0].reset();
        $('.iradio_minimal').removeClass('checked');
    });
    $('#moveLists-modal').on('hidden.bs.modal', function(){
        $('.app-guest-multi-detail').hide();
        $('#moveLists-modal form')[0].reset();
        $('.iradio_minimal').removeClass('checked');
    });
    $('body').on('click','.groups_li', function(){
        $('.iradio_minimal').removeClass('checked');
        var groupGuestsId = '';
        var groupGuestsArr = [];
        $('.select_all_childs').each(function(){
            if($(this).is(':checked')) {
                groupGuestsArr.push($(this).val());
            }
        });
        var guestsNumbr = 0;
        var filteredArray = groupGuestsArr.filter(function(item, pos){
            var chkVal = groupGuestsArr.indexOf(item)== pos;
            if(chkVal) {
                if(groupGuestsId == '') {
                    groupGuestsId = item;
                    guestsNumbr++;
                } else {
                    groupGuestsId += '--'+item;
                    guestsNumbr++;
                }
            }
        });
        $('#groupGuestsId').val(groupGuestsId);
        if(guestsNumbr > 0) {
            $('.modal-guest-num').html(guestsNumbr);
            var groupNaam = $(this).attr('data-groupname');
            $('.modal-change-name').html(groupNaam);
            $('.app-guest-multi-detail').show();
        } else {
            $('.app-guest-multi-detail').hide();
        }
        var groupId = $(this).attr('data-value');
        $('#groupId').val(groupId);
        $(this).find('.iradio_minimal').addClass('checked');
    });
    $('body').on('click','.attendance_li', function(){
        $('.iradio_minimal').removeClass('checked');
        var attendanceGuestsId = '';
        var attendanceGuestsArr = [];
        $('.select_all_childs').each(function(){
            if($(this).is(':checked')) {
                attendanceGuestsArr.push($(this).val());
            }
        });
        var guestsNumbr = 0;
        var filteredArray = attendanceGuestsArr.filter(function(item, pos){
            var chkVal = attendanceGuestsArr.indexOf(item)== pos;
            if(chkVal) {
                if(attendanceGuestsId == '') {
                    attendanceGuestsId = item;
                    guestsNumbr++;
                } else {
                    attendanceGuestsId += '--'+item;
                    guestsNumbr++;
                }
            }
        });
        $('#attendanceGuestsId').val(attendanceGuestsId);
        var attendanceId = $(this).attr('data-value');
        $('#attendanceId').val(attendanceId);
        if(guestsNumbr > 0) {
            $('.modal-guest-num').html(guestsNumbr);
            $('.modal-change-name').html(attendanceId);
            $('.app-guest-multi-detail').show();
        } else {
            $('.app-guest-multi-detail').hide();
        }
        $(this).find('.iradio_minimal').addClass('checked');
    });
    $('body').on('click','.menus_li', function(){
        $('.iradio_minimal').removeClass('checked');
        var menusGuestsId = '';
        var menusGuestsArr = [];
        $('.select_all_childs').each(function(){
            if($(this).is(':checked')) {
                menusGuestsArr.push($(this).val());
            }
        });
        var guestsNumbr = 0;
        var filteredArray = menusGuestsArr.filter(function(item, pos){
            var chkVal = menusGuestsArr.indexOf(item)== pos;
            if(chkVal) {
                if(menusGuestsId == '') {
                    menusGuestsId = item;
                    guestsNumbr++;
                } else {
                    menusGuestsId += '--'+item;
                    guestsNumbr++;
                }
            }
        });
        $('#menusGuestsId').val(menusGuestsId);
        var menusId = $(this).attr('data-value');
        $('#menusId').val(menusId);
        if(guestsNumbr > 0) {
            $('.modal-guest-num').html(guestsNumbr);
            $('.modal-change-name').html(menusId);
            $('.app-guest-multi-detail').show();
        } else {
            $('.app-guest-multi-detail').hide();
        }
        $(this).find('.iradio_minimal').addClass('checked');
    });
    $('body').on('click','.lists_li', function(){
        $('.iradio_minimal').removeClass('checked');
        var listsGuestsId = '';
        var listsGuestsArr = [];
        $('.select_all_childs').each(function(){
            if($(this).is(':checked')) {
                listsGuestsArr.push($(this).val());
            }
        });
        var guestsNumbr = 0;
        var filteredArray = listsGuestsArr.filter(function(item, pos){
            var chkVal = listsGuestsArr.indexOf(item)== pos;
            if(chkVal) {
                if(listsGuestsId == '') {
                    listsGuestsId = item;
                    guestsNumbr++;
                } else {
                    listsGuestsId += '--'+item;
                    guestsNumbr++;
                }
            }
        });
        $('#listsGuestsId').val(listsGuestsId);
        var listsId = $(this).attr('data-value');
        $('#listsId').val(listsId);
        if(guestsNumbr > 0) {
            $('.modal-guest-num').html(guestsNumbr);
            $('.modal-change-name').html(listsId);
            $('.app-guest-multi-detail').show();
        } else {
            $('.app-guest-multi-detail').hide();
        }
        $(this).find('.iradio_minimal').addClass('checked');
    });

    $(".app-input-search-guests").keyup(function() {
        var filter = $(this).val();
        if(filter.length > 0) {
            $('.app-input-search-guests-reset').show();
        } else {
            $('.app-input-search-guests-reset').hide();
        }
        $("tr.searchDataFilter").each(function() {
            if($(this).text().search(new RegExp(filter, "i")) < 0) {
                $(this).fadeOut();
            } else {
                $(this).show();
            }
        });
    });
    $('body').on('click','.app-input-search-guests-reset', function(){
        $('tr.searchDataFilter').show();
        $('.app-input-search-guests').val('');
        $('.app-input-search-guests-reset').hide();
    });
});
function take_viewGrid(viewGrid) {
    if(viewGrid) {
        $('.app-tools-guest-change-view').removeClass('active');
        var tab = $('#tab').val();
        var idEvent = $('#idEvent').val();
        if(idEvent == '') {
            idEvent = "{{@$data['guests_event'][0]->id}}";
        }
        var idGuest = $('#idGuest').val();
        if(idGuest == '') {
            idGuest = "{{$idGuest}}";
            $('#idGuest').val(idGuest);
        }
        var newUrl = "{{ url('tools/guests')}}?idEvent="+idEvent+"&tab="+tab+"&viewGrid="+viewGrid+"&idGuest="+idGuest;
        window.location.href = newUrl;
    }
}
function take_tab(vals) {
    if(vals) {
        $('.app-tools-guest-change-tab').removeClass('active');
        $('#tab').val(vals);
        mainFunction();
    }
}
function reloadUrl(idGuest) {
    if(idGuest) {
        $('.app-tools-guest-change-view').removeClass('active');
        var tab = $('#tab').val();
        var idEvent = $('#idEvent').val();
        if(idEvent == '') {
            idEvent = "{{@$data['guests_event'][0]->id}}";
        }
        var newUrl = "{{ url('tools/guests')}}?idEvent="+idEvent+"&tab="+tab+"&viewGrid=2&idGuest="+idGuest;
        window.location.href = newUrl;
    }
}
function mainFunction() {
    var tab = $('#tab').val();
    var idEvent = $('#idEvent').val();
    if(idEvent == '') {
        idEvent = "{{@$data['guests_event'][0]->id}}";
        $('#idEvent').val(idEvent);
    }
    var idGuest = $('#idGuest').val();
    if(idGuest == '') {
        idGuest = "{{$idGuest}}";
        $('#idGuest').val(idGuest);
    }
    var viewGrid = $('#viewGrid').val();
    var newURL = "{{ url('tools/guests')}}?idEvent="+idEvent+"&tab="+tab+"&viewGrid="+viewGrid+"&idGuest="+idGuest;
    $.ajax({
        url: newURL,
        type: "GET",
        data: '',
        success: function(response) {
            window.history.pushState({"html":'',"pageTitle":''},"", newURL);
            $('.tab'+tab).addClass('active');
            $('.viewGrid'+viewGrid).addClass('active');
            if(viewGrid == 2) {
                $('.imageView').show();
                $('.listView').hide();
            } else {
                $('.listView').show();
                $('.imageView').hide();
            }
            $('.defTabDivCls').hide();
            $('.tabDiv'+tab).show();
            if(tab == 1) {
                $('.add_groups').show();
                $('.add_menus').hide();
                $('.add_tables').hide();
                $('.add_lists').hide();
            } else if(tab == 2) {
                $('.add_menus').show();
                $('.add_groups').hide();
                $('.add_tables').hide();
                $('.add_lists').hide();
            } else if(tab == 3) {
                $('.add_tables').show();
                $('.add_groups').hide();
                $('.add_menus').hide();
                $('.add_lists').hide();
            } else if(tab == 4) {
                $('.add_groups').hide();
                $('.add_menus').hide();
                $('.add_tables').hide();
                $('.add_lists').hide();
            } else if(tab == 5) {
                $('.add_lists').show();
                $('.add_groups').hide();
                $('.add_menus').hide();
                $('.add_tables').hide();
            }
        }
    });
}
var counter = 0;
function modalAddGuest_add() {
    counter++;
    var elem = document.createElement('div');
    elem.setAttribute("id","addGuestRemove"+counter);
    elem.innerHTML += "<div class='modalAddGuestCompanion app-addGuest-suggest-item-contact'><div class='modalAddGuestCompanion__icon'><i class='svgIcon svgIcon__avatarGuestAdult '><svg viewBox='0 0 179 179'><path d='M37.226 154.617C51.535 166.117 69.714 173 89.5 173c19.44 0 37.328-6.643 51.518-17.783C132.608 134.17 112.144 120 89 120c-22.92 0-43.215 13.897-51.774 34.617zm-4.754-4.124c7.464-16.539 21.784-28.892 38.969-33.963C54.747 109.63 43 93.187 43 74c0-25.405 20.595-46 46-46s46 20.595 46 46c0 19.187-11.747 35.63-28.44 42.53 17.412 5.138 31.882 17.753 39.259 34.618C162.523 135.88 173 113.914 173 89.5 173 43.384 135.616 6 89.5 6S6 43.384 6 89.5c0 24.067 10.182 45.755 26.472 60.993zM89.5 179C40.07 179 0 138.93 0 89.5S40.07 0 89.5 0 179 40.07 179 89.5 138.93 179 89.5 179zm-.5-65c22.091 0 40-17.909 40-40s-17.909-40-40-40-40 17.909-40 40 17.909 40 40 40z' fill-rule='nonzero'></path></svg></i></div><div class='modalAddGuestCompanion__name input-group-line input-group-line--noMargin '><span class='input-group-line-label'>Name</span><input type='text' placeholder='First name' class='app-addGuest-suggest-item-name' name='firstnames[]' size='25' maxlength='20' onclick='hidefirstnameErr("+counter+");'><span class='firstnameErr"+counter+" dnone' style='color:#f5234d;'>The name must contain a minimum of two characters</span></div><div class='modalAddGuestCompanion__surname input-group-line input-group-line--noMargin app-'><input type='text' placeholder='Last Name' class='app-addGuest-suggest-item-surname' name='lastnames[]' size='25' maxlength='40'/></div><div class='modalAddGuestCompanion__remove'><i class='svgIcon svgIcon__trash app-guest-remove-companion' onclick='modalAddGuest_remove("+counter+")'><svg viewBox='0 0 32 32'><path d='M5.5 4.5h4v-3a1 1 0 0 1 1-1h11a1 1 0 0 1 1 1v3h8a1 1 0 0 1 0 2h-3v24a1 1 0 0 1-1 1h-21a1 1 0 0 1-1-1v-24h-3a1 1 0 1 1 0-2h4zm1 2v23h19v-23h-19zm14-2v-2h-9v2h9zM9.5 11a1 1 0 0 1 2 0v14a1 1 0 0 1-2 0V11zm5.5 0a1 1 0 0 1 2 0v14a1 1 0 0 1-2 0V11zm5.5 0a1 1 0 0 1 2 0v14a1 1 0 0 1-2 0V11z' fill-rule='nonzero'></path></svg></i></div></div>";
    $(".app-guest-new-companion-container").append(elem);
}
function modalAddGuest_remove(id) {
    $('#addGuestRemove'+id).remove();
}
function change_svgIcon(vals) {
    if(vals == 'Child') {
        $(".svgIcon__avatarGuestChild").show();
        $(".firstAdultIcon").hide();
        $(".svgIcon__avatarGuestBaby").hide();
    } else
    if(vals == 'Baby') {
        $(".svgIcon__avatarGuestBaby").show();
        $(".firstAdultIcon").hide();
        $(".svgIcon__avatarGuestChild").hide();
    } else {
        $(".firstAdultIcon").show();
        $(".svgIcon__avatarGuestChild").hide();
        $(".svgIcon__avatarGuestBaby").hide();
    }
}
function hidefirstnameErr(id) {
    $('.firstnameErr'+id).hide();
}
function guests_layer_submit(vals) {
    var defNum = 0;
    var firstname = $('input[name=firstname]').val();
    if(firstname == '') {
        $('.firstnameErr0').show();
        defNum++;
    } else {
        $("input[name='firstnames[]']").each(function(index) {
            var newNum = Number(index) + 1;
            if($(this).val() == '') {
                defNum++;
                $('.firstnameErr'+newNum).show();
                return false;
            }
        });
    }
    if(Number(defNum) === 0) {
        $.ajax({
            url: "{{url('tools/add_guest')}}",
            type: "POST",
            data: $('#newGuestsForm').serialize(),
            success: function(response) {
                if(response == 'inserted' && vals == 'save') {
                    $("#newGuestsForm")[0].reset();
                    $('.app-guest-add').removeClass('dnone');
                    for(var nm = 1; nm <= counter; nm++) {
                        $('#addGuestRemove'+nm).remove();
                    }
                    $("#newGuests-modal").scrollTop(0);
                    setTimeout(function() { $('.app-guest-add').addClass('dnone'); },5000);
                } else {
                    $("#newGuestsForm")[0].reset();
                    location.reload();
                }
            }
        });
    }
}
function groupNameErr() {
    $('.alert-error').hide();
    $('.groupNameErr').hide();
}
function add_groups() {
    $('.alert-error').hide();
    $('.groupNameErr').hide();
    $('input[name=idGroup]').val('');
    $('input[name=group_name]').val('');
    $('.modal-headerTools-title').html('Add Group of Guests');
    $('#newGroup-modal').modal('show');
}
function submit_group_name() {
    var group_name = $('input[name=group_name]').val();
    if(group_name == '') {
        $('.groupNameErr').show();
    } else {
        $.ajax({
            url: "{{url('tools/add_group')}}",
            type: "POST",
            data: $('#newGroupForm').serialize(),
            success: function(response) {
                if(response == 'inserted') {
                    $("#newGroupForm")[0].reset();
                    location.reload();
                } else {
                    $("#newGroupForm")[0].reset();
                    $('.alert-error').show();
                }
            }
        });
    }
}
function add_menus() {
    $('.alert-error').hide();
    $('#menu_nameErr').hide();
    $('.inviteTblId').hide();
    $('.eventTblId').hide();
    $('.eventTblIdnew').show();
    $('input[name=eventTblId]').val('{{$idEvent}}');
    $('input[name=menu_name]').val('');
    $('.modal-headerTools-title').html('Add new Menu');
    $('#newMenus-modal').modal('show');
}
function submit_newMenu() {
    var menu_name = $('input[name=menu_name]').val();
    if(menu_name == '') {
        $('#menu_nameErr').show();
    } else {
        $.ajax({
            url: "{{url('tools/add_menus')}}",
            type: "POST",
            data: $('#newMenusForm').serialize(),
            success: function(response) {
                if(response == 'inserted') {
                    $("#newMenusForm")[0].reset();
                    location.reload();
                } else {
                    $("#newMenusForm")[0].reset();
                    $('.alert-error').show();
                }
            }
        });
    }
}
function add_lists() {
    $('.alert-error').hide();
    $('#list_nameErr').hide();
    $('.inviteTblIdList').hide();
    $('.eventTblIdList').hide();
    $('.eventTblIdListnew').show();
    $('input[name=eventTblIdList]').val('{{$idEvent}}');
    $('input[name=list_name]').val('');
    $('.modal-headerTools-title').html('Add a new List');
    $('#newLists-modal').modal('show');
}
function submit_newList() {
    var list_name = $('input[name=list_name]').val();
    if(list_name == '') {
        $('#list_nameErr').show();
    } else {
        $.ajax({
            url: "{{url('tools/add_lists')}}",
            type: "POST",
            data: $('#newListsForm').serialize(),
            success: function(response) {
                if(response == 'inserted') {
                    $("#newListsForm")[0].reset();
                    location.reload();
                } else {
                    $("#newListsForm")[0].reset();
                    $('.alert-error').show();
                }
            }
        });
    }
}
function show_edit_dropdown(idx) {
    if(idx) {
        $('.dropdown-opened').hide();
        $('.enable_dropdown'+idx).toggle();
    }
}
function edit_groups(idx,vals) {
    if(idx != '' && vals != '') {
        $('.alert-error').hide();
        $('.groupNameErr').hide();
        $('input[name=idGroup]').val(idx);
        $('input[name=group_name]').val(vals);
        $('.modal-headerTools-title').html('Edit Group of Guests');
        $('#newGroup-modal').modal('show');
    } else {
        $('#newGroup-modal').modal('hide');
    }
}
function remove_groups(idx) {
    var cnfrm = confirm('Are you sure you want to remove this group of guests?');
    if(idx != '' && cnfrm == true) {
        $.ajax({
            url: "{{url('tools/remove_group')}}/"+idx,
            type: "GET",
            data: '',
            success: function(response) {
                if(response == 'deleted') {
                    location.reload();
                }
            }
        });
    }
}
function sendMails(idx) {
    if(idx) {
        $('.guestsDropdown--center').hide();
        $('#sendMailView'+idx).toggle();
    }
}
function removeGuest_modal(idx) {
    if(idx) {
        $('input[name=idGuestModal]').val(idx);
        $('input[name=selectedGuestsId]').val('');
        $('#removeGuest-modal').modal('show');
    } else {
        $('#removeGuest-modal').modal('hide');
    }
}
function threeDotsTab(idx) {
    if(idx) {
        $('.threeDotsDiv').hide();
        $('#threeDotsDiv'+idx).toggle();
    }
}
function gthreeDotsTab(idx) {
    if(idx) {
        $('.threeDotsDiv').hide();
        $('#gthreeDotsDiv'+idx).toggle();
    }
}
function mthreeDotsTab(idx) {
    if(idx) {
        $('.threeDotsDiv').hide();
        $('#mthreeDotsDiv'+idx).toggle();
    }
}
function sthreeDotsTab(idx) {
    if(idx) {
        $('.threeDotsDiv').hide();
        $('#sthreeDotsDiv'+idx).toggle();
    }
}
function athreeDotsTab(idx) {
    if(idx) {
        $('.threeDotsDiv').hide();
        $('#athreeDotsDiv'+idx).toggle();
    }
}
function lthreeDotsTab(idx) {
    if(idx) {
        $('.threeDotsDiv').hide();
        $('#lthreeDotsDiv'+idx).toggle();
    }
}
////// For Attendance status of Invitation table......
function get_status(idx) {
    if(idx) {
        $('.hideStatusChange').hide();
        $('.hideMenusChange').hide();
        $('.hideTablesChange').hide();
        $('.hideListsChange').hide();
        $('.statusChange'+idx).show();
    } else {
        $('.statusChange'+idx).hide();
    }
}
function change_invitation_status(idx,num) {
    var chkSts = true;
    var cStats = '';
    if(num == 0) {
        cStats = 'pending';
    } else if(num == 1) {
        cStats = 'confirmed';
    } else if(num == 2) {
        cStats = 'cancelled';
        var chkSts = confirm("If you change their RSVP to Cancelled, you'll lose the table information. Are you sure?");
    }
    if(idx && chkSts && cStats) {
        $.ajax({
            url: "{{url('tools/change_invitation_status')}}/"+idx+'/'+cStats,
            type: "GET",
            data: '',
            success: function(response) {
                if(response != '') {
                    var viewGrid = "{{$viewGrid}}";
                    if(viewGrid == 2) {
                        $('.estatusChange'+idx).hide();
                        $('#estatusHtml'+idx).html(response);
                    }
                    var tabs = '{{$tab}}';
                    if(cStats == 'cancelled') {
                        $('.menuSpan'+idx).show();
                        $('.tableSpan'+idx).show();
                        $('.listSpan'+idx).show();
                        if(tabs == 1) {
                            $('#gmenusHtml'+idx).hide();
                            $('#gtablesHtml'+idx).hide();
                            $('#glistsHtml'+idx).hide();
                        } else if(tabs == 2) {
                            $('#mmenusHtml'+idx).hide();
                            $('#mtablesHtml'+idx).hide();
                            $('#mlistsHtml'+idx).hide();
                        } else if(tabs == 3) {
                            $('#smenusHtml'+idx).hide();
                            $('#stablesHtml'+idx).hide();
                            $('#slistsHtml'+idx).hide();
                        } else if(tabs == 4) {
                            $('#amenusHtml'+idx).hide();
                            $('#atablesHtml'+idx).hide();
                            $('#alistsHtml'+idx).hide();
                        } else if(tabs == 5) {
                            $('#lmenusHtml'+idx).hide();
                            $('#ltablesHtml'+idx).hide();
                            $('#llistsHtml'+idx).hide();
                        }
                        $('#etablesHtml'+idx).hide();
                        $('#emenusHtml'+idx).hide();
                        $('#elistsHtml'+idx).hide();
                    } else {
                        $('.menuSpan'+idx).hide();
                        $('.tableSpan'+idx).hide();
                        $('.listSpan'+idx).hide();
                        if(tabs == 1) {
                            $('#gmenusHtml'+idx).show();
                            $('#gtablesHtml'+idx).show();
                            $('#glistsHtml'+idx).show();
                        } else if(tabs == 2) {
                            $('#mmenusHtml'+idx).show();
                            $('#mtablesHtml'+idx).show();
                            $('#mlistsHtml'+idx).show();
                        } else if(tabs == 3) {
                            $('#smenusHtml'+idx).show();
                            $('#stablesHtml'+idx).show();
                            $('#slistsHtml'+idx).show();
                        } else if(tabs == 4) {
                            $('#amenusHtml'+idx).show();
                            $('#atablesHtml'+idx).show();
                            $('#alistsHtml'+idx).show();
                        } else if(tabs == 5) {
                            $('#lmenusHtml'+idx).show();
                            $('#ltablesHtml'+idx).show();
                            $('#llistsHtml'+idx).show();
                        }
                        $('#etablesHtml'+idx).show();
                        $('#emenusHtml'+idx).show();
                        $('#elistsHtml'+idx).show();
                    }
                    if(tabs == 1) {
                        $('#statusHtml'+idx).html(response);
                        $('#gstatusHtml'+idx).html(response);
                    } else if(tabs == 2) {
                        $('#mstatusHtml'+idx).html(response);
                    } else if(tabs == 3) {
                        $('#sstatusHtml'+idx).html(response);
                    } else if(tabs == 4) {
                        $('#astatusHtml'+idx).html(response);
                    } else if(tabs == 5) {
                        $('#lstatusHtml'+idx).html(response);
                    }
                }
            }
        });
    }
}
////// For Menus of Invitation table......
function get_menus(idx) {
    if(idx) {
        $('.hideStatusChange').hide();
        $('.hideMenusChange').hide();
        $('.hideTablesChange').hide();
        $('.hideListsChange').hide();
        $('.menusChange'+idx).show();
    } else {
        $('.menusChange'+idx).hide();
    }
}
function change_invitation_menus(idx,menus) {
    if(idx && menus) {
        $.ajax({
            url: "{{url('tools/change_invitation_menus')}}/"+idx+'/'+menus,
            type: "GET",
            data: '',
            success: function(response) {
                if(response != '') {
                    var tabs = '{{$tab}}';
                    if(tabs == 1) {
                        $('#gmenusHtml'+idx).html(response);
                    } else if(tabs == 2) {
                        $('#mmenusHtml'+idx).html(response);
                    } else if(tabs == 3) {
                        $('#smenusHtml'+idx).html(response);
                    } else if(tabs == 4) {
                        $('#amenusHtml'+idx).html(response);
                    } else if(tabs == 5) {
                        $('#amenusHtml'+idx).html(response);
                    }
                    var viewGrid = "{{$viewGrid}}";
                    if(viewGrid == 2) {
                        $('.emenusChange'+idx).hide();
                        $('#emenusHtml'+idx).html(response);
                    }
                }
            }
        });
    }
}
function get_newMenusModal(idx) {
    if(idx != '') {
        $('#menu_nameErr').hide();
        $('.eventTblId').hide();
        $('input[name=eventTblId]').val('');
        $('input[name=menu_name]').val('');
        $('.inviteTblId').show();
        $('input[name=inviteTblId]').val(idx);
        $('.modal-headerTools-title').html('Add new Menu');
        $('#newMenus-modal').modal('show');
    } else {
        $('#newMenus-modal').modal('hide');
    }
}
function createNewMenu() {
    var idx = $('input[name=inviteTblId]').val();
    var menu_name = $('input[name=menu_name]').val();
    if(menu_name == '' || idx == '') {
        $('#menu_nameErr').show();
        return false;
    } else {
        $.ajax({
            url: "{{url('tools/createNewMenu')}}/"+idx+'/'+menu_name,
            type: "GET",
            data: '',
            success: function(response) {
                if(response == 'done') {
                    $('#newMenus-modal').modal('hide');
                    change_invitation_menus(idx,menu_name);
                }
            }
        });
    }
}
function edit_menus(idx,vals) {
    if(idx != '' && vals != '') {
        $('.menu_nameErr').hide();
        $('.inviteTblId').hide();
        $('.eventTblId').show();
        $('input[name=eventTblId]').val(idx);
        $('input[name=menu_name]').val(vals);
        $('input[name=old_menu_name]').val(vals);
        $('.modal-headerTools-title').html('Edit Menu name');
        $('#newMenus-modal').modal('show');
    } else {
        $('#newMenus-modal').modal('hide');
    }
}
function updateMenu() {
    var idx = $('input[name=eventTblId]').val();
    var menu_name = $('input[name=menu_name]').val();
    var old_menu_name = $('input[name=old_menu_name]').val();
    if(menu_name == '' || idx == '') {
        $('#menu_nameErr').show();
        return false;
    } else {
        $.ajax({
            url: "{{url('tools/updateMenu')}}/"+idx+'/'+menu_name+'/'+old_menu_name,
            type: "GET",
            data: '',
            success: function(response) {
                if(response == 'done') {
                    $('#newMenus-modal').modal('hide');
                    location.reload();
                }
            }
        });
    }
}
function remove_menus(idx,menus) {
    var cnfrm = confirm('Are you sure you want to remove this menu?');
    if(idx != '' && menus != '' && cnfrm == true) {
        $.ajax({
            url: "{{url('tools/remove_menus')}}/"+idx+'/'+menus,
            type: "GET",
            data: '',
            success: function(response) {
                if(response == 'deleted') {
                    location.reload();
                }
            }
        });
    }
}
////// For Tables of Invitation table......
function get_tables(idx) {
    if(idx) {
        $('.hideStatusChange').hide();
        $('.hideMenusChange').hide();
        $('.hideTablesChange').hide();
        $('.hideListsChange').hide();
        $('.tablesChange'+idx).show();
    } else {
        $('.tablesChange'+idx).hide();
    }
}
function change_invitation_tables(invId,chartId) {
    if(invId && chartId) {
        $.ajax({
            url: "{{url('tools/change_invitation_tables')}}/"+invId+'/'+chartId,
            type: "GET",
            data: '',
            success: function(response) {
                if(response != '') {
                    var tabs = '{{$tab}}';
                    if(tabs == 1) {
                        $('#gtablesHtml'+invId).html(response);
                    } else if(tabs == 2) {
                        $('#mtablesHtml'+invId).html(response);
                    } else if(tabs == 3) {
                        $('#stablesHtml'+invId).html(response);
                    } else if(tabs == 4) {
                        $('#atablesHtml'+invId).html(response);
                    } else if(tabs == 5) {
                        $('#atablesHtml'+invId).html(response);
                    }
                    var viewGrid = "{{$viewGrid}}";
                    if(viewGrid == 2) {
                        $('.etablesChange'+invId).hide();
                        $('#etablesHtml'+invId).html(response);
                    }
                }
            }
        });
    }
}
function edit_tables(chartId) {
    if(chartId != '') {
        $('.table_nameErr').hide();
        $('input[name=chartId]').val(chartId);
        $('#editTable-modal').modal('show');
    } else {
        $('#editTable-modal').modal('hide');
    }
}
function updateTable() {
    var chartId = $('input[name=chartId]').val();
    var table_name = $('input[name=table_name]').val();
    if(table_name == '' || chartId == '') {
        $('#table_nameErr').show();
        return false;
    } else {
        $.ajax({
            url: "{{url('tools/updateTable')}}/"+chartId+'/'+table_name,
            type: "GET",
            data: '',
            success: function(response) {
                if(response == 'done') {
                    $('#editTable-modal').modal('hide');
                    location.reload();
                }
            }
        });
    }
}
// function remove_tables(idx,menus) {
//     var cnfrm = confirm('Are you sure you want to remove this menu?');
//     if(idx != '' && menus != '' && cnfrm == true) {
//         $.ajax({
//             url: "{{url('tools/remove_menus')}}/"+idx+'/'+menus,
//             type: "GET",
//             data: '',
//             success: function(response) {
//                 if(response == 'deleted') {
//                     location.reload();
//                 }
//             }
//         });
//     }
// }
////// For Lists of Invitation table......
function get_lists(idx) {
    if(idx) {
        $('.hideStatusChange').hide();
        $('.hideMenusChange').hide();
        $('.hideTablesChange').hide();
        $('.hideListsChange').hide();
        $('.listsChange'+idx).show();
    } else {
        $('.listsChange'+idx).hide();
    }
}
function change_invitation_lists(idx,lists) {
    if(idx && lists) {
        $.ajax({
            url: "{{url('tools/change_invitation_lists')}}/"+idx+'/'+lists,
            type: "GET",
            data: '',
            success: function(response) {
                if(response != '') {
                    var tabs = '{{$tab}}';
                    if(tabs == 1) {
                        $('#glistsHtml'+idx).html(response);
                    } else if(tabs == 2) {
                        $('#mlistsHtml'+idx).html(response);
                    } else if(tabs == 3) {
                        $('#slistsHtml'+idx).html(response);
                    } else if(tabs == 4) {
                        $('#alistsHtml'+idx).html(response);
                    } else if(tabs == 5) {
                        $('#llistsHtml'+idx).html(response);
                    }
                    var viewGrid = "{{$viewGrid}}";
                    if(viewGrid == 2) {
                        $('.elistsChange'+idx).hide();
                        $('#elistsHtml'+idx).html(response);
                    }
                }
            }
        });
    }
}
function get_newListsModal(idx) {
    if(idx != '') {
        $('#list_nameErr').hide();
        $('.eventTblIdList').hide();
        $('input[name=eventTblIdList]').val('');
        $('input[name=list_name]').val('');
        $('.inviteTblIdList').show();
        $('input[name=inviteTblIdList]').val(idx);
        $('.modal-headerTools-title').html('Add a new List');
        $('#newLists-modal').modal('show');
    } else {
        $('#newLists-modal').modal('hide');
    }
}
function createNewList() {
    var idx = $('input[name=inviteTblIdList]').val();
    var list_name = $('input[name=list_name]').val();
    if(list_name == '' || idx == '') {
        $('#list_nameErr').show();
        return false;
    } else {
        $.ajax({
            url: "{{url('tools/createNewList')}}/"+idx+'/'+list_name,
            type: "GET",
            data: '',
            success: function(response) {
                if(response == 'done') {
                    $('#newLists-modal').modal('hide');
                    change_invitation_lists(idx,list_name);
                }
            }
        });
    }
}
function edit_lists(idx,vals) {
    if(idx != '' && vals != '') {
        $('.list_nameErr').hide();
        $('.inviteTblIdList').hide();
        $('.eventTblIdList').show();
        $('input[name=eventTblIdList]').val(idx);
        $('input[name=list_name]').val(vals);
        $('input[name=old_list_name]').val(vals);
        $('.modal-headerTools-title').html('Edit List name');
        $('#newLists-modal').modal('show');
    } else {
        $('#newLists-modal').modal('hide');
    }
}
function updateList() {
    var idx = $('input[name=eventTblIdList]').val();
    var list_name = $('input[name=list_name]').val();
    var old_list_name = $('input[name=old_list_name]').val();
    if(list_name == '' || idx == '') {
        $('#list_nameErr').show();
        return false;
    } else {
        $.ajax({
            url: "{{url('tools/updateList')}}/"+idx+'/'+list_name+'/'+old_list_name,
            type: "GET",
            data: '',
            success: function(response) {
                if(response == 'done') {
                    $('#newLists-modal').modal('hide');
                    location.reload();
                }
            }
        });
    }
}
function remove_lists(idx,lists) {
    var cnfrm = confirm('Do you really want to remove this list?');
    if(idx != '' && lists != '' && cnfrm == true) {
        $.ajax({
            url: "{{url('tools/remove_lists')}}/"+idx+'/'+lists,
            type: "GET",
            data: '',
            success: function(response) {
                if(response == 'deleted') {
                    location.reload();
                }
            }
        });
    }
}
////// Functions of Image view Section starts from here......
function get_groups(idx) {
    if(idx) {
        $('.hideGroupChange').hide();
        $('.groupChange'+idx).show();
    } else {
        $('.groupChange'+idx).hide();
    }
}
function get_estatus(idx) {
    if(idx) {
        $('.hideeStatusChange').hide();
        $('.hideeMenusChange').hide();
        $('.hideeTablesChange').hide();
        $('.hideeListsChange').hide();
        $('.estatusChange'+idx).show();
    } else {
        $('.estatusChange'+idx).hide();
    }
}
function get_emenus(idx) {
    if(idx) {
        $('.hideeStatusChange').hide();
        $('.hideeMenusChange').hide();
        $('.hideeTablesChange').hide();
        $('.hideeListsChange').hide();
        $('.emenusChange'+idx).show();
    } else {
        $('.emenusChange'+idx).hide();
    }
}
function get_etables(idx) {
    if(idx) {
        $('.hideeStatusChange').hide();
        $('.hideeMenusChange').hide();
        $('.hideeTablesChange').hide();
        $('.hideeListsChange').hide();
        $('.etablesChange'+idx).show();
    } else {
        $('.etablesChange'+idx).hide();
    }
}
function get_elists(idx) {
    if(idx) {
        $('.hideeStatusChange').hide();
        $('.hideeMenusChange').hide();
        $('.hideeTablesChange').hide();
        $('.hideeListsChange').hide();
        $('.elistsChange'+idx).show();
    } else {
        $('.elistsChange'+idx).hide();
    }
}
function getEventTab(evnId) {
    if(evnId) {
        $('.app-tools-guest-detail-change-event').removeClass('active');
        $('.app-contact-sections-tools').addClass('dnone');
        $('.eventDiv'+evnId).removeClass('dnone');
        $('.eventSpan'+evnId).addClass('active');
    }
}
function editGuest(vals,colName) {
    var idGuest = "{{$idGuest}}";
    if(idGuest != '' && colName != '') {
        if(colName == 'gender') {
            $('#genderVal').val(vals);
            $('.app-toogle-gender').removeClass('active');
            $('.class'+vals).addClass('active');
        } else if(colName == 'age_type') {
            $('#age_typeVal').val(vals);
            $('.app-toogle-age').removeClass('active');
            $('.class'+vals).addClass('active');
        } else if(colName == 'need_hotel') {
            $('.app-toogle-need-hotel').removeClass('active');
            $('.class'+vals).addClass('active');
        }
        if(colName == 'age_type' || colName == 'gender') {
            var gndVal = $('#genderVal').val();
            var ageVal = $('#age_typeVal').val();
            if(gndVal == 'Male' && ageVal == 'Adult') {
                $('#iconToolsId').removeClass().addClass('icon-tools icon-tools-men-medium');
            } else if(gndVal == 'Male' && ageVal == 'Child') {
                $('#iconToolsId').removeClass().addClass('icon-tools icon-tools-boy-medium');
            } else if(gndVal == 'Female' && ageVal == 'Adult') {
                $('#iconToolsId').removeClass().addClass('icon-tools icon-tools-woman-medium');
            } else if(gndVal == 'Female' && ageVal == 'Child') {
                $('#iconToolsId').removeClass().addClass('icon-tools icon-tools-girl-medium');
            } else if((gndVal == 'Male' || gndVal == 'Female') && ageVal == 'Baby') {
                $('#iconToolsId').removeClass().addClass('icon-tools icon-tools-child-medium');
            } else {
                $('#iconToolsId').removeClass().addClass('icon-tools icon-tools-adult-medium');
            }
        }
        $.ajax({
            url: "{{url('tools/edit_guest')}}",
            type: "POST",
            data: 'idGuest='+idGuest+'&vals='+vals+'&colName='+colName,
            success: function(response) {
                console.log(response);
                if(colName == 'group_id') {
                    $('#classGroups').html(response);
                }
            }
        });
    }
}
function openMenuTypes() {
    $('.menuTypesDiv').toggle();
}
function get_menuTypes(vals) {
    if(vals) {
        $('.menuTypesDiv').hide();
        $('.menuTypesSpan').html(vals);
        $('input[name=cmenu_types]').val(vals);
        $('.menuTypesSpan').css('color','#000');
    }
}
function get_Gender(vals) {
    if(vals) {
        $('.genderClass').removeClass('active');
        $('.gender'+vals).addClass('active');
        $('input[name=cgender]').val(vals);
    }
}
function get_AgeTypes(vals) {
    if(vals) {
        $('.ageClass').removeClass('active');
        $('.age'+vals).addClass('active');
        $('input[name=cage_type]').val(vals);
    }
}
function guests_companion_add_new() {
    var idGuest = "{{$idGuest}}";
    var idEvent = "{{$idEvent}}";
    var firstname = $('input[name=cfirstname]').val();
    var lastname = $('input[name=clastname]').val();
    var menu_types = $('input[name=cmenu_types]').val();
    var gender = $('input[name=cgender]').val();
    var age_type = $('input[name=cage_type]').val();
    if(firstname == '' || lastname == '' || idGuest == '') {
        if(firstname == '') {
            $('.cfirst_nameErr').show();
        } else if(lastname == '') {
            $('.clast_nameErr').show();
        }
        return false;
    } else {
        $('.cfirst_nameErr').hide();
        $('.clast_nameErr').hide();
        $.ajax({
            url: "{{url('tools/guests_companion_add_new')}}",
            type: "POST",
            data: 'idGuest='+idGuest+'&idEvent='+idEvent+'&firstname='+firstname+'&lastname='+lastname+'&menu_types='+menu_types+'&gender='+gender+'&age_type='+age_type,
            success: function(response) {
                if(response == 'done') {
                    $('#newCompanion-modal').modal('hide');
                    location.reload();
                }
            }
        });
    }
}
function unlink_companion(idx,guestType) {
    if(idx) {
        $.ajax({
            url: "{{url('tools/guests_companion_remove')}}",
            type: "POST",
            data: 'idx='+idx+'&guestType='+guestType,
            success: function(response) {
                if(response == 'deleted') {
                    $('.subCompanion'+idx).remove();
                    location.reload();
                }
            }
        });
    }
}
function moveToGroups() {
    var groupId = $("#groupId").val();
    var groupGuestsId = $("#groupGuestsId").val();
    if(groupId && groupGuestsId) {
        $('.moveGroupsErr').hide();
        return true;
    } else {
        $('.moveGroupsErr').show();
        return false;
    }
}
function moveToAttendance() {
    var idEvent = $("#idEvent").val();
    var attendanceId = $("#attendanceId").val();
    var attendanceGuestsId = $("#attendanceGuestsId").val();
    if(idEvent && attendanceId && attendanceGuestsId) {
        $('.moveAttendanceErr').hide();
        return true;
    } else {
        $('.moveAttendanceErr').show();
        return false;
    }
}
function moveToMenus() {
    var idEvent = $("#idEvent").val();
    var menusId = $("#menusId").val();
    var menusGuestsId = $("#menusGuestsId").val();
    if(idEvent && menusId && menusGuestsId) {
        $('.moveMenusErr').hide();
        return true;
    } else {
        $('.moveMenusErr').show();
        return false;
    }
}
function moveToLists() {
    var idEvent = $("#idEvent").val();
    var listsId = $("#listsId").val();
    var listsGuestsId = $("#listsGuestsId").val();
    if(idEvent && listsId && listsGuestsId) {
        $('.moveListsErr').hide();
        return true;
    } else {
        $('.moveListsErr').show();
        return false;
    }
}
function remove_selectedGuests() {
    var selectedGuestsId = '';
    $('.select_all_childs').each(function(){
        if($(this).is(':checked')) {
            if(selectedGuestsId == '') {
                selectedGuestsId = $(this).val();
            } else {
                selectedGuestsId += '--'+$(this).val();
            }
        }
    });
    if(selectedGuestsId) {
        $('input[name=idGuestModal]').val('');
        $('input[name=selectedGuestsId]').val(selectedGuestsId);
        $('#removeGuest-modal').modal('show');
    } else {
        $('#removeGuest-modal').modal('hide');
    }
}
</script>
@endsection