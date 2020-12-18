<div tabindex="-1" role="dialog" aria-hidden="false" class="modal fade in" id="removeGuest-modal" style="z-index:1040;display:none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modal-headerTools">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <i class="svgIcon svgIcon__close "><svg viewBox="0 0 26 26"><path d="M12.983 10.862L23.405.439l2.122 2.122-10.423 10.422 10.423 10.422-2.122 2.122-10.422-10.423L2.561 25.527.439 23.405l10.423-10.422L.439 2.561 2.561.439l10.422 10.423z" fill-rule="nonzero"></path></svg></i>
                </button>
                <p class="modal-headerTools-title">Remove Guests</p>
            </div>
            <form class="app-form-guest-delete" action="{{url('tools/remove_guest')}}" method="post">
                @csrf
                <input type="hidden" name="idGuestModal">
                <input type="hidden" name="selectedGuestsId">
                <div class="modal-body p30">
                    <p>Do you want to permanently remove these guests from your account?</p>
                    <div class="mt20">
                        <input class="btn-flat red mr5" type="submit" value="Confirm">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>