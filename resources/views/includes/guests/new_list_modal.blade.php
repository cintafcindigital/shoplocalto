<div tabindex="-1" role="dialog" aria-hidden="false" class="modal fade in" id="newLists-modal" style="z-index:1040;display:none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modal-headerTools">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <i class="svgIcon svgIcon__close "><svg viewBox="0 0 26 26"><path d="M12.983 10.862L23.405.439l2.122 2.122-10.423 10.422 10.423 10.422-2.122 2.122-10.422-10.423L2.561 25.527.439 23.405l10.423-10.422L.439 2.561 2.561.439l10.422 10.423z" fill-rule="nonzero"></path></svg></i>
                </button>
                <p class="modal-headerTools-title">Add a new List</p>
            </div>
            <form id="newListsForm" class="app-form-list-update" action="#" method="post">
                @csrf
                <input type="hidden" name="inviteTblIdList">
                <input type="hidden" name="eventTblIdList">
                <div class="modal-body p30">
                    <div class="alert alert-error" style="display:none;">
                        <p>This name is already exist. Please enter another name.</p>
                    </div>
                    <div class="input-group-line">
                        <span class="input-group-line-label">List Name <span class="required">*</span></span>
                        <input type="hidden" name="old_list_name">
                        <input type="text" name="list_name" maxlength="40" placeholder="List name">
                        <span id="list_nameErr" style="color:red;display:none;">The name must contain a minimum of three characters</span>
                    </div>
                    <input class="btn-flat red inviteTblIdList" type="button" value="Add a List" onclick="createNewList();">
                    <input class="btn-flat red eventTblIdList" type="button" value="Update List" onclick="updateList();" style="display:none;">
                    <input class="btn-flat red eventTblIdListnew" type="button" value="Add a List" onclick="submit_newList();" style="display:none;">
                </div>
            </form>
        </div>
    </div>
</div>