<div tabindex="-1" role="dialog" aria-hidden="false" class="modal fade in" id="newMenus-modal" style="z-index:1040;display:none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modal-headerTools">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <i class="svgIcon svgIcon__close "><svg viewBox="0 0 26 26"><path d="M12.983 10.862L23.405.439l2.122 2.122-10.423 10.422 10.423 10.422-2.122 2.122-10.422-10.423L2.561 25.527.439 23.405l10.423-10.422L.439 2.561 2.561.439l10.422 10.423z" fill-rule="nonzero"></path></svg></i>
                </button>
                <p class="modal-headerTools-title">Add new Menu</p>
            </div>
            <form id="newMenusForm" class="app-form-menu-update" action="#" method="post">
                @csrf
                <input type="hidden" name="inviteTblId">
                <input type="hidden" name="eventTblId">
                <div class="modal-body p30">
                    <div class="alert alert-error" style="display:none;">
                        <p>This name is already exist. Please enter another name.</p>
                    </div>
                    <div class="input-group-line">
                        <span class="input-group-line-label">Name <span class="required">*</span></span>
                        <input type="hidden" name="old_menu_name">
                        <input type="text" name="menu_name" maxlength="40" placeholder="Menu">
                        <span id="menu_nameErr" style="color:red;display:none;">The name must contain a minimum of three characters</span>
                    </div>
                    <input class="btn-flat red inviteTblId" type="button" value="Add Menu" onclick="createNewMenu();">
                    <input class="btn-flat red eventTblId" type="button" value="Update Menu" onclick="updateMenu();" style="display:none;">
                    <input class="btn-flat red eventTblIdnew" type="button" value="Add Menu" onclick="submit_newMenu();" style="display:none;">
                </div>
            </form>
        </div>
    </div>
</div>