<!DOCTYPE html>
<html lang="en">
    
<head>
	<title>List PDF</title>
	<!-- <link rel="stylesheet" href="{{ URL::asset('css/tools.css') }}" media="all"> -->
	<style type="text/css">
	ul {
		list-style-type: none;
		padding:0;
	}
	.tools-tables-report-item {
	    text-align: center;
	    padding: 15px;
	    height: auto;
	}
	.tools-tables-report-item-line {
	    border: 1px solid #D9D9D9;
	    box-sizing: border-box;
	    border-radius: 4px;
	    cursor: move;
	    position: relative;
	    background: #FFF;
	    padding: 10px;
	}
	.tools-tables-report-item-title {
	    font-family: Merriweather, Arial, sans-serif;
	    font-weight: 600;
	    font-size: 18px;
	}
	.tools-tables-report-item hr {
	    border: 1px solid #19b5bc;
	    line-height: 32px;
	    margin-top: 20px;
	    width: 50px;
	}
	.tools-tables-report-item-line ul li {
	    font-size: 14px;
	    font-weight: 400;
	    line-height: 27px;
	}
	</style>
</head>
<body>
	<div class="listpdf-wr" style="padding: 10px">
			<div class="image-wr" style="text-align: center; padding-bottom: 20px; border-bottom: 2px solid #00AEAF">
		        <img src="{{$pdfImage}}" alt="PDF LOGO">
		    </div>
		<section class="section-padding dashboard-wrap" style="padding-top: 25px">
			@php $listDataArray = json_decode($listData) @endphp
			<div class="wrapper">
			    <div id="app-sortable" class="pure-g ui-sortable">
			    	@if(count($listDataArray) > 0)
			    		@foreach( $listDataArray as $list )
			    			
				    		<div class="pure-u-1-3 app-table-plan tools-tables-report-item" data-divid="{{ $list->tableID }}" style="">
				                <div class="tools-tables-report-item-line">
				                    <p class="tools-tables-report-item-title">{{ $list->tblname }}</p>
				                    <hr>
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
	</div>
</body>
</html>