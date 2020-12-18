 <!-- Modal -->
<div class="modal fade my-wedding-modal" id="addImagePopup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document" style="width:500px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Photos</h4>
      </div>
      <div class="modal-body">
        <form name="frmBudgetLayer" id="frmBudgetLayer" action="#" method="post" enctype="multipart/form-data">
            <div class="response-sms"></div>
            <div class="pure-g">
                <div class="pure-u-1 modal-addGuest-right" style="min-height:100px;">
                    <div class="app-tab-box-content modal-addGuest-section addGuest-1 active" data-step="1">
                         <div class="pure-g">
                            <div class="pure-u-1" style="text-align: center;">
                                <div class="title-g-img-uploag">Upload Photos <small>(Multiple)</small></div>
                                <div class="input-group-line" style="margin-bottom: 0; text-align: center;">
                                    <div class="upl-foto app-photo-1 hide">
                                        <input id="groupImageid" type="file" name="groupImage[]" accept="image/*" multiple="multiple">
                                    </div>
                                    <label for="groupImageid" class="pointer frame-inputFile btn-outline outline-red"> Upload </label>
                                    <input type="hidden" value="" id="imageGroupid" name="imageGroupid">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
      </div>
      <div class="modal-addGuest-footer">
            <button class="btn-flat red group-image-save" type="button">Save </button>
      </div>
    </div>
  </div>
</div><!-- My Wedding Modal -->