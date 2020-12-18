 <!-- Modal -->
<div class="modal fade my-wedding-modal" id="addEstimateBudgetPopup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document" style="width:400px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Estimated Budget</h4>
      </div>
      <div class="modal-body">
        <form name="frmBudgetLayer" id="frmBudgetLayer" action="#" method="post">
                <div class="alert app-total-budget-add"></div>
                <div class="pure-g">
                    <div class="pure-u-1 modal-addGuest-right" style="min-height:70px;">
                        <div class="app-tab-box-content modal-addGuest-section addGuest-1 active" data-step="1">
                            <div class="pure-g">
                                <div class="pure-u-1">
                                    <div class="input-group-line mr10">
                                        <div class="input-group-line">
                                            <span class="input-group-line-label">ESTIMATED BUDGET</span>
                                            <input type="text" value="" data-msgerror="The name must contain a minimum of three characters" id="popup_total_estimate_budget" name="total_estimate_budget" placeholder="C$ Estimated budget">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
      </div>
      <div class="modal-addGuest-footer">
            <button onclick="Frontend.toolsTotalBudgetLayerSubmit(1);" class="btn-flat red app-guest-save" type="button">Save </button>
      </div>
    </div>
  </div>
</div><!-- My Wedding Modal -->