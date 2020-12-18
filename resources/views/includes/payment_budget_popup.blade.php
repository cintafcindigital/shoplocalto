 <!-- Modal -->
<div class="modal fade my-wedding-modal" id="addBudgetPaymentPopup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document" style="width:400px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Payment</h4>
      </div>
      <div class="modal-body">
            <form id="app-payment-form" method="post" action="{{url('tools/add_budget_payment')}}" name="paymentForm" data-parent-id="" data-category-id="" data-payment-id="" data-new-categ-pay="true">
                {{csrf_field()}}
                <div class="p40">
                <p class="msg-show-payment modal-addGuest-right-title mb15"></p>
                    <div class="pure-g">
                        <div class="pure-u-1-2">
                            <span class="input-group-line-label">Amount</span>
                            <div class="input-group-line input-group-large input-group-line-currency">
                                <span class="currency">C$ </span>
                            <input class="app-budget-inputamount" id="app-budget-inputamount" type="number" name="paid" value="0" placeholder="0" data-msgerror="The price must be greater than 0 dollars" required>
                        </div>
                        </div>
                        <div class="pure-u-1-2">
                            <div class="mt25 ml20">
                                    <label for="check" class="checkbox" style="font-size:14px;margin:0px;">
                                            <input type="checkbox" name="is_paid" class="check" id="check" value="1">
                                           Paid
                                            <span class="checkmark"></span>
                                    </label>
                            </div>
                        </div>
                    </div>
                    <div class="pure-g">
                        <div class="pure-u-1">
                            <div class="input-group-line">
                                <span class="input-group-line-label">Date paid</span>
                                <div class="app-common-datepicker">
                                    <input name="paid_date" id="paid_date" placeholder="dd/mm/yyyy" size="11" type="text" value="" class="datetimepicker">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="pure-g">
                        <div class="pure-u-1">
                            <div class="input-group-line">
                                <span class="input-group-line-label">Paid by (name)</span>
                                <input name="paid_by" id="paid_by" type="text" placeholder="Name" value="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p25 text-center border-top">
                    <input type="hidden" name="id" id="payment_budget_id" value="">
                    <button class="btn-flat red" type="submit">Save</button>
                </div>
            </form>
        </div>     
    </div>
  </div>
</div><!-- My Wedding Modal -->