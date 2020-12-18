@extends('layouts.default')
@section('meta_title','Perfect Wedding | Seating Chart')
@section('meta_keyword','Perfect Wedding | Seating Chart')
@section('meta_description','Perfect Wedding | Seating Chart')
@section('content')
@include('includes.menu')
<?php
    $idEvent = @Request::get('idEvent') ? : '';
?>
<section class="section-padding dashboard-wrap">
    @include('tools.tools_nav') 
    <div class="wrapper-tools-tables ">
        <span class="tools-tables-left-uncollapse app-tools-grid-menu-open" id="showdiv">
            <i class="icon-tools-seating icon-tools-double-arrow-right icon-left"></i>Menu
        </span>
        <div id="app-tools-grid-menu" class="tools-tables-left ">
            <div>
                <a href="#" id="hide">
                    <span class="tools-tables-left-collapse app-tools-grid-menu-close">
                        <i class="icon-tools-seating icon-tools-double-arrow-left icon-left"></i>Hide
                    </span>
                </a>
            </div>
            <div class="tools-tables-left-content separator">
                <p class="tools-tables-left-title add_table_wrp">Add table</p>
                <div class="pure-g mt20 va-flex-middle">
                    <div class="pure-u-1-5 text-center">
                        <a rel="nofollow" class="inline-block app-icon-hover tabelmodelshow" data-icon-new="icon-tools-table-3-active" data-icon-old="icon-tools-table-3" role="button" data-type="2side"  href="javascript:;">
                            <i class="app-create-table icon-tools-seating icon-tools-table-3 pointer text-center ui-draggable" data-type="2side"></i>
                        </a>
                    </div>
                    <div class="pure-u-1-5 text-center">
                        <a rel="nofollow" class="inline-block app-icon-hover tabelmodelshow" data-icon-new="icon-tools-table-2-active" data-icon-old="icon-tools-table-2" role="button" data-toggle="modal" data-type="1side" href="javascript:;">
                            <i class="app-create-table icon-tools-seating icon-tools-table-2 pointer text-center ui-draggable" data-type="1side"></i>
                        </a>
                    </div>
                    <div class="pure-u-1-5 text-center">
                        <a rel="nofollow" class="inline-block app-icon-hover tabelmodelshow" data-icon-new="icon-tools-table-1-active" data-icon-old="icon-tools-table-1" role="button" data-toggle="modal" data-type="round2" href="javascript:;">
                            <i class="app-create-table icon-tools-seating pointer text-center ui-draggable icon-tools-table-1" data-type="round2"></i>
                        </a>
                    </div>
                     <div class="pure-u-1-5 text-center">
                        <a rel="nofollow" class="inline-block app-icon-hover tabelmodelshow" data-icon-new="icon-tools-table-4-active" data-icon-old="icon-tools-table-4" role="button"  data-toggle="modal" data-type="square" href="javascript:;">
                            <i class="app-create-table icon-tools-seating icon-tools-table-4 pointer text-center ui-draggable" data-type="square"></i>
                        </a>
                    </div>
                    <div class="pure-u-1-5 text-center">
                        <a rel="nofollow" class="inline-block app-icon-hover othertablemodelshow" data-icon-new="icon-tools-table-5-active" data-icon-old="icon-tools-table-5" role="button" data-toggle="modal" href="javascript:;">
                            <i class="app-create-table icon-tools-seating icon-tools-table-5 pointer text-center ui-draggable" data-type="noSeats"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="tools-tables-left-content pb0">
                <div class="flex">
                    <p class="tools-tables-left-title add_table_wrp">Guests</p>
                    <div class="tools-tables-left-switch">
                        <span class="app-pending-seat pointer" data-pending="0">All</span> |
                        <span class="app-pending-seat pointer current" data-pending="1">Pending</span>
                    </div>
                </div>
                <div class="app-tools-guest-assign mt10 mb20 flex" data-target="#tool-modal" data-toggle="modal" role="button">
                    <button class="btn-flat red tools-tables-left-content-addGuest add_guest_head" data-toggle="modal" data-target="#myModal">Add guest</button>
                </div>
                <div class="app-tools-guest-add mt10 mb20 flex" data-target="#tool-modal" data-toggle="modal" role="button" style="display: none;"></div>
                <div class="tools-tables-leftSearch">
                    <i class="icon-tools-seating icon-tools-search"></i>
                    <input class="app-tables-guest-search search_guest" placeholder="Search guests" id="keyword">
                </div>
            </div>
            <div class="tools-tables-left-content">
                <div class="tools-tables-left-guests app-tables-guest-list">
                    <div id="guestnew"></div>
                    @if(!empty($data['guestListData']))
                    <div id="guestlist">
                        @php $guestCountNum = 0; @endphp
                        @foreach($data['guestListData'] as $liss)
                            @if(count($liss->guestsData) > 0)
                            @php $guestCountNum++; @endphp
                            <div class="app-tools-tables-group" id="guestlistShow">
                                <p class="app-tools-tables-group-title tools-tables-left-guests-family-title">{{$liss['title']}}</p>
                                <ul class="app-tools-tables-group-family tools-tables-left-guests-family searchDataFilter" id="content">
                                    @foreach($liss->guestsData as $gd)
                                    <a id="editguest{{$gd['guestId']}}" onclick="editguest({{$gd['guestId']}});">
                                        <li data-position="0" data-idcontact="{{$gd['guestId']}}" data-proxy="guestProxyBoy" data-grupo="{{$gd['group_id']}}" data-nombre="{{$gd['firstname'].' '.$gd['lastname']}}" data-apellidos="{{$gd['firstname'].' '.$gd['lastname']}}" data-seat-id="@if($gd['event_id'] == $idEvent){{ $gd['seat_id'] }}@endif" id="i{{$gd['guestId']}}" class="app-tables-persona app-tables-persona-list tools-tables-left-guests-item ui-draggable" @if(isset($gd['seat_id']) && $gd['event_id'] == $idEvent) style="display:none" @endif >
                                            <span class="app-tables-guest-name tools-tables-left-guests-name parent @if(isset($gd['seat_id']) && $gd['event_id'] == $idEvent) marked-text @endif">{{$gd['firstname'].' '.$gd['lastname']}}</span>
                                            @php $iconType = ''; @endphp
                                            @if( $gd['age_type'] == 'Adult' &&  $gd['gender'] == 'Male' )
                                                @php $iconType = 'groom'; @endphp
                                            @endif
                                            @if( $gd['age_type'] == 'Adult' &&  $gd['gender'] == 'Female' )
                                                @php $iconType = 'bride'; @endphp
                                            @endif
                                            @if( $gd['age_type'] == 'Child' &&  $gd['gender'] == 'Male' )
                                                @php $iconType = 'boy'; @endphp
                                            @endif
                                            @if( $gd['age_type'] == 'Child' &&  $gd['gender'] == 'Female' )
                                                @php $iconType = 'girl'; @endphp
                                            @endif
                                            @if( $gd['age_type'] == 'Baby' &&  $gd['gender'] == 'Male' )
                                                @php $iconType = 'child'; @endphp
                                            @endif
                                            @if( $gd['age_type'] == 'Baby' &&  $gd['gender'] == 'Female' )
                                                @php $iconType = 'child'; @endphp
                                            @endif
                                            @if( $gd['age_type'] == '' &&  $gd['gender'] == '' )
                                                @php $iconType = 'adult'; @endphp
                                            @endif
                                            @if( $gd['age_type'] == 'Not defined' &&  $gd['gender'] == '' )
                                                @php $iconType = 'adult'; @endphp
                                            @endif
                                            @if(isset($gd['seat_id']) && $gd['event_id'] == $idEvent)
                                                <i icontype="{{$iconType}}" class="app-tables-guest-icon icon-tools-seating fright relative icon-tools-guest-dropped dropped"></i>
                                            @else
                                                <i icontype="{{$iconType}}" class="app-tables-guest-icon icon-tools-seating fright relative icon-tools-{{ $iconType }}-small"></i>
                                            @endif
                                        </li>
                                    </a>
                                    <input type="hidden" name="guestid" id="guestid" value="{{$gd['guestId']}}">
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                        @endforeach
                        @if(count($data['unassignListData']) > 0)
                            @php $guestCountNum++; @endphp
                            <div class="app-tools-tables-group" id="guestlistShow">
                                <p class="app-tools-tables-group-title tools-tables-left-guests-family-title">Unassigned</p>
                                <ul class="app-tools-tables-group-family tools-tables-left-guests-family searchDataFilter" id="content">
                                    @foreach($data['unassignListData'] as $unls)
                                    <a id="editguest{{$unls['guestId']}}" onclick="editguest({{$unls['guestId']}});">
                                        <li data-position="0" data-idcontact="{{$unls['guestId']}}" data-proxy="guestProxyBoy" data-grupo="{{$unls['group_id']}}" data-nombre="{{$unls['firstname'].' '.$unls['lastname']}}" data-apellidos="{{$unls['firstname'].' '.$unls['lastname']}}" data-seat-id="@if($unls['event_id'] == $idEvent){{ $unls['seat_id'] }}@endif" id="i{{$unls['guestId']}}" class="app-tables-persona app-tables-persona-list tools-tables-left-guests-item ui-draggable" @if(isset($unls['seat_id']) && $unls['event_id'] == $idEvent) style="display:none" @endif >
                                            <span class="app-tables-guest-name tools-tables-left-guests-name parent @if(isset($unls['seat_id']) && $unls['event_id'] == $idEvent) marked-text @endif">{{$unls['firstname'].' '.$unls['lastname']}}</span>
                                            @php $iconType = ''; @endphp
                                            @if( $unls['age_type'] == 'Adult' &&  $unls['gender'] == 'Male' )
                                                @php $iconType = 'groom'; @endphp
                                            @endif
                                            @if( $unls['age_type'] == 'Adult' &&  $unls['gender'] == 'Female' )
                                                @php $iconType = 'bride'; @endphp
                                            @endif
                                            @if( $unls['age_type'] == 'Child' &&  $unls['gender'] == 'Male' )
                                                @php $iconType = 'boy'; @endphp
                                            @endif
                                            @if( $unls['age_type'] == 'Child' &&  $unls['gender'] == 'Female' )
                                                @php $iconType = 'girl'; @endphp
                                            @endif
                                            @if( $unls['age_type'] == 'Baby' &&  $unls['gender'] == 'Male' )
                                                @php $iconType = 'child'; @endphp
                                            @endif
                                            @if( $unls['age_type'] == 'Baby' &&  $unls['gender'] == 'Female' )
                                                @php $iconType = 'child'; @endphp
                                            @endif
                                            @if( $unls['age_type'] == '' &&  $unls['gender'] == '' )
                                                @php $iconType = 'adult'; @endphp
                                            @endif
                                            @if( $unls['age_type'] == 'Not defined' &&  $unls['gender'] == '' )
                                                @php $iconType = 'adult'; @endphp
                                            @endif
                                            @if(isset($unls['seat_id']) && $unls['event_id'] == $idEvent)
                                                <i icontype="{{$iconType}}" class="app-tables-guest-icon icon-tools-seating fright relative icon-tools-guest-dropped dropped"></i>
                                            @else
                                                <i icontype="{{$iconType}}" class="app-tables-guest-icon icon-tools-seating fright relative icon-tools-{{ $iconType }}-small"></i>
                                            @endif
                                        </li>
                                    </a>
                                    <input type="hidden" name="guestid" id="guestid" value="{{$unls['guestId']}}">
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if($guestCountNum == 0)
                        <div id="app-zero-persona" >
                            <div class="tools-tables-guests-empty">
                                <strong>No guests found</strong>
                                <p>First add guests, then click and drag to a table</p>
                            </div>
                        </div>
                        @endif
                    </div>
                    @endif
                </div>
            </div>
        </div> <!-- End app-tools-grid-menu -->
        <div class="tools-tables-right-content">
            <div class="wrapper-tables-header-buttons main">
                <div class="input-group tools-toggle icon icon-arrow-down">
                    <select class="event-select app-multi-event" name="idEvent" onchange="change_eventName();">
                        @foreach($data['guestsEvent'] as $ge)
                            <option value="{{$ge->id}}" @if($ge->id == $idEvent) selected @endif>{{$ge->event_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="tools-toggle">
                    <a class="tools-toggle-item active wedd_head" href="{{url('tools/seating_chart').'?idEvent='.$idEvent}}">Chart</a>
                    <a class="tools-toggle-item " href="{{url('tools/seating_list').'?idEvent='.$idEvent}}">List</a>
                </div>
                <div class="tools-toggle">
                    <a href="{{url('tools/chart_PDF').'?idEvent='.$idEvent}}" style="display: inline-block;"><span class="app-open-layer-pdf tools-toggle-item" data-section="main"><i class="icon-tools-seating icon-tools-download icon-left"></i>PDF</span></a>
                </div>
            </div>
            @if(count($data['tableChart']) > 0 )
            <div class="app-tables-viewbox tools-tables-viewbox ui-resizable ui-droppable" style="height: {{ $data['chartablelist'][0]->tbl_height  }}px; width: {{ $data['chartablelist'][0]->tbl_width  }}px;">
            @else
            <div class="app-tables-viewbox tools-tables-viewbox ui-resizable ui-droppable" style="height: 450px; width: 450px;">
            @endif
                <div class="app-tables-content tools-tables-content" id="tablelist">
                    @if(count($data['tableChart']) > 0 )
                        @foreach($data['tableChart'] as $tablechart)
                            @if($tablechart->table_type == '2side')
                                <div id="table_{{$tablechart->id}}" class="app-mesa-item tools-tables-gridItem ui-draggable ui-droppable" style="position: absolute; visibility: visible; top: {{$tablechart->posY}}px; left: {{$tablechart->posX}}px;" data-invitados="" data-numchairs="{{$tablechart->table_seat}}" data-type="{{$tablechart->table_type}}" data-name="{{$tablechart->table_nm}}" data-posx="{{$tablechart->posX}}" data-posy="{{$tablechart->posY}}">
                                    <div class="tools-tables-gridItem-settings app-table-settings" style="display: none;">
                                        <div class="app-table-remove mb15" data-id="table_{{$tablechart->id}}">
                                            <i class="icon-tools-seating icon-tools-tables-trash"></i>
                                            <i class="icon-tools-seating icon-tools-tables-trash-hover dnone"></i>
                                        </div>
                                        <div class="app-table-edit mb15" data-id="table_{{$tablechart->id}}">
                                            <i class="icon-tools-seating icon-tools-tables-edit"></i>
                                            <i class="icon-tools-seating icon-tools-tables-edit-hover dnone"></i>
                                        </div>
                                    </div>
                                    <div style="height:34px; margin-bottom:-4px;">
                                        @for ( $i = 0; $i < $tablechart->top_seat; $i++)
                                            <div style="margin: 0 7px; float:left;" class="app-table-seat tools-tables-gridItem-seat ui-droppable" id="table_{{$tablechart->id}}_s{{$i}}" tbl-id="{{$tablechart->id}}">
                                                @foreach($tablechart['seatdata'] as $seat)
                                                    @php $seatID = 'table_'.$tablechart->id.'_s'.$i; @endphp
                                                    @if($seat->seat_id == $seatID)
                                                        {!! $seat->seat_gust_html !!}
                                                    @endif
                                                @endforeach
                                            </div>
                                        @endfor
                                    </div>
                                    <div class="tools-tables-gridItem-table tools-tables-gridItem-square" style="height:50px;width:{{$tablechart->table_width}}px;"> 
                                        <div class="tools-tables-gridItem-squareLabel" id="">&nbsp; {{$tablechart->table_nm}} &nbsp;</div>
                                    </div>
                                    <div style="height:34px; margin-top:-4px;">
                                        @for ( $j = 0; $j < $tablechart->bottom_seat; $j++)
                                            @php  $styleMargin = '';
                                            if($tablechart->top_seat > $tablechart->bottom_seat && $j== 0) {
                                                $styleMargin = '0 7px 0 32px';
                                            } else {
                                                $styleMargin = '0 7px';
                                            }
                                            @endphp
                                            <div style="margin: {{$styleMargin}}; float:left;" class="app-table-seat tools-tables-gridItem-seat ui-droppable" id="table_{{$tablechart->id}}_s{{$i}}" tbl-id="{{$tablechart->id}}">
                                                @foreach($tablechart['seatdata'] as $seat)
                                                    @php $seatID = 'table_'.$tablechart->id.'_s'.$i; @endphp
                                                    @if($seat->seat_id == $seatID)
                                                        {!! $seat->seat_gust_html !!}
                                                    @endif
                                                @endforeach
                                            </div>
                                            @php $i++; @endphp
                                        @endfor
                                    </div>
                                </div>
                            @endif
                            @if($tablechart->table_type == '1side')
                                <div id="table_{{$tablechart->id}}" class="app-mesa-item tools-tables-gridItem  ui-draggable ui-droppable" style="position: absolute; visibility: visible; top: {{$tablechart->posY}}px; left: {{$tablechart->posX}}px;" data-invitados="" data-numchairs="{{$tablechart->table_seat}}" data-type="{{$tablechart->table_type}}" data-name="{{$tablechart->table_nm}}" data-posx="{{$tablechart->posX}}" data-posy="{{$tablechart->posY}}">
                                    <div class="tools-tables-gridItem-settings app-table-settings" style="display: none;">
                                        <div class="app-table-remove mb15" data-id="table_{{$tablechart->id}}">
                                            <i class="icon-tools-seating icon-tools-tables-trash"></i>
                                            <i class="icon-tools-seating icon-tools-tables-trash-hover dnone"></i>
                                        </div>
                                        <div class="app-table-edit mb15" data-id="table_{{$tablechart->id}}">
                                            <i class="icon-tools-seating icon-tools-tables-edit"></i>
                                            <i class="icon-tools-seating icon-tools-tables-edit-hover dnone"></i>
                                        </div>
                                    </div>
                                    <div style="height:34px; margin-bottom:-4px;">
                                        @for ( $i = 0; $i < $tablechart->top_seat; $i++)
                                            <div style="margin: 0 7px; float:left;" class="app-table-seat tools-tables-gridItem-seat ui-droppable" id="table_{{$tablechart->id}}_s{{$i}}" tbl-id="{{$tablechart->id}}">
                                                @foreach($tablechart['seatdata'] as $seat)
                                                    @php $seatID = 'table_'.$tablechart->id.'_s'.$i; @endphp
                                                    @if($seat->seat_id == $seatID)
                                                        {!! $seat->seat_gust_html !!}
                                                    @endif
                                                @endforeach
                                            </div>
                                        @endfor
                                    </div>
                                    <div class="tools-tables-gridItem-table tools-tables-gridItem-square" style="height:50px;width:{{$tablechart->table_width}}px;"> 
                                        <div class="tools-tables-gridItem-squareLabel" id="">&nbsp; {{$tablechart->table_nm}} &nbsp;</div>
                                    </div>
                                </div>
                            @endif
                            @if($tablechart->table_type == 'round2')
                                <div class="app-mesa-item tools-tables-gridItem ui-draggable ui-droppable" id="table_{{$tablechart->id}}" style="width: {{$tablechart->table_width}}px; height: {{$tablechart->table_width}}px; position: absolute; visibility: visible; top: {{$tablechart->posY}}px; left: {{$tablechart->posX}}px;" data-invitados="" data-numchairs="{{$tablechart->table_seat}}" data-type="{{$tablechart->table_type}}" data-name="{{$tablechart->table_nm}}" data-posx="{{$tablechart->posX}}" data-posy="{{$tablechart->posY}}">
                                    <div class="tools-tables-gridItem-table tools-tables-gridItem-circle" style="z-index: -1">
                                        <div class="tools-tables-gridItem-circleLabel" id="table_{{$tablechart->id}}">{{$tablechart->table_nm}}</div>
                                    </div>
                                    @php $seatAngle = 270; @endphp
                                    @for ( $i = 0; $i < $tablechart->table_seat; $i++)
                                        <div id="table_{{$tablechart->id}}_s{{$i}}" tbl-id="{{$tablechart->id}}" class="app-table-seat tools-tables-gridItem-seat ui-droppable" style="position: absolute; top: calc(50% - 17.5px); left: calc(50% - 17.5px); z-index: 1; transform: rotate({{ $seatAngle }}deg) translate({{$tablechart->circle_tansform}}px) rotate(-{{$seatAngle}}deg);">
                                            @foreach($tablechart['seatdata'] as $seat)
                                                @php $seatID = 'table_'.$tablechart->id.'_s'.$i; @endphp
                                                @if($seat->seat_id == $seatID)
                                                    {!! $seat->seat_gust_html !!}
                                                @endif
                                            @endforeach
                                        </div>
                                        @php $seatAngle = $seatAngle + $tablechart->circle_angle;
                                            if($seatAngle > 360) {
                                                $seatAngle = $seatAngle - 360;
                                            }elseif($seatAngle == 360) {
                                                $seatAngle = 0;
                                            }
                                        @endphp
                                    @endfor
                                    <div class="tools-tables-gridItem-settings app-table-settings" style="display: none;">
                                        <div class="app-table-remove mb15" data-id="table_{{$tablechart->id}}">
                                            <i class="icon-tools-seating icon-tools-tables-trash"></i>
                                            <i class="icon-tools-seating icon-tools-tables-trash-hover dnone"></i>
                                        </div>
                                        <div class="app-table-edit mb15" data-id="table_{{$tablechart->id}}">
                                            <i class="icon-tools-seating icon-tools-tables-edit"></i>
                                            <i class="icon-tools-seating icon-tools-tables-edit-hover dnone"></i>
                                        </div>
                                    </div>
                                </div> <!-- End round Table -->
                            @endif
                            @if($tablechart->table_type == 'square')
                                <div id="table_{{$tablechart->id}}" class="app-mesa-item tools-tables-gridItem flexItem ui-draggable ui-droppable" style="position: absolute; visibility: visible; top: {{$tablechart->posY}}px; left: {{$tablechart->posX}}px;" data-invitados="" data-numchairs="{{$tablechart->table_seat}}" data-type="{{$tablechart->table_type}}" data-name="{{$tablechart->table_nm}}" data-posx="{{$tablechart->posX}}" data-posy="{{$tablechart->posY}}">
                                    <div class="tools-tables-gridItem-settings app-table-settings" style="display: none;">
                                        <div class="app-table-remove mb15" data-id="table_{{$tablechart->id}}">
                                            <i class="icon-tools-seating icon-tools-tables-trash"></i>
                                            <i class="icon-tools-seating icon-tools-tables-trash-hover dnone"></i>
                                        </div>
                                        <div class="app-table-edit mb15" data-id="table_{{$tablechart->id}}">
                                            <i class="icon-tools-seating icon-tools-tables-edit"></i>
                                            <i class="icon-tools-seating icon-tools-tables-edit-hover dnone"></i>
                                        </div>
                                    </div>
                                    <div class="tools-tables-gridItem-topSide">
                                        @php $i = 1;
                                        while ( $i <= $tablechart->top_seat ) { @endphp
                                            <div class="app-table-seat tools-tables-gridItem-seat seatX ui-droppable" id="table_{{$tablechart->id}}_s{{$i}}" tbl-id="{{$tablechart->id}}">
                                                @foreach($tablechart['seatdata'] as $seat)
                                                    @php $seatID = 'table_'.$tablechart->id.'_s'.$i; @endphp
                                                    @if($seat->seat_id == $seatID)
                                                        {!! $seat->seat_gust_html !!}
                                                    @endif
                                                @endforeach
                                            </div>
                                        @php $i++;
                                        } @endphp
                                    </div>
                                    <div class="flex">
                                        <div class="tools-tables-gridItem-lateralSide leftSide">
                                            @php $j = 1;
                                            while ( $j <= $tablechart->left_seat ) { @endphp
                                                <div class="app-table-seat tools-tables-gridItem-seat seatY ui-droppable" id="table_{{$tablechart->id}}_s{{$i}}" tbl-id="{{$tablechart->id}}">
                                                    @foreach($tablechart['seatdata'] as $seat)
                                                        @php $seatID = 'table_'.$tablechart->id.'_s'.$i; @endphp
                                                        @if($seat->seat_id == $seatID)
                                                            {!! $seat->seat_gust_html !!}
                                                        @endif
                                                    @endforeach
                                                </div>
                                            @php $j++; $i++;
                                            } @endphp
                                        </div>
                                        <div class="tools-tables-gridItem-table tools-tables-gridItem-square flex-va-center" style="height:{{$tablechart->table_width}}px; width:{{$tablechart->table_width}}px;">
                                            <div class="tools-tables-gridItem-squareLabel" id="table_{{$tablechart->id}}_label">{{$tablechart->table_nm}}</div>
                                        </div>
                                        <div class="tools-tables-gridItem-lateralSide rightSide">
                                            @php $k = 1;
                                            while ( $k <= $tablechart->right_seat ) { @endphp
                                                <div class="app-table-seat tools-tables-gridItem-seat seatY ui-droppable" id="table_{{$tablechart->id}}_s{{$i}}" tbl-id="{{$tablechart->id}}">
                                                    @foreach($tablechart['seatdata'] as $seat)
                                                        @php $seatID = 'table_'.$tablechart->id.'_s'.$i; @endphp
                                                        @if($seat->seat_id == $seatID)
                                                            {!! $seat->seat_gust_html !!}
                                                        @endif
                                                    @endforeach
                                                </div>
                                            @php  $k++; $i++;
                                            } @endphp
                                        </div>
                                    </div>
                                    <div class="tools-tables-gridItem-bottomSide">
                                        @php $l = 1;
                                        while ( $l <= $tablechart->bottom_seat ) { @endphp
                                            <div class="app-table-seat tools-tables-gridItem-seat seatX ui-droppable" id="table_{{$tablechart->id}}_s{{$i}}" tbl-id="{{$tablechart->id}}">
                                                @foreach($tablechart['seatdata'] as $seat)
                                                    @php $seatID = 'table_'.$tablechart->id.'_s'.$i; @endphp
                                                    @if($seat->seat_id == $seatID)
                                                        {!! $seat->seat_gust_html !!}
                                                    @endif
                                                @endforeach
                                            </div>
                                        @php  $l++; $i++;
                                        } @endphp
                                    </div>
                                </div>
                            @endif
                            @if($tablechart->table_type == 'noSeats')
                                <div id="table_{{$tablechart->id}}" class="app-mesa-item tools-tables-gridItem flexItem ui-draggable ui-droppable" style="position: absolute; visibility: visible; top: {{$tablechart->posY}}px; left: {{$tablechart->posX}}px;" data-invitados="" data-numchairs="{{$tablechart->table_seat}}" data-type="noSeats" data-name="{{$tablechart->table_nm}}" data-posx="{{$tablechart->posX}}" data-posy="{{$tablechart->posY}}">
                                    <div class="tools-tables-gridItem-settings app-table-settings" style="display: none;">
                                        <div class="app-table-remove mb15" data-id="table_{{$tablechart->id}}">
                                            <i class="icon-tools-seating icon-tools-tables-trash"></i>
                                            <i class="icon-tools-seating icon-tools-tables-trash-hover dnone"></i>
                                        </div>
                                        <div class="app-table-edit mb15" data-id="table_{{$tablechart->id}}">
                                            <i class="icon-tools-seating icon-tools-tables-edit"></i>
                                            <i class="icon-tools-seating icon-tools-tables-edit-hover dnone"></i>
                                        </div>
                                    </div>
                                    @php $tblWidth = $tablechart->table_width; @endphp
                                    @if( $tblWidth == 50 )
                                        @php $tblWidth = ''; @endphp
                                    @endif
                                    <div class="flex">
                                        <div class="tools-tables-gridItem-table tools-tables-gridItem-square flex-va-center" style="height:{{$tblWidth}}px; width:{{$tblWidth}}px;">
                                            <div class="tools-tables-gridItem-squareLabel" id="table_{{$tablechart->id}}_label">{{$tablechart->table_nm}}</div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endif
                    <!-- <div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se" style="z-index: 90;"></div> -->
                </div>
                <div id="app-container-data" class="dnone"></div>
                <div class="ui-resizable-handle ui-resizable-e" style="z-index: 90; display: block;"></div>
                <div class="ui-resizable-handle ui-resizable-s" style="z-index: 90; display: block;"></div>
            </div>
        </div>
        <!-- Modal for Add a guest to Wedding -->
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-dialog modal-dialog-assignGuest">
                    <div class="modal-content modal-assignGuest">
                        <div class="modal-header modal-headerTools guest_tools_wrp">
                            <button type="button" class="close icon icon-close-grey" data-dismiss="modal"></button>
                            <p class="modal-headerTools-title">Add a guest to Wedding</p>
                        </div>
                        <div class="modal-body guest_popup_wrp">
                            <div class="p20">
                                <p>There are no contacts to select.</p>
                                <span><a class="app-guest-assign-modal link--primary add_new_guest" id="addnew" data-toggle="modal" href="#newGuests-modal">Add new guest</a></span>
                            </div>
                        </div>
                        <div class="modal-assignGuest-footer"></div>
                    </div>
                </div>
            </div>
        </div>
        @include('includes.guests.add_guest_modal')
        @include('includes.guests.edit_guest_modal')
        <!--table create modal-->
        <div class="modal fade" id="tableadd" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content modalAddTable">
                    <div class="modal-header modal-headerTools">
                        <button type="button" class="close" data-dismiss="modal">×</button>
                        <p class="modal-headerTools-title">Add table</p>
                    </div>
                    <form name="frmTableModif" id="creattable" action="" method="post">
                        <div class="modalAddTable__content">
                            <input id="idEvents" type="hidden" name="idEvents" value="{{$idEvent}}">
                            <input id="TableType" type="hidden" name="TableType" value="">
                            <input type="hidden" name="idMesa" value="">
                            <input id="posX" type="hidden" name="posX" value="0">
                            <input id="posY" type="hidden" name="posY" value="0">
                            <input type="hidden" name="minChairs" value="2">
                            <input type="hidden" name="maxChairs" value="100">
                            <div class="pure-g">
                                <div class="pure-u-1-4">
                                    <span class="icon-replace"><i class="icon-tools-seating icon-tools-table-2side"></i></span>
                                </div>
                                <div class="pure-u-3-4">
                                    <div class="input-group-line">
                                        <span class="input-group-line-label">Table name</span>
                                        <input id="TableName" name="TableName" type="text" value="" placeholder="Table name" data-msgerror="You must select a name." required="">
                                        <div class="app-message-error input-group-label-error dnone" data-name="undefined" style="display: none;"></div>
                                    </div>
                                    <div class="input-group-line input-group-naked">
                                        <span class="input-group-line-label">No. chairs</span>
                                        <div class="mt5 seatinput-wrr">
                                            <span class="ui-spinner ui-widget ui-widget-content ui-corner-all"><input id="seatinput" class="spinner ui-spinner-input" name="TableSeats" type="number" min="2" max="100" value="8" aria-valuemin="2" aria-valuemax="100" aria-valuenow="8" autocomplete="off" role="spinbutton"><a class="ui-spinner-button ui-spinner-up ui-corner-tr ui-button ui-widget ui-state-default ui-button-text-only" tabindex="-1" role="button" aria-disabled="false"><span class="ui-button-text"><span class="ui-icon ui-icon-triangle-1-n">▲</span></span></a><a class="ui-spinner-button ui-spinner-down ui-corner-br ui-button ui-widget ui-state-default ui-button-text-only" tabindex="-1" role="button" aria-disabled="false"><span class="ui-button-text"><span class="ui-icon ui-icon-triangle-1-s">▼</span></span></a></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modalAddTable__footer">
                            <button type="button" class="btn-flat red" value="Add " onclick="submitCreateTable()">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Table Update Model -->
        <div class="modal fade" id="tableUpdate" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content modalAddTable">
                    <div class="modal-header modal-headerTools">
                        <button type="button" class="close" data-dismiss="modal">×</button>
                        <p class="modal-headerTools-title">Update table</p>
                    </div>
                    <form name="frmTableModif" id="updatetable" action="" method="post">
                        <div class="modalAddTable__content">
                            <input id="idEvents" type="hidden" name="idEvents" value="{{$idEvent}}">
                            <input id="update_TableId" type="hidden" name="TableId" value="">
                            <input id="update_TableType" type="hidden" name="TableType" value="">
                            <input type="hidden" name="idMesa" value="">
                            <input id="update_posX" type="hidden" name="posX" value="">
                            <input id="update_posY" type="hidden" name="posY" value="">
                            <input id="update_minChairs" type="hidden" name="minChairs" value="">
                            <input id="update_maxChairs" type="hidden" name="maxChairs" value="">
                            <div class="pure-g">
                                <div class="pure-u-1-4">
                                    <span class="icon-replace"><i class="icon-tools-seating icon-tools-table-2side"></i></span>
                                </div>
                                <div class="pure-u-3-4">
                                    <div class="input-group-line">
                                        <span class="input-group-line-label">Table name</span>
                                        <input id="update_TableName" name="TableName" type="text" value="" placeholder="Table name" data-msgerror="You must select a name." required="">
                                        <div class="update_app-message-error input-group-label-error dnone" data-name="undefined" style="display: none;"></div>
                                    </div>
                                    <div class="input-group-line input-group-naked">
                                        <span class="input-group-line-label">No. chairs</span>
                                        <div class="mt5 update_seatinput-wrr">
                                            <span class="ui-spinner ui-widget ui-widget-content ui-corner-all"><input id="update_seatinput" class="spinner ui-spinner-input" name="TableSeats" type="number" min="2" max="100" value="" aria-valuemin="2" aria-valuemax="100" aria-valuenow="8" autocomplete="off" role="spinbutton"><a class="ui-spinner-button ui-spinner-up ui-corner-tr ui-button ui-widget ui-state-default ui-button-text-only" tabindex="-1" role="button" aria-disabled="false"><span class="ui-button-text"><span class="ui-icon ui-icon-triangle-1-n">▲</span></span></a><a class="ui-spinner-button ui-spinner-down ui-corner-br ui-button ui-widget ui-state-default ui-button-text-only" tabindex="-1" role="button" aria-disabled="false"><span class="ui-button-text"><span class="ui-icon ui-icon-triangle-1-s">▼</span></span></a></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modalAddTable__footer">
                            <button type="button" class="btn-flat red" value="Add " onclick="submitUpdateTable()">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Extra other table model -->
        <div id="othertables" tabindex="-1" role="dialog" aria-hidden="false" class="modal fade in" id="tool-modal" style="z-index: 1050;">
            <div class="modal-dialog">
                <div class="modal-content modalAddTable">
                    <div class="modal-header modal-headerTools">
                        <button type="button" class="close" data-dismiss="modal">×</button>
                        <p class="modal-headerTools-title">Add table</p>
                    </div>
                    <form name="frmTableModif" id="creatOthertable">
                        <div class="modalAddTable__content modalAddTable__content--custom">
                            <input type="hidden" name="idEvents" name="idEvents" value="{{$idEvent}}">
                            <input type="hidden" name="TableType" value="noSeats">
                            <input type="hidden" name="idMesa" value="">
                            <input type="hidden" name="posX" value="200">
                            <input type="hidden" name="posY" value="400">
                            <input type="hidden" name="minChairs" value="0">
                            <input type="hidden" name="maxChairs" value="0">
                            <input type="hidden" name="TableSeats" value="0">
                            <div class="pure-g">
                                <div class="pure-u-1-3">
                                    <span class="modalAddTable__customIcon">
                                        <span class="modalAddTable__customLabel app-table-custom-icon">Other</span>
                                    </span>
                                </div>
                                <div class="pure-u-2-3 prcustomcls prcustomclscls">
                                    <span class="input-group-line-label mb15">Choose a type</span>
                                    <div class="input-group-line">
                                        <div class="pure-g">
                                            <div class="pure-u-1-2 mb10">
                                                <label>
                                                    <input name="subtype" checked="" type="radio" value="4" class="app-table-custom-select" data-text="Bar">
                                                    <span></span>
                                                    <span class="ml5">Bar</span>
                                                </label>
                                            </div>
                                            <div class="pure-u-1-2 mb10">
                                                <label>
                                                    <input name="subtype" type="radio" value="2" class="app-table-custom-select" data-text="Cake">
                                                    <span></span>
                                                    <span class="ml5">Cake</span>
                                                </label>
                                            </div>
                                            <div class="pure-u-1-2 mb10">
                                                <label>
                                                    <input name="subtype" type="radio" value="3" class="app-table-custom-select" data-text="Dj">
                                                    <span></span>
                                                    <span class="ml5">Dj</span>
                                                </label>
                                            </div>
                                            <div class="pure-u-1-2 mb10">
                                                <label>
                                                    <input name="subtype" type="radio" value="6" class="app-table-custom-select" data-text="Details">
                                                    <span></span>
                                                    <span class="ml5">Details</span>
                                                </label>
                                            </div>
                                            <div class="pure-u-1-2 mb10">
                                                <label>
                                                    <input name="subtype" type="radio" value="1" class="app-table-custom-select" data-text="Gifts">
                                                    <span></span>
                                                    <span class="ml5">Gifts</span>
                                                </label>
                                            </div>
                                            <div class="pure-u-1-2 mb10">
                                                <label>
                                                    <input name="subtype" type="radio" value="5" class="app-table-custom-select" data-text="Guestbook">
                                                    <span></span>
                                                    <span class="ml5">Guestbook</span>
                                                </label>
                                            </div>
                                            <div class="pure-u-1-2 mb10">
                                                <label>
                                                    <input name="subtype" type="radio" value="7" class="app-table-custom-select" data-text="Podium">
                                                    <span></span>
                                                    <span class="ml5">Podium</span>
                                                </label>
                                            </div>
                                            <div class="pure-u-1-2 mb10">
                                                <label>
                                                    <input name="subtype" checked="" type="radio" value="0" class="app-table-custom-select" data-text="Other">
                                                    <span></span>
                                                    <span class="ml5">Other</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="input-group-line input-group-naked">
                                            <span class="input-group-line-label">Table size in feet</span>
                                            <div class="mt5 othertbleerror-wr">
                                                <span class="ui-spinner ui-widget ui-widget-content ui-corner-all"><input id="tablesizeother" class="spinner ui-spinner-input" name="tableSize" type="number" min="1" max="12" value="2" aria-valuemin="1" aria-valuemax="12" aria-valuenow="2" autocomplete="off" role="spinbutton"><a class="ui-spinner-button ui-spinner-up ui-corner-tr ui-button ui-widget ui-state-default ui-button-text-only" tabindex="-1" role="button" aria-disabled="false"><span class="ui-button-text"><span class="ui-icon ui-icon-triangle-1-n">▲</span></span></a><a class="ui-spinner-button ui-spinner-down ui-corner-br ui-button ui-widget ui-state-default ui-button-text-only" tabindex="-1" role="button" aria-disabled="false"><span class="ui-button-text"><span class="ui-icon ui-icon-triangle-1-s">▼</span></span></a></span>
                                            </div>
                                        </div>
                                        <div class="app-table-custom-input mt10">
                                            <span class="input-group-line-label">Table name</span>
                                            <input id="otherTablename" name="TableName" type="text" value="Other" placeholder="Table name" data-msgerror="You must select a name." required="">
                                            <div class="othertbl-message-error input-group-label-error dnone" data-name="undefined" style="display: none;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modalAddTable__footer">
                            <button type="button" class="btn-flat red" value="Add " onclick="submitotherCreateTable()">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Edit Other table data -->
        <div id="editothertables" tabindex="-1" role="dialog" aria-hidden="false" class="modal fade in" id="tool-modal" style="z-index: 1050;">
            <div class="modal-dialog">
                <div class="modal-content modalAddTable">
                    <div class="modal-header modal-headerTools">
                        <button type="button" class="close" data-dismiss="modal">×</button>
                        <p class="modal-headerTools-title">Edit table</p>
                    </div>
                    <form name="frmTableModif" id="updateOthertable">
                        <div class="modalAddTable__content modalAddTable__content--custom">
                            <input id="idEvents" type="hidden" name="idEvents" value="{{$idEvent}}">
                            <input id="edit_TableType" type="hidden" name="TableType" value="noSeats">
                            <input id="edit_idMesa" type="hidden" name="idMesa" value="">
                            <input id="edit_posX" type="hidden" name="posX" value="0">
                            <input id="edit_posY" type="hidden" name="posY" value="0">
                            <input id="edit_minChairs" type="hidden" name="minChairs" value="0">
                            <input id="edit_maxChairs" type="hidden" name="maxChairs" value="0">
                            <input id="edit_TableSeats" type="hidden" name="TableSeats" value="0">
                            <input id="edit_TableId" type="hidden" name="TableId" value="">

                            <div class="pure-g">
                                <div class="pure-u-1-3">
                                    <span class="modalAddTable__customIcon">
                                        <span class="modalAddTable__customLabel app-table-custom-icon edittxt"></span>
                                    </span>
                                </div>
                                <div class="pure-u-2-3 prcustomcls updateprcustomcls">
                                    <span class="input-group-line-label mb15">Choose a type</span>
                                    <div class="input-group-line">
                                        <div class="pure-g">
                                            <div class="pure-u-1-2 mb10">
                                                <label>
                                                    <input name="subtype" type="radio" value="4" class="app-table-custom-select" data-text="Bar">
                                                    <span></span>
                                                    <span class="ml5">Bar</span>
                                                </label>
                                            </div>
                                            <div class="pure-u-1-2 mb10">
                                                <label>
                                                    <input name="subtype" type="radio" value="2" class="app-table-custom-select" data-text="Cake">
                                                    <span></span>
                                                    <span class="ml5">Cake</span>
                                                </label>
                                            </div>
                                            <div class="pure-u-1-2 mb10">
                                                <label>
                                                    <input name="subtype" type="radio" value="3" class="app-table-custom-select" data-text="Dj">
                                                    <span></span>
                                                    <span class="ml5">Dj</span>
                                                </label>
                                            </div>
                                            <div class="pure-u-1-2 mb10">
                                                <label>
                                                    <input name="subtype" type="radio" value="6" class="app-table-custom-select" data-text="Details">
                                                    <span></span>
                                                    <span class="ml5">Details</span>
                                                </label>
                                            </div>
                                            <div class="pure-u-1-2 mb10">
                                                <label>
                                                    <input name="subtype" type="radio" value="1" class="app-table-custom-select" data-text="Gifts">
                                                    <span></span>
                                                    <span class="ml5">Gifts</span>
                                                </label>
                                            </div>
                                            <div class="pure-u-1-2 mb10">
                                                <label>
                                                    <input name="subtype" type="radio" value="5" class="app-table-custom-select" data-text="Guestbook">
                                                    <span></span>
                                                    <span class="ml5">Guestbook</span>
                                                </label>
                                            </div>
                                            <div class="pure-u-1-2 mb10">
                                                <label>
                                                    <input name="subtype" type="radio" value="7" class="app-table-custom-select" data-text="Podium">
                                                    <span></span>
                                                    <span class="ml5">Podium</span>
                                                </label>
                                            </div>
                                            <div class="pure-u-1-2 mb10">
                                                <label>
                                                    <input name="subtype" type="radio" value="0" class="app-table-custom-select" data-text="Other">
                                                    <span></span>
                                                    <span class="ml5">Other</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="input-group-line input-group-naked">
                                            <span class="input-group-line-label">Table size in feet</span>
                                            <div class="mt5 edit_othertbleerror-wr">
                                                <span class="ui-spinner ui-widget ui-widget-content ui-corner-all"><input id="edit_tablesizeother" class="spinner ui-spinner-input" name="tableSize" type="number" min="1" max="12" value="2" aria-valuemin="1" aria-valuemax="12" aria-valuenow="2" autocomplete="off" role="spinbutton"><a class="ui-spinner-button ui-spinner-up ui-corner-tr ui-button ui-widget ui-state-default ui-button-text-only" tabindex="-1" role="button" aria-disabled="false"><span class="ui-button-text"><span class="ui-icon ui-icon-triangle-1-n">▲</span></span></a><a class="ui-spinner-button ui-spinner-down ui-corner-br ui-button ui-widget ui-state-default ui-button-text-only" tabindex="-1" role="button" aria-disabled="false"><span class="ui-button-text"><span class="ui-icon ui-icon-triangle-1-s">▼</span></span></a></span>
                                            </div>
                                        </div>
                                        <div class="app-table-custom-input mt10">
                                            <span class="input-group-line-label">Table name</span>
                                            <input id="edit_otherTablename" name="TableName" type="text" value="Other" placeholder="Table name" data-msgerror="You must select a name." required="">
                                            <div class="edit_othertbl-message-error input-group-label-error dnone" data-name="undefined" style="display: none;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modalAddTable__footer">
                            <button type="button" class="btn-flat red" value="Add " onclick="submitotherUpdateTable()">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> <!-- End wrapper-tools-tables -->
</section> <!-- End Main section -->
<style>
.modalAddGuestCompanion {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    margin-bottom: 10px;
}
.modalAddGuestCompanion__name {
    width: 40%;
    margin-right: 15px;
}
.modalAddGuestCompanion__surname {
    margin: 24px 15px 0 0;
    width: 40%;
}
.input-group-line {
    padding: 0;
    background: #fff;
    position: relative;
    text-align: left;
}
.icon-close-grey::before {
    background-position: -74px -252px;
    height: 18px;
    width: 18px;
}
.input-group.icon select {
    width: 100%;
    padding: 0 25px 0 10px;
}
.wrapper-tables-header-buttons .input-group.icon {
    vertical-align: baseline;
}
</style>
<!--finish table create modal-->
@include('includes.footer')
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/jquery-ui.min.js"></script>
<script type="text/javascript">
// Dragable function for ( Drag table on chart )
function doDraggable() {
    $( ".tools-tables-gridItem" ).draggable({
        containment: ".app-tables-viewbox", 
        scroll: true,
        stop: function( event, ui ) {
            var tblid = $(this).attr('id');
            var posX = ui.position.left;
            var posY = ui.position.top;
            // For height
            chartWrapperheight = $('.app-tables-viewbox').outerHeight();
            var elementOffsettop = $(this).offset().top + ui.helper.height();
            var viewOffsettop = $('.app-tables-viewbox').offset().top + chartWrapperheight;

            // For width
            chartWrapperWidth = $('.app-tables-viewbox').outerWidth();
            var elementOffsetleft = $(this).offset().left + ui.helper.width();
            var viewOffsetleft = $('.app-tables-viewbox').offset().left + chartWrapperWidth;

            var chartWrapperheight;
            var chartWrapperWidth;
            if(Math.round(viewOffsettop - elementOffsettop) == 76) {
                chartWrapperheight = chartWrapperheight + 50;
                $('.app-tables-viewbox').css({"height": chartWrapperheight+"px"});
            }
            if(Math.round(viewOffsetleft - elementOffsetleft) == 75  ) {
                chartWrapperWidth = chartWrapperWidth + 50;
                $('.app-tables-viewbox').css({"width": chartWrapperWidth+"px"});
            }
          //  Update chart table posistions
            $.ajax({
                type: "post",
                url: "{{ url('tools/update_table_positions') }}",
                dataType: "json",
                data: {tableID: tblid, posX: posX, posY: posY, height: chartWrapperheight, width: chartWrapperWidth },
                beforeSend: function() {
                    $('#loading').hide();
                },
                success: function(data){
                    console.log(data.tableid);
                    // $('#'+data.removeid).remove();
                },
                error: function(data){
                    alert("Error");
                }
            });
        }
    });
}
// Dragable function for ( Drag gust from list to table seat )
function doDraggust() {
    $('.app-tables-persona').draggable({
        cursorAt: {
            top: 12,
            left: 12
        },
        containment: "document",
        revert: function(dropped) {
        },
        appendTo: ".wrapper-tools-tables",
        helper: function( event, ui ) {
            var iconCls = $(this).find('i').attr('class');
            return $( '<div class="shine"><i class="'+iconCls+'" style="z-index: 9999999"></i></div>' );
        },
    });
}
// Dropable function for ( Gust drop on table seat )
function doDropableGust() {
    $('.app-table-seat').droppable({ 
        accept: ".app-tables-persona", 
        drop: function(event, ui) {
            console.log("drop");
            var previousGustid = $(this).find('.app-tables-persona').attr('data-idcontact');
            if(previousGustid == 'undefined') {
                previousGustid = '';
            }
            // Create HTMl for user on seat
            var dropped = ui.draggable;
            var contactId = ui.draggable.attr('data-idcontact');
            var ucls = ui.draggable.find('i').attr('class');
            var gustnm = ui.draggable.attr('data-nombre');
            var gustnArray = gustnm.split(" ");
            var drophtml = '<div class="app-tables-persona app-seated-guest" data-nombre="'+gustnm+'" data-idcontact="' + contactId + '"><div class="tools-tables-gridItem-guest"><i class="' + ucls + '"></i></div><div class="app-tables-persona-name tools-tables-gridItem-guestName" title="' + gustnm + '"><span>' + gustnArray[0] + '</span><span>' + gustnArray[1] + '</span></div></div>';
            // Drop html on seat
            $(this).html(drophtml); 
            doDraggust();
            $('#i'+contactId).hide();
            $('#i'+contactId).find('.app-tables-guest-icon').attr('class', 'app-tables-guest-icon icon-tools-seating fright relative icon-tools-guest-dropped dropped');
            $('#i'+contactId).find('.app-tables-guest-name').addClass('marked-text');
            $(this).removeClass("hover-effect");
            var seatId = $(this).attr('id');
            var tableId = $(this).attr('tbl-id');
            var idEvents = "{{$idEvent}}";
            // Save Gust data on seat
            $.ajax({
                type: 'POST',
                url: "{{ url('tools/seat_arrangement') }}",
                dataType: "json",
                data: { gustid: contactId, seatId: seatId, tableId: tableId, seatHtml: drophtml, previousGustid: previousGustid, idEvents: idEvents },
                beforeSend: function() {
                    $('#loading').hide();
                },
                success: function(data) {
                    if(data.previousGustid) {
                        $('#i'+data.previousGustid).show();
                    }
                },
            });
        }, 
        over: function(event, elem) {
            $(this).addClass("hover-effect");
            console.log("over");
        },
        out: function(event, ui) {
            console.log("out");
            var check = $(this).find('.app-tables-persona').attr('data-idcontact');
            $(this).find('.app-tables-persona').remove();
            $(this).removeClass("hover-effect");
            var contactId = ui.draggable.attr('data-idcontact');
            var idEvents = "{{$idEvent}}";
            // Remove gust from table seat
            if( typeof check !== 'undefined' ) {
                $('#i'+contactId).find('.app-tables-guest-name').removeClass('marked-text');
                var icontype = $('#i'+contactId).find('.app-tables-guest-icon').attr('icontype');
                $('#i'+contactId).find('.app-tables-guest-icon').attr('class', 'app-tables-guest-icon icon-tools-seating fright relative icon-tools-'+icontype+'-small');
                $('#i'+contactId).show();
                $.ajax({
                    type: 'POST',
                    url: "{{ url('tools/seat_arrangement_delete') }}",
                    dataType: "json",
                    data: { gustid: contactId, idEvents: idEvents },
                    beforeSend: function() {
                        $('#loading').hide();
                    },
                    success: function(data){
                        console.log(data.tableid);
                    },
                });
            }
        }
    });
}
function change_eventName()
{
    var idEvent = $('select[name=idEvent]').val();
    if(idEvent) {
        var newURL = "{{ url('tools/seating_chart')}}?idEvent="+idEvent;
        window.location.href = newURL;
    }
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
$(document).ready(function() {
    var idEvent = "{{$idEvent}}";
    if(!idEvent) {
        change_eventName();
    }
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
    // load draggust element
        doDraggust();
    // load dropggust element
        doDropableGust();
    // Show modal for add table on chart
    $('.tabelmodelshow').on('click', function() {
        var tableType = $(this).attr('data-type');
        $('#TableType').val(tableType);
        $('.icon-replace').html('<i class="icon-tools-seating icon-tools-table-'+tableType+'"></i>');
        if(tableType == 'round2') {
            $('#seatinput').attr('min', '6');
            $('#seatinput').attr('max', '12');
        } else if(tableType == 'square') {
            $('#seatinput').attr('min', '4');
            $('#seatinput').attr('max', '24');
        } else {
            $('#seatinput').attr('min', '2');
            $('#seatinput').attr('max', '100');
        }
        $.ajax({
            type: 'get',
            url: "{{ url('tools/chartGrid') }}",
            dataType: "json",
            success: function(data){
                console.log(data);
                $('#posX').val(data.postionX);
                $('#posY').val(data.postionY);
                $('#tableadd').modal('show');
            }
        });
    });
    // Error out for modal field focus
    $('#TableName').focus(function() {
        $('.app-message-error').fadeOut();
    });
    $('#update_TableName').focus(function() {
        $('.update_app-message-error').fadeOut();
    });
    $('#otherTablename').focus(function() {
        $('.othertbl-message-error').fadeOut();
    });
    $('#edit_otherTablename').focus(function() {
        $('.edit_othertbl-message-error').fadeOut();
    });
    // Make div droppable
        $('.tools-tables-viewbox').droppable();
    // Make Div resizeable
    $( ".app-tables-viewbox" ).resizable({
        handles: "se",
    });
    // Call draggable function for table on chart
        doDraggable();
    // Hide show table edit delete button on chart
    $(document).on('mouseover', '.app-mesa-item', function(e) {
        $(this).find('.tools-tables-gridItem-settings').show();
    });
    $(document).on('mouseout', '.app-mesa-item', function(e) {
        $(this).find('.tools-tables-gridItem-settings').hide();
    });
    // Remove table from chart
    $('body').on('click', '.app-table-remove', function() {
        var tableID = $(this).attr('data-id');
        if(tableID != '') {
            if(confirm('Are you sure you want to delete this table?')) {
                $.ajax({
                    type: "post",
                    url: "{{ url('tools/remove_chart_table') }}",
                    dataType: "json",
                    data: {tableID: tableID},
                    success: function(data){
                        console.log(data.removeid);
                        $('#'+data.removeid+', .app-table-seat').each(function() {
                            var id = $(this).find('.app-tables-persona').attr('data-idcontact');
                            $('#i'+id).show();
                        })
                        $('#'+data.removeid).remove();
                    },
                    error: function(data){
                        alert("Error");
                    }
                });
            } // end confirm box
        }
    });
    // Get update and edit modal table on chart    
    $('body').on('click', '.app-table-edit', function() {
        var tableID = $(this).attr('data-id');
        if(tableID != '') {
            $.ajax({
                type: "get",
                url: "{{ url('tools/edit_chart_table') }}/"+tableID,
                dataType: "json",
                success: function(data) {
                    if(data.id) {
                        if(data.table_type == 'noSeats') {
                            $('#edit_posX').val(data.posX);
                            $('#edit_posY').val(data.posY);
                            $('#edit_TableId').val(data.id);
                            $('#edit_tablesizeother').val(data.tableSize);
                            $('#edit_otherTablename').val(data.table_nm);
                            $('.updateprcustomcls .pure-u-1-2').each(function() {
                                var cv = $(this);
                                var allVal = cv.find('.app-table-custom-select').val();
                                if(allVal == data.subtype) {
                                    cv.find('.app-table-custom-select').attr("checked", true);
                                    var titleTxt = cv.find('.app-table-custom-select').attr('data-text');
                                    $('.edittxt').text(titleTxt);
                                    return false;
                                }
                            });
                            $('#editothertables').modal('show');
                        } else {
                            $('#update_TableId').val(data.id);
                            $('#update_TableName').val(data.table_nm);
                            $('#update_seatinput').val(data.table_seat)
                            $('#update_TableType').val(data.table_type);
                            $('#update_posX').val(data.posX);
                            $('#update_posY').val(data.posY);
                            $('#update_minChairs').val(data.minChairs);
                            $('#update_maxChairs').val(data.maxChairs);
                            $('.icon-replace').html('<i class="icon-tools-seating icon-tools-table-'+data.table_type+'"></i>');
                            if(data.table_type == 'round2') {
                                $('#update_seatinput').attr('min', '6');
                                $('#update_seatinput').attr('max', '12');
                            } else if(data.table_type == 'square') {
                                $('#update_seatinput').attr('min', '4');
                                $('#update_seatinput').attr('max', '24');
                            } else {
                                $('#update_seatinput').attr('min', '2');
                                $('#update_seatinput').attr('max', '100');
                            }
                            $('#tableUpdate').modal('show');
                        }
                    } // endi data.id
                },
                error: function(data){
                    alert("Error");
                }
            });
        } // end
    }); // end function app-table-edit class
    // Other tables model show
    $('body').on('click', '.othertablemodelshow', function() {
        $('#othertables').modal('show');
    });
    $('.prcustomclscls .app-table-custom-select').on('change', function() {
        var tabletext = $(this).attr('data-text');
        $('.modalAddTable__customLabel').text(tabletext);
        $('#otherTablename').val(tabletext);
    });
    $('.updateprcustomcls .app-table-custom-select').on('change', function() {
        var tabletext = $(this).attr('data-text');
        $('.modalAddTable__customLabel.edittxt').text(tabletext);
        $('#edit_otherTablename').val(tabletext);
    });
    // All pending function
    $('.app-pending-seat').on('click', function() {
        $(this).siblings().removeClass('current');
        $(this).addClass('current');
        if($(this).attr('data-pending') == 0) {
            $('.marked-text').parent('.app-tables-persona').css({'display': 'inline-block'});
        } else {
            $('.marked-text').parent('.app-tables-persona').css({'display': 'none'});
        } 
    });
}); // End of document ready function
// Update table height width function
function updateTableheightwidth(height, width) {
    $.ajax({
        type: "post",
        url: "{{ url('tools/update_chart_table_list') }}",
        dataType: "json",
        data: {height: height, width: width},
        success: function(data){

        },
        error: function(data) {
            // nothing...
        }
    });
}
// Insert table data into data base ( Table create function )
function submitCreateTable() {
    var tableName = $('#TableName').val();
    if($.trim(tableName) == '') {
        $('.app-message-error').text('You must select a name.');
        $('.app-message-error').fadeIn();
        return false;
    }
    if($('#TableType').val() == 'round2') {
        var chairVal = $('#seatinput').val();
        if(chairVal < 6 || chairVal > 12) {
            $('.seatinput-wrr').html('<p style="margin-top:10px">please select between 6 - 12 Number</p>');
            return false;
        }
    }
    if($('#TableType').val() == 'square') {
        var chairVal = $('#seatinput').val();
        if(chairVal < 4 || chairVal > 24) {
            $('.seatinput-wrr').html('<p style="margin-top:10px">please select between 4 - 24 Number</p>');
            return false;
        }
    }
    $.ajax({
        type: "post",
        url: "{{ url('tools/save_tabledata') }}",
        dataType: "json",
        data: $('#creattable').serialize(),
        success: function(data) {
            // Positions update function
            var wrHeight = $('.app-tables-viewbox').outerHeight();
            var wrWidth = $('.app-tables-viewbox').outerWidth();
            if(data.tablewidth > 250 ) {
                var newTablwidth = data.tablewidth + 650;
                var newTablHeigth = data.tablewidth + 650;
                if( data.tableType == 'square' ||  data.tableType == 'round2' ) {
                    if(wrHeight < 900 ) {
                        $('.app-tables-viewbox').css({"height": newTablHeigth+'px' });
                        updateTableheightwidth(newTablHeigth, wrWidth); // Update table height width
                    }
                    if(wrWidth < 900) {
                        $('.app-tables-viewbox').css({"width": newTablwidth+'px' });
                        updateTableheightwidth(wrHeight, newTablwidth); // Update table height width
                    }
                } else if( data.tableType == '1side' || data.tableType == '2side' ) {
                    $('.app-tables-viewbox').css({"width": newTablwidth+'px' });
                    updateTableheightwidth(wrHeight, newTablwidth); // Update table height width
                }
            }
            // Append table html into chart board
            $('#tablelist').append(data.tableHtml);
            doDraggable();  // Call drag function
            $('#tableadd').modal('hide');
            $("#creattable")[0].reset(); 
            doDropableGust(); // for ajax content
        },
        error: function(data){
            alert("Error");
        }
    });
} // End function submitCreateTable()
// Update table chart function
function submitUpdateTable() {
    var tableName = $('#update_TableName').val();
    if($.trim(tableName) == '') {
        $('.update_app-message-error').text('You must select a name.');
        $('.update_app-message-error').fadeIn();
        return false;
    }
    if($('#update_TableType').val() == 'round2') {
        var chairVal = $('#update_seatinput').val();
        if(chairVal < 6 || chairVal > 12) {
            $('.update_seatinput-wrr').html('<p style="margin-top:10px">please select between 6 - 12 Number</p>');
            return false;
        }
    }
    if($('#update_TableType').val() == 'square') {
        var chairVal = $('#update_seatinput').val();
        if(chairVal < 4 || chairVal > 24) {
            $('.update_seatinput-wrr').html('<p style="margin-top:10px">please select between 4 - 24 Number</p>');
            return false;
        }
    }
    // Save update data into database
    $.ajax({
        type: "post",
        url: "{{ url('tools/update_chart_table') }}",
        dataType: "json",
        data: $('#updatetable').serialize(),
        success: function(data) {
            // show user after table update user remove from seat
            if(data.removeGustids.length > 0) {
                var userDataids = data.removeGustids;
                for (x in userDataids) {
                    $('#i'+userDataids[x]).show();
                }
            }
            $('#'+data.table_updateid).remove(); // remove old table html
            // update chart area size
            var wrHeight = $('.app-tables-viewbox').outerHeight();
            var wrWidth = $('.app-tables-viewbox').outerWidth();
            if(data.tablewidth > 250 ) {
                var newTablwidth = data.tablewidth + 650;
                var newTablHeigth = data.tablewidth + 650;
                if( data.tableType == 'square' ||  data.tableType == 'round2' ) {
                    if(wrHeight < 900 ) {
                        $('.app-tables-viewbox').css({"height": newTablHeigth+'px' });
                        updateTableheightwidth(newTablHeigth, wrWidth); // Update table height width
                    }
                    if(wrWidth < 900) {
                        $('.app-tables-viewbox').css({"width": newTablwidth+'px' });
                        updateTableheightwidth(wrHeight, newTablwidth); // Update table height width
                    }
                } else if( data.tableType == '1side' || data.tableType == '2side' ) {
                    $('.app-tables-viewbox').css({"width": newTablwidth+'px' });
                    updateTableheightwidth(wrHeight, newTablwidth); // Update table height width
                }
            }
            // Append updated data into chart board
            $('#tablelist').append(data.tableHtml); // append update data
            doDraggable(); // fire dragable jquery
            $('#tableUpdate').modal('hide');    // hide model
            $("#updatetable")[0].reset();   // reset form
            doDropableGust(); // for ajax content
        },
        error: function(data){
            alert("Error");
        }
    });
}
// Create noSeat data table function
function submitotherCreateTable() {
    var tableName = $('#otherTablename').val();
    if($.trim(tableName) == '') {
        $('.othertbl-message-error').text('You must select a name.');
        $('.othertbl-message-error').fadeIn();
        return false;
    }
    var chairVal = $('#tablesizeother').val();
    if(chairVal < 1 || chairVal > 12) {
        $('.othertbleerror-wr').html('<p style="margin-top:10px">please select between 1 - 12 Number</p>');
        return false;
    }
    // Ajax to save data into data base
    $.ajax({
        type: "post",
        url: "{{ url('tools/save_tabledata') }}",
        dataType: "json",
        data: $('#creatOthertable').serialize(),
        success: function(data) {
            var wrHeight = $('.app-tables-viewbox').outerHeight();
            var wrWidth = $('.app-tables-viewbox').outerWidth();
            if(data.tablewidth > 250 ) {
                var newTablwidth = data.tablewidth + 650;
                var newTablHeigth = data.tablewidth + 650;
                if( data.tableType == 'noSeats' ) {
                    if(wrHeight < 1200 ) {
                        $('.app-tables-viewbox').css({"height": newTablHeigth+'px' });
                        updateTableheightwidth(newTablHeigth, wrWidth); // Update table height width
                    }
                    if(wrWidth < 1200) {
                        $('.app-tables-viewbox').css({"width": newTablwidth+'px' });
                        updateTableheightwidth(wrHeight, newTablwidth); // Update table height width
                    }
                }                   
            }
            console.log(data.tableHtml);
            $('#tablelist').append(data.tableHtml);
            doDraggable();
            $('#othertables').modal('hide');
            $("#creatOthertable")[0].reset();
        },
        error: function(data){
            alert("Error");
        }
    });
} // end of function submitotherCreateTable()
// Update noSeat data table function
function submitotherUpdateTable() {
    var tableName = $('#edit_otherTablename').val();
    if($.trim(tableName) == '') {
        $('.edit_othertbl-message-error').text('You must select a name.');
        $('.edit_othertbl-message-error').fadeIn();
        return false;
    }
    var chairVal = $('#edit_tablesizeother').val();
    if(chairVal < 1 || chairVal > 12) {
        $('.edit_othertbleerror-wr').html('<p style="margin-top:10px">please select between 1 - 12 Number</p>');
        return false;
    }
    //ajax for update data into database
    $.ajax({
        type: "post",
        url: "{{ url('tools/update_chart_table') }}",
        dataType: "json",
        data: $('#updateOthertable').serialize(),
        success: function(data) {
            $('#'+data.table_updateid).remove();
            var wrHeight = $('.app-tables-viewbox').outerHeight();
            var wrWidth = $('.app-tables-viewbox').outerWidth();
            if(data.tablewidth > 250 ) {
                var newTablwidth = data.tablewidth + 650;
                var newTablHeigth = data.tablewidth + 650;
                if( data.tableType == 'noSeats' ) {
                    if(wrHeight < 1200 ) {
                        $('.app-tables-viewbox').css({"height": newTablHeigth+'px' });
                        updateTableheightwidth(newTablHeigth, wrWidth); // Update table height width
                    }
                    if(wrWidth < 1200) {
                        $('.app-tables-viewbox').css({"width": newTablwidth+'px' });
                        updateTableheightwidth(wrHeight, newTablwidth); // Update table height width
                    }
                }                   
            }
            $('#tablelist').append(data.tableHtml);
            doDraggable();
            $('#editothertables').modal('hide');
            $("#updateOthertable")[0].reset(); 
        },
        error: function(data){
            alert("Error");
        }
    });
} // End of submitotherUpdateTable()
//Hide add gust to wedding model
$("#addnew").click(function(){
    $("#myModal").modal('hide');
});
// Hide Show Menu JS
$('#hide').click(function(){
    $("#app-tools-grid-menu").addClass("collapsed");
    $('#showdiv').addClass("collapsed");
});
$('#showdiv').click(function(){
    $("#showdiv").removeClass("collapsed");
    $("#app-tools-grid-menu").removeClass("collapsed");
});
//// Edit gust model....
function editguest(id) {
   var guestid = id;
    $.ajax({
        type: "GET",
        url: "{{ url('tools/getsingleguest') }}",
        dataType: "json",
        data: { guestid: guestid },
        success: function(data) {
            console.log(data);
            $('#edit_guestId').val(data.id);
            $('#edit_firstname').val(data.firstname);
            $('#edit_lastname').val(data.lastname);
            $('#edit_age_type').val(data.age_type);
            $('#edit_gender').val(data.gender);
            $('#edit_group_id').val(data.group_id);
            if(data.need_hotel == 'Yes') {
                $('#edit_need_hotel').prop('checked',true);
            } else {
                $('#edit_need_hotel').prop('checked',false);
            }
            if(data.invited_for) {
                var invFor = data.invited_for.split('--');
                for(var inv = 0; inv < invFor.length; inv++) {
                    $('#edit_invited_for'+invFor[inv]).prop("checked", true);
                }
            }
            $('#edit_email').val(data.email);
            $('#edit_phone_no').val(data.phone_no);
            $('#edit_mobile_no').val(data.mobile_no);
            $('#edit_address').val(data.address);
            $('#edit_city_town').val(data.city_town);
            $('#edit_postal_code').val(data.postal_code);
            $("#editGuests-modal").modal('show');
        },
    });
}
// Edit button for gust
function editguest_new() {
    $.ajax({
        type: "post",
        url: "{{ url('tools/editguest_new') }}",
        dataType: "json",
        data: $('#editGuestsForm').serialize(),
        success: function(data){
            location.reload();
        },
        error: function(data){
            alert("Error");
        }
    });
}
// add more seating
$(document).ready(function() {
    $('#keyword').keyup(function() {
        var filter = $(this).val();
        $("ul.searchDataFilter").each(function() {
            if($(this).text().search(new RegExp(filter, "i")) < 0) {
                $(this).fadeOut();
            } else {
                $(this).show();
            }
        });
    });
    // JS for import file
    $('body').on('change', '#app-up-excel-list', function() {
        $('.modalAddGuest__buttonSection').find('p').remove();
        var file = document.getElementById('app-up-excel-list').files[0];
        console.log(file.type);
        var form = new FormData();
        form.append('spreadsheet', file);
        if(file.type != 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet') {
            $('.modalAddGuest__buttonSection').append('<p>Please select .xlsx file to import Guest.</p>');
            return false;
        }
        if(file != '') {
             $.ajax({
                type: "post",
                url: "{{ url('tools/guestsimportCSV') }}",
                cache: false,
                contentType: false,
                processData: false,
                data: form,
                success: function(data) {
                    console.log(data);
                    data = JSON.parse(data);
                    if(data.success) {
                        $('.modalAddGuest__buttonSection').append('<p>'+ data.success +'</p>');
                    } else {
                        $('.modalAddGuest__buttonSection').append('<p>'+ data.error +'</p>');
                    }
                }
            });
        }
    });
}); // End document ready functions
</script>
@endsection