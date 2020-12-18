<div tabindex="-1" role="dialog" aria-hidden="false" class="modal fade in" id="newGroup-modal" style="z-index:1040;display:none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modal-headerTools">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <i class="svgIcon svgIcon__close ">
                        <svg viewBox="0 0 26 26">
                            <path d="M12.983 10.862L23.405.439l2.122 2.122-10.423 10.422 10.423 10.422-2.122 2.122-10.422-10.423L2.561 25.527.439 23.405l10.423-10.422L.439 2.561 2.561.439l10.422 10.423z" fill-rule="nonzero"></path>
                        </svg>
                    </i>
                </button>
                <p class="modal-headerTools-title"></p>
            </div>
            <div class="modal-body">
                <form id="newGroupForm" class="app-form-group-update" action="#" method="post">
                    @csrf
                    <div class="modal-body p30">
                        <div class="mb20">
                            <div class="alert alert-error" style="display:none;">
                                <p>This name is already exist. Please enter another name.</p>
                            </div>
                            <input type="hidden" name="idGroup" value="">
                            <div class="input-group-line">
                                <span class="input-group-line-label">Name</span>
                                <input type="text" name="group_name" size="40" maxlength="80" placeholder="Group" onclick="groupNameErr();">
                                <span class="groupNameErr dnone" style="color:#f5234d;">The name must contain a minimum of three characters</span>
                            </div>
                        </div>
                        <input type="button" onclick="submit_group_name();" class="btn-flat red" value="Save">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>