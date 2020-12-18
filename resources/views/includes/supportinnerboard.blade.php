<div class="message-innerboard">
    <h1 class="adminTitle" style="display:inline-block;">
        @if(Request::is('supports/opened'))
            Tickets <span class="adminTitle__counter">({{ $ticketsCount['opened'] }})</span>
        @elseif(Request::is('supports/awaiting-your-reply'))
            Tickets <span class="adminTitle__counter">({{ $ticketsCount['awaiting'] }})</span>
        @elseif(Request::is('supports/closed'))
            Tickets <span class="adminTitle__counter">({{ $ticketsCount['closed'] }})</span>
        @elseif(Request::is('supports/customer-service'))
            Tickets <span class="adminTitle__counter">({{ $ticketsCount['customer'] }})</span>
        @elseif(Request::is('supports/sales-support'))
            Tickets <span class="adminTitle__counter">({{ $ticketsCount['sales'] }})</span>
        @elseif(Request::is('supports/technical-support'))
            Tickets <span class="adminTitle__counter">({{ $ticketsCount['technical'] }})</span>
        @endif
    </h1>
    <a href="{{url('ticket-support-add')}}" style="float:right;border:1px solid #8c8c8c;border-radius:5px;padding: 10px;">
        <i class="fa fa-plus"></i> Add New Ticket
    </a>
    <div class="mb20"></div>
    <div class="clearfix mb5">
        <div class="">
            <form class="relative" name="frmGestorSolicitudesBusc" action="" method="get" onsubmit="return va_solicitudes_validarSolicBusc(this);">
                {{ csrf_field() }}
                <input class="adminFiltersSuggest__Search" type="search" name="sn" value="@if(isset($_GET['sn'])){{$_GET['sn']}}@endif" placeholder="Search" style="width:80%;display:inline-block;">
                <div class="adminFiltersSuggest__More app-solicitudes-drop app-solicitudes-drop-search" style="display:inline-block;">
                    <span class="adminFiltersBox__moreButton" role="button" style="font-size:18px;">Advanced search</span>
                    <div class="app-solicitudes-droplayer adminFiltersSuggest__Layer" style="display:none;top:33px !important;">
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
</script>