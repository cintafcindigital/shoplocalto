 <!-- Modal -->
<div class="modal fade my-wedding-modal" id="addBudgetPopup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document" style="width:400px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Budget</h4>
      </div>
      <div class="modal-body">
        <form name="frmBudgetLayer" id="frmBudgetLayer" action="#" method="post">
                <div class="alert app-budget-add"></div>
                <div class="pure-g">
                    <div class="pure-u-1 modal-addGuest-right" style="min-height:300px;">
                        <div class="app-tab-box-content modal-addGuest-section addGuest-1 active" data-step="1">
                            <p class="modal-addGuest-right-title mb15">Add New Expense</p>
                             <div class="pure-g">
                                <div class="pure-u-1">
                                    <div class="input-group-line mr10">
                                        <div class="input-group-line">
                                            <span class="input-group-line-label">CONCEPT</span>
                                            <input type="text" value="" data-msgerror="The name must contain a minimum of three characters" id="popup_concept" name="concept" placeholder="Concept">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="pure-g">
                                <div class="pure-u-1">
                                    <div class="input-group-line mr10">
                                        <div class="input-group-line">
                                            <span class="input-group-line-label">ESTIMATED BUDGET</span>
                                            <input type="text" value="" data-msgerror="The name must contain a minimum of three characters" id="popup_estimate_budget" name="estimate_budget" placeholder="C$ Estimated budget">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="pure-g">
                                <div class="pure-u-1">
                                    <div class="input-group-line mr10">
                                        <div class="input-group-line">
                                            <span class="input-group-line-label">FINAL COST</span>
                                            <input type="text" value="" data-msgerror="The name must contain a minimum of three characters" id="popup_final_cost" name="final_cost" placeholder="C$ Final cost">
                                            <input type="hidden" id="current_budget_cat_id" value="">
                                            <input type="hidden" id="current_task_id" value="">
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
            <!-- <button onclick="Frontend.toolsBudgetLayerSubmit(0);" class="btn-outline outline-red mr10 app-guest-save" type="button">Save and add another</button> -->
            <button onclick="Frontend.toolsBudgetLayerSubmit(1);" class="btn-flat red app-guest-save" type="button">Save </button>
      </div>
    </div>
  </div>
</div><!-- My Wedding Modal -->