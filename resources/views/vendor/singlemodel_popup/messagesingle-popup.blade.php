<div id="app-va-modal-addnode" class="modal fade dnone in" tabindex="-1" role="dialog" aria-hidden="false" style="display: none;">
    <div class="modal-dialog content">
        <div class="modal-content box box-blood">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h2 class="adminModalTitle">Add note</h2>
            </div>
            <div class="modal-body">
                <form class="pure-form pure-form-stacked pt20 pr25 pb20 pl25" name="addnoteMessage" id="addnoteMessage" action="{{ url('/message-add-note') }}" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" id="note_enqury_id" name="note_enqury_id" value="{{ $data['message_details']->id }}">
                    <input type="hidden" id="note_enq_name" name="note_enq_name" value="{{ $data['message_details']->name }}">
                    <input type="hidden" id="note_enq_email" name="note_enq_email" value="{{ $data['message_details']->email }}">
                    <textarea class="pure-u-1" rows="5" id="message_note" name="message_note"></textarea>
                    <p class="small color-grey mt10">This note will only be visible in your message history.</p>
                    <input class="btnFlat btnFlat--primary mt10" type="submit" value="Save" onclick="return saveNote()">
                </form>
            </div>
        </div>
    </div>
</div>
<div id="app-va-modal-sendlead" class="modal fade dnone in" tabindex="-1" role="dialog" aria-hidden="false" style="display: none;">
    <div class="modal-dialog content">
        <div class="modal-content box box-blood">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h2 class="adminModalTitle">Resend message</h2>
            </div>
            <div class="modal-body">
                <form class="pure-form pure-form-stacked pt20 pr25 pb20 pl25" name="resendLead" id="resendLead" action="{{ url('/resend-lead') }}" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" id="resend_enqury_id" name="resend_enqury_id" value="{{ $data['message_details']->id }}">
                    <p>Enter the email of the person you would like to forward this lead to.</p>
                    <textarea class="pure-u-1" rows="5" id="resend_mail" name="resend_mail">{{ $data['vendorData'][0]['email'] }}</textarea>
                    <input class="mt15 btnFlat btnFlat--primary" type="submit" value="Resend message" onclick="return resendMessage()">
                </form>
            </div>
        </div>
    </div>
</div>
<div class="popup_overlay" style="display: none;"></div>