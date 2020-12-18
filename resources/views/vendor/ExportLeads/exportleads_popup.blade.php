@php
$firstDayofPreviousMonth = date('d/m/Y');
$lastDayofPreviousMonth = date('d/m/Y', strtotime('-30 days'));
@endphp

<div id="app-va-modal" class="modal fade dnone in export_lead_cont" tabindex="-1" role="dialog" aria-hidden="false" style="display: none;">
   <div class="modal-dialog content">
      <div class="modal-content">
         <button type="button" class="close export_close" data-dismiss="modal" aria-hidden="true">×</button>
         <div class="modal-header">
            <h2 class="adminModalTitle">Export leads</h2>
         </div>
         <div class="adminModalContent text-center">
            <form class="pure-form pure-form-aligned" name="frmAdmin" method="post" action="{{ url('leadexport') }}">
            {{ csrf_field() }}
               <p>Select the time frame you would like to export.</p>
               <div class="mt15 pure-control-group">
                  <label class="pure-u-1-6 adminFormLabel mt5">From:</label>
                  <div class="pure-u-1-2 input-append date app-common-datepicker">
                     <input class="pure-u-1 datetimepicker" id="FecIni" value="{{ $lastDayofPreviousMonth }}" type="text" name="fromDate" data-date-weekstart="1" placeholder="dd/mm/yyyy">
                     <span class="add-on"></span>
                  </div>
               </div>
               <div class="pure-control-group">
                  <label class="pure-u-1-6 adminFormLabel mt5">Until:</label>
                  <div class="pure-u-1-2 input-append date app-common-datepicker">
                     <input class="pure-u-1 datetimepicker" id="FecFin" value="{{ $firstDayofPreviousMonth }}" type="text" name="toDate" data-date-weekstart="1" placeholder="dd/mm/yyyy">
                     <span class="add-on"></span>
                  </div>
               </div>
               <input class="btnFlat btnFlat--primary ajax-button mt10" type="submit" value="Export leads">
            </form>
         </div>
      </div>
   </div>
</div>
<div class="popup_overlay" style="display: none;"></div>