<div class="modal fade vendor-modal" id="myModalAddListVendor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-content">
        <div class="modal-header modal-headerTools">
            <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
            <p class="modal-headerTools-title">Vendors for this task</p>
            <p class="modal-headerTools-subtitle">Choose a type of vendor:</p>
        </div>
        <div class="modal-body">
        <form name="frmNewItem" class="app-form-new-vendor server-vendor-form" method="post" action="{{url('add_vendor_to_task')}}">
            {{csrf_field()}}
            <div class="modal-vendors-search">
                <span class="app-loader-line loader-line"></span>
                <span class="icon-tools icon-tools-search pr10"></span>
                <input type="text" class="pure-u-1" name="nameEmpresa" autocomplete="off" placeholder="Enter the vendor's name" onkeyup="Frontend.allVendorsData(this)" id="vendor_search_data_show" >
                <input type="hidden" class="app-suggest-vendor-id-default" name="vendor_search_data" id="vendor_search_data" value="">
                <input type="hidden" name="search_cat_id" id="search_cat_id" value="">
                <input type="hidden" name="list_id" id="list_id" value="{{$data['list_id']}}">
                <div class="droplayer droplayer-scroll app-suggest-vendor-div-default vendor-suggest-list hide" style="top: 70px;">
                   <ul class="nav-main-list search-vendor-list"></ul>
                </div>
            </div>
             <div class="no-match hide">
                  No matches have been found
            </div>
            <!-- <div class="modal-vendors-footer app-addvendor-footer dnone"> -->
            <div class="pure-g app-new-vendor-ask-reserved modal-vendors-reserved app-addvendor-footer dnone">
              <div class="pure-u-1-2">
                    <input id="status" name="status" type="hidden" value="6">
                    <p>Already hired this vendor?</p>
                    <div class="modal-vendors-switch app-switch-vendor" data-switch="0">
                        <span class="modal-vendors-switch-left app-switch-vendor-item" onclick="Frontend.vendorHiredOrNot(this)" data-switch-item="1">Yes</span>
                        <span class="modal-vendors-switch-right app-switch-vendor-item search-active" onclick="Frontend.vendorHiredOrNot(this)" data-switch-item="0">No</span>
                        <input type="hidden" name="vendor_hired" id="vendor_hired" value="0">
                        <div class="modal-vendors-switch-label"></div>
                    </div>
              </div>
              <div class="pure-u-1-2 text-right">
                    <button type="submit" class="btn-flat red mt35 app-tools-vendors-save" data-id-categ="116" data-zona-insert="11" data-reload="">
                        Save vendor
                    </button>
                </div>
            </div>
        </form>
      </div>
    </div>
    </div>
  </div>
</div>