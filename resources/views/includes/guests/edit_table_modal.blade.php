<div tabindex="-1" role="dialog" aria-hidden="false" class="modal fade in" id="editTable-modal" style="z-index:1040;display:none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modal-headerTools">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <i class="svgIcon svgIcon__close "><svg viewBox="0 0 26 26"><path d="M12.983 10.862L23.405.439l2.122 2.122-10.423 10.422 10.423 10.422-2.122 2.122-10.422-10.423L2.561 25.527.439 23.405l10.423-10.422L.439 2.561 2.561.439l10.422 10.423z" fill-rule="nonzero"></path></svg></i>
                </button>
                <p class="modal-headerTools-title">Edit Table</p>
            </div>
            <form id="newTablesForm" class="app-form-menu-update" action="#" method="post">
                @csrf
                <input type="hidden" name="chartId">
                <div class="modal-body p30">
                    <div class="input-group-line">
                        <span class="input-group-line-label">Table Name <span class="required">*</span></span>
                        <input type="text" name="table_name" maxlength="40" placeholder="Table">
                        <span id="table_nameErr" style="color:red;display:none;">You must select a name.</span>
                    </div>
                    <input class="btn-flat red" type="button" value="Update Table" onclick="updateTable();">
                </div>
            </form>
        </div>
    </div>
</div>