@extends('layouts.default')
@section('meta_title',$data['titleData']->meta_title)
@section('meta_keyword',$data['titleData']->meta_keyword)
@section('meta_description',$data['titleData']->meta_description)
@section('content')
@include('includes.menu')
<?php
    $idEvent = @Request::get('idEvent');
    $eventTitle = '';
    $isDefault = '';
    $eTrack = 'active';
    $eSeats = 'active';
    if($idEvent) {
        $eventTitle = $data['current_event']->event_name;
        if($data['current_event']->is_default == 1) {
            $isDefault = "yes";
        }
        if($data['current_event']->menus == 'No') {
            $eTrack = '';
        }
        if($data['current_event']->tables == 'No') {
            $eSeats = '';
        }
    }
?>
<section class="section-padding-ex dashboard-wrap-ex">
    @include('tools.tools_nav');
    <div class="wrapper guest-desgin">
        <div class="mb20 text-center">
            <div class="text-center" data-where="">
                <div class="inline-block tools-toggle">
                    <span class="tools-toggle-item app-event-change" data-href="{{url('/tools/guests')}}">Overview</span>
                    @foreach($data['guests_event'] as $ge)
                        <span class="tools-toggle-item @if($idEvent == $ge->id) active @endif app-event-change" data-href="{{url('/tools/guests')}}?idEvent={{$ge->id}}">{{$ge->event_name}}</span>
                    @endforeach
                    <a class="tools-toggle-item small @if(!$idEvent) active @endif" href="{{url('/tools/guests/eventForm')}}">
                        <i class="icon-tools icon-tools-plus"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="em-event wrapper wrapper--600">
        <h1 class="tools-title text-center">@if($eventTitle) Edit event '{{$eventTitle}}' @else Add an event @endif</h1>
            <form class="guests-eventForm app-tools-event-form" name="eventForm" id="eventForm" action="#" method="post">
                @csrf
                <input type="hidden" name="idEvent" value="{{$idEvent}}">
                <div class="mb30">
                    <span class="input-group-line-label">Event name</span>
                    <div class="input-group-line">
                        @if($isDefault)
                            <input type="hidden" name="event_name" value="{{$eventTitle}}">
                            <input value="{{$eventTitle}}" style="padding-left:5px;" disabled>
                        @else
                            <input type="text" name="event_name" value="{{$eventTitle}}" placeholder="Event name" maxlength="100">
                            <span class="event_nameErr dnone" style="color:#f5234d;">The name must contain a minimum of three characters</span>
                        @endif
                    </div>
                </div>
                <div class="mb10">
                    <span class="input-group-line-label mb10">Options</span>
                    <div class="pure-g row">
                        <div class="pure-u-1-2">
                            <label class="eventFormSelector app-tools-event-select track_meal_option {{$eTrack}}">
                                <div class="eventFormSelector__check">
                                    <div class="icheckbox_minimal track_meal_div @if($eTrack) checked @endif">
                                        <input id="event_track_meals" name="event_track_meals" type="checkbox" value="1" @if($eTrack) checked @endif>
                                        <ins class="iCheck-helper"></ins>
                                    </div>
                                </div>
                                <i class="eventFormSelector__icon icon-tools icon-tools-guest-menu"></i> Track Meals
                            </label>
                        </div>
                        <div class="pure-u-1-2">
                            <label class="eventFormSelector app-tools-event-select seating_chart_option {{$eSeats}}">
                                <div class="eventFormSelector__check">
                                    <div class="icheckbox_minimal seating_chart_div @if($eSeats) checked @endif">
                                        <input id="event_seating_chart" name="event_seating_chart" type="checkbox" value="1" @if($eSeats) checked @endif>
                                        <ins class="iCheck-helper"></ins>
                                    </div>
                                </div>
                                <i class="eventFormSelector__icon icon-tools icon-tools-guest-tables"></i> Create Seating Chart
                            </label>
                        </div>
                    </div>
                </div>
                <div class="mb20 app-meals-container @if(!$eTrack) dnone @endif">
                    <span class="input-group-line-label mb10">Menus</span>
                    <div class="pure-g row">
                        <div class="pure-u-1-2 app-list-group">
                            <div class="eventFormList">
                                <header class="eventFormList__header">
                                    <input type="text" class="eventFormList__input app-list-add-item-input menuInput" placeholder="Add new meal choice">
                                    <i class="eventFormList__action app-list-add-item-button icon-tools icon-tools-plus-circle-outline menuiTag" role="button"></i>
                                </header>
                                <ul class="eventFormList__content app-list-items menuUlList">
                                    @if($idEvent != '' && $data['current_event']->menu_types != '')
                                        @php $menuArr = explode('--',$data['current_event']->menu_types);
                                        for($mnm = 0; $mnm < count($menuArr); $mnm++) {
                                        @endphp
                                        <li class="eventFormList__item app-list-item">
                                            <span class="app-list-item-checkbox menuSpan dnone">
                                                <div class="icheckbox_minimal menuCheckbx">
                                                    <input type="checkbox" name="menu_types[]" value="{{$menuArr[$mnm]}}"><ins class="iCheck-helper"></ins>
                                                </div>
                                            </span>
                                            <span class="app-list-item-text">{{$menuArr[$mnm]}}</span>
                                        </li>
                                        @php } @endphp
                                    @else
                                        <li class="eventFormList__item app-list-item">
                                            <span class="app-list-item-checkbox menuSpan dnone">
                                                <div class="icheckbox_minimal menuCheckbx">
                                                    <input type="checkbox" name="menu_types[]" value="Beef"><ins class="iCheck-helper"></ins>
                                                </div>
                                            </span>
                                            <span class="app-list-item-text">Beef</span>
                                        </li>
                                        <li class="eventFormList__item app-list-item">
                                            <span class="app-list-item-checkbox menuSpan dnone">
                                                <div class="icheckbox_minimal menuCheckbx">
                                                    <input type="checkbox" name="menu_types[]" value="Chicken"><ins class="iCheck-helper"></ins>
                                                </div>
                                            </span>
                                            <span class="app-list-item-text">Chicken</span>
                                        </li>
                                        <li class="eventFormList__item app-list-item">
                                            <span class="app-list-item-checkbox menuSpan dnone">
                                                <div class="icheckbox_minimal menuCheckbx">
                                                    <input type="checkbox" name="menu_types[]" value="Fish"><ins class="iCheck-helper"></ins>
                                                </div>
                                            </span>
                                            <span class="app-list-item-text">Fish</span>
                                        </li>
                                        <li class="eventFormList__item app-list-item">
                                            <span class="app-list-item-checkbox menuSpan dnone">
                                                <div class="icheckbox_minimal menuCheckbx">
                                                    <input type="checkbox" name="menu_types[]" value="Lamb"><ins class="iCheck-helper"></ins>
                                                </div>
                                            </span>
                                            <span class="app-list-item-text">Lamb</span>
                                        </li>
                                        <li class="eventFormList__item app-list-item">
                                            <span class="app-list-item-checkbox menuSpan dnone">
                                                <div class="icheckbox_minimal menuCheckbx">
                                                    <input type="checkbox" name="menu_types[]" value="Vegetarian"><ins class="iCheck-helper"></ins>
                                                </div>
                                            </span>
                                            <span class="app-list-item-text">Vegetarian</span>
                                        </li>
                                        <li class="eventFormList__item app-list-item">
                                            <span class="app-list-item-checkbox menuSpan dnone">
                                                <div class="icheckbox_minimal menuCheckbx">
                                                    <input type="checkbox" name="menu_types[]" value="Child Meal"><ins class="iCheck-helper"></ins>
                                                </div>
                                            </span>
                                            <span class="app-list-item-text">Child Meal</span>
                                        </li>
                                        <li class="eventFormList__item app-list-item">
                                            <span class="app-list-item-checkbox menuSpan dnone">
                                                <div class="icheckbox_minimal menuCheckbx">
                                                    <input type="checkbox" name="menu_types[]" value="Other"><ins class="iCheck-helper"></ins>
                                                </div>
                                            </span>
                                            <span class="app-list-item-text">Other</span>
                                        </li>
                                    @endif
                                </ul>
                                <footer class="eventFormList__footer">
                                    <div class="eventFormList__footerActions app-list-item-actions menuSpan dnone">
                                        <a class="eventFormList__footerLink eventFormList__footerLink--grey menuAddRemoveBtn " role="button">
                                            <i class="eventFormList__footerIcon icon-tools icon-tools-trash-grey"></i> Remove
                                            <span class="app-select-count menuCounter"></span>
                                        </a>
                                        <a class="eventFormList__footerLink eventFormList__footerLink--right menuDoneBtn" role="button">Done</a>
                                    </div>
                                    <a class="eventFormList__footerLink app-list-edit-button menuEditBtn" role="button">Edit</a>
                                </footer>
                            </div>
                        </div>
                        <div class="pure-u-1-2">
                            @if($idEvent)
                            <p class="eventFormCopy">
                                Want to track vendor meals?<br> Go to the <a class="eventFormCopy__link" href="{{url('/tools/guests/stats')}}?idEvent={{$idEvent}}" style="color:#19b5bc;">stats page</a> for this event.
                            </p>
                            @endif
                        </div>
                    </div>
                </div>
                <span class="input-group-line-label mb10">Lists</span>
                <div class="pure-g row">
                    <div class="pure-u-1-2 app-list-group">
                        <div class="eventFormList">
                            <header class="eventFormList__header">
                                <input type="text" class="eventFormList__input app-list-add-item-input listInput" placeholder="Add a new list">
                                <i class="eventFormList__action app-list-add-item-button icon-tools icon-tools-plus-circle-outline listiTag" role="button"></i>
                            </header>
                            <ul class="eventFormList__content app-list-items listUlList">
                                @if($idEvent != '' && $data['current_event']->list_types != '')
                                    @php $listArr = explode('--',$data['current_event']->list_types);
                                    for($lnm = 0; $lnm < count($listArr); $lnm++) {
                                    @endphp
                                    <li class="eventFormList__item app-list-item">
                                        <span class="app-list-item-checkbox listSpan dnone">
                                            <div class="icheckbox_minimal listCheckbx">
                                                <input type="checkbox" name="list_types[]" value="{{$listArr[$lnm]}}"><ins class="iCheck-helper"></ins>
                                            </div>
                                        </span>
                                        <span class="app-list-item-text">{{$listArr[$lnm]}}</span>
                                    </li>
                                    @php } @endphp
                                @else
                                    <li class="eventFormList__item app-list-item">
                                        <span class="app-list-item-checkbox listSpan dnone">
                                            <div class="icheckbox_minimal listCheckbx">
                                                <input type="checkbox" name="list_types[]" value="A-List"><ins class="iCheck-helper"></ins>
                                            </div>
                                        </span>
                                        <span class="app-list-item-text">A-List</span>
                                    </li>
                                    <li class="eventFormList__item app-list-item">
                                        <span class="app-list-item-checkbox listSpan dnone">
                                            <div class="icheckbox_minimal listCheckbx">
                                                <input type="checkbox" name="list_types[]" value="B-List"><ins class="iCheck-helper"></ins>
                                            </div>
                                        </span>
                                        <span class="app-list-item-text">B-List</span>
                                    </li>
                                    <li class="eventFormList__item app-list-item">
                                        <span class="app-list-item-checkbox listSpan dnone">
                                            <div class="icheckbox_minimal listCheckbx">
                                                <input type="checkbox" name="list_types[]" value="C-List"><ins class="iCheck-helper"></ins>
                                            </div>
                                        </span>
                                        <span class="app-list-item-text">C-List</span>
                                    </li>
                                @endif
                            </ul>
                            <footer class="eventFormList__footer">
                                <div class="eventFormList__footerActions app-list-item-actions listSpan dnone">
                                    <a class="eventFormList__footerLink eventFormList__footerLink--grey listAddRemoveBtn " role="button">
                                        <i class="eventFormList__footerIcon icon-tools icon-tools-trash-grey"></i> Remove
                                        <span class="app-select-count listCounter"></span>
                                    </a>
                                    <a class="eventFormList__footerLink eventFormList__footerLink--right listDoneBtn" role="button">Done</a>
                                </div>
                                <a class="eventFormList__footerLink app-list-edit-button listEditBtn" role="button">Edit</a>
                            </footer>
                        </div>
                    </div>
                </div>
                @if($idEvent)
                    <hr>
                    <div class="mt30 mb30 text-center">
                        <a class="app-delete-event pointer" role="button" data-url="{{url('tools/guests/remove_event').'/'.$idEvent}}">
                            <i class="icon-tools icon-tools-trash-grey icon-left"></i> Remove event
                        </a>
                    </div>
                @endif
                <hr class="mb25">
                <button type="button" class="btn-flat red mr10 event_submit">Save changes</button>
                <a class="btn-outline outline-red" href="/tools/Guests">Cancel</a>
            </form>
        </div>
    </div>
</section>
<style>
.menuAddRemoveBtn:hover {
    color: #19b5bc;
}
.eventFormList__action.active::before {
    opacity: 1;
    filter: grayscale(0);
}
.eventFormCopy {
    color: #6c6c6c;
    margin: 0 10px;
}
</style>
@include('includes.footer')
<script>
$(document).ready(function(){
    $('body').on('click','.app-event-change', function(){
        var curUrl = $(this).attr('data-href');
        window.location.href = curUrl;
    });
    ////// For Track Meals Section......
    $('.track_meal_option').mouseover(function() {
        $(this).addClass('hover');
        $('.track_meal_div').addClass('hover');
    });
    $('.track_meal_option').mouseleave(function() {
        $(this).removeClass('hover');
        $('.track_meal_div').removeClass('hover');
    });
    $('.track_meal_option input[type=checkbox]').change(function() {
        var chkbox = $('.track_meal_div').hasClass('checked');
        if(chkbox) {
            $('.app-meals-container').slideUp(500);
            $('#event_track_meals').attr('checked',false);
            $('.track_meal_option').removeClass('active');
            $('.track_meal_div').removeClass('checked');
        } else {
            $('.app-meals-container').slideDown(800);
            $('#event_track_meals').attr('checked',true);
            $('.track_meal_option').addClass('active');
            $('.track_meal_div').addClass('checked');
        }
    });
    ////// For Seating Chart Section......
    $('.seating_chart_option').mouseover(function() {
        $(this).addClass('hover');
        $('.seating_chart_div').addClass('hover');
    });
    $('.seating_chart_option').mouseleave(function() {
        $(this).removeClass('hover');
        $('.seating_chart_div').removeClass('hover');
    });
    $('.seating_chart_option input[type=checkbox]').change(function() {
        var chkbox = $('.seating_chart_div').hasClass('checked');
        if(chkbox) {
            $('#event_seating_chart').attr('checked',false);
            $('.seating_chart_option').removeClass('active');
            $('.seating_chart_div').removeClass('checked');
        } else {
            $('#event_seating_chart').attr('checked',true);
            $('.seating_chart_option').addClass('active');
            $('.seating_chart_div').addClass('checked');
        }
    });
    ////// For Menus Section......
    $('.menuEditBtn').click(function() {
        $(this).addClass('dnone');
        $('.menuSpan').removeClass('dnone');
    });
    $('body').on('mouseover','.menuCheckbx',function() {
        $(this).addClass('hover');
    });
    $('body').on('mouseleave','.menuCheckbx',function() {
        $(this).removeClass('hover');
    });
    var menuCounter = 0;
    $('body').on('click','.menuCheckbx',function() {
        var mchkbox = $(this).hasClass('checked');
        if(mchkbox) {
            menuCounter--;
            $(this).removeClass('checked');
            $(this).find('input[type=checkbox]').attr("checked",false);
        } else {
            menuCounter++;
            $(this).addClass('checked');
            $(this).find('input[type=checkbox]').attr("checked",true);
        }
        if(menuCounter > 0) {
            $('.menuAddRemoveBtn').addClass('menuRemoveBtn');
            $('.menuCounter').html('('+menuCounter+')');
        } else {
            $('.menuAddRemoveBtn').removeClass('menuRemoveBtn');
            $('.menuCounter').html('');
        }
    });
    $('body').on('click', '.menuRemoveBtn', function() {
        $(".menuCheckbx").find('input[type=checkbox]').each(function () {
            if($(this).is(':checked')) {
                $(this).closest('li').html('');
                menuCounter--;
            }
        });
        $('.menuCounter').html('');
        $('.menuAddRemoveBtn').removeClass('menuRemoveBtn');
    });
    $('.menuDoneBtn').click(function() {
        $('.menuSpan').addClass('dnone');
        $('.menuEditBtn').removeClass('dnone');
    });
    $('.menuInput').keyup(function() {
        var vals = $(this).val();
        if(vals.length > 0) {
            $('.menuiTag').addClass('active');
        } else {
            $('.menuiTag').removeClass('active');
        }
    });
    $('.menuiTag').click(function() {
        var vals = $('.menuInput').val();
        if(vals.length > 0) {
            $('.menuUlList').append('<li class="eventFormList__item app-list-item"><span class="app-list-item-checkbox menuSpan dnone"><div class="icheckbox_minimal menuCheckbx"><input type="checkbox" name="menu_types[]" value="'+vals+'"><ins class="iCheck-helper"></ins></div></span><span class="app-list-item-text">'+vals+'</span></li>');
            $('.menuInput').val('');
            $('.menuSpan').addClass('dnone');
            $('.menuEditBtn').removeClass('dnone');
        }
    });
    ////// For Lists Section......
    $('.listEditBtn').click(function() {
        $(this).addClass('dnone');
        $('.listSpan').removeClass('dnone');
    });
    $('body').on('mouseover','.listCheckbx',function() {
        $(this).addClass('hover');
    });
    $('body').on('mouseleave','.listCheckbx',function() {
        $(this).removeClass('hover');
    });
    var listCounter = 0;
    $('body').on('click','.listCheckbx',function() {
        var lchkbox = $(this).hasClass('checked');
        if(lchkbox) {
            listCounter--;
            $(this).removeClass('checked');
            $(this).find('input[type=checkbox]').attr("checked",false);
        } else {
            listCounter++;
            $(this).addClass('checked');
            $(this).find('input[type=checkbox]').attr("checked",true);
        }
        if(listCounter > 0) {
            $('.listAddRemoveBtn').addClass('listRemoveBtn');
            $('.listCounter').html('('+listCounter+')');
        } else {
            $('.listAddRemoveBtn').removeClass('listRemoveBtn');
            $('.listCounter').html('');
        }
    });
    $('body').on('click', '.listRemoveBtn', function() {
        $(".listCheckbx").find('input[type=checkbox]').each(function () {
            if($(this).is(':checked')) {
                $(this).closest('li').html('');
                listCounter--;
            }
        });
        $('.listCounter').html('');
        $('.listAddRemoveBtn').removeClass('listRemoveBtn');
    });
    $('.listDoneBtn').click(function() {
        $('.listSpan').addClass('dnone');
        $('.listEditBtn').removeClass('dnone');
    });
    $('.listInput').keyup(function() {
        var vals = $(this).val();
        if(vals.length > 0) {
            $('.listiTag').addClass('active');
        } else {
            $('.listiTag').removeClass('active');
        }
    });
    $('.listiTag').click(function() {
        var vals = $('.listInput').val();
        if(vals.length > 0) {
            $('.listUlList').append('<li class="eventFormList__item app-list-item"><span class="app-list-item-checkbox listSpan dnone"><div class="icheckbox_minimal listCheckbx"><input type="checkbox" name="list_types[]" value="'+vals+'"><ins class="iCheck-helper"></ins></div></span><span class="app-list-item-text">'+vals+'</span></li>');
            $('.listInput').val('');
            $('.listSpan').addClass('dnone');
            $('.listEditBtn').removeClass('dnone');
        }
    });
    ////// For Submit Event Form Section......
    $('body').on('click','.event_submit', function(){
        var event_name = $('input[name=event_name]').val();
        if(event_name == '') {
            $('.event_nameErr').show();
            return false;
        } else {
            var menuTypes = '';
            $("input[name='menu_types[]']").each(function () {
                if(menuTypes == '') {
                    menuTypes = $(this).val();
                } else {
                    menuTypes += '--'+$(this).val();
                }
            });
            var listTypes = '';
            $("input[name='list_types[]']").each(function () {
                if(listTypes == '') {
                    listTypes = $(this).val();
                } else {
                    listTypes += '--'+$(this).val();
                }
            });
            $.ajax({
                url: "{{url('tools/guests/add_event')}}",
                type: "POST",
                data: $('#eventForm').serialize()+'&menuTypes='+menuTypes+'&listTypes='+listTypes,
                success: function(response) {
                    if(response == 'inserted') {
                        if("{{$idEvent}}" != '') {
                            window.location.href = "{{url('tools/guests')}}?idEvent={{$idEvent}}";
                        } else {
                            window.location.href = "{{url('tools/guests')}}";
                        }
                    }
                }
            });
        }
    });
    $('body').on('click', '.app-delete-event', function() {
        curUrl = $(this).attr('data-url');
        if(curUrl && confirm('Do you really want to remove this event?')) {
            $.ajax({
                url: curUrl,
                type: "GET",
                data: '',
                success: function(response) {
                    if(response == 'deleted') {
                        window.location.href = "{{url('tools/guests')}}";
                    }
                }
            });
        }
    });
});
</script>
@endsection