<form name="frmGuests" id="frmPaged" action="#" method="post">
    <div class="relative">
        <div class="guests-rows-content guests-rows-content-full">
            <ul id="app-guest-mark-nav" class="app-mark-as app-mark-multi guests-mark-nav disabled">
                <li>
                    <div class="input-group-line">
                        <label class="guests-rows-select-all">
                            <input type="checkbox" class="app-guest-select-all app-not-icheck guest_select_all">
                            <span class="guest_select_all_span"></span>
                            <span class="label-mark-all app-guest-mark-hide-label">Select all</span>
                        </label>
                    </div>
                </li>
                <li class="app-guest-multi-open guests-mark-nav-action" data-toggle="modal" data-target="#moveGroups-modal">
                    <i class="icon-tools icon-tools-mark-switch"></i>Group
                </li>
                @if($idEvent != '')
                    <li class="app-guest-multi-open guests-mark-nav-action" data-toggle="modal" data-target="#moveAttendance-modal">
                        <i class="icon-tools icon-tools-mark-confirm"></i>Attendance
                    </li>
                    @if($data['current_event']->menus == 'Yes')
                        <li class="app-guest-multi-open guests-mark-nav-action" data-toggle="modal" data-target="#moveMenus-modal">
                            <i class="icon-tools icon-tools-mark-menu"></i>Menu
                        </li>
                    @endif
                    @if($data['current_event']->lists == 'Yes')
                        <li class="app-guest-multi-open guests-mark-nav-action" data-toggle="modal" data-target="#moveLists-modal">
                            <i class="icon-tools icon-tools-mark-list"></i>Lists
                        </li>
                    @endif
                @endif
                <li class="app-guest-multi-delete guests-mark-nav-action" onclick="remove_selectedGuests();">
                    <i class="icon-tools icon-tools-mark-remove"></i>Remove
                </li>
            </ul>
            @if($idEvent == '')
                @foreach($data['guestsCat'] as $gcat)
                <table class="app-guest-row-group guests-rows-group">
                    <thead>
                        <tr class="guests-rows-head app-guests-group-title">
                            <td class="guests-rows-td guests-rows-noBorder" width="3%"></td>
                            <td class="guests-rows-td guests-rows-nameBig" width="24%">
                                {{$gcat->title}} <span class="guests-rows-count app-guests-group-items-count">{{count($gcat->groupCount)}}</span>
                            </td>
                            @foreach($data['guests_event_limit'] as $ge)
                                <td class="guests-rows-td guestsRowsTitle" width="18%">{{$ge->event_name}}</td>
                            @endforeach
                            <td class="guests-rows-td guestsRowsTitle" width="12%">Contact</td>
                            <td class="guests-rows-td guestsRowsTitle" width="6%"></td>
                            <td class="guests-rows-td guestsRowsLink" width="18%" align="right">
                                <span class="app-toogle-layer pointer clsSpan" onclick="show_edit_dropdown('{{$gcat->id}}');">Edit</span>
                                <div class="guestsDropdown guestsDropdown--right enable_dropdown{{$gcat->id}} dropdown-opened dnone">
                                    <a role="button" onclick='edit_groups("{{$gcat->id}}","{{$gcat->title}}")'>
                                        <i class="icon-tools icon-tools-excel icon-left"></i> Rename
                                    </a>
                                    @if($gcat->is_default == '1')
                                        <a role="button" class="app-contact-group-delete" onclick="remove_groups('{{$gcat->id}}');">
                                            <i class="icon-tools icon-tools-trash icon-left"></i> Remove
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    </thead>
                    <tbody>
                        @php $groomNum = $brideNum = $pndngMailNum = $totlMailNum = 0; @endphp
                        @if(count($gcat->groupCount) > 0)
                            @foreach($gcat->groupCount as $glst)
                            <tr class="app-contact-row guests-rows-item searchDataFilter">
                                <td class="guests-rows-td guests-rows-noBorder" width="3%">
                                    <div class="guests-rows-td-checkbox input-group-line inline">
                                        <label class="app-guest-check-label">
                                            <input type="checkbox" class="app-guest-check app-not-icheck select_all_childs chbxChilds0" value="{{$glst->id}}">
                                            <span class="select_all_childs_span"></span>
                                        </label>
                                    </div>
                                </td>
                                <td class="guests-rows-td guests-rows-name pointer app-contact-change-view-contact" onclick="reloadUrl('{{$glst->id}}');">
                                    @if($glst->age_type == 'Adult' && $glst->gender == 'Male')
                                        @if($gcat->id == 1 && $groomNum == 0)
                                            @php $groomNum++; @endphp
                                            <span class="icon-tools icon-tools-groom"></span>
                                        @else
                                            <span class="icon-tools icon-tools-men"></span>
                                        @endif
                                    @elseif($glst->age_type == 'Child' && $glst->gender == 'Male')
                                        <span class="icon-tools icon-tools-boy"></span>
                                    @elseif($glst->age_type == 'Adult' && $glst->gender == 'Female')
                                        @if($gcat->id == 1 && $brideNum == 0)
                                            @php $brideNum++; @endphp
                                            <span class="icon-tools icon-tools-bride"></span>
                                        @else
                                            <span class="icon-tools icon-tools-woman"></span>
                                        @endif
                                    @elseif($glst->age_type == 'Child' && $glst->gender == 'Female')
                                        <span class="icon-tools icon-tools-girl"></span>
                                    @elseif($glst->age_type == 'Baby' && $glst->gender != '')
                                        <span class="icon-tools icon-tools-child"></span>
                                    @elseif($glst->age_type == NULL && $glst->gender == NULL)
                                        <span class="icon-tools icon-tools-adult"></span>
                                    @endif
                                    @if($glst->related_id != '')
                                        @foreach($gcat->groupCount as $rlid)
                                            @if($rlid->id == $glst->related_id && $rlid->group_id == $glst->group_id)
                                                <i class="guests-row-child icon-tools icon-tools-guest-lock"></i>
                                            @endif
                                        @endforeach
                                    @endif
                                    <span class="app-contact-grid-name pointer pl5">{{ucfirst($glst->firstname).' '.$glst->lastname}}</span>
                                </td>
                                @foreach($data['guests_event_limit'] as $ge)
                                    @php $statusNum = 0; @endphp
                                    @foreach($ge->guestsInvitationCount as $evt)
                                        @if($glst->id == $evt->guest_id && $evt->invited_for == $ge->id)
                                        @php $statusNum++; if($evt->attendances == 'pending'){ $pndngMailNum++; } else { $totlMailNum++; } @endphp
                                        <td class="guests-rows-td">
                                            <div class="app-input-select input-select app-guest-update select-attendance guests-rows-select" id="statusHtml{{$evt->id}}">
                                                <span class="app-input-label input-select-label input-filled" onclick="get_status('{{$evt->id}}');">
                                                    @if($evt->attendances == 'confirmed')
                                                        <i class="icon-tools icon-tools-checkbox mr10"></i>Confirmed
                                                    @elseif($evt->attendances == 'pending')
                                                        <i class="icon-tools icon-tools-clock-orange mr10"></i>Pending
                                                    @elseif($evt->attendances == 'cancelled')
                                                        <i class="icon-tools icon-tools-times-red mr10"></i>Cancelled
                                                    @endif
                                                </span>
                                                <div class="app-input-dropdown input-select-dropdown hideStatusChange statusChange{{$evt->id}}">
                                                    <ul>
                                                        <li class="subtitle app-input-select-label ">
                                                            @if($evt->attendances == 'confirmed')
                                                                <i class="icon-tools icon-tools-checkbox mr10"></i>Confirmed
                                                            @elseif($evt->attendances == 'pending')
                                                                <i class="icon-tools icon-tools-clock-orange mr10"></i>Pending
                                                            @elseif($evt->attendances == 'cancelled')
                                                                <i class="icon-tools icon-tools-times-red mr10"></i>Cancelled
                                                            @endif
                                                        </li>
                                                        <li @if($evt->attendances == 'pending') style="display:none;" @else onclick="change_invitation_status('{{$evt->id}}','0');" @endif>
                                                            <i class="icon-tools icon-tools-clock-orange mr10"></i>Pending
                                                        </li>
                                                        <li @if($evt->attendances == 'confirmed') style="display:none;" @else onclick="change_invitation_status('{{$evt->id}}','1');" @endif>
                                                            <i class="icon-tools icon-tools-checkbox mr10"></i>Confirmed
                                                        </li>
                                                        <li @if($evt->attendances == 'cancelled') style="display:none;" @else onclick="change_invitation_status('{{$evt->id}}','2');" @endif>
                                                            <i class="icon-tools icon-tools-times-red mr10"></i>Cancelled
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                        @endif
                                    @endforeach
                                    @if($statusNum == 0)
                                        <td class="guests-rows-td"><span class="guestsRowsMore guestsRowsMore--big">·</span></td>
                                    @endif
                                @endforeach
                                <td class="guests-rows-td">
                                    @if($glst->phone_no)
                                        <i class="app-contact-change-view-contact pointer icon-tools icon-tools-form-phone mr10"></i>
                                    @else
                                        <i class="app-contact-change-view-contact pointer icon-tools icon-tools-form-phone-grey mr10"></i>
                                    @endif
                                    @if($glst->address && $glst->postal_code && $glst->city_town)
                                        <i class="app-contact-change-view-contact pointer icon-tools icon-tools-form-postal mr10"></i>
                                    @else
                                        <i class="app-contact-change-view-contact pointer icon-tools icon-tools-form-postal-grey mr10"></i>
                                    @endif
                                    @if($glst->email)
                                        <div class="guestsRowsContact__mail" onclick="sendMails('{{$glst->id}}');">
                                            <div class="app-toogle-layer pointer">
                                                <i class="icon-tools icon-tools-form-mail sendMail"></i>
                                                @if($totlMailNum > 0 || $pndngMailNum > 0)
                                                    <div class="guestsDropdown guestsDropdown--center dnone" id="sendMailView{{$glst->id}}">
                                                        @if($pndngMailNum > 0)
                                                            <a role="button" href="{{url('tools/guests/requestRSVP').'?idGuest='.$glst->id}}">
                                                                <i class="icon icon-mail-letter-grey icon-left"></i> Request RSVP
                                                            </a>
                                                        @endif
                                                        <a role="button" href="{{url('tools/guests/requestAddress').'?idGuest='.$glst->id}}">
                                                            <i class="icon icon-mail-letter-grey icon-left"></i> Request mailing address
                                                        </a>
                                                    </div>
                                                    <i class="guestsRowsContact__arrow"></i>
                                                @endif
                                            </div>
                                        </div>
                                    @else
                                        <div class="guestsRowsContact__mail">
                                            <i class="icon-tools icon-tools-form-mail-grey"></i>
                                        </div>
                                    @endif
                                </td>
                                <td class="guests-rows-td pointer app-contact-change-view-contact"></td>
                                <td class="guests-rows-td guestsRowsMore" align="right">
                                    <div class="app-toogle-layer pointer relative inline-block" onclick="threeDotsTab('{{$glst->id}}');">···
                                        <div class="guestsDropdown guestsDropdown--right threeDotsDiv dnone" id="threeDotsDiv{{$glst->id}}">
                                            <a role="button" class="app-contact-change-view-contact" onclick="reloadUrl('{{$glst->id}}');">
                                                <i class="icon-tools icon-tools-edit icon-left"></i> Edit
                                            </a>
                                            <a role="button" onclick="removeGuest_modal('{{$glst->id}}');">
                                                <i class="icon-tools icon-tools-trash icon-left"></i> Remove
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        @else
                            <tr class="app-row-no-items">
                                <td width="3%"></td>
                                <td class="guests-rows-empty" colspan="7">
                                    <span>No guests</span>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                @endforeach
                @if(count($data['unassignGuest']) > 0)
                <table class="app-guest-row-group guests-rows-group">
                    <thead>
                        <tr class="guests-rows-head app-guests-group-title">
                            <td class="guests-rows-td guests-rows-noBorder" width="3%"></td>
                            <td class="guests-rows-td guests-rows-nameBig" width="24%">
                                Unassigned <span class="guests-rows-count app-guests-group-items-count">{{count($data['unassignGuest'])}}</span>
                            </td>
                            @foreach($data['guests_event_limit'] as $ge)
                                <td class="guests-rows-td guestsRowsTitle" width="18%">{{$ge->event_name}}</td>
                            @endforeach
                            <td class="guests-rows-td guestsRowsTitle" width="12%">Contact</td>
                            <td class="guests-rows-td guestsRowsTitle" width="6%"></td>
                            <td class="guests-rows-td guestsRowsLink" width="18%" align="right"></td>
                        </tr>
                    </thead>
                    <tbody>
                        @php $pndngMailNum = $totlMailNum = 0; @endphp
                        @foreach($data['unassignGuest'] as $glst)
                        <tr class="app-contact-row guests-rows-item searchDataFilter">
                            <td class="guests-rows-td guests-rows-noBorder" width="3%">
                                <div class="guests-rows-td-checkbox input-group-line inline">
                                    <label class="app-guest-check-label">
                                        <input type="checkbox" class="app-guest-check app-not-icheck select_all_childs chbxChilds0" value="{{$glst->id}}">
                                        <span class="select_all_childs_span"></span>
                                    </label>
                                </div>
                            </td>
                            <td class="guests-rows-td guests-rows-name pointer app-contact-change-view-contact" onclick="reloadUrl('{{$glst->id}}');">
                                @if($glst->age_type == 'Adult' && $glst->gender == 'Male')
                                    <span class="icon-tools icon-tools-men"></span>
                                @elseif($glst->age_type == 'Child' && $glst->gender == 'Male')
                                    <span class="icon-tools icon-tools-boy"></span>
                                @elseif($glst->age_type == 'Adult' && $glst->gender == 'Female')
                                    <span class="icon-tools icon-tools-woman"></span>
                                @elseif($glst->age_type == 'Child' && $glst->gender == 'Female')
                                    <span class="icon-tools icon-tools-girl"></span>
                                @elseif($glst->age_type == 'Baby' && $glst->gender != '')
                                    <span class="icon-tools icon-tools-child"></span>
                                @elseif($glst->age_type == NULL && $glst->gender == NULL)
                                    <span class="icon-tools icon-tools-adult"></span>
                                @endif
                                @if($glst->related_id != '')
                                    @foreach($data['unassignGuest'] as $rlid)
                                        @if($rlid->id == $glst->related_id && $rlid->group_id == $glst->group_id)
                                            <i class="guests-row-child icon-tools icon-tools-guest-lock"></i>
                                        @endif
                                    @endforeach
                                @endif
                                <span class="app-contact-grid-name pointer pl5">{{ucfirst($glst->firstname).' '.$glst->lastname}}</span>
                            </td>
                            @foreach($data['guests_event_limit'] as $ge)
                                @php $statusNum = 0; @endphp
                                @foreach($ge->guestsInvitationCount as $evt)
                                    @if($glst->id == $evt->guest_id && $evt->invited_for == $ge->id)
                                    @php $statusNum++; if($evt->attendances == 'pending'){ $pndngMailNum++; } else { $totlMailNum++; } @endphp
                                    <td class="guests-rows-td">
                                        <div class="app-input-select input-select app-guest-update select-attendance guests-rows-select" id="statusHtml{{$evt->id}}">
                                            <span class="app-input-label input-select-label input-filled" onclick="get_status('{{$evt->id}}');">
                                                @if($evt->attendances == 'confirmed')
                                                    <i class="icon-tools icon-tools-checkbox mr10"></i>Confirmed
                                                @elseif($evt->attendances == 'pending')
                                                    <i class="icon-tools icon-tools-clock-orange mr10"></i>Pending
                                                @elseif($evt->attendances == 'cancelled')
                                                    <i class="icon-tools icon-tools-times-red mr10"></i>Cancelled
                                                @endif
                                            </span>
                                            <div class="app-input-dropdown input-select-dropdown hideStatusChange statusChange{{$evt->id}}">
                                                <ul>
                                                    <li class="subtitle app-input-select-label ">
                                                        @if($evt->attendances == 'confirmed')
                                                            <i class="icon-tools icon-tools-checkbox mr10"></i>Confirmed
                                                        @elseif($evt->attendances == 'pending')
                                                            <i class="icon-tools icon-tools-clock-orange mr10"></i>Pending
                                                        @elseif($evt->attendances == 'cancelled')
                                                            <i class="icon-tools icon-tools-times-red mr10"></i>Cancelled
                                                        @endif
                                                    </li>
                                                    <li @if($evt->attendances == 'pending') style="display:none;" @else onclick="change_invitation_status('{{$evt->id}}','0');" @endif>
                                                        <i class="icon-tools icon-tools-clock-orange mr10"></i>Pending
                                                    </li>
                                                    <li @if($evt->attendances == 'confirmed') style="display:none;" @else onclick="change_invitation_status('{{$evt->id}}','1');" @endif>
                                                        <i class="icon-tools icon-tools-checkbox mr10"></i>Confirmed
                                                    </li>
                                                    <li @if($evt->attendances == 'cancelled') style="display:none;" @else onclick="change_invitation_status('{{$evt->id}}','2');" @endif>
                                                        <i class="icon-tools icon-tools-times-red mr10"></i>Cancelled
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                    @endif
                                @endforeach
                                @if($statusNum == 0)
                                    <td class="guests-rows-td"><span class="guestsRowsMore guestsRowsMore--big">·</span></td>
                                @endif
                            @endforeach
                            <td class="guests-rows-td">
                                @if($glst->phone_no)
                                    <i class="app-contact-change-view-contact pointer icon-tools icon-tools-form-phone mr10"></i>
                                @else
                                    <i class="app-contact-change-view-contact pointer icon-tools icon-tools-form-phone-grey mr10"></i>
                                @endif
                                @if($glst->address && $glst->postal_code && $glst->city_town)
                                    <i class="app-contact-change-view-contact pointer icon-tools icon-tools-form-postal mr10"></i>
                                @else
                                    <i class="app-contact-change-view-contact pointer icon-tools icon-tools-form-postal-grey mr10"></i>
                                @endif
                                @if($glst->email)
                                    <div class="guestsRowsContact__mail" onclick="sendMails('{{$glst->id}}');">
                                        <div class="app-toogle-layer pointer">
                                            <i class="icon-tools icon-tools-form-mail sendMail"></i>
                                            @if($totlMailNum > 0 || $pndngMailNum > 0)
                                                <div class="guestsDropdown guestsDropdown--center dnone" id="sendMailView{{$glst->id}}">
                                                    @if($pndngMailNum > 0)
                                                        <a role="button" href="{{url('tools/guests/requestRSVP').'?idGuest='.$glst->id}}">
                                                            <i class="icon icon-mail-letter-grey icon-left"></i> Request RSVP
                                                        </a>
                                                    @endif
                                                    <a role="button" href="{{url('tools/guests/requestAddress').'?idGuest='.$glst->id}}">
                                                        <i class="icon icon-mail-letter-grey icon-left"></i> Request mailing address
                                                    </a>
                                                </div>
                                                <i class="guestsRowsContact__arrow"></i>
                                            @endif
                                        </div>
                                    </div>
                                @else
                                    <div class="guestsRowsContact__mail">
                                        <i class="icon-tools icon-tools-form-mail-grey"></i>
                                    </div>
                                @endif
                            </td>
                            <td class="guests-rows-td pointer app-contact-change-view-contact"></td>
                            <td class="guests-rows-td guestsRowsMore" align="right">
                                <div class="app-toogle-layer pointer relative inline-block" onclick="threeDotsTab('{{$glst->id}}');">···
                                    <div class="guestsDropdown guestsDropdown--right threeDotsDiv dnone" id="threeDotsDiv{{$glst->id}}">
                                        <a role="button" class="app-contact-change-view-contact" onclick="reloadUrl('{{$glst->id}}');">
                                            <i class="icon-tools icon-tools-edit icon-left"></i> Edit
                                        </a>
                                        <a role="button" onclick="removeGuest_modal('{{$glst->id}}');">
                                            <i class="icon-tools icon-tools-trash icon-left"></i> Remove
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif
            @elseif($idEvent != '')
                <div class="defTabDivCls tabDiv1" @if($tab != '1') style="display:none;" @endif>
                    @foreach($data['guestsCat'] as $gcat)
                    <table class="app-guest-row-group guests-rows-group">
                        <thead>
                            <tr class="guests-rows-head app-guests-group-title">
                                <td class="guests-rows-td guests-rows-noBorder" width="3%"></td>
                                <td class="guests-rows-td guests-rows-nameBig" width="24%">
                                    {{$gcat->title}} <span class="guests-rows-count app-guests-group-items-count">{{count($gcat->guestsData)}}</span>
                                </td>
                                <td class="guests-rows-td guestsRowsTitle" width="15%">Attendance</td>
                                @if($data['current_event']->menus == 'Yes')
                                    <td class="guests-rows-td guestsRowsTitle" width="18%">Menu</td>
                                @endif
                                @if($data['current_event']->tables == 'Yes')
                                    <td class="guests-rows-td guestsRowsTitle" width="18%">Table</td>
                                @endif
                                @if($data['current_event']->lists == 'Yes')
                                    <td class="guests-rows-td guestsRowsTitle" width="18%">List</td>
                                @endif
                                <td class="guests-rows-td guestsRowsTitle" width="5%"></td>
                                <td class="guests-rows-td guestsRowsLink" width="10%" align="right">
                                    <span class="app-toogle-layer pointer clsSpan" onclick="show_edit_dropdown('{{$gcat->id}}');">...</span>
                                    <div class="guestsDropdown guestsDropdown--right enable_dropdown{{$gcat->id}} dropdown-opened dnone">
                                        <a role="button" onclick='edit_groups("{{$gcat->id}}","{{$gcat->title}}")'>
                                            <i class="icon-tools icon-tools-excel icon-left"></i> Rename
                                        </a>
                                        @if($gcat->is_default == '1')
                                            <a role="button" class="app-contact-group-delete" onclick="remove_groups('{{$gcat->id}}');">
                                                <i class="icon-tools icon-tools-trash icon-left"></i> Remove
                                            </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        </thead>
                        <tbody>
                            @php $groomNum = $brideNum = 0; @endphp
                            @if(count($gcat->guestsData) > 0)
                                @foreach($gcat->guestsData as $glst)
                                <tr class="app-contact-row guests-rows-item searchDataFilter">
                                    <td class="guests-rows-td guests-rows-noBorder" width="3%">
                                        <div class="guests-rows-td-checkbox input-group-line inline">
                                            <label class="app-guest-check-label">
                                                <input type="checkbox" class="app-guest-check app-not-icheck select_all_childs chbxChilds1" value="{{$glst->id}}">
                                                <span class="select_all_childs_span"></span>
                                            </label>
                                        </div>
                                    </td>
                                    <td class="guests-rows-td guests-rows-name pointer app-contact-change-view-contact" onclick="reloadUrl('{{$glst->id}}');">
                                        @if($glst->age_type == 'Adult' && $glst->gender == 'Male')
                                            @if($gcat->id == 1 && $groomNum == 0)
                                                @php $groomNum++; @endphp
                                                <span class="icon-tools icon-tools-groom"></span>
                                            @else
                                                <span class="icon-tools icon-tools-men"></span>
                                            @endif
                                        @elseif($glst->age_type == 'Child' && $glst->gender == 'Male')
                                            <span class="icon-tools icon-tools-boy"></span>
                                        @elseif($glst->age_type == 'Adult' && $glst->gender == 'Female')
                                            @if($gcat->id == 1 && $brideNum == 0)
                                                @php $brideNum++; @endphp
                                                <span class="icon-tools icon-tools-bride"></span>
                                            @else
                                                <span class="icon-tools icon-tools-woman"></span>
                                            @endif
                                        @elseif($glst->age_type == 'Child' && $glst->gender == 'Female')
                                            <span class="icon-tools icon-tools-girl"></span>
                                        @elseif($glst->age_type == 'Baby' && $glst->gender != '')
                                            <span class="icon-tools icon-tools-child"></span>
                                        @elseif($glst->age_type == NULL && $glst->gender == NULL)
                                            <span class="icon-tools icon-tools-adult"></span>
                                        @endif
                                        @if($glst->related_id != '')
                                            @foreach($gcat->guestsData as $rlid)
                                                @if($rlid->id == $glst->related_id && $rlid->group_id == $glst->group_id)
                                                    <i class="guests-row-child icon-tools icon-tools-guest-lock"></i>
                                                @endif
                                            @endforeach
                                        @endif
                                        <span class="app-contact-grid-name pointer pl5">{{ucfirst($glst->firstname).' '.$glst->lastname}}</span>
                                    </td>
                                    <td class="guests-rows-td">
                                        <div class="app-input-select input-select app-guest-update select-attendance guests-rows-select" id="gstatusHtml{{$glst->invId}}">
                                            <span class="app-input-label input-select-label input-filled" onclick="get_status('{{$glst->invId}}');">
                                                @if($glst->attendances == 'confirmed')
                                                    <i class="icon-tools icon-tools-checkbox mr10"></i>Confirmed
                                                @elseif($glst->attendances == 'pending')
                                                    <i class="icon-tools icon-tools-clock-orange mr10"></i>Pending
                                                @elseif($glst->attendances == 'cancelled')
                                                    <i class="icon-tools icon-tools-times-red mr10"></i>Cancelled
                                                @endif
                                            </span>
                                            <div class="app-input-dropdown input-select-dropdown hideStatusChange statusChange{{$glst->invId}}">
                                                <ul>
                                                    <li class="subtitle app-input-select-label ">
                                                        @if($glst->attendances == 'confirmed')
                                                            <i class="icon-tools icon-tools-checkbox mr10"></i>Confirmed
                                                        @elseif($glst->attendances == 'pending')
                                                            <i class="icon-tools icon-tools-clock-orange mr10"></i>Pending
                                                        @elseif($glst->attendances == 'cancelled')
                                                            <i class="icon-tools icon-tools-times-red mr10"></i>Cancelled
                                                        @endif
                                                    </li>
                                                    <li @if($glst->attendances == 'pending') style="display:none;" @else onclick="change_invitation_status('{{$glst->invId}}','0');" @endif>
                                                        <i class="icon-tools icon-tools-clock-orange mr10"></i>Pending
                                                    </li>
                                                    <li @if($glst->attendances == 'confirmed') style="display:none;" @else onclick="change_invitation_status('{{$glst->invId}}','1');" @endif>
                                                        <i class="icon-tools icon-tools-checkbox mr10"></i>Confirmed
                                                    </li>
                                                    <li @if($glst->attendances == 'cancelled') style="display:none;" @else onclick="change_invitation_status('{{$glst->invId}}','2');" @endif>
                                                        <i class="icon-tools icon-tools-times-red mr10"></i>Cancelled
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                    @if($data['current_event']->menus == 'Yes')
                                    <td class="guests-rows-td">
                                        @if($glst->attendances == 'cancelled')
                                            <span class="app-guest-canceled menuSpan{{$glst->invId}}">Cancelled</span>
                                        @else
                                            <span class="app-guest-canceled menuSpan{{$glst->invId}}" style="display:none;">Cancelled</span>
                                        @endif
                                        @php $eMenus = explode('--',$data['current_event']->menu_types); @endphp
                                        <div class="app-input-select input-select app-guest-update guests-rows-select" id="gmenusHtml{{$glst->invId}}" @if($glst->attendances == 'cancelled') style="display:none;" @endif>
                                            <span class="app-input-label input-select-label input-filled" onclick="get_menus('{{$glst->invId}}');">
                                                @if($glst->menus && in_array($glst->menus,$eMenus)){{$glst->menus}} @else Select @endif
                                            </span>
                                            <div class="app-input-dropdown input-select-dropdown hideMenusChange menusChange{{$glst->invId}}">
                                                <ul>
                                                    @if(in_array($glst->menus,$eMenus))
                                                    <li class="subtitle app-input-select-label ">{{$glst->menus}}</li>
                                                    @endif
                                                    @for($em = 0; $em < count($eMenus); $em++)
                                                        <li @if($glst->menus == $eMenus[$em]) style="display:none;" @else onclick="change_invitation_menus('{{$glst->invId}}','{{$eMenus[$em]}}');" @endif>{{$eMenus[$em]}}</li>
                                                    @endfor
                                                    <li class="guests-rows-select-add" onclick="get_newMenusModal('{{$glst->invId}}');">
                                                        <i class="icon-tools icon-tools-plus-circle-medium icon-left"></i>Create Menu
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                    @endif
                                    @if($data['current_event']->tables == 'Yes')
                                    <td class="guests-rows-td">
                                        @if($glst->attendances == 'cancelled')
                                            <span class="app-guest-canceled tableSpan{{$glst->invId}}">Cancelled</span>
                                        @else
                                            <span class="app-guest-canceled tableSpan{{$glst->invId}}" style="display:none;">Cancelled</span>
                                        @endif
                                        <div class="app-input-select input-select app-guest-update guests-rows-select" id="gtablesHtml{{$glst->invId}}" @if($glst->attendances == 'cancelled') style="display:none;" @endif>
                                            <span class="app-input-label input-select-label input-filled" onclick="get_tables('{{$glst->invId}}');">
                                                @if($glst->tables) {{$glst->title.'('.($glst->table_seat - $glst->guest_seat).')'}} @else Select @endif
                                            </span>
                                            <div class="app-input-dropdown input-select-dropdown hideTablesChange tablesChange{{$glst->invId}}">
                                                <ul>
                                                    @if($glst->tables)
                                                    <li class="subtitle app-input-select-label ">{{$glst->title.'('.($glst->table_seat - $glst->guest_seat).')'}}</li>
                                                    @endif
                                                    @foreach($data['eventTable'] as $evt)
                                                        @if(($evt->table_seat - count($evt->seatdata)) > 0)
                                                            <li @if($glst->tables == $evt->id) style="display:none;" @else onclick="change_invitation_tables('{{$glst->invId}}','{{$evt->id}}');" @endif>{{$evt->table_nm}} ({{($evt->table_seat - count($evt->seatdata))}})</li>
                                                        @endif
                                                    @endforeach
                                                    <li class="guests-rows-select-add" onclick="window.location.href='{{url('tools/seating_chart').'?idEvent='.$idEvent}}';">
                                                        <i class="icon-tools icon-tools-plus-circle-medium icon-left"></i>Add Table
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                    @endif
                                    @if($data['current_event']->lists == 'Yes')
                                    <td class="guests-rows-td">
                                        @if($glst->attendances == 'cancelled')
                                            <span class="app-guest-canceled listSpan{{$glst->invId}}">Cancelled</span>
                                        @else
                                            <span class="app-guest-canceled listSpan{{$glst->invId}}" style="display:none;">Cancelled</span>
                                        @endif
                                        @php $eLists = explode('--',$data['current_event']->list_types); @endphp
                                        <div class="app-input-select input-select app-guest-update guests-rows-select" id="glistsHtml{{$glst->invId}}" @if($glst->attendances == 'cancelled') style="display:none;" @endif>
                                            <span class="app-input-label input-select-label input-filled" onclick="get_lists('{{$glst->invId}}');">
                                                @if($glst->lists && in_array($glst->lists,$eLists)){{$glst->lists}} @else Select @endif
                                            </span>
                                            <div class="app-input-dropdown input-select-dropdown hideListsChange listsChange{{$glst->invId}}">
                                                <ul>
                                                    @if(in_array($glst->lists,$eLists))
                                                    <li class="subtitle app-input-select-label ">{{$glst->lists}}</li>
                                                    @endif
                                                    @for($em = 0; $em < count($eLists); $em++)
                                                        <li @if($glst->lists == $eLists[$em]) style="display:none;" @else onclick="change_invitation_lists('{{$glst->invId}}','{{$eLists[$em]}}');" @endif>{{$eLists[$em]}}</li>
                                                    @endfor
                                                    <li class="guests-rows-select-add" onclick="get_newListsModal('{{$glst->invId}}');">
                                                        <i class="icon-tools icon-tools-plus-circle-medium icon-left"></i>Add a List
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                    @endif
                                    <td class="guests-rows-td"></td>
                                    <td class="guests-rows-td guestsRowsMore" align="right">
                                        <div class="app-toogle-layer pointer relative inline-block" onclick="gthreeDotsTab('{{$glst->id}}');">···
                                            <div class="guestsDropdown guestsDropdown--right threeDotsDiv dnone" id="gthreeDotsDiv{{$glst->id}}">
                                                <a role="button" class="app-contact-change-view-contact" onclick="reloadUrl('{{$glst->id}}');">
                                                    <i class="icon-tools icon-tools-edit icon-left"></i> Edit
                                                </a>
                                                <a role="button" onclick="removeGuest_modal('{{$glst->id}}');">
                                                    <i class="icon-tools icon-tools-trash icon-left"></i> Remove
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            @else
                                <tr class="app-row-no-items">
                                    <td width="3%"></td>
                                    <td class="guests-rows-empty" colspan="7">
                                        <span>No guests</span>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    @endforeach
                    @if(count($data['unassignGuest']) > 0)
                    <table class="app-guest-row-group guests-rows-group">
                        <thead>
                            <tr class="guests-rows-head app-guests-group-title">
                                <td class="guests-rows-td guests-rows-noBorder" width="3%"></td>
                                <td class="guests-rows-td guests-rows-nameBig" width="24%">
                                    Unassigned <span class="guests-rows-count app-guests-group-items-count">{{count($data['unassignGuest'])}}</span>
                                </td>
                                <td class="guests-rows-td guestsRowsTitle" width="15%">Attendance</td>
                                @if($data['current_event']->menus == 'Yes')
                                    <td class="guests-rows-td guestsRowsTitle" width="18%">Menu</td>
                                @endif
                                @if($data['current_event']->tables == 'Yes')
                                    <td class="guests-rows-td guestsRowsTitle" width="18%">Table</td>
                                @endif
                                @if($data['current_event']->lists == 'Yes')
                                    <td class="guests-rows-td guestsRowsTitle" width="18%">List</td>
                                @endif
                                <td class="guests-rows-td guestsRowsTitle" width="5%"></td>
                                <td class="guests-rows-td guestsRowsLink" width="10%" align="right"></td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data['unassignGuest'] as $glst)
                            <tr class="app-contact-row guests-rows-item searchDataFilter">
                                <td class="guests-rows-td guests-rows-noBorder" width="3%">
                                    <div class="guests-rows-td-checkbox input-group-line inline">
                                        <label class="app-guest-check-label">
                                            <input type="checkbox" class="app-guest-check app-not-icheck select_all_childs chbxChilds1" value="{{$glst->id}}">
                                            <span class="select_all_childs_span"></span>
                                        </label>
                                    </div>
                                </td>
                                <td class="guests-rows-td guests-rows-name pointer app-contact-change-view-contact" onclick="reloadUrl('{{$glst->id}}');">
                                    @if($glst->age_type == 'Adult' && $glst->gender == 'Male')
                                        <span class="icon-tools icon-tools-men"></span>
                                    @elseif($glst->age_type == 'Child' && $glst->gender == 'Male')
                                        <span class="icon-tools icon-tools-boy"></span>
                                    @elseif($glst->age_type == 'Adult' && $glst->gender == 'Female')
                                        <span class="icon-tools icon-tools-woman"></span>
                                    @elseif($glst->age_type == 'Child' && $glst->gender == 'Female')
                                        <span class="icon-tools icon-tools-girl"></span>
                                    @elseif($glst->age_type == 'Baby' && $glst->gender != '')
                                        <span class="icon-tools icon-tools-child"></span>
                                    @elseif($glst->age_type == NULL && $glst->gender == NULL)
                                        <span class="icon-tools icon-tools-adult"></span>
                                    @endif
                                    @if($glst->related_id != '')
                                        @foreach($data['unassignGuest'] as $rlid)
                                            @if($rlid->id == $glst->related_id && $rlid->group_id == $glst->group_id)
                                                <i class="guests-row-child icon-tools icon-tools-guest-lock"></i>
                                            @endif
                                        @endforeach
                                    @endif
                                    <span class="app-contact-grid-name pointer pl5">{{ucfirst($glst->firstname).' '.$glst->lastname}}</span>
                                </td>
                                <td class="guests-rows-td">
                                    <div class="app-input-select input-select app-guest-update select-attendance guests-rows-select" id="gstatusHtml{{$glst->invId}}">
                                        <span class="app-input-label input-select-label input-filled" onclick="get_status('{{$glst->invId}}');">
                                            @if($glst->attendances == 'confirmed')
                                                <i class="icon-tools icon-tools-checkbox mr10"></i>Confirmed
                                            @elseif($glst->attendances == 'pending')
                                                <i class="icon-tools icon-tools-clock-orange mr10"></i>Pending
                                            @elseif($glst->attendances == 'cancelled')
                                                <i class="icon-tools icon-tools-times-red mr10"></i>Cancelled
                                            @endif
                                        </span>
                                        <div class="app-input-dropdown input-select-dropdown hideStatusChange statusChange{{$glst->invId}}">
                                            <ul>
                                                <li class="subtitle app-input-select-label ">
                                                    @if($glst->attendances == 'confirmed')
                                                        <i class="icon-tools icon-tools-checkbox mr10"></i>Confirmed
                                                    @elseif($glst->attendances == 'pending')
                                                        <i class="icon-tools icon-tools-clock-orange mr10"></i>Pending
                                                    @elseif($glst->attendances == 'cancelled')
                                                        <i class="icon-tools icon-tools-times-red mr10"></i>Cancelled
                                                    @endif
                                                </li>
                                                <li @if($glst->attendances == 'pending') style="display:none;" @else onclick="change_invitation_status('{{$glst->invId}}','0');" @endif>
                                                    <i class="icon-tools icon-tools-clock-orange mr10"></i>Pending
                                                </li>
                                                <li @if($glst->attendances == 'confirmed') style="display:none;" @else onclick="change_invitation_status('{{$glst->invId}}','1');" @endif>
                                                    <i class="icon-tools icon-tools-checkbox mr10"></i>Confirmed
                                                </li>
                                                <li @if($glst->attendances == 'cancelled') style="display:none;" @else onclick="change_invitation_status('{{$glst->invId}}','2');" @endif>
                                                    <i class="icon-tools icon-tools-times-red mr10"></i>Cancelled
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                                @if($data['current_event']->menus == 'Yes')
                                <td class="guests-rows-td">
                                    @if($glst->attendances == 'cancelled')
                                        <span class="app-guest-canceled menuSpan{{$glst->invId}}">Cancelled</span>
                                    @else
                                        <span class="app-guest-canceled menuSpan{{$glst->invId}}" style="display:none;">Cancelled</span>
                                    @endif
                                    @php $eMenus = explode('--',$data['current_event']->menu_types); @endphp
                                    <div class="app-input-select input-select app-guest-update guests-rows-select" id="gmenusHtml{{$glst->invId}}" @if($glst->attendances == 'cancelled') style="display:none;" @endif>
                                        <span class="app-input-label input-select-label input-filled" onclick="get_menus('{{$glst->invId}}');">
                                            @if($glst->menus && in_array($glst->menus,$eMenus)){{$glst->menus}} @else Select @endif
                                        </span>
                                        <div class="app-input-dropdown input-select-dropdown hideMenusChange menusChange{{$glst->invId}}">
                                            <ul>
                                                @if(in_array($glst->menus,$eMenus))
                                                <li class="subtitle app-input-select-label ">{{$glst->menus}}</li>
                                                @endif
                                                @for($em = 0; $em < count($eMenus); $em++)
                                                    <li @if($glst->menus == $eMenus[$em]) style="display:none;" @else onclick="change_invitation_menus('{{$glst->invId}}','{{$eMenus[$em]}}');" @endif>{{$eMenus[$em]}}</li>
                                                @endfor
                                                <li class="guests-rows-select-add" onclick="get_newMenusModal('{{$glst->invId}}');">
                                                    <i class="icon-tools icon-tools-plus-circle-medium icon-left"></i>Create Menu
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                                @endif
                                @if($data['current_event']->tables == 'Yes')
                                <td class="guests-rows-td">
                                    @if($glst->attendances == 'cancelled')
                                        <span class="app-guest-canceled tableSpan{{$glst->invId}}">Cancelled</span>
                                    @else
                                        <span class="app-guest-canceled tableSpan{{$glst->invId}}" style="display:none;">Cancelled</span>
                                    @endif
                                    <div class="app-input-select input-select app-guest-update guests-rows-select" id="gtablesHtml{{$glst->invId}}" @if($glst->attendances == 'cancelled') style="display:none;" @endif>
                                        <span class="app-input-label input-select-label input-filled" onclick="get_tables('{{$glst->invId}}');">
                                            @if($glst->tables) {{$glst->title.'('.($glst->table_seat - $glst->guest_seat).')'}} @else Select @endif
                                        </span>
                                        <div class="app-input-dropdown input-select-dropdown hideTablesChange tablesChange{{$glst->invId}}">
                                            <ul>
                                                @if($glst->tables)
                                                <li class="subtitle app-input-select-label ">{{$glst->title.'('.($glst->table_seat - $glst->guest_seat).')'}}</li>
                                                @endif
                                                @foreach($data['eventTable'] as $evt)
                                                    @if(($evt->table_seat - count($evt->seatdata)) > 0)
                                                        <li @if($glst->tables == $evt->id) style="display:none;" @else onclick="change_invitation_tables('{{$glst->invId}}','{{$evt->id}}');" @endif>{{$evt->table_nm}} ({{($evt->table_seat - count($evt->seatdata))}})</li>
                                                    @endif
                                                @endforeach
                                                <li class="guests-rows-select-add" onclick="window.location.href='{{url('tools/seating_chart').'?idEvent='.$idEvent}}';">
                                                    <i class="icon-tools icon-tools-plus-circle-medium icon-left"></i>Add Table
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                                @endif
                                @if($data['current_event']->lists == 'Yes')
                                <td class="guests-rows-td">
                                    @if($glst->attendances == 'cancelled')
                                        <span class="app-guest-canceled listSpan{{$glst->invId}}">Cancelled</span>
                                    @else
                                        <span class="app-guest-canceled listSpan{{$glst->invId}}" style="display:none;">Cancelled</span>
                                    @endif
                                    @php $eLists = explode('--',$data['current_event']->list_types); @endphp
                                    <div class="app-input-select input-select app-guest-update guests-rows-select" id="glistsHtml{{$glst->invId}}" @if($glst->attendances == 'cancelled') style="display:none;" @endif>
                                        <span class="app-input-label input-select-label input-filled" onclick="get_lists('{{$glst->invId}}');">
                                            @if($glst->lists && in_array($glst->lists,$eLists)){{$glst->lists}} @else Select @endif
                                        </span>
                                        <div class="app-input-dropdown input-select-dropdown hideListsChange listsChange{{$glst->invId}}">
                                            <ul>
                                                @if(in_array($glst->lists,$eLists))
                                                <li class="subtitle app-input-select-label ">{{$glst->lists}}</li>
                                                @endif
                                                @for($em = 0; $em < count($eLists); $em++)
                                                    <li @if($glst->lists == $eLists[$em]) style="display:none;" @else onclick="change_invitation_lists('{{$glst->invId}}','{{$eLists[$em]}}');" @endif>{{$eLists[$em]}}</li>
                                                @endfor
                                                <li class="guests-rows-select-add" onclick="get_newListsModal('{{$glst->invId}}');">
                                                    <i class="icon-tools icon-tools-plus-circle-medium icon-left"></i>Add a List
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                                @endif
                                <td class="guests-rows-td"></td>
                                <td class="guests-rows-td guestsRowsMore" align="right">
                                    <div class="app-toogle-layer pointer relative inline-block" onclick="gthreeDotsTab('{{$glst->id}}');">···
                                        <div class="guestsDropdown guestsDropdown--right threeDotsDiv dnone" id="gthreeDotsDiv{{$glst->id}}">
                                            <a role="button" class="app-contact-change-view-contact" onclick="reloadUrl('{{$glst->id}}');">
                                                <i class="icon-tools icon-tools-edit icon-left"></i> Edit
                                            </a>
                                            <a role="button" onclick="removeGuest_modal('{{$glst->id}}');">
                                                <i class="icon-tools icon-tools-trash icon-left"></i> Remove
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
                <div class="defTabDivCls tabDiv2" @if($tab != '2') style="display:none;" @endif>
                    @foreach($data['menusCat'] as $mcat)
                    <table class="app-guest-row-group guests-rows-group">
                        <thead>
                            <tr class="guests-rows-head app-guests-group-title">
                                <td class="guests-rows-td guests-rows-noBorder" width="3%"></td>
                                <td class="guests-rows-td guests-rows-nameBig" width="24%">
                                    {{$mcat['title']}} <span class="guests-rows-count app-guests-group-items-count">{{count($mcat['guestData'])}}</span>
                                </td>
                                <td class="guests-rows-td guestsRowsTitle" width="15%">Attendance</td>
                                @if($data['current_event']->menus == 'Yes')
                                    <td class="guests-rows-td guestsRowsTitle" width="18%">Menu</td>
                                @endif
                                @if($data['current_event']->tables == 'Yes')
                                    <td class="guests-rows-td guestsRowsTitle" width="18%">Table</td>
                                @endif
                                @if($data['current_event']->lists == 'Yes')
                                    <td class="guests-rows-td guestsRowsTitle" width="18%">List</td>
                                @endif
                                <td class="guests-rows-td guestsRowsTitle" width="5%"></td>
                                <td class="guests-rows-td guestsRowsLink" width="10%" align="right">
                                    <span class="app-toogle-layer pointer clsSpan" onclick="show_edit_dropdown('{{str_replace(' ','_',$mcat['title'])}}');">...</span>
                                    <div class="guestsDropdown guestsDropdown--right enable_dropdown{{str_replace(' ','_',$mcat['title'])}} dropdown-opened dnone">
                                        <a role="button" onclick='edit_menus("{{$idEvent}}","{{$mcat['title']}}")'>
                                            <i class="icon-tools icon-tools-excel icon-left"></i> Rename
                                        </a>
                                        <a role="button" class="app-contact-group-delete" onclick="remove_menus('{{$idEvent}}','{{$mcat['title']}}');">
                                            <i class="icon-tools icon-tools-trash icon-left"></i> Remove
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        </thead>
                        <tbody>
                            @php $groomNum = $brideNum = 0; @endphp
                            @if(count($mcat['guestData']) > 0)
                                @foreach($mcat['guestData'] as $glst)
                                <tr class="app-contact-row guests-rows-item searchDataFilter">
                                    <td class="guests-rows-td guests-rows-noBorder" width="3%">
                                        <div class="guests-rows-td-checkbox input-group-line inline">
                                            <label class="app-guest-check-label">
                                                <input type="checkbox" class="app-guest-check app-not-icheck select_all_childs chbxChilds2" value="{{$glst->id}}">
                                                <span class="select_all_childs_span"></span>
                                            </label>
                                        </div>
                                    </td>
                                    <td class="guests-rows-td guests-rows-name pointer app-contact-change-view-contact" onclick="reloadUrl('{{$glst->id}}');">
                                        @if($glst->age_type == 'Adult' && $glst->gender == 'Male')
                                            @if($glst->group_id == 1 && $groomNum == 0)
                                                @php $groomNum++; @endphp
                                                <span class="icon-tools icon-tools-groom"></span>
                                            @else
                                                <span class="icon-tools icon-tools-men"></span>
                                            @endif
                                        @elseif($glst->age_type == 'Child' && $glst->gender == 'Male')
                                            <span class="icon-tools icon-tools-boy"></span>
                                        @elseif($glst->age_type == 'Adult' && $glst->gender == 'Female')
                                            @if($glst->group_id == 1 && $brideNum == 0)
                                                @php $brideNum++; @endphp
                                                <span class="icon-tools icon-tools-bride"></span>
                                            @else
                                                <span class="icon-tools icon-tools-woman"></span>
                                            @endif
                                        @elseif($glst->age_type == 'Child' && $glst->gender == 'Female')
                                            <span class="icon-tools icon-tools-girl"></span>
                                        @elseif($glst->age_type == 'Baby' && $glst->gender != '')
                                            <span class="icon-tools icon-tools-child"></span>
                                        @elseif($glst->age_type == NULL && $glst->gender == NULL)
                                            <span class="icon-tools icon-tools-adult"></span>
                                        @endif
                                        @if($glst->related_id != '')
                                            @foreach($mcat['guestData'] as $rlid)
                                                @if($rlid->id == $glst->related_id && $rlid->menus == $glst->menus)
                                                    <i class="guests-row-child icon-tools icon-tools-guest-lock"></i>
                                                @endif
                                            @endforeach
                                        @endif
                                        <span class="app-contact-grid-name pointer pl5">{{ucfirst($glst->firstname).' '.$glst->lastname}}</span>
                                    </td>
                                    <td class="guests-rows-td">
                                        <div class="app-input-select input-select app-guest-update select-attendance guests-rows-select" id="mstatusHtml{{$glst->invId}}">
                                            <span class="app-input-label input-select-label input-filled" onclick="get_status('{{$glst->invId}}');">
                                                @if($glst->attendances == 'confirmed')
                                                    <i class="icon-tools icon-tools-checkbox mr10"></i>Confirmed
                                                @elseif($glst->attendances == 'pending')
                                                    <i class="icon-tools icon-tools-clock-orange mr10"></i>Pending
                                                @elseif($glst->attendances == 'cancelled')
                                                    <i class="icon-tools icon-tools-times-red mr10"></i>Cancelled
                                                @endif
                                            </span>
                                            <div class="app-input-dropdown input-select-dropdown hideStatusChange statusChange{{$glst->invId}}">
                                                <ul>
                                                    <li class="subtitle app-input-select-label ">
                                                        @if($glst->attendances == 'confirmed')
                                                            <i class="icon-tools icon-tools-checkbox mr10"></i>Confirmed
                                                        @elseif($glst->attendances == 'pending')
                                                            <i class="icon-tools icon-tools-clock-orange mr10"></i>Pending
                                                        @elseif($glst->attendances == 'cancelled')
                                                            <i class="icon-tools icon-tools-times-red mr10"></i>Cancelled
                                                        @endif
                                                    </li>
                                                    <li @if($glst->attendances == 'pending') style="display:none;" @else onclick="change_invitation_status('{{$glst->invId}}','0');" @endif>
                                                        <i class="icon-tools icon-tools-clock-orange mr10"></i>Pending
                                                    </li>
                                                    <li @if($glst->attendances == 'confirmed') style="display:none;" @else onclick="change_invitation_status('{{$glst->invId}}','1');" @endif>
                                                        <i class="icon-tools icon-tools-checkbox mr10"></i>Confirmed
                                                    </li>
                                                    <li @if($glst->attendances == 'cancelled') style="display:none;" @else onclick="change_invitation_status('{{$glst->invId}}','2');" @endif>
                                                        <i class="icon-tools icon-tools-times-red mr10"></i>Cancelled
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                    @if($data['current_event']->menus == 'Yes')
                                    <td class="guests-rows-td">
                                        @if($glst->attendances == 'cancelled')
                                            <span class="app-guest-canceled menuSpan{{$glst->invId}}">Cancelled</span>
                                        @else
                                            <span class="app-guest-canceled menuSpan{{$glst->invId}}" style="display:none;">Cancelled</span>
                                        @endif
                                        @php $eMenus = explode('--',$data['current_event']->menu_types); @endphp
                                        <div class="app-input-select input-select app-guest-update guests-rows-select" id="mmenusHtml{{$glst->invId}}" @if($glst->attendances == 'cancelled') style="display:none;" @endif>
                                            <span class="app-input-label input-select-label input-filled" onclick="get_menus('{{$glst->invId}}');">
                                                @if($glst->menus && in_array($glst->menus,$eMenus)){{$glst->menus}} @else Select @endif
                                            </span>
                                            <div class="app-input-dropdown input-select-dropdown hideMenusChange menusChange{{$glst->invId}}">
                                                <ul>
                                                    @if(in_array($glst->menus,$eMenus))
                                                    <li class="subtitle app-input-select-label ">{{$glst->menus}}</li>
                                                    @endif
                                                    @for($em = 0; $em < count($eMenus); $em++)
                                                        <li @if($glst->menus == $eMenus[$em]) style="display:none;" @else onclick="change_invitation_menus('{{$glst->invId}}','{{$eMenus[$em]}}');" @endif>{{$eMenus[$em]}}</li>
                                                    @endfor
                                                    <li class="guests-rows-select-add" onclick="get_newMenusModal('{{$glst->invId}}');">
                                                        <i class="icon-tools icon-tools-plus-circle-medium icon-left"></i>Create Menu
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                    @endif
                                    @if($data['current_event']->tables == 'Yes')
                                    <td class="guests-rows-td">
                                        @if($glst->attendances == 'cancelled')
                                            <span class="app-guest-canceled tableSpan{{$glst->invId}}">Cancelled</span>
                                        @else
                                            <span class="app-guest-canceled tableSpan{{$glst->invId}}" style="display:none;">Cancelled</span>
                                        @endif
                                        <div class="app-input-select input-select app-guest-update guests-rows-select" id="mtablesHtml{{$glst->invId}}" @if($glst->attendances == 'cancelled') style="display:none;" @endif>
                                            <span class="app-input-label input-select-label input-filled" onclick="get_tables('{{$glst->invId}}');">
                                                @if($glst->tables) {{$glst->title.'('.($glst->table_seat - $glst->guest_seat).')'}} @else Select @endif
                                            </span>
                                            <div class="app-input-dropdown input-select-dropdown hideTablesChange tablesChange{{$glst->invId}}">
                                                <ul>
                                                    @if($glst->tables)
                                                    <li class="subtitle app-input-select-label ">{{$glst->title.'('.($glst->table_seat - $glst->guest_seat).')'}}</li>
                                                    @endif
                                                    @foreach($data['eventTable'] as $evt)
                                                        @if(($evt->table_seat - count($evt->seatdata)) > 0)
                                                            <li @if($glst->tables == $evt->id) style="display:none;" @else onclick="change_invitation_tables('{{$glst->invId}}','{{$evt->id}}');" @endif>{{$evt->table_nm}} ({{($evt->table_seat - count($evt->seatdata))}})</li>
                                                        @endif
                                                    @endforeach
                                                    <li class="guests-rows-select-add" onclick="window.location.href='{{url('tools/seating_chart').'?idEvent='.$idEvent}}';">
                                                        <i class="icon-tools icon-tools-plus-circle-medium icon-left"></i>Add Table
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                    @endif
                                    @if($data['current_event']->lists == 'Yes')
                                    <td class="guests-rows-td">
                                        @if($glst->attendances == 'cancelled')
                                            <span class="app-guest-canceled listSpan{{$glst->invId}}">Cancelled</span>
                                        @else
                                            <span class="app-guest-canceled listSpan{{$glst->invId}}" style="display:none;">Cancelled</span>
                                        @endif
                                        @php $eLists = explode('--',$data['current_event']->list_types); @endphp
                                        <div class="app-input-select input-select app-guest-update guests-rows-select" id="mlistsHtml{{$glst->invId}}" @if($glst->attendances == 'cancelled') style="display:none;" @endif>
                                            <span class="app-input-label input-select-label input-filled" onclick="get_lists('{{$glst->invId}}');">
                                                @if($glst->lists && in_array($glst->lists,$eLists)){{$glst->lists}} @else Select @endif
                                            </span>
                                            <div class="app-input-dropdown input-select-dropdown hideListsChange listsChange{{$glst->invId}}">
                                                <ul>
                                                    @if(in_array($glst->lists,$eLists))
                                                    <li class="subtitle app-input-select-label ">{{$glst->lists}}</li>
                                                    @endif
                                                    @for($em = 0; $em < count($eLists); $em++)
                                                        <li @if($glst->lists == $eLists[$em]) style="display:none;" @else onclick="change_invitation_lists('{{$glst->invId}}','{{$eLists[$em]}}');" @endif>{{$eLists[$em]}}</li>
                                                    @endfor
                                                    <li class="guests-rows-select-add" onclick="get_newListsModal('{{$glst->invId}}');">
                                                        <i class="icon-tools icon-tools-plus-circle-medium icon-left"></i>Add a List
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                    @endif
                                    <td class="guests-rows-td"></td>
                                    <td class="guests-rows-td guestsRowsMore" align="right">
                                        <div class="app-toogle-layer pointer relative inline-block" onclick="mthreeDotsTab('{{$glst->id}}');">···
                                            <div class="guestsDropdown guestsDropdown--right threeDotsDiv dnone" id="mthreeDotsDiv{{$glst->id}}">
                                                <a role="button" class="app-contact-change-view-contact" onclick="reloadUrl('{{$glst->id}}');">
                                                    <i class="icon-tools icon-tools-edit icon-left"></i> Edit
                                                </a>
                                                <a role="button" onclick="removeGuest_modal('{{$glst->id}}');">
                                                    <i class="icon-tools icon-tools-trash icon-left"></i> Remove
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            @else
                                <tr class="app-row-no-items">
                                    <td width="3%"></td>
                                    <td class="guests-rows-empty" colspan="7">
                                        <span>No guests</span>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    @endforeach
                    @if(count($data['unassignMenu']) > 0)
                    <table class="app-guest-row-group guests-rows-group">
                        <thead>
                            <tr class="guests-rows-head app-guests-group-title">
                                <td class="guests-rows-td guests-rows-noBorder" width="3%"></td>
                                <td class="guests-rows-td guests-rows-nameBig" width="24%">
                                    Unassigned <span class="guests-rows-count app-guests-group-items-count">{{count($data['unassignMenu'])}}</span>
                                </td>
                                <td class="guests-rows-td guestsRowsTitle" width="15%">Attendance</td>
                                @if($data['current_event']->menus == 'Yes')
                                    <td class="guests-rows-td guestsRowsTitle" width="18%">Menu</td>
                                @endif
                                @if($data['current_event']->tables == 'Yes')
                                    <td class="guests-rows-td guestsRowsTitle" width="18%">Table</td>
                                @endif
                                @if($data['current_event']->lists == 'Yes')
                                    <td class="guests-rows-td guestsRowsTitle" width="18%">List</td>
                                @endif
                                <td class="guests-rows-td guestsRowsTitle" width="5%"></td>
                                <td class="guests-rows-td guestsRowsLink" width="10%" align="right"></td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data['unassignMenu'] as $glst)
                            <tr class="app-contact-row guests-rows-item searchDataFilter">
                                <td class="guests-rows-td guests-rows-noBorder" width="3%">
                                    <div class="guests-rows-td-checkbox input-group-line inline">
                                        <label class="app-guest-check-label">
                                            <input type="checkbox" class="app-guest-check app-not-icheck select_all_childs chbxChilds2" value="{{$glst->id}}">
                                            <span class="select_all_childs_span"></span>
                                        </label>
                                    </div>
                                </td>
                                <td class="guests-rows-td guests-rows-name pointer app-contact-change-view-contact" onclick="reloadUrl('{{$glst->id}}');">
                                    @if($glst->age_type == 'Adult' && $glst->gender == 'Male')
                                        <span class="icon-tools icon-tools-men"></span>
                                    @elseif($glst->age_type == 'Child' && $glst->gender == 'Male')
                                        <span class="icon-tools icon-tools-boy"></span>
                                    @elseif($glst->age_type == 'Adult' && $glst->gender == 'Female')
                                        <span class="icon-tools icon-tools-woman"></span>
                                    @elseif($glst->age_type == 'Child' && $glst->gender == 'Female')
                                        <span class="icon-tools icon-tools-girl"></span>
                                    @elseif($glst->age_type == 'Baby' && $glst->gender != '')
                                        <span class="icon-tools icon-tools-child"></span>
                                    @elseif($glst->age_type == NULL && $glst->gender == NULL)
                                        <span class="icon-tools icon-tools-adult"></span>
                                    @endif
                                    @if($glst->related_id != '')
                                        @foreach($data['unassignMenu'] as $rlid)
                                            @if($rlid->id == $glst->related_id && $rlid->menus == $glst->menus)
                                                <i class="guests-row-child icon-tools icon-tools-guest-lock"></i>
                                            @endif
                                        @endforeach
                                    @endif
                                    <span class="app-contact-grid-name pointer pl5">{{ucfirst($glst->firstname).' '.$glst->lastname}}</span>
                                </td>
                                <td class="guests-rows-td">
                                    <div class="app-input-select input-select app-guest-update select-attendance guests-rows-select" id="mstatusHtml{{$glst->invId}}">
                                        <span class="app-input-label input-select-label input-filled" onclick="get_status('{{$glst->invId}}');">
                                            @if($glst->attendances == 'confirmed')
                                                <i class="icon-tools icon-tools-checkbox mr10"></i>Confirmed
                                            @elseif($glst->attendances == 'pending')
                                                <i class="icon-tools icon-tools-clock-orange mr10"></i>Pending
                                            @elseif($glst->attendances == 'cancelled')
                                                <i class="icon-tools icon-tools-times-red mr10"></i>Cancelled
                                            @endif
                                        </span>
                                        <div class="app-input-dropdown input-select-dropdown hideStatusChange statusChange{{$glst->invId}}">
                                            <ul>
                                                <li class="subtitle app-input-select-label ">
                                                    @if($glst->attendances == 'confirmed')
                                                        <i class="icon-tools icon-tools-checkbox mr10"></i>Confirmed
                                                    @elseif($glst->attendances == 'pending')
                                                        <i class="icon-tools icon-tools-clock-orange mr10"></i>Pending
                                                    @elseif($glst->attendances == 'cancelled')
                                                        <i class="icon-tools icon-tools-times-red mr10"></i>Cancelled
                                                    @endif
                                                </li>
                                                <li @if($glst->attendances == 'pending') style="display:none;" @else onclick="change_invitation_status('{{$glst->invId}}','0');" @endif>
                                                    <i class="icon-tools icon-tools-clock-orange mr10"></i>Pending
                                                </li>
                                                <li @if($glst->attendances == 'confirmed') style="display:none;" @else onclick="change_invitation_status('{{$glst->invId}}','1');" @endif>
                                                    <i class="icon-tools icon-tools-checkbox mr10"></i>Confirmed
                                                </li>
                                                <li @if($glst->attendances == 'cancelled') style="display:none;" @else onclick="change_invitation_status('{{$glst->invId}}','2');" @endif>
                                                    <i class="icon-tools icon-tools-times-red mr10"></i>Cancelled
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                                @if($data['current_event']->menus == 'Yes')
                                <td class="guests-rows-td">
                                    @if($glst->attendances == 'cancelled')
                                        <span class="app-guest-canceled menuSpan{{$glst->invId}}">Cancelled</span>
                                    @else
                                        <span class="app-guest-canceled menuSpan{{$glst->invId}}" style="display:none;">Cancelled</span>
                                    @endif
                                    @php $eMenus = explode('--',$data['current_event']->menu_types); @endphp
                                    <div class="app-input-select input-select app-guest-update guests-rows-select" id="mmenusHtml{{$glst->invId}}" @if($glst->attendances == 'cancelled') style="display:none;" @endif>
                                        <span class="app-input-label input-select-label input-filled" onclick="get_menus('{{$glst->invId}}');">
                                            @if($glst->menus && in_array($glst->menus,$eMenus)){{$glst->menus}} @else Select @endif
                                        </span>
                                        <div class="app-input-dropdown input-select-dropdown hideMenusChange menusChange{{$glst->invId}}">
                                            <ul>
                                                @if(in_array($glst->menus,$eMenus))
                                                <li class="subtitle app-input-select-label ">{{$glst->menus}}</li>
                                                @endif
                                                @for($em = 0; $em < count($eMenus); $em++)
                                                    <li @if($glst->menus == $eMenus[$em]) style="display:none;" @else onclick="change_invitation_menus('{{$glst->invId}}','{{$eMenus[$em]}}');" @endif>{{$eMenus[$em]}}</li>
                                                @endfor
                                                <li class="guests-rows-select-add" onclick="get_newMenusModal('{{$glst->invId}}');">
                                                    <i class="icon-tools icon-tools-plus-circle-medium icon-left"></i>Create Menu
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                                @endif
                                @if($data['current_event']->tables == 'Yes')
                                <td class="guests-rows-td">
                                    @if($glst->attendances == 'cancelled')
                                        <span class="app-guest-canceled tableSpan{{$glst->invId}}">Cancelled</span>
                                    @else
                                        <span class="app-guest-canceled tableSpan{{$glst->invId}}" style="display:none;">Cancelled</span>
                                    @endif
                                    <div class="app-input-select input-select app-guest-update guests-rows-select" id="mtablesHtml{{$glst->invId}}" @if($glst->attendances == 'cancelled') style="display:none;" @endif>
                                        <span class="app-input-label input-select-label input-filled" onclick="get_tables('{{$glst->invId}}');">
                                            @if($glst->tables) {{$glst->title.'('.($glst->table_seat - $glst->guest_seat).')'}} @else Select @endif
                                        </span>
                                        <div class="app-input-dropdown input-select-dropdown hideTablesChange tablesChange{{$glst->invId}}">
                                            <ul>
                                                @if($glst->tables)
                                                <li class="subtitle app-input-select-label ">{{$glst->title.'('.($glst->table_seat - $glst->guest_seat).')'}}</li>
                                                @endif
                                                @foreach($data['eventTable'] as $evt)
                                                    @if(($evt->table_seat - count($evt->seatdata)) > 0)
                                                        <li @if($glst->tables == $evt->id) style="display:none;" @else onclick="change_invitation_tables('{{$glst->invId}}','{{$evt->id}}');" @endif>{{$evt->table_nm}} ({{($evt->table_seat - count($evt->seatdata))}})</li>
                                                    @endif
                                                @endforeach
                                                <li class="guests-rows-select-add" onclick="window.location.href='{{url('tools/seating_chart').'?idEvent='.$idEvent}}';">
                                                    <i class="icon-tools icon-tools-plus-circle-medium icon-left"></i>Add Table
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                                @endif
                                @if($data['current_event']->lists == 'Yes')
                                <td class="guests-rows-td">
                                    @if($glst->attendances == 'cancelled')
                                        <span class="app-guest-canceled listSpan{{$glst->invId}}">Cancelled</span>
                                    @else
                                        <span class="app-guest-canceled listSpan{{$glst->invId}}" style="display:none;">Cancelled</span>
                                    @endif
                                    @php $eLists = explode('--',$data['current_event']->list_types); @endphp
                                    <div class="app-input-select input-select app-guest-update guests-rows-select" id="mlistsHtml{{$glst->invId}}" @if($glst->attendances == 'cancelled') style="display:none;" @endif>
                                        <span class="app-input-label input-select-label input-filled" onclick="get_lists('{{$glst->invId}}');">
                                            @if($glst->lists && in_array($glst->lists,$eLists)){{$glst->lists}} @else Select @endif
                                        </span>
                                        <div class="app-input-dropdown input-select-dropdown hideListsChange listsChange{{$glst->invId}}">
                                            <ul>
                                                @if(in_array($glst->lists,$eLists))
                                                <li class="subtitle app-input-select-label ">{{$glst->lists}}</li>
                                                @endif
                                                @for($em = 0; $em < count($eLists); $em++)
                                                    <li @if($glst->lists == $eLists[$em]) style="display:none;" @else onclick="change_invitation_lists('{{$glst->invId}}','{{$eLists[$em]}}');" @endif>{{$eLists[$em]}}</li>
                                                @endfor
                                                <li class="guests-rows-select-add" onclick="get_newListsModal('{{$glst->invId}}');">
                                                    <i class="icon-tools icon-tools-plus-circle-medium icon-left"></i>Add a List
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                                @endif
                                <td class="guests-rows-td"></td>
                                <td class="guests-rows-td guestsRowsMore" align="right">
                                    <div class="app-toogle-layer pointer relative inline-block" onclick="mthreeDotsTab('{{$glst->id}}');">···
                                        <div class="guestsDropdown guestsDropdown--right threeDotsDiv dnone" id="mthreeDotsDiv{{$glst->id}}">
                                            <a role="button" class="app-contact-change-view-contact" onclick="reloadUrl('{{$glst->id}}');">
                                                <i class="icon-tools icon-tools-edit icon-left"></i> Edit
                                            </a>
                                            <a role="button" onclick="removeGuest_modal('{{$glst->id}}');">
                                                <i class="icon-tools icon-tools-trash icon-left"></i> Remove
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
                <div class="defTabDivCls tabDiv3" @if($tab != '3') style="display:none;" @endif>
                    @foreach($data['tablesCat'] as $tcat)
                    <table class="app-guest-row-group guests-rows-group">
                        <thead>
                            <tr class="guests-rows-head app-guests-group-title">
                                <td class="guests-rows-td guests-rows-noBorder" width="3%"></td>
                                <td class="guests-rows-td guests-rows-nameBig" width="24%">
                                    {{$tcat->table_nm}} <span class="guests-rows-count app-guests-group-items-count">{{count($tcat['guestData'])}}</span>
                                </td>
                                <td class="guests-rows-td guestsRowsTitle" width="15%">Attendance</td>
                                @if($data['current_event']->menus == 'Yes')
                                    <td class="guests-rows-td guestsRowsTitle" width="18%">Menu</td>
                                @endif
                                @if($data['current_event']->tables == 'Yes')
                                    <td class="guests-rows-td guestsRowsTitle" width="18%">Table</td>
                                @endif
                                @if($data['current_event']->lists == 'Yes')
                                    <td class="guests-rows-td guestsRowsTitle" width="18%">List</td>
                                @endif
                                <td class="guests-rows-td guestsRowsTitle" width="5%"></td>
                                <td class="guests-rows-td guestsRowsLink" width="10%" align="right">
                                    <span class="app-toogle-layer pointer clsSpan" onclick="show_edit_dropdown('{{$tcat->id}}');">...</span>
                                    <div class="guestsDropdown guestsDropdown--right enable_dropdown{{$tcat->id}} dropdown-opened dnone">
                                        <a role="button" onclick='edit_tables("{{$tcat->id}}")'>
                                            <i class="icon-tools icon-tools-excel icon-left"></i> Rename
                                        </a>
                                        <a role="button" class="app-contact-group-delete" onclick="remove_tables('{{$tcat->id}}');">
                                            <i class="icon-tools icon-tools-trash icon-left"></i> Remove
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        </thead>
                        <tbody>
                            @php $groomNum = $brideNum = 0; @endphp
                            @if(count($tcat['guestData']) > 0)
                                @foreach($tcat['guestData'] as $glst)
                                <tr class="app-contact-row guests-rows-item searchDataFilter">
                                    <td class="guests-rows-td guests-rows-noBorder" width="3%">
                                        <div class="guests-rows-td-checkbox input-group-line inline">
                                            <label class="app-guest-check-label">
                                                <input type="checkbox" class="app-guest-check app-not-icheck select_all_childs chbxChilds3" value="{{$glst->id}}">
                                                <span class="select_all_childs_span"></span>
                                            </label>
                                        </div>
                                    </td>
                                    <td class="guests-rows-td guests-rows-name pointer app-contact-change-view-contact" onclick="reloadUrl('{{$glst->id}}');">
                                        @if($glst->age_type == 'Adult' && $glst->gender == 'Male')
                                            @if($glst->group_id == 1 && $groomNum == 0)
                                                @php $groomNum++; @endphp
                                                <span class="icon-tools icon-tools-groom"></span>
                                            @else
                                                <span class="icon-tools icon-tools-men"></span>
                                            @endif
                                        @elseif($glst->age_type == 'Child' && $glst->gender == 'Male')
                                            <span class="icon-tools icon-tools-boy"></span>
                                        @elseif($glst->age_type == 'Adult' && $glst->gender == 'Female')
                                            @if($glst->group_id == 1 && $brideNum == 0)
                                                @php $brideNum++; @endphp
                                                <span class="icon-tools icon-tools-bride"></span>
                                            @else
                                                <span class="icon-tools icon-tools-woman"></span>
                                            @endif
                                        @elseif($glst->age_type == 'Child' && $glst->gender == 'Female')
                                            <span class="icon-tools icon-tools-girl"></span>
                                        @elseif($glst->age_type == 'Baby' && $glst->gender != '')
                                            <span class="icon-tools icon-tools-child"></span>
                                        @elseif($glst->age_type == NULL && $glst->gender == NULL)
                                            <span class="icon-tools icon-tools-adult"></span>
                                        @endif
                                        @if($glst->related_id != '')
                                            @foreach($tcat['guestData'] as $rlid)
                                                @if($rlid->id == $glst->related_id && $rlid->tables == $glst->tables)
                                                    <i class="guests-row-child icon-tools icon-tools-guest-lock"></i>
                                                @endif
                                            @endforeach
                                        @endif
                                        <span class="app-contact-grid-name pointer pl5">{{ucfirst($glst->firstname).' '.$glst->lastname}}</span>
                                    </td>
                                    <td class="guests-rows-td">
                                        <div class="app-input-select input-select app-guest-update select-attendance guests-rows-select" id="sstatusHtml{{$glst->invId}}">
                                            <span class="app-input-label input-select-label input-filled" onclick="get_status('{{$glst->invId}}');">
                                                @if($glst->attendances == 'confirmed')
                                                    <i class="icon-tools icon-tools-checkbox mr10"></i>Confirmed
                                                @elseif($glst->attendances == 'pending')
                                                    <i class="icon-tools icon-tools-clock-orange mr10"></i>Pending
                                                @elseif($glst->attendances == 'cancelled')
                                                    <i class="icon-tools icon-tools-times-red mr10"></i>Cancelled
                                                @endif
                                            </span>
                                            <div class="app-input-dropdown input-select-dropdown hideStatusChange statusChange{{$glst->invId}}">
                                                <ul>
                                                    <li class="subtitle app-input-select-label ">
                                                        @if($glst->attendances == 'confirmed')
                                                            <i class="icon-tools icon-tools-checkbox mr10"></i>Confirmed
                                                        @elseif($glst->attendances == 'pending')
                                                            <i class="icon-tools icon-tools-clock-orange mr10"></i>Pending
                                                        @elseif($glst->attendances == 'cancelled')
                                                            <i class="icon-tools icon-tools-times-red mr10"></i>Cancelled
                                                        @endif
                                                    </li>
                                                    <li @if($glst->attendances == 'pending') style="display:none;" @else onclick="change_invitation_status('{{$glst->invId}}','0');" @endif>
                                                        <i class="icon-tools icon-tools-clock-orange mr10"></i>Pending
                                                    </li>
                                                    <li @if($glst->attendances == 'confirmed') style="display:none;" @else onclick="change_invitation_status('{{$glst->invId}}','1');" @endif>
                                                        <i class="icon-tools icon-tools-checkbox mr10"></i>Confirmed
                                                    </li>
                                                    <li @if($glst->attendances == 'cancelled') style="display:none;" @else onclick="change_invitation_status('{{$glst->invId}}','2');" @endif>
                                                        <i class="icon-tools icon-tools-times-red mr10"></i>Cancelled
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                    @if($data['current_event']->menus == 'Yes')
                                    <td class="guests-rows-td">
                                        @if($glst->attendances == 'cancelled')
                                            <span class="app-guest-canceled menuSpan{{$glst->invId}}">Cancelled</span>
                                        @else
                                            <span class="app-guest-canceled menuSpan{{$glst->invId}}" style="display:none;">Cancelled</span>
                                        @endif
                                        @php $eMenus = explode('--',$data['current_event']->menu_types); @endphp
                                        <div class="app-input-select input-select app-guest-update guests-rows-select" id="smenusHtml{{$glst->invId}}" @if($glst->attendances == 'cancelled') style="display:none;" @endif>
                                            <span class="app-input-label input-select-label input-filled" onclick="get_menus('{{$glst->invId}}');">
                                                @if($glst->menus && in_array($glst->menus,$eMenus)){{$glst->menus}} @else Select @endif
                                            </span>
                                            <div class="app-input-dropdown input-select-dropdown hideMenusChange menusChange{{$glst->invId}}">
                                                <ul>
                                                    @if(in_array($glst->menus,$eMenus))
                                                    <li class="subtitle app-input-select-label ">{{$glst->menus}}</li>
                                                    @endif
                                                    @for($em = 0; $em < count($eMenus); $em++)
                                                        <li @if($glst->menus == $eMenus[$em]) style="display:none;" @else onclick="change_invitation_menus('{{$glst->invId}}','{{$eMenus[$em]}}');" @endif>{{$eMenus[$em]}}</li>
                                                    @endfor
                                                    <li class="guests-rows-select-add" onclick="get_newMenusModal('{{$glst->invId}}');">
                                                        <i class="icon-tools icon-tools-plus-circle-medium icon-left"></i>Create Menu
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                    @endif
                                    @if($data['current_event']->tables == 'Yes')
                                    <td class="guests-rows-td">
                                        @if($glst->attendances == 'cancelled')
                                            <span class="app-guest-canceled tableSpan{{$glst->invId}}">Cancelled</span>
                                        @else
                                            <span class="app-guest-canceled tableSpan{{$glst->invId}}" style="display:none;">Cancelled</span>
                                        @endif
                                        <div class="app-input-select input-select app-guest-update guests-rows-select" id="stablesHtml{{$glst->invId}}" @if($glst->attendances == 'cancelled') style="display:none;" @endif>
                                            <span class="app-input-label input-select-label input-filled" onclick="get_tables('{{$glst->invId}}');">
                                                @if($glst->tables) {{$tcat->table_nm.'('.($tcat->table_seat - count($tcat->seatdata)).')'}} @else Select @endif
                                            </span>
                                            <div class="app-input-dropdown input-select-dropdown hideTablesChange tablesChange{{$glst->invId}}">
                                                <ul>
                                                    @if($glst->tables)
                                                    <li class="subtitle app-input-select-label ">{{$tcat->table_nm.'('.($tcat->table_seat - count($tcat->seatdata)).')'}}</li>
                                                    @endif
                                                    @foreach($data['eventTable'] as $evt)
                                                        @if(($evt->table_seat - count($evt->seatdata)) > 0)
                                                            <li @if($glst->tables == $evt->id) style="display:none;" @else onclick="change_invitation_tables('{{$glst->invId}}','{{$evt->id}}');" @endif>{{$evt->table_nm}} ({{($evt->table_seat - count($evt->seatdata))}})</li>
                                                        @endif
                                                    @endforeach
                                                    <li class="guests-rows-select-add" onclick="window.location.href='{{url('tools/seating_chart').'?idEvent='.$idEvent}}';">
                                                        <i class="icon-tools icon-tools-plus-circle-medium icon-left"></i>Add Table
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                    @endif
                                    @if($data['current_event']->lists == 'Yes')
                                    <td class="guests-rows-td">
                                        @if($glst->attendances == 'cancelled')
                                            <span class="app-guest-canceled listSpan{{$glst->invId}}">Cancelled</span>
                                        @else
                                            <span class="app-guest-canceled listSpan{{$glst->invId}}" style="display:none;">Cancelled</span>
                                        @endif
                                        @php $eLists = explode('--',$data['current_event']->list_types); @endphp
                                        <div class="app-input-select input-select app-guest-update guests-rows-select" id="slistsHtml{{$glst->invId}}" @if($glst->attendances == 'cancelled') style="display:none;" @endif>
                                            <span class="app-input-label input-select-label input-filled" onclick="get_lists('{{$glst->invId}}');">
                                                @if($glst->lists && in_array($glst->lists,$eLists)){{$glst->lists}} @else Select @endif
                                            </span>
                                            <div class="app-input-dropdown input-select-dropdown hideListsChange listsChange{{$glst->invId}}">
                                                <ul>
                                                    @if(in_array($glst->lists,$eLists))
                                                    <li class="subtitle app-input-select-label ">{{$glst->lists}}</li>
                                                    @endif
                                                    @for($em = 0; $em < count($eLists); $em++)
                                                        <li @if($glst->lists == $eLists[$em]) style="display:none;" @else onclick="change_invitation_lists('{{$glst->invId}}','{{$eLists[$em]}}');" @endif>{{$eLists[$em]}}</li>
                                                    @endfor
                                                    <li class="guests-rows-select-add" onclick="get_newListsModal('{{$glst->invId}}');">
                                                        <i class="icon-tools icon-tools-plus-circle-medium icon-left"></i>Add a List
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                    @endif
                                    <td class="guests-rows-td"></td>
                                    <td class="guests-rows-td guestsRowsMore" align="right">
                                        <div class="app-toogle-layer pointer relative inline-block" onclick="sthreeDotsTab('{{$glst->id}}');">···
                                            <div class="guestsDropdown guestsDropdown--right threeDotsDiv dnone" id="sthreeDotsDiv{{$glst->id}}">
                                                <a role="button" class="app-contact-change-view-contact" onclick="reloadUrl('{{$glst->id}}');">
                                                    <i class="icon-tools icon-tools-edit icon-left"></i> Edit
                                                </a>
                                                <a role="button" onclick="removeGuest_modal('{{$glst->id}}');">
                                                    <i class="icon-tools icon-tools-trash icon-left"></i> Remove
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            @else
                                <tr class="app-row-no-items">
                                    <td width="3%"></td>
                                    <td class="guests-rows-empty" colspan="7">
                                        <span>No guests</span>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    @endforeach
                    @if(count($data['unassignTable']) > 0)
                    <table class="app-guest-row-group guests-rows-group">
                        <thead>
                            <tr class="guests-rows-head app-guests-group-title">
                                <td class="guests-rows-td guests-rows-noBorder" width="3%"></td>
                                <td class="guests-rows-td guests-rows-nameBig" width="24%">
                                    Unassigned <span class="guests-rows-count app-guests-group-items-count">{{count($data['unassignTable'])}}</span>
                                </td>
                                <td class="guests-rows-td guestsRowsTitle" width="15%">Attendance</td>
                                @if($data['current_event']->menus == 'Yes')
                                    <td class="guests-rows-td guestsRowsTitle" width="18%">Menu</td>
                                @endif
                                @if($data['current_event']->tables == 'Yes')
                                    <td class="guests-rows-td guestsRowsTitle" width="18%">Table</td>
                                @endif
                                @if($data['current_event']->lists == 'Yes')
                                    <td class="guests-rows-td guestsRowsTitle" width="18%">List</td>
                                @endif
                                <td class="guests-rows-td guestsRowsTitle" width="5%"></td>
                                <td class="guests-rows-td guestsRowsLink" width="10%" align="right"></td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data['unassignTable'] as $glst)
                            <tr class="app-contact-row guests-rows-item searchDataFilter">
                                <td class="guests-rows-td guests-rows-noBorder" width="3%">
                                    <div class="guests-rows-td-checkbox input-group-line inline">
                                        <label class="app-guest-check-label">
                                            <input type="checkbox" class="app-guest-check app-not-icheck select_all_childs chbxChilds3" value="{{$glst->id}}">
                                            <span class="select_all_childs_span"></span>
                                        </label>
                                    </div>
                                </td>
                                <td class="guests-rows-td guests-rows-name pointer app-contact-change-view-contact" onclick="reloadUrl('{{$glst->id}}');">
                                    @if($glst->age_type == 'Adult' && $glst->gender == 'Male')
                                        <span class="icon-tools icon-tools-men"></span>
                                    @elseif($glst->age_type == 'Child' && $glst->gender == 'Male')
                                        <span class="icon-tools icon-tools-boy"></span>
                                    @elseif($glst->age_type == 'Adult' && $glst->gender == 'Female')
                                        <span class="icon-tools icon-tools-woman"></span>
                                    @elseif($glst->age_type == 'Child' && $glst->gender == 'Female')
                                        <span class="icon-tools icon-tools-girl"></span>
                                    @elseif($glst->age_type == 'Baby' && $glst->gender != '')
                                        <span class="icon-tools icon-tools-child"></span>
                                    @elseif($glst->age_type == NULL && $glst->gender == NULL)
                                        <span class="icon-tools icon-tools-adult"></span>
                                    @endif
                                    @if($glst->related_id != '')
                                        @foreach($data['unassignTable'] as $rlid)
                                            @if($rlid->id == $glst->related_id && $rlid->tables == $glst->tables)
                                                <i class="guests-row-child icon-tools icon-tools-guest-lock"></i>
                                            @endif
                                        @endforeach
                                    @endif
                                    <span class="app-contact-grid-name pointer pl5">{{ucfirst($glst->firstname).' '.$glst->lastname}}</span>
                                </td>
                                <td class="guests-rows-td">
                                    <div class="app-input-select input-select app-guest-update select-attendance guests-rows-select" id="mstatusHtml{{$glst->invId}}">
                                        <span class="app-input-label input-select-label input-filled" onclick="get_status('{{$glst->invId}}');">
                                            @if($glst->attendances == 'confirmed')
                                                <i class="icon-tools icon-tools-checkbox mr10"></i>Confirmed
                                            @elseif($glst->attendances == 'pending')
                                                <i class="icon-tools icon-tools-clock-orange mr10"></i>Pending
                                            @elseif($glst->attendances == 'cancelled')
                                                <i class="icon-tools icon-tools-times-red mr10"></i>Cancelled
                                            @endif
                                        </span>
                                        <div class="app-input-dropdown input-select-dropdown hideStatusChange statusChange{{$glst->invId}}">
                                            <ul>
                                                <li class="subtitle app-input-select-label ">
                                                    @if($glst->attendances == 'confirmed')
                                                        <i class="icon-tools icon-tools-checkbox mr10"></i>Confirmed
                                                    @elseif($glst->attendances == 'pending')
                                                        <i class="icon-tools icon-tools-clock-orange mr10"></i>Pending
                                                    @elseif($glst->attendances == 'cancelled')
                                                        <i class="icon-tools icon-tools-times-red mr10"></i>Cancelled
                                                    @endif
                                                </li>
                                                <li @if($glst->attendances == 'pending') style="display:none;" @else onclick="change_invitation_status('{{$glst->invId}}','0');" @endif>
                                                    <i class="icon-tools icon-tools-clock-orange mr10"></i>Pending
                                                </li>
                                                <li @if($glst->attendances == 'confirmed') style="display:none;" @else onclick="change_invitation_status('{{$glst->invId}}','1');" @endif>
                                                    <i class="icon-tools icon-tools-checkbox mr10"></i>Confirmed
                                                </li>
                                                <li @if($glst->attendances == 'cancelled') style="display:none;" @else onclick="change_invitation_status('{{$glst->invId}}','2');" @endif>
                                                    <i class="icon-tools icon-tools-times-red mr10"></i>Cancelled
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                                @if($data['current_event']->menus == 'Yes')
                                <td class="guests-rows-td">
                                    @if($glst->attendances == 'cancelled')
                                        <span class="app-guest-canceled menuSpan{{$glst->invId}}">Cancelled</span>
                                    @else
                                        <span class="app-guest-canceled menuSpan{{$glst->invId}}" style="display:none;">Cancelled</span>
                                    @endif
                                    @php $eMenus = explode('--',$data['current_event']->menu_types); @endphp
                                    <div class="app-input-select input-select app-guest-update guests-rows-select" id="smenusHtml{{$glst->invId}}" @if($glst->attendances == 'cancelled') style="display:none;" @endif>
                                        <span class="app-input-label input-select-label input-filled" onclick="get_menus('{{$glst->invId}}');">
                                            @if($glst->menus && in_array($glst->menus,$eMenus)){{$glst->menus}} @else Select @endif
                                        </span>
                                        <div class="app-input-dropdown input-select-dropdown hideMenusChange menusChange{{$glst->invId}}">
                                            <ul>
                                                @if(in_array($glst->menus,$eMenus))
                                                <li class="subtitle app-input-select-label ">{{$glst->menus}}</li>
                                                @endif
                                                @for($em = 0; $em < count($eMenus); $em++)
                                                    <li @if($glst->menus == $eMenus[$em]) style="display:none;" @else onclick="change_invitation_menus('{{$glst->invId}}','{{$eMenus[$em]}}');" @endif>{{$eMenus[$em]}}</li>
                                                @endfor
                                                <li class="guests-rows-select-add" onclick="get_newMenusModal('{{$glst->invId}}');">
                                                    <i class="icon-tools icon-tools-plus-circle-medium icon-left"></i>Create Menu
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                                @endif
                                @if($data['current_event']->tables == 'Yes')
                                <td class="guests-rows-td">
                                    @if($glst->attendances == 'cancelled')
                                        <span class="app-guest-canceled tableSpan{{$glst->invId}}">Cancelled</span>
                                    @else
                                        <span class="app-guest-canceled tableSpan{{$glst->invId}}" style="display:none;">Cancelled</span>
                                    @endif
                                    <div class="app-input-select input-select app-guest-update guests-rows-select" id="stablesHtml{{$glst->invId}}" @if($glst->attendances == 'cancelled') style="display:none;" @endif>
                                        <span class="app-input-label input-select-label input-filled" onclick="get_tables('{{$glst->invId}}');">
                                            @if($glst->tables) {{$glst->title.'('.($glst->table_seat - $glst->guest_seat).')'}} @else Select @endif
                                        </span>
                                        <div class="app-input-dropdown input-select-dropdown hideTablesChange tablesChange{{$glst->invId}}">
                                            <ul>
                                                @if($glst->tables)
                                                <li class="subtitle app-input-select-label ">{{$glst->title.'('.($glst->table_seat - $glst->guest_seat).')'}}</li>
                                                @endif
                                                @foreach($data['eventTable'] as $evt)
                                                    @if($evt->table_seat - count($evt->seatdata) > 0)
                                                        <li @if($glst->tables == $evt->id) style="display:none;" @else onclick="change_invitation_tables('{{$glst->invId}}','{{$evt->id}}');" @endif>{{$evt->table_nm}} ({{($evt->table_seat - count($evt->seatdata))}})</li>
                                                    @endif
                                                @endforeach
                                                <li class="guests-rows-select-add" onclick="window.location.href='{{url('tools/seating_chart').'?idEvent='.$idEvent}}';">
                                                    <i class="icon-tools icon-tools-plus-circle-medium icon-left"></i>Add Table
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                                @endif
                                @if($data['current_event']->lists == 'Yes')
                                <td class="guests-rows-td">
                                    @if($glst->attendances == 'cancelled')
                                        <span class="app-guest-canceled listSpan{{$glst->invId}}">Cancelled</span>
                                    @else
                                        <span class="app-guest-canceled listSpan{{$glst->invId}}" style="display:none;">Cancelled</span>
                                    @endif
                                    @php $eLists = explode('--',$data['current_event']->list_types); @endphp
                                    <div class="app-input-select input-select app-guest-update guests-rows-select" id="slistsHtml{{$glst->invId}}" @if($glst->attendances == 'cancelled') style="display:none;" @endif>
                                        <span class="app-input-label input-select-label input-filled" onclick="get_lists('{{$glst->invId}}');">
                                            @if($glst->lists && in_array($glst->lists,$eLists)){{$glst->lists}} @else Select @endif
                                        </span>
                                        <div class="app-input-dropdown input-select-dropdown hideListsChange listsChange{{$glst->invId}}">
                                            <ul>
                                                @if(in_array($glst->lists,$eLists))
                                                <li class="subtitle app-input-select-label ">{{$glst->lists}}</li>
                                                @endif
                                                @for($em = 0; $em < count($eLists); $em++)
                                                    <li @if($glst->lists == $eLists[$em]) style="display:none;" @else onclick="change_invitation_lists('{{$glst->invId}}','{{$eLists[$em]}}');" @endif>{{$eLists[$em]}}</li>
                                                @endfor
                                                <li class="guests-rows-select-add" onclick="get_newListsModal('{{$glst->invId}}');">
                                                    <i class="icon-tools icon-tools-plus-circle-medium icon-left"></i>Add a List
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                                @endif
                                <td class="guests-rows-td"></td>
                                <td class="guests-rows-td guestsRowsMore" align="right">
                                    <div class="app-toogle-layer pointer relative inline-block" onclick="sthreeDotsTab('{{$glst->id}}');">···
                                        <div class="guestsDropdown guestsDropdown--right threeDotsDiv dnone" id="sthreeDotsDiv{{$glst->id}}">
                                            <a role="button" class="app-contact-change-view-contact" onclick="reloadUrl('{{$glst->id}}');">
                                                <i class="icon-tools icon-tools-edit icon-left"></i> Edit
                                            </a>
                                            <a role="button" onclick="removeGuest_modal('{{$glst->id}}');">
                                                <i class="icon-tools icon-tools-trash icon-left"></i> Remove
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
                <div class="defTabDivCls tabDiv4" @if($tab != '4') style="display:none;" @endif>
                    @foreach($data['attendanceCat'] as $acat)
                    <table class="app-guest-row-group guests-rows-group">
                        <thead>
                            <tr class="guests-rows-head app-guests-group-title">
                                <td class="guests-rows-td guests-rows-noBorder" width="3%"></td>
                                <td class="guests-rows-td guests-rows-nameBig" width="24%">
                                    {{$acat['title']}} <span class="guests-rows-count app-guests-group-items-count">{{count($acat['guestData'])}}</span>
                                </td>
                                <td class="guests-rows-td guestsRowsTitle" width="15%">Attendance</td>
                                @if($data['current_event']->menus == 'Yes')
                                    <td class="guests-rows-td guestsRowsTitle" width="18%">Menu</td>
                                @endif
                                @if($data['current_event']->tables == 'Yes')
                                    <td class="guests-rows-td guestsRowsTitle" width="18%">Table</td>
                                @endif
                                @if($data['current_event']->lists == 'Yes')
                                    <td class="guests-rows-td guestsRowsTitle" width="18%">List</td>
                                @endif
                                <td class="guests-rows-td guestsRowsTitle" width="5%"></td>
                                <td class="guests-rows-td guestsRowsLink" width="10%" align="right"></td>
                            </tr>
                        </thead>
                        <tbody>
                            @php $groomNum = $brideNum = 0; @endphp
                            @if(count($acat['guestData']) > 0)
                                @foreach($acat['guestData'] as $glst)
                                <tr class="app-contact-row guests-rows-item searchDataFilter">
                                    <td class="guests-rows-td guests-rows-noBorder" width="3%">
                                        <div class="guests-rows-td-checkbox input-group-line inline">
                                            <label class="app-guest-check-label">
                                                <input type="checkbox" class="app-guest-check app-not-icheck select_all_childs chbxChilds4" value="{{$glst->id}}">
                                                <span class="select_all_childs_span"></span>
                                            </label>
                                        </div>
                                    </td>
                                    <td class="guests-rows-td guests-rows-name pointer app-contact-change-view-contact" onclick="reloadUrl('{{$glst->id}}');">
                                        @if($glst->age_type == 'Adult' && $glst->gender == 'Male')
                                            @if($glst->group_id == 1 && $groomNum == 0)
                                                @php $groomNum++; @endphp
                                                <span class="icon-tools icon-tools-groom"></span>
                                            @else
                                                <span class="icon-tools icon-tools-men"></span>
                                            @endif
                                        @elseif($glst->age_type == 'Child' && $glst->gender == 'Male')
                                            <span class="icon-tools icon-tools-boy"></span>
                                        @elseif($glst->age_type == 'Adult' && $glst->gender == 'Female')
                                            @if($glst->group_id == 1 && $brideNum == 0)
                                                @php $brideNum++; @endphp
                                                <span class="icon-tools icon-tools-bride"></span>
                                            @else
                                                <span class="icon-tools icon-tools-woman"></span>
                                            @endif
                                        @elseif($glst->age_type == 'Child' && $glst->gender == 'Female')
                                            <span class="icon-tools icon-tools-girl"></span>
                                        @elseif($glst->age_type == 'Baby' && $glst->gender != '')
                                            <span class="icon-tools icon-tools-child"></span>
                                        @elseif($glst->age_type == NULL && $glst->gender == NULL)
                                            <span class="icon-tools icon-tools-adult"></span>
                                        @endif
                                        @if($glst->related_id != '')
                                            @foreach($acat['guestData'] as $rlid)
                                                @if($rlid->id == $glst->related_id && $rlid->attendances == $glst->attendances)
                                                    <i class="guests-row-child icon-tools icon-tools-guest-lock"></i>
                                                @endif
                                            @endforeach
                                        @endif
                                        <span class="app-contact-grid-name pointer pl5">{{ucfirst($glst->firstname).' '.$glst->lastname}}</span>
                                    </td>
                                    <td class="guests-rows-td">
                                        <div class="app-input-select input-select app-guest-update select-attendance guests-rows-select" id="astatusHtml{{$glst->invId}}">
                                            <span class="app-input-label input-select-label input-filled" onclick="get_status('{{$glst->invId}}');">
                                                @if($glst->attendances == 'confirmed')
                                                    <i class="icon-tools icon-tools-checkbox mr10"></i>Confirmed
                                                @elseif($glst->attendances == 'pending')
                                                    <i class="icon-tools icon-tools-clock-orange mr10"></i>Pending
                                                @elseif($glst->attendances == 'cancelled')
                                                    <i class="icon-tools icon-tools-times-red mr10"></i>Cancelled
                                                @endif
                                            </span>
                                            <div class="app-input-dropdown input-select-dropdown hideStatusChange statusChange{{$glst->invId}}">
                                                <ul>
                                                    <li class="subtitle app-input-select-label ">
                                                        @if($glst->attendances == 'confirmed')
                                                            <i class="icon-tools icon-tools-checkbox mr10"></i>Confirmed
                                                        @elseif($glst->attendances == 'pending')
                                                            <i class="icon-tools icon-tools-clock-orange mr10"></i>Pending
                                                        @elseif($glst->attendances == 'cancelled')
                                                            <i class="icon-tools icon-tools-times-red mr10"></i>Cancelled
                                                        @endif
                                                    </li>
                                                    <li @if($glst->attendances == 'pending') style="display:none;" @else onclick="change_invitation_status('{{$glst->invId}}','0');" @endif>
                                                        <i class="icon-tools icon-tools-clock-orange mr10"></i>Pending
                                                    </li>
                                                    <li @if($glst->attendances == 'confirmed') style="display:none;" @else onclick="change_invitation_status('{{$glst->invId}}','1');" @endif>
                                                        <i class="icon-tools icon-tools-checkbox mr10"></i>Confirmed
                                                    </li>
                                                    <li @if($glst->attendances == 'cancelled') style="display:none;" @else onclick="change_invitation_status('{{$glst->invId}}','2');" @endif>
                                                        <i class="icon-tools icon-tools-times-red mr10"></i>Cancelled
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                    @if($data['current_event']->menus == 'Yes')
                                    <td class="guests-rows-td">
                                        @if($glst->attendances == 'cancelled')
                                            <span class="app-guest-canceled menuSpan{{$glst->invId}}">Cancelled</span>
                                        @else
                                            <span class="app-guest-canceled menuSpan{{$glst->invId}}" style="display:none;">Cancelled</span>
                                        @endif
                                        @php $eMenus = explode('--',$data['current_event']->menu_types); @endphp
                                        <div class="app-input-select input-select app-guest-update guests-rows-select" id="amenusHtml{{$glst->invId}}" @if($glst->attendances == 'cancelled') style="display:none;" @endif>
                                            <span class="app-input-label input-select-label input-filled" onclick="get_menus('{{$glst->invId}}');">
                                                @if($glst->menus && in_array($glst->menus,$eMenus)){{$glst->menus}} @else Select @endif
                                            </span>
                                            <div class="app-input-dropdown input-select-dropdown hideMenusChange menusChange{{$glst->invId}}">
                                                <ul>
                                                    @if(in_array($glst->menus,$eMenus))
                                                    <li class="subtitle app-input-select-label ">{{$glst->menus}}</li>
                                                    @endif
                                                    @for($em = 0; $em < count($eMenus); $em++)
                                                        <li @if($glst->menus == $eMenus[$em]) style="display:none;" @else onclick="change_invitation_menus('{{$glst->invId}}','{{$eMenus[$em]}}');" @endif>{{$eMenus[$em]}}</li>
                                                    @endfor
                                                    <li class="guests-rows-select-add" onclick="get_newMenusModal('{{$glst->invId}}');">
                                                        <i class="icon-tools icon-tools-plus-circle-medium icon-left"></i>Create Menu
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                    @endif
                                    @if($data['current_event']->tables == 'Yes')
                                    <td class="guests-rows-td">
                                        @if($glst->attendances == 'cancelled')
                                            <span class="app-guest-canceled tableSpan{{$glst->invId}}">Cancelled</span>
                                        @else
                                            <span class="app-guest-canceled tableSpan{{$glst->invId}}" style="display:none;">Cancelled</span>
                                        @endif
                                        <div class="app-input-select input-select app-guest-update guests-rows-select" id="atablesHtml{{$glst->invId}}" @if($glst->attendances == 'cancelled') style="display:none;" @endif>
                                            <span class="app-input-label input-select-label input-filled" onclick="get_tables('{{$glst->invId}}');">
                                                @if($glst->tables) {{$glst->title.'('.($glst->table_seat - $glst->guest_seat).')'}} @else Select @endif
                                            </span>
                                            <div class="app-input-dropdown input-select-dropdown hideTablesChange tablesChange{{$glst->invId}}">
                                                <ul>
                                                    @if($glst->tables)
                                                    <li class="subtitle app-input-select-label ">{{$glst->title.'('.($glst->table_seat - $glst->guest_seat).')'}}</li>
                                                    @endif
                                                    @foreach($data['eventTable'] as $evt)
                                                        @if(($evt->table_seat - count($evt->seatdata)) > 0)
                                                            <li @if($glst->tables == $evt->id) style="display:none;" @else onclick="change_invitation_tables('{{$glst->invId}}','{{$evt->id}}');" @endif>{{$evt->table_nm}} ({{($evt->table_seat - count($evt->seatdata))}})</li>
                                                        @endif
                                                    @endforeach
                                                    <li class="guests-rows-select-add" onclick="window.location.href='{{url('tools/seating_chart').'?idEvent='.$idEvent}}';">
                                                        <i class="icon-tools icon-tools-plus-circle-medium icon-left"></i>Add Table
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                    @endif
                                    @if($data['current_event']->lists == 'Yes')
                                    <td class="guests-rows-td">
                                        @if($glst->attendances == 'cancelled')
                                            <span class="app-guest-canceled listSpan{{$glst->invId}}">Cancelled</span>
                                        @else
                                            <span class="app-guest-canceled listSpan{{$glst->invId}}" style="display:none;">Cancelled</span>
                                        @endif
                                        @php $eLists = explode('--',$data['current_event']->list_types); @endphp
                                        <div class="app-input-select input-select app-guest-update guests-rows-select" id="alistsHtml{{$glst->invId}}" @if($glst->attendances == 'cancelled') style="display:none;" @endif>
                                            <span class="app-input-label input-select-label input-filled" onclick="get_lists('{{$glst->invId}}');">
                                                @if($glst->lists && in_array($glst->lists,$eLists)){{$glst->lists}} @else Select @endif
                                            </span>
                                            <div class="app-input-dropdown input-select-dropdown hideListsChange listsChange{{$glst->invId}}">
                                                <ul>
                                                    @if(in_array($glst->lists,$eLists))
                                                    <li class="subtitle app-input-select-label ">{{$glst->lists}}</li>
                                                    @endif
                                                    @for($em = 0; $em < count($eLists); $em++)
                                                        <li @if($glst->lists == $eLists[$em]) style="display:none;" @else onclick="change_invitation_lists('{{$glst->invId}}','{{$eLists[$em]}}');" @endif>{{$eLists[$em]}}</li>
                                                    @endfor
                                                    <li class="guests-rows-select-add" onclick="get_newListsModal('{{$glst->invId}}');">
                                                        <i class="icon-tools icon-tools-plus-circle-medium icon-left"></i>Add a List
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                    @endif
                                    <td class="guests-rows-td"></td>
                                    <td class="guests-rows-td guestsRowsMore" align="right">
                                        <div class="app-toogle-layer pointer relative inline-block" onclick="athreeDotsTab('{{$glst->id}}');">···
                                            <div class="guestsDropdown guestsDropdown--right threeDotsDiv dnone" id="athreeDotsDiv{{$glst->id}}">
                                                <a role="button" class="app-contact-change-view-contact" onclick="reloadUrl('{{$glst->id}}');">
                                                    <i class="icon-tools icon-tools-edit icon-left"></i> Edit
                                                </a>
                                                <a role="button" onclick="removeGuest_modal('{{$glst->id}}');">
                                                    <i class="icon-tools icon-tools-trash icon-left"></i> Remove
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            @else
                                <tr class="app-row-no-items">
                                    <td width="3%"></td>
                                    <td class="guests-rows-empty" colspan="7">
                                        <span>No guests</span>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    @endforeach
                </div>
                <div class="defTabDivCls tabDiv5" @if($tab != '5') style="display:none;" @endif>
                    @foreach($data['listsCat'] as $lcat)
                    <table class="app-guest-row-group guests-rows-group">
                        <thead>
                            <tr class="guests-rows-head app-guests-group-title">
                                <td class="guests-rows-td guests-rows-noBorder" width="3%"></td>
                                <td class="guests-rows-td guests-rows-nameBig" width="24%">
                                    {{$lcat['title']}} <span class="guests-rows-count app-guests-group-items-count">{{count($lcat['guestData'])}}</span>
                                </td>
                                <td class="guests-rows-td guestsRowsTitle" width="15%">Attendance</td>
                                @if($data['current_event']->menus == 'Yes')
                                    <td class="guests-rows-td guestsRowsTitle" width="18%">Menu</td>
                                @endif
                                @if($data['current_event']->tables == 'Yes')
                                    <td class="guests-rows-td guestsRowsTitle" width="18%">Table</td>
                                @endif
                                @if($data['current_event']->lists == 'Yes')
                                    <td class="guests-rows-td guestsRowsTitle" width="18%">List</td>
                                @endif
                                <td class="guests-rows-td guestsRowsTitle" width="5%"></td>
                                <td class="guests-rows-td guestsRowsLink" width="10%" align="right">
                                    <span class="app-toogle-layer pointer clsSpan" onclick="show_edit_dropdown('{{str_replace(' ','_',$lcat['title'])}}');">...</span>
                                    <div class="guestsDropdown guestsDropdown--right enable_dropdown{{str_replace(' ','_',$lcat['title'])}} dropdown-opened dnone">
                                        <a role="button" onclick='edit_lists("{{$idEvent}}","{{$lcat['title']}}")'>
                                            <i class="icon-tools icon-tools-excel icon-left"></i> Rename
                                        </a>
                                        <a role="button" class="app-contact-group-delete" onclick="remove_lists('{{$idEvent}}','{{$lcat['title']}}');">
                                            <i class="icon-tools icon-tools-trash icon-left"></i> Remove
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        </thead>
                        <tbody>
                            @php $groomNum = $brideNum = 0; @endphp
                            @if(count($lcat['guestData']) > 0)
                                @foreach($lcat['guestData'] as $glst)
                                <tr class="app-contact-row guests-rows-item searchDataFilter">
                                    <td class="guests-rows-td guests-rows-noBorder" width="3%">
                                        <div class="guests-rows-td-checkbox input-group-line inline">
                                            <label class="app-guest-check-label">
                                                <input type="checkbox" class="app-guest-check app-not-icheck select_all_childs chbxChilds5" value="{{$glst->id}}">
                                                <span class="select_all_childs_span"></span>
                                            </label>
                                        </div>
                                    </td>
                                    <td class="guests-rows-td guests-rows-name pointer app-contact-change-view-contact" onclick="reloadUrl('{{$glst->id}}');">
                                        @if($glst->age_type == 'Adult' && $glst->gender == 'Male')
                                            @if($glst->group_id == 1 && $groomNum == 0)
                                                @php $groomNum++; @endphp
                                                <span class="icon-tools icon-tools-groom"></span>
                                            @else
                                                <span class="icon-tools icon-tools-men"></span>
                                            @endif
                                        @elseif($glst->age_type == 'Child' && $glst->gender == 'Male')
                                            <span class="icon-tools icon-tools-boy"></span>
                                        @elseif($glst->age_type == 'Adult' && $glst->gender == 'Female')
                                            @if($glst->group_id == 1 && $brideNum == 0)
                                                @php $brideNum++; @endphp
                                                <span class="icon-tools icon-tools-bride"></span>
                                            @else
                                                <span class="icon-tools icon-tools-woman"></span>
                                            @endif
                                        @elseif($glst->age_type == 'Child' && $glst->gender == 'Female')
                                            <span class="icon-tools icon-tools-girl"></span>
                                        @elseif($glst->age_type == 'Baby' && $glst->gender != '')
                                            <span class="icon-tools icon-tools-child"></span>
                                        @elseif($glst->age_type == NULL && $glst->gender == NULL)
                                            <span class="icon-tools icon-tools-adult"></span>
                                        @endif
                                        @if($glst->related_id != '')
                                            @foreach($lcat['guestData'] as $rlid)
                                                @if($rlid->id == $glst->related_id && $rlid->lists == $glst->lists)
                                                    <i class="guests-row-child icon-tools icon-tools-guest-lock"></i>
                                                @endif
                                            @endforeach
                                        @endif
                                        <span class="app-contact-grid-name pointer pl5">{{ucfirst($glst->firstname).' '.$glst->lastname}}</span>
                                    </td>
                                    <td class="guests-rows-td">
                                        <div class="app-input-select input-select app-guest-update select-attendance guests-rows-select" id="lstatusHtml{{$glst->invId}}">
                                            <span class="app-input-label input-select-label input-filled" onclick="get_status('{{$glst->invId}}');">
                                                @if($glst->attendances == 'confirmed')
                                                    <i class="icon-tools icon-tools-checkbox mr10"></i>Confirmed
                                                @elseif($glst->attendances == 'pending')
                                                    <i class="icon-tools icon-tools-clock-orange mr10"></i>Pending
                                                @elseif($glst->attendances == 'cancelled')
                                                    <i class="icon-tools icon-tools-times-red mr10"></i>Cancelled
                                                @endif
                                            </span>
                                            <div class="app-input-dropdown input-select-dropdown hideStatusChange statusChange{{$glst->invId}}">
                                                <ul>
                                                    <li class="subtitle app-input-select-label ">
                                                        @if($glst->attendances == 'confirmed')
                                                            <i class="icon-tools icon-tools-checkbox mr10"></i>Confirmed
                                                        @elseif($glst->attendances == 'pending')
                                                            <i class="icon-tools icon-tools-clock-orange mr10"></i>Pending
                                                        @elseif($glst->attendances == 'cancelled')
                                                            <i class="icon-tools icon-tools-times-red mr10"></i>Cancelled
                                                        @endif
                                                    </li>
                                                    <li @if($glst->attendances == 'pending') style="display:none;" @else onclick="change_invitation_status('{{$glst->invId}}','0');" @endif>
                                                        <i class="icon-tools icon-tools-clock-orange mr10"></i>Pending
                                                    </li>
                                                    <li @if($glst->attendances == 'confirmed') style="display:none;" @else onclick="change_invitation_status('{{$glst->invId}}','1');" @endif>
                                                        <i class="icon-tools icon-tools-checkbox mr10"></i>Confirmed
                                                    </li>
                                                    <li @if($glst->attendances == 'cancelled') style="display:none;" @else onclick="change_invitation_status('{{$glst->invId}}','2');" @endif>
                                                        <i class="icon-tools icon-tools-times-red mr10"></i>Cancelled
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                    @if($data['current_event']->menus == 'Yes')
                                    <td class="guests-rows-td">
                                        @if($glst->attendances == 'cancelled')
                                            <span class="app-guest-canceled menuSpan{{$glst->invId}}">Cancelled</span>
                                        @else
                                            <span class="app-guest-canceled menuSpan{{$glst->invId}}" style="display:none;">Cancelled</span>
                                        @endif
                                        @php $eMenus = explode('--',$data['current_event']->menu_types); @endphp
                                        <div class="app-input-select input-select app-guest-update guests-rows-select" id="lmenusHtml{{$glst->invId}}" @if($glst->attendances == 'cancelled') style="display:none;" @endif>
                                            <span class="app-input-label input-select-label input-filled" onclick="get_menus('{{$glst->invId}}');">
                                                @if($glst->menus && in_array($glst->menus,$eMenus)){{$glst->menus}} @else Select @endif
                                            </span>
                                            <div class="app-input-dropdown input-select-dropdown hideMenusChange menusChange{{$glst->invId}}">
                                                <ul>
                                                    @if(in_array($glst->menus,$eMenus))
                                                    <li class="subtitle app-input-select-label ">{{$glst->menus}}</li>
                                                    @endif
                                                    @for($em = 0; $em < count($eMenus); $em++)
                                                        <li @if($glst->menus == $eMenus[$em]) style="display:none;" @else onclick="change_invitation_menus('{{$glst->invId}}','{{$eMenus[$em]}}');" @endif>{{$eMenus[$em]}}</li>
                                                    @endfor
                                                    <li class="guests-rows-select-add" onclick="get_newMenusModal('{{$glst->invId}}');">
                                                        <i class="icon-tools icon-tools-plus-circle-medium icon-left"></i>Create Menu
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                    @endif
                                    @if($data['current_event']->tables == 'Yes')
                                    <td class="guests-rows-td">
                                        @if($glst->attendances == 'cancelled')
                                            <span class="app-guest-canceled tableSpan{{$glst->invId}}">Cancelled</span>
                                        @else
                                            <span class="app-guest-canceled tableSpan{{$glst->invId}}" style="display:none;">Cancelled</span>
                                        @endif
                                        <div class="app-input-select input-select app-guest-update guests-rows-select" id="ltablesHtml{{$glst->invId}}" @if($glst->attendances == 'cancelled') style="display:none;" @endif>
                                            <span class="app-input-label input-select-label input-filled" onclick="get_tables('{{$glst->invId}}');">
                                                @if($glst->tables) {{$glst->title.'('.($glst->table_seat - $glst->guest_seat).')'}} @else Select @endif
                                            </span>
                                            <div class="app-input-dropdown input-select-dropdown hideTablesChange tablesChange{{$glst->invId}}">
                                                <ul>
                                                    @if($glst->tables)
                                                    <li class="subtitle app-input-select-label ">{{$glst->title.'('.($glst->table_seat - $glst->guest_seat).')'}}</li>
                                                    @endif
                                                    @foreach($data['eventTable'] as $evt)
                                                        @if(($evt->table_seat - count($evt->seatdata)) > 0)
                                                            <li @if($glst->tables == $evt->id) style="display:none;" @else onclick="change_invitation_tables('{{$glst->invId}}','{{$evt->id}}');" @endif>{{$evt->table_nm}} ({{($evt->table_seat - count($evt->seatdata))}})</li>
                                                        @endif
                                                    @endforeach
                                                    <li class="guests-rows-select-add" onclick="window.location.href='{{url('tools/seating_chart').'?idEvent='.$idEvent}}';">
                                                        <i class="icon-tools icon-tools-plus-circle-medium icon-left"></i>Add Table
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                    @endif
                                    @if($data['current_event']->lists == 'Yes')
                                    <td class="guests-rows-td">
                                        @if($glst->attendances == 'cancelled')
                                            <span class="app-guest-canceled listSpan{{$glst->invId}}">Cancelled</span>
                                        @else
                                            <span class="app-guest-canceled listSpan{{$glst->invId}}" style="display:none;">Cancelled</span>
                                        @endif
                                        @php $eLists = explode('--',$data['current_event']->list_types); @endphp
                                        <div class="app-input-select input-select app-guest-update guests-rows-select" id="llistsHtml{{$glst->invId}}" @if($glst->attendances == 'cancelled') style="display:none;" @endif>
                                            <span class="app-input-label input-select-label input-filled" onclick="get_lists('{{$glst->invId}}');">
                                                @if($glst->lists && in_array($glst->lists,$eLists)){{$glst->lists}} @else Select @endif
                                            </span>
                                            <div class="app-input-dropdown input-select-dropdown hideListsChange listsChange{{$glst->invId}}">
                                                <ul>
                                                    @if(in_array($glst->lists,$eLists))
                                                    <li class="subtitle app-input-select-label ">{{$glst->lists}}</li>
                                                    @endif
                                                    @for($em = 0; $em < count($eLists); $em++)
                                                        <li @if($glst->lists == $eLists[$em]) style="display:none;" @else onclick="change_invitation_lists('{{$glst->invId}}','{{$eLists[$em]}}');" @endif>{{$eLists[$em]}}</li>
                                                    @endfor
                                                    <li class="guests-rows-select-add" onclick="get_newListsModal('{{$glst->invId}}');">
                                                        <i class="icon-tools icon-tools-plus-circle-medium icon-left"></i>Add a List
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                    @endif
                                    <td class="guests-rows-td"></td>
                                    <td class="guests-rows-td guestsRowsMore" align="right">
                                        <div class="app-toogle-layer pointer relative inline-block" onclick="lthreeDotsTab('{{$glst->id}}');">···
                                            <div class="guestsDropdown guestsDropdown--right threeDotsDiv dnone" id="lthreeDotsDiv{{$glst->id}}">
                                                <a role="button" class="app-contact-change-view-contact" onclick="reloadUrl('{{$glst->id}}');">
                                                    <i class="icon-tools icon-tools-edit icon-left"></i> Edit
                                                </a>
                                                <a role="button" onclick="removeGuest_modal('{{$glst->id}}');">
                                                    <i class="icon-tools icon-tools-trash icon-left"></i> Remove
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            @else
                                <tr class="app-row-no-items">
                                    <td width="3%"></td>
                                    <td class="guests-rows-empty" colspan="7">
                                        <span>No guests</span>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    @endforeach
                    @if(count($data['unassignList']) > 0)
                    <table class="app-guest-row-group guests-rows-group">
                        <thead>
                            <tr class="guests-rows-head app-guests-group-title">
                                <td class="guests-rows-td guests-rows-noBorder" width="3%"></td>
                                <td class="guests-rows-td guests-rows-nameBig" width="24%">
                                    Unassigned <span class="guests-rows-count app-guests-group-items-count">{{count($data['unassignList'])}}</span>
                                </td>
                                <td class="guests-rows-td guestsRowsTitle" width="15%">Attendance</td>
                                @if($data['current_event']->menus == 'Yes')
                                    <td class="guests-rows-td guestsRowsTitle" width="18%">Menu</td>
                                @endif
                                @if($data['current_event']->tables == 'Yes')
                                    <td class="guests-rows-td guestsRowsTitle" width="18%">Table</td>
                                @endif
                                @if($data['current_event']->lists == 'Yes')
                                    <td class="guests-rows-td guestsRowsTitle" width="18%">List</td>
                                @endif
                                <td class="guests-rows-td guestsRowsTitle" width="5%"></td>
                                <td class="guests-rows-td guestsRowsLink" width="10%" align="right"></td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data['unassignList'] as $glst)
                            <tr class="app-contact-row guests-rows-item searchDataFilter">
                                <td class="guests-rows-td guests-rows-noBorder" width="3%">
                                    <div class="guests-rows-td-checkbox input-group-line inline">
                                        <label class="app-guest-check-label">
                                            <input type="checkbox" class="app-guest-check app-not-icheck select_all_childs chbxChilds5" value="{{$glst->id}}">
                                            <span class="select_all_childs_span"></span>
                                        </label>
                                    </div>
                                </td>
                                <td class="guests-rows-td guests-rows-name pointer app-contact-change-view-contact" onclick="reloadUrl('{{$glst->id}}');">
                                    @if($glst->age_type == 'Adult' && $glst->gender == 'Male')
                                        <span class="icon-tools icon-tools-men"></span>
                                    @elseif($glst->age_type == 'Child' && $glst->gender == 'Male')
                                        <span class="icon-tools icon-tools-boy"></span>
                                    @elseif($glst->age_type == 'Adult' && $glst->gender == 'Female')
                                        <span class="icon-tools icon-tools-woman"></span>
                                    @elseif($glst->age_type == 'Child' && $glst->gender == 'Female')
                                        <span class="icon-tools icon-tools-girl"></span>
                                    @elseif($glst->age_type == 'Baby' && $glst->gender != '')
                                        <span class="icon-tools icon-tools-child"></span>
                                    @elseif($glst->age_type == NULL && $glst->gender == NULL)
                                        <span class="icon-tools icon-tools-adult"></span>
                                    @endif
                                    @if($glst->related_id != '')
                                        @foreach($data['unassignList'] as $rlid)
                                            @if($rlid->id == $glst->related_id && $rlid->lists == $glst->lists)
                                                <i class="guests-row-child icon-tools icon-tools-guest-lock"></i>
                                            @endif
                                        @endforeach
                                    @endif
                                    <span class="app-contact-grid-name pointer pl5">{{ucfirst($glst->firstname).' '.$glst->lastname}}</span>
                                </td>
                                <td class="guests-rows-td">
                                    <div class="app-input-select input-select app-guest-update select-attendance guests-rows-select" id="lstatusHtml{{$glst->invId}}">
                                        <span class="app-input-label input-select-label input-filled" onclick="get_status('{{$glst->invId}}');">
                                            @if($glst->attendances == 'confirmed')
                                                <i class="icon-tools icon-tools-checkbox mr10"></i>Confirmed
                                            @elseif($glst->attendances == 'pending')
                                                <i class="icon-tools icon-tools-clock-orange mr10"></i>Pending
                                            @elseif($glst->attendances == 'cancelled')
                                                <i class="icon-tools icon-tools-times-red mr10"></i>Cancelled
                                            @endif
                                        </span>
                                        <div class="app-input-dropdown input-select-dropdown hideStatusChange statusChange{{$glst->invId}}">
                                            <ul>
                                                <li class="subtitle app-input-select-label ">
                                                    @if($glst->attendances == 'confirmed')
                                                        <i class="icon-tools icon-tools-checkbox mr10"></i>Confirmed
                                                    @elseif($glst->attendances == 'pending')
                                                        <i class="icon-tools icon-tools-clock-orange mr10"></i>Pending
                                                    @elseif($glst->attendances == 'cancelled')
                                                        <i class="icon-tools icon-tools-times-red mr10"></i>Cancelled
                                                    @endif
                                                </li>
                                                <li @if($glst->attendances == 'pending') style="display:none;" @else onclick="change_invitation_status('{{$glst->invId}}','0');" @endif>
                                                    <i class="icon-tools icon-tools-clock-orange mr10"></i>Pending
                                                </li>
                                                <li @if($glst->attendances == 'confirmed') style="display:none;" @else onclick="change_invitation_status('{{$glst->invId}}','1');" @endif>
                                                    <i class="icon-tools icon-tools-checkbox mr10"></i>Confirmed
                                                </li>
                                                <li @if($glst->attendances == 'cancelled') style="display:none;" @else onclick="change_invitation_status('{{$glst->invId}}','2');" @endif>
                                                    <i class="icon-tools icon-tools-times-red mr10"></i>Cancelled
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                                @if($data['current_event']->menus == 'Yes')
                                <td class="guests-rows-td">
                                    @if($glst->attendances == 'cancelled')
                                        <span class="app-guest-canceled menuSpan{{$glst->invId}}">Cancelled</span>
                                    @else
                                        <span class="app-guest-canceled menuSpan{{$glst->invId}}" style="display:none;">Cancelled</span>
                                    @endif
                                    @php $eMenus = explode('--',$data['current_event']->menu_types); @endphp
                                    <div class="app-input-select input-select app-guest-update guests-rows-select" id="lmenusHtml{{$glst->invId}}" @if($glst->attendances == 'cancelled') style="display:none;" @endif>
                                        <span class="app-input-label input-select-label input-filled" onclick="get_menus('{{$glst->invId}}');">
                                            @if($glst->menus && in_array($glst->menus,$eMenus)){{$glst->menus}} @else Select @endif
                                        </span>
                                        <div class="app-input-dropdown input-select-dropdown hideMenusChange menusChange{{$glst->invId}}">
                                            <ul>
                                                @if(in_array($glst->menus,$eMenus))
                                                <li class="subtitle app-input-select-label ">{{$glst->menus}}</li>
                                                @endif
                                                @for($em = 0; $em < count($eMenus); $em++)
                                                    <li @if($glst->menus == $eMenus[$em]) style="display:none;" @else onclick="change_invitation_menus('{{$glst->invId}}','{{$eMenus[$em]}}');" @endif>{{$eMenus[$em]}}</li>
                                                @endfor
                                                <li class="guests-rows-select-add" onclick="get_newMenusModal('{{$glst->invId}}');">
                                                    <i class="icon-tools icon-tools-plus-circle-medium icon-left"></i>Create Menu
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                                @endif
                                @if($data['current_event']->tables == 'Yes')
                                <td class="guests-rows-td">
                                    @if($glst->attendances == 'cancelled')
                                        <span class="app-guest-canceled tableSpan{{$glst->invId}}">Cancelled</span>
                                    @else
                                        <span class="app-guest-canceled tableSpan{{$glst->invId}}" style="display:none;">Cancelled</span>
                                    @endif
                                    <div class="app-input-select input-select app-guest-update guests-rows-select" id="ltablesHtml{{$glst->invId}}" @if($glst->attendances == 'cancelled') style="display:none;" @endif>
                                        <span class="app-input-label input-select-label input-filled" onclick="get_tables('{{$glst->invId}}');">
                                            @if($glst->tables) {{$glst->title.'('.($glst->table_seat - $glst->guest_seat).')'}} @else Select @endif
                                        </span>
                                        <div class="app-input-dropdown input-select-dropdown hideTablesChange tablesChange{{$glst->invId}}">
                                            <ul>
                                                @if($glst->tables)
                                                <li class="subtitle app-input-select-label ">{{$glst->title.'('.($glst->table_seat - $glst->guest_seat).')'}}</li>
                                                @endif
                                                @foreach($data['eventTable'] as $evt)
                                                    @if(($evt->table_seat - count($evt->seatdata)) > 0)
                                                        <li @if($glst->tables == $evt->id) style="display:none;" @else onclick="change_invitation_tables('{{$glst->invId}}','{{$evt->id}}');" @endif>{{$evt->table_nm}} ({{($evt->table_seat - count($evt->seatdata))}})</li>
                                                    @endif
                                                @endforeach
                                                <li class="guests-rows-select-add" onclick="window.location.href='{{url('tools/seating_chart').'?idEvent='.$idEvent}}';">
                                                    <i class="icon-tools icon-tools-plus-circle-medium icon-left"></i>Add Table
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                                @endif
                                @if($data['current_event']->lists == 'Yes')
                                <td class="guests-rows-td">
                                    @if($glst->attendances == 'cancelled')
                                        <span class="app-guest-canceled listSpan{{$glst->invId}}">Cancelled</span>
                                    @else
                                        <span class="app-guest-canceled listSpan{{$glst->invId}}" style="display:none;">Cancelled</span>
                                    @endif
                                    @php $eLists = explode('--',$data['current_event']->list_types); @endphp
                                    <div class="app-input-select input-select app-guest-update guests-rows-select" id="llistsHtml{{$glst->invId}}" @if($glst->attendances == 'cancelled') style="display:none;" @endif>
                                        <span class="app-input-label input-select-label input-filled" onclick="get_lists('{{$glst->invId}}');">
                                            @if($glst->lists && in_array($glst->lists,$eLists)){{$glst->lists}} @else Select @endif
                                        </span>
                                        <div class="app-input-dropdown input-select-dropdown hideListsChange listsChange{{$glst->invId}}">
                                            <ul>
                                                @if(in_array($glst->lists,$eLists))
                                                <li class="subtitle app-input-select-label ">{{$glst->lists}}</li>
                                                @endif
                                                @for($em = 0; $em < count($eLists); $em++)
                                                    <li @if($glst->lists == $eLists[$em]) style="display:none;" @else onclick="change_invitation_lists('{{$glst->invId}}','{{$eLists[$em]}}');" @endif>{{$eLists[$em]}}</li>
                                                @endfor
                                                <li class="guests-rows-select-add" onclick="get_newListsModal('{{$glst->invId}}');">
                                                    <i class="icon-tools icon-tools-plus-circle-medium icon-left"></i>Add a List
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                                @endif
                                <td class="guests-rows-td"></td>
                                <td class="guests-rows-td guestsRowsMore" align="right">
                                    <div class="app-toogle-layer pointer relative inline-block" onclick="lthreeDotsTab('{{$glst->id}}');">···
                                        <div class="guestsDropdown guestsDropdown--right threeDotsDiv dnone" id="lthreeDotsDiv{{$glst->id}}">
                                            <a role="button" class="app-contact-change-view-contact" onclick="reloadUrl('{{$glst->id}}');">
                                                <i class="icon-tools icon-tools-edit icon-left"></i> Edit
                                            </a>
                                            <a role="button" onclick="removeGuest_modal('{{$glst->id}}');">
                                                <i class="icon-tools icon-tools-trash icon-left"></i> Remove
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
            @endif
        </div>
    </div>
</form>