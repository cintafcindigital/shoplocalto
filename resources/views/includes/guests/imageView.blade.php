<div class="pure-u-2-5 tools-guests-collapsed guestAsideCollapsed" style="overflow:auto;">
    <form name="frmGuests" id="frmPaged" action="#" method="post">
        <div class="relative">
            <div class="guests-rows-content guests-rows-content-full" style="border-right: 1px solid #d9d9d9;">
                <div class="defTabDivCls tabDiv1" @if($tab != '1') style="display:none;" @endif>
                    @foreach($data['guestsCat'] as $gcat)
                    <table class="app-guest-row-group guests-rows-group" style="margin-bottom:10px !important;">
                        <thead>
                            <tr class="guests-rows-head app-guests-group-title">
                                <td class="guests-rows-td guests-rows-nameBig" width="100%">
                                    {{$gcat->title}} <span class="guests-rows-count app-guests-group-items-count">@if(@$gcat->guestsData) {{count($gcat->guestsData)}} @endif</span>
                                </td>
                            </tr>
                        </thead>
                        <tbody>
                            @php $groomNum = $brideNum = 0; @endphp
                            @if(@$gcat->guestsData)
                                @foreach($gcat->guestsData as $glst)
                                <tr class="app-contact-row guests-rows-item searchDataFilter">
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
                                </tr>
                                @endforeach
                            @else
                                <tr class="app-row-no-items">
                                    <td class="guests-rows-empty" colspan="7">
                                        <span>No guests</span>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    @endforeach
                    @if(count($data['unassignGuest']) > 0)
                    <table class="app-guest-row-group guests-rows-group" style="margin-bottom:10px !important;">
                        <thead>
                            <tr class="guests-rows-head app-guests-group-title">
                                <td class="guests-rows-td guests-rows-nameBig" width="100%">
                                    Unassigned <span class="guests-rows-count app-guests-group-items-count">{{count($data['unassignGuest'])}}</span>
                                </td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data['unassignGuest'] as $glst)
                            <tr class="app-contact-row guests-rows-item searchDataFilter">
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
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
                <div class="defTabDivCls tabDiv2" @if($tab != '2') style="display:none;" @endif>
                    @foreach($data['menusCat'] as $mcat)
                    <table class="app-guest-row-group guests-rows-group" style="margin-bottom:10px !important;">
                        <thead>
                            <tr class="guests-rows-head app-guests-group-title">
                                <td class="guests-rows-td guests-rows-nameBig" width="100%">
                                    {{$mcat['title']}} <span class="guests-rows-count app-guests-group-items-count">{{count($mcat['guestData'])}}</span>
                                </td>
                            </tr>
                        </thead>
                        <tbody>
                            @php $groomNum = $brideNum = 0; @endphp
                            @if(count($mcat['guestData']) > 0)
                                @foreach($mcat['guestData'] as $glst)
                                <tr class="app-contact-row guests-rows-item searchDataFilter">
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
                                </tr>
                                @endforeach
                            @else
                                <tr class="app-row-no-items">
                                    <td class="guests-rows-empty" colspan="7">
                                        <span>No guests</span>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    @endforeach
                    @if(count($data['unassignMenu']) > 0)
                    <table class="app-guest-row-group guests-rows-group" style="margin-bottom:10px !important;">
                        <thead>
                            <tr class="guests-rows-head app-guests-group-title">
                                <td class="guests-rows-td guests-rows-nameBig" width="100%">
                                    Unassigned <span class="guests-rows-count app-guests-group-items-count">{{count($data['unassignMenu'])}}</span>
                                </td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data['unassignMenu'] as $glst)
                            <tr class="app-contact-row guests-rows-item searchDataFilter">
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
                                <td class="guests-rows-td guests-rows-nameBig" width="100%">
                                    {{$tcat->table_nm}} <span class="guests-rows-count app-guests-group-items-count">{{count($tcat['guestData'])}}</span>
                                </td>
                            </tr>
                        </thead>
                        <tbody>
                            @php $groomNum = $brideNum = 0; @endphp
                            @if(count($tcat['guestData']) > 0)
                                @foreach($tcat['guestData'] as $glst)
                                <tr class="app-contact-row guests-rows-item searchDataFilter">
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
                                </tr>
                                @endforeach
                            @else
                                <tr class="app-row-no-items">
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
                                <td class="guests-rows-td guests-rows-nameBig" width="100%">
                                    Unassigned <span class="guests-rows-count app-guests-group-items-count">{{count($data['unassignTable'])}}</span>
                                </td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data['unassignTable'] as $glst)
                            <tr class="app-contact-row guests-rows-item searchDataFilter">
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
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
                <div class="defTabDivCls tabDiv4" @if($tab != '4') style="display:none;" @endif>
                    @foreach($data['attendanceCat'] as $acat)
                    <table class="app-guest-row-group guests-rows-group" style="margin-bottom:10px !important;">
                        <thead>
                            <tr class="guests-rows-head app-guests-group-title">
                                <td class="guests-rows-td guests-rows-nameBig" width="100%">
                                    {{$acat['title']}} <span class="guests-rows-count app-guests-group-items-count">{{count($acat['guestData'])}}</span>
                                </td>
                            </tr>
                        </thead>
                        <tbody>
                            @php $groomNum = $brideNum = 0; @endphp
                            @if(count($acat['guestData']) > 0)
                                @foreach($acat['guestData'] as $glst)
                                <tr class="app-contact-row guests-rows-item searchDataFilter">
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
                                </tr>
                                @endforeach
                            @else
                                <tr class="app-row-no-items">
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
                    <table class="app-guest-row-group guests-rows-group" style="margin-bottom:10px !important;">
                        <thead>
                            <tr class="guests-rows-head app-guests-group-title">
                                <td class="guests-rows-td guests-rows-nameBig" width="100%">
                                    {{$lcat['title']}} <span class="guests-rows-count app-guests-group-items-count">{{count($lcat['guestData'])}}</span>
                                </td>
                            </tr>
                        </thead>
                        <tbody>
                            @php $groomNum = $brideNum = 0; @endphp
                            @if(count($lcat['guestData']) > 0)
                                @foreach($lcat['guestData'] as $glst)
                                <tr class="app-contact-row guests-rows-item searchDataFilter">
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
                                </tr>
                                @endforeach
                            @else
                                <tr class="app-row-no-items">
                                    <td class="guests-rows-empty" colspan="7">
                                        <span>No guests</span>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    @endforeach
                    @if(count($data['unassignList']) > 0)
                    <table class="app-guest-row-group guests-rows-group" style="margin-bottom:10px !important;">
                        <thead>
                            <tr class="guests-rows-head app-guests-group-title">
                                <td class="guests-rows-td guests-rows-nameBig" width="100%">
                                    Unassigned <span class="guests-rows-count app-guests-group-items-count">{{count($data['unassignList'])}}</span>
                                </td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data['unassignList'] as $glst)
                            <tr class="app-contact-row guests-rows-item searchDataFilter">
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
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
        </div>
    </form>
</div>
<div class="pure-u-3-5 app-contact-data-container">
    <div class="guest-detail-content">
        <div class="pure-g mb20">
            <div class="pure-u-5-7">
                <div class="pure-g">
                    <div class="pure-u-2-10">
                        <div class="guest-detail-avatar">
                            @if(@$data['editGuest'][0]->age_type == 'Adult' && @$data['editGuest'][0]->gender == 'Male')
                                <span id="iconToolsId" class="icon-tools icon-tools-men-medium"></span>
                            @elseif(@$data['editGuest'][0]->age_type == 'Child' && @$data['editGuest'][0]->gender == 'Male')
                                <span id="iconToolsId" class="icon-tools icon-tools-boy-medium"></span>
                            @elseif(@$data['editGuest'][0]->age_type == 'Adult' && @$data['editGuest'][0]->gender == 'Female')
                                <span id="iconToolsId" class="icon-tools icon-tools-woman-medium"></span>
                            @elseif(@$data['editGuest'][0]->age_type == 'Child' && @$data['editGuest'][0]->gender == 'Female')
                                <span id="iconToolsId" class="icon-tools icon-tools-girl-medium"></span>
                            @elseif(@$data['editGuest'][0]->age_type == 'Baby' && @$data['editGuest'][0]->gender != '')
                                <span id="iconToolsId" class="icon-tools icon-tools-child-medium"></span>
                            @elseif(@$data['editGuest'][0]->age_type == NULL && @$data['editGuest'][0]->gender == NULL)
                                <span id="iconToolsId" class="icon-tools icon-tools-adult-medium"></span>
                            @endif
                            @if(@$data['editGuest'][0]['companion'])
                            <span class="guest-detail-avatar-counter" @if(count(@$data['editGuest'][0]['companion']) == 0) style="display:none;" @endif>
                                @if(@$data['editGuest'][0]['companion']) +{{count(@$data['editGuest'][0]['companion'])}} @endif
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="pure-u-8-10">
                        <div class="pl10 pr10 pure-g">
                            <div class="pure-u-1-2">
                                <div class="input-group-line mr10">
                                    <label class="input-group-line-label">First name</label>
                                    <input onchange="editGuest(this.value,'firstname');" type="text" value="{{@$data['editGuest'][0]->firstname}}" placeholder="First name">
                                </div>
                            </div>
                            <div class="pure-u-1-2">
                                <div class="input-group-line ml10">
                                    <label class="input-group-line-label">Last Name</label>
                                    <input onchange="editGuest(this.value,'lastname');" type="text" value="{{@$data['editGuest'][0]->lastname}}" placeholder="Last Name">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pure-u-2-7 pl15">
                <div class="unit">
                    <div class="app-input-select input-select input-group-line app-contact-change">
                        <label class="input-group-line-label">Group</label>
                        <span class="app-input-label input-select-label input-filled" id="classGroups" onclick="get_groups('{{$idGuest}}');">
                            @if(@$data['editGuest'][0]->title) {{@$data['editGuest'][0]->title}} @else Select @endif
                        </span>
                        <div class="app-input-dropdown input-select-dropdown hideGroupChange groupChange{{$idGuest}}">
                            <ul>
                                @foreach($data['guestsCat'] as $gcat)
                                    <li onclick="editGuest('{{$gcat->id}}','group_id');">{{$gcat->title}}</li>
                                @endforeach
                                <li class="guests-rows-select-add" onclick="add_groups();">
                                    <i class="icon-tools icon-tools-plus-circle-medium icon-left"></i> Create group
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="pure-g mb20 ">
            <div class="pure-u-1-3">
                <div class="unit">
                    <label class="input-group-line-label">Gender</label>
                    <div class="select-switcher mt5 mr20">
                        <span onclick="editGuest('Male','gender');" class="select-switcher-section app-toogle-gender classMale @if(@$data['editGuest'][0]->gender == 'Male') active @endif" role="button">Male</span>
                        <span onclick="editGuest('Female','gender');" class="select-switcher-section app-toogle-gender classFemale @if(@$data['editGuest'][0]->gender == 'Female') active @endif" role="button">Female</span>
                    </div>
                    <input type="hidden" id="genderVal" value="{{@$data['editGuest'][0]->gender}}">
                </div>
            </div>
            <div class="pure-u-1-3">
                <div class="unit">
                    <label class="input-group-line-label">Age</label>
                    <div class="select-switcher mt5">
                        <span onclick="editGuest('Adult','age_type');" class="select-switcher-section app-toogle-age classAdult @if(@$data['editGuest'][0]->age_type == 'Adult') active @endif" role="button">Adult</span>
                        <span onclick="editGuest('Child','age_type');" class="select-switcher-section app-toogle-age classChild @if(@$data['editGuest'][0]->age_type == 'Child') active @endif" role="button">Child</span>
                        <span onclick="editGuest('Baby','age_type');" class="select-switcher-section app-toogle-age classBaby @if(@$data['editGuest'][0]->age_type == 'Baby') active @endif" role="button">Baby</span>
                    </div>
                    <input type="hidden" id="age_typeVal" value="{{@$data['editGuest'][0]->age_type}}">
                </div>
            </div>
            <div class="pure-u-1-3">
                <div class="unit">
                    <label class="input-group-line-label ml20">Need hotel</label>
                    <div class="select-switcher mt5 ml20">
                        <span onclick="editGuest('Yes','need_hotel');" class="select-switcher-section app-toogle-need-hotel classYes @if(@$data['editGuest'][0]->need_hotel == 'Yes') active @endif" role="button">Yes</span>
                        <span onclick="editGuest('No','need_hotel');" class="select-switcher-section app-toogle-need-hotel classNo @if(@$data['editGuest'][0]->need_hotel == 'No') active @endif" role="button">No</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="guestsNavCollapsed app-tools-guest-detail-nav">
            @foreach(@$data['editGuest'] as $enum => $gd)
                <span class="guests-rows-header-link pointer app-tools-guest-detail-change-event eventSpan{{$gd->event_id}} @if($gd->event_id == $idEvent) active @endif" onclick="getEventTab('{{$gd->event_id}}');">{{$gd->event_name}}</span>
            @endforeach
        </div>
        @foreach(@$data['editGuest'] as $enum => $gd)
            <div class="app-contact-sections-tools eventDiv{{$gd->event_id}} @if($gd->event_id != $idEvent) dnone @endif">
                <p class="guestsDetailTitle">{{$gd->event_name}}</p>
                <div class="pure-g row">
                    <div class="pure-u-1-4">
                        <label class="input-group-line-label" style="padding-left:10px;">Attendance</label>
                        <div class="app-input-select input-select unit input-group-line app-contact-detail-change" id="estatusHtml{{$gd->invId}}">
                            <span class="app-input-label input-select-label input-filled" onclick="get_estatus('{{$gd->invId}}');">
                                @if($gd->attendances == 'confirmed')
                                    <i class="icon-tools icon-tools-checkbox mr10"></i>Confirmed
                                @elseif($gd->attendances == 'pending')
                                    <i class="icon-tools icon-tools-clock-orange mr10"></i>Pending
                                @elseif($gd->attendances == 'cancelled')
                                    <i class="icon-tools icon-tools-times-red mr10"></i>Cancelled
                                @endif
                            </span>
                            <div class="app-input-dropdown input-select-dropdown hideeStatusChange estatusChange{{$gd->invId}}">
                                <ul>
                                    <li class="subtitle app-input-select-label ">
                                        @if($gd->attendances == 'confirmed')
                                            <i class="icon-tools icon-tools-checkbox mr10"></i>Confirmed
                                        @elseif($gd->attendances == 'pending')
                                            <i class="icon-tools icon-tools-clock-orange mr10"></i>Pending
                                        @elseif($gd->attendances == 'cancelled')
                                            <i class="icon-tools icon-tools-times-red mr10"></i>Cancelled
                                        @endif
                                    </li>
                                    <li @if($gd->attendances == 'pending') style="display:none;" @else onclick="change_invitation_status('{{$gd->invId}}','0');" @endif>
                                        <i class="icon-tools icon-tools-clock-orange mr10"></i>Pending
                                    </li>
                                    <li @if($gd->attendances == 'confirmed') style="display:none;" @else onclick="change_invitation_status('{{$gd->invId}}','1');" @endif>
                                        <i class="icon-tools icon-tools-checkbox mr10"></i>Confirmed
                                    </li>
                                    <li @if($gd->attendances == 'cancelled') style="display:none;" @else onclick="change_invitation_status('{{$gd->invId}}','2');" @endif>
                                        <i class="icon-tools icon-tools-times-red mr10"></i>Cancelled
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    @if($gd->eTable == 'Yes')
                    <div class="pure-u-1-4">
                        <div class="unit">
                            <label class="input-group-line-label">Table</label>
                            <div class="app-input-select input-select input-group-line app-contact-detail-change">
                                @if($gd->attendances == 'cancelled')
                                    <span class="app-guest-canceled tableSpan{{$gd->invId}}">Cancelled</span>
                                @else
                                    <span class="app-guest-canceled tableSpan{{$gd->invId}}" style="display:none;">Cancelled</span>
                                @endif
                                <div class="app-input-select input-select app-guest-update guests-rows-select" id="etablesHtml{{$gd->invId}}" @if($gd->attendances == 'cancelled') style="display:none;" @endif>
                                    <span class="app-input-label input-select-label input-filled" onclick="get_etables('{{$gd->invId}}');">
                                        @if($gd->table_nm){{$gd->table_nm.' ('.($gd->table_seat - $gd->guest_seat).')'}} @else Select @endif
                                    </span>
                                    <div class="app-input-dropdown input-select-dropdown hideeTablesChange etablesChange{{$gd->invId}}">
                                        <ul>
                                            @if($gd->table_nm)
                                            <li class="subtitle app-input-select-label ">{{$gd->table_nm.' ('.($gd->table_seat - $gd->guest_seat).')'}}</li>
                                            @endif
                                            @foreach($data['eventTable'] as $evt)
                                                @if($evt->table_seat - count($evt->seatdata) > 0)
                                                    <li @if($gd->tables == $evt->id) style="display:none;" @else onclick="change_invitation_tables('{{$gd->invId}}','{{$evt->id}}');" @endif>{{$evt->table_nm}} ({{($evt->table_seat - count($evt->seatdata))}})</li>
                                                @endif
                                            @endforeach
                                            <li class="guests-rows-select-add" onclick="window.location.href='{{url('tools/seating_chart').'?idEvent='.$idEvent}}';">
                                                <i class="icon-tools icon-tools-plus-circle-medium icon-left"></i>Add Table
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    @if($gd->eMenu == 'Yes')
                    <div class="pure-u-1-4">
                        <div class="unit">
                            <label class="input-group-line-label">Menu</label>
                            <div class="app-input-select input-select input-group-line app-contact-detail-change">
                                @if($gd->attendances == 'cancelled')
                                    <span class="app-guest-canceled menuSpan{{$gd->invId}}">Cancelled</span>
                                @else
                                    <span class="app-guest-canceled menuSpan{{$gd->invId}}" style="display:none;">Cancelled</span>
                                @endif
                                @php $eMenus = explode('--',$data['current_event']->menu_types); @endphp
                                <div class="app-input-select input-select app-guest-update guests-rows-select" id="emenusHtml{{$gd->invId}}" @if($gd->attendances == 'cancelled') style="display:none;" @endif>
                                    <span class="app-input-label input-select-label input-filled" onclick="get_emenus('{{$gd->invId}}');">
                                        @if($gd->menus && in_array($gd->menus,$eMenus)){{$gd->menus}} @else Select @endif
                                    </span>
                                    <div class="app-input-dropdown input-select-dropdown hideeMenusChange emenusChange{{$gd->invId}}">
                                        <ul>
                                            @if(in_array($gd->menus,$eMenus))
                                            <li class="subtitle app-input-select-label ">{{$gd->menus}}</li>
                                            @endif
                                            @for($em = 0; $em < count($eMenus); $em++)
                                                <li @if($gd->menus == $eMenus[$em]) style="display:none;" @else onclick="change_invitation_menus('{{$gd->invId}}','{{$eMenus[$em]}}');" @endif>{{$eMenus[$em]}}</li>
                                            @endfor
                                            <li class="guests-rows-select-add" onclick="get_newMenusModal('{{$gd->invId}}');">
                                                <i class="icon-tools icon-tools-plus-circle-medium icon-left"></i>Create Menu
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    @if($gd->eList == 'Yes')
                    <div class="pure-u-1-4">
                        <div class="unit">
                            <label class="input-group-line-label">List</label>
                            <div class="app-input-select input-select input-group-line app-contact-detail-change">
                                @if($gd->attendances == 'cancelled')
                                    <span class="app-guest-canceled listSpan{{$gd->invId}}">Cancelled</span>
                                @else
                                    <span class="app-guest-canceled listSpan{{$gd->invId}}" style="display:none;">Cancelled</span>
                                @endif
                                @php $eLists = explode('--',$data['current_event']->list_types); @endphp
                                <div class="app-input-select input-select app-guest-update guests-rows-select" id="elistsHtml{{$gd->invId}}" @if($gd->attendances == 'cancelled') style="display:none;" @endif>
                                    <span class="app-input-label input-select-label input-filled" onclick="get_elists('{{$gd->invId}}');">
                                        @if($gd->lists && in_array($gd->lists,$eLists)){{$gd->lists}} @else Select @endif
                                    </span>
                                    <div class="app-input-dropdown input-select-dropdown hideeListsChange elistsChange{{$gd->invId}}">
                                        <ul>
                                            @if(in_array($gd->lists,$eLists))
                                            <li class="subtitle app-input-select-label ">{{$gd->lists}}</li>
                                            @endif
                                            @for($em = 0; $em < count($eLists); $em++)
                                                <li @if($gd->lists == $eLists[$em]) style="display:none;" @else onclick="change_invitation_lists('{{$gd->invId}}','{{$eLists[$em]}}');" @endif>{{$eLists[$em]}}</li>
                                            @endfor
                                            <li class="guests-rows-select-add" onclick="get_newListsModal('{{$gd->invId}}');">
                                                <i class="icon-tools icon-tools-plus-circle-medium icon-left"></i>Add a List
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        @endforeach
        <hr class="guestsDetailSeparator">
        <p class="guestsDetailTitle">
            @if(@$data['editGuest'][0]->related_id != '')
                <p class="guestsDetailTitle">Plus one for</p>
            @else
                Companions <span class="guestsDetailTitle-counter app-tools-guest-acompanante-count">
                    @if(@$data['editGuest'][0]['companion']) @if(count(@$data['editGuest'][0]['companion']) > 0) {{count($data['editGuest'][0]['companion'])}} @endif @endif
                </span>
            @endif
        </p>
        <div class="pure-g row">
            @if(@$data['editGuest'][0]->related_id != '')
                <div class="pure-u-1-2 app-tools-guest-acompanante subCompanion{{$data['editGuest'][0]['rCompanion']->id}}">
                    <div class="unit">
                        @if(@$data['editGuest'][0]['rCompanion']->age_type == 'Adult' && @$data['editGuest'][0]['rCompanion']->gender == 'Male')
                            <span class="icon-tools icon-tools-men"></span>
                        @elseif(@$data['editGuest'][0]['rCompanion']->age_type == 'Child' && @$data['editGuest'][0]['rCompanion']->gender == 'Male')
                            <span class="icon-tools icon-tools-boy"></span>
                        @elseif(@$data['editGuest'][0]['rCompanion']->age_type == 'Adult' && @$data['editGuest'][0]['rCompanion']->gender == 'Female')
                            <span class="icon-tools icon-tools-woman"></span>
                        @elseif(@$data['editGuest'][0]['rCompanion']->age_type == 'Child' && @$data['editGuest'][0]['rCompanion']->gender == 'Female')
                            <span class="icon-tools icon-tools-girl"></span>
                        @elseif(@$data['editGuest'][0]['rCompanion']->age_type == 'Baby' && @$data['editGuest'][0]['rCompanion']->gender != '')
                            <span class="icon-tools icon-tools-child"></span>
                        @elseif(@$data['editGuest'][0]['rCompanion']->age_type == NULL && @$data['editGuest'][0]['rCompanion']->gender == NULL)
                            <span class="icon-tools icon-tools-adult"></span>
                        @endif
                        <p class="guest-related-info">
                            <a href="javascript:;" class="app-tools-guest-companion-name" onclick="reloadUrl('{{@$data['editGuest'][0]['rCompanion']->id}}');">
                                {{@$data['editGuest'][0]['rCompanion']->firstname.' '.@$data['editGuest'][0]['rCompanion']->lastname}}
                            </a>
                            <a class="guest-related-remove app-tools-guest-companion-delete" title="Remove as an accompanying guest" role="button" href="javascript:;" onclick="unlink_companion('{{$data['editGuest'][0]['rCompanion']->id}}','mainGuest');">
                                × Unlink
                            </a>
                        </p>
                    </div>
                </div>
            @elseif(@$data['editGuest'][0]['companion'])
                @if(count(@$data['editGuest'][0]['companion']) > 0)
                    @foreach($data['editGuest'][0]['companion'] as $relCamp)
                    <div class="pure-u-1-2 app-tools-guest-acompanante subCompanion{{$relCamp->id}}">
                        <div class="unit">
                            @if($relCamp->age_type == 'Adult' && $relCamp->gender == 'Male')
                                <span class="icon-tools icon-tools-men"></span>
                            @elseif($relCamp->age_type == 'Child' && $relCamp->gender == 'Male')
                                <span class="icon-tools icon-tools-boy"></span>
                            @elseif($relCamp->age_type == 'Adult' && $relCamp->gender == 'Female')
                                <span class="icon-tools icon-tools-woman"></span>
                            @elseif($relCamp->age_type == 'Child' && $relCamp->gender == 'Female')
                                <span class="icon-tools icon-tools-girl"></span>
                            @elseif($relCamp->age_type == 'Baby' && $relCamp->gender != '')
                                <span class="icon-tools icon-tools-child"></span>
                            @elseif($relCamp->age_type == NULL && $relCamp->gender == NULL)
                                <span class="icon-tools icon-tools-adult"></span>
                            @endif
                            <p class="guest-related-info">
                                <a href="javascript:;" class="app-tools-guest-companion-name" onclick="reloadUrl('{{$relCamp->id}}');">
                                    {{$relCamp->firstname.' '.$relCamp->lastname}}
                                </a>
                                <a class="guest-related-remove app-tools-guest-companion-delete" title="Remove as an accompanying guest" role="button" href="javascript:;" onclick="unlink_companion('{{$relCamp->id}}','compGuest');">
                                    × Unlink
                                </a>
                            </p>
                        </div>
                    </div>
                    @endforeach
                @endif
            @endif
        </div>
        <div class="guest-related app-tools-guest-add-acompanante mb50" @if(@$data['editGuest'][0]->related_id != '') style="display:none;" @endif>
            <a href="#" data-toggle="modal" data-target="#newCompanion-modal" role="button" class="link--primary">
                <i class="guest-related-icon icon-tools icon-tools-plus-circle-outline icon-left"></i> Add related guests or a plus one
            </a>
        </div>
        <div><p class="guestsDetailTitle">Contact Information</p></div>
        <div class="pure-g row mb20">
            <div class="pure-u-1-3">
                <div class="unit">
                    <div class="input-group-line">
                        <label class="input-group-line-label">Email</label>
                        <i class="icon-tools icon-tools-form-mail"></i>
                        <input onchange="editGuest(this.value,'email');" type="email" value="{{@$data['editGuest'][0]->email}}" placeholder="Add email-id">
                    </div>
                </div>
            </div>
            <div class="pure-u-1-3">
                <div class="unit">
                    <div class="input-group-line">
                        <label class="input-group-line-label">Phone number</label>
                        <i class="icon-tools icon-tools-form-phone"></i>
                        <input onchange="editGuest(this.value,'phone_no');" type="tlf" value="{{@$data['editGuest'][0]->phone_no}}" placeholder="Add Phone number">
                    </div>
                </div>
            </div>
            <div class="pure-u-1-3">
                <div class="unit">
                    <div class="input-group-line">
                        <label class="input-group-line-label">Mobile number</label>
                        <i class="icon-tools icon-tools-form-smartphone"></i>
                        <input onchange="editGuest(this.value,'mobile_no');" type="tlf" value="{{@$data['editGuest'][0]->mobile_no}}" placeholder="Add Mobile number">
                    </div>
                </div>
            </div>
            <div class="pure-u-1-3">
                <div class="unit">
                    <div class="input-group-line">
                        <label class="input-group-line-label">Address</label>
                        <i class="icon-tools icon-tools-form-address"></i>
                        <input onchange="editGuest(this.value,'address');" type="text" value="{{@$data['editGuest'][0]->address}}" placeholder="Add address">
                    </div>
                </div>
            </div>
            <div class="pure-u-1-3 app-suggest-location-container">
                <div class="unit">
                    <div class="input-group-line">
                        <label class="input-group-line-label">City/Town</label>
                        <input onchange="editGuest(this.value,'city_town');" type="text" value="{{@$data['editGuest'][0]->city_town}}" placeholder="Add town/city">
                    </div>
                </div>
            </div>
            <div class="pure-u-1-3 app-suggest-location-container">
                <div class="unit">
                    <div class="app-input-select input-select input-group-line">
                        <label class="input-group-line-label">Country</label>
                        <select class="app-contact-form-country-selector-edit app-contact-form-country-selector" name="country">
                            <option>Canada</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="pure-u-1-3">
                <div class="unit">
                    <div class="input-group-line">
                        <label class="input-group-line-label">Postal Code</label>
                        <i class="icon-tools icon-tools-form-address"></i>
                        <input onchange="editGuest(this.value,'postal_code');" type="text" value="{{@$data['editGuest'][0]->postal_code}}" placeholder="Add zip code">
                    </div>
                </div>
            </div>
            <div class="pure-u-1-3">
                <div class="unit">
                    <!-- <label class="input-group-line-label">Invitation</label>
                    <p class="mt10">
                        <span><i class="icon-tools icon-tools-checkbox-green-small mr10"></i>Sent invitation</span>
                    </p> -->
                </div>
            </div>
        </div>
        <div class="pure-g row">
            <div class="pure-u-1">
                <div class="unit">
                    <div class="input-group-line">
                        <label class="input-group-line-label">Notes</label>
                        <textarea onchange="editGuest(this.value,'note');" class="app-contact-form-comments" rows="4" placeholder="Add note">{!! @$data['editGuest'][0]->note !!}</textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>