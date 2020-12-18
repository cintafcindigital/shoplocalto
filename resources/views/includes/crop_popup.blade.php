 <!-- Modal -->
<div class="modal fade my-wedding-modal" id="myModalCrop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabelCrop">Crop your photo</h4>
      </div>
      <div class="modal-body">
                 <div class="demo-wrap" style="display:none;">
                    <div class="container">
                        <div class="grid">
                            <div class="col-1-2">
                                <div id="vanilla-demo"></div>
                            </div>
                            <div class="col-1-2">                            
                                <div class="actions">
                                    <button class="vanilla-result">Result</button>
                                </div>
                            </div>
                        </div>
                    </div> 
                </div> 
                <div class="demo-wrap upload-demo">
                    <div class="grids">
                        <div class="col-1-2">
                            <div id="upload-demo"></div>
                        </div>
                        <div class="col-1-2">
                            <div class="actions" style="text-align: center;margin-bottom: 30px;">
                                <a class="btn file-btn" style="display:none;">
                                    <span>Upload</span>
                                    <input  type="file" id="upload" value="Choose a file" accept="image/*" />
                                </a>
                                <input type="hidden" id="user_type_crop" value="">
                                <input type="hidden" name="imageData" id="imageData">
                                <button class="upload-result btn-flat red">Crop Image</button>
                            </div>
                        </div>
                        
                    </div>
         </div>

      </div>
    </div>
  </div>
</div><!-- My Wedding Modal -->