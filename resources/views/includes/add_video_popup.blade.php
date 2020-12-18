 <!-- Modal -->
<div class="modal fade my-wedding-modal" id="addVideoPopup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document" style="width:500px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Video</h4>
      </div>
      <div class="modal-body">
        <form name="frmBudgetLayer" id="frmBudgetLayer" action="#" method="post">
            <div class="response-sms"></div>
            <div class="pure-g">
                <div class="pure-u-1 modal-addGuest-right" style="min-height:100px;">
                    <div class="app-tab-box-content modal-addGuest-section addGuest-1 active" data-step="1">
                         <div class="pure-g">
                            <div class="pure-u-1">
                                <div class="input-group-line" style="margin-bottom: 0">
                                    <span class="input-group-line-label">Video URL</span>
                                    <input type="text" id="group_viedo" name="group-viedo" placeholder="https://www.youtube.com/watch?v=8BB2VFhLe_Y; https://vimeo.com/91246" style="padding: 8px">
                                    <input type="hidden" value="" id="videoGroupid" name="videoGroupid">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
      </div>
      <div class="modal-addGuest-footer">
            <button class="btn-flat red group-video-save" type="button">Save </button>
      </div>
    </div>
  </div>
</div><!-- My Wedding Modal -->