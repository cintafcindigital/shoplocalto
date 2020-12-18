<div class="message-innerboard">
	<h1 class="adminTitle">
        @if(Request::is('messages'))
          Messages <span class="adminTitle__counter">({{ $messageCount['inbox'] }})</span>
        @elseif(Request::is('messages-unread'))
          Messages <span class="adminTitle__counter">({{ $messageCount['unread'] }})</span>
        @elseif(Request::is('messages-read'))
          Messages <span class="adminTitle__counter">({{ $messageCount['read'] }})</span>
        @elseif(Request::is('messages-pending'))
          Messages <span class="adminTitle__counter">({{ $messageCount['pending'] }})</span>
        @elseif(Request::is('messages-replied'))
          Messages <span class="adminTitle__counter">({{ $messageCount['replied'] }})</span>
        @elseif(Request::is('messages-booked'))
          Messages <span class="adminTitle__counter">({{ $messageCount['booked'] }})</span>
        @elseif(Request::is('messages-discarded'))
          Messages <span class="adminTitle__counter">({{ $messageCount['discarded'] }})</span>
        @endif
    </h1>
    <div class="mb20">
    </div>
    <ul class="adminTicketsSummary">
        <li class="adminTicketsSummary__item">
           <span class="adminTicketsSummary__icon adminTicketsSummary__icon--requests"></span>
           <p class="adminTicketsSummary__description msg_text">
              <span class="adminTicketsSummary__number">{{ $messageCount['replied'] }}</span>
              Leads replied to                    
           </p>
        </li>
        <li class="adminTicketsSummary__item">
           <span class="adminTicketsSummary__icon adminTicketsSummary__icon--accepted"></span>
           <p class="adminTicketsSummary__description msg_text">
              <span class="adminTicketsSummary__number" id="app-num-boletos-aceptados">{{ $messageCount['booked'] }}</span>
              Leads booked                    
           </p>
        </li>
        <li class="adminTicketsSummary__item">
           <span class="adminTicketsSummary__icon adminTicketsSummary__icon--rejectedRounded"></span>
           <p class="adminTicketsSummary__description msg_text">
              <span class="adminTicketsSummary__number" id="app-num-boletos-descartados">{{ $messageCount['discarded'] }}</span>
              Leads discarded                    
           </p>
        </li>
     </ul>
     <div class="clearfix mb5">
        <div class="adminFiltersBox adminFiltersBox--pill filter_wrp">
           <label class="adminFiltersBox__check select_label mr10">
              <div class="icheckbox_minimal common_icheckbox_minimal" style="position: relative;"><input class="app-solicitudes-check-all" type="checkbox" style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div>
              <span>Select all</span>
           </label>
           <div class="app-ui-dropdown adminFiltersBox__select move_select">
              <span class="move_text">Move to</span>
              <i class="icon icon-arrow-down move_icon"></i>
              <ul class="app-ui-dropdown-layer adminFiltersBox__dropdown move_to_list" style="display:none;">
                 <li>
                    <a class="app-solicitudes-changeStatus" data-actionvalue="0" data-action="pending" role="button">
                   		<i class="adminBullet adminBullet--orange"></i>Pending
                    </a>
                 </li>
                 <li>
                    <a class="app-solicitudes-changeStatus" data-actionvalue="1" data-action="replied" role="button">
                    	<i class="adminBullet adminBullet--blue"></i>Replied
                    </a>
                 </li>
                 <li>
                    <a class="app-solicitudes-changeStatus" data-actionvalue="3" data-action="booked" role="button">
                		<i class="adminBullet adminBullet--green"></i>Booked
                    </a>
                 </li>
                 <li>
                    <a class="app-solicitudes-changeStatus" data-actionvalue="2" data-action="discarded" role="button">
                    	<i class="adminBullet adminBullet--red"></i>Discarded
                    </a>
                 </li>
              </ul>
           </div>
           <div class="app-ui-dropdown adminFiltersBox__select mark_select">
              <span class="mark_text">Mark as</span>
              <i class="icon icon-arrow-down mark_icon"></i>
              <ul class="app-ui-dropdown-layer adminFiltersBox__dropdown mark_us_list" style="display:none;">
                 <li>
                    <a class="app-solicitudes-changeStatus" href="javascript:;" data-actionvalue="0" data-action="unread">Unread</a>
                 </li>
                 <li>
                    <a class="app-solicitudes-changeStatus" href="javascript:;" data-actionvalue="1" data-action="read">Read</a>
                 </li>
              </ul>
           </div>
        </div>
        <div class="adminFiltersSuggest">
           <form class="relative" name="frmGestorSolicitudesBusc" action="" method="get" onsubmit="return va_solicitudes_validarSolicBusc(this);">
              {{ csrf_field() }}
              <input class="adminFiltersSuggest__Search" type="search" name="sn" value="@if(isset($_GET['sn'])) {{ $_GET['sn'] }} @endif" placeholder="Search">
              <div class="adminFiltersSuggest__More app-solicitudes-drop app-solicitudes-drop-search">
                 <span class="adminFiltersBox__moreButton" role="button">Advanced search</span>
                 <div class="app-solicitudes-droplayer adminFiltersSuggest__Layer" style="display:none;">
                    <label class="adminFormLabel" for="FechaInicio">From:</label>
                    <div class="input-append date app-common-datepicker mb10">
                       <input id="FechaInicio" name="dfrom" class="adminFiltersSuggest__Date datetimepicker" type="text" placeholder="dd/mm/yyyy">
                       <span class="add-on"></span>
                    </div>
                    <label class="adminFormLabel" for="FechaFin">Until:</label>
                    <div class="input-append date app-common-datepicker mb10">
                       <input id="FechaFin" name="dend" class="adminFiltersSuggest__Date datetimepicker" type="text" placeholder="dd/mm/yyyy">
                       <span class="add-on"></span>
                    </div>
                    <div class="pure-control-group mb5">
                       <div class="iradio_minimal checked" style="position: relative;"><input id="fechaSol" name="leadby" type="radio" value="1" checked="checked" style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div>
                       <label for="fechaSol">Lead date</label>
                    </div>
                    <!--<div class="pure-control-group">
                       <div class="iradio_minimal" style="position: relative;"><input id="fechaBoda" name="leadby" type="radio" value="2" style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div>
                       <label for="fechaBoda">Wedding date</label>
                    </div>-->
                    <input class="btnFlat btnFlat--primary btnFlat--full" type="submit" onclick="return advanceSearch()" value="Search">
                 </div>
              </div>
              <input class="adminFiltersBox__inputHidden" type="submit">
           </form>
        </div>
     </div>
</div>

<script type="text/javascript">

  function advanceSearch() {
    var dfrom = $('#FechaInicio').val();
    var dend = $('#FechaFin').val();

    if(dfrom != '' && dend != '' && new Date(dfrom) > new Date(dend)) {
      alert('The end date cannot be before the starting date');
      return false;
    }

  }

  $(document).ready(function() {
      $('.iradio_minimal').on('click', function() {
        $('.iradio_minimal').removeClass('checked');
        $(this).addClass('checked');
      });
  });
</script>