@extends('layouts.default')
@section('meta_title','Perfect Wedding | Seating List')
@section('meta_keyword','Perfect Wedding | Seating List')
@section('meta_description','Perfect Wedding | Seating List')
@section('content')
@include('includes.menu')
<?php
    $idEvent = @Request::get('idEvent') ? : '';
?>
<section class="section-padding dashboard-wrap">
  	@include('tools.tools_nav')
   	@php $listDataArray = json_decode($listData) @endphp
	<div class="wrapper-tables-header-buttons report">
        <div class="input-group tools-toggle icon icon-arrow-down">
            <select class="event-select app-multi-event" name="idEvent" onchange="change_eventName();">
                @foreach($guestsEvent as $ge)
                    <option value="{{$ge->id}}" @if($ge->id == $idEvent) selected @endif>{{$ge->event_name}}</option>
                @endforeach
            </select>
        </div>
		<div class="tools-toggle">
		    <a class="tools-toggle-item" href="{{url('tools/seating_chart').'?idEvent='.$idEvent}}">Chart</a>
		    <a class="tools-toggle-item active" href="{{url('tools/seating_list').'?idEvent='.$idEvent}}">List</a>
		</div>
	    <div class="tools-toggle">
		    <a href="{{url('/tools/chart_list_PDF').'?idEvent='.$idEvent}}" style="display: inline-block;">
		        <span class="app-open-layer-pdf tools-toggle-item" data-section="report">
		        <i class="icon-tools-seating icon-tools-download icon-left"></i>PDF</span>
		    </a>
	    </div>
	</div>
	<div class="wrapper">
	    <div id="app-sortable" class="pure-g ui-sortable">
	    	@if(count($listDataArray) > 0)
	    		@foreach( $listDataArray as $list )
		    		<div class="pure-u-1-3 app-table-plan tools-tables-report-item" data-divid="{{ $list->tableID }}" style="">
		                <div class="tools-tables-report-item-line">
		                    <p class="tools-tables-report-item-title">{{ $list->tblname }}</p><hr>
		                    <ul>
			                    @if( isset( $list->gustdata ) )
			                    	@foreach( $list->gustdata as $gustdata )
			                    		<li gustid="{{ $gustdata->gustid }}" seatid="{{ $gustdata->seat_id }}" >{{ $gustdata->gustname }}</li>
			                    	@endforeach
			                    @endif
		                    </ul>
		                </div>
		            </div>
            	@endforeach
	    	@endif
	    </div>
	</div>
</section>
<style type="text/css">
.wrapper-tables-header-buttons .input-group.icon {
    vertical-align: baseline;
}
</style>
@include('includes.footer')
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/jquery-ui.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$("#app-sortable").sortable({
        stop: function() {
	        a = [];
	        $("#app-sortable").find(".app-table-plan").each(function(e, t) {
	            a[a.length] = $(t).data("divid") + "=" + e
	        });
	        console.log(a);
	        $.ajax({
                type: 'POST',
                url: "{{ url('tools/seating_list_position') }}",
                dataType: "json",
                data: { position: a },
                beforeSend: function() {
                    $('#loading').hide();
                },
                success: function(data){
                    // console.log(data.tableid);
                },
            });
        }
    });
});
function change_eventName()
{
    var idEvent = $('select[name=idEvent]').val();
    if(idEvent) {
        var newURL = "{{ url('tools/seating_list')}}?idEvent="+idEvent;
        window.location.href = newURL;
    }
}
</script>
@endsection 