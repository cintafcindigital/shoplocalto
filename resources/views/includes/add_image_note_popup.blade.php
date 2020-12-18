 <!-- Modal -->
<div class="modal fade my-wedding-modal" id="addAlbumImageNote" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document" style="width:400px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Loving Memory</h4>
      </div>
      <div class="modal-body">
        <form name="frmBudgetLayer" id="frmBudgetLayer" action="#" method="post">
                <div class="app-album-image-note"></div>
                <div class="pure-g">
                    <div class="pure-u-1 modal-addGuest-right" style="min-height:70px;">
                        <div class="app-tab-box-content modal-addGuest-section addGuest-1 active" data-step="1">
                            <div class="pure-g">
                                <div class="pure-u-1">
                                    <div class="input-group-line mr10">
                                        <div class="input-group-line">
                                            <span class="input-group-line-label">Title</span>
                                            <input id="popup_album_image_title" name="popup_album_image_note" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="pure-u-1">
                                    <div class="input-group-line mr10">
                                        <div class="input-group-line">
                                            <span class="input-group-line-label">Description</span>
                                            <textarea id="popup_album_image_note" name="popup_album_image_note"></textarea>
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
            <input type="hidden" id="id_user_album_image" value=""> 
            <button onclick="Frontend.SaveAlbumImageNote();" class="btn-flat red" type="button">Save </button>
      </div>
    </div>
  </div>
</div><!-- My Wedding Modal -->